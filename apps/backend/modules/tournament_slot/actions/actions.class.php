<?php

/**
 * tournament_slot actions.
 *
 * @package    lufy
 * @subpackage tournament_slot
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tournament_slotActions extends sfActions
{

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeIndex(sfWebRequest $request)
  {

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

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeDashboard(sfWebRequest $request)
  {

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

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeNew(sfWebRequest $request)
  {
    $this->form = new TournamentSlotForm();
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new TournamentSlotForm();

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
    $this->forward404Unless($tournament_slot = Doctrine::getTable('TournamentSlot')->find(array($request->getParameter('id_tournament_slot'))), sprintf('Object tournament_slot does not exist (%s).', $request->getParameter('id_tournament_slot')));
    $this->form = new TournamentSlotForm($tournament_slot);
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($tournament_slot = Doctrine::getTable('TournamentSlot')->find(array($request->getParameter('id_tournament_slot'))), sprintf('Object tournament_slot does not exist (%s).', $request->getParameter('id_tournament_slot')));
    $this->form = new TournamentSlotForm($tournament_slot);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($tournament_slot = Doctrine::getTable('TournamentSlot')->find(array($request->getParameter('id_tournament_slot'))), sprintf('Object tournament_slot does not exist (%s).', $request->getParameter('id_tournament_slot')));


    if ($tournament_slot->getIsValid() == 0 && $tournament_slot->getIsLocked() == 0)
    {
      $slug =$tournament_slot->getTournament()->getSlug();
      $tournament_slot->delete();
      $this->redirect('tournament_slot/tournament?slug=' . $slug);
    }
    else
    {
      $this->getUser()->setFlash('error', 'Avant de suprimer le slot vous devez déverrouiller et dé-valider léquipe.');
      $this->redirect('tournament_slot/edit?id_tournament_slot='.$tournament_slot->getIdTournamentSlot());   
    }
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
      $tournament_slot = $form->save();

      $this->redirect('tournament_slot/edit?id_tournament_slot=' . $tournament_slot->getIdTournamentSlot());
    }
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeTournament(sfWebRequest $request)
  {
    $this->tournament = Doctrine::getTable('tournament')->findOneBySlug($request->getParameter('slug', ''));
    $this->forward404Unless($this->tournament);
    $this->tournament_slots = Doctrine::getTable('TournamentSlot')
            ->createQuery('a')
            ->where('tournament_id = ' . $this->tournament->getIdTournament())
            ->execute();
  }

}
