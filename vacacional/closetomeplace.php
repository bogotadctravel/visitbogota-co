<?php
include 'includes/head.php';
$placeID = $_GET['placenearid'];
$place = $b->singlePlace($placeID);
$place = $place[0];
?>
<main id="closetomePlace" class="closetomePlace">
    <section class="title">
        <a href="<?= $_GET['lang'] ?>/cerca-de-mi" class="wait isabacklink"><img src="img/arrow_back.svg" alt="back page"></a>
        <h2><?= $place->title ?></h2>
    </section>
    <section class="placeinfo">
        <div class="closetomeplace-banner" style="background-image: url(<?= $place->field_cover_image ? $urlGlobal . $place->field_cover_image : 'img/noimg.png' ?>);">
        </div>
        <ul class="details">
            <?php if ($place->field_address) { ?>
                <li><img src="img/address.svg" alt="address"><span><?= $place->field_address ?></span></li>
            <?php } ?>
            <?php if ($place->field_phone) { ?>
                <li><img src="img/tel.svg" alt="tel"><span>Tel: <?= $place->field_phone ?></span></li>
            <?php } ?>
            <?php if ($place->field_email) { ?>
                <li><img src="img/email.svg" alt="email"><span><?= $place->field_email ?></span></li>
            <?php } ?>
        </ul>
    </section>
    <section class="apps_closetome">
        <div class="sliderPhone">
            <img loading="lazy" src="https://picsum.photos/20/20" data-src="img/qr_frame.svg" alt="phoneApp" class="qrImg lazyload">
            <img loading="lazy" src="https://picsum.photos/20/20" data-src="img/bogota_app.svg" alt="Bogota App" class="logoAppImg lazyload">
        </div>
        <div class="logoApp">
            <div class="find_app">
                <h3><?= $b->generalInfo->field_invitacion ?></h3>
                <div class="link_apps">
                    <a href="javascript:;"><img loading="lazy" class="lazyload" src="https://picsum.photos/20/20" data-src="img/playstore.svg" alt="playstore"></a>
                    <a href="javascript:;"><img loading="lazy" class="lazyload" src="https://picsum.photos/20/20" data-src="img/appstore.svg" alt="appstore"></a>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- SCRIPTS -->

<script src="js/jquery-1.12.4.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js" integrity="sha256-eTyxS0rkjpLEo16uXTS0uVCS4815lc40K2iVpWDvdSY=" crossorigin="anonymous"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/jquery.form.js"></script>
<script src="js/additional-methods.min.js"></script>
<script src="js/jquery.fancybox.min.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/iphone-inline-video.min.js"></script>
<!-- <script src="js/aos.js"></script> -->
<script src="js/jquery.mCustomScrollbar.js"></script>
<script src="js/custom_select.js"></script>
<script src="js/cookie.js"></script>
<script src="js/main.js?<?= $versionScripts ?>"></script>
<script>
    window.addEventListener(
    "contextmenu",
    function (e) {
      e.preventDefault();
    },
    false
  );
</script>
</body>

</html>