<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to tfuse_comment() which is
 * located in the functions.php file.
 *
 */
?>  
    <div class="clearfix"></div>
    <section id="comments" class="comments-area">
    <?php if ( post_password_required() ) : ?>
        <p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'tfuse' ); ?></p>
    </div><!-- #comments -->
    <?php
            /* Stop the rest of comments.php from being processed,
             * but don't kill the script entirely -- we still have
             * to fully load the template.
             */
            return;
        endif;
    ?>
    <?php
    $commenter = wp_get_current_commenter();
        $req = get_option( 'require_name_email' );
        $aria_req = ( $req ? " aria-required='true'" : '' );
        
if(is_user_logged_in()){
    $comment_field = '<p class="comment-form-comment logged">
                                <label for="comment">'. __( 'Message', 'tfuse' ) .'
                                        <span class="required-asterisc">*</span>
                                </label>
                                <textarea id="comment" name="comment" ' . $aria_req . '></textarea>
                        </p>';
    $textarea_field = '';
}
else{
    $comment_field = '';
    $textarea_field = '  <p class="comment-form-comment">
                                <label for="comment">'. __( 'Message', 'tfuse' ) .'
                                        <span class="required-asterisc">*</span>
                                </label>
                                <textarea id="comment" name="comment" ' . $aria_req . '></textarea>
                        </p>';
}

$args = array(
    'id_form'           => 'commentform',
    'id_submit'         => 'submit',
    'title_reply'       => __( 'Leave A Reply:','tfuse'  ),
    'title_reply_to'    => __( 'Leave Your Reply to %s','tfuse'  ),
    'cancel_reply_link' => __( 'Cancel Reply','tfuse'  ),
    'label_submit'      => __( 'SUBMIT COMMENT','tfuse'  ),
    
    'comment_field' => $comment_field,

    'must_log_in' => '<p class="must-log-in">' .
        sprintf(
            __( 'You must be <a href="%s">logged in</a> to post a comment.','tfuse'  ),
            wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
        ) . '</p>',

    'logged_in_as' => '<p class="logged-in-as">' .
        sprintf(
            __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','tfuse'  ),
            admin_url( 'profile.php' ),
            $user_identity,
            wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
        ) . '</p>',

    'comment_notes_before' => '',

    'comment_notes_after' => '',

    'fields' => apply_filters( 'comment_form_default_fields', array(
        'comment_field' => $textarea_field,
            'author' =>'<p class="comment-form-author">
                            <label for="author">' . __( 'YOUR DISPLAY Name ', 'tfuse' ) . '<span class="required">*</span></label>
                            <input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .'" ' . $aria_req . '>
                        </p>',

            'email' =>'<p class="comment-form-email">
                            <label for="email">' . __( 'YOUR EMAIL ADDRESS ', 'tfuse' ) . '<span class="required">*</span></label>
                            <input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) .'"  ' . $aria_req . '>
                            <span class="optional">(' . __( 'this will not be shared', 'tfuse' ) . ')</span>
                        </p>',
            'url' =>
            '<p class="comment-form-url">
                <label for="url">'.__('YOUR WEBSITE','tfuse').'</label>
                <input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) .'" >
                <span class="optional">('.__('optional field','tfuse').')</span>
            </p>',
        )
    )
);
comment_form($args);
// You can start editing here -- including this comment! ?>

    <?php if ( have_comments() ) : ?>
        <ol class="comment-list">
            <?php
                /* Loop through and list the comments. Tell wp_list_comments()
                 * to use tfuse_comment() to format the comments.
                 * If you want to overload this in a child theme then you can
                 * copy file comments-template.php to child theme or
                 * define your own tfuse_comment() and that will be used instead.
                 * See tfuse_comment() in comments-template.php for more.
                 */
                get_template_part( 'comments', 'template' );
                wp_list_comments( array( 'callback' => 'tfuse_comment' ) );
            ?>
        </ol>

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
       <div class="comments-pagination">
            <?php paginate_comments_links(); ?>
        </div>
        <?php endif; // check for comment navigation ?>

    <?php elseif ( comments_open() ) : // If comments are open, but there are no comments ?>

        <p class="nocomments"><?php _e('No comments yet.', 'tfuse') ?></p>

    <?php endif; ?>
</section><!-- #comments -->