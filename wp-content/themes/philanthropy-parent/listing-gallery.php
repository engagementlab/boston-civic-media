<?php
/**
 * The template for displaying posts on archive pages.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since Philanthropy 1.0
 */
 global $more,$post;
    $more = apply_filters('tfuse_more_tag',0);
    
$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'post-thumbnails'));

$gallery = tfuse_page_options('gallery');
?>
<li class="gallery-item">
    <?php if(!empty($image)):?>
        <div class="gallery-img">
            <a href="<?php echo $image;?>" class="see-more-gallery" data-rel="prettyPhoto[<?php echo $post->ID?>]" title="<?php echo get_the_title();?>">
                <span><?php _e('More','tfuse');?></span>
            </a>
            <img src="<?php echo TF_GET_IMAGE::get_src_link($image, 270, 270);?>" alt="">
        </div>
        <?php if(!empty($gallery)):?>
            <div class="gallery-array">
                <?php foreach ($gallery as $img):?>
                <a href="<?php echo $img['url'];?>"  data-rel="prettyPhoto[<?php echo $post->ID?>]" title="<?php echo $img['title'];?>"> </a>
                <?php endforeach;?>
            </div>
        <?php endif;?>
    <?php endif;?>
    <span class="title"><a href="<?php the_permalink(); ?>"><?php echo get_the_title();?></a></span>
</li>