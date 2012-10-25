<?php

/**
 * Team form.
 *
 * @package    lufy
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class TeamForm extends BaseTeamForm
{
  public function configure()
  {
  unset($this['created_at'], $this['updated_at']);
  
  $this->setWidget['country'] = new sfWidgetFormI18nChoiceCountry(array('culture' => 'fr', 'countries' => array('FR', 'BE', 'ES', 'CH', 'DE', 'DK', 'PT', 'LU', 'NL', 'US', 'RU', 'PL', 'GB', 'IE'), 'add_empty' => true));
		
  }
}
