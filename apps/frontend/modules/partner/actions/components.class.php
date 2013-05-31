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
            ->select('p.name, p.logourl, p.status, p.position, pt.name, pt.status, pt.position')
            ->from('partner p')
            ->leftJoin('p.PartnerType pt')
            ->where('status = 1')
            ->orderBy('position ASC')
            ->execute();
  }

}
