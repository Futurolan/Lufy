<?php

/**
 * comment actions.
 *
 * @package    lufy
 * @subpackage comment
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class commentActions extends BackendActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->comments = Doctrine::getTable('comment')
      ->createQuery('a')
      ->orderBy('created_at DESC')
      ->execute();
  }

  public function executeSwitchStatus(sfWebRequest $request)
  {
    $this->forward404Unless($comment = Doctrine::getTable('comment')->findOneByIdComment($request->getParameter('id_comment')));

    if ($comment->getStatus() == 1)
    {
      $comment->setStatus('0');
    }
    else
    {
      $comment->setStatus('1');
    }
    $comment->save();

    $this->redirect('news/comments?id_news='.$comment->getNewsId());

  }


  public function executeNew(sfWebRequest $request)
  {
    $this->form = new commentForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new commentForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($comment = Doctrine::getTable('comment')->find(array($request->getParameter('id_comment'))), sprintf('Object comment does not exist (%s).', $request->getParameter('id_comment')));
    $this->form = new commentForm($comment);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($comment = Doctrine::getTable('comment')->find(array($request->getParameter('id_comment'))), sprintf('Object comment does not exist (%s).', $request->getParameter('id_comment')));
    $this->form = new commentForm($comment);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $this->forward404Unless($comment = Doctrine::getTable('comment')->find(array($request->getParameter('id_comment'))), sprintf('Object comment does not exist (%s).', $request->getParameter('id_comment')));
    $comment->delete();

    $this->redirect('news/comments?id_news='.$comment->getNewsId());
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $comment = $form->save();

      $this->redirect('comment/edit?id_comment='.$comment->getIdComment());
    }
  }
}
