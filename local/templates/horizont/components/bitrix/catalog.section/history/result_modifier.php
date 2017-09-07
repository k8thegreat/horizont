<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();
foreach ($arResult['ITEMS'] as $arItem){
    if($arItem["DATE_ACTIVE_FROM"]){
        $year = FormatDate('Y', MakeTimeStamp($arItem["DATE_ACTIVE_FROM"], CSite::GetDateFormat()), time());
        $arResult["CATEGORY"][$year][] = $arItem;
    }
}
//print_r($arResult["CATEGORY"]);