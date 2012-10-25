<?php

/**
 * payement actions.
 *
 * @package    lufy
 * @subpackage payement
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class payementActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
/*
    $this->payements = Doctrine::getTable('payement')
      ->createQuery('a')
      ->execute();
*/

    $this->payements = Doctrine_Query::create()
      ->select('p.txn_id, p.amount, p.is_valid, p.is_paypal, p.created_at, p.updated_at, u.username, c.id_commande')
      ->from('Payement p')
      ->leftJoin('p.SfGuardUser u')
      ->leftJoin('p.Commande c')
      ->orderBy('p.id_payement DESC')
      ->execute();

  }

  public function executeShow(sfWebRequest $request)
  {
    $this->payement = Doctrine::getTable('payement')->find(array($request->getParameter('id_payement')));
    $this->forward404Unless($this->payement);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new payementForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new payementForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($payement = Doctrine::getTable('payement')->find(array($request->getParameter('id_payement'))), sprintf('Object payement does not exist (%s).', $request->getParameter('id_payement')));
    $this->form = new payementForm($payement);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($payement = Doctrine::getTable('payement')->find(array($request->getParameter('id_payement'))), sprintf('Object payement does not exist (%s).', $request->getParameter('id_payement')));
    $this->form = new payementForm($payement);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
//    $request->checkCSRFProtection();

    $this->forward404Unless($payement = Doctrine::getTable('payement')->find(array($request->getParameter('id_payement'))), sprintf('Object payement does not exist (%s).', $request->getParameter('id_payement')));
    $payement->delete();

    if (!$request->isXmlHttpRequest())
    {
      $this->redirect($request->getReferer());
    }
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $payement = $form->save();

      $this->redirect('payement/edit?id_payement='.$payement->getIdPayement());
    }
  }
}
