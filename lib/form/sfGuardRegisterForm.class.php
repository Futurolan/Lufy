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
class sfGuardRegisterForm extends BaseSfGuardUserForm {

  public function configure()
  {
    unset(
      $this['algorithm'],
      $this['salt'],
      $this['group_list'],
      $this['permissions_list'],
      $this['groups_list'],
      $this['is_active'],
      $this['is_super_admin'],
      $this['last_login'],
      $this['created_at'],
      $this['updated_at']
    );


    $this->setWidget('password', new sfWidgetFormInputPassword());
    $this->setWidget('password_again', new sfWidgetFormInputPassword());

    $this->setWidget('captcha', new sfWidgetFormReCaptcha(array('public_key' => sfConfig::get('app_recaptcha_public_key'))));


    $this->setValidator('first_name', new sfValidatorString(
      array(
        'required' => true,
        'min_length' => 4,
        'max_length' => 255
      )
    ));


    $this->setValidator('last_name', new sfValidatorString(
      array(
        'required' => true,
        'min_length' => 4,
        'max_length' => 255
      )
    ));


    $this->setValidator('email_address', new sfValidatorEmail(
      array(
        'required' => true
      ),
      array(
        'required' => 'L\'adresse de courriel est requise',
        'invalid' => 'Ce courriel n\'est pas valide'
      )
    ));


    $this->setValidator('username', new sfValidatorAnd(array(
      new sfValidatorString(
        array(
          'required' => true,
          'min_length' => 2,
          'max_length' => 15
        ),
        array(
          'min_length' => 'Le pseudo est trop court. 2 caractères minimum.',
          'max_length' => 'Le pseudo est trop long. 15 caractères maximum.',
        )
      ),
      new sfValidatorRegex(
        array(
          'pattern' => '/^[a-zA-Z0-9-]+$/')
        )
      ),
      array(),
      array(
        'required' => 'Le pseudo est requis',
        'invalid' => 'Le pseudo ne peux pas contenir de caractere speciaux'
      )
    ));


    $this->setValidator('password', new sfValidatorString(
      array(
        'required' => true,
        'min_length' => 4,
        'max_length' => 50
      ),
      array(
        'min_length' => 'Le mot de passe est trop court, 4 caracteres minimum.',
        'max_length' => 'Le mot de passe est trop long, 50 caracteres maximum.',
        'required' => 'Le mot de passe est requis',
        'invalid' => 'Le mot de passe doit contenir en entre 4 et 50 caracteres'
      )
    ));


    $this->setValidator('password_again', new sfValidatorString(
      array(
        'required' => true,
        'min_length' => 4,
        'max_length' => 20
      ),
      array(
        'min_length' => 'Le mot de passe est trop court, 4 caracteres minimum.',
        'max_length' => 'Le mot de passe est trop long, 50 caracteres maximum.',
        'required' => 'La confirmation est obligatoire',
        'invalid' => 'Le mot de passe doit contenir en entre 4 et 255 caracteres'
      )
    ));


    $this->setValidator('captcha', new sfValidatorReCaptcha(
      array(
        'private_key' => sfConfig::get('app_recaptcha_private_key')
      )
    ));


    $this->validatorSchema->setPostValidator(new sfValidatorAnd(
      array(
        new sfValidatorDoctrineUnique(
          array(
            'model' => 'sfGuardUser',
            'column' => array(
              'email_address'
            )
          )
        ),
        new sfValidatorDoctrineUnique(
          array(
            'model' => 'sfGuardUser',
            'column' => array(
              'username'
            )
          )
        ),
        new sfValidatorSchemaCompare('password',  sfValidatorSchemaCompare::EQUAL, 'password_again'),
      ))
    );
  }
}
