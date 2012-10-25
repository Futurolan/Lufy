<?php

/**
 * poker_tournament_player actions.
 *
 * @package    lufy
 * @subpackage poker_tournament_player
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class poker_tournament_playerActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->poker_tournament_players = Doctrine_Core::getTable('pokerTournamentPlayer')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new pokerTournamentPlayerForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new pokerTournamentPlayerForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($poker_tournament_player = Doctrine_Core::getTable('pokerTournamentPlayer')->find(array($request->getParameter('id_poker_tournament_player'))), sprintf('Object poker_tournament_player does not exist (%s).', $request->getParameter('id_poker_tournament_player')));
    $this->form = new pokerTournamentPlayerForm($poker_tournament_player);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($poker_tournament_player = Doctrine_Core::getTable('pokerTournamentPlayer')->find(array($request->getParameter('id_poker_tournament_player'))), sprintf('Object poker_tournament_player does not exist (%s).', $request->getParameter('id_poker_tournament_player')));
    $this->form = new pokerTournamentPlayerForm($poker_tournament_player);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($poker_tournament_player = Doctrine_Core::getTable('pokerTournamentPlayer')->find(array($request->getParameter('id_poker_tournament_player'))), sprintf('Object poker_tournament_player does not exist (%s).', $request->getParameter('id_poker_tournament_player')));
    $poker_tournament_player->delete();

    $this->redirect('poker_tournament_player/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $poker_tournament_player = $form->save();

      $this->redirect('poker_tournament_player/edit?id_poker_tournament_player='.$poker_tournament_player->getIdPokerTournamentPlayer());
    }
  }
}
