<?php

class lufyValidateSlotsTask extends sfBaseTask
{

  protected function configure()
  {
    $this->addOptions(array(
        new sfCommandOption('execute', null, sfCommandOption::PARAMETER_NONE, 'Valide les équipes'),
    ));


    $this->namespace = 'lufy';
    $this->name = 'validate-slots';
    $this->briefDescription = 'Affiche la liste de tous les slots qui peuvent être validés.';
    $this->detailedDescription = <<<EOF
The [lufy:validate-slots|INFO] task does things.
Call it with:

  [php symfony lufy:validate-slots|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    $databaseManager = new sfDatabaseManager($this->configuration);
    $this->logSection('info', 'Affiche la liste de tous les slots qui peuvent être validés.');
    $tournamentSlots = Doctrine_Core::getTable('TournamentSlot')->findByIsValid('0');

    foreach ($tournamentSlots as $tournamentSlot)
    {
      $result = false;
      if ($this->checkPlayerNumber($tournamentSlot))
      {
        foreach ($tournamentSlot->getTeam()->getTeamPlayer() as $teamPlayer)
        {
          if ($teamPlayer->getIsPlayer() == 1)
          {
            $user = $teamPlayer->getSfGuardUser();

            if ($this->checkProfile($user) || $this->checkAddress($user) || $this->checkWeezevent($user))
            {
              $result = true;
            }
          }
        }
      }
      if ($result)
      {
        $this->logSection('info', $tournamentSlot->getTeam()->getName() . ' peut etre validée sur ' . $tournamentSlot->getTournament()->getName());
        if ($options['execute'])
        {
          $this->logSection('info', $tournamentSlot->getIsValid());

          $tournamentSlot->setIsValid('1');
          $this->logSection('info', $tournamentSlot->getIsValid());

          $tournamentSlot->setIsLocked('1');
          $tournamentSlot->getTeam()->setIsLocked('1');
          $tournamentSlot->save();
          $tournamentSlot->getTeam()->save();
        }
      }
    }
    if ($result)
    {
      $this->logSection('info', 'Vous pouvez lancer la procédure utilisez la commande');
      $this->logSection('info', 'php symfony lufy:validate-slots --execute');
    }
  }

  /**
   * @brief Check if profil is ok ( name, email, username ).
   * @return boolean : true if everything is ok.
   */
  private function checkProfile($user)
  {
    $result = true;

    if ($user->getFirstName() == NULL ||
            $user->getLastName() == NULL ||
            $user->getEmailAddress() == NULL ||
            $user->getUsername() == NULL)
      $result = false;
    //$this->logSection('info', 'toto 5 : Check Profile : ' . $result);

    return $result;
  }

  private function checkPlayerNumber($tournamentSlot)
  {
    $result = true;

    $player_per_team = $tournamentSlot->getTournament()->getPlayerPerTeam();
    $users_are_players = Doctrine_Query::create()
            ->from('TeamPlayer tp')
            ->innerJoin('tp.Team t')
            ->innerJoin('t.TournamentSlot ts')
            ->where('tp.is_player = 1')
            ->andWhere('ts.id_tournament_slot = ?', $tournamentSlot->getIdTournamentSlot())
            ->count();

    //$this->logSection('info', 'Toto 2, player_perteam, usersareplayers, idtournament slot ' . $player_per_team . ' ' . $users_are_players . ' ' . $tournamentSlot->getIdTournamentSlot());
    if ($player_per_team >= $users_are_players)
      $result = false;

    //$this->logSection('info', 'toto 6 : Check PlayerNumber : ' . $result);
    return $result;
  }

  /**
   * @brief Check if Weezevent Ticket is valid.
   * @param[in] $userId Take a user id or check current user id
   * @return boolean : true if there is one.
   */
  private function checkWeezevent($user)
  {
    $weezevent = Doctrine_Query::create()
            ->select('user_id')
            ->from('sfGuardUserWeezevent')
            ->where('user_id = ?', $user->getId())
            ->andWhere('is_valid = 1')
            ->fetchOne();
    $result = true;
    if ($weezevent == NULL)
      $result = false;

    $this->logSection('info', 'toto 6 : Check Weezevent : ' . $result);
    return $result;
  }

  /**
   * @brief Check if there is a default address.
   * @return boolean : true if there is one.
   */
  private function checkAddress($user)
  {
    $address = Doctrine_Query::create()
            ->select("id")
            ->from('sfGuardUserAddress')
            ->where('user_id = ?', $user->getId())
            ->andWhere('is_default = 1')
            ->fetchOne();
    $result = true;
    if ($address == NULL)
      $result = false;

    //$this->logSection('info', 'toto 7 : Check address : ' . $result);
    return $result;
  }

}
?>

