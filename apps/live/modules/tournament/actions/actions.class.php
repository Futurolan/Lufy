<?php

/**
 * tournament actions.
 *
 * @package    lufy
 * @subpackage tournament
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tournamentActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        $this->lastevents = Doctrine_Query::create()
                        ->select('*')
                        ->from('event e')
                        ->orderBy('e.end_at DESC')
                        ->limit($this->getRequestParameter('limit', 1))
                        ->execute();

        $this->tournaments = Doctrine_Query::create()
                        ->select('*')
                        ->from('tournament t1, game g, event e')
                        ->where('t1.is_active = 1')
                        ->andWhere('t1.game_id = g.id_game')
                        ->andWhere('t1.event_id = e.id_event')
                        ->orderBy('e.end_at DESC')
                        ->execute();
    }


    public function executeRedirect(sfWebRequest $request) {
        $tournament = Doctrine_Core::getTable('tournament')->findOneByIdTournament($request->getParameter('id_tournament'));
        $this->forward404Unless($tournament);
        if ($tournament->getPlayerPerTeam() > 1) {
	    $this->getUser()->setAttribute('tmp_tournament_id', $tournament->getIdTournament());
	    $this->redirect('team/index');
        }
	else {
	$has_team = Doctrine::getTable('teamPlayer')->findOneByUserId($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
	if (!$has_team) {
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

	$this->redirect('tournament/reglement?slug='.$tournament->getSlug());
	}
    }


    public function executeView(sfWebRequest $request) {
//        $this->redirectUnless($team=Doctrine::getTable('teamPlayer')->findOneByUserId($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser')), 'team', 'index');
        $this->page = Doctrine::getTable('page')->findOneBySlug($request->getParameter('slug', ''));
        $this->tournament = Doctrine::getTable('Tournament')->findOneBySlug($request->getParameter('slug', ''));
        $this->forward404Unless($this->tournament);
        $this->event = Doctrine::getTable('Event')->findOneByIdEvent($this->tournament->getEventId());
        $this->tadmins = Doctrine::getTable('tournamentAdmin')->createQuery('a')->where('tournament_id ='.$this->tournament->getIdTournament())->execute();
        $teamplayer=new TeamPlayer();
/*        if ($team->getTeamId()):
            $this->isgoodnbplayer = $this->isGoodNbPlayer($teamplayer->countPlayer($team->getTeamId()),$this->tournament->getPlayerPerTeam()); 
        endif;
*/
    }
    
    public function executeList(sfWebRequest $request) {
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

    public function executeReglement(sfWebRequest $request) {
        $this->tournament = Doctrine::getTable('Tournament')->findOneBySlug($request->getParameter('slug', ''));
        $this->forward404Unless($this->tournament);
        $this->reglement = Doctrine::getTable('varConfig')->findOneByName('reglement');
    }

    public function executeAddTeam(sfWebRequest $request) {
        $this->form = new addTeamForm();
        if ($request->isMethod(sfRequest::POST)) {
            $this->processFormTournament($request, $this->form);
            $this->redirect('team/index');
        }
    }

    protected function processFormTournament(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $team = Doctrine::getTable('teamPlayer')->findOneByUserId($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
            $tournament = $form->save();
            $tournament->setTeamId($team->getTeamId());
            $tournament->setUserId($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
            $tournament->save();
            $this->getUser()->setFlash('success', 'L equipe est inscrite au tournoi');
            $this->redirect('team/index');
        }
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
