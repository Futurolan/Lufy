<?php

/**
 * sfGuardRegisterForm for registering new users
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Jonathan H. Wage <jonwage@gmail.com>
 * @version    SVN: $Id: BasesfGuardChangeUserPasswordForm.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
class sfGuardRegisterForm extends BasesfGuardRegisterForm
{
  /**
   * @see sfForm
   */
  public function configure()
  {
    unset(
      $this['id'],
      $this['licence_masters'],
      $this['licence_ga'],
      $this['phone'],
      $this['birthdate'],
      $this['gender'],
      $this['address'],
      $this['zipcode'],
      $this['city'],
      $this['country'],
      $this['website'],
      $this['logourl'],
      $this['carrer']
    );
    
    $this->widgetSchema->setLabels(array(
      'first_name'    => 'Firstname',
      'last_name'      => 'Lastname',
      'email_address'   => 'Email',
      'username'   => 'Username',
      'password'   => 'Password',
      'password_again'   => 'Confirm password',
    ));
    
    $this->setValidators(array(
            'first_name'    => new sfValidatorString(array('min_length' => 2), array('invalid' => 'Le pr&eacute;nom est trop court, 2 caracteres min.', 'required' => 'Le p&eacute;nom est trop court, 2 caracteres min.')),
            'last_name'   => new sfValidatorString(array('min_length' => 2), array('invalid' => 'Le nom est trop court, 2 caracteres min.', 'required' => 'Le nom est trop court, 2 caracteres min.')),
//            'username' => new sfValidatorString(array('min_length' => 2), array('invalid' => 'Le pseudo est trop court, 2 caracteres min.', 'required' => 'Le pseudo est trop court, 2 caracteres min.')),
	    'username' => new sfValidatorAnd(array(
		new sfValidatorString(array('min_length' => 2), array('invalid' => 'Le pseudo est trop court, 2 caracteres min.', 'required' => 'Le pseudo est trop court, 2 caracteres min.')),
		new sfValidatorDoctrineUnique(array('model' => 'sfGuardUser', 'column' => 'username'), array('invalid' => 'Ce pseudo est deja utilise'))
	    )),
            'email_address' => new sfValidatorAnd(array(
		new sfValidatorEmail(array(), array('invalid' => 'L\'adresse email est invalide.')),
		new sfValidatorDoctrineUnique(array('model' => 'sfGuarduser', 'column' => 'email_address'), array('invalid' => 'Cette adresse est deja utilise'))
	    )),
            'password' => new sfValidatorString(array('min_length' => 4), array('invalid' => 'Le password est trop court, 4 caracteres min.', 'required' => 'Le password est trop court, 4 caracteres min.')),
            'password_again' => new sfValidatorString(array('min_length' => 4), array('invalid' => 'Le password est trop court, 4 caracteres min.', 'required' => 'Le password est trop court, 4 caracteres min.')),
            
        ));
  }
}
