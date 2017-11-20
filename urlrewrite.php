<?
$arUrlRewrite = array(
	array(
		"CONDITION" => "#^/location/([0-9a-zA-Z_-]+)/([0-9a-zA-Z_-]+)/(\\?(.*))?#",
		"RULE" => "CODE=\$1&TYPE=\$2",
		"ID" => "",
		"PATH" => "/filter/index.php",
	),
    array(
        "CONDITION" => "#^/metro/([0-9a-zA-Z_-]+)/([0-9a-zA-Z_-]+)/(\\?(.*))?#",
        "RULE" => "CODE=\$1&TYPE=\$2",
        "ID" => "",
        "PATH" => "/filter/index.php",
    ),
	array(
		"CONDITION" => "#^/pereustupki/([0-9a-zA-Z_-]+)/(.*)#",
		"RULE" => "ELEMENT_ID=\$1",
		"ID" => "",
		"PATH" => "/pereustupki/detail.php",
	),
	array(
		"CONDITION" => "#^/location/([0-9a-zA-Z_-]+)/(\\?(.*))?#",
		"RULE" => "CODE=\$1",
		"ID" => "",
		"PATH" => "/filter/index.php",
	),
	array(
		"CONDITION" => "#^/metro/([0-9a-zA-Z_-]+)/(\\?(.*))?#",
		"RULE" => "CODE=\$1",
		"ID" => "",
		"PATH" => "/filter/index.php",
	),
	array(
		"CONDITION" => "#^/information/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/information/index.php",
	),
	array(
		"CONDITION" => "#^/novostroyki/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/novostroyki/index.php",
	),
	array(
		"CONDITION" => "#^/developers/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/developers/index.php",
	),
);

?>