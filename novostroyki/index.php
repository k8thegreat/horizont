<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новостройки");
$items = array();
//error_reporting(E_ALL);
global $propFilterArrByID;
function fillItemValues(&$resultItem, $arProperty, $flag = null)
{
    $cache = array();
    if(is_array($arProperty))
    {
        if(isset($arProperty["PRICE"]))
        {
            return null;
        }
        $key = $arProperty["VALUE"];
        $PROPERTY_TYPE = $arProperty["PROPERTY_TYPE"];
        $PROPERTY_USER_TYPE = $arProperty["USER_TYPE"];
        $PROPERTY_ID = $arProperty["ID"];
    }
    else
    {
        $key = $arProperty;
        $PROPERTY_TYPE = $resultItem["PROPERTY_TYPE"];
        $PROPERTY_USER_TYPE = $resultItem["USER_TYPE"];
        $PROPERTY_ID = $resultItem["ID"];
        $arProperty = $resultItem;
    }

    if($PROPERTY_TYPE == "F")
    {
        return null;
    }
    elseif($PROPERTY_TYPE == "N")
    {
        $convertKey = (float)$key;
        if (strlen($key) <= 0)
        {
            return null;
        }

        if (
            !isset($resultItem["VALUES"]["MIN"])
            || !array_key_exists("VALUE", $resultItem["VALUES"]["MIN"])
            || doubleval($resultItem["VALUES"]["MIN"]["VALUE"]) > $convertKey
        )
            $resultItem["VALUES"]["MIN"]["VALUE"] = preg_replace("/\\.0+\$/", "", $key);

        if (
            !isset($resultItem["VALUES"]["MAX"])
            || !array_key_exists("VALUE", $resultItem["VALUES"]["MAX"])
            || doubleval($resultItem["VALUES"]["MAX"]["VALUE"]) < $convertKey
        )
            $resultItem["VALUES"]["MAX"]["VALUE"] = preg_replace("/\\.0+\$/", "", $key);

        return null;
    }
    elseif($arProperty["DISPLAY_TYPE"] == "U")
    {
        $date = substr($key, 0, 10);
        if (!$date)
        {
            return null;
        }
        $timestamp = MakeTimeStamp($date, "YYYY-MM-DD");
        if (!$timestamp)
        {
            return null;
        }

        if (
            !isset($resultItem["VALUES"]["MIN"])
            || !array_key_exists("VALUE", $resultItem["VALUES"]["MIN"])
            || $resultItem["VALUES"]["MIN"]["VALUE"] > $timestamp
        )
            $resultItem["VALUES"]["MIN"]["VALUE"] = $timestamp;

        if (
            !isset($resultItem["VALUES"]["MAX"])
            || !array_key_exists("VALUE", $resultItem["VALUES"]["MAX"])
            || $resultItem["VALUES"]["MAX"]["VALUE"] < $timestamp
        )
            $resultItem["VALUES"]["MAX"]["VALUE"] = $timestamp;

        return null;
    }
    elseif($PROPERTY_TYPE == "E" && $key <= 0)
    {
        return null;
    }
    elseif($PROPERTY_TYPE == "G" && $key <= 0)
    {
        return null;
    }
    elseif(strlen($key) <= 0)
    {
        return null;
    }

    $arUserType = array();
    if($PROPERTY_USER_TYPE != "")
    {
        $arUserType = CIBlockProperty::GetUserType($PROPERTY_USER_TYPE);
        if(isset($arUserType["GetExtendedValue"]))
            $PROPERTY_TYPE = "Ux";
        elseif(isset($arUserType["GetPublicViewHTML"]))
            $PROPERTY_TYPE = "U";
    }

    if ($PROPERTY_USER_TYPE === "DateTime")
    {
        $key = call_user_func_array(
            $arUserType["GetPublicViewHTML"],
            array(
                $arProperty,
                array("VALUE" => $key),
                array("MODE" => "SIMPLE_TEXT", "DATETIME_FORMAT" => "SHORT"),
            )
        );
        $PROPERTY_TYPE = "S";
    }

    $htmlKey = htmlspecialcharsbx($key);
    if (isset($resultItem["VALUES"][$htmlKey]))
    {
        return $htmlKey;
    }

    $file_id = null;
    $url_id = null;

    switch($PROPERTY_TYPE)
    {
        case "L":
            $enum = CIBlockPropertyEnum::GetByID($key);
            if ($enum)
            {
                $value = $enum["VALUE"];
                $sort  = $enum["SORT"];
                $url_id = toLower($enum["XML_ID"]);
            }
            else
            {
                return null;
            }
            break;
        case "E":
            if(!isset($cache[$PROPERTY_TYPE][$key]))
            {
                $arLinkFilter = array (
                    "ID" => $key,
                    "ACTIVE" => "Y",
                    "ACTIVE_DATE" => "Y",
                    "CHECK_PERMISSIONS" => "Y",
                );
                $rsLink = CIBlockElement::GetList(array(), $arLinkFilter, false, false, array("ID","IBLOCK_ID","NAME","SORT","CODE"));
                $cache[$PROPERTY_TYPE][$key] = $rsLink->Fetch();
            }

            if (!$cache[$PROPERTY_TYPE][$key])
                return null;

            $value = $cache[$PROPERTY_TYPE][$key]["NAME"];
            $sort = $cache[$PROPERTY_TYPE][$key]["SORT"];
            if ($cache[$PROPERTY_TYPE][$key]["CODE"])
                $url_id = toLower($cache[$PROPERTY_TYPE][$key]["CODE"]);
            else
                $url_id = toLower($value);
            break;
        case "G":
            if(!isset($cache[$PROPERTY_TYPE][$key]))
            {
                $arLinkFilter = array (
                    "ID" => $key,
                    "GLOBAL_ACTIVE" => "Y",
                    "CHECK_PERMISSIONS" => "Y",
                );
                $rsLink = CIBlockSection::GetList(array(), $arLinkFilter, false, array("ID","IBLOCK_ID","NAME","LEFT_MARGIN","DEPTH_LEVEL","CODE"));
                $cache[$PROPERTY_TYPE][$key] = $rsLink->Fetch();
                $cache[$PROPERTY_TYPE][$key]['DEPTH_NAME'] = str_repeat(".", $cache[$PROPERTY_TYPE][$key]["DEPTH_LEVEL"]).$cache[$PROPERTY_TYPE][$key]["NAME"];
            }

            if (!$cache[$PROPERTY_TYPE][$key])
                return null;

            $value = $cache[$PROPERTY_TYPE][$key]['DEPTH_NAME'];
            $sort = $cache[$PROPERTY_TYPE][$key]["LEFT_MARGIN"];
            if ($cache[$PROPERTY_TYPE][$key]["CODE"])
                $url_id = toLower($cache[$PROPERTY_TYPE][$key]["CODE"]);
            else
                $url_id = toLower($value);
            break;
        case "U":
            if(!isset($cache[$PROPERTY_ID]))
                $cache[$PROPERTY_ID] = array();

            if(!isset($cache[$PROPERTY_ID][$key]))
            {
                $cache[$PROPERTY_ID][$key] = call_user_func_array(
                    $arUserType["GetPublicViewHTML"],
                    array(
                        $arProperty,
                        array("VALUE" => $key),
                        array("MODE" => "SIMPLE_TEXT"),
                    )
                );
            }

            $value = $cache[$PROPERTY_ID][$key];
            $sort = 0;
            $url_id = toLower($value);
            break;
        case "Ux":
            if(!isset($cache[$PROPERTY_ID]))
                $cache[$PROPERTY_ID] = array();

            if(!isset($cache[$PROPERTY_ID][$key]))
            {
                $cache[$PROPERTY_ID][$key] = call_user_func_array(
                    $arUserType["GetExtendedValue"],
                    array(
                        $arProperty,
                        array("VALUE" => $key),
                    )
                );
            }

            if ($cache[$PROPERTY_ID][$key])
            {
                $value = $cache[$PROPERTY_ID][$key]['VALUE'];
                $file_id = $cache[$PROPERTY_ID][$key]['FILE_ID'];
                $sort = (isset($cache[$PROPERTY_ID][$key]['SORT']) ? $cache[$PROPERTY_ID][$key]['SORT'] : 0);
                $url_id = toLower($cache[$PROPERTY_ID][$key]['UF_XML_ID']);
            }
            else
            {
                return null;
            }
            break;
        default:
            $value = $key;
            $sort = 0;
            $url_id = toLower($value);
            break;
    }

    $keyCrc = abs(crc32($htmlKey));
    $safeValue = htmlspecialcharsex($value);
    $sort = (int)$sort;

    $filterPropertyID = 'arrFilter_'.$PROPERTY_ID;
    $filterPropertyIDKey = $filterPropertyID.'_'.$keyCrc;
    $resultItem["VALUES"][$htmlKey] = array(
        "CONTROL_ID" => $filterPropertyIDKey,
        "CONTROL_NAME" => $filterPropertyIDKey,
        "CONTROL_NAME_ALT" => $filterPropertyID,
        "HTML_VALUE_ALT" => $keyCrc,
        "HTML_VALUE" => "Y",
        "VALUE" => $safeValue,
        "SORT" => $sort,
        "UPPER" => ToUpper($safeValue),
        "FLAG" => $flag,
    );

    if ($file_id)
    {
        $resultItem["VALUES"][$htmlKey]['FILE'] = CFile::GetFileArray($file_id);
    }

    if (strlen($url_id))
    {
        $resultItem["VALUES"][$htmlKey]['URL_ID'] = urlencode(str_replace("/", "-", $url_id));
    }

    return $htmlKey;
}

