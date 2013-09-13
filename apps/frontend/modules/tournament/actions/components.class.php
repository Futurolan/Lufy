<?php

class tournamentComponents extends sfComponents
{

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeNext(sfWebRequest $request)
  {
    $id_event = Doctrine::getTable('event')->getCurrent()->getIdEvent();

    $this->tournaments = Doctrine_Query::create()
      ->from('Tournament t')
      ->leftJoin('t.Event e')
      ->leftJoin('t.TournamentSlot ts')
      ->where('e.id_event = ?', $id_event)
      ->andWhere('is_active = 1')
      ->execute();
  }
}
