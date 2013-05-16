<?php

/**
 * sfGuardUser form.
 *
 * @package    lufy
 * @subpackage form
 * @author     Guillaume Marsay
 * @version    SVN: $Id: sfDoctrinePluginFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfGuardUserForm extends PluginsfGuardUserForm
{
  public function configure()
  {
    $this->setValidator('firstname', new sfValidatorString(array('required' => true)));
    $this->setValidator('lastname', new sfValidatorString(array('required' => true)));
  }
}
