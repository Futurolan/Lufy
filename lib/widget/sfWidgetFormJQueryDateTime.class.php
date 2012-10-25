<?php

class sfWidgetFormJQueryDateTime extends sfWidgetFormDateTime
{
  //array('date' => array())
  protected function configure($options = array(), $attributes = array())
  {
    parent::configure($options, $attributes);
    
    sfContext::getInstance()->getConfiguration()->loadHelpers('Asset');
    $icon = image_path('/images/16/date.png');
    $this->setOption('date', array(
      'culture' => 'fr',
      'config' => "{ buttonImage: '".$icon."'}",
      'date_widget' => new sfWidgetFormDate(array('format' => '%day%/%month%/%year%'))
    ));
  }
  
  /**
   * Returns the date widget.
   *
   * @param  array $attributes  An array of attributes
   *
   * @return sfWidgetForm A Widget representing the date
   */
  protected function getDateWidget($attributes = array())
  {
    //return new sfWidgetFormDate($this->getOptionsFor('date'), $this->getAttributesFor('date', $attributes));
    return new sfWidgetFormJQueryDate($this->getOptionsFor('date'), $this->getAttributesFor('date', $attributes));
  }

  /**
   * Returns the time widget.
   *
   * @param  array $attributes  An array of attributes
   *
   * @return sfWidgetForm A Widget representing the time
   */
  protected function getTimeWidget($attributes = array())
  {
    return new sfWidgetFormTime($this->getOptionsFor('time'), $this->getAttributesFor('time', $attributes));
  }

}
