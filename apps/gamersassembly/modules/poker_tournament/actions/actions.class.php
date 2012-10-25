<?php

/**
 * poker_tournament actions.
 *
 * @package    lufy
 * @subpackage poker_tournament
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class poker_tournamentActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->poker_tournaments = Doctrine_Core::getTable('PokerTournament')
      ->createQuery('a')
      ->where('is_active = 1')
      ->orderBy('start_at ASC')
      ->execute();
  }
  
  public function executeView(sfWebRequest $request)
  {
    if (!$this->getUser()->isAuthenticated()) {
        $this->redirect('@sf_guard_signin');
    }
    $this->pokerTournament = Doctrine_Core::getTable('PokerTournament')->findOneBySlug($request->getParameter('slug'));
    $this->event = Doctrine_Query::create()
     ->select('e.name, e.start_at, e.end_at, e.start_registration_at, e.end_registration_at')
     ->from('event e')
     ->orderBy('e.end_at DESC')	 
	 ->limit($this->getRequestParameter('limit', 1))
     ->execute();
    
    $this->user = Doctrine_Core::getTable('SfGuardUser')->findOneByUsername($this->getUser()->getUsername());
    $this->is_inscrit = Doctrine_Query::create()
      ->select('*')
      ->from('pokerTournamentPlayer p')
      ->where('p.poker_tournement_id = '.$this->pokerTournament->getIdPokerTournament())
      ->andWhere('p.user_id = '.$this->user->getId())
      ->execute();
  }
  
  public function executeReglement(sfWebRequest $request) {
    if (!$this->getUser()->isAuthenticated()) {
        $this->redirect('@sf_guard_signin');
    }
    $this->pokerTournament = Doctrine::getTable('PokerTournament')->findOneBySlug($request->getParameter('slug', ''));
    $this->forward404Unless($this->pokerTournament);
    $this->reglement = Doctrine::getTable('varConfig')->findOneByName('reglement');
  }
}
