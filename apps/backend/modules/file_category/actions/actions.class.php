<?php

/**
 * file_category actions.
 *
 * @package    lufy
 * @subpackage file_category
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class file_categoryActions extends sfActions
{

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->file_categorys = Doctrine::getTable('fileCategory')
            ->createQuery('a')
            ->execute();
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeSwitchStatus(sfWebRequest $request)
  {
    $this->forward404Unless($file_category = Doctrine::getTable('fileCategory')->findOneByIdFileCategory($request->getParameter('id_file_category')));

    if ($file_category->getStatus() == 1)
    {
      $file_category->setStatus('0');
    }
    else
    {
      $file_category->setStatus('1');
    }
    $file_category->save();
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeNew(sfWebRequest $request)
  {
    $this->form = new fileCategoryForm();
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new fileCategoryForm();

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
    $this->forward404Unless($file_category = Doctrine::getTable('fileCategory')->find(array($request->getParameter('id_file_category'))), sprintf('Object file_category does not exist (%s).', $request->getParameter('id_file_category')));
    $this->form = new fileCategoryForm($file_category);
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($file_category = Doctrine::getTable('fileCategory')->find(array($request->getParameter('id_file_category'))), sprintf('Object file_category does not exist (%s).', $request->getParameter('id_file_category')));
    $this->form = new fileCategoryForm($file_category);

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

    $this->forward404Unless($file_category = Doctrine::getTable('fileCategory')->find(array($request->getParameter('id_file_category'))), sprintf('Object file_category does not exist (%s).', $request->getParameter('id_file_category')));
    $file_category->delete();

    $this->redirect('file_category/index');
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
      $file_category = $form->save();

      $this->redirect('file_category/edit?id_file_category=' . $file_category->getIdFileCategory());
    }
  }

}
