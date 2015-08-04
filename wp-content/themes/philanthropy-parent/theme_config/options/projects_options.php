<?php

/* ----------------------------------------------------------------------------------- */
/* Initializes all the theme settings option fields for categories area.             */
/* ----------------------------------------------------------------------------------- */

$options = array(
    array('name' => __('Category Title','tfuse'),
        'desc' => __('Category title.','tfuse'),
        'id' => TF_THEME_PREFIX . '_category_title',
        'value' => '',
        'type' => 'text'
    ),
    array('name' => __('Enable Join Us','tfuse'),
        'desc' => __('Enable Join Us Button.','tfuse'),
        'id' => TF_THEME_PREFIX . '_join_enable',
        'value' => false,
        'type' => 'checkbox'
    ),
   // Bottom Shortcodes
    array('name' => __('Shortcodes before Content','tfuse'),
        'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
        'id' => TF_THEME_PREFIX . '_content_top',
        'value' => '',
        'type' => 'textarea'
    ),
    // Bottom Shortcodes
    array('name' => __('Shortcodes after Content','tfuse'),
        'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
        'id' => TF_THEME_PREFIX . '_content_bottom',
        'value' => '',
        'type' => 'textarea'
    )
   
);

?>