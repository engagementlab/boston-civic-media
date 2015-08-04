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

$art_type = tfuse_page_options('article_type');

if(!empty($image))
{
    if($art_type == 'post-style-4' || $art_type == 'post-style-3') $image = TF_GET_IMAGE::get_src_link($image, 270, 380);
    elseif ($art_type == 'post-style-1' || $art_type == 'post-style-2') $image = TF_GET_IMAGE::get_src_link($image, 269, 267);
}
?>
<article class="post <?php echo $art_type;?>">
    <div class="entry-aside">
        <header class="entry-header">
            
            <?php if($art_type != 'post-style-7'):?>
                <?php if(!empty($image)):?>
                    <div class="post-thumbnail">
                        <a href="<?php the_permalink(); ?>" class="post-thumbnail-image">
                            <span><?php _e('More','tfuse');?></span>
                        </a>
                        <img src="<?php echo $image;?>" alt="">
                    </div>
                <?php endif;?>
            <?php endif;?>
            
            <div class="entry-meta">
                <time class="entry-date" datetime=""><?php echo get_the_date(); ?></time>
                <span class="author"> <?php _e('by','tfuse');?> <?php the_author_posts_link() ?></span>
                <?php if($post->post_type != 'page'):?>
                    <span class="cat-links"> <?php _e('in','tfuse');?> <?php echo tfuse_cat_links($post->post_type,$post->ID);?></span>
                <?php endif;?>
                <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php echo get_the_title();?></a></h2>
                <?php if($art_type == 'post-style-7'):?>
                    <?php if(!empty($image)):?>
                        <div class="post-thumbnail">
                            <a href="<?php the_permalink(); ?>" class="post-thumbnail-image">
                                <span><?php _e('More','tfuse');?></span>
                            </a>
                            <img src="<?php echo $image;?>" alt="">
                        </div>
                    <?php endif;?>
                <?php endif;?>
            </div>
        </header>
        <div class="entry-content">
            <?php if ( tfuse_options('post_content') == 'content' ) the_content(''); else the_excerpt(); ?>
        </div>
        <footer class="entry-meta clearfix">
            <a href="<?php the_permalink(); ?>" class="btn btn-yellow btn-read-more"><span><?php _e('Read More','tfuse');?></span></a>
            <a href="<?php the_permalink(); ?>#comments" class="btn btn-transparent link-comment"><span><?php echo tfuse_get_comments(TRUE,$post->ID); ?></span></a>
        </footer>
    </div>
</article>
