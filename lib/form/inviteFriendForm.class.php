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
class inviteFriendForm extends BaseInviteForm {

    public function configure() {
        unset($this['team_id'], $this['response'], $this['created_at'], $this['updated_at']);
    }

}

