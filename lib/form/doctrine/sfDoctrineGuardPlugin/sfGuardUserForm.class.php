<?php

/**
 * sfGuardUser form.
 *
 * @package    lufy
 * @subpackage form
 * @author     Guillaume Marsay
 * @version    SVN: $Id: sfDoctrinePluginFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfGuardUserForm extends PluginsfGuardUserForm
{
  public function configure()
  {
    $this->validatorSchema->setPostValidator(
         new sfValidatorSchemaCompare('password',  sfValidatorSchemaCompare::EQUAL, 'password_again')
    );

    $this->setValidators(array(
        'first_name' => new sfValidatorString(
                array('required' => true, 'min_lenght' => 4, 'max_lenght' => 255)),
        'last_name' => new sfValidatorString(
                array('required' => true, 'min_lenght' => 4, 'max_lenght' => 255)),
        'email_address'   => new sfValidatorEmail(
                                          array('required' => true),
                                          array(
                                          'required' => 'L\'adresse de courriel est requise',
                                          'invalid' => 'Ce courriel n\'est pas valide')
                                          ),
        'username'   => new sfValidatorAnd(
                array(
                    new sfValidatorString(
                            array('required' => true, 'min_length' => 2, 'max_length' => 15),
                            array(
                                'min_length' => 'Le pseudo est trop court. 2 caractères minimum.',
                                'max_length' => 'Le pseudo est trop long. 15 caractères maximum.',)
                            ),
                    new sfValidatorRegex(array('pattern' => '/^[a-zA-Z0-9-]+$/'))
                    ),
                array(),
                array(
                  'required' => "Le pseudo est requis",
                  'invalid' => "Le pseudo ne peux pas contenir de caractère spéciaux.")
                ),
        'password'   => new sfValidatorAnd(
                array(
                    new sfValidatorString(
                            array('required' => true, 'min_length' => 8, 'max_length' => 255),
                            array(
                                'min_length' => 'Le mot de passe est trop court. 8 caractères minimum.',
                                'max_length' => 'Le mot de passe est trop long. 255 caractères maximum.',)
                            ),
                    new sfValidatorRegex(array('pattern' => '/[a-z]+[A-Z]+[0-9]+^[a-zA-Z0-9]+[^ ]/'))
                    ),
                array(),
                array(
                  'required' => 'Le mot de passe est requis',
                  'invalid' => 'Le mot de passe doit contenir au moins une majuscule, une minuscule, un chiffre et un symbole. Il ne peux y avoir d\'espace .')
                ),
        'password_again'   => new sfValidatorAnd(
                array(
                    new sfValidatorString(
                            array('required' => true, 'min_length' => 8, 'max_length' => 255),
                            array(
                                'min_length' => 'Le mot de passe est trop court. 8 caractères minimum.',
                                'max_length' => 'Le mot de passe est trop long. 255 caractères maximum.',)
                            ),
                    new sfValidatorRegex(array('pattern' => '/[a-z]+[A-Z]+[0-9]+^[a-zA-Z0-9]+[^ ]/'))
                    ),
                array(),
                array(
                  'required' => 'Le mot de passe est requis',
                  'invalid' => 'Le mot de passe doit contenir au moins une majuscule, une minuscule, un chiffre et un symbole. Il ne peux y avoir d\'espace .')
                )
//        'password'   => new sfValidatorString(
//                array('required' => true, 'min_length' => 4, 'max_length' => 255),
//                array(
//                  'min_length' => "Le mot de passe est trop court, 4 caractères minimum.",
//                  'max_length' => "Le mot de passe est trop long, 255 caractères maximum.",
//                  'required' => "Le mot de passe est requis",
//                  'invalid' => "Le mot de passe doit contenir en entre 4 et 255 caractères")
//                ),
//        'password_again'   => new sfValidatorString(
//                                                array('required' => true, 'min_length' => 4, 'max_length' => 20),
//                                                array(
//                                                  'min_length' => "Le mot de passe est trop court, 4 caractères minimum.",
//                                                  'max_length' => "Le mot de passe est trop long, 255 caractères maximum.",
//                                                  'required' => "La confirmation est obligatoire",
//                                                  'invalid' => "Le mot de passe doit contenir en entre 4 et 255 caractères")
//                                                )
        ));
  }
}
