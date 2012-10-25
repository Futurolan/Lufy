<?php

class TeamTable extends Doctrine_Table {

    public static function getInstance() {
        return Doctrine_Core::getTable('Team');
    }

    public function isAlreadyInTournament() {
        $id = sfContext::getInstance()->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser');
        $q = Doctrine_Query::create()
                        ->from('teamPlayer')
                        ->where('user_id = ' . $id)
                        ->execute();
        $p = Doctrine_Query::create()
                        ->from('tournamentSlot')
                        ->where('team_id = ' . $q[0]->getTeamId())
                        ->execute();

        if (count($p) == '1' && $q[0]->getUserId() == $id) {
            return true;
        } else {
            return false;
        };
    }

    public function isInTeam($id) {
        $q = Doctrine_Query::create()
                        ->from('teamPlayer')
                        ->where('user_id = ' . $id)
                        ->execute();
        if (count($q) == 0) {
            return false;
        } else {
            return true;
        };
    }

    public function deleteTeamPlayers($id_team) {
        $d = Doctrine_Query::create()
                        ->delete('TeamPlayer')
                        ->where('team_id = ' . $id_team)
                        ->execute();
    }

    public function InSlot($team_id) {
        $s = doctrine::getTable('tournamentSlot')->findOneByTeamId($team_id);
        if ($s):
            return $s;
        else:
            return '0';
        endif;
    }

    public function getAdminTeam($team_id) {
        $s = Doctrine_Query::create()
                        ->from('team')
                        ->where('id_team = ' . $team_id)
                        ->execute();
        $u = Doctrine_Query::create()
                        ->from('sfGuardUser')
                        ->where('id =' . $s[0]->getAdminteamId())
                        ->execute();

        return $u;
    }
    

}