<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'>
    <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <title><?=$APPLICATION->ShowTitle()?></title>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <link rel="icon" href="favicon.png" type="image/png" sizes="30x30">
    <?
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery-2.2.1.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/owl.carousel.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/fancybox/jquery.fancybox.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.tablesorter.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.mask.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.form.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery-ui.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/main.js");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/fonts/fonts.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/owl.theme.default.min.css");
    //$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/jquery-ui.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/owl.carousel.min.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/fancybox/jquery.fancybox.min.css");
    ?>
    <?=$APPLICATION->ShowHead();?>
</head>
<body>
<?=$APPLICATION->ShowPanel();?>
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
                <a href="" class="contact-number" data-modal="modal-callback">+7 (812) 603-44-33</a>
                <button class="btn btn-border btn-callback" data-modal="modal-callback">Заказать обратный звонок</button>
                <div class="callback-mob" data-modal="modal-callback">
                    <svg class="callback-ico" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         viewBox="0 0 512 512" xml:space="preserve">
                        <path d="M492.438,397.75l-2.375-7.156c-5.625-16.719-24.063-34.156-41-38.75l-62.688-17.125c-17-4.625-41.25,1.594-53.688,14.031
                        L310,371.438c-82.453-22.281-147.109-86.938-169.359-169.375l22.688-22.688c12.438-12.438,18.656-36.656,14.031-53.656L160.266,63
                        c-4.625-16.969-22.094-35.406-38.781-40.969l-7.156-2.406c-16.719-5.563-40.563,0.063-53,12.5L27.391,66.094
                        c-6.063,6.031-9.938,23.281-9.938,23.344C16.266,197.188,58.516,301,134.734,377.219c76.031,76.031,179.453,118.219,286.891,117.313
                        c0.563,0,18.313-3.813,24.375-9.844l33.938-33.938C492.375,438.313,498,414.469,492.438,397.75z"/>
                    </svg>
                </div>
                <div class="menu-btn">
                    <svg class="menu-btn-ico" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         viewBox="0 0 344.339 344.339" xml:space="preserve">
                        <g>
                            <rect y="46.06" width="344.339" height="29.52"/>
                        </g>
                        <g>
                            <rect y="156.506" width="344.339" height="29.52"/>
                        </g>
                        <g>
                            <rect y="268.748" width="344.339" height="29.531"/>
                        </g>
                    </svg>
                </div>
            </div>
        </div>
    </header>
    <main class="content">
        <div class="mobile-prev">
            <button class="filter-back">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 451.847 451.847" xml:space="preserve">
                        <g>
                            <path d="M225.923,354.706c-8.098,0-16.195-3.092-22.369-9.263L9.27,151.157c-12.359-12.359-12.359-32.397,0-44.751   c12.354-12.354,32.388-12.354,44.748,0l171.905,171.915l171.906-171.909c12.359-12.354,32.391-12.354,44.744,0   c12.365,12.354,12.365,32.392,0,44.751L248.292,345.449C242.115,351.621,234.018,354.706,225.923,354.706z"/>
                        </g>
                    </svg>
                Назад к списку
            </button>
            <a href="" class="go-filter">Фильтр
                <svg class="svg-result-sort" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 612.006 612.006" xml:space="preserve">
                                <path d="M292.911,318.872H14.833C6.639,318.872,0,312.232,0,304.04c0-8.194,6.639-14.833,14.833-14.833h278.078
                                    c8.194,0,14.833,6.639,14.833,14.833C307.744,312.232,301.105,318.872,292.911,318.872z"></path>
                    <path d="M597.167,318.872H449.638c-8.193,0-14.833-6.64-14.833-14.833c0-8.194,6.64-14.833,14.833-14.833h147.529
                                    c8.193,0,14.833,6.639,14.833,14.833C612,312.232,605.36,318.872,597.167,318.872z"></path>
                    <path d="M214.545,506.712H14.833C6.639,506.712,0,500.072,0,491.88c0-8.193,6.639-14.834,14.833-14.834h199.712
                                    c8.194,0,14.833,6.641,14.833,14.834C229.378,500.072,222.739,506.712,214.545,506.712z"></path>
                    <path d="M597.167,506.712H371.266c-8.193,0-14.833-6.64-14.833-14.833c0-8.192,6.64-14.833,14.833-14.833h225.901
                                    c8.193,0,14.833,6.641,14.833,14.833C612,500.072,605.36,506.712,597.167,506.712z"></path>
                    <path d="M129.368,134.96H14.833C6.639,134.96,0,128.32,0,120.127s6.639-14.833,14.833-14.833h114.535
                                    c8.193,0,14.833,6.639,14.833,14.833S137.562,134.96,129.368,134.96z"></path>
                    <path d="M597.167,134.96H286.1c-8.194,0-14.833-6.639-14.833-14.833s6.639-14.833,14.833-14.833h311.073
                                    c8.193,0,14.833,6.639,14.833,14.833C612,128.32,605.36,134.96,597.167,134.96z"></path>
                    <path d="M175.635,181.215c-33.695,0-61.101-27.406-61.101-61.1c0-33.683,27.406-61.089,61.101-61.089
                                    c33.683,0,61.088,27.406,61.088,61.089C236.718,153.81,209.312,181.215,175.635,181.215z M175.635,88.693
                                    c-17.331,0-31.434,14.097-31.434,31.422c0,17.331,14.103,31.434,31.434,31.434c17.325,0,31.422-14.104,31.422-31.434
                                    C207.052,102.791,192.954,88.693,175.635,88.693z"></path>
                    <path d="M257.709,552.979c-33.695,0-61.1-27.406-61.1-61.102c0-33.688,27.405-61.095,61.1-61.095
                                    c33.689,0,61.094,27.406,61.094,61.095C318.798,525.573,291.393,552.979,257.709,552.979z M257.709,460.45
                                    c-17.331,0-31.434,14.099-31.434,31.43c0,17.33,14.103,31.435,31.434,31.435s31.428-14.104,31.428-31.435
                                    C289.137,474.549,275.035,460.45,257.709,460.45z"></path>
                    <path d="M339.173,365.121c-33.689,0-61.095-27.404-61.095-61.094c0-33.683,27.406-61.089,61.095-61.089
                                    c33.688,0,61.094,27.406,61.094,61.089C400.267,337.716,372.861,365.121,339.173,365.121z M339.173,272.605
                                    c-17.331,0-31.429,14.097-31.429,31.422c0,17.331,14.098,31.428,31.429,31.428s31.428-14.097,31.428-31.428
                                    C370.601,286.702,356.504,272.605,339.173,272.605z"></path>
                            </svg>
            </a>
        </div>
