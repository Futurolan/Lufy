<?php

/**
 * ipn actions.
 *
 * @package    lufy
 * @subpackage ipn
 * @author     Guillaume Marsay <guillaume@futurolan.net>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class IpnActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->redirect('ipn/listNotChecked');
  }

  public function executeCheck(sfWebRequest $request)
  {
    $ipn = Doctrine_Core::getTable('IpnPaypal')->checkById($request->getParameter('id'));
    //$this->forward404Unless($ipn);
    $this->redirect('ipn/index');
  }

  public function executeView(sfWebRequest $request)
  {
    $this->ipn = Doctrine_Core::getTable('IpnPaypal')->findOneById($request->getParameter('id'));
    $this->forward404Unless($this->ipn);
    $this->user = Doctrine_Core::getTable('sfGuardUser')->findOneByLicenceGa($this->ipn->getLicenceGa());
  }

  public function executeListAll(sfWebRequest $request)
  {
    $this->ipns = Doctrine_Core::getTable('IpnPaypal')->findAll();
  }

  public function executeListChecked(sfWebRequest $request)
  {
    $this->ipns = Doctrine_Core::getTable('IpnPaypal')->findByIsChecked(1);
  }

  public function executeListNotChecked(sfWebRequest $request)
  {
    $this->ipns = Doctrine_Core::getTable('IpnPaypal')->findByIsChecked(0);
  }
}
