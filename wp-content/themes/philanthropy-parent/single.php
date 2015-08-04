<?php get_header(); global $post;?>
<?php $sidebar_position = tfuse_sidebar_position(); ?>
<?php  tfuse_shortcode_content('before'); ?>
<div id="main" class="site-main" role="main">
    <div class="container">
        <div class="row">
            
        <?php if ($sidebar_position == 'left') : ?>
            <div class="col-md-8 col-sm-12 content-area sidebar_left">
        <?php endif;?>
        <?php if ($sidebar_position == 'right') : ?>
            <div class="col-md-8 col-sm-12 content-area sidebar_right">
        <?php endif;?>
        <?php if ($sidebar_position == 'full') : ?>
            <div class="col-sm-12 col-xs-12 content-area">
        <?php endif; ?> 
                <div class="inner">
                    <article class="post post-details <?php echo tfuse_page_options('article_type');?>">
                            <?php  while ( have_posts() ) : the_post();?>
                                    <?php get_template_part('content','single');?>
                            <?php endwhile; // end of the loop. ?> 
                    </article>
                    <?php $tags = tfuse_tags_links($post->post_type,$post->ID); 
                        if (!empty($tags)):?>
                        <section class="wrapp-tagcloud">
                            <div class="tagcloud"><?php echo $tags;?></div>
                        </section>
                    <?php endif;?>
                    
                    <?php get_template_part('content','author'); ?>
                    
                    <section class="clearfix">
                        <?php if(tfuse_options('post_share')):?>
                            <div class="social-share-blog">
                                <div class="twitter"><a href="https://twitter.com/share?url=<?php echo get_permalink(); ?>" target="_blank"><i class="icon-twitter"></i><?php _e('Tweet','tfuse'); ?></a></div>
                                <div class="facebook-share-blog"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?>" target="_blank"><i class="tficon-like"></i><?php _e('Share','tfuse'); ?></a></div>
                                <div class="pinterest"><a href="http://www.pinterest.com/pin/create/button/?url=<?php echo get_permalink(); ?>" target="_blank"><i class="tficon-pinterest"></i><?php _e('Pin it','tfuse'); ?></a></div>
                            </div>
                        <?php endif;?>
                        <?php custom_wp_link_pages(); ?>
                    </section>
                    
                    <section class="blog-post-navigation clearfix">
                        <?php previous_post_link( '%link','<i class="tficon-chevron-left"></i><span>'.__('Previous Story','tfuse').'</span>%title' ); ?>
                        <?php next_post_link( '%link', '<i class="tficon-chevron-right"></i><span>'.__('Next Story','tfuse').'</span>%title' ); ?>
                    </section>
                    
                    <?php tfuse_show_similar_posts($post->ID,$post->post_type); ?>
                    
                    <?php if ( comments_open() ) : ?>
                        <?php  tfuse_comments(); ?>
                     <?php endif; ?>
                </div>
            </div>
            <?php if (($sidebar_position == 'right') || ($sidebar_position == 'left')) : ?>
                <div class="col-md-4 col-sm-12 sidebar widget-area">
                    <div class="inner">
                        <?php get_sidebar();?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php tfuse_shortcode_content('after'); ?>
<?php get_footer();