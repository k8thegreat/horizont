<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
?>
    <h2>Загрузка каталога объектов для переуступок</h2>
<form name="go" action="" method="post">

    <input type="submit" name="go" value="Запустить выгрузку"/> 
</form>

<?
if($_POST["go"]) {
    set_time_limit(0);
//ini_set('memory_limit', '6000M');

    if (CModule::IncludeModule("iblock")) {

        global $propRoomsArr;
        $property_enums = CIBlockPropertyEnum::GetList(Array("SORT" => "ASC"), Array("IBLOCK_ID" => TRADE_IBLOCK_ID, "CODE" => "rooms"));
        while ($enum_fields = $property_enums->GetNext()) {
            $propRoomsArr[$enum_fields["XML_ID"]] = $enum_fields;
        }

        $reader = new fileXMLReader('result.xml');
        $reader->onEvent('afterParseElement', function ($name, $context) {
            $context->clearResult();
        });

        $reader->onEvent('parseobject', function ($context) {
            global $USER, $propRoomsArr;

            $item = xml2array($context->getResult());

            if ($item["id"] && is_array($item["properties"])) {
                //if($arBuildings[$item["properties"]["zhk-id"]])
                $arSelect = Array("ID", "NAME", "XML_ID");
                $arFilter = Array("IBLOCK_ID" => TRADE_IBLOCK_ID, "XML_ID" => $item["id"], "ACTIVE" => "Y");
                $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
                if ($ob = $res->GetNextElement()) {


                } else {
                    $el = new CIBlockElement;
                    $arItemPropsArray = array(
                        "rayon" => $item["properties"]["data-rayon"],
                        "gk" => $item["properties"]["gk"],
                        "builder" => $item["properties"]["builder"],
                        "corpus" => $item["properties"]["corpus"],
                        "deadline" => $item["properties"]["deadline"],
                        "rooms" => $propRoomsArr[trim($item["properties"]["rooms"])]["ID"],
                        "sGeneral" => $item["properties"]["sGeneral"],
                        "floor" => $item["properties"]["floor"],
                        "price" => IntVal(str_replace(" ", "", $item["properties"]["price"])),
                        "otdelka" => $item["properties"]["otdelka"],
                        "metro" => $item["properties"]["metro"]
                    );

                    $arLoadItemArray = Array(
                        "MODIFIED_BY" => $USER->GetID(),
                        "IBLOCK_SECTION_ID" => false,
                        "IBLOCK_ID" => TRADE_IBLOCK_ID,
                        "PROPERTY_VALUES" => $arItemPropsArray,
                        "NAME" => $item["id"],
                        "ACTIVE" => "Y",
                        "XML_ID" => $item["id"]
                    );

                    if ($item["properties"]["photoplan"])
                        $arLoadItemArray["PREVIEW_PICTURE"] = CFile::MakeFileArray($item["properties"]["photoplan"]);
                    if ($itemID = $el->Add($arLoadItemArray)) {
                         //echo "New ID: ".$itemID;

                    } else
                        echo "Error: " . $el->LAST_ERROR;
                }
            }
        });

        $reader->parse();
        echo $reader->counter_offer;
    }
}
?>