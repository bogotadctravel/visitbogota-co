<?php
$dir = "/home/bogotas/public_html/cache";
$dir2 = "/home/bogotas/public_html/dev2024/cache";
$log  = "Caché eliminado ".date("F j, Y, g:i a").PHP_EOL.
        "-------------------------".PHP_EOL;
file_put_contents('refresh.log', $log, FILE_APPEND);
deleteDirectory($dir);
deleteDirectory($dir2);
function deleteDirectory($dir) {
    if (!file_exists($dir)) {
        return true;
    }

    if (!is_dir($dir)) {
        return unlink($dir);
    }

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }

    }

    return rmdir($dir);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaciar caches</title>
</head>

<body>
    <h2>La cache ha sido eliminada correctamente</h2>
    <a href="https://files.visitbogota.co/drpl/es/admin/content">Volver al administrador</a>
</body>

</html>