<?php

/**
 * partner actions.
 *
 * @package    lufy
 * @subpackage partner
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class partnerActions extends BackendActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->partners = Doctrine::getTable('partner')
      ->createQuery('a')
      ->orderBy('position')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new partnerForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new partnerForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($this->partner = Doctrine::getTable('partner')->find(array($request->getParameter('id_partner'))), sprintf('Object partner does not exist (%s).', $request->getParameter('id_partner')));
    $this->form = new partnerForm($this->partner);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($partner = Doctrine::getTable('partner')->find(array($request->getParameter('id_partner'))), sprintf('Object partner does not exist (%s).', $request->getParameter('id_partner')));
    $this->form = new partnerForm($partner);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }
  
  public function executeUpdatePosition(sfWebRequest $request)
  {
    $partner = new Partner();
    $partner->updatePosition($request->getPostParameter('partner'));
    $this->getUser()->setFlash('success', 'L\'ordre des partenaires a ete mis a jour.');
    $this->redirect('partner/index');
  }
  
  public function executeSetStatus(sfWebRequest $request)
  {
    $id_partner = $request->getParameter('id_partner');
    $partner = Doctrine::getTable('partner')->findOneByIdPartner($id_partner);
    $this->forward404Unless($partner);
    if ($partner->getStatus() == 1):
      $partner->setHidden($id_partner);
    else:
      $partner->setVisible($id_partner);
    endif;
    $this->getUser()->setFlash('success', 'Le statut a été modifié.');
    $this->redirect('partner/index');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($partner = Doctrine::getTable('partner')->find(array($request->getParameter('id_partner'))), sprintf('Object partner does not exist (%s).', $request->getParameter('id_partner')));
    $partner->delete();

    $this->redirect('partner/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $partner = $form->save();

      //$this->redirect('partner/edit?id_partner='.$partner->getIdPartner());
      $this->redirect('partner/index');    }
  }
}
