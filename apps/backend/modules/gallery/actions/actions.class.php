<?php

/**
 * gallery actions.
 *
 * @package    lufy
 * @subpackage gallery
 * @author     Guillaume Marsay <guillaume@futurolan.net>
 */
class galleryActions extends sfActions
{

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->galleries = Doctrine::getTable('gallery')
            ->createQuery('a')
            ->orderBy('title ASC')
            ->execute();
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeNew(sfWebRequest $request)
  {
    $this->form = new galleryForm();
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new galleryForm();

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
    $this->forward404Unless($gallery = Doctrine::getTable('gallery')->find(array($request->getParameter('id_gallery'))), sprintf('Object file_type does not exist (%s).', $request->getParameter('id_gallery')));
    $this->form = new galleryForm($gallery);
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($gallery = Doctrine::getTable('gallery')->find(array($request->getParameter('id_gallery'))), sprintf('Object file_type does not exist (%s).', $request->getParameter('id_gallery')));
    $this->form = new galleryForm($gallery);

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

    $this->forward404Unless($gallery = Doctrine::getTable('gallery')->find(array($request->getParameter('id_gallery'))), sprintf('Object file_type does not exist (%s).', $request->getParameter('id_gallery')));
    $gallery->delete();

    $this->redirect('gallery/index');
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
      $gallery = $form->save();

      $this->redirect('gallery/edit?id_gallery=' . $gallery->getIdGallery());
    }
  }

}
