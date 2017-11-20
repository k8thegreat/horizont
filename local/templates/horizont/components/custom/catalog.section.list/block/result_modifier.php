<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();



$arDefaultParams = array(
	'VIEW_MODE' => 'LIST',
	'SHOW_PARENT_NAME' => 'Y',
	'HIDE_SECTION_NAME' => 'N'
);


$arSelect = Array("ID", "NAME", "XML_ID", "SORT", "CODE");
$arFilter = Array("IBLOCK_ID" => FILTER_IBLOCK_ID, "ACTIVE" => "Y", "SECTION_CODE" => "flat");
$res = CIBlockElement::GetList(Array("SORT" => "ASC"), $arFilter, false, Array(), $arSelect);
$i = 0;
while($ob = $res->GetNext()){
    $ob["INDEX"] = $i;
    $roomsArr[$ob["ID"]] = $ob;
    $i++;
}
$property_enums = CUserFieldEnum::GetList(array(), array("USER_FIELD_NAME" => "UF_PAYMENT"));
while ($enum_fields = $property_enums->GetNext()) {
    $propSectionPaymentArr[$enum_fields["ID"]] = $enum_fields;
}
foreach ($arResult['SECTIONS'] as &$arSection){
    foreach ($roomsArr as $key => $roomsVal){
        $priceMinDiscount = $priceMinBase = 0;
        $arFilter = Array(
            "IBLOCK_ID"=>$arParams["IBLOCK_ID"],
            "ACTIVE"=>"Y",
            "IBLOCK_SECTION_ID" => $arSection["ID"],
            "PROPERTY_rooms" => $roomsVal["ID"],
            ">PROPERTY_price_base" => 0
        );
        $res = CIBlockElement::GetList(Array("PROPERTY_price_base" => "asc"), $arFilter, false, array(),array("IBLOCK_ID", "ID",  "PROPERTY_price_discount", "PROPERTY_price_base"));
        if($ob = $res->GetNextElement())
        {

            $arProps = $ob->GetProperties();
            $priceMinBase = IntVal($arProps["price_base"]["VALUE"])."<br/>";
        }
        $arFilter = Array(
            "IBLOCK_ID"=>$arParams["IBLOCK_ID"],
            "ACTIVE"=>"Y",
            "IBLOCK_SECTION_ID" => $arSection["ID"],
            "PROPERTY_rooms" => $roomsVal["ID"],
            ">PROPERTY_price_discount" => 0
        );
        $res = CIBlockElement::GetList(Array("PROPERTY_price_discount" => "asc"), $arFilter, false, array(),array("IBLOCK_ID", "ID",  "PROPERTY_price_discount", "PROPERTY_price_base"));
        if($ob = $res->GetNextElement())
        {
            $arProps = $ob->GetProperties();
            $priceMinDiscount = IntVal($arProps["price_discount"]["VALUE"])."<br/>";
        }
        if($priceMinDiscount || $priceMinBase)
            $arSection["ITEMS_PRICE"][$roomsVal["INDEX"]] = (($priceMinDiscount > 0 && $priceMinDiscount < $priceMinBase) ? $priceMinDiscount : $priceMinBase);
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
        $arSection["UF_METRO_ID"] = $arSection2["UF_METRO_ID"];
        $arSection["UF_GOOD_PRICE"] = $arSection2["UF_GOOD_PRICE"];
        $arSection["UF_LOCALITY_NAME"] = $arSection2["UF_LOCALITY_NAME"];
        $arSection["UF_ADDRESS"] = $arSection2["UF_ADDRESS"];
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
        $arSection["UF_READY"][] = $ob["PROPERTY_READY_VALUE"];

    }
    $arFilter = Array(
        "IBLOCK_ID"=>$arParams["IBLOCK_ID"],
        "ACTIVE"=>"Y",
        "IBLOCK_SECTION_ID" => $arSection["ID"]
    );
    asort($arSection["UF_READY"]);


}

?>