<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$arResult["FORM_ACTION"] = "/novostroyki/";
$url = parse_url($arResult["FILTER_URL"]);
$arResult["FILTER_URL"] = "/novostroyki/".($url["query"] ? "?".$url["query"] : "");
$res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>FILTER_IBLOCK_ID, "ACTIVE"=>"Y"), false, Array(), Array("ID", "NAME", "XML_ID", "CODE"));
while($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    $filterItemsArr[$arFields["ID"]] = $arFields;
}
foreach ($arResult["ITEMS"][68]["VALUES"] as $i => $item) {
    if(substr($filterItemsArr[$i]["XML_ID"], 0, 8) == "district"){
        $arResult["ITEMS"][68]["CATEGORY"]["DISTRICT"][] = $item;
    }elseif (substr($filterItemsArr[$i]["XML_ID"], 0, 17) == "sub-locality-name"){
        $arResult["ITEMS"][68]["CATEGORY"]["SUB_LOCALITY_NAME"][] = $item;
    }elseif (substr($filterItemsArr[$i]["XML_ID"], 0, 8) == "metro_id"){
        $arResult["ITEMS"][68]["CATEGORY"]["METRO_ID"][] = $item;
    }elseif (substr($filterItemsArr[$i]["XML_ID"], 0, 13) == "locality-name"){
        $arResult["ITEMS"][68]["CATEGORY"]["LOCALITY_NAME"][] = $item;
    }elseif (substr($filterItemsArr[$i]["XML_ID"], 0, 3) == "zhk"){
        $arResult["ITEMS"][68]["CATEGORY"]["ZHK"][] = $item;
    }elseif (substr($filterItemsArr[$i]["XML_ID"], 0, 9) == "developer"){
        $arResult["ITEMS"][68]["CATEGORY"]["DEVELOPER"][] = $item;
    }
}
//print_r($arResult["ITEMS"][68]["VALUES"]);