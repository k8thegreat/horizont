<?
use Bitrix\Main\Context;
use Bitrix\Main\Loader;
use Bitrix\Main\Type\DateTime;
use Bitrix\Currency\CurrencyTable;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

/** @global CCacheManager $CACHE_MANAGER */
global $CACHE_MANAGER;
/** @global CIntranetToolbar $INTRANET_TOOLBAR */
global $INTRANET_TOOLBAR;

CJSCore::Init(array('popup'));

CPageOption::SetOptionString("main", "nav_page_in_session", "N");

/*************************************************************************
Processing of received parameters
 *************************************************************************/
if(!isset($arParams["CACHE_TIME"]))
    $arParams["CACHE_TIME"] = 36000000;

$arParams["IBLOCK_TYPE"] = trim($arParams["IBLOCK_TYPE"]);
$arParams["IBLOCK_ID"] = (int)$arParams["IBLOCK_ID"];

$arParams["SECTION_ID"] = (int)$arParams["~SECTION_ID"];
if($arParams["SECTION_ID"] > 0 && $arParams["SECTION_ID"]."" != $arParams["~SECTION_ID"])
{
    if (CModule::IncludeModule("iblock"))
    {
        \Bitrix\Iblock\Component\Tools::process404(
            trim($arParams["MESSAGE_404"]) ?: GetMessage("CATALOG_SECTION_NOT_FOUND")
            ,true
            ,$arParams["SET_STATUS_404"] === "Y"
            ,$arParams["SHOW_404"] === "Y"
            ,$arParams["FILE_404"]
        );
    }
    return;
}

if (!isset($arParams["INCLUDE_SUBSECTIONS"]) || !in_array($arParams["INCLUDE_SUBSECTIONS"], array('Y', 'A', 'N')))
    $arParams["INCLUDE_SUBSECTIONS"] = 'Y';
$arParams["SHOW_ALL_WO_SECTION"] = $arParams["SHOW_ALL_WO_SECTION"]==="Y";
$arParams["SET_LAST_MODIFIED"] = $arParams["SET_LAST_MODIFIED"]==="Y";
$arParams["USE_MAIN_ELEMENT_SECTION"] = $arParams["USE_MAIN_ELEMENT_SECTION"]==="Y";

if (empty($arParams["ELEMENT_SORT_FIELD"]))
    $arParams["ELEMENT_SORT_FIELD"] = "sort";
if (!preg_match('/^(asc|desc|nulls)(,asc|,desc|,nulls){0,1}$/i', $arParams["ELEMENT_SORT_ORDER"]))
    $arParams["ELEMENT_SORT_ORDER"] = "asc";
if (empty($arParams["ELEMENT_SORT_FIELD2"]))
    $arParams["ELEMENT_SORT_FIELD2"] = "id";
if (!preg_match('/^(asc|desc|nulls)(,asc|,desc|,nulls){0,1}$/i', $arParams["ELEMENT_SORT_ORDER2"]))
    $arParams["ELEMENT_SORT_ORDER2"] = "desc";

if(empty($arParams["FILTER_NAME"]) || !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["FILTER_NAME"]))
{
    $arrFilter = array();
}
else
{
    global ${$arParams["FILTER_NAME"]};
    $arrFilter = ${$arParams["FILTER_NAME"]};
    if(!is_array($arrFilter))
        $arrFilter = array();
}

if (empty($arParams["PAGER_PARAMS_NAME"]) || !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["PAGER_PARAMS_NAME"]))
{
    $pagerParameters = array();
}
else
{
    $pagerParameters = $GLOBALS[$arParams["PAGER_PARAMS_NAME"]];
    if (!is_array($pagerParameters))
        $pagerParameters = array();
}

$arParams["SECTION_URL"]=trim($arParams["SECTION_URL"]);
$arParams["DETAIL_URL"]=trim($arParams["DETAIL_URL"]);
$arParams["BASKET_URL"]=trim($arParams["BASKET_URL"]);
if($arParams["BASKET_URL"] === '')
    $arParams["BASKET_URL"] = "/personal/basket.php";

