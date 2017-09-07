<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var array $arParams
 * @var array $templateData
 * @var string $templateFolder
 * @var CatalogSectionComponent $component
 */


if (!isset($_COOKIE['ITEM_VIEW'])) {
    $value = array($arResult['ID']);
    setcookie("ITEM_VIEW", serialize($value), time()+86400, "/", "");
} else {
    $itemArr = unserialize($_COOKIE['ITEM_VIEW']);
    if (!in_array($arResult["ID"],$itemArr)) {
        array_unshift($itemArr, $arResult["ID"]);
        $value = serialize($itemArr);
        setcookie("ITEM_VIEW", $value,time()+86400, "/", "");
    }
}
?>