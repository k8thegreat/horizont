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
    <button class="filter-back">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 451.847 451.847" xml:space="preserve">
            <g>
                <path d="M225.923,354.706c-8.098,0-16.195-3.092-22.369-9.263L9.27,151.157c-12.359-12.359-12.359-32.397,0-44.751   c12.354-12.354,32.388-12.354,44.748,0l171.905,171.915l171.906-171.909c12.359-12.354,32.391-12.354,44.744,0   c12.365,12.354,12.365,32.392,0,44.751L248.292,345.449C242.115,351.621,234.018,354.706,225.923,354.706z"/>
            </g>
        </svg>
        Назад</button>
    <button class="reset-filter">Сбросить все</button>
</div>
<div class="filter-bar">
    <form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="smartfilter">
        <?foreach($arResult["HIDDEN"] as $arItem):?>
            <input type="hidden" name="<?echo $arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
        <?endforeach;?>

        <div class="drop-filter-bar">
            <div class="drop-filter">
                <div>
                    <div class="input-default drop-wrapper areas-locations">
                        <button class="drop-btn">Районы, локации</button>
                        <div class="drop-body">
                            <div class="tabs">
                            <div class="drop-nav three-filter">
                                <ul>
                                    <li><a href="#tab-district">Районы</a></li>
                                    <li><a href="#tab-metro">Метро</a></li>
                                    <li><a href="#tab-location">Локации</a></li>
                                </ul>
                                <label class="input-default">
                                    <input type="text" placeholder="Введите название" id="location-filter-input" value="">
                                </label>
                            </div>
                            <div class="drop-content location-items">
                                <ul class="drop-list" id="tab-district">
                                    <?foreach ($arResult["ITEMS"][2]["VALUES"] as $item){?>
                                        <li>
                                        <label class="checkbox" for="<?=$item["CONTROL_ID"]?>">
                                            <input type="checkbox" onclick="smartFilter.click(this)" value="<?=$item["HTML_VALUE"]?>" id="<?=$item["CONTROL_ID"]?>" name="<?=$item["CONTROL_NAME"]?>" <? echo $item["CHECKED"]? 'checked="checked"': '' ?>/>
                                            <span data-name="<?=$item["CONTROL_NAME"]?>"><?=$item["VALUE"]?></span>
                                        </label>
                                        </li><?
                                    }?>
                                </ul>
                                <ul class="drop-list" id="tab-metro">
                                    <?foreach ($arResult["ITEMS"][3]["VALUES"] as $item){?>
                                        <li>
                                        <label class="checkbox" for="<?=$item["CONTROL_ID"]?>">
                                            <input type="checkbox" onclick="smartFilter.click(this)" value="<?=$item["HTML_VALUE"]?>" id="<?=$item["CONTROL_ID"]?>" name="<?=$item["CONTROL_NAME"]?>" <? echo $item["CHECKED"]? 'checked="checked"': '' ?>/>
                                            <span data-name="<?=$item["CONTROL_NAME"]?>"><?=$item["VALUE"]?></span>
                                        </label>
                                        </li><?
                                    }?>
                                </ul>
                                <ul class="drop-list" id="tab-location">
                                    <?foreach (array_merge($arResult["ITEMS"][61]["VALUES"], $arResult["ITEMS"][1]["VALUES"]) as $item){?>
                                        <li>
                                        <label class="checkbox" for="<?=$item["CONTROL_ID"]?>">
                                            <input type="checkbox" onclick="smartFilter.click(this)" value="<?=$item["HTML_VALUE"]?>" id="<?=$item["CONTROL_ID"]?>" name="<?=$item["CONTROL_NAME"]?>" <? echo $item["CHECKED"]? 'checked="checked"': '' ?>/>
                                            <span data-name="<?=$item["CONTROL_NAME"]?>"><?=$item["VALUE"]?></span>
                                        </label>
                                        </li><?
                                    }?>
                                </ul>
                            </div>
                            </div>
                            <div class="wrap-btn">
                                <button class="reset-filter">Сбросить</button>
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
                                        <?
                                        $currQuarter = ceil(date("n")/3);
                                        $currYear = intval(date("Y"));
                                        ?>
                                        <li>
                                            <label class="checkbox" for="arrFilter_63_<?=$currYear?>_<?=$currQuarter?>">
                                                <input class="deadline-ready" type="radio" name="arrFilter_63_MAX" value="<?=$currYear.".".$currQuarter?>" id="arrFilter_63_<?=$currYear?>_<?=$currQuarter?>" onclick="smartFilter.click(this)"/>
                                                <span data-name="arrFilter_63">Сдан</span>
                                            </label>
                                        </li>
                                        <?

                                        for ($year=$currYear; $year<($currYear+5); $year++){
                                            for($quarter=1; $quarter<5;$quarter++){
                                                if($year==$currYear && $quarter<=$currQuarter) continue;
                                                $value = $year.".".$quarter;
                                                ?>
                                                <li>
                                                <label class="checkbox" for="arrFilter_63_<?=$year?>_<?=$quarter?>">
                                                    <input class="deadline-date" type="radio" name="arrFilter_63_MAX" class="checkbox" onclick="smartFilter.click(this)"
                                                           value="<?=$value?>"
                                                           id="arrFilter_63_<?=$year?>_<?=$quarter?>"<?=(($_REQUEST["arrFilter_63_MAX"]==$value) ? " checked" : "")?> />
                                                    <span data-name="arrFilter_63">до <?= $quarter." кв. ".$year ?></span>
                                                </label>
                                                </li><?
                                            }
                                        }?>
                                    </ul>
                                </div>
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
                                    <?foreach ($arResult["ITEMS"][22]["VALUES"] as $item){?>
                                        <li>
                                        <label class="checkbox" for="<?=$item["CONTROL_ID"]?>">
                                            <input type="checkbox" onclick="smartFilter.click(this)" value="<?=$item["HTML_VALUE"]?>" id="<?=$item["CONTROL_ID"]?>" name="<?=$item["CONTROL_NAME"]?>" <? echo $item["CHECKED"]? 'checked="checked"': '' ?>/>
                                            <span data-name="<?=$item["CONTROL_NAME"]?>"><?=$item["VALUE"]?></span>
                                        </label>
                                        </li><?
                                    }?>
                                </ul>
                            </div>
                            <div class="wrap-btn">
                                <button class="reset-filter">Сбросить</button>
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
                                        $arItem = $arResult["ITEMS"][27];
                                        if($arItem["VALUES"]){
                                            ?>
                                            <input type="text" placeholder="От" onkeyup="smartFilter.keyup(this)" name="<?=$arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>" id="<?=$arItem["VALUES"]["MIN"]["CONTROL_ID"]?>" value="<?=$arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"/>
                                            <?}?>
                                    </label>
                                </div>
                            </div>
                            <div class="drop-content">
                                <div class="drop-nav">
                                    <label class="input-default">
                                        <?
                                        $arItem = $arResult["ITEMS"][27];
                                        if($arItem["VALUES"]){
                                            ?>
                                            <input type="text" placeholder="До" onkeyup="smartFilter.keyup(this)" name="<?=$arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>" id="<?=$arItem["VALUES"]["MAX"]["CONTROL_ID"]?>" value="<?=$arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"/>
                                         <?}?>
                                    </label>
                                </div>
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
                <?foreach (array_merge($arResult["ITEMS"][32]["VALUES"], $arResult["ITEMS"][33]["VALUES"]) as $item){?>
                    <label class="checkbox hidden" for="<?=$item["CONTROL_ID"]?>">
                        <input type="checkbox" onclick="smartFilter.click(this)" value="<?=$item["HTML_VALUE"]?>" id="<?=$item["CONTROL_ID"]?>" name="<?=$item["CONTROL_NAME"]?>" <? echo $item["CHECKED"]? 'checked="checked"': '' ?>/>
                        <span data-name="<?=$item["CONTROL_NAME"]?>"><?=$item["VALUE"]?></span>
                    </label>
                <?}?>
                </div>
                <script type="text/javascript">
                    $(document).ready(function() {
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
                            },
                        });
                        var data = [
                            <?
                            foreach ($arResult["ITEMS"][32]["VALUES"] as $i => $item) {
                                echo '{ label: "'.addslashes(htmlspecialchars_decode($item["VALUE"])).'", category: "Застройщики", control: "'.$item["CONTROL_NAME"].'"},';
                            }
                            foreach ($arResult["ITEMS"][33]["VALUES"] as $i => $item) {
                                echo '{ label: "'.addslashes(htmlspecialchars_decode($item["VALUE"])).'", category: "ЖК", control: "'.$item["CONTROL_NAME"].'"},';
                            }
                            foreach ($arResult["ITEMS"][2]["VALUES"] as $i => $item) {
                                echo '{ label: "'.addslashes(htmlspecialchars_decode($item["VALUE"])).'", category: "Районы", control: "'.$item["CONTROL_NAME"].'"},';
                            }
                            foreach ($arResult["ITEMS"][3]["VALUES"] as $i => $item) {
                                echo '{ label: "м.'.addslashes(htmlspecialchars_decode($item["VALUE"])).'", category: "Станции метро", control: "'.$item["CONTROL_NAME"].'"},';
                            }
                            foreach ($arResult["ITEMS"][1]["VALUES"] as $i => $item) {
                                echo '{ label: "'.addslashes(htmlspecialchars_decode($item["VALUE"])).'", category: "Локации", control: "'.$item["CONTROL_NAME"].'"},';
                            }
                            ?>

                        ];

                        $("#autocomplete").catcomplete({
                            delay: 0,
                            source: data,
                            appendTo: ".ui-front"
                        });
                        $("body").on("click", ".ui-menu-item-wrapper", function(){
                            var control_name = $(this).attr("data-control");
                            //$(".hidden-items").prop("checked", false);
                            $("[name='"+control_name+"']").click();
                            $("#autocomplete").val("");
                        });
                        });
                </script>
                <div class="ui-front"></div>
            </label>
            <div class="advanced-search-nav">
                <label class="checkbox show-el-map">
                    <input type="checkbox" name="view" value="map" <?=($_REQUEST["view"]=="map" ? "checked" : "")?> onclick="smartFilter.click(this)" />
                    <span>Показать объекты на карте</span>
                </label>
                <button class="advanced-search-btn">Расширенный поиск</button>
            </div>
        </div>

        <div class="filter-bar-bottom">
            <div class="additional-filter">
                <div class="additional-filter-content">
                    <div class="drop-filter">
                        <div>
                            <div class="input-default drop-wrapper">
                                <button class="drop-btn">Оплата</button>
                                <div class="drop-body">

                                    <div class="drop-content">
                                        <ul class="drop-list">
                                            <?foreach ($arResult["ITEMS"][35]["VALUES"] as $item){?>
                                                <li>
                                                <label class="checkbox" for="<?=$item["CONTROL_ID"]?>">
                                                    <input type="checkbox" onclick="smartFilter.click(this)" value="<?=$item["HTML_VALUE"]?>" id="<?=$item["CONTROL_ID"]?>" name="<?=$item["CONTROL_NAME"]?>" <? echo $item["CHECKED"]? 'checked="checked"': '' ?>/>
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
                            <div class="input-default drop-wrapper">
                                <button class="drop-btn">Отделка</button>
                                <div class="drop-body">
                                    <div class="drop-content">
                                        <ul class="drop-list">
                                            <?foreach ($arResult["ITEMS"][24]["VALUES"] as $item){?>
                                                <li>
                                                <label class="checkbox" for="<?=$item["CONTROL_ID"]?>">
                                                    <input type="checkbox" onclick="smartFilter.click(this)" value="<?=$item["HTML_VALUE"]?>" id="<?=$item["CONTROL_ID"]?>" name="<?=$item["CONTROL_NAME"]?>" <? echo $item["CHECKED"]? 'checked="checked"': '' ?>/>
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
                            <div class="input-default drop-wrapper">
                                <button class="drop-btn">Санузел</button>
                                <div class="drop-body">
                                    <div class="drop-content">
                                        <ul class="drop-list">
                                            <?foreach ($arResult["ITEMS"][18]["VALUES"] as $item){?>
                                                <li>
                                                <label class="checkbox" for="<?=$item["CONTROL_ID"]?>">
                                                    <input type="checkbox"  onclick="smartFilter.click(this)" value="<?=$item["HTML_VALUE"]?>" id="<?=$item["CONTROL_ID"]?>" name="<?=$item["CONTROL_NAME"]?>" <? echo $item["CHECKED"]? 'checked="checked"': '' ?>/>
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
                            <div class="input-default drop-wrapper">
                                <button class="drop-btn">Город и обл.</button>
                                <div class="drop-body">
                                    <div class="drop-content">
                                        <ul class="drop-list">
                                            <?foreach ($arResult["ITEMS"][46]["VALUES"] as $item){?>
                                                <li>
                                                <label class="checkbox" for="<?=$item["CONTROL_ID"]?>">
                                                    <input type="checkbox" onclick="smartFilter.click(this)" value="<?=$item["HTML_VALUE"]?>" id="<?=$item["CONTROL_ID"]?>" name="<?=$item["CONTROL_NAME"]?>" <? echo $item["CHECKED"]? 'checked="checked"': '' ?>/>
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
                            <div class="input-default input-group">
                                <h3 class="input-group-title">S общая, кв.м</h3>
                                <?
                                $arItem = $arResult["ITEMS"][15];
                                if($arItem["VALUES"]){
                                    ?>
                                    <input type="text" placeholder="От" onkeyup="smartFilter.keyup(this)" name="<?=$arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>" id="<?=$arItem["VALUES"]["MIN"]["CONTROL_ID"]?>" value="<?=$arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"/>
                                    <input type="text" placeholder="До" onkeyup="smartFilter.keyup(this)" name="<?=$arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>" id="<?=$arItem["VALUES"]["MAX"]["CONTROL_ID"]?>" value="<?=$arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"/>
                                <?}?>
                            </div>
                        </div>
                        <div>
                            <div class="input-default input-group">
                                <h3 class="input-group-title">S кухни, кв.м</h3>
                                <?
                                $arItem = $arResult["ITEMS"][17];
                                if($arItem["VALUES"]){
                                    ?>
                                    <input type="text" placeholder="От" onkeyup="smartFilter.keyup(this)" name="<?=$arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>" id="<?=$arItem["VALUES"]["MIN"]["CONTROL_ID"]?>" value="<?=$arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"/>
                                    <input type="text" placeholder="До" onkeyup="smartFilter.keyup(this)" name="<?=$arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>" id="<?=$arItem["VALUES"]["MAX"]["CONTROL_ID"]?>" value="<?=$arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"/>
                                <?}?>
                            </div>
                        </div>
                        <div>
                            <div class="input-default input-group">
                                <h3 class="input-group-title">S балкона, кв.м</h3>
                                <?
                                $arItem = $arResult["ITEMS"][26];
                                if($arItem["VALUES"]){
                                    ?>
                                    <input type="text" placeholder="От" onkeyup="smartFilter.keyup(this)" name="<?=$arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>" id="<?=$arItem["VALUES"]["MIN"]["CONTROL_ID"]?>" value="<?=$arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"/>
                                    <input type="text" placeholder="До" onkeyup="smartFilter.keyup(this)" name="<?=$arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>" id="<?=$arItem["VALUES"]["MAX"]["CONTROL_ID"]?>" value="<?=$arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"/>
                                <?}?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="additional-filter-nav">
                    <button class="reset-filter"
                            type="submit"
                            id="del_filter"
                            name="del_filter"
                            value="Y">Сбросить</button>
                    <button
                            class="add-filter"
                            type="submit"
                            id="set_filter"
                            name="set_filter"
                            value="Y"
                    >ОК</button>
                </div>
            </div>
            <div class="filters">

            </div>
        </div>
    </form>
</div>

<script type="text/javascript">
    var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
</script>
