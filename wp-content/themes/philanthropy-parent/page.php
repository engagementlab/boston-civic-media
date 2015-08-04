<?php 
global $is_tf_blog_page;
get_header();
if ($is_tf_blog_page) die(); 
?>
<?php $sidebar_position = tfuse_sidebar_position(); ?>
<?php tfuse_shortcode_content('before');?>

<?php $desc = tfuse_page_options('short_desc');?>

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
                    <article>
                        <?php if(!tfuse_page_options('hide_title')):?>
                           <header class="entry-header">
                                <h1 class="entry-title"><?php echo get_the_title();?>
                                    <?php if(!empty($desc)):?>
                                        <p class="entry-title-min-description"><?php echo $desc;?></p>
                                    <?php endif;?>
                                </h1>
                                    
                                <?php if(tfuse_page_options('join_enable')):?>
                                    <a href="<?php echo tfuse_options('join_link');?>" class="btn btn-transparent btn-join-us"><span><?php _e('Join Us','tfuse');?></span></a>
                                <?php endif;?>
                            </header>
                        <?php endif;?>

                            <div class="entry-content">
                                <?php  while ( have_posts() ) : the_post();?>
                                    <?php the_content(); ?>
                                <?php break; endwhile; // end of the loop. ?>
                            </div>
                    </article>
                    <?php if ( comments_open() ) : ?>
                        <?php tfuse_comments(); ?>
                    <?php endif;?>
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