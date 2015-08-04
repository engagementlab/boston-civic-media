<?php

add_action( 'wp_enqueue_scripts', 'tfuse_add_css' );
add_action( 'wp_enqueue_scripts', 'tfuse_add_js' );

if ( ! function_exists( 'tfuse_add_css' ) ) :
/**
 * This function include files of css.
 */
    function tfuse_add_css()
    {
         wp_register_style( 'calendar',  tfuse_get_file_uri('/css/calendar.css', false, '') );
        wp_enqueue_style( 'calendar' );
        
    
        wp_register_style( 'bootstrap',  tfuse_get_file_uri('/css/bootstrap.css', false, '') );
        wp_enqueue_style( 'bootstrap' );
    
        wp_register_style( 'style', get_stylesheet_uri());
        wp_enqueue_style( 'style' );
        
        wp_register_style( 'font-awesome',  tfuse_get_file_uri('/css/font-awesome.css', false, '') );
        wp_enqueue_style( 'font-awesome' );

        wp_register_style( 'prettyPhoto', TFUSE_ADMIN_CSS . '/prettyPhoto.css', false, '' );
        wp_enqueue_style( 'prettyPhoto' );
        
        wp_register_style( 'animate',  tfuse_get_file_uri('/css/animate.css', false, '') );
        wp_enqueue_style( 'animate' );
        
        wp_register_style( 'jquery-ui-1.10.4',  tfuse_get_file_uri('/css/jquery-ui-1.10.4.css', true, '') );
        wp_enqueue_style( 'jquery-ui-1.10.4' );

        wp_register_style( 'shCore',  tfuse_get_file_uri('/css/shCore.css', false, '') );
        wp_enqueue_style( 'shCore' );
        
        wp_register_style( 'video-js',  tfuse_get_file_uri('/css/video-js.css', false, '') );
        wp_enqueue_style( 'video-js' );
        
        wp_register_style( 'shThemeDefault',  tfuse_get_file_uri('/css/shThemeDefault.css', false, '') );
        wp_enqueue_style( 'shThemeDefault' );
    }
endif;


if ( ! function_exists( 'tfuse_add_js' ) ) :
/**
 * This function include files of javascript.
 */
    function tfuse_add_js()
    {

        wp_enqueue_script( 'jquery' );
        
        wp_register_script( 'modernizr', tfuse_get_file_uri('/js/lib/modernizr.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'modernizr' );
		
        wp_register_script( 'respond', tfuse_get_file_uri('/js/lib/respond.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'respond' );	
        
        wp_register_script( 'jquery-ui.min', tfuse_get_file_uri('/js/lib/jquery-ui.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery-ui.min' );
//        
        wp_register_script( 'bootstrap', tfuse_get_file_uri('/js/lib/bootstrap.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'bootstrap' );
        
         wp_register_script( 'jquery.slicknav.min',  tfuse_get_file_uri('/js/jquery.slicknav.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery.slicknav.min' );
        
         wp_register_script( 'jquery.customInput',  tfuse_get_file_uri('/js/jquery.customInput.js'), array('jquery'), '', false );
        wp_enqueue_script( 'jquery.customInput' );
        
        wp_register_script( 'jquery.carouFredSel-6.2.1-packed',  tfuse_get_file_uri('/js/jquery.carouFredSel-6.2.1-packed.js'), array('jquery'), '', false );
        wp_enqueue_script( 'jquery.carouFredSel-6.2.1-packed' );
        
        wp_register_script( 'general', tfuse_get_file_uri('/js/general.js'), array('jquery'), '', true );
        wp_enqueue_script( 'general' );
        
        wp_register_script( 'html5shiv', tfuse_get_file_uri('/js/lib/html5shiv.js'), array('jquery'), '', true );
        wp_enqueue_script( 'html5shiv' );
        
        wp_register_script('maps.google.com', '//maps.google.com/maps/api/js?sensor=false', array('jquery'), '1.0', true);
        wp_enqueue_script('maps.google.com');
        
        wp_register_script( 'jquery.gmap.min',  tfuse_get_file_uri('/js/jquery.gmap.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery.gmap.min' );
       
        wp_register_script( 'html5gallery',  tfuse_get_file_uri('/js/html5gallery.js'), array('jquery'), '', true );
        wp_enqueue_script( 'html5gallery' );
        
	wp_register_script( 'jquery.touchSwipe.min',  tfuse_get_file_uri('/js/jquery.touchSwipe.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery.touchSwipe.min' );
        
        wp_register_script( 'video',  tfuse_get_file_uri('/js/video.js'), array('jquery'), '', true );
        wp_enqueue_script( 'video' );
//        
        wp_register_script( 'prettyPhoto', TFUSE_ADMIN_JS . '/jquery.prettyPhoto.js', array('jquery'), '3.1.4', true );
        wp_enqueue_script( 'prettyPhoto' );
        
        wp_register_script( 'youtube-api.min',  tfuse_get_file_uri('/js/youtube-api.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'youtube-api.min' );
        
        wp_register_script( 'shCore', tfuse_get_file_uri('/js/shCore.js'), array('jquery'), '', true );
        wp_enqueue_script( 'shCore' );
        
        wp_register_script( 'calendar', tfuse_get_file_uri('/js/calendar/calendar.js'), array('jquery'), '', true );
        wp_enqueue_script( 'calendar' );
        
        wp_register_script( 'underscore-min', tfuse_get_file_uri('/js/calendar/underscore-min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'underscore-min' );
        
        wp_register_script( 'shBrushPlain', tfuse_get_file_uri('/js/shBrushPlain.js'), array('jquery'), '', true );
        wp_enqueue_script( 'shBrushPlain' );
        
        wp_register_script( 'sintaxHighlighter', tfuse_get_file_uri('/js/sintaxHighlighter.js'), array('jquery'), '', true );
        wp_enqueue_script( 'sintaxHighlighter' );
        
        if( function_exists('qtrans_getLanguage') ){
            wp_localize_script('general', 'tf_qtrans_lang', array(
                'lang' => qtrans_getLanguage()
            ));
        }
    }
endif;