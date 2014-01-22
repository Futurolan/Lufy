<?php

/**
 * SfGuardUserWeezevent form.
 *
 * @package    lufy
 * @subpackage form
 * @author     Guillaume Marsay
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SfGuardUserWeezeventForm extends BaseSfGuardUserWeezeventForm
{

  public function configure()
  {
    $this->setValidators(array(
        'tournament_id' => new sfValidatorString(array('required' => true, 'min_length' => 4, 'max_length' => 255), array('required' => 'Vous devez saisir un code bar.')),
        'barcode' => new sfValidatorString(array('required' => true, 'min_length' => 4, 'max_length' => 255), array('required' => 'Vous devez saisir un code bar.')),
        'id_weez_ticket' => new sfValidatorString(array('required' => true, 'min_length' => 4, 'max_length' => 255), array('required' => 'Vous devez saisir l\'id du ticket.')),
        'is_valid' => new sfValidatorBoolean(array('required' => true), array('required' => 'Le ticket est valide.')),
    ));
  }

}
