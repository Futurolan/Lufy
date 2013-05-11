<?php

/**
 * faq actions.
 *
 * @package    lufy
 * @subpackage faq
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class faqActions extends FrontendActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->faqs = Doctrine::getTable('faq')
      ->createQuery('a')
      ->where('status = 1')
      ->orderBy('position ASC')
      ->execute();
  }
}
