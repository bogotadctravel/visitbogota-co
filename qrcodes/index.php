<?php 
    include "../includes/config.php";
    $ficha = $b->getfichas_turisticas($_GET['id']);
    var_dump();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$ficha[0]->title?></title>
</head>
<body>
    <h1><?=$ficha[0]->title?></h1>
</body>
</html>