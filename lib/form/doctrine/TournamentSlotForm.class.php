<?php

/**
 * TournamentSlot form.
 *
 * @package    lufy
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class TournamentSlotForm extends BaseTournamentSlotForm
{
  public function configure()
  {
    unset($this['tournament_id'], $this['position'], $this['created_at'], $this['updated_at']);
        $this->widgetSchema['locked'] = new sfWidgetFormChoice(array('choices' => array('0' => 'Non', '1' => 'Oui')));
        $this->widgetSchema['status'] = new sfWidgetFormChoice(array('choices' => array('attente' => 'En attente', 'libre' => 'Libre', 'inscrit' => 'Inscrit', 'valide' => 'Valid&eacute;', 'reserve' => 'Reserv&eacute;')));
  }
}
