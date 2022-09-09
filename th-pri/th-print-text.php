<?php
require __DIR__ . '/vendor/autoload.php';

use Mike42\Escpos\Printer;
use Mike42\Escpos\CapabilityProfile;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;

/* Printer setup */
$connector = new FilePrintConnector("php://stdout");
$profile = CapabilityProfile::load("simple");
$printer = new Printer($connector, $profile);
$printer -> setLineSpacing(1);

/* le writing */
$fh = fopen($argv[1],'r');
while ($line = fgets($fh)) {
  $printer -> text($line);
}

/* cleanup */
$printer -> close();
