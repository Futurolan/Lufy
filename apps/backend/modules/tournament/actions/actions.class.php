<?php

/**
 * tournament actions.
 *
 * @package    lufy
 * @subpackage tournament
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tournamentActions extends sfActions
{

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->tournaments = Doctrine::getTable('tournament')
            ->createQuery('a')
            ->orderBy('position ASC')
            ->execute();
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeView(sfWebRequest $request)
  {
    $this->forward404Unless(
            $this->tournament = Doctrine::getTable('tournament')->findOneBySlug(
            $request->getParameter('slug')
            )
    );
    $this->admins = Doctrine::getTable('tournamentAdmin')->createQuery('a')->where('tournament_id =' . $this->tournament->getIdTournament())->execute();
    /*        $this->admins = Doctrine::getTable('tournamentAdmin')->findByTournamentId(
      $this->tournament->getIdTournament()
      ); */
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeNew(sfWebRequest $request)
  {
    $this->form = new tournamentForm();
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new tournamentForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($tournament = Doctrine::getTable('tournament')->find(array($request->getParameter('id_tournament'))), sprintf('Object tournament does not exist (%s).', $request->getParameter('id_tournament')));
    $this->form = new tournamentForm($tournament);
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($tournament = Doctrine::getTable('tournament')->find(array($request->getParameter('id_tournament'))), sprintf('Object tournament does not exist (%s).', $request->getParameter('id_tournament')));
    $this->form = new tournamentForm($tournament);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeUpdatePosition(sfWebRequest $request)
  {
    $tournament = new Tournament();
    $tournament->updatePosition($request->getPostParameter('tournament'));
    $this->getUser()->setFlash('success', 'L\'ordre des tournois a ete mis a jour.');
    $this->redirect('tournament/index');
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeSetStatus(sfWebRequest $request)
  {
    $id_tournament = $request->getParameter('id_tournament');
    $tournament = Doctrine::getTable('tournament')->findOneByIdTournament($id_tournament);
    $this->forward404Unless($tournament);
    if ($tournament->getIsActive() == 1):
      $tournament->setHidden($id_tournament);
    else:
      $tournament->setVisible($id_tournament);
    endif;
    $this->getUser()->setFlash('success', 'Le statut a été modifié.');
    $this->redirect('tournament/index');
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($tournament = Doctrine::getTable('tournament')->find(array($request->getParameter('id_tournament'))), sprintf('Object tournament does not exist (%s).', $request->getParameter('id_tournament')));
    $tournamentSlots = Doctrine::getTable('tournamentSlot')->findByTournamentId($request->getParameter('id_tournament'));

    /** Suppression en cascade des slots, commandes, paiements et des admisn tournois * */
    foreach ($tournamentSlots as $tournamentSlot):
      $commandes = Doctrine::getTable('commande')->findByTournamentSlotId($tournamentSlot->getIdTournamentSlot());
      foreach ($commandes as $commande):
        $payements = Doctrine::getTable('payement')->findByCommandeId($commande->getIdCommande());
        foreach ($payements as $payement):
          $payement->delete();
        endforeach;
        $commande->delete();
      endforeach;
      $tournamentSlot->delete();
    endforeach;
    $tournamentAdmins = Doctrine::getTable('tournamentAdmin')->findByTournamentId($request->getParameter('id_tournament'));
    foreach ($tournamentAdmins as $tournamentAdmin):
      $tournamentAdmin->delete();
    endforeach;
    /**     * */
    $tournament->delete();

    $this->redirect('tournament/index');
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {


      $tn = Doctrine::getTable('tournament')->findOneByIdTournament($request->getPostParameter('tournament[id_tournament]'));
      if ($tn):
        $position = $tn->getReservedSlot();
        $diffRes = $tn->getReservedSlot();
        $diff = $tn->getNumberTeam();
      endif;

      $tournament = $form->save();
      $positionMoulinette = $tournament->getReservedSlot();
      if ($tn):
        $diffRes = $diffRes - $tournament->getReservedSlot();
        $diff = $diff - $tournament->getNumberTeam();
      endif;
      // SI pas de slot ALORS generation des slots
      $q = Doctrine::getTable('tournamentSlot')
              ->verifNoSlot($tournament->getIdTournament());
      if ($q == true):
        $nb_team = $tournament->getNumberTeam();
        $nb_reserve = $tournament->getReservedSlot();
        $nb_team_libre = $nb_team - $nb_reserve;

        for ($i = 1; $i <= $nb_reserve; $i++):
          $slot = new TournamentSlot();
          $slot->setTournamentId($tournament->getIdTournament());
          $slot->setPosition($i);
          $slot->setStatus('reserve');
          $slot->save();
        endfor;

        $j = $i;

        for ($i = $i; $i < $nb_team_libre + $j; $i++):
          $slot = new TournamentSlot();
          $slot->setTournamentId($tournament->getIdTournament());
          $slot->setPosition($i);
          $slot->setStatus('libre');
          $slot->save();
        endfor;
      else:

        $slots = Doctrine_Query::create()
                ->select('*')
                ->from('tournamentSlot')
                ->where('tournament_id =' . $tournament->getIdTournament())
                ->orderBy('position ASC')
                ->execute();
        // SI il y a plus de SLOTS RESERVED
        if ($diffRes < 0):
          for ($diffRes = $diffRes; $diffRes < 0; $diffRes++)
          {
            $position++;
            Doctrine::getTable('tournamentSlot')
                    ->addReserved($position, $tournament->getIdTournament());
            $g = Doctrine::getTable('tournamentSlot')
                    ->SlotLibreFin($tournament->getIdTournament());

            if (isset($g))
            {
              Doctrine::getTable('tournamentSlot')
                      ->deleteSlot($g[0]->getIdTournamentSlot());
              $m = $position;
              foreach ($slots as $slot):
                if ($slot->getStatus() != 'reserve' && 'attente'):
                  $m++;
                  Doctrine::getTable('tournamentSlot')
                          ->updatePosSlots($slot->getIdTournamentSlot(), $m);
                endif;
              endforeach;
            } else
            {
              $l = Doctrine::getTable('tournamentSlot')
                      ->SlotInscritFin($tournament->getIdTournament());
              if (isset($l))
              {
                Doctrine::getTable('tournamentSlot')
                        ->setAttente($l[0]->getIdTournamentSlot());
                $m = $position;
                foreach ($slots as $slot):
                  if ($slot->getStatus() != 'reserve'):
                    $m++;
                    Doctrine::getTable('tournamentSlot')
                            ->updatePosSlots($slot->getIdTournamentSlot(), $m);
                  endif;
                endforeach;
              } else
              {
                $this->getUser()->setFlash('error', 'Impossible d\'ajouter des slots reserved ,aucun slot LIBRE ou INSCRIT trouve : FAIL');
                $this->redirect('tournament/index');
              };
            };
          };
        // SI il y a moins de SLOTS RESERVED
        elseif ($diffRes > 0):
          for ($diffRes = $diffRes; $diffRes > 0; $diffRes--)
          {
            $d = Doctrine::getTable('tournamentSlot')
                    ->selectReservedFin($tournament->getIdTournament());
            if ($d->getIdTournamentSlot()):
              Doctrine::getTable('tournamentSlot')
                      ->setLibre($d->getIdTournamentSlot());
            endif;
          };
          $slot2 = Doctrine::getTable('tournamentSlot')
                  ->selectSlots($tournament->getIdTournament());

          foreach ($slot2 as $slot):
            if ($slot->getStatus() == 'valide'):
              $positionMoulinette = $positionMoulinette + 1;
              Doctrine::getTable('tournamentSlot')
                      ->setPosition($positionMoulinette, $slot->getIdTournamentSlot());
            endif;
          endforeach;
          foreach ($slot2 as $slot):
            if ($slot->getStatus() == 'inscrit'):
              $positionMoulinette = $positionMoulinette + 1;
              Doctrine::getTable('tournamentSlot')
                      ->setPosition($positionMoulinette, $slot->getIdTournamentSlot());
            endif;
          endforeach;
          foreach ($slot2 as $slot):
            if ($slot->getStatus() == 'libre'):
              $positionMoulinette = $positionMoulinette + 1;
              Doctrine::getTable('tournamentSlot')
                      ->setPosition($positionMoulinette, $slot->getIdTournamentSlot());

              $this->getUser()->setFlash('success', 'moulinette ');

            endif;
          endforeach;
        endif;
        // SI il y a plus de SLOTS
        if ($diff < 0):
          $mode_ins = Doctrine::getTable('varConfig')->findOneByName('inscription_mode');
          if ($mode_ins['value'] == 'ffa'):
            for ($diff = $diff; $diff < 0; $diff++)
            {
              Doctrine::getTable('tournamentSlot')
                      ->addSlotFin($tournament->getIdTournament(), $diff);
            };
            foreach ($slots as $slot):
              if ($slot->getStatus() == 'attente'):
                Doctrine::getTable('tournamentSlot')
                        ->updateAttente($slot->getIdTournamentSlot(), $slot->getTournamentId(), $u);
              endif;
            endforeach;
            $this->getUser()->setFlash('success', 'Ajout de slot au tournoi : OK');
          /*
           * Algo
           * On ajoute autant de slot que necessaire juste avant la liste d'attente status=libre
           * Si il y a des slot en liste d'attente
           *      on update toutes les positions
           */
          elseif ($mode_ins['value'] == 'rotation'):
            for ($diff = $diff; $diff < 0; $diff++)
            {
              Doctrine::getTable('tournamentSlot')
                      ->addSlotFin($tournament->getIdTournament(), $diff);
            };


            foreach ($slots as $slot):
              if ($slot->getStatus() == 'attente')
              {
                $k = Doctrine::getTable('tournamentSlot')
                        ->SlotLibre($tournament->getIdTournament());

                if (isset($k)):
                  Doctrine::getTable('tournamentSlot')
                          ->setTeam($k[0]->getIdTournamentSlot(), $slot->getTeamId());
                  Doctrine::getTable('tournamentSlot')
                          ->setInscrit($k[0]->getIdTournamentSlot());
                  Doctrine::getTable('tournamentSlot')
                          ->updateCommande($slot->getIdTournamentSlot(), $k[0]->getIdTournamentSlot());
                  Doctrine::getTable('tournamentSlot')
                          ->deleteSlot($slot->getIdTournamentSlot());
                  Doctrine::getTable('tournamentSlot')
                          ->updateAttente($slot->getIdTournamentSlot(), $slot->getTournamentId(), $u);
                endif;
                Doctrine::getTable('tournamentSlot')
                        ->updateAttente($slot->getIdTournamentSlot(), $slot->getTournamentId(), $u);
              };
            endforeach;
            $this->getUser()->setFlash('success', 'Ajout de slot au tournoi : OK');
          /*
           * Algo
           * On ajoute autant de slot que necessaire juste avant la liste d'attente status=libre
           * Si il y a des slot en liste d'attente
           *      on remonte les slot en attente dans les slots libres
           * on update la liste d'attente
           */

          endif;
        // SI il y a moins de SLOTS
        elseif ($diff > 0):

          $i = 0;
          for ($diff = $diff; $diff > 0; $diff--)
          {
            $k = Doctrine::getTable('tournamentSlot')
                    ->SlotLibreFin($tournament->getIdTournament());

            if (isset($k))
            {
              Doctrine::getTable('tournamentSlot')
                      ->deleteSlot($k[0]->getIdTournamentSlot());
              foreach ($slots as $slot):
                if ($slot->getStatus() == 'attente'):
                  Doctrine::getTable('tournamentSlot')
                          ->updateAttente($slot->getIdTournamentSlot(), $slot->getTournamentId(), $u);
                endif;
              endforeach;
            } else
            {
              $l = Doctrine::getTable('tournamentSlot')
                      ->SlotInscritFin($tournament->getIdTournament());
              if (isset($l))
              {
                Doctrine::getTable('tournamentSlot')
                        ->setAttente($l[0]->getIdTournamentSlot());
              }
              else
              {
                $this->getUser()->setFlash('error', 'Aucun slot LIBRE ou INSCRIT trouve : FAIL');
                $this->redirect('tournament/index');
              };
            };
          };
          $this->getUser()->setFlash('success', 'Diminution du nombre de slot du tournoi : OK');
        /*
         * Algo
         * on trie les slots par position DEFSC
         * Si il y a des slots status=libre
         *  on les supprimes
         * Sinon il y a des slots status= inscrit
         *  on ajoute un slot en debut de liste d'attente
         *  on deplace la team du dernier slot 'inscrit' vers le slot precedement ajouté
         *  on delete le dernier slot status= inscrit
         *  on update la position de la liste d'attente
         */
        // SI il y a autant de SLOTS
        elseif ($diff == 0 && $diffRes == 0):
          if ($q == true):
            $this->getUser()->setFlash('success', 'Generation des slots du tournoi avec succes');
          else:
            $this->getUser()->setFlash('success', 'Aucun changement de slot du tournoi');
          endif;
        endif;

      endif;





      $this->redirect('tournament/index');
    }
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeCheck(sfWebRequest $request)
  {

    $l = Doctrine::getTable('event')
            ->getLastEvent();

    $this->tournaments = Doctrine_Query::create()
            ->from('tournament')
            ->where('event_id =' . $l)
            ->orderBy('id_tournament ASC')
            ->execute();
  }

}
