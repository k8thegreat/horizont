<?
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


/*************************************************************************
	Processing of received parameters
*************************************************************************/
if(!isset($arParams["CACHE_TIME"]))
	$arParams["CACHE_TIME"] = 36000000;

$arParams["IBLOCK_TYPE"] = trim($arParams["IBLOCK_TYPE"]);
$arParams["IBLOCK_ID"] = intval($arParams["IBLOCK_ID"]);
$arParams["SECTION_ID"] = intval($arParams["SECTION_ID"]);
$arParams["SECTION_CODE"] = trim($arParams["SECTION_CODE"]);

$arParams["SECTION_URL"]=trim($arParams["SECTION_URL"]);

$arParams["TOP_DEPTH"] = intval($arParams["TOP_DEPTH"]);
if($arParams["TOP_DEPTH"] <= 0)
	$arParams["TOP_DEPTH"] = 2;
$arParams["COUNT_ELEMENTS"] = $arParams["COUNT_ELEMENTS"]!="N";
$arParams["ADD_SECTIONS_CHAIN"] = $arParams["ADD_SECTIONS_CHAIN"]!="N"; //Turn on by default

$arResult["SECTIONS"]=array();

if(strlen($arParams["FILTER_NAME"])<=0 || !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["FILTER_NAME"]))
{
	$arrFilter = array();
}
else
{
	$arrFilter = $GLOBALS[$arParams["FILTER_NAME"]];
	if(!is_array($arrFilter))
		$arrFilter = array();
}
$arParams["ITEMS_COUNT"] = intval($arParams["ITEMS_COUNT"]);
if($arParams["ITEMS_COUNT"]<=0)
    $arParams["ITEMS_COUNT"] = 20;
$arParams["SORT_BY1"] = trim($arParams["SORT_BY1"]);
if(strlen($arParams["SORT_BY1"])<=0)
    $arParams["SORT_BY1"] = "SORT";
if(!preg_match('/^(asc|desc|nulls)(,asc|,desc|,nulls){0,1}$/i', $arParams["SORT_ORDER1"]))
    $arParams["SORT_ORDER1"]="ASC";

if(strlen($arParams["SORT_BY2"])<=0)
    $arParams["SORT_BY2"] = "NAME";
if(!preg_match('/^(asc|desc|nulls)(,asc|,desc|,nulls){0,1}$/i', $arParams["SORT_ORDER2"]))
    $arParams["SORT_ORDER2"]="ASC";
$arParams["DISPLAY_TOP_PAGER"] = $arParams["DISPLAY_TOP_PAGER"]=="Y";
$arParams["DISPLAY_BOTTOM_PAGER"] = $arParams["DISPLAY_BOTTOM_PAGER"]!="N";
$arParams["PAGER_TITLE"] = trim($arParams["PAGER_TITLE"]);
$arParams["PAGER_SHOW_ALWAYS"] = $arParams["PAGER_SHOW_ALWAYS"]=="Y";
$arParams["PAGER_TEMPLATE"] = trim($arParams["PAGER_TEMPLATE"]);
$arParams["PAGER_DESC_NUMBERING"] = $arParams["PAGER_DESC_NUMBERING"]=="Y";
$arParams["PAGER_DESC_NUMBERING_CACHE_TIME"] = intval($arParams["PAGER_DESC_NUMBERING_CACHE_TIME"]);
$arParams["PAGER_SHOW_ALL"] = $arParams["PAGER_SHOW_ALL"]=="Y";

