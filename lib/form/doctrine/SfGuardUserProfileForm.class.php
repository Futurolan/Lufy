<?php

/**
 * SfGuardUserProfile form.
 *
 * @package    lufy
 * @subpackage form
 * @author     Guillaume Marsay
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SfGuardUserProfileForm extends BaseSfGuardUserProfileForm
{
  public function configure()
  {
  //$this->widgetSchema->setFormFormatterName('list');
    unset(
      $this['user_id'],
      $this['ean13']
    );

    $years = range(date('Y')-120, date('Y')-1);

    $this->widgetSchema['birthdate'] = new sfWidgetFormI18nDate(array(
     'culture' => sfContext::getInstance()->getUser()->getCulture(),
     'years' => array_combine($years, $years),
     'default' => '1 January '.(date('Y')-10),
     'can_be_empty' => false)
    );

    $this->setValidator('birthdate', new sfValidatorDate(array('required' => true)));
  }
}