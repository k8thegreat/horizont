<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<ul>
<? foreach($arResult as $arItem):
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;
    if($arItem["SELECTED"]):?>
		<li<?=($arItem["PARAMS"]["class"] ? ' class="'.$arItem["PARAMS"]["class"].'"' : "")?>><a href="<?=$arItem["LINK"]?>" class="selected"><?=$arItem["TEXT"]?></a></li>
	<?else:?>
		<li<?=($arItem["PARAMS"]["class"] ? ' class="'.$arItem["PARAMS"]["class"].'"' : "")?>><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
	<?endif?>
<?endforeach?>
</ul>
<?endif?>