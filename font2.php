<?php
require __DIR__ . '/vendor/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\CapabilityProfile;
use Mike42\Escpos\PrintBuffers\EscposPrintBuffer;
use Mike42\Escpos\PrintBuffers\ImagePrintBuffer;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;

// Connection settings for the printer
$connector = new NetworkPrintConnector("192.168.1.27", 9100);
$profile = CapabilityProfile::load("simple");

// Setup for printing text. You can switch between these as necessary.
$imageBuffer = new ImagePrintBuffer();
$imageBuffer -> setFont(__DIR__ . "/NotoSans-Regular.ttf");
$textBuffer = new EscposPrintBuffer();

$text = "Tiếng Việt, còn gọi tiếng Việt\n" .
        "Nam hay Việt ngữ, là ngôn ngữ \n" .
        "của người Việt (người Kinh) và\n" .
        "là ngôn ngữ chính thức tại\n" .
        "Việt Nam.";
$printer = new Printer($connector, $profile);
try {
  $printer -> setPrintBuffer($imageBuffer);
  $printer -> text($text);

  $printer -> setPrintBuffer($textBuffer);
  $printer -> text($text);
} finally {
  $printer -> close();
}