$arParams["ACTION_VARIABLE"]=trim($arParams["ACTION_VARIABLE"]);
if($arParams["ACTION_VARIABLE"] === '' || !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["ACTION_VARIABLE"]))
    $arParams["ACTION_VARIABLE"] = "action";

$arParams["PRODUCT_ID_VARIABLE"]=trim($arParams["PRODUCT_ID_VARIABLE"]);
if($arParams["PRODUCT_ID_VARIABLE"] === '' || !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["PRODUCT_ID_VARIABLE"]))
    $arParams["PRODUCT_ID_VARIABLE"] = "id";

$arParams["PRODUCT_QUANTITY_VARIABLE"]=trim($arParams["PRODUCT_QUANTITY_VARIABLE"]);
if($arParams["PRODUCT_QUANTITY_VARIABLE"] === '' || !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["PRODUCT_QUANTITY_VARIABLE"]))
    $arParams["PRODUCT_QUANTITY_VARIABLE"] = "quantity";

$arParams["PRODUCT_PROPS_VARIABLE"]=trim($arParams["PRODUCT_PROPS_VARIABLE"]);
if($arParams["PRODUCT_PROPS_VARIABLE"] === '' || !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["PRODUCT_PROPS_VARIABLE"]))
    $arParams["PRODUCT_PROPS_VARIABLE"] = "prop";

$arParams["SECTION_ID_VARIABLE"]=trim($arParams["SECTION_ID_VARIABLE"]);
if($arParams["SECTION_ID_VARIABLE"] === '' || !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["SECTION_ID_VARIABLE"]))
    $arParams["SECTION_ID_VARIABLE"] = "SECTION_ID";

$arParams["SET_TITLE"] = $arParams["SET_TITLE"]!="N";
$arParams["SET_BROWSER_TITLE"] = (isset($arParams["SET_BROWSER_TITLE"]) && $arParams["SET_BROWSER_TITLE"] === 'N' ? 'N' : 'Y');
$arParams["SET_META_KEYWORDS"] = (isset($arParams["SET_META_KEYWORDS"]) && $arParams["SET_META_KEYWORDS"] === 'N' ? 'N' : 'Y');
$arParams["SET_META_DESCRIPTION"] = (isset($arParams["SET_META_DESCRIPTION"]) && $arParams["SET_META_DESCRIPTION"] === 'N' ? 'N' : 'Y');
$arParams["ADD_SECTIONS_CHAIN"] = (isset($arParams["ADD_SECTIONS_CHAIN"]) && $arParams["ADD_SECTIONS_CHAIN"]==="Y"); //Turn off by default

$arParams["BACKGROUND_IMAGE"] = (isset($arParams["BACKGROUND_IMAGE"]) ? trim($arParams["BACKGROUND_IMAGE"]) : '');
if ($arParams["BACKGROUND_IMAGE"] == '-')
    $arParams["BACKGROUND_IMAGE"] = '';

$arParams["DISPLAY_COMPARE"] = (isset($arParams['DISPLAY_COMPARE']) && $arParams["DISPLAY_COMPARE"] == "Y");
$arParams['COMPARE_PATH'] = (isset($arParams['COMPARE_PATH']) ? trim($arParams['COMPARE_PATH']) : '');

$arParams["PAGE_ELEMENT_COUNT"] = intval($arParams["PAGE_ELEMENT_COUNT"]);
if($arParams["PAGE_ELEMENT_COUNT"]<=0)
    $arParams["PAGE_ELEMENT_COUNT"]=20;
$arParams["LINE_ELEMENT_COUNT"] = intval($arParams["LINE_ELEMENT_COUNT"]);
if($arParams["LINE_ELEMENT_COUNT"]<=0)
    $arParams["LINE_ELEMENT_COUNT"]=3;

if(!is_array($arParams["PROPERTY_CODE"]))
    $arParams["PROPERTY_CODE"] = array();
foreach($arParams["PROPERTY_CODE"] as $k=>$v)
    if($v==="")
        unset($arParams["PROPERTY_CODE"][$k]);

if(!is_array($arParams["PRICE_CODE"]))
    $arParams["PRICE_CODE"] = array();
