<div class="filterVenuesMobile">
    <div class="content active">
        <section>
            <h3 class="uppercase">Tipo de <?=$b->MICEgeneralInfo->field_mice_ui_20?></h3>
            <ul class="filters_typevenue"></ul>
        </section>
        <section>
            <h3 class="uppercase">Formatos del evento</h3>
            <ul class="filters_format"></ul>
        </section>
        <section>
            <div class="slide-filter">
                <small><?= $b->MICEgeneralInfo->field_mice_ui_5 ?></small>
                <input type="range" onchange="changeFilterVenues()" min="<?= $b->MICEgeneralInfo->field_minaforo ?>" max="<?= $b->MICEgeneralInfo->field_maxaforo ?>" value="<?= $_GET['aforo'] ? explode(',', $_GET['aforo'])[0] : $b->MICEgeneralInfo->field_minaforo ?>" class="slide" id="myRange" />
                <div class="values">
                    <small><?= $_GET['aforo'] ? explode(',', $_GET['aforo'])[0] : $b->MICEgeneralInfo->field_minaforo ?></small>
                    <small><?= $b->MICEgeneralInfo->field_maxaforo ?></small>
                </div>
            </div>
            <button type="button">Aplicar</button>
        </section>
    </div>
    <span class="title">Filtrar<img src="img/mice_filter.svg" alt="mice_filter"></span>
</div>