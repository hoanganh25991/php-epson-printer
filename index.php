<?php
/* Call this file 'hello-world.php' */
require __DIR__ . '/vendor/autoload.php';
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;

// $connector = new FilePrintConnector("php://stdout");
$connector = new FilePrintConnector("/dev/usb/lp0");
// $connector = new NetworkPrintConnector("192.168.1.21", 9100);
$printer = new Printer($connector);
try {
  // ... Print stuff
  $printer->text("--------------------------------------------
============================================
~!@#$%^&*()_+{}:'[]\-=`
ABCDEFGHIJKLMNOPQRSTUVWXYZ
$123,000
$123.000
____________________________________________
____________________________________________
____________________________________________
1    công thức làm bánh ngọt    1    300,000
2    công thức ngọt            12     10,000
3    công thức làm bánh ngọt    1    300,000
4    công thức làm bánh ngọt    1    300,000
5    công thức làm bánh ngọt    1    300,000
1    công thức làm bánh ngọt    1    300,000
____________________________________________
SUBTOTAL                           1,000,100
VAT                                  100,000
TỔNG CỘNG                          1,245,100

");
  $printer->cut();
  $printer->close();
} catch(\Exception $e) {
  echo $e->getMessage();
}
