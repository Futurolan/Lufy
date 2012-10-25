<?php

/**
 * tournament actions.
 *
 * @package    lufy
 * @subpackage tournament
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class commentActions extends sfActions {

    public function preExecute() {
        if (!$this->getUser()->isAuthenticated()) {
            $this->redirect('@homepage');
        }
    }

    public function executeNew(sfWebRequest $request) {
        if ($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT)) {
            $comment = new comment();
            $comment->setNewsId($request->getPostParameter('comment[news_id]', ''));
            $comment->setUserId($request->getPostParameter('comment[user_id]', ''));
            $comment->setContent($request->getPostParameter('comment[content]', ''));
            $comment->save();
            $news = Doctrine_Core::getTable('news')->findOneByIdNews($request->getPostParameter('comment[news_id]', ''));
            $this->redirect('news/view?slug='.$news->getSlug());
        }
        else {
            $this->redirect('@homepage');
        }
    }
}

