<?php

/**
 * team actions.
 *
 * @package    lufy
 * @subpackage team
 * @author     Guillaume Marsay <guillaume@futurolan.net>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class teamActions extends FrontendActions
{

  public function executeView(sfWebRequest $request)
  {
    $this->team = Doctrine::getTable('Team')->findOneBySlug($request->getParameter('slug'));
    $this->forward404Unless($this->team);

    if ($this->getUser()->isAuthenticated())
    {
      $this->isCaptain = Doctrine::getTable('TeamPlayer')->findOneByTeamIdAndUserId($this->team->getIdTeam(), $this->getUser()->getGuardUser()->getId())->getIsCaptain();
    }
    else
    {
      $this->isCaptain = false;
    }
  }

  public function executeIndex(sfWebRequest $request)
  {

    if ($this->getUser()->isAuthenticated())
    {
      $isInTeam = Doctrine::getTable('team')
              ->isInTeam($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
      if ($isInTeam == true):
        $this->q = Doctrine::getTable('sfGuardUser')
                ->isCaptain();
        $this->a = Doctrine::getTable('sfGuardUser')
                ->isAdmin();
        if ($this->q == true || $this->a == true)
        {
          $this->droits = true;
        }
        else
        {
          $this->droits = false;
        };
        $this->alreadyInTournament = Doctrine::getTable('team')
                ->isAlreadyInTournament();
        # Remplacer la requete du dessus par $this->team avec le findOneBy */
        $this->team = Doctrine::getTable('teamPlayer')->findOneByUserId($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
        $this->admins = Doctrine::getTable('team')
                ->getAdminTeam($this->team->getTeamId());


        $this->captains = Doctrine_Query::create()
                ->from('teamPlayer')
                ->where('is_captain = 1')
                ->andWhere('team_id = ' . $this->team->getTeamId())
                ->execute();

        $this->joueurs = Doctrine_Query::create()
                ->from('teamPlayer')
                ->where('is_player = 1')
                ->andWhere('team_id = ' . $this->team->getTeamId())
                ->execute();

        $this->autres = Doctrine_Query::create()
                ->from('teamPlayer')
                ->where('is_player = 0')
                ->andWhere('is_captain = 0')
                ->andWhere('team_id = ' . $this->team->getTeamId())
                ->execute();

        $this->tournaments = Doctrine_Query::create()
                ->select('*')
                ->from('tournamentSlot t1, tournament t2')
                ->where('t1.tournament_id = t2.id_tournament')
                ->andWhere('t1.team_id = ' . $this->team->getTeamId())
                ->execute();
        $this->b = Doctrine::getTable('tournamentSlot')
                ->getTournamentSlot($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
      endif;

      $this->team = Doctrine::getTable('teamPlayer')->findOneByUserId($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));

      /*       * ********************* */
      if ($this->getUser()->getAttribute('tmp_tournament_id', array()))
      {
        $this->tournament_selected = Doctrine_Core::getTable('tournament')->findOneByIdTournament($this->getUser()->getAttribute('tmp_tournament_id', array()));
      }
    }
  }

  public function executePlayers(sfWebRequest $request)
  {
    if ($this->getUser()->getTeamPlayer()->getIsCaptain() != 1)
    {
      $this->getUser()->setFlash('error', 'Vous n\'avez pas les droits pour gerer cette equipe');
      $this->redirect('team/view?id_team=' . $request->getParameter('team_id'));
    }

    $this->team = Doctrine::getTable('Team')->findOneByIdTeam($request->getParameter('team_id'));
    $this->players = Doctrine::getTable('TeamPlayer')->findByTeamId($request->getParameter('team_id'));
    // TODO: Tri des utilisateurs par manager, joueur, membre
  }

  public function executeAddMember(sfWebRequest $request)
  {
    if (!$request->getParameter('user_id'))
    {
      $this->getUser()->setFlash('error', 'Vous devez selectionner un utilisateur');
      $this->redirect('team/players');
    }
    $team = Doctrine::getTable('Team')->findOneByIdTeam($request->getParameter('team_id'));

    $team_player = new TeamPlayer;
    $team_player->setTeamId($request->getParameter('team_id'));
    $team_player->setUserId($request->getParameter('user_id'));
    $team_player->setIsPlayer(0);
    $team_player->setIsCaptain(0);
    $team_player->save();

    $this->getUser()->setFlash('success', 'Vous avez ajoute un membre a votre equipe');

    $this->redirect('team/view?slug='.$team->getSlug());
  }


   public function executeInviteMember(sfWebRequest $request)
  {
    if (!$request->getParameter('user_id'))
    {
      $this->getUser()->setFlash('error', 'Vous devez selectionner un utilisateur');
      $this->redirect('team/players');
    }
    $team = Doctrine::getTable('Team')->findOneByIdTeam($request->getParameter('team_id'));

    $invite = new Invite;
    $invite->setTeamId($request->getParameter('team_id'));
    $invite->setUserId($request->getParameter('user_id'));
    $team_player->save();

    $this->getUser()->setFlash('success', 'Vous avez ajoute un membre a votre equipe');

    $this->redirect('team/view?slug='.$team->getSlug());
  }


  public function executeDeleteMember(sfWebRequest $request)
  {
    $team_player = Doctrine::getTable('TeamPlayer')->findOneByTeamIdAndUserId($request->getParameter('team_id'), $request->getParameter('user_id'));
    $team = Doctrine::getTable('Team')->findOneByIdTeam($request->getParameter('team_id'));

    $team_player->delete();
    $this->getUser()->setFlash('success', $team_player->getSfGuardUser()->getUsername() . ' a ete supprime de l\'equipe');

    $this->redirect('team/view?slug='.$team->getSlug());
  }

  public function executeSetPlayer(sfWebRequest $request)
  {
    $team_player = Doctrine::getTable('TeamPlayer')->findOneByTeamIdAndUserId($request->getParameter('team_id'), $request->getParameter('user_id'));

    if ($team_player->getIsPlayer() == 0)
    {
      $team_player->setIsPlayer(1);
      $this->getUser()->setFlash('success', $team_player->getSfGuardUser()->getUsername() . ' ne fait plus parti des joueurs');
    }
    else
    {
      $team_player->setIsPlayer(0);
      $this->getUser()->setFlash('success', $team_player->getSfGuardUser()->getUsername() . ' est maintenant joueur de l\'equipe');
    }

    $team_player->save();
    $team = Doctrine::getTable('Team')->findOneByIdTeam($request->getParameter('team_id'));
    $this->redirect('team/view?slug='.$team->getSlug());
  }

  public function executeSetCaptain(sfWebRequest $request)
  {
    $team_player = Doctrine::getTable('TeamPlayer')->findOneByTeamIdAndUserId($request->getParameter('team_id'), $request->getParameter('user_id'));

    if ($team_player->getIsCaptain() == 0)
    {
      $team_player->setIsCaptain(1);
      $this->getUser()->setFlash('success', $team_player->getSfGuardUser()->getUsername() . ' ne fait plus parti des capitaines');
    }
    else
    {
      $team_player->setIsCaptain(0);
      $this->getUser()->setFlash('success', $team_player->getSfGuardUser()->getUsername() . ' est maintenant capitaine de l\'equipe');
    }

    $team_player->save();

    $team = Doctrine::getTable('Team')->findOneByIdTeam($request->getParameter('team_id'));
    $this->redirect('team/view?slug='.$team->getSlug());
  }

