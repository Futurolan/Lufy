<?php

/**
 * file_type actions.
 *
 * @package    lufy
 * @subpackage file_type
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class file_typeActions extends sfActions
{

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->file_types = Doctrine::getTable('fileType')
            ->createQuery('a')
            ->orderBy('name ASC')
            ->execute();
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeNew(sfWebRequest $request)
  {
    $this->form = new fileTypeForm();
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new fileTypeForm();

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
    $this->forward404Unless($file_type = Doctrine::getTable('fileType')->find(array($request->getParameter('id_file_type'))), sprintf('Object file_type does not exist (%s).', $request->getParameter('id_file_type')));
    $this->form = new fileTypeForm($file_type);
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($file_type = Doctrine::getTable('fileType')->find(array($request->getParameter('id_file_type'))), sprintf('Object file_type does not exist (%s).', $request->getParameter('id_file_type')));
    $this->form = new fileTypeForm($file_type);

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

    $this->forward404Unless($file_type = Doctrine::getTable('fileType')->find(array($request->getParameter('id_file_type'))), sprintf('Object file_type does not exist (%s).', $request->getParameter('id_file_type')));
    $file_type->delete();

    $this->redirect('file_type/index');
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
      $file_type = $form->save();

      $this->redirect('file_type/edit?id_file_type=' . $file_type->getIdFileType());
    }
  }

}
