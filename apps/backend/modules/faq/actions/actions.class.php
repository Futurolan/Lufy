<?php

/**
 * faq actions.
 *
 * @package    lufy
 * @subpackage faq
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class faqActions extends BackendActions
{
    public function executeIndex(sfWebRequest $request) {
        $this->faqs = Doctrine::getTable('faq')
                        ->createQuery('a')
                        ->orderBy('position ASC')
                        ->execute();
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new faqForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new faqForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($faq = Doctrine::getTable('faq')->find(array($request->getParameter('id_faq'))), sprintf('Object faq does not exist (%s).', $request->getParameter('id_faq')));
        $this->form = new faqForm($faq);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($faq = Doctrine::getTable('faq')->find(array($request->getParameter('id_faq'))), sprintf('Object faq does not exist (%s).', $request->getParameter('id_faq')));
        $this->form = new faqForm($faq);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

  public function executeUpdatePosition(sfWebRequest $request)
  {
    $faq = new Faq();
    $faq->updatePosition($request->getPostParameter('faq'));
    $this->getUser()->setFlash('success', 'L\'ordre des questions a ete mis a jour.');
    $this->redirect('faq/index');
  }
  
  public function executeSetStatus(sfWebRequest $request)
  {
    $id_faq = $request->getParameter('id_faq');
    $faq = Doctrine::getTable('faq')->findOneByIdFaq($id_faq);
    $this->forward404Unless($faq);
    if ($faq->getStatus() == 1):
      $faq->setHidden($id_faq);
    else:
      $faq->setVisible($id_faq);
    endif;
    $this->getUser()->setFlash('success', 'Le statut a été modifié.');
    $this->redirect('faq/index');
  }
  
    
    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($faq = Doctrine::getTable('faq')->find(array($request->getParameter('id_faq'))), sprintf('Object faq does not exist (%s).', $request->getParameter('id_faq')));
        $faq->delete();

        $this->redirect('faq/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $faq = $form->save();

            $this->redirect('faq/index');
        }
    }

}