if($arParams["DISPLAY_TOP_PAGER"] || $arParams["DISPLAY_BOTTOM_PAGER"])
{
    $arNavParams = array(
        "nPageSize" => $arParams["ITEMS_COUNT"],
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
        "nTopCount" => $arParams["ITEMS_COUNT"],
        "bDescPageNumbering" => $arParams["PAGER_DESC_NUMBERING"],
    );
    $arNavigation = false;
}
/*************************************************************************
			Work with cache
*************************************************************************/
if($this->StartResultCache(false, ($arParams["CACHE_GROUPS"]==="N"? false: $USER->GetGroups())))
{
	if(!\Bitrix\Main\Loader::includeModule("iblock"))
	{
		$this->AbortResultCache();
		ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
		return;
	}
	$arFilter = array(
		"ACTIVE" => "Y",
		"GLOBAL_ACTIVE" => "Y",
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"CNT_ACTIVE" => "Y",
	);

	$arSelect = array();
	if(array_key_exists("SECTION_FIELDS", $arParams) && !empty($arParams["SECTION_FIELDS"]) && is_array($arParams["SECTION_FIELDS"]))
	{
		foreach($arParams["SECTION_FIELDS"] as &$field)
		{
			if (!empty($field) && is_string($field))
				$arSelect[] = $field;
		}
		if (isset($field))
			unset($field);
	}

	if(!empty($arSelect))
	{
		$arSelect[] = "ID";
		$arSelect[] = "NAME";
		$arSelect[] = "LEFT_MARGIN";
		$arSelect[] = "RIGHT_MARGIN";
		$arSelect[] = "DEPTH_LEVEL";
		$arSelect[] = "IBLOCK_ID";
		$arSelect[] = "IBLOCK_SECTION_ID";
		$arSelect[] = "LIST_PAGE_URL";
		$arSelect[] = "SECTION_PAGE_URL";
	}
	$boolPicture = empty($arSelect) || in_array('PICTURE', $arSelect);

	if(isset($arParams['SECTION_USER_FIELDS']) && !empty($arParams["SECTION_USER_FIELDS"]) && is_array($arParams["SECTION_USER_FIELDS"]))
	{
		foreach($arParams["SECTION_USER_FIELDS"] as &$field)
		{
			if(is_string($field) && preg_match("/^UF_/", $field))
				$arSelect[] = $field;
		}
		if (isset($field))
			unset($field);
	}

	$arResult["SECTION"] = false;
	$intSectionDepth = 0;
	if($arParams["SECTION_ID"]>0)
	{
		$arFilter["ID"] = $arParams["SECTION_ID"];
		$rsSections = CIBlockSection::GetList(array(), $arFilter, $arParams["COUNT_ELEMENTS"], $arSelect);
		$rsSections->SetUrlTemplates("", $arParams["SECTION_URL"]);
		$arResult["SECTION"] = $rsSections->GetNext();
	}
	elseif('' != $arParams["SECTION_CODE"])
	{
		$arFilter["=CODE"] = $arParams["SECTION_CODE"];
		$rsSections = CIBlockSection::GetList(array(), $arFilter, $arParams["COUNT_ELEMENTS"], $arSelect);
		$rsSections->SetUrlTemplates("", $arParams["SECTION_URL"]);
		$arResult["SECTION"] = $rsSections->GetNext();
	}

	if(is_array($arResult["SECTION"]))
	{
		unset($arFilter["ID"]);
		unset($arFilter["=CODE"]);
		$arFilter["LEFT_MARGIN"]=$arResult["SECTION"]["LEFT_MARGIN"]+1;
		$arFilter["RIGHT_MARGIN"]=$arResult["SECTION"]["RIGHT_MARGIN"];
		$arFilter["<="."DEPTH_LEVEL"]=$arResult["SECTION"]["DEPTH_LEVEL"] + $arParams["TOP_DEPTH"];

		$ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues($arResult["SECTION"]["IBLOCK_ID"], $arResult["SECTION"]["ID"]);
		$arResult["SECTION"]["IPROPERTY_VALUES"] = $ipropValues->getValues();

		$arResult["SECTION"]["PATH"] = array();
		$rsPath = CIBlockSection::GetNavChain($arResult["SECTION"]["IBLOCK_ID"], $arResult["SECTION"]["ID"]);
		$rsPath->SetUrlTemplates("", $arParams["SECTION_URL"]);
		while($arPath = $rsPath->GetNext())
		{
			$ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues($arParams["IBLOCK_ID"], $arPath["ID"]);
			$arPath["IPROPERTY_VALUES"] = $ipropValues->getValues();
			$arResult["SECTION"]["PATH"][]=$arPath;
		}
	}
	else
	{
		$arResult["SECTION"] = array("ID"=>0, "DEPTH_LEVEL"=>0);
		$arFilter["<="."DEPTH_LEVEL"] = $arParams["TOP_DEPTH"];
	}
	$intSectionDepth = $arResult["SECTION"]['DEPTH_LEVEL'];

	//ORDER BY
    $arSort = array(
        $arParams["SORT_BY1"]=>$arParams["SORT_ORDER1"],
        $arParams["SORT_BY2"]=>$arParams["SORT_ORDER2"],
    );
	//EXECUTE

	$rsSections = CIBlockSection::GetList($arSort, array_merge($arFilter, $arrFilter), $arParams["COUNT_ELEMENTS"], $arSelect, $arNavParams);
	$rsSections->SetUrlTemplates("", $arParams["SECTION_URL"]);
	while($arSection = $rsSections->GetNext())
	{
		$ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues($arSection["IBLOCK_ID"], $arSection["ID"]);
		$arSection["IPROPERTY_VALUES"] = $ipropValues->getValues();

		if ($boolPicture)
		{
			$mxPicture = false;
			$arSection["PICTURE"] = intval($arSection["PICTURE"]);
			if (0 < $arSection["PICTURE"])
				$mxPicture = CFile::GetFileArray($arSection["PICTURE"]);
			$arSection["PICTURE"] = $mxPicture;
			if ($arSection["PICTURE"])
			{
				$arSection["PICTURE"]["ALT"] = $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"];
				if ($arSection["PICTURE"]["ALT"] == "")
					$arSection["PICTURE"]["ALT"] = $arSection["NAME"];
				$arSection["PICTURE"]["TITLE"] = $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"];
				if ($arSection["PICTURE"]["TITLE"] == "")
					$arSection["PICTURE"]["TITLE"] = $arSection["NAME"];
			}
		}
		$arSection['RELATIVE_DEPTH_LEVEL'] = $arSection['DEPTH_LEVEL'] - $intSectionDepth;

		$arButtons = CIBlock::GetPanelButtons(
			$arSection["IBLOCK_ID"],
			0,
			$arSection["ID"],
			array("SESSID"=>false, "CATALOG"=>true)
		);
		$arSection["EDIT_LINK"] = $arButtons["edit"]["edit_section"]["ACTION_URL"];
		$arSection["DELETE_LINK"] = $arButtons["edit"]["delete_section"]["ACTION_URL"];

		$arResult["SECTIONS"][]=$arSection;
	}
    $navComponentParameters = array();
    if ($arParams["PAGER_BASE_LINK_ENABLE"] === "Y")
    {
        $pagerBaseLink = trim($arParams["PAGER_BASE_LINK"]);
        if ($pagerBaseLink === "")
        {
            if (
                $arResult["SECTION"]
                && $arResult["SECTION"]["PATH"]
                && $arResult["SECTION"]["PATH"][0]
                && $arResult["SECTION"]["PATH"][0]["~SECTION_PAGE_URL"]
            )
            {
                $pagerBaseLink = $arResult["SECTION"]["PATH"][0]["~SECTION_PAGE_URL"];
            }
            elseif (
                isset($arItem) && isset($arSection["~LIST_PAGE_URL"])
            )
            {
                $pagerBaseLink = $arSection["~LIST_PAGE_URL"];
            }
        }

        if ($pagerParameters && isset($pagerParameters["BASE_LINK"]))
        {
            $pagerBaseLink = $pagerParameters["BASE_LINK"];
            unset($pagerParameters["BASE_LINK"]);
        }

        $navComponentParameters["BASE_LINK"] = CHTTP::urlAddParams($pagerBaseLink, $pagerParameters, array("encode"=>true));
    }

    $arResult["NAV_STRING"] = $rsSections->GetPageNavStringEx(
        $navComponentObject,
        $arParams["PAGER_TITLE"],
        $arParams["PAGER_TEMPLATE"],
        $arParams["PAGER_SHOW_ALWAYS"],
        $this,
        $navComponentParameters
    );
    $arResult["NAV_CACHED_DATA"] = null;
    $arResult["NAV_RESULT"] = $rsElement;
    $arResult["NAV_PARAM"] = $navComponentParameters;

    $arResult["SECTIONS_COUNT"] = count($arResult["SECTIONS"]);

	$this->SetResultCacheKeys(array(
		"SECTIONS_COUNT",
		"SECTION",
        "NAV_CACHED_DATA",
	));

	$this->IncludeComponentTemplate();
}

