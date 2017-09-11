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
use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

$this->setFrameMode(true);

$arParams['USE_FILTER'] = (isset($arParams['USE_FILTER']) && $arParams['USE_FILTER'] == 'Y' ? 'Y' : 'N');

                $intSectionID = $APPLICATION->IncludeComponent(
                    "bitrix:catalog.section",
                    "catalog",
                    array(
                        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                        "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
                        "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
                        "ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
                        "ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
                        "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
                        "PROPERTY_CODE_MOBILE" => $arParams["LIST_PROPERTY_CODE_MOBILE"],
                        "META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
                        "META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
                        "BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
                        "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
                        "INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
                        "BASKET_URL" => $arParams["BASKET_URL"],
                        "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
                        "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
                        "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
                        "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
                        "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
                        "FILTER_NAME" => $arParams["FILTER_NAME"],
                        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                        "CACHE_TIME" => $arParams["CACHE_TIME"],
                        "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                        "SET_TITLE" => $arParams["SET_TITLE"],
                        "MESSAGE_404" => $arParams["~MESSAGE_404"],
                        "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                        "SHOW_404" => $arParams["SHOW_404"],
                        "FILE_404" => $arParams["FILE_404"],
                        "DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
                        "PAGE_ELEMENT_COUNT" => "2500",
                        "LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
                        "PRICE_CODE" => $arParams["PRICE_CODE"],
                        "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
                        "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

                        "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
                        "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
                        "ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
                        "PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
                        "PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],

                        "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
                        "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
                        "PAGER_TITLE" => $arParams["PAGER_TITLE"],
                        "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
                        "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                        "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                        "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
                        "PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
                        "PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
                        "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                        "LAZY_LOAD" => $arParams["LAZY_LOAD"],
                        "MESS_BTN_LAZY_LOAD" => $arParams["~MESS_BTN_LAZY_LOAD"],
                        "LOAD_ON_SCROLL" => $arParams["LOAD_ON_SCROLL"],

                        "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
                        "OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
                        "OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
                        "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
                        "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
                        "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
                        "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
                        "OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],

                        "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
                        "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
                        "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                        "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
                        "USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
                        'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                        'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                        'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
                        'HIDE_NOT_AVAILABLE_OFFERS' => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],

                        'LABEL_PROP' => $arParams['LABEL_PROP'],
                        'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
                        'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
                        'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
                        'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
                        'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
                        'PRODUCT_ROW_VARIANTS' => $arParams['LIST_PRODUCT_ROW_VARIANTS'],
                        'ENLARGE_PRODUCT' => $arParams['LIST_ENLARGE_PRODUCT'],
                        'ENLARGE_PROP' => isset($arParams['LIST_ENLARGE_PROP']) ? $arParams['LIST_ENLARGE_PROP'] : '',
                        'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
                        'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
                        'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

                        'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
                        'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
                        'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
                        'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
                        'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
                        'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
                        'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
                        'MESS_SHOW_MAX_QUANTITY' => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
                        'RELATIVE_QUANTITY_FACTOR' => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
                        'MESS_RELATIVE_QUANTITY_MANY' => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY']) ? $arParams['~MESS_RELATIVE_QUANTITY_MANY'] : ''),
                        'MESS_RELATIVE_QUANTITY_FEW' => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW']) ? $arParams['~MESS_RELATIVE_QUANTITY_FEW'] : ''),
                        'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
                        'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
                        'MESS_BTN_SUBSCRIBE' => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
                        'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
                        'MESS_NOT_AVAILABLE' => (isset($arParams['~MESS_NOT_AVAILABLE']) ? $arParams['~MESS_NOT_AVAILABLE'] : ''),
                        'MESS_BTN_COMPARE' => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),

                        'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
                        'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
                        'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),

                        'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
                        "ADD_SECTIONS_CHAIN" => "N",
                        'ADD_TO_BASKET_ACTION' => $basketAction,
                        'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
                        'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
                        'COMPARE_NAME' => $arParams['COMPARE_NAME'],
                        'BACKGROUND_IMAGE' => (isset($arParams['SECTION_BACKGROUND_IMAGE']) ? $arParams['SECTION_BACKGROUND_IMAGE'] : ''),
                        'COMPATIBLE_MODE' => (isset($arParams['COMPATIBLE_MODE']) ? $arParams['COMPATIBLE_MODE'] : ''),
                        'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : '')
                    ),
                    $component
                );
                ?>
