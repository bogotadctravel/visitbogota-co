<?php
/*

Plan Bogota microsite class
Version 1.0
Basic PHP functions for Plan Bogota Microsite


*/
session_start();
class planbogota extends bogota
{
    
    public $domain = "https://www.bogotadc.travel/drpl/es/api/v1";
    public $generalInfo = array();
    public $pb_experiencias = array();
    public $language = "";
    public $production = true;


    public $planbogotainfo = array();


    function __construct($language, $development = false)
    {
        $this->language = $language;
        if ($development) {
            $this->production = false;
        }
        $this->generalInfo = $this->getInfoGnrl();
        $this->pb_experiencias = $this->getPlabrasInterfazPB();
    }
    function absoluteURL($str) //Enviar a bogota SDK
    {
     if(strpos($str,"https")==false){ return "https://files.visitbogota.co".$str; }else{ return $str; }
    
    }

    function getPlans($id = "all"){
        $result = $this->query("ofertas/".$id);
        if($id == "all"){
            return $this->unifyPlaces($result);
            
        }else{
            return $result[0];
            
        }
    }
    function searchPlans($term, $quant){
        $result = $this->query("pbsearch/".$term."?field_maxpeople_value=". $quant);
            return $result;
    }
    
    function getInfoGnrl(){
        $result = $this->query("pb_infognrl");
        $gnrl = $result[0];
    return $gnrl;
    }
    function getPlabrasInterfazPB(){
        $result = $this->query("palabras_interfaz/3224", "", true);
        $expoleWords = explode("|", $result[0]->field_palabras); 
        return $expoleWords;
    }
    
    function getZonesPB(){
        $result = $this->query("zones/all");
        return $result;
    }
    function getFaqPB(){
        $result = $this->query("faqpb");
        return $result;
    }
    function getTaxs($taxName){
        $result = $this->query("tax/".$taxName);
        return $result;
    }
    function getCompany($id){
        $result = $this->query("rld_operadores/".$id);
        return $result[0];
    }
    
    function filterPlans($zones, $persons, $segments, $price, $term,$quant ){
        // Realiza los reemplazos necesarios y valida si están vacíos
        $zonesFormatted = !empty($zones) ? str_replace(" ", "+", $zones) : "all";
        $personsFormatted = !empty($persons) ? str_replace(" ", "+", $persons) : "all";
        $segmentsFormatted = !empty($segments) ? str_replace(" ", "+", $segments) : "all";
        $termSelected = !empty($term) ? $term : "all";

        // Concatena los valores formateados
        $url = "ofertas_filtradas/" . $zonesFormatted . "/" . $personsFormatted . "/" . $segmentsFormatted . "/" . $termSelected . $price . $quant;
        $result = $this->query($url);
        return $this->unifyPlaces($result);
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

    function allOfertasActivas(){
        $result = $this->query("ofertas-activas");
        return $result;
    }
    function allEmpresasActivas(){
        $result = $this->query("excel/empresas");
        return $result;
    }
   
}