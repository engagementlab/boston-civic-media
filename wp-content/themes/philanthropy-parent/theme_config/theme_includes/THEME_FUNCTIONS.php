<?php
if ( ! isset( $content_width ) ) $content_width = 900;

function tf_time_passed($timestamp)
{
     $diff = time() - (int)$timestamp;

     if ($diff == 0) 
          return 'just now';

     $intervals = array
     (
         1                   => array('year',    31556926),
         $diff < 31556926    => array('month',   2628000),
         $diff < 2629744     => array('week',    604800),
         $diff < 604800      => array('day',     86400),
         $diff < 86400       => array('hour',    3600),
         $diff < 3600        => array('minute',  60),
         $diff < 60          => array('second',  1)
     );

      $value = floor($diff/$intervals[1][1]);
      return $value.' '.$intervals[1][0].($value > 1 ? 's' : '').' ago';
}


if (!function_exists('tfuse_sidebar_position')):
/* This Function Set sidebar position
 * To override tfuse_sidebar_position() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
*/
    function tfuse_sidebar_position() {
        global $TFUSE;

        $sidebar_position = $TFUSE->ext->sidebars->current_position;
        if ( empty($sidebar_position) ) $sidebar_position = 'full';

        return $sidebar_position;
    }

// End function tfuse_sidebar_position()
endif;


if (!function_exists('tfuse_count_post_visits')) :
/**
 * tfuse_count_post_visits.
 * 
 * To override tfuse_count_post_visits() in a child theme, add your own tfuse_count_post_visits() 
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_count_post_visits()
    {
        if ( !is_single() ) return;

        global $post;

        $views = get_post_meta($post->ID, TF_THEME_PREFIX . '_post_viewed', true);
        $views = intval($views);
        tf_update_post_meta( $post->ID, TF_THEME_PREFIX . '_post_viewed', ++$views);
    }
    add_action('wp_head', 'tfuse_count_post_visits');

// End function tfuse_count_post_visits()
endif;


if (!function_exists('tfuse_user_profile')) :
/**
 * Retrieve the requested data of the author of the current post.
 *  
 * @param array $fields first_name,last_name,email,url,aim,yim,jabber,facebook,twitter etc.
 * @return null|array The author's spefified fields from the current author's DB object.
 */
    function tfuse_user_profile( $fields = array() )
    {
        $tfuse_meta = null;

        // Get stnadard user contact info
        $standard_meta = array(
            'first_name' => get_the_author_meta('first_name'),
            'last_name' => get_the_author_meta('last_name'),
            'email'     => get_the_author_meta('email'),
            'url'       => get_the_author_meta('url'),
            'aim'       => get_the_author_meta('aim'),
            'yim'       => get_the_author_meta('yim'),
            'jabber'    => get_the_author_meta('jabber')
        );

        // Get extended user info if exists
        $custom_meta = (array) get_the_author_meta('theme_fuse_extends_user_options');

        $_meta = array_merge($standard_meta,$custom_meta);

        foreach ($_meta as $key => $item) {
            if ( !empty($item) && in_array($key, $fields) ) $tfuse_meta[$key] = $item;
        }

        return apply_filters('tfuse_user_profile', $tfuse_meta, $fields);
    }

endif;


