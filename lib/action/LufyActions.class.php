<?php 
/**
 * LufyActions executes all the logic for the current request.
 *
 * @package lufy
 * @subpackage actions
 * @author Guillaume Marsay <guillaume@futurolan.net>
 */

class LufyActions extends sfActions
{
  public function preExecute()
  {
    parent::preExecute();
  }

  public function postExecute()
  {
    parent::postExecute();
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind(
      $request->getParameter($form->getName()),
      $request->getFiles($form->getName())
    );
    if ($form->isValid())
    {
      $form->save();
      return true;
    }
    else
    {
      exit;
      return false;
    }
  }
}
