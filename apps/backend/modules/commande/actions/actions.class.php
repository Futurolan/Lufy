<?php

/**
 * commande actions.
 *
 * @package    lufy
 * @subpackage commande
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class commandeActions extends sfActions
{

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->commandes = Doctrine::getTable('commande')
            ->createQuery('a')
            ->execute();
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeNew(sfWebRequest $request)
  {
    $this->form = new commandeForm();
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new commandeForm();

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
    $this->forward404Unless($commande = Doctrine::getTable('commande')->find(array($request->getParameter('id_commande'))), sprintf('Object commande does not exist (%s).', $request->getParameter('id_commande')));
    $this->form = new commandeForm($commande);
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($commande = Doctrine::getTable('commande')->find(array($request->getParameter('id_commande'))), sprintf('Object commande does not exist (%s).', $request->getParameter('id_commande')));
    $this->form = new commandeForm($commande);

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

    $this->forward404Unless($commande = Doctrine::getTable('commande')->find(array($request->getParameter('id_commande'))), sprintf('Object commande does not exist (%s).', $request->getParameter('id_commande')));
    $commande->delete();

    $this->redirect('commande/index');
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
      $commande = $form->save();

      $this->redirect('commande/edit?id_commande=' . $commande->getIdCommande());
    }
  }

}
