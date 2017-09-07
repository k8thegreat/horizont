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
<div class="list-card one-el">
    <div>
        <div class="one-card">
            <div class="thumb">
                <?
                if($arResult["PREVIEW_PICTURE"]["ID"]){

                    $file = CFile::ResizeImageGet($arResult["PREVIEW_PICTURE"]["ID"], array('width'=>165, 'height'=>500), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                    $img = '<img src="'.$file['src'].'" width="'.$file['width'].'" height="'.$file['height'].'" />';

                    ?>
                    <?=$img?>
                <?}?>

            </div>
            <div class="card-content">
                <h3 class="card-title"><?=$arResult["NAME"]?></h3>
                <p><?=$arResult["PREVIEW_TEXT"];?>
                </p>
            </div>
        </div>
    </div>
</div>
