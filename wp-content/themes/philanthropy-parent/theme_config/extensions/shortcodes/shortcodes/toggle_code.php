<?php

/**
 * Toggle Content
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 */

function tfuse_toggle_content($atts, $content = null)
{
    extract(shortcode_atts(array('title' => '', 'class' => '','box'=>'','type'=>''), $atts));
    $uniq = rand(1,100);
    if($box == 'opened') $b = 'opened';
    else $b = 'closed';
        
    if (empty($title))
        $title = __('Toggle Content (click to open)', 'tfuse');
    if($type == 'default')
    {
        return ' <div class="panel '.$class.' toggleitem boxed '.$b.'">
                        <div class="panel-heading"><h4 class="panel-title"><a class="panel-toggle" data-toggle="collapse" href="#toggleOne'.$uniq.'">' . $title . '<span class="icon icon-toggle"></span></a></h4>
                            </div>
                            <div id="toggleOne'.$uniq.'" class="panel-collapse collapse">
                                <div class="panel-body"> ' . do_shortcode($content) . '</div>
                            </div>
                        </div>';
    }
    elseif($type == 'simple')
    {
        return '<div class="'.$class.' toggleitem '.$b.'">
                    <a class="panel-toggle" data-toggle="collapse" href="#toggleThree'.$uniq.'">'.$title.'<span class="icon icon-toggle"></span></a>
                    <div id="toggleThree'.$uniq.'" class="panel-collapse collapse">
                        ' . do_shortcode($content) . ' </div>
                </div>';
    }  
    elseif($type =='accordion') {
        return '
            <div class="panel '.$class.'">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$uniq.'">
                            '.$title.'
                        </a>
                    </h4>
                </div>
                <div id="collapse'.$uniq.'" class="panel-collapse collapse">
                    <div class="panel-body">
                    ' . do_shortcode($content) . ' 
                    </div>
                </div>
            </div>';
    }
}

$atts = array(
    'name' => __('Toggle Content','tfuse'),
    'desc' =>__('Here comes some lorem ipsum description for the box shortcode.','tfuse') ,
    'category' => 8,
    'options' => array(
        array(
            'name' => __('Toggle type','tfuse'),
            'desc' => __('Select toggle type','tfuse'),
            'id' => 'tf_shc_toggle_content_type',
            'value' => '',
            'options' => array(
                'default' => __('Default toggle','tfuse'),
                'simple' => __('Simple Toggle','tfuse'),
                'accordion' => __('Accordion Toggle','tfuse'),
            ),
            'type' => 'select'
        ),
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Specifies the title of an shortcode','tfuse'),
            'id' => 'tf_shc_toggle_content_title',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Box','tfuse'),
            'desc' => __('Default opened/closed box','tfuse'),
            'id' => 'tf_shc_toggle_content_box',
            'value' => 'closed',
            'options' => array(
                'closed' => __('Closed box','tfuse'),
                'opened' => __('Opened box','tfuse'),
            ),
            'type' => 'select'
        ),
        array(
            'name' => __('Class','tfuse'),
            'desc' => __('Specifies one or more class names for an shortcode:panel-default, panel-primary, panel-success, panel-warning, panel-danger, panel-info, panel-pink, panel-teal, panel-orange, panel-purple, panel-brown, panel-black','tfuse'),
            'id' => 'tf_shc_toggle_content_class',
            'value' => '',
            'type' => 'text'
        ),
        /* add the fllowing option in case shortcode has content */
        array(
            'name' =>__('Content','tfuse'),
            'desc' => __('Enter shortcode content','tfuse'),
            'id' => 'tf_shc_toggle_content_content',
            'value' => '',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('toggle_content', 'tfuse_toggle_content', $atts);


class TFUSE_Code_Shortcode {

    static $add_script_for_code;

    static function init() {
       

        $atts = array(
            'name' => __('Code', 'tfuse'),
            'desc' => __('Here comes some lorem ipsum description for the box shortcode.', 'tfuse'),
            'category' => 8,
            'options' => array(
                /* add the fllowing option in case shortcode has content */
                array(
                    'name' => __('Content', 'tfuse'),
                    'desc' => __('Enter shortcode content', 'tfuse'),
                    'id' => 'tf_shc_code_content',
                    'value' => '',
                    'type' => 'textarea'
                )
            )
        );

        tf_add_shortcode('code', array(__CLASS__, 'tfuse_code'), $atts);

        add_action('init', array(__CLASS__, 'register_script'));
        add_action('wp_footer', array(__CLASS__, 'print_script'));
        add_action('wp_enqueue_scripts', array(__CLASS__, 'print_styles'));
    }

   static function register_script() {
        $template_directory = get_template_directory_uri();

        wp_register_script('shCore', $template_directory . '/js/shCore.js', array('jquery'), '2.1.382', true);
        wp_register_script('shBrushPlain', $template_directory . '/js/shBrushPlain.js', array('jquery'), '2.1.382', true);
    }

   static function print_styles() {
        $template_directory = get_template_directory_uri();

        wp_register_style('shCore', $template_directory . '/css/shCore.css', false, '2.1.382');
        wp_enqueue_style('shCore');

        wp_register_style('shThemeDefault', $template_directory . '/css/shThemeDefault.css', false, '2.1.382');
        wp_enqueue_style('shThemeDefault');
    }

   static function print_script() {
        if (!self::$add_script_for_code)
            return;

        wp_enqueue_script('shCore');
        wp_enqueue_script('shBrushPlain');
    }

   

  static  function tfuse_code($atts, $content = null) {
        self::$add_script_for_code = true;

        extract(shortcode_atts(array('brush' => 'plain'), $atts));

        return '<pre class="brush: ' . $brush . '">' . $content . '</pre>';
    }

}

TFUSE_Code_Shortcode::init();
