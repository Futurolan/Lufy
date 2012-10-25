<?php

class tournamentComponents extends sfComponents {

    public function executeCheck(sfWebRequest $request) {

        
        //compare tournament.reserved_slot au nombre de slots du tournoi avec le status= reserve
        // return true/false
        //$q = Doctrine::getTable('tournamentSlot')
        //                ->verifNbReserve($tournament->getIdTournament());
        //verifie que le nombre de slot du tn est superieur ou egal a tournament.number_team
        // return true/flase
        $this->r = Doctrine::getTable('tournamentSlot')
                        ->verifNbSlot($this->idtournament);

        //verifie que les position des slots sont consécutives sur un tournoi
        // return true ou $error ( représente le nombre d'erreur de position )
        // return true/false ( si j'essaye de retourné $error il ne le prend pas en compte )
        $this->s = Doctrine::getTable('tournamentSlot')
                        ->verifPosSlot($this->idtournament);

        // verifie que les premier slots du tn sont bien valide ou reserve
        // return true ou $error ( représente le nombre d'erreur)
        // return true/false ( si j'essaye de retourné $error il ne le prend pas en compte )
        $this->t = Doctrine::getTable('tournamentSlot')
                        ->verifDebutSlot($this->idtournament);
    }

}