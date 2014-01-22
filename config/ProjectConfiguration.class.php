<?php

require_once dirname(__FILE__) . '/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{

  public function setup()
  {
    $this->enableAllPluginsExcept(array('sfPropelPlugin'));
    $this->enablePlugins('csDoctrineActAsGeolocatablePlugin');
    $this->enablePlugins('sfDoctrineGraphvizPlugin');
  }

  public function getApplicationLockFile()
  {
    return sfConfig::get('sf_data_dir') . DIRECTORY_SEPARATOR . 'lock' . DIRECTORY_SEPARATOR . $this->getApplication() . '.lck';
  }

  public function configureDoctrine(Doctrine_Manager $manager)
  {
    $manager->setAttribute(Doctrine_Core::ATTR_RESULT_CACHE, new Doctrine_Cache_Apc());
  }

}
