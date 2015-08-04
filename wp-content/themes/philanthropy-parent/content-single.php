 <?php
/**
 * The template for displaying content in the single.php template.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since Philanthropy  1.0
 */
 
$width = '';

$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'post-thumbnails'));

$art_type = tfuse_page_options('article_type');
$desc = tfuse_page_options('post_desc');

if(!empty($image))
{
    if($art_type == 'post-style-4' || $art_type == 'post-style-3') 
    {
        $image = TF_GET_IMAGE::get_src_link($image, 270, 380);
        $width = 'style="width:270px"';
    }
    elseif ($art_type == 'post-style-1' || $art_type == 'post-style-2') 
    {
        $image = TF_GET_IMAGE::get_src_link($image, 269, 267);
        $width = 'style="width:269px"';
    }
        
}
?>
<header class="entry-header">
    <h1 class="entry-title"><?php echo get_the_title();?></h1>
    <div class="entry-meta">
        <time class="entry-date" datetime="<?php echo get_the_date(); ?>"><?php echo get_the_date(); ?></time>
        <span class="author"> <?php _e('by','tfuse');?> <a href="#"><?php the_author_posts_link() ?></a></span>
        <span class="cat-links"> <?php _e('in ','tfuse');?><?php echo tfuse_cat_links($post->post_type,$post->ID);?></span>
        <?php if(!empty($desc)):?>
            <div class="entry-desc">
                <h4 class="min-descriptions"><?php echo $desc;?></h4>
            </div>
        <?php endif;?>
    </div>
</header>
<?php if(!empty($image)):?>
    <div class="post-thumbnail">
        <img src="<?php echo $image;?>" <?php echo $width;?>>
        <span <?php echo $width;?>><?php echo get_the_title();?></span>
    </div>
<?php endif;?>
        
<div class="entry-content">
    <?php the_content(); ?> 
</div>