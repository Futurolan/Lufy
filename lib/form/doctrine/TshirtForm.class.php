<?php

/**
 * Tshirt form.
 *
 * @package    lufy
 * @subpackage form
 * @author     Guillaume Marsay <guillaume@futurolan.net>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class TshirtForm extends BaseTshirtForm
{
  public function configure()
  {
    parent::setup();
    $this->widgetSchema['user_id']->setDefault(sfContext::getInstance()->getUser()->getId());
    $this->widgetSchema['size'] = new sfWidgetFormChoice(array(
	'choices' => array(
                '' => '',
		'XS' => 'XS',
		'S' => 'S',
		'M' => 'M',
		'L' => 'L',
		'XL' => 'XL',
		'XXL' => 'XXL',
		'XXXL' => 'XXXL'
		)
	)
    );
  }

}
