<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 */

$this->setFrameMode(true);


if (!empty($arResult['NAV_RESULT']))
{
	$navParams =  array(
		'NavPageCount' => $arResult['NAV_RESULT']->NavPageCount,
		'NavPageNomer' => $arResult['NAV_RESULT']->NavPageNomer,
		'NavNum' => $arResult['NAV_RESULT']->NavNum
	);
}
else
{
	$navParams = array(
		'NavPageCount' => 1,
		'NavPageNomer' => 1,
		'NavNum' => $this->randString()
	);
}

$showTopPager = false;
$showBottomPager = false;
$showLazyLoad = false;

if ($arParams['PAGE_ELEMENT_COUNT'] > 0 && $navParams['NavPageCount'] > 1)
{
	$showTopPager = $arParams['DISPLAY_TOP_PAGER'];
	$showBottomPager = $arParams['DISPLAY_BOTTOM_PAGER'];
	}


$elementEdit = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT');
$elementDelete = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE');
$elementDeleteParams = array('CONFIRM' => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));

$obName = 'ob'.preg_replace('/[^a-zA-Z0-9_]/', 'x', $this->GetEditAreaId($navParams['NavNum']));
$containerName = 'container-'.$navParams['NavNum'];


?>

<div class="catalog-section bx-<?=$arParams['TEMPLATE_THEME']?>" data-entity="<?=$containerName?>">
	<?
	if (!empty($arResult['ITEMS']))
	{
		$areaIds = array();

		foreach ($arResult['ITEMS'] as $item)
		{
			$uniqueId = $item['ID'].'_'.md5($this->randString().$component->getAction());
			$areaIds[$item['ID']] = $this->GetEditAreaId($uniqueId);
			$this->AddEditAction($uniqueId, $item['EDIT_LINK'], $elementEdit);
			$this->AddDeleteAction($uniqueId, $item['DELETE_LINK'], $elementDelete, $elementDeleteParams);
		}
		?>
		<div class="table-wrapper">
<table class="table table-trade table-border">
    <thead>
    <tr>
        <th><?=$arResult["ITEMS"][0]["PROPERTIES"]["rayon"]["NAME"]?></th>
        <th><?=$arResult["ITEMS"][0]["PROPERTIES"]["metro"]["NAME"]?></th>
        <th><?=$arResult["ITEMS"][0]["PROPERTIES"]["gk"]["NAME"]?></th>
        <th><?=$arResult["ITEMS"][0]["PROPERTIES"]["builder"]["NAME"]?></th>
        <th><?=$arResult["ITEMS"][0]["PROPERTIES"]["deadline"]["NAME"]?></th>
        <th><?=$arResult["ITEMS"][0]["PROPERTIES"]["corpus"]["NAME"]?></th>
        <th><?=$arResult["ITEMS"][0]["PROPERTIES"]["rooms"]["NAME"]?></th>
        <th><?=$arResult["ITEMS"][0]["PROPERTIES"]["sGeneral"]["NAME"]?></th>
        <?/*<th>S кухни, м²</th>*/?>
        <th><?=$arResult["ITEMS"][0]["PROPERTIES"]["price"]["NAME"]?></th>
        <th><?=$arResult["ITEMS"][0]["PROPERTIES"]["otdelka"]["NAME"]?></th>
        <th><?=$arResult["ITEMS"][0]["PROPERTIES"]["floor"]["NAME"]?></th>
        <th>ID</th>
    </tr>
    <tr class="row-blue">
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>

    </tr>
    </thead>
    <tbody>
		<?
		foreach ($arResult['ITEMS'] as $arItem)
		{?>
            <tr id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <td><?=$arItem["PROPERTIES"]["rayon"]["VALUE"]?></td>
                <td><?=$arItem["PROPERTIES"]["metro"]["VALUE"]?></td>
                <td><?=$arItem["PROPERTIES"]["gk"]["VALUE"]?></td>
                <td><?=$arItem["PROPERTIES"]["builder"]["VALUE"]?></td>
                <td><?=$arItem["PROPERTIES"]["deadline"]["VALUE"]?></td>
                <td><?=$arItem["PROPERTIES"]["corpus"]["VALUE"]?></td>
                <td><?=$arItem["PROPERTIES"]["rooms"]["VALUE"]?></td>
                <td><?=$arItem["PROPERTIES"]["sGeneral"]["VALUE"]?></td>
                <?/*<td>10,2</td>*/?>
                <td><?=number_format($arItem["PROPERTIES"]["price"]["VALUE"],0,".", " ")?></td>
                <td><?=$arItem["PROPERTIES"]["otdelka"]["VALUE"]?></td>
                <td><?=$arItem["PROPERTIES"]["floor"]["VALUE"]?></td>
                <td><a class="apart-modal" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></td>
            </tr>
	    <?}?>
    </tbody>
</table>
        </div>
		<?
	}
	?>
</div>
<?

if ($showBottomPager)
{
	?>
	<div data-pagination-num="<?=$navParams['NavNum']?>">
		<!-- pagination-container -->
		<?=$arResult['NAV_STRING']?>
		<!-- pagination-container -->
	</div>
	<?
}

?>
<?php
if($arResult["ITEMS"]){?>
    <script type="text/javascript">
        document.getElementById("modef_num").innerText = "<?=$arResult["NAV_RESULT"]->NavRecordCount?>";
    </script><?}
