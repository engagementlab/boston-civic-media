<!--Home Slider-->
<section class="slider-full">
    <!-- Loading Spinner -->
    <div class="spinner">
        <div class="wBall" id="wBall_1">
            <div class="wInnerBall">
            </div>
        </div>
        <div class="wBall" id="wBall_2">
            <div class="wInnerBall">
            </div>
        </div>
        <div class="wBall" id="wBall_3">
            <div class="wInnerBall">
            </div>
        </div>
        <div class="wBall" id="wBall_4">
            <div class="wInnerBall">
            </div>
        </div>
        <div class="wBall" id="wBall_5">
            <div class="wInnerBall">
            </div>
        </div>
    </div>
    <!--/ Loading Spinner -->

    <div class="main-carousel fade-effect image-video-slider invisible">
        <div id="myCarousel" class="carousel slide">
            <div class="carousel-inner">
                <!-- Carousel items -->
                <?php $count = 0; foreach ($view_variables['slides'] as $slide):?>
                    <div class="<?php echo ($count == 0) ? 'active' : '';?> item text-align-left" style="background-image:url(<?php echo $slide['slide_bg'];?>);">
                        <div class="container">
                            <div class="inset-wrap">
                                <div class="image-video-block pull-left" data-animate-in="fadeInLeft" data-animate-out="fadeOutLeft">
                                    <?php if(!empty($slide['slide_src'])):?>
                                        <img src="<?php echo $slide['slide_src'];?>">
                                    <?php else:?>
                                        <?php 
                                if ( !empty($slide['slide_video'])) :
                                    preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $slide['slide_video'], $video_id);
                                    
                                    if(strpos($slide['slide_video'], '<iframe'))
                                    {
                                        echo $slide['slide_video'];
                                    }
                                    elseif(!empty($video_id))
                                    {
                                        echo  '<iframe class="youtube" id="youtube'.$count.'" src="http://www.youtube.com/embed/'.$video_id[0].'?enablejsapi=1" width="910" height="540" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
                                    
                                        ?>
                                        <script src="http://www.youtube.com/player_api"></script>
                                        <script>
                                            function onYouTubeIframeAPIReady() {
                                                jQuery('.youtube').each(function(){
                                                    var thisId = jQuery(this).attr('id'),
                                                        youtube = new YT.Player(thisId);
                                                    jQuery('#myCarousel').on('slide.bs.carousel', function () {
                                                        youtube.stopVideo();
                                                    });
                                                });
                                            };
                                        </script>
                                        <?php
                                    }
                                    elseif(strpos($slide['slide_video'], 'vimeo'))
                                    {
                                        echo '<iframe class="vimeo" id="vimeo'.$count.'" src="'.$slide['slide_video'].'?api=1" width="910" height="540"  webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
                                        ?>
                                        <script src="http://f.vimeocdn.com/js_opt/froogaloop2.min.js"></script>
                                        <script>
                                            function vimeo(){
                                                jQuery('.vimeo').each(function(){
                                                    var thisID = jQuery(this).attr('id'),
                                                            iframe = document.getElementById(thisID),
                                                            player = $f(iframe);
                                                    jQuery('#myCarousel').on('slide.bs.carousel', function () {
                                                            player.api("pause");
                                                    });
                                                });
                                            }
                                            vimeo();
                                        </script>
                                        <?php
                                    }
                                    else 
                                    {
                                        echo '<iframe class="youtube" id="youtube'.$count.'" src="'.$slide['slide_video'].'?enablejsapi=1" width="910" height="540" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
                                        
                                        ?>
                                        <script src="http://www.youtube.com/player_api"></script>
                                        <script>
                                            function onYouTubeIframeAPIReady() {
                                                jQuery('.youtube').each(function(){
                                                    var thisId = jQuery(this).attr('id'),
                                                        youtube = new YT.Player(thisId);
                                                    jQuery('#myCarousel').on('slide.bs.carousel', function () {
                                                        youtube.stopVideo();
                                                    });
                                                });
                                            };
                                        </script>
                                        <?php
                                    }
                                ?>

                                <?php endif;?>
                                    <?php endif;?>
                                </div>
                                <div class="wrapp-slider-text">
                                    <div data-animate-in="fadeInDown" data-animate-out="fadeOutUp" class="invisible">
                                        <h1 class="slider-title"><?php echo $slide['slide_title'];?></span></h1>
                                        <p class="slidet-content"><?php echo $slide['slide_desc'];?></p>
                                    </div>
                                    <div data-animate-in="fadeInUp" data-animate-out="fadeOutDown" class="invisible">
                                        <a href="<?php echo $slide['slide_url'];?>" class="btn btn-white-transparent btn-slider"><span><?php echo $slide['slide_button'];?><i class="icon-chevron-right align-right-icon"></i></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                    
                <?php $count++; endforeach;?>
            </div>

            <!--Slider Navigation-->
            <div class="post-navigation">
                <!-- Carousel indicators -->
                <ol class="carousel-indicators">
                    <?php for($i = 0; $i < count($view_variables['slides']); $i++):?>
                        <li data-target="#myCarousel" data-slide-to="<?php echo $i;?>" class="<?php echo ($i == 0) ? 'active' : '';?>"></li>
                    <?php endfor;?>
                </ol>
                <!-- Carousel nav -->
                <a class="carousel-control left" href="#myCarousel" data-slide="prev"><i class="icon-chevron-left"></i></a>
                <a class="carousel-control right" href="#myCarousel" data-slide="next"><i class="icon-chevron-right"></i></a>
            </div>
            <!--/Slider Navigation-->
            <div class="brogressbar"></div>

        </div>
    </div>

