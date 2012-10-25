<?php

/**
 * TournamentAdmin form.
 *
 * @package    lufy
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class TournamentAdminForm extends BaseTournamentAdminForm {

    public function configure() {
        $this->widgetSchema['user_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'SfGuardUser', 'add_empty' => true));
    }

}
