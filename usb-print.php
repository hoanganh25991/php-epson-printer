<?php
/* Call this file 'hello-world.php' */
require __DIR__ . '/vendor/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

//$connector = new WindowsPrintConnector("ESDPRT002");
//$connector = new WindowsPrintConnector("//hoanganh/WORKGROUP/epson_tm_u220_4");
/**
 * To make this run
 * We have to SHARE this printer on windows
 * Right after shared, DONE, connect is successfully print
 */
$connector = new WindowsPrintConnector("epson_tm_u220_4");
$printer = new Printer($connector);
//$printer->text("HelloWorld!\n");
$tux = EscposImage::load("sample.png", false);
$printer -> bitImageColumnFormat($tux, Printer::IMG_DOUBLE_WIDTH | Printer::IMG_DOUBLE_HEIGHT);
$printer->cut();
$printer->close();