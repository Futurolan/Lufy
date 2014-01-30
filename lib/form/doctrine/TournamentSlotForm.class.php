<?php

/**
 * TournamentSlot form.
 *
 * @package    lufy
 * @subpackage form
 * @author     Guillaume Marsay
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class TournamentSlotForm extends BaseTournamentSlotForm
{
  public function configure()
  {
    unset($this['tournament_id'], $this['created_at'], $this['updated_at']);
  }
}
