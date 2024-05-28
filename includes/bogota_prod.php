<?php
session_start();

/*

BogotaDC.travel PHP SDK
Version 1.0
Basic PHP functions for Bogota Tourism Website


*/

class bogota{
    
    public $domain = "https://files.visitbogota.co/drpl/es/api/v1";
    public $generalInfo = array();
    public $language = "";
    public $production=true;
        
    function __construct($language,$development = false) {
        if($development){ $this->production = false; }
        $this->language = $language;    
        $this->generalInfo = $this->gInfo();
    }
    function productmenu($menu)
    {
        if($menu=="footer")
        {
            if(isset($_SESSION['menuFooter'])){
                $result = $_SESSION['menuFooter'];
            }else {
                $result = $this->query("productmenu/all/1");
                $_SESSION['menuFooter'] = $result;
            }
        }else
        {
            if(isset($_SESSION['menuHeader'])){
                $result = $_SESSION['menuFooter'];
            }else {
                $result = $this->query("productmenu/1/all");
                $_SESSION['menuHeader'] = $result;
            }
        }
        
        return $result;
    }
    function searchContent($search)
    {
        $result = $this->query("search/".urlencode($search));
        return $result;
    }
    function gInfo()
    {
        if(isset($_SESSION['ginfo']))
        {
            $gnrl = $_SESSION['ginfo'];
        }else
        {
            $result = $this->query("infognrl");
            $gnrl = $result[0];
            $_SESSION['ginfo'] = $gnrl;
        }
        return $gnrl;
    }
    function plans($id = 0, $wFilters = false)
    {
        if($id==0){
            if(isset($_SESSION['plans']))
            {
                $result = $_SESSION['plans'];
            }else
            {
                $result = $this->query("para/all");
                $_SESSION['plans'] = $result;
            }
        }else
        {
             if(isset($_SESSION['plans']))
             {
                 for($i=0;$i<count($_SESSION['plans']);$i++)
                 {
                     if($id === $_SESSION['plans'][$i]->nid)
                     {
                         $result = $_SESSION['plans'][$i];
                         if($wFilters) {
                             $result = (array)$result;
                             $result['filters'] = $this->planFilters();
                             $result = (object)$result;
                         }
                     }
                 }
             }else
             {
                 $result = $this->query("para/".$id);
                 if($wFilters) {
                     $result = (array)$result;
                    $result['filters'] = $this->planFilters();
                    $result = (object)$result;
                 }
             }
        }
        return $result;
    }
    function products($category=0, $id = 0, $wFilters = false)
    {
        if($id==0 && $category == 0){ //All products
            if(isset($_SESSION['products']))
            {
                $result = $_SESSION['products'];
            }else
            {
                $result = $this->query("products/all/all");
                $_SESSION['products'] = $result;
            }
        }else if($id==0 && $category>0){ //Products by category
            $list = array();
            if(isset($_SESSION['products']))
                 {
                    for($i=0;$i<count($_SESSION['products']);$i++)
                     {
                        if($category === $_SESSION['products'][$i]->field_cat_rel)
                        {
                            array_push($list,$_SESSION['products'][$i]);
                        }
                     }
            
            
                    }else
                    {
                        if(isset($_SESSION['productsAll'])){
                            $list = $_SESSION['productsAll'];
                        }else {
                            $list = $this->query("products/all/".$category);
                            $_SESSION['productsAll'] = $list;

                        }
                    }
                $result = $list;
            
                return $result;
        
        }else{ //Single Product
                 if(isset($_SESSION['products']))
                 {
                     for($i=0;$i<count($_SESSION['products']);$i++)
                     {
                         if($id === $_SESSION['products'][$i]->nid)
                         {
                             $result = $_SESSION['products'][$i];
                             if($wFilters){
                                $result = (array)$result;
                                $result['filters'] = $this->productFilters($result->field_cat_rel,$id);;
                                $result = (object)$result;
                             }
                        }
                     }
                 }else
                 {
                     $result = $this->query("products/".$id."/all")[0];
                     if($wFilters){
                        $result = (array)$result;
                        $result['filters'] = $this->productFilters($result->field_cat_rel,$id);;
                        $result = (object)$result;
                     }
                 }
            }
        
            return $result;
    }
    function otherProducts($ID,$quantity=5)
    {
        $partial = $this->products();
        for($i=0;$i<count($partial);$i++)
        {
            if($partial[$i]->nid == $ID)
            {
                unset($partial[$i]);
            }
        }
        //$final = array_rand($partial,$quantity);
        $final = $partial;
        return $final;
    }
    function zones($id = 0, $wFilters = false)
    {
        if($id==0){ //All Zones
            if(isset($_SESSION['zones']))
            {
                $result = $_SESSION['zones'];
            }else
            {
                $result = $this->query("zones/all");
                $_SESSION['zones'] = $result;
            }
        }else //Single Zone
        {
             if(isset($_SESSION['zones']))
             {
                 for($i=0;$i<count($_SESSION['zones']);$i++)
                 {
                     if($id === $_SESSION['zones'][$i]->nid)
                     {
                         $result = $_SESSION['zones'][$i];
                         if($wFilters){ 
                             $result = (array)$result;
                             $result['filters'] = $this->zoneFilters();
                             $result = (object)$result;
                         }
                     }
                 }
             }else
             {
                 $result = $this->query("zones/".$id)[0];
                 if($wFilters) {
                     $result = (array)$result;
                     $result['filters'] = $this->zoneFilters();
                     $result = (object)$result;
                 }
             }
        }
        return $result;
    }
    function featuredSlider()
    {
        $result = $this->query("featured");
        
        for($i=0;$i<count($result);$i++)
        {
            $result[$i]->url = $this->contentURL($result[$i]->field_contenido_relacionado)[0]->url;
        }
        
        return $result;
    }
    function nearbyPlaces($page,$id=0)
    {
        $page=$page-1;
        if($id==0){ $comp = "all/?page=".$page; }else{ $comp=$id; }
            
        $result = $this->query("nearby/".$comp);
        
        if($id>0){ $result = $result[0]; }
        return $result;
    }
    function singleCampaign($id)
    {
        $result = $this->query("campaign/".$id);
        
        return $result;
    }
    function productFilters($categoryID,$productID)
    {
        //Droplist
            $droplist = $this->products($categoryID);
            
        //filter1
            $filter1 = $this->subproducts($productID);
            
            
        //filter2
            $filter2 = $this->zones();
            
            
        //filter3
            $filter3 = $this->plans();
        
        $resultArray = array("droplist" => $droplist, "filter1"=>$filter1, "filter2"=>$filter2, "filter3"=>$filter3);
        
        return $resultArray;
        
    }
    function subproducts($productID)
    {
        $result = $this->query("subproducts/".$productID);
        return $result;
    }
    function singlePlace($placeID)
    {
         $result = $this->query("singleplace/".$placeID."all/all/all");
         return $result;
    }
    function places($plans,$subproducts,$zone,$closeto)
    {
        if(is_array($plans)){ $plansF = implode("+", $plans); }else{ $plansF= "all"; }
        if(is_array($subproducts)){ $subpF = implode("+", $subproducts); }else{ $subpF = "all"; }
        if(is_array($zone)){ $zoneF = implode("+", $zone); }else{ $zoneF = "all"; }

        $result = $this->query("places/all/".$plansF."/".$subpF."/".$zoneF);
        $result = $this->unifyPlaces($result);

        if(is_array($closeto) && is_numeric($closeto[0]) && is_numeric($closeto[1]))
        {
            for($i=0;$i<count($result);$i++)
            {
                $placelocation = explode(",", $result[$i]->field_location);
                $distancia = $this->distance($closeto,$placelocation);
                if($distancia > 2){
                    unset($result[$i]);
                }
                if($result[$i]->field_inmaterial === "1"){
                    unset($result[$i]);
                }
                if($result[$i]->field_inmaterial === ""){
                    unset($result[$i]);
                }
            }
            $result = array_values($result);            
        }
        return $result;
    }    
    function distance($currentLocation, $placeLocation)
    {
        $distanceinKM = 6371*acos(cos(deg2rad(90-$currentLocation[0]))*cos(deg2rad(90-$placeLocation[0]))+sin(deg2rad(90-$currentLocation[0]))*sin(deg2rad(90-$placeLocation[0]))*cos(deg2rad($currentLocation[1]-$placeLocation[1])));
        return $distanceinKM;
    }
    function unifyPlaces($object)
    {
        $localArray = array();
        $result = array();
        for($i=0;$i<count($object);$i++)
        {
            if(!in_array($object[$i]->nid,$localArray))
            {
                array_push($localArray,$object[$i]->nid);
                array_push($result,$object[$i]);
            }
        }
        return $result;
    }
    function planFilters()
    {
            //Droplist
            $droplist = $this->plans();
            
        //filter1
            $filter1 = $this->subproducts("all");
            
            
        //filter2
            $filter2 = $this->zones();
            
            
        //filter3
            $filter3 = array();
        
        $resultArray = array("droplist" => $droplist, "filter1"=>$filter1, "filter2"=>$filter2, "filter3"=>$filter3);
        
        return $resultArray;
    }
    function zoneFilters()
    {
         //Droplist
            $droplist = $this->zones();
            
        //filter1
            $filter1 = $this->plans();
            
            
        //filter2
            $filter2 = $this->subproducts("all");
            
            
        //filter3
            $filter3 = array();
        
        $resultArray = array("droplist" => $droplist, "filter1"=>$filter1, "filter2"=>$filter2, "filter3"=>$filter3);
        
        return $resultArray;
    }
    function blogs($ID,$productID,$quantity=13,$offset=0,$page=1)
    {
        if($ID>0)
        {
            $page=0;
            $perpage=1;
            $offset=0;
            $productID="all";
        }
        if($productID>0 || $productID=="all")
        {
            $page=$page-1;
        }
        
        $result = $this->query("blog/".$ID."/".$productID."?page=".$page."&items_per_page=".$quantity."&offset=".$offset);
        return $result;
        
    }
    function tripinfo($category,$id="all")
    {
       if($category=="all" && $id>0 || $category>0 && $id=="all") //Single item
       {
           $result = $this->query("tripinfo/".$category."/".$id);
       }
        
          return $result;  //https://files.visitbogota.co/drpl/es/api/v1/es/tripinfo/all/18
    }
    function tripinfoCats($cat)//cat_help_info, product, faq
    {
        $result = $this->query("tripinfocat/".$cat);
        return $result;
    }
    function getFaqs($cat){
        $result = $this->query("faq/".$cat);
        return $result;
    }
    function shorter($text, $chars_limit)
    {
        // Check if length is larger than the character limit
        if (strlen($text) > $chars_limit)
        {
            // If so, cut the string at the character limit
            $new_text = substr($text, 0, $chars_limit);
            // Trim off white space
            $new_text = trim($new_text);
            // Add at end of text ...
            return $new_text . "...";
        }
        // If not just return the text as is
        else
        {
        return $text;
        }
    }
    function contentURL($id)
    {
        
            $result = array();
            if($id>0){
        
            $result = $this->query("gcontent/".$id);
            
            switch($result[0]->type)
            {
                case "Artículo":
                    
                    $url = "/blog/".$this->get_alias($result[0]->field_prod_rel)."/".$this->get_alias($result[0]->title)."/".$result[0]->field_prod_rel_1."/".$result[0]->nid;
                    // bogotadc.travel/blog/:producto/:articulo/:idproducto/:idsubproducto/:idarticulo
                    break;
                case "Atractivos":
                    //   :atractivo/:idatractivo
                    $url = "/".$this->get_alias($result[0]->title)."/".$result[0]->nid;
                    break;
                case "Campaña":
                    // /iniciativas/bogota-cielo-abierto/56
                    $url = "/iniciativas/".$this->get_alias($result[0]->title)."/".$result[0]->nid;
                    break;
                default:
                    $url="#";
            }
            
            $result[0]->url = $url;
            }
        
        return $result;
    }
    function getMedia($id = 'all'){
        $result = $this->query("media/".$id);
        foreach ($result as $value) {
            return $value;
        }
    }
    function query($url,$body="")
    {
            $endpoint = $this->domain."/".$this->language."/".$url;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $endpoint);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            $request = json_decode($output);
            curl_close($ch);

