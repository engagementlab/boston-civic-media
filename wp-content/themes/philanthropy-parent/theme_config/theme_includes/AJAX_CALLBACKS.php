<?php 

if (!function_exists('tfuse_ajax_get_posts')) :
    function tfuse_ajax_get_posts(){ 
    
        $post_type = $_POST['post_type'];
        $search_param = $_POST['search_param'];
    
        $max = (intval($_POST['max'])); 
        $pageNum = (intval($_POST['pageNum']));
        $search_key = $_POST['search_key'];
        $allhome = $_POST['allhome'];
        $allblog = $_POST['allblog'];
        $homepage = $_POST['homepage'];
        $cat_ids = $_POST['cat_ids'];           
        $cat_ID = (intval($_POST['id']));
        $is_tax = $_POST['is_tax']; 
        $items = get_option('posts_per_page');  
        
        $pos4 = $pos1 = $pos2= $pos3 =$pos5 = $pos6 = $pos7 = $pos8 = $pos9 = $allpos = $pos = $pos10 =
        $pos11 = $pos12 = $pos13 = $pos14 = $pos15 = $pos16 = $pos17 = '';
        
        $posts = array();
    if($pageNum <= $max) {
        if($homepage == 'homepage' && $allhome == 'nonehomeall')
        {  

            $specific = tfuse_options('categories_select_categ'); 
            if(is_user_logged_in())
            {
                $args = array(
                    'post_status' => array( 'publish','private' ) ,
                            'paged' => $pageNum,
                            'cat' => $specific
                );
            }
            else 
            {
                $args = array(
                    'post_status' => array( 'publish') ,
                            'paged' => $pageNum,
                            'cat' => $specific
                );
            }
                
            $query = new WP_Query($args);
            $posts = $query->posts; 
        }
        elseif($homepage == 'blogpage' && $allblog == 'allblogcategories')
        { 
            if(is_user_logged_in())
            {
                $args = array(
                    'post_status' => array( 'publish','private' ) ,
                    'paged' => $pageNum,
                    'post_type' => 'post'
                );
            }
            else
            {
                $args = array(
                    'post_status' => array( 'publish' ) ,
                    'paged' => $pageNum,
                    'post_type' => 'post'
                );
            }
            
            $query = new WP_Query( $args );
            $posts = $query -> posts; 
        }
        elseif($homepage == 'blogpage' && $allblog == 'noneblogall')
        { 
            $specific = tfuse_options('categories_select_categ_blog'); 
                $args = array(
                    'paged' => $pageNum,
                    'cat' => $specific
                );
                
            $query = new WP_Query( $args );
            $posts = $query -> posts; 
        }
        elseif(($homepage == 'homepage') && ($allhome == 'allhomecategories'))
        { 
            if(is_user_logged_in())
            {
                $args = array(
                    'post_status' => array( 'publish','private' ) ,
                    'paged' => $pageNum,
                    'post_type' => 'post'
                );
            }
            else 
            {
                $args = array(
                    'post_status' => array( 'publish') ,
                            'paged' => $pageNum,
                            'cat' => $cat_ids
                );
            }
                
            $query = new WP_Query($args);
            $posts = $query->posts; 
        }
        
        elseif($is_tax == 'category')
        { 
            if(is_user_logged_in())
            {
                $query = new WP_Query(array('post_status' => array( 'publish','private' ) , 'cat' => $cat_ID,'paged' => $pageNum));
            }
            else
            {
                $query = new WP_Query(array('post_status' => array( 'publish' ) , 'cat' => $cat_ID,'paged' => $pageNum));
            }
            $posts = $query->posts;
        }
        elseif($is_tax == 'galleries')
        { 
            if(is_user_logged_in())
            {
                $args = array(
                    'post_status' => array( 'publish','private' ),
                        'paged' => $pageNum,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'galleries',
                                'field' => 'id',
                                'terms' => $cat_ID
                            )
                        )
                );
            }
            else
            {
                $args = array(
                    'post_status' => array( 'publish' ),
                        'paged' => $pageNum,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'galleries',
                                'field' => 'id',
                                'terms' => $cat_ID
                            )
                        )
                );
            }
           $query = new WP_Query( $args );
           $posts = $query->posts;
        }
        elseif($is_tax == 'projects')
        {
            if(is_user_logged_in())
            {
                $args = array(
                    'post_status' => array( 'publish','private' ),
                        'paged' => $pageNum,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'projects',
                                'field' => 'id',
                                'terms' => $cat_ID
                            )
                        )
                );
            }
            else
            {
                $args = array(
                    'post_status' => array( 'publish' ),
                        'paged' => $pageNum,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'projects',
                                'field' => 'id',
                                'terms' => $cat_ID
                            )
                        )
                );
            }
           $query = new WP_Query( $args );
           $posts = $query->posts;
        }
        elseif($is_tax == 'search') 
        { 
            $query = new WP_Query(array('post_status' => array( 'publish' ) , 's' => $search_key ,'paged' => $pageNum));
                
            $posts = $query->posts;
        }
        
        $cnt = 0; 
        foreach($posts as $post)
        { 
            $cnt++;
            //get date format
            $d = get_option('date_format');
            //get comments number
            $num_comments = get_comments_number($post->ID);
            if ( $num_comments == 0 ) {
                $comments = __('No Comments','tfuse');
            } elseif ( $num_comments > 1 ) {
                    $comments = $num_comments . __(' Comments','tfuse');
            } else {
                    $comments = __('1 Comment','tfuse');
            }
            
            if($is_tax == 'galleries')
            { 
                $image = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'post-thumbnails'));
                $gallery = tfuse_page_options('gallery','',$post->ID);
                
                $pos1 .='<li class="gallery-item">';
                            if(!empty($image)):
                            $pos2.='<div class="gallery-img">
                                    <a href="'.$image.'" class="see-more-gallery" data-rel="prettyPhoto['.$post->ID.']" title="'.$post->post_title.'">
                                        <span>'.__('More','tfuse').'</span>
                                    </a>
                                    <img src="'.TF_GET_IMAGE::get_src_link($image, 270, 270).'" alt="">
                                </div>';
                                if(!empty($gallery)):
                                    $pos3 .='<div class="gallery-array">';
                                        foreach ($gallery as $img):
                                            $pos4 .='<a href="'.$img['url'].'"  data-rel="prettyPhoto['.$post->ID.']" title="'.$img['title'].'"> </a>';
                                        endforeach;
                                $pos5 .='</div>';
                                endif;
                           endif;
                            $pos5 .='<span class="title"><a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a></span>
                        </li>';
                
                $pos = $pos1.$pos2.$pos3.$pos4.$pos5;
                $pos1 = $pos2 = $pos3 = $pos4 = $pos5 = '';
            }
            elseif($is_tax == 'projects')
            {                
                $image = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'post-thumbnails'));
                
                $pos5 .='<div class="col-md-6 col-sm-6 col-xs-12 clearfix">
                            <div class="post">
                                <div class="inner">
                                    <div class="entry-aside">
                                        <header class="entry-header">
                                            <h1 class="entry-title"><a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a> </h1>
                                        </header>
                                        <div class="divider"></div>
                                        <div class="entry-content">';
                                            $pos6 .= (!empty($post->post_excerpt)) ? '<p>'.$post->post_excerpt.'</p>' : '<p>'.strip_tags(tfuse_shorten_string(apply_filters('the_content',$post->post_content),50)).'</p>';
                                    $pos7.='</div>
                                    </div>
                                    <div class="post-thumbnail">';
                                        if(!empty($image)):
                                            $pos8.='<a href="'.get_permalink($post->ID).'" class="post-thumbnail-image"><span>'.__('More','tfuse').'</span></a>
                                            <img src="'.$image.'" alt="'.$post->post_title.'">';
                                        endif;
                                $pos9.='</div>
                                </div>
                            </div>
                        </div>';
                
                $pos = $pos5.$pos6.$pos7.$pos8.$pos9;
                $pos5 = $pos6 = $pos7 =  $pos8 = $pos9 = '';
            }
            elseif($is_tax == 'category')
            { 
                $image = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'post-thumbnails'));
                
                $art_type = tfuse_page_options('article_type','',$post->ID);

                if(!empty($image))
                {
                    if($art_type == 'post-style-4' || $art_type == 'post-style-3') $image = TF_GET_IMAGE::get_src_link($image, 270, 380);
                    elseif ($art_type == 'post-style-1' || $art_type == 'post-style-2') $image = TF_GET_IMAGE::get_src_link($image, 269, 267);
                }
                
                $user_data = get_user_by('id',$post->post_author);

                                
                $pos11 .='<article class="post '.$art_type.'">
                                <div class="entry-aside">
                                    <header class="entry-header">';

                                        if($art_type != 'post-style-7'):
                                            if(!empty($image)):
                                            $pos12.='<div class="post-thumbnail">
                                                    <a href="'.get_permalink($post->ID).'" class="post-thumbnail-image">
                                                        <span>'.__('More','tfuse').'</span>
                                                    </a>
                                                    <img src="'.$image.'" alt="">
                                                </div>';
                                            endif;
                                        endif;

                                    $pos13.='<div class="entry-meta">
                                            <time class="entry-date" datetime="">'.get_the_time( $d, $post->ID ).'</time>
                                            <span class="author"> '.__('by ','tfuse'). '<a href="'.get_author_posts_url( $post->post_author, $user_data->data->user_nicename ).'">'.$user_data->data->user_nicename.'</a></span>
                                            <span class="cat-links"> '.__('in','tfuse').' '.tfuse_cat_links($post->post_type,$post->ID).'</span>
                                            <h2 class="entry-title"><a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a></h2>';
                                            if($art_type == 'post-style-7'):
                                                if(!empty($image)):
                                                $pos14.='<div class="post-thumbnail">
                                                        <a href="'.get_permalink($post->ID).'" class="post-thumbnail-image">
                                                            <span>'.__('More','tfuse').'</span>
                                                        </a>
                                                        <img src="'.$image.'" alt="">
                                                    </div>';
                                                endif;
                                            endif;
                                    $pos15.='</div>
                                    </header>
                                    <div class="entry-content">';
                                        $pos16 .= (!empty($post->post_excerpt)) ? '<p>'.$post->post_excerpt.'</p>' : '<p>'.strip_tags(tfuse_shorten_string(apply_filters('the_content',$post->post_content),50)).'</p>';
                                    $pos17 .='</div>
                                    <footer class="entry-meta clearfix">
                                        <a href="'.get_permalink($post->ID).'" class="btn btn-yellow btn-read-more"><span>'.__('Read More','tfuse').'</span></a>
                                        <a href="'.get_permalink($post->ID).'#comments" class="btn btn-transparent link-comment"><span>'.$comments.'</span></a>
                                    </footer>
                                </div>
                            </article>';
                
                $pos = $pos11.$pos12.$pos13.$pos14.$pos15.$pos16.$pos17;
                $pos11 = $pos12 = $pos13 = $pos14 = $pos15 = $pos16 = $pos17 = '';
            }
            elseif($is_tax == 'search')
            {
                $img = tfuse_page_options('thumbnail_image',null,$post->ID);
                if(tfuse_options('disable_listing_lightbox'))
                {
                    $image = '<a href="'.$img.'" rel="prettyPhoto[gallery'.$post->ID.']">
                                <img src="'.$img.'" height="200" width="220" alt="">
                            </a>';
                }
                else
                {
                    $image = '<a href="'.get_permalink( $post->ID ).'"><img src="'.$img.'" height="200" width="220" alt="" ></a>';
                }
                
                $pos1 .='<div class="post-item clearfix">
                            <div class="post-image">'.$image.'</div>
                            <div class="post-meta">';
                                if ( tfuse_options('date_time')) :
                                    $pos2 .='<span class="post-date">'.get_the_time( $d, $post->ID ).'</span> &nbsp;|&nbsp;'; 
                                endif;
                                $pos3 .='<a href="' . get_comments_link($post->ID) .'" class="link-comments">'.$comments.'</a>
                            </div>
                            <div class="post-title">
                                <h3><a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a></h3>
                            </div>
                            <div class="post-descr entry">
                                <p>'.strip_tags(tfuse_shorten_string(apply_filters('the_content',$post->post_content),30)).'</p>
                            </div>
                            <div class="post-more"><a href="'.get_permalink($post->ID).'">'.__('READ THE ARTICLE','tfuse').'</a></div>
                        </div>';
                $pos = $pos1.$pos2.$pos3;
                $pos1 = $pos2 = $pos3 = '';
            }
                $allpos[] = $pos;
        }
        $rsp = array('html'=> $allpos,'items' => $items,'posts'=> $posts); 
        echo json_encode($rsp);
    }
        die();
    }
    add_action('wp_ajax_tfuse_ajax_get_posts','tfuse_ajax_get_posts');
    add_action('wp_ajax_nopriv_tfuse_ajax_get_posts','tfuse_ajax_get_posts');
