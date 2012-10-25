<?php

class FriendTable extends Doctrine_Table {

    public static function getInstance() {
        return Doctrine_Core::getTable('Friend');
    }

    public function isFriend($id) {
        $user_id = sfContext::getInstance()->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser');
        $q = Doctrine_Query::create()
                        ->from('friend')
                        ->where('user_id = ' . $id)
                        ->andWhere('friend_id = ' . $user_id)
                        ->execute();
        if (count($q) == 0) {
            return false;
        } else {
            return true;
        };
    }

}