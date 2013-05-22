<?php

/**
 * partner actions.
 *
 * @package    lufy
 * @subpackage partner
 * @author     Guillaume Marsay <guillaume@futurolan.net>
 */
class partnerActions extends FrontendActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->partners = Doctrine_Query::create()
      ->select('p.name, p.logourl, p.website, p.description, pt.name')
      ->from('Partner p')
      ->leftJoin('p.PartnerType pt')
      ->where('p.status = 1')
      ->andWhere('pt.status = 1')
      ->orderBy('p.position ASC')
      ->execute();
  }
}
