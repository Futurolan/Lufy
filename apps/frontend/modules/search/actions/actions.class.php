<?php

/**
 * search actions.
 *
 * @package    lufy
 * @subpackage search
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class searchActions extends FrontendActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    //$this->forward('default', 'module');
  }
  

  public function executeUser(sfWebRequest $request)
  {
    $this->form = new searchForm();

    if($this->processForm($request, 'search'))
    {
	$values = $this->form->getValues();
	$q = Doctrine::getTable('sfGuardUser')->searchQuery($values['pattern']);
	$this->users = $q->execute();

	return sfView::SUCCESS;
    }

    return 'Form';
  }


  protected function processForm(sfWebRequest $request, $parameterName)
  {
    if($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter($parameterName));
      if($this->form->isValid())
      {
	if(method_exists($this->form, 'save')) $this->form->save();

        return True;
      }
    }

    return False;
  }

  public function executeSearch(sfWebRequest $request)
  {
    if ($request->getParameter('query') != '')
    {
      $query = '%'.$request->getParameter('query').'%';

      $this->news = Doctrine_Query::create()
        ->select('n.title, n.content, n.status')
        ->from('news n')
        ->where('n.status = ?', 1)
        ->andWhere('n.content LIKE ?', $query)
        ->orWhere('n.title LIKE ?', $query)
        ->orderBy('created_at DESC')
        ->execute();

      $this->pages = Doctrine_Query::create()
        ->select('p.title, p.content, p.status')
        ->from('page p')
        ->where('p.status = ?', 1)
        ->andWhere('p.content LIKE ?', $query)
        ->orWhere('p.title LIKE ?', $query)
        ->orderBy('created_at DESC')
        ->execute();


      if ($request->isXmlHttpRequest())
      {
        if ('%%' != $query && strlen($query) >= 5)
        {
          return $this->renderPartial(
            'search/resultSearch',
            array(
              'news' => $this->news,
              'pages' => $this->pages,
            )
          );
        }
      }
    }
  }
}
