<?php

/**
 * AddTeam form base class.
 *
 * @method TeamPlayer getObject() Returns the current form's model object
 *
 * @package    lufy
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
class licenceMastersForm extends BaseSfGuardUserForm {

    public function configure() {
        unset($this['algorithm'], $this['salt'], $this['licence_ga'], $this['phone'], $this['birthdate'], $this['gender'], $this['address'], $this['zipcode'], $this['city'], $this['country'], $this['website'], $this['logorul'], $this['carrer'], $this['is_active'], $this['is_super_admin'], $this['last_login'], $this['created_at'], $this['updated_at'], $this['_csrf_token'], $this['first_name'], $this['last_name'], $this['username'], $this['email_address'], $this['password']);
    }

}