$arParams["USE_PRICE_COUNT"] = $arParams["USE_PRICE_COUNT"]=="Y";
$arParams["SHOW_PRICE_COUNT"] = (isset($arParams["SHOW_PRICE_COUNT"]) ? (int)$arParams["SHOW_PRICE_COUNT"] : 1);
if($arParams["SHOW_PRICE_COUNT"]<=0)
    $arParams["SHOW_PRICE_COUNT"]=1;
$arParams["USE_PRODUCT_QUANTITY"] = $arParams["USE_PRODUCT_QUANTITY"]==="Y";

if (empty($arParams['HIDE_NOT_AVAILABLE']))
    $arParams['HIDE_NOT_AVAILABLE'] = 'N';
elseif ('Y' != $arParams['HIDE_NOT_AVAILABLE'])
    $arParams['HIDE_NOT_AVAILABLE'] = 'N';

$arParams['ADD_PROPERTIES_TO_BASKET'] = (isset($arParams['ADD_PROPERTIES_TO_BASKET']) && $arParams['ADD_PROPERTIES_TO_BASKET'] == 'N' ? 'N' : 'Y');
if ('N' == $arParams['ADD_PROPERTIES_TO_BASKET'])
{
    $arParams["PRODUCT_PROPERTIES"] = array();
    $arParams["OFFERS_CART_PROPERTIES"] = array();
}
$arParams['PARTIAL_PRODUCT_PROPERTIES'] = (isset($arParams['PARTIAL_PRODUCT_PROPERTIES']) && $arParams['PARTIAL_PRODUCT_PROPERTIES'] === 'Y' ? 'Y' : 'N');
if(!is_array($arParams["PRODUCT_PROPERTIES"]))
    $arParams["PRODUCT_PROPERTIES"] = array();
foreach($arParams["PRODUCT_PROPERTIES"] as $k=>$v)
    if($v==="")
        unset($arParams["PRODUCT_PROPERTIES"][$k]);

if (!is_array($arParams["OFFERS_CART_PROPERTIES"]))
    $arParams["OFFERS_CART_PROPERTIES"] = array();
foreach($arParams["OFFERS_CART_PROPERTIES"] as $i => $pid)
    if ($pid === "")
        unset($arParams["OFFERS_CART_PROPERTIES"][$i]);

if (empty($arParams["OFFERS_SORT_FIELD"]))
    $arParams["OFFERS_SORT_FIELD"] = "sort";
if (!preg_match('/^(asc|desc|nulls)(,asc|,desc|,nulls){0,1}$/i', $arParams["OFFERS_SORT_ORDER"]))
    $arParams["OFFERS_SORT_ORDER"] = "asc";
if (empty($arParams["OFFERS_SORT_FIELD2"]))
    $arParams["OFFERS_SORT_FIELD2"] = "id";
if (!preg_match('/^(asc|desc|nulls)(,asc|,desc|,nulls){0,1}$/i', $arParams["OFFERS_SORT_ORDER2"]))
    $arParams["OFFERS_SORT_ORDER2"] = "desc";

$arParams["DISPLAY_TOP_PAGER"] = $arParams["DISPLAY_TOP_PAGER"]=="Y";
$arParams["DISPLAY_BOTTOM_PAGER"] = $arParams["DISPLAY_BOTTOM_PAGER"]!="N";
$arParams["PAGER_TITLE"] = trim($arParams["PAGER_TITLE"]);
$arParams["PAGER_SHOW_ALWAYS"] = $arParams["PAGER_SHOW_ALWAYS"]=="Y";
$arParams["PAGER_TEMPLATE"] = trim($arParams["PAGER_TEMPLATE"]);
$arParams["PAGER_DESC_NUMBERING"] = $arParams["PAGER_DESC_NUMBERING"]=="Y";
$arParams["PAGER_DESC_NUMBERING_CACHE_TIME"] = intval($arParams["PAGER_DESC_NUMBERING_CACHE_TIME"]);
$arParams["PAGER_SHOW_ALL"] = $arParams["PAGER_SHOW_ALL"]=="Y";

