<?php

/**
 * Game form.
 *
 * @package    lufy
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class GameForm extends BaseGameForm
{
  public function configure()
  {
    $this->widgetSchema['description'] = new sfWidgetFormTextarea;
    $files = sfFinder::type('file')->maxdepth(0)->name('*')->relative()->in(sfConfig::get('sf_upload_dir').'/jeux/images');
    $logo[0] = '';
    foreach($files as $file)
      {
        $logo[$file] = $file;
      }
    $this->widgetSchema['logourl'] = new sfWidgetFormChoice(array('choices' => $logo));
  }
}
