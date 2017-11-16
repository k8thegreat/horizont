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

if (!empty($arResult['NAV_RESULT']))
{
	$navParams =  array(
		'NavPageCount' => $arResult['NAV_RESULT']->NavPageCount,
		'NavPageNomer' => $arResult['NAV_RESULT']->NavPageNomer,
		'NavNum' => $arResult['NAV_RESULT']->NavNum
	);
}
else
{
	$navParams = array(
		'NavPageCount' => 1,
		'NavPageNomer' => 1,
		'NavNum' => $this->randString()
	);
}

$roomsTitleArr = array(
    "1" => "1-к.кв.",
    "2" => "2-к.кв.",
    "3" => "3-к.кв.",
    "4" => "4-к.кв.",
    "5" => "5-к.кв.",
    "studio" => "Студии"
);

$elementEdit = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT');
$elementDelete = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE');
$elementDeleteParams = array('CONFIRM' => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));

$obName = 'ob'.preg_replace('/[^a-zA-Z0-9_]/', 'x', $this->GetEditAreaId($navParams['NavNum']));
$containerName = 'container-'.$navParams['NavNum'];
?>
<section class="bg-gray">
    <div class="container">
        <h2 class="title-big cursive-title-left"><?=$arResult["NAME"]?>
        <span class="title-top"><span class="dop-title">Информация</span></span>
        </h2>
        <div class="build-short-info">
            <div class="loc-metro">
                <?if($arResult["UF_METRO_ID"]){?>
                    <?foreach($arResult["UF_METRO_ID"] as $val){?><?=printMetroValue($val, true)?><?}?>
                <?}?>
                <?if($arResult["UF_TIME_ON_FOOT"]){?>
                    <?=$arResult["UF_TIME_ON_FOOT"]?>мин
                    <?=FOOT_ICON?>
                <?}?>
                <?if($arResult["UF_TIME_ON_TRANSPORT"]){?>
                    <?=$arResult["UF_TIME_ON_TRANSPORT"]?>мин
                    <?=TRANSPORT_ICON?>
                <?}?>
            </div>
            <div class="dop-location">
                <?=($arResult["UF_SUBLOCALITY"] ? '<a href="">'.$arResult["UF_SUBLOCALITY"].'</a>' : '')?><?if($arResult["UF_ADDRESS"]){?>, <?=$arResult["UF_ADDRESS"]?><?}?>
            </div>
        </div>
    </div>
    <div class="builder-menu-wrapper">
        <div class="builder-menu">
            <div class="container">
                <ul class="menu">
                    <li><a href="#" data-scroll="menu-layouts-and-prices">Планировки и цены</a></li>
                    <li><a href="#" data-scroll="menu-advantages">Преимущества</a></li>
                    <li><a href="#" data-scroll="menu-description">Описание</a></li>
                    <?if($arResult["UF_LOCATION"]){?><li><a href="#" data-scroll="menu-map">Карта</a></li><?}?>
                    <?if($arResult["UF_PLAN_PHOTO"] || $arResult["UF_PLAN_DESCRIPTION"]){?><li><a href="#" data-scroll="menu-plan-of-the-complex">План комплекса</a></li><?}?>
                    <?if($arResult["UF_APARTMENTS"]){?><li><a href="#" data-scroll="menu-decoration">Отделка</a></li><?}?>
                    <?if($arResult["UF_HISTORY"]){?><li><a href="#" data-scroll="menu-course-of-construction">Ход строительства</a></li><?}?>
                    <?if($arResult["UF_BANKS"]){?><li><a href="#" data-scroll="menu-mortgage">Ипотека</a></li><?}?>
                </ul>
            </div>
        </div>
    </div>
    <div class="builder-card-detail">
        <div class="container">
            <div class="one-build">
                <div class="detail-content">
                    <?if($arResult["UF_GOOD_PRICE"]){?><h2 class="result-advantage">Выгодная цена</h2><?}?>
                    <div class="price-apartment-block">
                        <?if($arResult["MIN_PRICE"]){?>
                        <p class="price">Цена от <span><?=number_format($arResult["MIN_PRICE"], 0, ".", " ")?></span> руб.</p>
                        <?}?>
                        <p class="apartment-in-build">Квартир в комплексе: <?=$arResult["COUNT"]?></p>
                    </div>
                    <ul class="detail">
                        <?if($arResult["UF_DEVELOPER"]){?><li><span>Застройщик:</span><?=$arResult["UF_DEVELOPER"]["NAME"]?></li><?}?>
                        <?if($arResult["READY"]){?><li><span>Сроки сдачи:</span><?=(count($arResult["READY"])>1 ?  "".formatReadyDate($arResult["READY"][0])." - ".formatReadyDate($arResult["READY"][count($arResult["READY"])-1])."" : "".formatReadyDate($arResult["READY"][0], true)."")?></li><?}?>
                        <?if($arResult["UF_BUILDING_TYPE"]){?><li><span>Тип здания:</span><?=$arResult["UF_BUILDING_TYPE"]?></li><?}?>
                        <?if($arResult["FLOORS"]){?><li><span>Этажность:</span><?=$arResult["FLOORS"]["VALUE"]?></li><?}?>
                        <?if($arResult["RENOVATION"]){?><li><span>Отделка:</span><?=$arResult["RENOVATION"]["VALUE"]?></li><?}?>
                    </ul>
                </div>
                <div class="detail-preview">
                    <?if($arResult["UF_MORE_PHOTO"]){?>
                    <div class="slider-preview owl-carousel owl-theme">
                        <?foreach ($arResult["UF_MORE_PHOTO"] as $photo){
                            $file = CFile::ResizeImageGet($photo, array('width'=>758, 'height'=>320), BX_RESIZE_IMAGE_EXACT, true);
                            $img = '<img src="'.$file['src'].'" />';
                            ?>
                            <div class="item"><a href="<?=CFile::GetPath($photo)?>" class="thumb" data-fancybox="main-images"><?=$img?></a></div>
                        <?}?>
                    </div>
                    <?}?>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="bg-gray" id="menu-layouts-and-prices">
    <div class="container">
        <h2 class="title-big cursive-title-left">планировки и цены <?=$arResult["NAME"]?></h2>
        <div class="list-life-complex">
	<?
    $i = 0;
    foreach ($arResult['ITEMS'] as $key =>  $arSection1){
    ?>
            <div class="filter-life-complex">
                <ul>
                    <li><b><?=formatReadyDate($key)?></b>,</li>
                    <li>корпус: <?=implode(", ",$arSection1["CORPUS"])?></li>
                </ul>
                <?if($i==0){?>
                <ul>
                    <li><label class="checkbox"><input type="checkbox" value="all" name="rooms-selector" checked/><span>Все</span></label></li>
                    <li><label class="checkbox"><input type="checkbox" value="studio" name="rooms-selector"/><span>Студии</span></label></li>
                    <li><label class="checkbox"><input type="checkbox" value="1" name="rooms-selector"/><span>1-к.кв</span></label></li>
                    <li><label class="checkbox"><input type="checkbox" value="2" name="rooms-selector"/><span>2-к.кв</span></label></li>
                    <li><label class="checkbox"><input type="checkbox" value="3" name="rooms-selector"/><span>3-к.кв</span></label></li>
                    <li><label class="checkbox"><input type="checkbox" value="4" name="rooms-selector"/><span>4-к.кв</span></label></li>
                    <li><label class="checkbox"><input type="checkbox" value="5" name="rooms-selector"/><span>5-к.кв</span></label></li>
                </ul>
                <?}?>
            </div>
            <div class="list-drop-table">
                <?
                foreach ($arSection1["GROUPS"] as $rooms => $arSection2) {
                    $uniqueId = $item['ID'] . '_' . md5($this->randString() . $component->getAction());
                    $areaIds[$item['ID']] = $this->GetEditAreaId($uniqueId);
                    $this->AddEditAction($uniqueId, $item['EDIT_LINK'], $elementEdit);
                    $this->AddDeleteAction($uniqueId, $item['DELETE_LINK'], $elementDelete, $elementDeleteParams);
                    ?>
                    <div class="apartment-group" data-rooms="rooms-<?=$rooms?>">
                        <div class="apartment-group-title">
                            <div><?=$roomsTitleArr[$rooms]?></div>
                            <div><span>стоимость  от:</span><?= number_format($arSection2["MIN_PRICE"], 0, ".", " ") ?> руб.</div>
                            <div><span>метраж  от: </span><?= $arSection2["MIN_SQUARE"] ?> м²</div>
                            <div><span>квартир в продаже:</span><?=count($arSection2["ITEMS"]) ?></div>
                            <div><button class="btn-drop-table"><?=ARROW_DOWN?></button></div>
                        </div>
                        <div class="apartment-group-table">
                            <div class="table-wrapper">
                                <table id="table_<?=$i?>_<?=$rooms?>" class="table table-default tablesorter">
                                    <thead>
                                    <tr class="row-blue">
                                        <th>Корпус</th>
                                        <th>Этаж</th>
                                        <th>S общ.</th>
                                        <th>S кух.</th>
                                        <th>Отделка</th>
                                        <th>Балкон</th>
                                        <th>Санузел</th>
                                        <th>Базовая цена</th>
                                        <th>Цена со %</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <? foreach($arSection2["ITEMS"] as $arItem) {?>
                                        <tr id="<?=$this->GetEditAreaId($arItem['ID']);?>"  title="Посмотреть планировку" class="apart-modal" data-href="<?=$arItem["DETAIL_PAGE_URL"]?>"><td><?= $arItem["PROPERTIES"]["corpus_name"]["VALUE"] ?></td><td><?= $arItem["PROPERTIES"]["floor"]["VALUE"] ?>/<?= $arItem["PROPERTIES"]["floors_total"]["VALUE"] ?></td><td><?= ($arItem["PROPERTIES"]["area"]["VALUE"] ? $arItem["PROPERTIES"]["area"]["VALUE"] . " м<sup>2</sup>" : "") ?></td><td><?= ($arItem["PROPERTIES"]["kitchen_space"]["VALUE"] ? $arItem["PROPERTIES"]["kitchen_space"]["VALUE"] . " м<sup>2</sup>" : "--") ?></td><td><?=$arItem["PROPERTIES"]["renovation"]["VALUE"]?></td><td><?=($arItem["PROPERTIES"]["balcony_space"]["VALUE"] ? $arItem["PROPERTIES"]["balcony_space"]["VALUE"]. " м<sup>2</sup>" : "-")?></td><td><?= $arItem["PROPERTIES"]["bathroom_unit"]["VALUE"] ?></td><td><?= number_format($arItem["PROPERTIES"]["price_base"]["VALUE"], 0, ".", " ") ?></td><td><b><?= number_format($arItem["PROPERTIES"]["price_discount"]["VALUE"], 0, ".", " ") ?></b></td><td><a class="apart-modal" href="<?=$arItem["DETAIL_PAGE_URL"]?>">Посмотреть планировку</a></td></tr>
                                    <?}?>
                                    </tbody>
                                </table>
                            </div>
                            <?if(count($arSection2["ITEMS"])>12){/*?>
                            <div class="btn-center">
                                <button class="btn btn-border">Показать еще 12 квартир</button>
                            </div>
                        <?*/}?>
                        </div>
                    </div>
                    <?
                }
                $i++;
	}
	?>
            </div>
        </div>
    </div>
