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
    unset(
            $this['tournament_id'],
            $this['is_valid']
    );

    $this->setValidators(array(
        'barcode' => new sfValidatorString(array('required' => true,
                                                  'min_length' => 4,
                                                  'max_length' => 255),
                                                    array('required' => 'Vous devez saisir un code bar.'))
    ));
  }

}
