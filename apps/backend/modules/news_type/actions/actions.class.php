<?php

/**
 * news_type actions.
 *
 * @package    lufy
 * @subpackage news_type
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class news_typeActions extends BackendActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->news_types = Doctrine::getTable('newsType')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new newsTypeForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new newsTypeForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($news_type = Doctrine::getTable('newsType')->find(array($request->getParameter('id_news_type'))), sprintf('Object news_type does not exist (%s).', $request->getParameter('id_news_type')));
    $this->form = new newsTypeForm($news_type);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($news_type = Doctrine::getTable('newsType')->find(array($request->getParameter('id_news_type'))), sprintf('Object news_type does not exist (%s).', $request->getParameter('id_news_type')));
    $this->form = new newsTypeForm($news_type);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($news_type = Doctrine::getTable('newsType')->find(array($request->getParameter('id_news_type'))), sprintf('Object news_type does not exist (%s).', $request->getParameter('id_news_type')));
    $news_type->delete();

    $this->redirect('news_type/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $news_type = $form->save();

      $this->redirect('news_type/index');
    }
  }
}
