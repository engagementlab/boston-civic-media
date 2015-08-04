<?php
/**
 * The template for displaying content in the single.php template.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since  Gameszone 1.0
 */
?>

<?php
    /**
     * tfuse_user_profile() function is located in theme_config/theme_includes/THEME_FUNCTIONS.php
     * Create your own tfuse_user_profile() to override in a child theme or use filter tfuse_user_profile.
     * 
     * Specific wich fileds form user profile to retrive: first_name,last_name,email,url,aim,yim,jabber,facebook,twitter etc.
     * 
     * @since  Gameszone 1.0
     */
?>
<?php if(tfuse_options('disable_author_info')):?>
    <?php $author_description = get_the_author_meta('description');?>
    <section class="author-description">
        <div class="author-image"><?php echo get_avatar( get_the_author_meta( 'ID' ), '200' ); ?></div>
        <div class="author-text">
            <h2 class="author-name"><?php _e('Article by','tfuse'); ?>: <span><?php echo get_the_author(); ?></span></h2>
            <p><?php if ( !empty($author_description) ) echo $author_description; ?></p>
        </div>
    </section>
<?php endif;