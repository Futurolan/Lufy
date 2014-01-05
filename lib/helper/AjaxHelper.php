<?php

/**
 * AjaxHelper.
 *
 * @package    lufy
 * @subpackage helper
 * @author     Guillaume Marsay <g.marsay@gmail.com>
 * @version    0.1
 */

/* UrlHelper.php is required */


function ajax_component($name, $internal_uri, $options = array())
{
  $js_options = _parse_attributes($options);

  $js_options = _convert_options_to_javascript($js_options);

  $absolute = true;
  if (isset($js_options['absolute_url']))
  {
    $js_options['absolute'] = $js_options['absolute_url'];
    unset($js_options['absolute_url']);
  }
  if (isset($html_options['absolute']))
  {
    $absolute = (boolean) $js_options['absolute'];
    unset($js_options['absolute']);
  }
  $js_options['href'] = '#'.url_for($internal_uri, false);
  $js_options['onclick'] = 'loadPage(\''.url_for($internal_uri, $absolute).'\');';

  if (isset($js_options['class'])) { $class = 'class="'.$js_options['class'].'"'; } else { $class = ''; }
  if (isset($js_options['align'])) { $align = $js_options['align']; } else { $align = 'center'; }
  if (isset($js_options['top'])) { $top = $js_options['top']; } else { $top = '100'; }
  if (isset($js_options['width'])) { $width = $js_options['width']; } else { $width = '600'; }
  if (isset($js_options['padding'])) { $padding = $js_options['padding']; } else { $padding = '20'; }
  if (isset($js_options['borderColor'])) { $borderColor = $js_options['borderColor']; } else { $borderColor = '#ccc'; }

  $html = '<a '.$class.' style="cursor: pointer;" onclick="modalPopup(\''.$align.'\', '.$top.', '.$width.', '.$padding.', \'#dddddd\', 40, \'#ffffff\', \''.$borderColor.'\', 5, 5, 300, \''.url_for($internal_uri, $absolute).'\', \'http://dev-backend.gamers-assembly.net/images/ajax-loader.gif\');">'.$name.'</a>';

  return $html;
}

function ajax_link2($name, $routeName, $params, $options = array())
{
  $params = array_merge(array('sf_route' => $routeName), is_object($params) ? array('sf_subject' => $params) : $params);

  return ajax_link1($name, $params, $options);
}


function ajax_link1($name, $internal_uri, $options = array())
{
  $html_options = _parse_attributes($options);

  $html_options = _convert_options_to_javascript($html_options);

  $absolute = true;
  if (isset($html_options['absolute_url']))
  {
    $html_options['absolute'] = $html_options['absolute_url'];
    unset($html_options['absolute_url']);
  }
  if (isset($html_options['absolute']))
  {
    $absolute = (boolean) $html_options['absolute'];
    unset($html_options['absolute']);
  }
  $html_options['href'] = '#'.url_for($internal_uri, false);
  $html_options['onclick'] = 'loadPage(\''.url_for($internal_uri, $absolute).'\');';

  if (isset($html_options['query_string']))
  {
    $html_options['onclick'] .= '?'.$html_options['query_string'];
    unset($html_options['query_string']);
  }

  if (isset($html_options['anchor']))
  {
    $html_options['href'] .= '#'.$html_options['anchor'];
    unset($html_options['anchor']);
  }

  if (is_object($name))
  {
    if (method_exists($name, '__toString'))
    {
      $name = $name->__toString();
    }
    else
    {
      throw new sfException(sprintf('Object of class "%s" cannot be converted to string (Please create a __toString() method).', get_class($name)));
    }
  }

  if (!strlen($name))
  {
    $name = $html_options['onclick'];
  }

  return content_tag('a', $name, $html_options);
}

function ajax_link()
{
  $arguments = func_get_args();
  if (empty($arguments[1]) || is_array($arguments[1]) || '@' == substr($arguments[1], 0, 1) || false !== strpos($arguments[1], '/'))
  {
//    return call_user_func_array('ajax_link1', $arguments);
    return call_user_func_array('link_to1', $arguments);
  }
  else
  {
    if (!array_key_exists(2, $arguments))
    {
      $arguments[2] = array();
    }
//    return call_user_func_array('ajax_link2', $arguments);
    return call_user_func_array('link_to2', $arguments);
  }
}

