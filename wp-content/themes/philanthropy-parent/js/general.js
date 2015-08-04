
jQuery(document).ready(function($) {
    
    ajax_pagination();
    
// Events Calendar
    if(jQuery('#calendar').length || jQuery('#upcoming_events_load').length) {
        var now = new Date();
        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);
        var today = now.getFullYear()+"-"+(month)+"-"+(day);

        // ajax request to return event from curent category
        var id = jQuery('input[name="current_event"]').attr("value"); 
		
        var lang = '';
        if( typeof tf_qtrans_lang !== 'undefined' )
            lang = '&lang=' + tf_qtrans_lang.lang;

        var x_data = "action=tfuse_archive_events&id="+id + lang;
        jQuery.ajax({
            type: "POST",
            url: tf_script.ajaxurl,
            data: x_data,
            success: function(rsp){
                //console.log(rsp);
                var data = jQuery.parseJSON(rsp);
                var calendar = jQuery('#calendar').calendar({
                    events_source: data,
                    view: 'month',
                    tmpl_path: tf_script.TFUSE_THEME_URL+'/tmpls/',
                    tmpl_cache: false,
                    modal: '#events-modal',
                    day: today,
                    onAfterEventsLoad: function(events) {
                        if(!events) {
                            return;
                        }
                        var list = jQuery('#eventlist');
                        list.html('');

                        jQuery.each(events, function(key, val) { 
                            jQuery(document.createElement('li'))
                                .html('<a href="' + val.url + '">' + val.title + '</a>')
                                .appendTo(list);
                        });
                    },
                    onAfterViewLoad: function(view) {
                        jQuery('.calendar-navigation h3').text(this.getTitle());
                        jQuery('.calendar-navigation a').removeClass('active');
                        jQuery('a[data-calendar-view="' + view + '"]').addClass('active');

                        //Events day
                        jQuery(function() {
                            jQuery('.cal-cell1').each(function (){
                                var $this = jQuery(this);
                                if($this.children('.cal-month-day').children('.events-list').length){
                                    $this.children('.cal-month-day').addClass('event-day');

                                    var list_events = $this.find(".event").length;
                                    if(list_events > 1){
                                        $this.find('.event-day').append('<div class="list-events">' + '<span>' + list_events + '</span>' + ' ' + 'Events</div>');
                                    }
                                    else{
                                        $this.find('.event-day').append('<div class="list-events">' + '<span>' + list_events + '</span>' + ' ' + 'Event</div>');
                                    }

                                }
                            });
                            jQuery('.cal-day-today').append("<span class='text-today'>Today</span>");
                        });
                    },
                    classes: {
                        months: {
                            general: 'label'
                        }
                    }
                });

                jQuery('.calendar-navigation a[data-calendar-nav]').each(function() {
                    var $this = jQuery(this);
                    $this.click(function() {
                        calendar.navigate($this.data('calendar-nav'));
                    });
                });

                jQuery('.calendar-navigation a[data-calendar-view]').each(function() {
                    var $this = jQuery(this);
                    $this.click(function() {
                        calendar.view($this.data('calendar-view'));
                    });
                });

                jQuery('#first_day').change(function(){
                    var value = jQuery(this).val();
                    value = value.length ? parseInt(value) : null;
                    calendar.setOptions({first_day: value});
                    calendar.view();
                });

               jQuery('#language').change(function(){
                    calendar.setLanguage(jQuery(this).val());
                    calendar.view();
                });

                jQuery('#events-in-modal').change(function(){
                    var val = jQuery(this).is(':checked') ? jQuery(this).val() : null;
                    calendar.setOptions({modal: val});
                });
                jQuery('#events-modal .modal-header, #events-modal .modal-footer').click(function(e){
                    //e.preventDefault();
                    //e.stopPropagation();
                });
            }
        });
    }

   
   jQuery("[data-toggle='tooltip']").tooltip();
        
   //jQuery("body").tooltip({ selector: '[data-toggle=tooltip]' });
    
     jQuery('a[data-rel]').each(function() {
            jQuery(this).attr('rel', jQuery(this).data('rel'));
        });
        jQuery("a[rel^='prettyPhoto']").prettyPhoto({
	        social_tools:false,
	        theme: 'dark_square'
        });
    
    
 	//var $ = jQuery;
    var screenRes = jQuery(window).width(),
        screenHeight = jQuery(window).height(),
        html = jQuery('html');
	

//Menu <ul> replace to <select>
function responsive(mainNavigation, mainNavigation2) {
  var screenRes = jQuery('body').width();

  if (jQuery('#site-navigation select').length == 0) {
    /* Replace unordered list with a "select" element to be populated with options, and create a variable to select our new empty option menu */
    jQuery('#site-navigation').append('<select class="select_styled" id="topm-select" style="display:none;"></select>');
    var selectMenu = jQuery('#topm-select');

	function appendToSelect(elem){

	      /* Get top-level link and text */
      var href = jQuery(elem).children('a').attr('href');
      var text = jQuery(elem).children('a').text();

      /* Append this option to our "select" */
      if (jQuery(elem).is(".current-menu-item") && href != '#') {
        jQuery(selectMenu).append('<option value="' + href + '">' + text + '</option>');
      } else if (href == '#') {
        jQuery(selectMenu).append('<option value="' + href + '" disabled="disabled">' + text + '</option>');
      } else {
        jQuery(selectMenu).append('<option value="' + href + '">' + text + '</option>');
      }

      /* Check for "children" and navigate for more options if they exist */
      if (jQuery(elem).children('ul').length > 0) {
        jQuery(elem).children('ul').children('li').not(".mega-nav-widget").each(function() {

          /* Get child-level link and text */
          var href2 = jQuery(this).children('a').attr('href');
          var text2 = jQuery(this).children('a').text();

          /* Append this option to our "select" */
          if (jQuery(this).is(".current-menu-item") && href2 != '#') {
            jQuery(selectMenu).append('<option value="' + href2 + '" selected> - ' + text2 + '</option>');
          } else if (href2 == '#') {
            jQuery(selectMenu).append('<option value="' + href2 + '" disabled="disabled">- ' + text2 + '</option>');
          } else {
            jQuery(selectMenu).append('<option value="' + href2 + '"> - ' + text2 + '</option>');
          }

          /* Check for "children" and navigate for more options if they exist */
          if (jQuery(this).children('ul').length > 0) {
            jQuery(this).children('ul').children('li').each(function() {

              /* Get child-level link and text */
              var href3 = jQuery(this).children('a').attr('href');
              var text3 = jQuery(this).children('a').text();

              /* Append this option to our "select" */
              if (jQuery(this).is(".current-menu-item")) {
                jQuery(selectMenu).append('<option value="' + href3 + '" class="select-current" selected>--' + text3 + '</option>');
              } else {
                jQuery(selectMenu).append('<option value="' + href3 + '"> --- ' + text3 + '</option>');
              }

            })
          }
        })
      }
	}

    /* Navigate our nav clone for information needed to populate options */
    jQuery(mainNavigation).children('ul').children('li').each(function() {
		appendToSelect(jQuery(this))
    });
	jQuery(mainNavigation2).children('ul').children('li').each(function() {
		appendToSelect(jQuery(this))
    });

  }
  if (screenRes > 768) {
    jQuery('#site-navigation select:first').hide();
    jQuery('#site-navigation ul:first, #site-navigation2 ul:first').show();
  } else {
    jQuery('#site-navigation ul:first, #site-navigation2 ul:first').hide();
    jQuery('#site-navigation select:first').show();
  }

  /* When our select menu is changed, change the window location to match the value of the selected option. */
  jQuery(selectMenu).change(function() {
    location = this.options[this.selectedIndex].value;
  });
};
jQuery(document).ready(function() {
  var screenRes = jQuery(window).width();
  // Remove links outline in IE 7
  jQuery("a").attr("hideFocus", "true").css("outline", "none");



   // reload topmenu on Resize
  var mainNavigation = jQuery('#site-navigation').clone(),
	  mainNavigation2 = jQuery('#site-navigation2').clone();
  responsive(mainNavigation, mainNavigation2);

  jQuery(window).resize(function() {
    var screenRes = jQuery('body').width();
    responsive(mainNavigation, mainNavigation2);
    
    jQuery('.site-navigation').children('ul').first().slicknav({parentTag: 'div', allowParentLinks :true});
    jQuery('.slicknav_nav').find('.slicknav_item').siblings('ul').removeClass('hidden');

  });

        //Script align center the text for projects post
	var wrapper_projects_post = jQuery('.postlist.projects .post');
	var entry_aside_projects = jQuery('.postlist.projects .entry-aside');
	wrapper_projects_post.each(function(){
		hei3 = jQuery(this).height();
		entry_aside_projects.each(function(){
			hei4 = jQuery(this).height();
			jQuery(this).css({
				'padding-top' :hei3/2-hei4/2
			});
		});

	});

});


// Mobile Menu (SlickNav)
jQuery('.site-navigation').children('ul').first().slicknav({parentTag: 'div', allowParentLinks :true});
jQuery('.slicknav_nav').children('.mega-nav').find('.slicknav_item').removeClass('slicknav_item');
jQuery('.slicknav_nav').find('.slicknav_item').siblings('ul').removeClass('hidden');

//Menu Script dropdown animate
 jQuery(document).ready(function(jQuery) {

  
	jQuery(".nav-menu > ul").addClass('animated hidden');

	var menuItemWidth, submenuItemWidth, mnHeight;
  
	jQuery(".nav-menu > li").hover(function(){
		var jQuerythis = jQuery(this);


		jQuerythis.children('ul').removeClass().addClass('animated');
		menuItemWidth = jQuerythis.innerWidth();
		menuItemHeight = jQuerythis.innerHeight();
		submenuItemWidth = jQuerythis.children("ul").innerWidth();

		// Set Mega Nav Width according to # of Widgets
		if(jQuerythis.hasClass('mega-nav')) {
			var ul = jQuerythis.children('ul'),
				li = ul.children('li'),
				widthFinal = 0
				liHeight = 0;

			li.not('.arrow-dropdown').each(function() {
				var width = jQuery(this).outerWidth()
				widthFinal = widthFinal + width;
				height = jQuery(this).outerHeight();

				if (height > liHeight) {
					liHeight = height;
				}

			});
			ul.css('width', widthFinal);
			li.not('.arrow-dropdown').css('height', liHeight);
		}

		if (jQuery(this).find('ul').length){
			var meganav = jQuery(this).children("ul"),
				mnWidth = meganav.outerWidth(),
				mnoffset = parseInt(meganav.offset().left, 10),
				screenWidth = jQuery(window).width();

			if (mnoffset+mnWidth > screenWidth) {
				meganav.css('left' , -(mnoffset+mnWidth-screenWidth) - 22);

			};
		}


		jQuerythis.children('ul').addClass('fadeInDownSmall').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
			jQuerythis.children('ul').removeClass().addClass('animated')
		});
	}, function(){
		jQuery(this).children('ul').addClass('fadeOutUpSmall').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
			jQuery(this).removeClass().addClass('hidden');
		});

	});



	 // Menu parent
	 jQuery(".nav-menu li").has('ul').addClass('parent');
         
         
         //console.log(jQuery(".nav-menu ul.animated li").hasClass('parent').children('ul'));
         
         jQuery(".nav-menu ul.animated li").each(function(){
             if(jQuery(this).hasClass('parent'))
                 jQuery(this).find('ul').removeClass('animated');
         });
                  


  });

			
