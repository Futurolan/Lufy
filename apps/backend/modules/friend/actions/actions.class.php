<?php

/**
 * friend actions.
 *
 * @package    lufy
 * @subpackage friend
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class friendActions extends BackendActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->friends = Doctrine::getTable('friend')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new friendForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new friendForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($friend = Doctrine::getTable('friend')->find(array($request->getParameter('user_id'),
                               $request->getParameter('friend_id'))), sprintf('Object friend does not exist (%s).', $request->getParameter('user_id'),
                               $request->getParameter('friend_id')));
    $this->form = new friendForm($friend);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($friend = Doctrine::getTable('friend')->find(array($request->getParameter('user_id'),
                               $request->getParameter('friend_id'))), sprintf('Object friend does not exist (%s).', $request->getParameter('user_id'),
                               $request->getParameter('friend_id')));
    $this->form = new friendForm($friend);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($friend = Doctrine::getTable('friend')->find(array($request->getParameter('user_id'),
                               $request->getParameter('friend_id'))), sprintf('Object friend does not exist (%s).', $request->getParameter('user_id'),
                               $request->getParameter('friend_id')));
    $friend->delete();

    $this->redirect('friend/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $friend = $form->save();

      $this->redirect('friend/edit?user_id='.$friend->getUserId().'&friend_id='.$friend->getFriendId());
    }
  }
}
