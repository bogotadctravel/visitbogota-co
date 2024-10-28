<?php
$bodyClass = 'portal';
include 'includes/head.php';
$category;
if ($_GET['productID']) {
    $product = $b->getMenuTaxCategories($_GET['productID']);
    $product = $product[0];
    $coverImage = $product->field_banner_prod != "" ? $product->field_banner_prod : "";
}
if ($_GET['planID']) {
    $singlePara = $b->plans($_GET['planID']);
    $coverImage = $singlePara->field_cover_image;
}
if ($_GET['zoneID']) {
    $singleZone = $b->zones($_GET['zoneID']);
    $coverImage = $singleZone->field_cover_image;
}
?>
<script>
    var subproductsArray = <?php echo json_encode($b->allsubproducts()); ?>;
</script>
<main data-productid="<?= $_GET['productID'] ?>" id="mainPortal" data-planid="<?= $_GET['planID'] ?>" data-zoneid="<?= $_GET['zoneID'] ?>" data-productname="<?= $product->name ?>">
    <section class="banner" style="background-image:url(<?= $coverImage ? $urlGlobal . $coverImage : '/img/noimg.png' ?> );">
    <div class="container">
        <div class="intro-txt">
            <?php
            if ($_GET['productID']) {
                echo '<h2 class=""><img src="https://files.visitbogota.co'.$product->field_icono_claro.'" alt="nature" />' . $product->name . '</h2>';
            } else if ($_GET['zoneID']) {
                echo '<h3 class="">' . $b->generalInfo->field_titulo_bogota_por_zonas . '</h3>';
                echo '<h2 class=""><img  src="https://files.visitbogota.co'.$product->field_icono_claro.'" alt="nature"/>' . $singleZone->title . '</h2>';
            } else if ($_GET['planID']) {
                echo '<h3 class="">' . $singlePara->title . '</h3>';
                echo '<h2 class="">' . $b->generalInfo->field_dlaciudad . '</h2>';
            }
            ?>
            <?php
            if ($singleZone) {
            ?>
                <?= $singleZone->body ?>
            <?php
            } else {
            ?>
                <?= $product->field_intro_prod ?>
            <?php
            }
            ?>
        </div>
    </div>
    </section>
    <div class="portal-atractivos">
        <h3>Lugares que puedes visitar</h3>
        <?php if($_GET['productID'] == '216'){ ?>
            <video muted autoplay class="img-naturaleza">
  <source src="video/venado.mov" type="video/quicktime">
  <source src="video/venado.webm" type="video/webm">
  Tu navegador no soporta la reproducción de video.
</video>
 <?php } ?>
        <section class="grid-atractivos"></section>
    </div>

    <div class="portal-rutas">
        <h3>Rutas turísticas de <?= $product->name ?></h3>
        <section class="grid-rutas"></section>
    </div>

    <div class="portal-eventos">
        <h3>Próximos eventos de <?= $product->name ?></h3>
        <section class="grid-eventos"></section>

    </div>

    <div class="portal-experiencias">
        <h3>Experiencias de <?= $product->name ?> que pueden interesarte</h3>
        <section class="grid-experiencias"></section>
    </div>

    <section class="blog container">
    <h3><?=$lang == 'es' ? "Artículos que podrían interesarte": "Articles that might interest you"?></h3>

      <div class="container grid-blogs"></div>
    </section>


</main>
<?php include 'includes/imports.php'; ?>