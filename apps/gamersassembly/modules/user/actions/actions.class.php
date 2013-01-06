<?php

/**
 * user actions.
 *
 * @package    lufy
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class userActions extends BaseActions
{

  public function executeIndex(sfWebRequest $request)
  {
    if ($this->getUser()->isAuthenticated() == true)
    {
      $teamplayer = Doctrine_Core::getTable('teamPlayer')->findOneByUserId($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));

      if ($teamplayer)
      {
        $tournamentslot = Doctrine_Core::getTable('tournamentSlot')->findOneByTeamId($teamplayer->getTeamId());

        if ($tournamentslot)
        {
          $this->isInscrit = true;
        }
        else
        {
          $this->isInscrit = false;
        }
      }
      else
      {
        $this->isInscrit = false;
      }
    }
  }


  public function executeSuccess(sfWebRequest $request)
  {

  }


  public function executeBulletin(sfWebRequest $request)
  {
    if ($this->getUser()->isAuthenticated())
    {
      $this->user = Doctrine::getTable('sfGuardUser')->findOneById($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
      if (!$this->user->getLicenceGa())
      {
        $id = $this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser');
        $l = Doctrine::getTable('varConfig')->getEanNextPlayer();

        Doctrine::getTable('sfGuardUser')->setLicenceGa($l, $id);

        $k = substr($l, 0, 12);
        $k = $k + 1;

        for ($i = 0; $i < 12; $i++)
        {
          $EAN13[$i] = substr($k, $i, 1);
        }

        $pair = 0;

        for ($u = 0; $u < 12; $u = $u + 2)
        {
          $pair = $pair + $EAN13[$u];
        }

        $impair = 0;

        for ($y = 1; $y < 12; $y = $y + 2)
        {
          $impair = $impair + $EAN13[$y] * 3;
        }

        $total = $pair + $impair;
        $r = fmod($total, 10);
        $controlkey = 10 - $r;
        $n = str_pad($k, 13, $controlkey, STR_PAD_RIGHT);

        Doctrine::getTable('varConfig')->UpdateEanNextPlayer($n);

        $this->redirect('user/bulletin');
      }

      foreach ($this->user->getTeam() as $team)
      {
        $this->tournaments = Doctrine_Query::create()
          ->select('*')
          ->from('tournamentSlot t1, tournament t2')
          ->where('t1.tournament_id = t2.id_tournament')
          ->andWhere('t1.team_id = ' . $team->getIdTeam())
          ->execute();
      }

      $this->setLayout('print');
    }
  }


  public function executeView(sfWebRequest $request)
  {
    $this->user = Doctrine::getTable('sfGuardUser')->findOneByUsername($request->getParameter('username', ''));
    $this->forward404Unless($this->user);

    // team : notinteam, notininvitationteam,
    $t = Doctrine::getTable('invite')->isInvitedInTeam($this->user->getId());
    $t2 = Doctrine::getTable('team')->isInTeam($this->user->getId());

    // droits : adminteam ou captain
    $d = Doctrine::getTable('sfGuardUser')->isCaptain();
    $d2 = Doctrine::getTable('sfGuardUser')->isAdmin();
    $this->inviteteam = '0';

    if ($t == false && $t2 == false)
    {
      if ($d == true || $d2 == true)
      {
        $this->inviteteam = '1';
      }
    }

    // friend : notFriend, notininvitationfriend,
    $f = Doctrine::getTable('invite')->isInvitedFriend($this->user->getId());
    $f2 = Doctrine::getTable('friend')->isFriend($this->user->getId());

    $this->invitefriend = '0';
    if ($f == false && $f2 == false)
    {
      $this->invitefriend = '1';
    }

    if ($this->user->getId() == $this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser') || $this->getUser()->isAuthenticated() == false)
    {
      $this->invitefriend = '0';
    }
  }


  public function executeProfil(sfWebRequest $request)
  {
    if ($this->getUser()->isAuthenticated())
    {
      $this->user = Doctrine::getTable('sfGuardUser')->findOneById($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
    }
  }


  public function executeEdit(sfWebRequest $request)
  {
    if ($this->getUser()->isAuthenticated())
    {
      $this->forward404Unless($user = Doctrine::getTable('sfGuardUser')->find(array($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'))), sprintf('Object user does not exist (%s).', $request->getParameter('id')));
      $this->form = new profilForm($user);
    }
  }


  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($user = Doctrine::getTable('sfGuardUser')->find(array($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'))), sprintf('Object user does not exist (%s).', $request->getParameter('id')));
    $this->form = new profilForm($user);
    $this->processForm($request, $this->form);
    $this->getUser()->setFlash('error', 'Verifier les erreurs');
    $this->setTemplate('edit');
  }


  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $user = $form->save();
      $this->getUser()->setFlash('success', 'Votre profil a ete mis a jour.');
      $this->redirect('user/profil');
    }
  }


  public function executeLicence(sfWebRequest $request)
  {
    $this->forward404Unless($this->user = Doctrine_Core::getTable('sfGuardUser')->findOneById($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser')));
    $mfjv = new mfjv();
    $result = $mfjv->check($this->user->getLicenceMasters());
    if ($result)
    {
      // La requete a abouti et la licence est valide,
      // on peut donc exploiter les resultats
      $this->type = $result->type;
      $this->serial = $result->serial;
      $this->season = $result->season;
      $this->username = $result->username;
      $this->used = $result->used;
    };
  }


  public function executeNewLicenceGa(sfWebRequest $request)
  {
    if ($this->getUser()->isAuthenticated())
    {
      // on recupere l'user
      $id = $this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser');

      // on recupere la prochaine licence
      $l = Doctrine::getTable('varConfig')->getEanNextPlayer();

      // on assigne la licence a l'utilisateur
      Doctrine::getTable('sfGuardUser')->setLicenceGa($l, $id);


      // algo de calcul de la nouvelle licence

      // on retire le dernier chiffre, la cle
      $k = substr($l, 0, 12);
      $k = $k + 1;

      //Transformation de la chaine en tableau
      for ($i = 0; $i < 12; $i++)
      {
        $EAN13[$i] = substr($k, $i, 1);
      }

      // calcul chiffre pair
      $pair = 0;
      for ($u = 0; $u < 12; $u = $u + 2)
      {
        $pair = $pair + $EAN13[$u];
      }

      // calcul chiffre impair
      $impair = 0;
      for ($y = 1; $y < 12; $y = $y + 2)
      {
        $impair = $impair + $EAN13[$y] * 3;
      }
      $total = $pair + $impair;

      //calcul du reste du total divise par 10
      $r = fmod($total, 10);
      $controlkey = 10 - $r;

      // on ajoute la cle de controle a la nouvelle licence
      $n = str_pad($k, 13, $controlkey, STR_PAD_RIGHT);

      // on met a jour le numero de la prochaine licence
      Doctrine::getTable('varConfig')->UpdateEanNextPlayer($n);

      $this->getUser()->setFlash('success', 'La generation de votre nouvelle licence GA est un succes.');
      $this->redirect('user/profil');
    }

    $this->redirect('login');
  }


  // Permet de d'utiliser une licence masters pour la reduction, stockage de la licence dans commande.reduction
  // A TESTER !!!
  public function executeUseLicenceMasters(sfWebRequest $request)
  {
    if ($this->getUser()->isAuthenticated())
    {
      $user = Doctrine::getTable('sfGuardUser')->getUser($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
      $slot = Doctrine::getTable('tournamentSlot')->getTournamentSlot($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
      $commande = Doctrine::getTable('commande')->findOneByTournamentSlotId($slot->getIdTournamentSlot());

      if ($user->getLicenceMasters())
      {
        Doctrine::getTable('commande')->AddReduction($commande->getIdCommande(), $user->getLicenceMasters());
      }
      else
      {
        $this->getUser()->setFlash('error', 'Vous devez configurer votre licence masters.');
        $this->redirect('user/licence');
      }

      $this->getUser()->setFlash('success', 'Votre coupon de reduction a ete utilise pour cet evenement.');
      $this->redirect('tournament_slot/index');
    }

    $this->redirect('login');
  }


/**
 * Add a Masters licence on the current user
 */
  public function executeAddMasters(sfWebRequest $request)
  {
    if ($this->getUser()->isAuthenticated())
    {
      $this->forward404Unless($user = Doctrine::getTable('sfGuardUser')->find(array($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'))), sprintf('Object user does not exist (%s).', $request->getParameter('id')));
      $this->form = new licenceMastersForm($user);

      if ($request->isMethod(sfRequest::POST))
      {
        $this->processFormLicenceMasters($request, $this->form);
        $this->redirect('user/licence');
      }
    }
  }


  protected function processFormLicenceMasters(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $user = $form->save();
      $mfjv = new mfjv();
      $mfjv->setCriteria('first_name', $user->getFirstName());
      $mfjv->setCriteria('last_name', $user->getLastName());
      //$mfjv->setCriteria('birthdate', $user->getBirthdate());

      $result = $mfjv->check($user->getLicenceMasters());
      if ($result)
      {
        //  La requete a abouti et la licence est valide,
        // on peut donc exploiter les resultats
        if ($result->season == '2011-2012')
        {
          // On verifie que la licence a ete souscrite pour la bonne saison
          $this->getUser()->setFlash('success', 'Votre Licence Masters a ete verifiee. Les reductions seront automatiquement appliquees.');
          $this->redirect('user/licence');
        }
      }

      $user->setLicenceMasters(NULL);
      $user->save();
      $this->getUser()->setFlash('error', 'Votre numero de licence et/ou les informations relatives a votre profil (nom ou prenom) sont erronees.');
      $this->redirect('user/licence');
    }

    $this->getUser()->setFlash('error', 'Une erreur s\'est produite. Veuillez reessayer.');
    $this->redirect('user/licence');
  }


/**
 * Activate user account after registration
 */
  public function executeActivate(sfWebRequest $request)
  {
    $key = $request->getParameter('key', '');
    $id = substr($key, 40);
    $user = Doctrine::getTable('sfGuardUser')->findOneById($id);

    if ($user)
    {
      if ($user->getIsActive() == 1 && $user->getLicenceGa() != '')
      {
        $this->getUser()->setFlash('success', 'Votre compte a deja ete valide. Vous pouvez desormais vous connecter.');
        $this->redirect('sfGuardAuth/signin');
      }

      $verified = sha1($user->getFirstName() . $user->getLastName() . $user->getEmailAddress());
      $toverify = substr($key, 0, 40);

      if ($verified == $toverify)
      {
        Doctrine::getTable('sfGuardUser')->active($id);
        $l = Doctrine::getTable('varConfig')->getEanNextPlayer();
        Doctrine::getTable('sfGuardUser')->setLicenceGa($l, $id);
        $newLicence = new Ean13Tool;
        Doctrine::getTable('varConfig')->UpdateEanNextPlayer($newLicence->nextEan($l));
        $this->getUser()->setFlash('success', 'Votre compte a ete valide. Vous pouvez desormais vous connecter.');
        $this->redirect('sfGuardAuth/signin');
      }
      else
      {
        $this->getUser()->setFlash('error', 'Une erreur s\'est produite. Contactez un admin si ce probleme persiste.');
        $this->redirect('main/index');
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'Une erreur s\'est produite. Contactez un admin si ce probleme persiste.');
      $this->redirect('main/index');
    }
  }


  public function executePassword(sfWebRequest $request)
  {
    $this->form = new passwordForm($this->user);
    if($this->embeddedProcessForm($request, 'password'))
    {
      $this->getUser()->setFlash('success', 'Le mot de passe a bien été modifié.');
    }
  }


/**
 * Return and set the tshirt size for the current user
 */
  public function executeTshirt(sfWebRequest $request)
  {
    if ($this->getUser()->isAuthenticated())
    {
      $this->forward404Unless($user = Doctrine::getTable('sfGuardUser')->find(array($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'))), sprintf('Object user does not exist (%s).', $request->getParameter('id')));
      $tshirt = Doctrine::getTable('Tshirt')->findOneByUserId($user->getId());

      if (!$tshirt)
      {
        $tshirt = new Tshirt();
        $tshirt->setUserId($user->getId());
      }

      $this->form = new TshirtSizeForm($tshirt);

      if ($request->isMethod(sfRequest::POST))
      {
        $this->processFormTshirtSize($request, $this->form);
        $this->redirect('user/tshirt');
      }
    }
  }


  protected function processFormTshirtSize(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

    if ($form->isValid())
    {
      $form->save();
      $this->getUser()->setFlash('success', 'La taille de vote tee-shirt a ete enregistre');
      $this->redirect('user/tshirt');
    }
  }

}

