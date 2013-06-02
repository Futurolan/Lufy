<?php

class eventComponents extends sfComponents
{

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeNextevent(sfWebRequest $request)
  {
    $this->nextevents = Doctrine_Query::create()
<<<<<<< HEAD
      ->select('e.name, e.start_at, e.end_at, e.start_registration_at, e.end_registration_at')
      ->from('event e')
      ->orderBy('e.end_at DESC')
      ->limit($this->getRequestParameter('limit', 1))
      ->execute();
  }


  public function executeLast(sfWebRequest $request)
  {
    $this->event = Doctrine::getTable('Event')->getCurrent();
  }

}
=======
            ->select('e.name, e.start_at, e.end_at, e.start_registration_at, e.end_registration_at')
            ->from('event e')
            ->orderBy('e.end_at DESC')
            ->limit($this->getRequestParameter('limit', 1))
            ->execute();
  }

}
>>>>>>> dafc8f9ec03adf43cd25c906338ac0ca6f67ae36
