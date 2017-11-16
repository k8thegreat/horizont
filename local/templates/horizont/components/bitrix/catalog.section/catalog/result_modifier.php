<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */


$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();
$minPrice = 0;
foreach ($arResult["ITEMS"] as $arItem){
    if($arItem["PROPERTIES"]["price_discount"]["VALUE"] < $minPrice || $minPrice == 0)
        $minPrice = $arItem["PROPERTIES"]["price_discount"]["VALUE"];
    if($arItem["PROPERTIES"]["price_base"]["VALUE"] < $minPrice || $minPrice == 0)
        $minPrice = $arItem["PROPERTIES"]["price_base"]["VALUE"];
    $readyVal = $arItem["PROPERTIES"]["ready"]["VALUE"];

    $rooms = $arItem["PROPERTIES"]["rooms"]["VALUE_XML_ID"];
    if($arItem["PROPERTIES"]["ready"]["VALUE"]){
        $arResultTmp[$readyVal]["GROUPS"][$rooms]["ITEMS"][] = $arItem;
        if($arItem["PROPERTIES"]["price_discount"]["VALUE"] < $arResultTmp[$readyVal]["GROUPS"][$rooms]["MIN_PRICE"] || !$arResultTmp[$readyVal]["GROUPS"][$rooms]["MIN_PRICE"])
            $arResultTmp[$readyVal]["GROUPS"][$rooms]["MIN_PRICE"] = $arItem["PROPERTIES"]["price_discount"]["VALUE"];
        if($arItem["PROPERTIES"]["price_base"]["VALUE"] < $arResultTmp[$readyVal]["GROUPS"][$rooms]["MIN_PRICE"] || !$arResultTmp[$readyVal]["GROUPS"][$rooms]["MIN_PRICE"])
            $arResultTmp[$readyVal]["GROUPS"][$rooms]["MIN_PRICE"] = $arItem["PROPERTIES"]["price_base"]["VALUE"];
    }
    if($arItem["PROPERTIES"]["area"]["VALUE"]){
        if($arItem["PROPERTIES"]["area"]["VALUE"] < $arResultTmp[$readyVal]["GROUPS"][$rooms]["MIN_SQUARE"] || !$arResultTmp[$readyVal]["GROUPS"][$rooms]["MIN_SQUARE"])
            $arResultTmp[$readyVal]["GROUPS"][$rooms]["MIN_SQUARE"] = $arItem["PROPERTIES"]["area"]["VALUE"];
    }
    if(!in_array($arItem["PROPERTIES"]["corpus_name"]["VALUE"], $arResultTmp[$readyVal]["CORPUS"])){
        $arResultTmp[$readyVal]["CORPUS"][] = $arItem["PROPERTIES"]["corpus_name"]["VALUE"];
    }

}
$arResult["RENOVATION"] = $arResult["ITEMS"][0]["PROPERTIES"]["renovation"];
$arResult["FLOORS"] = $arResult["ITEMS"][0]["PROPERTIES"]["floors_total"];
foreach ($arResultTmp as $key => &$arSection) {

    ksort($arSection["GROUPS"]);
    $arResult["READY"][] = $key;
}
sort($arResult["READY"]);

$arResult["MIN_PRICE"] = $minPrice;
$arResult["ITEMS"] = $arResultTmp;

$rsSections = CIBlockSection::GetList(array(), array("IBLOCK_ID" => $arResult["IBLOCK_ID"], "ID" => $arResult["ID"]),false, array("IBLOCK_ID","UF_*"),array());
if ($arSection2 = $rsSections->GetNext())
{
    $arResult = array_merge($arResult, $arSection2);
    if($arSection2["UF_DEVELOPER"]) {
        $res = CIBlockElement::GetByID($arSection2["UF_DEVELOPER"]);
        if ($ar_res = $res->GetNext())
            $arResult["UF_DEVELOPER"] = $ar_res;
    }
    if($arSection2["UF_LOCATION"]){
        $arResult["UF_LOCATION"] = unserialize($arSection2["~UF_LOCATION"]);
    }
    $arResult["UF_GOOD_PRICE"] = $arSection2["UF_GOOD_PRICE"];
    $arResult["UF_METRO_ID"] = $arSection2["UF_METRO_ID"];
    $arResult["UF_ADVANTAGES"] = $arSection2["UF_ADVANTAGES"];

}

