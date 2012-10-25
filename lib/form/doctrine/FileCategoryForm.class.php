<?php

/**
 * FileCategory form.
 *
 * @package    lufy
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class FileCategoryForm extends BaseFileCategoryForm
{
  public function configure()
  {
    unset($this['created_at'], $this['updated_at'], $this['slug']);
    $this->widgetSchema['type'] = new sfWidgetFormChoice(array('choices' => array('Inconnu', 'Videos', 'Wallpapers', 'Replays')));
  }
}
