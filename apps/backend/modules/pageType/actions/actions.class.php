<?php

/**
 * pageType actions.
 *
 * @package    lufy
 * @subpackage pageType
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pageTypeActions extends sfActions
{

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->pageTypes = Doctrine::getTable('pageType')
            ->createQuery('a')
            ->orderBy('label ASC')
            ->execute();
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeNew(sfWebRequest $request)
  {
    $this->form = new pageTypeForm();
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new pageTypeForm();

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
    $this->forward404Unless($pageType = Doctrine::getTable('pageType')->find(array($request->getParameter('id_page_type'))), sprintf('Object page_type does not exist (%s).', $request->getParameter('id_page_type')));
    $this->form = new pageTypeForm($pageType);
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($pageType = Doctrine::getTable('pageType')->find(array($request->getParameter('id_page_type'))), sprintf('Object page_type does not exist (%s).', $request->getParameter('id_page_type')));
    $this->form = new pageTypeForm($pageType);

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

    $this->forward404Unless($pageType = Doctrine::getTable('pageType')->find(array($request->getParameter('id_page_type'))), sprintf('Object page_type does not exist (%s).', $request->getParameter('id_page_type')));
    $pageType->delete();

    $this->redirect('pageType/index');
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
      $pageType = $form->save();

      $this->redirect('pageType/index');
    }
  }

}
