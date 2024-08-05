<?php 
    $bodyClass = 'campaign_body';
    include 'includes/head.php';
    $campaign = $b->singleCampaign($_GET['campaignID']);
    $campaign = $campaign[0];
?>
<main style="background-image: url(<?=$campaign->field_image ? $campaign->field_image:'img/noimg.png' ?>);">
    <div class="container">
        <!-- <img src="img/logo_campaign.svg" alt="campaña 1" id="logoCampaign"> -->
        <h1><?=$campaign->title?></h1>
        <h2 class=""><?=$campaign->field_subtitle?></h2>
        <section>
        <?php
            if($campaign->field_video){
        ?>
            <div class="video">
            <?php
                $video = $b->getMedia($campaign->field_video);
            ?>
                <video autoplay muted playsinline loop preload="yes" poster="<?=$campaign->field_image?>" class="videoBanner">
                    <source src="<?=$video->field_media_video_file?>" type="video/mp4">
                </video>
            </div>
        <?php } ?>
            <div class="desc">
               <?=$campaign->body?>
            </div>
            <?php 
                $gallery = $campaign->field_multi_galery;
                if($gallery != ''){
                $idsMedia = explode(', ', $gallery);
            ?>
            <ul class="campaign_gallery" id="campaign_slider">
            <?php 
            for ($gal=0; $gal < count($idsMedia); $gal++) {
                $media = $b->getMedia($idsMedia[$gal]);
                if($media->field_media_image){
                    echo "<li><a href='".$media->field_media_image."' data-fancybox='gallery'><img loading='lazy' data-src='".($media->field_media_image ? $media->field_media_image:'img/noimg.png')."' alt='".$campaign->title."' class='zone_img lazyload' src='https://picsum.photos/20/20'></a></li>";
                }
                if($media->field_media_video_file){
                    echo "<li><a data-fancybox href='".($media->field_media_video_file ? $media->field_media_video_file:'img/noimg.png')."' class ='video'><img loading='lazy' data-src='' alt='bogota' class='zone_img lazyload' src='https://picsum.photos/20/20'></a></li>";
                }
            }
            ?>
            </ul>
            <?php } ?>
        </section>
    </div>
</main>

<?php include 'includes/imports.php'; ?>