<?php

class lufyBuildTask extends sfBaseTask
{
  protected function configure()
  {
    $this->namespace        = 'lufy';
    $this->name             = 'build';
    $this->briefDescription = 'Generation des librairies et de la base de données et chargement des fixtures';
    $this->detailedDescription = <<<EOF
The [lufy:build] task does things.
Call it with:

  [php symfony lufy:build]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    $buildAll = new sfDoctrineBuildTask($this->dispatcher, $this->formatter);
    $clearCache = new sfCacheClearTask($this->dispatcher, $this->formatter);
    $dataLoad = new sfDoctrineDataLoadTask($this->dispatcher, $this->formatter);
    
    echo '/!\ La base de donnees et certains fichiers seront modifies. Etes vous sur de vouloir continuer ? (yes/no) ';
    $response = trim(fgets(STDIN));
    if ($response == 'yes'):
      echo '
      *** Generation des librairies et bases de donnees... ***
      ';
      $buildAll->run(array('--all'));
      echo ' *** Suppression des fichiers inutilises... *** ';
      $finder = array();
      $finder[] = sfFinder::type('file')->maxdepth(0)->name('SfGuard*.php')->in(sfConfig::get('sf_lib_dir').DIRECTORY_SEPARATOR.'model'.DIRECTORY_SEPARATOR.'doctrine');
      $finder[] = sfFinder::type('file')->maxdepth(0)->name('BaseSfGuard*.php')->in(sfConfig::get('sf_lib_dir').DIRECTORY_SEPARATOR.'model'.DIRECTORY_SEPARATOR.'doctrine'.DIRECTORY_SEPARATOR.'base');
      $finder[] = sfFinder::type('file')->maxdepth(0)->name('SfGuard*.php')->in(sfConfig::get('sf_lib_dir').DIRECTORY_SEPARATOR.'filter'.DIRECTORY_SEPARATOR.'doctrine');
      $finder[] = sfFinder::type('file')->maxdepth(0)->name('BaseSfGuard*.php')->in(sfConfig::get('sf_lib_dir').DIRECTORY_SEPARATOR.'filter'.DIRECTORY_SEPARATOR.'doctrine'.DIRECTORY_SEPARATOR.'base');
      $finder[] = sfFinder::type('file')->maxdepth(0)->name('SfGuard*.php')->in(sfConfig::get('sf_lib_dir').DIRECTORY_SEPARATOR.'form'.DIRECTORY_SEPARATOR.'doctrine');
      $finder[] = sfFinder::type('file')->maxdepth(0)->name('BaseSfGuard*.php')->in(sfConfig::get('sf_lib_dir').DIRECTORY_SEPARATOR.'form'.DIRECTORY_SEPARATOR.'doctrine'.DIRECTORY_SEPARATOR.'base');
      foreach ($finder as $files):
        foreach ($files as $file):
          print('
          Deleting '.$file.'
          ');
          unlink($file);
        endforeach;
      endforeach;
      
      echo '
      *** Suppression du cache... ***
      ';
      $clearCache->run();
      echo '
      *** Chargement des fixtures... ***
      ';
      $dataLoad->run();
    else:
      echo '
      Abandon
      ';
    endif;
  }
}
