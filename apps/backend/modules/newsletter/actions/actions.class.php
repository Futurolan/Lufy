<?php

/**
 * newsletter actions.
 *
 * @package    lufy
 * @subpackage newsletter
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class newsletterActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->newsletters = Doctrine::getTable('newsletter')
                        ->createQuery('a')
                        ->execute();
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new newsletterForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new newsletterForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($newsletter = Doctrine::getTable('newsletter')->find(array($request->getParameter('id_newsletter'))), sprintf('Object newsletter does not exist (%s).', $request->getParameter('id_newsletter')));
        $this->form = new newsletterForm($newsletter);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($newsletter = Doctrine::getTable('newsletter')->find(array($request->getParameter('id_newsletter'))), sprintf('Object newsletter does not exist (%s).', $request->getParameter('id_newsletter')));
        $this->form = new newsletterForm($newsletter);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($newsletter = Doctrine::getTable('newsletter')->find(array($request->getParameter('id_newsletter'))), sprintf('Object newsletter does not exist (%s).', $request->getParameter('id_newsletter')));
        $newsletter->delete();

        $this->redirect('newsletter/index');
    }

    public function executePublish(sfWebRequest $request) {
        $this->forward404Unless($newsletter = Doctrine::getTable('newsletter')->find(array($request->getParameter('id_newsletter'))), sprintf('Object newsletter does not exist (%s).', $request->getParameter('id_newsletter')));
        $this->form = new filtresdiffForm($newsletter);
    }

    public function executeSend(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($newsletter = Doctrine::getTable('newsletter')->find(array($request->getParameter('id_newsletter'))), sprintf('Object newsletter does not exist (%s).', $request->getParameter('id_newsletter')));
        $this->form = new filtresdiffForm($newsletter);

        $this->processSend($request, $this->form);

        $this->setTemplate('publish');
    }

    protected function processSend(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $newsletter = $form->save();

            if ($newsletter->getRecipient() == 'tout_le_monde'):

                $q = Doctrine :: getTable('sfGuardUser')
                                ->getAllEmail();
                foreach ($q as $user):
                    $message = $this->getMailer()->compose();
                    $message->setSubject($newsletter->getSubject());
                    $message->setTo($user->getEmailAddress());
                    $message->setFrom('newsletter@gamersassembly.net');
                    $message->setBody($newsletter->getContent());
                    $this->getMailer()->send($message);
                endforeach;

            elseif ($newsletter->getRecipient() == 'toutes_les_team_des_tournois'):

                $q = Doctrine :: getTable('sfGuardUser')
                                ->getInscritsEmail();

                foreach ($q as $user):
                    $message = $this->getMailer()->compose();
                    $message->setSubject($newsletter->getSubject());
                    $message->setTo($user->getEmailAddress());
                    $message->setFrom('newsletter@gamersassembly.net');
                    $message->setBody($newsletter->getContent());
                    $this->getMailer()->send($message);
                endforeach;

            elseif ($newsletter->getRecipient() == 'tous_les_capitaines'):

                $q = Doctrine :: getTable('sfGuardUser')
                                ->getCaptainsEmail();
                $r = Doctrine :: getTable('sfGuardUser')
                                ->getTeams();

                foreach ($q as $user):
                    $message = $this->getMailer()->compose();
                    $message->setSubject($newsletter->getSubject());
                    $message->setTo($user->getSfGuardUser()->getEmailAddress());
                    $message->setFrom('newsletter@gamersassembly.net');
                    $message->setBody($newsletter->getContent());
                    $this->getMailer()->send($message);
                endforeach;
                foreach ($r as $team):

                    $done = 0;
                    foreach ($q as $users):
                        $user = Doctrine :: getTable('sfGuardUser')
                                ->getUser($team->getAdminteamId());
                        if ($user->getEmailAddress() == $users->getSfGuardUser()->getEmailAddress()){
                            $done++;
                        }
                    endforeach;
                    if ($done == 0):
                    $message = $this->getMailer()->compose();
                    $message->setSubject($newsletter->getSubject());
                    $message->setTo($user->getEmailAddress());
                    $message->setFrom('newsletter@gamersassembly.net');
                    $message->setBody($newsletter->getContent());
                    $this->getMailer()->send($message);
                    endif;
                endforeach;

            elseif ($newsletter->getRecipient() == 'tous_les_joueurs'):

                $q = Doctrine :: getTable('sfGuardUser')
                                ->getPlayerEmail();
                foreach ($q as $user):
                    $message = $this->getMailer()->compose();
                    $message->setSubject($newsletter->getSubject());
                    $message->setTo($user->getEmailAddress());
                    $message->setFrom('newsletter@gamersassembly.net');
                    $message->setBody($newsletter->getContent());
                    $this->getMailer()->send($message);
                endforeach;

            endif;


            $this->getUser()->setFlash('success', 'La newsletter a bien ete envoye.');
            $this->redirect('newsletter/index');
        }
        $this->getUser()->setFlash('success', 'Formulaire invalide');
        $this->redirect('newsletter/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $newsletter = $form->save();

            $this->redirect('newsletter/index');
        }
    }

}
