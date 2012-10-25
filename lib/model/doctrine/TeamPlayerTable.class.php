<?php

class TeamPlayerTable extends Doctrine_Table {
	
	
    public static function getInstance() {
        return Doctrine_Core::getTable('TeamPlayer');
    }

    public function addPlayer($id, $teamid) {
        $tp = new TeamPlayer();
        $tp->setUserId($id);
        $tp->setTeamId($teamid);
        $tp->save();
    }

    public function SetIsPlayer($teamplayer_id) {
        Doctrine_Query::create()
                ->update('teamPlayer')
                ->set('is_player', '?', '1')
                ->where('id_team_player = ' . $teamplayer_id)
                ->execute();
    }

    public function UnsetIsPlayer($teamplayer_id) {
        Doctrine_Query::create()
                ->update('teamPlayer')
                ->set('is_player', '?', '0')
                ->where('id_team_player = ' . $teamplayer_id)
                ->execute();
    }

    public function SetIsCaptain($teamplayer_id) {
        Doctrine_Query::create()
                ->update('teamPlayer')
                ->set('is_captain', '?', '1')
                ->where('id_team_player = ' . $teamplayer_id)
                ->execute();
    }

    public function UnsetIsCaptain($teamplayer_id) {
        Doctrine_Query::create()
                ->update('teamPlayer')
                ->set('is_captain', '?', '0')
                ->where('id_team_player = ' . $teamplayer_id)
                ->execute();
    }

    public function getReductions($team_id) {
        $reduction = 0;
        $q = Doctrine_Query::create()
                        ->from('teamPlayer t')
                        ->where('team_id = ' . $team_id)
                        ->andWhere('is_player = 1')
                        ->execute();
        foreach ($q as $player):
            $licenceused = 1;
            if ($player->getSfGuardUser()->getLicenceMasters()):
                $mfjv = new mfjv();
                $result = $mfjv->check($player->getSfGuardUser()->getLicenceMasters());
                if ($result) {
                    // La requete a abouti et la licence est valide,
                    // on peut donc exploiter les resultats
                    $licenceused = $result->used;
                };
            endif;
            if ($licenceused == 0):
                $reduction = $reduction + 5;
            endif;
        endforeach;

        return $reduction;
    }

}