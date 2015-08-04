<?php

/* ----------------------------------------------------------------------------------- */
/* Initializes all the theme settings option fields for pages area. */
/* ----------------------------------------------------------------------------------- */

$options = array(
   /* ----------------------------------------------------------------------------------- */
    /* After Textarea */
    /* ----------------------------------------------------------------------------------- */   
	/* Content Options */
    array('name' => __('Content Options','tfuse'),
        'id' => TF_THEME_PREFIX . '_content_option',
        'type' => 'metabox',
        'context' => 'normal'
    ),
    array('name' => __('Hide Title','tfuse'),
        'desc' => __('Hide Page Title.','tfuse'),
        'id' => TF_THEME_PREFIX . '_hide_title',
        'value' => false,
        'type' => 'checkbox',
        'divider' => true
    ),
    array('name' => __('Short Description','tfuse'),
        'desc' => __('Page Short description.','tfuse'),
        'id' => TF_THEME_PREFIX . '_short_desc',
        'value' => '',
        'type' => 'textarea',
        'divider' => true
    ),
    array('name' => __('Enable Join Us','tfuse'),
        'desc' => __('Enable Join Us Button.','tfuse'),
        'id' => TF_THEME_PREFIX . '_join_enable',
        'value' => false,
        'type' => 'checkbox',
        'divider' => true
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