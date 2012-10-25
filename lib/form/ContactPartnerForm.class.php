<?php
class ContactPartnerForm extends sfForm
{
	public function configure()
	{
		$this->setWidgets(array(
			'societe' => new sfWidgetFormInput(),
			'nom' => new sfWidgetFormInput(),
			'prenom' => new sfWidgetFormInput(),
			'email' => new sfWidgetFormInput(),
			'tel' => new sfWidgetFormInput(),
			'fax' => new sfWidgetFormInput(),
			'adresse' => new sfWidgetFormInput(),
			'cp' => new sfWidgetFormInput(),
			'ville' => new sfWidgetFormInput(),
			'pays' => new sfWidgetFormI18nChoiceCountry(array('culture' => 'fr')),
			'message' => new sfWidgetFormTextarea(),
		));

		$this->setValidators(array(
			'societe' => new sfValidatorString(array('required' => true), array('required' => 'Vous devez saisir votre societe')),
			'nom' => new sfValidatorString(array('required' => true), array('required' => 'Vous devez saisir votre nom')),
			'prenom' => new sfValidatorString(array('required' => true), array('required' => 'Vous devez saisir votre prénom')),
			'pseudo' => new sfValidatorString(array('required' => true), array('required' => 'Vous devez saisir votre pseudo')),
			'email' => new sfValidatorEmail(array('required' => true), array('invalid' => 'Email invalide', 'required' => 'Vous devez saisir votre email')),
			'tel' => new sfValidatorString(array('required' => true), array('required' => 'Vous devez saisir votre tél')),
			'fax' => new sfValidatorString(array('required' => false), array()),
			'cp' => new sfValidatorString(array('required' => false), array()),
			'ville' => new sfValidatorString(array('required' => false), array()),
			'adresse' => new sfValidatorString(array('required' => false), array()),
			'pays' => new sfValidatorString(array('required' => false), array()),
			'message' => new sfValidatorString(array('required' => true), array()),
		));

		$this->widgetSchema->setLabels(array(
			'societe' => 'Societe : ', 'nom' => 'Nom : ', 'prenom' => 'Prénom : ',
 			'email' => 'Email : ', 'tel' => 'Téléphone : ', 'fax' => 'Fax : ',
			'adresse'=> 'Adresse : ', 'cp' => 'Code Postal : ', 'ville' => 'Ville : ', 'pays' => 'Pays : ',
			'message' => 'Message : ',
		));

		$this->widgetSchema->setNameFormat('contactPartner[%s]');
	}
}
