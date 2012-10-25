<?php

class searchForm extends sfForm
{
  public function configure()
  {
    parent::configure();
    
    $this->setWidgets(array(
					'pattern' => new sfWidgetFormInput(),
		));
		
		$this->setValidator('pattern', new sfValidatorString(array(
					'required' => true,
					'min_length'=>2,
		)));
			
		$this->widgetSchema->setLabels(array(
		'pattern' => 'Rechercher',
		));
		
		$this->widgetSchema->setNameFormat('search[%s]');		 
    
  }
}