endif;

if (!function_exists('tfuse_object_to_array')) :
    function tfuse_object_to_array($data)
    {
        if (is_array($data) || is_object($data))
        {
            $result = array();
            foreach ($data as $key => $value)
            {
                $result[$key] = tfuse_object_to_array($value);
            }
            return $result;
        }
        return $data;
    }
endif;



if (!function_exists('tfuse_rewrite_worpress_reading_options')):

    /**
     *
     *
     * To override tfuse_rewrite_worpress_reading_options() in a child theme, add your own tfuse_rewrite_worpress_reading_options()
     * to your child theme's file.
     */

    add_action('tfuse_admin_save_options','tfuse_rewrite_worpress_reading_options', 10, 1);

    function tfuse_rewrite_worpress_reading_options ($options)
    {
        if($options[TF_THEME_PREFIX . '_homepage_category'] == 'page')
        {
            update_option('show_on_front', 'page');
            update_option('page_on_front', intval($options[TF_THEME_PREFIX . '_home_page']));
        }
        else
        {
            update_option('show_on_front', 'posts');
            update_option('page_on_front', 0);
        }
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

if ( !function_exists('tfuse_cat_links')):
    function tfuse_cat_links($post_type,$id){
        if($post_type == 'post')
            return get_the_term_list($id,'category', '', ', ' );
        elseif($post_type == 'gallery')
            return get_the_term_list($id,'galleries', '', ', ' );
        elseif($post_type == 'event')
            return get_the_term_list($id,'events', '', ', ' );
        elseif($post_type == 'project')
            return get_the_term_list($id,'projects', '', ', ' );

    }
endif;

if (!function_exists('tfuse_archive_events')) :
    function tfuse_archive_events()
    {
        global $q_config;

        if( isset( $_POST['lang'] ) && !empty( $_POST['lang'] ) ) {
            $q_config['language'] = $_POST['lang'];
        }

        $cat_ID = (intval($_POST['id']));
        $hour = $end_hour = $repeat = $date = '';
        $args = array(
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'events',
                    'field' => 'id',
                    'terms' => $cat_ID
                )
            )
        );
        $query = new WP_Query( $args );
        $posts = $query -> posts;
        //tf_print($posts);
        if(!empty($posts))
        {
            $all = $events = $hours = $repeats = $titles = $links = array();
            $count = 0;
            foreach($posts as $post){
                $date = tfuse_page_options('event_date','',$post->ID);
                if(!empty($date))
                {

                    $event_hour = tfuse_page_options('event_hour_min', false, $post->ID);
                    $end_event_hour = tfuse_page_options('end_hour_min', false, $post->ID);
                    if(!empty($event_hour))
                        $hour .= $event_hour['hour'].':'.$event_hour['minute'].' '.$event_hour['time'];

                    if(!empty($end_event_hour))
                        $end_hour .= ' - '.$end_event_hour['hour'].':'.$end_event_hour['minute'].' '.$end_event_hour['time'];
                    else $end_hour = '';

                    //repeat event
                    $repeat = tfuse_page_options('event_repeat','',$post->ID);
                    if($repeat != 'no')
                        $repeats[$post->ID] = tfuse_page_options('event_repeat','no',$post->ID);

                    $from = $date;
                    $post_title = get_the_title($post->ID);
                    $permalink = get_permalink($post->ID);
                    $event_type = tfuse_page_options('event_type', '', $post->ID);

                    if($repeat == 'year')
                    {
                        $date = new DateTime($from);
                        $year = (int)$date->format('Y');
                        $month = $date->format('m');
                        $day = $date->format('d');
                        for($i=0;$i<10;$i++)
                        {
                            $all[$count]['event_id'] = $post->ID;
                            $all[$count]['event_date'] = $event_date = $year+$i.'-'.$month.'-'.$day;

                            
                            if(strpos($permalink, "?") === false){
                                $permalink = $permalink.'?date='.$event_date;
                            }
                            else{
                                $permalink = $permalink.'&date='.$event_date;
                            }
                            
                            $event_start = $event_date.' '.$hour;
                            $event_start = strtotime($event_start) . '000';
                            $events[] = array(
                                'id' => $post->ID,
                                'title' => $post_title,
                                'url' => $permalink,
                                'class' => $event_type,
                                'start' => $event_start,
                            );
                            ++$count;
                        }
                    }
                    elseif($repeat == 'month')
                    {
                        $day = strtotime($from);
                        for($i=0;$i<10;$i++)
                        {
                            $to = strtotime(date("Y-m-d", $day) . " +".$i." month");
                            
                            $all[$count]['event_id'] = $post->ID;
                            $all[$count]['event_date'] = $event_date =  date("Y-m-d", $to);
                            
                            if(strpos($permalink, "?") === false){
                                $permalink = $permalink.'?date='.$event_date;
                            }
                            else{
                                $permalink = $permalink.'&date='.$event_date;
                            }
                            $event_start = $event_date.' '.$hour;
                            $event_start = strtotime($event_start) . '000';
                            $events[] = array(
                                'id' => $post->ID,
                                'title' => $post_title,
                                'url' => $permalink,
                                'class' => $event_type,
                                'start' => $event_start,
                            );
                            ++$count;
                        }
                    }
                    elseif($repeat == 'week')
                    {
                        $day = strtotime($from);
                        for($i=0;$i<53;$i++)
                        {
                            $to = strtotime(date("Y-m-d", $day) . " +".$i." weeks");
                            
                            $all[$count]['event_id'] = $post->ID;
                            $all[$count]['event_date'] = $event_date = date("Y-m-d", $to);
                            
                            if(strpos($permalink, "?") === false){
                                $permalink = $permalink.'?date='.$event_date;
                            }
                            else{
                                $permalink = $permalink.'&date='.$event_date;
                            }
                            $event_start = $event_date.' '.$hour;
                            $event_start = strtotime($event_start) . '000';
                            $events[] = array(
                                'id' => $post->ID,
                                'title' => $post_title,
                                'url' => $permalink,
                                'class' => $event_type,
                                'start' => $event_start,
                            );
                            ++$count;
                        }
                    }
                    elseif($repeat == 'day')
                    {
                        $day = strtotime($from);
                        for($i=0;$i<365;$i++)
                        {
                            $to = strtotime(date("Y-m-d", $day) . " +".$i." days");
                            
                            $all[$count]['event_id'] = $post->ID;
                            $all[$count]['event_date'] = $event_date = date("Y-m-d", $to);
                            
                            if(strpos($permalink, "?") === false){
                                $permalink = $permalink.'?date='.$event_date;
                            }
                            else{
                                $permalink = $permalink.'&date='.$event_date;
                            }
                            $event_start = $event_date.' '.$hour;
                            $event_start = strtotime($event_start) . '000';
                            $events[] = array(
                                'id' => $post->ID,
                                'title' => $post_title,
                                'url' => $permalink,
                                'class' => $event_type,
                                'start' => $event_start,
                            );
                            ++$count;
                        }
                    }
                    else
                    {
                        $all[$count]['event_id'] = $post->ID;
                        $all[$count]['event_date'] = $event_date = tfuse_page_options('event_date','',$post->ID);
                        
                        if(strpos($permalink, "?") === false){
                            $permalink = $permalink.'?date='.$event_date;
                        }
                        else{
                            $permalink = $permalink.'&date='.$event_date;
                        }
                        $event_start = $event_date.' '.$hour;
                        $event_start = strtotime($event_start) . '000';
                        $events[] = array(
                            'id' => $post->ID,
                            'title' => $post_title,
                            'url' => $permalink,
                            'class' => $event_type,
                            'start' => $event_start,
                        );
                        ++$count;
                    }
                    $hour = $end_hour = "";
                }
            }
            update_option(TF_THEME_PREFIX.'_all_array_events_'.$cat_ID, $all);
            
            $response = json_encode($events);
            echo $response;
            die();
        }
        else
        {
            echo '';
            die();
        }
    }
    add_action('wp_ajax_tfuse_archive_events','tfuse_archive_events');
    add_action('wp_ajax_nopriv_tfuse_archive_events','tfuse_archive_events');
