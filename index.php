<?php
require __DIR__ . '/vendor/autoload.php';
require_once './util.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;

// Allow cors
header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Credentials: true");
header("Access-Control-Max-Age: 1000");
header("Access-Control-Allow-Headers: access-control-allow-origin,content-type");
// header("Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE");
//header("Content-Type: application/json");

try{
    handleRequest();
}catch(\Exception $e){
    hoiEcho($e->getMessage());
    return;
}

function handleRequest(){
    hoiEcho("Printer Server");
    if(isPost()){
        $requestBody = file_get_contents('php://input');
        $req = json_decode($requestBody, true);
        hoiPrint($req['text']);
    }else{
        echo "See you";
    }
}

function hoiPrint($text){
    // $connector = new FilePrintConnector("php://stdout");
    // $connector = new FilePrintConnector("/dev/usb/lp0");
    hoiEcho("Set up connection to printer");
    $connector = new NetworkPrintConnector("192.168.1.121", 9100);
    $printer = new Printer($connector);
    try{
        // ... Print stuff
        hoiEcho("Printing...");
        $printer->text($text);
        hoiEcho("Cutting...");
        $printer->cut();
        hoiEcho("Finishing...");
        $printer->close();
    }catch(\Exception $e){
        echo $e->getMessage();
    }
}