<section class="bg-gray">
    <div class="container">
        <div class="blue-card card-full title-des ico-plane">
            <img src="<?=SITE_TEMPLATE_PATH?>/img/card-ico/plane.png" alt="">
            <div class="blue-card-content">
                <h2>Правда о застройщике</h2>
                <p>Расскажем сколько лет работает компания, сколько построено объектов,
                    были ли проблемы с дольщиками, сильные и слабые стороны застройщика.
                    Свяжитесь, чтобы узнать правду о застройщике:</p>
                <?$APPLICATION->IncludeComponent("custom:iblock.element.add.form", "get_info", array(
	"COMPONENT_TEMPLATE" => "get_info",
		"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
		"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
		"CUSTOM_TITLE_DETAIL_PICTURE" => "",
		"CUSTOM_TITLE_DETAIL_TEXT" => "",
		"CUSTOM_TITLE_IBLOCK_SECTION" => "",
		"CUSTOM_TITLE_NAME" => "Ваш телефон",
		"CUSTOM_TITLE_PREVIEW_PICTURE" => "",
		"CUSTOM_TITLE_PREVIEW_TEXT" => "",
		"CUSTOM_TITLE_TAGS" => "",
		"DEFAULT_INPUT_SIZE" => "30",
		"DETAIL_TEXT_USE_HTML_EDITOR" => "N",
		"ELEMENT_ASSOC" => "CREATED_BY",
		"GROUPS" => array(
			0 => "2",
		),
		"IBLOCK_ID" => "7",
		"IBLOCK_TYPE" => "feedback",
		"LEVEL_LAST" => "Y",
		"LIST_URL" => "",
		"MAX_FILE_SIZE" => "0",
		"MAX_LEVELS" => "100000",
		"MAX_USER_ENTRIES" => "100000",
		"PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
		"PROPERTY_CODES" => array(
			0 => "31",
			1 => "NAME",
		),
		"PROPERTY_CODES_REQUIRED" => array(
			0 => "NAME",
		),
		"RESIZE_IMAGES" => "N",
		"SEF_MODE" => "N",
		"STATUS" => "ANY",
		"STATUS_NEW" => "N",
		"USER_MESSAGE_ADD" => "Ваше сообщение успешно отправлено",
		"USER_MESSAGE_EDIT" => "Ваше сообщение успешно отправлено",
		"USE_CAPTCHA" => "N",
		"EVENT_NAME" => "SEND_MSG"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "Y"
	)
);?>
            </div>
        </div>
    </div>
