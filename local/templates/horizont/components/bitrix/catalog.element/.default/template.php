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
                    <span><?=number_format($arResult["PROPERTIES"]["price_discount"]["VALUE"], 0, ".", " ")?></span> руб.
                    <ul>
                        <li>
                            <a href="">
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                     viewBox="0 0 533.333 533.333" xml:space="preserve">
                                    <g>
                                        <path d="M438.548,307.021c-7.108-7.003-22.872-10.712-46.86-11.027c-16.238-0.179-35.782,1.251-56.339,4.129
                                            c-9.205-5.311-18.691-11.091-26.139-18.051c-20.033-18.707-36.755-44.673-47.175-73.226c0.679-2.667,1.257-5.011,1.795-7.403
                                            c0,0,11.284-64.093,8.297-85.763c-0.411-2.972-0.664-3.834-1.463-6.144l-0.98-2.518c-3.069-7.079-9.087-14.58-18.522-14.171
                                            l-5.533-0.176l-0.152-0.003c-10.521,0-19.096,5.381-21.347,13.424c-6.842,25.226,0.218,62.964,13.012,111.842l-3.275,7.961
                                            c-9.161,22.332-20.641,44.823-30.77,64.665l-1.317,2.581c-10.656,20.854-20.325,38.557-29.09,53.554l-9.05,4.785
                                            c-0.659,0.348-16.169,8.551-19.807,10.752c-30.862,18.427-51.313,39.346-54.706,55.946c-1.08,5.297-0.276,12.075,5.215,15.214
                                            l8.753,4.405c3.797,1.902,7.801,2.866,11.903,2.866c21.981,0,47.5-27.382,82.654-88.732
                                            c40.588-13.214,86.799-24.197,127.299-30.255c30.864,17.379,68.824,29.449,92.783,29.449c4.254,0,7.921-0.406,10.901-1.194
                                            c4.595-1.217,8.468-3.838,10.829-7.394c4.648-6.995,5.591-16.631,4.329-26.497C443.417,313.113,441.078,309.493,438.548,307.021z
                                             M110.233,423.983c4.008-10.96,19.875-32.627,43.335-51.852c1.475-1.196,5.108-4.601,8.435-7.762
                                            C137.47,403.497,121.041,419.092,110.233,423.983z M249.185,104.003c7.066,0,11.085,17.81,11.419,34.507
                                            c0.333,16.698-3.572,28.417-8.416,37.088c-4.012-12.838-5.951-33.073-5.951-46.304
                                            C246.237,129.294,245.942,104.003,249.185,104.003z M207.735,332.028c4.922-8.811,10.043-18.103,15.276-27.957
                                            c12.756-24.123,20.812-42.999,26.812-58.514c11.933,21.71,26.794,40.167,44.264,54.955c2.179,1.844,4.488,3.698,6.913,5.547
                                            C265.474,313.088,234.769,321.637,207.735,332.028z M431.722,330.027c-2.164,1.353-8.362,2.135-12.349,2.135
                                            c-12.867,0-28.787-5.883-51.105-15.451c8.575-0.635,16.438-0.957,23.489-0.957c12.906,0,16.729-0.056,29.349,3.163
                                            S433.885,328.674,431.722,330.027z M470.538,103.87L396.13,29.463C379.925,13.258,347.917,0,325,0H75
                                            C52.083,0,33.333,18.75,33.333,41.667v450c0,22.916,18.75,41.666,41.667,41.666h383.333c22.916,0,41.666-18.75,41.666-41.666V175
                                            C500,152.083,486.742,120.074,470.538,103.87z M446.968,127.44c1.631,1.631,3.255,3.633,4.833,5.893h-85.134V48.2
                                            c2.261,1.578,4.263,3.203,5.893,4.833L446.968,127.44z M466.667,491.667c0,4.517-3.816,8.333-8.333,8.333H75
                                            c-4.517,0-8.333-3.816-8.333-8.333v-450c0-4.517,3.817-8.333,8.333-8.333h250c2.517,0,5.341,0.318,8.334,0.887v132.446H465.78
                                            c0.569,2.993,0.887,5.816,0.887,8.333V491.667z"/>
                                    </g>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                     viewBox="0 0 508 508" xml:space="preserve">
                                <g>
                                    <g>
                                        <path d="M438.85,94.4h-36.8V14.1c0-7.8-6.3-14.1-14.1-14.1h-267.8c-7.8,0-14.1,6.3-14.1,14.1v80.2h-36.9
                                            c-38.1,0.1-69.1,31.1-69.1,69.3v139.3c0,38.1,31,69.1,69.1,69.1h36.9v121.9c0,7.8,6.3,14.1,14.1,14.1h267.7
                                            c7.8,0,14.1-6.3,14.1-14.1V372h36.8c38.2,0,69.2-31,69.2-69.1V163.6C508.05,125.4,477.05,94.4,438.85,94.4z M134.25,28.2h239.5
                                            v66.1h-239.5V28.2z M373.75,479.8h-239.5V323.6h239.5V479.8z M438.85,343.7h-36.8v-20.1h17.3c7.8,0,14.1-6.3,14.1-14.1
                                            c0-7.8-6.3-14.1-14.1-14.1H88.75c-7.8,0-14.1,6.3-14.1,14.1s6.3,14.1,14.1,14.1h17.3v20.1h-36.9c-22.6,0-40.9-18.4-40.9-40.9
                                            V163.6c0-22.6,18.4-41,40.9-41h369.6c22.6,0,41,18.4,41,41v139.2h0.1C479.85,325.4,461.45,343.7,438.85,343.7z"/>
                                    </g>
                                </g>
                                    <g>
                                        <g>
                                            <path d="M331.45,420.6h-154.8c-7.8,0-14.1,6.3-14.1,14.1c0,7.7,6.3,14.1,14.1,14.1h154.8c7.8,0,14.1-6.3,14.1-14.1
                C345.55,426.9,339.25,420.6,331.45,420.6z"/>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M331.45,359.5h-154.8c-7.8,0-14.1,6.3-14.1,14.1s6.3,14.1,14.1,14.1h154.8c7.8,0,14.1-6.3,14.1-14.1
                                            C345.55,365.8,339.25,359.5,331.45,359.5z"/>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <circle cx="433.45" cy="168.8" r="14.1"/>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <circle cx="433.45" cy="217.5" r="14.1"/>
                                        </g>
                                    </g>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                     viewBox="0 0 481.6 481.6" xml:space="preserve">
                                    <g>
                                        <path d="M381.6,309.4c-27.7,0-52.4,13.2-68.2,33.6l-132.3-73.9c3.1-8.9,4.8-18.5,4.8-28.4c0-10-1.7-19.5-4.9-28.5l132.2-73.8
                                            c15.7,20.5,40.5,33.8,68.3,33.8c47.4,0,86.1-38.6,86.1-86.1S429,0,381.5,0s-86.1,38.6-86.1,86.1c0,10,1.7,19.6,4.9,28.5
                                            l-132.1,73.8c-15.7-20.6-40.5-33.8-68.3-33.8c-47.4,0-86.1,38.6-86.1,86.1s38.7,86.1,86.2,86.1c27.8,0,52.6-13.3,68.4-33.9
                                            l132.2,73.9c-3.2,9-5,18.7-5,28.7c0,47.4,38.6,86.1,86.1,86.1s86.1-38.6,86.1-86.1S429.1,309.4,381.6,309.4z M381.6,27.1
                                            c32.6,0,59.1,26.5,59.1,59.1s-26.5,59.1-59.1,59.1s-59.1-26.5-59.1-59.1S349.1,27.1,381.6,27.1z M100,299.8
                                            c-32.6,0-59.1-26.5-59.1-59.1s26.5-59.1,59.1-59.1s59.1,26.5,59.1,59.1S132.5,299.8,100,299.8z M381.6,454.5
                                            c-32.6,0-59.1-26.5-59.1-59.1c0-32.6,26.5-59.1,59.1-59.1s59.1,26.5,59.1,59.1C440.7,428,414.2,454.5,381.6,454.5z"/>
                                    </g>
                                </svg>
                            </a>
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
                        <?if($arResult["PROPERTIES"]["renovation"]["VALUE"]){?>
                        <tr>
                            <td>Отделка:</td>
                            <td><?=$arResult["PROPERTIES"]["renovation"]["VALUE"]?></td>
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


