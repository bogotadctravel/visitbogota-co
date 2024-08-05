
<?php
function getOperatingSystem() {
    $userAgent = $_SERVER['HTTP_USER_AGENT'];

    // Android
    if (preg_match('/android/i', $userAgent)) {
        return "Android";
    }

    // iOS
    if (preg_match('/ipad|iphone|ipod/i', $userAgent)) {
        return "iOS";
    }

    return "unknown";
}

function getBrowser() {
    $userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);

    if (strpos($userAgent, 'chrome') !== false && strpos($userAgent, 'safari') !== false) {
        return "Chrome";
    } elseif (strpos($userAgent, 'safari') !== false && strpos($userAgent, 'chrome') === false) {
        return "Safari";
    }

    return "unknown";
}
$os = getOperatingSystem();
$browser = getBrowser();
$urlGlobal = 'https://files.visitbogota.co';

if(!isset($include_level)){
    $include_level = "";
}
if(!isset($project_base)){
    $project_base = "/";
}
include $include_level.'includes/config.php';
require_once 'mobile-detect.php';
$detect = new Mobile_Detect;
$isMobile = $detect->isMobile();
?>
<?php if (isset($_GET['clean'])) { ?>


    <!DOCTYPE html>
    <html lang="<?= $_GET['lang'] ? $_GET['lang'] : 'es' ?>">

    <head>
        <!-- SITIO WEB BOGOTA - idt bogotadc.travel -->
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        <meta name="theme-color" content="#35498e">
        <base href="<?=$project_base?>">
        <?= $b->create_metas($_GET['seo'],$_GET['seoType']) ?>
        <link rel="stylesheet" href="<?=$include_level?>css/style.css?v=<?=time();?>">
    </head>
    <script>
        var actualLang = "<?= isset($_GET['lang']) ? $_GET['lang'] : 'es' ?>";
        var messageError = "<?= $b->generalInfo->field_sub_txt ?>";
        var aforoMin = "<?= $b->MICEgeneralInfo->field_minaforo ?>";
        var aforoMax = "<?= $b->MICEgeneralInfo->field_maxaforo ?>";
      
    </script>
    <body class="<?= $bodyClass ?>" style="display:none;" data-os="<?=$os?>" data-browser="<?=$browser?>">
    <?php } else { ?>
        <!DOCTYPE html>
        <html lang="<?= $_GET['lang'] ? $_GET['lang'] : 'es' ?>">

        <head>
        <link rel="manifest" href="/manifest.webmanifest?v=<?=time();?>">
            <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
            <meta name="theme-color" content="#35498e">
            <meta name="google-site-verification" content="gmbhhlorLRNzSxm4RE99kBoX0x-W_gMvjxqRGWTeLS0" />
            <base href="<?=$project_base?>">
            <?= $b->create_metas($_GET['seo'],$_GET['seoType']) ?>
            <!-- STYLES -->
            <link rel="icon" href="<?=$include_level?>favicon.ico" type="image/x-icon">
            <link rel="stylesheet" href="<?=$include_level?>css/slick.min.css">
            <link rel="preload" href="<?=$include_level?>css/jquery.fancybox.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
            <link rel="stylesheet" href="<?=$include_level?>css/jquery.fancybox.min.css">
            <link rel="preload" href="<?=$include_level?>css/jquery.mCustomScrollbar.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
            <link rel="stylesheet" href="<?=$include_level?>css/jquery.mCustomScrollbar.min.css">
            <link rel="preload" href="<?=$include_level?>css/style.css?v=<?=time();?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
            <link rel="stylesheet" href="<?=$include_level?>css/style.css?v=<?=time();?>">
            <!-- Smartsupp Live Chat script
            <script type="text/javascript">
                var _smartsupp = _smartsupp || {};
                _smartsupp.key = 'b19a945a21df50ed6d8060bfd666c57560c2e12e';
                window.smartsupp || (function(d) {
                    var s, c, o = smartsupp = function() {
                        o._.push(arguments)
                    };
                    o._ = [];
                    s = d.getElementsByTagName('script')[0];
                    c = d.createElement('script');
                    c.type = 'text/javascript';
                    c.charset = 'utf-8';
                    c.async = true;
                    c.src = 'https://www.smartsuppchat.com/loader.js?';
                    s.parentNode.insertBefore(c, s);
                })(document);
            </script> -->
            <!-- Global site tag (gtag.js) - Google Analytics -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=UA172814268-1"></script>
            <script>
                window.dataLayer = window.dataLayer || [];

                function gtag() {
                    dataLayer.push(arguments);
                }
                gtag('js', new Date());

                gtag('config', 'UA172814268-1');
            </script>
            <!-- Smartsupp Live Chat script -->
            <script type="text/javascript">
            var _smartsupp = _smartsupp || {};
            _smartsupp.key = 'b19a945a21df50ed6d8060bfd666c57560c2e12e';
            window.smartsupp||(function(d) {
            var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
            s=d.getElementsByTagName('script')[0];c=d.createElement('script');
            c.type='text/javascript';c.charset='utf-8';c.async=true;
            c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
            })(document);
            </script>
            <noscript> Powered by <a href=“https://www.smartsupp.com” target=“_blank”>Smartsupp</a></noscript>
            <!-- Google Tag Manager -->
            <script>
                (function(w, d, s, l, i) {
                    w[l] = w[l] || [];
                    w[l].push({
                        'gtm.start': new Date().getTime(),
                        event: 'gtm.js'
                    });
                    var f = d.getElementsByTagName(s)[0],
                        j = d.createElement(s),
                        dl = l != 'dataLayer' ? '&l=' + l : '';
                    j.async = true;
                    j.src =
                        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                    f.parentNode.insertBefore(j, f);
                })(window, document, 'script', 'dataLayer', 'GTM-M7XH5JV');
            </script>
            <!-- End Google Tag Manager -->
            <!-- Facebook Pixel Code -->
            <script>
                ! function(f, b, e, v, n, t, s) {
                    if (f.fbq) return;
                    n = f.fbq = function() {
                        n.callMethod ?
                            n.callMethod.apply(n, arguments) : n.queue.push(arguments)
                    };
                    if (!f._fbq) f._fbq = n;
                    n.push = n;
                    n.loaded = !0;
                    n.version = '2.0';
                    n.queue = [];
                    t = b.createElement(e);
                    t.async = !0;
                    t.src = v;
                    s = b.getElementsByTagName(e)[0];
                    s.parentNode.insertBefore(t, s)
                }(window, document, 'script',
                    'https://connect.facebook.net/en_US/fbevents.js');
                fbq('init', '425688815109094');
                fbq('track', 'PageView');
            </script>
<!-- Accessibility Code for "visitbogota.co" -->
<script>
window.interdeal = {
    "sitekey": "d8d6acf1eb27744bac5c115295897570",
    "Position": "left",
    "Menulang": "ES",
    "domains": {
        "js": "https://cdn.equalweb.com/",
        "acc": "https://access.equalweb.com/"
    },
    "btnStyle": {
        "vPosition": [
            "50%",
            null
        ],
        "scale": [
            "0.8",
            null
        ],
        "color": {
            "main": "#35498e",
            "second": "#ffffff"
        },
        "icon": {
            "type": 7,
            "shape": "semicircle"
        }
    }
};
(function(doc, head, body){
    var coreCall             = doc.createElement('script');
    coreCall.src             = interdeal.domains.js + 'core/4.6.3/accessibility.js';
    coreCall.defer           = true;
    coreCall.integrity       = 'sha512-+5lbZsIsOqyfEswqMIHyOrR4jrrBUQ0aVv0KYYoZ6/jTkKsTIqAHwkHgFEoRDM3NbjZ0lOxR0qSslbA3NIXrfw==';
    coreCall.crossOrigin     = 'anonymous';
    coreCall.setAttribute('data-cfasync', true );
    body? body.appendChild(coreCall) : head.appendChild(coreCall);
})(document, document.head, document.body);
</script>
        <style>
            .campaign .container .message_campaign::before {
                content: '<?= $b->generalInfo->field_titulo_lo_ultimo ?>';
            }
        </style>
        </head>

        <body class="<?= $bodyClass ?>" style="display:none;" data-os="<?=$os?>" data-browser="<?=$browser?>">
        <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=425688815109094&ev=PageView&noscript=1" alt="facebook" />
            <!-- End Facebook Pixel Code -->
            <!-- Google Tag Manager (noscript) -->
            <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M7XH5JV" height="0" width="0" style="display:none;visibility:hidden"></iframe>
            <!-- End Google Tag Manager (noscript) -->
        <script>
            var actualLang = "<?= $_GET['lang'] ? $_GET['lang'] : 'es' ?>";
            var messageError = "<?= $b->generalInfo->field_sub_txt ?>";
            var aforoMax = parseInt("<?= $b->MICEgeneralInfo->field_maxaforo ?>");
            var aforoMin = parseInt("<?= $b->MICEgeneralInfo->field_minaforo ?>");
        </script>
        <script>
        if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => {
        navigator.serviceWorker.register('/service-worker.js')
        .then((registration) => {
            console.log('Service Worker registrado con éxito:', registration);
        })
        .catch((error) => {
            console.log('Error al registrar el Service Worker:', error);
        });
        });
        }
        </script>
            <?php if ($isMobile) { ?>
                <div class="searchMobile">
                    <form action="/<?= $lang ?>/buscador" id="search_form" class="search_form" autocomplete="off">
                        <label for="search">
                            <img src="<?=$include_level?>img/lupa.svg" alt="lupa" width="30" height="30">
                            <input type="search" name="search" id="search">
                        </label>
                    </form>
                </div>
            <?php } ?>
        <?php } ?>

        <script>
            let pi_bogota = <?=json_encode($pi_bogota)?>;
        </script>

        <style>
            :root{
                --linkcolor: <?=$b->generalInfo->field_coverdesktopweb == "" && $b->generalInfo->field_headercolor == "" ? "#fff":$b->generalInfo->field_headercolor?>
            }
        </style>