<?php

class inviteComponents extends sfComponents
{
  public function executeNbinvite(sfWebRequest $request)
  {
    $invites = Doctrine_Query::create()
      ->from('invite')
      ->where('user_id ='.$this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'))
      ->andWhere('status = 0')
      ->execute();

    if ($invites)
    {
      $this->count = count($invites);
    }
    else
    {
      $this->count = 0;
    }
  }
}
