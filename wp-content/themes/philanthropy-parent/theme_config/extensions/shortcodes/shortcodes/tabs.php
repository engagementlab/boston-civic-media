<?php

/**
 * Tabs
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 * 
 * Optional arguments:
 * title:
 * class:
 */
function tfuse_tabs($atts, $content = null) {
    global $framedtabsheading,$uniq;
    $framedtabsheading = '';
    $uniq = rand(300, 400);
    extract(shortcode_atts(array('class' => '','size'=>''), $atts));
    
    if($size == 'large') $s = 'nav-justified';
    else $s = '';
    
    $get_tabs = do_shortcode($content);
    $k = 0;
    $out = '<div class="tabs_framed '.$class.'">
                        <div class="inner">
            <ul class="nav nav-tabs '.$s.' clearfix active_bookmark">';

    while (isset($framedtabsheading[$k])) {
        $out .= $framedtabsheading[$k];
        $k++;
    }

    $out .= '
            </ul></div>
            <div class="tab-content clearfix">'
            . $get_tabs . '</div>
         <script>
				jQuery("#myTab'.$uniq.' a").click(function (e) {
					  e.preventDefault();
					  jQuery(this).tab("show");
					})
			</script>';
    return $out;
}

$atts = array(
    'name' => __('Tabs','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 8,
    'options' => array(
        array(
            'name' => __('Class','tfuse'),
            'desc' => __('Tabs class (optional),ex: small_tabs','tfuse'),
            'id' => 'tf_shc_tabs_class',
            'value' => '',
            'divider' => TRUE,
            'type' => 'text'
        ),
        
        array(
            'name' => __('Tabs size','tfuse'),
            'desc' => __('Select tabs size','tfuse'),
            'id' => 'tf_shc_tabs_size',
            'value' => 'default',
            'options' => array(
                'large' => __('Large size','tfuse'),
                'default' => __('Default size','tfuse'),
            ),
            'type' => 'select',
            'divider' => TRUE
        ),
        array(
            'name' => __('Title','tfuse'),
            'desc' => '',
            'id' => 'tf_shc_tabs_title',
            'value' => '',
            'properties' => array('class' => 'tf_shc_addable_0 tf_shc_addable'),
            'type' => 'text'
        ),
        array(
            'name' => __('Active','tfuse'),
            'desc' => __('Make  active','tfuse'),
            'id' => 'tf_shc_tabs_active',
            'value' => 'false',
            'options' => array(
                'false' => __('No','tfuse'),
                'true' => __('Active','tfuse'),
            ),
            'properties' => array('class' => 'tf_shc_addable_1 tf_shc_addable'),
            'type' => 'select'
        ),
        array(
            'name' => __('Content','tfuse'),
            'desc' => '',
            'id' => 'tf_shc_tabs_content',
            'value' => '',
            'properties' => array('class' => 'tf_shc_addable_2 tf_shc_addable tf_shc_addable_last'),
            'divider' => TRUE,
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('tabs', 'tfuse_tabs', $atts);

function tfuse_tab($atts, $content = null) {
    global $framedtabsheading,$uniq;
    
    extract(shortcode_atts(array('title' => '','active' => ''), $atts));
    $k = 0;

    while (isset($framedtabsheading[$k])) {
        $k++;
        
    }
    $act="";
    if($active == 'true') $act = 'active';
    $framedtabsheading[] = '<li class="'.$act.'" ><a href="#tabs_'.$uniq.'_' . ($k + 1) . '" data-toggle="tab">' . $title . '</a></li>';
    return '<div id="tabs_'.$uniq.'_' . ($k + 1) . '" class="tab-pane '.$act.'">' . do_shortcode($content) . '</div>
       ';
}

$atts = array(
    'name' => __('Tab','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 8,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Specifies the title of an shortcode','tfuse'),
            'id' => 'tf_shc_tab_title',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Active','tfuse'),
            'desc' => __('Make  active','tfuse'),
            'id' => 'tf_shc_tab_active',
            'value' => '',
            'options' => array(
                'false' => __('No','tfuse'),
                'true' => __('Active','tfuse'),
            ),
            'type' => 'checkbox'
        ),
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('Enter the tabs in this format:<i>[tab]Tab content[/tab]...</i>','tfuse'),
            'id' => 'tf_shc_tab_content',
            'value' => '',
            'type' => 'textarea'
        )
    )
);

add_shortcode('tab', 'tfuse_tab', $atts);
