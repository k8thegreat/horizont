<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <title><?=$APPLICATION->ShowTitle()?></title>
    <link rel="icon" href="favicon.png" type="image/png" sizes="30x30">
    <?
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery-2.2.1.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/owl.carousel.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/main.js");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/fonts/fonts.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/owl.theme.default.min.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/owl.carousel.min.css");
	?>
    <?=$APPLICATION->ShowHead()?>
</head>
<body>
<?=$APPLICATION->ShowPanel();?>
<div class="wrapper">
    <div class="page-404">
        <div class="content-404">
