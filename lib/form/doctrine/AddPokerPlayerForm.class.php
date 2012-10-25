<?php

/**
 *  AddPokerPlayer form.
 *
 * @package    lufy
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AddPokerPlayerForm extends BasePokerTournamentPlayerForm
{
  public function configure()
  {
  unset($this['user_id'],$this['poker_tournement_id'],$this['created_at'], $this['updated_at']);
  }
}
