<?php
// Configurar cabecera para XML
header("Content-Type: application/xml; charset=UTF-8");

$base_url = "https://visitbogota.co";
$cache_file = "/home/bogotas/public_html/visitbogota.co/sitemap_en_.xml";
$cache_time = 86400; // 24 horas

clearstatcache(true, $cache_file);

if (file_exists($cache_file) && (time() - filemtime($cache_file)) < $cache_time) {
    readfile($cache_file);
    exit;
}


// Definir rutas fijas
$routes = [
    "/en/",
    "/en/donde-comer",
    "/en/donde-dormir",
    "/en/informacion-al-viajero",
    "/en/blog",
    "/en/experiencias-turisticas",
    "/en/rutas-turisticas",
    "/en/eventos/agenda-general-148",
    "/en/banco-imagenes/",
    "/en/ruta-leyenda-el-dorado/inicio",
    "/en/ruta-leyenda-el-dorado/ruta/universo-muisca--845",
    "/en/ruta-leyenda-el-dorado/ruta/entre-agua-y-dioses--844",
    "/en/ruta-leyenda-el-dorado/ruta/inmersion-muisca-841",
    "/en/ruta-leyenda-el-dorado/ruta/oro-blanco--agua-verde-842",
    "/en/ruta-leyenda-el-dorado/ruta/conexion-entre-dos-mundos-824",
    "/en/ruta-leyenda-el-dorado/ruta/ancestros-de-sugamuxi--843",
    "/en/ruta-leyenda-el-dorado/imperdibles/"
];

// Función para limpiar y formatear los títulos para SEO
function generateSlug($string) {
    $string = html_entity_decode($string, ENT_QUOTES, 'UTF-8');
    
    // Mapa de caracteres a reemplazar
    $map = [
        'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 
        'Ç' => 'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 
        'Î' => 'I', 'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 
        'Ö' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'ß' => 'ss',
        'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 
        'ç' => 'c', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 
        'î' => 'i', 'ï' => 'i', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 
        'ö' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ý' => 'y', 'ÿ' => 'y'
    ];
    
    $string = strtr($string, $map);
    $string = preg_replace('/[^a-zA-Z0-9-]+/', '-', $string);
    $string = trim($string, '-');
    
    return strtolower($string);
}


function fetchDynamicUrls($api_url, $type) {
    $cacheAbsoluteRoute = "/home/bogotas/public_html/visitbogota.co/cache/";
    $filetitle = md5($api_url) . ".json";
    $cachePath = $cacheAbsoluteRoute . $filetitle;

    // Verificar si existe la caché
    if (file_exists($cachePath)) {
        $data = json_decode(file_get_contents($cachePath), true);
    } else {
        // Si no hay caché, hacer la petición
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($output, true);

        // Guardar en caché
        if (!file_exists($cacheAbsoluteRoute)) {
            mkdir($cacheAbsoluteRoute, 0777, true);
        }
        file_put_contents($cachePath, json_encode($data));
    }

    $urls = [];
    if ($data && is_array($data)) {
        foreach ($data as $item) {
            if (isset($item["title"]) && isset($item["nid"]) || isset($item["name"]) && isset($item["tid"])) {
                $slug = isset($item["title"]) ? generateSlug($item["title"]) : generateSlug($item["name"]);
                $id = $item["nid"] ?? $item["tid"];


                if ($type == "blog") {
                    $urls[] = "/en/blog/all/{$slug}-all-{$id}";
                } elseif ($type == "event") {
                    $urls[] = "/en/evento/{$slug}-{$id}";
                } elseif ($type == "category") {
                    $urls[] = "/en/explora/{$slug}/{$id}";
                    $urls[] = "/en/banco-imagenes/resultados/?productid={$id}";
                }elseif ($type == "atractivo"){
                    $urls[] = "/en/atractivo/all/{$slug}-all-{$id}";
                    if(isset($item["field_gastrozone"])){
                        $zonetitle = generateSlug($item['field_gastrozone_1']);
                        $urls[] = "/en/zona-gastronomica/{$zonetitle}-{$item["field_gastrozone"]}";
                    }
                }elseif ($type == "ruta"){
                    $urls[] = "/en/rutas-turisticas/{$slug}-{$id}";
                }
                elseif ($type == "experiencia"){
                    $urls[] = "/en/experiencias-turisticas/plan/{$slug}-{$id}";
                }
                elseif ($type == "restaurantes"){
                    $zone = $item["field_zone_rel"];
                    $urls[] = "/en/restaurante/{$slug}-{$zone}-{$id}";
                }
                elseif ($type == "bi"){
                    $urls[] = "/en/banco-imagenes/interna-{$id}";
                }
            }
        }
    }
    return $urls;
}


// Obtener URLs dinámicas desde la API
$routes = array_merge($routes, fetchDynamicUrls("https://bogotadc.travel/drpl/es/api/v2/blog/all/all?langcode=en", "blog"));
$routes = array_merge($routes, fetchDynamicUrls("https://bogotadc.travel/drpl/es/api/v2/eventsweb/all/all/all/all?langcode=en", "event"));
$routes = array_merge($routes, fetchDynamicUrls("https://bogotadc.travel/drpl/es/api/v2/categorias_atractivos/all?langcode=en", "category"));
$routes = array_merge($routes, fetchDynamicUrls("https://bogotadc.travel/drpl/es/api/v2/atractivos/all/all?langcode=en", "atractivo"));
$routes = array_merge($routes, fetchDynamicUrls("https://bogotadc.travel/drpl/es/api/v2/rt/all?langcode=en", "ruta"));
$routes = array_merge($routes, fetchDynamicUrls("https://bogotadc.travel/drpl/es/api/v2/ofertasapp/all/all/all/all/all?langcode=en", "experiencia"));
$routes = array_merge($routes, fetchDynamicUrls("https://bogotadc.travel/drpl/es/api/v2/restaurants/all/all/all/all/all?langcode=en", "restaurantes"));
$routes = array_merge($routes, fetchDynamicUrls("https://bogotadc.travel/drpl/es/api/v1/es/bi_imagenes", "bi"));

// Generar XML y guardar en caché
$dom = new DOMDocument('1.0', 'UTF-8');
$dom->formatOutput = true;

$urlset = $dom->createElement('urlset');
$urlset->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

foreach ($routes as $route) {
    $url = $dom->createElement('url');

    $loc = $dom->createElement('loc', $base_url . $route);
    $url->appendChild($loc);

    $lastmod = $dom->createElement('lastmod', date('c'));
    $url->appendChild($lastmod);

    $urlset->appendChild($url);
}

$dom->appendChild($urlset);
$dom->save($cache_file);

header("Content-Type: application/xml; charset=UTF-8");
echo $dom->saveXML();

?>
