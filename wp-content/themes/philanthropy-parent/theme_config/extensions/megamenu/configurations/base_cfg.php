<?php
if (!defined('TFUSE')) {
    exit('Direct access forbidden.');
}

$prefix = 'tf_megamenu_';

// the templates available for this theme
// note that the the keys must be valid templates
// from the $cfg['all_templates'] arr
$cfg['active_templates'] = array(
    'html' => 'HTML/Shortcodes'
);

$cfg['commun_options'] = array(
    // 0 depth commun options
    array(

        array(
            'name'       => __('MegaMenu ON', 'tfuse'),
            'id'         => $prefix . 'is_mega',
            'type'       => 'checkbox',
            'properties' => array(
                'class' => $prefix . 'nav_parent_switch'
            ),
            'options' => array(
                true  => 'yes',
                false => 'no'
            ),
            'value'      => false
        )

    ),


    // 1 depth commun options
    array(

        array(
            'name' => __('Select menu template', 'tfuse'),
            'id' => $prefix . 'menu_template',
            'type' => 'select',
            'properties' => array(
                'class' => $prefix . 'template_select'
            ),
            'options' => $cfg['active_templates'],
            'value' => false
        ),

    )

);

// the list of templates available
// for 1 depth menu nav items
$cfg['all_templates'] = array(

 

    'html' => array(
        array(
            'name' => __('HTML', 'tfuse'),
            'id' => $prefix . 'html',
            'type' => 'textarea',
            'value' => ''
        ),
    ),
);

$cfg['megafied_parent_li_css_classes'] = array(
    'mega-nav'
);

$cfg['megafied_child_li_css_classes'] = array(
    'mega-nav-widget'
);
