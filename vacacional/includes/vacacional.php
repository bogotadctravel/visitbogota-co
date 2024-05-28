<?php
/*

Vacacional class
Version 1.0
Basic PHP functions forVacacional

*/
session_start();
class vacacional extends bogota{
    public $domain = "https://www.bogotadc.travel/drpl/es/api/v1";
    public $domainv2 = "https://www.bogotadc.travel/drpl/es/api/v2";
    public $generalInfo = array();
    public $language = "";
    public $production = true;

    function __construct($language, $development = false){
        $this->language = $language;
        if ($development) {
            $this->production = false;
        }       
    }

    public function getLastBlogs(){
        $querystr = "lastblog/all/all";
        $result = $this->query($querystr);        
        return $result;
    }
    public function getLastEvents(){
        $querystr = "eventshome";
        $result = $this->query($querystr, "", true);        
        return $result;
    }
    public function getZonas(){
        $querystr = "zonas_tax";
        $result = $this->query($querystr);        
        return $result;
    }
    public function getBannersCuadrados(){
        $result = $this->query("banners_cuadrados", "", true);
        return $result;
    }
    public function getRutasTuristicas($id="all"){
        $result = $this->query("rt/$id", "", true);
        return $result;
    }
    public function getSlidersHome(){
        $result = $this->query("slider_home", "", true);
        return $result;
    }
    public function getOfertasRel($id_atractivo){
        $result = $this->query("ofertas/".$id_atractivo, "", true);
        return $result;
    }
    public function get_atractivos($id="all",$category ="all"){
        $result = $this->query("atractivos/$id/$category", "", true);
        return $result;
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
        function getprodTax($id){
            $result = $this->query("productcat/".$id);
            return $result[0];
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
        function getProductsRel($id){
            $result = $this->query("products/all/". $id);
            return $result;
        }
        function getDescargables($prod){
            $res = $this->query("tripinfoapp/3/" . $prod,"",true); 
            return $res;
        }
        function getbi_imagenes_home(){
            $res = $this->query("bi_imagenes_home"); 
            return $res;
        }
}


