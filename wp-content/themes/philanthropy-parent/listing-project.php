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

?>
<div class="col-md-6 col-sm-6 col-xs-12 clearfix">
    <!--Post 1-->
    <div class="post">
        <div class="inner">
            <div class="entry-aside">
                <header class="entry-header">
                    <h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php echo get_the_title();?></a> </h1>
                </header>
                <div class="divider"></div>
                <div class="entry-content">
                    <?php if ( tfuse_options('post_content') == 'content' ) the_content(''); else '<p>' . the_excerpt() .'</p>'; ?>
                </div>
            </div>
            <div class="post-thumbnail">
                <?php if(!empty($image)):?>
                    <a href="<?php the_permalink(); ?>" class="post-thumbnail-image"><span><?php _e('More','tfuse');?></span></a>
                    <img src="<?php echo TF_GET_IMAGE::get_src_link($image, 285, 326);?>" alt="<?php echo get_the_title();?>">
                <?php endif;?>
            </div>
        </div>
    </div>
</div>