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
/*
    unset(
      $this['id_event'],
      $this['slug']
    );

    $this->setWidgets(array(
      'name'                  => new sfWidgetFormInputText(),
      'description'           => new sfWidgetFormTextarea(),
      'image'                 => new sfWidgetFormInputText(),
      'start_at'              => new sfWidgetFormDateTime(),
      'end_at'                => new sfWidgetFormDateTime(),
      'start_registration_at' => new sfWidgetFormDateTime(),
      'end_registration_at'   => new sfWidgetFormDateTime(),
    ));
*/
  }
}
