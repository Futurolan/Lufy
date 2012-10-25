<?php

abstract class bbParserBase
{
  protected static $instance = null;
  
  protected $_tags;
  protected $_options;
  protected $_raw;
  protected $_index = 0;
  protected $_lastNode;
  protected $_tree = array();
  protected $_html;
  
  public function __construct()
  {
    $this->_tags = array();
    
    $this->setup();
    $this->configure();
  }
  
  protected function setup()
  {
    $this->_options['openchar'] = '[';
    $this->_options['closechar'] = ']';
  }
  
  protected function configure()
  {
  }
  
  public function load($str)
  {
    $this->_raw = $str;
  }
  
  public function toHtml($str = Null)
  {
    if(!is_null($str)) $this->load($str);
    $this->parse();
    
    return $this->filter($this->_tree);
  }
  
  public function filter($str)
  {
    $str = str_replace("\r\n\r\n", "\n</p>\n<p>\n  ", $str);
    $str = str_replace("\r\n", "<br/>\n", $str);
    $str = sprintf("<p>\n  %s\n</p>\n", $str);
    
    return $str;
  }
  
  public function parse()
  {
    $node = new bbNode();
    $node->parser = $this;
    
    while(False !== $pos = $this->findNextTag())
    {
      if($pos === False) break;
      
      $tag = $this->getTagAt($pos);
      
      if(!$this->isValidTag($tag['tag']))
      {
        $this->skipTag($pos);
        continue;
      }
      
      if($this->isOpenerTag($pos))
      {
        $newNode = new bbNode($tag);
        $newNode->parser = $this;
        
        if($node->selfclose && $tag['tag'] == $node->tag)
        {
          $node->appendText($this->getCurrentChunk($pos));
          $node = $node->getParent();
        }
        else
        {
          $node->appendText($this->getCurrentChunk($pos));
        }
        
        $node->appendChild($newNode);
        $node = $newNode;
      }
      
      if($this->isCloserTag($pos))
      {
        $node->appendText($this->getCurrentChunk($pos));
        
        if($tag['tag'] != $node->tag)
          $node = $node->getParent()->getParent();
        else
          $node = $node->getParent();
      }
      
      $this->skipTag($pos);
    }
    
    $node->getRoot()->appendText($this->getCurrentChunk($pos));
    
    $this->_tree = $node->getRoot();
  }
  

  public function addTag($tag, $pattern = Null, array $options = array())
  {
    $options = array_merge(array('selfclose' => false), $options);
    
    if(is_null($pattern))
    {
      $pattern = sprintf('<%s>${content}</%s>', $tag, $tag);
    }
    
    $this->_tags[$tag] = $options;
    $this->_tags[$tag]['pattern'] = $pattern;
  }
  
  public function getTag($tag)
  {
    if(isset($this->_tags[$tag])) return $this->_tags[$tag];
    
    return Null;
  }
  
  public function findNextTag()
  {
    $pos = strpos($this->_raw, $this->_options['openchar'], $this->_index);
    if($pos === False) return False;
    
    return $pos;
  }
  
  public function isValidTag($tag)
  {
    return in_array($tag, array_keys($this->_tags));
  }
  
  public function isValidContext($tag, bbNode $contextNode)
  {
    if(!isset($tag['context'])) return True;
    
    $context = $tag['context'];
    
    if(!is_array($context)) $context = array($context);
    if($tag['tag'] == $contextNode->tag) $contextNode = $contextNode->getParent();
    
    return in_array($contextNode->tag, array_keys($context));
  }
  
  public function isOpenerTag($pos)
  {
    return !$this->isCloserTag($pos);
  }
  
  public function isCloserTag($pos)
  {
    if(substr($this->_raw, $pos + 1, 1) == '/')
    {
      return True;
    }
    
    return False;
  }
  
  public function skipTag($pos)
  {    
    $pos = strpos($this->_raw, $this->_options['closechar'], $pos);
    
    if($pos === False) $this->_index = strlen($this->_raw) - 1;
    
    $this->_index = $pos + 1;
  }
  
  public function skipOne($pos)
  {
    $this->_index++;
  }
  
  public function getTagAt($pos)
  {
    if(substr($this->_raw, $pos, 1) != $this->_options['openchar']) return False;
    if(substr($this->_raw, $pos + 1, 1) == '/') $pos++;
    
    $tag = array();
    $endpos = strpos($this->_raw, $this->_options['closechar'], $pos);
    $tag['raw'] = substr($this->_raw, $pos + 1, ($endpos - $pos - 1));
    
    if(strpos($tag['raw'], '=') === false)
    {
      $tag['tag'] = substr($this->_raw, $pos + 1, ($endpos - $pos - 1));
      $tag['attr'] = '';
    }
    else
    {
      $arr = explode('=', $tag['raw']);
      $tag['tag'] = $arr[0];
      $tag['attr'] = $arr[1];
    }
    
    if(isset($this->_tags[$tag['tag']]))
    {
      $tag['selfclose'] = ($this->_tags[$tag['tag']]['selfclose']) ? True : False;
    }
    else
    {
      $tag['selfclose'] = False;
    }
    
    return $tag;
  }
  
