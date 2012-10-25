<?php

/**
 * news actions.
 *
 * @package    lufy
 * @subpackage news
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class newsActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->pager = new sfDoctrinePager('News', '8');
	if ($this->getUser()->getCulture() == 'en')
	{
	        $this->pager->setQuery(Doctrine::getTable('News')
			->createQuery('a')
			->where('slug LIKE "%-en"')
			->andWhere('status=1')
			->orderBy('publish_on DESC'));
	}
	else {
                $this->pager->setQuery(Doctrine::getTable('News')
                        ->createQuery('a')
                        ->where('slug NOT LIKE "%-en"')
                        ->andWhere('status=1')
                        ->orderBy('publish_on DESC'));
        }

        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
    }

    public function executeView(sfWebRequest $request) {
        $this->news = Doctrine::getTable('news')->findOneBySlug($request->getParameter('slug', ''));
        $this->forward404Unless($this->news);
        $this->response->setTitle($this->news->title);

       $this->commentForm = new commentForm();
       $this->user = $this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser');

       $this->comments = doctrine_query::create()
                        ->from('comment')
                        ->where('news_id = ' . $this->news->getIdNews())
                        ->execute();
    }

}
