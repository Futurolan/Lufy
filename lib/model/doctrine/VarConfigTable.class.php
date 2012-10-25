<?php

class VarConfigTable extends Doctrine_Table {

    public static function getInstance() {
        return Doctrine_Core::getTable('VarConfig');
    }

    public function setFfa() {
        Doctrine_Query::create()
                ->update('varConfig')
                ->set('value', '?', 'ffa')
                ->where('name = "inscription_mode"')
                ->execute();
    }

    public function setRotation() {
        Doctrine_Query::create()
                ->update('varConfig')
                ->set('value', '?', 'rotation')
                ->where('name = "inscription_mode"')
                ->execute();
    }

    public function getEanNextPlayer() {
        $q = Doctrine_Query::create()
                        ->from('VarConfig')
                        ->where('name = "ean_next_player"')
                        ->execute();
        return $q[0]->getValue();
    }
    
    public function updateEanNextPlayer($licence) {
        Doctrine_Query::create()
                ->update('varConfig')
                ->set('value', '?', $licence)
                ->where('name = "ean_next_player"')
                ->execute();
    }
}