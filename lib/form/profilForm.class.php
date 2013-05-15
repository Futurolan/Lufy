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

    $this->mergeForm(new SfGuardUserProfileForm());
  }

}
