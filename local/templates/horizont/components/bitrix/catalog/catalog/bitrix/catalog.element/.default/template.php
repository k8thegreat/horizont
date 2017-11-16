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
 * @var string $templateFolder
 */

$this->setFrameMode(true);

$mainId = $this->GetEditAreaId($arResult['ID']);
$itemIds = array(
    'ID' => $mainId,
    'DISCOUNT_PERCENT_ID' => $mainId.'_dsc_pict',
    'STICKER_ID' => $mainId.'_sticker',
    'BIG_SLIDER_ID' => $mainId.'_big_slider',
    'BIG_IMG_CONT_ID' => $mainId.'_bigimg_cont',
    'SLIDER_CONT_ID' => $mainId.'_slider_cont',
    'OLD_PRICE_ID' => $mainId.'_old_price',
    'PRICE_ID' => $mainId.'_price',
    'DISCOUNT_PRICE_ID' => $mainId.'_price_discount',
    'PRICE_TOTAL' => $mainId.'_price_total',
    'SLIDER_CONT_OF_ID' => $mainId.'_slider_cont_',
    'QUANTITY_ID' => $mainId.'_quantity',
    'QUANTITY_DOWN_ID' => $mainId.'_quant_down',
    'QUANTITY_UP_ID' => $mainId.'_quant_up',
    'QUANTITY_MEASURE' => $mainId.'_quant_measure',
    'QUANTITY_LIMIT' => $mainId.'_quant_limit',
    'BUY_LINK' => $mainId.'_buy_link',
    'ADD_BASKET_LINK' => $mainId.'_add_basket_link',
    'BASKET_ACTIONS_ID' => $mainId.'_basket_actions',
    'NOT_AVAILABLE_MESS' => $mainId.'_not_avail',
    'COMPARE_LINK' => $mainId.'_compare_link',
    'TREE_ID' => $mainId.'_skudiv',
    'DISPLAY_PROP_DIV' => $mainId.'_sku_prop',
    'DISPLAY_MAIN_PROP_DIV' => $mainId.'_main_sku_prop',
    'OFFER_GROUP' => $mainId.'_set_group_',
    'BASKET_PROP_DIV' => $mainId.'_basket_prop',
    'SUBSCRIBE_LINK' => $mainId.'_subscribe',
    'TABS_ID' => $mainId.'_tabs',
    'TAB_CONTAINERS_ID' => $mainId.'_tab_containers',
    'SMALL_CARD_PANEL_ID' => $mainId.'_small_card_panel',
    'TABS_PANEL_ID' => $mainId.'_tabs_panel'
);
$obName = $templateData['JS_OBJ'] = 'ob'.preg_replace('/[^a-zA-Z0-9_]/', 'x', $mainId);
$name = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])
    ? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
    : $arResult['NAME'];
$title = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE'])
    ? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE']
    : $arResult['NAME'];
$alt = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT'])
    ? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT']
    : $arResult['NAME'];
