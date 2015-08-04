<?php

/**
 * Twitter
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 * 
 * Optional arguments:
 * items: 5
 * username:
 * title:
 * post_date:
 */

function tfuse_twitter($atts, $content = null)
{
    extract(shortcode_atts(array(
            'items' => 5,
            'username' => '',
            'title' => '',
            'position' => '',
            'post_date' => '',
            'style' => ''
    ), $atts));
    
    $return_html = '';
   if ( !empty($username) )
    {
        $tweets = tfuse_get_tweets($username,$items);
        if(!sizeof($tweets)) return;

        
            if($style == 'style1')
            {
                $return_html .= '<div class="widget twitter">';
                
                            if(!empty($title)) $return_html .'<h2>'.$title.'</h2> ';
                
                    $return_html .='<ul>';
                foreach ( $tweets as $tweet )
                {
                    if( isset($tweet->text) )
                    { 
                        $return_html .= '<li>'
                                            .$tweet->text.
                                        '</li>' ;
                    }
                }

                $return_html .= '</ul></div>';
            }
            else
            {
                $return_html .= '<div class="widget widget_twitter">
                                <h3 class="widget-title">'.$title.'</h3>

                                <div class="tweet_list">';
                                    foreach ( $tweets as $tweet )
                                    {
                                        $return_html .= '<div class="tweet_item">';
                                        
                                        $return_html .= '<div class="tweet_image"><img src="'.$tweet->user->profile_image_url.'" width="30" height="30" alt="" /></div>';
                                        if( isset($tweet->text) )
                                        { 
                                            $return_html .= '<div class="tweet_text">
                                            <div class="inner">
                                                '.$tweet->text.'
                                                </div>
                                            </div>' ;
                                        }
                                        $return_html .='</div>';
                                    }
                                    
                                $return_html .='</div>
                            </div>';
            }

        
    }

    return $return_html;
}

$atts = array(
    'name' => __('Twitter','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 11,
    'options' => array(
         array(
            'name' => __('Styles','tfuse'),
            'desc' => __('Twitter Style','tfuse'),
            'id' => 'tf_shc_twitter_style',
            'value' => '',
             'options' => array('style1' => __('Style 1','tfuse'),'style2' => __('Style 2','tfuse')),
            'type' => 'select'
        ),
        array(
            'name' => __('Items','tfuse'),
            'desc' => __('Enter the number of tweets','tfuse'),
            'id' => 'tf_shc_twitter_items',
            'value' => '5',
            'type' => 'text'
        ),
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Specifies the title of an shortcode','tfuse'),
            'id' => 'tf_shc_twitter_title',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Username','tfuse'),
            'desc' => __('Twitter username','tfuse'),
            'id' => 'tf_shc_twitter_username',
            'value' => '',
            'type' => 'text'
        )
    )
);

tf_add_shortcode('twitter', 'tfuse_twitter', $atts);
