<?php
function tfuse_recent_posts($atts, $content = null)
{
  
    $return_html = '';
    extract(shortcode_atts(array(
                                'items' => 5,
                           ), $atts));

    $latest_posts = tfuse_shortcode_posts(array(
                                               'sort' => 'recent',
                                               'items' => $items,
                                               'image_post' => false,
                                                'date_format'=> 'F jS,Y',
                                               'date_post' => true,
                                          ));
    $return_html .= '
    <div class="widget recent-posts">
            <ul>';
    foreach ($latest_posts as $post_val):
        $return_html .= '<li>';
        $return_html .= '
            <a href="' . $post_val['post_link'] . '" class="entry-title">' . $post_val['post_title'] . '</a>';
        $return_html .= '<div class="entry-meta">
                            <time class="entry-date" datetime="">'.$post_val['post_date_post'].'</time>
                            <a href="'.$post_val['post_link'].'#comments" class="comments-link"><span>'.tfuse_get_comments(true,$post_val['post_id'] ).'</span></a>
                        </div>';
        $return_html .= '</li>';
    endforeach;
    $return_html .='</ul></div> ';

    return $return_html;
}

$atts = array(
    'name' => __('MG Recent Posts','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 11,
    'options' => array(
        array(
            'name' => __('Items','tfuse'),
            'desc' => __('Specifies the number of the post to show','tfuse'),
            'id' => 'tf_shc_recent_posts_items',
            'value' => '5',
            'type' => 'text'
        )
    )
);

tf_add_shortcode('recent_posts', 'tfuse_recent_posts', $atts);
