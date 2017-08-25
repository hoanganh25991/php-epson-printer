<?php
/* Example print-outs using the older bit image print command */
require __DIR__ . '/vendor/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\CapabilityProfile;

$profile = CapabilityProfile::load("simple");
$connector = new NetworkPrintConnector("192.168.1.68", 9100);
$printer = new Printer($connector, $profile);

try {
    $tux = EscposImage::load("receipt5.png", false);

    // $printer -> text("These example images are printed with the older\nbit image print command. You should only use\n\$p -> bitImage() if \$p -> graphics() does not\nwork on your printer.\n\n");
    
    // $printer -> bitImage($tux);
    $printer -> bitImageColumnFormat($tux, Printer::IMG_DOUBLE_WIDTH | Printer::IMG_DOUBLE_HEIGHT);
    // $printer -> bitImageColumnFormat($tux);
    // $printer -> text("Regular Tux (bit image).\n");
    $printer -> feed();
    
    // $printer -> bitImage($tux, Printer::IMG_DOUBLE_WIDTH);
    // $printer -> text("Wide Tux (bit image).\n");
    // $printer -> feed();
    
    // $printer -> bitImage($tux, Printer::IMG_DOUBLE_HEIGHT);
    // $printer -> text("Tall Tux (bit image).\n");
    // $printer -> feed();
    
    // $printer -> bitImage($tux, Printer::IMG_DOUBLE_WIDTH | Printer::IMG_DOUBLE_HEIGHT);
    // $printer -> text("Large Tux in correct proportion (bit image).\n");
} catch (Exception $e) {
    /* Images not supported on your PHP, or image file not found */
    $printer -> text($e -> getMessage() . "\n");
}

$printer -> cut();
$printer -> close();