if (!function_exists('tfuse_action_comments')) :
/**
 *  This function disable post commetns.
 *
 * To override tfuse_action_comments() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_action_comments() {
        global $post;
        comments_template( '' );
    }

    add_action('tfuse_comments', 'tfuse_action_comments');
endif;


if (!function_exists('tfuse_get_comments')):
/**
 *  Get post comments for a specific post.
 *
 * To override tfuse_get_comments() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_get_comments($return = TRUE, $post_ID) {
        $num_comments = get_comments_number($post_ID);

        if (comments_open($post_ID)) {
            if ($num_comments == 0) {
                $comments = __('No Comments','tfuse');
            } elseif ($num_comments > 1) {
                $comments = $num_comments . __(' Comments','tfuse');
            } else {
                $comments = __('1 Comment','tfuse');
            }
            $write_comments = $comments;
        } else {
            $write_comments = __('Comments are off','tfuse');
        }
        if ($return)
            return $write_comments;
        else
            echo $write_comments;
    }

endif;

if (!function_exists('tfuse_pagination')):
    
function tfuse_pagination( $args = array(), $query = '' ) {
   
    global $wp_rewrite, $wp_query;
        if ( $query ) {

            $wp_query = $query;

        } // End IF Statement
        /* If there's not more than one page, return nothing. */ 
        if ( 1 >= $wp_query->max_num_pages )
            return false;

        /* Get the current page. */
        $current = ( get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1 );
        
        /* Get the max number of pages. */
        $max_num_pages = intval( $wp_query->max_num_pages );  

        /* Set up some default arguments for the paginate_links() function. */
        $defaults = array(
            'base' => esc_url(add_query_arg( 'paged', '%#%' )),
            'format' => '',
            'total' => $max_num_pages,
            'current' => $current,
            'prev_next' => false,
            'show_all' => false,
            'end_size' => 2,
            'mid_size' => 1,
            'add_fragment' => '',
            'type' => 'plain',
            'before' => '',
            'after' => '',
            'echo' => true,
        );

        /* Add the $base argument to the array if the user is using permalinks. */
        if( $wp_rewrite->using_permalinks() )
            $defaults['base'] = user_trailingslashit( trailingslashit( get_pagenum_link() ) . 'page/%#%' );

        /* If we're on a search results page, we need to change this up a bit. */
        if ( is_search() ) {
            $search_permastruct = $wp_rewrite->get_search_permastruct();
            if ( !empty( $search_permastruct ) )
                $defaults['base'] = user_trailingslashit( trailingslashit( get_search_link() ) . 'page/%#%' );
        }

        /* Merge the arguments input with the defaults. */
        $args = wp_parse_args( $args, $defaults ); 

        /* Don't allow the user to set this to an array. */
        if ( 'array' == $args['type'] )
            $args['type'] = 'plain';

        /* Get the paginated links. */
        $page_links = paginate_links( $args );

        /* Remove 'page/1' from the entire output since it's not needed. */
        $page_links = str_replace( array( '&#038;paged=1\'', '/page/1\'' ), '\'', $page_links );

        /* Wrap the paginated links with the $before and $after elements. */
        $page_links = $args['before'] . $page_links . $args['after'];

        /* Return the paginated links for use in themes. */
            ?>
            <nav class="navigation paging-navigation" role="navigation">
                <div class="pagination loop-pagination">
                     <?php $prev_posts = get_previous_posts_link('<span class="prev">
                                            <i class="icon-chevron-left"></i>
                                            <span>Prev</span>
                                        </span>'); ?>
                    <?php if ($prev_posts != '') { echo $prev_posts;} else { echo '<a href="javascript:void(0);" class="prev">
                                                                                    <i class="icon-chevron-left"></i>
                                                                                    <span>Prev</span>
                                                                            </a>'; }?>

                    <?php $next_posts = get_next_posts_link('<span class="next">
                                            <span>Next</span>
                                            <i class="icon-chevron-right"></i>
                                        </span>'); ?>
                    <?php if ($next_posts != '') { echo $next_posts;} else { echo '<a href="javascript:void(0);" class="next">
                                                                                    <span>Next</span>
                                                                                    <i class="icon-chevron-right"></i>
                                                                                </a>'; } ?>
                </div>
            </nav>
            <?php
}
endif;

if (!function_exists('tfuse_shortcode_content')) :
/**
 *  Get post comments for a specific post.
 *
 * To override tfuse_shortcode_content() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_shortcode_content($position = '', $return = false)
    {
        $page_shortcodes = '';
        global $is_tf_front_page,$is_tf_blog_page,$TFUSE;
        $types = $TFUSE->request->isset_GET('types') ? $TFUSE->request->GET('types') : '';
        
        if($position == 'before') $position = 'content_top';
        else $position =  'content_bottom';

        if((is_front_page() || $is_tf_front_page) && !$is_tf_blog_page)
        {  
            if(tfuse_options('homepage_category')=='page'){
                $page_id = tfuse_options('home_page'); 
                $page_shortcodes = tfuse_page_options($position,'',$page_id);
            }
            else
            $page_shortcodes = tfuse_options($position);
        }
        elseif($is_tf_blog_page)
        { 
            $position ='blog_'.$position;
            $page_shortcodes = tfuse_options($position);
        }
        elseif (is_singular()) {
            global $post;
            $page_shortcodes = tfuse_page_options($position);
        } 
        elseif (is_category()) {
            $cat_ID = get_query_var('cat');
            $page_shortcodes = tfuse_options($position, '', $cat_ID);
        }
        elseif(is_search())
        { 
           $position ='search_'.$position;
            $page_shortcodes = tfuse_options($position);
        }
        elseif (is_tax()) {
            $taxonomy = get_query_var('taxonomy');
            $term = get_term_by('slug', get_query_var('term'), $taxonomy);
            $cat_ID = $term->term_id;
            $page_shortcodes = tfuse_options($position, '', $cat_ID);
        }
        elseif(is_404())
        { 
           $position ='404_'.$position;
            $page_shortcodes = tfuse_options($position);
        }
        
        $page_shortcodes = apply_filters('themefuse_shortcodes', $page_shortcodes);

        if ($return)
            return $page_shortcodes;
        else
        {
            if((($position == 'content_bottom') && !empty($page_shortcodes)) || (($position == 'blog_content_bottom') && !empty($page_shortcodes)) || (($position == '404_content_bottom') && !empty($page_shortcodes)) || (($position == 'search_content_bottom') && !empty($page_shortcodes)))
                echo $page_shortcodes;
            elseif((($position == 'content_top') && !empty($page_shortcodes)) || (($position == 'blog_content_top') && !empty($page_shortcodes)) || (($position == '404_content_top') && !empty($page_shortcodes)) || (($position == 'search_content_top') && !empty($page_shortcodes)))
                    echo $page_shortcodes;
        }
    }

// End function tfuse_shortcode_content()
endif;


if (!function_exists('tfuse_category_on_front_page')) :
/**
 * Dsiplay homepage category
 *
 * To override tfuse_category_on_front_page() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_category_on_front_page()
    {
        if ( !is_front_page() ) return;

        global $is_tf_front_page,$homepage_categ;
        $is_tf_front_page = false;

        $homepage_category = tfuse_options('homepage_category');
        $homepage_category = explode(",",$homepage_category);
        foreach($homepage_category as $homepage)
        {
            $homepage_categ = $homepage;
        }

        if($homepage_categ == 'specific')
        {
            $is_tf_front_page = true;
            $archive = 'archive.php';
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;           
            
            $specific = tfuse_options('categories_select_categ');

            $ids = explode(",",$specific);
            $posts = array(); 
            foreach ($ids as $id){
                $posts[] = get_posts(array('category' => $id));
            }

            $args = array(
                        'cat' => $specific,
                        'orderby' => 'date',
                        'paged' => $paged
            );
            query_posts($args);

            include_once(locate_template($archive));
                        
            return;
        }
        elseif($homepage_categ == 'page')
        {
            global $front_page;
            $is_tf_front_page = true;
            $front_page = true;
            $archive = 'page.php';
            $page_id = tfuse_options('home_page');

            $args=array(
                'page_id' => $page_id,
                'post_type' => 'page',
                'post_status' => 'publish',
                'posts_per_page' => 1,
                'ignore_sticky_posts'=> 1
            );
            query_posts($args);
            include_once(locate_template($archive));
            wp_reset_query();
            return;
        }
        elseif($homepage_categ == 'all')
        {
            $archive = 'archive.php';

            $is_tf_front_page = true;
            wp_reset_postdata();
            include_once(locate_template($archive));
            return;
        }
 
    }

// End function tfuse_category_on_front_page()
endif;

if (!function_exists('tfuse_category_on_blog_page')) :
    /**
     * Dsiplay blogpage category
     *
     * To override tfuse_category_on_blog_page() in a child theme, add your own tfuse_count_post_visits()
     * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
     */

    function tfuse_category_on_blog_page()
    {
        global $is_tf_blog_page; 
        $blogpage_categ ='';
        if ( !$is_tf_blog_page ) return;
        $is_tf_blog_page = false;

        $blogpage_category = tfuse_options('blogpage_category');
        $blogpage_category = explode(",",$blogpage_category);
        foreach($blogpage_category as $blogpage)
        {
            $blogpage_categ = $blogpage;
        }
        if($blogpage_categ == 'specific')
        {
            $is_tf_blog_page = true;
            $archive = 'archive.php';
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

            $specific = tfuse_options('categories_select_categ_blog');

            $ids = explode(",",$specific);
            $posts = array();
            foreach ($ids as $id){
                $posts[] = get_posts(array('category' => $id));
            }

            $args = array(
                'cat' => $specific,
                'orderby' => 'date',
                'paged' => $paged
            );
            query_posts($args);

            include_once(locate_template($archive));
            return;
        }
        else
        {  
            $is_tf_blog_page = true;
            $archive = 'archive.php';
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $categories = get_categories();

            $ids = array();
            foreach($categories as $cats){
                $ids[] = $cats -> term_id;
            }
            $posts = array(); 

            foreach ($ids as $id){
                $posts[] = get_posts(array('category' => $id));
            }

            $args = array(
                'orderby' => 'date',
                'paged' => $paged
            );
            query_posts($args);

            include_once(locate_template($archive));
            return;
        }
    }
// End function tfuse_category_on_blog_page()
endif;

add_filter('get_archives_link','wid_link',99);
if (!function_exists('wid_link')) :
    function wid_link($url) {
        $url = str_replace( '</a>&nbsp;', '&nbsp;', $url );
        $url = str_replace( '</li>', '</a></li>', $url );
        return $url;
    }
endif;

add_filter('wp_list_bookmarks','wid_link1',99);
if (!function_exists('wid_link1')) :
    function wid_link1($url) {
        $url = str_replace( '</a>', '', $url );
        $url = str_replace( '</li>', '</a></li>', $url );
        return $url;
    }
endif;


    
function new_excerpt_more( $more ) {
    $more = '';
        return $more;
}
add_filter('excerpt_more', 'new_excerpt_more');

function custom_excerpt_length( $length ) {
    return 50;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

if (!function_exists('tfuse_group_title')) :
    function tfuse_group_title(){
        $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy') );
        $ID = $term->term_id;
        $title = tfuse_options('group_title',null,$ID);
        echo $title;
    }
endif;

if(!function_exists('tfuse_feedFilter')) :

    function tfuse_feedFilter($query) {
        if ($query->is_feed) {
            add_filter('the_content', 'tfuse_feedContentFilter');
        }
        return $query;
    }
    add_filter('pre_get_posts','tfuse_feedFilter');

    function tfuse_feedContentFilter($content) {
        $thumb = tfuse_page_options('single_image');
        $image = '';
        if($thumb) {
            $image = '<a href="'.get_permalink().'"><img align="left" src="'. $thumb .'" width="200px" height="150px" /></a>';
            echo $image;
        }
        $content = $image . $content;
        return $content;
    }

endif;

if (!function_exists('tfuse_aasort')) :
    /**
     *
     *
     * To override tfuse_aasort() in a child theme, add your own tfuse_aasort()
     * to your child theme's file.
     */
    function tfuse_aasort ($array, $key) {
        $sorter=array();
        $ret=array();
        if (!$array){$array = array();}
        reset($array);
        foreach ($array as $ii => $va) {
            $sorter[$ii]=$va[$key];
        }
        asort($sorter);
        foreach ($sorter as $ii => $va) {
            $ret[$ii]=$array[$ii];
        }
        return $ret;
    }
endif;

function tfuse_change_submenu_class($menu) {
    $menu = preg_replace('/ class="sub-menu"/','/ class="hidden" /',$menu);
    return $menu;
}
add_filter ('wp_nav_menu','tfuse_change_submenu_class');


//display logo
if (!function_exists('tfuse_type_logo')) :
    function tfuse_type_logo() { 
        $logo_type = tfuse_options('logo_type');
    
        if($logo_type == 'img')
        {
            $logo_upload = tfuse_options('logo');
            if(!empty($logo_upload)) 
            {  ?> 
                  <a href="<?php echo home_url(); ?>"><span><img src="<?php echo tfuse_options('logo'); ?>"  border="0" /></span></a>
      <?php }
        }
        else
        { ?>
            <a href="<?php echo home_url(); ?>"><span><?php echo tfuse_options('logo_text','Philanthropy'); ?></span></a>
      <?php  }
    }
endif;

if (!function_exists('tfuse_shorten_string')) :
    /**
     * To override tfuse_shorten_string() in a child theme, add your own tfuse_shorten_string()
     * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
     */

function tfuse_shorten_string($string, $wordsreturned)

{
    $retval = $string;

    $array = explode(" ", $string);
    if (count($array)<=$wordsreturned)

    {
        $retval = $string;
    }
    else

    {
        array_splice($array, $wordsreturned);
        $retval = implode(" ", $array)." ...";
    }
    return $retval;
}

endif;

if (!function_exists('tfuse_user_has_gravatar')){
	function tfuse_user_has_gravatar( $email_address ) {
		// Build the Gravatar URL by hasing the email address
		$url = 'http://www.gravatar.com/avatar/' . md5( strtolower( trim ( $email_address ) ) ) . '?d=404';
		// Now check the headers
		$headers = @get_headers( $url );
		// If 200 is found, the user has a Gravatar; otherwise, they don't.
		return preg_match( '|200|', $headers[0] ) ? true : false;
	}
}


if (!function_exists('tfuse_filter_get_avatar')){
	function tfuse_filter_get_avatar($avatar, $id_or_email, $size, $default, $alt){
		$avatar_src = tfuse_options('default_avatar', false);
		if(empty($avatar_src)) {
			return $avatar;
		}

		$email = '';
		if ( is_numeric($id_or_email) ) {
			$id = (int) $id_or_email;
			$user = get_userdata($id);
			if ( $user )
				$email = $user->user_email;
		} elseif ( is_object($id_or_email) ) {
			// No avatar for pingbacks or trackbacks
			$allowed_comment_types = apply_filters( 'get_avatar_comment_types', array( 'comment' ) );
			if ( ! empty( $id_or_email->comment_type ) && ! in_array( $id_or_email->comment_type, (array) $allowed_comment_types ) )
				return false;

			if ( !empty($id_or_email->user_id) ) {
				$id = (int) $id_or_email->user_id;
				$user = get_userdata($id);
				if ( $user)
					$email = $user->user_email;
			} elseif ( !empty($id_or_email->comment_author_email) ) {
				$email = $id_or_email->comment_author_email;
			}
		} else {
			$email = $id_or_email;
		}

		if(!tfuse_user_has_gravatar($email)){
			$avatar = "<img alt='' src='".TF_GET_IMAGE::get_src_link($avatar_src, $size, $size)."' class='avatar avatar-".$size." photo avatar-default' height='".$size."' width='".$size."' />";
		}

		return $avatar;
	}
	add_filter('get_avatar', 'tfuse_filter_get_avatar',10,5);
}

add_theme_support( 'automatic-feed-links' );



function tfuse_feedburner_url($output, $feed)
{
    $feedburner_url = tfuse_options('feedburner_url');
    if($feedburner_url && (($feed == 'rss2') || ($feed == '' && false === strpos($output, '/comments/feed/'))) )
        return $feedburner_url;
    return $output;
}
add_filter('feed_link','tfuse_feedburner_url',10,2);

if ( !function_exists('tfuse_cat_links')):
    function tfuse_cat_links($post_type,$id){
        if($post_type == 'post')
            return get_the_category_list(', ');
        elseif($post_type == 'gallery')
            return get_the_term_list($id,'galleries', '', ', ' );
        elseif($post_type == 'event')
            return get_the_term_list($id,'events', '', ', ' );
        elseif($post_type == 'project')
            return get_the_term_list($id,'projects', '', ', ' );

    }
endif;

if ( !function_exists('tfuse_tags_links')):
    function tfuse_tags_links($post_type,$id){
        if($post_type == 'post')
            return get_the_term_list($id,'post_tag', '', ' ' );
        elseif($post_type == 'story')
            return get_the_term_list($id,'tags', '', ' ' );
        elseif($post_type == 'service')
            return get_the_term_list($id,'tags_service', '', ' ' );
        elseif($post_type == 'advice')
            return get_the_term_list($id,'tags_advice', '', ' ' );
        elseif($post_type == 'exercise')
            return get_the_term_list($id,'tags_exercises', '', ' ' );
    }
endif;

if ( !function_exists('tfuse_render_view')):

function tfuse_render_view($file_path, $view_variables = array()) {
	extract($view_variables, EXTR_REFS);

	ob_start();

	require $file_path;

	return ob_get_clean();
}
endif;

if ( ! function_exists( 'tfuse_get_slides_from_posts' ) ):
/**
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override tfuse_slider_type() in a child theme, add your own tfuse_slider_type to your child theme's
 * functions.php file.
 */
    function tfuse_get_slides_from_posts( $posts=array(), $slider = array() )
    {
        global $post;
        
        $slides = array();
        $slider_image_resize = ( isset($slider['general']['slider_image_resize']) && $slider['general']['slider_image_resize'] == 'true' ) ? $slider['general']['slider_image_resize'] : false;
        $k = 0;
        foreach ($posts as $k => $post) : $k++;
            setup_postdata( $post );  

            $tfuse_image = $image = null;

            $image = new TF_GET_IMAGE();
            
            if($slider_image_resize)
            {
                $post_image_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'post-thumbnails'));
                $get_image = new TF_GET_IMAGE();
                $tfuse_image = $get_image->properties(array('class' => '', 'alt' => get_the_title($post->ID)))->width(629)->height(500)->src($post_image_src)->resize(true)->get_img();
            }
            else
                $tfuse_image = '<img src="'.wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'post-thumbnails')).'"/>';
                
            
        endforeach;
		wp_reset_postdata();
                
        return $slides;
    }
