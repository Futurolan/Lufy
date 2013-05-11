<?php

/**
 * page actions.
 *
 * @package    lufy
 * @subpackage page
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pageActions extends FrontendActions
{
  public function executeView(sfWebRequest $request)
  {
    $slug = $request->getParameter('slug', '');

    if ($this->getUser()->getCulture() == 'en')
    {
      $slug = $slug.'-en';
    }

    $this->page = Doctrine::getTable('page')->findOneBySlug($slug);

    if (!$this->page)
    {
      $this->page = Doctrine::getTable('page')->findOneBySlug($request->getParameter('slug', ''));
    }

    $this->forward404Unless($this->page);

    if ($this->page->getStatus() == 0)
    {
      $this->forward404();
    }
  }

  public function executeConcoursOuikos(sfWebRequest $request)
  {
    $this->name = $request->getParameter('name');
  }
}
