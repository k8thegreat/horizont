<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Ипотека");
?><section class="builder-small-slide shadow" style="background-image: url(<?=SITE_TEMPLATE_PATH?>/img/builders/slide-bg.png);">
    <?$APPLICATION->IncludeComponent(
            "bitrix:breadcrumb",
            "breadcrumb",
            Array(
                "PATH" => "",
                "SITE_ID" => "s1",
                "START_FROM" => "0"
            )
        );?>
    <h1 class="title-big"><?$APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "COMPOSITE_FRAME_MODE" => "A",
                "COMPOSITE_FRAME_TYPE" => "AUTO",
                "EDIT_TEMPLATE" => "",
                "PATH" => "/includes/mortgage_title.php"
            )
        );?></h1>
    <div class="container">
        <div class="btn-center">
            <a href="" class="btn btn-border">Получите бесплатную консультацию</a>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <h2 class="title-big cursive-title-left">Наши возможности<span class="title-top"><span class="dop-title">Преимущества</span></span></h2>
        <?$APPLICATION->IncludeComponent("bitrix:news.list", "mortgage_advantages", Array(
	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "N",	// Включить подгрузку стилей
		"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
		"COMPOSITE_FRAME_MODE" => "A",	// Голосование шаблона компонента по умолчанию
		"COMPOSITE_FRAME_TYPE" => "AUTO",	// Содержимое компонента
		"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
		"DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
		"DISPLAY_DATE" => "N",	// Выводить дату элемента
		"DISPLAY_NAME" => "Y",	// Выводить название элемента
		"DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса
		"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"FIELD_CODE" => array(	// Поля
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",	// Фильтр
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
		"IBLOCK_ID" => "12",	// Код информационного блока
		"IBLOCK_TYPE" => "content",	// Тип информационного блока (используется только для проверки)
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
		"INCLUDE_SUBSECTIONS" => "N",	// Показывать элементы подразделов раздела
		"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
		"NEWS_COUNT" => "4",	// Количество новостей на странице
		"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
		"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
		"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
		"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
		"PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
		"PAGER_TITLE" => "",	// Название категорий
		"PARENT_SECTION" => "",	// ID раздела
		"PARENT_SECTION_CODE" => "",	// Код раздела
		"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
		"PROPERTY_CODE" => array(	// Свойства
			0 => "ICON",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
		"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
		"SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
		"SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
		"SET_STATUS_404" => "N",	// Устанавливать статус 404
		"SET_TITLE" => "N",	// Устанавливать заголовок страницы
		"SHOW_404" => "N",	// Показ специальной страницы
		"SORT_BY1" => "SORT",	// Поле для первой сортировки новостей
		"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
		"SORT_ORDER1" => "ASC",	// Направление для первой сортировки новостей
		"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
		"STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа списка
	),
	false
);?>

        <h2 class="title-big no-strong">Мгновенный рассчет ипотечного кредита</h2>
        <div class="gray-card">
            <h4>Минимальная ставка банков на сегодняшний день <b>11%</b></h4>
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
                            $rate = floatval($_REQUEST["RATE"])/100/12;
                            $m = IntVal($_REQUEST["PERIOD"])*12;
                            $sum = $S*($rate/(1-pow(1+$rate, -$m)));
                        }
                        if ($sum){
                            $success_str = "<p>Ежемесячный платеж: <b>".number_format($sum,0,".", " ")." руб/мес.</b></p>";
                        }
                        ?>{"errorstr":"<?=$error_str?>","success":"<?=$success_str?>"}<?
                        die();
                    }else{
                        ?>
                        <form id="calc-form" action="" method="post" enctype="multipart/form-data" >
                            <div class="values">
                                <label>
                                    <span>Процентная ставка, %</span>
                                    <input type="text" class="required" name="RATE" value="11"/>
                                </label>
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
                                        $("#calc-form .btn").prop("disabled",false).removeClass("disabled");
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
                                        $("#calc-form .btn").prop("disabled", "disabled").addClass("disabled");
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
</section>

<section class="bg-gray">
    <div class="container">
        <h2 class="title-big cursive-title-right">Банки, с которыми мы работаем<span class="title-top"><span class="dop-title">Наши партнеры</span></span></h2>
        <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"mortgage", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "4",
		"IBLOCK_TYPE" => "content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "5",
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
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "mortgage"
	),
	false
);?>
    </div>
</section>
<section class="wrap-plane-blue-card">
    <div class="container">
        <div class="blue-card card-full ico-plane">
			<img src="<?=SITE_TEMPLATE_PATH?>/img/card-ico/plane.png" alt="">
            <div class="blue-card-content">
                <h2>Узнайте лучшие условия ипотеки на сегодня</h2>
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
</section><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>