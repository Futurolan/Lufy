<?php

/**
 * Gallery form.
 *
 * @package    lufy
 * @subpackage form
 * @author     Guillaume Marsay <guillaume@futurolan.net>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class GalleryForm extends BaseGalleryForm
{
  public function configure()
  {
    unset($this['created_at'], $this['updated_at'], $this['slug']);
  }

}
