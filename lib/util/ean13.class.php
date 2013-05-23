<?php

/**
 * Gestion des codes barres EAN13
 * Guillaume Marsay <guillaume@futurolan.net>
 * Association Futurolan <contact@futurolan.net>
 */

class Ean13{
	private $ean;
	public static $lastGen = '1000000000009';

	private static function checksum($number){
		for ($i = 0; $i < 12; $i++)
		{
      	$EAN13[$i] = substr($number, $i, 1);
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
      $nextEan = \str_pad($number, 13, $controlkey, STR_PAD_RIGHT);

      return $nextEan;
	}

   public static function nextEan()
   {
	   $number = substr(Ean13::$lastGen, 0, 12);
      $newNumber = $number + 1;
	   $nextEan = Ean13::checksum($newNumber);
		return $nextEan;
   }

	static function raz(){
		Ean13::$lastGen = 1000000000009;
	}

	public function __construct() {
		$this->ean = Ean13::nextEan();
		Ean13::$lastgener = $this->ean;
	}

	public function __construct($prevEan) {
		$this->ean = nextEanParam($prevEan);
		Ean13::$lastgener = $this->ean;
	}

	public function getEan() {
		return $this->ean;
	}

	public function getNumber()
	{
		$number = substr($this->ean, 0, 12);
		return $number;
	}

	public function getChecksum()
	{
		$checksum = substr($this->ean, -1, $length = null);
		return $checksum;
	}

   public static function nextEanParam($number)
   {
		$number = substr($this->ean, 0, 12);
		$newNumber = $number + 1;
		$nextEan = Ean13::checksum($newNumber);
		return $nextEan;
   }

}

?>