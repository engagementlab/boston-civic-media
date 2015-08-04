<?php get_header(); global $TFUSE;  ?>

<?php get_header(); ?>

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
                <h1 class="entry-title blog">
                    <?php _e('Search Page','tfuse');?>
                </h1>
                <div id="content_load">
                    <?php if (have_posts()) 
                     { $count = 0;
                         while (have_posts()) : the_post(); $count++;
                             get_template_part('listing', 'search');
                         endwhile;
                     } 
                     else 
                     { ?>
                         <h5><?php _e('Sorry, no posts matched your criteria.', 'tfuse'); ?></h5>
               <?php } ?>
                </div>
                <?php  tfuse_pagination(); ?>
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
<?php  tfuse_shortcode_content('after'); ?>
<?php get_footer();