// IE<8 Warning
    if (html.hasClass("ie7")) {
        jQuery("body").empty().html('Please, Update your Browser to at least IE8');
    }

// Disable Empty Links
    jQuery("[href=#]").click(function(event){
        event.preventDefault();
    });

// Body Wrap
    jQuery(".body-wrap").css("min-height", screenHeight);
    jQuery(window).resize(function() {
        screenHeight = jQuery(window).height();
        jQuery(".body-wrap").css("min-height", screenHeight);
    });

// Remove outline in IE
	jQuery("a, input, textarea").attr("hideFocus", "true").css("outline", "none");


// buttons
	jQuery('a.btn, span.btn').on('mousedown', function(){
		jQuery(this).addClass('active')
	});
	jQuery('a.btn, span.btn').on('mouseup mouseout', function(){
		jQuery(this).removeClass('active')
	});


// Styled Select, CheckBox, RadioBox
	if (jQuery(".select-styled").length) {
		cuSel({changedEl: ".select-styled", visRows: 6, itemPadding: 14});
	}
	if (jQuery(".input-styled").length) {
		jQuery(".input-styled input").customInput();
	}

// prettyPhoto lightbox, check if <a> has atrr data-rel and hide for Mobiles
    if(jQuery('a').is('[data-rel]') && screenRes > 600) {
        jQuery('a[data-rel]').each(function() {
            jQuery(this).attr('rel', jQuery(this).data('rel'));
        });
        jQuery("a[rel^='prettyPhoto']").prettyPhoto({
	        social_tools:false,
	        theme: 'dark_square'
        });
    };




