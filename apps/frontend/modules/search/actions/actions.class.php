<?php

/**
 * search actions.
 *
 * @package    lufy
 * @subpackage search
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class searchActions extends FrontendActions
{

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeUser(sfWebRequest $request)
  {
    if ($request->getParameter('byUsername'))
    {
      $byUsername = $request->getParameter('byUsername');
      $byUsername = str_replace('%', '', $byUsername);
      $byUsername = str_replace('__', '', $byUsername);

      if (strlen($byUsername) >= 2)
      {
        $this->users = Doctrine_Query::create()
                ->from('sfGuardUser u')
                ->where('u.username LIKE ?', '%' . $request->getParameter('byUsername') . '%')
                ->execute();
      }
      else
      {
        $this->getUser()->setFlash('error', 'Vous devez utiliser 2 caracteres minimum.');
        $this->redirect('search/user');
      }
    }
  }

}
