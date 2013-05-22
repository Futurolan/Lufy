<?php

/**
 * Gestion des codes barres EAN13
 * Guillaume Marsay <guillaume@futurolan.net>
 * Association Futurolan <contact@futurolan.net>
 */

class Ean13Tool{
	public static $lastreneger = '1000000000001';
	private $myEan;

	public function __construct() {
		/*$this->myEan = '1000000000014';*/
		$this->myEan = $this->nextEan($lastgener);
		Ean::$lastgener = $this->myEan;
	}

	static function initialisation () {

	}

	static function raz(){
		Ean::$lastgener = 1000000000001;
	}

	public function getEan() {
		return $this->myEan;
	}

   public function nextEan($string) {
        $k = substr($string, 0, 12);
        $k = $k + 1;
        for ($i = 0; $i < 12; $i++) {
            $EAN13[$i] = substr($k, $i, 1);
        }
        $pair = 0;
        for ($u = 0; $u < 12; $u = $u + 2) {
            $pair = $pair + $EAN13[$u];
        }
        $impair = 0;
        for ($y = 1; $y < 12; $y = $y + 2) {
            $impair = $impair + $EAN13[$y] * 3;
        }
        $total = $pair + $impair;
        $r = fmod($total, 10);
        $controlkey = 10 - $r;
        $n = \str_pad($k, 13, $controlkey, STR_PAD_RIGHT);

        return $n;
    }
}

?>