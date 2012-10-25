<?php

class TournamentSlotTable extends Doctrine_Table {

    public static function getInstance() {
        return Doctrine_Core::getTable('TournamentSlot');
    }

    public function slotLibre($tournament_id) {
        $q = Doctrine_Query::create()
                        ->select('*')
                        ->from('tournamentSlot')
                        ->where('status = "libre"')
                        ->andWhere('tournament_id = ' . $tournament_id)
                        ->orderby('position ASC')
                        ->limit('limit', 1)
                        ->execute();

        if (count($q)):
            return $q;
        else:
            return NULL;
        endif;
    }

    public function slotLibreFin($tournament_id) {
        $q = Doctrine_Query::create()
                        ->select('*')
                        ->from('tournamentSlot')
                        ->where('status = "libre"')
                        ->andWhere('tournament_id = ' . $tournament_id)
                        ->orderby('position DESC')
                        ->limit('limit', 1)
                        ->execute();
        if (count($q)):
            return $q;
        else:
            return NULL;
        endif;
    }

    public function slotInscritFin($tournament_id) {
        $q = Doctrine_Query::create()
                        ->select('*')
                        ->from('tournamentSlot')
                        ->where('status = "inscrit"')
                        ->andWhere('tournament_id = ' . $tournament_id)
                        ->orderby('position DESC')
                        ->limit('limit', 1)
                        ->execute();
        if (count($q)):
            return $q;
        else:
            return NULL;
        endif;
    }

    public function setTeam($id_tournament_slot, $team_id) {
        Doctrine_Query::create()
                ->update('TournamentSlot')
                ->set('team_id', '?', $team_id)
                ->where('id_tournament_slot = ' . $id_tournament_slot)
                ->execute();
    }

    public function setPlayer($id_tournament_slot, $user_id) {
        Doctrine_Query::create()
                ->update('TournamentSlot')
                ->set('user_id', '?', $user_id)
                ->where('id_tournament_slot = ' . $id_tournament_slot)
                ->execute();
    }

    public function isLibre($id_tournament_slot) {
        $q = Doctrine_Query::create()
                        ->from('tournamentSlot')
                        ->where('status = "libre"')
                        ->andWhere('id_tournament_slot = ' . $id_tournament_slot)
                        ->execute();
        if (count($q) == 1)
            return true;
        else
            return false;
    }

    public function isReserve($id_tournament_slot) {
        $q = Doctrine_Query::create()
                        ->from('tournamentSlot')
                        ->where('status = "reserve"')
                        ->andWhere('id_tournament_slot = ' . $id_tournament_slot)
                        ->execute();
        if (count($q) == 1)
            return true;
        else
            return false;
    }

    public function isInscrit($id_tournament_slot) {
        $q = Doctrine_Query::create()
                        ->from('tournamentSlot')
                        ->where('status = inscrit')
                        ->andWhere('id_tournament_slot = ' . $id_tournament_slot)
                        ->execute();
        if (count($q) == 1)
            return true;
        else
            return false;
    }

    public function setInscrit($id_tournament_slot) {
        Doctrine_Query::create()
                ->update('TournamentSlot')
                ->set('status', '?', 'inscrit')
                ->where('id_tournament_slot = ' . $id_tournament_slot)
                ->execute();
    }

    public function isValide($id_tournament_slot) {
        $q = Doctrine_Query::create()
                        ->from('tournamentSlot')
                        ->where('status = "valide"')
                        ->andWhere('id_tournament_slot = ' . $id_tournament_slot)
                        ->execute();
        if (count($q) == 1)
            return true;
        else
            return false;
    }

    public function isAttente($id_tournament_slot) {
        $q = Doctrine_Query::create()
                        ->from('tournamentSlot')
                        ->where('status = "attente"')
                        ->andWhere('id_tournament_slot = ' . $id_tournament_slot)
                        ->execute();
        if (count($q) == 1)
            return true;
        else
            return false;
    }

    public function getPlayer($id_tournament_slot) {
        $q = Doctrine_Query::create()
                        ->from('tournamentSlot')
                        ->where('id_tournament_slot = ' . $id_tournament_slot)
                        ->execute();
        return $q[0]->getSfGuardUser();
    }

    public function getTeam($id_tournament_slot) {
        $q = Doctrine::getTable('tournamentSlot')->findOneByIdTournamentSlot($id_tournament_slot);
        $t = Doctrine::getTable('team')->findOneByIdTeam($q->getTeamId());
        return $t;
    }

    public function getTournament($id_tournament) {
        $t = Doctrine::getTable('tournament')->findOneByIdTournament($id_tournament);
        return $t;
    }

