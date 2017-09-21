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
<div id="apartment-detail">
    <h2 class="title-big"><?=$arResult["PROPERTIES"]["gk"]["VALUE"]?></h2>
    <div class="info-apartment">
        <div>
            <div class="build-short-info">
                <div class="loc-metro">
                    <svg version="1.1" class="ico-metro" xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink"
                         x="0px" y="0px" width="14px" height="14px" viewBox="0 0 94.69 94.691" xml:space="preserve">
                        <g>
                            <path d="M62.695,10.642l-15.35,48.393L31.996,10.642C13.737,16.918,0,33.943,0,53.461c0,11.756,4.796,22.597,12.555,30.587h22.254
                                l2.333-10.117C10.556,63.514,15.583,31.235,25.221,25.966C26.365,26.31,43.129,83.81,43.129,83.81c0.229,0,0.973,0,1.882,0
                                c0.192,0,0.915,0,1.816,0c0.326,0,0.678,0,1.035,0c0.612,0,1.247,0,1.815,0c0.91,0,1.653,0,1.883,0c0,0,16.765-57.5,17.908-57.844
                                c9.639,5.269,14.664,37.548-11.922,47.965l2.334,10.117h22.254c7.76-7.99,12.556-18.831,12.556-30.587
                                C94.69,33.943,80.953,16.918,62.695,10.642z"></path>
                        </g>
                    </svg>
                    <?=$arResult["PROPERTIES"]["metro"]["VALUE"]?>
                    </svg>

                </div>
                <div class="dop-location">
                    <?=$arResult["PROPERTIES"]["rayon"]["VALUE"]?>
                </div>
            </div>
            <div class="thumb">
                <?if($arResult["PREVIEW_PICTURE"]["ID"]){
                    $file = CFile::ResizeImageGet($arResult["PREVIEW_PICTURE"]["ID"], array('width'=>370, 'height'=>360), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                    $img = '<img src="'.$file['src'].'" width="'.$file['width'].'" height="'.$file['height'].'" />';
                    ?><a href="<?=CFile::GetPath($arResult["PREVIEW_PICTURE"]["ID"])?>" data-fancybox="image"><?=$img?></a><?
                }?>
            </div>
        </div>
        <div>
            <div class="price-apartment">
                <span><?=$arResult["PROPERTIES"]["price"]["VALUE"]?></span> руб.
                <ul>
                    <li>
                        <a href="/get_pdf.php?ID=<?=$arResult["ID"]?>">
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
                    <?if($arResult["PROPERTIES"]["builder"]["VALUE"]){?>
                        <tr>
                            <td>Застройщик:</td>
                            <td><?=$arResult["PROPERTIES"]["builder"]["VALUE"]?></td>
                        </tr>
                    <?}?>
                    <?if($arResult["PROPERTIES"]["deadline"]["VALUE"]){?>
                        <tr>
                            <td>Срок сдачи:</td>
                            <td><?=$arResult["PROPERTIES"]["deadline"]["VALUE"]?></td>
                        </tr>
                    <?}?>
                    <?if($arResult["PROPERTIES"]["otdelka"]["VALUE"]){?>
                        <tr>
                            <td>Отделка:</td>
                            <td><?=$arResult["PROPERTIES"]["otdelka"]["VALUE"]?></td>
                        </tr>
                    <?}?>
                    <?if($arResult["PROPERTIES"]["rooms"]["VALUE"]){?>
                        <tr>
                            <td>Кол-во комнат:</td>
                            <td><?=$arResult["PROPERTIES"]["rooms"]["VALUE"]?></td>
                        </tr>
                    <?}?>
                    <?if($arResult["PROPERTIES"]["sGeneral"]["VALUE"]){?>
                        <tr>
                            <td>Пл. общая</td>
                            <td><?=$arResult["PROPERTIES"]["sGeneral"]["VALUE"]?> м²</td>
                        </tr>
                    <?}?>
                    <?if($arResult["PROPERTIES"]["corpus"]["VALUE"]){?>
                        <tr>
                            <td>Корпус</td>
                            <td><?=$arResult["PROPERTIES"]["corpus"]["VALUE"]?></td>
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
                                    $rate = floatval($_REQUEST["RATE"])/100/12;
                                    $m = IntVal($_REQUEST["PERIOD"])*12;
                                    $sum = $S*($rate/(1-pow(1+$rate, -$m)));
                                }

                                if ($sum){
                                    $success_str = "<p>Ежемесячный платеж: <b>".number_format($sum,0,".", " ")." руб/мес.</b></p>";
                                }
                                ?>{"errorstr":"<?=$error_str?>","success":"<?=$success_str?>"}<?
                                die();
                            }else{
                                ?>

                                <form id="calc-form" action="<?=$arResult["DETAIL_PAGE_URL"]?>" method="post" enctype="multipart/form-data" >
                                    <div class="values">
                                        <label>
                                            <span>Процентная ставка, %</span>
                                            <input type="text" class="required" name="RATE" value="<?=$arResult["BANK"]["PROPERTY_RATE_VALUE"]?>"/>
                                        </label>
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