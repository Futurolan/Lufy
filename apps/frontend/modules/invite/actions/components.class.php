<?php

class inviteComponents extends sfComponents {

    public function executeNbinvite(sfWebRequest $request) {
        $invites = Doctrine_Query::create()
                        ->from('invite')
                        ->where('user_id ='.$this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'))
                        ->andWhere('status = 0')
                        ->andWhere('action = "join"')
                        ->execute();
        $friends = Doctrine_Query::create()
                        ->from('invite')
                        ->where('friend_id ='.$this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'))
                        ->andWhere('status = 0')
                        ->andWhere('action = "friend"')
                        ->execute();
        if ($invites||$friends):
            $this->count = count($invites) + count($friends);
        else:
            $this->count = 0;
        endif;
}
   


}
