<?php

/* ----------------------------------------------------------------------------------- */
/* Initializes all the theme settings option fields for pages area. */
/* ----------------------------------------------------------------------------------- */

$options = array(
   /* ----------------------------------------------------------------------------------- */
    /* After Textarea */
    /* ----------------------------------------------------------------------------------- */   
    array('name' => __('Event Media','tfuse'),
        'id' => TF_THEME_PREFIX . '_project_media',
        'type' => 'metabox',
        'context' => 'normal'
    ),
    array('name' => __('Upload Images','tfuse'),
        'desc' => __('Upload images for post gallery','tfuse'),
        'id' => TF_THEME_PREFIX . '_gallery',
        'value' => '',
        'type' => 'multi_upload2'
    ),
    
    
    array('name' => __('Event Settings','tfuse'),
        'id' => TF_THEME_PREFIX . '_event_settings',
        'type' => 'metabox',
        'context' => 'normal'
    ),
    array('name' => __('Event Date','tfuse'),
        'desc' => __('Select event date.','tfuse'),
        'id' => TF_THEME_PREFIX . '_event_date',
        'value' => '',
        'type' => 'datepicker'
    ),
    array('name' => __('Starts At','tfuse'),
        'desc' => __('Select event beginning hour.','tfuse'),
        'id' => TF_THEME_PREFIX . '_event_hour_min',
        'value' => '',
        'type' => 'callback',
        'callback'	=> 'select_hour'
    ),
	array('name' => __('Ends At','tfuse'),
        'desc' => __('Select event end hour.','tfuse'),
        'id' => TF_THEME_PREFIX . '_end_hour_min',
        'value' => '',
        'type' => 'callback',
        'callback'	=> 'select_hour_end'
    ),
    array('name' => __('Repeat','tfuse'),
        'desc' => __('Select type of event repetition.','tfuse'),
        'id' => TF_THEME_PREFIX . '_event_repeat',
        'value' => 'no',
        'options' => array('no' => __('No Repeat','tfuse'),'day' => __('Every day','tfuse'),'week' => __('Every week','tfuse'),'month' => __('Every month','tfuse'),'year' => __('Every year','tfuse')),
        'type' => 'select',
        /*'divider' => true*/
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