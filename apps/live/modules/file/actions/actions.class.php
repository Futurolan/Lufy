<?php

/**
 * file actions.
 *
 * @package    lufy
 * @subpackage file
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class fileActions extends sfActions
{


  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeIndex(sfWebRequest $request)
  {
    //$this->forward('default', 'module');
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeView(sfWebRequest $request)
  {
    $this->fileCategory = Doctrine::getTable('fileCategory')->findOneBySlug($request->getParameter('slug', ''));
    $this->forward404Unless($this->fileCategory);
    $this->files = Doctrine::getTable('file')->createQuery('a')->where('file_category_id=' . $this->fileCategory->id_file_category)->andWhere('status=1')->orderBy('name ASC')->execute();
  }

}
