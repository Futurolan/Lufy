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
      $this["id"],
      $this["user_id"],
      $this["latitude"],
      $this["longitude"],
      $this["is_default"],
      $this["is_billing"],
      $this["is_delivery"]
      );
    $this->setWidget('country', new sfWidgetFormI18nChoiceCountry());
  }
}
