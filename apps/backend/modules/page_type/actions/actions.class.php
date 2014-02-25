<?php

/**
 * page_type actions.
 *
 * @package    lufy
 * @subpackage page_type
 * @author     Guillaume Marsay
 * @version    Doctrine theme "lufy_backend"
 */

class page_typeActions extends sfActions{

  public function executeIndex(sfWebRequest $request)
  {
    $this->page_types = Doctrine_Core::getTable('PageType')->findAll();
  }


  public function executeView(sfWebRequest $request)
  {
    $this->page_type = Doctrine_Core::getTable('PageType')->find(array($request->getParameter('id_page_type')));
    $this->forward404Unless($this->page_type);
  }


  public function executeForm(sfWebRequest $request)
  {
    $this->form = new PageTypeForm();

    if ($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT))
    {
      if ($request->hasParameter('id_page_type'))
      {
        $this->object = Doctrine_Core::getTable('PageType')->findOneByIdPageType($request->getParameter('id_page_type'));

        $this->form =  new PageTypeForm($this->object);
      }

      $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));

      if ($this->form->isValid())
      {
        $object = $this->form->save();

        $this->getUser()->setFlash('success', 'Object has been updated.');

        $this->redirect('page_type/view?id_page_type='.$object->getIdPageType());
      }
    }

    if ($request->hasParameter('id_page_type'))
    {
      $this->object = Doctrine_Core::getTable('PageType')->findOneByIdPageType($request->getParameter('id_page_type'));

      $this->form =  new PageTypeForm($this->object);
    }
  }


  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($page_type = Doctrine_Core::getTable('PageType')->find(array($request->getParameter('id_page_type'))), sprintf('Object page_type does not exist (%s).', $request->getParameter('id_page_type')));
    $page_type->delete();

    $this->getUser()->setFlash('success', 'Object has been deleted.');

    $this->redirect('page_type/index');
  }
}
