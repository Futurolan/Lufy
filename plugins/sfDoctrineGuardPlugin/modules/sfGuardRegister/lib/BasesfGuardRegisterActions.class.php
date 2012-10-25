<?php

class BasesfGuardRegisterActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        if ($this->getUser()->isAuthenticated()) {
            $this->getUser()->setFlash('notice', 'You are already registered and signed in!');
            $this->redirect('@homepage');
        }

        $this->form = new sfGuardRegisterForm();

        if ($request->isMethod('post')) {
            $this->form->bind($request->getParameter($this->form->getName()));
            if ($this->form->isValid()) {
                $user = $this->form->save();

                // Ajout
                if ($user):
                    $verified = sha1($user->getFirstName() . $user->getLastName() . $user->getEmailAddress());
                    $link = 'http://www.gamers-assembly.net/fr/activate/' . $verified . $user->getId();
                endif;


                $mail = Doctrine::getTable('mail')->findOneByName('mail_user_new');
                $message = $this->getMailer()->compose();
                $message->setSubject($mail->getSubject());
                $message->setTo($user->getEmailAddress());
                $message->setFrom($mail->getEmail());
                $content = str_replace("%LINK%", $link, $mail->getContent());
                $content = str_replace("%PSEUDO%", $user->getUsername(), $content);
                $message->setBody($content);
                $this->getMailer()->send($message);
                //$this->getUser()->signIn($user);
                $this->getUser()->setFlash('success', 'Votre inscription a ete prise en compte, un mail contenant le lien de validation vous a ete envoye.');
                $this->redirect('user/success');
            }
        }
    }

}
