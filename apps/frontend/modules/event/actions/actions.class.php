<?php

/**
 * event actions.
 *
 * @package    lufy
 * @subpackage event
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class eventActions extends FrontendActions
{
  public function executeView(sfWebRequest $request)
  {
    $this->event = Doctrine::getTable('event')->findOneBySlug($request->getParameter('slug'));
    $this->forward404Unless($this->event);

    $this->page = Doctrine::getTable('page')->findOneBySlug('event-'.$request->getParameter('slug'));
  }
}
