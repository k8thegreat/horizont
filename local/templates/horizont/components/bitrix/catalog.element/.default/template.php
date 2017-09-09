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
                    <div class="loc-metro">
                        <?foreach($arResult["PROPERTIES"]["metro_id"]["VALUE_XML_ID"] as $val){?><?=getColoredIcon($val)?><?}?>
                        <?=$arResult["UF_METRO"]?>
                    </div>
                    <div class="dop-location">
                        <a href=""><?=$arResult["UF_SUBLOCALITY"] ?></a>, <?=$arResult["UF_ADDRESS"]?>
                    </div>
                </div>
                <div class="thumb">
                    <?if($arResult["PREVIEW_PICTURE"]["ID"]){
                        $file = CFile::ResizeImageGet($arResult["PREVIEW_PICTURE"]["ID"], array('width'=>370, 'height'=>500), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                        $img = '<img src="'.$file['src'].'" width="'.$file['width'].'" height="'.$file['height'].'" />';
                        echo $img;
					}?>
                </div>
            </div>
            <div>
                <div class="price-apartment">
                    <?$price = ($arResult["PROPERTIES"]["price_discount"]["VALUE"] ? $arResult["PROPERTIES"]["price_discount"]["VALUE"] : $arResult["PROPERTIES"]["price"]["VALUE"])?>
                    <span><?=number_format($price, 0, ".", " ")?></span> руб.
                    <ul>
                        <li>
                            <a href="">
                                <?=PDF_ICON?>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:CallPrint('apartment-detail');" class="print" title="Распечатать">
                                <?=PRINT_ICON?>
                            </a>
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
                        <?if($arResult["PROPERTIES"]["ready"]["VALUE"]){?>
                        <tr>
                            <td>Срок сдачи:</td>
                            <td><?=$arResult["PROPERTIES"]["ready"]["VALUE"]?> (<?=$arResult["PROPERTIES"]["building_section"]["VALUE"]?>)</td>
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
                    <?if($arResult["BANK"]){?>
                    <div class="btn-wrap">
                        <button class="btn btn-border">Калькулятор ипотеки</button>
                    </div>
                    <div class="gray-card">
                        <div class="close-card"></div>
                        <h4>Минимальная ставка банков: <b><?=$arResult["BANK"]["PROPERTY_RATE_VALUE"]?>%</b></h4>
                        <div class="mortgage-calculation">

                                <?php
                                if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' && $_REQUEST["calc_submit"]) {
                                $APPLICATION->RestartBuffer();

                                if(IntVal($_REQUEST["PRICE"]) && IntVal($_REQUEST["PERIOD"]) && IntVal($_REQUEST["RATE"])){
                                    if(IntVal($_REQUEST["SUM"])){
                                        $S = IntVal($_REQUEST["PRICE"]) - IntVal($_REQUEST["SUM"]);
                                    }else{
                                        $S = IntVal($_REQUEST["PRICE"]);
                                    }
                                    $rate = (1/12) * floatval($_REQUEST["RATE"])/100;
                                    $p = 1/12*floatval($_REQUEST["RATE"])/100;
                                    $m = $_REQUEST["PERIOD"]*12;
                                    $sum = $S*$rate*(1 + 1/((1+$rate)^$m -1));
                                //$sum =  ($S*$p) / (1-(1+$p)^(1-$m));
                                }

                                if ($sum){
                                $success_str = "<p>Ежемесячный платеж: <b>".number_format($sum,0,".", " ")." руб/мес.</b></p>";
                                }
                                ?>{"errorstr":"<?=$error_str?>","success":"<?=$success_str?>"}<?
                                die();
                                }else{
                                    ?>

                            <form id="calc-form" action="<?=$arResult["DETAIL_PAGE_URL"]?>" method="post" enctype="multipart/form-data" >

                                <input type="hidden" name="RATE" value="<?=$arResult["BANK"]["PROPERTY_RATE_VALUE"]?>"/>
                                    <div class="values">
                                        <label>
                                            <span>Стоимость квартиры, руб.</span>
                                            <input type="text" class="required" name="PRICE" value="<?=$arResult["PROPERTIES"]["price_discount"]["VALUE"]?>"/>
                                        </label>
                                        <label>
                                            <span>Первый взнос, руб.</span>
                                            <input type="text"  name="SUM" value=""/>
                                        </label>
                                        <label>
                                            <span>Срок ипотеки, лет</span>
                                            <input type="text"  name="PERIOD" class="required" value=""/>
                                        </label>
                                    </div>
                                    <div class="btn-center">
                                        <button type="submit" class="btn btn-full" value="Y" name="calc_submit">Рассчитать</button>
                                    </div>
                                    <div class="price-month">

                                    </div>

                                    </form>
                                    <script type="text/javascript">
                                        $(document).ready(function(){
                                            $("body").on("change", "#calc-form .required", function(){
                                                if($(this).val()) $(this).removeClass("error");
                                                else $(this).addClass("error");
                                            });
                                            var calc_form_options = {
                                                type: "post",
                                                dataType: "json",
                                                success: function(data){
                                                    $("#calc-form .btn").attr("disabled", "").removeClass("disabled");
                                                    if(data.errorstr){
                                                        $("#calc-form .errors").html(data.errorstr);
                                                    }else{
                                                        if(data.success){
                                                            $("#calc-form .errors").html("");
                                                            $("#calc-form .price-month").html(data.success);
                                                        }
                                                    }
                                                },
                                                beforeSubmit: function(){
                                                    var error = false;
                                                    $("#calc-form .errors").text();
                                                    $("#calc-form .required").each(function(){
                                                        if($(this).is("textarea")) var type="textarea"; else if($(this).is("input")) var type = $(this).attr("type");
                                                        switch (type) {
                                                            case 'text':
                                                            case 'textarea':
                                                                if(!$(this).val()){
                                                                    error = true;
                                                                    $(this).addClass("error");
                                                                }
                                                                break;
                                                        }
                                                    });

                                                    if(error == true) {
                                                        return false;
                                                    }
                                                    $("#calc-form .errors").html("");
                                                    $("#calc-form .btn").attr("disabled", "disabled").addClass("disabled");
                                                }
                                            }

                                            $('#calc-form').ajaxForm(calc_form_options);
                                        });

                                    </script>
                                <?}?>

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


