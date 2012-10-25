<?php

/**
 * game actions.
 *
 * @package    lufy
 * @subpackage game
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class gameActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->games = Doctrine::getTable('game')
      ->createQuery('a')
	  ->orderby('label ASC')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new gameForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new gameForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($game = Doctrine::getTable('game')->find(array($request->getParameter('id_game'))), sprintf('Object game does not exist (%s).', $request->getParameter('id_game')));
    $this->form = new gameForm($game);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($game = Doctrine::getTable('game')->find(array($request->getParameter('id_game'))), sprintf('Object game does not exist (%s).', $request->getParameter('id_game')));
    $this->form = new gameForm($game);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($game = Doctrine::getTable('game')->find(array($request->getParameter('id_game'))), sprintf('Object game does not exist (%s).', $request->getParameter('id_game')));
    $game->delete();

    $this->redirect('game/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $game = $form->save();

      $this->redirect('game/index');
    }
  }
}
