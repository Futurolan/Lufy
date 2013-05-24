<?php
  class Ean13
  {
    protected $current = null;

    public function __construct($ean)
    {
      if (strlen($ean) == 12)
      {
        $this->current = $this->checksum($ean);
      }
      elseif (strlen($ean) == 13)
      {
        if ($this->isValid($ean))
        {
          $this->current = $ean;
        }
        else
        {
          throw new Exception('Erreur - Code invalide');
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
      $prev = substr($this->current, 0, 12);
      $prev--;
      $prev = $this->checksum($prev);

      $this->current = $prev;

      return $this;
    }


    public function next()
    {
      $next = substr($this->current, 0, 12);
      $next++;
      $next = $this->checksum($next);

      $this->current = $next;

      return $this;
    }


    public function isValid($ean)
    {
      $ean_checked = substr($ean, 0, 12);
      $ean_checked = $this->checksum($ean_checked);

      if ($ean == $ean_checked)
      {
        return true;
      }
      else
      {
        return false;
      }

    }


    private function checksum($number)
    {
      $array_number = str_split($number, 1);

      $pair = 0;
      for ($i = 0; $i < 12; $i+= 2)
      {
        $pair+= $array_number[$i] * 1;
      }

      $impair = 0;
      for ($j = 1; $j < 12; $j+= 2)
      {
        $impair+= $array_number[$j] * 3;
      }

      $total = $pair + $impair;
      $r = fmod($total, 10);
      $controlkey = 10 - $r;

      if ($controlkey == 10)
      {
        $controlkey = 0;
      }

      $ean = $number.$controlkey;

      return $ean;
    }
  }
?>

<?php
  // Test de la classe
  $var = 100000000001;

  for ($i=$var; $i<$var+20; $i++)
  {
    $ean = new Ean13($i);
    echo '<b>Test de '.$i.'</b><br/>Current : '.$ean->get().'<br/>Next : '.$ean->next()->get().'<br/>Prev : '.$ean->prev()->prev()->get().'<br/><br/>';
  }
 ?>

