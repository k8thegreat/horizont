<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/*foreach($arResult["SECTIONS"] as &$arSection){
$arFilter = Array(
            "IBLOCK_ID"=>$arParams["IBLOCK_ID"],
            "ACTIVE"=>"Y",
            "IBLOCK_SECTION_ID" => $arSection["ID"],
        );
        $res = CIBlockElement::GetList(Array("PROPERTY_price_discount" => "asc"), $arFilter, false, array(),array("IBLOCK_ID", "ID",  "PROPERTY_price_discount"));
        if($ob = $res->GetNextElement())
        {
            $arProps = $ob->GetProperties();

            $arSection["MIN_PRICE"] = $arProps["price_discount"]["VALUE"];

        }
}*/
?>