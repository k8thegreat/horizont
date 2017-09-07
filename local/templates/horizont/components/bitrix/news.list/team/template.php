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
if($arResult["ITEMS"]){?>
<h2 class="title-big cursive-title-right">Команда, которой мы гордимся
<span class="title-top"><span class="dop-title">Наши сотрудники</span></span>
</h2>

<div class="our-team">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<div class="one-card">
			<div class="thumb">
				<?if($arItem["PREVIEW_PICTURE"]){
                $file = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], array('width'=>130, 'height'=>130), BX_RESIZE_IMAGE_EXACT, true);
                ?><img src="<?=$file["src"]?>" alt="<?=$arItem["NAME"]?>"/><?}?>
			</div>
			<div class="card-content">
				<h4 class="name"><?=$arItem["NAME"]?></h4>
				<p class=""><?=$arItem["PROPERTIES"]["POSITION"]["VALUE"]?></p>
				<p class="phone"><?=$arItem["PROPERTIES"]["PHONE"]["VALUE"]?></p>
			</div>
		</div>
	</div>
<?endforeach;?>
</div>
<?}?>