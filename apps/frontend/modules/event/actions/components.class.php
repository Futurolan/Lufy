<?php
class eventComponents extends sfComponents
{
  public function executeNextevent(sfWebRequest $request)
  {
	$this->nextevents = Doctrine_Query::create()
     ->select('e.name, e.start_at, e.end_at, e.start_registration_at, e.end_registration_at')
     ->from('event e')
     ->orderBy('e.end_at DESC')	 
	 ->limit($this->getRequestParameter('limit', 1))
     ->execute();
  }
}