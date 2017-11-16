<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?>

<?
print_r($_REQUEST["CODE"]);
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>