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
    public function getHotels($zones="all",$id="all",$tipos_de_hotel="all",$servicios_de_hoteles="all",$rangos_de_precios_hoteles="all" ){
        $querystr = "webhotels/".$id."/".$zones."/".$tipos_de_hotel."/".$servicios_de_hoteles."/".$rangos_de_precios_hoteles;
        $firstqueryfilter = true;
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
            $result = $this->query($querystr);
            $_SESSION['micefilters'][$filter] = $result;

        }
        
        return $result;
    }
   
    function absoluteURL($str) //Enviar a bogota SDK
    {
     if(strpos($str,"https")==false){ return "https://files.visitbogota.co".$str; }else{ return $str; }
    
    }
    function getInfoGnrlPB(){
        if (isset($_SESSION['pbinfo'][$this->language])) {
            $gnrl = $_SESSION['pbinfo'][$this->language];
        } else {
            $result = $this->query("pb_infognrl");
            $gnrl = $result[0];
            $_SESSION['pbinfo'][$this->language] = $gnrl;
        }
        return $gnrl;
        }
        function getPlans($id = "all"){
            $result = $this->query("ofertas/".$id);
            if($id == "all"){
                return $result;
            }else{
                return $result[0];
            }
        }
        function getRecommendPlans($ids){
            $plans = explode(", ", $ids);  
            if(count($plans) > 1){
               $arr = array();
               for ($a=0; $a < count($plans); $a++) { 
                   array_push($arr, $this->getPlans($plans[$a]));
               }
               return $arr;
               }else{
                   $plan = $this->getPlans($ids);
                   return array($plan);
               }
    
        }
  
}


