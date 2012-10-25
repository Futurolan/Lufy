<?php

/**
 * Team filter form.
 *
 * @package    lufy
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class TeamFormFilter extends BaseTeamFormFilter
{
  public function configure()
  {
    unset($this['created_at'], $this['updated_at'], $this['adminteam_id'], $this['description'], $this['logourl'], $this['website']);

    $this->widgetSchema['tag'] = new sfWidgetFormFilterInput(array('with_empty' => false));
    $this->widgetSchema['country'] = new sfWidgetFormFilterInput(array('with_empty' => false));
    $this->widgetSchema['slug'] = new sfWidgetFormFilterInput(array('with_empty' => false));
  }
}
