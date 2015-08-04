<?php

/* ----------------------------------------------------------------------------------- */
/* Initializes all the theme settings option fields for pages area. */
/* ----------------------------------------------------------------------------------- */

$options = array(
   /* ----------------------------------------------------------------------------------- */
    /* After Textarea */
    /* ----------------------------------------------------------------------------------- */   
    array('name' => __('Project Setting','tfuse'),
        'id' => TF_THEME_PREFIX . '_workout_option',
        'type' => 'metabox',
        'context' => 'normal'
    ),
    array('name' => __('Upload Images','tfuse'),
        'desc' => __('Upload images for post event','tfuse'),
        'id' => TF_THEME_PREFIX . '_gallery',
        'value' => '',
        'type' => 'multi_upload2'
    ),
    
	/* Content Options */
    array('name' => __('Content Options','tfuse'),
        'id' => TF_THEME_PREFIX . '_content_option',
        'type' => 'metabox',
        'context' => 'normal'
    ),
    array('name' => __('Shortcodes before Content','tfuse'),
        'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
        'id' => TF_THEME_PREFIX . '_content_top',
        'value' => '',
        'type' => 'textarea'
    ),
    array('name' => __('Shortcodes after Content','tfuse'),
        'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
        'id' => TF_THEME_PREFIX . '_content_bottom',
        'value' => '',
        'type' => 'textarea'
    )
    
);

/* * *********************************************************
  Advanced
 * ********************************************************** */
?>