<?php

class sfGuardUserTable extends PluginsfGuardUserTable {

    public static function getInstance() {
        return Doctrine_Core::getTable('sfGuardUser');
    }

    
    public function isInTournament($id) {
        $q = Doctrine_Query::create()
                        ->select('*')
                        ->from('teamPlayer t, tournament_slot t3')
                        ->where('t2.team_id = t.team_id')
                        ->andWhere('t.user_id = ' . $id)
                        ->execute();
                        
        if (count($q) == '1') {
            return true;
        } else {
            return false;
        };
    }

    public function isCaptain() {
        $id = sfContext::getInstance()->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser');
        
        $q = Doctrine_Query::create()
                        ->select('*')
                        ->from('teamPlayer t')
                        ->where('t.is_captain = 1')
                        ->andWhere('t.user_id = ' . $id)
                        ->execute();
                        
        if (count($q) == '1') {
            return true;
        } else {
            return false;
        };
    }

    public function isAdmin() {
        $id = sfContext::getInstance()->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser');

        $q = Doctrine_Query::create()
                        ->select('*')
                        ->from('team t, teamPlayer t2')
                        ->where('t.adminteam_id = ' . $id)
                        ->andWhere('t2.team_id = t.id_team')
                        ->execute();

        if (count($q) == '1') {
            return true;
        } else {
            return false;
        };
    }


    public function isPlayer() {
        $id = sfContext::getInstance()->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser');
        $q = Doctrine_Query::create()
                        ->select('*')
                        ->from('teamPlayer t')
                        ->where('t.is_player = 1')
                        ->andWhere('t.user_id = ' . $id)
                        ->execute();
        if (count($q) == '1') {
            return true;
        } else {
            return false;
        };
    }

    public function getUser($id) {
        $q = Doctrine_Query::create()
                        ->from('sfGuardUser')
                        ->where('id = ' . $id)
                        ->execute();
        return $q[0];
    }


    public function active($id) {
        Doctrine_Query::create()
                ->update('sfGuardUser')
                ->set('is_active', '?', '1')
                ->where('id = ' . $id)
                ->execute();
    }
    
    public function searchQuery($pattern)
	{
		$q = Doctrine_Query::create()
                ->from('sfGuardUser')
                ->where('is_active = 1')
                ->andWhere('username LIKE \'%'.$pattern.'%\'');

        return $q;
	}

}