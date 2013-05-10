<?php

/**
 * tournament_admin actions.
 *
 * @package    lufy
 * @subpackage tournament_admin
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tournament_adminActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->tournament_admins = Doctrine::getTable('tournamentAdmin')
      ->createQuery('a')
      ->execute();
    
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new tournamentAdminForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new tournamentAdminForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($tournament_admin = Doctrine::getTable('tournamentAdmin')->find(array($request->getParameter('user_id'))), sprintf('Object tournament_admin does not exist (%s).', $request->getParameter('user_id')));
    $this->form = new tournamentAdminForm($tournament_admin);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($tournament_admin = Doctrine::getTable('tournamentAdmin')->find(array($request->getParameter('user_id'))), sprintf('Object tournament_admin does not exist (%s).', $request->getParameter('user_id')));
    $this->form = new tournamentAdminForm($tournament_admin);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($tournament_admin = Doctrine::getTable('tournamentAdmin')->find(array($request->getParameter('user_id'))), sprintf('Object tournament_admin does not exist (%s).', $request->getParameter('user_id')));
    $tournament_admin->delete();

    $this->redirect('tournament_admin/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $tournament_admin = $form->save();

      $this->redirect('tournament_admin/index');
    }
  }
}
