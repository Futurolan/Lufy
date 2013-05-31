<?php

/**
 * gallery actions.
 *
 * @package    lufy
 * @subpackage gallery
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class galleryActions extends PresseActions
{

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->gallerys = Doctrine::getTable('Gallery')
            ->createQuery('a')
            ->where('status = 1')
            ->orderBy('position ASC')
            ->execute();
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeView(sfWebRequest $request)
  {
    $this->forward404Unless($this->gallery = Doctrine::getTable('Gallery')->findOneBySlug($request->getParameter('slug')));
  }

}
