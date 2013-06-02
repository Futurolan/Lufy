<?php

class partnerComponents extends sfComponents
{

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeRolling(sfWebRequest $request)
  {
    $this->partners = Doctrine_Query::create()
            ->from('partner p')
            ->where('status = 1')
            ->orderBy('position ASC')
            ->execute();
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executePrincipal(sfWebRequest $request)
  {
    $type = Doctrine::getTable('partnerType')
            ->createQuery('a')
            ->orderBy('position ASC')
            ->execute();
    $this->partners = Doctrine_Query::create()
            ->from('partner')
            ->where('partner_type_id =' . $type[0]->getIdPartnerType())
            ->andWhere('status = 1')
            ->execute();
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeOfficiel(sfWebRequest $request)
  {
    $type = Doctrine::getTable('partnerType')
            ->createQuery('a')
            ->orderBy('position ASC')
            ->execute();

    $this->partners = Doctrine_Query::create()
            ->from('partner p')
            ->where('partner_type_id =' . $type[1]->getIdPartnerType())
            ->andWhere('status = 1')
            ->orderBy('position ASC')
            ->limit('4')
            ->execute();
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeOrganisation(sfWebRequest $request)
  {
    $type = Doctrine::getTable('partnerType')
            ->createQuery('a')
            ->orderBy('position ASC')
            ->execute();
    if ($type[2]->getStatus() == 1):
      $this->partners = Doctrine_Query::create()
              ->from('partner p')
              ->where('partner_type_id =' . $type[2]->getIdPartnerType())
              ->andWhere('status = 1')
              ->orderBy('rand()')
              ->limit('8')
              ->execute();
    else:
      $this->partners = array();
    endif;
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeMedia(sfWebRequest $request)
  {
    $type = Doctrine::getTable('partnerType')
            ->createQuery('a')
            ->orderBy('position ASC')
            ->execute();
    if ($type[3]->getStatus() == 1):
      $this->partners = Doctrine_Query::create()
              ->from('partner p')
              ->where('partner_type_id =' . $type[3]->getIdPartnerType())
              ->andWhere('status = 1')
              ->orderBy('position ASC')
              ->execute();
    else:
      $this->partners = array();
    endif;
  }

}