    public function addSlot($tournament_id) {

        $w = Doctrine_Query::create()
                        ->from('tournamentSlot')
                        ->where('tournament_id = ' . $tournament_id)
                        ->orderBy('position DESC')
                        ->limit('1')
                        ->execute();
        $pos = $w[0]->getPosition() + 1;

        $slot = new TournamentSlot();
        $slot->setTournamentId($tournament_id);
        $slot->setPosition($pos);
        $slot->setStatus('attente');
        $slot->save();
        ;
        return $slot->getIdTournamentSlot();
    }

    public function addSlotDebutAttente($tournament_id, $i) {

        $w = Doctrine_Query::create()
                        ->from('tournament')
                        ->where('id_tournament = ' . $tournament_id)
                        ->execute();
        $i++;
        $pos = $w[0]->getNumberTeam() + $i;

        $slot = new TournamentSlot();
        $slot->setTournamentId($tournament_id);
        $slot->setPosition($pos);
        $slot->setStatus('attente');
        $slot->save();
        ;
        return $slot->getIdTournamentSlot();
    }

    public function addSlotFinAttente($tournament_id) {

        $w = Doctrine_Query::create()
                        ->from('tournamentSlot')
                        ->where('tournament_id = ' . $tournament_id)
                        ->orderBy('position DESC')
                        ->limit('1')
                        ->execute();
        $pos = $w[0]->getPosition() + 1;

        $slot = new TournamentSlot();
        $slot->setTournamentId($tournament_id);
        $slot->setPosition($pos);
        $slot->setStatus('attente');
        $slot->save();
        ;
        return $slot->getIdTournamentSlot();
    }

    public function addSlotFin($tournament_id, $diff) {

        $tournament = doctrine::getTable('tournament')->findOneByIdTournament($tournament_id);

        $pos = $tournament->getNumberTeam() + $diff + 1;

        $slot = new TournamentSlot();
        $slot->setTournamentId($tournament_id);
        $slot->setPosition($pos);
        $slot->setStatus('libre');
        $slot->save();

        return $slot->getIdTournamentSlot();
    }

    public function setLibre($id_tournament_slot) {
        $slot = Doctrine::getTable('tournamentSlot')->findOneByIdTournamentSlot($id_tournament_slot);
        if ($slot->getStatus() == 'inscrit' || 'attente' || 'valide'):
            $commande = Doctrine::getTable('commande')->findOneByTournamentSlotId($id_tournament_slot);
            if ($commande):
                if ($commande->getPayement()):
                    $commande->getPayement()->delete();
                endif;
                $commande->delete();
            endif;
        endif;
        Doctrine_Query::create()
                ->update('TournamentSlot')
                ->set('status', '?', 'libre')
                ->set('team_id', 'NULL')
                ->where('id_tournament_slot = ' . $id_tournament_slot)
                ->execute();
    }

    public function setAttente($id_tournament_slot) {
        Doctrine_Query::create()
                ->update('TournamentSlot')
                ->set('status', '?', 'attente')
                ->where('id_tournament_slot = ' . $id_tournament_slot)
                ->execute();
    }

    public function deleteSlot($id_tournament_slot) {
        $s = Doctrine_Query::create()
                        ->delete('TournamentSlot')
                        ->where('id_tournament_slot = ' . $id_tournament_slot)
                        ->execute();
    }

    public function updateAttente($id_tournament_slot, $tournament_id, $u) {
        $w = doctrine::getTable('tournament')->findOneByIdTournament($tournament_id);

        $u++;
        $pos = $w->getNumberTeam() + $u;

        Doctrine_Query::create()
                ->update('TournamentSlot')
                ->set('position', '?', $pos)
                ->where('id_tournament_slot = ' . $id_tournament_slot)
                ->execute();
    }

    public function getTournamentSlot($id) {
        $w = Doctrine::getTable('teamPlayer')->findOneByUserId($id);
        $teamid = $w->getTeamId();
        $tsID = Doctrine::getTable('tournamentSlot')->findOneByTeamId($w->getTeamId());

        return $tsID;
    }

    public function setValideAndPaid($id) {
        Doctrine_Query::create()
                ->update('TournamentSlot')
                ->set('status', '?', 'valide')
                ->set('locked', '?', '1')
                ->where('id_tournament_slot = ' . $id)
                ->execute();
    }

    public function verifNbReserve($id_tournament) {

        $p = Doctrine_Query::create()
                        ->from('tournament')
                        ->where('id_tournament = ' . $id_tournament)
                        ->execute();
        $q = Doctrine_Query::create()
                        ->from('tournamentSlot')
                        ->where('status = "reserve"')
                        ->andWhere('tournament_id = ' . $id_tournament)
                        ->execute();
        if (count($q) == $p[0]->getReservedSlot())
            return true;
        else
            return false;
    }

    public function verifNoSlot($id_tournament) {

        $q = Doctrine_Query::create()
                        ->from('tournamentSlot')
                        ->where('tournament_id = ' . $id_tournament)
                        ->execute();
        if (count($q) == 0)
            return true;
        else
            return false;
    }