endif;

if (!function_exists('tfuse_get_instagram_photos')):
    function tfuse_get_instagram_photos($username, $items = 9) {
        if ( false === ( $instagram = get_transient( 'instagram-photos-' . sanitize_title_with_dashes( $username ) . '-'.$items ) ) ) {
            $connect = wp_remote_get( 'http://instagram.com/' . trim( $username ) );

            if ( is_wp_error( $connect ) ) {
                return new WP_Error( 'site_down', __( 'Unable to communicate with Instagram.', 'tf' ) );
            }

            if ( 200 != wp_remote_retrieve_response_code( $connect ) ) {
                return new WP_Error( 'invalid_response', __( 'Instagram did not return a 200.', 'tf' ) );
            }

            $shared_data     = explode( 'window._sharedData = ', $connect['body'] );
            $instagram_json  = explode( ';</script>', $shared_data[1] );
            $instagram_array = json_decode( $instagram_json[0], true );

            if ( ! $instagram_array ) {
                return new WP_Error( 'bad_json', __( 'Instagram has returned invalid data.', 'tf' ) );
            }

            // attention on this array !
            if(isset($instagram_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'])) {
                $images = $instagram_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'];
            }
            else{
                return;
            }

            $instagram = array();
            $count     = 0;
            foreach ( $images as $image ) {
                if ( !$image['is_video']) {
                    $instagram[] = array(
                        'code'        => $image['code'],
                        'link'        => $image['display_src'],
                        'likes'       => $image['likes']['count'],
                    );
                    $count ++;
                }
                if ( $count == $items ) {
                    break;
                }
            }

            $instagram = base64_encode( serialize( $instagram ) );
            set_transient( 'instagram-photos-' . sanitize_title_with_dashes( $username ), $instagram, apply_filters( 'null_instagram_cache_time', HOUR_IN_SECONDS * 2 ) );
        }
        $instagram = unserialize( base64_decode( $instagram ) );
    
        return array_slice($instagram, 0, $items);
    }
endif;


function custom_wp_link_pages( $args = '' ) {
	$defaults = array(
		'before' => '<div class="post-pagination"><h6 class="title">'.__('This article contains multiple pages').':</h6>', 
		'after' => '</div>',
		'text_before' => '',
		'text_after' => '',
		'next_or_number' => 'number', 
		'nextpagelink' => __( 'Next page','tfuse' ),
		'previouspagelink' => __( 'Previous page','tfuse' ),
		'pagelink' => '%',
		'echo' => 1
	);

	$r = wp_parse_args( $args, $defaults );
	$r = apply_filters( 'wp_link_pages_args', $r );
	extract( $r, EXTR_SKIP );

	global $page, $numpages, $multipage, $more, $pagenow;

	$output = '';
	if ( $multipage ) {
		if ( 'number' == $next_or_number ) {
			$output .= $before;
			for ( $i = 1; $i < ( $numpages + 1 ); $i = $i + 1 ) {
				$j = str_replace( '%', $i, $pagelink );
				$output .= ' ';
				if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) )
					$output .= _wp_link_page( $i );
				else
					$output .= '<span class="current">';

				$output .= $text_before . $j . $text_after;
				if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) )
					$output .= '</a>';
				else
					$output .= '</span>';
			}
			$output .= $after;
		} else {
			if ( $more ) {
				$output .= $before;
				$i = $page - 1;
				if ( $i && $more ) {
					$output .= _wp_link_page( $i );
					$output .= $text_before . $previouspagelink . $text_after . '</a>';
				}
				$i = $page + 1;
				if ( $i <= $numpages && $more ) {
					$output .= _wp_link_page( $i );
					$output .= $text_before . $nextpagelink . $text_after . '</a>';
				}
				$output .= $after;
			}
		}
	}

	if ( $echo )
		echo $output;

	return $output;
}