</section>
<?if($GLOBALS["HISTORY"]){?>
<section class="shadow shadow-dark" id="menu-course-of-construction" style="background-image:url(img/overview-bg.jpg);">
    <div class="container">

        <?$APPLICATION->IncludeComponent("bitrix:catalog.section", "history", Array(
	"ACTION_VARIABLE" => "action",	// Название переменной, в которой передается действие
		"ADD_PICT_PROP" => "-",	// Дополнительная картинка основного товара
		"ADD_PROPERTIES_TO_BASKET" => "Y",	// Добавлять в корзину свойства товаров и предложений
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "N",	// Включить подгрузку стилей
		"BACKGROUND_IMAGE" => "-",	// Установить фоновую картинку для шаблона из свойства
		"BASKET_URL" => "/personal/basket.php",	// URL, ведущий на страницу с корзиной покупателя
		"BROWSER_TITLE" => "-",	// Установить заголовок окна браузера из свойства
		"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"COMPATIBLE_MODE" => "N",	// Включить режим совместимости
		"DETAIL_URL" => "",	// URL, ведущий на страницу с содержимым элемента раздела
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",	// Не подключать js-библиотеки в компоненте
		"DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
		"DISPLAY_COMPARE" => "N",	// Разрешить сравнение товаров
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"ELEMENT_SORT_FIELD" => "sort",	// По какому полю сортируем элементы
		"ELEMENT_SORT_FIELD2" => "id",	// Поле для второй сортировки элементов
		"ELEMENT_SORT_ORDER" => "asc",	// Порядок сортировки элементов
		"ELEMENT_SORT_ORDER2" => "desc",	// Порядок второй сортировки элементов
		"ENLARGE_PRODUCT" => "STRICT",	// Выделять товары в списке
		"FILTER_NAME" => "arrFilter",	// Имя массива со значениями фильтра для фильтрации элементов
		"IBLOCK_ID" => "6",	// Инфоблок
		"IBLOCK_TYPE" => "catalog",	// Тип инфоблока
		"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
		"LABEL_PROP" => "",	// Свойства меток товара
		"LAZY_LOAD" => "N",	// Показать кнопку ленивой загрузки Lazy Load
		"LINE_ELEMENT_COUNT" => "3",	// Количество элементов выводимых в одной строке таблицы
		"LOAD_ON_SCROLL" => "N",	// Подгружать товары при прокрутке до конца
		"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",	// Текст кнопки "Добавить в корзину"
		"MESS_BTN_BUY" => "Купить",	// Текст кнопки "Купить"
		"MESS_BTN_DETAIL" => "Подробнее",	// Текст кнопки "Подробнее"
		"MESS_BTN_SUBSCRIBE" => "Подписаться",	// Текст кнопки "Уведомить о поступлении"
		"MESS_NOT_AVAILABLE" => "Нет в наличии",	// Сообщение об отсутствии товара
		"META_DESCRIPTION" => "-",	// Установить описание страницы из свойства
		"META_KEYWORDS" => "-",	// Установить ключевые слова страницы из свойства
		"OFFERS_LIMIT" => "5",
		"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
		"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
		"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
		"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
		"PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
		"PAGER_TITLE" => "",	// Название категорий
		"PAGE_ELEMENT_COUNT" => "18",	// Количество элементов на странице
		"PARTIAL_PRODUCT_PROPERTIES" => "N",	// Разрешить добавлять в корзину товары, у которых заполнены не все характеристики
		"PRICE_CODE" => "",	// Тип цены
		"PRICE_VAT_INCLUDE" => "N",	// Включать НДС в цену
		"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",	// Порядок отображения блоков товара
		"PRODUCT_ID_VARIABLE" => "id",	// Название переменной, в которой передается код товара для покупки
		"PRODUCT_PROPERTIES" => "",	// Характеристики товара
		"PRODUCT_PROPS_VARIABLE" => "prop",	// Название переменной, в которой передаются характеристики товара
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",	// Название переменной, в которой передается количество товара
		"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",	// Вариант отображения товаров
		"PROPERTY_CODE" => array(	// Свойства
			0 => "",
			1 => "",
		),
		"PROPERTY_CODE_MOBILE" => "",	// Свойства товаров, отображаемые на мобильных устройствах
		"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],	// Параметр ID продукта (для товарных рекомендаций)
		"RCM_TYPE" => "personal",	// Тип рекомендации
		"SECTION_CODE" => "",	// Код раздела
		"SECTION_ID" => $GLOBALS["HISTORY"],	// ID раздела
		"SECTION_ID_VARIABLE" => "SECTION_ID",	// Название переменной, в которой передается код группы
		"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
		"SECTION_USER_FIELDS" => array(	// Свойства раздела
			0 => "",
			1 => "",
		),
		"SEF_MODE" => "N",	// Включить поддержку ЧПУ
		"SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
		"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
		"SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
		"SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
		"SET_STATUS_404" => "N",	// Устанавливать статус 404
		"SET_TITLE" => "N",	// Устанавливать заголовок страницы
		"SHOW_404" => "N",	// Показ специальной страницы
		"SHOW_ALL_WO_SECTION" => "N",	// Показывать все элементы, если не указан раздел
		"SHOW_FROM_SECTION" => "N",	// Показывать товары из раздела
		"SHOW_PRICE_COUNT" => "1",	// Выводить цены для количества
		"SHOW_SLIDER" => "N",	// Показывать слайдер для товаров
		"TEMPLATE_THEME" => "blue",	// Цветовая тема
		"USE_ENHANCED_ECOMMERCE" => "N",	// Отправлять данные электронной торговли в Google и Яндекс
		"USE_MAIN_ELEMENT_SECTION" => "N",	// Использовать основной раздел для показа элемента
		"USE_PRICE_COUNT" => "N",	// Использовать вывод цен с диапазонами
		"USE_PRODUCT_QUANTITY" => "N",	// Разрешить указание количества товара
	),
	false
);?>
    </div>
</section>
<?}?>
<?if($GLOBALS["BANKS"]){?>
    <section id="menu-mortgage">
        <div class="container">
            <h2 class="title-big">Ипотека</h2>

            <?
            global $arBanksFilter;

            foreach ($GLOBALS["BANKS"] as $BANK) {
                $arBanksFilter[] = array("ID" => $BANK);
            }
            $arBanksFilter["LOGIC"] = "OR";
            $arBanksFilter = array($arBanksFilter);
            ?>
            <?$APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "banks",
                array(
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
                    "CHECK_DATES" => "N",
                    "DETAIL_URL" => "",
                    "DISPLAY_BOTTOM_PAGER" => "N",
                    "DISPLAY_DATE" => "N",
                    "DISPLAY_NAME" => "N",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "N",
                    "DISPLAY_TOP_PAGER" => "N",
                    "FIELD_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "FILTER_NAME" => "arBanksFilter",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "IBLOCK_ID" => "4",
                    "IBLOCK_TYPE" => "content",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "INCLUDE_SUBSECTIONS" => "N",
                    "MESSAGE_404" => "",
                    "NEWS_COUNT" => "20",
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
                    "PROPERTY_CODE" => array(
                        0 => "RATE",
                        1 => "FIRST_PAYMENT",
                        2 => "PERIOD",
                        3 => "",
                    ),
                    "SET_BROWSER_TITLE" => "N",
                    "SET_LAST_MODIFIED" => "N",
                    "SET_META_DESCRIPTION" => "N",
                    "SET_META_KEYWORDS" => "N",
                    "SET_STATUS_404" => "N",
                    "SET_TITLE" => "N",
                    "SHOW_404" => "N",
                    "SORT_BY1" => "ACTIVE_FROM",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER1" => "DESC",
                    "SORT_ORDER2" => "ASC",
                    "STRICT_SECTION_CHECK" => "N",
                    "COMPONENT_TEMPLATE" => "banks"
                ),
                false
            );?>

            <?
            $arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_RATE");//IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
            $arFilter = Array("IBLOCK_ID"=>BANKS_CATALOG_ID, "ACTIVE"=>"Y");
            $res = CIBlockElement::GetList(Array("PROPERTY_RATE"=> "ASC"), $arBanksFilter, false, Array(), $arSelect);
            if($ob = $res->GetNextElement()){
                $arFields = $ob->GetFields();
                $arProps = $ob->GetProperties();
                $arResult["BANK"] = $arFields;
                $arResult["BANK"]["PROPERTIES"] = $arProps;
            }
            ?>
            <h2 class="title-big no-strong">мгновенный рассчет ипотечного кредита</h2>
            <div class="gray-card">
                <h4> Минимальная ставка банков на сегодняшний день <b><?=$arResult["BANK"]["PROPERTY_RATE_VALUE"]?>%</b></h4>
                <div class="mortgage-calculation">

                    <?php
                    if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' && $_REQUEST["calc_submit"]) {
                        $APPLICATION->RestartBuffer();

                        if(IntVal($_REQUEST["PRICE"]) && IntVal($_REQUEST["PERIOD"]) && IntVal($_REQUEST["RATE"])){
                            if(IntVal($_REQUEST["SUM"])){
                                $S = IntVal($_REQUEST["PRICE"]) - IntVal($_REQUEST["SUM"]);
                            }else{
                                $S = IntVal($_REQUEST["PRICE"]);
                            }
                            $rate = (1/12) * floatval($_REQUEST["RATE"])/100;
                            $p = 1/12*floatval($_REQUEST["RATE"])/100;
                            $m = $_REQUEST["PERIOD"]*12;
                            $sum = $S*$rate*(1 + 1/((1+$rate)^$m -1));
                            //$sum =  ($S*$p) / (1-(1+$p)^(1-$m));
                        }

                        if ($sum){
                            $success_str = "<p>Ежемесячный платеж: <b>".number_format($sum,0,".", " ")." руб/мес.</b></p>";
                        }
                        ?>{"errorstr":"<?=$error_str?>","success":"<?=$success_str?>"}<?
                        die();
                    }else{
                        ?>

                        <form id="calc-form" action="" method="post" enctype="multipart/form-data" >

                            <input type="hidden" name="RATE" value="<?=$arResult["BANK"]["PROPERTY_RATE_VALUE"]?>"/>
                            <div class="values">
                                <label>
                                    <span>Стоимость квартиры, руб.</span>
                                    <input type="text" class="required" name="PRICE" value="<?=$arResult["PROPERTIES"]["price_discount"]["VALUE"]?>"/>
                                </label>
                                <label>
                                    <span>Первый взнос, руб.</span>
                                    <input type="text"  name="SUM" value=""/>
                                </label>
                                <label>
                                    <span>Срок ипотеки, лет</span>
                                    <input type="text"  name="PERIOD" class="required" value=""/>
                                </label>
                            </div>

                            <div class="price-month">
                                <p></p>
                            </div>
                            <div class="btn-center">
                                <button type="submit" class="btn btn-full" value="Y" name="calc_submit">Рассчитать</button>
                            </div>
                        </form>
                        <script type="text/javascript">
                            $(document).ready(function(){
                                $("body").on("change", "#calc-form .required", function(){
                                    if($(this).val()) $(this).removeClass("error");
                                    else $(this).addClass("error");
                                });
                                var calc_form_options = {
                                    type: "post",
                                    dataType: "json",
                                    success: function(data){
                                        $("#calc-form .btn").attr("disabled", "").removeClass("disabled");
                                        if(data.errorstr){
                                            $("#calc-form .errors").html(data.errorstr);
                                        }else{
                                            if(data.success){
                                                $("#calc-form .errors").html("");
                                                $("#calc-form .price-month").html(data.success);
                                            }
                                        }
                                    },
                                    beforeSubmit: function(){
                                        var error = false;
                                        $("#calc-form .errors").text();
                                        $("#calc-form .required").each(function(){
                                            if($(this).is("textarea")) var type="textarea"; else if($(this).is("input")) var type = $(this).attr("type");
                                            switch (type) {
                                                case 'text':
                                                case 'textarea':
                                                    if(!$(this).val()){
                                                        error = true;
                                                        $(this).addClass("error");
                                                    }
                                                    break;
                                            }
                                        });

                                        if(error == true) {
                                            return false;
                                        }
                                        $("#calc-form .errors").html("");
                                        $("#calc-form .btn").attr("disabled", "disabled").addClass("disabled");
                                    }
                                }

                                $('#calc-form').ajaxForm(calc_form_options);
                            });

                        </script>
                    <?}?>
                    <div class="mortgage-terms">
                        <p>Свяжитесь, чтобы уточнить условия ипотеки:</p>
                        <?$APPLICATION->IncludeComponent("custom:iblock.element.add.form", "mortgage", Array(
	"COMPONENT_TEMPLATE" => "get_info",
		"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",	// * дата начала *
		"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",	// * дата завершения *
		"CUSTOM_TITLE_DETAIL_PICTURE" => "",	// * подробная картинка *
		"CUSTOM_TITLE_DETAIL_TEXT" => "",	// * подробный текст *
		"CUSTOM_TITLE_IBLOCK_SECTION" => "",	// * раздел инфоблока *
		"CUSTOM_TITLE_NAME" => "Ваш телефон",	// * наименование *
		"CUSTOM_TITLE_PREVIEW_PICTURE" => "",	// * картинка анонса *
		"CUSTOM_TITLE_PREVIEW_TEXT" => "",	// * текст анонса *
		"CUSTOM_TITLE_TAGS" => "",	// * теги *
		"DEFAULT_INPUT_SIZE" => "30",	// Размер полей ввода
		"DETAIL_TEXT_USE_HTML_EDITOR" => "N",	// Использовать визуальный редактор для редактирования подробного текста
		"ELEMENT_ASSOC" => "CREATED_BY",	// Привязка к пользователю
		"GROUPS" => array(	// Группы пользователей, имеющие право на добавление/редактирование
			0 => "2",
		),
		"IBLOCK_ID" => "7",	// Инфоблок
		"IBLOCK_TYPE" => "feedback",	// Тип инфоблока
		"LEVEL_LAST" => "Y",	// Разрешить добавление только на последний уровень рубрикатора
		"LIST_URL" => "",	// Страница со списком своих элементов
		"MAX_FILE_SIZE" => "0",	// Максимальный размер загружаемых файлов, байт (0 - не ограничивать)
		"MAX_LEVELS" => "100000",	// Ограничить кол-во рубрик, в которые можно добавлять элемент
		"MAX_USER_ENTRIES" => "100000",	// Ограничить кол-во элементов для одного пользователя
		"PREVIEW_TEXT_USE_HTML_EDITOR" => "N",	// Использовать визуальный редактор для редактирования текста анонса
		"PROPERTY_CODES" => array(	// Свойства, выводимые на редактирование
			0 => "31",
			1 => "NAME",
		),
		"PROPERTY_CODES_REQUIRED" => array(	// Свойства, обязательные для заполнения
			0 => "NAME",
		),
		"RESIZE_IMAGES" => "N",	// Использовать настройки инфоблока для обработки изображений
		"SEF_MODE" => "N",	// Включить поддержку ЧПУ
		"STATUS" => "ANY",	// Редактирование возможно
		"STATUS_NEW" => "N",	// Деактивировать элемент
		"USER_MESSAGE_ADD" => "Ваше сообщение успешно отправлено",	// Сообщение об успешном добавлении
		"USER_MESSAGE_EDIT" => "Ваше сообщение успешно отправлено",	// Сообщение об успешном сохранении
		"USE_CAPTCHA" => "N",	// Использовать CAPTCHA
		"EVENT_NAME" => "SEND_MSG"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "Y"
	)
);?>
                    </div>

                </div>
            </div>
        </div>
    </section>
