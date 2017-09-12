<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();
$rsSections = CIBlockSection::GetList(array(), array("IBLOCK_ID" => $arResult["IBLOCK_ID"], "ID" => $arResult["SECTION"]["ID"]),false, array("IBLOCK_ID","UF_*"),array());
if ($arSection = $rsSections->GetNext())
{
    if($arSection["UF_DEVELOPER"]) {
        $res = CIBlockElement::GetByID($arSection["UF_DEVELOPER"]);
        if ($ar_res = $res->GetNext())
            $arResult["UF_DEVELOPER"] = $ar_res;
    }
    if($arSection["UF_LOCATION"]){
        $arResult["UF_LOCATION"] = unserialize($arSection["UF_LOCATION"]);
    }
    $arResult["UF_SUBLOCALITY"] = $arSection["UF_SUBLOCALITY"];
    $arResult["UF_BUILDING_TYPE"] = $arSection["UF_BUILDING_TYPE"];
    $arResult["UF_METRO"] = $arSection["UF_METRO"];
    $arResult["UF_ADDRESS"] = $arSection["UF_ADDRESS"];
    if($arSection["UF_BANKS"]){
        $arResult["UF_BANKS"] = $arSection["UF_BANKS"];
        foreach ($arResult["UF_BANKS"] as $bank){
            $arBanks[] = array("ID" => $bank);
        }
        $arBanks["LOGIC"] = "OR";
        $arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_RATE");
        $arFilter = Array("IBLOCK_ID"=>BANKS_IBLOCK_ID, "ACTIVE"=>"Y");
        $res = CIBlockElement::GetList(Array("PROPERTY_RATE"=> "ASC"), array_merge($arFilter,array($arBanks)), false, Array(), $arSelect);
        if($ob = $res->GetNextElement()){
            $arFields = $ob->GetFields();
            $arProps = $ob->GetProperties();
            $arResult["BANK"] = $arFields;
            $arResult["BANK"]["PROPERTIES"] = $arProps;
        }

    }
}