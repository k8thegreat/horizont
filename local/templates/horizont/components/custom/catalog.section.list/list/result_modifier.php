<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();



$property_enums = CIBlockPropertyEnum::GetList(Array(), Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "CODE"=>"rooms"));
while($enum_fields = $property_enums->GetNext())
{
    $roomsArr[$enum_fields["XML_ID"]] = $enum_fields;

}
$property_enums = CUserFieldEnum::GetList(array(), array("USER_FIELD_NAME" => "UF_PAYMENT"));
while ($enum_fields = $property_enums->GetNext()) {
    $propSectionPaymentArr[$enum_fields["ID"]] = $enum_fields;
}
foreach ($arResult['SECTIONS'] as &$arSection){
    foreach ($roomsArr as $key => $roomsVal){
        $arFilter = Array(
            "IBLOCK_ID"=>$arParams["IBLOCK_ID"],
            "ACTIVE"=>"Y",
            "IBLOCK_SECTION_ID" => $arSection["ID"],
            "PROPERTY_rooms" => $roomsVal["ID"]
        );
        $res = CIBlockElement::GetList(Array("PROPERTY_price_discount" => "asc"), $arFilter, false, array(),array("IBLOCK_ID", "ID",  "PROPERTY_price_discount"));
        if($ob = $res->GetNextElement())
        {
            $arProps = $ob->GetProperties();

            $arSection["ITEMS_PRICE"][$key] = $arProps["price_discount"]["VALUE"];

        }
    }
    ksort($arSection["ITEMS_PRICE"]);
    $rsSections = CIBlockSection::GetList(array(), array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ID" => $arSection["ID"]),false, array("IBLOCK_ID","UF_*"),array());
    if ($arSection2 = $rsSections->GetNext())
    {
        if($arSection2["UF_DEVELOPER"]) {
            $res = CIBlockElement::GetByID($arSection2["UF_DEVELOPER"]);
            if ($ar_res = $res->GetNext())
                $arSection["UF_DEVELOPER"] = $ar_res;
        }

        if($arSection2["UF_LOCATION"]){
            $arSection["UF_LOCATION"] = unserialize($arSection2["~UF_LOCATION"]);
        }
        $arSection["UF_SUBLOCALITY"] = $arSection2["UF_SUBLOCALITY"];
        $arSection["UF_ADDRESS"] = $arSection2["UF_ADDRESS"];
        $arSection["UF_METRO"] = $arSection2["UF_METRO"];
        $arSection["UF_TIME_ON_FOOT"] = $arSection2["UF_TIME_ON_FOOT"];
        $arSection["UF_TIME_ON_TRANSPORT"] = $arSection2["UF_TIME_ON_TRANSPORT"];
        if($arSection2["UF_PAYMENT"]){
            $arSection2["UF_PAYMENT"] = unserialize($arSection2["UF_PAYMENT"]);
            foreach ($arSection2["UF_PAYMENT"] as $item){
                $arSection["UF_PAYMENT"][] = $propSectionPaymentArr[$item]["VALUE"];
            }

        }
    }
    $arFilter = Array(
        "IBLOCK_ID"=>$arParams["IBLOCK_ID"],
        "ACTIVE"=>"Y",
        "IBLOCK_SECTION_ID" => $arSection["ID"]
    );
    $res = CIBlockElement::GetList(Array("PROPERTY_renovation" => "asc"), $arFilter, array("PROPERTY_renovation"), array(), array("IBLOCK_ID", "ID",  "PROPERTY_renovation"));
    while($ob = $res->GetNext())
    {
        $arSection["UF_RENOVATION"][] = $ob["PROPERTY_RENOVATION_VALUE"];

    }
    $arFilter = Array(
        "IBLOCK_ID"=>$arParams["IBLOCK_ID"],
        "ACTIVE"=>"Y",
        "IBLOCK_SECTION_ID" => $arSection["ID"]
    );
    $res = CIBlockElement::GetList(Array("PROPERTY_ready" => "asc"), $arFilter, array("PROPERTY_ready"), array(), array("IBLOCK_ID", "ID",  "PROPERTY_ready"));
    while($ob = $res->GetNext())
    {
        $arSection["UF_READY"][] = str_replace("квартал", "кв.", $ob["PROPERTY_READY_VALUE"]);

    }
    $arFilter = Array(
        "IBLOCK_ID"=>$arParams["IBLOCK_ID"],
        "ACTIVE"=>"Y",
        "IBLOCK_SECTION_ID" => $arSection["ID"]
    );
    $res = CIBlockElement::GetList(Array(), $arFilter, false, array(), array("IBLOCK_ID", "ID",  "PROPERTY_metro_id"));
    if($ob = $res->GetNextElement())
    {
        $arProps = $ob->GetProperties();
        $arSection["METRO"] = $arProps["metro_id"]["VALUE_XML_ID"];
    }
    usort($arSection["UF_READY"], "cmp");
}

?>