<?}?>
<section class="bg-gray similar-offers">
    <div class="container">
        <div class="control-builders">
            <div class="tabs">
                <div class="nav-builders">
                    <ul>
                        <li><a href="#tab-near" class="btn btn-border">Рядом</a></li>
                        <li><a href="#tab-price" class="btn btn-border">С похожей ценой</a></li>
                        <li><a href="#tab-builder" class="btn btn-border">Тот же застройщик</a></li>
                    </ul>
                </div>
                <div class="control-builders-content">
                    <h2 class="title-big cursive-title-right">Похожие предложения<span class="title-top"><span class="dop-title">По вашим параметрам</span></span></h2>
                        <div id="tab-near">
                            <?
                            if($GLOBALS["METRO"]) {
                                global $arDistrictFilter;
                                $arDistrictFilter = array("!ID" => $intSectionID, "UF_METRO" => $GLOBALS["METRO"]); ?>
                                <? $APPLICATION->IncludeComponent("custom:catalog.section.list", "carousel", Array(
                                    "ADD_SECTIONS_CHAIN" => "N",    // Включать раздел в цепочку навигации
                                    "CACHE_GROUPS" => "Y",    // Учитывать права доступа
                                    "CACHE_TIME" => "36000000",    // Время кеширования (сек.)
                                    "CACHE_TYPE" => "N",    // Тип кеширования
                                    "COUNT_ELEMENTS" => "N",    // Показывать количество элементов в разделе
                                    "IBLOCK_ID" => "1",    // Инфоблок
                                    "IBLOCK_TYPE" => "catalog",    // Тип инфоблока
                                    "SECTION_CODE" => "",    // Код раздела
                                    "SECTION_FIELDS" => array(    // Поля разделов
                                        0 => "",
                                        1 => "",
                                    ),
                                    "SECTION_ID" => "",    // ID раздела
                                    "SECTION_URL" => "",    // URL, ведущий на страницу с содержимым раздела
                                    "SECTION_USER_FIELDS" => array(    // Свойства разделов
                                        0 => "UF_DEVELOPER",
                                        1 => "UF_METRO",
                                    ),
                                    "SHOW_PARENT_NAME" => "N",    // Показывать название раздела
                                    "TOP_DEPTH" => "",    // Максимальная отображаемая глубина разделов
                                    "VIEW_MODE" => "TILE",    // Вид списка подразделов
                                    "FILTER_NAME" => "arDistrictFilter",
                                    "COMPONENT_TEMPLATE" => "objects",
                                    "HIDE_SECTION_NAME" => "N",    // Не показывать названия подразделов
                                ),
                                    false
                                );
                            }?>
                        </div>
                        <div id="tab-price">
                            <?
                            global $arPriceFilter;
                            $arPriceFilter = array("!ID" => $intSectionID,"<UF_MIN_PRICE" => $GLOBALS["MIN_PRICE"]+200000, ">UF_MIN_PRICE" => $GLOBALS["MIN_PRICE"]-200000);

                            ?>
                            <?$APPLICATION->IncludeComponent("custom:catalog.section.list", "carousel", Array(
                                "ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
                                "CACHE_GROUPS" => "Y",	// Учитывать права доступа
                                "CACHE_TIME" => "36000000",	// Время кеширования (сек.)
                                "CACHE_TYPE" => "N",	// Тип кеширования
                                "COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
                                "IBLOCK_ID" => "1",	// Инфоблок
                                "IBLOCK_TYPE" => "catalog",	// Тип инфоблока
                                "SECTION_CODE" => "",	// Код раздела
                                "SECTION_FIELDS" => array(	// Поля разделов
                                    0 => "",
                                    1 => "",
                                ),
                                "SECTION_ID" => "",	// ID раздела
                                "SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
                                "SECTION_USER_FIELDS" => array(	// Свойства разделов
                                    0 => "UF_DEVELOPER",
                                    1 => "UF_METRO",
                                ),
                                "SHOW_PARENT_NAME" => "N",	// Показывать название раздела
                                "TOP_DEPTH" => "",	// Максимальная отображаемая глубина разделов
                                "VIEW_MODE" => "TILE",	// Вид списка подразделов
                                "FILTER_NAME" => "arPriceFilter",
                                "COMPONENT_TEMPLATE" => "objects",
                                "HIDE_SECTION_NAME" => "N",	// Не показывать названия подразделов
                            ),
                                false
                            );?>
                        </div>
                    <div id="tab-builder">

                        <?
                        global $arDeveloperFilter;
                        $arDeveloperFilter = array("!ID" => $intSectionID, "UF_DEVELOPER" => $GLOBALS["DEVELOPER"]);?>
                        <?$APPLICATION->IncludeComponent("custom:catalog.section.list", "carousel", Array(
	"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_TYPE" => "N",	// Тип кеширования
		"COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
		"IBLOCK_ID" => "1",	// Инфоблок
		"IBLOCK_TYPE" => "catalog",	// Тип инфоблока
		"SECTION_CODE" => "",	// Код раздела
		"SECTION_FIELDS" => array(	// Поля разделов
			0 => "",
			1 => "",
		),
		"SECTION_ID" => "",	// ID раздела
		"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
		"SECTION_USER_FIELDS" => array(	// Свойства разделов
			0 => "UF_DEVELOPER",
			1 => "UF_METRO",
		),
		"SHOW_PARENT_NAME" => "N",	// Показывать название раздела
		"TOP_DEPTH" => "",	// Максимальная отображаемая глубина разделов
		"VIEW_MODE" => "TILE",	// Вид списка подразделов
		"FILTER_NAME" => "arDeveloperFilter",
		"COMPONENT_TEMPLATE" => "objects",
		"HIDE_SECTION_NAME" => "N",	// Не показывать названия подразделов
	),
	false
);?>

                    </div>
                </div>
            </div>
        </div>

        <script>
            $( function() {
                $( ".tabs" ).tabs();
            } );
        </script>









    </div>
