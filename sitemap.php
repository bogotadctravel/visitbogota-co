<?php
// Configurar cabecera para XML
header("Content-Type: application/xml; charset=UTF-8");

$base_url = "https://visitbogota.co";
$cache_file = "/home/bogotas/public_html/cache/sitemap.xml";
$cache_time = 86400; // 24 horas

if (file_exists($cache_file) && (time() - filemtime($cache_file)) < $cache_time) {
    readfile($cache_file);
    exit;
}

// Definir rutas fijas
$routes = [
    "/es/",
    "/en/",
    "/es/donde-comer",
    "/es/donde-dormir",
    "/es/informacion-al-viajero",
];

// Función para limpiar y formatear los títulos para SEO
function generateSlug($String){
    $String = html_entity_decode($String); // Traduce codificación

    $String = str_replace("¡", "", $String); //Signo de exclamación abierta.&iexcl;
    $String = str_replace("'", "", $String); //Signo de exclamación abierta.&iexcl;
    $String = str_replace("!", "", $String); //Signo de exclamación cerrada.&iexcl;
    $String = str_replace("¢", "-", $String); //Signo de centavo.&cent;
    $String = str_replace("£", "-", $String); //Signo de libra esterlina.&pound;
    $String = str_replace("¤", "-", $String); //Signo monetario.&curren;
    $String = str_replace("¥", "-", $String); //Signo del yen.&yen;
    $String = str_replace("¦", "-", $String); //Barra vertical partida.&brvbar;
    $String = str_replace("§", "-", $String); //Signo de sección.&sect;
    $String = str_replace("¨", "-", $String); //Diéresis.&uml;
    $String = str_replace("©", "-", $String); //Signo de derecho de copia.&copy;
    $String = str_replace("ª", "-", $String); //Indicador ordinal femenino.&ordf;
    $String = str_replace("«", "-", $String); //Signo de comillas francesas de apertura.&laquo;
    $String = str_replace("¬", "-", $String); //Signo de negación.&not;
    $String = str_replace("", "-", $String); //Guión separador de sílabas.&shy;
    $String = str_replace("®", "-", $String); //Signo de marca registrada.&reg;
    $String = str_replace("¯", "&-", $String); //Macrón.&macr;
    $String = str_replace("°", "-", $String); //Signo de grado.&deg;
    $String = str_replace("±", "-", $String); //Signo de más-menos.&plusmn;
    $String = str_replace("²", "-", $String); //Superíndice dos.&sup2;
    $String = str_replace("³", "-", $String); //Superíndice tres.&sup3;
    $String = str_replace("´", "-", $String); //Acento agudo.&acute;
    $String = str_replace("µ", "-", $String); //Signo de micro.&micro;
    $String = str_replace("¶", "-", $String); //Signo de calderón.&para;
    $String = str_replace("·", "-", $String); //Punto centrado.&middot;
    $String = str_replace("¸", "-", $String); //Cedilla.&cedil;
    $String = str_replace("¹", "-", $String); //Superíndice 1.&sup1;
    $String = str_replace("º", "-", $String); //Indicador ordinal masculino.&ordm;
    $String = str_replace("»", "-", $String); //Signo de comillas francesas de cierre.&raquo;
    $String = str_replace("¼", "-", $String); //Fracción vulgar de un cuarto.&frac14;
    $String = str_replace("½", "-", $String); //Fracción vulgar de un medio.&frac12;
    $String = str_replace("¾", "-", $String); //Fracción vulgar de tres cuartos.&frac34;
    $String = str_replace("¿", "-", $String); //Signo de interrogación abierta.&iquest;
    $String = str_replace("×", "-", $String); //Signo de multiplicación.&times;
    $String = str_replace("÷", "-", $String); //Signo de división.&divide;
    $String = str_replace("À", "a", $String); //A mayúscula con acento grave.&Agrave;
    $String = str_replace("Á", "a", $String); //A mayúscula con acento agudo.&Aacute;
    $String = str_replace("Â", "a", $String); //A mayúscula con circunflejo.&Acirc;
    $String = str_replace("Ã", "a", $String); //A mayúscula con tilde.&Atilde;
    $String = str_replace("Ä", "a", $String); //A mayúscula con diéresis.&Auml;
    $String = str_replace("Å", "a", $String); //A mayúscula con círculo encima.&Aring;
    $String = str_replace("Æ", "a", $String); //AE mayúscula.&AElig;
    $String = str_replace("Ç", "c", $String); //C mayúscula con cedilla.&Ccedil;
    $String = str_replace("È", "e", $String); //E mayúscula con acento grave.&Egrave;
    $String = str_replace("É", "e", $String); //E mayúscula con acento agudo.&Eacute;
    $String = str_replace("Ê", "e", $String); //E mayúscula con circunflejo.&Ecirc;
    $String = str_replace("Ë", "e", $String); //E mayúscula con diéresis.&Euml;
    $String = str_replace("Ì", "i", $String); //I mayúscula con acento grave.&Igrave;
    $String = str_replace("Í", "i", $String); //I mayúscula con acento agudo.&Iacute;
    $String = str_replace("Î", "i", $String); //I mayúscula con circunflejo.&Icirc;
    $String = str_replace("Ï", "i", $String); //I mayúscula con diéresis.&Iuml;
    $String = str_replace("Ð", "d", $String); //ETH mayúscula.&ETH;
    $String = str_replace("Ñ", "n", $String); //N mayúscula con tilde.&Ntilde;
    $String = str_replace("Ò", "o", $String); //O mayúscula con acento grave.&Ograve;
    $String = str_replace("Ó", "o", $String); //O mayúscula con acento agudo.&Oacute;
    $String = str_replace("Ô", "o", $String); //O mayúscula con circunflejo.&Ocirc;
    $String = str_replace("Õ", "o", $String); //O mayúscula con tilde.&Otilde;
    $String = str_replace("Ö", "o", $String); //O mayúscula con diéresis.&Ouml;
    $String = str_replace("Ø", "o", $String); //O mayúscula con barra inclinada.&Oslash;
    $String = str_replace("Ù", "u", $String); //U mayúscula con acento grave.&Ugrave;
    $String = str_replace("Ú", "u", $String); //U mayúscula con acento agudo.&Uacute;
    $String = str_replace("Û", "u", $String); //U mayúscula con circunflejo.&Ucirc;
    $String = str_replace("Ü", "u", $String); //U mayúscula con diéresis.&Uuml;
    $String = str_replace("Ý", "y", $String); //Y mayúscula con acento agudo.&Yacute;
    $String = str_replace("Þ", "b", $String); //Thorn mayúscula.&THORN;
    $String = str_replace("ß", "b", $String); //S aguda alemana.&szlig;
    $String = str_replace("à", "a", $String); //a minúscula con acento grave.&agrave;
    $String = str_replace("á", "a", $String); //a minúscula con acento agudo.&aacute;
    $String = str_replace("â", "a", $String); //a minúscula con circunflejo.&acirc;
    $String = str_replace("ã", "a", $String); //a minúscula con tilde.&atilde;
    $String = str_replace("ä", "a", $String); //a minúscula con diéresis.&auml;
    $String = str_replace("å", "a", $String); //a minúscula con círculo encima.&aring;
    $String = str_replace("æ", "a", $String); //ae minúscula.&aelig;
    $String = str_replace("ç", "a", $String); //c minúscula con cedilla.&ccedil;
    $String = str_replace("è", "e", $String); //e minúscula con acento grave.&egrave;
    $String = str_replace("é", "e", $String); //e minúscula con acento agudo.&eacute;
    $String = str_replace("ê", "e", $String); //e minúscula con circunflejo.&ecirc;
    $String = str_replace("ë", "e", $String); //e minúscula con diéresis.&euml;
    $String = str_replace("ì", "i", $String); //i minúscula con acento grave.&igrave;
    $String = str_replace("í", "i", $String); //i minúscula con acento agudo.&iacute;
    $String = str_replace("î", "i", $String); //i minúscula con circunflejo.&icirc;
    $String = str_replace("ï", "i", $String); //i minúscula con diéresis.&iuml;
    $String = str_replace("ð", "i", $String); //eth minúscula.&eth;
    $String = str_replace("ñ", "n", $String); //n minúscula con tilde.&ntilde;
    $String = str_replace("ò", "o", $String); //o minúscula con acento grave.&ograve;
    $String = str_replace("ó", "o", $String); //o minúscula con acento agudo.&oacute;
    $String = str_replace("ô", "o", $String); //o minúscula con circunflejo.&ocirc;
    $String = str_replace("õ", "o", $String); //o minúscula con tilde.&otilde;
    $String = str_replace("ö", "o", $String); //o minúscula con diéresis.&ouml;
    $String = str_replace("ø", "o", $String); //o minúscula con barra inclinada.&oslash;
    $String = str_replace("ù", "o", $String); //u minúscula con acento grave.&ugrave;
    $String = str_replace("ú", "u", $String); //u minúscula con acento agudo.&uacute;
    $String = str_replace("û", "u", $String); //u minúscula con circunflejo.&ucirc;
    $String = str_replace("ü", "u", $String); //u minúscula con diéresis.&uuml;
    $String = str_replace("ý", "y", $String); //y minúscula con acento agudo.&yacute;
    $String = str_replace("þ", "b", $String); //thorn minúscula.&thorn;
    $String = str_replace("ÿ", "y", $String); //y minúscula con diéresis.&yuml;
    $String = str_replace("Œ", "d", $String); //OE Mayúscula.&OElig;
    $String = str_replace("œ", "-", $String); //oe minúscula.&oelig;
    $String = str_replace("Ÿ", "-", $String); //Y mayúscula con diéresis.&Yuml;
    $String = str_replace("ˆ", "", $String); //Acento circunflejo.&circ;
    $String = str_replace("˜", "", $String); //Tilde.&tilde;
    $String = str_replace("–", "", $String); //Guiún corto.&ndash;
    $String = str_replace("—", "", $String); //Guiún largo.&mdash;
    $String = str_replace("'", "", $String); //Comilla simple izquierda.&lsquo;
    $String = str_replace("'", "", $String); //Comilla simple derecha.&rsquo;
    $String = str_replace("‚", "", $String); //Comilla simple inferior.&sbquo;
    $String = str_replace("\"", "", $String); //Comillas doble derecha.&rdquo;
    $String = str_replace("\"", "", $String); //Comillas doble inferior.&bdquo;
    $String = str_replace("†", "-", $String); //Daga.&dagger;
    $String = str_replace("‡", "-", $String); //Daga doble.&Dagger;
    $String = str_replace("…", "-", $String); //Elipsis horizontal.&hellip;
    $String = str_replace("‰", "-", $String); //Signo de por mil.&permil;
    $String = str_replace("‹", "-", $String); //Signo izquierdo de una cita.&lsaquo;
    $String = str_replace("›", "-", $String); //Signo derecho de una cita.&rsaquo;
    $String = str_replace("€", "-", $String); //Euro.&euro;
    $String = str_replace("™", "-", $String); //Marca registrada.&trade;
    $String = str_replace(":", "-", $String); //Marca registrada.&trade;
    $String = str_replace(" & ", "-", $String); //Marca registrada.&trade;
    $String = str_replace("(", "-", $String);
    $String = str_replace(")", "-", $String);
    $String = str_replace("?", "-", $String);
    $String = str_replace("¿", "-", $String);
    $String = str_replace(",", "-", $String);
    $String = str_replace(";", "-", $String);
    $String = str_replace("�", "-", $String);
    $String = str_replace("/", "-", $String);
    $String = str_replace(" ", "-", $String); //Espacios
    $String = str_replace(".", "", $String); //Punto
    $String = str_replace("&", "-", $String);
    $String = str_replace("“", "", $String);
    $String = str_replace("”", "", $String);
    $String = str_replace("+", "", $String);
    $String = str_replace("’", "", $String);
    $String = str_replace("‘", "", $String);
    $String = str_replace("'", "", $String);
    $String = str_replace("?", "", $String);
    $String = str_replace("¿", "", $String);
    $String = str_replace("'", "", $String);
    $String = str_replace("'", "", $String);
    $String = str_replace("`", "", $String);
    $String = str_replace("`", "", $String);

    //Mayusculas
    $String = strtolower($String);

    return ($String);
}

