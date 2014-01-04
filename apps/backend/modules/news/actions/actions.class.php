<?php

/**
 * news actions.
 *
 * @package    lufy
 * @subpackage news
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class newsActions extends sfActions
{

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->pager = new sfDoctrinePager('news', '10');
    /*
      $this->pager->setQuery(Doctrine::getTable('News')
      ->createQuery('a')
      ->orderBy('publish_on DESC'));
     */
    $this->pager->setQuery(Doctrine_Query::create()
                    ->select('n.*, t.*')
                    ->from('News n')
                    ->leftJoin('n.NewsType t')
                    ->groupBy('n.id_news')
                    ->orderBy('n.publish_on DESC')
    );


    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executePreview(sfWebRequest $request)
  {
    $this->forward404Unless($this->news = Doctrine::getTable('news')->findOneByIdNews($request->getParameter('id_news')));
    $this->setLayout('popup');
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeSwitchStatus(sfWebRequest $request)
  {
    $this->forward404Unless($news = Doctrine::getTable('news')->findOneByIdNews($request->getParameter('id_news')));

    if ($news->getStatus() == 1)
    {
      $news->setStatus('0');
    }
    else
    {
      $news->setStatus('1');
    }
    $news->save();
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeSet(sfWebRequest $request)
  {
    $news = Doctrine::getTable('News')->findOneByIdNews($request->getParameter('id_news'));
    $this->forward404Unless($news);
    if (substr($news->getSlug(), -3, 3) == '-en')
    {
      if ($request->getParameter('lang') == 'fr')
      {
        $news->setSlug(substr($news->getSlug(), 0, -3));
        $news->save();
      }
    }
    else
    {
      if ($request->getParameter('lang') == 'en')
      {
        $news->setSlug($news->getSlug() . '-en');
        $news->save();
      }
    }
    $this->redirect('news/index');
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeNew(sfWebRequest $request)
  {
    $news = new News();
    $now = new DateTime;
    $now = $now->format('Y-m-d H:i:s');
    $last_type = DOctrine_Core::getTable('NewsType')->createQuery('n')->orderBy('id_news_type DESC')->limit(1)->execute();
    $news->setPublishOn($now);
    $news->setUserId($this->getUser()->getGuardUser()->getId());
    $news->setNewsType($last_type[0]);
    $this->form = new newsForm($news);
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new newsForm();

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
    $this->forward404Unless($this->news = Doctrine::getTable('news')->find(array($request->getParameter('id_news'))), sprintf('Object news does not exist (%s).', $request->getParameter('id_news')));
    $this->form = new newsForm($this->news);
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($news = Doctrine::getTable('news')->find(array($request->getParameter('id_news'))), sprintf('Object news does not exist (%s).', $request->getParameter('id_news')));
    $this->form = new newsForm($news);

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

    $this->forward404Unless($news = Doctrine::getTable('news')->find(array($request->getParameter('id_news'))), sprintf('Object news does not exist (%s).', $request->getParameter('id_news')));
    $comments = Doctrine::getTable('comment')->findByNewsId($request->getParameter('id_news'));
    foreach ($comments as $comment):
      $comment->delete();
    endforeach;
    $news->delete();

    $this->redirect('news/index');
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
      $news = $form->save();

      $this->redirect('news/edit?id_news=' . $news->getIdNews());
    }
  }

}
