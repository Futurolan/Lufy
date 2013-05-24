<?php

class VarConfigTable extends Doctrine_Table {

    public static function getInstance() {
        return Doctrine_Core::getTable('VarConfig');
    }

    public function getEanNextPlayer() {
        $q = Doctrine_Query::create()
                        ->select('value')
                        ->from('VarConfig')
                        ->where('name = ?','ean_next_player')
                        ->limit(1)
                        ->execute();
        return $q->getFirst()->getFirst();
    }

    public function updateEanNextPlayer($licence) {
        Doctrine_Query::create()
                ->update('varConfig')
                ->set('value', '?', $licence)
                ->where('name = ?','ean_next_player')
                ->execute();
    }
}