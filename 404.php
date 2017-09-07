<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Страница не найдена");
?>
    <h2>Похоже, данной страницы не существует</h2>
    <p>Возможно она была удалена, либо указан неправильный адрес</p>
    <div class="btn-center">
        <a href="/" class="btn btn-full">На главную</a>
        <a href="/novostroyki/" class="btn btn-border">Просмотр новостроек</a>
    </div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>