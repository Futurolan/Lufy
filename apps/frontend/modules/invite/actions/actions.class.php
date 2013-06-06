<?php

/**
 * invite actions.
 *
 * @package    lufy
 * @subpackage invite
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class inviteActions extends FrontendActions
{

  /**
   * @brief Load a $invites, symfony collection of invatation for current user order by updated date
   * @param[in] $request a sfWebRequest
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->invites = Doctrine_Query::create()
      ->select('*')
      ->from('Invite i')
      ->leftJoin('i.SfGuardUser u')
      ->leftJoin('i.Team t')
      ->where('i.user_id = ?', $this->getUser()->getGuardUser()->getId())
      ->orderBy('i.updated_at')
      ->execute();

    $this->setLayout('user');
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeAddPlayer(sfWebRequest $request)
  {

    $user = Doctrine::getTable('sfGuardUser')->findOneById($this->getUser()->getGuardUser()->getId());
    $this->forward404Unless($user);
    $q = Doctrine::getTable('sfGuardUser')->isCaptain();
    $a = Doctrine::getTable('sfGuardUser')->isAdmin();
    if ($q == true || $a == true)
    {
      $team = Doctrine::getTable('teamPlayer')->findOneByUserId($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
      $invite = new Invite();
      $invite->setUserId($user->getId());
      $invite->setTeamId($team->getTeamId());
      $invite->setAction('join');
      $invite->save();

      $link = 'http://www.gamers-assembly.net/invite';
      $t = doctrine::getTable('team')->findOneByIdTeam($team->getTeamId());
      $mail = Doctrine::getTable('mail')->findOneByName('mail_invite_addplayer');
      $message = $this->getMailer()->compose();
      $message->setSubject($mail->getSubject());
      $message->setTo($user->getEmailAddress());
      $message->setFrom($mail->getEmail());
      $content = str_replace("%TEAM%", $t->getName(), $mail->getContent());
      $content = str_replace("%LINK%", $link, $content);
      $message->setBody($content);
      $this->getMailer()->send($message);
    }
    else
    {
      $this->getUser()->setFlash('success', 'Vous n\'avez pas les droits pour cette action, vous devez etre Capitaine ou Admin de la team.');
      $this->redirect('team/index');
    }

    $this->getUser()->setFlash('success', 'Le joueur a ete invite a rejoindre l\'equipe. Un mail lui a ete envoye.');
  }

  /**
   * @brief Use by a player to accept a team invitation
   * @param[in] $request a sfWebRequest
   * @return Redirect_or_Exeption
   */
  public function executeAcceptPlayer(sfWebRequest $request)
  {

    $invite = Doctrine::getTable('invite')->findOneByIdInvite($request->getParameter('id'));

    if ($invite->getUserId() == $this->getUser()->getGuardUser()->getId()){

      $team_player = new TeamPlayer();
      $team_player->setTeamId($invite->getTeamId());
      $team_player->setUserId($invite->getUserId());
      $team_player->setIsPlayer(0);
      $team_player->setIsCaptain(0);
      $team_player->save();


      $invite->setIsAccepted(1);
      $invite->save();

      $this->redirect('invite/index');
    }
    else
    {
      $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
      $this->getContext()->getResponse()->setStatusCode(403);
    }

  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeRefusePlayer(sfWebRequest $request)
  {
    $invite = Doctrine::getTable('invite')->findOneByIdInvite($request->getParameter('id'));
    if ($invite->getUserId() == $this->getUser()->getGuardUser()->getId()){
      $invite = Doctrine::getTable('invite')->findOneByIdInvite($request->getParameter('id'));
      $invite->setIsAccepted(0);
      $invite->save();
      $this->redirect('invite/index');
    }
    else
    {
      $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
      $this->getContext()->getResponse()->setStatusCode(403);
    }
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();
    $this->forward404Unless($invite = Doctrine::getTable('invite')->find(array($request->getParameter('id_invite'))), sprintf('Object invite does not exist (%s).', $request->getParameter('id_invite')));
    $invite->delete();

    $this->redirect('invite/index');
  }

}
