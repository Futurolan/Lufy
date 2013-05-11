<?php

/**
 * partner_type actions.
 *
 * @package    lufy
 * @subpackage partner_type
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class partner_typeActions extends BackendActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->partners_types = Doctrine::getTable('partnerType')
      ->createQuery('a')
      ->orderBy('position ASC')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new partnerTypeForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new partnerTypeForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($partner_type = Doctrine::getTable('partnerType')->find(array($request->getParameter('id_partner_type'))), sprintf('Object partner_type does not exist (%s).', $request->getParameter('id_partner_type')));
    $this->form = new partnerTypeForm($partner_type);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($partner_type = Doctrine::getTable('partnerType')->find(array($request->getParameter('id_partner_type'))), sprintf('Object partner_type does not exist (%s).', $request->getParameter('id_partner_type')));
    $this->form = new partnerTypeForm($partner_type);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }
    
  public function executeUpdatePosition(sfWebRequest $request)
  {
    $partner_type = new PartnerType();
    $partner_type->updatePosition($request->getPostParameter('partner_type'));
    $this->getUser()->setFlash('success', 'L\'ordre des partenaires a ete mis a jour.');
    $this->redirect('partner_type/index');
  }
  
  public function executeSetStatus(sfWebRequest $request)
  {
    $id_partner_type = $request->getParameter('id_partner_type');
    $partner_type = Doctrine::getTable('partnerType')->findOneByIdPartnerType($id_partner_type);
    $this->forward404Unless($partner_type);
    if ($partner_type->getStatus() == 1):
      $partner_type->setHidden($id_partner_type);
    else:
      $partner_type->setVisible($id_partner_type);
    endif;
    $this->getUser()->setFlash('success', 'Le statut a été modifié.');
    $this->redirect('partner_type/index');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($partner_type = Doctrine::getTable('partnerType')->find(array($request->getParameter('id_partner_type'))), sprintf('Object partner_type does not exist (%s).', $request->getParameter('id_partner_type')));
    $partner_type->delete();

    $this->redirect('partner_type/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $partner_type = $form->save();

      $this->redirect('partner_type/edit?id_partner_type='.$partner_type->getIdPartnerType());
    }
  }
}
