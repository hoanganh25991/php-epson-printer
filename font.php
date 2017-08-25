<?php
require __DIR__ . '/vendor/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\CapabilityProfiles\DefaultCapabilityProfile;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;

// Printer initialisation
$profile = DefaultCapabilityProfile::getInstance();
$connector = new NetworkPrintConnector("192.168.1.27", 9100);
$printer = new Printer($connector, $profile);
$printer -> text("Tiếng Việt, còn gọi tiếng Việt Nam hay Việt ngữ, là ngôn ngữ của người Việt (người Kinh) và là ngôn ngữ chính thức tại Việt Nam.\n");

// Printer shutdown
$printer -> cut();
$printer -> close();