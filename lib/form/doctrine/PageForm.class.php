<?php

/**
 * Page form.
 *
 * @package    lufy
 * @subpackage form
 * @author     Guillaume Marsay
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PageForm extends BasePageForm
{
  public function configure()
  {
        unset($this['created_at'], $this['updated_at']);
        $this->widgetSchema['title']->setAttributes(array('size' => '50'));
        $this->widgetSchema['slug']->setAttributes(array('size' => '50'));
        $this->widgetSchema['content'] = new sfWidgetFormTextarea(array(), array('style' => 'width: 850px; height: 500px;'));


//              $this->widgetSchema['texte'] = new sfWidgetFormTextareaTinyMCE( array('config' => 'file_browser_callback: kfm_for_tiny_mce') );



        $this->widgetSchema['status'] = new sfWidgetFormChoice(array('choices' => array('Brouillon', 'Publi&eacute;', 'Archiv&eacute;')));
        $this->widgetSchema['publish_on'] = new sfWidgetFormJQueryDateTime();

        $this->widgetSchema->setDefaults(array( 'publish_on' => date('Y-m-d H:i')));
  }
}
