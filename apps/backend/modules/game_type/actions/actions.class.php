<?php

/**
 * game_type actions.
 *
 * @package    lufy
 * @subpackage game_type
 * @author     Guillaume Marsay
 * @version    Doctrine theme "lufy_backend"
 */

class game_typeActions extends sfActions{

  public function executeIndex(sfWebRequest $request)
  {
    $this->game_types = Doctrine_Core::getTable('GameType')->findAll();
  }


  public function executeView(sfWebRequest $request)
  {
    $this->game_type = Doctrine_Core::getTable('GameType')->find(array($request->getParameter('id_game_type')));
    $this->forward404Unless($this->game_type);
  }


  public function executeForm(sfWebRequest $request)
  {
    $this->form = new GameTypeForm();

    if ($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT))
    {
      if ($request->hasParameter('id_game_type'))
      {
        $this->object = Doctrine_Core::getTable('GameType')->findOneByIdGameType($request->getParameter('id_game_type'));

        $this->form =  new GameTypeForm($this->object);
      }

      $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));

      if ($this->form->isValid())
      {
        $object = $this->form->save();

        $this->redirect('game_type/view?id_game_type='.$object->getIdGameType());
      }
    }

    if ($request->hasParameter('id_game_type'))
    {
      $this->object = Doctrine_Core::getTable('GameType')->findOneByIdGameType($request->getParameter('id_game_type'));

      $this->form =  new GameTypeForm($this->object);
    }
  }


  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($game_type = Doctrine_Core::getTable('GameType')->find(array($request->getParameter('id_game_type'))), sprintf('Object game_type does not exist (%s).', $request->getParameter('id_game_type')));
    $game_type->delete();

    $this->redirect('game_type/index');
  }
}
