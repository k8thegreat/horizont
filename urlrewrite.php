<?
$arUrlRewrite = array(

	array(
		"CONDITION" => "#^/pereustupki/([0-9a-zA-Z_-]+)/(.*)#",
		"RULE" => "ELEMENT_ID=\$1",
		"ID" => "",
		"PATH" => "/pereustupki/detail.php",
	),
	array(
		"CONDITION" => "#^/novostroyki/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/novostroyki/index.php",
	),
	array(
		"CONDITION" => "#^/information/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/information/index.php",
	),
	array(
		"CONDITION" => "#^/developers/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/developers/index.php",
	),
    array(
        "CONDITION" => "#^/([0-9a-zA-Z_-]+)/([0-9a-zA-Z_-]+)/(.*)#",
        "RULE" => "",
        "ID" => "",
        "PATH" => "/novostroyki/index.php",
    ),
);

?>