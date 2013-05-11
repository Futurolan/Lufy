<?php

/**
 * upload actions.
 *
 * @package    lufy
 * @subpackage upload
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class uploadActions extends BackendActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->files = sfFinder::type('any')->maxdepth(2)->relative()->prune(array('gallery', 'assets'))->discard(array('gallery', 'assets'))->in(sfConfig::get('sf_upload_dir'));
  }
  
  public function executeNew(sfWebRequest $request)
  {
    $this->form = new uploadForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new uploadForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $upload = $form->save();

      $this->redirect('upload/index');
    }
  }
}
