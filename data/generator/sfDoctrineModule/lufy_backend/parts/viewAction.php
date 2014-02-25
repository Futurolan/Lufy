  public function executeView(sfWebRequest $request)
  {
    $this-><?php echo $this->getSingularName() ?> = Doctrine_Core::getTable('<?php echo $this->getModelClass() ?>')->find(array(<?php echo $this->getRetrieveByPkParamsForAction(65) ?>));
    $this->forward404Unless($this-><?php echo $this->getSingularName() ?>);
  }
