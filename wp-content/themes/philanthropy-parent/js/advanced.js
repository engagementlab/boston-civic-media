jQuery(document).ready(function($) {

    
    jQuery('.over_thumb ').bind('click', function(){
 
       window.setTimeout(function(){
           var sel = jQuery('#slider_design_type').val(); 
           if(sel == 'home' || sel == 'video' || sel == 'caption'){
                jQuery('#slider_type').html('<option value="">Choose your slider type</option><option value="custom">Manually, I\'ll upload the images myself</option>');            }
            else if(sel == 'workout')
            {
                jQuery('#slider_type').html('<option value="">Choose your slider type<option value="posts">Automatically, fetch images from posts</option>');
            }
       },12);
    });

    /*-----------------------------------------*/
    

            
       //hide /show addable button on click
      if(!$('#philanthropy_footer_socials').is(':checked')){
        jQuery('.philanthropy_facebook,.philanthropy_twitter,.philanthropy_vimeo,.philanthropy_google').hide();
        }
            $('#philanthropy_footer_socials').live('change',function () {
            if(!jQuery(this).is(':checked'))
            {
                jQuery('.philanthropy_facebook,.philanthropy_twitter,.philanthropy_vimeo,.philanthropy_google,.philanthropy_skype').hide();
            }
            else
            {
                jQuery('.philanthropy_facebook,.philanthropy_twitter,.philanthropy_vimeo,.philanthropy_google,.philanthropy_skype').show();
            }
        });

jQuery('.tfuse_selectable_code').live('click', function () {
        var r = document.createRange();
        var w = jQuery(this).get(0);
        r.selectNodeContents(w);
        var sel = window.getSelection();
        sel.removeAllRanges();
        sel.addRange(r);
    });

  

    function getUrlVars() {
        urlParams = {};
        var e,
            a = /\+/g,
            r = /([^&=]+)=?([^&]*)/g,
            d = function (s) {
                return decodeURIComponent(s.replace(a, " "));
            },
            q = window.location.search.substring(1);
        while (e = r.exec(q))
            urlParams[d(e[1])] = d(e[2]);
        return urlParams;
    }
	 $("#slider_slideSpeed,#slider_play,#slider_pause,#philanthropy_map_zoom").keydown(function(event) {
        // Allow: backspace, delete, tab, escape, and enter
        if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 ||
            // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) ||
            // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault();
            }
        }
    });

    jQuery('#philanthropy_map_lat,#philanthropy_map_long').keydown(function(event) {
        // Allow: backspace, delete, tab, escape, and enter
        if ( event.keyCode == 190 || event.keyCode == 110|| event.keyCode == 189 || event.keyCode == 109 || event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 ||
            // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) ||
            // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault();
            }
        }
    });

   

    var options = new Array();
    

    
    options['philanthropy_logo_type'] = jQuery('#philanthropy_logo_type').val();
    jQuery('#philanthropy_logo_type').bind('change', function() {
        options['philanthropy_logo_type'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    
    options['philanthropy_homepage_category'] = jQuery('#philanthropy_homepage_category').val();
    jQuery('#philanthropy_homepage_category').bind('change', function() {
        options['philanthropy_homepage_category'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    //blog page
    options['philanthropy_blogpage_category'] = jQuery('#philanthropy_blogpage_category').val();
     jQuery('#philanthropy_blogpage_category').bind('change', function() {
         options['philanthropy_blogpage_category'] = jQuery(this).val();
         tfuse_toggle_options(options);
     });
     
     options['slide_type'] = jQuery('#slide_type').val();
    jQuery('#slide_type').bind('change', function() {
        options['slide_type'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
     
    tfuse_toggle_options(options);

    function tfuse_toggle_options(options)
    {

        jQuery('.categories_select_category,#philanthropy_logo,#philanthropy_logo_text,#philanthropy_home_page,#philanthropy_categories_select_categ,.homepage_category_header_element').parents('.option-inner').hide();
        jQuery('#philanthropy_home_page,#philanthropy_categories_select_categ,.homepage_category_header_element').parents('.form-field').hide();        
        
        if(jQuery('#slider_design').val() === 'caption')
        {
             jQuery('#slide_title,#slide_url,#slide_button,#slide_src,#slide_video').parents('.option-inner').hide();
            
            
            jQuery(document).on('click','.image_frame',function(){
                if(jQuery(this).data('settings').slide_type == 'image'){
                    jQuery('#slide_title,#slide_url,#slide_button,#slide_src').parents('.option-inner').show();
                    jQuery('#slide_video').parents('.option-inner').hide();
                    jQuery('.slide_button').next().show();
                }
                else{
                    jQuery('.slide_button').next().hide();
                    jQuery('#slide_title,#slide_url,#slide_button,#slide_src').parents('.option-inner').hide();
                    jQuery('#slide_video').parents('.option-inner').show();

                }
           });
        
        
           if(options['slide_type']=='image')
           {
               jQuery('.slide_button').next().show();
               jQuery('#slide_title,#slide_url,#slide_button,#slide_src').parents('.option-inner').show();
           }
           else
           {
               jQuery('.slide_button').next().hide();
              jQuery('#slide_video').parents('.option-inner').show();
           }
        }
        
         //logo type select
        if(options['philanthropy_rating_type']=='esrb')
            jQuery('#philanthropy_esrb').parents('.option-inner').show();
        else
            jQuery('#philanthropy_pegi').parents('.option-inner').show();


        

        //logo type select
        if(options['philanthropy_logo_type']=='text')
            jQuery('#philanthropy_logo_text').parents('.option-inner').show();
        else
            jQuery('#philanthropy_logo').parents('.option-inner').show();

        /*-----------------------------------------------------*/

        //homepage
       if(options['philanthropy_homepage_category']=='specific'){
            jQuery('.philanthropy_display_type_home').show();
            jQuery('.philanthropy_categories_select_categ').next().show();
            jQuery('#philanthropy_categories_select_categ').parents('.option-inner').show();
            jQuery('#philanthropy_categories_select_categ').parents('.form-field').show();
            
            jQuery('#philanthropy_content_top').parents('.postbox').show();
        }
        else if (options['philanthropy_homepage_category']=='all')
        {
            jQuery('.philanthropy_display_type_home').show();
            jQuery('.philanthropy_categories_select_categ').next().show();
            if($('#philanthropy_use_page_options').is(':checked')) 
                jQuery('#homepage-header,#homepage-shortcodes').removeAttr('style');
            
            jQuery('#philanthropy_content_top').parents('.postbox').show();
        }
        else if(options['philanthropy_homepage_category']=='page'){
            jQuery('#philanthropy_home_page').parents('.option-inner').show();
            jQuery('#philanthropy_home_page').parents('.form-field').show();
            jQuery('.philanthropy_categories_select_categ').next().hide();
            
            jQuery('#philanthropy_content_top').parents('.postbox').hide();
        } 
        
        
        //blog page
        if(options['philanthropy_blogpage_category']=='all'){
            jQuery('.philanthropy_categories_select_categ_blog').hide();
        }
        else if(options['philanthropy_blogpage_category']=='specific'){
            jQuery('.philanthropy_categories_select_categ_blog').show();
        } 
    }
});