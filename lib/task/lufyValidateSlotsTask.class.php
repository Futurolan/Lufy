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

  /**
   * @brief Check if profil is ok ( name, email, username ).
   * @param[in] $user Take a user
   * @return boolean : true if everything is ok.
   */
  protected function execute($arguments = array(), $options = array())
  {
    $databaseManager = new sfDatabaseManager($this->configuration);
    $this->logSection('info', 'Affiche la liste de tous les slots qui peuvent être validés.');
    $tournamentSlots = Doctrine_Core::getTable('TournamentSlot')->findByIsValid('0');
    $result = true;
    foreach ($tournamentSlots as $tournamentSlot)
    {

      $this->logSection('info', 'Debut =======');


      if ($this->checkPlayerNumber($tournamentSlot) && !$tournamentSlot->getTeam()->getIsLocked())
      {
        //$this->logSection('info', 'Banzaiiii');
        foreach ($tournamentSlot->getTeam()->getTeamPlayer() as $teamPlayer)
        {
          //$this->logSection('info', 'kawwaaaaa');

          if ($teamPlayer->getIsPlayer() == 1)
          {
            //$this->logSection('info', 'bunnnga');
            $user = $teamPlayer->getSfGuardUser();

            if (!$this->checkProfile($user) || !$this->checkAddress($user) || !$this->checkWeezevent($user))
            {
              $result = false;
            }
          }
        }
      }
      else
      {
        $result = false;
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
          $this->logSection('info', $tournamentSlot->getTeam()->getName() . ' est maintenant validée sur ' . $tournamentSlot->getTournament()->getName());
        }
      }
      else
      {
        $this->logSection('info', $tournamentSlot->getTeam()->getName() . ' non validable sur ' . $tournamentSlot->getTournament()->getName());
      }
      $this->logSection('info', 'Fin =======');
    }

    if ($result)
    {
      $this->logSection('info', 'Vous pouvez lancer la procédure utilisez la commande');
      $this->logSection('info', 'php symfony lufy:validate-slots --execute');
    }
  }

  /**
   * @brief Check if profil is ok ( name, email, username ).
   * @param[in] $user Take a user
   * @return boolean : true if everything is ok.
   */
  private function checkProfile($user)
  {
    $result = false;

    if ($user->getFirstName() != NULL &&
            $user->getLastName() != NULL &&
            $user->getEmailAddress() != NULL &&
            $user->getUsername() != NULL)
      $result = true;



    $this->logSection('info', '+++++++');
    if ($result)
    {
      $this->logSection('info', 'profil ok');
    }
    else
    {
      $this->logSection('info', 'profil Nok');
    }


    return $result;
  }

  private function checkPlayerNumber($tournamentSlot)
  {
    $result = false;
    //$this->logSection('info', 'Katana dans ta gueule');
    $player_per_team = $tournamentSlot->getTournament()->getPlayerPerTeam();

    $users_are_players = Doctrine_Query::create()
            ->from('TeamPlayer tp')
            ->innerJoin('tp.Team t')
            ->innerJoin('t.TournamentSlot ts')
            ->where('tp.is_player = 1')
            ->andWhere('ts.id_tournament_slot = ?', $tournamentSlot->getIdTournamentSlot())
            ->count();
    $this->logSection('info', $player_per_team . ' == ' . $users_are_players);

    if ($player_per_team <= $users_are_players)
      $result = true;

    if ($result)
    {
      $this->logSection('info', 'playernb ok');
    }
    else
    {
      $this->logSection('info', 'playernb Nok');
    }


    return $result;
  }

  /**
   * @brief Check if Weezevent Ticket is valid.
   * @param[in] $user Take a user
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

    $result = false;

    //$this->logSection('info', $weezevent . ' <== weezevent');
    if ($weezevent != NULL)
      $result = true;

    if ($result)
    {
      $this->logSection('info', 'weezevent ok');
    }
    else
    {
      $this->logSection('info', 'weezevent Nok');
    }
    $this->logSection('info', '+++++++');

    return $result;
  }

  /**
   * @brief Check if there is a default address.
   * @param[in] $user Take a user
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


    if ($result)
    {
      $this->logSection('info', 'address ok');
    }
    else
    {
      $this->logSection('info', 'address Nok');
    }

    return $result;
  }

}
?>

