<?php

/**
 * API Weezevent
 *
 * 2013-01-28
 * Association Futurolan
 * Guillaume Marsay <guillaume@futurolan.net>
 *
 * Require : php_openssl extension
 */

class Weezevent_API
{
  protected $initialized = false;
  private $token = null;
  protected $login = '';
  protected $password = '';
  protected $api_key = '';
  public $env = 'prod';


  public function __construct()
  {
    if ($this->env == 'prod')
    {
      $this->api_url = 'https://api.weezevent.com/';
    }
    elseif ($this->env == 'test')
    {
      $this->api_url = 'https://test.weezevent.com/api/v2/';
    }
    else
    {
      throw new Exception('Your environment isn\'t valid. Please use "prod" or "test".');
      exit;
    }

    $this->auth();
  }


  public function isInitialized()
  {
    if ($this->initialized)
    {
      return true;
    }
    else
    {
      throw new Exception('You are not identified on Weezevent API.');
      return false;
    }
  }


  private function _getJson($url)
  {
    if ($json = @file_get_contents($url))
    {
      $json = json_decode($json);

      return $json;
    }

    throw new Exception('API Error.');
    return false;
  }


  public function auth()
  {
    $url = $this->api_url.'auth/access_token/?username='.$this->login.'&password='.$this->password.'&api_key='.$this->api_key;
    $json = $this->_getJson($url);

    $this->token = $json->accessToken;
    $this->initialized = true;
  }


  public function participantsByEventAndTournament($event, $tournament)
  {
    if ($this->isInitialized())
    {
      $url = $this->api_url.'participants?api_key='.$this->api_key.'&access_token='.$this->token.'&id_event[]='.$event.'&id_ticket[]='.$tournament.'&minimized=1';
      $json = $this->_getJson($url);

      return $json;
    }
  }

  public function checkParticipant($event, $tournament, $barcode)
  {
    $participants = $this->participantsByEventAndTournament($event, $tournament);

    $is_valid = false;

    foreach ($participants->p as $participant)
    {
      if ($participant->bc == $barcode)
      {
        $is_valid = true;
      }
    }

    return $is_valid;
  }
}

/**
 * How use it 
 * 
$weezevent = new Weezevent_API;
if ($weezevent->checkParticipant('53854', '217045', '7497363'))
{
  echo 'Ticket valide !';
}
 * */
 
?>