if ( !function_exists('tfuse_show_similar_posts')):
    function tfuse_show_similar_posts($id,$post_type){
        
        if($post_type == 'story')
            $tags = wp_get_post_terms($id,'tags');
        elseif($post_type == 'service')
            $tags = wp_get_post_terms($id,'tags_service');
        elseif($post_type == 'advice')
            $tags = wp_get_post_terms($id,'tags_advice');
        elseif($post_type == 'exercise')
            $tags = wp_get_post_terms($id,'tags_exercises');
        else
            $tags = wp_get_post_tags($id);
                        
        if(!empty($tags)){ 
            $tags_ids = array();
            foreach($tags as $tag){
                $tags_ids[] = $tag->term_id;
            }
            
            if($post_type == 'story')
            {
                $query = new WP_Query(
                    array(
                        'post_type' => 'story',
                        'posts_per_page' => 2,
                        'post__not_in' => array($id),
                        'tax_query' => array(
                                array(
                                        'taxonomy' => 'tags',
                                        'field' => 'id',
                                        'terms' => $tags_ids
                                )
                        )
                    )
                );
            }
            elseif($post_type == 'service')
            {
                $query = new WP_Query(
                    array(
                        'post_type' => 'service',
                        'posts_per_page' => 2,
                        'post__not_in' => array($id),
                        'tax_query' => array(
                                array(
                                        'taxonomy' => 'tags_service',
                                        'field' => 'id',
                                        'terms' => $tags_ids
                                )
                        )
                    )
                );
            }
            else
            {
                $query = new WP_Query(
                    array(
                        'post_type' => 'post',
                        'tag__in' => $tags_ids,
                        'posts_per_page' => 2,
                        'post__not_in' => array($id),
                    )
                );
            }
                        
            if(!empty($query->posts)){ ?>
                <section class="post-similar clearfix">
                    <h6 class="title"><?php _e('You may also like these posts','tfuse'); ?></h6>
                    <?php foreach($query->posts as $item){
                        $image = wp_get_attachment_url( get_post_thumbnail_id($item->ID, 'post-thumbnails'));
                        if(!empty($image))
                            echo '<a href="'.get_permalink($item->ID).'"><img src="'.TF_GET_IMAGE::get_src_link($image, 322, 234).'" /><span>'.strip_tags($item->post_title).'</span></a>';
                    } ?>
                </section>
            <?php }
        }
    }