// Smooth Scroling of ID anchors
    function filterPath(string) {
        return string
            .replace(/^\//,'')
            .replace(/(index|default).[a-zA-Z]{3,4}jQuery/,'')
            .replace(/\/jQuery/,'');
    }
    var locationPath = filterPath(location.pathname);
    var scrollElem = scrollableElement('html', 'body');

    jQuery('a[href*=#].anchor').each(function() {
        jQuery(this).click(function(event) {
            var thisPath = filterPath(this.pathname) || locationPath;
            if (  locationPath == thisPath
                && (location.hostname == this.hostname || !this.hostname)
                && this.hash.replace(/#/,'') ) {
                var jQuerytarget = jQuery(this.hash), target = this.hash;
                if (target && jQuerytarget.length != 0) {
                    var targetOffset = jQuerytarget.offset().top;
                    event.preventDefault();
                    jQuery(scrollElem).animate({scrollTop: targetOffset}, 400, function() {
                        location.hash = target;
                    });
                }
            }
        });
    });

    // use the first element that is "scrollable"
    function scrollableElement(els) {
        for (var i = 0, argLength = arguments.length; i <argLength; i++) {
            var el = arguments[i],
                jQueryscrollElement = jQuery(el);
            if (jQueryscrollElement.scrollTop()> 0) {
                return el;
            } else {
                jQueryscrollElement.scrollTop(1);
                var isScrollable = jQueryscrollElement.scrollTop()> 0;
                jQueryscrollElement.scrollTop(0);
                if (isScrollable) {
                    return el;
                }
            }
        }
        return [];
    };




// Crop Images in Image Slider

    // adds .naturalWidth() and .naturalHeight() methods to jQuery for retrieving a normalized naturalWidth and naturalHeight.
    (function(jQuery){
        var
            props = ['Width', 'Height'],
            prop;

        while (prop = props.pop()) {
            (function (natural, prop) {
                jQuery.fn[natural] = (natural in new Image()) ?
                    function () {
                        return this[0][natural];
                    } :
                    function () {
                        var
                            node = this[0],
                            img,
                            value;

                        if (node.tagName.toLowerCase() === 'img') {
                            img = new Image();
                            img.src = node.src,
                                value = img[prop];
                        }
                        return value;
                    };
            }('natural' + prop, prop.toLowerCase()));
        }
    }(jQuery));

    var
        carousels_on_page = jQuery('.carousel-inner').length,
        carouselWidth,
        carouselHeight,
        ratio,
        imgWidth,
        imgHeight,
        imgRatio,
        imgMargin,
        this_image,
        images_in_carousel;

    for(var i = 1; i <= carousels_on_page; i++){
        jQuery('.carousel-inner').eq(i-1).addClass('id'+i);
    }

    function imageSize() {
        setTimeout(function () {
            for(var i = 1; i <= carousels_on_page; i++){
                carouselWidth = jQuery('.carousel-inner.id'+i+' .item').width();
                carouselHeight = jQuery('.carousel-inner.id'+i+' .item').height();
                ratio = carouselWidth/carouselHeight;

                images_in_carousel = jQuery('.carousel-inner.id'+i+' .item img').length;

                for(var j = 1; j <= images_in_carousel; j++){
                    this_image = jQuery('.carousel-inner.id'+i+' .item img').eq(j-1);
                    imgWidth = this_image.naturalWidth();
                    imgHeight = this_image.naturalHeight();
                    imgRatio = imgWidth/imgHeight;

                    if(ratio <= imgRatio){
                        imgMargin = parseInt((carouselHeight/imgHeight*imgWidth-carouselWidth)/2, 10);
                        this_image.css("cssText", "height: "+carouselHeight+"px; margin-left:-"+imgMargin+"px;");
                    }
                    else{
                        imgMargin = parseInt((carouselWidth/imgWidth*imgHeight-carouselHeight)/2, 10);
                        this_image.css("cssText", "width: "+carouselWidth+"px; margin-top:-"+imgMargin+"px;");
                    }
                }
            }
        }, 0);
    }

    jQuery(window).load(function(){
        imageSize();
    });
    jQuery(window).resize(function() {
        jQuery('.carousel-indicators li:first-child').click();
        imageSize();
    });

});