endif;


if(!function_exists('tf_is_real_post_save')){
    /**
     * This function is used in 'post_updated' action
     *
     * @param $post_id
     * @return bool
     */
    function tf_is_real_post_save($post_id)
    {
        return !(
            wp_is_post_revision($post_id)
            || wp_is_post_autosave($post_id)
            || (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            || (defined('DOING_AJAX') && DOING_AJAX)
        );
    }
}


if (!function_exists('tfuse_find_hour')) :
    function tfuse_find_hour($post_id)
    {
        global $TFUSE;

        if (!tf_is_real_post_save($post_id)) {
            return;
        }

        $time = array(
            'hour'   => $TFUSE->request->post(TF_THEME_PREFIX.'_event_hour'),
            'minute' => $TFUSE->request->post(TF_THEME_PREFIX.'_event_minute'),
            'time'   => $TFUSE->request->post(TF_THEME_PREFIX.'_event_time'),
        );
        tfuse_set_page_option('event_hour_min', $time, $post_id);

        $endtime = array(
            'hour'   => $TFUSE->request->post(TF_THEME_PREFIX.'_event_hour_end'),
            'minute' => $TFUSE->request->post(TF_THEME_PREFIX.'_event_minute_end'),
            'time'   => $TFUSE->request->post(TF_THEME_PREFIX.'_event_time_end'),
        );
        tfuse_set_page_option('end_hour_min', $endtime, $post_id);
    }
    add_action( 'save_post_event', 'tfuse_find_hour' );
endif;


add_theme_support( 'post-thumbnails');


add_action( 'init', 'tfuse_remove_thumbnail_support' );
function tfuse_remove_thumbnail_support() {
	remove_post_type_support( 'page', 'thumbnail' );
	remove_post_type_support( 'event', 'thumbnail' );
}

add_image_size( 'feature-image', 9999, 9999, true ); 
add_image_size( 'medium-thumb', 200, 200, true );
add_image_size( 'similar_posts', 371, 234, true );


if (!function_exists('tfuse_filter_seo_title')) :
    function tfuse_filter_seo_title($title)
    {       
        return strip_tags($title);
    }
    add_filter('wp_title','tfuse_filter_seo_title',11);
endif;