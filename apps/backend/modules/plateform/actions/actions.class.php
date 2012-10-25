<?php

/**
 * plateform actions.
 *
 * @package    lufy
 * @subpackage plateform
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class plateformActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->plateforms = Doctrine::getTable('plateform')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new plateformForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new plateformForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($plateform = Doctrine::getTable('plateform')->find(array($request->getParameter('id_plateform'))), sprintf('Object plateform does not exist (%s).', $request->getParameter('id_plateform')));
    $this->form = new plateformForm($plateform);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($plateform = Doctrine::getTable('plateform')->find(array($request->getParameter('id_plateform'))), sprintf('Object plateform does not exist (%s).', $request->getParameter('id_plateform')));
    $this->form = new plateformForm($plateform);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($plateform = Doctrine::getTable('plateform')->find(array($request->getParameter('id_plateform'))), sprintf('Object plateform does not exist (%s).', $request->getParameter('id_plateform')));
    $plateform->delete();

    $this->redirect('plateform/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $plateform = $form->save();

      $this->redirect('plateform/edit?id_plateform='.$plateform->getIdPlateform());
    }
  }
}
