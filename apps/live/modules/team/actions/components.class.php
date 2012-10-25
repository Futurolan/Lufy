<?php

class teamComponents extends sfComponents {

    public function executePlayers(sfWebRequest $request) {
        $this->players = Doctrine_Query::create()
                        ->select('*')
                        ->from('sfGuardUser s, TeamPlayer t')
                        ->where('s.id = t.user_id')
                        ->andWhere('t.team_id = ' . $this->idteam)
                        ->andWhere('t.is_player = 1')
                        ->execute();
    }

}