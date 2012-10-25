<?php

/**
 * Block form.
 *
 * @package    lufy
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BlockForm extends BaseBlockForm
{
  public function configure()
  {
  
    $files = sfFinder::type('file')->maxdepth(0)->name('*.jpg')->name('*.png')->relative()->in(sfConfig::get('sf_upload_dir').'/encarts');
    $logo[0] = '';
    foreach($files as $file)
      {
        $logo[$file] = $file;
      }
  
    $this->widgetSchema['image'] = new sfWidgetFormChoice(array('choices' => $logo));
  }
}
