<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if (strlen($arResult["PAGE_URL"]) > 0)
{
	?><ul class="social">
    <?
		if (is_array($arResult["BOOKMARKS"]) && count($arResult["BOOKMARKS"]) > 0)
		{
			foreach($arResult["BOOKMARKS"] as $name => $arBookmark)
			{
				?><li><?=$arBookmark["ICON"]?></li><?
			}
		}
		?>
	</ul><?
}
else
{
	?><?=GetMessage("SHARE_ERROR_EMPTY_SERVER")?><?
}
?>