<?php

/**
 * status_slot actions.
 *
 * @package    lufy
 * @subpackage status_slot
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class status_slotActions extends BackendActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->status_slots = Doctrine::getTable('StatusSlot')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new StatusSlotForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new StatusSlotForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($status_slot = Doctrine::getTable('StatusSlot')->find(array($request->getParameter('id_status_slot'))), sprintf('Object status_slot does not exist (%s).', $request->getParameter('id_status_slot')));
    $this->form = new StatusSlotForm($status_slot);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($status_slot = Doctrine::getTable('StatusSlot')->find(array($request->getParameter('id_status_slot'))), sprintf('Object status_slot does not exist (%s).', $request->getParameter('id_status_slot')));
    $this->form = new StatusSlotForm($status_slot);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($status_slot = Doctrine::getTable('StatusSlot')->find(array($request->getParameter('id_status_slot'))), sprintf('Object status_slot does not exist (%s).', $request->getParameter('id_status_slot')));
    $status_slot->delete();

    $this->redirect('status_slot/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $status_slot = $form->save();

      $this->redirect('status_slot/edit?id_status_slot='.$status_slot->getIdStatusSlot());
    }
  }
}
