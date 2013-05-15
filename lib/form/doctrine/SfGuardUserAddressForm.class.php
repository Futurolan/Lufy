<?php

/**
 * SfGuardUserAddress form.
 *
 * @package    lufy
 * @subpackage form
 * @author     Guillaume Marsay
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SfGuardUserAddressForm extends BaseSfGuardUserAddressForm
{
  public function configure()
  {
    unset(
          $this["id"],$this["user_id"],
            $this["latitude"],$this["longitude"],
            $this["is_default"],$this["is_default"],
            $this["is_delivery"]
    );
  }

  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'user_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SfGuardUser'), 'add_empty' => false)),
      'name'        => new sfWidgetFormInputText(),
      'complement'  => new sfWidgetFormInputText(),
      'address'     => new sfWidgetFormTextarea(),
      'zipcode'     => new sfWidgetFormInputText(),
      'city'        => new sfWidgetFormInputText(),
      'country'     => new sfWidgetFormI18nChoiceCountry(array('culture' => 'fr')),
      'latitude'    => new sfWidgetFormInputText(),
      'longitude'   => new sfWidgetFormInputText(),
      'is_default'  => new sfWidgetFormInputCheckbox(),
      'is_billing'  => new sfWidgetFormInputCheckbox(),
      'is_delivery' => new sfWidgetFormInputCheckbox(),
    ));
    
  }

}
