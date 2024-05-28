<?php include 'includes/head.php';
$banners = $b->generalInfo->field_field_banners;
$arrayBanners = explode(",", $banners);
$bannerHome = str_replace(' ', '', $arrayBanners[0]);
?>
<main id="closetome" class="closetome">
    <div class="closetome-banner">
        <div class="closetome-banner__content">
            <img src="img/logo.svg" alt="logo">
            <span class="divider"></span>
            <div class="closetome-banner__text">
                <h3>Explora</h3>
                <h2>tu área</h2>
            </div>
        </div>
    </div>
    <div class="places">
        <div class="place-item">
            <img src="https://images.unsplash.com/photo-1568632234180-0e6c08735d01?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1350&q=80" alt="placeImg">
        </div>
        <div class="place-item">
            <img src="https://images.unsplash.com/photo-1568632234168-5d77a6ff2396?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=634&q=80" alt="placeImg">
        </div>
        <div class="place-item">
            <img src="https://images.unsplash.com/photo-1604251887561-518fb1d26d1d?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1353&q=80" alt="placeImg">
        </div>
        <div class="place-item">
            <img src="https://images.unsplash.com/photo-1619732112649-6a871321df61?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=634&q=80" alt="placeImg">
        </div>
    </div>
    <section class="apps_closetome">
        <div class="sliderPhone">
            <img loading="lazy" src="https://picsum.photos/20/20" data-src="img/qr_frame.png" alt="phoneApp" class="qrImg lazyload">
            <img loading="lazy" src="https://picsum.photos/20/20" data-src="img/bogota_app.svg" alt="Bogota App" class="logoAppImg lazyload">
        </div>
        <div class="logoApp">
            <div class="find_app">
                <h3><?= $b->generalInfo->field_invitacion ?></h3>
                <div class="link_apps">
                    <div><img loading="lazy" class="lazyload" src="https://picsum.photos/20/20" data-src="img/playstore.svg" alt="playstore"></div>
                    <div><img loading="lazy" class="lazyload" src="https://picsum.photos/20/20" data-src="img/appstore.svg" alt="appstore"></div>
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