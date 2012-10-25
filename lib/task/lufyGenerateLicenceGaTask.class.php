<?php

class lufyGenerateLicenceGaTask extends sfBaseTask
{
  protected function configure()
  {
    $this->namespace        = 'lufy';
    $this->name             = 'generate-licence-ga';
    $this->briefDescription = 'Genere les licences GA manquantes aux utilisateurs actifs';
    $this->detailedDescription = <<<EOF
The [lufy:generate-licence-ga|INFO] task does things.
Call it with:

  [php symfony lufy:generate-licence-ga|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    $databaseManager = new sfDatabaseManager($this->configuration);
    
    $this->logSection('info', 'Generation des licences pour les utilisateurs actifs.');
    
    $users = Doctrine_Core::getTable('sfGuardUser')->findByIsActive('1');
    $count = 0;
    $count_total = 0;
    foreach ($users as $user):
        $count_total++;
        if ($user->getIsActive() == 1):
            if (strlen($user->getLicenceGa()) != 13):
                $count++;
            
                $l = Doctrine_Core::getTable('varConfig')->getEanNextPlayer();
                $user->setLicenceGa($l);
                $user->save();
                
                $k = substr($l, 0, 12);
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
                $n = str_pad($k, 13, $controlkey, STR_PAD_RIGHT);
                
                Doctrine_Core::getTable('varConfig')->UpdateEanNextPlayer($n);
                $this->logSection('info', '>>> '.$user->getId().' '.$user->getUsername());
            endif;
        endif;
    endforeach;
    
    $this->logSection('info', ''.$count.' utilisateurs enregistres / '.$count_total.' ont ete affectes.');
  }
}
