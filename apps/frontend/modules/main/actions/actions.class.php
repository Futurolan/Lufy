<?php

/**
 * main actions.
 *
 * @package    lufy
 * @subpackage main
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mainActions extends FrontendActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
   $this->setTemplate('index2');
  }
  
 /**
  * Executes language action
  *
  * @param sfRequest $request A request object
  */
  public function executeLanguage(sfWebRequest $request)
  {
    # Définition de la langue par defaut
    $this->getUser()->setCulture('fr');
    $this->redirect('main/index');
  }
  

 /**
  * Executes changeLanguage action
  *
  * @param sfRequest $request A request object
  */
  public function executeChangeLanguage(sfWebRequest $request)
  {
    # Définition de la langue par defaut
    $culture = $request->getParameter('culture');
    $this->getUser()->setCulture($culture);
    $this->redirect('main/index');
  }


 /**
  * Executes error404 action
  *
  * @param sfRequest $request A request object
  */
  public function executeError404(sfWebRequest $request)
  {
    
  }
  
 /**
  * Executes error401 action
  *
  * @param sfRequest $request A request object
  */
  public function executeError401(sfWebRequest $request)
  {
    
  }

}
