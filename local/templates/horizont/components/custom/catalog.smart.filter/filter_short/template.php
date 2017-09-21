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
<?
$arResult["FORM_ACTION"] = "/novostroyki/";
?>

<div class="filter-bar">
    <form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="smartfilter">
        <?foreach($arResult["HIDDEN"] as $arItem):?>
            <input type="hidden" name="<?echo $arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
        <?endforeach;?>

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
                <input class="hidden-items" type="checkbox" onchange="smartFilter.click(this)" value="<?=$item["HTML_VALUE"]?>" name="<?=$item["CONTROL_NAME"]?>" id="<?=$item["CONTROL_ID"]?>" />

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
                                echo '{ label: "'.$item["VALUE"].'", category: "Застройщики", control: "'.$item["CONTROL_NAME"].'"},';
                            }
                            foreach ($arResult["ITEMS"][33]["VALUES"] as $i => $item) {
                                echo '{ label: "'.$item["VALUE"].'", category: "ЖК", control: "'.$item["CONTROL_NAME"].'"},';
                            }
                            ?>

                        ];

                        $( "#autocomplete" ).catcomplete({
                            delay: 0,
                            source: data,
                            appendTo: ".ui-front"
                        });
                        $("body").on("click", ".ui-menu-item-wrapper", function(){
                            var control_name = $(this).attr("data-control");
                            $(".hidden-items").prop("checked", false);
                            $("[name='"+control_name+"']").click();
                        });
                        });
                </script>
                <div class="ui-front"></div>
            </label>
			<div id="modef">
            	<a class="btn btn-full"  href="<?echo $arResult["FILTER_URL"]?>">Показать <span id="modef_num"><?=intval($arResult["ELEMENT_COUNT"])?></span></a>
            </div>
        </div>


    </form>
</div>

<script type="text/javascript">
    var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
</script>
