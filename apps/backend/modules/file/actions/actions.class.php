<?php

/**
 * file actions.
 *
 * @package    lufy
 * @subpackage file
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class fileActions extends sfActions
{

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeIndex(sfWebRequest $request)
  {
    /*    $this->file_categorys = Doctrine::getTable('fileCategory')
      ->createQuery('a')
      ->select('c.id_file_category, c.name, c.description')
      ->from('FileCategory c, File f')
      ->where('f.file_category_id = c.id_file_category')
      ->execute();
     */
    $this->file_categorys = Doctrine_Query::create()
            ->select('c.*, COUNT(f.id_file) as nb_file')
            ->from('FileCategory c')
            ->leftJoin('c.File f')
            ->groupBy('f.file_category_id')
            ->execute();
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeList(sfWebRequest $request)
  {
    $this->file_category = Doctrine::getTable('FileCategory')->findOneByIdFileCategory($request->getParameter('file_category'));
    $this->files = Doctrine::getTable('File')->findByFileCategoryId($request->getParameter('file_category'));
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
    exit;
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeNew(sfWebRequest $request)
  {
    $this->form = new fileForm();
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new fileForm();

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
    $this->forward404Unless($file = Doctrine::getTable('file')->find(array($request->getParameter('id_file'))), sprintf('Object file does not exist (%s).', $request->getParameter('id_file')));
    $this->form = new fileForm($file);
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($file = Doctrine::getTable('file')->find(array($request->getParameter('id_file'))), sprintf('Object file does not exist (%s).', $request->getParameter('id_file')));
    $this->form = new fileForm($file);

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

    $this->forward404Unless($file = Doctrine::getTable('file')->find(array($request->getParameter('id_file'))), sprintf('Object file does not exist (%s).', $request->getParameter('id_file')));
    $file->delete();

    $this->redirect('file/index');
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
      $file = $form->save();

      $this->redirect('file/edit?id_file=' . $file->getIdFile());
    }
  }

}
