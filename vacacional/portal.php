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

    <section class="grid-atractivos">
    </section>
    <section class="descubre container">
      <h2><img src="images/descubre_bogotaic.svg" alt="descubre"><?=$descubre_bogota?></h2>
      <section class="splide" id="bogota-natural" aria-label="Basic Structure Example">
        <div class="splide__arrows">
          <button class="splide__arrow splide__arrow--prev">
            <img src="images/ep_arrow-left-bold.svg" alt="left">
          </button>
          <button class="splide__arrow splide__arrow--next">
            <img src="images/ep_arrow-right-bold.svg" alt="right">
          </button>
        </div>
        <div class="splide__track">
          <ul class="splide__list">
          </ul>
        </div>
      </section>
    </section>
    <section class="blog container">
      <h3><?=$lang == 'es' ? "Artículos que podrían interesarte": "Articles that might interest you"?></h3>
      <div class="container grid-blogs"></div>
    </section>


</main>
<?php include 'includes/imports.php'; ?>