if($_REQUEST["set_filter"]) {
    foreach(CIBlockSectionPropertyLink::GetArray(CATALOG_IBLOCK_ID, "") as $PID => $arLink)
    {
        $rsProperty = CIBlockProperty::GetByID($PID);
        $arProperty = $rsProperty->Fetch();
        if($arProperty)
        {
            $items[$arProperty["ID"]] = array(
                "ID" => $arProperty["ID"],
                "IBLOCK_ID" => $arProperty["IBLOCK_ID"],
                "CODE" => $arProperty["CODE"],
                "~NAME" => $arProperty["NAME"],
                "NAME" => htmlspecialcharsEx($arProperty["NAME"]),
                "PROPERTY_TYPE" => $arProperty["PROPERTY_TYPE"],
                "USER_TYPE" => $arProperty["USER_TYPE"],
                "USER_TYPE_SETTINGS" => $arProperty["USER_TYPE_SETTINGS"],
                "DISPLAY_TYPE" => $arLink["DISPLAY_TYPE"],
                "DISPLAY_EXPANDED" => $arLink["DISPLAY_EXPANDED"],
                "FILTER_HINT" => $arLink["FILTER_HINT"],
                "VALUES" => array(),
            );

        }
    }
    $facet = new \Bitrix\Iblock\PropertyIndex\Facet(CATALOG_IBLOCK_ID);
    if ($facet->isValid()) {
        $filter = array(
            "ACTIVE_DATE" => "Y",
            "CHECK_PERMISSIONS" => "Y",
            'CATALOG_AVAILABLE' => "Y"
        );
        $facet->setSectionId(0);
        $res = $facet->query($filter);
        while ($row = $res->fetch()) {
            $facetId = $row["FACET_ID"];
            if (\Bitrix\Iblock\PropertyIndex\Storage::isPropertyId($facetId)) {
                $PID = \Bitrix\Iblock\PropertyIndex\Storage::facetIdToPropertyId($facetId);
                if ($items["ITEMS"][$PID]["PROPERTY_TYPE"] == "N") {
                    fillItemValues($items[$PID], $row["MIN_VALUE_NUM"]);
                    fillItemValues($items[$PID], $row["MAX_VALUE_NUM"]);
                    if ($row["VALUE_FRAC_LEN"] > 0)
                        $items[$PID]["DECIMALS"] = $row["VALUE_FRAC_LEN"];
                } elseif ($items[$PID]["DISPLAY_TYPE"] == "U") {
                    fillItemValues($items[$PID], FormatDate("Y-m-d", $row["MIN_VALUE_NUM"]));
                    fillItemValues($items[$PID], FormatDate("Y-m-d", $row["MAX_VALUE_NUM"]));
                } elseif ($arResult["ITEMS"][$PID]["PROPERTY_TYPE"] == "S") {
                    $addedKey = fillItemValues($items[$PID], $facet->lookupDictionaryValue($row["VALUE"]), true);
                    if (strlen($addedKey) > 0) {
                        $items[$PID]["VALUES"][$addedKey]["FACET_VALUE"] = $row["VALUE"];
                        $items[$PID]["VALUES"][$addedKey]["ELEMENT_COUNT"] = $row["ELEMENT_COUNT"];
                    }
                } else {
                    $addedKey = fillItemValues($items[$PID], $row["VALUE"], true);
                    if (strlen($addedKey) > 0) {
                        $items[$PID]["VALUES"][$addedKey]["FACET_VALUE"] = $row["VALUE"];
                        $items[$PID]["VALUES"][$addedKey]["ELEMENT_COUNT"] = $row["ELEMENT_COUNT"];
                    }
                }
            }
        }
    }
    foreach ($items as $arItem) {
        if ($arItem["VALUES"] && ($arItem["PROPERTY_TYPE"]=="L" || $arItem["PROPERTY_TYPE"]=="E")) {
            foreach ($arItem["VALUES"] as $i => $val) {
                if($_REQUEST[$val["CONTROL_ID"]]=="Y") {
                    $activeFacetItem[] = $i;
                    $items_active++;
                }
            }
        }
        if(($_REQUEST["arrFilter_".$arItem["ID"]."_MIN"] || $_REQUEST["arrFilter_".$arItem["ID"]."_MAX"]) && $arItem["PROPERTY_TYPE"]=="N"){
            $is_numeric = true;
            break;
        }
    }
    if(count($activeFacetItem)<=2 && !$is_numeric) {
        $section = true;
        foreach ($activeFacetItem as $item){
            if($propFilterArrByID[$item]["SECTION"]=="metro-id"){
                $metro = $propFilterArrByID[$item]["CODE"];
                $location_counter++;
            }
            elseif($propFilterArrByID[$item]["SECTION"]=="flat"){
                $flat = $propFilterArrByID[$item]["CODE"];
                $flat_counter++;
            }
            elseif($propFilterArrByID[$item]["SECTION"]=="sub-locality-name" || $propFilterArrByID[$item]["SECTION"]=="locality-name" || $propFilterArrByID[$item]["SECTION"]=="district"){
                $location = $propFilterArrByID[$item]["CODE"];
                $location_counter++;
            }else{
                $section = false;
            }
        }
        if($section && ($location_counter<=1) && $flat_counter<=1){
            if($metro && $flat){
                $url = "/metro/".$metro."/".$flat."/";
            }elseif ($location && $flat){
                $url = "/location/".$location."/".$flat."/";
            }elseif ($metro){
                $url = "/metro/".$metro."/";
            }elseif ($location){
                $url = "/location/".$location."/";
            }
            if($url){
                LocalRedirect($url);
                die();
            }
        }
    }
}
?>
    <div class="mobile-prev">
        <a href="#" class="go-filter">Фильтр
            <?=FILTER_ICON?>
        </a>
    </div>
    <section class="builder-small-slide shadow" style="background-image: url(<?=SITE_TEMPLATE_PATH?>/img/builders/slide-bg.png);">
        <?$APPLICATION->IncludeComponent(
            "bitrix:breadcrumb",
            "breadcrumb",
            Array(
                "PATH" => "",
                "SITE_ID" => "s1",
                "START_FROM" => "0"
            )
        );?>
        <div class="container">
            <div class="title-big">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "COMPOSITE_FRAME_MODE" => "A",
                        "COMPOSITE_FRAME_TYPE" => "AUTO",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/includes/novostroyki_title.php"
                    )
                );?>
            </div>
        </div>
    </section>
    <section class="filter-bar-wrapper bg-gray" id="go-filter">
        <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.smart.filter",
	"catalog",
	array(
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"DISPLAY_ELEMENT_COUNT" => "N",
		"FILTER_NAME" => "arrFilter",
		"FILTER_VIEW_MODE" => "horizontal",
		"IBLOCK_ID" => "1",
		"IBLOCK_TYPE" => "catalog",
		"PAGER_PARAMS_NAME" => "arrPager",
		"POPUP_POSITION" => "left",
		"SAVE_IN_SESSION" => "N",
		"SECTION_CODE" => "",
		"SECTION_CODE_PATH" => "",
		"SECTION_DESCRIPTION" => "-",
		"SECTION_ID" => "",
		"SECTION_TITLE" => "-",
		"SEF_MODE" => "N",
		"SEF_RULE" => "",
		"SMART_FILTER_PATH" => "",
		"TEMPLATE_THEME" => "blue",
		"XML_EXPORT" => "N",
		"COMPONENT_TEMPLATE" => ".default",
        "INCLUDE_SUBSECTIONS" => "Y",
        "SHOW_ALL_WO_SECTION" => "Y"
	),
	false
);?>

    </section>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog", 
	"catalog", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADD_ELEMENT_CHAIN" => "N",
		"ADD_PICT_PROP" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "N",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BASKET_URL" => "/personal/basket.php",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "N",
		"COMPATIBLE_MODE" => "Y",
		"DETAIL_ADD_DETAIL_TO_SLIDER" => "N",
		"DETAIL_BACKGROUND_IMAGE" => "-",
		"DETAIL_BRAND_USE" => "N",
		"DETAIL_BROWSER_TITLE" => "-",
		"DETAIL_CHECK_SECTION_ID_VARIABLE" => "N",
		"DETAIL_DETAIL_PICTURE_MODE" => array(
			0 => "POPUP",
			1 => "MAGNIFIER",
		),
		"DETAIL_DISPLAY_NAME" => "Y",
		"DETAIL_DISPLAY_PREVIEW_TEXT_MODE" => "E",
		"DETAIL_IMAGE_RESOLUTION" => "16by9",
		"DETAIL_MAIN_BLOCK_PROPERTY_CODE" => array(
		),
		"DETAIL_META_DESCRIPTION" => "-",
		"DETAIL_META_KEYWORDS" => "-",
		"DETAIL_PRODUCT_INFO_BLOCK_ORDER" => "sku,props",
		"DETAIL_PRODUCT_PAY_BLOCK_ORDER" => "rating,price,priceRanges,quantityLimit,quantity,buttons",
		"DETAIL_PROPERTY_CODE" => array(
			0 => "ceiling_height",
			1 => "living_space",
			2 => "building_section",
			3 => "flat_number",
			4 => "renovation",
			5 => "area",
			6 => "kitchen_space",
			7 => "bathroom_unit",
			8 => "ready",
			9 => "rooms",
			10 => "floor",
			11 => "developer",
			12 => "order_status",
			13 => "price",
			14 => "",
		),
		"DETAIL_SET_CANONICAL_URL" => "N",
		"DETAIL_SHOW_POPULAR" => "Y",
		"DETAIL_SHOW_SLIDER" => "N",
		"DETAIL_SHOW_VIEWED" => "Y",
		"DETAIL_STRICT_SECTION_CHECK" => "N",
		"DETAIL_USE_COMMENTS" => "N",
		"DETAIL_USE_VOTE_RATING" => "N",
		"DISABLE_INIT_JS_IN_COMPONENT" => "Y",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_HIDE_ON_MOBILE" => "N",
		"FILTER_VIEW_MODE" => "VERTICAL",
		"IBLOCK_ID" => "1",
		"IBLOCK_TYPE" => "catalog",
		"INCLUDE_SUBSECTIONS" => "Y",
		"INSTANT_RELOAD" => "N",
		"LABEL_PROP" => array(
		),
		"LAZY_LOAD" => "N",
		"LINE_ELEMENT_COUNT" => "3",
		"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
		"LINK_IBLOCK_ID" => "",
		"LINK_IBLOCK_TYPE" => "",
		"LINK_PROPERTY_SID" => "",
		"LIST_BROWSER_TITLE" => "-",
		"LIST_ENLARGE_PRODUCT" => "STRICT",
		"LIST_META_DESCRIPTION" => "-",
		"LIST_META_KEYWORDS" => "-",
		"LIST_PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
		"LIST_PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
		"LIST_PROPERTY_CODE" => array(
			0 => "living_space",
			1 => "area",
			2 => "kitchen_space",
			3 => "bathroom_unit",
			4 => "ready",
			5 => "rooms",
			6 => "floor",
			7 => "price",
			8 => "",
		),
		"LIST_PROPERTY_CODE_MOBILE" => array(
		),
		"LIST_SHOW_SLIDER" => "N",
		"LIST_SLIDER_INTERVAL" => "3000",
		"LIST_SLIDER_PROGRESS" => "N",
		"LOAD_ON_SCROLL" => "N",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "",
		"MESS_BTN_BUY" => "",
		"MESS_BTN_COMPARE" => "",
		"MESS_BTN_DETAIL" => "",
		"MESS_BTN_SUBSCRIBE" => "",
		"MESS_NOT_AVAILABLE" => "",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "",
		"PAGE_ELEMENT_COUNT" => "30",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(
		),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"SEARCH_CHECK_DATES" => "Y",
		"SEARCH_NO_WORD_LOGIC" => "Y",
		"SEARCH_PAGE_RESULT_COUNT" => "50",
		"SEARCH_RESTART" => "N",
		"SEARCH_USE_LANGUAGE_GUESS" => "Y",
		"SECTIONS_SHOW_PARENT_NAME" => "N",
		"SECTIONS_VIEW_MODE" => "TILE",
		"SECTION_BACKGROUND_IMAGE" => "-",
		"SECTION_COUNT_ELEMENTS" => "Y",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_TOP_DEPTH" => "2",
		"SEF_FOLDER" => "/novostroyki/",
		"SEF_MODE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_STATUS_404" => "Y",
		"SET_TITLE" => "Y",
		"SHOW_404" => "Y",
		"SHOW_DEACTIVATED" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"SHOW_TOP_ELEMENTS" => "N",
		"SIDEBAR_DETAIL_SHOW" => "N",
		"SIDEBAR_PATH" => "",
		"SIDEBAR_SECTION_SHOW" => "N",
		"TEMPLATE_THEME" => "blue",
		"TOP_ELEMENT_COUNT" => "9",
		"TOP_ELEMENT_SORT_FIELD" => "sort",
		"TOP_ELEMENT_SORT_FIELD2" => "id",
		"TOP_ELEMENT_SORT_ORDER" => "asc",
		"TOP_ELEMENT_SORT_ORDER2" => "desc",
		"TOP_ENLARGE_PRODUCT" => "STRICT",
		"TOP_LINE_ELEMENT_COUNT" => "3",
		"TOP_PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
		"TOP_PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
		"TOP_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"TOP_PROPERTY_CODE_MOBILE" => "",
		"TOP_SHOW_SLIDER" => "Y",
		"TOP_SLIDER_INTERVAL" => "3000",
		"TOP_SLIDER_PROGRESS" => "N",
		"TOP_VIEW_MODE" => "SECTION",
		"USE_COMPARE" => "N",
		"USE_ELEMENT_COUNTER" => "Y",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_FILTER" => "Y",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"USE_REVIEW" => "N",
		"USE_STORE" => "N",
		"COMPONENT_TEMPLATE" => "catalog",
		"FILTER_NAME" => "",
		"FILTER_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_PRICE_CODE" => "",
		"SECTIONS_HIDE_SECTION_NAME" => "N",
		"FILE_404" => "/404.php",
		"COMPOSITE_FRAME_MODE" => "N",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"USER_CONSENT" => "N",
		"USER_CONSENT_ID" => "0",
		"USER_CONSENT_IS_CHECKED" => "Y",
		"USER_CONSENT_IS_LOADED" => "N",
		"SEF_URL_TEMPLATES" => array(
			"sections" => "",
			"section" => "#SECTION_CODE#/",
			"element" => "#SECTION_CODE#/#ELEMENT_ID#/",
			"compare" => "compare.php?action=#ACTION_CODE#",
			"smart_filter" => "#SECTION_ID#/filter/#SMART_FILTER_PATH#/apply/",
		),
		"VARIABLE_ALIASES" => array(
			"compare" => array(
				"ACTION_CODE" => "action",
			),
		)
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>