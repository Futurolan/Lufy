<?php

class lufyCleanUsersTask extends sfBaseTask
{
  protected function configure()
  {
    $this->namespace        = 'lufy';
    $this->name             = 'clean-users';
    $this->briefDescription = 'Supprime les utilisateurs inactif depuis plus de 7 jours';
    $this->detailedDescription = <<<EOF
The [lufy:clna-users|INFO] task does things.
Call it with:

  [php symfony lufy:clean-users|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    $databaseManager = new sfDatabaseManager($this->configuration);
    
    $this->logSection('info', 'Suppression des utilisateurs inactifs.');
    
    $users = Doctrine_Core::getTable('sfGuardUser')->findByIsActive('0');
    $count = 0;
    $count_total = 0;
    foreach ($users as $user):
        $count_total++;
        if ($user->getIsActive() == 0):
            $date_insc = new DateTime($user->getCreatedAt());
            $date_now = new DateTime();
            $interval = $date_now->diff($date_insc);
            if ($interval->format('%y%m%d') > 7):
                $count++;
                $this->logSection('info', '>>> '.$user->getId().' '.$user->getUsername());
                $user->delete();
            endif;
        endif;
    endforeach;
    
    $this->logSection('info', ''.$count.' utilisateurs inactifs / '.$count_total.' ont ete supprimes.');
  }
}
