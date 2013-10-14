<?php
/**
 * FrontendActions executes all the logic for the current request.
 *
 * @package lufy
 * @subpackage actions
 * @author Guillaume Marsay <guillaume@futurolan.net>
 */

class FrontendActions extends LufyActions
{
  public function preExecute()
  {
    parent::preExecute();
  }

  public function postExecute()
  {
    if ($this->getRequest()->isXmlHttpRequest())
    {
      $this->setLayout('default');
    }

    parent::postExecute();
  }
}
