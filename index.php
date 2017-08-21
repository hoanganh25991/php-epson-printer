<?php
require __DIR__ . '/vendor/autoload.php';
require_once './util.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;

// Allow cors
header("Access-Control-Allow-Origin: *");
header("Access-Control-Max-Age: 0");
header("Access-Control-Allow-Headers: access-control-allow-origin,content-type");

try{
    handleRequest();
}catch(\Exception $e){
    hoiEcho("Something wrong");
    hoiEcho($e->getMessage());
}

function handleRequest(){
    hoiEcho("Printer Server");
    if(isPost()){
        $requestBody = file_get_contents('php://input');
        $req = json_decode($requestBody, true);
        $text = isset($req['text']) ? $req['text'] : "Please submit text";
        hoiPrint($text);
    }else{
        hoiEcho("See you");
    }
}

function hoiPrint($text){
    hoiEcho("Set up connection to printer");
    hoiEcho($text);
    $connector = new NetworkPrintConnector("192.168.1.123", 9100);
    $printer = new Printer($connector);
    try{
        // ... Print stuff
        $printer->setFont(Printer::FONT_B);
        // $printer->setTextSize(2, 2);
        // $printer->setPrintMode(Printer:::MODE_DOUBLE_HEIGHT);
        $printer->setEmphasis(true);
        $printer->text("$text\n");
        $printer->cut(Printer::CUT_FULL, 1);
        $printer->close();
    }catch(\Exception $e){
        hoiEcho($e->getMessage());
    }
}