// Footer Menu <ul> replace to <select>
function responsive(footerNavigation) {
  var screenRes = jQuery('body').width();

  if (jQuery('#site-navigation3 select').length == 0) {
    /* Replace unordered list with a "select" element to be populated with options, and create a variable to select our new empty option menu */
    jQuery('#site-navigation3').append('<select class="select_styled" id="footerm-select" style="display:none;"></select>');
    var footerMenu = jQuery('#footerm-select');

    /* Navigate our nav clone for information needed to populate options */
    jQuery(footerNavigation).children('ul').children('li').each(function() {

      /* Get top-level link and text */
      var href = jQuery(this).children('a').attr('href');
      var text = jQuery(this).children('a').text();

      /* Append this option to our "select" */
      if (jQuery(this).is(".current-menu-item") && href != '#') {
        jQuery(footerMenu).append('<option value="' + href + '" selected>' + text + '</option>');
      } else if (href == '#') {
        jQuery(footerMenu).append('<option value="' + href + '" disabled="disabled">' + text + '</option>');
      } else {
        jQuery(footerMenu).append('<option value="' + href + '">' + text + '</option>');
      }

      /* Check for "children" and navigate for more options if they exist */
      if (jQuery(this).children('ul').length > 0) {
        jQuery(this).children('ul').children('li').not(".mega-nav-widget").each(function() {

          /* Get child-level link and text */
          var href2 = jQuery(this).children('a').attr('href');
          var text2 = jQuery(this).children('a').text();

          /* Append this option to our "select" */
          if (jQuery(this).is(".current-menu-item") && href2 != '#') {
            jQuery(footerMenu).append('<option value="' + href2 + '" selected> - ' + text2 + '</option>');
          } else if (href2 == '#') {
            jQuery(footerMenu).append('<option value="' + href2 + '" disabled="disabled"># ' + text2 + '</option>');
          } else {
            jQuery(footerMenu).append('<option value="' + href2 + '"> - ' + text2 + '</option>');
          }

          /* Check for "children" and navigate for more options if they exist */
          if (jQuery(this).children('ul').length > 0) {
            jQuery(this).children('ul').children('li').each(function() {

              /* Get child-level link and text */
              var href3 = jQuery(this).children('a').attr('href');
              var text3 = jQuery(this).children('a').text();

              /* Append this option to our "select" */
              if (jQuery(this).is(".current-menu-item")) {
                jQuery(footerMenu).append('<option value="' + href3 + '" class="select-current" selected>' + text3 + '</option>');
              } else {
                jQuery(footerMenu).append('<option value="' + href3 + '"> -- ' + text3 + '</option>');
              }

            });
          }
        });
      }
    });
  }
  if (screenRes > 768) {
    jQuery('#site-navigation3 select:first').hide();
    jQuery('#site-navigation3 ul:first').show();
  } else {
    jQuery('#site-navigation3 ul:first').hide();
    jQuery('#site-navigation3 select:first').show();
  }

  /* When our select menu is changed, change the window location to match the value of the selected option. */
  jQuery(footerMenu).change(function() {
    location = this.options[this.selectedIndex].value;
  });
}
jQuery(document).ready(function() {
  var screenRes = jQuery(window).width();
  // Remove links outline in IE 7
  jQuery("a").attr("hideFocus", "true").css("outline", "none");
  

   // reload topmenu on Resize
  var footerNavigation = jQuery('#site-navigation3').clone();
  responsive(footerNavigation);

  jQuery(window).resize(function() {
    var screenRes = jQuery('body').width();
    responsive(footerNavigation);
  });



// odd/even
	jQuery("ul.recent_posts > li:odd, ul.popular_posts > li:odd, .table-striped table>tbody>tr:odd, .boxed_list > .boxed_item:odd, .grid_layout .post-item:odd").addClass("odd");
	jQuery(".widget_recent_comments ul > li:even, .widget_recent_entries li:even, .widget_twitter .tweet_item:even, .widget_archive ul > li:even, .widget_categories ul > li:even, .widget_nav_menu ul > li:even, .widget_links ul > li:even, .widget_meta ul > li:even, .widget_pages ul > li:even, .event_list .event_item:even").addClass("even");



	if(jQuery('.header').parents('header').next().hasClass('slider-full')){
		jQuery('.header').removeClass('bg-menu');
	}

	else{
		jQuery('.header').addClass('bg-menu');
	}

	jQuery( ".press-article:nth-child(2n)" ).css( "margin-right", "0" );








});

