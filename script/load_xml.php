<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

global $arTransalteParams;
$arTransalteParams = array("replace_space"=>"_","replace_other"=>"_");


?>
    <h2>Загрузка каталога объектов</h2>
<form action="" method="post">
<?
$files = DirFilesR("../xml/");
if($files){
    ?>
    <label for="file">Выберите файл</label>
    <select name="file" id="file">
        <?foreach ($files as $file){?>
            <option value="<?=$file?>"><?=$file?></option>
        <?}?>
    </select>
    <?
}
?><br/><br/>
    <label for="delete"><input type="checkbox" id="delete" name="delete" value="Y"/> Удалить неактуальные записи</label><br/><br/>
    <input type="submit" name="go" value="Запустить обновление"/>

</form>
<?

if($_POST["go"] && $_POST["file"]) {
    set_time_limit(0);

  //ini_set('memory_limit', '6000M');
    global $updatedElements, $updatedSections, $timestamp_start, $arDevelopers, $arBanks, $arBuildings, $propRoomsArr, $propMetroArr, $propPaymentArr, $propSectionPaymentArr, $propStateArr, $propReadyArr, $limit, $arFIlterSections;

    $timestamp_start = time();

    file_put_contents("log.txt", $timestamp_start);

    if (CModule::IncludeModule("iblock")) {


        $arSelect = Array("ID", "NAME", "XML_ID");
        $arFilter = Array("IBLOCK_ID" => DEVELOPER_IBLOCK_ID, "ACTIVE" => "Y");
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 500), $arSelect);
        while ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $arDevelopers[$arFields["XML_ID"]] = $arFields;
        }
        $arSelect = Array("ID", "NAME");
        $arFilter = Array("IBLOCK_ID" => BANKS_IBLOCK_ID, "ACTIVE" => "Y");
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 500), $arSelect);
        while ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $arBanks[$arFields["NAME"]] = $arFields;
        }
        $arSelect = Array("ID", "NAME", "XML_ID", "UF_LOCKED");
        $arFilter = Array('IBLOCK_ID' => CATALOG_IBLOCK_ID, 'GLOBAL_ACTIVE' => 'Y', "DEPTH_LEVEL" => "1");
        $res = CIBlockSection::GetList(Array(), $arFilter, true, $arSelect);
        while ($ob = $res->GetNext()) {
            $arBuildings[$ob["XML_ID"]] = $ob;
        }
        $arSelect = Array("ID", "NAME", "XML_ID");
        $arFilter = Array("IBLOCK_ID"=>METRO_IBLOCK_ID, "ACTIVE"=>"Y");
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>100), $arSelect);
        while($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $propMetroArr[$arFields["XML_ID"]] = $arFields;
        }
        $property_enums = CIBlockPropertyEnum::GetList(Array("SORT" => "ASC"), Array("IBLOCK_ID" => CATALOG_IBLOCK_ID, "CODE" => "payment"));
        while ($enum_fields = $property_enums->GetNext()) {
            $propPaymentArr[$enum_fields["XML_ID"]] = $enum_fields;
        }
        $property_enums = CIBlockPropertyEnum::GetList(Array("SORT" => "ASC"), Array("IBLOCK_ID" => CATALOG_IBLOCK_ID, "CODE" => "building_state"));
        while ($enum_fields = $property_enums->GetNext()) {
            $propStateArr[$enum_fields["XML_ID"]] = $enum_fields;
        }
        $property_enums = CIBlockPropertyEnum::GetList(Array("SORT" => "ASC"), Array("IBLOCK_ID" => CATALOG_IBLOCK_ID, "CODE" => "ready3"));
        while ($enum_fields = $property_enums->GetNext()) {
            $propReadyArr[$enum_fields["XML_ID"]] = $enum_fields["ID"];
        }
        $property_enums = CUserFieldEnum::GetList(array(), array("USER_FIELD_NAME" => "UF_PAYMENT"));
        while ($enum_fields = $property_enums->GetNext()) {
            $propSectionPaymentArr[$enum_fields["XML_ID"]] = $enum_fields;
        }

        $reader = new fileXMLReader('../xml/'.$_POST["file"]);

        $reader->onEvent('afterParseElement', function ($name, $context) {
            $context->clearResult();
        });


        $reader->onEvent('afterParse', function ($name, $context) {
            /*global $timestamp_start;
            $element = new CIBlockElement;
            $rsElements = CIBlockElement::GetList(array(), array(
                "IBLOCK_ID" =>  CATALOG_IBLOCK_ID,
                "ACTIVE" => "Y",
                "<TIMESTAMP_X" => $timestamp_start
            ), false, false, array("ID"));
            while ($arElement = $rsElements->Fetch())
            {
                $element->Delete($arElement["ID"]);
                $context->deleted++;
            }*/
        });



        $reader->onEvent('parseoffer', function ($context) {
            global $updatedElements, $updatedSections, $arDevelopers, $propFilterArr, $arBanks, $arBuildings, $USER, $propRoomsArr, $propMetroArr, $propPaymentArr, $propReadyArr, $propStateArr, $propSectionPaymentArr, $arTransalteParams;
            $item = xml2array($context->getResult());

            if ($item["id"] && is_array($item["properties"])) {
                $arSelect = Array("ID", "NAME", "XML_ID", "PROPERTY_crc", "IBLOCK_SECTION_ID");
                $arFilter = Array("IBLOCK_ID" => CATALOG_IBLOCK_ID, "XML_ID" => $item["id"], "ACTIVE" => "Y");
                $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
                if ($ob = $res->GetNextElement()){
                    $arFields = $ob->GetFields();
                    $ELEMENT_ID = $arFields["ID"];
                    $SECTION_ID = $arFields["IBLOCK_SECTION_ID"];
                    $propCRC = $arFields["PROPERTY_CRC_VALUE"];
                    $crc = md5(json_encode($item["properties"]));

                    $el = new CIBlockElement;
                    if($propCRC == $crc){
                        $updatedElements[]=$arFields["ID"];
                    }else {
                        $arItemPropsArray = array(
                            "region" => $item["properties"]["location"]["region"],
                            "locality_name" => $item["properties"]["location"]["locality-name"],
                            "district" => $item["properties"]["location"]["district"],
                            "sub_locality_name" => $item["properties"]["location"]["sub-locality-name"],
                            "flat_number" => $item["properties"]["flat-number"],
                            "corpus_name" => $item["properties"]["corpus-name"],
                            "levels" => $item["properties"]["levels"],
                            "price_base" => $item["properties"]["price-base"]["value"],
                            "area" => $item["properties"]["area"]["value"],
                            "living_space" => $item["properties"]["living-space"]["value"],
                            "kitchen_space" => $item["properties"]["kitchen-space"]["value"],
                            "bathroom_unit" => $item["properties"]["bathroom-unit"],
                            "floor" => $item["properties"]["floor"],
                            "floors_total" => $item["properties"]["floors-total"],
                            "building_section" => $item["properties"]["building-section"],
                            "renovation" => $item["properties"]["furnish"],
                            "ceiling_height" => $item["properties"]["ceiling-height"],
                            "balcony_space" => $item["properties"]["balcony-space"]["value"],
                            "price_discount" => $item["properties"]["price-discount"]["value"],
                            "ready" => floatval($item["properties"]["built-year"] . "." . $item["properties"]["ready-quarter"]),
                            "building_state" => $propStateArr[$item["properties"]["building-state"]],
                            "crc" => $crc
                        );
                        $rooms = ($item["properties"]["studio"] ? "studio" : $item["properties"]["rooms"]);
                        if($rooms){
                            $code = "flat_".$rooms;
                            if($propFilterArr[$code]) {
                                $arItemPropsArray["rooms"] = $propFilterArr[$code]["ID"];
                            }
                        }
                        if ($item["properties"]["maternal-capital"]) $arItemPropsArray["payment"][] = $propPaymentArr["maternal-capital"]["ID"];
                        elseif ($item["properties"]["military-mortgage"]) $arItemPropsArray["payment"][] = $propPaymentArr["military-mortgage"]["ID"];
                        elseif ($item["properties"]["developers-subsidies"]) $arItemPropsArray["payment"][] = $propPaymentArr["developers-subsidies"]["ID"];

                        if(is_array($item["properties"]["metro-id"])){
                            foreach ($item["properties"]["metro-id"] as $xml_id)
                                $arItemPropsArray["metro-id"][] = $propMetroArr[$xml_id]["ID"];
                        }elseif($item["properties"]["metro-id"]){
                            $xml_id = IntVal($item["properties"]["metro-id"]);
                            $arItemPropsArray["metro-id"][] = $propMetroArr[$xml_id]["ID"];
                        }
                        //значения фильтра для выдачи
                        //метро
                        if(is_array($item["properties"]["metro-id"])){
                            foreach ($item["properties"]["metro-id"] as $xml_id) {
                                $arItemPropsArray["filter"][] = $propFilterArr["metro_id_".$xml_id]["ID"];
                            }
                        }elseif($item["properties"]["metro-id"]){
                            $arItemPropsArray["filter"][] = $propFilterArr["metro_id_".$item["properties"]["metro-id"]]["ID"];
                        }
                        //locality-name
                        if($item["properties"]["location"]["locality-name"]){
                            $code = "locality-name_".CUtil::Translit($item["properties"]["location"]["locality-name"], "ru", array("replace_space" => "-", "replace_other" => "-"));
                            if($propFilterArr[$code]) {
                                $arItemPropsArray["filter"][] = $propFilterArr[$code]["ID"];

                            }else{
                                $ID = addFilterValue("locality-name", $item["properties"]["location"]["locality-name"]);
                                $arItemPropsArray["filter"][] = $ID;
                            }
                        }
                        //sub-locality-name
                        if($item["properties"]["location"]["sub-locality-name"]){
                            $code = "sub-locality-name_".CUtil::Translit($item["properties"]["location"]["sub-locality-name"], "ru", array("replace_space" => "-", "replace_other" => "-"));
                            if($propFilterArr[$code]) {
                                $arItemPropsArray["filter"][] = $propFilterArr[$code]["ID"];

                            }else{
                                $ID = addFilterValue("sub-locality-name", $item["properties"]["location"]["sub-locality-name"]);
                                $arItemPropsArray["filter"][] = $ID;
                            }
                        }
                        //district
                        if($item["properties"]["location"]["district"]){

                            $code = "district_".CUtil::Translit($item["properties"]["location"]["district"], "ru", array("replace_space" => "-", "replace_other" => "-"));
                            if($propFilterArr[$code]) {
                                $arItemPropsArray["filter"][] = $propFilterArr[$code]["ID"];

                            }else{
                                $ID = addFilterValue("district", $item["properties"]["location"]["district"]);
                                $arItemPropsArray["filter"][] = $ID;
                            }
                        }
                        //developer
                        if($item["properties"]["developer-name"]){

                            $code = "developer_".CUtil::Translit($item["properties"]["developer-name"], "ru", array("replace_space" => "-", "replace_other" => "-"));
                            if($propFilterArr[$code]) {
                                $arItemPropsArray["filter"][] = $propFilterArr[$code]["ID"];

                            }else{
                                $ID = addFilterValue("developer", $item["properties"]["developer-name"]);
                                $arItemPropsArray["filter"][] = $ID;
                            }
                        }
                        //zhk
                        if($item["properties"]["zhk-name"]){
                            $code = "zhk_".CUtil::Translit($item["properties"]["zhk-name"], "ru", array("replace_space" => "-", "replace_other" => "-"));
                            if($propFilterArr[$code]) {
                                $arItemPropsArray["filter"][] = $propFilterArr[$code]["ID"];

                            }else{
                                $ID = addFilterValue("zhk", $item["properties"]["zhk-name"]);
                                $arItemPropsArray["filter"][] = $ID;
                            }
                        }
                        // обновление описания квартиры
                        $arLoadItemArray = Array(
                            "NAME" => "Квартира " . $item["properties"]["flat-number"],
                            "PROPERTY_VALUES" => $arItemPropsArray
                        );
                        if ($item["properties"]["image"][0])
                            $arLoadItemArray["PREVIEW_PICTURE"] = CFile::MakeFileArray($item["properties"]["image"][0]);
                        //print_r($item["properties"]);
                        //print_r($arLoadItemArray);die();
                        $res = $el->Update($ELEMENT_ID, $arLoadItemArray);
                        $updatedElements[] = $ELEMENT_ID;

                    }

                    if(!in_array($SECTION_ID, $updatedSections)){
                        if($arBuildings[$item["properties"]["zhk-id"]]["UF_LOCKED"]!=1) {
                            $bs = new CIBlockSection;
                            $arSectionFields = Array(
                                "ACTIVE" => "Y",
                                "IBLOCK_SECTION_ID" => "",
                                "IBLOCK_ID" => CATALOG_IBLOCK_ID,
                                "NAME" => $item["properties"]["zhk-name"],
                                "XML_ID" => $item["properties"]["zhk-id"],
                                "DESCRIPTION" => $item["properties"]["description"],
                                "DESCRIPTION_TYPE" => "TEXT",
                                "UF_BUILDING_TYPE" => $item["properties"]["building-type"],
                                "UF_SUB_LOCALITY_NAME" => $item["properties"]["location"]["sub-locality-name"],
                                "UF_REGION" => $item["properties"]["location"]["region"],
                                "UF_DISTRICT" => $item["properties"]["location"]["district"],
                                "UF_ADDRESS" => $item["properties"]["location"]["address"],
                                "UF_TIME_ON_FOOT" => $item["properties"]["location"]["metro"]["time-on-foot"],
                                "UF_TIME_ON_TRANSPORT" => $item["properties"]["location"]["metro"]["time-on-transport"],
                                "UF_LOCALITY_NAME" => $item["properties"]["location"]["locality-name"],
                                "UF_LOCATION" => serialize(array("lat" => $item["properties"]["Latitude"], "long" => $item["properties"]["Longitude"]))
                            );

                            if (is_array($item["properties"]["metro-id"])) {
                                foreach ($item["properties"]["metro-id"] as $xml_id)
                                    $arSectionFields["UF_METRO_ID"][] = $propMetroArr[$xml_id]["ID"];
                            } elseif ($item["properties"]["metro-id"]) {
                                $xml_id = IntVal($item["properties"]["metro-id"]);
                                $arSectionFields["UF_METRO_ID"][] = $propMetroArr[$xml_id]["ID"];
                            }
                            if ($item["properties"]["main-image"]) {
                                $arSectionFields["PICTURE"] = CFile::MakeFileArray($item["properties"]["main-image"]);
                            }

                            if (is_array($item["properties"]["complex-image"])) {
                                $arComplexImages = array();
                                foreach ($item["properties"]["complex-image"] as $i => $pict) {
                                    $arComplexImages["n" . $i] = CFile::MakeFileArray($pict);
                                }
                                $arSectionFields["UF_MORE_PHOTO"] = $arComplexImages;
                            }

                            if ($item["properties"]["banks"]["bank"]) {
                                $arSectionBanks = array();
                                foreach ($item["properties"]["banks"]["bank"] as $bank) {
                                    if ($arBanks[$bank]) {
                                        $arSectionBanks[] = $arBanks[$bank]["ID"];
                                    } else {
                                        $el = new CIBlockElement;
                                        $arLoadBankArray = Array(
                                            "MODIFIED_BY" => $USER->GetID(),
                                            "IBLOCK_SECTION_ID" => false,
                                            "IBLOCK_ID" => BANKS_IBLOCK_ID,
                                            "NAME" => $bank,
                                            "ACTIVE" => "Y"
                                        );
                                        if ($bankID = $el->Add($arLoadBankArray)) {

                                            $arSectionBanks[] = $bankID;
                                            $arBanks[$bank] = array("NAME" => $bank, "ID" => $bankID);
                                        }
                                    }
                                }
                                $arSectionFields["UF_BANKS"] = $arSectionBanks;
                            }
                            if ($item["properties"]["maternal-capital"]) $arSectionFields["UF_PAYMENT"][] = $propSectionPaymentArr["maternal-capital"]["ID"];
                            elseif ($item["properties"]["military-mortgage"]) $arSectionFields["UF_PAYMENT"][] = $propSectionPaymentArr["military-mortgage"]["ID"];
                            elseif ($item["properties"]["developers-subsidies"]) $arSectionFields["UF_PAYMENT"][] = $propSectionPaymentArr["developers-subsidies"]["ID"];

                            if ($item["properties"]["developer-id"]) {
                                if ($arDevelopers[$item["properties"]["developer-id"]]) {
                                    $developerID = $arDevelopers[$item["properties"]["developer-id"]]["ID"];
                                } else {
                                    $el = new CIBlockElement;
                                    $arLoadDeveloperArray = Array(
                                        "MODIFIED_BY" => $USER->GetID(),
                                        "IBLOCK_SECTION_ID" => false,
                                        "IBLOCK_ID" => DEVELOPER_IBLOCK_ID,
                                        "NAME" => $item["properties"]["developer-name"],
                                        "ACTIVE" => "Y",
                                        "XML_ID" => $item["properties"]["developer-id"]
                                    );
                                    if ($developerID = $el->Add($arLoadDeveloperArray)) {
                                        $arDevelopers[$item["properties"]["developer-id"]] = array(
                                            "NAME" => $item["properties"]["developer-name"],
                                            "ID" => $developerID,
                                            "XML_ID" => $item["properties"]["developer-id"]
                                        );
                                    }
                                }
                                $arSectionFields["UF_DEVELOPER"] = $developerID;
                            }
                            // обновление ЖК
                            $bs->Update($SECTION_ID, $arSectionFields);
                            $updatedSections[] = $SECTION_ID;
                        }

                    }
                    unset($el);

                }else{
                    $el = new CIBlockElement;
                    $crc = md5(json_encode($item["properties"]));
                    $arItemPropsArray = array(
                        "region" => $item["properties"]["location"]["region"],
                        "locality_name" => $item["properties"]["location"]["locality-name"],
                        "district" => $item["properties"]["location"]["district"],
                        "sub_locality_name" => $item["properties"]["location"]["sub-locality-name"],
                        "flat_number" => $item["properties"]["flat-number"],
                        "corpus_name" => $item["properties"]["corpus-name"],
                        "levels" => $item["properties"]["levels"],
                        "price_base" => $item["properties"]["price-base"]["value"],
                        "area" => $item["properties"]["area"]["value"],
                        "living_space" => $item["properties"]["living-space"]["value"],
                        "kitchen_space" => $item["properties"]["kitchen-space"]["value"],
                        "bathroom_unit" => $item["properties"]["bathroom-unit"],
                        "floor" => $item["properties"]["floor"],
                        "floors_total" => $item["properties"]["floors-total"],
                        "building_section" => $item["properties"]["building-section"],
                        "renovation" => $item["properties"]["furnish"],
                        "ceiling_height" => $item["properties"]["ceiling-height"],
                        "balcony_space" => $item["properties"]["balcony-space"]["value"],
                        "price_discount" => $item["properties"]["price-discount"]["value"],
                        "ready" => floatval($item["properties"]["built-year"].".".$item["properties"]["ready-quarter"]),
                        "building_state" => $propStateArr[$item["properties"]["building-state"]],
                        "crc" => $crc
                    );
                    $rooms = ($item["properties"]["studio"] ? "studio" : $item["properties"]["rooms"]);
                    if($rooms){
                        $code = "flat_".$rooms;
                        if($propFilterArr[$code]) {
                            $arItemPropsArray["rooms"] = $propFilterArr[$code]["ID"];
                        }
                    }
                    if ($item["properties"]["maternal-capital"]) $arItemPropsArray["payment"][] = $propPaymentArr["maternal-capital"]["ID"];
                    elseif ($item["properties"]["military-mortgage"]) $arItemPropsArray["payment"][] = $propPaymentArr["military-mortgage"]["ID"];
                    elseif ($item["properties"]["developers-subsidies"]) $arItemPropsArray["payment"][] = $propPaymentArr["developers-subsidies"]["ID"];

                    if(is_array($item["properties"]["metro-id"])){
                        foreach ($item["properties"]["metro-id"] as $xml_id)
                            $arItemPropsArray["metro-id"][] = $propMetroArr[$xml_id]["ID"];
                    }elseif($item["properties"]["metro-id"]){
                        $xml_id = IntVal($item["properties"]["metro-id"]);
                        $arItemPropsArray["metro-id"][] = $propMetroArr[$xml_id]["ID"];
                    }

                    //значения фильтра для выдачи
                    //метро
                    if(is_array($item["properties"]["metro-id"])){
                        foreach ($item["properties"]["metro-id"] as $xml_id) {
                            $arItemPropsArray["filter"][] = $propFilterArr["metro_id_".$xml_id]["ID"];
                        }
                    }elseif($item["properties"]["metro-id"]){
                        $arItemPropsArray["filter"][] = $propFilterArr["metro_id_".$item["properties"]["metro-id"]]["ID"];
                    }
                    //locality-name
                    if($item["properties"]["location"]["locality-name"]){
                        //echo $item["properties"]["location"]["locality-name"];
                        $code = "locality-name_".CUtil::Translit($item["properties"]["location"]["locality-name"], "ru", array("replace_space" => "-", "replace_other" => "-"));
                        if($propFilterArr[$code]) {
                            $arItemPropsArray["filter"][] = $propFilterArr[$code]["ID"];
                        }else{
                            $ID = addFilterValue("locality-name", $item["properties"]["location"]["locality-name"]);
                            $arItemPropsArray["filter"][] = $ID;
                        }
                    }
                    //sub-locality-name
                    if($item["properties"]["location"]["sub-locality-name"]){
                        $code = "sub-locality-name_".CUtil::Translit($item["properties"]["location"]["sub-locality-name"], "ru", array("replace_space" => "-", "replace_other" => "-"));
                        if($propFilterArr[$code]) {
                            $arItemPropsArray["filter"][] = $propFilterArr[$code]["ID"];
                        }else{
                            $ID = addFilterValue("sub-locality-name", $item["properties"]["location"]["sub-locality-name"]);
                            $arItemPropsArray["filter"][] = $ID;
                        }
                    }
                    //district
                    if($item["properties"]["location"]["district"]){
                        $code = "district_".CUtil::Translit($item["properties"]["location"]["district"], "ru", array("replace_space" => "-", "replace_other" => "-"));
                        if($propFilterArr[$code]) {
                            $arItemPropsArray["filter"][] = $propFilterArr[$code]["ID"];
                        }else{
                            $ID = addFilterValue("district", $item["properties"]["location"]["district"]);
                            $arItemPropsArray["filter"][] = $ID;
                        }
                    }
                    //developer
                    if($item["properties"]["developer-name"]){
                        $code = "developer_".CUtil::Translit($item["properties"]["developer-name"], "ru", array("replace_space" => "-", "replace_other" => "-"));
                        if($propFilterArr[$code]) {
                            $arItemPropsArray["filter"][] = $propFilterArr[$code]["ID"];

                        }else{
                            $ID = addFilterValue("developer", $item["properties"]["developer-name"]);
                            $arItemPropsArray["filter"][] = $ID;
                        }
                    }
                    //zhk
                    if($item["properties"]["zhk-name"]){
                        $code = "zhk_".CUtil::Translit($item["properties"]["zhk-name"], "ru", array("replace_space" => "-", "replace_other" => "-"));
                        if($propFilterArr[$code]) {
                            $arItemPropsArray["filter"][] = $propFilterArr[$code]["ID"];
                        }else{
                            $ID = addFilterValue("zhk", $item["properties"]["zhk-name"]);
                            $arItemPropsArray["filter"][] = $ID;
                        }
                    }
                    $sectionID = $arBuildings[$item["properties"]["zhk-id"]]["ID"];
                    if(!$arBuildings[$item["properties"]["zhk-id"]] || !in_array($sectionID, $updatedSections)){
                        $arSectionFields = Array(
                            "ACTIVE" => "Y",
                            "IBLOCK_SECTION_ID" => "",
                            "IBLOCK_ID" => CATALOG_IBLOCK_ID,
                            "NAME" => $item["properties"]["zhk-name"],
                            "XML_ID" => $item["properties"]["zhk-id"],
                            "DESCRIPTION" => $item["properties"]["description"],
                            "DESCRIPTION_TYPE" => "TEXT",
                            "UF_BUILDING_TYPE" => $item["properties"]["building-type"],
                            "UF_SUB_LOCALITY_NAME" => $item["properties"]["location"]["sub-locality-name"],
                            "UF_DISTRICT" => $item["properties"]["location"]["district"],
                            "UF_REGION" => $item["properties"]["location"]["region"],
                            "UF_ADDRESS" => $item["properties"]["location"]["address"],
                            "UF_LOCALITY_NAME" => $item["properties"]["location"]["locality-name"],
                            "UF_TIME_ON_FOOT" => $item["properties"]["location"]["metro"]["time-on-foot"],
                            "UF_TIME_ON_TRANSPORT" => $item["properties"]["location"]["metro"]["time-on-transport"],
                            "UF_LOCATION" => serialize(array("lat" => $item["properties"]["Latitude"], "long" => $item["properties"]["Longitude"]))
                        );

                        if(is_array($item["properties"]["metro-id"])){
                            foreach ($item["properties"]["metro-id"] as $xml_id)
                                $arSectionFields["UF_METRO_ID"][] = $propMetroArr[$xml_id]["ID"];
                        }elseif($item["properties"]["metro-id"]){
                            $xml_id = IntVal($item["properties"]["metro-id"]);
                            $arSectionFields["UF_METRO_ID"][] = $propMetroArr[$xml_id]["ID"];
                        }
                        if ($item["properties"]["main-image"]) {
                            $arSectionFields["PICTURE"] = CFile::MakeFileArray($item["properties"]["main-image"]);
                        }
                        if (is_array($item["properties"]["complex-image"])) {
                            $arComplexImages = array();
                            foreach ($item["properties"]["complex-image"] as $i => $pict) {
                                $arComplexImages["n" . $i] = CFile::MakeFileArray($pict);
                            }
                            $arSectionFields["UF_MORE_PHOTO"] = $arComplexImages;
                        }
                        if ($item["properties"]["banks"]["bank"]) {
                            $arSectionBanks = array();
                            foreach ($item["properties"]["banks"]["bank"] as $bank) {
                                if ($arBanks[$bank]) {
                                    $arSectionBanks[] = $arBanks[$bank]["ID"];
                                } else {
                                    $el = new CIBlockElement;
                                    $arLoadBankArray = Array(
                                        "MODIFIED_BY" => $USER->GetID(),
                                        "IBLOCK_SECTION_ID" => false,
                                        "IBLOCK_ID" => BANKS_IBLOCK_ID,
                                        "NAME" => $bank,
                                        "ACTIVE" => "Y"
                                    );
                                    if ($bankID = $el->Add($arLoadBankArray)) {

                                        $arSectionBanks[] = $bankID;
                                        $arBanks[$bank] = array("NAME" => $bank, "ID" => $bankID);
                                    }
                                }
                            }
                            $arSectionFields["UF_BANKS"] = $arSectionBanks;
                        }
                        if ($item["properties"]["maternal-capital"]) $arSectionFields["UF_PAYMENT"][] = $propSectionPaymentArr["maternal-capital"]["ID"];
                        elseif ($item["properties"]["military-mortgage"]) $arSectionFields["UF_PAYMENT"][] = $propSectionPaymentArr["military-mortgage"]["ID"];
                        elseif ($item["properties"]["developers-subsidies"]) $arSectionFields["UF_PAYMENT"][] = $propSectionPaymentArr["developers-subsidies"]["ID"];

                        if ($item["properties"]["developer-id"]) {
                            if ($arDevelopers[$item["properties"]["developer-id"]]) {
                                $developerID = $arDevelopers[$item["properties"]["developer-id"]]["ID"];
                            } else {
                                $el = new CIBlockElement;
                                $arLoadDeveloperArray = Array(
                                    "MODIFIED_BY" => $USER->GetID(),
                                    "IBLOCK_SECTION_ID" => false,
                                    "IBLOCK_ID" => DEVELOPER_IBLOCK_ID,
                                    "NAME" => $item["properties"]["developer-name"],
                                    "ACTIVE" => "Y",
                                    "XML_ID" => $item["properties"]["developer-id"]
                                );
                                if ($developerID = $el->Add($arLoadDeveloperArray)) {
                                    $arDevelopers[$item["properties"]["developer-id"]] = array(
                                        "NAME" => $item["properties"]["developer-name"],
                                        "ID" => $developerID,
                                        "XML_ID" => $item["properties"]["developer-id"]
                                    );
                                }
                            }
                            $arSectionFields["UF_DEVELOPER"] = $developerID;
                        }
                    }
                    if (!$arBuildings[$item["properties"]["zhk-id"]]) {
                        $bs = new CIBlockSection;
                        // добавление ЖК
                        if ($sectionID = $bs->Add($arSectionFields)) {
                            $arBuildings[$item["properties"]["zhk-id"]] = array(
                                "NAME" => $item["properties"]["zhk-name"],
                                "ID" => $sectionID
                            );
                        }
                    }
                    if(!in_array($sectionID, $updatedSections) && $arBuildings[$item["properties"]["zhk-id"]]["UF_LOCKED"]!=1){
                        $bs = new CIBlockSection;
                        //обновление ЖК
                        $bs->Update($sectionID, $arSectionFields);
                        $updatedSections[] = $sectionID;
                    }

                    $arLoadItemArray = Array(
                        "MODIFIED_BY" => $USER->GetID(),
                        "IBLOCK_SECTION_ID" => $sectionID,
                        "IBLOCK_ID" => CATALOG_IBLOCK_ID,
                        "PROPERTY_VALUES" => $arItemPropsArray,
                        "NAME" => "Квартира " . $item["properties"]["flat-number"],
                        "ACTIVE" => "Y",
                        "XML_ID" => $item["id"]
                    );

                    if ($item["properties"]["flat-image"])
                        $arLoadItemArray["PREVIEW_PICTURE"] = CFile::MakeFileArray($item["properties"]["flat-image"]);

                    // Добавление квартиры
                    if ($itemID = $el->Add($arLoadItemArray)) {
                        // echo "New ID: ".$itemID;
                        $updatedElements[] = $itemID;

                    } else
                        echo "Error: " . $el->LAST_ERROR;

                    unset($el);
                }
            }
        });

        $reader->parse();
        echo "Обновлено квартир: ".count($updatedElements)."<br/>";

    }
}
if($_POST["delete"]=="Y") {
     if(file_get_contents("../log.txt", $timestamp_start)){
         $element = new CIBlockElement;
         $arSelect = Array("ID");
         $arFilter = Array("IBLOCK_ID" => CATALOG_IBLOCK_ID, "ACTIVE" => "Y");
         $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 100000), $arSelect);
         while ($ob = $res->GetNextElement()) {
             $arFields = $ob->GetFields();
             if(!in_array($arFields["ID"], $updatedElements)) {
                 $element->Delete($arFields["ID"]);
                 $deleted++;
             }
         }
         echo "Удалено квартир: ".$deleted;
     }
}

?>