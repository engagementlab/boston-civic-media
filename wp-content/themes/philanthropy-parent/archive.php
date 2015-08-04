<?php get_header(); ?>
<?php $cat_id = get_query_var('cat'); $title = tfuse_options('category_title','',$cat_id); ?>

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
                <h1 class="entry-title blog"><?php echo (!empty($title)) ? $title : ''; single_cat_title('',false); ?>
                    <span class="entry-title-min-description"><?php echo category_description(); ?></span>
                </h1>
                <div id="content_load">
                    <?php if (have_posts()) 
                     { $count = 0;
                         while (have_posts()) : the_post(); $count++;
                             get_template_part('listing', 'blog');
                         endwhile;
                     } 
                     else 
                     { ?>
                         <h5><?php _e('Sorry, no posts matched your criteria.', 'tfuse'); ?></h5>
               <?php } ?>
                </div>
                <?php if(tfuse_options('pagination_type') == 'type2'):?>
                    <div class="row text-center blog">
                        <a href="#" class="btn btn-transparent btn-padding-big" id="ajax_load_posts"><span><?php _e('Load more','tfuse');?></span></a>
                    </div>
                <?php endif;?>
                <?php tfuse_show_numb_pagination(); ?>
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
<?php  $id = tfuse_get_cat_id();?>
<input type="hidden" value="<?php echo $id; ?>" name="current_cat"  />
<input type="hidden" value="category" name="is_this_tax"  />
<?php get_footer();

