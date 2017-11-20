<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $templateData */
/** @var @global CMain $APPLICATION */

use Bitrix\Iblock\InheritedProperty;
global $SELECTED_FILTER_ITEM;
    foreach ($arResult["ITEMS"][68]["VALUES"] as $i => $val){
        if($val["CHECKED"])
        {
            $cheackedArr[] = $val;
            $ELEMENT_ID = $i;
        }

    }
if(count($cheackedArr==1)){
    $SELECTED_FILTER_ITEM = $ELEMENT_ID;
    /*$ipropValues = new InheritedProperty\ElementValues(FILTER_IBLOCK_ID, $ELEMENT_ID);
    $arResult["IPROPERTY_VALUES"] = $ipropValues->getValues();
    $arResult["META_TAGS"]["TITLE"] = (
    $arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"] != ""
        ? $arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"]
        : $arResult["NAME"]
    );
    $browserTitle = $arResult["IPROPERTY_VALUES"]["ELEMENT_META_TITLE"];
    $arResult["META_TAGS"]["BROWSER_TITLE"] = $browserTitle;

    $metaKeywords = $arResult["IPROPERTY_VALUES"]["ELEMENT_META_KEYWORDS"];
    $arResult["META_TAGS"]["KEYWORDS"] = $metaKeywords;
    $metaDescription = $arResult["IPROPERTY_VALUES"]["ELEMENT_META_DESCRIPTION"];
    $arResult["META_TAGS"]["DESCRIPTION"] = $metaDescription;
    $APPLICATION->SetPageProperty("subtitle",$arResult["META_TAGS"]["TITLE"]);

    if ($arResult["META_TAGS"]["BROWSER_TITLE"] !== '')
        $APPLICATION->SetPageProperty("title", $arResult["META_TAGS"]["BROWSER_TITLE"]);

    if ($arResult["META_TAGS"]["KEYWORDS"] !== '')
        $APPLICATION->SetPageProperty("keywords", $arResult["META_TAGS"]["KEYWORDS"]);

    if ($arResult["META_TAGS"]["DESCRIPTION"] !== '')
        $APPLICATION->SetPageProperty("description", $arResult["META_TAGS"]["DESCRIPTION"]);
*/
}
?>