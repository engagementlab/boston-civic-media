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

function tfuse_footer_tweet($atts, $content = null)
{
    extract(shortcode_atts(array(
            'username' => '',
            'title' => '',
            'post_date' => '',
    ), $atts));
    
    $return_html = '';
   if ( !empty($username) )
    {
        $tweets = tfuse_get_tweets($username,1);
        if(!sizeof($tweets)) return;

        $return_html .= '<div class="col-lg-4  col-md-4 col-sm-6 col-xs-6">'
                . '<div class="widget widget_twitter">';
            if(!empty($title)) $return_html .='<h3 class="widget-title">'.$title.'</h3> ';
                                
                                
    $return_html .='<div class="tweet_list">';
    
    foreach ( $tweets as $tweet )
    {
            if( isset($tweet->text) )
            { 
                $return_html .= '<div class="tweet_item">
                                    <div class="tweet_image">
                                    </div>
                                    <div class="tweet_text">
                                          <div class="inner">
                                              '.$tweet->text.'
                                              <div class="meta-tweet">
                                                    <i class="icon-twitter-sign"></i>
                                                    <span class="tweet-time">'.$tweet->created_at.'</span>
                                                    <span class="tweet-author">'.__('By','tfuse').': <a href="'.$tweet->user->url.'">@'.$tweet->user->name.'</a></span>
                                              </div>
                                          </div>
                                    </div>
                              </div>' ;
            }
    }               
                  
    $return_html .='</div></div></div>';

    }

    return $return_html;
}

$atts = array(
    'name' => __('Footer Tweet','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 11,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Specifies the title of an shortcode','tfuse'),
            'id' => 'tf_shc_footer_tweet_title',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Username','tfuse'),
            'desc' => __('Twitter username','tfuse'),
            'id' => 'tf_shc_footer_tweet_username',
            'value' => '',
            'type' => 'text'
        )
    )
);

tf_add_shortcode('footer_tweet', 'tfuse_footer_tweet', $atts);
