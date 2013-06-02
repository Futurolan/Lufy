<?php

/**
 * poker_player components.
 *
 * @package    lufy
 * @subpackage poker_player
 * @author     Your name here
 * @version    SVN: $Id: components.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class poker_playerComponents extends sfComponents
{

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executePlayer(sfWebRequest $request)
  {
    $this->poker_tournament_players = Doctrine_Core::getTable('PokerTournamentPlayer')
            ->createQuery('a')
            ->execute();

    $this->poker_tournament_players = Doctrine_Query::create()
            ->select('*')
            ->from('pokerTournamentPlayer p')
            ->orderBy('p.id_poker_tournament_player ASC')
            ->where('p.poker_tournement_id = ' . $this->idtournament)
            ->andWhere('p.is_invite = 0')
            ->execute();

    $this->is_inscrit = Doctrine_Query::create()
            ->select('*')
            ->from('pokerTournamentPlayer p')
            ->where('p.poker_tournement_id = ' . $this->idtournament)
            ->andWhere('p.user_id = ' . $this->iduser)
            ->execute();
    $this->all_tournament = Doctrine_Core::getTable('PokerTournamentPlayer')->findByUserId($this->iduser);
  }

}
