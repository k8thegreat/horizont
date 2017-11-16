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

$arViewModeList = $arResult['VIEW_MODE_LIST'];

$arViewStyles = array(
	'LIST' => array(
		'CONT' => 'bx_sitemap',
		'TITLE' => 'bx_sitemap_title',
		'LIST' => 'bx_sitemap_ul',
	),
	'LINE' => array(
		'CONT' => 'bx_catalog_line',
		'TITLE' => 'bx_catalog_line_category_title',
		'LIST' => 'bx_catalog_line_ul',
		'EMPTY_IMG' => $this->GetFolder().'/images/line-empty.png'
	),
	'TEXT' => array(
		'CONT' => 'bx_catalog_text',
		'TITLE' => 'bx_catalog_text_category_title',
		'LIST' => 'bx_catalog_text_ul'
	),
	'TILE' => array(
		'CONT' => 'bx_catalog_tile',
		'TITLE' => 'bx_catalog_tile_category_title',
		'LIST' => 'bx_catalog_tile_ul',
		'EMPTY_IMG' => $this->GetFolder().'/images/tile-empty.png'
	)
);
$arCurView = $arViewStyles[$arParams['VIEW_MODE']];

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

if (0 < $arResult["SECTIONS_COUNT"])
{
			foreach ($arResult['SECTIONS'] as &$arSection)
			{
				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
                ?>
                <div id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
                    <div class="one-result">
                        <?if($arSection["PICTURE"]){?>
                        <a href="<?=$arSection['SECTION_PAGE_URL']?>" class="thumb">
                            <?
                            $file = CFile::ResizeImageGet($arSection["PICTURE"], array('width'=>365, 'height'=>230), BX_RESIZE_IMAGE_EXACTL, true);
                            $img = '<img src="'.$file['src'].'" width="'.$file['width'].'" height="'.$file['height'].'" />';

                            ?>
                            <?=$img?>
                            <h2 class="result-advantage">Выгодная цена</h2>
                        </a>
                        <?}?>
                        <div class="result-content">
                            <h2 class="name-rc"><?=$arSection["NAME"]?></h2>
                            <div class="result-dop-con">
                                <ul class="left-con">
                                    <li><h4 class="name-loc">Всеволожский район</h4></li>
                                    <li>
                                        <div class="loc-metro">
                                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                 width="14px" height="14px" viewBox="0 0 94.69 94.691"
                                                 xml:space="preserve" fill="#f10138">
                                                <g>
                                                    <path d="M62.695,10.642l-15.35,48.393L31.996,10.642C13.737,16.918,0,33.943,0,53.461c0,11.756,4.796,22.597,12.555,30.587h22.254
                                                        l2.333-10.117C10.556,63.514,15.583,31.235,25.221,25.966C26.365,26.31,43.129,83.81,43.129,83.81c0.229,0,0.973,0,1.882,0
                                                        c0.192,0,0.915,0,1.816,0c0.326,0,0.678,0,1.035,0c0.612,0,1.247,0,1.815,0c0.91,0,1.653,0,1.883,0c0,0,16.765-57.5,17.908-57.844
                                                        c9.639,5.269,14.664,37.548-11.922,47.965l2.334,10.117h22.254c7.76-7.99,12.556-18.831,12.556-30.587
                                                        C94.69,33.943,80.953,16.918,62.695,10.642z"/>
                                                </g>
                                            </svg>
                                            Площадь Ленина
                                        </div>
                                    </li>
                                    <li>
                                        <div class="loc-data">
                                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                 width="14px" height="14px" viewBox="0 0 97.16 97.16" fill="#d4d4d5"
                                                 xml:space="preserve">
                                                <g>
                                                    <path d="M48.58,0C21.793,0,0,21.793,0,48.58s21.793,48.58,48.58,48.58s48.58-21.793,48.58-48.58S75.367,0,48.58,0z M48.58,86.823
                                                        c-21.087,0-38.244-17.155-38.244-38.243S27.493,10.337,48.58,10.337S86.824,27.492,86.824,48.58S69.667,86.823,48.58,86.823z"/>
                                                    <path d="M73.898,47.08H52.066V20.83c0-2.209-1.791-4-4-4c-2.209,0-4,1.791-4,4v30.25c0,2.209,1.791,4,4,4h25.832
                                                        c2.209,0,4-1.791,4-4S76.107,47.08,73.898,47.08z"/>
                                                </g>
                                            </svg>
                                            15 мин
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1"
                                                 x="0px" y="0px" viewBox="0 0 93.646 93.646" fill="#d4d4d5"
                                                 xml:space="preserve" width="14px" height="14px">
                                                <g>
                                                    <path d="M67.971,49.778l-9.378-10.345c-0.584-0.644-1.121-1.971-1.148-2.841L57.1,25.858v-0.311c0-1.654-1.346-3-3-3h-9.18h-3.648   c-1.478,0-3.127,1.047-3.756,2.384l-12.358,26.25c-0.342,0.728-0.376,1.541-0.096,2.292c0.28,0.75,0.84,1.342,1.575,1.666   l1.821,0.803c0.388,0.171,0.802,0.258,1.231,0.258h0c1.177,0,2.273-0.669,2.794-1.704l5.789-11.517v11.576   c-0.024,0.067-0.059,0.128-0.081,0.196l-9.783,30.638c-0.407,1.276-0.283,2.619,0.35,3.781s1.693,1.994,2.987,2.343l0.654,0.177   c0.428,0.116,0.872,0.175,1.318,0.175c2.251,0,4.296-1.481,4.974-3.603l9.141-28.628l3.242,7.941   c0.791,1.937,1.645,5.329,1.865,7.409l1.551,14.621c0.249,2.341,2.1,4.04,4.402,4.04c0.377,0,0.76-0.046,1.137-0.137l0.659-0.16   c2.624-0.635,4.478-3.331,4.133-6.008l-2.297-17.828c-0.292-2.265-1.269-5.812-2.178-7.907l-3.102-7.144   c-0.04-0.093-0.097-0.177-0.143-0.267v-4.841l5.59,5.836c0.556,0.581,1.3,0.901,2.094,0.901c0.803,0,1.553-0.326,2.111-0.918   l1.034-1.098C69.036,52.899,69.055,50.973,67.971,49.778z"/>
                                                    <path d="M48.52,20.005c5.516,0,10.003-4.487,10.003-10.003C58.523,4.487,54.036,0,48.52,0c-5.515,0-10.001,4.487-10.001,10.002   C38.518,15.518,43.005,20.005,48.52,20.005z"/>
                                                </g>
                                            </svg>
                                        </div>
                                    </li>
                                </ul>
                                <ul class="left-con">
                                    <li><span>Сроки сдачи:</span><b>II кв. 2018 г. — IV кв. 2019</b></li>
                                    <li><span>Варианты оплаты:</span><b>Рассрочка, Ипотека</b></li>
                                    <li><span>Отделка:</span><b> Чистовая</b></li>
                                    <li><span>Застройщик:</span><b>Петрострой </b></li>
                                </ul>
                                <ul class="right-con">
                                    <?foreach ($arSection["ITEMS_PRICE"] as $key => $value){?>
                                        <li><span><?=$roomsTitleArr[$key]?> от:</span> <b><?=number_format($value, 0, ".", " ")?> руб.</b></li>
                                    <?}?>
                                </ul>
                            </div>
                            <a href="<?=$arSection['SECTION_PAGE_URL']?>" class="btn btn-border">Перейти на страницу комплекса</a>
                        </div>
                    </div>
                </div>


               <?
			}

}
?></div>