jQuery(document).ready(function(){


	if(jQuery(".slider-foto-video").find("[data-skin='" + 'light' + "']").length){

		jQuery('.slider-html5gallery').attr({
				//"data-skin" : "light", //Skins: darkness, gallery, horizontal, light(default), mediapage, showcase, vertical
				"data-width" : "740",
				"data-height" : "515",
				"data-slideshowinterval" : "6000",
				"data-padding": 0,
				"data-bgcolor" : "",
				"data-bgimage" : "",
				"data-galleryshadow" : !1,
				"data-slideshadow" : !1, //!0 - Slider Shadow its true, analogical for next parameters
				"data-showsocialmedia" : !1,
				"data-headerpos" : "top",
				"data-showdescription" : !1,
				"data-titleoverlay" : !1,
				"data-titleautohide" : !1,
				"data-titlecss" : " {color:#ffffff; font-size:14px; font-family:Armata, sans-serif, Arial; overflow:hidden; white-space:normal; text-align:left; padding:10px 0px 10px 10px;  background:rgb(102, 102, 102) transparent; background: rgba(102, 102, 102, 0.6); filter:'progid:DXImageTransform.Microsoft.gradient(startColorstr=#99666666, endColorstr=#99666666)'; -ms-filter:'progid:DXImageTransform.Microsoft.gradient(startColorstr=#99666666, endColorstr=#99666666)'; }",
				"data-titlecsslink" : " a {color:#ffffff;}",
				"data-descriptioncss" : " {color:#ffffff; font-size:12px; font-family:Armata, sans-serif, Arial; overflow:hidden; white-space:normal; text-align:left; padding:0px 0px 10px 10px;  background:rgb(102, 102, 102) transparent; background: rgba(102, 102, 102, 0.6); filter:'progid:DXImageTransform.Microsoft.gradient(startColorstr=#99666666, endColorstr=#99666666)'; -ms-filter:'progid:DXImageTransform.Microsoft.gradient(startColorstr=#99666666, endColorstr=#99666666)'; }",
				"data-descriptioncsslink" : " a {color:#ffffff;}",
				"data-showcarousel" : !0,
				"data-carouselmargin" : 0,
				"data-carouselbgtransparent" : !0,
				"data-thumbwidth" : 120,
				"data-thumbheight" : 90,
				"data-thumbgap" : 2,
				"data-thumbmargin" : 2,
				"data-thumbunselectedimagebordercolor" : "",
				"data-thumbimageborder" : 0,
				"data-thumbimagebordercolor" : "",
				"data-thumbshowplayonvideo" : !0,
				"data-thumbshadow" : !1,
				"data-thumbopacity" : 0.9,
				"data-responsive" : "true",
				"data-pausebutton" : "false",
				"data-autoslide" : "true",
				"data-showplaybutton" : "false",
				"data-autoplayvideo" : "false"


			}
		);
		jQuery('.slider-html5gallery').addClass('html5gallery');


		}

	else{
		jQuery(".slider-foto-video > div").removeClass("slider-html5gallery").addClass("html5gallery");
	}


	//Iframe Serponsive
	function adjustIframes()
	{
		jQuery('iframe').each(function(){
			var
				jQuerythis       = jQuery(this),
				proportion  = jQuerythis.data( 'proportion' ),
				w           = jQuerythis.attr('width'),
				actual_w    = jQuerythis.width();

			if ( ! proportion )
			{
				proportion = jQuerythis.attr('height') / w;
				jQuerythis.data( 'proportion', proportion );
			}

			if ( actual_w != w )
			{
				jQuerythis.css( 'height', Math.round( actual_w * proportion ) + 'px' );
			}
		});
	}
	jQuery(window).on('resize load',adjustIframes);

	// Detect Click in Iframe
	function detectIframeClick() {
		var overiFrame = -1;

		jQuery('#myCarousel').find('iframe').hover( function() {
			overiFrame = 1;
		}, function() {
			overiFrame = -1
		});
		jQuery(window).on('blur', function() {
			if( overiFrame != -1 ) {
				jQuery('#myCarousel').carousel('pause');
			}

		});
                
                jQuery('.carousel-control, .carousel-indicators li').click(function() {
			jQuery('#myCarousel').carousel('cycle');
		});
	}

	detectIframeClick();

});

