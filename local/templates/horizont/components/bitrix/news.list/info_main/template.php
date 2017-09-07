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
<div class="info-block">
<?foreach($arResult["ITEMS"] as $k => $arItem):?>
	<?
    switch ($k){
        case 0:
            $class="info-left-content";
            break;
        case 1:
            $class="info-top";
            break;
        case 2:
            $class="info-bottom-left";
            break;
        case 3:
            $class="info-bottom-right";
            break;
    }
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
    <?if($k==0){?>
    <div class="info-left">
        <?}?>
    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="<?=$class?>" <?if($arItem["PREVIEW_PICTURE"]){?>style="background-image:url(<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>);"<?}?> id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <h4 class="info-title"><?=$arItem["NAME"]?></h4>
        <p class="info-des"><?=$arItem["PREVIEW_TEXT"]?></p>
        <span class="info-date"><?=$arItem["DISPLAY_ACTIVE_FROM"]?></span>
	</a>
    <?if($k==0){?>
        </div>
        <div class="info-right">
    <?}?>
<?endforeach;?>
     </div>
</div>
