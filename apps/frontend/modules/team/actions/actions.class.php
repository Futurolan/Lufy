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

  /**
   * @brief Display Team and set right for current user
   * @param[in] $request a sfWebRequest
   */
  public function executeView(sfWebRequest $request)
  {
    $this->team = Doctrine::getTable('Team')->findOneBySlug($request->getParameter('slug'));
    $this->forward404Unless($this->team);

    $this->isCaptain = false;
    $this->isMember = false;
    $this->isAuth = false;

    if ($this->getUser()->isAuthenticated())
    {
      if ($this->user = Doctrine::getTable('TeamPlayer')->findOneByTeamIdAndUserId($this->team->getIdTeam(), $this->getUser()->getGuardUser()->getId()))
      {
        $this->isCaptain = $this->user->getIsCaptain();
        $this->isMember = true;
      }

      $this->isAuth = true;
    }

    if ($this->isMember)
    {
      $this->setLayout('user');
    }
  }

  /**
   * @brief Add a member at team
   * @param[in] $request a sfWebRequest
   * @return Redirect
   */
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

    $this->redirect('team/view?slug=' . $team->getSlug());
  }

  /**
   * @brief Invite a player with check on is_accepted.
   * @param[in] $request a sfWebRequest
   * @return Redirect
   */
  public function executeInviteMember(sfWebRequest $request)
  {
    if ($request->getParameter('user_id') == $this->getUser()->getGuardUser()->getId())
    {
      $this->getUser()->setFlash('error', $this->getContext()->getI18n()->__('Vous ne pouvez pas vous inviter dans l\'équipe'));
    }
    elseif ($invite = Doctrine_Core::getTable('Invite')->findOneByTeamIdAndUserId($request->getParameter('team_id'), $request->getParameter('user_id')))
    {
      if (!$request->getParameter('user_id'))
      {
        $this->getUser()->setFlash('error', $this->getContext()->getI18n()->__('Vous devez selectionner un utilisateur'));
        $this->redirect('team/players');
      }
      
      if (Doctrine_core::getTable('TeamPlayer')->findOneByTeamIdAndUserId($request->getParameter('team_id'), $request->getParameter('user_id')))
      {
         $player = Doctrine::getTable('SfGuardUser')->findOneById($request->getParameter('user_id'));
         $this->getUser()->setFlash('error', $player->getUsername().$this->getContext()->getI18n()->__(' a déjà rejoins l\'équipe'));
      }
      else
      {
        if ((Doctrine_Core::getTable('Invite')->findOneByTeamIdAndUserId($request->getParameter('team_id'), $request->getParameter('user_id'))->getIsAccepted()) != 0)
        {
          $player = Doctrine::getTable('SfGuardUser')->findOneById($request->getParameter('user_id'));
          $this->getUser()->setFlash('error', $player->getUsername().$this->getContext()->getI18n()->__(' a déjà reçu une invitation a rejoindre l\'équipe'));
        }
        else
        {
          $invite->setIsAccepted(null);
          $invite->save();

          $player = Doctrine::getTable('SfGuardUser')->findOneById($request->getParameter('user_id'));
          $this->getUser()->setFlash('success', $this->getContext()->getI18n()->__('Vous avez envoyé une invitation à ').$player->getUsername());
        }
      }
    }
    else
    {
      $invite = new Invite ;
      $invite->setTeamId($request->getParameter('team_id'));
      $invite->setUserId($request->getParameter('user_id'));
      $invite->save();

      $player = Doctrine::getTable('SfGuardUser')->findOneById($request->getParameter('user_id'));
      $this->getUser()->setFlash('success', $this->getContext()->getI18n()->__('Vous avez envoyé une invitation à ').$player->getUsername());
    }

      $team = Doctrine_core::getTable('Team')->findOneByIdTeam($request->getParameter('team_id'));
      $this->redirect('team/searchPlayers?slug=' . $team->getSlug());
  }

  /**
   * @brief Delete a team member and reset his invitation 0
   * @param[in] $request a sfWebRequest
   * @return Redirect
   */
  public function executeDeleteMember(sfWebRequest $request)
  {
    $team_player = Doctrine::getTable('TeamPlayer')->findOneByTeamIdAndUserId($request->getParameter('team_id'), $request->getParameter('user_id'));
    $team = Doctrine::getTable('Team')->findOneByIdTeam($request->getParameter('team_id'));

    $team_player->delete();

    $invite =  Doctrine_core::getTable('Invite')->findOneByTeamIdAndUserId($request->getParameter('team_id'), $this->getUser()->getGuardUser()->getId());
    $invite->setIsAccepted(0);
    $invite->save();

    $this->getUser()->setFlash('success', $team_player->getSfGuardUser()->getUsername() .$this->getContext()->getI18n()->__(' a ete supprime de l\'equipe'));
    $this->redirect('team/view?slug=' . $team->getSlug());
  }

  /**
   * @brief Define a member as a player or not a player
   * @param[in] $request a sfWebRequest
   * @return Redirect
   */
  public function executeSetPlayer(sfWebRequest $request)
  {
    $team_player = Doctrine::getTable('TeamPlayer')->findOneByTeamIdAndUserId($request->getParameter('team_id'), $request->getParameter('user_id'));

    if ($team_player->getIsPlayer() == 0)
    {
      $team_player->setIsPlayer(1);
      $this->getUser()->setFlash('success', $team_player->getSfGuardUser()->getUsername() . $this->getContext()->getI18n()->__(' est maintenant joueur de l\'equipe'));
    }
    else
    {
      $team_player->setIsPlayer(0);
      $this->getUser()->setFlash('success', $team_player->getSfGuardUser()->getUsername() .$this->getContext()->getI18n()->__(' ne fait plus parti des joueurs'));
    }

    $team_player->save();
    $team = Doctrine::getTable('Team')->findOneByIdTeam($request->getParameter('team_id'));
    $this->redirect('team/view?slug=' . $team->getSlug());
  }

  /**
   * @brief Define a player as a captain or not a captain
   * @param[in] $request a sfWebRequest
   * @return Redirect
   */
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
    $this->redirect('team/view?slug=' . $team->getSlug());
  }

  /**
   * @brief Permit to leave a team and reset invitation 0
   * @param[in] $request a sfWebRequest
   * @return Redirect
   */
  public function executeLeaveTeam(sfWebRequest $request)
  {
    $team_player = Doctrine_core::getTable('teamplayer')->findOneByTeamIdAndUserId($request->getParameter('team_id'), $this->getUser()->getGuardUser()->getId());
    $team_player->delete();

    $this->getUser()->setFlash('success', $this->getContext()->getI18n()->__('Vous avez quitte l\'equipe'));
    $this->redirect('user/profile');

  }


  /**
   * @brief Create a new team form
   * @param[in] $request a sfWebRequest
   * @return Redirect
   */
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

        $this->redirect('@team_view?slug=' . $team->getSlug());
      }
    }

    $this->setLayout('user');
  }

  /**
   * @brief Overriding processForm
   * @param[in] $request a sfWebRequest
   * @param[in] $form a sfForm
   * @return Redirect
   */
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $team = $form->save();
      $team->save();
      $this->redirect('@team_view?slug=' . $team->getSlug());
    }
  }

  /**
   * @brief Permit search players
   * @param[in] $request a sfWebRequest
   */
  public function executeSearchPlayers(sfWebRequest $request)
  {
    if ($request->isXmlHttpRequest())
    {
      $this->results = Doctrine_Query::create()
        ->select('u.id, u.username')
        ->from('sfGuardUser u')
        ->where('u.username LIKE ?', $request->getParameter('query') . '%')
        ->execute();

      $this->setLayout(false);
      echo json_encode($this->results->toArray());
      exit;
    }
    else
    {
      $this->team = Doctrine::getTable('Team')->findOneBySlug($request->getParameter('slug'));
      $this->forward404Unless($this->team);

      $this->setLayout('user');
    }
  }


  public function executeDelete(sfWebRequest $request)
  {
    $this->forward404Unless($team = Doctrine::getTable('Team')->findOneBySlug($request->getParameter('slug')));

    $current_player = Doctrine::getTable('TeamPlayer')->findOneByUserIdAndTeamId($this->getUser()->getGuardUser()->getId(), $team->getIdTeam());

    if (!$current_player->getIsCaptain())
    {
      $this->getUser()->setFlash('error', 'Vous devez etre manager pour supprimer une equipe.');
      $this->redirect('team/view?slug='.$request->getParameter('slug'));
    }

    if ($team->getIsLocked())
    {
      $this->getUser()->setFlash('error', 'Vous ne pouvez pas supprimer une equipe verrouillee.');
      $this->redirect('team/view?slug='.$request->getParameter('slug'));
    }

    $slot = Doctrine::getTable('TournamentSlot')->findOneByTeamId($team->getIdTeam());

    if ($slot)
    {
      $slot->delete();
    }

    $players = Doctrine::getTable('TeamPlayer')->findByTeamId($team->getIdTeam());

    foreach ($players as $player)
    {
      $player->delete();
    }

    $team->delete();

    $this->getUser()->setFlash('success', 'Votre equipe a ete supprimee');
    $this->redirect('user/profile');
  }
}
