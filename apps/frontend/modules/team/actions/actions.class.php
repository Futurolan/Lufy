<?php

/**
 * team actions.
 *
 * @package    lufy
 * @subpackage team
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class teamActions extends FrontendActions {

    public function executeView(sfWebRequest $request) {
        $this->team = Doctrine::getTable('Team')->findOneBySlug($request->getParameter('slug', ''));
        $this->forward404Unless($this->team);
        $this->alreadyInTournament = Doctrine::getTable('team')
                        ->isAlreadyInTournament();

        $this->admins = Doctrine::getTable('team')
                        ->getAdminTeam($this->team->getIdTeam());


        $this->captains = Doctrine_Query::create()
                        ->from('teamPlayer')
                        ->where('is_captain = 1')
                        ->andWhere('team_id = ' . $this->team->getIdTeam())
                        ->execute();

        $this->joueurs = Doctrine_Query::create()
                        ->from('teamPlayer')
                        ->where('is_player = 1')
                        ->andWhere('team_id = ' . $this->team->getIdTeam())
                        ->execute();

        $this->autres = Doctrine_Query::create()
                        ->from('teamPlayer')
                        ->where('is_player = 0')
                        ->andWhere('is_captain = 0')
                        ->andWhere('team_id = ' . $this->team->getIdTeam())
                        ->execute();
        $this->tournaments = Doctrine_Query::create()
                        ->select('*')
                        ->from('tournamentSlot t1, tournament t2')
                        ->where('t1.tournament_id = t2.id_tournament')
                        ->andWhere('t1.team_id = ' . $this->team->getIdTeam())
                        ->execute();
    }

    public function executeIndex(sfWebRequest $request) {

        if ($this->getUser()->isAuthenticated()) {
            $isInTeam = Doctrine::getTable('team')
                            ->isInTeam($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
            if ($isInTeam == true):
                $this->q = Doctrine::getTable('sfGuardUser')
                                ->isCaptain();
                $this->a = Doctrine::getTable('sfGuardUser')
                                ->isAdmin();
                if ($this->q == true || $this->a == true) {
                    $this->droits = true;
                } else {
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

	    /************************/
	    if ($this->getUser()->getAttribute('tmp_tournament_id', array())) {
		$this->tournament_selected = Doctrine_Core::getTable('tournament')->findOneByIdTournament($this->getUser()->getAttribute('tmp_tournament_id', array()));
	    }
        }
    }

    public function executeDeletePlayer(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($team_player = Doctrine::getTable('teamPlayer')->findOneByUserId(array($request->getParameter('user_id'))), sprintf('Object team_player does not exist (%s).', $request->getParameter('id_team_player')));
        $team = doctrine::getTable('team')->findOneByIdTeam($team_player->getTeamId());

        $mail = Doctrine::getTable('mail')->findOneByName('mail_team_deleteplayer');
        $message = $this->getMailer()->compose();
        $message->setSubject($mail->getSubject());
        $message->setTo($team_player->getSfGuardUser()->getEmailAddress());
        $message->setFrom($mail->getEmail());
        $content = str_replace("%TEAM%", $team->getName(), $mail->getContent());
        $content = str_replace("%PSEUDO%", $team_player->getSfGuardUser()->getUsername(), $content);
        $message->setBody($content);
        $this->getMailer()->send($message);

        $team_player->delete();
        $this->getUser()->setFlash('success', 'L\'utilisateur a ete supprime de l\'equipe, ce dernier a recu un mail.');
        $this->redirect('team/index');
    }

    public function executeDeleteTeam(sfWebRequest $request) {
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
                    if ($commande) $commande->delete();
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

    public function executeNew(sfWebRequest $request) {

        $this->form = new createTeamForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new createTeamForm();

        $this->processNewTeamForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        if ($this->getUser()->isAuthenticated()) {

            $q = Doctrine::getTable('sfGuardUser')
                            ->isCaptain();
            $a = Doctrine::getTable('sfGuardUser')
                            ->isAdmin();
            if ($q == true || $a == true) {
                $team = Doctrine::getTable('teamPlayer')->findOneByUserId($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
                $this->forward404Unless($teamObject = Doctrine::getTable('team')->findOneByIdTeam($team->getTeamId()));
                $this->form = new editTeamForm($teamObject);
            } else {
                $this->getUser()->setFlash('error', 'Vous n\'avez pas les droits pour cette action, vous devez etre Capitaine ou Admin de la team.');
                $this->redirect('team/index');
            };
        } else {
            $this->getUser()->setFlash('error', 'Vous devez etre authentifie pour continuer');
            $this->redirect('/login');
        };
    }

    public function executeUpdate(sfWebRequest $request) {

        $this->forward404Unless($request->isMethod(sfRequest::POST));
        $team = Doctrine::getTable('teamPlayer')->findOneByUserId($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
        $this->forward404Unless($teamObject = Doctrine::getTable('team')->findOneByIdTeam($team->getTeamId()));



        $this->form = new editTeamForm($teamObject);

        $this->processForm($request, $this->form);
        $this->setTemplate('edit');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $team = $form->save();

            $this->redirect('team/index');
        }
    }

    protected function processNewTeamForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $team = $form->save();
            $team->setAdminteamId($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
            $team->save();

            Doctrine::getTable('teamPlayer')
                    ->addPlayer($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'), $team->getIdTeam());



            $y = Doctrine::getTable('sfGuardUser')->getUser($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
            $mail = Doctrine::getTable('mail')->findOneByName('mail_team_new');
            $message = $this->getMailer()->compose();
            $message->setSubject($mail->getSubject());
            $message->setTo($y->getEmailAddress());
            $message->setFrom($mail->getEmail());
            $content = str_replace("%TEAM%", $team->getName(), $mail->getContent());
            $content = str_replace("%PSEUDO%", $y->getUsername(), $content);
            $message->setBody($content);
            $this->getMailer()->send($message);
            $this->redirect('team/index');
        }
    }

    public function executeManagement(sfWebRequest $request) {
	if ($isvalid = Doctrine::getTable('tournamentSlot')->getTournamentSlot($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'))) {
	    if ($isvalid->getStatus() == 'valide') {
	        $this->getUser()->setFlash('error', 'Vous ne pouvez pas modifier la composition d\'une equipe validee.');
	        $this->redirect('team/index');
	        exit;
	    }
        }

        $this->q = Doctrine::getTable('sfGuardUser')
                        ->isCaptain();
        $this->a = Doctrine::getTable('sfGuardUser')
                        ->isAdmin();
        if ($this->q == true || $this->a == true) {
            $this->droits = true;
        } else {
            $this->droits = false;
            $this->getUser()->setFlash('error', 'Vous n\'avez pas les droits pour acceder a cette section.');
            $this->redirect('team/index');
        };
        $this->alreadyInTournament = Doctrine::getTable('team')->isAlreadyInTournament();
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
	if($this->alreadyInTournament)
	{
		$teamplayer=new TeamPlayer();
		$team = new Team();
		
		$tournamentslot = Doctrine_Core::getTable('tournamentSlot')->findOneByTeamId($this->team->getTeamId());
		$tournament =   Doctrine_Core::getTable('tournament')->findOneByIdTournament($tournamentslot->getTournamentId());
		$this->countplayer = $teamplayer->countPlayer($this->team->getTeamId());
		$this->countTournamentPlayer = $tournament->getPlayerPerTeam();
		//$this->isgoodnbplayer = $this->isGoodNbPlayer($teamplayer->countPlayer($this->team->getTeamId()),$tournament->getPlayerPerTeam()); 
	}
    }

    public function executeManagementIsPlayer(sfWebRequest $request) {
        $this->forward404Unless($teamplayer = Doctrine::getTable('teamPlayer')->findOneByUserId($request->getParameter('user_id', '')));
        if ($teamplayer->getIsPlayer() == 0):
            Doctrine::getTable('teamPlayer')
                    ->SetIsPlayer($teamplayer->getIdTeamPlayer());
        elseif ($teamplayer->getIsPlayer() == 1):
            Doctrine::getTable('teamPlayer')
                    ->UnsetIsPlayer($teamplayer->getIdTeamPlayer());
        endif;
        $this->redirect('team/management');
    }

    public function executeManagementIsCaptain(sfWebRequest $request) {
        $this->forward404Unless($teamplayer = Doctrine::getTable('teamPlayer')->findOneByUserId($request->getParameter('user_id', '')));
        if ($teamplayer->getIsCaptain() == 0):
            Doctrine::getTable('teamPlayer')
                    ->SetIsCaptain($teamplayer->getIdTeamPlayer());
        elseif ($teamplayer->getIsCaptain() == 1):
            Doctrine::getTable('teamPlayer')
                    ->UnsetIsCaptain($teamplayer->getIdTeamPlayer());
        endif;
        $this->redirect('team/management');
    }


	public function isGoodNbPlayer($nbPlayerTeam,$nbPlayerTournament)
	   {
		if($nbPlayerTeam > $nbPlayerTournament)
		{
			return false;
		}
		else
		{
			return true;
		}
	   }
}
