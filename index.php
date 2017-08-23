<?php
require __DIR__ . '/vendor/autoload.php';
require_once './util.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;

define("PRINT_IMAGE", "PRINT_IMAGE");

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
	if(isGet()){
		hoiEcho("See you. Please submit POST to run print");
		return;
	}

    $requestBody = file_get_contents('php://input');
    $req = json_decode($requestBody, true);
    $type= isset($req['type']) ? $req['type'] : null;
    $data= isset($req['data']) ? $req['data'] : null;
    // Support legacy submit text
    // Try with text key
    if(is_null($data)){
	    $data = isset($req['text']) ? $req['text'] : null;
    }

	// Check data
	if(is_null($data)){
		hoiEcho("No data to print");
		return;
	}

    hoiPrint($data, $type);
}

function hoiPrint($data, $type){
    hoiEcho("Set up connection to printer");
	hoiEcho("I see print type: $type");
    $connector = new NetworkPrintConnector("192.168.1.3", 9100);
    $printer = new Printer($connector);
    // Print stuff
    switch($type){
        case PRINT_IMAGE:
	        $data = str_replace('data:image/png;base64,', '', $data);
	        $data = str_replace(' ', '+', $data);
	        $data = base64_decode($data); // Decode image using base64_decode
	        $file = uniqid() . '.png'; //Now you can put this image data to your desired file using file_put_contents function like below:
	        $success = file_put_contents($file, $data);

			if(!$success){
				throw new \Exception("Fail to create image file");
			}

	        $tux = EscposImage::load($file, false);
	        $printer->bitImage($tux);
	        unlink($file);
	        break;
        default:
	        $printer->setEmphasis(true);
	        $printer->text("$data\n");
	        break;
    }
    $printer->cut(Printer::CUT_FULL, 1);
    $printer->close();
}



