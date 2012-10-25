<?php

/**
 * PokerTournament form.
 *
 * @package    lufy
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PokerTournamentForm extends BasePokerTournamentForm
{
  public function configure()
  {
    $this->widgetSchema['description'] = new sfWidgetFormTextarea(array(), array('cols' => 60, 'rows' => 5));
    $this->widgetSchema['start_at'] = new sfWidgetFormJQueryDateTime();
    $this->widgetSchema['end_at'] = new sfWidgetFormJQueryDateTime();
    $this->widgetSchema['is_active'] = new sfWidgetFormChoice(array('choices' => array('Cach&eacute;', 'Visible')));
    $files = sfFinder::type('file')->maxdepth(0)->name('*')->relative()->in(sfConfig::get('sf_upload_dir').'/jeux/icones');
    $logo[0] = '';
    foreach($files as $file)
      {
        
        $logo[$file] = $file;
      }
    $this->widgetSchema['image'] = new sfWidgetFormChoice(array('choices' => $logo));
  }
}
