<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
?>

<div class="list-nav">

<?if($arResult["bDescPageNumbering"] === true):?>
    <ul class="pagination">
	<?while($arResult["nStartPage"] >= $arResult["nEndPage"]):?>
		<?$NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1;?>

		<?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
			<span class="nav-current-page">&nbsp;<?=$NavRecordGroupPrint?>&nbsp;</span>&nbsp;
		<?elseif($arResult["nStartPage"] == $arResult["NavPageCount"] && $arResult["bSavePage"] == false):?>
			<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$NavRecordGroupPrint?></a>&nbsp;
		<?else:?>
			<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$NavRecordGroupPrint?></a>&nbsp;
		<?endif?>

		<?$arResult["nStartPage"]--?>
	<?endwhile?>
    </ul>
<?else:?>
    <ul class="pagination">
        <?if ($arResult["NavPageNomer"] > 1):?>

            <?if($arResult["bSavePage"]):?>
                <li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1"><?=GetMessage("nav_begin")?></a></li>
                <li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>">&laquo;</a></li>

            <?else:?>
                <li><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=GetMessage("nav_begin")?></a></li>
                <?if ($arResult["NavPageNomer"] > 2):?>
                    <li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>">&laquo;</a></li>
                <?else:?>
                    <li><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>">&laquo;</a></li>
                <?endif?>
            <?endif?>
        <?endif?>
	<?while($arResult["nStartPage"] <= $arResult["nEndPage"]):?>

		<?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
            <li class="active"><a href="<?=$arResult["sUrlPath"]?>"><?=$arResult["nStartPage"]?></a></li>
		<?elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):?>
            <li><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$arResult["nStartPage"]?></a></li>
		<?else:?>
            <li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a></li>
		<?endif?>
		<?$arResult["nStartPage"]++?>
	<?endwhile?>
        <?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
            <li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>">&raquo;</a></li>
            <li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>"><?=GetMessage("nav_end")?></a></li>
        <?endif?>
        </ul>
<?endif?>


</div>