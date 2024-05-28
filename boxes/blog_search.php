<?php 
    include '../includes/config.php';
    $products = $b->products();
?>

<div class="boxes">
    <button type="button" id="closebox" data-fancybox-close><img src="img/close_search_box.svg" alt="close box"></button>
    <div class="boxes-container">
        <form action="" id="blogSearch">
            <span>
                <label for="category">Filtrar articulos por categoría</label>
                <div class="custom-select" style="width:100%;">
                    <select id="category">
                        <option value="-1">Todos</option>
                    <?php for ($i=0; $i < count($products); $i++) { ?>
                        <option value="<?=$products[$i]->nid?>"><?=$products[$i]->title?></option>
                    <?php } ?>
                    </select>
                </div>
            </span>
        </form>
    </div>
</div>