if ($arParams['DISPLAY_TOP_PAGER'] || $arParams['DISPLAY_BOTTOM_PAGER'])
{
    $arNavParams = array(
        "nPageSize" => $arParams["PAGE_ELEMENT_COUNT"],
        "bDescPageNumbering" => $arParams["PAGER_DESC_NUMBERING"],
        "bShowAll" => $arParams["PAGER_SHOW_ALL"],
    );
    $arNavigation = CDBResult::GetNavParams($arNavParams);
    if($arNavigation["PAGEN"]==0 && $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"]>0)
        $arParams["CACHE_TIME"] = $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"];
}
else
{
    $arNavParams = array(
        "nTopCount" => $arParams["PAGE_ELEMENT_COUNT"],
        "bDescPageNumbering" => $arParams["PAGER_DESC_NUMBERING"],
    );
    $arNavigation = false;
}

$arParams['CACHE_GROUPS'] = trim($arParams['CACHE_GROUPS']);
if ('N' != $arParams['CACHE_GROUPS'])
    $arParams['CACHE_GROUPS'] = 'Y';

$arParams["CACHE_FILTER"]=$arParams["CACHE_FILTER"]=="Y";
if(!$arParams["CACHE_FILTER"] && count($arrFilter)>0)
    $arParams["CACHE_TIME"] = 0;

$arParams["PRICE_VAT_INCLUDE"] = $arParams["PRICE_VAT_INCLUDE"] !== "N";

$arParams['CONVERT_CURRENCY'] = (isset($arParams['CONVERT_CURRENCY']) && 'Y' == $arParams['CONVERT_CURRENCY'] ? 'Y' : 'N');
$arParams['CURRENCY_ID'] = trim(strval($arParams['CURRENCY_ID']));
if ('' == $arParams['CURRENCY_ID'])
{
    $arParams['CONVERT_CURRENCY'] = 'N';
}
elseif ('N' == $arParams['CONVERT_CURRENCY'])
{
    $arParams['CURRENCY_ID'] = '';
}

$arParams["OFFERS_LIMIT"] = intval($arParams["OFFERS_LIMIT"]);
if (0 > $arParams["OFFERS_LIMIT"])
    $arParams["OFFERS_LIMIT"] = 0;

/*************************************************************************
Processing of the Buy link
 *************************************************************************/
$strError = '';
$successfulAdd = true;

if (isset($_REQUEST[$arParams["ACTION_VARIABLE"]]) && isset($_REQUEST[$arParams["PRODUCT_ID_VARIABLE"]]))
{
    if(isset($_REQUEST[$arParams["ACTION_VARIABLE"]."BUY"]))
        $action = "BUY";
    elseif(isset($_REQUEST[$arParams["ACTION_VARIABLE"]."ADD2BASKET"]))
        $action = "ADD2BASKET";
    else
        $action = strtoupper($_REQUEST[$arParams["ACTION_VARIABLE"]]);

    $productID = (int)$_REQUEST[$arParams["PRODUCT_ID_VARIABLE"]];
    if(($action == "ADD2BASKET" || $action == "BUY" || $action == "SUBSCRIBE_PRODUCT") && $productID > 0)
    {
        if (Loader::includeModule("sale") && Loader::includeModule("catalog"))
        {
            $addByAjax = isset($_REQUEST['ajax_basket']) && 'Y' == $_REQUEST['ajax_basket'];
            $QUANTITY = 0;
            $product_properties = array();
            $intProductIBlockID = (int)CIBlockElement::GetIBlockByID($productID);
            if (0 < $intProductIBlockID)
            {
                if ($arParams['ADD_PROPERTIES_TO_BASKET'] == 'Y')
                {
                    if ($intProductIBlockID == $arParams["IBLOCK_ID"])
                    {
                        if (!empty($arParams["PRODUCT_PROPERTIES"]))
                        {
                            if (
                                isset($_REQUEST[$arParams["PRODUCT_PROPS_VARIABLE"]])
                                && is_array($_REQUEST[$arParams["PRODUCT_PROPS_VARIABLE"]])
                            )
                            {
                                $product_properties = CIBlockPriceTools::CheckProductProperties(
                                    $arParams["IBLOCK_ID"],
                                    $productID,
                                    $arParams["PRODUCT_PROPERTIES"],
                                    $_REQUEST[$arParams["PRODUCT_PROPS_VARIABLE"]],
                                    $arParams['PARTIAL_PRODUCT_PROPERTIES'] == 'Y'
                                );
                                if (!is_array($product_properties))
                                {
                                    $strError = GetMessage("CATALOG_PARTIAL_BASKET_PROPERTIES_ERROR");
                                    $successfulAdd = false;
                                }
                            }
                            else
                            {
                                $strError = GetMessage("CATALOG_EMPTY_BASKET_PROPERTIES_ERROR");
                                $successfulAdd = false;
                            }
                        }
                    }
                    else
                    {
                        $skuAddProps = (isset($_REQUEST['basket_props']) && !empty($_REQUEST['basket_props']) ? $_REQUEST['basket_props'] : '');
                        if (!empty($arParams["OFFERS_CART_PROPERTIES"]) || !empty($skuAddProps))
                        {
                            $product_properties = CIBlockPriceTools::GetOfferProperties(
                                $productID,
                                $arParams["IBLOCK_ID"],
                                $arParams["OFFERS_CART_PROPERTIES"],
                                $skuAddProps
                            );
                        }
                    }
                }
                if ($arParams["USE_PRODUCT_QUANTITY"])
                {
                    if (isset($_REQUEST[$arParams["PRODUCT_QUANTITY_VARIABLE"]]))
                    {
                        $QUANTITY = doubleval($_REQUEST[$arParams["PRODUCT_QUANTITY_VARIABLE"]]);
                    }
                }
                if (0 >= $QUANTITY)
                {
                    $rsRatios = CCatalogMeasureRatio::getList(
                        array(),
                        array('PRODUCT_ID' => $productID),
                        false,
                        false,
                        array('PRODUCT_ID', 'RATIO')
                    );
                    if ($arRatio = $rsRatios->Fetch())
                    {
                        $intRatio = (int)$arRatio['RATIO'];
                        $dblRatio = doubleval($arRatio['RATIO']);
                        $QUANTITY = ($dblRatio > $intRatio ? $dblRatio : $intRatio);
                    }
                }
                if (0 >= $QUANTITY)
                    $QUANTITY = 1;
            }
            else
            {
                $strError = GetMessage('CATALOG_PRODUCT_NOT_FOUND');
                $successfulAdd = false;
            }

            $notifyOption = COption::GetOptionString("sale", "subscribe_prod", "");
            $arNotify = unserialize($notifyOption);
            $arRewriteFields = array();
            if ($action == "SUBSCRIBE_PRODUCT" && $arNotify[SITE_ID]['use'] == 'Y')
            {
                $arRewriteFields["SUBSCRIBE"] = "Y";
                $arRewriteFields["CAN_BUY"] = "N";
            }

            if ($successfulAdd)
            {
                if(!Add2BasketByProductID($productID, $QUANTITY, $arRewriteFields, $product_properties))
                {
                    if ($ex = $APPLICATION->GetException())
                        $strError = $ex->GetString();
                    else
                        $strError = GetMessage("CATALOG_ERROR2BASKET");
                    $successfulAdd = false;
                }
            }

            if ($addByAjax)
            {
                if ($successfulAdd)
                {
                    $addResult = array('STATUS' => 'OK', 'MESSAGE' => GetMessage('CATALOG_SUCCESSFUL_ADD_TO_BASKET'));
                }
                else
                {
                    $addResult = array('STATUS' => 'ERROR', 'MESSAGE' => $strError);
                }
                $APPLICATION->RestartBuffer();
                echo CUtil::PhpToJSObject($addResult);
                die();
            }
            else
            {
                if ($successfulAdd)
                {
                    $pathRedirect = (
                    $action == "BUY"
                        ? $arParams["BASKET_URL"]
                        : $APPLICATION->GetCurPageParam("", array(
                        $arParams["PRODUCT_ID_VARIABLE"],
                        $arParams["ACTION_VARIABLE"],
                        $arParams['PRODUCT_QUANTITY_VARIABLE'],
                        $arParams['PRODUCT_PROPS_VARIABLE']
                    ))
                    );
                    LocalRedirect($pathRedirect);
                }
            }
        }
    }
}

if (!$successfulAdd)
{
    ShowError($strError);
    return;
}

/*************************************************************************
Work with cache
 *************************************************************************/
if($this->StartResultCache(false, array($arrFilter, ($arParams["CACHE_GROUPS"]==="N"? false: $USER->GetGroups()), $arNavigation, $pagerParameters)))
{
    if(!Loader::includeModule("iblock"))
    {
        $this->AbortResultCache();
        ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
        return;
    }

    $arResultModules = array(
        'iblock' => true,
        'catalog' => false,
        'currency' => false
    );

    $arConvertParams = array();
    if ($arParams['CONVERT_CURRENCY'] == 'Y')
    {
        if (!Loader::includeModule('currency'))
        {
            $arParams['CONVERT_CURRENCY'] = 'N';
            $arParams['CURRENCY_ID'] = '';
        }
        else
        {
            $arResultModules['currency'] = true;
            $currencyIterator = CurrencyTable::getList(array(
                'select' => array('CURRENCY'),
                'filter' => array('=CURRENCY' => $arParams['CURRENCY_ID'])
            ));
            if ($currency = $currencyIterator->fetch())
            {
                $arParams['CURRENCY_ID'] = $currency['CURRENCY'];
                $arConvertParams['CURRENCY_ID'] = $currency['CURRENCY'];
            }
            else
            {
                $arParams['CONVERT_CURRENCY'] = 'N';
                $arParams['CURRENCY_ID'] = '';
            }
            unset($currency, $currencyIterator);
        }
    }

    $arSelect = array();
    if(isset($arParams["SECTION_USER_FIELDS"]) && is_array($arParams["SECTION_USER_FIELDS"]))
    {
        foreach($arParams["SECTION_USER_FIELDS"] as $field)
            if(is_string($field) && preg_match("/^UF_/", $field))
                $arSelect[] = $field;
    }
    if(preg_match("/^UF_/", $arParams["META_KEYWORDS"])) $arSelect[] = $arParams["META_KEYWORDS"];
    if(preg_match("/^UF_/", $arParams["META_DESCRIPTION"])) $arSelect[] = $arParams["META_DESCRIPTION"];
    if(preg_match("/^UF_/", $arParams["BROWSER_TITLE"])) $arSelect[] = $arParams["BROWSER_TITLE"];
    if(preg_match("/^UF_/", $arParams["BACKGROUND_IMAGE"])) $arSelect[] = $arParams["BACKGROUND_IMAGE"];

    $arFilter = array(
        "IBLOCK_ID"=>$arParams["IBLOCK_ID"],
        "IBLOCK_ACTIVE"=>"Y",
        "ACTIVE"=>"Y",
        "GLOBAL_ACTIVE"=>"Y",
    );

    $bSectionFound = false;
    //Hidden triky parameter USED to display linked
    //by default it is not set
    if($arParams["BY_LINK"]==="Y")
    {
        $arResult = array(
            "ID" => 0,
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        );
        $bSectionFound = true;
    }
    elseif($arParams["SECTION_ID"] > 0)
    {
        $arFilter["ID"]=$arParams["SECTION_ID"];
        $rsSection = CIBlockSection::GetList(array(), $arFilter, false, $arSelect);
        $rsSection->SetUrlTemplates("", $arParams["SECTION_URL"]);
        $arResult = $rsSection->GetNext();
        if($arResult)
            $bSectionFound = true;
    }
    elseif(strlen($arParams["SECTION_CODE"]) > 0)
    {
        $arFilter["=CODE"]=$arParams["SECTION_CODE"];
        $rsSection = CIBlockSection::GetList(array(), $arFilter, false, $arSelect);
        $rsSection->SetUrlTemplates("", $arParams["SECTION_URL"]);
        $arResult = $rsSection->GetNext();
        if($arResult)
            $bSectionFound = true;
    }
    elseif(strlen($arParams["SECTION_CODE_PATH"]) > 0)
    {
        $sectionId = CIBlockFindTools::GetSectionIDByCodePath($arParams["IBLOCK_ID"], $arParams["SECTION_CODE_PATH"]);
        if ($sectionId)
        {
            $arFilter["ID"]=$sectionId;
            $rsSection = CIBlockSection::GetList(array(), $arFilter, false, $arSelect);
            $rsSection->SetUrlTemplates("", $arParams["SECTION_URL"]);
            $arResult = $rsSection->GetNext();
            if($arResult)
                $bSectionFound = true;
        }
    }
    else
    {
        //Root section (no section filter)
        $arResult = array(
            "ID" => 0,
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        );
        $bSectionFound = true;
    }


    if ($arResult["ID"] > 0)
    {
        $ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues($arResult["IBLOCK_ID"], $arResult["ID"]);
        $arResult["IPROPERTY_VALUES"] = $ipropValues->getValues();
    }
    else
    {
        $arResult["IPROPERTY_VALUES"] = array();
    }

    $bGetPropertyCodes = !empty($arParams["PROPERTY_CODE"]);
    $bGetProductProperties = ($arParams['ADD_PROPERTIES_TO_BASKET'] == 'Y'  && !empty($arParams["PRODUCT_PROPERTIES"]));
    $bGetProperties = $bGetPropertyCodes || $bGetProductProperties;

    // list of the element fields that will be used in selection
    $arSelect = array(
        "ID",
        "IBLOCK_ID",
        "CODE",
        "XML_ID",
        "NAME",
        "ACTIVE",
        "DATE_ACTIVE_FROM",
        "DATE_ACTIVE_TO",
        "SORT",
        "PREVIEW_TEXT",
        "PREVIEW_TEXT_TYPE",
        "DETAIL_TEXT",
        "DETAIL_TEXT_TYPE",
        "DATE_CREATE",
        "CREATED_BY",
        "TIMESTAMP_X",
        "MODIFIED_BY",
        "TAGS",
        "IBLOCK_SECTION_ID",
        "DETAIL_PAGE_URL",
        "DETAIL_PICTURE",
        "PREVIEW_PICTURE"
    );
    if ($bIBlockCatalog)
        $arSelect[] = "CATALOG_QUANTITY";
    $arFilter = array(
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "IBLOCK_LID" => SITE_ID,
        "IBLOCK_ACTIVE" => "Y",
        "ACTIVE_DATE" => "Y",
        "ACTIVE" => "Y",
        "CHECK_PERMISSIONS" => "Y",
        "MIN_PERMISSION" => "R",
        "INCLUDE_SUBSECTIONS" => ($arParams["INCLUDE_SUBSECTIONS"] == 'N' ? 'N' : 'Y'),
    );
    if ($arParams["INCLUDE_SUBSECTIONS"] == 'A')
        $arFilter["SECTION_GLOBAL_ACTIVE"] = "Y";
    if ($bIBlockCatalog && 'Y' == $arParams['HIDE_NOT_AVAILABLE'])
        $arFilter['CATALOG_AVAILABLE'] = 'Y';

    if($arParams["BY_LINK"]!=="Y")
    {
        if($arResult["ID"])
            $arFilter["SECTION_ID"] = $arResult["ID"];
        elseif(!$arParams["SHOW_ALL_WO_SECTION"])
            $arFilter["SECTION_ID"] = 0;
        else
        {
            if (is_set($arFilter, 'INCLUDE_SUBSECTIONS'))
                unset($arFilter["INCLUDE_SUBSECTIONS"]);
            if (is_set($arFilter, 'SECTION_GLOBAL_ACTIVE'))
                unset($arFilter["SECTION_GLOBAL_ACTIVE"]);
        }
    }



    $arSort = array(
        $arParams["ELEMENT_SORT_FIELD"] => $arParams["ELEMENT_SORT_ORDER"],
        $arParams["ELEMENT_SORT_FIELD2"] => $arParams["ELEMENT_SORT_ORDER2"],
    );

    $arDefaultMeasure = array();
    if ($bIBlockCatalog)
        $arDefaultMeasure = CCatalogMeasure::getDefaultMeasure(true, true);
    $currencyList = array();
    $arSections = array();

    //EXECUTE
    if($arParams["GROUP_BY"])
        $arGroupBy = array($arParams["GROUP_BY"]);
    $rsElements = CIBlockElement::GetList(array($arParams["GROUP_BY"] => "ASC"), array_merge($arrFilter, $arFilter), $arGroupBy, $arNavParams, $arSelect);
    $rsElements->SetUrlTemplates($arParams["DETAIL_URL"]);
    if(
        $arParams["BY_LINK"]!=="Y"
        && !$arParams["SHOW_ALL_WO_SECTION"]
        && !$arParams["USE_MAIN_ELEMENT_SECTION"]
    )
    {
        $rsElements->SetSectionContext($arResult);
    }
    $totalCount = 0;
    $arResult["ITEMS"] = array();
    $arElementLink = array();
    $intKey = 0;
    while($rsItem = $rsElements->GetNextElement())
    {
        $arItem = $rsItem->GetFields();
        $arResult["ITEMS"][$arItem["IBLOCK_SECTION_ID"]] = $arItem;
        $totalCount = $totalCount + $arItem["CNT"];

    }
    $arResult["TOTAL_COUNT"] = $totalCount;
    if (isset($arItem))
        unset($arItem);

    $this->SetResultCacheKeys(array(
        "ID",
        "NAV_CACHED_DATA",
        $arParams["META_KEYWORDS"],
        $arParams["META_DESCRIPTION"],
        $arParams["BROWSER_TITLE"],
        "NAME",
        "PATH",
        "IBLOCK_SECTION_ID"
    ));
}


if($arParams["SET_TITLE"])
{
    if ($arResult["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"] != "")
        $APPLICATION->SetTitle($arResult["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"], $arTitleOptions);
    elseif(isset($arResult["NAME"]))
        $APPLICATION->SetTitle($arResult["NAME"], $arTitleOptions);
}

if ($arParams["SET_BROWSER_TITLE"] === 'Y')
{
    $browserTitle = \Bitrix\Main\Type\Collection::firstNotEmpty(
        $arResult, $arParams["BROWSER_TITLE"]
        ,$arResult["IPROPERTY_VALUES"], "SECTION_META_TITLE"
    );
    if (is_array($browserTitle))
        $APPLICATION->SetPageProperty("title", implode(" ", $browserTitle), $arTitleOptions);
    elseif ($browserTitle != "")
        $APPLICATION->SetPageProperty("title", $browserTitle, $arTitleOptions);
}

if ($arParams["SET_META_KEYWORDS"] === 'Y')
{
    $metaKeywords = \Bitrix\Main\Type\Collection::firstNotEmpty(
        $arResult, $arParams["META_KEYWORDS"]
        ,$arResult["IPROPERTY_VALUES"], "SECTION_META_KEYWORDS"
    );
    if (is_array($metaKeywords))
        $APPLICATION->SetPageProperty("keywords", implode(" ", $metaKeywords), $arTitleOptions);
    elseif ($metaKeywords != "")
        $APPLICATION->SetPageProperty("keywords", $metaKeywords, $arTitleOptions);
}

if ($arParams["SET_META_DESCRIPTION"] === 'Y')
{
    $metaDescription = \Bitrix\Main\Type\Collection::firstNotEmpty(
        $arResult, $arParams["META_DESCRIPTION"]
        ,$arResult["IPROPERTY_VALUES"], "SECTION_META_DESCRIPTION"
    );
    if (is_array($metaDescription))
        $APPLICATION->SetPageProperty("description", implode(" ", $metaDescription), $arTitleOptions);
    elseif ($metaDescription != "")
        $APPLICATION->SetPageProperty("description", $metaDescription, $arTitleOptions);
}


if ($arParams["ADD_SECTIONS_CHAIN"] && isset($arResult["PATH"]) && is_array($arResult["PATH"]))
{
    foreach($arResult["PATH"] as $arPath)
    {
        if ($arPath["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"] != "")
            $APPLICATION->AddChainItem($arPath["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"], $arPath["~SECTION_PAGE_URL"]);
        else
            $APPLICATION->AddChainItem($arPath["NAME"], $arPath["~SECTION_PAGE_URL"]);
    }
}

return $arResult;