<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */


$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();
$minPrice = 0;
$arResult["COUNT"] = count($arResult["ITEMS"]);
foreach ($arResult["ITEMS"] as $arItem){
    if($arItem["PROPERTIES"]["price_discount"]["VALUE"] < $minPrice || $minPrice == 0)
        $minPrice = $arItem["PROPERTIES"]["price_discount"]["VALUE"];
    $readyVal = $arItem["PROPERTIES"]["ready"]["VALUE"];

    $rooms = $arItem["PROPERTIES"]["rooms"]["VALUE_XML_ID"];
    if($arItem["PROPERTIES"]["ready"]["VALUE"]){
        $arResultTmp[$readyVal]["GROUPS"][$rooms]["ITEMS"][] = $arItem;
        if($arItem["PROPERTIES"]["price_discount"]["VALUE"] < $arResultTmp[$readyVal]["GROUPS"][$rooms]["MIN_PRICE"] || !$arResultTmp[$readyVal]["GROUPS"][$rooms]["MIN_PRICE"])
            $arResultTmp[$readyVal]["GROUPS"][$rooms]["MIN_PRICE"] = $arItem["PROPERTIES"]["price_discount"]["VALUE"];
    }
    if($arItem["PROPERTIES"]["area"]["VALUE"]){
        if($arItem["PROPERTIES"]["area"]["VALUE"] < $arResultTmp[$readyVal]["GROUPS"][$rooms]["MIN_SQUARE"] || !$arResultTmp[$readyVal]["GROUPS"][$rooms]["MIN_SQUARE"])
            $arResultTmp[$readyVal]["GROUPS"][$rooms]["MIN_SQUARE"] = $arItem["PROPERTIES"]["area"]["VALUE"];
    }
    if(!in_array($arItem["PROPERTIES"]["corpus_name"]["VALUE"], $arResultTmp[$readyVal]["CORPUS"])){
        $arResultTmp[$readyVal]["CORPUS"][] = $arItem["PROPERTIES"]["corpus_name"]["VALUE"];
    }

}
$arResult["METRO"] = $arResult["ITEMS"][0]["PROPERTIES"]["metro_id"];
foreach ($arResultTmp as $key => &$arSection) {

    ksort($arSection["GROUPS"]);
    $arResult["READY"][] = $key;
}

$arResult["MIN_PRICE"] = $minPrice;
$arResult["ITEMS"] = $arResultTmp;

$rsSections = CIBlockSection::GetList(array(), array("IBLOCK_ID" => $arResult["IBLOCK_ID"], "ID" => $arResult["ID"]),false, array("IBLOCK_ID","UF_*"),array());
if ($arSection2 = $rsSections->GetNext())
{
    $arResult = array_merge($arResult, $arSection2);
    if($arSection2["UF_MORE_PHOTO"]){
        $arResult["UF_MORE_PHOTO"] = unserialize($arSection2["UF_MORE_PHOTO"]);
    }
    if($arSection2["UF_DEVELOPER"]) {
        $res = CIBlockElement::GetByID($arSection2["UF_DEVELOPER"]);
        if ($ar_res = $res->GetNext())
            $arResult["UF_DEVELOPER"] = $ar_res;
    }
    if($arSection2["UF_LOCATION"]){
        $arResult["UF_LOCATION"] = unserialize($arSection2["~UF_LOCATION"]);
    }
    if($arSection2["UF_BANKS"]){
        $arResult["UF_BANKS"] = unserialize($arSection2["~UF_BANKS"]);
    }
    if($arSection2["UF_APARTMENTS"]){
        $arResult["UF_APARTMENTS"] = unserialize($arSection2["UF_APARTMENTS"]);
    }
}
