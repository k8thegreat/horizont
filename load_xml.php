<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
?>
    <h2>Загрузка каталога объектов</h2>
<form action="" method="post">

    <input type="submit" name="go" value="Запустить выгрузку"/>
    <?/*<input type="submit" name="delete" value="Удалить неактуальные записи"/>*/?>
</form>

<?

if($_POST["go"]) {
    set_time_limit(0);

  //ini_set('memory_limit', '6000M');
    global $timestamp_start, $arDevelopers, $arBanks, $arBuildings, $propRoomsArr, $propMetroArr, $propPaymentArr, $propSectionPaymentArr, $propStateArr, $propReadyArr, $limit;

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
        $arSelect = Array("ID", "NAME", "XML_ID");
        $arFilter = Array('IBLOCK_ID' => CATALOG_IBLOCK_ID, 'GLOBAL_ACTIVE' => 'Y', "DEPTH_LEVEL" => "1");
        $res = CIBlockSection::GetList(Array(), $arFilter, true, $arSelect);
        while ($ob = $res->GetNext()) {
            $arBuildings[$ob["XML_ID"]] = $ob;
        }

        $property_enums = CIBlockPropertyEnum::GetList(Array("SORT" => "ASC"), Array("IBLOCK_ID" => CATALOG_IBLOCK_ID, "CODE" => "rooms"));
        while ($enum_fields = $property_enums->GetNext()) {
            $propRoomsArr[$enum_fields["XML_ID"]] = $enum_fields;
        }

        $property_enums = CIBlockPropertyEnum::GetList(Array("SORT" => "ASC"), Array("IBLOCK_ID" => CATALOG_IBLOCK_ID, "CODE" => "metro_id"));
        while ($enum_fields = $property_enums->GetNext()) {
            $propMetroArr[$enum_fields["XML_ID"]] = $enum_fields;
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

        $reader = new fileXMLReader('topnlab.ru_test.xml');
//$reader = new fileXMLReader('test.xml');

        $reader->onEvent('afterParseElement', function ($name, $context) {
            $context->clearResult();
        });


        $reader->onEvent('afterParse', function ($name, $context) {
            global $timestamp_start;
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
            }
        });



        $reader->onEvent('parseoffer', function ($context) {
            global $arDevelopers, $arBanks, $arBuildings, $USER, $propRoomsArr, $propMetroArr, $propPaymentArr, $propReadyArr, $propStateArr, $propSectionPaymentArr;
            $item = xml2array($context->getResult());

            if ($item["id"] && is_array($item["properties"])) {
                //if($arBuildings[$item["properties"]["zhk-id"]])
                $arSelect = Array("ID", "NAME", "XML_ID", "PROPERTY_crc");
                $arFilter = Array("IBLOCK_ID" => CATALOG_IBLOCK_ID, "XML_ID" => $item["id"], "ACTIVE" => "Y");
                $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
                if ($ob = $res->GetNextElement()){
                    $arFields = $ob->GetFields();
                    $propCRC = $arFields["PROPERTY_CRC_VALUE"];
                    $crc = md5(json_encode($item["properties"]));
                    $el = new CIBlockElement;
                    //if($propCRC == $crc){
                    if($item["properties"]["banks"]){
                        if ($item["properties"]["banks"]["bank"]) {
                            $arSectionBanks = array();
                            foreach ($item["properties"]["banks"]["bank"] as $bank) {
                                if ($arBanks[$bank]) {
                                    $arSectionBanks[] = $arBanks[$bank]["ID"];
                                }
                            }
                            $arSectionFields["UF_BANKS"] = $arSectionBanks;
                            $sectionID = $arBuildings[$item["properties"]["zhk-id"]]["ID"];
                            if($arSectionFields) {
                                $bs = new CIBlockSection;
                                $bs->Update($sectionID, $arSectionFields);

                            }
                        }

                        //$res = $el->Update($arFields["ID"], array());
                    }else {
                        $rooms = ($item["properties"]["studio"] ? "studio" : $item["properties"]["rooms"]);
                        $arItemPropsArray = array(
                            "region" => $item["properties"]["location"]["region"],
                            "locality_name" => $item["properties"]["location"]["locality-name"],
                            "district" => $item["properties"]["location"]["district"],
                            "sub_locality_name" => $item["properties"]["location"]["sub-locality-name"],
                            "metro_id" => $propMetroArr[$item["properties"]["metro-id"]]["ID"],
                            "flat_number" => $item["properties"]["flat-number"],
                            "corpus_name" => $item["properties"]["corpus-name"],
                            "corpus_id" => $item["properties"]["corpus-id"],
                            "levels" => $item["properties"]["levels"],
                            "price_base" => $item["properties"]["price-base"]["value"],
                            "area" => $item["properties"]["area"]["value"],
                            "living_space" => $item["properties"]["living-space"]["value"],
                            "kitchen_space" => $item["properties"]["kitchen-space"]["value"],
                            "bathroom_unit" => $item["properties"]["bathroom-unit"],
                            "floor" => $item["properties"]["floor"],
                            "floors_total" => $item["properties"]["floors-total"],
                            "rooms" => $propRoomsArr[$rooms]["ID"],
                            "building_section" => $item["properties"]["building-section"],
                            "renovation" => $item["properties"]["renovation"],
                            "ceiling_height" => $item["properties"]["ceiling-height"],
                            "balcony_space" => $item["properties"]["balcony-space"]["value"],
                            "price_discount" => $item["properties"]["price-discount"]["value"],
                            "developer" => $item["properties"]["developer-name"],
                            "zhk" => $item["properties"]["zhk-name"],
                            "ready" => floatval($item["properties"]["built-year"] . "." . $item["properties"]["ready-quarter"]),
                            "building_state" => $propStateArr[$item["properties"]["building-state"]],
                            "crc" => $crc
                        );
                        if ($item["properties"]["maternal-capital"]) $arItemPropsArray["payment"][] = $propPaymentArr["maternal-capital"]["ID"];
                        elseif ($item["properties"]["military-mortgage"]) $arItemPropsArray["payment"][] = $propPaymentArr["military-mortgage"]["ID"];
                        elseif ($item["properties"]["developers-subsidies"]) $arItemPropsArray["payment"][] = $propPaymentArr["developers-subsidies"]["ID"];

                        $arLoadItemArray = Array(
                            "NAME" => "Квартира " . $item["properties"]["flat-number"],
                            "PROPERTY_VALUES" => $arItemPropsArray
                        );
                        if ($item["properties"]["image"][0])
                            $arLoadItemArray["PREVIEW_PICTURE"] = CFile::MakeFileArray($item["properties"]["image"][0]);
                        $res = $el->Update($arFields["ID"], $arLoadItemArray);



                        /*
                        if($item["properties"]["location"]["metro"]["time-on-transport"]){
                            echo $item["properties"]["zhk-name"];
                            $arFields = Array(
                                "UF_TIME_ON_TRANSPORT" => $item["properties"]["location"]["metro"]["time-on-transport"]
                            );

                        }
                        $sectionID = $arBuildings[$item["properties"]["zhk-id"]]["ID"];
                        if($item["properties"]["building-type"]){

                            $arFields = Array(
                                "UF_BUILDING_TYPE" => $item["properties"]["building-type"]
                            );
                        }
                        if($arFields) {
                            $bs = new CIBlockSection;
                            $bs->Update($sectionID, $arFields);

                        }
                        /*$arFields = $ob->GetFields();
                        if ($item["properties"]["maternal-capital"]) $arItemPropsArray["payment"][] = $propPaymentArr["maternal-capital"]["ID"];
                        elseif ($item["properties"]["military-mortgage"]) $arItemPropsArray["payment"][] = $propPaymentArr["military-mortgage"]["ID"];
                        elseif ($item["properties"]["developers-subsidies"]) $arItemPropsArray["payment"][] = $propPaymentArr["developers-subsidies"]["ID"];
                        else $payment_type = "";
                        if($arItemPropsArray) {
                            echo $arFields["ID"];
                        }*/
                    }
                    unset($el);
                } else {

                    $el = new CIBlockElement;
                    $rooms = ($item["properties"]["studio"] ? "studio" : $item["properties"]["rooms"]);

                    $crc = md5(json_encode($item["properties"]));


                    $arItemPropsArray = array(
                        "region" => $item["properties"]["location"]["region"],
                        "locality_name" => $item["properties"]["location"]["locality-name"],
                        "district" => $item["properties"]["location"]["district"],
                        "sub_locality_name" => $item["properties"]["location"]["sub-locality-name"],
                        "metro_id" => $propMetroArr[$item["properties"]["metro-id"]]["ID"],
                        "flat_number" => $item["properties"]["flat-number"],
                        "corpus_name" => $item["properties"]["corpus-name"],
                        "corpus_id" => $item["properties"]["corpus-id"],
                        "levels" => $item["properties"]["levels"],
                        "price_base" => $item["properties"]["price-base"]["value"],
                        "area" => $item["properties"]["area"]["value"],
                        "living_space" => $item["properties"]["living-space"]["value"],
                        "kitchen_space" => $item["properties"]["kitchen-space"]["value"],
                        "bathroom_unit" => $item["properties"]["bathroom-unit"],
                        "floor" => $item["properties"]["floor"],
                        "floors_total" => $item["properties"]["floors-total"],
                        "rooms" => $propRoomsArr[$rooms]["ID"],
                        "building_section" => $item["properties"]["building-section"],
                        "renovation" => $item["properties"]["renovation"],
                        "ceiling_height" => $item["properties"]["ceiling-height"],
                        "balcony_space" => $item["properties"]["balcony-space"]["value"],
                        "price_discount" => $item["properties"]["price-discount"]["value"],
                        "developer" => $item["properties"]["developer-name"],
                        "zhk" => $item["properties"]["zhk-name"],
                        "ready" => floatval($item["properties"]["built-year"].".".$item["properties"]["ready-quarter"]),
                        "building_state" => $propStateArr[$item["properties"]["building-state"]],
                        "crc" => $crc
                    );
                    if ($item["properties"]["maternal-capital"]) $arItemPropsArray["payment"][] = $propPaymentArr["maternal-capital"]["ID"];
                    elseif ($item["properties"]["military-mortgage"]) $arItemPropsArray["payment"][] = $propPaymentArr["military-mortgage"]["ID"];
                    elseif ($item["properties"]["developers-subsidies"]) $arItemPropsArray["payment"][] = $propPaymentArr["developers-subsidies"]["ID"];

                    if (!$arBuildings[$item["properties"]["zhk-id"]]) {
                        $bs = new CIBlockSection;
                        $arSectionFields = Array(
                            "ACTIVE" => "Y",
                            "IBLOCK_SECTION_ID" => "",
                            "IBLOCK_ID" => CATALOG_IBLOCK_ID,
                            "NAME" => $item["properties"]["zhk-name"],
                            "XML_ID" => $item["properties"]["zhk-id"],
                            "DESCRIPTION" => $item["properties"]["description"],
                            "DESCRIPTION_TYPE" => "TEXT",
                            "UF_METRO" => $item["properties"]["location"]["metro"]["name"],
                            "UF_BUILDING_TYPE" => $item["properties"]["building-type"],
                            "UF_SUBLOCALITY" => $item["properties"]["location"]["locality-name"],
                            "UF_DISTRICT" => $item["properties"]["location"]["district"],
                            "UF_ADDRESS" => $item["properties"]["location"]["address"],
                            "UF_LOCATION" => serialize(array("lat" => $item["properties"]["Latitude"], "long" => $item["properties"]["Longitude"]))

                        );
                        if ($item["properties"]["main-image"]) {
                            $arSectionFields["PICTURE"] = CFile::MakeFileArray($item["properties"]["main-image"]);
                        }

                        if (is_array($item["properties"]["image"])) {
                            $arApartImages = array();
                            foreach ($item["properties"]["image"] as $i => $pict) {
                                if ($i == 0) continue;
                                $arApartImages["n" . $i] = CFile::MakeFileArray($pict);

                            }
                            $arSectionFields["UF_APARTMENTS"] = $arApartImages;
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
                        if ($sectionID = $bs->Add($arSectionFields)) {
                            $arBuildings[$item["properties"]["zhk-id"]] = array(
                                "NAME" => $item["properties"]["zhk-name"],
                                "ID" => $sectionID
                            );
                        }
                    } else {
                        $sectionID = $arBuildings[$item["properties"]["zhk-id"]]["ID"];
                        if ($item["properties"]["location"]["metro"]["time-on-foot"]) {
                            echo $item["properties"]["zhk-name"];
                            $arFields = Array(
                                "UF_TIME_ON_FOOT" => $item["properties"]["location"]["metro"]["time-on-foot"]
                            );
                        }
                        if ($item["properties"]["location"]["metro"]["time-on-transport"]) {
                            echo $item["properties"]["zhk-name"];
                            $arFields = Array(
                                "UF_TIME_ON_TRANSPORT" => $item["properties"]["location"]["metro"]["time-on-transport"]
                            );

                        }
                        if ($arFields) {
                            $bs = new CIBlockSection;
                            $bs->Update($sectionID, $arFields);
                            echo $item["properties"]["zhk-name"];
                        }

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

                    if ($item["properties"]["image"][0])
                        $arLoadItemArray["PREVIEW_PICTURE"] = CFile::MakeFileArray($item["properties"]["image"][0]);
                    if ($itemID = $el->Add($arLoadItemArray)) {
                        // echo "New ID: ".$itemID;

                    } else
                        echo "Error: " . $el->LAST_ERROR;

                    unset($el);
                }
            }
        });

        $reader->parse();

    }
}
if($_POST["delete"]) {
     if(file_get_contents("log.txt", $timestamp_start)){
         if (CModule::IncludeModule("iblock")) {
             $element = new CIBlockElement;
             $rsElements = CIBlockElement::GetList(array(), array(
                 "IBLOCK_ID" => CATALOG_IBLOCK_ID,
                 "ACTIVE" => "Y",
                 "<TIMESTAMP_X" => $timestamp_start
             ), false, false, array("ID"));
             while ($arElement = $rsElements->Fetch()) {
                 $element->Delete($arElement["ID"]);
                 $deleted++;
             }
             echo $deleted;
         }
     }
}
?>