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
                    <p class="address">
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
                        </p>
                    <ul class="contact-info">
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" class="address-ico" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 60 60" xml:space="preserve">
                                <g>
                                    <path d="M30,26c3.86,0,7-3.141,7-7s-3.14-7-7-7s-7,3.141-7,7S26.14,26,30,26z M30,14c2.757,0,5,2.243,5,5s-2.243,5-5,5   s-5-2.243-5-5S27.243,14,30,14z"/>
                                    <path d="M29.823,54.757L45.164,32.6c5.754-7.671,4.922-20.28-1.781-26.982C39.761,1.995,34.945,0,29.823,0   s-9.938,1.995-13.56,5.617c-6.703,6.702-7.535,19.311-1.804,26.952L29.823,54.757z M17.677,7.031C20.922,3.787,25.235,2,29.823,2   s8.901,1.787,12.146,5.031c6.05,6.049,6.795,17.437,1.573,24.399L29.823,51.243L16.082,31.4   C10.882,24.468,11.628,13.08,17.677,7.031z"/>
                                    <path d="M42.117,43.007c-0.55-0.067-1.046,0.327-1.11,0.876s0.328,1.046,0.876,1.11C52.399,46.231,58,49.567,58,51.5   c0,2.714-10.652,6.5-28,6.5S2,54.214,2,51.5c0-1.933,5.601-5.269,16.117-6.507c0.548-0.064,0.94-0.562,0.876-1.11   c-0.065-0.549-0.561-0.945-1.11-0.876C7.354,44.247,0,47.739,0,51.5C0,55.724,10.305,60,30,60s30-4.276,30-8.5   C60,47.739,52.646,44.247,42.117,43.007z" />
                                </g>
                            </svg>
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
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 60 60" xml:space="preserve">
                                <g>
                                    <path d="M42.595,0H17.405C14.977,0,13,1.977,13,4.405v51.189C13,58.023,14.977,60,17.405,60h25.189C45.023,60,47,58.023,47,55.595   V4.405C47,1.977,45.023,0,42.595,0z M15,8h30v38H15V8z M17.405,2h25.189C43.921,2,45,3.079,45,4.405V6H15V4.405   C15,3.079,16.079,2,17.405,2z M42.595,58H17.405C16.079,58,15,56.921,15,55.595V48h30v7.595C45,56.921,43.921,58,42.595,58z"/>
                                    <path d="M30,49c-2.206,0-4,1.794-4,4s1.794,4,4,4s4-1.794,4-4S32.206,49,30,49z M30,55c-1.103,0-2-0.897-2-2s0.897-2,2-2   s2,0.897,2,2S31.103,55,30,55z"/>
                                    <path d="M26,5h4c0.553,0,1-0.447,1-1s-0.447-1-1-1h-4c-0.553,0-1,0.447-1,1S25.447,5,26,5z"/>
                                    <path d="M33,5h1c0.553,0,1-0.447,1-1s-0.447-1-1-1h-1c-0.553,0-1,0.447-1,1S32.447,5,33,5z"/>
                                    <path d="M56.612,4.569c-0.391-0.391-1.023-0.391-1.414,0s-0.391,1.023,0,1.414c3.736,3.736,3.736,9.815,0,13.552   c-0.391,0.391-0.391,1.023,0,1.414c0.195,0.195,0.451,0.293,0.707,0.293s0.512-0.098,0.707-0.293   C61.128,16.434,61.128,9.085,56.612,4.569z"/>
                                    <path d="M52.401,6.845c-0.391-0.391-1.023-0.391-1.414,0s-0.391,1.023,0,1.414c1.237,1.237,1.918,2.885,1.918,4.639   s-0.681,3.401-1.918,4.638c-0.391,0.391-0.391,1.023,0,1.414c0.195,0.195,0.451,0.293,0.707,0.293s0.512-0.098,0.707-0.293   c1.615-1.614,2.504-3.764,2.504-6.052S54.017,8.459,52.401,6.845z"/>
                                    <path d="M4.802,5.983c0.391-0.391,0.391-1.023,0-1.414s-1.023-0.391-1.414,0c-4.516,4.516-4.516,11.864,0,16.38   c0.195,0.195,0.451,0.293,0.707,0.293s0.512-0.098,0.707-0.293c0.391-0.391,0.391-1.023,0-1.414   C1.065,15.799,1.065,9.72,4.802,5.983z"/>
                                    <path d="M9.013,6.569c-0.391-0.391-1.023-0.391-1.414,0c-1.615,1.614-2.504,3.764-2.504,6.052s0.889,4.438,2.504,6.053   c0.195,0.195,0.451,0.293,0.707,0.293s0.512-0.098,0.707-0.293c0.391-0.391,0.391-1.023,0-1.414   c-1.237-1.237-1.918-2.885-1.918-4.639S7.775,9.22,9.013,7.983C9.403,7.593,9.403,6.96,9.013,6.569z"/>
                                </g>
                            </svg>
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
                            <svg xmlns="http://www.w3.org/2000/svg" class="e-mail" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 31.012 31.012" xml:space="preserve" >
                                <g>
                                    <g>
                                        <path d="M25.109,21.51c-0.123,0-0.246-0.045-0.342-0.136l-5.754-5.398c-0.201-0.188-0.211-0.505-0.022-0.706    c0.189-0.203,0.504-0.212,0.707-0.022l5.754,5.398c0.201,0.188,0.211,0.505,0.022,0.706C25.375,21.457,25.243,21.51,25.109,21.51z"/>
                                        <path d="M5.902,21.51c-0.133,0-0.266-0.053-0.365-0.158c-0.189-0.201-0.179-0.518,0.022-0.706l5.756-5.398    c0.202-0.188,0.519-0.18,0.707,0.022c0.189,0.201,0.179,0.518-0.022,0.706l-5.756,5.398C6.148,21.465,6.025,21.51,5.902,21.51z"/>
                                    </g>
                                    <path d="M28.512,26.529H2.5c-1.378,0-2.5-1.121-2.5-2.5V6.982c0-1.379,1.122-2.5,2.5-2.5h26.012c1.378,0,2.5,1.121,2.5,2.5v17.047   C31.012,25.408,29.89,26.529,28.512,26.529z M2.5,5.482c-0.827,0-1.5,0.673-1.5,1.5v17.047c0,0.827,0.673,1.5,1.5,1.5h26.012   c0.827,0,1.5-0.673,1.5-1.5V6.982c0-0.827-0.673-1.5-1.5-1.5H2.5z"/>
                                    <path d="M15.506,18.018c-0.665,0-1.33-0.221-1.836-0.662L0.83,6.155C0.622,5.974,0.6,5.658,0.781,5.449   c0.183-0.208,0.498-0.227,0.706-0.048l12.84,11.2c0.639,0.557,1.719,0.557,2.357,0L29.508,5.419   c0.207-0.181,0.522-0.161,0.706,0.048c0.181,0.209,0.16,0.524-0.048,0.706L17.342,17.355   C16.835,17.797,16.171,18.018,15.506,18.018z"/>
                                </g>
                            </svg>
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
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 60 60" xml:space="preserve">
                                <g>
                                    <path d="M30,0C13.458,0,0,13.458,0,30s13.458,30,30,30s30-13.458,30-30S46.542,0,30,0z M30,58C14.561,58,2,45.439,2,30   S14.561,2,30,2s28,12.561,28,28S45.439,58,30,58z"/>
                                    <path d="M30,6c-0.552,0-1,0.447-1,1v23H14c-0.552,0-1,0.447-1,1s0.448,1,1,1h16c0.552,0,1-0.447,1-1V7C31,6.447,30.552,6,30,6z"/>
                                </g>
                            </svg>
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
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 471.2 471.2" xml:space="preserve">
                            <g>
                                <g>
                                    <path d="M457.7,230.15c-7.5,0-13.5,6-13.5,13.5v122.8c0,33.4-27.2,60.5-60.5,60.5H87.5c-33.4,0-60.5-27.2-60.5-60.5v-124.8    c0-7.5-6-13.5-13.5-13.5s-13.5,6-13.5,13.5v124.8c0,48.3,39.3,87.5,87.5,87.5h296.2c48.3,0,87.5-39.3,87.5-87.5v-122.8    C471.2,236.25,465.2,230.15,457.7,230.15z"/>
                                    <path d="M226.1,346.75c2.6,2.6,6.1,4,9.5,4s6.9-1.3,9.5-4l85.8-85.8c5.3-5.3,5.3-13.8,0-19.1c-5.3-5.3-13.8-5.3-19.1,0l-62.7,62.8    V30.75c0-7.5-6-13.5-13.5-13.5s-13.5,6-13.5,13.5v273.9l-62.8-62.8c-5.3-5.3-13.8-5.3-19.1,0c-5.3,5.3-5.3,13.8,0,19.1    L226.1,346.75z"/>
                                </g>
                            </g>
                        </svg>
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