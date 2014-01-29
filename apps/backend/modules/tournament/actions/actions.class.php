<?php

/**
 * tournament actions.
 *
 * @package    lufy
 * @subpackage tournament
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tournamentActions extends BackendActions
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
