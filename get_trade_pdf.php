<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
require_once $_SERVER["DOCUMENT_ROOT"].'/local/php_interface/include/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

if($_REQUEST["ID"]) {
    if (CModule::IncludeModule("iblock")) {
        $arSelect = Array("ID", "IBLOCK_ID", "IBLOCK_SECTION_ID", "NAME", "PREVIEW_PICTURE", "PROPERTY_*");
        $arFilter = Array("ID" => Intval($_REQUEST["ID"]), "IBLOCK_ID" => TRADE_IBLOCK_ID, "ACTIVE" => "Y");
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
        if ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $ID = $arFields["ID"];
            $arProps = $ob->GetProperties();
        }

        $metro = $arProps["metro"]["VALUE"];
        $zhk = $arProps["gk"]["VALUE"];
        $locality_name = $arProps["rayon"]["VALUE"];
        $ready = $arProps["deadline"]["VALUE"];
        $developer = $arProps["builder"]["VALUE"];
        $renovation = $arProps["otdelka"]["VALUE"];
        $floor = $arProps["floor"]["VALUE"];
        $rooms = $arProps["rooms"]["VALUE"];
        $area = $arProps["sGeneral"]["VALUE"];
        $price = $arProps["price"]["VALUE"];
        if($arFields["PREVIEW_PICTURE"]) {
            $url = CFile::GetPath($arFields["PREVIEW_PICTURE"]);
            $preview_picture = '<img src="'.substr_replace($url, "",0,1).'" width="300"/>';
        }
        $html = '
<html>
<body>
<style>
body { font-family: DejaVu Sans;font-size: 13px; }
span{font-weingt:bold;}
</style>
<table border="0" width="530" cellpadding="0" cellspacing="0">
<tr>
	<td valign="top">
		<font size="4">Центр Недвижимости Горизонт</font>
	</td>
	<td align="right">
		<span>+7 (812) 603-44-33</span>
		<br/><span>http://gorizont-spb.com</span>
	</td>
</tr>
<tr>
	<td colspan="2">
		<font size="3">'.$zhk.'</font>
	</td>
</tr>

<tr>
	<td colspan="2">
		<span>'.($metro ? "м. ".$metro : "").'</span>
	</td>
</tr>
<tr>
	<td>
	    <span>'.$locality_name.'</span>
	</td>
	<td>
		<font size="3"><font color="#1ab9db"><span>'.number_format($price, 0, ".", " ").'</span></font> руб.</font><span>
	</td>
</tr>
<tr>
	<td colspan="2">
		&nbsp;
	</td>
</tr>
<tr>
	<td align="center" valign="top" width="300">'.$preview_picture.'</td>
	<td valign="top">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr><td><span>Застройщик</span></td><td><span>'.$developer.'</span></td></tr>
        <tr><td><span>Срок сдачи</span></td><td><span>'.$ready.'</span></td></tr>
        <tr><td><span>Отделка</span></td><td><span>'.$renovation.'</span></td></tr>
        <tr><td><span>Этаж</span></td><td><span>'.$floor.'</span></td></tr>
        <tr><td><span>Кол-во комнат</span></td><td><span>'.$rooms.'</span></td></tr>
        <tr><td><span>Пл. общая</span></td><td><span>'.$area.' м²</span></td></tr>
        </table>
</tr>
</table>
</body>
</html>';
        $dompdf = new DOMPDF();
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->stream($ID.".pdf");
    }
}