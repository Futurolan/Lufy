<?php

/**
 * AddTeam form base class.
 *
 * @method TeamPlayer getObject() Returns the current form's model object
 *
 * @package    lufy
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
class editTeamForm extends BaseTeamForm {

    public function configure() {
        unset($this['adminteam_id'], $this['created_at'], $this['updated_at'], $this['slug'], $this['locked']);

		$this->setWidget['name'] = new sfWidgetFormInput(array(), array('maxlength' => '30'));
		$this->setWidget['tag'] = new sfWidgetFormInput(array(), array('maxlength' => '6', 'size' => '7'));
        $this->setWidget['country'] = new sfWidgetFormI18nChoiceCountry(array('culture' => 'fr', 'countries' => array('FR', 'BE', 'ES', 'CH', 'DE', 'DK', 'PT', 'LU', 'NL', 'US', 'RU', 'PL', 'GB', 'IE'), 'add_empty' => true));
		$this->setWidget['description'] = new sfWidgetFormTextarea(array(), array('rows' => '6', 'cols' => '50'));
		$this->setWidget['website'] = new sfWidgetFormInput(array(), array('maxlength' => '250', 'size' => '50'));
		$this->setWidget['logourl'] = new sfWidgetFormInput(array(), array('maxlength' => '250', 'size' => '50'));
		

    }

}

