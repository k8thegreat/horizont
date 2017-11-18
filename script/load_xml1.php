<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

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
    global $updated, $timestamp_start, $arDevelopers, $arBanks, $arBuildings, $propRoomsArr, $propMetroArr, $propPaymentArr, $propSectionPaymentArr, $propStateArr, $propReadyArr, $limit;

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
        $arSelect = Array("ID", "NAME", "XML_ID");
        $arFilter = Array("IBLOCK_ID"=>METRO_IBLOCK_ID, "ACTIVE"=>"Y");
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>100), $arSelect);
        while($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $propMetroArr[$arFields["XML_ID"]] = $arFields;
        }
        $property_enums = CIBlockPropertyEnum::GetList(Array("SORT" => "ASC"), Array("IBLOCK_ID" => CATALOG_IBLOCK_ID, "CODE" => "rooms"));
        while ($enum_fields = $property_enums->GetNext()) {
            $propRoomsArr[$enum_fields["XML_ID"]] = $enum_fields;
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
        $property_enums = CIBlockPropertyEnum::GetList(Array("ID" => "ASC"), Array("IBLOCK_ID" => CATALOG_IBLOCK_ID, "CODE" => "filter"));
        while ($enum_fields = $property_enums->GetNext()) {
            $propFilterArr[$enum_fields["XML_ID"]] = $enum_fields;
        }

        $reader = new fileXMLReader('../xml/'.$_POST["file"]);

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
            global $updated, $arDevelopers, $propFilterArr, $arBanks, $arBuildings, $USER, $propRoomsArr, $propMetroArr, $propPaymentArr, $propReadyArr, $propStateArr, $propSectionPaymentArr, $arTransalteParams;
            $item = xml2array($context->getResult());

            if ($item["id"] && is_array($item["properties"])) {
                //if($arBuildings[$item["properties"]["zhk-id"]])
                $arSelect = Array("ID", "NAME", "XML_ID", "PROPERTY_crc", "IBLOCK_SECTION_ID", "PREVIEW_PICTURE");
                $arFilter = Array("IBLOCK_ID" => CATALOG_IBLOCK_ID, "XML_ID" => $item["id"], "ACTIVE" => "Y");
                $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
                if ($ob = $res->GetNextElement()){
                    $arFields = $ob->GetFields();
                    $rooms = ($item["properties"]["studio"] ? "studio" : $item["properties"]["rooms"]);
                    if($rooms){
                        $code = "flat_".$rooms;
                        if($propFilterArr[$code]) {
                            $arItemPropsArray["rooms2"] = $propFilterArr[$code]["ID"];
                        }
                        echo $rooms;

                    }
                    //CIBlockElement::SetPropertyValuesEx($arFields["ID"], false, $arItemPropsArray);
                }
            }
        });

        $reader->parse();

    }
}
if($_POST["delete"]=="Y") {
    if(file_get_contents("../log.txt", $timestamp_start)){
        echo $timestamp_start;
        print_r($updated);
        if (CModule::IncludeModule("iblock")) {
            /*$element = new CIBlockElement;
            $rsElements = CIBlockElement::GetList(array(), array(
                "IBLOCK_ID" => CATALOG_IBLOCK_ID,
                "ACTIVE" => "Y",
                "<TIMESTAMP_X" => $timestamp_start
            ), false, false, array("ID"));
            while ($arElement = $rsElements->Fetch()) {
                $element->Delete($arElement["ID"]);
                $deleted++;
            }
            echo "Удалено объектов: ".$deleted;*/
        }
    }
}
?>