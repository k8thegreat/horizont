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

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));

$roomsTitleArr = array(
    "1" => "1-к.кв.",
    "2" => "2-к.кв.",
    "3" => "3-к.кв.",
    "4" => "4-к.кв.",
    "5" => "5-к.кв.",
    "studio" => "Студии"
);
?>
<div class="result-list tile-mod">
    <div class="result-list-nav">
        <div>
            <a href="" class="go-filter">Фильтр<?=FILTER_ICON?></a>
            <select name="sort" class="result-sort">
                <option value="">Сортировать</option>
                <option value="<?= $APPLICATION->GetCurPageParam("sort=name", array("sort")); ?>"<?=($_GET["sort"]=="name" ? " selected" : "")?>>По имени</option>
                <option value="<?= $APPLICATION->GetCurPageParam("sort=date", array("sort")); ?>"<?=($_GET["sort"]=="date" ? " selected" : "")?>>По дате</option>
                <option value="<?= $APPLICATION->GetCurPageParam("sort=price", array("sort")); ?>"<?=($_GET["sort"]=="price" ? " selected" : "")?>>По цене</option>
            </select>
            <a href="<?= $APPLICATION->GetCurPageParam("view=list", array("view")); ?>" class="list list-line"><?=LIST_VIEW_ICON?></a>
            <a href="<?= $APPLICATION->GetCurPageParam("view=block", array("view")); ?>" class="list list-squares active"><?=BLOCK_VIEW_ICON?></a>
            <a href="<?= $APPLICATION->GetCurPageParam("view=map", array("view")); ?>" class="list list-map"><?=MAP_VIEW_ICON?></a>
        </div>
    </div>
<?
if (0 < $arResult["SECTIONS_COUNT"])
{
    $i=0;
			foreach ($arResult['SECTIONS'] as &$arSection)
			{
				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
                ?>
                <div id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
                    <a href="<?=$arSection['SECTION_PAGE_URL']?>" class="one-result" target="_blank">
                        <div class="result-content-top">
                            <div>
                                <h2 class="name-rc"><?=$arSection["NAME"]?></h2>
                                <h4 class="name-loc"><?=$arSection["UF_SUBLOCALITY"]?><?=($arSection["UF_ADDRESS"] ? ", ".$arSection["UF_ADDRESS"] : "")?></h4>
                            </div>
                            <div>
                                <?if($arSection["UF_METRO"]){?>
                                <div class="loc-metro">
                                    <?foreach($arSection["METRO"] as $val){?><?=getColoredIcon($val)?><?}?>
                                    <?=$arSection["UF_METRO"]?>
                                </div>
                                <?}?>
                                <?if($arSection["UF_TIME_ON_FOOT"]){?>
                                    <div class="loc-data"><?=TIME_ICON?><?=$arSection["UF_TIME_ON_FOOT"]?> мин <?=FOOT_ICON?></div>
                                <?}?>
                                <?if($arSection["UF_TIME_ON_TRANSPORT"]){?>
                                    <div class="loc-data"><?=TIME_ICON?><?=$arSection["UF_TIME_ON_TRANSPORT"]?> мин <?=TRANSPORT_ICON?></div>
                                <?}?>
                            </div>
                        </div>
                        <div class="thumb">
                            <?if($arSection["PICTURE"]){
                                $file = CFile::ResizeImageGet($arSection["PICTURE"], array('width'=>555, 'height'=>285), BX_RESIZE_IMAGE_EXACT, true);
                                $img = '<img src="'.$file['src'].'" width="'.$file['width'].'" height="'.$file['height'].'" />'; ?>
                                <?=$img?>
                            <?}?>
                        </div>
                        <div class="result-content">
                            <h2 class="result-advantage">Выгодная цена</h2>
                            <div class="result-dop-con">
                                <ul class="left-con">
                                    <?if($arSection["UF_READY"]){?><li><span>Сроки сдачи:</span>
                                        <?=(count($arSection["UF_READY"])>1 ?  "<b>".formatReadyDate($arSection["UF_READY"][0])." - ".formatReadyDate($arSection["UF_READY"][count($arSection["UF_READY"])-1])."</b>" : "<b>".formatReadyDate($arSection["UF_READY"][0])."</b>")?>
                                    </li><?}?>
                                    <?if($arSection["UF_PAYMENT"]){?>
                                        <li><span>Варианты оплаты:</span><b><?=implode(", ", $arSection["UF_PAYMENT"])?></b></li>
                                    <?}?>
                                    <?if($arSection["UF_RENOVATION"]){?>
                                    <li><span>Отделка:</span><b><?=implode(", ", $arSection["UF_RENOVATION"])?></b></li><?}?>
                                    <?if($arSection["UF_DEVELOPER"]){?>
                                    <li><span>Застройщик:</span> <b><?=$arSection["UF_DEVELOPER"]["NAME"]?></b></li>
                                    <?}?>
                                </ul>
                                <ul class="right-con">
                                    <?foreach ($arSection["ITEMS_PRICE"] as $key => $value){?>
                                        <li><span><?=$roomsTitleArr[$key]?> от:</span> <b><?=number_format($value, 0, ".", " ")?> руб.</b></li>
                                    <?}?>
                                </ul>
                            </div>
                        </div>
                    </a>
                </div>
               <?
                $i++;
                if($i==5){
                    ?><?$APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "banner",
                        Array(
                            "ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "AJAX_MODE" => "N",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "N",
                            "CACHE_FILTER" => "N",
                            "CACHE_GROUPS" => "Y",
                            "CACHE_TIME" => "36000000",
                            "CACHE_TYPE" => "A",
                            "CHECK_DATES" => "Y",
                            "DETAIL_URL" => "",
                            "DISPLAY_BOTTOM_PAGER" => "N",
                            "DISPLAY_DATE" => "N",
                            "DISPLAY_NAME" => "Y",
                            "DISPLAY_PICTURE" => "Y",
                            "DISPLAY_PREVIEW_TEXT" => "Y",
                            "DISPLAY_TOP_PAGER" => "N",
                            "FIELD_CODE" => array("",""),
                            "FILTER_NAME" => "",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "IBLOCK_ID" => "5",
                            "IBLOCK_TYPE" => "content",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            "INCLUDE_SUBSECTIONS" => "N",
                            "MESSAGE_404" => "",
                            "NEWS_COUNT" => "1",
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_TEMPLATE" => ".default",
                            "PAGER_TITLE" => "",
                            "PARENT_SECTION" => "",
                            "PARENT_SECTION_CODE" => "",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "PROPERTY_CODE" => array("",""),
                            "SET_BROWSER_TITLE" => "N",
                            "SET_LAST_MODIFIED" => "N",
                            "SET_META_DESCRIPTION" => "N",
                            "SET_META_KEYWORDS" => "N",
                            "SET_STATUS_404" => "N",
                            "SET_TITLE" => "N",
                            "SHOW_404" => "N",
                            "SORT_BY1" => "RAND",
                            "SORT_BY2" => "RAND",
                            "SORT_ORDER1" => "ASC",
                            "SORT_ORDER2" => "ASC",
                            "STRICT_SECTION_CHECK" => "N"
                        )
                    );?><?
                }
			}

}
?></div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <?=$arResult["NAV_STRING"]?><br />
<?endif;?>