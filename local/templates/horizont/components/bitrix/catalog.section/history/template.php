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
                <?foreach ($arResult["CATEGORY"] as $year => $arItem){?>
                <li><a href="#tabs-<?=$year?>" class="btn btn-border"><?=$year?></a></li>
                <?}?>
            </ul>
        </div>
    <div class="control-builders-content">
        <h2 class="title-big cursive-title-right">ход строительства<span class="title-top"><span class="dop-title">Ретроспектива</span></span></h2>
        <?foreach ($arResult["CATEGORY"] as $year => $arItems){?>
        <div id="tabs-<?=$year?>">
            <div class="dark-control owl-carousel owl-theme">
                <?foreach ($arItems as $arItem){?>
                    <div class="item">
                        <div class="thumb">
                            <?
                            if($arItem["PREVIEW_PICTURE"]["SRC"]){
                                $file = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], array('width'=>283, 'height'=>178), BX_RESIZE_IMAGE_EXACT, true);
                                $img = '<img src="'.$file['src'].'" width="'.$file['width'].'" height="'.$file['height'].'" />';

                                ?>
                                <?=$img?>
                            <?}?>
                        </div>
                        <div class="carousel-content">
                            <h4><?= FormatDate('f Y', MakeTimeStamp($arItem["DATE_ACTIVE_FROM"], CSite::GetDateFormat()), time())?></h4>
                        </div>
                    </div>
                    <?}?>
            </div>
        </div>
        <?}?>



    </div>
    </div>
</div>
<?}?>
<script>
    $( function() {
        $( "#tabs" ).tabs();
    } );
</script>

