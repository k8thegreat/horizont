<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<?if($arResult["ITEMS"]){?>
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
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
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
            <td><?=$arItem["PROPERTIES"]["price"]["VALUE"]?></td>
            <td><?=$arItem["PROPERTIES"]["otdelka"]["VALUE"]?></td>
            <td><?=$arItem["PROPERTIES"]["floor"]["VALUE"]?></td>
            <td><a class="apart-modal" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></td>
        </tr>
<?endforeach;?>
    </tbody>
</table>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
<?}?>

