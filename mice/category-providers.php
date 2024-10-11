<?php 
include "includes/head.php";
include "includes/header.php";
 ?>

<div id="mobile"></div>
<div id="disabler"></div>
<div class="card-list providers graybg font1" data-type="providers">
    <h1 class="fw900 uppercase center title"><?=$mice->miceinfo->field_mice_ui_18?></h1>
    <div class="column flex w_100">
        <aside class="column w_25 filters graybg m_outter">
                <button class="fw500" id="resetfilters"><?=$mice->miceinfo->field_mice_ui_34?></button>
                <h2 class="fw700"><?=$mice->miceinfo->field_mice_ui_35?></h2>
                

                <div class="filtergroup checkboxes open" data-filterid="provider_type">
                    
                    <h3 class="fw700"><span class="arrow"></span>Tipo de proveedor</h3>
                    <div class="loader"></div>
                    <div class="content">
                    </div>
                </div>

                <div class="filtergroup checkboxes color open" data-filterid="certificaciones_proveedores">
                    
                    <h4 class="fw700"><span class="arrow"></span>Certificaciones</h4>
                    <div class="loader"></div>
                    <div class="content">
                    </div>
                </div>

        </aside>
        <section class="w_75 cards flex loading m_outter">
            <div class="loader big"></div>
            <div class="content flex"></div>

        </section>
    </div>
    <?php if($isMobile){ ?>
        <button class="mobilefilterbutton uppercase fw700">FILTRAR RESULTADOS</button>
    <?php } ?>
            </div>


<? include 'includes/footer.php'?>
