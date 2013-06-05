<?php

class inviteComponents extends sfComponents
{
  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeNbinvite(sfWebRequest $request)
  {
    $invites = Doctrine_Query::create()
      ->from('invite')
      ->where('user_id = ?', $this->getUser()->getGuardUser()->getId())
      ->andWhere('is_accepted IS NULL')
      ->execute();

    if ($invites)
    {
      $this->count = count($invites);
    }
    else
    {
      $this->count = 0;
    }
  }
}
