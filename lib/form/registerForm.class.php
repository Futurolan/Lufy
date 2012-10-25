<?php

/**
 * register form base class.
 *
 * @method TeamPlayer getObject() Returns the current form's model object
 *
 * @package    lufy
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
class registerForm extends BaseSfGuardUserForm {

    public function configure() {
        unset($this['algorithm'], $this['salt'], $this['licence_masters'], $this['licence_ga'], $this['phone'], $this['birthdate'], $this['gender'], $this['address'], $this['zipcode'], $this['city'], $this['country'], $this['website'], $this['logorul'], $this['carrer'], $this['is_active'], $this['is_super_admin'], $this['last_login'], $this['created_at'], $this['updated_at'], $this['_csrf_token']);
        
        $this->setValidators(array(
            'first_name'    => new sfValidatorString(array('min_length' => 2)),
            'last_name'   => new sfValidatorString(array('min_length' => 2)),
            'username' => new sfValidatorString(array('min_length' => 2)),
            'email_address' => new sfValidatorEmail(array(), array('invalid' => 'L\'adresse email est invalide.')),
        ));
    }

}
