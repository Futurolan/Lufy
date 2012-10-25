<?php

/**
 * mfjv
 * 
 * Master Français du Jeu Vidéo License checker class
 * 
 * @property string $url
 * @property string $error
 * 
 * @method SimpleXMLElement    check()    Query HTTP webservice, check licence and return result.
 * 
 * @author   Jean Christophe "Syam" Huwette
 * @link     www.mastersjeuvideo.org
 * @version  1.0
 * 
 */

/*
 * Use example :
 * 
 * $mfjv = new mfjv();
 * 
 * $mfjv->setCriteria('username', 'Syam');
 * $mfjv->setCriteria('first_name', 'Jean Christophe');
 * $mfjv->setCriteria('last_name', 'Huwette');
 * $mfjv->setCriteria('birthdate', '1981-04-01');
 * 
 * $result = $mfjv->check('8C11-ZCGOWP-131V');
 * 
 * if($result)
 * {
 *   echo $result->type."\n";
 *   echo $result->serial."\n";
 *   echo $result->season."\n";
 *   echo $result->username."\n";
 *   echo $result->used."\n";
 * }
 * 
 */

class mfjv
{
  protected $datas = array();
  public $url = 'http://www.mastersjeuvideo.org/license/check/%s.xml';
  public $error;
  
  public function __construct($url = Null)
  {
    if(!is_null($url)) $this->url = $url;
  }
  
  public function setCriteria($key, $value)
  {
    $this->datas[$key] = $value;
  }
  
  public function check($serial)
  {
    $url_parsed = parse_url(sprintf($this->url, urlencode($serial)));
    $post_string = '';
        
    foreach ($this->datas as $key => $value)
    {
       $post_string .= $key.'='.urlencode($value).'&'; 
    }
    
    $stream = fsockopen($url_parsed['host'], "80", $err_num, $err_str, 30);
    
    if(!$stream)
    {
      throw new Exception(sprintf('Unable to connect webservice : (%s) %s', $errnum, $errstr));
    }
    
    fputs($stream, "POST ".$url_parsed['path']." HTTP/1.1\r\n");
    fputs($stream, "Host: ".$url_parsed['host']."\r\n");
    fputs($stream, "Content-type: application/x-www-form-urlencoded\r\n");
    fputs($stream, "Content-length: ".strlen($post_string)."\r\n");
    fputs($stream, "Connection: close\r\n\r\n");
    fputs($stream, $post_string . "\r\n\r\n");
    
    $response = '';
    while(!feof($stream))
    {
      $response .= fgets($stream, 128);
      
      if(strlen($response) <= 128)
      {
        $pos = strpos($response, "\n");
        if(!strstr(substr($response, 0, $pos), '200'))
        {
          fclose($stream);
          
          return false;
        }
      }
    }
    
    fclose($stream);
    
    $pos = strpos($response, "\r\n\r\n");
    $response = substr($response, $pos + 4);
    
    $xml = new SimpleXMLElement($response);
    
    return $xml;
  }
}
