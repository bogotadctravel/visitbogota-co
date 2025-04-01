<?php
if (isset($_GET['page'])) {
    $pages = [
        1 => "https://maps.app.goo.gl/ZqoEKjZR4dXu1dUq5",
        2 => "https://maps.app.goo.gl/7tipE3pxt8F4h1zc6?g_st=ic",
        3 => "https://maps.app.goo.gl/AuhcdmEB57hfmYDaA?g_st=ic",
        4 => "https://visitbogota.co/es/ruta-leyenda-el-dorado/ruta/universo-muisca--845",
        5 => "https://visitbogota.co/es/ruta-leyenda-el-dorado/ruta/entre-agua-y-dioses--844",
        6 => "https://visitbogota.co/es/ruta-leyenda-el-dorado/ruta/inmersion-muisca-841",
        7 => "https://visitbogota.co/es/ruta-leyenda-el-dorado/ruta/oro-blanco--agua-verde-842",
        8 => "https://visitbogota.co/es/ruta-leyenda-el-dorado/ruta/conexion-entre-dos-mundos-824",
        9 => "https://visitbogota.co/es/ruta-leyenda-el-dorado/ruta/ancestros-de-sugamuxi--843",
        10 => "https://maps.app.goo.gl/pHibcb7eGYcYQdBH8?g_st=iw",
        11 => "https://maps.app.goo.gl/i6QKGNRdMzrfUYo69?g_st=iw",
        12 => "https://maps.app.goo.gl/24XAkaiN4LdEkqfV6",
        13 => "https://linktr.ee/acueductodebogota",
        14 => "https://maps.app.goo.gl/EnzRBJbBSuGW4g7c9",
        15 => "https://linktr.ee/acueductodebogota",
        16 => "https://maps.app.goo.gl/BTczrWFdnKthHYfA7",
        17 => "https://linktr.ee/acueductodebogota",
        18 => "https://maps.app.goo.gl/BauPg5uMdb8WBqtW7",
        19 => "https://maps.app.goo.gl/aQVnqu6zcUi6nmcX8",
        20 => "https://maps.app.goo.gl/mXyB4F1xMSwYGLoo7",
        21 => "https://maps.app.goo.gl/SL5Mk6VPc8gyP9CEA",
        22 => "https://maps.app.goo.gl/QJk4zFNGNzME98cd8",
        23 => "https://maps.app.goo.gl/UQg2t2WV8yeb8o8q6",
        24 => "https://maps.app.goo.gl/3LDYTWyN4tUADAQw5",
        25 => "https://goo.gl/maps/FfRPTRoXKegfetav5?g_st=aw",
        26 => "https://goo.gl/maps/npt7kx87HvNAyLtU8?g_st=aw",
        27 => "https://goo.gl/maps/g3ugwU4JKh68N613A?g_st=aw",
        28 => "https://goo.gl/maps/Ubt8wd5urSi3LiLd8?g_st=aw",
        29 => "https://goo.gl/maps/EwdT2P5qGxs4RBxJ9",
        30 => "https://maps.app.goo.gl/zR9rhBHPZDTRyWTr7",
        31 => "https://goo.gl/maps/VXPW3z8DFLtWiZCH9?g_st=aw",
        32 => "https://goo.gl/maps/hm2fZFp9q3sJdXNz8?g_st=aw",
        33 => "https://goo.gl/maps/ckrh9iDFy4Z3dhy48?g_st=aw",
        34 => "https://goo.gl/maps/jDvbZDkfysussGQd7?g_st=aw",
        35 => "https://goo.gl/maps/ns5zuT2wUXkjXCch9?g_st=aw",
        36 => "https://maps.app.goo.gl/CbuYdzAmy3SvZLdSA",
        37 => "https://maps.app.goo.gl/BHqhyrwvuQUdYYyK6",
        38 => "https://regioncentralrape.gov.co/bicibogota-region/",
        39 => "https://es.wikiloc.com/rutas-gravel-bike/rocas-del-origen-ruta-biciregion-88409203",
        40 => "https://es.wikiloc.com/rutas-cicloturismo/segmento-6-sendero-del-frailejon-81505392",
        41 => "https://maps.app.goo.gl/jjYDDShTAvtnTcwy6",
        42 => "https://www.strava.com/routes/3125276065722538428"
    ];

    $page = (int)$_GET['page'];

    if (isset($pages[$page])) {
        header("Location: " . $pages[$page]);
        exit;
    } else {
        echo "Invalid page number.";
    }
} else {
    echo "No page specified.";
}
?>
