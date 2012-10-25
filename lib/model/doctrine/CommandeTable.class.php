<?php

class CommandeTable extends Doctrine_Table {

    public static function getInstance() {
        return Doctrine_Core::getTable('Commande');
    }
    /* Utile pour gérer les licences dans le champs reduction
    public function addReduction($id_commande, $licence_masters) {
        $commande = Doctrine::getTable('commande')->findOneByIdCommande($id_commande);
        if ($commande->getReduction()):
        $licences = explode(';', $commande->getReduction());
        $n = count($licences);
        $licences[$n] = $licence_masters;
        $reduction = implode(';', $licences);
        else:
        $licences[0] = $licence_masters;
        $reduction = implode(';', $licences);
        endif;

        Doctrine_Query::create()
                ->update('Commande')
                ->set('reduction', '?', $reduction)
                ->where('id_commande = ' . $id_commande)
                ->execute();

    }*/
    public function setReduction($id_commande, $reduction) {
        Doctrine_Query::create()
                ->update('Commande')
                ->set('reduction', '?', $reduction)
                ->where('id_commande = ' . $id_commande)
                ->execute();

    }

}