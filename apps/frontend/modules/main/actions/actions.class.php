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
   * @brief
   * @param[in]
   * @return
   */
  public function executeIndex(sfWebRequest $request)
  {

  }


  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeLanguage(sfWebRequest $request)
  {
    $this->getUser()->setCulture('fr');
    $this->redirect('main/index');
  }


  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeChangeLanguage(sfWebRequest $request)
  {
    $culture = $request->getParameter('culture');
    $this->getUser()->setCulture($culture);
    $this->redirect('main/index');
  }


  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeError404(sfWebRequest $request)
  {

  }


  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeError401(sfWebRequest $request)
  {

  }

}
