<?php
require __DIR__ . '/vendor/autoload.php';
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;
$connector = new FilePrintConnector("php://stdout");
$printer = new Printer($connector);
$printer -> cut();
$printer -> close();
