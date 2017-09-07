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
<div class="list-partner">
    <div class="list-partner-title">
        <div>Наименование банка</div>
        <div>Количество ипотечных программ</div>
        <div>Минимальная ставка по кредиту (%)</div>
    </div>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
    <div class="list-partner-group" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <div class="list-partner-group-title">
            <div><?if($arItem["PREVIEW_PICTURE"]){
                $file = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], array('width'=>160, 'height'=>100), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                ?><img src="<?=$file["src"]?>" alt="<?=$arItem["NAME"]?>"/><?}?></div>
            <div><?=$arItem["NAME"]?></div>
            <div><?=$arItem["PROPERTIES"]["PROGRAMS_COUNT"]["VALUE"]?></div>
            <div><?=$arItem["PROPERTIES"]["RATE"]["VALUE"]?></div>

            <div>
                <button class="btn-drop-table">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" class="btn-drop-table-ico"
                         xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         viewBox="0 0 49.656 49.656" xml:space="preserve">
                                <g>
                                    <polygon
                                            points="1.414,14.535 4.242,11.707 24.828,32.292 45.414,11.707 48.242,14.535 24.828,37.95"/>
                                    <path d="M24.828,39.364L0,14.536l4.242-4.242l20.586,20.585l20.586-20.586l4.242,4.242L24.828,39.364zM2.828,14.536l22,22l22-22.001l-1.414-1.414L24.828,33.707L4.242,13.122L2.828,14.536z"/>
                                </g>
                            </svg>
                </button>
            </div>
        </div>
        <div class="list-partner-group-description">
            <p><?=$arItem["PREVIEW_TEXT"]?></p>
            <div class="wrap-table">

                <?=$arItem["PROPERTIES"]["PROGRAMS"]["~VALUE"]["TEXT"]?>
            </div>
        </div>
    </div>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
