<?php
require __DIR__ . '/vendor/autoload.php';

use Mike42\Escpos\Printer;
use Mike42\Escpos\CapabilityProfile;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;

/* Printer setup */
$connector = new FilePrintConnector("php://stdout");
$profile = CapabilityProfile::load("simple");
$printer = new Printer($connector, $profile);

/* le writing */
$printer -> text($argv[1]);
$printer -> text("\n");

/* cleanup */
$printer -> close();
