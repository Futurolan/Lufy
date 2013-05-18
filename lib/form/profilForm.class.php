<?php

/**
 * profil form.
 *
 * @package    lufy
 * @subpackage form
 * @author     Guillaume Marsay <guillaume@futurolan.net>
 * @version    SVN: $Id: sfDoctrinePluginFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class profilForm extends sfGuardUserForm
{

  public function configure()
  {
    parent::configure();

    unset(
      $this['id'],
      $this['username'],
      $this['email_address'],
      $this['algorithm'],
      $this['salt'],
      $this['password'],
      $this['is_active'],
      $this['is_super_admin'],
      $this['last_login'],
      $this['created_at'],
      $this['updated_at'],
      $this['groups_list'],
      $this['permissions_list']
    );

    $this->mergeForm(new SfGuardUserProfileForm($this->getSfGuardUserProfile()));
  }

  /**
  * Override the save method to save the merged user info form.
  */
  public function doSave($con = null) {
    parent::doSave();

    $this->updateSfGuardUserProfile();

    return $this->object;
  }

  /**
  * Updates the user info merged form.
  */
  protected function updateSfGuardUserProfile() {
    // update user info
    if (!is_null($sfGuardUserProfile = $this->getSfGuardUserProfile())) {

      $values = $this->getValues();
      if ( $sfGuardUserProfile->isNew() ) {
        $values['user_id'] = $this->object->getId();
      }

      $sfGuardUserProfile->fromArray($values, 'user_id');

      $sfGuardUserProfile->save();
    }
  }

  /**
  * Returns the user info object. If it does
  * not exist return a new instance.
  *
  * @return UserInfo
  */
  protected function getSfGuardUserProfile() {

  if (!$this->object->getSfGuardUserProfile()) {
    return new SfGuardUserProfile();
  }

  return $this->object->getSfGuardUserProfile();
  }

}
