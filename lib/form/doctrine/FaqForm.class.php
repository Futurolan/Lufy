<?php

/**
 * Faq form.
 *
 * @package    lufy
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class FaqForm extends BaseFaqForm
{
  public function configure()
  {
    $this->widgetSchema['request'] = new sfWidgetFormTextarea();
    $this->widgetSchema['answer'] = new sfWidgetFormTextareaBB(array('buttons' => array('bold','italic','underline','link','quote','code','image','usize','dsize','back','forward','back_disable:\'btn back_disable\'','forward_disable:\'btn forward_disable\'','preview')));
    //$this->widgetSchema['answer'] = new sfWidgetFormTextarea();
    $this->widgetSchema['status'] = new sfWidgetFormChoice(array('choices' => array('Brouillon', 'Publi&eacute;')));
  }
}
