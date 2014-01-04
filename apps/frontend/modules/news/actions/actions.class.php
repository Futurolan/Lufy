<?php

/**
 * news actions.
 *
 * @package    lufy
 * @subpackage news
 * @author     Guillaume Marsay <guillaume@futurolan.Net>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class newsActions extends FrontendActions
{

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->pager = new sfDoctrinePager('News', '20');
    if ($this->getUser()->getCulture() == 'en')
    {
      $this->pager->setQuery(Doctrine_Query::create()
                      ->select('n.title, n.publish_on, n.slug, nt.logourl')
                      ->from('News n')
                      ->leftJoin('n.NewsType nt')
                      ->where('n.slug LIKE "%-en"')
                      ->andWhere('n.status = 1')
                      ->andWhere('n.publish_on < NOW()')
                      ->groupBy('n.id_news')
                      ->orderBy('n.publish_on DESC'));
    }
    else
    {
      $this->pager->setQuery(Doctrine_Query::create()
                      ->select('n.title, n.publish_on, n.slug, nt.logourl')
                      ->from('News n')
                      ->leftJoin('n.NewsType nt')
                      ->where('n.slug NOT LIKE "%-en"')
                      ->andWhere('n.status = 1')
                      ->andWhere('n.publish_on < NOW()')
                      ->groupBy('n.id_news')
                      ->orderBy('n.publish_on DESC'));
    }

    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeView(sfWebRequest $request)
  {
    $this->news = Doctrine::getTable('news')->findOneBySlug($request->getParameter('slug', ''));
    $this->forward404Unless($this->news);

    $this->response->setTitle($this->news->title);
  }
}