  public function getCurrentChunk($pos)
  {
    if($pos === False) return substr($this->_raw, $this->_index, strlen($this->_raw) - $this->_index);
    
    return substr($this->_raw, $this->_index, $pos - $this->_index);
  }
  
  public function renderTag($tagName, $content = Null, $attr = Null)
  {
    
    $method = 'render'.ucfirst($tagName);
    if(method_exists($this, $method) && $method != 'renderTag')
    {
      return $this->$method($tagName, $content, $attr);
    }
    else
    {
      return $this->renderBaseTag($tagName, $content, $attr);
    }
  }
  
  public function renderBaseTag($tagName, $content = Null, $attr = Null)
  {
    $tag = $this->getTag($tagName);
    $string = str_ireplace('${content}', $content, $tag['pattern']);
    $string = str_ireplace('${attr}', $attr, $string);
    
    return $string;
  }
  
  public static function getInstance()
  {
    if (!isset(self::$instance))
    {
      $class = __CLASS__;
      self::$instance = new $class();
    }
 
    return self::$instance;
  }
  
  public $_count = 0;
  public function exitOn($limit)
  {
    $this->_count++;
    
    if($this->_count >= $limit) exit;
  }
}





class bbNode
{
  public $parser;
  public $content;
  public $attribute;
  public $tag;
  public $selfclose = False;
  
  protected $parent;
  protected $childs = array();
  
  public function __construct($datas = Null)
  {
    if(isset($datas) && is_array($datas))
    {
      if(isset($datas['content'])) $this->content = $datas['content'];
      if(isset($datas['tag'])) $this->tag = $datas['tag'];
      if(isset($datas['attr'])) $this->attribute = $datas['attr'];
      if(isset($datas['selfclose'])) $this->selfclose = $datas['selfclose'];
    }
  }
  
  public function __toString()
  {
    $string = ($this->content) ? $this->content : '';
    
    foreach($this->childs as $child)
    {
      $string .= $child;
    }
    
    
    if($this->tag)
    {
      $string = $this->parser->renderTag($this->tag, $string, $this->attribute);
    }
    
    return $string;
  }
  
  public function getRoot()
  {
    $node = $this;
    
    while($node = $node->getParent())
    {
      if($node->isRoot()) return $node;
    }
  }
  
  public function isRoot()
  {
    return $this->parent ? False : True;
  }
  
  public function appendChild(bbNode $node)
  {
    $this->childs[] = $node;
    $node->setParent($this);
  }
  
  public function appendText($text)
  {
    $node = new bbNode(array('content' => $text));
    
    $this->appendChild($node);
  }
  
  public function getParent()
  {
    if($this->isRoot()) return $this;
    
    return $this->parent;
  }
  
  public function setParent(bbNode $node)
  {
    $this->parent = $node;
  }
  
  public function toArray()
  {
    $tree = array();
    $tree['content'] = $this->content;
    $tree['attribute'] = $this->attribute;
    
    foreach($this->childs as $child)
    {
      $tree[$child->tag] = $child->toArray();
    }
  }
}


class bbParser extends bbParserBase
{
  public function configure()
  {
    $this->addTag('b');
    $this->addTag('i');
    $this->addTag('u');
    $this->addTag('s');
    
    $this->addTag('h4');
    
    $this->addTag('sup');
    $this->addTag('sub');
    
    $this->addTag('center', '<center>${content}</center>');
    $this->addTag('code', '<pre class="code">${content}</pre>');
    $this->addTag('img', '<img src="${content}">');
    
    $this->addTag('url');
    $this->addTag('size');
    $this->addTag('list');
    $this->addTag('quote');
    $this->addTag('*', '<li>${content}</li>', array('selfclose' => True, 'context' => array('list')));
  }
  
  public function renderImg($tagName, $content = Null, $attr = Null)
  {
    return sprintf('<img src="%s">', image_path($content));
  }
  
  public function renderUrl($tagName, $content = Null, $attr = Null)
  {
    if($attr)
    {
      return sprintf('<a href="%s">%s</a>', url_for($attr), $content);
    }
    
    return sprintf('<a href="%s">%s</a>', url_for($content), $content);
  }
  
  public function renderSize($tagName, $content = Null, $attr = Null)
  {
    if($attr)
    {
      return sprintf('<span style="font-size: %s;">%s</span>', $attr, $content);
    }
    
    return $content;
  }
  
