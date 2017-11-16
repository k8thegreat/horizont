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

$arViewModeList = $arResult['VIEW_MODE_LIST'];


$arCurView = $arViewStyles[$arParams['VIEW_MODE']];

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));

$roomsTitleArr = array(
    "1" => "1-к.кв.",
    "2" => "2-к.кв.",
    "3" => "3-к.кв.",
    "4" => "4-к.кв.",
    "5" => "5-к.кв.",
    "studio" => "Студии"
);
?>
<div class="result-list map-mod">
    <div class="result-list-nav">
        <div>
            <a href="#" class="go-filter">Фильтр<?=FILTER_ICON?></a>
            <a href="<?= $APPLICATION->GetCurPageParam("view=list", array("view")); ?>" class="list list-line"><?=LIST_VIEW_ICON?></a>
            <a href="<?= $APPLICATION->GetCurPageParam("view=block", array("view")); ?>" class="list list-squares"><?=BLOCK_VIEW_ICON?></a>
            <a href="<?= $APPLICATION->GetCurPageParam("view=map", array("view")); ?>" class="list list-map active"><?=MAP_VIEW_ICON?></a>
        </div>
    </div>
    <div class="map-result" id="map-result">

    </div>
<?
if (0 < $arResult["SECTIONS_COUNT"])
{
?>
    <script type="text/javascript">
        ymaps.ready(init);
        var objMap, objManager;
        function init(){
            objMap = new ymaps.Map ("map", {
                center: [59.932460, 30.301976],
                zoom: 9,
                controls:[]
            });
            objMap.controls.add("fullscreenControl", {float:'none', position:{top:6,right:6}});
            objMap.controls.add("zoomControl", {float:'none', position:{top:74,right:6}});
            objMap.controls.add("rulerControl", {float:'none', position:{top:40,right:6}});
            objMap.behaviors.disable('scrollZoom');
            objManager = new ymaps.ObjectManager({
                clusterize: false
            });
            <?
            foreach($arResult["SECTIONS"] as $arSection){
                if(is_array($arSection["UF_LOCATION"])){
                ?>
            objManager.add({
                    type: 'Feature',
                    id: <?=$arSection["ID"]?>,
                    geometry: {
                        type: 'Point',
                        coordinates: [<?=$arSection["UF_LOCATION"]["lat"]?>, <?=$arSection["UF_LOCATION"]["long"]?>]
                    },
                    options:{
                        iconLayout: 'default#image',
                        iconImageHref: '/images/map-icon.png',
                        iconImageSize: [35, 44],
                        iconImageOffset: [-17, -44]
                    },
                    properties: {
                        hintContent: '<?=$arSection["NAME"]?>',
                        description: ['<div class="one-result">',
                            '<div class="result-content-top">',
                            '<div>',
                            '<h2 class="name-rc"><?=$arSection["NAME"]?></h2>',
                            '<h4 class="name-loc"><?=(implode(", ",array($arSection["UF_LOCALITY_NAME"], $arSection["UF_ADDRESS"])))?></h4>',
                            '</div>',
                            '<div>',
                            '<div class="loc-metro">',
                            '<?foreach($arSection["UF_METRO_ID"] as $val){?><?=printMetroValue($val, true)?><?}?>',
                        '</div>',
                        '<div class="loc-data">',
                        <?=($arSection["UF_TIME_ON_FOOT"] ? "'".TIME_ICON." ".$arSection["UF_TIME_ON_FOOT"]." мин ".FOOT_ICON."'," : "")?>
                        <?=($arSection["UF_TIME_ON_TRANSPORT"] ? "'".TIME_ICON." ".$arSection["UF_TIME_ON_TRANSPORT"]." мин ".TRANSPORT_ICON."'," : "")?>
                        '</div>',
                        '</div>',
                        '</div>',
                        '<a href="<?=$arSection["SECTION_PAGE_URL"]?>" class="thumb" target="_blank">',
                        '<?=$arSection["PICTURE"]?>',
                        '</a>',
                        '<div class="result-content">',
                        '<div class="result-dop-con">',
                        '<ul class="left-con">',
                            <?if($arSection["UF_READY"]){?>'<li><span>Сроки сдачи:</span><?=(count($arSection["UF_READY"])>1 ?  "<b>".formatReadyDate($arSection["UF_READY"][0])." - ".formatReadyDate($arSection["UF_READY"][count($arSection["UF_READY"])-1])."</b>" : "<b>".formatReadyDate($arSection["UF_READY"][0], true)."</b>")?></li>',<?}?>
                            <?=($arSection["UF_PAYMENT"] ? "'<li><span>Варианты оплаты:</span> <b>".implode(", ",$arSection["UF_PAYMENT"])."</b></li>'," : "")?>
                            <?=($arSection["UF_DEVELOPER"] ? "'<li><span>Застройщик:</span> <b>".$arSection["UF_DEVELOPER"]["NAME"]."</b></li>'," : "")?>
                        '</ul>',
                        '<ul class="right-con"><?foreach ($arSection["ITEMS_PRICE"] as $key => $value){?><li><span><?= $roomsTitleArr[$key] ?> от:</span><b><?= number_format($value, 0, ".", " ") ?> руб.</b></li> <?} ?>',
                        '</ul>',
                        '</div>',
                        '</div>',
                        '<div class="btn-center">',
                        '<a href="#" class="btn btn-full" data-modal="modal-callback">Заказать бесплатную консультацию</a>',
                        '</div>',
                        '</div>',
                        '</div>'].join('')
                    }
                });
            <?
                }
            }?>
            objManager.objects.events.add('click', function (e) {
                var objectId = e.get('objectId'),
                    object = objManager.objects.getById(objectId);
                document.getElementById("map-result").innerHTML = object.properties.description;
            });
            objManager.clusters.events.add('click', function (e) {
                e.preventDefault();
            });
            objMap.geoObjects.add(objManager);
            <?
            if($arResult["SECTIONS_COUNT"]>1){?>
            //objMap.setBounds(objManager.getBounds() );
            //objMap.setBounds(objMap.geoObjects.getBounds(), {checkZoomRange:true}).then(function(){ if(objMap.getZoom() > 10) objMap.setZoom(10);});
            <?}?>
        }
    </script>
    <?}?>
</div>