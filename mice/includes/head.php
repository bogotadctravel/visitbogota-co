<?php 
$lang = $_GET['lang'];
if (file_exists("includes/bogota.php")) { 
    include "includes/bogota.php";
}else{
  $include_level = "../";  
  $project_base = "/mice/";
  $project_folder = "mice";
  include "../includes/header.php";
}
  $bogota = new bogota(isset($lang) ? $lang  : 'es' );
  include "includes/mice.php";
  $mice = new mice(isset($lang) ? $lang  : 'en' );

?>
<?php if (file_exists("includes/bogota.php")) { ?>
<!DOCTYPE html>
<html lang="<?= isset($lang) ? $lang  : 'en'?>">
  <head>
    <base href="/">
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#00857f" />
    <meta name="twitter:card" value="summary" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="MICE" />
    <meta property="og:url" content=" url" />
    <meta property="og:image" content=" img/ventajas.jpg" />
    <meta property="og:description" content="description" />
    <title>MICE</title>    
    <link rel="canonical" href="url" />
    <link rel="stylesheet" href="/css/styles.css">
  </head>
<?php }?>
  <script>
     var actualLang = "<?= $_GET['lang'] ? $_GET['lang'] : 'es' ?>";
    var aforoMin = "<?= $mice->miceinfo->field_minaforo ?>";
    var aforoMax = "<?= $mice->miceinfo->field_maxaforo ?>";
    var miceinfo = <?= json_encode($mice->miceinfo) ?>;
  </script>
  <style>
    .salas .right .gallery .disinfo:after {
content: "<?= $mice->miceinfo->field_mice_ui_24 ?>";
}
  </style>

  <body class="<?=$bodyClass?>">