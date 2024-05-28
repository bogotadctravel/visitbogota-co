<?php include '../includes/config.php'; ?>
<div class="boxes">
    <button type="button" id="closebox" data-fancybox-close><img src="img/close_box.svg" alt="close box"></button>
    <div class="boxes-container">
        <h2 class="uppercase"><?= $b->generalInfo->field_sub_title ?></h2>
        <p>
            <?= $b->generalInfo->field_sub_msg ?>
        </p>
        <a href="javascript:;" class="btn boxBtn uppercase" data-fancybox-close>Cerrar / Aceptar</a>
    </div>
</div>