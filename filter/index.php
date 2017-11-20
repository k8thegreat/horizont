<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новостройки");
$APPLICATION->AddChainItem("Новостройки", "/novostroyki/");
global $FILTER_CONDITION, $FILTER_VALUE_CODE, $propFilterArr, $arrFilter;
if($_REQUEST["CODE"]){
    $FILTER_VALUE_CODE = $_REQUEST["CODE"];
}
if($_REQUEST["TYPE"]){
    $FILTER_VALUE_CODE2 = $_REQUEST["TYPE"];
}
foreach ($propFilterArr as $val){
    if($val["CODE"]==$FILTER_VALUE_CODE || $val["CODE"]==$FILTER_VALUE_CODE2){
        $activeItemID[] = $val["ID"];
    }
}
$items = array();

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
if ($facet->isValid())
{
    $filter = array(
        "ACTIVE_DATE" => "Y",
        "CHECK_PERMISSIONS" => "Y",
        'CATALOG_AVAILABLE' => "Y"
    );
    $facet->setSectionId(0);
    $res = $facet->query($filter);
    while ($row = $res->fetch())
    {
        $facetId = $row["FACET_ID"];
        if (\Bitrix\Iblock\PropertyIndex\Storage::isPropertyId($facetId))
        {
            $PID = \Bitrix\Iblock\PropertyIndex\Storage::facetIdToPropertyId($facetId);
            if ($items["ITEMS"][$PID]["PROPERTY_TYPE"] == "N")
            {
                fillItemValues($items[$PID], $row["MIN_VALUE_NUM"]);
                fillItemValues($items[$PID], $row["MAX_VALUE_NUM"]);
                if ($row["VALUE_FRAC_LEN"] > 0)
                    $items[$PID]["DECIMALS"] = $row["VALUE_FRAC_LEN"];
            }
            elseif ($items[$PID]["DISPLAY_TYPE"] == "U")
            {
                fillItemValues($items[$PID], FormatDate("Y-m-d", $row["MIN_VALUE_NUM"]));
                fillItemValues($items[$PID], FormatDate("Y-m-d", $row["MAX_VALUE_NUM"]));
            }
            elseif ($arResult["ITEMS"][$PID]["PROPERTY_TYPE"] == "S")
            {
                $addedKey = fillItemValues($items[$PID], $facet->lookupDictionaryValue($row["VALUE"]), true);
                if (strlen($addedKey) > 0)
                {
                    $items[$PID]["VALUES"][$addedKey]["FACET_VALUE"] = $row["VALUE"];
                    $items[$PID]["VALUES"][$addedKey]["ELEMENT_COUNT"] = $row["ELEMENT_COUNT"];
                }
            }
            else
            {
                $addedKey = fillItemValues($items[$PID], $row["VALUE"], true);
                if (strlen($addedKey) > 0)
                {
                    $items[$PID]["VALUES"][$addedKey]["FACET_VALUE"] = $row["VALUE"];
                    $items[$PID]["VALUES"][$addedKey]["ELEMENT_COUNT"] = $row["ELEMENT_COUNT"];
                }
            }
        }
    }
}
foreach ($activeItemID as $activeItem){
    foreach ($items as $arItem){
        if($arItem["VALUES"][$activeItem]){
            $activeFacetItem = $arItem["VALUES"][$activeItem];
            $_REQUEST[$activeFacetItem["CONTROL_ID"]] = $_GET[$activeFacetItem["CONTROL_ID"]] = "Y";
            $items_active++;
        }
    }
}

