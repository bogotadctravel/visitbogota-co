<div class="bluemenu">
    <ul>
        <li><a href="<?= $lang ?>/mice/bioseguridad-bogota" class="<?php if ($_GET['activelink'] == '3') {
                                                                        echo 'active';
                                                                    }  ?>">Bioseguridad</a></li>
        <li><a href="<?= $lang ?>/mice/movilidad-bogota" class="<?php if ($_GET['activelink'] == '4') {
                                                                    echo 'active';
                                                                }  ?>">Movilidad</a></li>
        <li><a href="<?= $lang ?>/mice/aeropuerto-el-dorado" class="<?php if ($_GET['activelink'] == '2') {
                                                                        echo 'active';
                                                                    }  ?>">Aeropuerto</a></li>
        <li><a href="<?= $lang ?>/mice/bogota-ciudad" class="<?php if ($_GET['activelink'] == '1') {
                                                                    echo 'active';
                                                                }  ?>">La ciudad</a></li>
    </ul>
    <span class="activelink">
        <?php switch ($_GET['activelink']) {
            case '5':
                echo 'Casos de éxito';
                break;
            case '3':
                echo 'Bioseguridad';
                break;
            case '4':
                echo 'Movilidad';
                break;
            case '2':
                echo 'Aeropuerto';
                break;
            case '1':
                echo 'La ciudad';
                break;
        } ?>

        <img src="img/blumenu_arrow.svg" alt="arrow"></span>
</div>