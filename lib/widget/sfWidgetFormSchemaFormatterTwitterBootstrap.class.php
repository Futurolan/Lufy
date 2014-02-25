<?php
/**
 * Class sfWidgetFormSchemaFormatterTwitterBootstrap
 */
class sfWidgetFormSchemaFormatterTwitterBootstrap extends sfWidgetFormSchemaFormatter {
  protected
    $rowFormat = "<div class=\"control-group %row_class%\">\n %label%\n <div class=\"controls\">\n %field%\n %error%\n %help%\n </div>\n %hidden_fields%\n </div>\n",
    $errorRowFormat = '%errors%',
    $errorListFormatInARow = "<span class=\"help-inline\">%errors%</span>\n",
    $errorRowFormatInARow = "%error% ",
    $namedErrorRowFormatInARow = "%name%: %error% ",
    $helpFormat = "<span class=\"help-block\">%help%</span>",
    $decoratorFormat = '%content%';


  public function __construct(sfWidgetFormSchema $widgetSchema)
  {
    foreach ($widgetSchema->getFields() as $field)
    {
      $widget_to_form_control = array(
        'sfWidgetFormFilterInput',
        'sfWidgetFormInputText',
        'sfWidgetFormInputPassword',
        'sfWidgetFormDoctrineChoice',
        'sfWidgetFormChoice',
        'sfWidgetFormDoctrineChoiceNestedSet'
      );
 
      if (in_array(get_class($field), $widget_to_form_control))
      {
       //$field->setAttribute('class', 'form-control ' . $field->getAttribute('class'));
      }

      if (get_class($field) == 'sfWidgetFormDateTime')
      {
        $field->setAttribute('date', array('class' => 'input-mini ' . $field->getAttribute('class')));
        $field->setOption('date', array('format' => '%day%/%month%/%year%'));
        $field->setAttribute('time', array('class' => 'input-mini ' . $field->getAttribute('class')));
      }
    }
    parent::__construct($widgetSchema);
  }


  public function formatRow($label, $field, $errors = array(), $help = '', $hiddenFields = null)
  {
    $row = parent::formatRow(
      $label,
      $field,
      $errors,
      $help,
      $hiddenFields
    );
    return strtr($row, array(
      '%row_class%' => count($errors) ? ' error' : '',
    ));
  }


  public function generateLabel($name, $attributes = array())
  {
    if (isset($attributes['class']))
    {
      $attributes['class'] .= ' control-label';
    }
    else
    {
      $attributes['class'] = 'control-label';
    }
    return parent::generateLabel($name, $attributes);
  }
}
?>
