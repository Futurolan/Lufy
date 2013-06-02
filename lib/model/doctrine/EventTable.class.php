<?php

class EventTable extends Doctrine_Table
{
  public static function getInstance()
  {
    return Doctrine_Core::getTable('Event');
  }

  public static function getCurrent()
  {
    $event = Doctrine_Query::create()
      ->from('Event e')
      ->orderBy('e.end_at DESC')
      ->limit(1)
      ->execute();

     if ($event->count() != 1)
     {
       return false;
     }
     else
     {
       return $event->getFirst();
     }
  }
}
