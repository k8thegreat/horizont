<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$arResult["FORM_ACTION"] = "/novostroyki/";

foreach ($arResult["ITEMS"][68]["VALUES"] as $item) {
    if(substr($item["URL_ID"], 0, 8) == "district"){
        $arResult["ITEMS"][68]["CATEGORY"]["DISTRICT"][] = $item;
    }elseif (substr($item["URL_ID"], 0, 17) == "sub-locality-name"){
        $arResult["ITEMS"][68]["CATEGORY"]["SUB_LOCALITY_NAME"][] = $item;
    }elseif (substr($item["URL_ID"], 0, 8) == "metro_id"){
        $arResult["ITEMS"][68]["CATEGORY"]["METRO_ID"][] = $item;
    }elseif (substr($item["URL_ID"], 0, 13) == "locality-name"){
        $arResult["ITEMS"][68]["CATEGORY"]["LOCALITY_NAME"][] = $item;
    }elseif (substr($item["URL_ID"], 0, 3) == "zhk"){
        $arResult["ITEMS"][68]["CATEGORY"]["ZHK"][] = $item;
    }elseif (substr($item["URL_ID"], 0, 9) == "developer"){
        $arResult["ITEMS"][68]["CATEGORY"]["DEVELOPER"][] = $item;
    }
}
//print_r($arResult["ITEMS"][68]["VALUES"]);