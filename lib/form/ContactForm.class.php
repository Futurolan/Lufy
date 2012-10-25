<?php
class ContactForm extends sfForm
{
	public function configure()
	{

		$this->setWidgets(array(
			'nom' => new sfWidgetFormInput(),
			'prenom' => new sfWidgetFormInput(),
			'pseudo' => new sfWidgetFormInput(),
			'date_naissance' => new sfWidgetFormI18nDate(array('culture' => 'fr', 'years'   => berdujtools::getYearList())),
			'email' => new sfWidgetFormInput(),
			'tel' => new sfWidgetFormInput(),
			//'adresse' => new sfWidgetFormInput(),
			'cp' => new sfWidgetFormInput(),
			'ville' => new sfWidgetFormInput(),
			'date_arrivee' => new sfWidgetFormI18nDateTime(array('culture' => 'fr')),
			'date_depart' => new sfWidgetFormI18nDateTime(array('culture' => 'fr')),
			'hebergement' => new sfWidgetFormChoice(array('choices' => array('Non' => 'Non', 'Oui' => 'Oui'))),
			'postes' => new sfWidgetFormTextarea(),
			'commentaires' => new sfWidgetFormTextarea(),
			//'centre_interet' => new sfWidgetFormChoice(array(  'choices'  => $centre_interet_list, 	'expanded' => true, 'multiple' => true ))
		));

		$this->setValidators(array(
			'nom' => new sfValidatorString(array( 'required' => true), array('required' => 'Vous devez saisir votre nom')),
			'prenom' => new sfValidatorString(array( 'required' => true), array('required' => 'Vous devez saisir votre prénom')),
			'pseudo' => new sfValidatorString(array( 'required' => true), array('required' => 'Vous devez saisir votre pseudo')),
			'email' => new sfValidatorEmail(array( 'required' => true), array('invalid' => 'Email invalide', 'required' => 'Vous devez saisir votre email')),
			'tel' => new sfValidatorString(array( 'required' => true), array('required' => 'Vous devez saisir votre tél')),
			'cp' => new sfValidatorString(array( 'required' => true), array('required' => 'Vous devez saisir votre code postal')),
			'ville' => new sfValidatorString(array( 'required' => true), array('required' => 'Vous devez saisir votre ville')),
			//'adresse' => new sfValidatorString(array( 'required' => true), array('required' => 'Vous devez saisir votre adresse')),
			'commentaires' => new sfValidatorString(array( 'required' => false), array()),
			'hebergement' => new sfValidatorString(array( 'required' => false), array()),
			'postes' => new sfValidatorString(array( 'required' => false), array()),
			'date_naissance' => new sfValidatorDateTime(array( 'required' => true), array('required' => 'Vous devez saisir votre date de naissance', 'invalid' =>'date invalide')),
			'date_arrivee' => new sfValidatorDateTime(array( 'required' => true), array('required' => 'Vous devez saisir la date d\'arrivée', 'invalid' =>'date invalide')),
			'date_depart' => new sfValidatorDateTime(array( 'required' => true), array('required' => 'Vous devez saisir la date de départ', 'invalid' =>'date invalide')),
			//'centre_interet' => new sfValidatorPass()
		));

		$this->widgetSchema->setLabels(array(
			'nom' => 'Nom', 'prenom' => 'Pr&eacute;nom', 'pseudo' => 'Pseudo',
			'email' => 'Email', 'date_naissance' => 'Date de naissance', 'tel' => 'T&eacute;l&eacute;phone',
			'cp' => 'Code Postal', 'ville' => 'Ville',
			'date_arrivee' => 'Arriv&eacute;e', 'date_depart' => 'D&eacute;part', 'hebergement' => 'Besoin d\'h&eacute;bergement ?',
			'postes' => 'Poste', 'commentaires' => 'Commentaires',
		));

		$this->widgetSchema->setNameFormat('contact[%s]');
	}
}
