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
    unset(
      $this['user_id'],
      $this['ean13']
    );
    #$this->setWidget['birthdate'] = new sfWidgetFormI18nDate(array('culture'=>'fr', 'format'=>'%day%/%month%/%year%'));

//    $this->widgetSchema['birthdate'] = new sfWidgetFormI18nDate(array('culture' => /*$this->getUser()->getCulture()*/'en',
//      'years'=> range(date('Y')-120, date('Y')-1),
//      #'days'=> range(date('D')-4, date('D')+4),
//      'default'      => '03-02-2010'/* '1 January'date('Y')-18*/));#((string)('0101'.date('Y')-18)),
//      #'can_be_empty' => false));
//    #$years = range(date('Y') - 120, date('Y') -12000);
//
//    #sfContext::getInstance()


    $years = range(date('Y')-120, date('Y')-1);

  $this->widgetSchema['birthdate'] = new sfWidgetFormI18nDate(array(
   //'culture' => sfContext::getInstance()>getUser()>getCulture(),
   'culture' => 'fr',
   'years'=> array_combine($years, $years),
   'default' => '1 January '.date('Y')-18,
   'can_be_empty' => false)
  );
  }
}
