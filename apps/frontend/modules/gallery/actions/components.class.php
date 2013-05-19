<?php

class galleryComponents extends sfComponents
{
  public function executeList(sfWebRequest $request)
  {
    $this->galleries = Doctrine_Query::create()
      ->from('Gallery g')
      ->where('g.status = 1')
      ->orderBy('g.position ASC')
      ->execute();
  }
}
