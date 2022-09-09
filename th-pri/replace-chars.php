<?php
require __DIR__ . '/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;

class MyCoolPrinter extends Mike42\Escpos\Printer {

    public function setUserDefinedCharacter(EscposImage $img, $char)
    {
        $verticalBytes = 3;
        $colFormatData = $img -> toColumnFormat(true);
        foreach ($colFormatData as $line) {
            // Print each line, double density etc for printing are set here also
            $this -> connector -> write(self::ESC . "&" . chr($verticalBytes) . $char . $char . chr($img -> getWidth()) . $line);
            break;
        }
    }

    public function selectUserDefinedCharacterSet($on = true)
    {
        self::validateBoolean($on, __FUNCTION__);
        $this -> connector -> write(self::ESC . "%". ($on ? chr(1) : chr(0)));
    }
}

/* Fill in your own connector here */
$connector = new FilePrintConnector("php://stdout");
$printer = new MyCoolPrinter($connector);

// Replace '$' with a 24x12 image.
$char = EscposImage::load("btc2.png");
$printer -> setUserDefinedCharacter($char, "$");
$printer -> selectUserDefinedCharacterSet(true);

// Print some stuff normally
$printer -> text("Item    $2.50\n");

$printer -> cut();
$printer -> close();
