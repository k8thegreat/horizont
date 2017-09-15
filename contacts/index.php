<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контактная информация");
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
        <div class="container">
            <h2 class="title-big"><?=$APPLICATION->ShowTitle(true);?></h2>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="contact-card">
                <?$APPLICATION->IncludeComponent(
	"bitrix:map.yandex.view",
	"contacts_map",
	array(
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"CONTROLS" => array(
			0 => "ZOOM",
			1 => "MINIMAP",
			2 => "TYPECONTROL",
			3 => "SCALELINE",
		),
		"INIT_MAP_TYPE" => "MAP",
		"MAP_DATA" => "a:4:{s:10:\"yandex_lat\";d:59.9292340888496;s:10:\"yandex_lon\";d:30.313590770827396;s:12:\"yandex_scale\";i:12;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:3:\"LON\";d:30.37466777049932;s:3:\"LAT\";d:59.93050508613367;s:4:\"TEXT\";s:0:\"\";}}}",
		"MAP_HEIGHT" => "500",
		"MAP_ID" => "",
		"MAP_WIDTH" => "600",
		"OPTIONS" => array(
			0 => "ENABLE_SCROLL_ZOOM",
			1 => "ENABLE_DBLCLICK_ZOOM",
			2 => "ENABLE_DRAGGING",
		),
		"COMPONENT_TEMPLATE" => "contacts_map"
	),
	false
);?>
                <div class="shadow-card">
                    <div class="address">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "COMPOSITE_FRAME_MODE" => "A",
                                "COMPOSITE_FRAME_TYPE" => "AUTO",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => "/includes/contacts_pretext.php"
                            )
                        );?>
                        </div>
                    <ul class="contact-info">
                        <li>
                            <?=ADDRESS_ICON?>
                            <div class="contact-content">
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    Array(
                                        "AREA_FILE_SHOW" => "file",
                                        "AREA_FILE_SUFFIX" => "inc",
                                        "COMPOSITE_FRAME_MODE" => "A",
                                        "COMPOSITE_FRAME_TYPE" => "AUTO",
                                        "EDIT_TEMPLATE" => "",
                                        "PATH" => "/includes/contacts_address.php"
                                    )
                                );?>
                            </div>
                        </li>
                        <li>
                            <?=PHONE_ICON?>
                            <div class="contact-content">
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    Array(
                                        "AREA_FILE_SHOW" => "file",
                                        "AREA_FILE_SUFFIX" => "inc",
                                        "COMPOSITE_FRAME_MODE" => "A",
                                        "COMPOSITE_FRAME_TYPE" => "AUTO",
                                        "EDIT_TEMPLATE" => "",
                                        "PATH" => "/includes/contacts_phone.php"
                                    )
                                );?>
                            </div>
                        </li>
                        <li>
                            <?=EMAIL_ICON?>
                            <div class="contact-content">
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    Array(
                                        "AREA_FILE_SHOW" => "file",
                                        "AREA_FILE_SUFFIX" => "inc",
                                        "COMPOSITE_FRAME_MODE" => "A",
                                        "COMPOSITE_FRAME_TYPE" => "AUTO",
                                        "EDIT_TEMPLATE" => "",
                                        "PATH" => "/includes/contacts_email.php"
                                    )
                                );?>
                            </div>
                        </li>
                        <li>
                            <?=SCHEDULE_ICON?>
                            <div class="contact-content">
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    Array(
                                        "AREA_FILE_SHOW" => "file",
                                        "AREA_FILE_SUFFIX" => "inc",
                                        "COMPOSITE_FRAME_MODE" => "A",
                                        "COMPOSITE_FRAME_TYPE" => "AUTO",
                                        "EDIT_TEMPLATE" => "",
                                        "PATH" => "/includes/contacts_schedule.php"
                                    )
                                );?>
                            </div>
                        </li>
                    </ul>
                    <a href="" class="link-download">
                        <?=DOWNLOAD_ICON?>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "COMPOSITE_FRAME_MODE" => "A",
                                "COMPOSITE_FRAME_TYPE" => "AUTO",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => "/includes/contacts_download.php"
                            )
                        );?>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="blue-card card-full contact-form">
                <img src="<?=SITE_TEMPLATE_PATH?>/img/card-ico/plane.png" alt="">
                <div class="blue-card-content">
                    <h2>Свяжитесь с нами</h2>
                    <?$APPLICATION->IncludeComponent(
	"custom:iblock.element.add.form",
	"contacts",
	array(
		"COMPONENT_TEMPLATE" => "contacts",
		"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
		"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
		"CUSTOM_TITLE_DETAIL_PICTURE" => "",
		"CUSTOM_TITLE_DETAIL_TEXT" => "",
		"CUSTOM_TITLE_IBLOCK_SECTION" => "",
		"CUSTOM_TITLE_NAME" => "Ваше имя",
		"CUSTOM_TITLE_PREVIEW_PICTURE" => "",
		"CUSTOM_TITLE_PREVIEW_TEXT" => "Сообщение",
		"CUSTOM_TITLE_TAGS" => "",
		"DEFAULT_INPUT_SIZE" => "30",
		"DETAIL_TEXT_USE_HTML_EDITOR" => "N",
		"ELEMENT_ASSOC" => "CREATED_BY",
		"GROUPS" => array(
			0 => "2",
		),
		"IBLOCK_ID" => "17",
		"IBLOCK_TYPE" => "feedback",
		"LEVEL_LAST" => "Y",
		"LIST_URL" => "",
		"MAX_FILE_SIZE" => "0",
		"MAX_LEVELS" => "100000",
		"MAX_USER_ENTRIES" => "100000",
		"PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
		"PROPERTY_CODES" => array(
			0 => "45",
			1 => "NAME",
			2 => "PREVIEW_TEXT",
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
		"EVENT_NAME" => "SEND_MSG",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
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
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>