<?php

/**
 * ticket actions.
 *
 * @package    lufy
 * @subpackage ticket
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ticketActions extends sfActions
{

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->tickets = Doctrine::getTable('ticket')
            ->createQuery('a')
            ->where('parent_id IS NULL')
            ->execute();
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeView(sfWebRequest $request)
  {
    $this->ticket = Doctrine::getTable('ticket')->findOneById($request->getParameter('id'));
    $this->replys = Doctrine::getTable('ticket')->findByParentId($request->getParameter('id'));
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ticketForm();
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ticketForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($ticket = Doctrine::getTable('ticket')->find(array($request->getParameter('id'))), sprintf('Object ticket does not exist (%s).', $request->getParameter('id')));
    $this->form = new ticketForm($ticket);
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($ticket = Doctrine::getTable('ticket')->find(array($request->getParameter('id'))), sprintf('Object ticket does not exist (%s).', $request->getParameter('id')));
    $this->form = new ticketForm($ticket);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($ticket = Doctrine::getTable('ticket')->find(array($request->getParameter('id'))), sprintf('Object ticket does not exist (%s).', $request->getParameter('id')));
    $ticket->delete();

    $this->redirect('ticket/index');
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $ticket = $form->save();

      $this->redirect('ticket/index');
    }
  }

}