function ajax_pagination()
{
    
    if(parseInt(display.number) <= parseInt(display.items)) {
           jQuery('#ajax_load_posts').parent().remove();
    }
    
    var pageNum = parseInt(display.startPage);
    var max = parseInt(display.maxPages);
    var max_specific = parseInt(display.max_specific);// alert(max_specific);
    if(max_specific != 0){ max = max_specific;}

    jQuery('#ajax_load_posts').on('click',function(){
    jQuery(this).children('span').text('Loading...');
        pageNum++;
        
        var post_type = jQuery('input[name="post_type"]').attr("value"); 
        var search_param = jQuery('input[name="search_param"]').attr("value");
        
        var search_key = jQuery('input[name="search_key"]').attr("value"); 
        var homepage = jQuery('input[name="homepage"]').attr("value");
        var allhome = jQuery('input[name="allhome"]').attr("value"); 
        var allblog = jQuery('input[name="allblog"]').attr("value");
        var cat_ids = jQuery('input[name="categories_ids"]').attr("value"); 
        var is_tax = jQuery('input[name="is_this_tax"]').attr("value");
        var id = jQuery('input[name="current_cat"]').attr("value");
        
        var x_data = "action=tfuse_ajax_get_posts&id="+id+"&search_param="+search_param+"&post_type="+post_type+"&is_tax="+is_tax+"&homepage="+homepage+"&allhome="+allhome+"&allblog="+allblog+"&cat_ids="+cat_ids+'&search_key='+search_key+'&pageNum='+pageNum+'&max='+max;
        jQuery.ajax({
            type: "POST",
            url: tf_script.ajaxurl,
            data: x_data,
            success: function(rsp){
        
                var obj = jQuery.parseJSON(rsp); 
        //var obj = rsp; 
       //s console.log(obj);
        
                for(var i = 0 ;i < parseInt(obj.items); i++)
                {
                    var boxes = jQuery(obj.html[i]);
                    jQuery("#content_load").append( boxes ); 
                }

                if(pageNum >= max)
                {  
                    jQuery('#ajax_load_posts').parent().remove();
                }
                else
                {
                     jQuery('#ajax_load_posts').children('span').text('Load more');
                }
                
                //Script align center the text for projects post
                var wrapper_projects_post = jQuery('.postlist.projects .post');
                var entry_aside_projects = jQuery('.postlist.projects .entry-aside');
                wrapper_projects_post.each(function(){
                        hei3 = jQuery(this).height();
                        entry_aside_projects.each(function(){
                                hei4 = jQuery(this).height();
                                jQuery(this).css({
                                        'padding-top' :hei3/2-hei4/2
                                });
                        });

                });

                jQuery('a[data-rel]').each(function() {
                    jQuery(this).attr('rel', jQuery(this).data('rel'));
                });
                jQuery("a[rel^='prettyPhoto']").prettyPhoto({
                        social_tools:false,
                        theme: 'dark_square'
                });
                
                jQuery('.gallery-list .gallery-item:nth-child(4n)').css('margin-right','0px');
            }
        });
        return false;
    });
}
