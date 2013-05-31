<?php

/**
 * contact actions.
 *
 * @package    lufy
 * @subpackage contact
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contactActions extends FrontendActions
{

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executePresseAccred(sfWebRequest $request)
  {

  }


  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executePartner(sfWebRequest $request)
  {
    $this->form = new ContactPartnerForm();
  }


  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeSendcontactpartner(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));
    $form = new ContactPartnerForm();
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

    if ($form->isValid())
    {
      $destinataire = 'guillaume@futurolan.net';

      $contact = $request->getParameters('contactPartner');
      $auteur_nom = $contact['nom'];
      $auteur_prenom = $contact['prenom'];
      $auteur_email = $contact['email'];

      $auteur = $auteur_prenom . ' ' . $auteur_nom . (($auteur_email) ? ' (' . $auteur_email . ') ' : '');

      $plain = $auteur . ' a rempli le formulaire ci dessous sur le site Gamers Assembly le ' . date('d/m/Y H:i') . "\n\n" . str_repeat("--", 80) . "\n" .
              'Societe : ' . $contact['societe'] . "\n" .
              'Nom : ' . $contact['nom'] . "\n" .
              'Prenom : ' . $contact['prenom'] . "\n" .
              'Email : ' . $contact['email'] . "\n" .
              'Tel : ' . $contact['tel'] . "\n" .
              'Adresse : ' . $contact['adresse'] . "\n" .
              'Code postal : ' . $contact['cp'] . "\n" .
              'Ville : ' . $contact['ville'] . "\n" .
              'Pays : ' . $contact['pays'] . "\n" .
              'Message : ' . $contact['message'] . "\n" .
              str_repeat("--", 80) . "\n";
      $html = nl2br($plain);

      $message = $this->getMailer()->compose();
      $message->setSubject('Nouvelle proposition partenaire');
      $message->setTo($destinataire);
      $message->setFrom('noreply@futurolan.net');
      $message->setBody($plain);
      $this->getMailer()->send($message);
    }
    else
    {
      $this->form = new ContactPartnerForm($form);
      $this->setTemplate('partner');
    }
  }


  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeAidesOrgas(sfWebRequest $request)
  {
    $this->form = new ContactForm();
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeSendcontact(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));
    $form = new ContactForm();

    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $destinataire = sfConfig::get('app_destinataire_contact');

      $contact = $request->getParameter('contact');
      $auteur_nom = $contact['nom'];
      $auteur_prenom = $contact['prenom'];
      $auteur_email = $contact['email'];
      $auteur = $auteur_prenom . ' ' . $auteur_nom . (($auteur_email) ? ' (' . $auteur_email . ') ' : '');

      $plain = 'Le ' . date('d/m/Y H:i') . "<br/><br/>\n\n" .
              'Nom : ' . $contact['nom'] . "<br/>\n" .
              'Pr&eacute;nom : ' . $contact['prenom'] . "<br/>\n" .
              'Pseudo : ' . $contact['pseudo'] . "<br/>\n" .
              'Date naissance : ' . $contact['date_naissance']['day'] . '/' . $contact['date_naissance']['month'] . '/' . $contact['date_naissance']['year'] . "<br/>\n" .
              'Email : ' . $contact['email'] . "<br/>\n" .
              'T&eacute;l : ' . $contact['tel'] . "<br/>\n" .
              'Code postal : ' . $contact['cp'] . "<br/>\n" .
              'Ville : ' . $contact['ville'] . "<br/>\n" .
              'Arriv&eacute;e : ' . $contact['date_arrivee']['day'] . '/' . $contact['date_arrivee']['month'] . '/' . $contact['date_arrivee']['year'] . " &agrave; " . $contact['date_arrivee']['hour'] . ':' . $contact['date_arrivee']['minute'] . "<br/>\n" .
              'D&eacute;part : ' . $contact['date_depart']['day'] . '/' . $contact['date_depart']['month'] . '/' . $contact['date_depart']['year'] . " &agrave; " . $contact['date_depart']['hour'] . ':' . $contact['date_depart']['minute'] . "<br/>\n" .
              'H&eacute;bergement : ' . $contact['hebergement'] . "<br/><br/>\n\n" .
              'Poste : ' . $contact['postes'] . "<br/><br/>\n\n" .
              'Commentaires : ' . $contact['commentaires'] . "<br/><br/><br/>\n\n" .
              '<i style="color:#888;font-size:10px;">Mail envoy&eacute; depuis le formulaire aide orga.</i><br/>';
      $html = nl2br($plain);

      $message = $this->getMailer()->compose();
      $message->setSubject('Nouvelle proposition d\'aide orga (' . $contact['prenom'] . ' ' . $contact['nom'] . ')');
      $message->setTo($destinataire);
      $message->setFrom('noreply@gamers-assembly.net');
      $message->addReplyTo($contact['email']);
      $message->addCc('guillaume@futurolan.net');
      $message->addBcc('futurolan@gmail.com');
      $message->setBody($plain, 'text/html');
      $this->getMailer()->send($message);
      /*
        $connection = new Swift_Connection_NativeMail();
        $mailer = new Swift($connection);
        $sender= $auteur_email ? $auteur_email : "noreply@gamers-assembly.net";

        $message = new Swift_Message('Formulaire rempli sur le site Gamers Assembly');
        $message->setReplyTo($sender);
        $message->setReturnPath($sender);
        $message->attach(new Swift_Message_Part($html, 'text/html'));
        $message->attach(new Swift_Message_Part($plain, 'text/plain'));

        $mailer->send($message, $destinataire, $sender );

        $mailer->disconnect();
       */
    }
    else
    {
      $this->form = $form;
      $this->setTemplate('aidesOrgas');
    }
  }

}
