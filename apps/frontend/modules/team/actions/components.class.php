<?php

class teamComponents extends sfComponents
{

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executePlayers(sfWebRequest $request)
  {
    $this->players = Doctrine_Query::create()
      ->select('*')
      ->from('sfGuardUser s, TeamPlayer t')
      ->where('s.id = t.user_id')
      ->andWhere('t.team_id = ' . $this->idteam)
      ->andWhere('t.is_player = 1')
      ->execute();
  }
  
  
  public function executeListPlayers(sfWebRequest $request)
  {
    $this->players = Doctrine_Query::create()
      ->select('u.username')
      ->from('sfGuardUser u')
      ->leftJoin('u.TeamPlayer tp')
      ->where('tp.team_id = ?', $this->idteam)
      ->andWhere('tp.is_player = ?', 1)
      ->execute();
  }
}
