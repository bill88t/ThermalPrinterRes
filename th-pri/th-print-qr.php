<?php
require __DIR__ . '/vendor/autoload.php';

use Mike42\Escpos\Printer;
use Mike42\Escpos\CapabilityProfile;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;

/* Printer setup */
$connector = new FilePrintConnector("php://stdout");
$printer = new Printer($connector);

/* le writing */
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> qrCode($argv[1], Printer::QR_ECLEVEL_L, 10);
$printer -> setJustification();
$printer -> feed();

/* cleanup */
$printer -> close();
