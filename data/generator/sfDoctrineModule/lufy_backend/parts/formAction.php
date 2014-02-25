  public function executeForm(sfWebRequest $request)
  {
    $this->form = new <?php echo $this->getModelClass().'Form' ?>();

    if ($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT))
    {
      if ($request->hasParameter('<? echo $this->getPrimaryKeys(true) ?>'))
      {
        $this->object = Doctrine_Core::getTable('<?=$this->getModelClass() ?>')->findOneById<?=$this->getModelClass() ?>($request->getParameter('<? echo $this->getPrimaryKeys(true) ?>'));

        $this->form =  new <?php echo $this->getModelClass().'Form' ?>($this->object);
      }

      $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));

      if ($this->form->isValid())
      {
        $object = $this->form->save();

        $this->getUser()->setFlash('success', 'Object has been updated.');

<? if (in_array('--with-show', $this->params)): ?>
        $this->redirect('<?=$this->getModuleName() ?>/view?<? echo $this->getPrimaryKeys(true) ?>='.$object->getId<?=$this->getModelClass() ?>());
<? else: ?>
        $this->redirect('<?=$this->getModuleName() ?>/index');
<? endif; ?>
      }
    }

    if ($request->hasParameter('<? echo $this->getPrimaryKeys(true) ?>'))
    {
      $this->object = Doctrine_Core::getTable('<?=$this->getModelClass() ?>')->findOneById<?=$this->getModelClass() ?>($request->getParameter('<? echo $this->getPrimaryKeys(true) ?>'));

      $this->form =  new <?php echo $this->getModelClass().'Form' ?>($this->object);
    }
  }