            if(!$this->production){ echo "<br><br><strong>".$endpoint."</strong><br>"; print_r($request); }
            return $request;
    }
    function simplequery($url,$body="")
    {
       $endpoint = $url;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $endpoint);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            $request = json_decode($output);
            curl_close($ch);

            if(!$this->production){ echo "<br><br><strong>".$endpoint."</strong><br>"; print_r($request); }
            return $request; 
    }
    function bogotaweather()
    {
        function buildBaseString($baseURI, $method, $params) {
            $r = array();
            ksort($params);
            foreach($params as $key => $value) {
                $r[] = "$key=" . rawurlencode($value);
            }
            return $method . "&" . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $r));
        }

        function buildAuthorizationHeader($oauth) {
            $r = 'Authorization: OAuth ';
            $values = array();
            foreach($oauth as $key=>$value) {
                $values[] = "$key=\"" . rawurlencode($value) . "\"";
            }
            $r .= implode(', ', $values);
            return $r;
        }

        $url = 'https://weather-ydn-yql.media.yahoo.com/forecastrss';
        $app_id = 'Lgv7B36C';
        $consumer_key = 'dj0yJmk9TWtjYlppYUtieFVkJmQ9WVdrOVRHZDJOMEl6TmtNbWNHbzlNQT09JnM9Y29uc3VtZXJzZWNyZXQmc3Y9MCZ4PWY2';
        $consumer_secret = 'fdf88d676e672c399f89b71e6d58c1b1291317e9';

        $query = array(
            'location' => 'bogota,co',
            'format' => 'json',
            'u' => 'c'
        );

        $oauth = array(
            'oauth_consumer_key' => $consumer_key,
            'oauth_nonce' => uniqid(mt_rand(1, 1000)),
            'oauth_signature_method' => 'HMAC-SHA1',
            'oauth_timestamp' => time(),
            'oauth_version' => '1.0'
        );

        $base_info = buildBaseString($url, 'GET', array_merge($query, $oauth));
        $composite_key = rawurlencode($consumer_secret) . '&';
        $oauth_signature = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
        $oauth['oauth_signature'] = $oauth_signature;

        $header = array(
            buildAuthorizationHeader($oauth),
            'X-Yahoo-App-Id: ' . $app_id
        );
        $options = array(
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_HEADER => false,
            CURLOPT_URL => $url . '?' . http_build_query($query),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false
        );

        $ch = curl_init();
        curl_setopt_array($ch, $options);
        $response = curl_exec($ch);
        curl_close($ch);

        //print_r($response);
        $return_data = json_decode($response);
        
        $return_data->current_observation->condition->temperatureF=ceil(($return_data->current_observation->condition->temperature* (9/5)) + 32 );
        //print_r($return_data->current_observation->condition);

        return $return_data->current_observation->condition;
    }
    function setSubscriber($email)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
              CURLOPT_URL => "https://files.visitbogota.co/drpl/entity/user",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS =>"{\r\n   \"name\":[{\"value\":\"".$email."\"}],\r\n    \"mail\":[{\"value\":\"".$email."\"}],\r\n    \"roles\":[{\"target_id\":\"suscriptor\"}],\r\n    \"pass\":[{\"value\":\"test\"}],\r\n    \"status\":[{\"value\":\"1\"}]\r\n}",
              CURLOPT_HTTPHEADER => array(
                "Authorization: Basic ZGV2ZWxvcGVyOkVIVkBhXCgjRnl9LTVCSF8=",
                "Content-Type: application/json",
                "Cookie: __cfduid=d46d32125f3807fe17263a76e46846c531599431613"
              ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            return $response;
    }
    function get_alias($String) {
        $String = html_entity_decode($String); // Traduce codificación

        $String=str_replace("¡","",$String);//Signo de exclamación abierta.&iexcl;
        $String=str_replace("!","",$String);//Signo de exclamación cerrada.&iexcl;
        $String=str_replace("¢","-",$String);//Signo de centavo.&cent;
        $String=str_replace("£","-",$String);//Signo de libra esterlina.&pound;
        $String=str_replace("¤","-",$String);//Signo monetario.&curren;
        $String=str_replace("¥","-",$String);//Signo del yen.&yen;
        $String=str_replace("¦","-",$String);//Barra vertical partida.&brvbar;
        $String=str_replace("§","-",$String);//Signo de sección.&sect;
        $String=str_replace("¨","-",$String);//Diéresis.&uml;
        $String=str_replace("©","-",$String);//Signo de derecho de copia.&copy;
        $String=str_replace("ª","-",$String);//Indicador ordinal femenino.&ordf;
        $String=str_replace("«","-",$String);//Signo de comillas francesas de apertura.&laquo;
        $String=str_replace("¬","-",$String);//Signo de negación.&not;
        $String=str_replace("","-",$String);//Guión separador de sílabas.&shy;
        $String=str_replace("®","-",$String);//Signo de marca registrada.&reg;
        $String=str_replace("¯","&-",$String);//Macrón.&macr;
        $String=str_replace("°","-",$String);//Signo de grado.&deg;
        $String=str_replace("±","-",$String);//Signo de más-menos.&plusmn;
        $String=str_replace("²","-",$String);//Superíndice dos.&sup2;
        $String=str_replace("³","-",$String);//Superíndice tres.&sup3;
        $String=str_replace("´","-",$String);//Acento agudo.&acute;
        $String=str_replace("µ","-",$String);//Signo de micro.&micro;
        $String=str_replace("¶","-",$String);//Signo de calderón.&para;
        $String=str_replace("·","-",$String);//Punto centrado.&middot;
        $String=str_replace("¸","-",$String);//Cedilla.&cedil;
        $String=str_replace("¹","-",$String);//Superíndice 1.&sup1;
        $String=str_replace("º","-",$String);//Indicador ordinal masculino.&ordm;
        $String=str_replace("»","-",$String);//Signo de comillas francesas de cierre.&raquo;
        $String=str_replace("¼","-",$String);//Fracción vulgar de un cuarto.&frac14;
        $String=str_replace("½","-",$String);//Fracción vulgar de un medio.&frac12;
        $String=str_replace("¾","-",$String);//Fracción vulgar de tres cuartos.&frac34;
        $String=str_replace("¿","-",$String);//Signo de interrogación abierta.&iquest;
        $String=str_replace("×","-",$String);//Signo de multiplicación.&times;
        $String=str_replace("÷","-",$String);//Signo de división.&divide;
        $String=str_replace("À","a",$String);//A mayúscula con acento grave.&Agrave;
        $String=str_replace("Á","a",$String);//A mayúscula con acento agudo.&Aacute;
        $String=str_replace("Â","a",$String);//A mayúscula con circunflejo.&Acirc;
        $String=str_replace("Ã","a",$String);//A mayúscula con tilde.&Atilde;
        $String=str_replace("Ä","a",$String);//A mayúscula con diéresis.&Auml;
        $String=str_replace("Å","a",$String);//A mayúscula con círculo encima.&Aring;
        $String=str_replace("Æ","a",$String);//AE mayúscula.&AElig;
        $String=str_replace("Ç","c",$String);//C mayúscula con cedilla.&Ccedil;
        $String=str_replace("È","e",$String);//E mayúscula con acento grave.&Egrave;
        $String=str_replace("É","e",$String);//E mayúscula con acento agudo.&Eacute;
        $String=str_replace("Ê","e",$String);//E mayúscula con circunflejo.&Ecirc;
        $String=str_replace("Ë","e",$String);//E mayúscula con diéresis.&Euml;
        $String=str_replace("Ì","i",$String);//I mayúscula con acento grave.&Igrave;
        $String=str_replace("Í","i",$String);//I mayúscula con acento agudo.&Iacute;
        $String=str_replace("Î","i",$String);//I mayúscula con circunflejo.&Icirc;
        $String=str_replace("Ï","i",$String);//I mayúscula con diéresis.&Iuml;
        $String=str_replace("Ð","d",$String);//ETH mayúscula.&ETH;
        $String=str_replace("Ñ","n",$String);//N mayúscula con tilde.&Ntilde;
        $String=str_replace("Ò","o",$String);//O mayúscula con acento grave.&Ograve;
        $String=str_replace("Ó","o",$String);//O mayúscula con acento agudo.&Oacute;
        $String=str_replace("Ô","o",$String);//O mayúscula con circunflejo.&Ocirc;
        $String=str_replace("Õ","o",$String);//O mayúscula con tilde.&Otilde;
        $String=str_replace("Ö","o",$String);//O mayúscula con diéresis.&Ouml;
        $String=str_replace("Ø","o",$String);//O mayúscula con barra inclinada.&Oslash;
        $String=str_replace("Ù","u",$String);//U mayúscula con acento grave.&Ugrave;
        $String=str_replace("Ú","u",$String);//U mayúscula con acento agudo.&Uacute;
        $String=str_replace("Û","u",$String);//U mayúscula con circunflejo.&Ucirc;
        $String=str_replace("Ü","u",$String);//U mayúscula con diéresis.&Uuml;
        $String=str_replace("Ý","y",$String);//Y mayúscula con acento agudo.&Yacute;
        $String=str_replace("Þ","b",$String);//Thorn mayúscula.&THORN;
        $String=str_replace("ß","b",$String);//S aguda alemana.&szlig;
        $String=str_replace("à","a",$String);//a minúscula con acento grave.&agrave;
        $String=str_replace("á","a",$String);//a minúscula con acento agudo.&aacute;
        $String=str_replace("â","a",$String);//a minúscula con circunflejo.&acirc;
        $String=str_replace("ã","a",$String);//a minúscula con tilde.&atilde;
        $String=str_replace("ä","a",$String);//a minúscula con diéresis.&auml;
        $String=str_replace("å","a",$String);//a minúscula con círculo encima.&aring;
        $String=str_replace("æ","a",$String);//ae minúscula.&aelig;
        $String=str_replace("ç","a",$String);//c minúscula con cedilla.&ccedil;
        $String=str_replace("è","e",$String);//e minúscula con acento grave.&egrave;
        $String=str_replace("é","e",$String);//e minúscula con acento agudo.&eacute;
        $String=str_replace("ê","e",$String);//e minúscula con circunflejo.&ecirc;
        $String=str_replace("ë","e",$String);//e minúscula con diéresis.&euml;
        $String=str_replace("ì","i",$String);//i minúscula con acento grave.&igrave;
        $String=str_replace("í","i",$String);//i minúscula con acento agudo.&iacute;
        $String=str_replace("î","i",$String);//i minúscula con circunflejo.&icirc;
        $String=str_replace("ï","i",$String);//i minúscula con diéresis.&iuml;
        $String=str_replace("ð","i",$String);//eth minúscula.&eth;
        $String=str_replace("ñ","n",$String);//n minúscula con tilde.&ntilde;
        $String=str_replace("ò","o",$String);//o minúscula con acento grave.&ograve;
        $String=str_replace("ó","o",$String);//o minúscula con acento agudo.&oacute;
        $String=str_replace("ô","o",$String);//o minúscula con circunflejo.&ocirc;
        $String=str_replace("õ","o",$String);//o minúscula con tilde.&otilde;
        $String=str_replace("ö","o",$String);//o minúscula con diéresis.&ouml;
        $String=str_replace("ø","o",$String);//o minúscula con barra inclinada.&oslash;
        $String=str_replace("ù","o",$String);//u minúscula con acento grave.&ugrave;
        $String=str_replace("ú","u",$String);//u minúscula con acento agudo.&uacute;
        $String=str_replace("û","u",$String);//u minúscula con circunflejo.&ucirc;
        $String=str_replace("ü","u",$String);//u minúscula con diéresis.&uuml;
        $String=str_replace("ý","y",$String);//y minúscula con acento agudo.&yacute;
        $String=str_replace("þ","b",$String);//thorn minúscula.&thorn;
        $String=str_replace("ÿ","y",$String);//y minúscula con diéresis.&yuml;
        $String=str_replace("Œ","d",$String);//OE Mayúscula.&OElig;
        $String=str_replace("œ","-",$String);//oe minúscula.&oelig;
        $String=str_replace("Ÿ","-",$String);//Y mayúscula con diéresis.&Yuml;
        $String=str_replace("ˆ","-",$String);//Acento circunflejo.&circ;
        $String=str_replace("˜","-",$String);//Tilde.&tilde;
        $String=str_replace("–","-",$String);//Guiún corto.&ndash;
        $String=str_replace("—","-",$String);//Guiún largo.&mdash;
        $String=str_replace("'","-",$String);//Comilla simple izquierda.&lsquo;
        $String=str_replace("'","-",$String);//Comilla simple derecha.&rsquo;
        $String=str_replace("‚","-",$String);//Comilla simple inferior.&sbquo;
        $String=str_replace("\"","-",$String);//Comillas doble derecha.&rdquo;
        $String=str_replace("\"","-",$String);//Comillas doble inferior.&bdquo;
        $String=str_replace("†","-",$String);//Daga.&dagger;
        $String=str_replace("‡","-",$String);//Daga doble.&Dagger;
        $String=str_replace("…","-",$String);//Elipsis horizontal.&hellip;
        $String=str_replace("‰","-",$String);//Signo de por mil.&permil;
        $String=str_replace("‹","-",$String);//Signo izquierdo de una cita.&lsaquo;
        $String=str_replace("›","-",$String);//Signo derecho de una cita.&rsaquo;
        $String=str_replace("€","-",$String);//Euro.&euro;
        $String=str_replace("™","-",$String);//Marca registrada.&trade;
        $String=str_replace(":","-",$String);//Marca registrada.&trade;
        $String=str_replace(" & ","-",$String);//Marca registrada.&trade;
        $String=str_replace("(","-",$String);
        $String=str_replace(")","-",$String);
        $String=str_replace("?","-",$String);
        $String=str_replace("¿","-",$String);
        $String=str_replace(",","-",$String);
        $String=str_replace(";","-",$String);
        $String=str_replace("�","-",$String);
        $String=str_replace("/","-",$String);
        $String=str_replace(" ","-",$String);//Espacios
        $String=str_replace(".","",$String);//Punto
        $String=str_replace("&","-",$String);
        
        //Mayusculas
        $String=strtolower($String);
        
        return($String);
    }
    function create_metas($seoId){
        if($seoId == ''){
            $seoId = 4;
        }
        $seo = $this->query("seo/".$seoId);
        $seo = $seo[0];
        var_dump($seo);

        global $metas,$urlMap;
    
        $ret = '';
        $metas['title'] = $seo->field_seo_title;
        $metas['desc'] = $seo->field_seo_desc;
        $metas['words'] = $seo->field_seo_keys;
        $metas['img'] = "https://files.visitbogota.co" . $seo->field_seo_img;
    
        list($width, $height, $type, $attr) = getimagesize("https://files.visitbogota.co" . $seo->field_seo_img); 
    
        $ret = '<meta charset="utf-8">'.PHP_EOL;
        $ret .= '<link rel="canonical" href="'.$_GET['canon'].'">'.PHP_EOL;
        $ret .= '<meta name="keywords" content="'.$metas['words'].'">'.PHP_EOL;
        $ret .= '<meta name="description" content="'.$metas['desc'].'">'.PHP_EOL;
        $ret .= '<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, maximum-scale=1.5">'.PHP_EOL;
        $ret .= '<title>'.$metas['title'].'</title>'.PHP_EOL;
        $ret .= '<meta name="thumbnail" content="'.$metas['img'].'">'.PHP_EOL;
        $ret .= '<meta name="language" content="spanish">'.PHP_EOL;
        $ret .= '<meta name="twitter:card" content="summary_large_image">'.PHP_EOL;
        $ret .= '<meta name="twitter:site" content="@BogotaDCTravel">'.PHP_EOL;
        $ret .= '<meta name="twitter:title" content="'.$metas['title'].'">'.PHP_EOL;
        $ret .= '<meta name="twitter:description" content="'.$metas['desc'].'">'.PHP_EOL;
        $ret .= '<meta name="twitter:image" content="'.$metas['img'].'">'.PHP_EOL;
        //$ret .= '<meta property="fb:app_id" content="865245646889167">'.PHP_EOL;
        $ret .= '<meta property="og:url" content="https://files.visitbogota.co/'.$_GET['canon'].'">'.PHP_EOL;
        $ret .= '<meta property="og:type" content="website">'.PHP_EOL;
        $ret .= '<meta property="og:title" content="'.$metas['title'].'">'.PHP_EOL;
        $ret .= '<meta property="og:site_name" content="'.$metas['title'].'">'.PHP_EOL;
        $ret .= '<meta property="og:description" content="'.$metas['desc'].'">'.PHP_EOL;
        $ret .= '<meta property="og:image" content="'.$metas['img'].'">'.PHP_EOL;
        $ret .= '<meta property="og:image:width" content="'.$width.'">'.PHP_EOL;
        $ret .= '<meta property="og:image:height" content="'.$height.'">'.PHP_EOL;
        $ret .= '<meta property="og:image:alt" content="'.$metas['title'].'"/>'.PHP_EOL;
        $ret .= PHP_EOL;
        $ret .= "<!--[if IE]>\n";
        $ret .= "<script>\n";
        $ret .= "\n\tdocument.createElement('header');\n\tdocument.createElement('footer');";
        $ret .= "\n\tdocument.createElement('section');\n\tdocument.createElement('figure');\n\tdocument.createElement('aside');";
        $ret .= "\n\tdocument.createElement('nav');\n\tdocument.createElement('article');";
        $ret .= "\n</script>\n";
        $ret .= "\n<![endif]-->\n";
        
        return $ret;
    }
}
?>