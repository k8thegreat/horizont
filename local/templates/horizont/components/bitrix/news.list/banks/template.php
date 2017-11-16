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
if($arResult["ITEMS"]){
?>
<div class="mortgage owl-carousel owl-theme">

<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>

	<div class="item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<div class="thumb">
		<?
		if($arItem["PREVIEW_PICTURE"]){
		$file = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], array('width'=>160, 'height'=>200), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		$img = '<img src="'.$file['src'].'" width="'.$file['width'].'" height="'.$file['height'].'" alt="'.$arItem["NAME"].'" />';
		?>
		<?=$img?>
			<?}?>
		</div>
		<div class="carousel-content">
            <p><?=($arItem["PROPERTIES"]["FIRST_PAYMENT"]["VALUE"] ? "Первый взнос от ".$arItem["PROPERTIES"]["FIRST_PAYMENT"]["VALUE"]."%" : "")?></p>
            <p><?=($arItem["PROPERTIES"]["RATE"]["VALUE"] ? "Годовых ".$arItem["PROPERTIES"]["RATE"]["VALUE"]."%" : "")?></p>
            <p><?=($arItem["PROPERTIES"]["PERIOD"]["VALUE"] ? "Срок ипотеки ".$arItem["PROPERTIES"]["PERIOD"]["VALUE"]." лет" : "")?></p>

        </div>
    </div>
<?endforeach;?>
</div>
<?}?>
