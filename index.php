<?php
require __DIR__ . '/vendor/autoload.php';
require_once './util.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
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
        $type= isset($req['type']) ?  $req['type'] : null;
        
        echo "I see type: $type";

        if(!is_null($type)){
            $dataUrl =  isset($req['dataUrl']) ? $req['dataUrl'] : null;
            if(!is_null($dataUrl)){
                echo "I see dataUrl";
                $data = str_replace('data:image/png;base64,', '', $dataUrl);
                $data = str_replace(' ', '+', $data);
                $data = base64_decode($data); // Decode image using base64_decode
                $file = uniqid() . '.png'; //Now you can put this image data to your desired file using file_put_contents function like below:
                $success = file_put_contents($file, $data);
                if($success){
                    $tux = EscposImage::load($file, false);
                    hoiPrintImage($tux);
                }
            }
            return;
        }

        $requestBody = file_get_contents('php://input');
        $req = json_decode($requestBody, true);
        $text = isset($req['text']) ? $req['text'] : "Please submit text";
        hoiPrint($text);
    }else{
        hoiEcho("See you");
    }
}

function hoiPrintImage($image){
    var_dump($image); return;
    hoiEcho("Set up connection to printer");
    hoiEcho($text);
    $connector = new NetworkPrintConnector("192.168.1.123", 9100);
    $printer = new Printer($connector);
    try{
        $printer->bitImage($image);
        $printer->cut(Printer::CUT_FULL, 1);
        $printer->close();
    }catch(\Exception $e){
        hoiEcho($e->getMessage());
    }
}

function hoiPrint($text){
    var_dump($text); return;
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



