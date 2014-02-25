<?php

/**
 * plateform actions.
 *
 * @package    lufy
 * @subpackage plateform
 * @author     Guillaume Marsay
 * @version    Doctrine theme "lufy_backend"
 */

class plateformActions extends sfActions{

  public function executeIndex(sfWebRequest $request)
  {
    $this->plateforms = Doctrine_Core::getTable('Plateform')->findAll();
  }


  public function executeView(sfWebRequest $request)
  {
    $this->plateform = Doctrine_Core::getTable('Plateform')->find(array($request->getParameter('id_plateform')));
    $this->forward404Unless($this->plateform);
  }


  public function executeForm(sfWebRequest $request)
  {
    $this->form = new PlateformForm();

    if ($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT))
    {
      if ($request->hasParameter('id_plateform'))
      {
        $this->object = Doctrine_Core::getTable('Plateform')->findOneByIdPlateform($request->getParameter('id_plateform'));

        $this->form =  new PlateformForm($this->object);
      }

      $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));

      if ($this->form->isValid())
      {
        $object = $this->form->save();

        $this->getUser()->setFlash('success', 'Object has been updated.');

        $this->redirect('plateform/view?id_plateform='.$object->getIdPlateform());
      }
    }

    if ($request->hasParameter('id_plateform'))
    {
      $this->object = Doctrine_Core::getTable('Plateform')->findOneByIdPlateform($request->getParameter('id_plateform'));

      $this->form =  new PlateformForm($this->object);
    }
  }


  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($plateform = Doctrine_Core::getTable('Plateform')->find(array($request->getParameter('id_plateform'))), sprintf('Object plateform does not exist (%s).', $request->getParameter('id_plateform')));
    $plateform->delete();

    $this->getUser()->setFlash('success', 'Object has been deleted.');

    $this->redirect('plateform/index');
  }
}
