<?php

class tournament_slotComponents extends sfComponents
{
  public function executeListTeamsAndPlayers(sfWebRequest $request)
  {
    $this->nb_slots = $this->numberteam;
    
    $this->slots = Doctrine_Query::create()
      ->select('ts.is_valid, ts.team_id')
      ->from('tournamentSlot ts')
      ->where('ts.tournament_id = ?', $this->idtournament)
      ->execute();
  }
  
  

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeTeamWithoutPlayers(sfWebRequest $request)
  {
    $this->attente = $this->numberteam + 1;
    $this->teams = Doctrine_Query::create()
            ->select('*')
            ->from('team t, tournamentSlot t2')
            ->where('t.id_team = t2.team_id')
            ->andWhere('t2.tournament_id = ' . $this->idtournament)
            ->execute();
    $this->slots = Doctrine_Query::create()
            ->from('tournamentSlot')
            ->where('tournament_id =' . $this->idtournament)
            ->orderBy('position ASC')
            ->execute();
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeTeam(sfWebRequest $request)
  {
    $this->nb_team = Doctrine::getTable('Tournament')->findOneByIdTournament($this->idtournament);
    $this->slots = Doctrine_Query::create()
            ->select('*')
            ->from('tournamentSlot t, team t2')
            ->where('t.tournament_id = ' . $this->idtournament)
            ->OrderBy('t.position ASC')
            ->execute();
  }

}