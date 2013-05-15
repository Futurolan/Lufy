<?php

/**
 * Project form base class.
 *
 * @package    lufy
 * @subpackage form
 * @author     Guillaume Marsay
 * @version    SVN: $Id: sfDoctrineFormBaseTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class BaseFormDoctrine extends sfFormDoctrine
{
  public function setup()
  {
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
      return false;
    }
  }
}
