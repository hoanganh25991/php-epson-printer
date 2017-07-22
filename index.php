<?php
/* Call this file 'hello-world.php' */
require __DIR__ . '/vendor/autoload.php';
require_once './util.php';
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;

hoiEcho("Hello");

try{
	handleRequest();
}catch(\Exception $e){
	hoiEcho($e->getMessage());
	return;
}

function handleRequest(){
	if(isPost()){
		$text = $_POST['text'];
		hoiPrint($text);
	}else{
		echo "See you";
	}
}

function hoiPrint($text){
	

	// $connector = new FilePrintConnector("php://stdout");
	// $connector = new FilePrintConnector("/dev/usb/lp0");
	$connector = new NetworkPrintConnector("192.168.1.121", 9100);
	$printer = new Printer($connector);
	try {
	  // ... Print stuff
	  $printer->text($text);
	  $printer->cut();
	  $printer->close();
	} catch(\Exception $e) {
	  echo $e->getMessage();
	}
}



