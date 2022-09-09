<?php
require __DIR__ . '/vendor/autoload.php';
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
$connector = new FilePrintConnector("php://stdout");
$printer = new Printer($connector);
$printer -> setLineSpacing(1);
$img = EscposImage::load($argv[1], false);
$printer -> graphics($img);
$printer -> close();
