<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of weezevent
 *
 * @author jerome
 */
class weezevent
{
    protected $datas = array();
    public $url = 'http://www.aremplirdotcom';
    public $error;

    public function __construct($url = Null)
    {
        if (!is_null($url))
            $this->url = $url;
    }

    public function setCriteria($key, $value)
    {
        $this->datas[$key] = $value;
    }

    public function check($barcode)
    {
      
    }

}

?>
