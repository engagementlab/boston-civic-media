<?php

function tfuse_header_map($atts, $content) {
    global $header_map;
    
    $header_map ='';
    extract(shortcode_atts(array('zoom' => '', 'icon' => ''), $atts));
    
    $get_header_map = do_shortcode($content);
    
    $output = '';
    

    $i = $j = $k = $z = $y = 0;
    $output = '';
    if (isset($header_map['lat'][0]) && isset($header_map['long'][0])) {

        $output .= "
            <section class='see-location clearfix'>
		<div class='row'>
                    <div id='googleMap' class='map'></div>
        </div>
        </section>";

    
        $output .= '
            <section class="wrapp-office clearfix">
                <div class="container">
                        <div class="row">';
                        while(isset($header_map['lat'][$z]) && isset($header_map['long'][$z]))
                        {
                            $output .='<div class="col-sm-4 col-xs-6 adress">';
                                if(!empty($header_map['title'][$z])) $output .='<h3 class="city">'.$header_map['title'][$z].'</h3>';
                                if(!empty($header_map['adress'][$z])) $output .='<p>'.$header_map['adress'][$z].'</p>';
                                if(!empty($header_map['phone'][$z])) $output .='<p>'.$header_map['phone'][$z].'</p>';
                                if(!empty($header_map['email'][$z])) $output .='<p><a href="mailto:'.$header_map['email'][$z].'">'.$header_map['email'][$z].'</a></p>';
                               $output .='<a href="#" class="btn btn-transparent btn-viewonmap" id="officemarker'.$z.'"><span><i class="tficon-view"></i>'.__('View on map','tfuse').'</span></a>';

                        $output .=' </div>';
                                    
                            $z++;
                        }
                    $output .='</div>
                </div>
            </section>';

        $icon = !empty($icon) ? $icon : get_template_directory_uri() . '/images/pin.png';
                    
        $output .="
            <script>
        
        jQuery(document).ready(function(){
        
            var image = '".$icon."';";
                    
            while(isset($header_map['lat'][$i]) && isset($header_map['long'][$i]))
            {
                $output .= "
                    var officecenter".$i." = new google.maps.LatLng(".$header_map['lat'][$i].",".$header_map['long'][$i].");
                    var officemarker".$i." = new google.maps.Marker({
                            position:officecenter".$i.",
                            icon: image
                    });";
                $i++;
            }

            $output .= "
                var centralOffice = new google.maps.LatLng(".$header_map['lat'][0].",".$header_map['long'][0]."); //Default Adress
                var centralOfficeMarker = new google.maps.Marker({
                        position: centralOffice,
                        icon: image
                });

                function initialize()
                {

                    var isDraggable = jQuery(document).width() > 480 ? true : false;
                        var mapCenter = new google.maps.LatLng(".$header_map['lat'][0]." , ".$header_map['long'][0].");
                        var infowindow = null;

                        var mapProp = {
                                center:mapCenter,
                                zoom:".$zoom.",
                                popup: false,
                                scrollwheel: false,
                                draggable: isDraggable,
                                maptype: google.maps.MapTypeId.ROADMAP
                        };

                        var map=new google.maps.Map(document.getElementById(\"googleMap\"),mapProp);";


                    while(isset($header_map['lat'][$j]) && isset($header_map['long'][$j]))
                    {
                        $output .= "google.maps.event.addListener(officemarker".$j.",'click',function() {
                                map.setZoom(".$zoom.");
                                map.setCenter(officemarker".$j.".getPosition());
                                if (infowindow) {
                                    infowindow.close();
                                }
                                infowindow = new google.maps.InfoWindow();
                                infowindow.setContent(\"<span class='title-map-marker'>".$header_map['title'][$j]."</span><p class='map-text-marker'>".$header_map['adress'][$j]."</p>\");
                                infowindow.open(map,officemarker".$j.");
                        });
                        
                         officemarker".$j.".setMap(map);
                             
                        ";
                        
                        $j++;
                    }
                                /* Central Office (Default Adress) */
                    $output .= "google.maps.event.addListener(centralOfficeMarker,'click',function() {
                                map.setZoom(".$zoom.");
                                map.setCenter(centralOfficeMarker.getPosition());
                                if (infowindow) {
                                        infowindow.close();
                                }
                                infowindow = new google.maps.InfoWindow();
                                infowindow.setContent(\"<span class='title-map-marker'>".$header_map['title'][0]."</span><p class='map-text-marker'>".$header_map['adress'][$j]."</p>\");
                                infowindow.open(map,centralOfficeMarker);
                        });


                        centralOfficeMarker.setMap(map);";

              $output .= "  } ";

              $output .="
                  function showMarker(marker){
                        var gMarker = null;
                        var center = null; ";
              
                    while(isset($header_map['lat'][$k]) && isset($header_map['long'][$k]))
                    {
                       $output .="
                        if(marker === 'officemarker".$k."') {
                                gMarker = officemarker".$k.";
                                center = officecenter".$k.";
                        }
                        else if(marker === 'centralOfficeMarker') {
                                gMarker = centralOfficeMarker;
                                center = centralOfficeMarker;
                        }

                        
                         ";
                       
                       $k++;
                    }
                    $output .=" 
                        google.maps.event.trigger(gMarker, 'click', {
                            latLng: center
                        });

                    }
                    google.maps.event.addDomListener(window, 'load', initialize);";
                    
                    while(isset($header_map['lat'][$y]) && isset($header_map['long'][$y]))
                    {
                        $output .= "jQuery('#officemarker".$y."').on('click',function(){
                            showMarker('officemarker".$y."');
                        });";
                        
                        $y++;
                    }

        $output .= "});
	 </script>";
    }
    
    return $output;
}

$atts = array(
    'name' => 'Header Map',
    'desc' => 'Here comes some lorem ipsum description for the shortcode.',
    'category' => 4,
    'options' => array(
        array(
            'name' => __('Zoom','tfuse'),
            'desc' => __('','tfuse'),
            'id' => 'tf_shc_header_map_zoom',
            'value' => '',
            'type' => 'text',
            'divider' => true
        ),
        array(
            'name' => __('Map Icon','tfuse'),
            'desc' => __('Map icon URL','tfuse'),
            'id' => 'tf_shc_header_map_icon',
            'value' => '',
            'type' => 'text',
            'divider' => true
        ),
        array(
            'name' => 'Title',
            'desc' => '',
            'id' => 'tf_shc_header_map_title',
            'value' => '',
            'properties' => array('class' => 'tf_shc_addable_0 tf_shc_addable'),
            'type' => 'text'
        ),
        array(
            'name' => __('Latitude','tfuse'),
            'desc' => __('','tfuse'),
            'id' => 'tf_shc_header_map_lat',
            'value' => '',
           'properties' =>  array('class' => 'tf_shc_addable_1 tf_shc_addable'),
            'type' => 'text'
        ),
        array(
            'name' => __('Longitude','tfuse'),
            'desc' => __('','tfuse'),
            'id' => 'tf_shc_header_map_long',
            'value' => '',
            'properties' =>  array('class' => 'tf_shc_addable_2 tf_shc_addable'),
            'type' => 'text'
        ),
        array(
            'name' => __('Email','tfuse'),
            'desc' => __('','tfuse'),
            'id' => 'tf_shc_header_map_email',
            'value' => '',
            'properties' =>  array('class' => 'tf_shc_addable_3 tf_shc_addable'),
            'type' => 'text'
        ),
        array(
            'name' => __('Phone','tfuse'),
            'desc' => __('','tfuse'),
            'id' => 'tf_shc_header_map_phone',
            'value' => '',
            'properties' =>  array('class' => 'tf_shc_addable_4 tf_shc_addable'),
            'type' => 'text'
        ),
        array(
            'name' => 'Address',
            'desc' => '',
            'id' => 'tf_shc_header_map_adress',
            'value' => '',
            'properties' => array('class' => 'tf_shc_addable_5 tf_shc_addable tf_shc_addable_last'),
            'type' => 'textarea'
        )

    )
);

tf_add_shortcode('header_map', 'tfuse_header_map', $atts);


function tfuse_head_map($atts, $content = null)
{
    global $header_map;
    extract(shortcode_atts(array('title' => '', 'adress' => '', 'lat' => '','long' => '','email' => '','phone' => ''), $atts));
    $header_map['title'][] = $title;
    $header_map['adress'][] = $adress;
    $header_map['lat'][] = $lat;
    $header_map['long'][] = $long;
    $header_map['email'][] = $email;
    $header_map['phone'][] = $phone;
}

$atts = array(
    'name' => 'Header Map',
    'desc' => 'Here comes some lorem ipsum description for the box shortcode.',
    'category' => 3,
    'options' => array(
        array(
            'name' => 'Title',
            'desc' => '',
            'id' => 'tf_shc_head_map_title',
            'value' => 'image',
            'type' => 'text'
        ),
        array(
            'name' => 'Address',
            'desc' => '',
            'id' => 'tf_shc_head_map_adress',
            'value' => '',
            'type' => 'textarea'
        ),
        array(
            'name' => __('Latitude','tfuse'),
            'desc' => __('','tfuse'),
            'id' => 'tf_shc_head_map_lat',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Longitude','tfuse'),
            'desc' => __('','tfuse'),
            'id' => 'tf_shc_head_map_long',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Email','tfuse'),
            'desc' => __('','tfuse'),
            'id' => 'tf_shc_head_map_email',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Phone','tfuse'),
            'desc' => __('','tfuse'),
            'id' => 'tf_shc_head_map_phone',
            'value' => '',
            'type' => 'text'
        ),
    )
);

add_shortcode('head_map', 'tfuse_head_map', $atts);