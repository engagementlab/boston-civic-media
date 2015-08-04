<?php
//Recent / Most Commented Widget

function tfuse_tabs_posts($atts) {   
    extract(shortcode_atts(array('num' => ''), $atts));
    
    $recent_posts  = tfuse_shortcode_posts_tabs(array(
                                'sort' => 'recent',
                                'items' => 5,
                                'image_post' => true,
                                'image_width' => 80,
                                'image_height' => 80,
                                'image_class' => ''
                                ));
        
    $popular_posts = tfuse_shortcode_posts_tabs(array(
                                'sort' => 'popular',
                                'items' => 5,
                                'image_post' => true,
                                'image_width' => 80,
                                'image_height' => 80,
                                'image_class' => ''
                            ));
    
    $commented_posts = tfuse_shortcode_posts_tabs(array(
                                'sort' => 'commented',
                                'items' => 5,
                                'image_post' => true,
                                'image_width' => 80,
                                'image_height' => 80,
                                'image_class' => ''
                            ));
    
    $return_html = '';
    $return_html .='<div class="widget widget_tabs">
        <ul class="nav nav-tabs nav-justified clearfix active_bookmark1">
            <li class="active"><a href="#tab_cont_1_1" data-toggle="tab">'.__('Popular','tfuse').'</a></li>
            <li><a href="#tab_cont_1_2" data-toggle="tab">'.__('Latest','tfuse').'</a></li>
            <li><a href="#tab_cont_1_3" data-toggle="tab">'.__('Recent comments','tfuse').'</a></li>
        </ul><div class="tab-content clearfix">';

    $return_html .= '<div id="tab_cont_1_1" class="tab-pane fade in active">
                    <ul class="side-postlist">';
                       $k=0; foreach ($popular_posts as $post_val) { 
                            if($k == $num) break;
                                                   
                            $return_html .= '<li>';
                            $return_html .= '
                                        ' . ' <a href="' . $post_val['post_link'] . '" class="post-thumbnail">' . $post_val['post_img'] . '</a> ';
                            $return_html .= '<span class="date">'.$post_val['post_date_post'].'</span>
                                    <h3 class="title"><a href="' . $post_val['post_link'] . '">&nbsp;' . $post_val['post_title'] . '</a></h3>
                                        ';
                            $return_html .='<a href="' . $post_val['post_link'] . '" class="right-arrow"><i class="icon-chevron-right"></i></a>';
                           
                            $k++;
                        }
    $return_html .='</ul>
        </div>

        <div id="tab_cont_1_2" class="tab-pane fade">
            <ul class="side-postlist">';
                       $c=0; foreach ($recent_posts as $post_val) {
                           if($c == $num) break;
                           
                            $return_html .= '<li>';
                            $return_html .= '
                                        ' . ' <a href="' . $post_val['post_link'] . '" class="post-thumbnail">' . $post_val['post_img'] . '</a> ';
                            $return_html .= '<span class="date">'.$post_val['post_date_post'].'</span>
                                    <h3 class="title"><a href="' . $post_val['post_link'] . '">&nbsp;' . $post_val['post_title'] . '</a></h3>
                                        ';
                            $return_html .='<a href="' . $post_val['post_link'] . '" class="right-arrow"><i class="icon-chevron-right"></i></a>';
                                                       
                            $c++;
                        }
     $return_html .= '</ul>
         </div>';
     $return_html .= '<div id="tab_cont_1_3" class="tab-pane fade">
                    <ul class="side-postlist">';
                       $z = 0; foreach ($commented_posts as $post_val) { 
                            if($z == $num) break;
                                                   
                            $return_html .= '<li>';
                            $return_html .= '
                                        ' . ' <a href="' . $post_val['post_link'] . '" class="post-thumbnail">' . $post_val['post_img'] . '</a> ';
                            $return_html .= '<span class="date">'.$post_val['post_date_post'].'</span>
                                    <h3 class="title"><a href="' . $post_val['post_link'] . '">&nbsp;' . $post_val['post_title'] . '</a></h3>
                                        ';
                            $return_html .='<a href="' . $post_val['post_link'] . '" class="right-arrow"><i class="icon-chevron-right"></i></a>';
                           
                            $z++;
                        }
    $return_html .='</ul>
        </div>
        </div>
    </div>';
    return $return_html;
}

$atts = array(
    'name' => __('Tab Posts','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 2,
    'options' => array(
        array(
            'name' => __('Number of posts','tfuse'),
            'desc' => __('Number of posts to display','tfuse'),
            'id' => 'tf_shc_tabs_posts_num',
            'value' => '',
            'type' => 'text'
        ),
    )
);

tf_add_shortcode('tabs_posts','tfuse_tabs_posts', $atts);