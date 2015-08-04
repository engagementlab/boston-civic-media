 <?php
/**
 * The template for displaying content in the single.php template.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since Philanthropy 1.0
 */
$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'post-thumbnails'));

$gallery = tfuse_page_options('gallery');

$date_post = tfuse_page_options('event_date');
if( isset($_GET['date']) && $_GET['date']!='' ) {
    $date_post = $_GET['date'];
}
$date = new DateTime($date_post);
$year = $date->format('Y');
$month = $date->format('F jS');

$get_start_hour  = tfuse_page_options('event_hour_min');
$get_end_hour  = tfuse_page_options('end_hour_min');
?>
<header class="entry-header">
    <h1 class="entry-title">
        <?php echo get_the_title();?>
        <span class="entry-title-min-description">
            <p>
                <?php 
                    _e('Event on','tfuse');?>: <?php echo $year .'-'.$month;
                    echo '  '.$get_start_hour['hour'],':',$get_start_hour['minute'],' ',$get_start_hour['time'],' - ' ;
                    echo '  '.$get_end_hour['hour'],':',$get_end_hour['minute'],' ',$get_end_hour['time'] ;
                ?> 
            </p>
        </span>
    </h1>
    
</header>
<div class="slider-foto-video">
    <div style="display:none;" class="slider-html5gallery" data-skin="light">
        <?php if(!empty($image)):?>
            <a href="<?php echo TF_GET_IMAGE::get_src_link($image, 715, 498);?>" title="<?php echo get_the_title();?>"><img src="<?php echo TF_GET_IMAGE::get_src_link($image, 715, 498);?>" alt="<?php echo get_the_title();?>"></a>
        <?php endif;?>
        <?php if(!empty($gallery)):?>
                <?php foreach ($gallery as $img):?>
                    <a href="<?php echo TF_GET_IMAGE::get_src_link($img['url'], 715, 498);?>" title="<?php echo get_the_title();?>"><img src="<?php echo TF_GET_IMAGE::get_src_link($img['url'], 715, 498);?>" alt="<?php echo get_the_title();?>"></a>
                <?php endforeach;?>
        <?php endif;?>        
    </div>
</div>
<div class="entry-content">
    <?php the_content();?> 
    <div class="divider project-details"></div>
</div>