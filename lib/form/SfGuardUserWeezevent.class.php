<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SfGuardUserWeezevent
 *
 * @author jerome
 */
class SfGuardUserWeezevent
{

    public function configure()
    {
        $this->setValidator(
         'barcode', new sfValidatorString(
                 array(
            'required' => true,
            'min_length' => 4,
            'max_length' => 255
                )
        ));
        $this->setValidator('id_weez_ticket', new sfValidatorString(
                array(
            'required' => true,
            'min_length' => 4,
            'max_length' => 255
                )
        ));
        $this->setValidator('is_valid', new sfValidatorBoolean(
                array(
            'required' => true
                )
        ));
        
        
        		$this->setValidators(array(
			'barcode' => new sfValidatorString(array('required' => true, 'min_length' => 4, 'max_length' => 255), array('required' => 'Vous devez saisir un code bar.')),
			'id_weez_ticket' => new sfValidatorString(array('required' => true,  'min_length' => 4, 'max_length' => 255), array('required' => 'Vous devez saisir l\'id du ticket.')),
			'is_valid' => new sfValidatorBoolean(array('required' => true), array('required' => 'Le ticket est valide.')),
		));
    }

}

?>
