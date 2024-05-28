<?php 
if (file_exists("includes/bogota.php")) { 
    include "includes/bogota.php";
}else{
  $include_level = "../";  
  $project_base = "/rld/";
  $project_folder = "rld";
  include "../includes/header.php";
}
  $bogota = new bogota($_GET["lang"] ? $_GET["lang"]  : 'es' );
  include "rld.php";
  $mice = new Rld($_GET["lang"] ? $_GET["lang"]  : 'es' );

?>
<?php if (file_exists("includes/bogota.php")) { ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#00857f" />
    <meta name="twitter:card" value="summary" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Ruta leyenda el Dorado en Bogotá - BogotaDC.travel" />
    <meta property="og:url" content=" url" />
    <meta property="og:image" content=" img/ventajas.jpg" />
    <meta property="og:description" content="description" />
    <title>Ruta leyenda el Dorado - BogotaDC.travel</title>
    
    <link rel="canonical" href="url" />
    <meta name="description" content="description" />
  </head>

<?php }?>