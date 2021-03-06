<?php

/**
 * SfGuardUserWeezevent form.
 *
 * @package    lufy
 * @subpackage form
 * @author     Guillaume Marsay
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SfGuardUserWeezeventForm extends BaseSfGuardUserWeezeventForm
{

  public function configure()
  {
    unset(
            $this['event_id'],
            $this['tournament_id'],
            $this['is_valid']
    );
  }

}
