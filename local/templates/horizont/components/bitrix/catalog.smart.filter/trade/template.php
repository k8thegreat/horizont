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
<div class="mobile-nav-filter">
    <button class="filter-back"><?=ARROW_LEFT_BLUE?>Назад</button>
    <button class="reset-filter">Сбросить все</button>
</div>
<div class="filter-bar">
    <form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="smartfilter">
        <?/*foreach($arResult["HIDDEN"] as $arItem):?>
            <input type="hidden" name="<?echo $arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
        <?endforeach;*/?>
        <input type="hidden" name="sort" value="price"/>
        <input type="hidden" name="PAGEN_1" value="1"/>
        <div class="drop-filter-bar">
            <div class="drop-filter">
                <div>
                    <div class="input-default drop-wrapper areas-locations">
                        <button class="drop-btn">Районы, локации</button>
                        <div class="drop-body">
                            <div class="location-tabs">
                                <div class="drop-nav three-filter">
                                    <ul>
                                        <li><a href="#tab-district">Районы</a></li>
                                        <li><a href="#tab-metro">Метро</a></li>
                                    </ul>
                                    <label class="input-default">
                                        <input type="text" placeholder="Введите название" value="" id="location-input">
                                    </label>
                                </div>
                                <div class="drop-content">
                                    <div class="location-items">
                                        <ul class="drop-list">
                                    <?foreach ($arResult["ITEMS"][47]["VALUES"] as $item){?>
                                            <li data-tab="tab-district">
                                                <label class="checkbox" for="<?=$item["CONTROL_ID"]?>">
                                                    <input type="checkbox" onclick="smartFilter.click(this)" data-filter="checkbox" value="<?=$item["HTML_VALUE"]?>" id="<?=$item["CONTROL_ID"]?>" name="<?=$item["CONTROL_NAME"]?>" <? echo $item["CHECKED"]? 'checked="checked"': '' ?>/>
                                                    <span data-name="<?=$item["CONTROL_NAME"]?>"><?=$item["VALUE"]?></span>
                                                </label>
                                            </li><?
                                    }?>
                                    <?foreach ($arResult["ITEMS"][57]["VALUES"] as $item){?>
                                            <li data-tab="tab-metro">
                                                <label class="checkbox" for="<?=$item["CONTROL_ID"]?>">
                                                    <input type="checkbox" onclick="smartFilter.click(this)" data-filter="checkbox" value="<?=$item["HTML_VALUE"]?>" id="<?=$item["CONTROL_ID"]?>" name="<?=$item["CONTROL_NAME"]?>" <? echo $item["CHECKED"]? 'checked="checked"': '' ?>/>
                                                    <span data-name="<?=$item["CONTROL_NAME"]?>"><?=$item["VALUE"]?></span>
                                                </label>
                                            </li><?
                                    }?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="wrap-btn">
                                <button class="reset-filter-small">Сбросить</button>
                                <button class="btn btn-full">OK</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="input-default drop-wrapper deadline">
                        <button class="drop-btn">Срок сдачи</button>
                        <div class="drop-body">
                            <div class="drop-content">
                                <div class="drop-content">
                                    <ul class="drop-list">
                                        <?foreach ($arResult["ITEMS"][51]["VALUES"] as $item){?>
                                            <li>
                                            <label class="checkbox" for="<?=$item["CONTROL_ID"]?>">
                                                <input type="checkbox" onclick="smartFilter.click(this)" data-filter="checkbox" value="<?=$item["HTML_VALUE"]?>" id="<?=$item["CONTROL_ID"]?>" name="<?=$item["CONTROL_NAME"]?>" <? echo $item["CHECKED"]? 'checked="checked"': '' ?>/>
                                                <span data-name="<?=$item["CONTROL_NAME"]?>"><?=$item["VALUE"]?></span>
                                            </label>
                                            </li><?
                                        }?>
                                    </ul>
                                </div>
                            </div>
                            <div class="wrap-btn">
                                <button class="reset-filter-small">Сбросить</button>
                                <button class="btn btn-full">OK</button>
                            </div>
                        </div>

                    </div>
                </div>
                <div>
                    <div class="input-default drop-wrapper type-apartment">
                        <button class="drop-btn">Тип квартиры</button>
                        <div class="drop-body">
                            <div class="drop-content">
                                <ul class="drop-list">
                                    <?foreach ($arResult["ITEMS"][59]["VALUES"] as $item){?>
                                        <li>
                                        <label class="checkbox" for="<?=$item["CONTROL_ID"]?>">
                                            <input type="checkbox" onclick="smartFilter.click(this)" data-filter="checkbox" value="<?=$item["HTML_VALUE"]?>" id="<?=$item["CONTROL_ID"]?>" name="<?=$item["CONTROL_NAME"]?>" <? echo $item["CHECKED"]? 'checked="checked"': '' ?>/>
                                            <span data-name="<?=$item["CONTROL_NAME"]?>"><?=$item["VALUE"]?></span>
                                        </label>
                                        </li><?
                                    }?>
                                </ul>
                            </div>
                            <div class="wrap-btn">
                                <button class="reset-filter-small">Сбросить</button>
                                <button class="btn btn-full">OK</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="input-default drop-wrapper price">
                        <button class="drop-btn">Цена, тыс. руб.</button>
                        <div class="drop-body">
                            <div class="drop-content">
                                <div class="drop-nav">
                                    <label class="input-default">
                                        <?
                                        $arItem = $arResult["ITEMS"][55];
                                        if($arItem["VALUES"]){
                                            ?>
                                            <input type="text" placeholder="От" onchange="smartFilter.change(this)" name="<?=$arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>" id="price_to_input" value="<?=$_REQUEST[$arItem["VALUES"]["MIN"]["CONTROL_NAME"]]?>"/>
                                        <?}?>
                                    </label>
                                </div>
                                <div class="drop-content">
                                    <ul class="drop-list price-range" id="price_to">
                                        <?
                                        $step = 500000;
                                        $min = floor($arResult["ITEMS"][55]["VALUES"]["MIN"]["VALUE"] / $step);
                                        $max = ceil($arResult["ITEMS"][55]["VALUES"]["MAX"]["VALUE"] / $step);
                                        for($i = $min; $i<= $max; $i++){
                                            ?>
                                            <li>
                                                <label class="checkbox">
                                                    <input type="radio" name="price_to" value="<?=$step*$i?>" data-filter="radio_price" <?=($arItem["VALUES"]["MIN"]["CONTROL_NAME"] == $step*$i ? "checked" : "")?>>
                                                    <span data-value="<?=$step*$i?>"><?=number_format($step*$i, 0, ".", " ")?></span>
                                                </label>
                                            </li>
                                            <?
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="drop-content">
                                <div class="drop-nav">
                                    <label class="input-default">
                                        <?
                                        $arItem = $arResult["ITEMS"][55];
                                        if($arItem["VALUES"]){
                                            ?>
                                            <input type="text" placeholder="До" onchange="smartFilter.change(this)" name="<?=$arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>" id="price_do_input" value="<?=$_REQUEST[$arItem["VALUES"]["MAX"]["CONTROL_NAME"]]?>"/>
                                        <?}?>
                                    </label>
                                </div>
                                <div class="drop-content">
                                    <ul class="drop-list price-range" id="price_do">
                                        <?
                                        for($i = $min; $i<= $max; $i++){
                                            ?>
                                            <li>
                                                <label class="checkbox">
                                                    <input type="radio" name="price_do" value="<?=$step*$i?>" data-filter="radio_price" <?=($arItem["VALUES"]["MAX"]["CONTROL_NAME"] == $step*$i ? "checked" : "")?>>
                                                    <span data-value="<?=$step*$i?>"><?=number_format($step*$i, 0, ".", " ")?></span>
                                                </label>
                                            </li>
                                            <?
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="wrap-btn">
                                <button class="reset-filter-small">Сбросить</button>
                                <button class="btn btn-full">OK</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="modef">
                <a class="btn btn-full"  href="<?echo $arResult["FILTER_URL"]?>">Показать <span id="modef_num"><?=intval($arResult["ELEMENT_COUNT"])?></span></a>
            </div>
        </div>
        <div class="search-bar">
            <label class="input-default" for="autocomplete">
                <input type="text" placeholder="Поиск по названию застройщика или ЖК" class="search" id="autocomplete" value=""/>
                <?/*;foreach ($arResult["ITEMS"][32]["VALUES"] as $i => $item) {
                    $arValues[] = $item["VALUE"];
                }
                foreach ($arResult["ITEMS"][33]["VALUES"] as $i => $item) {
                    $arValues[] = $item["VALUE"];
                }*/
                ?>
                <div style="display: none;">
                    <?foreach (array_merge($arResult["ITEMS"][48]["VALUES"], $arResult["ITEMS"][49]["VALUES"], $arResult["ITEMS"][66]["VALUES"]) as $item){?>
                        <label class="hidden" for="<?=$item["CONTROL_ID"]?>">
                            <input type="checkbox" data-filter="checkbox" onclick="smartFilter.click(this)" value="<?=$item["HTML_VALUE"]?>" id="<?=$item["CONTROL_ID"]?>" name="<?=$item["CONTROL_NAME"]?>" <? echo $item["CHECKED"]? 'checked="checked"': '' ?>/>
                            <span data-name="<?=$item["CONTROL_NAME"]?>"><?=$item["VALUE"]?></span>
                        </label>
                    <?}?>
                </div>
                <div class="ui-front" id="search-general"></div>
            </label>
            <div class="advanced-search-nav">
                <button class="advanced-search-btn">Расширенный поиск</button>
            </div>
        </div>

        <div class="filter-bar-bottom">
            <div class="additional-filter">
                <div class="additional-filter-content">
                    <div class="drop-filter">
                        <div>
                            <div class="input-default drop-wrapper no-title-wrapper">
                                <button class="drop-btn">Отделка</button>
                                <div class="drop-body">
                                    <div class="drop-content">
                                        <ul class="drop-list">
                                            <?foreach ($arResult["ITEMS"][56]["VALUES"] as $item){?>
                                                <li>
                                                <label class="checkbox" for="<?=$item["CONTROL_ID"]?>">
                                                    <input data-filter="checkbox"  type="checkbox" onclick="smartFilter.click(this)" value="<?=$item["HTML_VALUE"]?>" id="<?=$item["CONTROL_ID"]?>" name="<?=$item["CONTROL_NAME"]?>" <? echo $item["CHECKED"]? 'checked="checked"': '' ?>/>
                                                    <span data-name="<?=$item["CONTROL_NAME"]?>"><?=$item["VALUE"]?></span>
                                                </label>
                                                </li><?
                                            }?>
                                        </ul>
                                    </div>
                                    <div class="wrap-btn">
                                        <button class="btn btn-full">OK</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="input-default input-group" data-input="sqr_all">
                                <h3 class="input-group-title"><span>S общая, кв.м</span></h3>
                                <?
                                $arItem = $arResult["ITEMS"][53];
                                if($arItem["VALUES"]){
                                    ?>
                                    <input type="text" class="sqr to" placeholder="От" onchange="smartFilter.change(this)" name="<?=$arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>" id="<?=$arItem["VALUES"]["MIN"]["CONTROL_ID"]?>" value="<?=$arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"/>
                                    <input type="text" class="sqr do" placeholder="До" onchange="smartFilter.change(this)" name="<?=$arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>" id="<?=$arItem["VALUES"]["MAX"]["CONTROL_ID"]?>" value="<?=$arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"/>
                                <?}?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="additional-filter-nav">

                </div>
            </div>
            <div class="filters">

            </div>
        </div>
    </form>
</div>


<script type="text/javascript">
    var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
    smartFilter.set(BX("smartfilter"));
    $(document).ready(function() {
        var data = [
            <?
            foreach ($arResult["ITEMS"][49]["VALUES"] as $i => $item) {
                echo '{ value: "'.addslashes(htmlspecialchars_decode($item["VALUE"])).'", label: "'.addslashes(htmlspecialchars_decode($item["VALUE"])).'", category: "Застройщики", control: "'.$item["CONTROL_NAME"].'"},';
            }
            foreach ($arResult["ITEMS"][48]["VALUES"] as $i => $item) {
                echo '{ value: "'.addslashes(htmlspecialchars_decode($item["VALUE"])).'", label: "'.addslashes(htmlspecialchars_decode($item["VALUE"])).'", category: "ЖК", control: "'.$item["CONTROL_NAME"].'"},';
            }
            foreach ($arResult["ITEMS"][66]["VALUES"] as $i => $item) {
                echo '{ value: "'.addslashes(htmlspecialchars_decode($item["VALUE"])).'", label: "'.addslashes(htmlspecialchars_decode($item["VALUE"])).'", category: "ID", control: "'.$item["CONTROL_NAME"].'"},';
            }
            foreach ($arResult["ITEMS"][47]["VALUES"] as $i => $item) {
                echo '{ value: "'.addslashes(htmlspecialchars_decode($item["VALUE"])).'", label: "'.addslashes(htmlspecialchars_decode($item["VALUE"])).' р-н", category: "Районы", control: "'.$item["CONTROL_NAME"].'"},';
            }
            foreach ($arResult["ITEMS"][57]["VALUES"] as $i => $item) {
                echo '{ value: "'.addslashes(htmlspecialchars_decode($item["VALUE"])).'", label: "м. '.addslashes(htmlspecialchars_decode($item["VALUE"])).'", category: "Станции метро", control: "'.$item["CONTROL_NAME"].'"},';
            }
            ?>
        ];
        $.widget( "custom.catcomplete", $.ui.autocomplete, {
            _create: function() {
                this._super();
                this.widget().menu( "option", "items", "> :not(.ui-autocomplete-category)" );
            },
            _renderMenu: function( ul, items ) {
                var that = this,
                    currentCategory = "";
                $.each( items, function( index, item ) {
                    var li;
                    if ( item.category != currentCategory ) {
                        ul.append( "<li class='ui-autocomplete-category'>" + item.category + "</li>" );
                        currentCategory = item.category;
                    }
                    li = that._renderItemData( ul, item );
                    if ( item.category ) {
                        li.attr( "aria-label", item.category + " : " + item.label );
                        $("div", $(li)).attr("data-control", item.control);
                    }
                });
            }
        });
        var charMap = {
            'q' : 'й', 'w' : 'ц', 'e' : 'у', 'r' : 'к', 't' : 'е', 'y' : 'н', 'u' : 'г', 'i' : 'ш', 'o' : 'щ', 'p' : 'з', '[' : 'х', ']' : 'ъ', 'a' : 'ф', 's' : 'ы', 'd' : 'в', 'f' : 'а', 'g' : 'п', 'h' : 'р', 'j' : 'о', 'k' : 'л', 'l' : 'д', ';' : 'ж', '\'' : 'э', 'z' : 'я', 'x' : 'ч', 'c' : 'с', 'v' : 'м', 'b' : 'и', 'n' : 'т', 'm' : 'ь', ',' : 'б', '.' : 'ю','Q' : 'Й', 'W' : 'Ц', 'E' : 'У', 'R' : 'К', 'T' : 'Е', 'Y' : 'Н', 'U' : 'Г', 'I' : 'Ш', 'O' : 'Щ', 'P' : 'З', '[' : 'Х', ']' : 'Ъ', 'A' : 'Ф', 'S' : 'Ы', 'D' : 'В', 'F' : 'А', 'G' : 'П', 'H' : 'Р', 'J' : 'О', 'K' : 'Л', 'L' : 'Д', ';' : 'Ж', '\'' : 'Э', 'Z' : '?', 'X' : 'ч', 'C' : 'С', 'V' : 'М', 'B' : 'И', 'N' : 'Т', 'M' : 'Ь', ',' : 'Б', '.' : 'Ю',
        };
        function toTranslit(text) {
            return text.replace(/([а-яё])|([\s_-])|([^a-z\d])/gi,
                function (all, ch, space, words, i) {
                    if (space || words) {
                        return space ? '-' : '';
                    }
                    var code = ch.charCodeAt(0),
                        index = code == 1025 || code == 1105 ? 0 :
                            code > 1071 ? code - 1071 : code - 1039,
                        t = ['yo', 'a', 'b', 'v', 'g', 'd', 'e', 'zh',
                            'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p',
                            'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh',
                            'shch', '', 'y', '', 'e', 'yu', 'ya'
                        ];
                    return t[index];
                });
        }
        function changeKeyboardLayout(str){
            var r = '';
            for (var i = 0; i < str.length; i++) {
                r += charMap[str.charAt(i)] || str.charAt(i);
            }
            return r;
        }
        function testValue(item, term){
            if (-1 < item.toUpperCase().indexOf(term.toUpperCase())) {
                return true;
            }else{
                if(-1 < item.toUpperCase().indexOf(changeKeyboardLayout(term.toUpperCase()))){
                    return true;
                }
                else {
                    if (-1 < toTranslit(item).indexOf(term))
                        return true;
                }
            }
            return false;
        }
        $("#autocomplete").catcomplete({
            delay: 0,
            minLength:0,
            source: function( request, response ) {
                response( $.grep( data, function(item){
                    return testValue( item.value, request.term);
                }) );
            },
            appendTo: "#search-general",
            select: function(event, ui){
                var control_name = ui.item.control;
                $("[name='"+control_name+"']").click();
                $("#autocomplete").val("");
            },
            response: function( event, ui ) {
                if(!ui.content.length){
                    $("#autocomplete").catcomplete("search", " ");

                }
            }
        });
    });
</script>

