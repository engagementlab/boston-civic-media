<?php 
/*
Template Name: Page Full
*/

global $is_tf_blog_page,$post;
$id_post = $post->ID; 
if(tfuse_options('blog_page') != 0 && $id_post == tfuse_options('blog_page')) $is_tf_blog_page = true;
get_header();
if ($is_tf_blog_page) die(); 
?>
<?php tfuse_shortcode_content('before');?>

<?php $desc = tfuse_page_options('short_desc');?>

<div id="main" class="site-main" role="main">
    <?php if(!tfuse_page_options('hide_title')):?>
    <div class="container">
        <div class="row">
            <!--Content Area-->
            <div class="col-sm-12 col-xs-12 content-area">
                <div class="inner">
                    <article class="post-involved">
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
                    </article>
                </div>
            </div>
        </div>
    </div>
    <?php endif;?>

    <?php  while ( have_posts() ) : the_post();?>
        <?php the_content(); ?>
    <?php break; endwhile; // end of the loop. ?>
    <?php if ( comments_open() ) : ?>
        <?php tfuse_comments(); ?>
    <?php endif;?>
</div>
<?php tfuse_shortcode_content('after'); ?>
<?php get_footer();