function custom_generator_help_bar(type,options) {    
    shortcode='[help_bar title="'+options['title']+'"]';
    for(i in options.array) {
        shortcode+="[help_bar_item item_title='"+options.array[i]["item_title"]+"' image='" + options.array[i]["image"] +"' link='" + options.array[i]["link"] +"'][/help_bar_item]";
    }
    shortcode+='[/help_bar]';
    return shortcode;
}

function custom_obtainer_help_bar(data) {
    cont=jQuery('.tf_shortcode_option:visible');
    sh_options={};
    sh_options['array']=[];
    sh_options['title']= opt_get('tf_shc_help_bar_title',cont);

    cont.find('[name="tf_shc_help_bar_item_title"]').each(function(i)
    {
        div=jQuery(this).parents('.option');
        item_title=opt_get(jQuery(this).attr('name'),div);

        div=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_help_bar_image"]').first().parents('.option');
        image=opt_get(jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_help_bar_image"]').first().attr('name'),div);
        
        div=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_help_bar_link"]').first().parents('.option');
        link=opt_get(jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_help_bar_link"]').first().attr('name'),div);
                
        tmp={};
        
        tmp['link']=link;
        tmp['image']=image;
        tmp['item_title']=item_title;
        
        sh_options['array'].push(tmp);
    });
    
    return sh_options;
}

function custom_generator_header_map(type,options) {    
    shortcode='[header_map zoom="'+options['zoom']+'"]';
    for(i in options.array) {
        shortcode+="[head_map title='"+options.array[i]["title"]+"' adress='" + options.array[i]["adress"] +"' lat='" + options.array[i]["lat"] +"' long='" + options.array[i]["long"] +"' email='" + options.array[i]["email"] +"' phone='" + options.array[i]["phone"] +"'][/head_map]";
    }
    shortcode+='[/header_map]';
    return shortcode;
}

function custom_obtainer_header_map(data) {
    cont=jQuery('.tf_shortcode_option:visible');
    sh_options={};
    sh_options['array']=[];
    sh_options['zoom']= opt_get('tf_shc_header_map_zoom',cont);

    cont.find('[name="tf_shc_header_map_title"]').each(function(i)
    {
        div=jQuery(this).parents('.option');
        title=opt_get(jQuery(this).attr('name'),div);

        div=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_header_map_adress"]').first().parents('.option');
        adress=opt_get(jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_header_map_adress"]').first().attr('name'),div);
        
        div=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_header_map_lat"]').first().parents('.option');
        lat=opt_get(jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_header_map_lat"]').first().attr('name'),div);
        
        div=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_header_map_long"]').first().parents('.option');
        long=opt_get(jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_header_map_long"]').first().attr('name'),div);
        
        div=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_header_map_email"]').first().parents('.option');
        email=opt_get(jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_header_map_email"]').first().attr('name'),div);
        
        div=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_header_map_phone"]').first().parents('.option');
        phone=opt_get(jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_header_map_phone"]').first().attr('name'),div);
        
        tmp={};
        
        tmp['title']=title;
        tmp['adress']=adress;
        tmp['lat']=lat;
        tmp['long']=long;
        tmp['email']=email;
        tmp['phone']=phone;
        
        sh_options['array'].push(tmp);
    });
    
    return sh_options;
}

function custom_generator_slideshow(type,options) {
    shortcode='[slideshow type_size="'+options['type_size']+'"]';
    for(i in options.array) {
        shortcode+="[slide type='"+options.array[i]["type"]+"' content='" + options.array[i]["content"] +"'"+"][/slide]";
    }
    shortcode+='[/slideshow]';
    return shortcode;
}

function custom_obtainer_slideshow(data) {
    cont=jQuery('.tf_shortcode_option:visible');
    sh_options={};
    sh_options['array']=[];
    sh_options['type_size']= opt_get('tf_shc_slideshow_type_size',cont);

    cont.find('[name="tf_shc_slideshow_type"]').each(function(i)
    {
        div=jQuery(this).parents('.option');
        type=opt_get(jQuery(this).attr('name'),div);

        div=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_slideshow_content"]').first().parents('.option');
        content=opt_get(jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_slideshow_content"]').first().attr('name'),div);
        
        tmp={};
        
        tmp['type']=type;
        tmp['content']=content;
        
        sh_options['array'].push(tmp);
    });
    
    return sh_options;
}
function custom_generator_imagegallery(type,options) {
    shortcode='[imagegallery width="'+options['width']+'" height="'+options['height']+'"]';
    for(i in options.array) {
        shortcode+="[image title='"+options.array[i]["title"]+"' src='" + options.array[i]["src"] +"'"+"][/image]";
    }
    shortcode+='[/imagegallery]';
    return shortcode;
}

function custom_obtainer_imagegallery(data) {
    cont=jQuery('.tf_shortcode_option:visible');
    sh_options={};
    sh_options['array']=[];
    sh_options['width']= opt_get('tf_shc_imagegallery_width',cont);
    sh_options['height']= opt_get('tf_shc_imagegallery_height',cont);

    cont.find('[name="tf_shc_imagegallery_title"]').each(function(i)
    {
        div=jQuery(this).parents('.option');
        title=opt_get(jQuery(this).attr('name'),div);

        div=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_imagegallery_src"]').first().parents('.option');
        src=opt_get(jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_imagegallery_src"]').first().attr('name'),div);

        tmp={};

        tmp['title']=title;
        tmp['src']=src;

        sh_options['array'].push(tmp);
    });

    return sh_options;
}

function custom_generator_tabs(type,options) {
    shortcode='[tabs class="'+options['class']+'" size="'+options['size']+'"]';
    for(i in options.array) {
        shortcode+='[tab active="'+options.array[i]['active']+'" title="'+options.array[i]['title']+'"]'+options.array[i]['content']+'[/tab]';
    }
    shortcode+='[/tabs]';
    return shortcode;
}

function custom_obtainer_tabs(data) {
    cont=jQuery('.tf_shortcode_option:visible');
    sh_options={};
    sh_options['array']=[];
    sh_options['class']= opt_get('tf_shc_tabs_class',cont);
    sh_options['size']= opt_get('tf_shc_tabs_size');
    cont.find('[name="tf_shc_tabs_title"]').each(function(i) {
        div=jQuery(this).parents('.option');
        title=opt_get(jQuery(this).attr('name'),div);
        div=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_tabs_content"]').first().parents('.option');
        content=opt_get(jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_tabs_content"]').first().attr('name'),div);
        active=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_tabs_active"] option:selected').val();
        tmp={};
        tmp['title']=title;
        tmp['active']=active;
        tmp['content']=content;
        sh_options['array'].push(tmp);
    })
    return sh_options;
}

jQuery(document).ready(function($) {
    var $=jQuery;
    
    $('#tf_rf_display').live('change',function () {
        val = $(this).val();
        if(val !='popup')
            $('.tf_rf_button,.tf_rf_color').hide();
        else
            $('.tf_rf_button,.tf_rf_color').show();
    });

    $('#tf_shc_prettyPhoto_type').live('change',function () {
        val = $(this).val();
        if(val !='image')
            $('.tf_shc_prettyPhoto_thumb').hide();
        else
            $('.tf_shc_prettyPhoto_thumb').show();
    });

    $('#tf_shc_text_styles_type').live('change',function () {
        val = $(this).val();
        if(val !='link')
            $('.tf_shc_text_styles_link,.tf_shc_text_styles_target').hide();
        else
            $('.tf_shc_text_styles_link,.tf_shc_text_styles_target').show();
    });
    
    
     $('#tf_shc_toggle_content_type').live('change',function () {
        val = $(this).val();
        if(val =='simple')
        {
            $('.tf_shc_toggle_content_class').hide();
            $('.tf_shc_toggle_content_box').show();
        }
        else if(val == 'accordion')
        {
             $('.tf_shc_toggle_content_box').hide();
             $('.tf_shc_toggle_content_class').show();
        }
        else if(val == 'default')
        {
            $('.tf_shc_toggle_content_class').show();
            $('.tf_shc_toggle_content_box').show();
        }
    });
});

jQuery(document).ready(function($) {
    jQuery(document).on('click','.tf_shortcode_element',function(){
        if(jQuery(this).attr('rel') === 'section')
            jQuery('.tf_shc_section_before,.tf_shc_section_title').hide();
    });
    
    
     jQuery(document).on('change','#tf_shc_section_sect',function () {
        val = $(this).val();
        if(val =='top')
        {
            jQuery('.tf_shc_section_bg,.tf_shc_section_row,.tf_shc_section_border').hide();
            jQuery('.tf_shc_section_before,.tf_shc_section_title').show();
        }
        else
        {
            jQuery('.tf_shc_section_bg,.tf_shc_section_row').show();
            jQuery('.tf_shc_section_before,.tf_shc_section_title').hide();
        }
    });
    
});