// Función para obtener URLs dinámicas según el tipo
function fetchDynamicUrls($api_url, $type) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    
    $data = json_decode($output, true);
    $urls = [];

    if ($data && is_array($data)) {
        foreach ($data as $item) {

            if (isset($item["title"]) && isset($item["nid"])) {
                $slug = generateSlug($item["title"]);
                $id = $item["nid"];

                if ($type == "blog") {
                    $urls[] = "/es/blog/all/{$slug}-all-{$id}";
                } elseif ($type == "event") {
                    $urls[] = "/es/evento/{$slug}-{$id}";
                }
            }
        }
    }

    return $urls;
}

// Obtener URLs dinámicas desde la API
$routes = array_merge($routes, fetchDynamicUrls("https://bogotadc.travel/drpl/es/api/v2/blog/all/all", "blog"));
$routes = array_merge($routes, fetchDynamicUrls("https://bogotadc.travel/drpl/es/api/v2/eventsweb/all/all/all/all", "event"));

// Generar XML y guardar en caché
ob_start();
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php foreach ($routes as $route) : ?>
        <url>
            <loc><?php echo $base_url . $route; ?></loc>
            <lastmod><?php echo date('Y-m-d'); ?></lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    <?php endforeach; ?>
</urlset>

<?php
$sitemap = ob_get_contents();
ob_end_clean();
file_put_contents($cache_file, $sitemap);
echo $sitemap;
?>