?>
<div id="apartment-detail">
    <h2 class="title-big"><?=$arResult["SECTION"]["NAME"]?></h2>
    <div class="info-apartment">
        <div>
            <div class="build-short-info">
                <?if($arResult["UF_METRO_ID"]){?>
                    <div class="loc-metro">
                        <?foreach($arResult["UF_METRO_ID"] as $val){?><?=printMetroValue($val, true)?><?}?>
                    </div>
                <?}?>
                <div class="dop-location">
                    <a href=""><?=$arResult["UF_LOCALITY_NAME"] ?></a>, <?=$arResult["UF_ADDRESS"]?>
                </div>
            </div>
            <div class="thumb">
                <?if($arResult["PREVIEW_PICTURE"]["ID"]){
                    $file = CFile::ResizeImageGet($arResult["PREVIEW_PICTURE"]["ID"], array('width'=>370, 'height'=>360), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                    $img = '<img src="'.$file['src'].'" alt="'.$arResult["NAME"].'"/>';
                    ?><a href="<?=CFile::GetPath($arResult["PREVIEW_PICTURE"]["ID"])?>" data-fancybox="image"><?=$img?></a><?
                }?>
            </div>
        </div>
        <div>
            <div class="price-apartment">
                <?$price = ($arResult["PROPERTIES"]["price_discount"]["VALUE"] ? $arResult["PROPERTIES"]["price_discount"]["VALUE"] : $arResult["PROPERTIES"]["price"]["VALUE"])?>
                <span><?=number_format($price, 0, ".", " ")?></span> руб.
                <ul>
                    <li>
                        <a href="/get_pdf.php?ID=<?=$arResult["ID"]?>"><?=PDF_ICON?></a>
                    </li>
                    <li>
                        <a href="javascript:printPageArea('apartment-detail');" class="print" title="Распечатать"><?=PRINT_ICON?></a>
                    </li>
                    <li class="share">
                        <a href="" class="share-link"><?=SHARE_ICON?></a>
                        <div class="share-block">
                            <?$APPLICATION->IncludeComponent("bitrix:main.share", "share", Array(
                                "COMPOSITE_FRAME_MODE" => "A",	// Голосование шаблона компонента по умолчанию
                                "COMPOSITE_FRAME_TYPE" => "AUTO",	// Содержимое компонента
                                "HANDLERS" => array(	// Используемые соц. закладки и сети
                                    0 => "facebook",
                                    1 => "twitter",
                                    2 => "vk",
                                ),
                                "HIDE" => "N",	// Скрыть панель закладок по умолчанию
                                "PAGE_TITLE" => $arResult["~NAME"],	// Заголовок страницы
                                "PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],	// URL страницы относительно корня сайта
                                "SHORTEN_URL_KEY" => "",	// Ключ API для bit.ly
                                "SHORTEN_URL_LOGIN" => "",	// Логин для bit.ly
                            ),
                                false
                            );?>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="detailed-information">
                <table class="table-modal">
                    <tbody>
                    <?if($arResult["UF_DEVELOPER"]["NAME"]){?>
                        <tr>
                            <td>Застройщик:</td>
                            <td><?=$arResult["UF_DEVELOPER"]["NAME"]?></td>
                        </tr>
                    <?}?>
                    <?if($arResult["PROPERTIES"]["ready"]["VALUE"]){?>
                        <tr>
                            <td>Срок сдачи:</td>
                            <td><?=formatReadyDate($arResult["PROPERTIES"]["ready"]["VALUE"])?> (<?=$arResult["PROPERTIES"]["building_section"]["VALUE"]?>)</td>
                        </tr>
                    <?}?>
                    <?if($arResult["UF_BUILDING_TYPE"]){?>
                        <tr>
                            <td>Тип дома:</td>
                            <td><?=$arResult["UF_BUILDING_TYPE"]?></td>
                        </tr>
                    <?}?>
                    <?if($arResult["PROPERTIES"]["renovation"]["VALUE"]){?>
                        <tr>
                            <td>Отделка:</td>
                            <td><?=$arResult["PROPERTIES"]["renovation"]["VALUE"]?></td>
                        </tr>
                    <?}?>
                    <?if($arResult["PROPERTIES"]["floor"]["VALUE"]){?>
                        <tr>
                            <td>Этаж:</td>
                            <td><?=$arResult["PROPERTIES"]["floor"]["VALUE"]?> (<?=$arResult["PROPERTIES"]["floors_total"]["VALUE"]?>)</td>
                        </tr>
                    <?}?>
                    <?if($arResult["PROPERTIES"]["payment"]["VALUE"]){?>
                        <tr>
                            <td>Оплата:</td>
                            <td><?=implode(", ",$arResult["PROPERTIES"]["payment"]["VALUE"])?></td>
                        </tr>
                    <?}?>
                    <?if($arResult["PROPERTIES"]["ceiling_height"]["VALUE"]){?>
                        <tr>
                            <td>Высота потолка:</td>
                            <td><?=$arResult["PROPERTIES"]["ceiling_height"]["VALUE"]?> м</td>
                        </tr>
                    <?}?>
                    <?if($arResult["PROPERTIES"]["rooms"]["VALUE"]){?>
                        <tr>
                            <td>Кол-во комнат:</td>
                            <td><?=$arResult["PROPERTIES"]["rooms"]["VALUE"]?></td>
                        </tr>
                    <?}?>
                    <?if($arResult["PROPERTIES"]["area"]["VALUE"]){?>
                        <tr>
                            <td>Пл. общая</td>
                            <td><?=$arResult["PROPERTIES"]["area"]["VALUE"]?> м²</td>
                        </tr>
                    <?}?>
                    <?if($arResult["PROPERTIES"]["kitchen_space"]["VALUE"]){?>
                        <tr>
                            <td>Пл. кухни</td>
                            <td><?=$arResult["PROPERTIES"]["kitchen_space"]["VALUE"]?> м²</td>
                        </tr>
                    <?}?>
                    </tbody>
                </table>
                <?if($arResult["UF_BANKS"]){?>
                    <div class="btn-wrap">
                        <button class="btn btn-border show-calc">Калькулятор ипотеки</button>
                    </div>
                    <div class="gray-card">
                        <div class="close-card"></div>
                        <h4>Минимальная ставка банков: <b><?=(defined("RATE_MIN_LOCAL") ? RATE_MIN_LOCAL : RATE_MIN_GLOBAL)?></b></h4>
                        <div class="mortgage-calculation">
                            <?$APPLICATION->IncludeFile("/includes/mortgage_apartment_calculator.php", Array("arResult" => $arResult))?>
                        </div>
                    </div>
                <?}?>
            </div>
        </div>
    </div>
    <div class="info-apartment modal-footer">
        <div>
            <p>Свяжитесь с нашим специалистом, чтобы
                получить полную информацию</p>
        </div>
        <div>
            <div class="btn-wrap">
                <button class="btn btn-full" data-modal="modal-callback">Заказать обратный звонок</button>
            </div>
        </div>
    </div>
</div>


