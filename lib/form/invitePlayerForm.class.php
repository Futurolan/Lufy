<?php

/**
 * InvitePlayer form base class.
 *
 * @method TeamPlayer getObject() Returns the current form's model object
 *
 * @package    lufy
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
class InvitePlayerForm extends BaseFormDoctrine
{
  public function setup()
  {
    unset($this['friend_id'], $this['response'], $this['created_at'], $this['updated_at']);
    $this->setWidgets(array(
      'id_invite' => new sfWidgetFormInputHidden(),
	  'team_id'   => new sfWidgetFormInputHidden(),
      'user_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SfGuardUser'), 'add_empty' => false)),
      
    ));

    $this->setValidators(array(
      'id_invite'    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_invite')), 'empty_value' => $this->getObject()->get('id_invite'), 'required' => false)),
      'user_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('SfGuardUser'))),
      'team_id'      => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('invite[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Invite';
  }

}
