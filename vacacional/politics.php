<?php 
    $bodyClass = 'politics';
    include 'includes/head.php';
    $politicas = $b->query("gcontent/1")[0];
    $body = explode("<hr />", $politicas->body);
    function fnextractHeadins($headingtag, $html) {
        $headingText = '';
        preg_match_all( '|<'.$headingtag.'>(.*)</'.$headingtag.'>|iU', $html, $headings );
        foreach($headings[0] as $headh2val)
        {
            $headingText.=$headh2val;
        }
        return $headingText;
    }

?>
<main>
    <div class="container">
        <?php if($isMobile){ ?>
            <div class="fixed_filter" id="openFiltersBlog" onclick="upFilterBlog()">
                <span class="uppercase">Todos</span>
                <img src="../img/arrow_up_w.svg" alt="filter_blog">
                <div class="categories">
                    <a href="#introduccion">Introducción </a>
                </div>
            </div>
        <?php }else{ ?>
            <ol class="sections_list">
            <?php 
                for ($i=0; $i < count($body); $i++) {
                    $h1 = fnextractHeadins('h1', $body[$i]);
                    $h2 = fnextractHeadins('h2', $body[$i]);
                    $newS = substr($allTxt, 7);
                    if($h1){
                        echo "<li><a href='#section-$i'>$h1<img src='../img/arrow_politics.svg' alt='ver'></a></li>";
                    }
                    else if($h2){
                        echo "<li><a href='#section-$i'>$h2<img src='../img/arrow_politics.svg' alt='ver'></a></li>";
                    }
                    else if($h3){
                        echo "<li><a href='#section-$i'>$h3<img src='../img/arrow_politics.svg' alt='ver'></a></li>";
                    }
                    else if($h4){
                        echo "<li><a href='#section-$i'>$h4<img src='../img/arrow_politics.svg' alt='ver'></a></li>";
                    }
                    else if($h5){
                        echo "<li><a href='#section-$i'>$h5<img src='../img/arrow_politics.svg' alt='ver'></a></li>";
                    }
                    else if($h6){
                        echo "<li><a href='#section-$i'>$h6<img src='../img/arrow_politics.svg' alt='ver'></a></li>";
                    }
                }
            ?>
            </ol>
        <?php } ?>
        <div class="content">
            <h1><?=$politicas->title?></h1>
            <?php for ($i=0; $i < count($body); $i++) { ?>
                <div id="section-<?=$i?>">
                    <?=$body[$i]?>
                </div>
            <?php } ?>
        </div>
    </div>
</main>
<?php include 'includes/imports.php'; ?>