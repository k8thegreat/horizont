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


$elementEdit = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT');
$elementDelete = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE');
$elementDeleteParams = array('CONFIRM' => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));

if (!empty($arResult['ITEMS'])){?>

<div class="control-builders">
    <div id="tabs">
    <div class="nav-builders">
            <ul>
                <?foreach ($arResult["ITEMS"] as $arSection){?>
                <li class="btn btn-border"><a href="#tabs-<?=$arSection["ID"]?>"><?=$arSection["NAME"]?></a></li>
                <?}?>
            </ul>
        </div>
    <div class="control-builders-content">
        <h2 class="title-big cursive-title-right">ход строительства<span class="title-top"><span class="dop-title">Ретроспектива</span></span></h2>
        <?
        foreach ($arResult["ITEMS"] as $arSection){?>
        <div id="tabs-<?=$arSection["ID"]?>">
            <div class="dark-control owl-carousel owl-theme">
                <?
                if($arSection["PROPERTIES"]["MORE_PHOTO"]["VALUE"]) {

                    foreach ($arSection["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $k => $val) {

                        ?>
                        <div class="item">
                            <a data-fancybox="history-images" data-caption="<?= $arSection["PROPERTIES"]["MORE_PHOTO"]["DESCRIPTION"][$k] ?>" class="thumb"
                               href="<?= CFile::GetPath($val) ?>">
                                <?
                                    $file = CFile::ResizeImageGet($val, array('width' => 283, 'height' => 178), BX_RESIZE_IMAGE_EXACT, true);
                                    $img = '<img src="' . $file['src'] . '" width="' . $file['width'] . '" height="' . $file['height'] . '" />';
                                ?>
                                <?=$img?>
                            </a>
                            <div class="carousel-content">
                                <h4><?=$arSection["PROPERTIES"]["MORE_PHOTO"]["DESCRIPTION"][$k]?></h4>
                            </div>
                        </div>
                    <?
                    }
                }?>
            </div>
        </div>
        <?}?>
    </div>
    </div>
</div>
<?}?>


