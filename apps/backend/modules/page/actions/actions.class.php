<?php

/**
 * page actions.
 *
 * @package    lufy
 * @subpackage page
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pageActions extends sfActions
{

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeIndex(sfWebRequest $request)
  {
    /*    $this->pages = Doctrine::getTable('page')
      ->createQuery('a')
      ->orderBy('title ASC')
      ->where('status != 2')
      ->execute();
     */
    $this->pages = Doctrine_Query::create()
            ->select('p.title, p.slug, p.status, c.label')
            ->from('Page p')
            ->leftJoin('p.PageType c')
            ->where('p.status != 2')
            ->orderBy('title ASC')
            ->execute();
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeArchived(sfWebRequest $request)
  {
    /*
      $this->pages = Doctrine::getTable('page')
      ->createQuery('a')
      ->orderBy('title ASC')
      ->where('status = 2')
      ->execute();
     */
    $this->pages = Doctrine_Query::create()
            ->select('p.title, p.slug, p.status, c.label')
            ->from('Page p')
            ->leftJoin('p.PageType c')
            ->where('p.status != 2')
            ->orderBy('title ASC')
            ->execute();
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeArchive(sfWebRequest $request)
  {
    $page = Doctrine::getTable('Page')->findOneByIdPage($request->getParameter('id_page'));
    $page->setStatus('2');
    $page->save();
    $this->getUser()->setFlash('info', 'La page a ete archive.');
    $this->redirect('page/index');
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeUnarchive(sfWebRequest $request)
  {
    $page = Doctrine::getTable('Page')->findOneByIdPage($request->getParameter('id_page'));
    $page->setStatus('0');
    $page->save();
    $this->getUser()->setFlash('info', 'La page a ete desarchive.');
    $this->redirect('page/archived');
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeNew(sfWebRequest $request)
  {
    $this->form = new pageForm();
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new pageForm();

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
    $page = Doctrine::getTable('page')->findOneBySlug($request->getParameter('slug'));
    if (!$page && substr($request->getParameter('slug'), -3, 3) == '-en')
    {
      $slug_fr = substr($request->getParameter('slug'), 0, -3);
      $page = Doctrine::getTable('page')->findOneBySlug($slug_fr);
      if ($page)
      {
        $new_page = new Page();
        $new_page->setTitle($page->getTitle());
        $new_page->setContent($page->getContent());
        $new_page->setPublishOn($page->getPublishOn());
        $new_page->setPageTypeId($page->getPageTypeId());
        $new_page->setStatus('0');
        $new_page->setSlug($page->getSlug() . '-en');
        $new_page->save();
      }
      $this->redirect('page/edit?slug=' . $new_page->getSlug());
    }
    $this->forward404Unless($page);
    $this->form = new pageForm($page);
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($page = Doctrine::getTable('page')->find(array($request->getParameter('id_page'))), sprintf('Object page does not exist (%s).', $request->getParameter('id_page')));
    $this->form = new pageForm($page);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeDuplicate(sfWebRequest $request)
  {
    $page = Doctrine::getTable('page')->findOneByIdPage(array($request->getParameter('id_page')));

    $new_page = new Page();
    $new_page->setTitle('Copie de ' . $page->getTitle());
    $new_page->setContent($page->getContent());
    $new_page->setPublishOn($page->getPublishOn());
    $new_page->setPageTypeId($page->getPageTypeId());
    $new_page->setStatus('0');
    $new_page->setSlug('copie-de-' . $page->getSlug());
    $new_page->save();

    $this->redirect('page/edit?slug=' . $new_page->getSlug());
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($page = Doctrine::getTable('page')->find(array($request->getParameter('id_page'))), sprintf('Object page does not exist (%s).', $request->getParameter('id_page')));
    $page->delete();

    $this->getUser()->setFlash('info', 'La page a ete supprime.');
    $this->redirect('page/index');
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
      $page = $form->save();

      $this->getUser()->setFlash('success', 'Les modifications sur la page ont ete enregistre.');
      $this->redirect('page/index');
    }
  }

}
