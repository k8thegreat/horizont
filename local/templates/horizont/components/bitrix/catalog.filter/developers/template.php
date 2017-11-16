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
</div>

<div class="filter-bar">
    <form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get">
        <?foreach($arResult["ITEMS"] as $arItem):
            if(array_key_exists("HIDDEN", $arItem)):
                echo $arItem["INPUT"];
            endif;
        endforeach;?>
        <div class="search-bar developer-search">
            <label class="input-default" for="autocomplete">
                <input type="text" placeholder="Поиск по названию застройщика" class="search" id="developers" value="<?=$_REQUEST["arrFilter_ff"]["NAME"]?>" name="arrFilter_ff[NAME]"/>
                <div class="ui-front" id="search-general"></div>
                <?/*;foreach ($arResult["ITEMS"][32]["VALUES"] as $i => $item) {
                    $arValues[] = $item["VALUE"];
                }
                foreach ($arResult["ITEMS"][33]["VALUES"] as $i => $item) {
                    $arValues[] = $item["VALUE"];
                }*/
                ?>
            </label>
                <input type="submit" class="btn btn-full"  name="set_filter" value="<?=GetMessage("IBLOCK_SET_FILTER")?>" />
                <input type="hidden" name="set_filter" value="Y" />&nbsp;
        </div>
    </form>
</div>
<script>
    $(function() {
        var developers = [<?
            foreach ($arResult["DEVELOPERS"] as $dev){
            ?>{
                value: "<?=$dev["NAME"]?>",
                label: "<?=$dev["NAME"]?>",
                url: "<?=$dev["DETAIL_PAGE_URL"]?>"
            },<?
                }
            ?>];
        $("#developers").autocomplete({
            delay: 0,
            source: developers,
            appendTo: "#search-general",
            select: function( event, ui ) {
                window.location = ui.item.url;
                return false;
            }

        }).autocomplete( "instance" )._renderItem = function( ul, item ) {
            return $( "<li>" )
                .append(item.label )
                .appendTo( ul );
        };;
    });
</script>

