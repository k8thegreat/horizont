<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

require_once $_SERVER["DOCUMENT_ROOT"].'/local/php_interface/include/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new DOMPDF();

$html = <<<'ENDHTML'
<html>
 <body>
  <h1>Hello Dompdf</h1>
 </body>
</html>
ENDHTML;

$dompdf->load_html($html);
$dompdf->render();

$dompdf->stream("hello.pdf");