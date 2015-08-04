<?php

/* ----------------------------------------------------------------------------------- */
/* Initializes all the theme settings option fields for categories area.             */
/* ----------------------------------------------------------------------------------- */

$options = array(
     array('name' => __('Member Settings','tfuse'),
        'id' => TF_THEME_PREFIX . '_content_option',
        'type' => 'metabox',
        'context' => 'normal'
    ),
    array('name' => __('Member Position','tfuse'),
        'desc' => __('Member Job Position.','tfuse'),
        'id' => TF_THEME_PREFIX . '_job',
        'value' => '',
        'type' => 'text'
    ),
   
);