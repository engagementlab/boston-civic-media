<?php
/**
 * Upcoming Events
 *
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 *
 */

function tfuse_upcoming_events($atts, $content = null)
{
    extract(shortcode_atts(array('items' => 3, 'title' => 'Popular Posts', 'link' => '', 'cat' => '' ), $atts));
    $return_html = '';
    $saved_events = get_option(TF_THEME_PREFIX.'_all_array_events_'.$cat, '');
    
    $uniq = rand(1,100);
    $return_html .= '<div id="upcoming_events_load"></div>
		<input type="hidden" value="'.$cat.'" name="current_event" />';
        $current_date = date("Y-m-d");

        if(!empty($saved_events)){
            $upcoming_events = $final_events = array();
            $count = 0;
            $sorted = tfuse_aasort($saved_events, 'event_date');
            foreach($sorted as $event){
                if($event['event_date'] > $current_date){
                    $upcoming_events[$count]['event_id'] = $event['event_id'];
                    $upcoming_events[$count]['event_date'] = $event['event_date'];
                    ++$count;
                }
            }

            $items = (int)$items;
            $k=0;
            for($i=0; $i<$items; $i++){
                if($upcoming_events[$i]['event_id'])
                {
                    $final_events[$k]['event_id'] = $upcoming_events[$i]['event_id'];
                    $final_events[$k]['event_date'] = $upcoming_events[$i]['event_date'];
                    $k++;
                }
            }
        }

        $return_html .= '<section class="upcoming-events">
			<div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="event-slide">
                                        <div class="event-carousel">
                                            <div id="myCarousel'.$uniq.'" >';
        
        
                                $return_html .= '<div class="col-md-6 col-sm-12 col-xs-12">
                                                    <div class="events">
                                                        <h3 class="section-title">'.$title.'</h3>';
                                            if(!empty($link))
                                            $return_html .= ' <a href="'.$link.'" class="view-all" >'.__('View all','tfuse').' <span>+</span></a>';
                                                $return_html .= '<div class="events-navigation">';
													if(!empty($final_events))
													{
                                                    $return_html .= '<ol class="carousel-indicators">';
                                                                     $c = 0;   
                                                                     foreach($final_events as $event){
                                                                         $active = ($c == 0) ? 'active' : "";
                                                                            $return_html .= '
                                                                            <li data-target="#myCarousel'.$uniq.'" data-slide-to="'.$c.'" class="'.$active.'">
                                                                                <i class="icon-calendar"></i>
                                                                                <div class="title-date">
                                                                                    <div class="event-date">'.$event['event_date'].'</div>
                                                                                    <h3 class="section-title">'.get_the_title($event['event_id']).'</h3>
                                                                                </div>
                                                                            </li>';
                                                                    $c++;    }
                                                    $return_html .= '</ol>';
													}
                                        $return_html .='</div></div>';
                                    $return_html .= '</div>';
                                    
                                    
                $return_html .= '<div class="carousel-inner col-md-6 col-sm-12 col-xs-12">';
				if(!empty($final_events))
				{
              $count =0;  foreach($final_events as $event){
                    $act = ($count == 0) ? 'active' : "";
                    $current_post = get_post( $event['event_id'] );
                  
                    $return_html .= '<div class="'.$act.' item">
                                        <div class="container">
                                            <div class="wrapp-event-slider-text" data-animate-in="fadeIn" data-animate-out="fadeOut">
                                                <div class="event-date">'.$event['event_date'].'</div>
                                                <h3 class="section-title">'.get_the_title($event['event_id']).'</h3>
                                                <div class="event-content"><p>';
                                        $return_html .= (!empty($current_post->post_excerpt)) ? $current_post->post_excerpt : strip_tags(tfuse_shorten_string(apply_filters('the_content',$current_post->post_content),150));
                                            $return_html .='</p></div>
                                                <a href="'.get_permalink($event['event_id']).'" class="btn btn-transparent btn-event"><span>'.__('Event details','tfuse').' <i class="icon-chevron-right align-right-icon"></i></span></a>
                                            </div>
                                        </div>
                                    </div>';
                    $count++;
                }
				}
                  $return_html .= '</div>';
                  
                
        $return_html .= '</div></div></div></div></div></div></section>';
        
        $return_html .="
                <script>
			jQuery(document).ready(function($) {
				//Event Slider

				var slider2 = jQuery('#myCarousel".$uniq."'),
						animateClass;
				slider2.carousel({
					interval: 0,
					pause: 'none'
				});
				slider2.find('[data-animate-in]').addClass('animated');

				function animateSlideEvents() {
					slider2.find('.item').removeClass('current');

					slider2.find('.active').addClass('current').find('[data-animate-in]').each(function () {
						var _this = jQuery(this);
						animateClass = _this.data('animate-in');
						_this.addClass(animateClass)
					});

					slider2.find('.active').find('[data-animate-out]').each(function () {
						var _this = jQuery(this);
						animateClass = _this.data('animate-out');
						_this.removeClass(animateClass)
					});
				}
				function animateSlideEndEvents() {
					slider2.find('.active').find('[data-animate-in]').each(function () {
						var _this = jQuery(this);
						animateClass = _this.data('animate-in');
						_this.removeClass(animateClass)
					});
					slider2.find('.active').find('[data-animate-out]').each(function () {
						var _this = jQuery(this);
						animateClass = _this.data('animate-out');
						_this.addClass(animateClass)
					});
				}
				slider2.find('.invisible').removeClass('invisible');
				animateSlideEvents();

				slider2.on('slid.bs.carousel', function () {
					animateSlideEvents();
				});
				slider2.on('slide.bs.carousel', function () {
					animateSlideEndEvents();
				});

				if (Modernizr.touch) {
					slider2.find('.carousel-inner').swipe( {
						swipeLeft: function() {
                                                    jQuery(this).parent().carousel('prev');
						},
						swipeRight: function() {
                                                    jQuery(this).parent().carousel('next');
						},
						threshold: 30
					})
				}
			});

		</script>
        ";

    return $return_html;
}

$atts = array(
    'name' => __('Upcoming Events','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the shortcode.','tfuse'),
    'category' => 11,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Specifies the title for an shortcode','tfuse'),
            'id' => 'tf_shc_upcoming_events_title',
            'value' => 'Upcoming Events',
            'type' => 'text'
        ),
		array(
            'name' => __('Category','tfuse'),
            'desc' => __('Select Events Category','tfuse'),
            'id' => 'tf_shc_upcoming_events_cat',
            'value' => '',
			'options' => tfuse_list_events(),
            'type' => 'select'
        ),
        array(
            'name' => __('View All Link','tfuse'),
            'desc' => __('','tfuse'),
            'id' => 'tf_shc_upcoming_events_link',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Items','tfuse'),
            'desc' => __('Specifies the number of the events to show','tfuse'),
            'id' => 'tf_shc_upcoming_events_items',
            'value' => '3',
            'type' => 'text'
        ),
    )
);

tf_add_shortcode('upcoming_events', 'tfuse_upcoming_events', $atts);