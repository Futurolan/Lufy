<?php

class lufyValidateSlots extends sfBaseTask
{

  protected function configure()
  {

    $this->addOptions(array(
        new sfCommandOption('escaping-strategy', null, sfCommandOption::PARAMETER_REQUIRED, 'Output escaping strategy', true),
        new sfCommandOption('csrf-secret', null, sfCommandOption::PARAMETER_REQUIRED, 'Secret to use for CSRF protection', true),
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

    $tournamentSlots = Doctrine_Core::getTable('TournamentSlot')->findByIsValid('1');

    foreach ($tournamentSlots as $tournamentSlot)
    {
      if ($this->checkPlayerNumber())
      {
        foreach ($tournamentSlot->getTeam() as $team)
        {
          foreach ($team->getTeamPlayer() as $user)
          {
            $result = true;
            if (!$this->checkProfile($user) || !$this->checkAddress($user) || !$this->checkWeezevent($user))
            {
              $result = false;
            }
            if ($result)
            {
              $this->logSection('info', '' . $team->getName() . ' peut etre validée sur ' . $tournamentSlot->getTournament->getName());
            }
          }
        }
      }
    }
  }

  /**
   * @brief Check if profil is ok ( name, email, username ).
   * @return boolean : true if everything is ok.
   */
  private function checkProfile($user)
  {
    $result = true;

    if ($user->getGuardUser()->getFirstName() == NULL ||
            $user->getGuardUser()->getLastName() == NULL ||
            $user->getGuardUser()->getEmailAddress() == NULL ||
            $user->getGuardUser()->getUsername() == NULL)
      $result = false;

    return $result;
  }

  private function checkPlayerNumber($user)
  {
    $result = true;

    $player_per_team = $tournamentSlot->getTournament()->getPlayerPerTeam();
    $users_are_players = Doctrine_Query::create()
            ->count()
            ->from('TournamentSlot ts')
            ->innerJoin('TeamPlayer tp')
            ->where('tp.is_player = 1')
            ->andWhere('ts.id_tournament_slot = ?', $tournamentSlot->getIdTournamentSlot())
            ->execute();

    if ($player_per_team != $users_are_players)
      $result = false;

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
            ->select("user_id")
            ->from('sfGuardUserWeezevent')
            ->where('user_id = ?', $user->getId())
            ->andWhere('is_valid = 1')
            ->fetchOne();
    $result = true;
    if ($weezevent == NULL)
      $result = false;
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
            ->where('user_id = ?', $user->getGuardUser()->getId())
            ->andWhere('is_default = 1')
            ->fetchOne();
    $result = true;
    if ($address == NULL)
      $result = false;
    return $result;
  }

}
?>

