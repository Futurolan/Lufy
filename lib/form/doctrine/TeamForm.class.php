<?php

/**
 * Team form.
 *
 * @package    lufy
 * @subpackage form
 * @author     Guillaume Marsay
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class TeamForm extends BaseTeamForm
{
  public function configure()
  {
    unset($this['adminteam_id'], $this['created_at'], $this['updated_at'], $this['slug'], $this['locked']);

        $this->setWidget('country', new sfWidgetFormI18nChoiceCountry());

  }

}
