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
    <?php $uniq = rand(1,100);?>
    <div class="main-carousel fade-effect with-caption-slider invisible" style="background: url(<?php echo $view_variables['general']['slider_bg'];?>)">
        <div id="myCarousel<?php echo $uniq; ?>" class="carousel slide">
            <div class="carousel-inner">
                
                <?php $count = 0; foreach ($view_variables['slides'] as $slide):?>
                    <?php if(!empty($slide['slide_src'])):?>
                        <!-- Carousel items -->
                        <div class="<?php echo ($count == 0) ? 'active' : '';?> item" style="background-image:url(<?php echo $slide['slide_src'];?>);">
                            <div class="container">
                                <div class="text-with-caption">
                                    <h1 class="slider-title"><?php echo $slide['slide_title'];?></h1>
                                    <div><a href="<?php echo $slide['slide_url'];?>" class="btn btn-white-transparent btn-slider">
                                        <span><?php echo $slide['slide_button'];?><i class="icon-chevron-right align-right-icon"></i></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Carousel items -->
                    <?php else:?>
                        <!-- Carousel items -->
                        <div class="<?php echo ($count == 0) ? 'active' : '';?> item">
                            <div class="container">
                                <?php 
                                if ( !empty($slide['slide_video'])) :
                                    preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $slide['slide_video'], $video_id);
                                    if(!empty($video_id))
                                    {
                                        echo  '<iframe class="youtube" id="youtube'.$count.'" src="http://www.youtube.com/embed/'.$video_id[0].'?enablejsapi=1" width="910" height="540" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
                                    
                                        ?>
                                        <script src="http://www.youtube.com/player_api"></script>
                                        <script>
                                            function onYouTubeIframeAPIReady() {
                                                jQuery('.youtube').each(function(){
                                                    var thisId = jQuery(this).attr('id'),
                                                        youtube = new YT.Player(thisId);
                                                    jQuery('#myCarousel<?php echo $uniq; ?>').on('slide.bs.carousel', function () {
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
                                                    jQuery('#myCarousel<?php echo $uniq; ?>').on('slide.bs.carousel', function () {
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
                                                    jQuery('#myCarousel<?php echo $uniq; ?>').on('slide.bs.carousel', function () {
                                                        youtube.stopVideo();
                                                    });
                                                });
                                            };
                                        </script>
                                        <?php
                                    }
                                ?>

                                <?php endif;?>
                            </div>
                        </div>
                        <!-- /Carousel items -->
                    <?php endif;?>
                 <?php $count++; endforeach;?>
            </div>

            <!--Slider Navigation-->
            <div class="post-navigation">
                <!-- Carousel indicators -->
                <ol class="carousel-indicators">
                    <?php for($i = 0; $i < count($view_variables['slides']); $i++):?>
                        <li data-target="#myCarousel<?php echo $uniq; ?>" data-slide-to="<?php echo $i;?>" class="<?php echo ($i == 0) ? 'active' : '';?>"></li>
                    <?php endfor;?>
                </ol>
                <!-- Carousel nav -->
                <a class="carousel-control left" href="#myCarousel<?php echo $uniq; ?>" data-slide="prev"><i class="icon-chevron-left"></i></a>
                <a class="carousel-control right" href="#myCarousel<?php echo $uniq; ?>" data-slide="next"><i class="icon-chevron-right"></i></a>
            </div>
            <!--/Slider Navigation-->
            <div class="brogressbar"></div>

        </div>
    </div>

</section>

<!--/Home Slider-->
<script>
jQuery(document).ready(function($) {

    $('.main-carousel').prepend('<img src="<?php echo $view_variables['general']['slider_bg'];?>" alt="" class="testimage hidden">');

    $('.testimage').load(function(){
            $(".slider-full .spinner, .slider-full .testimage").remove();
            $(".main-carousel").removeClass('invisible').addClass('animated fadeIn');


    });
    var slider = $('#myCarousel<?php echo $uniq;?>'),
                    animateClass;


    //Brogressbar Slider
    var percent = 0, bar = $('.brogressbar'), interval = <?php echo !empty($view_variables['general']['slider_interval']) ? $view_variables['general']['slider_interval'] : '10000'?>;

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
                    var $this = $(this);
                    animateClass = $this.data('animate-in');
                    $this.addClass(animateClass)
            });

            slider.find('.active').find('[data-animate-out]').each(function () {
                    var $this = $(this);
                    animateClass = $this.data('animate-out');
                    $this.removeClass(animateClass)
            });
    }
    function animateSlideEnd() {
            slider.find('.active').find('[data-animate-in]').each(function () {
                    var $this = $(this);
                    animateClass = $this.data('animate-in');
                    $this.removeClass(animateClass)
            });
            slider.find('.active').find('[data-animate-out]').each(function () {
                    var $this = $(this);
                    animateClass = $this.data('animate-out');
                    $this.addClass(animateClass)
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
                            $(this).parent().carousel('prev');
                    },
                    swipeRight: function() {
                            $(this).parent().carousel('next');
                    },
                    threshold: 30
            })
    }
});

</script>