endif;

if (!function_exists('tf_get_game_images_posts')) :

function tf_get_game_images_posts($post_id)
{
    $all_posts = array();
    
    $weeks_training = tfuse_page_options('content_weeks','',$post_id);
    
    if(!empty($weeks_training))
    {
        $training_id = $weeks_training[0]['tab_day1'];
        
        $exercises = explode(',',tfuse_page_options('exercises_select','',$training_id));
                
        $args = array(
            'posts_per_page' => -1,
            'post_type' => 'exercise',
            'post__in' =>  $exercises
        );
    
        $all_posts = new WP_Query( $args );
        $posts = $all_posts->posts;
    }
     
    
        
    return $all_posts;
}

endif;

if(!function_exists('tfuse_get_workout_trainings'))
{
    function tfuse_get_workout_trainings($weeks){
        $weeks_training = tfuse_page_options('content_weeks');
        
        if(count($weeks_training) > $weeks)
            $weeks_training = array_slice($weeks_training, 0, $weeks); 
        else
        {
            $end_week = end($weeks_training);
            if($end_week['tab_repeat'])
                $array_to_concat = array_fill(0, $weeks - count($weeks_training) ,end($weeks_training));
            elseif($weeks - count($weeks_training) == 0){
                $array_to_concat = array('');
            }
            else
                $array_to_concat = array_fill(0, $weeks - count($weeks_training) ,array(''));

            $weeks_training = array_merge($weeks_training,$array_to_concat);
        }
        
        return $weeks_training;
    }
}


if(!function_exists('tf_get_similar_workouts'))
{
    function tf_get_similar_workouts($post_id){
        $posts = array();
        
        $tags = wp_get_post_terms($post_id,'goals');
        
        if(!empty($tags)){ 
            $tags_ids = array();
            foreach($tags as $tag){
                $tags_ids[] = $tag->term_id;
            }

            $query = new WP_Query(
                array(
                    'post_type' => 'workout',
                    'posts_per_page' => 3,
                    'post__not_in' => array($post_id),
                    'tax_query' => array(
                            array(
                                    'taxonomy' => 'goals',
                                    'field' => 'id',
                                    'terms' => $tags_ids
                            )
                    )
                )
            );
                
            $posts = $query->posts;
        }
        
        return $posts;
    }
}

if ( !function_exists('tfuse_pass_post_id')):

    function tfuse_pass_post_id() {
        global $post;
        
        if(is_singular('workout'))
        {  
            $rating = array();

            $rating['workout-'.$post->ID.'-rating']['val'] = '';
            $rating['workout-'.$post->ID.'-rating']['count'] = 0;

            $rating_info = get_post_meta($post->ID, TF_THEME_PREFIX . '_rating', true);
            
            if(empty($rating_info)) {$rating_info = $rating;}

            wp_localize_script(
                'general',
                'rating',
                array(
                    'id' => $post->ID,
                    'rating_info' => $rating_info,
                )
            );
        }
        else
        {
            wp_localize_script(
                'general',
                'rating',
                array(
                    'id' => '',
                    'rating_info' => '',
                )
            );
        }
    }
    add_action('wp_print_scripts', 'tfuse_pass_post_id', 1000);
endif;

