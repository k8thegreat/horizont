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
<div class="list-card">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
    <div id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="one-card">
            <div class="thumb">
                <?
                if($arItem["PREVIEW_PICTURE"]["ID"]){

                $file = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], array('width'=>300, 'height'=>500), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                $img = '<img src="'.$file['src'].'" width="'.$file['width'].'" height="'.$file['height'].'" />';

                ?>
                <?=$img?>
                <?}?>
            </div>
            <div class="card-content">
                <h3 class="card-title"><?=$arItem["NAME"]?></h3>
                <p><?=$arItem["PREVIEW_TEXT"]?></p>
            </div>
        </a>
    </div>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
