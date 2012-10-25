<?php

/**
 * File form.
 *
 * @package    lufy
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class FileForm extends BaseFileForm
{
  public function configure()
  {
    unset($this['position'], $this['created_at'], $this['updated_at'], $this['slug']);
    $this->widgetSchema['status'] = new sfWidgetFormChoice(array('choices' => array('Prive', 'Publique')));
  }
}
