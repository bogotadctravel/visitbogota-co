<section class="searchMICE">
    <div class="container-btns">
        <button href="<?= $lang ?>/mice/bogota-ciudad" type="button" id="filterbtn3" class="btn uppercase <?= $active === 0 ? 'active' : ''?>">
            <?= $b->MICEgeneralInfo->field_mice_ui_11 ?>

            <div class="filter3">
                <ul>
                    <li>
                        <a class="wait" href="<?= $lang ?>/mice/bogota-ciudad">La ciudad</a>
                    </li>
                    <li><a class="wait" href="<?= $lang ?>/mice/movilidad-bogota"><?= $b->MICEgeneralInfo->field_mice_ui_13 ?></a></li>
                    <li><a class="wait" href="<?= $lang ?>/mice/bioseguridad-bogota">Bioseguridad</a></li>
                    <li><a class="wait" href="<?= $lang ?>/mice/aeropuerto-el-dorado"><?= $b->MICEgeneralInfo->field_mice_ui_12 ?></a></li>
                </ul>
            </div>
        </button>
        <button type="button" id="filterbtn1" class="btn uppercase <?= $active === 1 ? 'active' : ''?>">
            <?= $b->MICEgeneralInfo->field_mice_ui_1 ?>
        </button>
        <button type="button" id="filterbtn2" class="btn uppercase <?= $active === 2 ? 'active' : ''?>">
            <?= $b->MICEgeneralInfo->field_mice_ui_2 ?>
        </button>
    </div>
    <form class="filtersmice" id="filter1">
        <div>
            <div class="selects-container">
                <div class="select" data-options="tipoVenues">
                    <div>
                        <span>Tipo de <?=$b->MICEgeneralInfo->field_mice_ui_20?></span>
                        <small>Seleccionar</small>
                    </div>
                    <img src="img/arrow_list.svg" alt="arrow" />
                </div>
                <div class="select" data-options="formatos">
                    <div>
                        <span>Formato del evento </span>
                        <small>Seleccionar</small>
                    </div>
                    <img src="img/arrow_list.svg" alt="arrow" />
                </div>
                <div class="select" data-options="aforo">
                    <div>
                        <span>Tamaño de la reunión</span>
                        <small>Seleccionar</small>
                    </div>
                    <img src="img/arrow_list.svg" alt="arrow" />
                </div>
            </div>
            <div class="options formatos"></div>
            <div class="options tipoVenues"></div>
            <div class="options aforo">
                <span class="customCheck"><input type="radio" name="venuesAforo" id="venuesAforo-10" value="10,50"><label for="venuesAforo-0">10 a 50 participantes</label></span>
                <span class="customCheck"><input type="radio" name="venuesAforo" id="venuesAforo-50" value="50,149"><label for="venuesAforo-0">50 a 149 participantes </label></span>
                <span class="customCheck"><input type="radio" name="venuesAforo" id="venuesAforo-150" value="150,249"><label for="venuesAforo-0">150 a 249 participantes </label></span>
                <span class="customCheck"><input type="radio" name="venuesAforo" id="venuesAforo-250" value="250,499"><label for="venuesAforo-0">250 a 499 participantes</label></span>
                <span class="customCheck"><input type="radio" name="venuesAforo" id="venuesAforo-500" value="500,999"><label for="venuesAforo-0">500 a 999 participantes </label></span>
                <span class="customCheck"><input type="radio" name="venuesAforo" id="venuesAforo-1000" value="1000,1999"><label for="venuesAforo-0">1000 a 1999 participantes </label></span>
                <span class="customCheck"><input type="radio" name="venuesAforo" id="venuesAforo-2000" value="2000,2999"><label for="venuesAforo-0">2000 a 2999 participantes </label></span>
                <span class="customCheck"><input type="radio" name="venuesAforo" id="venuesAforo-3000" value="3000,5000"><label for="venuesAforo-0">3000 a 5000 participantes</label></span>
            </div>
            <button type="button" onclick="findVenues()" class="btn btn-submit uppercase" style="display: none">
                Buscar <?=$b->MICEgeneralInfo->field_mice_ui_20?>
            </button>
        </div>
    </form>
    <form class="filtersmice" id="filter2">
        <div>
            <div class="selects-container">
                <div class="select" data-options="tipoProveedor">
                    <div>
                        <span>Tipo de proveedor</span>
                        <small>Seleccionar</small>
                    </div>
                    <img src="img/arrow_list.svg" alt="arrow" />
                </div>
            </div>
            <div class="options tipoProveedor"></div>
            <button type="button" class="btn btn-submit uppercase" onclick="findProviders()">
                Buscar Proveedores
            </button>
        </div>
    </form>
</section>