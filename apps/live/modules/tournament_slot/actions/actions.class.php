<?php

/**
 * tournament_slot actions.
 *
 * @package    lufy
 * @subpackage tournament_slot
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tournament_slotActions extends sfActions
{

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeIndex(sfWebRequest $request)
  {
    if (!$this->getUser()->isAuthenticated())
    {
      $this->redirect('main/index');
    }

    $q = Doctrine::getTable('sfGuardUser')->isCaptain();
    $a = Doctrine::getTable('sfGuardUser')->isAdmin();
    $this->droits = '0';
    if ($q || $a)
    {
      $this->droits = '1';
    }

    $c = Doctrine::getTable('sfGuardUser')->isPlayer();
    $this->player = '0';
    if ($c)
    {
      $this->player = '1';
    }

    $this->user = Doctrine::getTable('sfGuardUser')->findOneById($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
    if ($this->user->getLicenceMasters())
    {
      $mfjv = new mfjv();
      $result = $mfjv->check($this->user->getLicenceMasters());
      if ($result)
      {
        // La requete a abouti et la licence est valide,
        // on peut donc exploiter les resultats
        $this->licencetype = $result->type;
        $this->licenceused = $result->used;
      }
    }

    $teamplayers = Doctrine::getTable('teamPlayer')->findOneByUserId($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
    $b = Doctrine::getTable('team')->isAlreadyInTournament();

    if ($b)
    {
      $this->tournamentslot = Doctrine::getTable('tournamentSlot')->findOneByTeamId($teamplayers->getTeamId());
      $this->tournament = Doctrine::getTable('tournament')->findOneByIdTournament($this->tournamentslot->getTournamentId());

      $teamplayer = new TeamPlayer();

      $this->countplayer = $teamplayer->countPlayer($teamplayers->getTeamId());
      if ($this->countplayer == 0)
      {
        $this->getUser()->setFlash('error', 'Vous devez ajouter des joueurs dans votre equipe.');
        $this->redirect('team/index');
      }

      $this->countTournamentPlayer = $this->tournament->getPlayerPerTeam();

      $this->commande = Doctrine::getTable('commande')->findOneByTournamentSlotId($this->tournamentslot->getIdTournamentSlot());
      $this->payment = doctrine::getTable('payement')->findByCommandeId($this->commande->getIdCommande());
      foreach ($this->payment as $thispayment)
      {
        if ($thispayment->getIsValid() == 1 || $thispayment->getIsPaypal() == 0)
        {
          $this->payments = 1;
        }
      }

      if (count($this->payment) == 0 || $this->payments != 1)
      {
        $this->payments = 0;
      }
      else
      {
        $this->payments = 1;
      }

      $this->priceinitial = $this->tournament->getPlayerPerTeam() * $this->tournament->getCostPerPlayer();

      /* Calcul le nombre de licences stockee dans commande.reduction et applique la reduction. */
      if ($this->commande->getReduction())
      {
        $licences = explode(';', $this->commande->getReduction());
        $n = count($licences);
        $this->reduction = $n * -5;
        for ($i = 0; $i < $n; $i++)
        {
          if ($this->commande->getReduction() == $licences[$i])
          {
            $this->alreadyused = 1;
          }
        }
      }
      else
      {
        $this->reduction = 0;
      }
      $this->pricefinal = $this->priceinitial + $this->reduction;
      /*       * ******** */
      if ($this->commande->getReduction())
      {
        $this->reduction = $this->commande->getReduction();
      }
      else
      {
        $this->reduction = Doctrine::getTable('teamPlayer')->getReductions($teamplayers->getTeamId());
      }

      if (substr($this->tournament->getSlug(), -8, 0) != '-masters')
      {
        $this->reduction = 0;
      }

      $this->pricefinal = $this->priceinitial - $this->reduction;
      //$this->varconfig = Doctrine::getTable('varConfig')->findOneByName('inscription_mode');
      $this->varconfig = 'ffa';
    }
    else
    {
      $this->getUser()->setFlash('warning', 'L\'equipe n\'est pas inscrite a un tournoi');
      $this->redirect('team/index');
    }
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeInsertTeam(sfWebRequest $request)
  {
    $teamplayers = Doctrine::getTable('teamPlayer')->findOneByUserId($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
    $tournament = Doctrine::getTable('Tournament')->findOneBySlug($request->getParameter('slug', ''));
    $this->forward404Unless($tournament);

    if ($this->getUser()->isAuthenticated())
    {

      $q = Doctrine::getTable('sfGuardUser')
              ->isCaptain();
      $a = Doctrine::getTable('sfGuardUser')
              ->isAdmin();
      if ($q == true || $a == true)
      {
        $droits = '1';
      }
      else
      {
        $droits = '0';
      };
      $event = Doctrine::getTable('Event')->findOneByIdEvent($tournament->getEventId());
      $maintenant = date("Y-m-d H:i:s");
      if ($event->getStartRegistrationAt() < $maintenant):
        if ($maintenant < $event->getEndRegistrationAt()):


          if ($droits == '1')
          {


            $tournamentslots = Doctrine_Query::create()
                    ->select('*')
                    ->from('tournamentSlot')
                    ->where('team_id = ' . $teamplayers->getTeamId())
                    ->execute();
            if (count($tournamentslots) == 1)
            {
              $this->getUser()->setFlash('error', 'La Team est deja inscrite a un tournoi');
              $this->redirect('tournament_slot/index');
            };
            $mode_ins = Doctrine::getTable('varConfig')->findOneByName('inscription_mode');
            $q = Doctrine::getTable('tournamentSlot')
                    ->slotLibre($tournament->getIdTournament());

            $commande = new Commande();
            $commande->setItemName('inscription tournoi');
            $price = $tournament->getPlayerPerTeam() * $tournament->getCostPerPlayer();
            $commande->setAmount($price);
            if ($mode_ins['value'] == 'rotation'):
              if (count($q) == '0')
              {
                $o = Doctrine::getTable('tournamentSlot')
                        ->addSlot($tournament->getIdTournament());
                Doctrine::getTable('tournamentSlot')
                        ->setTeam($o, $teamplayers->getTeamId());
                $commande->setTournamentSlotId($o);
              }
              else
              {
                Doctrine::getTable('tournamentSlot')
                        ->setTeam($q[0]->getIdTournamentSlot(), $teamplayers->getTeamId());
                Doctrine::getTable('tournamentSlot')
                        ->setInscrit($q[0]->getIdTournamentSlot());
                $commande->setTournamentSlotId($q[0]->getIdTournamentSlot());
              };
            elseif ($mode_ins['value'] == 'ffa'):
              $o = Doctrine::getTable('tournamentSlot')
                      ->addSlot($tournament->getIdTournament());
              Doctrine::getTable('tournamentSlot')
                      ->setTeam($o, $teamplayers->getTeamId());
              $commande->setTournamentSlotId($o);
            endif;

            ;
            $commande->save();

            $this->getUser()->setFlash('success', 'La Team est inscrite au tournoi');
            $players = Doctrine_Query::create()
                    ->from('teamplayer')
                    ->where('team_id = ' . $teamplayers->getTeamId())
                    ->execute();


            $team = Doctrine::getTable('team')->findOneByIdTeam($teamplayers->getTeamId());
            $mail = Doctrine::getTable('mail')->findOneByName('mail_slot_insert');
            foreach ($players as $player):
              $message = $this->getMailer()->compose();
              $message->setSubject($mail->getSubject());
              $message->setTo($player->getSfGuardUser()->getEmailAddress());
              $message->setFrom($mail->getEmail());
              $content = str_replace("%TEAM%", $team->getName(), $mail->getContent());
              $content = str_replace("%TOURNAMENT%", $tournament->getName(), $content);
              $message->setBody($content);
              $this->getMailer()->send($message);
            endforeach;

            $this->redirect('tournament_slot/index');
          } else
          {
            $this->getUser()->setFlash('error', 'Vous n\'avez pas les droits.');
            $this->redirect('tournament_slot/index');
          };
        else:
          $this->getUser()->setFlash('warning', 'Les inscriptions ne sont pas ouvertes actuellement');
          $this->redirect('user/index');
        endif;
      else:
        $this->getUser()->setFlash('warning', 'Les inscriptions ne sont pas ouvertes actuellement');
        $this->redirect('user/index');
      endif;
    }
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeList(sfWebRequest $request)
  {
    $l = Doctrine::getTable('event')
            ->getLastEvent();

    $this->tournaments = Doctrine_Query::create()
            ->select('*')
            ->from('tournament t, event e')
            ->where('e.id_event = t.event_id')
            ->andWhere('e.id_event = ' . $l)
            ->execute();
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeLeaveTournament(sfWebRequest $request)
  {
    $admin = Doctrine::getTable('sfGuardUser')
            ->isAdmin();
    if ($admin == true)
    {
      $l = Doctrine::getTable('tournamentSlot')
              ->getTournamentSlot($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
      $this->forward404Unless($l);

      $team_id = $l->getTeamId();
      $commande = Doctrine::getTable('commande')->findOneByTournamentSlotId($l->getIdTournamentSlot());
      $commande->getPayement()->delete();
      $commande->delete();
      $tournament = Doctrine_Core::getTable('tournament')->findOneByIdTournament($l->getTournamentId());
      Doctrine::getTable('tournamentSlot')
              ->setLibre($l->getIdTournamentSlot());
      $q = Doctrine::getTable('tournamentSlot')
              ->getTournament($l->getTournamentId());
      // $q retourne l'objet 'tournament' associé au slot du tournoi
      $slots = Doctrine_Query::create()
              ->from('tournamentSlot')
              ->where('tournament_id = ' . $q->getIdTournament())
              ->orderBy('position ASC')
              ->execute();
      // on selectionne tout les slots de ce tournoi
      $pos = 0;
      // voici la moulinette pour remettre les slots dans l'ordre
      foreach ($slots as $slot):
        if ($slot->getStatus() == 'reserve'):
          $pos++;
          Doctrine::getTable('tournamentSlot')
                  ->setPosition($pos, $slot->getIdTournamentSlot());
        endif;
      endforeach;
      foreach ($slots as $slot):
        if ($slot->getStatus() == 'valide'):
          $pos++;
          Doctrine::getTable('tournamentSlot')
                  ->setPosition($pos, $slot->getIdTournamentSlot());
        endif;
      endforeach;
      /* Deprecie. Utilise pour le mode d'inscriptio 'rotation'
       * L'ensemble du code n'a jamais fonctionne correctementet provoque des validations automatique
        foreach ($slots as $slot):
        if ($slot->getStatus() == 'inscrit'):
        $pos++;
        Doctrine::getTable('tournamentSlot')
        ->setPosition($pos, $slot->getIdTournamentSlot());
        endif;
        endforeach;
       */
      foreach ($slots as $slot):
        if ($slot->getStatus() == 'attente'):
          $pos++;
          if ($pos <= $tournament->getNumberTeam()):
            Doctrine::getTable('tournamentSlot')
                    ->setInscrit($slot->getIdTournamentSlot());
          endif;
          Doctrine::getTable('tournamentSlot')
                  ->setPosition($pos, $slot->getIdTournamentSlot());
        endif;
      endforeach;
      foreach ($slots as $slot):
        if ($slot->getStatus() == 'libre'):
          $pos++;
          if ($pos > $tournament->getNumberTeam()):
            $slot->delete();
          else:
            Doctrine::getTable('tournamentSlot')
                    ->setPosition($pos, $slot->getIdTournamentSlot());

          endif;

        endif;
      endforeach;

      $this->getUser()->setFlash('success', 'Votre equipe a bien quitte le tournoi.');
      $players = Doctrine_Query::create()
              ->from('teamplayer')
              ->where('team_id = ' . $team_id)
              ->execute();

      $team = Doctrine::getTable('team')->findOneByIdTeam($team_id);
      $mail = Doctrine::getTable('mail')->findOneByName('mail_slot_leave');
      foreach ($players as $player):
        $message = $this->getMailer()->compose();
        $message->setSubject($mail->getSubject());
        $message->setTo($player->getSfGuardUser()->getEmailAddress());
        $message->setFrom($mail->getEmail());
        $content = str_replace("%TEAM%", $team->getName(), $mail->getContent());
        $content = str_replace("%TOURNAMENT%", $q->getName(), $content);
        $message->setBody($content);
        $this->getMailer()->send($message);
      endforeach;
      if ($l->Tournament->getPlayerPerTeam() == 1)
      {
        $zqsdteamplayer = Doctrine_Core::getTable('teamPlayer')->findOneByUserId($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
        $zqsdteamplayer->delete();
        $l->getTeam()->delete();
        $this->getUser()->setFlash('success', 'Vous avez ete desinscrit du tournoi ' . $l->Tournament->getName());
        $this->redirect('user/index');
      }
    }
    elseif ($admin == false)
    {
      $this->getUser()->setFlash('error', 'Vous devez etre l\'admin de la team pour effectuer cette action');
    }
    $this->redirect('tournament_slot/index');
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeCheque(sfWebRequest $request)
  {

    $this->userinfo = Doctrine::getTable('sfGuardUser')->findOneById($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));


    // verification du nombre de joueurs et des infos de ces derniers
    $teamplayers = Doctrine::getTable('teamPlayer')->findOneByUserId($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
    $this->team = $teamplayers->getTeam();



    $c = Doctrine::getTable('tournamentSlot')
            ->countPlayer($teamplayers['team_id']);
    $t = Doctrine::getTable('tournamentSlot')
            ->getTournamentSlot($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
    $tournament = Doctrine::getTable('tournamentSlot')
            ->getTournament($t->getIdTournamentSlot());

    if ($c != $t->getTournament()->getPlayerPerTeam())
    {
      $this->getUser()->setFlash('error', 'La Team n\'a pas le bon nombre de player');
      $this->redirect('tournament_slot/index');
    };
    $p = Doctrine_Query::create()
            ->from('teamPlayer')
            ->where('team_id = ' . $teamplayers['team_id'])
            ->andWhere('is_player = 1')
            ->execute();
    foreach ($p as $player):
      if ($player->getSfGuardUser()->getFirstName() == NULL || $player->getSfGuardUser()->getLastName() == NULL || $player->getSfGuardUser()->getUsername() == NULL || $player->getSfGuardUser()->getEmailAddress() == NULL || $player->getSfGuardUser()->getAddress() == NULL || $player->getSfGuardUser()->getZipcode() == NULL || $player->getSfGuardUser()->getCity() == NULL || $player->getSfGuardUser()->getCountry() == NULL || $player->getSfGuardUser()->getPhone() == NULL || $player->getSfGuardUser()->getBirthdate() == NULL):
        $this->getUser()->setFlash('error', 'Le joueur ' . $player->getSfGuardUser()->getUsername() . ' n\'a pas remplis correctement sa fiche profile');
        $this->redirect('tournament_slot/index');
      endif;
    endforeach;
    // fin de verif

    $l = Doctrine::getTable('tournamentSlot')
            ->getTournamentSlot($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
    $this->tournament = Doctrine::getTable('tournament')->findOneByIdTournament($l->getTournamentId());
    $this->commande = Doctrine::getTable('commande')->findOneByTournamentSlotId($l->getIdTournamentSlot());


    if ($this->commande->getReduction()):
      $reduction = $this->commande->getReduction();
    else:
      $reduction = Doctrine::getTable('teamPlayer')->getReductions($teamplayers->getTeamId());
    endif;

    if (substr($this->tournament->getSlug(), -8, 0) != '-masters')
    {
      $reduction = 0;
    }

    $this->price = $this->tournament->getPlayerPerTeam() * $this->tournament->getCostPerPlayer() - $reduction;
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executePaypal(sfWebRequest $request)
  {

    $this->userinfo = Doctrine::getTable('sfGuardUser')->findOneById($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));

    // verification du nombre de joueurs et des infos de ces derniers
    $teamplayers = Doctrine::getTable('teamPlayer')->findOneByUserId($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
    $c = Doctrine::getTable('tournamentSlot')
            ->countPlayer($teamplayers['team_id']);
    $t = Doctrine::getTable('tournamentSlot')
            ->getTournamentSlot($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));

    if ($c != $t->getTournament()->getPlayerPerTeam())
    {
      $this->getUser()->setFlash('error', 'La Team n\'a pas le bon nombre de player');
      $this->redirect('tournament_slot/index');
    };
    $p = Doctrine_Query::create()
            ->from('teamPlayer')
            ->where('team_id = ' . $teamplayers['team_id'])
            ->andWhere('is_player = 1')
            ->execute();
    foreach ($p as $player):
      if ($player->getSfGuardUser()->getFirstName() == NULL || $player->getSfGuardUser()->getLastName() == NULL || $player->getSfGuardUser()->getUsername() == NULL || $player->getSfGuardUser()->getEmailAddress() == NULL || $player->getSfGuardUser()->getAddress() == NULL || $player->getSfGuardUser()->getZipcode() == NULL || $player->getSfGuardUser()->getCity() == NULL || $player->getSfGuardUser()->getCountry() == NULL || $player->getSfGuardUser()->getPhone() == NULL || $player->getSfGuardUser()->getBirthdate() == NULL):
        $this->getUser()->setFlash('error', 'Le joueur ' . $player->getSfGuardUser()->getUsername() . ' n\'a pas remplis correctement sa fiche profile');
        $this->redirect('tournament_slot/index');
      endif;
    endforeach;
    // fin de verif

    $l = Doctrine::getTable('tournamentSlot')
            ->getTournamentSlot($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
    $this->tournament = Doctrine::getTable('tournament')->findOneByIdTournament($l->getTournamentId());
    $this->commande = Doctrine::getTable('commande')->findOneByTournamentSlotId($l->getIdTournamentSlot());


    if ($this->commande->getReduction()):
      $reduction = $this->commande->getReduction();
    else:
      $reduction = Doctrine::getTable('teamPlayer')->getReductions($teamplayers->getTeamId());
    endif;

    if (substr($this->tournament->getSlug(), -8, 0) != '-masters')
    {
      $reduction = 0;
    }

    $this->price = $this->tournament->getPlayerPerTeam() * $this->tournament->getCostPerPlayer() - $reduction;
    $this->pricettc = $this->price;

    Doctrine::getTable('payement')->insertPrepayment(
            $this->commande->getIdCommande(), $this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'), $this->pricettc
    );
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executePaymentCheque(sfWebRequest $request)
  {
    $o = Doctrine::getTable('tournamentSlot')
            ->getTournamentSlot($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
    $tournament = Doctrine::getTable('tournament')->findOneByIdTournament($o->getTournamentId());
    $commande = Doctrine::getTable('commande')->findOneByTournamentSlotId($o->getIdTournamentSlot());
    $reduction = Doctrine::getTable('teamPlayer')->getReductions($o->getTeamId());
    if (substr($tournament->getSlug(), -8, 0) != '-masters')
    {
      $reduction = 0;
    }
    Doctrine::getTable('commande')->setReduction($commande->getIdCommande(), $reduction);
    $payment_amount = $tournament->getPlayerPerTeam() * $tournament->getCostPerPlayer() - $reduction;
    $payment_currency = 'euros';
    Doctrine::getTable('payement')
            ->insertPaymentCheque($commande->getIdCommande(), $this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'), $payment_amount, $payment_currency);
    $this->getUser()->setFlash('success', 'Votre demande de paiement par cheque a bien ete prise en compte. A la reception du cheque votre inscription sera valide.');
    $y = Doctrine::getTable('sfGuardUser')->getUser($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
    $mail = Doctrine::getTable('mail')->findOneByName('mail_payment_cheque');
    $message = $this->getMailer()->compose();
    $message->setSubject($mail->getSubject());
    $message->setTo($y->getEmailAddress());
    $message->setFrom($mail->getEmail());
    $content = str_replace("%TEAM%", $o->getTeam()->getName(), $mail->getContent());
    $content = str_replace("%TTC%", $payment_amount, $content);
    $content = str_replace("%REDUCTION%", $reduction, $content);
    $message->setBody($content);
    $this->getMailer()->send($message);
    $this->redirect('tournament_slot/index');
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executePayment(sfWebRequest $request)
  {
    // DEBUG
    $maildebug = $this->getMailer()->compose();
    $maildebug->setSubject('GA DEBUG::Validation');
    $maildebug->setTo('gmarsay@gmail.com');
    $maildebug->setFrom('gmarsay@gmail.com');
    $maildebug->setBody('etape 0');
    $this->getMailer()->send($maildebug);

    // lire le formulaire provenant du systeme PayPal et ajouter 'cmd'
    $req = 'cmd=_notify-validate';

    foreach ($request->getPostParameters() as $key => $value)
    {
      $value = urlencode(stripslashes($value));
      $req .= "&$key=$value";
    }

    // DEBUG
    $maildebug = $this->getMailer()->compose();
    $maildebug->setSubject('GA DEBUG::Validation');
    $maildebug->setTo('gmarsay@gmail.com');
    $maildebug->setFrom('gmarsay@gmail.com');
    $maildebug->setBody('etape 1');
    $this->getMailer()->send($maildebug);

// renvoyer au systeme PayPal pour validation
    $header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
    $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
    $header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
    $fp = fsockopen('www.paypal.com', 80, $errno, $errstr, 30);
//recuperation des donnees
    $item_name = $request->getPostParameter('item_name', '');
    $item_number = $request->getPostParameter('item_number', '');
    $payment_status = $request->getPostParameter('payment_status', '');
    $payment_amount = $request->getPostParameter('mc_gross', '');
    $payment_currency = $request->getPostParameter('mc_currency', '');
    $txn_id = $request->getPostParameter('txn_id', '');
    $receiver_email = $request->getPostParameter('receiver_email', '');
    $payer_email = $request->getPostParameter('payer_email', '');
    $id_user = $request->getPostParameter('custom', '');

    // DEBUG
    $maildebug = $this->getMailer()->compose();
    $maildebug->setSubject('GA DEBUG::Validation');
    $maildebug->setTo('gmarsay@gmail.com');
    $maildebug->setFrom('gmarsay@gmail.com');
    $maildebug->setBody('etape 2');
    $this->getMailer()->send($maildebug);

    if (!$fp)
    {

    }
    else
    {
      fputs($fp, $header . $req);
      while (!feof($fp))
      {
        $res = fgets($fp, 1024);
        if (strcmp($res, "VERIFIED") == 0)
        {
          if ($payment_status == "Completed")
          {
            // DEBUG
            $maildebug = $this->getMailer()->compose();
            $maildebug->setSubject('GA DEBUG::Validation');
            $maildebug->setTo('gmarsay@gmail.com');
            $maildebug->setFrom('gmarsay@gmail.com');
            $maildebug->setBody('etape 3 - ' . $receiver_email);
            $this->getMailer()->send($maildebug);

            // vÃ¯erifier que txn_id n'a pas ete precedemment traite: Creez une fonction qui va interroger votre base de donnees
            //if (VerifIXNID($txn_id) == 0) {
            if ("paypal@futurolan.net" == $receiver_email)
            {
              // verifier que payment_amount et payment_currency sont corrects
              // INSERT dans la table payement
              // DEBUG
              $maildebug = $this->getMailer()->compose();
              $maildebug->setSubject('GA DEBUG::Validation');
              $maildebug->setTo('gmarsay@gmail.com');
              $maildebug->setFrom('gmarsay@gmail.com');
              $maildebug->setBody('etape 4');
              $this->getMailer()->send($maildebug);

              $o = Doctrine::getTable('tournamentSlot')
                      ->getTournamentSlot($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
              $commande = Doctrine::getTable('commande')->findOneByTournamentSlotId($o->getIdTournamentSlot());
              $reduction = Doctrine::getTable('teamPlayer')->getReductions($o->getTeamId());
              Doctrine::getTable('commande')->setReduction($commande->getIdCommande(), $reduction);

              Doctrine::getTable('payement')
                      ->insertPayment($commande->getIdCommande(), $this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'), $txn_id, $payment_amount, $payment_currency);
              //Verification du prix / de ce qui a ete paye
              $teamplayers = Doctrine::getTable('teamPlayer')->findOneByUserId($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
              $this->tournamentslots = Doctrine_Query::create()
                      ->select('*')
                      ->from('tournamentSlot')
                      ->where('team_id = ' . $teamplayers['team_id'])
                      ->execute();
              $this->tournament = Doctrine_Query::create()
                      ->select('*')
                      ->from('tournament')
                      ->where('id_tournament = ' . $this->tournamentslots[0]->getTournamentId())
                      ->execute();
              $this->price = $this->tournament[0]->getPlayerPerTeam() * $this->tournament[0]->getCostPerPlayer() - $reduction;
              $this->pricettc = $this->price;
              // DEBUG
              $maildebug = $this->getMailer()->compose();
              $maildebug->setSubject('GA DEBUG::Validation');
              $maildebug->setTo('gmarsay@gmail.com');
              $maildebug->setFrom('gmarsay@gmail.com');
              $maildebug->setBody('etape 5');
              $this->getMailer()->send($maildebug);

              $payments = Doctrine_Query::create()
                      ->select('amount')
                      ->from('payement')
                      ->where('tournament_slot_id = ' . $this->tournamentslots[0]->getIdTournamentSlot())
                      ->execute();

              // DEBUG
              $maildebug = $this->getMailer()->compose();
              $maildebug->setSubject('GA DEBUG::Validation');
              $maildebug->setTo('gmarsay@gmail.com');
              $maildebug->setFrom('gmarsay@gmail.com');
              $maildebug->setBody('etape 6');
              $this->getMailer()->send($maildebug);

              foreach ($payments as $payment)
              {
                $this->paid = $payment->getAmount() + $this->paid;
              };
              // Comparaison de ce qui a ete et ce qui doit etre paye
              if ($this->paid == $this->pricettc)
              {
                Doctrine::getTable('tournamentSlot')
                        ->setValideAndPaid($o);
                $slots = Doctrine_Query::create()
                        ->from('tournamentSlot')
                        ->where('tournament_id = ' . $this->tournamentslots[0]->getTournamentId())
                        ->orderBy('position ASC')
                        ->execute();
                $pos = 0;
                foreach ($slots as $slot):
                  if ($slot->getStatus() == 'reserve'):
                    $pos++;
                    Doctrine::getTable('tournamentSlot')
                            ->setPosition($pos, $slot->getIdTournamentSlot());
                  endif;
                endforeach;
                foreach ($slots as $slot):
                  if ($slot->getStatus() == 'valide'):
                    $pos++;
                    Doctrine::getTable('tournamentSlot')
                            ->setPosition($pos, $slot->getIdTournamentSlot());
                  endif;
                endforeach;
                /* Deprecie. Utilise pour la mode d'inscription 'rotation'
                 * L'emsemble du code ne fonctionne pas, ne surtout pas utilise
                  foreach ($slots as $slot):
                  if ($slot->getStatus() == 'inscrit'):
                  $pos++;
                  Doctrine::getTable('tournamentSlot')
                  ->setPosition($pos, $slot->getIdTournamentSlot());
                  endif;
                  endforeach;
                 * */
                foreach ($slots as $slot):
                  if ($slot->getStatus() == 'libre'):
                    $pos++;
                    Doctrine::getTable('tournamentSlot')
                            ->setPosition($pos, $slot->getIdTournamentSlot());
                  endif;
                endforeach;
                foreach ($slots as $slot):
                  if ($slot->getStatus() == 'attente'):
                    $pos++;
                    Doctrine::getTable('tournamentSlot')
                            ->setPosition($pos, $slot->getIdTournamentSlot());
                  endif;
                endforeach;
                $y = Doctrine::getTable('sfGuardUser')->getUser($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
                $mail = Doctrine::getTable('mail')->findOneByName('mail_payment_paypal');
                $message = $this->getMailer()->compose();
                $message->setSubject($mail->getSubject());
                $message->setTo($y->getEmailAddress());
                $message->setFrom($mail->getEmail());
                $content = str_replace("%TRANSACTION%", $txn_id, $mail->getContent());
                $content = str_replace("%TTC%", $payment_amount, $content);
                $content = str_replace("%REDUCTION%", $reduction, $content);
                $message->setBody($content);
                $this->getMailer()->send($message);

                $players = Doctrine_Query::create()
                        ->from('teamplayer')
                        ->where('team_id = ' . $y->getTeamPlayer()->getTeamId())
                        ->execute();


                foreach ($players as $player):
                  $mail = Doctrine::getTable('mail')->findOneByName('mail_slot_valide');
                  $message = $this->getMailer()->compose();
                  $message->setSubject($mail->getSubject());
                  $message->setTo($player->getSfGuardUser()->getEmailAddress());
                  $message->setFrom($mail->getEmail());
                  $team = Doctrine::getTable('team')->findOneByIdTeam($this->tournamentslots[0]->getTeamId());
                  $content = str_replace("%TEAM%", $team->getName(), $mail->getContent());
                  $content = str_replace("%TOURNAMENT%", $this->tournaments[0]->getName(), $content);
                  $message->setBody($content);
                  $this->getMailer()->send($message);
                endforeach;
              }

              //
            } else
            {

            };
            // } else {
            // ID de transaction deja utilise
            //}
          }
          else
          {

          }
        }
        else if (strcmp($res, "INVALID") == 0)
        {

        }
      }
      fclose($fp);
    }
  }

}
