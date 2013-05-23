<?php

/**
 * event actions.
 *
 * @package    lufy
 * @subpackage event
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class eventActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->events = Doctrine::getTable('event')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new eventForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new eventForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($this->event = Doctrine::getTable('event')->find(array($request->getParameter('id_event'))), sprintf('Object event does not exist (%s).', $request->getParameter('id_event')));
    $this->form = new eventForm($this->event);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($event = Doctrine::getTable('event')->find(array($request->getParameter('id_event'))), sprintf('Object event does not exist (%s).', $request->getParameter('id_event')));
    $this->form = new eventForm($event);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($event = Doctrine::getTable('event')->find(array($request->getParameter('id_event'))), sprintf('Object event does not exist (%s).', $request->getParameter('id_event')));
    $event->delete();

    $this->redirect('event/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $event = $form->save();

      $this->redirect('event/edit?id_event='.$event->getIdEvent());
    }
  }
}
