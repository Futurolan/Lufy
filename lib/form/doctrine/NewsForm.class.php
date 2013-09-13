<?php

/**
 * News form.
 *
 * @package    lufy
 * @subpackage form
 * @author     Guillaume Marsay
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class NewsForm extends BaseNewsForm
{
  public function configure()
  {
    unset($this['created_at'], $this['updated_at'], $this['slug']);

    $this->widgetSchema['user_id']->setDefault(sfContext::getInstance()->getUser()->getGuardUser()->getId());

    $users_list = Doctrine_Query::create()
        ->from('SfGuardUser u')
        ->where('u.id = '.sfContext::getInstance()->getUser()->getGuardUser()->getId())
        ->orWhere('u.is_super_admin = ?', '1');

    $this->widgetSchema['user_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SfGuardUser'), 'add_empty' => false, 'query' => $users_list));
    $this->widgetSchema['title'] = new sfWidgetFormInput(array(), array('size' => 43));
    $this->widgetSchema['summary'] = new sfWidgetFormTextarea(array(), array('cols' => 50));
    $this->widgetSchema['content'] = new sfWidgetFormTextareaBB(array(
      'buttons' => array('bold','italic','underline','link','quote','code','image','usize','dsize','back','forward','back_disable:\'btn back_disable\'','forward_disable:\'btn forward_disable\'','preview')
    ));
    $this->widgetSchema['status'] = new sfWidgetFormChoice(array('choices' => array('Brouillon', 'Publi&eacute;')));
    $this->widgetSchema['publish_on'] = new sfWidgetFormJQueryDateTime();
    $files = sfFinder::type('file')->maxdepth(0)->name('*')->relative()->in(sfConfig::get('sf_upload_dir').'/news/affiche');
    $logo[0] = '';
    foreach($files as $file)
      {
        $logo[$file] = $file;
      }

    $this->widgetSchema['image'] = new sfWidgetFormChoice(array('choices' => $logo));
  }
}
