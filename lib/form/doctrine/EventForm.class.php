<?php

/**
 * Event form.
 *
 * @package    lufy
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EventForm extends BaseEventForm
{
  public function configure()
  {
    $this->widgetSchema['start_at'] = new sfWidgetFormJQueryDateTime();
    $this->widgetSchema['end_at'] = new sfWidgetFormJQueryDateTime();
    $this->widgetSchema['start_registration_at'] = new sfWidgetFormJQueryDateTime();
    $this->widgetSchema['end_registration_at'] = new sfWidgetFormJQueryDateTime();
  }
}