    public function verifNbSlot($id_tournament) {
        $p = Doctrine_Query::create()
                        ->from('tournament')
                        ->where('id_tournament = ' . $id_tournament)
                        ->execute();

        $q = Doctrine_Query::create()
                        ->from('tournamentSlot')
                        ->where('tournament_id = ' . $id_tournament)
                        ->execute();
        if (count($q) < $p[0]->getNumberTeam())
            return false;
        else
            return true;
    }

    public function verifPosSlot($id_tournament) {

        $slots = Doctrine_Query::create()
                        ->from('tournamentSlot')
                        ->where('tournament_id = ' . $id_tournament)
                        ->orderBy('position ASC')
                        ->execute();

        $pos = '1';
        $error = '0';
        foreach ($slots as $slot):
            if ($pos == $slot->getPosition()):
                $pos++;
            else:
                $error++;
            endif;
        endforeach;


        if ($error > '0')
            return false;
        else
            return true;
    }

    public function verifDebutSlot($id_tournament) {
        $p = Doctrine_Query::create()
                        ->from('tournament')
                        ->where('id_tournament = ' . $id_tournament)
                        ->execute();

        $slots = Doctrine_Query::create()
                        ->from('tournamentSlot')
                        ->where('tournament_id = ' . $id_tournament)
                        ->orderBy('position ASC')
                        ->limit($p[0]->getReservedSlot())
                        ->execute();

        $error = '0';

        foreach ($slots as $slot):
            if ($slot->getStatus() != 'valide' && $slot->getStatus() != 'reserve'):
                $error++;
            endif;
        endforeach;

        if ($error > '0')
            return false;
        else
            return true;
    }

    public function countPlayer($id_team) {
        $c = Doctrine_Query::create()
                        ->from('teamPlayer')
                        ->where('team_id = ' . $id_team)
                        ->andWhere('is_player = 1')
                        ->execute();
        return count($c);
    }

    public function selectSlots($id_tournament) {
        $t = doctrine::getTable('tournament')->findOneByIdTournament($id_tournament);
        $reserved = $t->getReservedSlot();
        $attente = $t->getNumberTeam();

        $s = Doctrine_Query::create()
                        ->from('tournamentSlot')
                        ->where('tournament_id = ' . $id_tournament)
                        ->andWhere('position > ' . $reserved)
                        ->andWhere('position <= ' . $attente)
                        ->orderBy('position ASC')
                        ->execute();
        return $s;
    }

    public function setPosition($pos, $id) {
        Doctrine_Query::create()
                ->update('tournamentSlot')
                ->set('position', '?', '' . $pos)
                ->where('id_tournament_slot = ' . $id)
                ->execute();
    }

    public function addReserved($position, $tournament_id) {

        $slot = new TournamentSlot();
        $slot->setTournamentId($tournament_id);
        $slot->setPosition($position);
        $slot->setStatus('reserve');
        $slot->save();

        return $slot->getIdTournamentSlot();
    }

    public function updatePosSlots($id_tournament_slot, $m) {


        Doctrine_Query::create()
                ->update('TournamentSlot')
                ->set('position', '?', $m)
                ->where('id_tournament_slot = ' . $id_tournament_slot)
                ->execute();
    }

    public function selectReservedFin($id_tournament) {
        $d = Doctrine_Query::create()
                        ->from('tournamentSlot')
                        ->where('tournament_id = ' . $id_tournament)
                        ->andWhere('status = ?', 'reserve')
                        ->orderBy('position DESC')
                        ->limit('1')
                        ->execute();
        if (count($d) == 1):
            return $d[0];
        endif;
    }

    public function positionUp($id_tournament_slot, $factor) {
        $s = doctrine::getTable('tournamentSlot')->findOneByIdTournamentSlot($id_tournament_slot);
        $pos = $s->getPosition() + $factor;
        Doctrine_Query::create()
                ->update('TournamentSlot')
                ->set('position', '?', $pos)
                ->where('id_tournament_slot = ' . $id_tournament_slot)
                ->execute();
    }

    public function ifDoublonDelete($id_tournament_slot) {
        $s = doctrine::getTable('tournamentSlot')->findOneByIdTournamentSlot($id_tournament_slot);
        $slots = Doctrine_Query::create()
                        ->from('tournamentSlot')
                        ->where('position = ?', $s->getPosition())
                        ->andWhere('tournament_id = ?', $s->getTournamentId())
                        ->execute();
        if (count($slots) > 1):
            $s->delete();
        endif;
    }
    public function updateCommande($id_tournament_slot, $id_tournament_slot2) {
        $c = doctrine::getTable('commande')->findOneByTournamentSlotId($id_tournament_slot);
        Doctrine_Query::create()
                        ->update('commande')
                        ->set('tournament_slot_id', '?', $id_tournament_slot2)
                        ->where('tournament_slot_id = ?',$id_tournament_slot)
                        ->execute();
        
    }

}