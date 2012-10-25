<?php

/**
 * sfWidgetFormRichText represents an HTML rich text input tag based on .
 *
 * @package    symfony
 * @subpackage widget
 * @author     Samy
 * @version    SVN: $Id: sfWidgetFormRichText.class.php 20941 2009-08-08 14:11:51Z Kris.Wallsmith $
 */
class sfWidgetFormTextareaBB extends sfWidgetForm
{
  protected function configure($options = array(), $attributes = array())
  {
    $this->addRequiredOption('buttons');
    
    parent::configure($options, $attributes);
  }
	
	/**
   * @param  string $name        The element name
   * @param  string $value       The value displayed in this widget
   * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
   * @param  array  $errors      An array of errors for the field
   *
   * @return string An HTML tag string
   *
   * @see sfWidgetForm
   */
	
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $buttons = $this->getOption('buttons');
    $code_buttons = "";
    $i=0;
    $name_div = str_replace(array('[',']'),array('_',''),$name);
    foreach($buttons as $val)
    {
      if ($i>0) $code_buttons .= ",";
    	if(!strstr($val,":"))
      {
        $code_buttons .= $val.":$('.bb_".$val."_".$name_div."')";
    	}
    	else
    	{
    		$code_buttons .= $val;
    	}
    	$i++;
    }
    
	  $js = sprintf(<<<EOF
<script type="text/javascript">
  $(document).ready((function(){
		$('textarea[name=%s]').bbcodeeditor(
    {
		  %s
    });
  }));
</script>
EOF
    ,
    $name,
    $code_buttons
    );
    
    return $js.$this->getHTML($name,$value);
  }
	
  private function getHTML($name, $value)
  {
  $buttons = $this->getOption('buttons');
  $name_div = str_replace(array('[',']'),array('_',''),$name);
  $src = "";
  foreach ($buttons as $b)
  {
    if(!strstr($b, "preview") && !strstr($b,":"))
    {
      $src .= "<div class=\"bb_button bb_".$b." bb_".$b."_".$name_div."\"></div>";
    }
  }
  
  $src .="<div><textarea name=\"".$name."\" class=\"bb_textarea\">".$value."</textarea></div>";
  
  if (array_search('preview', $buttons)!==false) $src .= "<div class=\"bb_preview bb_preview_".$name_div."\"></div>";
  
  return $src;
  }
  
  public function getJavascripts()
  {
    return array('jquery.bbcodeeditor-1.0.min.js');
  }
  
  public function getStylesheets()
  {
    return array('bbcode.css' => 'all');
  }
}