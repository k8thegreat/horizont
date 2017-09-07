</main>
<a href="" class="scroll-top">
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px"
         viewBox="0 0 31.479 31.479" xml:space="preserve">
        <path d="M26.477,10.274c0.444,0.444,0.444,1.143,0,1.587c-0.429,0.429-1.143,0.429-1.571,0l-8.047-8.047  v26.555c0,0.619-0.492,1.111-1.111,1.111c-0.619,0-1.127-0.492-1.127-1.111V3.813l-8.031,8.047c-0.444,0.429-1.159,0.429-1.587,0  c-0.444-0.444-0.444-1.143,0-1.587l9.952-9.952c0.429-0.429,1.143-0.429,1.571,0L26.477,10.274z"/>
    </svg>
</a>
</div><!-- .wrapper -->
<footer class="footer">
    <div class="container">
        <div class="footer-content-top">
            <div class="box-info">
                <h4 class="footer-title">Новостройки в санкт-петербурге</h4>
                <div class="footer-list">
                    <?
                    global $arFooterItemsFilter;
                    $arFooterItemsFilter = array("IBLOCK_ID" => CATALOG_IBLOCK_ID, "UF_SHOW_IN_FOOTER" => "Y");
                    ?>
                    <?$APPLICATION->IncludeComponent("custom:catalog.section.list", "footer_objects", Array(
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
		"FILTER_NAME" => "arFooterItemsFilter",
		"COMPONENT_TEMPLATE" => "objects",
		"HIDE_SECTION_NAME" => "N",	// Не показывать названия подразделов
	),
	false
);?>

                </div>
            </div>
            <div class="box-footer-nav">
                <div>
                    <h4 class="footer-title">Квартиры на севере</h4>
                    <div class="footer-list">
                        <a href="/novostroyki/?set_filter=y&arrFilter_3_894006417=Y">м. Коменданский проспект</a>
                        <a href="/novostroyki/?set_filter=y&arrFilter_3_1886922373=Y">м. Парнас</a>
                        <a href="/novostroyki/?set_filter=y&arrFilter_3_725582281=Y">м. Лесная</a>
                        <a href="/novostroyki/?set_filter=y&arrFilter_3_2545945474=Y">м. Пионерская</a>
                        <a href="/novostroyki/?set_filter=y&arrFilter_3_3937927111=Y">м. Девяткино</a>
                    </div>
                </div>
                <div>
                    <h4 class="footer-title">Квартиры на ЮГЕ</h4>
                    <div class="footer-list">
                        <a href="/novostroyki/?set_filter=y&arrFilter_3_1159954462=Y">м. Звездная</a>
                        <a href="/novostroyki/?set_filter=y&arrFilter_3_3832313845=Y">м. Проспект Ветеранов</a>
                        <a href="/novostroyki/?set_filter=y&arrFilter_3_3539032470=Y">м. Купчино</a>
                        <a href="/novostroyki/?set_filter=y&arrFilter_3_2871910706=Y">м. Дыбенко</a>
                        <a href="/novostroyki/?set_filter=y&arrFilter_3_1532327238=Y">м. Московская</a>
                    </div>
                </div>
                <div>
                    <h4 class="footer-title">Квартиры </h4>
                    <div class="footer-list">
                        <a href="/novostroyki/?set_filter=Y&arrFilter_22_2212294583=Y">Студии</a>
                        <a href="/novostroyki/?set_filter=y&arrFilter_22_450215437=Y">1-комнатные</a>
                        <a href="/novostroyki/?set_filter=y&arrFilter_22_1842515611=Y">2-комнатные</a>
                        <a href="/novostroyki/?set_filter=y&arrFilter_22_4088798008=Y">3-комнатные</a>
                    </div>
                </div>
                <div>
                    <h4 class="footer-title">полезная информация</h4>
                    <div class="footer-list">
                        <?$APPLICATION->IncludeComponent("bitrix:news.list", "footer_links", Array(
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
		"DISPLAY_PICTURE" => "N",	// Выводить изображение для анонса
		"DISPLAY_PREVIEW_TEXT" => "N",	// Выводить текст анонса
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"FIELD_CODE" => array(	// Поля
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",	// Фильтр
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
		"IBLOCK_ID" => "10",	// Код информационного блока
		"IBLOCK_TYPE" => "content",	// Тип информационного блока (используется только для проверки)
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
		"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
		"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
		"NEWS_COUNT" => "7",	// Количество новостей на странице
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
			0 => "",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
		"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
		"SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
		"SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
		"SET_STATUS_404" => "N",	// Устанавливать статус 404
		"SET_TITLE" => "N",	// Устанавливать заголовок страницы
		"SHOW_404" => "N",	// Показ специальной страницы
		"SORT_BY1" => "ACTIVE_FROM",	// Поле для первой сортировки новостей
		"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
		"SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
		"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
		"STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа списка
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>

                    </div>
                </div>
                <div>
                    <h4 class="footer-title">Варианты оплаты</h4>
                    <div class="footer-list">
                        <a href="/novostroyki/?set_filter=y&arrFilter_35_2274021061=Y">Военная ипотека</a>
                        <a href="/novostroyki/?set_filter=y&arrFilter_35_1770303465=Y">Материнский капитал</a>
                    </div>
                </div>
                <div>
                    <h4 class="footer-title">Год сдачи</h4>
                    <div class="footer-list">
                        <a href="">2015 год.</a>
                        <a href="">2016 год.</a>
                        <a href="">2017 год.</a>
                        <a href="">2018 год.</a>

                    </div>
                </div>
                <div>
                    <h4 class="footer-title">Стоимость</h4>
                    <div class="footer-list">
                        <a href="/novostroyki/?set_filter=y&arrFilter_27_MAX=1000000">Кв-ра за 1 млн</a>
                        <a href="/novostroyki/?set_filter=y&arrFilter_27_MAX=2000000">Кв-ра за 2 млн</a>
                        <a href="/novostroyki/?set_filter=y&arrFilter_27_MAX=3000000">Кв-ра за 3 млн</a>
                        <a href="/novostroyki/?set_filter=y&arrFilter_27_MAX=4000000">Кв-ра за 4 млн</a>
                    </div>
                </div>
                <div class="contacts">
                    <h4 class="footer-title">Контакты</h4>
                    <div class="footer-list">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "COMPOSITE_FRAME_MODE" => "A",
                                "COMPOSITE_FRAME_TYPE" => "AUTO",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => "/includes/footer_contacts.php"
                            )
                        );?>
                    </div>
                </div>
                <div>
                    <h4 class="footer-title">новостройки в ленобласти</h4>
                    <div class="footer-list">
                        <a href="/novostroyki/?set_filter=y&arrFilter_1_3495862007=Y">г. Гатчина</a>
                        <a href="/novostroyki/?set_filter=y&arrFilter_1_3631440898=Y">г. Колпино</a>
                        <a href="/novostroyki/?set_filter=y&arrFilter_1_762577961=Y">Мурино</a>
                        <a href="/novostroyki/?set_filter=y&arrFilter_1_2273900021=Y">Шушары</a>
                        <a href="/novostroyki/?set_filter=y&arrFilter_1_166262827=Y">Всеволожск</a>
                    </div>
                </div>
                <div>
                    <h4 class="footer-title">новостройки в ленобласти</h4>
                    <div class="footer-list">
                        <a href="/novostroyki/?set_filter=y&arrFilter_1_1307564635=Y">Янино</a>
                        <a href="/novostroyki/?set_filter=y&arrFilter_1_2906900607=Y">г. Ломоносов</a>
                        <a href="/novostroyki/?set_filter=y&arrFilter_1_1348989193=Y">Парголово</a>
                        <a href="/novostroyki/?set_filter=y&arrFilter_1_2484444824=Y">Новое Девяткино</a>
                        <a href="/novostroyki/?set_filter=y&arrFilter_1_1111777430=Y">Сертолово</a>
                    </div>
                </div>
                <div class="subscription">
                    <p class="subscription-des">Подпишитесь на самые главные новости о новостройках
                        (1-2 письма в месяц)</p>


                    <?$APPLICATION->IncludeComponent("bitrix:subscribe.form", "subscribe", Array(
	"CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"PAGE" => "#SITE_DIR#personal/subscribe/",	// Страница редактирования подписки (доступен макрос #SITE_DIR#)
		"SHOW_HIDDEN" => "N",	// Показать скрытые рубрики подписки
		"USE_PERSONALIZATION" => "Y",	// Определять подписку текущего пользователя
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>

                </div>
            </div>
        </div>
    </div>
    <div class="copy">
        <?$APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "PATH" => "/includes/footer_text.php"
            )
        );?>
    </div>
</footer><!-- .footer -->

<div class="modal" id="modal-callback">
    <div class="transparent"></div>
    <div class="modal-body">
        <div class="close"></div>
        <h3 class="title-big">обратный звонок</h3>
        <p>Перезвоним в рабочие дни
            с 8:00 до 20:00</p>
        <?$APPLICATION->IncludeComponent(
            "custom:iblock.element.add.form",
            "callback",
            array(
                "COMPONENT_TEMPLATE" => "callback",
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
                "IBLOCK_ID" => "8",
                "IBLOCK_TYPE" => "feedback",
                "LEVEL_LAST" => "Y",
                "LIST_URL" => "",
                "MAX_FILE_SIZE" => "0",
                "MAX_LEVELS" => "100000",
                "MAX_USER_ENTRIES" => "100000",
                "PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
                "PROPERTY_CODES" => array(

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
            false
        );?>

    </div>
</div>
<div class="modal" id="modal-apartment">
    <div class="transparent"></div>
    <div class="modal-body">
        <div class="close"></div>
        <div class="modal-body-innner">
        </div>
    </div>
</div>
</body>
</html>