if($items_active){
    $_REQUEST["set_filter"] = $_GET["set_filter"] = "y";
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
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "N",
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
		"COMPONENT_TEMPLATE" => "catalog",
		"INCLUDE_SUBSECTIONS" => "Y",
		"SHOW_ALL_WO_SECTION" => "Y",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>
    </section>
        <?if(isset($_REQUEST["view"]) ) {
        //$APPLICATION->set_cookie("view", strVal($_REQUEST["view"]) );
        $view = strVal($_REQUEST["view"]) ;
        }else{
        $view = "list";
        }
        if(isset($_REQUEST["sort"]) ) {
        //$APPLICATION->set_cookie("sort", strVal($_REQUEST["sort"] ));
        $sort = strVal($_REQUEST["sort"]) ;
        }
        else{
        $sort = "price";
        }
        switch ($sort){
        case "name":
        $sortField = "NAME";
        break;
        case "date":
        $sortField = "UF_READY_MIN";
        break;
        case "price":
        $sortField = "UF_MIN_PRICE";
        break;
        case "location":
        $sortField = "UF_DISTRICT";
        break;
        case "metro":
        $sortField = "UF_METRO";
        break;
        default:
        $sortField = "UF_MIN_PRICE";
        }
        ?>
        <?/*$this->SetViewTarget('banner');?>
banner
<?$this->EndViewTarget();*/?>
        <?$arResult = $APPLICATION->IncludeComponent(
            "custom:catalog.section",
            "",
            array(
                "IBLOCK_ID" => "1",
                "IBLOCK_TYPE" => "catalog",
                "ELEMENT_SORT_FIELD" => "sort",
                "ELEMENT_SORT_FIELD2" => "id",
                "ELEMENT_SORT_ORDER" => "asc",
                "ELEMENT_SORT_ORDER2" => "desc",
                "PROPERTY_CODE" => "",
                "PROPERTY_CODE_MOBILE" => "",
                "META_KEYWORDS" => "",
                "META_DESCRIPTION" => "",
                "BROWSER_TITLE" => "",
                "SET_LAST_MODIFIED" => "",
                "INCLUDE_SUBSECTIONS" => "Y",
                "BASKET_URL" => "",
                "ACTION_VARIABLE" => "",
                "PRODUCT_ID_VARIABLE" => "",
                "SECTION_ID_VARIABLE" => "",
                "PRODUCT_QUANTITY_VARIABLE" => "",
                "PRODUCT_PROPS_VARIABLE" => "",
                "FILTER_NAME" => "arrFilter",
                "CACHE_FILTER" => "Y",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "360000",
                "CACHE_TYPE" => "N",
                "SET_TITLE" => "N",
                "MESSAGE_404" => "",
                "SET_STATUS_404" => "Y",
                "SHOW_404" => "Y",
                "FILE_404" => "/404.php",
                "DISPLAY_COMPARE" => "",
                "PAGE_ELEMENT_COUNT" => "100000000",
                "LINE_ELEMENT_COUNT" => "",
                "PRICE_CODE" => "",
                "USE_PRICE_COUNT" => "",
                "SHOW_PRICE_COUNT" => "",
                "SHOW_ALL_WO_SECTION" => "Y",
                "GROUP_BY" => "IBLOCK_SECTION_ID",

                "PRICE_VAT_INCLUDE" => "",
                "USE_PRODUCT_QUANTITY" => "",
                "ADD_PROPERTIES_TO_BASKET" => "",
                "PARTIAL_PRODUCT_PROPERTIES" => "",
                "PRODUCT_PROPERTIES" => "",

                "DISPLAY_TOP_PAGER" => "",
                "DISPLAY_BOTTOM_PAGER" => "",
                "PAGER_TITLE" => "",
                "PAGER_SHOW_ALWAYS" => "",
                "PAGER_TEMPLATE" => "",
                "PAGER_DESC_NUMBERING" => "",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
                "PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
                "PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
                "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                "LAZY_LOAD" => $arParams["LAZY_LOAD"],
                "MESS_BTN_LAZY_LOAD" => $arParams["~MESS_BTN_LAZY_LOAD"],
                "LOAD_ON_SCROLL" => $arParams["LOAD_ON_SCROLL"],

                "OFFERS_CART_PROPERTIES" => "",
                "OFFERS_FIELD_CODE" => "",
                "OFFERS_PROPERTY_CODE" => "",
                "OFFERS_SORT_FIELD" => "",
                "OFFERS_SORT_ORDER" => "",
                "OFFERS_SORT_FIELD2" => "",
                "OFFERS_SORT_ORDER2" => "",
                "OFFERS_LIMIT" => "",

                "SECTION_ID" => "",
                "SECTION_CODE" => "",
                "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
                "USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
                'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
                'HIDE_NOT_AVAILABLE_OFFERS' => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],

                'LABEL_PROP' => $arParams['LABEL_PROP'],
                'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
                'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
                'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
                'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
                'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
                'PRODUCT_ROW_VARIANTS' => $arParams['LIST_PRODUCT_ROW_VARIANTS'],
                'ENLARGE_PRODUCT' => $arParams['LIST_ENLARGE_PRODUCT'],
                'ENLARGE_PROP' => isset($arParams['LIST_ENLARGE_PROP']) ? $arParams['LIST_ENLARGE_PROP'] : '',
                'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
                'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
                'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

                'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
                'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
                'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
                'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
                'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
                'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
                'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
                'MESS_SHOW_MAX_QUANTITY' => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
                'RELATIVE_QUANTITY_FACTOR' => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
                'MESS_RELATIVE_QUANTITY_MANY' => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY']) ? $arParams['~MESS_RELATIVE_QUANTITY_MANY'] : ''),
                'MESS_RELATIVE_QUANTITY_FEW' => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW']) ? $arParams['~MESS_RELATIVE_QUANTITY_FEW'] : ''),
                'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
                'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
                'MESS_BTN_SUBSCRIBE' => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
                'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
                'MESS_NOT_AVAILABLE' => (isset($arParams['~MESS_NOT_AVAILABLE']) ? $arParams['~MESS_NOT_AVAILABLE'] : ''),
                'MESS_BTN_COMPARE' => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),

                'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
                'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
                'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),

                'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
                "ADD_SECTIONS_CHAIN" => "N",
                'ADD_TO_BASKET_ACTION' => $basketAction,
                'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
                'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
                'COMPARE_NAME' => $arParams['COMPARE_NAME'],
                'BACKGROUND_IMAGE' => (isset($arParams['SECTION_BACKGROUND_IMAGE']) ? $arParams['SECTION_BACKGROUND_IMAGE'] : ''),
                'COMPATIBLE_MODE' => (isset($arParams['COMPATIBLE_MODE']) ? $arParams['COMPATIBLE_MODE'] : ''),
                'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : '')
            )
        );?>
        <?
        global $arFilter;

        if($arResult["ITEMS"]){
            foreach ($arResult["ITEMS"] as $arItem){
                $arFilter["ID"][] = $arItem["IBLOCK_SECTION_ID"];
            }
        }
        ?>
        <section class="bg-gray">
            <div class="container">
                <?
                if($arResult["TOTAL_COUNT"]){
                    if(!$APPLICATION->GetProperty("subtitle"))
                        $APPLICATION->SetTitle("Найдено ".$arResult["SECTIONS_COUNT"]." ".formatObjectString($arResult["SECTIONS_COUNT"]).", ".$arResult["TOTAL_COUNT"]." ".formatApartment($arResult["TOTAL_COUNT"]));
                    else
                        $APPLICATION->SetPageProperty("h1", $APPLICATION->GetProperty("subtitle"));
                        $APPLICATION->SetPageProperty("h1", "#AIMT_ZAG_1#");
                    ?>
                    <div class="title-big cursive-title-top-center"><span class="dop-title">Все новостройки</span>
                        <h1><?=$APPLICATION->ShowTitle("h1")?></h1>
                    </div>
                    <script type="text/javascript">
                        $(document).ready(function(){
                            console.log($("h1").text());
                            if($("h1").text()==""){
                                $("h1").text("Найдено <?=$arResult["SECTIONS_COUNT"]?> <?=formatObjectString($arResult["SECTIONS_COUNT"])?>, <?=number_format($arResult["TOTAL_COUNT"], 0,".", " ")?> <?=formatApartment($arResult["TOTAL_COUNT"])?>");
                            }
                        });
                    </script>
                    <?
                }else{
                    ?><div class="title-big cursive-title-top-center">Нет результатов для ваших условий</div><?
                }
                ?>
                <?if($arResult["TOTAL_COUNT"]){
                if($view=="map") $count = 1000; else $count = 10;
                $APPLICATION->IncludeComponent(
                    "custom:catalog.section.list",
                    $view,
                    array(
                        "IBLOCK_ID" => "1",
                        "IBLOCK_TYPE" => "catalog",
                        "CACHE_GROUPS" => "Y",
                        "CACHE_TIME" => "3600",
                        "CACHE_TYPE" => "N",
                        "COUNT_ELEMENTS" => "",
                        "TOP_DEPTH" => "",
                        "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                        "VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
                        "SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
                        "HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
                        "ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : ''),
                        "FILTER_NAME" => "arFilter",
                        "ITEMS_COUNT" => "$count",
                        "COMPOSITE_FRAME_MODE" => "A",
                        "COMPOSITE_FRAME_TYPE" => "AUTO",
                        "PAGER_TEMPLATE" => ".default",
                        "DISPLAY_TOP_PAGER" => "N",
                        "DISPLAY_BOTTOM_PAGER" => "Y",
                        "PAGER_TITLE" => "",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "SORT_BY1" => $sortField,
                        "SORT_ORDER1" => "ASC",
                        "SORT_BY2" => "SORT",
                        "SORT_ORDER2" => "ASC"
                    ),
                    false
                );
                ?>
            </div>
            <?if($view=="map"){?>
                <div id="map" class="ya-map"></div>
            <?}?>
            <?}?>
        </section>
        <?
        if($_COOKIE['ITEM_VIEW']){
            global $arViewedItemsFilter;
            $arViewedItemsFilter = array("ID" => unserialize($_COOKIE['ITEM_VIEW']));
            ?>
            <section>
                <div class="container">
                    <?$APPLICATION->IncludeComponent(
                        "custom:catalog.section.list",
                        "history",
                        array(
                            "ADD_SECTIONS_CHAIN" => "N",
                            "CACHE_GROUPS" => "Y",
                            "CACHE_TIME" => "3600",
                            "CACHE_TYPE" => "N",
                            "COUNT_ELEMENTS" => "N",
                            "IBLOCK_ID" => "1",
                            "IBLOCK_TYPE" => "catalog",
                            "SECTION_CODE" => "",
                            "SECTION_FIELDS" => array(
                                0 => "UF_MIN_PRICE",
                                1 => "PICTURE",
                            ),
                            "SECTION_ID" => "",
                            "SECTION_URL" => "",
                            "SECTION_USER_FIELDS" => array(
                                0 => "",
                                1 => "",
                            ),
                            "SHOW_PARENT_NAME" => "N",
                            "TOP_DEPTH" => "",
                            "VIEW_MODE" => "TILE",
                            "FILTER_NAME" => "arViewedItemsFilter",
                            "COMPONENT_TEMPLATE" => "history",
                            "HIDE_SECTION_NAME" => "N",
                            "ITEMS_COUNT" => "10",
                            "COMPOSITE_FRAME_MODE" => "A",
                            "COMPOSITE_FRAME_TYPE" => "AUTO",
                            "PAGER_TEMPLATE" => ".default",
                            "DISPLAY_TOP_PAGER" => "N",
                            "DISPLAY_BOTTOM_PAGER" => "N",
                            "PAGER_TITLE" => "",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_BASE_LINK_ENABLE" => "N"
                        ),
                        false
                    );?>
                </div>
            </section>
        <?}?>
        <?
        global $SELECTED_FILTER_ITEM;
        if($SELECTED_FILTER_ITEM){?>
            <section class="bg-gray">
                <div class="container">
                    <div class="filter-data-description-wrapper">
                        <div class="filter-data-description">
                            #AIMT_TEXT_1#
                        </div>
                    </div>

                    <?/*$APPLICATION->IncludeComponent("bitrix:news.detail", "seo_text", Array(
                        "ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
                        "ADD_ELEMENT_CHAIN" => "N",	// Включать название элемента в цепочку навигации
                        "ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
                        "AJAX_MODE" => "N",	// Включить режим AJAX
                        "AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
                        "AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
                        "AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
                        "AJAX_OPTION_STYLE" => "N",	// Включить подгрузку стилей
                        "BROWSER_TITLE" => "-",	// Установить заголовок окна браузера из свойства
                        "CACHE_GROUPS" => "Y",	// Учитывать права доступа
                        "CACHE_TIME" => "36000000",	// Время кеширования (сек.)
                        "CACHE_TYPE" => "A",	// Тип кеширования
                        "CHECK_DATES" => "N",	// Показывать только активные на данный момент элементы
                        "COMPOSITE_FRAME_MODE" => "A",	// Голосование шаблона компонента по умолчанию
                        "COMPOSITE_FRAME_TYPE" => "AUTO",	// Содержимое компонента
                        "DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
                        "DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
                        "DISPLAY_DATE" => "N",	// Выводить дату элемента
                        "DISPLAY_NAME" => "N",	// Выводить название элемента
                        "DISPLAY_PICTURE" => "N",	// Выводить детальное изображение
                        "DISPLAY_PREVIEW_TEXT" => "N",	// Выводить текст анонса
                        "DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
                        "ELEMENT_CODE" => "",	// Код новости
                        "ELEMENT_ID" => $SELECTED_FILTER_ITEM,	// ID новости
                        "FIELD_CODE" => array(	// Поля
                            0 => "DETAIL_TEXT",
                            1 => "",
                        ),
                        "IBLOCK_ID" => "24",	// Код информационного блока
                        "IBLOCK_TYPE" => "dictionary",	// Тип информационного блока (используется только для проверки)
                        "IBLOCK_URL" => "",	// URL страницы просмотра списка элементов (по умолчанию - из настроек инфоблока)
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
                        "MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
                        "META_DESCRIPTION" => "-",	// Установить описание страницы из свойства
                        "META_KEYWORDS" => "-",	// Установить ключевые слова страницы из свойства
                        "PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
                        "PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
                        "PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
                        "PAGER_TITLE" => "",	// Название категорий
                        "PROPERTY_CODE" => array(	// Свойства
                            0 => "",
                            1 => "",
                        ),
                        "SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
                        "SET_CANONICAL_URL" => "N",	// Устанавливать канонический URL
                        "SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
                        "SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
                        "SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
                        "SET_STATUS_404" => "N",	// Устанавливать статус 404
                        "SET_TITLE" => "N",	// Устанавливать заголовок страницы
                        "SHOW_404" => "N",	// Показ специальной страницы
                        "STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа элемента
                        "USE_PERMISSIONS" => "N",	// Использовать дополнительное ограничение доступа
                        "USE_SHARE" => "N",	// Отображать панель соц. закладок
                    ),
                        false
                    );*/?>
                </div>
            </section>
        <?}?>
    </section>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>