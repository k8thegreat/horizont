<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'>
    <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <title><?=$APPLICATION->ShowTitle('title')?></title>
    <link rel="icon" href="/favicon.png" type="image/png" sizes="30x30">
    <?
    $APPLICATION->AddHeadScript("https://api-maps.yandex.ru/2.1/?lang=ru_RU");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery-2.2.1.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/owl.carousel.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/fancybox/jquery.fancybox.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.tablesorter.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.inputmask.bundle.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.form.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery-ui.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/main.js");
    //$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/scripts.js");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/fonts/fonts.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/owl.theme.default.min.css");
    //$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/jquery-ui.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/owl.carousel.min.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/fancybox/jquery.fancybox.min.css");
    ?>
    <?=$APPLICATION->ShowHead();?>
</head>
<body>
<div id="panel"><?=$APPLICATION->ShowPanel();?></div>
<div class="wrapper">
    <header class="header">
        <div class="nav-top">
            <ul class="nav-menu-top">
                <li><a href="/about/">О компании</a></li>
                <li><a href="/information/">Полезная информация</a></li>
                <li><a href="/contacts/">Контакты</a></li>
            </ul>
        </div>
        <div class="header-body">
            <a href="/" class="logo">
                <img src="<?=SITE_TEMPLATE_PATH?>/img/logo.png" alt="">
            </a>
            <div class="menu">
            <?$APPLICATION->IncludeComponent("bitrix:menu", "main", Array(
	"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
		"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
		"DELAY" => "N",	// Откладывать выполнение шаблона меню
		"MAX_LEVEL" => "2",	// Уровень вложенности меню
		"MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
			0 => "",
		),
		"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"MENU_CACHE_TYPE" => "N",	// Тип кеширования
		"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
		"ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
		"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
	),
	false
);?>
            </div>
            <div class="callback">
                <a href="#" class="contact-number" data-modal="modal-callback">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/includes/header_phone.php"
                        )
                    );?>
                </a>
                <button class="btn btn-border btn-callback" data-modal="modal-callback">Заказать обратный звонок</button>
                <a class="callback-mob" href="#" data-modal="modal-callback">
                    <?=PHONE_ICON?>
                </a>
                <div class="menu-btn">
                    <?=MENU_ICON?>
                </div>
            </div>
        </div>
    </header>
    <main class="content">

