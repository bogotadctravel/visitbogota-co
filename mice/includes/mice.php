<?php
/*

Mice microsite class
Version 1.0
Basic PHP functions for Mice Microsite


*/
session_start();
class mice extends bogota
{
    
    public $domain = "https://www.bogotadc.travel/drpl/es/api/v1";
    public $generalInfo = array();
    public $language = "es";
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
            $result = $this->query("mice_infognrl", "", true);
            $gnrl = $result[0];
            $_SESSION['miceinfo'][$this->language] = $gnrl;
            $_SESSION['micefilters'] = array();
        }
        return $gnrl;
    }
    public function getVenues($type,$cert,$maxcap)
    {
        $querystr = "venues/".$type."/".$cert;
        $firstqueryfilter = true;
        if(is_array($maxcap) && count($maxcap)>0)
        {
            for($i=0;$i<count($maxcap);$i++)
            {
                $connector = "&";
                if($firstqueryfilter){ $connector = "?"; $firstqueryfilter = false; }
                $querystr.=$connector.$maxcap[$i]["filter"]."=".$maxcap[$i]["value"];
            }
        }
        // echo $querystr;
        $result = $this->query($querystr);

        return $this->unifyPlaces($result);
    }
    public function getProviders($type,$cert,$maxcap)
    {
        $querystr = "providers/".$type."/".$cert;
        $firstqueryfilter = true;

        if(is_array($maxcap) && count($maxcap)>0)
        {
            for($i=0;$i<count($maxcap);$i++)
            {
                $connector = "&";
                if($firstqueryfilter){ $connector = "?"; $firstqueryfilter = false; }
                $querystr.=$connector.$maxcap[$i]["filter"]."=".$maxcap[$i]["value"];
            }
        }
        // echo $querystr;

        $result = $this->query($querystr);

        return $result;
    }
    public function getLinks()
    {
        $querystr = "micelinks";
       
        $result = $this->query($querystr, "", true);

        return $result;
    }
    public function getCases()
    {
        $querystr = "cases";
       
        $result = $this->query($querystr, "", true);

        return $result;
    }
    public function getfilters($filter)
    {
        $querystr = "micefilters?filter=".$filter;
            $result = $this->query($querystr);
      
        return $result;
    }
    public function getData()
    {
        $querystr = "data";
       
        $result = $this->query($querystr);

        return $result;
    }
    public function getLanding($id)
    {
        $querystr = "landing/".$id;
       
        $result = $this->query($querystr, "", true);

        return $result[0];
    }
    function absoluteURL($str) //Enviar a bogota SDK
    {
     if(strpos($str,"https")==false){ return "https://files.visitbogota.co".$str; }else{ return $str; }
    
    }
    function get_mice_single_provider($id)
    {
        $result = $this->query("miceprovider/" . $id);
        return $result[0];
    }
    function get_mice_single_venues($id)
    {
        $result = $this->query("singlevenue/" . $id, "", true);
        return $result[0];
    }
    function get_mice_venues($type, $formats, $aforo)
    {

        if (is_array($type)) {
            $typeF = implode("+", $type);
        } else {
            $typeF = "all";
        }
        $finalURL = "venues/" . $typeF . '/all?filter=0';
       
        $result = $this->query($finalURL);
        return $result;
    }

    function get_mice_sections()
    {
        $result = $this->query("mice");
        return $result;
    }
    function get_mice_infognrl()
    {
        if (isset($_SESSION['MICEgeneralInfo'][$this->language])) {
            $gnrl = $_SESSION['MICEgeneralInfo'][$this->language];
        } else {
            $result = $this->query("mice_infognrl", "", true);
            $gnrl = $result[0];
            $_SESSION['MICEgeneralInfo'][$this->language] = $gnrl;
        }
        return $gnrl;

        $result = $this->query("mice_infognrl");
        return $result;
    }

    // MICE
    


    
    function get_mice_provider($type, $page)
    {
        if (is_array($type)) {
            $typeF = implode("+", $type);
        } else {
            $typeF = "all";
        }
        $result = $this->query("miceprovider/all/" . $typeF . "?page=" . $page);
        return $this->unifyPlaces($result);
    }

    function get_mice_salones($venueID)
    {
        $result = $this->query("salones/" . $venueID, "", true);
        return $result;
    }
    function get_mice_casos()
    {
        $result = $this->query("casos_exito");
        return $this->unifyPlaces($result);
    }
    function get_single_mice_casos($id)
    {
        $result = $this->query("casos_exito/" . $id);
        return $result[0];
    }
    function get_mice_aeropuerto()
    {
        $result = $this->query("aeropuerto");
        return $this->unifyPlaces($result);
    }
    function get_mice_timeline($timeline)
    {
        $result = $this->query("timeline/" . $timeline);
        return $this->unifyPlaces($result);
    }
    function get_mice_imperdibles()
    {
        $result = $this->query("impplaces");
        return $result;
    }
    function get_mice_movilidad()
    {
        $result = $this->query("movilidad");
        return $this->unifyPlaces($result);
    }
    function get_mice_bioseguridad()
    {
        $result = $this->query("mice_bioseguridad");
        return $this->unifyPlaces($result);
    }
    function criteriosVenues()
    {
        $result = $this->query("tax/criterios_venues");
        return $result;
    }
    function eventformatVenues()
    {
        $result = $this->query("tax/event_format");
        return $result;
    }
    function criteriosProvider()
    {
        $result = $this->query("tax/provider_type");
        return $result;
    }
    function formatosSalas()
    {
        $result = $this->query("tax/format_sala");
        return $result;
    }
}


