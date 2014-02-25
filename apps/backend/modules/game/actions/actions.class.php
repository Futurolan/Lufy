<?php

/**
 * game actions.
 *
 * @package    lufy
 * @subpackage game
 * @author     Guillaume Marsay
 * @version    Doctrine theme "lufy_backend"
 */

class gameActions extends sfActions{

  public function executeIndex(sfWebRequest $request)
  {
    $this->games = Doctrine_Core::getTable('Game')->findAll();
  }


  public function executeView(sfWebRequest $request)
  {
    $this->game = Doctrine_Core::getTable('Game')->find(array($request->getParameter('id_game')));
    $this->forward404Unless($this->game);
  }


  public function executeForm(sfWebRequest $request)
  {
    $this->form = new GameForm();

    if ($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT))
    {
      if ($request->hasParameter('id_game'))
      {
        $this->object = Doctrine_Core::getTable('Game')->findOneByIdGame($request->getParameter('id_game'));

        $this->form =  new GameForm($this->object);
      }

      $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));

      if ($this->form->isValid())
      {
        $object = $this->form->save();

        $this->redirect('game/view?id_game='.$object->getIdGame());
      }
    }

    if ($request->hasParameter('id_game'))
    {
      $this->object = Doctrine_Core::getTable('Game')->findOneByIdGame($request->getParameter('id_game'));

      $this->form =  new GameForm($this->object);
    }
  }


  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($game = Doctrine_Core::getTable('Game')->find(array($request->getParameter('id_game'))), sprintf('Object game does not exist (%s).', $request->getParameter('id_game')));
    $game->delete();

    $this->redirect('game/index');
  }
}
