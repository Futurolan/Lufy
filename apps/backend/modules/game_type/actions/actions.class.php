<?php

/**
 * game_type actions.
 *
 * @package    lufy
 * @subpackage game_type
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class game_typeActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->game_types = Doctrine::getTable('gameType')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new gameTypeForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new gameTypeForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($game_type = Doctrine::getTable('gameType')->find(array($request->getParameter('id_game_type'))), sprintf('Object game_type does not exist (%s).', $request->getParameter('id_game_type')));
    $this->form = new gameTypeForm($game_type);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($game_type = Doctrine::getTable('gameType')->find(array($request->getParameter('id_game_type'))), sprintf('Object game_type does not exist (%s).', $request->getParameter('id_game_type')));
    $this->form = new gameTypeForm($game_type);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($game_type = Doctrine::getTable('gameType')->find(array($request->getParameter('id_game_type'))), sprintf('Object game_type does not exist (%s).', $request->getParameter('id_game_type')));
    $game_type->delete();

    $this->redirect('game_type/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $game_type = $form->save();

      $this->redirect('game_type/edit?id_game_type='.$game_type->getIdGameType());
    }
  }
}
