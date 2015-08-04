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
                    <article class="projects-detail">
                            <?php  while ( have_posts() ) : the_post();?>
                                    <?php get_template_part('content','single-project');?>
                            <?php endwhile; // end of the loop. ?> 
                    </article>
                                        
                    <section class="projects-details-navigation clearfix">
                        <span class="prev_pag"><?php previous_post_link( '%link','<i class="icon-chevron-left"></i><span>'.__('Previous Project','tfuse').'</span>' ); ?></span>
                        <span class="next_pag"><?php next_post_link( '%link', '<span>'.__('Next Project','tfuse').'</span><i class="icon-chevron-right"></i>' ); ?></span>
                    </section>
                    
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