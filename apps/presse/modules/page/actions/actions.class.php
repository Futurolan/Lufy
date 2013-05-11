<?php

/**
 * page actions.
 *
 * @package    lufy
 * @subpackage page
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pageActions extends PresseActions
{

  public function executeView(sfWebRequest $request)
  {
    $slug = $request->getParameter('slug');
    $this->forward404Unless($slug);
    if (substr($slug, 0, 7) == 'presse-') $this->redirect('page/view?slug='.str_replace('presse-', '', $slug));


    $this->page = Doctrine::getTable('page')->findOneBySlug('presse-'.$slug);
    $this->forward404Unless($this->page);
  }
}
