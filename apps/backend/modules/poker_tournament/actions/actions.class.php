<?php

/**
 * poker_tournament actions.
 *
 * @package    lufy
 * @subpackage poker_tournament
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class poker_tournamentActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->poker_tournaments = Doctrine_Core::getTable('pokerTournament')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new pokerTournamentForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new pokerTournamentForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($poker_tournament = Doctrine_Core::getTable('pokerTournament')->find(array($request->getParameter('id_poker_tournament'))), sprintf('Object poker_tournament does not exist (%s).', $request->getParameter('id_poker_tournament')));
    $this->form = new pokerTournamentForm($poker_tournament);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($poker_tournament = Doctrine_Core::getTable('pokerTournament')->find(array($request->getParameter('id_poker_tournament'))), sprintf('Object poker_tournament does not exist (%s).', $request->getParameter('id_poker_tournament')));
    $this->form = new pokerTournamentForm($poker_tournament);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($poker_tournament = Doctrine_Core::getTable('pokerTournament')->find(array($request->getParameter('id_poker_tournament'))), sprintf('Object poker_tournament does not exist (%s).', $request->getParameter('id_poker_tournament')));
    $poker_tournament->delete();

    $this->redirect('poker_tournament/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $poker_tournament = $form->save();

      $this->redirect('poker_tournament/edit?id_poker_tournament='.$poker_tournament->getIdPokerTournament());
    }
  }
}
