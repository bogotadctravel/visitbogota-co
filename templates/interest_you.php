<article class="interest_you">
    <h2><?=$b->generalInfo->field_titulo_tambien_interesar?></h2>
    <?php if(!$isMobile){ ?>
        <ul></ul>
    <?php }else{ ?>
        <div id="slider_interest_you">
            <?php for ($i=0; $i < count($othersProducts); $i++) { ?>
            <a href="<?=$lang?>/explora/<?=$b->get_alias($othersProducts[$i]->title)?>/<?=$othersProducts[$i]->nid?>" class="slider_interest_you_item">
                <img loading=""lazy src="https://picsum.photos/20/20" data-src="<?=$urlGlobal?><?=$othersProducts[$i]->field_cover_image ? $othersProducts[$i]->field_cover_image: 'img/noimg.png' ?>" alt="<?=$othersProducts[$i]->title?>" class="lazyload">
                <h3><?=$othersProducts[$i]->title?></h3>
            </a>
            <?php } ?>
        </div>
    <?php } ?>
</article>