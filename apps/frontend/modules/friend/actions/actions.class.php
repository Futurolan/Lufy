<?php

/**
 * friend actions.
 *
 * @package    lufy
 * @subpackage friend
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class friendActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
     $this->friends = Doctrine::getTable('friend')->findByUserId($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
     
  }
}