</section>
<section class="full-phone">
    <div class="container">
        <div class="blue-card card-full">
            <img src="<?=SITE_TEMPLATE_PATH?>/img/card-ico/phone.png" alt="">
            <div class="blue-card-content">
                <h2>Свяжитесь, чтобы получить полную информацию о новостройках</h2>


<?$APPLICATION->IncludeComponent("custom:iblock.element.add.form", "get_info", array(
	"COMPONENT_TEMPLATE" => "get_info",
		"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
		"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
		"CUSTOM_TITLE_DETAIL_PICTURE" => "",
		"CUSTOM_TITLE_DETAIL_TEXT" => "",
		"CUSTOM_TITLE_IBLOCK_SECTION" => "",
		"CUSTOM_TITLE_NAME" => "Ваш телефон",
		"CUSTOM_TITLE_PREVIEW_PICTURE" => "",
		"CUSTOM_TITLE_PREVIEW_TEXT" => "",
		"CUSTOM_TITLE_TAGS" => "",
		"DEFAULT_INPUT_SIZE" => "30",
		"DETAIL_TEXT_USE_HTML_EDITOR" => "N",
		"ELEMENT_ASSOC" => "CREATED_BY",
		"GROUPS" => array(
			0 => "2",
		),
		"IBLOCK_ID" => "7",
		"IBLOCK_TYPE" => "feedback",
		"LEVEL_LAST" => "Y",
		"LIST_URL" => "",
		"MAX_FILE_SIZE" => "0",
		"MAX_LEVELS" => "100000",
		"MAX_USER_ENTRIES" => "100000",
		"PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
		"PROPERTY_CODES" => array(
			0 => "31",
			1 => "NAME",
		),
		"PROPERTY_CODES_REQUIRED" => array(
			0 => "NAME",
		),
		"RESIZE_IMAGES" => "N",
		"SEF_MODE" => "N",
		"STATUS" => "ANY",
		"STATUS_NEW" => "N",
		"USER_MESSAGE_ADD" => "Ваше сообщение успешно отправлено",
		"USER_MESSAGE_EDIT" => "Ваше сообщение успешно отправлено",
		"USE_CAPTCHA" => "N",
		"EVENT_NAME" => "SEND_MSG"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "Y"
	)
);?>
            </div>
        </div>
    </div>
