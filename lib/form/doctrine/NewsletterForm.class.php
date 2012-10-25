<?php

/**
 * Newsletter form.
 *
 * @package    lufy
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class NewsletterForm extends BaseNewsletterForm
{
    public function configure()
  {
    unset($this['created_at'], $this['updated_at'], $this['recipient']);
    $this->widgetSchema['content'] = new sfWidgetFormTextareaBB(array('buttons' => array('bold','italic','underline','link','quote','code','image','usize','dsize','back','forward','back_disable:\'btn back_disable\'','forward_disable:\'btn forward_disable\'','preview')));
  }
}
