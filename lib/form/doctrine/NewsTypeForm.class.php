<?php

/**
 * NewsType form.
 *
 * @package    lufy
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class NewsTypeForm extends BaseNewsTypeForm
{
  public function configure()
  {
  $files = sfFinder::type('file')->maxdepth(0)->name('*.png')->relative()->in(sfConfig::get('sf_upload_dir').'/news/icones');
  foreach($files as $file)
    {
      $logo[$file] = $file;
    }
  
  $this->widgetSchema['logourl'] = new sfWidgetFormChoice(array('choices' => $logo));
  }
}
