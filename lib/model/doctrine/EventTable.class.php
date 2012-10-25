<?php

class EventTable extends Doctrine_Table {

    public static function getInstance() {
        return Doctrine_Core::getTable('Event');
    }

    public function getLastEvent() {
        $l = Doctrine_Query::create()
                ->from('event')
                ->orderBy('end_at DESC')
                ->limit('1')
                ->execute();
        return $l[0]->getIdEvent();
    }

}