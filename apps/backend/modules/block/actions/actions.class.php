<?php

/**
 * block actions.
 *
 * @package    lufy
 * @subpackage block
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class blockActions extends sfActions
{

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->blocks = Doctrine_Core::getTable('block')
            ->createQuery('a')
            ->orderBy('position')
            ->execute();
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeNew(sfWebRequest $request)
  {
    $this->form = new blockForm();
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new blockForm();

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
    $this->forward404Unless($block = Doctrine_Core::getTable('block')->find(array($request->getParameter('id_block'))), sprintf('Object block does not exist (%s).', $request->getParameter('id_block')));
    $this->form = new blockForm($block);
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($block = Doctrine_Core::getTable('block')->find(array($request->getParameter('id_block'))), sprintf('Object block does not exist (%s).', $request->getParameter('id_block')));
    $this->form = new blockForm($block);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeUpdatePosition(sfWebRequest $request)
  {
    $block = new Block();
    $block->updatePosition($request->getPostParameter('block'));
    $this->getUser()->setFlash('success', 'L\'ordre des encarts a ete mis a jour.');
    $this->redirect('block/index');
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeSetStatus(sfWebRequest $request)
  {
    $id_block = $request->getParameter('id_block');
    $block = Doctrine::getTable('block')->findOneByIdBlock($id_block);
    $this->forward404Unless($block);
    if ($block->getIsActive() == 1):
      $block->setHidden($id_block);
    else:
      $block->setVisible($id_block);
    endif;
    $this->getUser()->setFlash('success', 'Le statut a été modifié.');
    $this->redirect('block/index');
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($block = Doctrine_Core::getTable('block')->find(array($request->getParameter('id_block'))), sprintf('Object block does not exist (%s).', $request->getParameter('id_block')));
    $block->delete();

    $this->redirect('block/index');
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
      $block = $form->save();

      $this->redirect('block/index');
      //$this->redirect('block/edit?id_block='.$block->getIdBlock());
    }
  }

}
