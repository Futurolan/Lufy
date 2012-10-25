<?php

class InviteTable extends Doctrine_Table {

    public static function getInstance() {
        return Doctrine_Core::getTable('Invite');
    }

    public function isInvitedInTeam($id) {
        $q = Doctrine_Query::create()
                        ->from('invite')
                        ->where('user_id = ' . $id)
                        ->andWhere('action = "join"')
                        ->andWhere('status = 0')
                        ->execute();

        if (count($q) == 0):
            return FALSE;
        else:
            return TRUE;
        endif;
    }

    public function isInvitedFriend($id) {
        $user_id = sfContext::getInstance()->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser');
        $q = Doctrine_Query::create()
                        ->from('invite')
                        ->where('user_id = ' . $user_id)
                        ->andWhere('friend_id = ' . $id)
                        ->andWhere('action = "friend"')
                        ->andWhere('status = 0')
                        ->execute();
        $r = Doctrine_Query::create()
                        ->from('invite')
                        ->where('user_id = ' . $id)
                        ->andWhere('friend_id = ' . $user_id)
                        ->andWhere('action = "friend"')
                        ->andWhere('status = 0')
                        ->execute();
        if (count($q) == 0 && count($r) == 0):
            return FALSE;
        else:
            return TRUE;
        endif;
    }

}