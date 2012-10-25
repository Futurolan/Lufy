<?php

class lufyMaintenanceTask extends sfBaseTask
{
  protected function configure()
  {
    $this->addArguments(array(
      new sfCommandArgument('application', sfCommandArgument::REQUIRED, 'Application'),
    ));

    $this->namespace        = 'lufy';
    $this->name             = 'maintenance';
    $this->briefDescription = 'Gestion du mode maintenance';
    $this->detailedDescription = <<<EOF
The [lufy:maintenance|INFO] task does things.
Call it with:

  [php symfony lufy:maintenance|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    $file = sfConfig::get('sf_data_dir').'/lock/'.$arguments['application'].'.lck';
      if (file_exists($file))
      {
        if (unlink($file))
        {
          $this->logSection('info', 'Le mode maintenance est maintenant desactive.');
        }
      }
      else
      {
        if (is_readable(sfConfig::get('sf_data_dir').'/lock'))
        {
          file_put_contents($file, array());
          $this->logSection('info', 'Le site est maintenant en mode maintenance.');
        }
      }
  }
}
