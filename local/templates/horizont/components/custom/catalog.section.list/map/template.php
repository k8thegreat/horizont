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
            <a href="" class="go-filter">Фильтр<?=FILTER_ICON?></a>
            <select name="sort" class="result-sort">
                <option value="">Сортировать</option>
                <option value="<?= $APPLICATION->GetCurPageParam("sort=name", array("sort")); ?>"<?=($_GET["sort"]=="name" ? " selected" : "")?>>По имени</option>
                <option value="<?= $APPLICATION->GetCurPageParam("sort=date", array("sort")); ?>"<?=($_GET["sort"]=="date" ? " selected" : "")?>>По дате</option>
                <option value="<?= $APPLICATION->GetCurPageParam("sort=price", array("sort")); ?>"<?=($_GET["sort"]=="price" ? " selected" : "")?>>По цене</option>
            </select>
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
    <script src="http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU" type="text/javascript"></script>
    <script type="text/javascript">
        ymaps.ready(function () {
            var map = new ymaps.Map("map", {
                center: [<?=$arResult["SECTIONS"][0]["UF_LOCATION"]["lat"]?>, <?=$arResult["SECTIONS"][0]["UF_LOCATION"]["long"]?>],
                zoom: 12}
            );
            map.behaviors.enable('scrollZoom');
            map.controls.add('mapTools', { top: 6, right: 41});
            map.controls.add('zoomControl', { top: 40, right: 7 });
            <?$i=1;
            foreach($arResult["SECTIONS"] as $arSection):?>
            var mapPlacemark<?=$arSection["ID"]?> = new ymaps.Placemark([<?=$arSection["UF_LOCATION"]["lat"]?>, <?=$arSection["UF_LOCATION"]["long"]?>],
                {
                    hintContent: '<?=$arSection["NAME"]?>',
                    description: ['<div class="one-result">',
                        '<div class="result-content-top">',
                        '<div>',
                        '<h2 class="name-rc"><?=$arSection["NAME"]?></h2>',
                        '<h4 class="name-loc"><?=(implode(", ",array($arSection["UF_SUBLOCALITY"], $arSection["UF_ADDRESS"])))?></h4>',
                        '</div>',
                        '<div>',
                        '<div class="loc-metro">',
                        '<?foreach($arSection["METRO"] as $val){?><?=getColoredIcon($val)?><?}?>',
                        <?=($arSection["UF_METRO"] ? "'".$arSection["UF_METRO"]."'," : "")?>
                        '</div>',
                        '<div class="loc-data">',
                        <?=($arSection["UF_TIME_ON_FOOT"] ? "'".TIME_ICON." ".$arSection["UF_TIME_ON_FOOT"]." мин ".FOOT_ICON."'," : "")?>
                        <?=($arSection["UF_TIME_ON_TRANSPORT"] ? "'".TIME_ICON." ".$arSection["UF_TIME_ON_TRANSPORT"]." мин ".TRANSPORT_ICON."'," : "")?>
                        '</div>',
                        '</div>',
                        '</div>',
                        '<a href="<?=$arSection["SECTION_PAGE_URL"]?>" class="thumb">',
                        '<?=$arSection["PICTURE"]?>',
                        '</a>',
                        '<div class="result-content">',
                        '<div class="result-dop-con">',
                        '<ul class="left-con">',
                        <?if($arSection["UF_READY"]){?>'<li><span>Сроки сдачи:</span><?=(count($arSection["UF_READY"])>1 ?  "<b>".$arSection["UF_READY"][0]." - ".$arSection["UF_READY"][count($arSection["UF_READY"])-1]."</b>" : "<b>".$arSection["UF_READY"][0]."</b>")?></li>',<?}?>
                        <?=($arSection["UF_PAYMENT"] ? "'<li><span>Варианты оплаты:</span> <b>".implode(", ",$arSection["UF_PAYMENT"])."</b></li>'," : "")?>
                        <?=($arSection["UF_DEVELOPER"] ? "'<li><span>Застройщик:</span> <b>".$arSection["UF_DEVELOPER"]["NAME"]."</b></li>'," : "")?>
                        '</ul>',
                        '<ul class="right-con"><?foreach ($arSection["ITEMS_PRICE"] as $key => $value){?><li><span><?= $roomsTitleArr[$key] ?> от:</span><b><?= number_format($value, 0, ".", " ") ?> руб.</b></li> <?} ?>',
                        '</ul>',
                        '</div>',
                        '</div>',
                        '<div class="btn-center">',
                        '<a href="" class="btn btn-full">Заказать бесплатную консультацию</a>',
                        '</div>',
                        '</div>',
                        '</div>'].join('')
                },{
                    iconLayout: 'default#image',
                    iconImageHref: '/images/map-icon.png',
                    iconImageSize: [35, 44],
                    iconImageOffset: [-17, -44]
                });
            map.geoObjects.add(mapPlacemark<?=$arSection["ID"]?>);
            mapPlacemark<?=$arSection["ID"]?>.events.add('click', function (e) {
                document.getElementById("map-result").innerHTML = e.get('target')['properties'].get('description');


            });
            <?endforeach;?>
            <?if($arResult["SECTIONS_COUNT"]>1){?>
            map.setBounds(map.geoObjects.getBounds());
            <?}?>
        });
    </script>
    <?}?>
</div>