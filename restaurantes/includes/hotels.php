<?php
/*

Mice microsite class
Version 1.0
Basic PHP functions for Mice Microsite


*/
session_start();
class hotels extends bogota
{
    
    public $domain = "https://www.bogotadc.travel/drpl/es/api/v1";
    public $generalInfo = array();
    public $language = "";
    public $production = true;


    public $miceinfo = array();


    function __construct($language, $development = false)
    {
        $this->language = $language;
        if ($development) {
            $this->production = false;
        }
        $this->miceinfo = $this->miceinfo();
       
    }
    public function miceinfo()
    {
        
        if (isset($_SESSION['miceinfo'][$this->language])) {
            $gnrl = $_SESSION['miceinfo'][$this->language];
        } else {
            $result = $this->query("mice_infognrl");
            $gnrl = $result[0];
            $_SESSION['miceinfo'][$this->language] = $gnrl;
            $_SESSION['micefilters'] = array();
        }
        return $gnrl;
    }
    public function getHotels($zones,$id="all")
    {
       $querystr = "webhotels/".$id."/".$zones;
        $firstqueryfilter = true;

        //echo $querystr;
        $result = $this->query($querystr);

        return $result;
    }

  
    public function getfilters($filter)
    {

        $querystr = "micefilters?filter=".$filter;
        
        if (isset($_SESSION['micefilters'][$filter])) {
            $result = $_SESSION['micefilters'][$filter];
        }else
        {
            $result = $this->query($querystr, "", true);
            $_SESSION['micefilters'][$filter] = $result;

        }
        
        return $result;
    }
   
    function absoluteURL($str) //Enviar a bogota SDK
    {
     if(strpos($str,"https")==false){ return "https://files.visitbogota.co".$str; }else{ return $str; }
    
    }
  
}


