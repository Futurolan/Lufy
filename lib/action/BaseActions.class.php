<?php
class BaseActions extends sfActions
{
  protected function embeddedProcessForm(sfWebRequest $request, $parameterName)
  {
    if($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter($parameterName));
      if($this->form->isValid())
      {
        if(method_exists($this->form, 'save'))
        {
          $this->form->save();
        }

        return True;
      }
    }

    return False;
  }
}
