<?php

/**
 * invite actions.
 *
 * @package    lufy
 * @subpackage invite
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class inviteActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->invites = Doctrine::getTable('invite')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new inviteForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new inviteForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($invite = Doctrine::getTable('invite')->find(array($request->getParameter('id_invite'))), sprintf('Object invite does not exist (%s).', $request->getParameter('id_invite')));
    $this->form = new inviteForm($invite);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($invite = Doctrine::getTable('invite')->find(array($request->getParameter('id_invite'))), sprintf('Object invite does not exist (%s).', $request->getParameter('id_invite')));
    $this->form = new inviteForm($invite);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($invite = Doctrine::getTable('invite')->find(array($request->getParameter('id_invite'))), sprintf('Object invite does not exist (%s).', $request->getParameter('id_invite')));
    $invite->delete();

    $this->redirect('invite/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $invite = $form->save();

      $this->redirect('invite/edit?id_invite='.$invite->getIdInvite());
    }
  }
}
