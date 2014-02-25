<?php

/**
 * event actions.
 *
 * @package    lufy
 * @subpackage event
 * @author     Guillaume Marsay
 * @version    Doctrine theme "lufy_backend"
 */

class eventActions extends sfActions{

  public function executeIndex(sfWebRequest $request)
  {
    $this->events = Doctrine_Core::getTable('Event')->findAll();
  }


  public function executeView(sfWebRequest $request)
  {
    $this->event = Doctrine_Core::getTable('Event')->find(array($request->getParameter('id_event')));
    $this->forward404Unless($this->event);
  }


  public function executeForm(sfWebRequest $request)
  {
    $this->form = new EventForm();

    if ($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT))
    {
      if ($request->hasParameter('id_event'))
      {
        $this->object = Doctrine_Core::getTable('Event')->findOneByIdEvent($request->getParameter('id_event'));

        $this->form =  new EventForm($this->object);
      }

      $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));

      if ($this->form->isValid())
      {
        $object = $this->form->save();

        $this->redirect('event/view?id_event='.$object->getIdEvent());
      }
    }

    if ($request->hasParameter('id_event'))
    {
      $this->object = Doctrine_Core::getTable('Event')->findOneByIdEvent($request->getParameter('id_event'));

      $this->form =  new EventForm($this->object);
    }
  }


  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($event = Doctrine_Core::getTable('Event')->find(array($request->getParameter('id_event'))), sprintf('Object event does not exist (%s).', $request->getParameter('id_event')));
    $event->delete();

    $this->redirect('event/index');
  }
}
