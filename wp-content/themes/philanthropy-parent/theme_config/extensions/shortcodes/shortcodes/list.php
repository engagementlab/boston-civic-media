<?php

/**
 * List Styles
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 */

function tfuse_list($atts, $content = null)
{
    extract( shortcode_atts(array('type' => ''), $atts) );
    
    switch($type)
    {
        case 'minus': $class = 'list-minus'; break;
        case 'links': $class = 'list-external-link'; break;
        case 'files': $class = 'list-file-text'; break;
        case 'plus': $class = 'list-plus'; break;
        case 'ok': $class = 'list-ok'; break;
        case 'videos': $class = 'list-video'; break;
        case 'caret': $class = 'list-caret-right'; break;
        case 'stars': $class = 'list-star'; break;
        case 'images': $class = 'list-image'; break;
        case 'chevron': $class = 'list-chevron-sign-right'; break;
        case 'folders': $class = 'list-folder'; break;
        case 'games': $class = 'list-game'; break;
        case 'bordered_chevron': $class = 'list-chevron-sign-right list-bordered'; break;
        default: $class = 'list-ok';break;
    }
    
    
    return '<div class="'.$class.'">' . do_shortcode($content) . '</div>';
}

$atts = array(
    'name' => __('List', 'tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.', 'tfuse'),
    'category' => 2,
    'options' => array(
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('List type','tfuse'),
            'desc' => __('Select list type','tfuse'),
            'id' => 'tf_shc_list_type',
            'value' => '',
            'options' => array(
                'minus' => __('Minus list','tfuse'),
                'links' => __('Links','tfuse'),
                'files' => __('Files list','tfuse'),
                'plus' => __('Plus list','tfuse'),
                'ok' => __('Ok list','tfuse'),
                'videos' => __('Videos list','tfuse'),
                'caret' => __('Caret list','tfuse'),
                'stars' => __('Stars list','tfuse'),
                'images' => __('Images list','tfuse'),
                'chevron' => __('Chevron list','tfuse'),
                'folders' => __('Folders list','tfuse'),
                'games' => __('Games list','tfuse'),
                'bordered_chevron' => __('Bordered Chevron List list','tfuse'),
            ),
            'type' => 'select'
        ),
        array(
            'name' => __('Content', 'tfuse'),
            'desc' => __('Use the &lt;ul&gt; tag together with the &lt;li&gt; tag to create check lists', 'tfuse'),
            'id' => 'tf_shc_list_content',
            'value' => '
                <ul>
                    <li>List item 1</li>
                    <li>List item 2</li>
                    <li>List item 3</li>
                </ul>
            ',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('list', 'tfuse_list', $atts);