if($arResult["SECTIONS_COUNT"] > 0 || isset($arResult["SECTION"]))
{
	if(
		$USER->IsAuthorized()
		&& $APPLICATION->GetShowIncludeAreas()
		&& \Bitrix\Main\Loader::includeModule("iblock")
	)
	{
		$UrlDeleteSectionButton = "";
		if(isset($arResult["SECTION"]) && $arResult["SECTION"]['IBLOCK_SECTION_ID'] > 0)
		{
			$rsSection = CIBlockSection::GetList(
				array(),
				array("=ID" => $arResult["SECTION"]['IBLOCK_SECTION_ID']),
				false,
				array("SECTION_PAGE_URL")
			);
			$rsSection->SetUrlTemplates("", $arParams["SECTION_URL"]);
			$arSection = $rsSection->GetNext();
			$UrlDeleteSectionButton = $arSection["SECTION_PAGE_URL"];
		}

		if(empty($UrlDeleteSectionButton))
		{
			$url_template = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "LIST_PAGE_URL");
			$arIBlock = CIBlock::GetArrayByID($arParams["IBLOCK_ID"]);
			$arIBlock["IBLOCK_CODE"] = $arIBlock["CODE"];
			$UrlDeleteSectionButton = CIBlock::ReplaceDetailURL($url_template, $arIBlock, true, false);
		}

		$arReturnUrl = array(
			"add_section" => (
				'' != $arParams["SECTION_URL"]?
				$arParams["SECTION_URL"]:
				CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_PAGE_URL")
			),
			"add_element" => (
				'' != $arParams["SECTION_URL"]?
				$arParams["SECTION_URL"]:
				CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_PAGE_URL")
			),
			"delete_section" => $UrlDeleteSectionButton,
		);
		$arButtons = CIBlock::GetPanelButtons(
			$arParams["IBLOCK_ID"],
			0,
			$arResult["SECTION"]["ID"],
			array("RETURN_URL" =>  $arReturnUrl, "CATALOG"=>true)
		);

		$this->AddIncludeAreaIcons(CIBlock::GetComponentMenu($APPLICATION->GetPublicShowMode(), $arButtons));
	}

	if($arParams["ADD_SECTIONS_CHAIN"] && isset($arResult["SECTION"]) && is_array($arResult["SECTION"]["PATH"]))
	{
		foreach($arResult["SECTION"]["PATH"] as $arPath)
		{
			if (isset($arPath["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]) && $arPath["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"] != "")
				$APPLICATION->AddChainItem($arPath["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"], $arPath["~SECTION_PAGE_URL"]);
			else
				$APPLICATION->AddChainItem($arPath["NAME"], $arPath["~SECTION_PAGE_URL"]);
		}
	}
}
?>