  public function renderList($tagName, $content = Null, $attr = Null)
  {
    if($attr)
    {
      return sprintf('<ol>%s</ol>', $content);
    }
    
    return sprintf('<ul>%s</ul>', $content);
  }
  
  public function renderQuote($tagName, $content = Null, $attr = Null)
  {
    if($attr)
    {
      return sprintf('<blockquote">%s</blockquote><cite>%s</cite>', $content, $attr);
    }
    
    return sprintf('<blockquote">%s</blockquote>', $content);
  }
}

function bb_parse($string)
{
  $parser = new bbParser();
  return $parser->toHtml($string);
  
  while (preg_match_all('#\[(.+?)=?(.*?)\](.+?)\[/\1\]#s', $string, $matches))
  {
    foreach ($matches[0] as $key => $match)
    {
      list($tag, $param, $innertext) = array($matches[1][$key], $matches[2][$key], $matches[3][$key]);
      
      switch ($tag)
      {
        case 'b':
          $replacement = "<strong>$innertext</strong>";
          break;
        case 'h4':
        case 'u':
          $replacement = "<$tag>$innertext</$tag>";
          break;
        case 'list':
          $replacement = ($param ? "<ol>$innertext</ol>" : "<ul>$innertext</ul>");
          break;
        case 'i':
          $replacement = "<em>$innertext</em>";
          break;
        case 'size':
          $replacement = "<span style=\"font-size: $param;\">$innertext</span>";
          break;
        case 'color':
          $replacement = "<span style=\"color: $param;\">$innertext</span>";
          break;
        case 'center':
          $replacement = "<div class=\"center\">$innertext</div>";
          break;
        case 'quote':
          $replacement = "<blockquote>$innertext</blockquote>" . $param? "<cite>$param</cite>" : '';
          break;
        case 'code':
          $replacement = "<pre class=\"code\">$innertext</pre>"; break;
        case 'url':
          $replacement = '<a href="' . ($param? $param : $innertext) . "\">$innertext</a>";
          break;
        case 'img':
          list($width, $height) = preg_split('`[Xx]`', $param);
          $replacement = "<img src=\"$innertext\" " . (is_numeric($width)? "width=\"$width\" " : '') . (is_numeric($height)? "height=\"$height\" " : '') . '/>';
          break;
        case 'video':
          $videourl = parse_url($innertext);
          parse_str($videourl['query'], $videoquery);
          if (strpos($videourl['host'], 'youtube.com') !== FALSE) $replacement = '<embed src="http://www.youtube.com/v/' . $videoquery['v'] . '" type="application/x-shockwave-flash" width="425" height="344"></embed>';
          if (strpos($videourl['host'], 'google.com') !== FALSE) $replacement = '<embed src="http://video.google.com/googleplayer.swf?docid=' . $videoquery['docid'] . '" width="400" height="326" type="application/x-shockwave-flash"></embed>';
        break;
      }
      
      $string = str_replace($match, $replacement, $string);
    }
  }
  
  $string = preg_replace('/\[\*\](.*?)(\r?\n)/s', '<li>\\1</li>', $string);
  $string = preg_replace('/<(li|ul)>\s/', "<\\1>", $string);
  $string = str_replace("\r\n\r\n", "\n</p>\n<p>\n  ", $string);
  $string = str_replace("\r\n", "<br/>\n", $string);
  $string = sprintf("<p>\n  %s\n</p>\n", $string);
  
  return $string;
}

function bb_no_parse($string)
{
    
  while (preg_match_all('#\[(.+?)=?(.*?)\](.+?)\[/\1\]#s', $string, $matches))
  {
    foreach ($matches[0] as $key => $match)
    {
      list($tag, $param, $innertext) = array($matches[1][$key], $matches[2][$key], $matches[3][$key]);
      
      switch ($tag)
      {
        case 'b':
        case 'h1':
        case 'h2':
        case 'h3':
        case 'h4':
        case 'u':
        case 'list':
        case 'i':
        case 'size':
        case 'color':
        case 'center':
        case 'quote':
        case 'code':
          $replacement = "$innertext";
          break;
        case 'img':
        case 'video':
          $replacement = "";
          break;
      }
      
      $string = str_replace($match, $replacement, $string);
    }
  }
  
  $string = preg_replace('/\[\*\](.*?)(\r?\n)/s', '<li>\\1</li>', $string);
  $string = preg_replace('/<(li|ul)>\s/', "<\\1>", $string);
  $string = str_replace("\r\n\r\n", "\n</p>\n<p>\n  ", $string);
  $string = str_replace("\r\n", "<br/>\n", $string);
  $string = sprintf("<p>\n  %s\n</p>\n", $string);
  
  return $string;
} 
