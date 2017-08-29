<?php
/* Call this file 'hello-world.php' */
require __DIR__ . '/vendor/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

$connector = new WindowsPrintConnector("ESDPRT002");
$printer = new Printer($connector);
$printer->text("HelloWorld!\n");
$printer->cut();
$printer->close();