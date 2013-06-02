<?php

/**
 * main actions.
 *
 * @package    lufy
 * @subpackage main
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mainActions extends PresseActions
{

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->homepage = Doctrine::getTable('Page')->findOneBySlug('presse-accueil');
  }
}
