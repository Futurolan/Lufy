<?php

/**
 * partner actions.
 *
 * @package    lufy
 * @subpackage partner
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class partnerActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {

	/*$this->partnerTypes = Doctrine_Query::create()
     ->select('t.name')
     ->from('partnerType t')
	 ->where('t.status = 1')
     ->orderBy('t.position ASC')
     ->execute();
	 
	 $pType = $partnerTypes->getName();*/
	 
	$this->partners = Doctrine_Query::create()
     ->select('p.name, p.logourl, p.website, p.description')
     ->from('partner p, partnerType t')
	 ->where('p.status = 1')
     ->orderBy('p.position ASC')
     ->execute();
	 
	 // $this->partnerorga = Doctrine_Query::create()
     // ->select('p.name, p.logourl, p.website, p.description')
     // ->from('partner p, partnerType t')
     // ->where('p.partner_type_id = t.id_partner_type')
	 // ->andwhere('t.id_partner_type = 3')
     // ->orderBy('p.position ASC')
     // ->execute();
  }
}
