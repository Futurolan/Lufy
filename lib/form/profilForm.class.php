<?php

/**
 * profil form.
 *
 * @package    lufy
 * @subpackage form
 * @author     Guillaume Marsay <guillaume@futurolan.net>
 * @version    SVN: $Id: sfDoctrinePluginFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class profilForm extends sfGuardUserForm
{

  public function configure()
  {
    parent::configure();

    unset(
      $this['username'],
      $this['email_address'],
      $this['algorithm'],
      $this['salt'],
      $this['password'],
      $this['is_active'],
      $this['is_super_admin'],
      $this['last_login'],
      $this['created_at'],
      $this['updated_at'],
      $this['groups_list'],
      $this['permissions_list']
    );

    $this->mergeForm(new SfGuardUserProfileForm());
  }

//  public function setup()
//  {
//    $this->setWidgets(array(
//      'id'        => new sfWidgetFormInputHidden(),
//      'user_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SfGuardUser'), 'add_empty' => false)),
//      'ean13'     => new sfWidgetFormInputText(),
//      'phone'     => new sfWidgetFormInputText(),
//      'birthdate' => new sfWidgetFormI18nDate(array('culture'=> 'fr')),
//      'gender'    => new sfWidgetFormChoice(array('choices' => array('unknow' => 'unknow', 'female' => 'female', 'male' => 'male'))),
//      'website'   => new sfWidgetFormInputText(),
//      'logourl'   => new sfWidgetFormInputText(),
//      'carrer'    => new sfWidgetFormTextarea(),
//    ));
//
//    $this->setValidators(array(
//      'id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
//      'user_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('SfGuardUser'))),
//      'ean13'     => new sfValidatorString(array('max_length' => 13)),
//      'phone'     => new sfValidatorString(array('max_length' => 20, 'required' => false)),
//      'birthdate' => new sfValidatorDate(array('required' => false)),
//      'gender'    => new sfValidatorChoice(array('choices' => array(0 => 'unknow', 1 => 'female', 2 => 'male'), 'required' => false)),
//      'website'   => new sfValidatorString(array('max_length' => 250, 'required' => false)),
//      'logourl'   => new sfValidatorString(array('max_length' => 250, 'required' => false)),
//      'carrer'    => new sfValidatorString(array('required' => false)),
//    ));
//
//    $this->widgetSchema->setNameFormat('sf_guard_user_profile[%s]');
//
//    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
//
//    $this->setupInheritance();
//
//    parent::setup();
//  }

}
