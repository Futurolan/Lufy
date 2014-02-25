<?php

/**
 * news_type actions.
 *
 * @package    lufy
 * @subpackage news_type
 * @author     Guillaume Marsay
 * @version    Doctrine theme "lufy_backend"
 */

class news_typeActions extends sfActions{

  public function executeIndex(sfWebRequest $request)
  {
    $this->news_types = Doctrine_Core::getTable('NewsType')->findAll();
  }


  public function executeView(sfWebRequest $request)
  {
    $this->news_type = Doctrine_Core::getTable('NewsType')->find(array($request->getParameter('id_news_type')));
    $this->forward404Unless($this->news_type);
  }


  public function executeForm(sfWebRequest $request)
  {
    $this->form = new NewsTypeForm();

    if ($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT))
    {
      if ($request->hasParameter('id_news_type'))
      {
        $this->object = Doctrine_Core::getTable('NewsType')->findOneByIdNewsType($request->getParameter('id_news_type'));

        $this->form =  new NewsTypeForm($this->object);
      }

      $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));

      if ($this->form->isValid())
      {
        $object = $this->form->save();

        $this->redirect('news_type/view?id_news_type='.$object->getIdNewsType());
      }
    }

    if ($request->hasParameter('id_news_type'))
    {
      $this->object = Doctrine_Core::getTable('NewsType')->findOneByIdNewsType($request->getParameter('id_news_type'));

      $this->form =  new NewsTypeForm($this->object);
    }
  }


  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($news_type = Doctrine_Core::getTable('NewsType')->find(array($request->getParameter('id_news_type'))), sprintf('Object news_type does not exist (%s).', $request->getParameter('id_news_type')));
    $news_type->delete();

    $this->redirect('news_type/index');
  }
}