if ( !function_exists('tfuse_pass_ajax_info')):

    function tfuse_pass_ajax_info() {
        global $post,$is_tf_blog_page,$is_tf_front_page,$wp_query;
        $posts = '';
        $max_specific =  $num_post = $posttype = $col = 0 ;
        $items = get_option('posts_per_page');
        
        if(!empty($post)) $posttype = $post->post_type;  else $posttype = '';
        
        if(is_search())
        {
            $search_query = get_search_query();
            
            $query = new WP_Query(array( 's' => $search_query ,'posts_per_page' => -1));
            $posts = $query->get_posts();
        }
        elseif(is_tax())
        {  
            if($posttype == 'gallery')
            { 
                $term = get_term_by('slug', get_query_var('term'), 'galleries'); $type = 'galleries';
            }
            elseif($posttype == 'project')
            { 
                $term = get_term_by('slug', get_query_var('term'), 'projects'); $type = 'projects'; 
            }
            
            if(!empty($term))
            {
                $ID = $term->term_id; 
                $query = new WP_Query(array( 
                    'posts_per_page' => -1 ,
                    'tax_query' => array(
                                    array(
                                        'taxonomy' => $type,
                                        'field' => 'id',
                                        'terms' => $ID
                                    )
                            )));
                $posts = $query->get_posts();
            }
        }
        elseif($is_tf_front_page || $is_tf_blog_page)
        { 
            if($is_tf_front_page){
                $select_blog = tfuse_options('homepage_category','');
            }
            else {
                $select_blog = tfuse_options('blogpage_category', '');
            }

            if($select_blog=='specific'){
                if($is_tf_front_page) $cats = tfuse_options('categories_select_categ', '');
                else $cats = tfuse_options('categories_select_categ_blog', '');
                $cat_ids = explode(",",$cats);
                $type = 'post';
                $tax = 'category';
            }
            else
            {
                $cats = get_terms('category');
                $cat_ids = array();
                foreach($cats as $cat){
                    $cat_ids[] = $cat->term_id;
                }
                $type = 'post';
                $tax = 'category';
            }

            $args = array(
                'post_type' => $type,
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => $tax,
                        'field' => 'id',
                        'terms' => $cat_ids
                    )
                )
            );
            $posts = new WP_Query( $args );
            $posts = $posts -> posts;
            
            if($select_blog=='specific'){
                $num_posts = count($posts);
                $max_specific = $num_posts/$items;
                if($num_posts%$items != 0) $max_specific++;
            }
            else
                $max_specific = 0;
            
        }
        elseif(is_category())
        { 
            $ID = get_query_var('cat');
            $query = new WP_Query(array( 'cat' => $ID,'posts_per_page' => -1));
            $posts = $query->get_posts();
        }
        else
        {
            $posts = '';
        }
        
        if($is_tf_front_page){
            $select_front = tfuse_options('homepage_category','');
        }
        else {
            $select_front = tfuse_options('blogpage_category', '');
        }
        
        if($is_tf_blog_page)
        { 
            $paged = 1;
            $num_posts = count($posts);
            $max = $num_posts/$items;
            if($num_posts%$items != 0) $max++; 
        }
        elseif( !is_singular() || $is_tf_blog_page != true ) {
            $max = $wp_query->max_num_pages; 
            $paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;
        }
        else { 
            $paged = '';
            $max = '';
        }
        
        wp_localize_script(
                'general',
                'display',
                array(
                    'max_specific' => $max_specific,
                    'number' => count($posts),
                    'items' => $items,
                    'startPage' => $paged,
                    'maxPages' => $max,
                    'nextLink' => next_posts($max, false)
                )
            );
    }
    add_action('wp_print_scripts', 'tfuse_pass_ajax_info', 1000);
endif;

if ( !function_exists('tfuse_get_cat_id')):

    function tfuse_get_cat_id() {
        global $post;
	$ID = $posttype = '';
        
        if(!empty($post)) $posttype = $post->post_type;  else $posttype = '';
        
        if(is_tax())
        {
            if($posttype == 'gallery')
            {
                $term = get_term_by('slug', get_query_var('term'), 'galleries');
            }
            elseif($posttype == 'project')
            {
                $term = get_term_by('slug', get_query_var('term'), 'projects');
            }
            
            if(!empty($term))
                $ID = $term->term_id;
        }
        elseif(is_category())
        { 
            $ID = get_query_var('cat');
        }
        return $ID;
    }
endif;

if ( !function_exists('tfuse_show_numb_pagination')):

    function tfuse_show_numb_pagination() {
        if(tfuse_options('pagination_type') == 'type1' || is_tag() || is_author() || (is_archive() && !is_category()))
        {
            tfuse_pagination();
        }
    }
endif;

if ( !function_exists('tfuse_is_homepage')):

    function tfuse_is_homepage() {
        global $is_tf_blog_page,$is_tf_front_page;
        
        if($is_tf_front_page) return 'homepage';
        elseif($is_tf_blog_page) return 'blogpage';
        else return;
           
    }
endif;

if ( !function_exists('tfuse_get_categories_ids')):

    function tfuse_get_categories_ids() {
        $categories = get_categories();
        
        $id = array();
        foreach ($categories as $category):
            $id[] = $category->term_id;
        endforeach;

        $ids = implode(',',$id);
        return $ids;
    }
endif;

if ( !function_exists('tfuse_select_all_home')):

    function tfuse_select_all_home() {
        $select= tfuse_options('homepage_category');
        
        if($select == 'all') return 'allhomecategories';
        else return 'nonehomeall';
    }
endif;

if ( !function_exists('tfuse_select_all_blog')):

    function tfuse_select_all_blog() {
        $select = tfuse_options('blogpage_category');
        
        if($select == 'all') return 'allblogcategories';
        else return 'noneblogall';
    }
endif;

