<?php

/**
 * Event form.
 *
 * @package    lufy
 * @subpackage form
 * @author     Guillaume Marsay
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EventForm extends BaseEventForm
{
  public function configure()
  {
    unset(
      $this['slug']
    );

    $this->widgetSchema['description'] = new sfWidgetFormTextarea(array(), array('rows' => 5, 'cols' => 80));

    $files = sfFinder::type('file')->maxdepth(0)->name('*.jpg')->name('*.png')->relative()->in(sfConfig::get('sf_upload_dir').'/events/logo');
    $logo[0] = '';
    foreach($files as $file)
      {
        $logo[$file] = $file;
      }

    $this->widgetSchema['image'] = new sfWidgetFormChoice(array('choices' => $logo));

    $this->widgetSchema['address'] = new sfWidgetFormTextarea(array(), array('rows' => 4, 'cols' => 40));
  }
}
