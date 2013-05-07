<?php

/**
 * tournament_slot actions.
 *
 * @package    lufy
 * @subpackage tournament_slot
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tournament_slotActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {

        $this->lastevent = Doctrine_Query::create()
                        ->select('*')
                        ->from('event e')
                        ->orderBy('e.end_at DESC')
                        ->limit($this->getRequestParameter('limit', 1))
                        ->execute();

        $this->tournaments = Doctrine::getTable('Tournament')
                        ->createQuery('a')
                        ->where('event_id = ' . $this->lastevent[0]->getIdEvent())
                        ->execute();
    }

    public function executeDashboard(sfWebRequest $request) {

        $this->lastevent = Doctrine_Query::create()
                        ->select('*')
                        ->from('event e')
                        ->orderBy('e.end_at DESC')
                        ->limit($this->getRequestParameter('limit', 1))
                        ->execute();

        $this->tournaments = Doctrine::getTable('Tournament')
                        ->createQuery('a')
                        ->where('event_id = ' . $this->lastevent[0]->getIdEvent())
                        ->execute();

        $this->setLayout('nologin');
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new TournamentSlotForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new TournamentSlotForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($tournament_slot = Doctrine::getTable('TournamentSlot')->find(array($request->getParameter('id_tournament_slot'))), sprintf('Object tournament_slot does not exist (%s).', $request->getParameter('id_tournament_slot')));
        $this->form = new TournamentSlotForm($tournament_slot);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($tournament_slot = Doctrine::getTable('TournamentSlot')->find(array($request->getParameter('id_tournament_slot'))), sprintf('Object tournament_slot does not exist (%s).', $request->getParameter('id_tournament_slot')));
        $this->form = new TournamentSlotForm($tournament_slot);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($tournament_slot = Doctrine::getTable('TournamentSlot')->find(array($request->getParameter('id_tournament_slot'))), sprintf('Object tournament_slot does not exist (%s).', $request->getParameter('id_tournament_slot')));
        $tournament_slot->delete();

        $this->redirect('tournament_slot/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $tournament_slot = $form->save();

            $this->redirect('tournament_slot/edit?id_tournament_slot=' . $tournament_slot->getIdTournamentSlot());
        }
    }

    public function executeTournament(sfWebRequest $request) {
        $this->tournament = Doctrine::getTable('tournament')->findOneBySlug($request->getParameter('slug', ''));
        $this->forward404Unless($this->tournament);
        $this->tournament_slots = Doctrine::getTable('TournamentSlot')
                        ->createQuery('a')
                        ->where('tournament_id = ' . $this->tournament->getIdTournament())
                        ->orderBy('position ASC')
                        ->execute();
    }

    public function executeSetLibre(sfWebRequest $request) {
        $this->tournament_slot = Doctrine::getTable('tournamentSlot')->findOneByIdTournamentSlot($request->getParameter('id_tournament_slot', ''));
        $this->forward404Unless($this->tournament_slot);

        Doctrine::getTable('tournamentSlot')
                ->setLibre($this->tournament_slot->getIdTournamentSlot());



        $this->getUser()->setFlash('success', 'Le slot est LIBRE');
        $this->redirect('tournament_slot/index');
    }

    public function executeSetValide(sfWebRequest $request) {
        $tournament_slot = Doctrine::getTable('tournamentSlot')->findOneByIdTournamentSlot($request->getParameter('id_tournament_slot', ''));
        $this->forward404Unless($tournament_slot);

        Doctrine::getTable('tournamentSlot')
                ->setValideAndPaid($tournament_slot->getIdTournamentSlot());
        $t = Doctrine::getTable('tournamentSlot')
                        ->getTournament($tournament_slot->getTournamentId());
        if ($tournament_slot->getStatus() == 'inscrit'):

            $slots = Doctrine::getTable('tournamentSlot')
                            ->selectSlots($t->getIdTournament());
            $pos = $t->getReservedSlot();

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

        elseif ($tournament_slot->getStatus() == 'attente'):
        // Si slot libre
        // recupérer la position du slot libre
        // supprimer le slot libre orderby position asc
        // update le slot en attente avec la pos
        // updateAttente() pour tout les slots en attente
        // Sinon
        //  recupère le slot 'inscrit' orderby position desc
        //  on le passe en 'attente'
        //  updateAttente() pour tout les slots en attente
        //  on updatela position du slot valide avec la pos du slot inscirt
        // endif
        endif;
        $players = Doctrine_Query::create()
                        ->from('teamplayer')
                        ->where('team_id = ' . $tournament_slot->getTeamId())
                        ->execute();


        foreach ($players as $player):
            $mail = Doctrine::getTable('mail')->findOneByName('mail_slot_valide');
            $message = $this->getMailer()->compose();
            $message->setSubject($mail->getSubject());
            $message->setTo($player->getSfGuardUser()->getEmailAddress());
            $message->setFrom($mail->getEmail());
            $team = Doctrine::getTable('team')->findOneByIdTeam($player->getTeamId());
            $content = str_replace("%TEAM%", $team->getName(), $mail->getContent());
            $content = str_replace("%TOURNAMENT%", $t->getName(), $content);
            $message->setBody($content);
            $this->getMailer()->send($message);
        endforeach;
        $this->getUser()->setFlash('success', 'Le slot est Valide. Les mails necessaires ont ete envoyes.');
        $this->redirect('tournament_slot/index');
    }

    public function executeSetFfa(sfWebRequest $request) {
        $i = '0';
        Doctrine::getTable('varConfig')->setFfa();
        $lastevent = Doctrine::getTable('event')
                        ->getLastEvent();
        $tournaments = Doctrine_Query::create()
                        ->from('tournament')
                        ->where('event_id = ' . $lastevent)
                        ->execute();
        foreach ($tournaments as $tournament):
            $slots = Doctrine_Query::create()
                            ->from('tournamentSlot')
                            ->where('tournament_id = ' . $tournament->getIdTournament())
                            ->orderBy('position ASC')
                            ->execute();
            $nbinscrit = 0;
            $nbattente = 0;
            $nblibre = 0;
            foreach ($slots as $slot):

                if ($slot->getStatus() == 'attente'):
                    $nbattente++;
                elseif ($slot->getStatus() == 'libre'):
                    $nblibre++;
                elseif ($slot->getStatus() == 'inscrit'):
                    $nbinscrit++;
                    Doctrine::getTable('tournamentSlot')
                            ->setAttente($slot->getIdTournamentSlot());
                endif;
            endforeach;
            $slots = Doctrine::getTable('tournamentSlot')
                            ->createQuery('a')
                            ->where('tournament_id = ' . $tournament->getIdTournament())
                            ->orderBy('position ASC')
                            ->execute();
            if ($nblibre == 0):
                foreach ($slots as $slot):
                    if ($slot->getStatus() == 'attente'):
                        Doctrine::getTable('tournamentSlot')
                                ->PositionUp($slot->getIdTournamentSlot(), $nbinscrit);
                    endif;
                endforeach;
                $diff = 0 - $nbinscrit;
                for ($diff = $diff; $diff < 0; $diff++):
                    Doctrine::getTable('tournamentSlot')
                            ->addSlotFin($tournament->getIdTournament(), $diff);
                endfor;
            elseif ($nbattente == 0):
                $nbsaut = $nbinscrit + $nblibre;
                foreach ($slots as $slot):
                    if ($slot->getStatus() == 'attente'):
                        Doctrine::getTable('tournamentSlot')
                                ->PositionUp($slot->getIdTournamentSlot(), $nbsaut);
                    endif;
                endforeach;
                $diff = 0 - $nbsaut;
                $stop = 0 - $nblibre;
                for ($diff = $diff; $diff < $stop; $diff++):
                    Doctrine::getTable('tournamentSlot')
                            ->addSlotFin($tournament->getIdTournament(), $diff);
                endfor;

            endif;
        endforeach;


        $this->getUser()->setFlash('success', 'Les inscriptions se derouleront desormais en mode FFA');
        $this->redirect('tournament_slot/index');
    }

    public function executeSetRotation(sfWebRequest $request) {
        $u = '0';
        Doctrine::getTable('varConfig')->setRotation();
        $lastevent = Doctrine::getTable('event')
                        ->getLastEvent();
        $tournaments = Doctrine_Query::create()
                        ->from('tournament')
                        ->where('event_id = ' . $lastevent)
                        ->execute();
        foreach ($tournaments as $tournament):
            $slots = Doctrine_Query::create()
                            ->from('tournamentSlot')
                            ->where('tournament_id = ' . $tournament->getIdTournament())
                            ->orderBy('position ASC')
                            ->execute();

            if (count($slots) > $tournament->getNumberTeam()):
                $nbattente = 0;
                $nbinscrit = 0;
                $nblibre = 0;
                foreach ($slots as $slot):

                    if ($slot->getStatus() == 'attente'):
                        $nbattente++;
                    elseif ($slot->getStatus() == 'inscrit'):
                        $nbinscrit--;
                    elseif ($slot->getStatus() == 'libre'):
                        $nblibre--;
                    endif;
                endforeach;

                foreach ($slots as $slot):
                    if ($slot->getStatus() == 'inscrit'):
                        Doctrine::getTable('tournamentSlot')
                                ->PositionUp($slot->getIdTournamentSlot(), $nbattente);
                        Doctrine::getTable('tournamentSlot')
                                ->setAttente($slot->getIdTournamentSlot());
                    elseif ($slot->getStatus() == 'attente'):
                        $saut = $nbinscrit + $nblibre;
                        Doctrine::getTable('tournamentSlot')
                                ->PositionUp($slot->getIdTournamentSlot(), $saut);

                    endif;
                endforeach;
                $slots = Doctrine_Query::create()
                                ->from('tournamentSlot')
                                ->where('tournament_id = ' . $tournament->getIdTournament())
                                ->orderBy('position ASC')
                                ->execute();

                foreach ($slots as $slot):
                    if ($slot->getStatus() == 'attente'):
                        if ($slot->getPosition() <= $tournament->getNumberTeam()):
                            Doctrine::getTable('tournamentSlot')
                                    ->setInscrit($slot->getIdTournamentSlot());
                        endif;
                    endif;
                endforeach;
                foreach ($slots as $slot):
                    if ($slot->getStatus() == 'libre'):
                        if ($slot->getPosition() > $tournament->getNumberTeam()):
                            $slot->delete();
                        else:
                            Doctrine::getTable('tournamentSlot')
                                    ->IfDoublonDelete($slot->getIdTournamentSlot());

                        endif;


                    endif;
                endforeach;

            endif;

        endforeach;


        $this->getUser()->setFlash('success', 'La ROTATION a ete effectue correctement');
        $this->redirect('tournament_slot/index');
    }

    public function executeUpdatePosition(sfWebRequest $request) {
        $tournament = Doctrine::getTable('tournament')->findOneBySlug($request->getParameter('slug', ''));
        $this->forward404Unless($tournament);

        $slots = Doctrine_Query::create()
                        ->from('tournamentSlot')
                        ->where('tournament_id = ' . $tournament->getIdTournament())
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

        $this->getUser()->setFlash('success', 'Les slots on ete range dans l\'ordre.');

        $this->redirect('tournament_slot/index');
    }

}
