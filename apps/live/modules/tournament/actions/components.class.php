<?php

class tournamentComponents extends sfComponents {

    public function executeNexttournament(sfWebRequest $request) {
        $l = Doctrine::getTable('event')
                        ->getLastEvent();
        $this->nexttournaments = Doctrine_Query::create()
                        ->from('tournament')
                        ->where('event_id = ' . $l)
                        ->andWhere('is_active = 1')
                        ->orderBy('position ASC')
                        ->execute();

	$this->tournaments = array();

	foreach ($this->nexttournaments as $tournament)
	{
	    $nb_valide = 0;
	    $nb_inscrit = 0;
	    $nb_slot = $tournament->getNumberTeam();

	    $slots = Doctrine::getTable('TournamentSlot')->findByTournamentId($tournament->getIdTournament());
	    foreach ($slots as $slot)
	    {
		if ($slot->getStatus() == 'valide' || $slot->getStatus() == 'reserve')
		{
		    $nb_valide++;
		    $nb_inscrit++;
		}
		elseif ($slot->getStatus() != 'libre')
		{
		    $nb_inscrit++;
		}
	    }

	    if ($nb_inscrit > $nb_slot-1)
	    {
		$nb_inscrit = $nb_slot;
	    }
	    if ($nb_valide > $nb_slot-1)
            {
                $nb_valide = $nb_slot;
            }

	    $percent_inscrit = $nb_inscrit*100/$nb_slot;
	    $percent_valide = $nb_valide*100/$nb_slot; 

	    $this->tournaments[] = array(
		'id' => $tournament->getIdTournament(),
		'name' => $tournament->getName(),
		'logo' => $tournament->getLogourl(),
		'slug' => $tournament->getSlug(),
		'nb_slots' => $nb_slot,
		'percent_slot' => 100,
		'nb_inscrits' => $nb_inscrit,
		'percent_inscrits' => $percent_inscrit,
		'nb_valides' => $nb_valide,
		'percent_valides' => $percent_valide,
	    );
	}
    }

}
