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
class filtresdiffForm extends BaseNewsletterForm {

    public function configure() {
        unset($this['subject'], $this['content'], $this['created_at'], $this['updated_at']);
    }

    public function setup() {
        $this->setWidgets(array(
            'id_newsletter' => new sfWidgetFormInputHidden(),
            'recipient' => new sfWidgetFormChoice(array(
                'expanded' => true,
                'choices' => array('tout_le_monde' => '&Agrave; tout le monde', 'toutes_les_team_des_tournois' => 'Aux membres des &eacute;quipes inscrites aux tournois', 'tous_les_capitaines' => '&Agrave; tout les capitaines et admin de team', 'tous_les_joueurs' => '&Agrave; tous les joueurs des &eacute;quipe')
            )),
            'subject' => new sfWidgetFormInputText(),
            'content' => new sfWidgetFormTextarea(),
            'created_at' => new sfWidgetFormDateTime(),
            'updated_at' => new sfWidgetFormDateTime(),
        ));

        $this->setValidators(array(
            'id_newsletter' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_newsletter')), 'empty_value' => $this->getObject()->get('id_newsletter'), 'required' => false)),
            'recipient' => new sfValidatorString(array('max_length' => 255)),
            'subject' => new sfValidatorString(array('max_length' => 255)),
            'content' => new sfValidatorString(),
            'created_at' => new sfValidatorDateTime(),
            'updated_at' => new sfValidatorDateTime(),
        ));

        $this->widgetSchema->setNameFormat('newsletter[%s]');



        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

    }

}
