<?php

/**
 * mail actions.
 *
 * @package    lufy
 * @subpackage mail
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mailActions extends BackendActions
{

    public function executeIndex(sfWebRequest $request) {
        $this->mails = Doctrine::getTable('mail')
                        ->createQuery('a')
                        ->execute();
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new mailForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new mailForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($mail = Doctrine::getTable('mail')->find(array($request->getParameter('id_mail'))), sprintf('Object mail does not exist (%s).', $request->getParameter('id_mail')));
        $this->form = new mailForm($mail);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($mail = Doctrine::getTable('mail')->find(array($request->getParameter('id_mail'))), sprintf('Object mail does not exist (%s).', $request->getParameter('id_mail')));
        $this->form = new mailForm($mail);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($mail = Doctrine::getTable('mail')->find(array($request->getParameter('id_mail'))), sprintf('Object mail does not exist (%s).', $request->getParameter('id_mail')));
        $mail->delete();

        $this->redirect('mail/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $mail = $form->save();

            $this->redirect('mail/index');
        }
    }

    public function executeMajEmail(sfWebRequest $request) {
        $mails = Doctrine_Query::create()
                        ->from('mail')
                        ->execute();
        $email = Doctrine_Query::create()
                        ->from('varConfig')
                        ->where('name = "email_noreply"')
                        ->execute();

        foreach ($mails as $mail):
            Doctrine::getTable('mail')
                    ->updateEmail($mail->getName(), $email[0]->getValue());
        endforeach;
        $this->getUser()->setFlash('success', 'Les mails on bien ete mis a jours.');
        $this->redirect('mail/index');
    }

    public function executeTestmail(sfWebRequest $request) {
        $this->forward404Unless($mail = Doctrine::getTable('mail')->find(array($request->getParameter('id_mail'))), sprintf('Object mail does not exist (%s).', $request->getParameter('id_mail')));
        $y = Doctrine::getTable('sfGuardUser')->getUser($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
        $message = $this->getMailer()->compose();
        $message->setSubject($mail->getSubject());
        $message->setTo($y->getEmailAddress());
        $message->setFrom($mail->getEmail());
        $message->setBody($mail->getContent());
        $this->getMailer()->send($message);

        $this->getUser()->setFlash('success', 'Le mail vous a ete envoye.');
        $this->redirect('mail/index');
    }

}
