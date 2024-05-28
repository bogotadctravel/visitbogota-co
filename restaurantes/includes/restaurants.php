<?php
/*

Mice microsite class
Version 1.0
Basic PHP functions for Mice Microsite


*/
session_start();
class Restaurants extends bogota
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
    public function getRestaurants($categoria_restaurantes="all",$test_zona="all",$zonas_gastronomicas="all",$rangos_de_precio="all",$id="all")
    {
       $querystr = "webrestaurants/".$id."/".$test_zona."/".$rangos_de_precio."/".$zonas_gastronomicas."/".$categoria_restaurantes;
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


