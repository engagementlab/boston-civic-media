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

?>
<header class="entry-header">
    <h1 class="entry-title"><?php echo get_the_title();?></h1>
</header><?php if(!empty($gallery)):?>
    <div class="slider-foto-video">
        <div style="display:none;" class="slider-html5gallery" data-skin="light">
            <?php foreach ($gallery as $img):?>
                <a href="<?php echo TF_GET_IMAGE::get_src_link($img['url'], 715, 498);?>"><img src="<?php echo TF_GET_IMAGE::get_src_link($img['url'], 715, 498);?>"></a>
            <?php endforeach;?>
        </div>
    </div>
 <?php endif;?>
 <div class="entry-content">
    <?php the_content();?> 
    <div class="divider project-details"></div>
</div>