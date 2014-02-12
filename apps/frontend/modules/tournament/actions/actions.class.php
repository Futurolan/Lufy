<?php

/**
 * tournament actions.
 *
 * @package    lufy
 * @subpackage tournament
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tournamentActions extends FrontendActions
{

  public function executeRegistration(sfWebRequest $request)
  {
    $this->checkRegistration($request);
  }

  private function checkRegistration(sfWebRequest $request)
  {
    $this->forward404Unless($this->tournament = Doctrine::getTable('tournament')->findOneBySlug($request->getParameter('slug')));

    if (!$this->tournament->registrationIsActive())
    {
      $this->getUser()->setFlash('error', $this->getContext()->getI18n()->__('Les inscriptions ne sont pas encore ouvertes pour ce tournois.'));
      $this->redirect('tournament/view?slug=' . $this->tournament->getSlug());
    }

    if (!$this->getUser()->getGuardUser()->hasTeam())
    {
      $this->getUser()->setFlash('error', $this->getContext()->getI18n()->__('Vous devez appartenir a une equipe pour vous inscrire au tournoi.'));
      $this->redirect('tournament/view?slug=' . $this->tournament->getSlug());
    }

    // Vérifier si le slot de la team est validé ; afficher un message d'info
    if ($this->getUser()->getGuardUser()->TeamPlayer[0]->getTeam()->getTournamentSlot()->getIdTournamentSlot() != '')
    {
      $this->getUser()->setFlash('error', $this->getContext()->getI18n()->__('Vous etes deja inscrit au tournoi.'));
      $this->redirect('tournament/view?slug=' . $this->tournament->getSlug());
    }

// Vérifier que la team comporte bien le bon nombre de joueur pour le tournoi ; si non : afficher un message
// 
// 
// tester que le profil des joueurs est bien remplis ; si non : afficher un message en indiquant les joueurs concernés
// tester que chaque joueur a une adresse par défaut ; si non : afficher un message en indiquants les joueurs concernés
// tester que chaque joueur à bien enregistré son billets Weezevent ; si non : afficher un message en indiquants les joueurs concernés

    $this->steps = array(
        'Profile' => false,
        'Address' => false,
        'Weezevent' => false,
        'IsInTeam' => false,
        'MyTeamIsOk' => false,
    );
    if ($this->checkProfile())
      $this->steps['Profile'] = true;
    
    if ($this->checkAddress())
      $this->steps['Address'] = true;
    
    if ($this->checkWeezevent($this->getUser()->getGuardUser()->getId()))
      $this->steps['Weezevent'] = true;
    
    if ($this->checkHasTeam())
      $this->steps['IsInTeam'] = true;
    
    if ($this->checkTeamPlayerHasWeezevent())
      $this->steps['MyTeamIsOk'] = true;
  }
  
  
private function checkPlayerNumber()
  {
    $result = false;
    $player_per_team = $this->getPlayerPerTeam();
    
    // TODO :plein de chose ici
    $idTournamentSlot = Doctrine_core::getTable("tournament_slot")->findOneByIdTournamentAndTeamId($this->getId(), );

    $users_are_players = Doctrine_Query::create()
            ->from('TeamPlayer tp')
            ->innerJoin('tp.Team t')
            ->innerJoin('t.TournamentSlot ts')
            ->where('tp.is_player = 1')
            ->andWhere('ts.id_tournament_slot = ?', $tournamentSlot->getIdTournamentSlot())
            ->count();
    $this->logSection('info', $player_per_team . ' == ' . $users_are_players);

    if ($player_per_team <= $users_are_players)
      $result = true;

    if ($result)
    {
      $this->logSection('info', 'playernb ok');
    }
    else
    {
      $this->logSection('info', 'playernb Nok');
    }


    return $result;
  }

  /**
   * @brief Check if weezevent tickets of team members are valid.
   * @return boolean : true if team is ok.
   */
  private function checkTeamPlayerHasWeezevent()
  {
    $user = $this->getUser();
    $team = Doctrine_Query::create()
            ->select('tp.team_id')
            ->from('TeamPlayer tp')
            ->where('tp.user_id = ?', $this->getUser()->getGuardUser()->getId())
            ->fetchOne();

    $users = Doctrine_Query::create()
            ->select('tp.user_id')
            ->from('TeamPlayer tp')
            ->where('tp.team_id = ?', $team->getTeamId())
            ->execute();
    $players = array();
    $result = true;
    foreach ($users as $key)
    {
      if (!$this->checkWeezevent($key->getUserId()))
        $result = false;
    }
    return $result;
  }

  /**
   * @brief Check if Weezevent Ticket is valid.
   * @param[in] $userId Take a user id or check current user id
   * @return boolean : true if there is one.
   */
  private function checkWeezevent($userId)
  {
    if (!$userId)
    {
      $userId = $this->getUser()->getSfGuard()->getId();
    }
    $weezevent = Doctrine_Query::create()
            ->select("user_id")
            ->from('sfGuardUserWeezevent')
            ->where('user_id = ?', $userId)
            ->andWhere('is_valid = 1')
            ->fetchOne();
    $result = true;
    if ($weezevent == NULL)
      $result = false;
    return $result;
  }

  /**
   * @brief Check if User is a player in a team.
   * @return boolean : true if he is.
   */
  private function checkHasTeam()
  {
    $user = $this->getUser();
    $team = Doctrine_Query::create()
            ->select("team_id")
            ->from('teamPlayer')
            ->where('user_id = ?', $this->getUser()->getGuardUser()->getId())
            ->andWhere('is_player = 1')
            ->fetchOne();
    $result = true;
    if ($team == NULL)
      $result = false;
    return $result;
  }

  /**
   * @brief Check if there is a default address.
   * @return boolean : true if there is one.
   */
  private function checkAddress($user)
  {
    $address = Doctrine_Query::create()
            ->select("id")
            ->from('sfGuardUserAddress')
            ->where('user_id = ?', $user)
            ->andWhere('is_default = 1')
            ->fetchOne();
    $result = true;
    if ($address == NULL)
      $result = false;
    return $result;
  }

  /**
   * @brief Check if profil is ok ( name, email, username ).
   * @return boolean : true if everything is ok.
   */
  private function checkProfile($user)
  {
    $result = true;

    if ($user->getFirstName() == NULL ||
            $user->getLastName() == NULL ||
            $user->getEmailAddress() == NULL ||
            $user->getUsername() == NULL)
      $result = false;

    return $result;
  }

  
  
  
  
  
  
  
  
  
  public function executeRegistrationConfirm(sfWebRequest $request)
  {
    $teamSlug = $request->getParameter('team_slug');
    $tournamentSlug = $request->getParameter('slug');

    $this->checkRegistration($request);

    if (!$this->checkHasTeamAndIsCaptain())
    {
      $this->getUser()->setFlash('error', $this->getContext()->getI18n()->__('Vous devez etre le manager pour vous inscrire au tournoi.'));
      $this->redirect('tournament/registration?slug=' . $tournamentSlug);
    }

    if ($this->getUser()->getGuardUser()->TeamPlayer[0]->getTeam()->getTournamentSlot()->getIdTournamentSlot() != '')
    {
      $this->getUser()->setFlash('error', $this->getContext()->getI18n()->__('Vous etes deja inscrit au tournoi.'));
      $this->redirect('tournament/registration?slug=' . $tournamentSlug);
    }

    $idTournament = Doctrine_Query::create()
            ->select('t.id_tournament')
            ->from('tournament t')
            ->where('t.slug = ?', $tournamentSlug)
            ->fetchOne();

    $idTeam = Doctrine_Query::create()
            ->select('t.id_team')
            ->from('team t')
            ->where('t.slug = ?', $teamSlug)
            ->fetchOne();

    $tournamentSlot = new TournamentSlot();
    $tournamentSlot->setTeamId($idTeam);
    $tournamentSlot->setTournamentId($idTournament);
    $tournamentSlot->save();

    $this->getUser()->setFlash('success', 'L equipe est inscrite au tournoi');

    $this->redirect('tournament/registration?slug=' . $tournamentSlug);
  }



    /**
   * @brief Check if User is a player in a team.
   * @return boolean : true if he is.
   */
  private function checkHasTeamAndIsCaptain()
  {
    if ($this->getUser()->getGuardUser()->hasTeam())
    {
      $team = Doctrine_Query::create()
              ->select("team_id")
              ->from('teamPlayer')
              ->where('user_id = ?', $this->getUser()->getGuardUser()->getId())
              ->andWhere('is_captain = 1')
              ->fetchOne();

      if ($team)
      {
        return true;
      }

      return false;
    }

    return false;
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->lastevent = Doctrine_Core::getTable('Event')->getCurrent();

    $this->tournaments = Doctrine_Query::create()
            ->select('*')
            ->from('tournament t1, game g, event e')
            ->where('t1.is_active = 1')
            ->andWhere('t1.game_id = g.id_game')
            ->andWhere('t1.event_id = e.id_event')
            ->orderBy('e.end_at DESC')
            ->execute();
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeRedirect(sfWebRequest $request)
  {
    $tournament = Doctrine_Core::getTable('tournament')->findOneByIdTournament($request->getParameter('id_tournament'));
    $this->forward404Unless($tournament);
    if ($tournament->getPlayerPerTeam() > 1)
    {
      $this->getUser()->setAttribute('tmp_tournament_id', $tournament->getIdTournament());
      $this->redirect('team/index');
    }
    else
    {
      $has_team = Doctrine::getTable('teamPlayer')->findOneByUserId($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
      if (!$has_team)
      {
        $this->getUser()->setAttribute('tmp_tournament_id', $tournament->getIdTournament());
        $new_team = new Team();
        $new_team->setName($this->getUser()->getUsername());
        $new_team->setAdminteamId($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
        $new_team->setLocked('0');
        $new_team->save();

        $new_player = new TeamPlayer();
        $new_player->setUserId($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
        $new_player->setTeamId($new_team->getIdTeam());
        $new_player->setIsCaptain('1');
        $new_player->setIsPlayer('1');
        $new_player->save();
      }

      $this->redirect('tournament/reglement?slug=' . $tournament->getSlug());
    }
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeView(sfWebRequest $request)
  {
    $this->tournament = Doctrine_Query::create()
            ->from('Tournament t')
            ->leftJoin('t.Event e')
            ->leftJoin('t.Game g')
            ->leftJoin('g.GameType gt')
            ->leftJoin('g.Plateform p')
            ->where('t.slug = ?', $request->getParameter('slug'))
            ->fetchOne();

    $this->forward404Unless($this->tournament);

    $this->page = Doctrine_Query::create()
            ->from('Page p')
            ->where('p.slug = ?', $request->getParameter('slug'))
            ->limit(1)
            ->fetchOne();

    $this->admins = Doctrine::getTable('tournamentAdmin')
            ->createQuery('a')
            ->where('tournament_id =' . $this->tournament->getIdTournament())
            ->execute();

    /*
      $this->admins = Doctrine_Query::create()
      ->from('TournamentAdmin ta')
      ->leftJoin('ta.sfGuardUser u')
      ->where('ta.tournament_id = ?', $this->tournament->getIdTournament())
      ->execute();
     */
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeList(sfWebRequest $request)
  {
    $this->lastevents = Doctrine_Query::create()
            ->select('*')
            ->from('event e')
            ->orderBy('e.end_at DESC')
            ->limit($this->getRequestParameter('limit', 1))
            ->execute();

    $this->tournaments = Doctrine_Query::create()
            ->select('*')
            ->from('tournament t1, game g, event e')
            ->where('t1.game_id = g.id_game')
            ->andWhere('t1.event_id = e.id_event')
            ->andWhere('t1.is_active = 1')
            ->orderBy('e.end_at DESC')
            ->execute();

    $this->tournamentDetail = Doctrine::getTable('Tournament')->findOneBySlug($request->getParameter('slug', ''));
    if (!$this->tournamentDetail):
      $this->tournamentDetail = false;
    endif;
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeReglement(sfWebRequest $request)
  {
    $this->tournament = Doctrine::getTable('Tournament')->findOneBySlug($request->getParameter('slug', ''));
    $this->forward404Unless($this->tournament);
    $this->reglement = Doctrine::getTable('varConfig')->findOneByName('reglement');
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeAddTeam(sfWebRequest $request)
  {
    $this->form = new addTeamForm();
    if ($request->isMethod(sfRequest::POST))
    {
      $this->processFormTournament($request, $this->form);
      $this->redirect('team/index');
    }
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  protected function processFormTournament(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $team = Doctrine::getTable('teamPlayer')->findOneByUserId($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
      $tournament = $form->save();
      $tournament->setTeamId($team->getTeamId());
      $tournament->setUserId($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
      $tournament->save();
      $this->getUser()->setFlash('success', 'L equipe est inscrite au tournoi');
      $this->redirect('team/index');
    }
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function isGoodNbPlayer($nbPlayerTeam, $nbPlayerTournament)
  {
    if ($nbPlayerTeam > $nbPlayerTournament)
    {
      return false;
    }
    else
    {
      return true;
    }
  }

}
