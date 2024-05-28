<?php
session_start();
class Rld extends bogota
{
    
    public $domain = "https://www.bogotadc.travel/drpl/es/api/v1";
    public $language = "";
    public $production = true;
    
    public $miceinfo = array();

    function __construct($language, $development = false)
    {
        $this->language = $language;
        if ($development) {
            $this->production = false;
        }
       
    }
  
}


