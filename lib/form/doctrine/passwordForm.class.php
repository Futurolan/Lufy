<?php

class passwordForm extends sfGuardUserForm
{
  protected $check_old_password = True;
  
  public function configure()
  {
  	parent::configure();
		
		//$this->mergeForm(new registerForm()); 
     
    $this->useFields(array('password')); 
      
    $this->widgetSchema['password'] = new sfWidgetFormInputPassword(); 
    $this->widgetSchema['password_again'] = new sfWidgetFormInputPassword(); 
    $this->widgetSchema['old_password'] = new sfWidgetFormInputPassword(); 
    $this->validatorSchema['password_again'] = new sfValidatorString();
    $this->validatorSchema['old_password'] = new sfValidatorString();
	    
    $this->validatorSchema->setPostValidator(new sfValidatorAnd(array(
        new sfValidatorCallback(array(
          'callback' => array($this, 'checkPassword'))))));
		
		
		$this->widgetSchema->setLabel('old_password', 'Ancien mot de passe');
		
		$this->widgetSchema->setNameFormat('password[%s]');
    
    unset($this['id']);
	}
	
	public function checkPassword($validator, $value)
  {
    if(!$this->check_old_password) return $value;
    
		if (!sfContext::getInstance()->getUser()->getGuardUser()->checkPassword($value['old_password']))
    {
      $error = new sfValidatorError($validator, 'Ancien mot de passe incorrect'); 
      throw new sfValidatorErrorSchema($validator, array('old_password' => $error));
    }
    
    return $value;
  }
  
  /**
   * Enable old password checking for security reason. Enabled by default.
   * If disable this feature, this will unset widget and validator for old password.
   * 
   * @param bool $bool
   * @return void 
   */
  public function enableCheckPassword($bool = True)
  {
    if(!$bool) unset($this['old_password']);
    
    $this->check_old_password = $bool;
  }
}
?>