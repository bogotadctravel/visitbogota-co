<?php
class bancoImagenes extends bogota {
    public $subproducts = array();
    public $RLDgeneralInfo = array();
    public $BIgeneralInfo = array();
    public $language = "es";
    public $production = true;

    function __construct($language, $development = false){
        if ($development) {
            $this->production = false;
        }
        $this->language = $language;
        $this->BIgeneralInfo = $this->getBIInfoGeneral();
    }
    function getBIInfoGeneral() {
        $result = $this->query("bi_infogeneral");
        $gnrl = $result[0];
        return $gnrl;
    }
    function getImages($products = false, $zone = false, $id = false){
        if (is_array($products)) {
            $prodF = implode("+", $products);
        } else {
            $prodF = "all";
        }
        if (is_array($zone)) {
            $zoneF = implode("+", $zone);
        } else {
            $zoneF = "all";
        }
        if($id){
            $idF = $id;
        }else{
            $idF = "all";
        }
        $thequery = "bi_imagenes/" . $idF . "/". $zoneF . "/" . $prodF;
        $result = $this->query($thequery);
        if($id){
            return $result[0];
        }else{
            return $this->unifyPlaces($result);

        }
    }
    function sendNotificationimage($emailto, $params){
    $curl = curl_init();
    $userID =2;
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.sendinblue.com/v3/smtp/email",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\"to\":[{\"email\":\"$emailto\",\"name\":\"$emailto\"}],\"params\":".$params.",\"templateId\":243}",
        CURLOPT_HTTPHEADER => [
            "Accept: application/json",
            "Content-Type: application/json",
            "api-key: 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"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return "cURL Error #:" . $err;
    } else {
        return $response;
    }
}

function setFirstImage($to, $params, $link){
    $emailSended = $this->sendNotificationimage($to, $params);
    return  $emailSended;
}

function searchByWord($word, $onlyImages = false, $onlyVideos = false){
    if($onlyImages){
        $result = $this->query("searchbi/".$word."?field_is_video_value=0");
    }else if($onlyVideos){
        $result = $this->query("searchbi/".$word."?field_is_video_value=1");
    }else{
        $result = $this->query("searchbi/".$word);

    }
    return $result;
}

function fixbiurl($prefix, $url, $author=''){
    $url_explode = explode('/upload/', $url);
    if($author != ''){
        $url_explode = $url_explode[0] .'/upload/l_text:Arial_50_bold:Archivo%20fotogr%C3%A1fico%20IDT. '.$author.',co_rgb:FFFFFF,g_south_east/'. $prefix .'/'. $url_explode[1];

    }else{
        $url_explode = $url_explode[0] .'/upload/'. $prefix .'/'. $url_explode[1];

    }
    return $url_explode;
}
function replaceSpecialCharactersWithUnderscores($text) {
    // Define a list of characters to replace
    $charactersToReplace = array(' ', 'ñ', 'á', 'é', 'í', 'ó', 'ú', 'ü', 'Á', 'É', 'Í', 'Ó', 'Ú', 'Ü', '(', ')');
    
    // Replace each special character with an underscore
    foreach ($charactersToReplace as $char) {
        $text = str_replace($char, '_', $text);
    }
    
    return $text;
}
function getInfo($url){
    $url = $this->fixbiurl('fl_getinfo', $url);
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $sizes = array();
    $sizes['width'] = $response->output->width;
    $sizes['height'] = $response->output->height;
    return $sizes;

}

function get_allImages(){
    $result = $this->query("bi_imagenes");
    return $result;
}
function get_products_byID($id){
    $result = $this->query("products/".$id."/all");
    return $result;
}
function get_signlang(){
    $result = $this->query("signlang/all");
    return $result;
}
function get_signlang_byID($id){
    $result = $this->query("signlang/".$id);
    return $result;
}
function getTaxAgenda($id){
    $result = $this->query("agenda_tax/".$id);
    return $result[0];
}
}