//  public function executeSetPlayerAndCaptain(sfWebRequest $request)
//  {
//    $this->executeSetCaptain($request);
//    $this->executeSetPlayer($request);
//  }

  public function executeDeleteTeam(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($team = Doctrine::getTable('team')->findOneByAdminteamId($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser')));
    $players = Doctrine_Query::create()
            ->from('teamplayer')
            ->where('team_id = ' . $team->getIdTeam())
            ->execute();

    $mail = Doctrine::getTable('mail')->findOneByName('mail_team_delete');
    foreach ($players as $player):
      $message = $this->getMailer()->compose();
      $message->setSubject($mail->getSubject());
      $message->setTo($player->getSfGuardUser()->getEmailAddress());
      $message->setFrom($mail->getEmail());
      $content = str_replace("%TEAM%", $team->getName(), $mail->getContent());
      $message->setBody($content);
      $this->getMailer()->send($message);
    endforeach;


    $s = Doctrine::getTable('team')
            ->InSlot($team->getIdTeam());
    if ($s != '0'):
      if ($s->getStatus() == 'attente'):
        $commande = Doctrine_Core::getTable('commande')->findOneByTournamentSlotId($s->getIdTournamentSlot());
        if ($commande)
          $commande->delete();
        $s->delete();
      else:
        $commande = Doctrine_Core::getTable('commande')->findOneByTournamentSlotId($s->getIdTournamentSlot());
        $commande->delete();
        Doctrine::getTable('tournamentSlot')
                ->setLibre($s->getIdTournamentSlot());
      endif;
      $slots = Doctrine_Query::create()
              ->from('tournamentSlot')
              ->where('tournament_id = ' . $s->getTournamentId())
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
      foreach ($slots as $slot):
        if ($slot->getStatus() == 'inscrit'):
          $pos++;
          Doctrine::getTable('tournamentSlot')
                  ->setPosition($pos, $slot->getIdTournamentSlot());
        endif;
      endforeach;
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
    endif;

    $invite = Doctrine_Core::getTable('invite')->findByTeamId($team->getIdTeam());
    $invite->delete();

    Doctrine::getTable('team')
            ->deleteTeamPlayers($team->getIdTeam());
    $team->delete();

    $this->getUser()->setFlash('success', 'L\'equipe a ete supprime, tous les membres ont recu un mail.');
    $this->redirect('team/index');
  }

  public function executeNew(sfWebRequest $request)
  {
    $object = new Team();
    $this->form = new TeamForm($object);

    if ($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT))
    {
      $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
      if ($this->form->isValid())
      {
        $team = $this->form->save();
        $team_player = new TeamPlayer;
        $team_player->setTeamId($team->getIdTeam());
        $team_player->setUserId($this->getUser()->getGuardUser()->getId());
        $team_player->setIsCaptain(1);
        $team_player->save();

        $this->redirect('team/view?slug='.$team->getSlug());
      }
    }
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $team = $form->save();
      $team->save();
      $this->redirect('team/view?slug='.$team->getSlug());
    }
  }

  public function executeSearchPlayers(sfWebRequest $request)
  {
    if ($request->isXmlHttpRequest())
    {
      $this->results = Doctrine_Query::create()
        ->select('u.id, u.username')
        ->from('sfGuardUser u')
        ->where('u.username LIKE ?', $request->getParameter('query').'%')
        ->execute();

      $this->setLayout(false);
     echo json_encode($this->results->toArray());
     exit;
    }
    else
    {
      $this->team = Doctrine::getTable('Team')->findOneBySlug($request->getParameter('slug'));
      $this->forward404Unless($this->team);
    }
  }

}
