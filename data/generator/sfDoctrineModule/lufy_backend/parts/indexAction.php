  public function executeIndex(sfWebRequest $request)
  {
    $this-><?php echo $this->getPluralName() ?> = Doctrine_Core::getTable('<?php echo $this->getModelClass() ?>')->findAll();
  }