</section>
<!--/Home Slider-->

<script>
    jQuery(function($) {
        jQuery('.main-slider, .page-header').prepend('<img src="<?php echo $slide['slide_bg'];?>" alt="" id="testimage" class="hidden">');
    });
    
    jQuery(document).ready(function($) {

        jQuery('.main-carousel').prepend('<img src="<?php echo $slide['slide_bg'];?>" alt="" class="testimage hidden">');

        jQuery('.testimage').load(function(){
            jQuery(".slider-full .spinner, .slider-full .testimage").remove();
            jQuery(".main-carousel").removeClass('invisible').addClass('animated fadeIn');
        });
        
        var slider = jQuery('#myCarousel'),
                        animateClass;


        //Brogressbar Slider
        var percent = 0, bar = jQuery('.brogressbar'), interval = <?php echo !empty($view_variables['general']['slider_interval']) ? $view_variables['general']['slider_interval'] : '10000'?>;

        function progressBarCarousel() {
                bar.css({width:percent+'%'});
                bar.css('transition', '0.2s');
                percent = percent +1;

        }
        var barInterval = setInterval(progressBarCarousel, interval/105);
        slider.carousel({
                interval: interval,
                pause: false
        }).on('slide.bs.carousel', function () {
                                percent=0;
                                bar.css('transition', '0s')
                        });


        slider.find('[data-animate-in]').addClass('animated');

        function animateSlide() {
                slider.find('.item').removeClass('current');

                slider.find('.active').addClass('current').find('[data-animate-in]').each(function () {
                        var $this = jQuery(this);
                        animateClass = $this.data('animate-in');
                        $this.addClass(animateClass);
                });

                slider.find('.active').find('[data-animate-out]').each(function () {
                        var $this = jQuery(this);
                        animateClass = $this.data('animate-out');
                        $this.removeClass(animateClass);
                });
        }
        function animateSlideEnd() {
            slider.find('.active [data-animate-in], .carousel-indicators, .carousel-control').each(function () {
                    var $this = jQuery(this);
                    animateClass = $this.data('animate-in');
                    $this.removeClass(animateClass);
            });
            slider.find('.active [data-animate-in], .carousel-indicators, .carousel-control').each(function () {
                    var $this = jQuery(this);
                    animateClass = $this.data('animate-out');
                    $this.addClass(animateClass);
            });
        }

        slider.find('.invisible').removeClass('invisible');
        animateSlide();

        slider.on('slid.bs.carousel', function () {
                animateSlide();
        });
        slider.on('slide.bs.carousel', function () {
                animateSlideEnd();
        });

        if (Modernizr.touch) {
            slider.find('.carousel-inner').swipe( {
                    swipeLeft: function() {
                        jQuery(this).parent().carousel('prev');
                    },
                    swipeRight: function() {
                        jQuery(this).parent().carousel('next');
                    },
                    threshold: 30
            });
        }
    });

</script>
