<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();



$arDefaultParams = array(
	'VIEW_MODE' => 'LIST',
	'SHOW_PARENT_NAME' => 'Y',
	'HIDE_SECTION_NAME' => 'N'
);

$arParams = array_merge($arDefaultParams, $arParams);

if (!in_array($arParams['VIEW_MODE'], $arViewModeList))
	$arParams['VIEW_MODE'] = 'LIST';
if ('N' != $arParams['SHOW_PARENT_NAME'])
	$arParams['SHOW_PARENT_NAME'] = 'Y';
if ('Y' != $arParams['HIDE_SECTION_NAME'])
	$arParams['HIDE_SECTION_NAME'] = 'N';

$arResult['VIEW_MODE_LIST'] = $arViewModeList;

$property_enums = CIBlockPropertyEnum::GetList(Array(), Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "CODE"=>"rooms"));
while($enum_fields = $property_enums->GetNext())
{
    $roomsArr[$enum_fields["XML_ID"]] = $enum_fields;

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


}

?>