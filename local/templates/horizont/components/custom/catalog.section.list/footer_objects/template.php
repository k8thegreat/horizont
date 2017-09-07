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
    "1" => "1к.",
    "2" => "2к.",
    "3" => "3к.",
    "4" => "4к.",
    "5" => "5к.",
    "studio" => "студии"
);
if (0 < $arResult["SECTIONS_COUNT"])
{
			foreach ($arResult['SECTIONS'] as &$arSection)
			{
				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
				?>
				<a href="<? echo $arSection['SECTION_PAGE_URL']; ?>" class="link-preview" id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
               <?if($arSection['PICTURE']['SRC']){
                    $file = CFile::ResizeImageGet($arSection['PICTURE']['ID'], array('width'=>70, 'height'=>70), BX_RESIZE_IMAGE_EXACT, true);
                    $img = '<img src="'.$file['src'].'" width="'.$file['width'].'" height="'.$file['height'].'" />';
					?>
                 <?=$img?>
				<?}?>
                        <span>
                           <?=$arSection["NAME"]?>
                            <?if($arSection["TYPES"]){
                                $arr = array();
                                foreach ($arSection["TYPES"] as $ROOM) {
                                    $arr[] = $roomsTitleArr[$ROOM];
                                }
                                $rooms_str = implode(" ", $arr);
                            }?>
                            <?=$rooms_str?>
                            от <?=number_format($arSection["MIN_PRICE"], "0", ".", " ")?>
                            до <?=number_format($arSection["MAX_PRICE"], "0", ".", " ")?> руб.
                        </span>
				</a>
				<?
			}

}
?>