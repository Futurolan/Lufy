<?php

class myUser extends sfGuardSecurityUser
{
  public function getId()
  {
    return $this->getAttribute('id', null, 'sfGuardSecurityUser');
  }
  public function getFirstName()
  {
    return $this->getAttribute('first_name', null, 'sfGuardSecurityUser');
  }
  public function getLastName()
  {
    return $this->getAttribute('last_name', null, 'sfGuardSecurityUser');
  }
  public function getEmailAddress()
  {
    return $this->getAttribute('email_address', null, 'sfGuardSecurityUser');
  }
  public function getCreatedAt()
  {
    return $this->getAttribute('created_at', null, 'sfGuardSecurityUser');
  }
  public function getBirthdate()
  {
    return $this->getAttribute('birthdate', null, 'sfGuardSecurityUser');
  }
  public function getGender()
  {
    return $this->getAttribute('gender', null, 'sfGuardSecurityUser');
  }
  public function getCountry()
  {
    return $this->getAttribute('country', null, 'sfGuardSecurityUser');
  }
  public function getCity()
  {
    return $this->getAttribute('city', null, 'sfGuardSecurityUser');
  }
  public function getLicenceMasters()
  {
    return $this->getAttribute('licence_masters', null, 'sfGuardSecurityUser');
  }
  public function getLicenceGa()
  {
    return $this->getAttribute('licence_ga', null, 'sfGuardSecurityUser');
  }
  public function getWebsite()
  {
    return $this->getAttribute('website', null, 'sfGuardSecurityUser');
  }
  public function getCarrer()
  {
    return $this->getAttribute('carrer', null, 'sfGuardSecurityUser');
  }
}
