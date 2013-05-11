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
  public function executeIndex(sfWebRequest $request)
  {
    $this->invites = Doctrine::getTable('invite')->findByUserId($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
    $this->friends = Doctrine::getTable('invite')->findByFriendId($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new inviteForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));
    $this->form = new inviteForm();
    $this->processForm($request, $this->form);
    $this->getUser()->setTemplate('new');
  }

  public function executeAddPlayer(sfWebRequest $request)
  {
    $user = Doctrine::getTable('sfGuardUser')->findOneByUsername($request->getParameter('username', ''));
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

  public function executeAcceptPlayer(sfWebRequest $request)
  {
    $invite = Doctrine::getTable('invite')->findOneByIdInvite($request->getParameter('id', ''));
    $team = Doctrine::getTable('Team')->findOneByIdTeam($invite->getTeamId());
    $u = Doctrine::getTable('sfGuardUser')->getUser($invite->getUserId());
    $isinteam = Doctrine::getTable('team')->isInTeam($invite->getUserId());

    if ( $isinteam == false)
    {
      $players = Doctrine_Query::create()
        ->from('teamplayer')
        ->where('team_id = ' . $invite->getTeamId())
        ->execute();
      $mail = Doctrine::getTable('mail')->findOneByName('mail_team_newplayer');

      foreach ($players as $player)
      {
        $message = $this->getMailer()->compose();
        $message->setSubject($mail->getSubject());
        $message->setTo($player->getSfGuardUser()->getEmailAddress());
        $message->setFrom($mail->getEmail());
        $content = str_replace("%TEAM%", $team->getName(), $mail->getContent());
        $content = str_replace("%PSEUDO%", $u->getUsername(), $content);
        $message->setBody($content);
        $this->getMailer()->send($message);
      }

      $teamPlayer = new TeamPlayer();
      $teamPlayer->setUserId($invite->getUserId());
      $teamPlayer->setTeamId($invite->getTeamId());
      $teamPlayer->save();

      $invite = new Invite();
      $invite->setAcceptInvite($request->getParameter('id', ''));
      $invite->setFalseInvite($request->getParameter('id', ''));
      $this->getUser()->setFlash('success', 'Vous venez de rejoindre l\'equipe.');

      $mail = Doctrine::getTable('mail')->findOneByName('mail_invite_acceptplayer');
      $message = $this->getMailer()->compose();
      $message->setSubject($mail->getSubject());
      $message->setTo($u->getEmailAddress());
      $message->setFrom($mail->getEmail());
      $content = str_replace("%TEAM%", $team->getName(), $mail->getContent());
      $message->setBody($content);
      $this->getMailer()->send($message);
      $this->redirect('team/index');
    }
    else
    {
      $this->getUser()->setFlash('success', 'Vous devez quitter votre equipe actuelle pour pouvoir en rejoindre une autre.');
      $this->redirect('invite/index');
    }
  }

  public function executeRefusePlayer(sfWebRequest $request)
  {
        $invite = new Invite();
        $invite = Doctrine::getTable('invite')->findOneByIdInvite($request->getParameter('id'));
        $invite->setRefuseInvite($request->getParameter('id', ''));
        $invite->setFalseInvite($request->getParameter('id', ''));
        $u = Doctrine::getTable('sfGuardUser')
                        ->getUser($invite->getUserId());
        $team = doctrine::getTable('team')->findOneByIdTeam($invite->getTeamId());
        $this->getUser()->setFlash('warning', 'Vous avez refuse l\'invitation de l\'equipe.');

        $mail = Doctrine::getTable('mail')->findOneByName('mail_invite_refuseplayer');
        $message = $this->getMailer()->compose();
        $message->setSubject($mail->getSubject());
        $message->setTo($u->getEmailAddress());
        $message->setFrom($mail->getEmail());
        $content = str_replace("%TEAM%", $team->getName(), $mail->getContent());
        $message->setBody($content);
        $this->getMailer()->send($message);
        $this->redirect('invite/index');
    }

    public function executeAddFriend(sfWebRequest $request) {
        $user = Doctrine::getTable('sfGuardUser')->findOneByUsername($request->getParameter('username', ''));
        $this->forward404Unless($user);
        $invite = new Invite();
        $invite->setFriendId($user->getId());
        $invite->setUserId($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
        $invite->setAction('friend');
        $invite->save();
        $link = 'http://www.gamers-assembly.net/invite';
        $this->getUser()->setFlash('success', 'Le joueur a ete invite a etre votre ami. Un mail lui a ete envoye.');
        $u = doctrine::getTable('sfGuardUser')->findOneById($invite->getUserId());
        $mail = Doctrine::getTable('mail')->findOneByName('mail_invite_addfriend');
        $message = $this->getMailer()->compose();
        $message->setSubject($mail->getSubject());
        $message->setTo($user->getEmailAddress());
        $message->setFrom($mail->getEmail());
        $content = str_replace("%USER%", $u->getUsername(), $mail->getContent());
        $content = str_replace("%LINK%", $link, $content);
        $message->setBody($content);
        $this->getMailer()->send($message);
        $this->redirect('user/view?username=' . $user->getUsername());
    }

    public function executeAcceptFriend(sfWebRequest $request) {
        $invite = Doctrine::getTable('invite')->findOneByIdInvite($request->getParameter('id', ''));
        $friend = new Friend();
        $friend->setUserId($invite->getUserId());
        $friend->setFriendId($invite->getFriendId());
        $friend->save();

        $friend = new Friend();
        $friend->setUserId($invite->getFriendId());
        $friend->setFriendId($invite->getUserId());
        $friend->save();
        /*         * * */
        $invite = new Invite();
        $invite->setAcceptInvite($request->getParameter('id', ''));
        $invite->setFalseInvite($request->getParameter('id', ''));
        $u = Doctrine::getTable('sfGuardUser')
                        ->getUser($invite->getUserId());
        $y = Doctrine::getTable('sfGuardUser')
                        ->getUser($invite->getFriendId());

        $mail = Doctrine::getTable('mail')->findOneByName('mail_invite_acceptfriend');
        $message = $this->getMailer()->compose();
        $message->setSubject($mail->getSubject());
        $message->setTo($u->getEmailAddress());
        $message->setFrom($mail->getEmail());
        $content = str_replace("%PSEUDO%", $y->getUsername(), $mail->getContent());
        $message->setBody($content);
        $this->getMailer()->send($message);

        $mail = Doctrine::getTable('mail')->findOneByName('mail_invite_acceptfriend');
        $message = $this->getMailer()->compose();
        $message->setSubject($mail->getSubject());
        $message->setTo($y->getEmailAddress());
        $message->setFrom($mail->getEmail());
        $content = str_replace("%PSEUDO%", $u->getUsername(), $mail->getContent());
        $message->setBody($content);
        $this->getMailer()->send($message);


        $this->getUser()->setFlash('success', 'Vous avez accepte l\'invitation du joueur.');
        $this->redirect('invite/index');
    }

    public function executeRefuseFriend(sfWebRequest $request) {
        $invite = new Invite();
        $invite->setRefuseInvite($request->getParameter('id', ''));
        $invite->setFalseInvite($request->getParameter('id', ''));
        $y = Doctrine::getTable('sfGuardUser')
                        ->getUser($invite->getUserId());
        $u = Doctrine::getTable('sfGuardUser')
                        ->getUser($invite->getFriendId());
        $mail = Doctrine::getTable('mail')->findOneByName('mail_invite_refusefriend');
        $message = $this->getMailer()->compose();
        $message->setSubject($mail->getSubject());
        $message->setTo($y->getEmailAddress());
        $message->setFrom($mail->getEmail());

        $content = str_replace("%PSEUDO%", $u->getUsername(), $mail->getContent());
        $message->setBody($content);
        $this->getMailer()->send($message);
        $this->getUser()->setFlash('warning', 'Vous avez refuse l\'invitation du joueur.');
        $this->redirect('invite/index');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($invite = Doctrine::getTable('invite')->find(array($request->getParameter('id_invite'))), sprintf('Object invite does not exist (%s).', $request->getParameter('id_invite')));
        $invite->delete();

        $this->redirect('invite/index');
    }

}