</section>
<?
if ($arResult["UF_ADVANTAGES"]){?>
    <section id="menu-advantages">
        <div class="container">
            <h2 class="title-big cursive-title-left">преимущества жк<span class="title-top"><span class="dop-title">Ваша выгода</span></span></h2>
            <ul class="list-box-num el-3">
                <?foreach ($arResult["UF_ADVANTAGES"] as $val){?>
                    <li>
                        <p><?=$val?></p>
                    </li>
                <?}?>
            </ul>
        </div>
    </section>
<?}?>
    <section class="bg-gray life-complex-des" id="menu-description">
        <div class="container">
            <h2 class="title-big cursive-title-right"><b>описание жк</b><span class="title-top"><span class="dop-title">Подробно</span></span></h2>
            <p><?=$arResult["DESCRIPTION"]?></p>
        </div>
    </section>
    <section class="bg-gray">
        <div class="container">
            <div class="blue-card card-full title-des">
                <img src="<?=SITE_TEMPLATE_PATH?>/img/card-ico/horn.png" alt="">
                <div class="blue-card-content">
                    <h2>Полное представление информации</h2>
                    <p>Вы получаете полноценную беспристрастную информацию о рынке новостроек, в отличие от застройщика,
                        который заинтересован в продаже только своих объектов.
                        Свяжитесь, чтобы выбрать лучший вариант:</p>
                    <?$APPLICATION->IncludeComponent(
                        "custom:iblock.element.add.form",
                        "get_info",
                        array(
                            "COMPONENT_TEMPLATE" => "get_info",
                            "CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
                            "CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
                            "CUSTOM_TITLE_DETAIL_PICTURE" => "",
                            "CUSTOM_TITLE_DETAIL_TEXT" => "",
                            "CUSTOM_TITLE_IBLOCK_SECTION" => "",
                            "CUSTOM_TITLE_NAME" => "Ваш телефон",
                            "CUSTOM_TITLE_PREVIEW_PICTURE" => "",
                            "CUSTOM_TITLE_PREVIEW_TEXT" => "",
                            "CUSTOM_TITLE_TAGS" => "",
                            "DEFAULT_INPUT_SIZE" => "30",
                            "DETAIL_TEXT_USE_HTML_EDITOR" => "N",
                            "ELEMENT_ASSOC" => "CREATED_BY",
                            "GROUPS" => array(
                                0 => "2",
                            ),
                            "IBLOCK_ID" => "7",
                            "IBLOCK_TYPE" => "feedback",
                            "LEVEL_LAST" => "Y",
                            "LIST_URL" => "",
                            "MAX_FILE_SIZE" => "0",
                            "MAX_LEVELS" => "100000",
                            "MAX_USER_ENTRIES" => "100000",
                            "PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
                            "PROPERTY_CODES" => array(
                                0 => "31",
                                1 => "NAME",
                            ),
                            "PROPERTY_CODES_REQUIRED" => array(
                                0 => "NAME",
                            ),
                            "RESIZE_IMAGES" => "N",
                            "SEF_MODE" => "N",
                            "STATUS" => "ANY",
                            "STATUS_NEW" => "N",
                            "USER_MESSAGE_ADD" => "Ваше сообщение успешно отправлено",
                            "USER_MESSAGE_EDIT" => "Ваше сообщение успешно отправлено",
                            "USE_CAPTCHA" => "N",
                            "EVENT_NAME" => "CALLBACK_MSG"
                        ),
                        false
                    );?>
                </div>
            </div>
        </div>
    </section>
