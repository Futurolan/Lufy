<?php

class commentComponents extends sfComponents
{

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeNbCommentByNews(sfWebRequest $request)
  {
    $comments = Doctrine::getTable('Comment')->findByNewsId($this->news_id);
    $this->nb_comments = count($comments);
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeNbCommentByNewsLight(sfWebRequest $request)
  {
    $comments = Doctrine::getTable('Comment')->findByNewsId($this->news_id);
    $this->nb_comments = count($comments);
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeComments(sfWebRequest $request)
  {
    if ($this->getUser()->isAuthenticated())
    {
      $this->auth = true;
      $this->form = new newCommentForm();
      if ($request->isMethod(sfRequest::POST))
      {
        $this->processFormComment($request, $this->form);
        $this->redirect('page/views?slug=' . $news->getSlug());
      }
    }
    else
    {
      $this->auth = '0';
    };
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  protected function processFormComment(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $comment = $form->save();
      $comment->setNewsId($idnews);
      $comment->setUserId($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
      $comment->save();
      $this->getUser()->setFlash('success', 'Le commentaire a bien ete poste.');
      $this->redirect('test/views?slug=' . $slugnews);
    }
    $this->getUser()->setFlash('error', 'Le commentaire n\'a pas ete poste.');
  }

}
