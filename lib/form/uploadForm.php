<?php

/**
 * Upload form base class.
 *
 * @package    lufy
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
class uploadForm {

  public function configure()
  {
    $this->setWidgets(array(
      'file' => new sfWidgetFormInputFile(),
      'path' => new sfWidgetFormInput(),
      'name' => new sfWidgetFormInput(),
    ));
    
    $this->validatorSchema['file'] = new sfValidatorFile(array(
                                        'required' => true,
                                        'path' => sfConfig::get('sf_upload_dir'),
                               ));
    

    $this->widgetSchema->setNameFormat('upload[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'upload';
  }
  
}
