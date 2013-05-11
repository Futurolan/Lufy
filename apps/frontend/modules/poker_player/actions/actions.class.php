<?php

/**
 * poker_player actions.
 *
 * @package    lufy
 * @subpackage poker_player
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class poker_playerActions extends FrontendActions
{

  public function executeAddPlayer(sfWebRequest $request)
  {
    $this->tournamentSlug = $this->request->getParameter('slug');
    $this->tournament = Doctrine_Core::getTable('PokerTournament')->findOneBySlug($this->tournamentSlug);
    $user = Doctrine_Core::getTable('SfGuardUser')->findOneByUsername($this->getUser()->getUsername());

    $player = new PokerTournamentPlayer();
    $player->setPokerTournementId($this->tournament->getIdPokerTournament());
    $player->setUserId($user->getId());
    $this->form = new AddPokerPlayerForm($player);

    if ($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT))
    {
      $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
      if ($this->form->isValid())
      {
        $poker_tournament_player = $this->form->save();
        $this->redirect('poker_tournament/view?slug='.$this->tournamentSlug);
      }
    }
  }

  public function executeDelete(sfWebRequest $request)
  {
    $this->forward404Unless($poker_tournament_player = Doctrine_Core::getTable('PokerTournamentPlayer')->find(array($request->getParameter('id_poker_tournament_player'))), sprintf('Object poker_tournament_player does not exist (%s).', $request->getParameter('id_poker_tournament_player')));
    $poker_tournament_player->delete();

    $this->redirect('poker_tournament/index');
  }
}
