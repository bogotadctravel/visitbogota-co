<?php 
header('Location: /');
exit;

if (file_exists("includes/bogota.php")) { 
    include "includes/bogota.php";
}else{
  $include_level = "../";  
  $project_base = "/mice/";
  $project_folder = "mice";
  include "../includes/header.php";
}
  $bogota = new bogota(isset($_GET["lang"]) ? $_GET["lang"]  : 'es' );
  include "includes/mice.php";
  $mice = new mice(isset($_GET["lang"]) ? $_GET["lang"]  : 'en' );

?>
<?php if (file_exists("includes/bogota.php")) { ?>
<!DOCTYPE html>
<html lang="<?= isset($_GET["lang"]) ? $_GET["lang"]  : 'en'?>">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#00857f" />
    <meta name="twitter:card" value="summary" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="MICE - BogotaDC.travel" />
    <meta property="og:url" content=" url" />
    <meta property="og:image" content=" img/ventajas.jpg" />
    <meta property="og:description" content="description" />
    <title>MICE - BogotaDC.travel</title>    
    <link rel="canonical" href="url" />
  </head>
<?php }?>
  <script>
    var aforoMin = "<?= $mice->miceinfo->field_minaforo ?>";
    var aforoMax = "<?= $mice->miceinfo->field_maxaforo ?>";
    var miceinfo = <?= json_encode($mice->miceinfo) ?>;
  </script>
  <style>
    .salas .right .gallery .disinfo:after {
content: "<?= $mice->miceinfo->field_mice_ui_24 ?>";
}
  </style>