</section>
<?
    if($_COOKIE['ITEM_VIEW']){
        global $arViewedItemsFilter;
        $arViewedItemsFilter = array("ID" => unserialize($_COOKIE['ITEM_VIEW']));


?>
<section>
    <div class="container">
            <?$APPLICATION->IncludeComponent("custom:catalog.section.list", "history", Array(
	"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_TYPE" => "N",	// Тип кеширования
		"COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
		"IBLOCK_ID" => "1",	// Инфоблок
		"IBLOCK_TYPE" => "catalog",	// Тип инфоблока
		"SECTION_CODE" => "",	// Код раздела
		"SECTION_FIELDS" => array(	// Поля разделов
			0 => "",
			1 => "",
		),
		"SECTION_ID" => "",	// ID раздела
		"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
		"SECTION_USER_FIELDS" => array(	// Свойства разделов
			0 => "",
			1 => "",
		),
		"SHOW_PARENT_NAME" => "N",	// Показывать название раздела
		"TOP_DEPTH" => "",	// Максимальная отображаемая глубина разделов
		"VIEW_MODE" => "TILE",	// Вид списка подразделов
		"FILTER_NAME" => "arViewedItemsFilter",
		"COMPONENT_TEMPLATE" => "objects",
		"HIDE_SECTION_NAME" => "N",	// Не показывать названия подразделов
	),
	false
);?>
    </div>
</section>
<?}?>

