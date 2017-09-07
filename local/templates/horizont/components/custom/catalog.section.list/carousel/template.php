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


$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));


if (0 < $arResult["SECTIONS_COUNT"]) {
?>
<div class="dark-control owl-carousel owl-theme">
<?
    foreach ($arResult['SECTIONS'] as &$arSection){
        $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
        $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
        ?>
    <div class="item" id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
        <a href="<? echo $arSection['SECTION_PAGE_URL']; ?>" class="thumb">
            <?if($arSection['PICTURE']['SRC']){
                $file = CFile::ResizeImageGet($arSection['PICTURE']['ID'], array('width'=>283, 'height'=>178), BX_RESIZE_IMAGE_EXACT, true);
                $img = '<img src="'.$file['src'].'" width="'.$file['width'].'" height="'.$file['height'].'" />';
                ?>
                <?=$img?>
            <?}?>
        </a>
        <div class="carousel-content">
            <h4><?=$arSection['NAME']; ?></h4>
            <?if($arSection["UF_METRO"]){?>
                <div class="loc-metro">
                    <?foreach($arSection["METRO"] as $val){?><?=getColoredIcon($val)?><?}?>
                    <?=$arSection["UF_METRO"]?>
                </div>
            <?}?>
            <?if($arSection["MIN_PRICE"]){?><p>от <?=number_format($arSection["MIN_PRICE"], "0", ".", " ")?> руб.</p><?}?>
        </div>
    </div>
        <?}?>
</div>
<?}?>