if( !function_exists('tfuse_theme_styles') )
{
    function tfuse_theme_styles($values = array(),$options = array())
    {
        if (empty($options))
            return;
                
        $output = '';
        
        $body_font = $options[TF_THEME_PREFIX . '_body_font'];
        $titles_font = $options[TF_THEME_PREFIX . '_titles_font'];
                
        if(!empty($body_font))
        {
            switch ($body_font) {
                case 'intro_inline':
                    $font = '';
                    $b_family ='"Intro Inline"';
                    break;
                case 'great_vibes':
                    $font = '//fonts.googleapis.com/css?family=Great+Vibes&subset=latin,latin-ext';
                    $b_family ='"Great Vibes"';
                    break;
                case 'roboto':
                    $font = '//fonts.googleapis.com/css?family=Roboto+Slab:400,700';
                    $b_family ='"Roboto Slab", serif';
                    break;
                case 'cabin':
                    $font = '//fonts.googleapis.com/css?family=Cabin';
                    $b_family ='"Cabin", sans-serif';
                    break;
                case 'droid_sans':
                    $font = '//fonts.googleapis.com/css?family=Droid+Sans';
                    $b_family ="'Droid Sans', sans-serif";
                    break;
                case 'gafata':
                    $font = '//fonts.googleapis.com/css?family=Gafata|Lato:300,700';
                    $b_family = '"Gafata", sans-serif';
                    break;
                case 'oxygen':
                    $font = '//fonts.googleapis.com/css?family=Oxygen';
                    $b_family ="'Oxygen', sans-serif";
                    break;
                case 'philosopher':
                    $font = '//fonts.googleapis.com/css?family=Philosopher';
                    $b_family ="'Philosopher', sans-serif";
                    break;
                case 'questrial':
                    $font = '//fonts.googleapis.com/css?family=Questrial';
                    $b_family ="'Questrial', sans-serif";
                    break;
                case 'raleway':
                    $font = '//fonts.googleapis.com/css?family=Raleway:400,600,700,800,900,500,300,200,100';
                    $b_family ="'Raleway', sans-serif";
                    break;
                case 'signika':
                    $font = '//fonts.googleapis.com/css?family=Signika';
                    $b_family ="'Signika', sans-serif";
                    break;
                case 'ubuntu':
                    $font = '//fonts.googleapis.com/css?family=Ubuntu';
                    $b_family ="'Ubuntu', sans-serif";
                    break;
                case 'georgia':
                    $font = '';
                    $b_family ="'Georgia', serif";
                    break;
                case 'arial':
                    $font = '';
                    $b_family ="'Arial', sans-serif";
                    break;
                case 'arbutus':
                    $font = '//fonts.googleapis.com/css?family=Arbutus+Slab';
                    $b_family ="'Arbutus Slab', serif";
                    break;
                case 'bitter':
                    $font = '//fonts.googleapis.com/css?family=Bitter';
                    $b_family ="'Bitter', serif";
                    break;
                case 'coustard':
                    $font = '//fonts.googleapis.com/css?family=Coustard';
                    $b_family ="'Coustard', serif";
                    break;
                case 'droid_serif':
                    $font = '//fonts.googleapis.com/css?family=Droid+Serif';
                    $b_family ="'Droid Serif', serif";
                    break;
                case 'eb':
                    $font = '//fonts.googleapis.com/css?family=EB+Garamond';
                    $b_family ="'EB Garamond', serif";
                    break;
                case 'goudy':
                    $font = '//fonts.googleapis.com/css?family=Goudy+Bookletter+1911';
                    $b_family ="'Goudy Bookletter 1911', serif";
                    break;
                case 'kotta':
                    $font = '//fonts.googleapis.com/css?family=Kotta+One';
                    $b_family ="'Kotta One', serif";
                    break;
                case 'playfair':
                    $font = '//fonts.googleapis.com/css?family=Playfair+Display';
                    $b_family ="'Playfair Display', serif";
                    break;
                case 'vidaloka':
                    $font = '//fonts.googleapis.com/css?family=Vidaloka';
                    $b_family ="'Vidaloka', serif";
                    break;
                case 'pacifico':
                    $font = '//fonts.googleapis.com/css?family=Pacifico';
                    $b_family ="'Pacifico', cursive";
                    break;
                case 'dancing_script':
                    $font = '//fonts.googleapis.com/css?family=Dancing+Script';
                    $b_family ="'Dancing Script', cursive";
                    break;
                case 'gloria_hallelujah':
                    $font = '//fonts.googleapis.com/css?family=Gloria+Hallelujah';
                    $b_family ="'Gloria Hallelujah', cursive";
                    break;
                case 'satisfy':
                    $font = '//fonts.googleapis.com/css?family=Satisfy';
                    $b_family ="'Satisfy', cursive";
                    break;
                case 'bad_script':
                    $font = '//fonts.googleapis.com/css?family=Bad+Script';
                    $b_family ="'Bad Script', cursive";
                    break;
                case 'allura':
                    $font = '//fonts.googleapis.com/css?family=Allura';
                    $b_family ="'Allura', cursive";
                    break;
                case 'gafata':
                    $font = '//fonts.googleapis.com/css?family=Gafata|Lato:300,700';
                    $b_family = '"Gafata", sans-serif';
                    break;
                case 'montstmerrat':
                    $font = '//fonts.googleapis.com/css?family=Montserrat:400,700';
                    $b_family = '"Montserrat", sans-serif';
                    break;
                default:
                    $font = '//fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic';
                    $b_family = '"Lato", sans-serif';
                    break;
            }
        }
        else
        {
            $output .= '
                    // Load Custom Fonts
                    @import url(//fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic);

                    @font-family:  "Lato", sans-serif;
                    ';
        } 

        if(!empty($titles_font))
        {
            switch ($titles_font) {
                case 'intro_inline':
                    $t_font = '';
                    $t_family ='"Intro Inline"';
                    break;
                case 'great_vibes':
                    $t_font = '//fonts.googleapis.com/css?family=Great+Vibes&subset=latin,latin-ext';
                    $t_family ='"Great Vibes"';
                    break;
                case 'roboto':
                    $t_font = '//fonts.googleapis.com/css?family=Roboto+Slab:400,700';
                    $t_family ='"Roboto Slab", serif';
                    break;
                case 'cabin':
                    $t_font = '//fonts.googleapis.com/css?family=Cabin';
                    $t_family ='"Cabin", sans-serif';
                    break;
                case 'droid_sans':
                    $t_font = '//fonts.googleapis.com/css?family=Droid+Sans';
                    $t_family ="'Droid Sans', sans-serif";
                    break;
                case 'gafata':
                    $t_font = '//fonts.googleapis.com/css?family=Gafata|Lato:300,700';
                    $t_family = '"Gafata", sans-serif';
                    break;
                case 'oxygen':
                    $t_font = '//fonts.googleapis.com/css?family=Oxygen';
                    $t_family ="'Oxygen', sans-serif";
                    break;
                case 'philosopher':
                    $t_font = '//fonts.googleapis.com/css?family=Philosopher';
                    $t_family ="'Philosopher', sans-serif";
                    break;
                case 'questrial':
                    $t_font = '//fonts.googleapis.com/css?family=Questrial';
                    $t_family ="'Questrial', sans-serif";
                    break;
                case 'raleway':
                    $t_font = '//fonts.googleapis.com/css?family=Raleway:400,600,700,800,900,500,300,200,100';
                    $t_family ="'Raleway', sans-serif";
                    break;
                case 'signika':
                    $t_font = '//fonts.googleapis.com/css?family=Signika';
                    $t_family ="'Signika', sans-serif";
                    break;
                case 'ubuntu':
                    $t_font = '//fonts.googleapis.com/css?family=Ubuntu';
                    $t_family ="'Ubuntu', sans-serif";
                    break;
                case 'georgia':
                    $t_font = '';
                    $t_family ="Georgia, serif";
                    break;
                case 'arial':
                    $t_font = '';
                    $t_family ="Arial, sans-serif";
                    break;
                case 'arbutus':
                    $t_font = '//fonts.googleapis.com/css?family=Arbutus+Slab';
                    $t_family ="'Arbutus Slab', serif";
                    break;
                case 'bitter':
                    $t_font = '//fonts.googleapis.com/css?family=Bitter';
                    $t_family ="'Bitter', serif";
                    break;
                case 'coustard':
                    $t_font = '//fonts.googleapis.com/css?family=Coustard';
                    $t_family ="'Coustard', serif";
                    break;
                case 'droid_serif':
                    $t_font = '//fonts.googleapis.com/css?family=Droid+Serif';
                    $t_family ="'Droid Serif', serif";
                    break;
                case 'eb':
                    $t_font = '//fonts.googleapis.com/css?family=EB+Garamond';
                    $t_family ="'EB Garamond', serif";
                    break;
                case 'goudy':
                    $t_font = '//fonts.googleapis.com/css?family=Goudy+Bookletter+1911';
                    $t_family ="'Goudy Bookletter 1911', serif";
                    break;
                case 'kotta':
                    $t_font = '//fonts.googleapis.com/css?family=Kotta+One';
                    $t_family ="'Kotta One', serif";
                    break;
                case 'playfair':
                    $t_font = '//fonts.googleapis.com/css?family=Playfair+Display';
                    $t_family ="'Playfair Display', serif";
                    break;
                case 'vidaloka':
                    $t_font = '//fonts.googleapis.com/css?family=Vidaloka';
                    $t_family ="'Vidaloka', serif";
                    break;
                case 'pacifico':
                    $t_font = '//fonts.googleapis.com/css?family=Pacifico';
                    $t_family ="'Pacifico', cursive";
                    break;
                case 'dancing_script':
                    $t_font = '//fonts.googleapis.com/css?family=Dancing+Script';
                    $t_family ="'Dancing Script', cursive";
                    break;
                case 'gloria_hallelujah':
                    $t_font = '//fonts.googleapis.com/css?family=Gloria+Hallelujah';
                    $t_family ="'Gloria Hallelujah', cursive";
                    break;
                case 'satisfy':
                    $t_font = '//fonts.googleapis.com/css?family=Satisfy';
                    $t_family ="'Satisfy', cursive";
                    break;
                case 'bad_script':
                    $t_font = '//fonts.googleapis.com/css?family=Bad+Script';
                    $t_family ="'Bad Script', cursive";
                    break;
                case 'allura':
                    $t_font = '//fonts.googleapis.com/css?family=Allura';
                    $t_family ="'Allura', cursive";
                    break;
                case 'roboto':
                    $t_font = '//fonts.googleapis.com/css?family=Roboto+Slab:400,700';
                    $t_family ='"Montserrat", sans-serif';
                    break;
                case 'montstmerrat':
                    $t_font = '//fonts.googleapis.com/css?family=Montserrat:400,700';
                    $t_family = '"Montserrat", sans-serif';
                    break;
                default:
                    $t_font = '//fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic';
                    $t_family = '"Lato", sans-serif';
                    break;
            }
        }
        
        $fonts = array();
        
        if(!empty($font))
        {
            if(!in_array( $font, $fonts))
            {
                $output .= '
                        @import url('.$font.');';
                $fonts[$font] = $font;
            }
            
            $output .= '
                @font-family:  '.$b_family.'; @body-text-font:  '.$b_family.';';
        }
        else
            $output .= '
                    @font-family:  '.$b_family.'; @body-text-font:  '.$b_family.';';

              
        if(!empty($t_font)){
            if(!in_array( $t_font, $fonts))
            {
                $output .= '
                        @import url('.$t_font.');';
                $fonts[$t_font] = $t_font;
            }
            $output .= '
                    @titles-font:  '.$t_family.';';
                    
        }
        else{
            $output .= '
                    @titles-font:  '.$t_family.';';
        }
        
        
        $primary_color = $options[TF_THEME_PREFIX . '_primary_color'];
        $bg_color = $options[TF_THEME_PREFIX . '_bg_color'];
        $sec_bg_color = $options[TF_THEME_PREFIX . '_sec_bg_color'];
        $menu_color = $options[TF_THEME_PREFIX . '_menu_color'];
        $heading_color = $options[TF_THEME_PREFIX . '_heading_color'];
        
        $menu_text_color = $options[TF_THEME_PREFIX . '_menu_text_color'];
        $text_color = $options[TF_THEME_PREFIX . '_text_color'];
        $footer_text_color = $options[TF_THEME_PREFIX . '_footer_text_color'];
        $link_hover = $options[TF_THEME_PREFIX . '_link_hover'];
        
        if(!empty($link_hover))
        {
            $output .= ' '
                    . '@base-color2: '.$link_hover.';
                    ';
        }
        
        if(!empty($footer_text_color))
        {
            $output .= ' '
                    . '@footers_text_color: '.$footer_text_color.';
                       @footer-text-color: '.$footer_text_color.';
                       @footers_link_color: '.$footer_text_color.';
                       @footers_white_color: '.$footer_text_color.';
                    ';
        }

        if(!empty($bg_color))
            $output .= '//** Background color for `<body>`.
                    @body-background: '.$bg_color.';';
//        
        if(!empty($text_color))
        {
            $output .= ' '
                    . '@text-body-color: '.$text_color.';
                    @boxes-text-color: '.$text_color.';
                    @white-color-text: '.$text_color.';
                    @black-color-text: '.$text_color.';
                    ';
        }
        
        if(!empty($menu_text_color))
        {
            $output .= ' @menu-text-color: '.$menu_text_color.';
                        @logos-color: '.$menu_text_color.';
                    ';
        }
        
        if(!empty($sec_bg_color))
        {
            $output .= '
                    @sec-bg-color: '.$sec_bg_color.';'
                    . '@base-color6 : '.$sec_bg_color.';';
        }
           
        if(!empty($primary_color))
        {
            $output .= '
                    @site-footer: '.$primary_color.';
                    @widgets-blue: '.$primary_color.';
                    @main-menu-background: '.$primary_color.';
                    @main-menus-background: '.$primary_color.';
                    @links-blue: '.$primary_color.';
                    ';
        }
//       
        if(!empty($menu_color))
            $output .= '
                @dropdown-menu-background: '.$menu_color.';
                    ';
//
//        
        if(!empty($heading_color))
        {
            $output .= '
                   @heading-color: '.$heading_color.';';
            $output .= '
                    @donation-title-color: '.$heading_color.';
                    @white-title-color:'.$heading_color.';
                    @calendar-title-color:'.$heading_color.';
                ';
        }

        
            //writtte new values in colors.less file
            file_put_contents(get_template_directory().'/less/colors.less', $output);
            
            if(file_exists(get_template_directory().'/less-compiler.php'))
            {
                include get_template_directory().'/less-compiler.php';
                
                $less = new lessc;
                                
                $new_css = $less->compileFile(get_template_directory().'/style.less');
                                                
                //if(!empty($new_css))
                file_put_contents(get_template_directory().'/style.css', $new_css);
            }
        

    }
    add_action('tfuse_admin_save_options', 'tfuse_theme_styles',10,2);
}

if ( !function_exists('tfuse_set_blog_page')):
    function tfuse_set_blog_page(){
        global $wp_query, $is_tf_blog_page;
        if(isset($wp_query->queried_object->ID)) $id_post = $wp_query->queried_object->ID;
        elseif(isset($wp_query->query['page_id'])) $id_post = $wp_query->query['page_id'];
        else $id_post = 0;

        $blog_page_id = tfuse_options('blog_page','');
        if(function_exists('icl_object_id')){
            $id_post = icl_object_id($id_post, 'page', false, 'en');
        }
        if($blog_page_id != 0 && $id_post == $blog_page_id) $is_tf_blog_page = true;
    }
    add_action('wp_head','tfuse_set_blog_page');
endif;