<?if($arResult["UF_LOCATION"]){?>
    <section class="bg-gray" id="menu-map">
        <div class="container">
            <h2 class="title-big cursive-title-left">Новостройка на карте<span class="title-top"><span class="dop-title">Местоположение</span></span></h2>
            <div id="loc-life-complex" class="ya-map shadow-map"></div>
        </div>
    </section>
    <script type="text/javascript">
        ymaps.ready(init);
        var locMap, locPlacemark;

        function init(){
            locMap = new ymaps.Map ("loc-life-complex", {
                center: [<?=$arResult["UF_LOCATION"]["lat"]?>, <?=$arResult["UF_LOCATION"]["long"]?>],
                zoom: 12,
                controls:[]
            });
            locMap.controls.add("fullscreenControl", {float:'none', position:{top:6,right:6}});
            locMap.controls.add("zoomControl", {float:'none', position:{top:74,right:6}});
            locMap.controls.add("rulerControl", {float:'none', position:{top:40,right:6}});
            locMap.behaviors.disable('scrollZoom');
            locMap.behaviors.disable('drag');
            locPlacemark = new ymaps.Placemark(locMap.getCenter(), {
                hintContent: '<?=$arResult["NAME"]?>'
            },{
                iconLayout: 'default#image',
                iconImageHref: '/images/map-icon.png',
                iconImageSize: [35, 44],
                iconImageOffset: [-17, -44]
            });
            locMap.geoObjects.add(locPlacemark);
        }
    </script>
    <?}?>
    <?if($arResult["UF_PLAN_PHOTO"] || $arResult["UF_PLAN_DESCRIPTION"]){?>
    <section class="bg-gray" id="menu-plan-of-the-complex">
        <div class="container">
            <div class="white-card-bg">
                <h2 class="title-big">План комплекса</h2>
                <div class="plan-life-complex">
                    <?
                    if($arResult["UF_PLAN_PHOTO"]){
                    $file = CFile::ResizeImageGet($arResult["UF_PLAN_PHOTO"], array('width'=>670, 'height'=>335), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                    $img = '<img src="'.$file['src'].'" width="'.$file['width'].'" height="'.$file['height'].'"/>';
                    ?>
                        <a data-fancybox="plan" href="<?=CFile::GetPath($arResult["UF_PLAN_PHOTO"])?>"><?=$img?></a>
                    <?}?>
                    <p><?=$arResult["UF_PLAN_DESCRIPTION"]?></p>
                </div>
            </div>
        </div>
    </section>
    <?}?>
    <?if($arResult["UF_APARTMENTS"]){
        ?>
    <section class="bg-gray" id="menu-decoration">
        <div class="container">
            <h2 class="title-big cursive-title-left">Отделка в квартирах</h2>
            <div class="dark-control owl-carousel owl-theme border-img">
                <?foreach ($arResult["UF_APARTMENTS"] as $photo){
                    $file = CFile::ResizeImageGet($photo, array('width'=>372, 'height'=>178), BX_RESIZE_IMAGE_EXACT, true);
                    $img = '<img src="'.$file['src'].'" width="'.$file['width'].'" height="'.$file['height'].'"/>';?>
                <div class="item"><a href="<?=CFile::GetPath($photo)?>" class="thumb" data-fancybox="group"><?=$img?></a></div>
                <?}?>
            </div>
        </div>
    </section>
    <?}?>
<?
if($arResult["UF_BANKS"]){
    $GLOBALS["BANKS"] = $arResult["UF_BANKS"];
}
if($arResult["UF_HISTORY"]){
    $GLOBALS["HISTORY"] = $arResult["UF_HISTORY"];
}
if($arResult["UF_DEVELOPER"]){
    $GLOBALS["DEVELOPER"] = $arResult["UF_DEVELOPER"];
}
if($arResult["UF_SUBLOCALITY"]){
    $GLOBALS["SUBLOCALITY"] = $arResult["UF_SUBLOCALITY"];
}
if($arResult["UF_METRO_ID"]){
    $GLOBALS["METRO"] = $arResult["UF_METRO_ID"];
}
if($arResult["MIN_PRICE"]){
    $GLOBALS["MIN_PRICE"] = $arResult["MIN_PRICE"];
}