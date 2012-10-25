<?php

class myUser extends sfGuardSecurityUser
{
  public function getId()
  {
    return $this->getAttribute('id', null, 'sfGuardSecurityUser');
  }

  public function getUsername()
  {
    return $this->getAttribute('username', null, 'sfGuardSecurityUser');
  }

  public function getEmailAddress()
  {
    return $this->getAttribute('email_address', null, 'sfGuardSecurityUser');
  }
}
