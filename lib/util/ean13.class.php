<?php
    class Ean13
    {
      protected $current = null;

      public function __construct($ean)
      {
        if (strlen($ean) == 12)
        {
          // Calcul de la clef de controle
          // Definition de $current
          $this->current = $ean;
          $this->checksum();
        }
        elseif (strlen($ean) == 13)
        {
          // Verifie la validite de la clef de controle
          // Definition de $current
          if ($this->isvalid($ean))
          {
          	$this->current = $ean
          }
        }
        else
        {
          throw new Exception('Erreur - Code invalide');
        }
      }

      public function get()
      {
        return $this->current;
      }

      public function prev()
      {
        // Genere le precedent code ean13
        // Mise a jour de la valeur de $current
        $number = substr($this->current, 0, 12);
        $newNumber = $number + 1;
        for ($i = 0; $i < 12; $i++)
        {
          $EAN13[$i] = substr($newNumber, $i, 1);
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
      	$this->current = \str_pad($number, 13, $controlkey, STR_PAD_RIGHT);
        return $this;
        return $this;
      }

      public function next()
      {
        // Genere le prochain code ean13
        // Mise a jour de la valeur de $current
        $number = substr($this->current, 0, 12);
        $newNumber = $number + 1;
        for ($i = 0; $i < 12; $i++)
        {
          $EAN13[$i] = substr($newNumber, $i, 1);
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
      	$this->current = \str_pad($number, 13, $controlkey, STR_PAD_RIGHT);
        return $this;
      }

      // Verifie la clef de controle de $ean ; return true ou false en fonction du resultat
      public function isValid($ean)
      {
        $result = false;
        $number = substr($ean, 0, 12);
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
      	if($controlkey ==substr($ean, -1, $length = null);) {
          $result = true;
      	}
      	return $result;
      }

      // Calcul de la clef de controle a partie de $current
      // Mise a jour de la valeur de $current
      private function checksum()
      {
        for ($i = 0; $i < 12; $i++)
        {
          $EAN13[$i] = substr($this->current, $i, 1);
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
      	$this->current = \str_pad($number, 13, $controlkey, STR_PAD_RIGHT);
      }

    }
?>