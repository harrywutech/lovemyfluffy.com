(function($){
	"use strict"; // Start of use strict  
	 function bzotech_swiper_slider(){
		$('.elbzotech-swiper-slider:not(.swiper-container-initialized)').each(function(){

			var slidesPerView = Number($(this).attr('data-items'));
			var items_custom = $(this).attr('data-items-custom');
			var direction = $(this).attr('data-direction');
			var slidertype = $(this).attr('data-slidertype');
			var effect = $(this).attr('data-effect');
			var scrollbar = $(this).parent().find('.swiper-scrollbar');
			var draggable = false;
			if(scrollbar.length){
				draggable = true;
			}
			if(!effect) effect = false;
			if(!direction) direction = 'horizontal';			
			if(!slidesPerView) slidesPerView = 1;			
			var number_active = slidesPerView;

			var spaceBetween = Number($(this).attr('data-space'));
			if(!spaceBetween) spaceBetween = 0;

			var slidesPerColumn = Number($(this).attr('data-column'));
			if(!slidesPerColumn) slidesPerColumn = 1;

			var slidesPerColumnFill = 'column';
			if(slidesPerColumn>1)  slidesPerColumnFill = 'row';

			var loop = $(this).attr('data-loop');
			if(loop != 'yes') loop = false;
			else loop = true;

			var auto = $(this).attr('data-auto');
			if(auto != 'yes') auto = false;
			else auto = true;			
			if(auto) slidesPerView = 'auto';


			var centeredSlides = $(this).attr('data-center');
			if(centeredSlides != 'yes') centeredSlides = false;
			else centeredSlides = true;

			var breakpoints = {};
			var items_widescreen = Number($(this).attr('data-items-widescreen'));
			var items_laptop = Number($(this).attr('data-items-laptop'));
			var items_tablet_extra = Number($(this).attr('data-items-tablet-extra'));
			var items_tablet = Number($(this).attr('data-items-tablet'));
			var items_mobile_extra = Number($(this).attr('data-items-mobile-extra'));
			var items_mobile = Number($(this).attr('data-items-mobile'));

			var space_widescreen = Number($(this).attr('data-space-widescreen'));
			var space_laptop = Number($(this).attr('data-space-laptop'));
			var space_tablet_extra = Number($(this).attr('data-space-tablet-extra'));
			var space_tablet = Number($(this).attr('data-space-tablet'));
			var space_mobile_extra = Number($(this).attr('data-space-mobile-extra'));
			var space_mobile = Number($(this).attr('data-space-mobile'));



			if(items_tablet || items_mobile || items_widescreen || items_laptop || items_tablet_extra || items_mobile_extra || space_tablet || space_mobile || space_widescreen || space_laptop || space_tablet_extra || space_mobile_extra){
				if(auto) items_tablet = items_mobile = 'auto';
				if(items_widescreen == '') items_widescreen = slidesPerView;
				if(items_laptop == '') items_laptop = slidesPerView;
				if(items_tablet_extra == '') items_tablet_extra = items_laptop;
				if(items_tablet == '') items_tablet = items_tablet_extra;
				if(items_mobile_extra == '') items_mobile_extra = items_tablet;
				if(items_mobile == '') items_mobile = items_mobile_extra;

				if(space_widescreen == '') space_widescreen = spaceBetween;
				if(space_laptop == '') space_laptop = spaceBetween;
				if(space_tablet_extra == '') space_tablet_extra = space_laptop;
				if(space_tablet == '') space_tablet = space_tablet_extra;
				if(space_mobile_extra == '') space_mobile_extra = space_tablet;
				if(space_mobile == '') space_mobile = space_mobile_extra;
				
				breakpoints = {
					0: {
				      	slidesPerView: items_mobile,
				      	grid: {
					        rows: slidesPerColumn,
					   		fill:slidesPerColumnFill,
					    },
				      	spaceBetween: space_mobile
				    },
				    768: {
				      	slidesPerView: items_mobile_extra,
				      	grid: {
					        rows: slidesPerColumn,
					   		fill:slidesPerColumnFill,
					    },
				      	spaceBetween: space_mobile_extra
				    },
				    881: {
				      	slidesPerView: items_tablet,
				      	grid: {
					        rows: slidesPerColumn,
					   		fill:slidesPerColumnFill,
					    },
				      	spaceBetween: space_tablet
				    },
				    1025: {
				      	slidesPerView: items_tablet_extra,
				      	grid: {
					        rows: slidesPerColumn,
					   		fill:slidesPerColumnFill,
					    },
				      	spaceBetween: space_tablet_extra
				    },
				    1201: {
				      	slidesPerView: items_laptop,
				      	grid: {
					        rows: slidesPerColumn,
					   		fill:slidesPerColumnFill,
					    },
				      	spaceBetween: space_laptop
				    },
				    1367: {
				      	slidesPerView: slidesPerView,
				      	grid: {
					        rows: slidesPerColumn,
					   		fill:slidesPerColumnFill,
					    },
				      	spaceBetween: spaceBetween
				    },
				    2401: {
				      	slidesPerView: items_widescreen,
				      	grid: {
					        rows: slidesPerColumn,
					   		fill:slidesPerColumnFill,
					    },
				      	spaceBetween: space_widescreen
				    }
				}
				
			}
			
			if(items_custom){
				items_custom = items_custom.split(',');
				var breakpoints = {};
				var i;
				
				for (i = 0; i < items_custom.length; i++) { 

				    items_custom[i] = items_custom[i].split(':');
				    
				    var res_dv = {};
				    res_dv.slidesPerView = parseInt(items_custom[i][1], 10);
				    
				    if(767 > Number(items_custom[i][0]) && Number(items_custom[i][0]) >= 0 && space_mobile){
				    	res_dv.spaceBetween = space_mobile;
				    }else if(1170 > Number(items_custom[i][0]) && Number(items_custom[i][0]) >= 767 && space_tablet){
				    	res_dv.spaceBetween = space_tablet;
				    }else if(Number(items_custom[i][0]) >= 1170 && spaceBetween){
				    	res_dv.spaceBetween = spaceBetween;
				    }
				    res_dv.slidesPerColumn = slidesPerColumn;
				    breakpoints[items_custom[i][0]] = res_dv;
					var max_items_custom = items_custom[0][0];
				    var max_items_custom_v = items_custom[0][1];
				    if(max_items_custom<items_custom[i][0]) {
				    	max_items_custom = items_custom[i][0]; 
				    	max_items_custom_v = parseInt(items_custom[i][1], 10);
				    }
				}
				if(Number(max_items_custom) < 1170) {
					var breakpoints_c = {
					    1170: {
					      	slidesPerView: Number(max_items_custom_v),
					      	spaceBetween: spaceBetween,
					      	slidesPerColumn: slidesPerColumn,
					    }
					}
					
					let a = {...breakpoints_c, ...breakpoints};
					breakpoints = a;
				}
			}
			var autoplay = false;
			var speed = Number($(this).attr('data-speed'));
			if(speed){
				autoplay = {};
				autoplay.delay = speed;
			}

			var navigation = $(this).attr('data-navigation');
			if(navigation == '') navigation = {};
			else navigation = {
		        	nextEl: $(this).parent().find('.swiper-button-next').get(0),
		            prevEl: $(this).parent().find('.swiper-button-prev').get(0),
		        };

		    var pagination = $(this).attr('data-pagination');
			if(pagination == '') pagination = {};
			else if(pagination == 'number')
			{
				pagination = {

			        	el: $(this).parent().find('.swiper-pagination').get(0),
		        		clickable: true,
		        		renderBullet: function (index, className) {
				           return '<span class="' + className + ' sw-pev'+ (index + 1) +'">' + (index + 1) + '</span>';
				        },

			    };
		    } else
			pagination = {
		        	el: $(this).parent().find('.swiper-pagination').get(0),
	        		clickable: true,
	        		renderBullet: function (index, className) {
				           return '<span class="' + className + ' sw-pev'+ (index + 1) +'"></span>';
				        },
		     };
		    var galleryThumbs ='';
		    if($(this).parent().find('.gallery-thumbs').length){
		    	var navigation_gallery = $(this).parent().find('.gallery-thumbs').attr('data-navigation');
				if(navigation_gallery == '') navigation_gallery = {};
				else navigation_gallery = {
			        	nextEl: $(this).parent().find('.swiper-button-gallery-next').get(0),
			            prevEl: $(this).parent().find('.swiper-button-gallery-prev').get(0),
		        };


		    	var spaceBetween_gallery = Number($(this).parent().find('.gallery-thumbs').attr('data-space'));
				if(!spaceBetween_gallery) spaceBetween_gallery = 0;

		    	var slidesPerView_gallery = Number($(this).parent().find('.gallery-thumbs').attr('data-items'));	
				if(!slidesPerView_gallery) slidesPerView_gallery = 3;

		    	var items_widescreen_gallery = Number($(this).parent().find('.gallery-thumbs').attr('data-items-widescreen'));
				var items_laptop_gallery = Number($(this).parent().find('.gallery-thumbs').attr('data-items-laptop'));
				var items_tablet_extra_gallery = Number($(this).parent().find('.gallery-thumbs').attr('data-items-tablet-extra'));
				var items_tablet_gallery = Number($(this).parent().find('.gallery-thumbs').attr('data-items-tablet'));
				var items_mobile_extra_gallery = Number($(this).parent().find('.gallery-thumbs').attr('data-items-mobile-extra'));
				var items_mobile_gallery = Number($(this).parent().find('.gallery-thumbs').attr('data-items-mobile'));

				var space_widescreen_gallery = Number($(this).parent().find('.gallery-thumbs').attr('data-space-widescreen'));
				var space_laptop_gallery = Number($(this).parent().find('.gallery-thumbs').attr('data-space-laptop'));
				var space_tablet_extra_gallery = Number($(this).parent().find('.gallery-thumbs').attr('data-space-tablet-extra'));
				var space_tablet_gallery = Number($(this).parent().find('.gallery-thumbs').attr('data-space-tablet'));
				var space_mobile_extra_gallery = Number($(this).parent().find('.gallery-thumbs').attr('data-space-mobile-extra'));
				var space_mobile_gallery = Number($(this).parent().find('.gallery-thumbs').attr('data-space-mobile'));



				if(items_widescreen_gallery == '') items_widescreen_gallery = slidesPerView_gallery;
				if(items_laptop_gallery == '') items_laptop_gallery = slidesPerView_gallery;
				if(items_tablet_extra_gallery == '') items_tablet_extra_gallery = items_laptop_gallery;
				if(items_tablet_gallery == '') items_tablet_gallery = items_tablet_extra_gallery;
				if(items_mobile_extra_gallery == '') items_mobile_extra_gallery = items_tablet_gallery;
				if(items_mobile_gallery == '') items_mobile_gallery = items_mobile_extra_gallery;

				if(space_widescreen_gallery == '') space_widescreen_gallery = spaceBetween_gallery;
				if(space_laptop_gallery == '') space_laptop_gallery = spaceBetween_gallery;
				if(space_tablet_extra_gallery == '') space_tablet_extra_gallery = space_laptop_gallery;
				if(space_tablet_gallery == '') space_tablet_gallery = space_tablet_extra_gallery;
				if(space_mobile_extra_gallery == '') space_mobile_extra_gallery = space_tablet_gallery;
				if(space_mobile_gallery == '') space_mobile_gallery = space_mobile_extra_gallery;

			    var direction2 = $(this).parent().find('.gallery-thumbs').attr('data-direction');
		    	if(!direction2)  direction2 = 'horizontal';
		    	var select_gallery = $(this).parent().find('.gallery-thumbs').get(0);
				galleryThumbs = new Swiper(select_gallery, {
					spaceBetween: spaceBetween_gallery,
					slidesPerView: slidesPerView_gallery,
					direction: direction2,
					centeredSlides: centeredSlides,
					navigation: navigation_gallery,
					slideToClickedSlide: true,
					loop: loop,
					//freeMode: true,
					loopedSlides: 4, //looped slides should be the same
					breakpoints: {
					    0: {
					      	slidesPerView: items_mobile_gallery,
					      	spaceBetween: space_mobile_gallery
					    },
					    768: {
					      	slidesPerView: items_mobile_extra_gallery,
					      	spaceBetween: space_mobile_extra_gallery
					    },
					    881: {
					      	slidesPerView: items_tablet_gallery,
					      	spaceBetween: space_tablet_gallery
					    },
					    1025: {
					      	slidesPerView: items_tablet_extra_gallery,
					      	spaceBetween: space_tablet_extra_gallery
					    },
					    1201: {
					      	slidesPerView: items_laptop_gallery,
					      	spaceBetween: space_laptop_gallery
					    },
					    1367: {
					      	slidesPerView: slidesPerView_gallery,
					      	spaceBetween: spaceBetween_gallery
					    },
					    2401: {
					      	slidesPerView: items_widescreen_gallery,
					      	spaceBetween: space_widescreen_gallery
					    }
					},
					watchSlidesVisibility: true,
					watchSlidesProgress: true,
				});
			   
			}
		    if(slidertype == 'marquee'){
		    	var swiper2 = new Swiper(this,{
		    		spaceBetween: 0,
					centeredSlides: true,
					speed: 3000,
					autoplay: {
						delay: 1,
					},
					loop: true,
					slidesPerView:'auto',
					allowTouchMove: false,
					disableOnInteraction: true
		    	});
		    }else{
		    	var swiper = new Swiper(this, {
					autoHeight: false,
					direction: direction,
			      	slidesPerView: slidesPerView,
			      	spaceBetween: spaceBetween,
			      	grid: {
				        rows: slidesPerColumn,
				   		fill:slidesPerColumnFill,
				    },
			      	loop: loop,
			      	centeredSlides: centeredSlides,
			      	breakpoints: breakpoints,
			      	autoplay: autoplay,
			        navigation: navigation,
			        pagination: pagination,
			        observer: true,
					observeParents: true,
					effect: effect,
					fadeEffect: {
					    crossFade: true
					  },
			        scrollbar: {
				        el: scrollbar.get(0),
				        hide: true,
			            draggable : draggable,
				    },
				    thumbs: {
				        swiper: galleryThumbs,
				    },
				    on: {
				        
				        init: function () {
				          var activeIndex = this.activeIndex;
				          $('.swiper-slide').removeClass('bzotech-active-swiper');
				          var i;
				          for (i = activeIndex; i < number_active+activeIndex-1; i++){
				          	$('.swiper-slide:nth-child('+i+')').addClass('bzotech-active-swiper');
				          }
							bzotech_packery_masory();
				          
				        },
						slideChange: function () {

				          var activeIndex = this.activeIndex+1;
				          $('.swiper-slide').removeClass('bzotech-active-swiper');
				          var i;
				          for (i = activeIndex; i < number_active+activeIndex; i++){
				          	$('.swiper-slide:nth-child('+i+')').addClass('bzotech-active-swiper');
				          }
				          
				        },
				        transitionEnd: function () {
				        },
				    }
			    });
		    }
			if(slidertype == 'marquee'){
				$(this).on('mouseenter', function(e){
					swiper2.autoplay.stop();
				});
				$(this).on('mouseleave', function(e){
					swiper2.autoplay.start();
				});
			}
		})
	}
	function background_slider_swiper(){
		$('.bg-slider-swiper .swiper-thumb').each(function(){
			$(this).find('img').css('height',$(this).find('img').attr('height'));
			var src=$(this).find('img').attr('src');
			$(this).css('background-image','url("'+src+'")');
		});	
	}
    
    // login popup
    function login_popup(){
    	$('.popup-form').find('input:not(.button)').on('focusin',function(){    		
    		$(this).parent().addClass('input-focus');
    	}).on('focusout',function(){
    		$(this).parent().removeClass('input-focus');
    	})
    	$('.popup-form').find('input:not(.button)').each(function(){
    		if($(this).val()) $(this).parent().addClass('has-value');
    		else $(this).parent().removeClass('has-value');    		
    	})
    	$('.popup-form').find('input:not(.button)').on('keyup',function(){
    		$(this).parent().removeClass('invalid');
			if($(this).val()) $(this).parent().addClass('has-value');
			else $(this).parent().removeClass('has-value');
    	})
    	$('.open-login-form,.login-popup,.register-popup,.lostpass-popup').on('click',function(e){
    		if(!$(this).parents('.disable-popup').length > 0){
	    		e.preventDefault();
	    		$('.login-popup-content-wrap').fadeIn();
	    		if($(this).hasClass('register-popup')) $('.register-link').trigger('click');
	    		if($(this).hasClass('lostpass-popup')) $('.lostpass-link').trigger('click');
	    	}
    	})
    	$('.close-login-form,.popup-overlay').on('click',function(e){
    		e.preventDefault();
    		$('.login-popup-content-wrap').fadeOut();
    	})
    	$('.popup-redirect').on('click',function(e){
    		e.preventDefault();
    		var id = $(this).attr('href');
    		$('.ms-default').fadeOut();
    		$('.popup-form').removeClass('active');
			$(this).closest('.elbzotech-popup-open').find(id).parents('.popup-form').addClass('active');
    		//$(id).parents('.popup-form').addClass('active');
    	})
    	$('#login_error a').on('click',function(){
    		$('.lostpass-link').trigger('click');
    	})
    }

    // fix append css
    function fix_css_append(){
		var css_data = String($('#bzotech-theme-style-inline-css').html());
		$('#bzotech-theme-style-inline-css').remove();
	    if(css_data) $('head').append('<'+'style id="bzotech-theme-style-inline-css">'+css_data+'</style>');
    }
    // Letter popup
    function letter_popup(){
    	//Popup letter
		var content = $('#boxes-content').html();
		$('#boxes-content').html('');
		if(content) $('body').append('<div id="boxes">'+content+'</div>');
		if($('#boxes').html() != ''){
			var id = '#dialog';	
			//Get the screen height and width
			var maskHeight = $(document).height();
			var maskWidth = $(window).width();
		
			//Set heigth and width to mask to fill up the whole screen
			$('#mask').css({'width':maskWidth,'height':maskHeight});
			
			//transition effect		
			$('#mask').fadeIn(500);	
			$('#mask').fadeTo("slow",0.6);	
		
			//Get the window height and width
			var winH = $(window).height();
			var winW = $(window).width();
	              
			//Set the popup window to center
			$(id).css('top',  winH/2-$(id).height()/2);
			$(id).css('left', winW/2-$(id).width()/2);
		
			//transition effect
			$(id).fadeIn(2000); 	
		
			//if close button is clicked
			$('.window .close-popup').on('click',function (e) {
				//Cancel the link behavior
				e.preventDefault();
				
				$('#mask').hide();
				$('.window').hide();
			});		
			
			//if mask is clicked
			$('#mask').on('click',function () {
				$(this).hide();
				$('.window').hide();
			});
		}
		//End popup letter
    }

    /************** FUNCTION ****************/ 
    function tool_panel(){
    	$('.dm-open').on('click',function(){
    		$('#widget_indexdm').toggleClass('active');
    		$('#indexdm_img').toggleClass('active');
    		return false;
    	})
    	$('.dm-content .item-content').on('hover',function(){
    		if(!$(this).hasClass('active')){
    			$('.img-demo').removeClass('dm-scroll-img');
				setTimeout(function() {
					$('.img-demo').addClass('dm-scroll-img');
				},20);
    			$(this).parent().find('.item-content').removeClass('active');
    			$(this).addClass('active');
    		}
			$('#indexdm_img').addClass('active');
			var img_src = $(this).find('img').attr('data-src');			
			$('.img-demo').css('display','block');
			$('.img-demo').css('background-image','url('+img_src+')');
    	});
    	$('.img-demo').mouseenter(function(){
			$(this).addClass('pause');
	        }).mouseleave(function(){
	        $(this).removeClass('pause');
	    });
    	var default_data = $('#bzotech-theme-style-inline-css').html();    	
    	$('.dm-color').on('click',function(){
    		$(this).parent().find('.dm-color').removeClass('active');
    		$(this).addClass('active');
    		var color,color2,rgb,rgb2;
    		var data = $('.get-data-css').attr('data-css');
    		var sep = new RegExp('##', 'gi');
    		data = data.replace(sep,'"', -1);
    		// Color 1
    		var color_old = $('.get-data-css').attr('data-color');
    		var rgb_old = $('.get-data-css').attr('data-rgb');
    		var color_df = $('.get-data-css').attr('data-colordf');
    		var rgb_df = $('.get-data-css').attr('data-rgbdf');
    		if($(this).attr('data-color')) $('.get-data-css').attr('data-color',$(this).attr('data-color'));
    		if($(this).attr('data-rgb')) $('.get-data-css').attr('data-rgb',$(this).attr('data-rgb'));
    		color = $('.get-data-css').attr('data-color');    		
    		rgb = $('.get-data-css').attr('data-rgb');

    		// Color 2
    		var color2_old = $('.get-data-css').attr('data-color2');
    		var rgb2_old = $('.get-data-css').attr('data-rgb2');
    		var color2_df = $('.get-data-css').attr('data-color2df');
    		var rgb2_df = $('.get-data-css').attr('data-rgb2df');
    		if($(this).attr('data-color2')) $('.get-data-css').attr('data-color2',$(this).attr('data-color2'));
    		if($(this).attr('data-rgb2')) $('.get-data-css').attr('data-rgb2',$(this).attr('data-rgb2'));
    		color2 = $('.get-data-css').attr('data-color2');
    		rgb2 = $('.get-data-css').attr('data-rgb2');
    		if(color && color2){
    			// Color 1
	    		color_df = new RegExp(color_df, 'gi');
	    		rgb_df = new RegExp(rgb_df, 'gi');
	    		data = data.replace(color_df,color, -1);
	    		data = data.replace(rgb_df,rgb, -1);

	    		// Color 2
	    		color2_df = new RegExp(color2_df, 'gi');
	    		rgb2_df = new RegExp(rgb2_df, 'gi');
	    		data = data.replace(color2_df,color2, -1);
	    		data = data.replace(rgb2_df,rgb2, -1);

	    		if($('#bzotech-theme-style-inline-css').length > 0) $('#bzotech-theme-style-inline-css').html(data);
	    		else $('head').append('<'+'style id="bzotech-theme-style-inline-css">'+data+'</style>');
	    	}
	    	else $('#bzotech-theme-style-inline-css').html(default_data);
	    	return false;
    	})
    }
	function auto_width_megamenu(){
    	if($(window).width()>1200){
    		if($('.bzotech-container .mega-menu').length > 0){
		        var full_width = parseInt($('.bzotech-container .bzotech-container-width').innerWidth());
		        var container_offset = $('.bzotech-container .bzotech-container-width').offset().left;
		        setTimeout(function() {

		        var elementor_container_offset = $('.bzotech-container .elementor-container').offset().left;
		        if(elementor_container_offset<container_offset) container_offset= elementor_container_offset;
		        },2000);
		        var mega_menu_pos = $('.bzotech-container .mega-menu').attr('data-position');
		       
		        if($('.bzotech-menu-container').length > 0){
			        var main_menu_width = parseInt($('.bzotech-menu-container').innerWidth());
			        var main_menu_left = parseInt($('.bzotech-menu-container').offset().left);
			        var main_li_left = parseInt($('.bzotech-menu-container .bzotech-navbar-nav > li').first().offset().left);
			        var fix_space = main_li_left - main_menu_left;
			        $('.bzotech-menu-container .bzotech-navbar-nav > li.has-mega-menu').each(function(){
			        	if($(this).find('.mega-menu').length > 0){
			        		var mega_menu_width = parseInt($(this).find('.mega-menu').innerWidth());
			        		if(mega_menu_width > full_width){
			        			if($(window).width() < full_width + 30) mega_menu_width = full_width - 30;
			        			mega_menu_width = full_width;
			        			$(this).find('.mega-menu').css('max-width',mega_menu_width);
			        		}
					        var li_width = parseInt($(this).innerWidth());
					        var seff = $(this);
					        if($('.rtl').length > 0){
					        	setTimeout(function() {
					        		main_menu_left = parseInt($(window).width() - (seff.parents('.bzotech-menu-container').offset().left + seff.parents('.s7upf-menu-container').outerWidth()));
						        	var mega_menu_left = $(window).width() - (seff.find('.mega-menu').offset().left + seff.find('.mega-menu').outerWidth());
							        var li_left = $(window).width() - (seff.offset().left + seff.outerWidth());
							        var pos = li_left - mega_menu_left - mega_menu_width/2 + li_width/2;
							        var pos2 = pos + mega_menu_left + mega_menu_width - main_menu_left - main_menu_width;
							        if(pos2 > 0 ) pos = pos - pos2;
							        if(pos > 0 ) $(this).find('.mega-menu').css('right',pos);
							        else{
							        	pos  = $(window).width() - (container_offset + full_width) - main_menu_left + (full_width - mega_menu_width)/2;
							        	seff.find('.mega-menu').css('right',pos);
							        }
							       }, 2000);
					        }
					        else{
					        	
							        var mega_menu_left = $(this).find('.mega-menu').offset().left;
							        var li_left = $(this).offset().left;
							        var pos = li_left - mega_menu_left - mega_menu_width/2 + li_width/2;
							        var pos2 = pos + mega_menu_left + mega_menu_width - main_menu_left - main_menu_width;
							        if(pos2 > 0 ) pos = pos - pos2;
							        if(pos > 0 ){
							        	if(mega_menu_pos == 'left'){
							        		$(this).find('.mega-menu').css('left',pos-pos);
							        	}else if(mega_menu_pos == 'right'){
							        		$(this).find('.mega-menu').css('left',pos+pos);
							        	}else{
							        		$(this).find('.mega-menu').css('left',pos);
							        	}
							        	
							        }
							        else{
							        	pos  = container_offset - main_menu_left + (full_width - mega_menu_width)/2;
							        	
							        	
							        	if(mega_menu_pos == 'left'){
							        		$(this).find('.mega-menu').css('left',pos-((full_width - mega_menu_width)/2)-0.5);
							        	}else if(mega_menu_pos == 'right'){
							        		$(this).find('.mega-menu').css('left',pos+((full_width - mega_menu_width)/2)-0.5);
							        	}else{
							        		$(this).find('.mega-menu').css('left',pos);
							        	}
							        }
						    }
					    }
			        })
			    }
			}
	    }
    }
    //Detail Gallery

	function gallery_attachment_click(){
		if($('.gallery-attachment').length>0){

				$('.gallery-attachment').find("a").on('click',function(event) {
					event.preventDefault();
					$(this).parents('.gallery-attachment').find("a").removeClass('active');
					$(this).addClass('active');
					var z_url =  $(this).find('img').attr("data-src");
					$(this).parents('.product-thumb').find(".product-thumb-link img").attr("src", z_url);
				});
		}
	}
	function detail_gallery(){
		if($('.product-detail-gallery-js').length>0){
			$('.product-detail-gallery-js').each(function(){
                var seff = $(this);

                // vertical
                $('.gallery-vertical-mobi').each(function(){
                    var number = $(this).find('.gallery-slider').data('visible');
                    if($(window).width()<768){
                        number =2;
					} 
					var vertical = true;
					var prevArrow = '<button type="button"  class="slick-prev"><i class="las la-angle-up" aria-hidden="true"></i></button>';
					var nextArrow='<button type="button" class="slick-next"><i class="las la-angle-down" aria-hidden="true"></i></button>'
					if($(window).width()<1170){
						$(this).addClass('style-gallery-horizontal');
                     	$(this).removeClass('style-gallery-vertical'); 
                        vertical = false;
                       	prevArrow='<button type="button"  class="slick-prev"><i class="icon-bzo icon-bzo-left las la-angle-left" aria-hidden="true"></i></button>';
                        nextArrow= '<button type="button" class="slick-next"><i class="icon-bzo icon-bzo-right las la-angle-right" aria-hidden="true"></i></button>';   
					} else{
						$(this).removeClass('style-gallery-horizontal');
	                    $(this).addClass('style-gallery-vertical');
					}
                    $('.gallery-control .gallery-slider ').slick({
                        slidesToShow: number,
                        slidesToScroll: 1,
                        infinite: true,
                        focusOnSelect: true,
                        vertical: vertical,
                        verticalSwiping: true,
                        prevArrow: prevArrow,
                        nextArrow: nextArrow,
                        responsive: [
                            {
                                breakpoint: 1024,
                                settings: {
                                    slidesToShow: 3,
                                }
                            },
                            {
                                breakpoint: 480,
                                settings: {
                                    slidesToShow: 2,
                                }
                            }
                        ]
                    });

                });
                $('.style-gallery-vertical2').each(function(){
                    var number = $(this).find('.gallery-slider').data('visible');
                    if($(window).width()<768){
                        number =2;
					} 
					var vertical = true;
					var prevArrow = '<button type="button"  class="slick-prev"><i class="icon-bzo icon-bzo-up" aria-hidden="true"></i></button>';
					var nextArrow='<button type="button" class="slick-next"><i class="icon-bzo icon-bzo-down" aria-hidden="true"></i></button>'
					if($(window).width()<1170){
						$(this).addClass('style-gallery-horizontal style-gallery-vertical2-mobi');
                     	$(this).removeClass('style-gallery-vertical2'); 
                        vertical = false;
                       	prevArrow='<button type="button"  class="slick-prev"><i class="icon-bzo icon-bzo-left las la-angle-left" aria-hidden="true"></i></button>';
                        nextArrow= '<button type="button" class="slick-next"><i class="icon-bzo icon-bzo-right las la-angle-right" aria-hidden="true"></i></button>';   
					} else{
						$(this).removeClass('style-gallery-horizontal style-gallery-vertical2-mobi');
	                    $(this).addClass('style-gallery-vertical2');
					}
                    $('.gallery-control .gallery-slider ').slick({
                        slidesToShow: number,
                        slidesToScroll: 1,
                        infinite: true,
                        focusOnSelect: true,
                        vertical: vertical,
                        verticalSwiping: true,
                        prevArrow: prevArrow,
                        nextArrow: nextArrow,
                        responsive: [
                            {
                                breakpoint: 1024,
                                settings: {
                                    slidesToShow: 3,
                                }
                            },
                            {
                                breakpoint: 480,
                                settings: {
                                    slidesToShow: 2,
                                }
                            }
                        ]
                    });

                });
                // horizontal
                $('.gallery-horizontal-js,.style-image-small').each(function(){
                    var number = $(this).find('.gallery-slider').data('visible');
                    $('.gallery-control .gallery-slider ').slick({
                        dots: false,
                        nav: false,
                        infinite: false,
                        speed: 300,
                        slidesToShow: number,
                        slidesToScroll: 1,
                        focusOnSelect: true,
                        prevArrow: '<button type="button"  class="slick-prev"><i class="icon-bzo icon-bzo-left las la-angle-left" aria-hidden="true"></i></button>',
                        nextArrow: '<button type="button" class="slick-next"><i class="icon-bzo icon-bzo-right las la-angle-right" aria-hidden="true"></i></button>',
                        responsive: [
                            {
                                breakpoint: 1024,
                                settings: {
                                    slidesToShow: 3,
                                }
                            },
                            {
                                breakpoint: 480,
                                settings: {
                                    slidesToShow: 3,
                                }
                            }
                        ]
                    });
                });

				//Elevate Zoom				
				$.removeData($('.product-detail-gallery-js .mid img'), 'elevateZoom');//remove zoom instance from image
				$('.zoomContainer').remove();
				if($(window).width()>=1200){
					$(this).find('.zoom-style1 .mid img').elevateZoom();
					$(this).find('.zoom-style2 .mid img').elevateZoom({
						scrollZoom : true
					});
					$(this).find('.zoom-style3 .mid img').elevateZoom({
						zoomType: "lens",
						lensShape: "square",
						lensSize: 150,
						borderSize:1,
						containLensZoom:true,
						responsive:true
					});
					$(this).find('.zoom-style4 .mid img').elevateZoom({
						zoomType: "inner",
						cursor: "crosshair",
						zoomWindowFadeIn: 500,
						zoomWindowFadeOut: 750
					});
				}

				$(this).find(".carousel a").on('click',function(event) {
					event.preventDefault();
					$(this).parents('.product-detail-gallery-js').find(".carousel a").removeClass('active');
					$(this).addClass('active');
					var z_url =  $(this).find('img').attr("data-src");
					var srcset =  $(this).find('img').attr("data-srcset");
					var index =  Number($(this).parent().attr("data-number"));
					$(this).parents('.product-detail-gallery-js').find(".image-lightbox").attr("data-index",index-1);
					$(this).parents('.product-detail-gallery-js').find(".mid img").attr("src", z_url);
					$(this).parents('.product-detail-gallery-js').find(".mid img").attr("srcset", srcset);
					$('.zoomWindow,.zoomLens').css('background-image','url("'+z_url+'")');
					$.removeData($('.product-detail-gallery-js .mid img'), 'elevateZoom');//remove zoom instance from image
					$('.zoomContainer').remove();
					if($(window).width()>=1200){
						$(this).parents('.product-detail-gallery-js').find('.zoom-style1 .mid img').elevateZoom();
						$(this).parents('.product-detail-gallery-js').find('.zoom-style2 .mid img').elevateZoom({
							scrollZoom : true
						});
						$(this).parents('.product-detail-gallery-js').find('.zoom-style3 .mid img').elevateZoom({
							zoomType: "lens",
							lensShape: "square",
							lensSize: 150,
							borderSize:1,
							containLensZoom:true,
							responsive:true
						});
						$(this).parents('.product-detail-gallery-js').find('.zoom-style4 .mid img').elevateZoom({
							zoomType: "inner",
							cursor: "crosshair",
							zoomWindowFadeIn: 500,
							zoomWindowFadeOut: 750
						});
					}
				});
				$('input[name="variation_id"]').on('change',function(){
					var z_url =  seff.find('.mid img').attr("src");
					$('.zoomWindow,.zoomLens').css('background-image','url("'+z_url+'")');
					$.removeData($('.product-detail-gallery-js .mid img'), 'elevateZoom');//remove zoom instance from image
					$('.zoomContainer').remove();
					$('.product-detail-gallery-js').find('.zoom-style1 .mid img').elevateZoom();
					$('.product-detail-gallery-js').find('.zoom-style2 .mid img').elevateZoom({
						scrollZoom : true
					});
					$('.product-detail-gallery-js').find('.zoom-style3 .mid img').elevateZoom({
						zoomType: "lens",
						lensShape: "square",
						lensSize: 150,
						borderSize:1,
						containLensZoom:true,
						responsive:true
					});
					$('.product-detail-gallery-js').find('.zoom-style4 .mid img').elevateZoom({
						zoomType: "inner",
						cursor: "crosshair",
						zoomWindowFadeIn: 500,
						zoomWindowFadeOut: 750
					});
				})
				$('.image-lightbox').on('click',function(event){
					event.preventDefault();
                    var gallerys = $(this).attr('data-gallery');
					var index = Number($(this).attr('data-index'));
					var data_thumb = $(this).attr('data-thumb');
					var data_src = $(this).find('img').attr('src');
					var gallerys_array = gallerys.split(',');
                    var data = [];
					var data2 = [];
					var j = 0;
					var k = 0;
					var url_current = $(this).find('img').attr('src');
					if(gallerys != ''){
						for (var i = 0; i < gallerys_array.length; i++) {
							if(gallerys_array[i] != ''){
                                if(i >= index){
    								data[j] = {};
    								data[j] = gallerys_array[i];
    								j++;
                                }
                                else{
                                    data2[k] = {};
                                    data2[k] = gallerys_array[i];
                                    k++;
                                }
							}
						};
					}
                    if(data2.length>0) data = data.concat(data2);
                    if(data_thumb){
                    	var add_thumb = [];
                    	add_thumb[0] = {};
                    	add_thumb[0] = data_thumb;
                    	if(data_thumb == data_src) data = add_thumb.concat(data);
                    	else data = data.concat(add_thumb);
                    }
					const url_current_index = data.indexOf(url_current);
                    if (url_current_index > -1) { 
					  data.splice(url_current_index, 1); 
					}
                    data.unshift(url_current);
					$.fancybox.open(data);
				})
			});
		}
	}
	// 
	// Hide header on scroll down
	// var lastScroll = 0;
	// var isScrolled = false;
	// window.addEventListener("scroll", function () {
	//   var topHeader = document.querySelector(".header-page");
	//   var currentScroll =
	// 	window.pageYOffset ||
	// 	document.documentElement.scrollTop ||
	// 	document.body.scrollTop ||
	// 	0;
	//   var scrollDirection = currentScroll < lastScroll;
	//   var shouldToggle = isScrolled && scrollDirection;
	//   isScrolled = currentScroll > 100;
	//   topHeader.classList.toggle("active11", shouldToggle);
	//   lastScroll = currentScroll;
	// });
	

    // Menu fixed
	

    function fixed_header(){
        var menu_element;
        menu_element = $('.menu-sticky-on:not(.menu-fixed-content)').parents('.elementor-element').last();
        var lastScrollTop = 0;
       
		

        if($('.menu-sticky-on').length > 0 && $('.menu-sticky-on.style-menu-sticky-').length > 0 && $(window).width()>1200){           
            
            var menu_class = $('.main-nav').attr('class');
            var header_height = $("#header").height()+100;
            var ht = header_height + 150;
            var st = $(window).scrollTop();

            var check_scrollTop = false;
            var width_content_ = menu_element.find('>.e-con-inner').width();
           if(menu_element.hasClass('elementor-section-stretched')){
 				var data_setting = menu_element.attr('data-settings');
            	var setting = JSON.parse(data_setting);
            	if(!menu_element.hasClass('header-fixed') && setting.stretch_section == 'section-stretched')
           		menu_element.addClass('header-fixed');
            }
            window.addEventListener("scroll", function(){ // or window.addEventListener("scroll"....
			    var st = window.pageYOffset;
			    if (st > lastScrollTop || st<500){
				    	if(st<400){
					    	menu_element.removeClass('header-fixed');
					    }
				   		menu_element.removeClass('active');
				   
				    if(menu_element.hasClass('elementor-section-stretched')) {
				    	if(st<400){
				     		menu_element.removeClass('fixed-header');
				     	}
				     	 
				    }
		            else{
		                    if(menu_element.parent().parent().hasClass('fixed-header')){
		                    	menu_element.parent().parent().removeClass('active');
		                    	menu_element.unwrap();
			                    menu_element.unwrap(); 
		                    	                   
		                    }
		                }
	                $('body').removeClass('menu-on-fixed');
			    } else {

			           if( menu_element.hasClass('elementor-section-stretched')){
							menu_element.addClass('fixed-header');
		                    setTimeout(function() {
				               menu_element.addClass('active');
				            },500);
		                    $('body').addClass('menu-on-fixed');
		                }
		                else{
		                	setTimeout(function() {
			                    menu_element.parent().parent().addClass('active');
			                },500);

		                    if(!menu_element.parent().parent().hasClass('fixed-header')){
		                        menu_element.wrap( "<div class='menu-fixed-content fixed-header "+menu_class+"'><div class='container-menu-fix'></div></div>" );
							}

		                    $('body').removeClass('menu-on-fixed');
		                    menu_element.removeClass('vc_hidden');
		                }
			    }
			    lastScrollTop = st <= 0 ? 0 : st; // For Mobile or negative scrolling
			});
        }
		if($('.menu-sticky-on').length > 0 && $('.menu-sticky-on.style-menu-sticky-down').length > 0 && $(window).width()>1200){           
            
            var menu_class = $('.main-nav').attr('class');
            var header_height = $("#header").height()+100;
            var ht = header_height + 150;
            var st = $(window).scrollTop();

            var check_scrollTop = false;
            var width_content_ = menu_element.find('>.e-con-inner').width();
           	if(menu_element.hasClass('elementor-section-stretched')){
 				var data_setting = menu_element.attr('data-settings');
            	var setting = JSON.parse(data_setting);
            	if(!menu_element.hasClass('header-fixed') && setting.stretch_section == 'section-stretched')
           		menu_element.addClass('header-fixed');
            }
            window.addEventListener("scroll", function(){ // or window.addEventListener("scroll"....
			    var st = window.pageYOffset;
			    if (st<header_height){
				    	if(st<ht){
					    	menu_element.removeClass('header-fixed');
					    }
				   		menu_element.removeClass('active');
				   
				    if(menu_element.hasClass('elementor-section-stretched')) {
				    	if(st<ht){
				     		menu_element.removeClass('fixed-header');
				     	}
				     	 
				    }
		            else{
		                    if(menu_element.parent().parent().hasClass('fixed-header')){
		                    	menu_element.parent().parent().removeClass('active');
		                    	menu_element.unwrap();
			                    menu_element.unwrap(); 
		                    	                   
		                    }
		                }
	                $('body').removeClass('menu-on-fixed');
			    } else {

			           if( menu_element.hasClass('elementor-section-stretched')){
							menu_element.addClass('fixed-header');
		                    setTimeout(function() {
				               menu_element.addClass('active');
				            },500);
		                    $('body').addClass('menu-on-fixed');
		                }
		                else{
		                	setTimeout(function() {
			                    menu_element.parent().parent().addClass('active');
			                },500);

		                    if(!menu_element.parent().parent().hasClass('fixed-header')){
		                        menu_element.wrap( "<div class='menu-fixed-content fixed-header "+menu_class+"'><div class='container-menu-fix'></div></div>" );
							}

		                    $('body').removeClass('menu-on-fixed');
		                    menu_element.removeClass('vc_hidden');
		                }
			    }
			    lastScrollTop = st <= 0 ? 0 : st; // For Mobile or negative scrolling
			});
        }
        
    }
    //Menu Responsive
   function fix_click_menu(){
        if($(window).width()<=1200){
            if($('.btn-toggle-mobile-menu').length>0){
                return false;
            }
            else $('.bzotech-menu-inner li.menu-item-has-children,.bzotech-menu-inner li.has-mega-menu').append('<span class="btn-toggle-mobile-menu"></span>');
        }
        else{
            $('.btn-toggle-mobile-menu').remove();
            $('.bzotech-menu-inner .sub-menu,.bzotech-menu-inner .mega-menu').slideDown('fast');
        }
    }
	function rep_menu(){
		$('.toggle-mobile-menu').on('click',function(event){
            event.preventDefault();
            $(this).parent().toggleClass('active');
            $(this).next().slideToggle('fast');
        });
        $('.bzotech-menu-inner').on('click','.btn-toggle-mobile-menu',function(event){
            $(this).toggleClass('active');
            $(this).prev().stop(true,false).slideToggle('fast');
        });
        $('.bzotech-menu-inner').on('click','.menu-item > a[href="#"]',function(event){
            event.preventDefault();
            $(this).toggleClass('active');
            $(this).next().stop(true,false).slideToggle('fast');
        });
	}

    function background(){
		$('.bg-slider .item-slider').each(function(){
			$(this).find('.banner-thumb a img').css('height',$(this).find('.banner-thumb a img').attr('height'));
			var src=$(this).find('.banner-thumb a img').attr('src');
			$(this).css('background-image','url("'+src+'")');
		});	
	}
    
    function fix_variable_product(){
    	//Fix product variable thumb    	
        $('body .variations_form select').on('change',function(){
            var id = $('input[name="variation_id"]').val();
            if(id){
                $('.product-gallery #bx-pager').find('a[data-variation_id="'+id+'"]').trigger( 'click' );
            }
        })
        // variable product
        if($('.wrap-attr-product1.special').length > 0){
            $('.attr-filter ul li a').on('click',function(){
                event.preventDefault();
                $(this).parents('ul').find('li').removeClass('active');
                $(this).parent().addClass('active');
                var attribute = $(this).parent().attr('data-attribute');
                var id = $(this).parents('ul').attr('data-attribute-id');
                $('#'+id).val(attribute);
                $('#'+id).trigger( 'change' );
                $('#'+id).trigger( 'focusin' );
                return false;
            })
            $('.attr-hover-box').on('hover',function(){
                var seff = $(this);
                var old_html = $(this).find('ul').html();
                var current_val = $(this).find('ul li.active').attr('data-attribute');
                $(this).next().find('select').trigger( 'focusin' );
                var content = '';
                $(this).next().find('select').find('option').each(function(){
                    var val = $(this).attr('value');
                    var title = $(this).html();
                    var el_class = '';
                    if(current_val == val) el_class = ' class="active"';
                    if(val != ''){
                        content += '<li'+el_class+' data-attribute="'+val+'"><a href="#" class="bgcolor-'+val+'"><span></span>'+title+'</a></li>';
                    }
                })
                if(old_html != content) $(this).find('ul').html(content);
            })
            $('body .reset_variations').on('click',function(){
                $('.attr-hover-box').each(function(){
                    var seff = $(this);
                    var old_html = $(this).find('ul').html();
                    var current_val = $(this).find('ul li.active').attr('data-attribute');
                    $(this).next().find('select').trigger( 'focusin' );
                    var content = '';
                    $(this).next().find('select').find('option').each(function(){
                        var val = $(this).attr('value');
                        var title = $(this).html();
                        var el_class = '';
                        if(current_val == val) el_class = ' class="active"';
                        if(val != ''){
	                        content += '<li'+el_class+' data-attribute="'+val+'"><a href="#" class="bgcolor-'+val+'"><span></span>'+title+'</a></li>';
	                    }
                    })
                    if(old_html != content) $(this).find('ul').html(content);
                    $(this).find('ul li').removeClass('active');
                })
            })
        }
        //end
    }
    function beforeAction(event){
    	var element   = event.target;
    	var i = 0;
    	$(element).find('.owl-item').each(function(){
			$(this).find('[data-animated]').each(function(){
				var anime = $(this).attr('data-animated');
				if(event.item.index == i){
					$(this).addClass(anime);
					$(this).addClass('animated');
				}
				else{
					$(this).removeClass(anime);
					$(this).removeClass('animated');
				}
			})
			i++;
		})
	}
    function afterAction(event){
    	var element   = event.target;
		$(element).find('.owl-item').each(function(){
			var check = $(this).hasClass('active');
			if(check==true){
				$(this).attr('class','owl-item active');
				$(this).find('[data-animated]').each(function(){
					var anime = $(this).attr('data-animated');
					$(this).addClass(anime);
					$(this).addClass('animated');
				});
			}else{
				$(this).attr('class','owl-item');
				$(this).find('[data-animated]').each(function(){
					var anime = $(this).attr('data-animated');
					$(this).removeClass(anime);
					$(this).removeClass('animated');
				});
			}
		})
	}
    function bzotech_qty_click(){
    	//QUANTITY CLICK
		$("body").on("click",".detail-qty .qty-up",function(){
            var min = $(this).prev().attr("min");
            var max = $(this).prev().attr("max");
            var step = $(this).prev().attr("step");
            if(step === undefined) step = 1;
            if(max !==undefined && Number($(this).prev().val())< Number(max) || max === undefined || max === ''){ 
                if(step!=''){
                	var up = Number($(this).prev().val())+Number(step);
                	$(this).prev().val(up);
                	$(this).parents('.cart').find('.ajax_add_to_cart').attr('data-quantity',up);
                } 
            }
            $( 'div.woocommerce form .button[name="update_cart"]' ).prop( 'disabled', false );
            return false;
        })
        $("body").on("click",".detail-qty .qty-down",function(){
            var min = $(this).next().attr("min");
            var max = $(this).next().attr("max");
            var step = $(this).next().attr("step");
            if(step === undefined) step = 1;
            if(Number($(this).next().val()) > Number(min)){
	            if(min !==undefined && $(this).next().val()>min || min === undefined || min === ''){
	                if(step!=''){
	                	var down =Number($(this).next().val())-Number(step);
	                	$(this).next().val(down);
	               	 	$(this).parents('.cart').find('.ajax_add_to_cart').attr('data-quantity',down);
	                }
	            }
	        }
	        $( 'div.woocommerce form .button[name="update_cart"]' ).prop( 'disabled', false );
	        return false;
        })
        $("body").on("keyup change","input.qty-val",function(){
        	$( 'div.woocommerce form .button[name="update_cart"]' ).prop( 'disabled', false );
        })
		//END
    }
    
    function bzotech_owl_slider(){
    	//Carousel Slider
		if($('.sv-slider').length>0){
			var rtl = false;
			if($('.rtl-enable').length>0) rtl = true;
			$('.sv-slider').each(function(){
				var seff = $(this);
				var item = seff.attr('data-item');
				var speed = seff.attr('data-speed');
				var itemres = seff.attr('data-itemres');
				var nav = seff.attr('data-navigation');
				var pag = seff.attr('data-pagination');
				var text_prev = seff.attr('data-prev');
				var text_next = seff.attr('data-next');
				var margin = seff.attr('data-margin');
				var stage_padding = seff.attr('data-stage_padding');
				var start_position = seff.attr('data-start_position');
				var merge = seff.attr('data-merge');
				var loop = seff.attr('data-loop');
				var mousewheel = seff.attr('data-mousewheel');
				var animation_out = seff.attr('data-animation_out');
				var animation_in = seff.attr('data-animation_in');
				if(animation_in == 'none' || animation_in == undefined) animation_in = '';
				if(animation_out == 'none' || animation_out == undefined) animation_out = '';
				var pagination = false, navigation= false, singleItem = false;
				var autoplay;
				var autoplaytimeout = 5000;
				if(!margin) margin = 0;
				if(!stage_padding) stage_padding = 0;
				if(!start_position) start_position = 0;
				if(!merge) merge = false; else merge = true;
				if(!loop) loop = false; else loop = true;
				if(!mousewheel) mousewheel = false; else mousewheel = true;
				if(speed != ''){
					autoplay = true;
					autoplaytimeout = parseInt(speed, 10);
				}
				else autoplay = false;
				// Navigation
				if(nav) navigation = true;
				if(pag) pagination = true;
				var prev_text = '<i class="fa fa-angle-left" aria-hidden="true"></i>';
				var next_text = '<i class="fa fa-angle-right" aria-hidden="true"></i>';
				if(text_prev) prev_text = text_prev;
				if(text_next) next_text = text_next;
				if(itemres == '' || itemres === undefined){
					if(item == '1') itemres = '0:1,480:1,768:1,1200:1';
					if(item == '2') itemres = '0:1,480:1,768:2,1200:2';
					if(item == '3') itemres = '0:1,480:2,768:2,992:3';
					if(item == '4') itemres = '0:1,480:2,840:3,1200:4';
					if(item >= '5') itemres = '0:1,480:2,768:3,1024:4,1200:'+item;
				}
				itemres = itemres.split(',');
				var responsive = {};
				var i;
				for (i = 0; i < itemres.length; i++) { 
				    itemres[i] = itemres[i].split(':');
				    var res_dv = {};
				    res_dv.items = parseInt(itemres[i][1], 10);
				    responsive[itemres[i][0]] = res_dv;
				}
				seff.owlCarousel({
					items: parseInt(item, 10),
				    margin: parseInt(margin, 10),
				    loop: loop,
				    stagePadding: parseInt(stage_padding, 10),
				    startPosition: parseInt(start_position, 10),
				    nav:navigation,
				    navText: [prev_text,next_text],
				    responsive: responsive,
				    autoplay: autoplay,
				    autoplayTimeout: autoplaytimeout,
				    animateOut: animation_out,
				    animateIn: animation_in,
				    dots: pagination,
				    onTranslate: beforeAction,
				    onInitialize:background,
				    rtl: rtl,
				    rewind: true,
				});
				if(mousewheel){
					seff.on('mousewheel', '.owl-stage', function (e) {
					    if (e.deltaY>0) {
					        seff.trigger('next.owl');
					    } else {
					        seff.trigger('prev.owl');
					    }
					    e.preventDefault();
					});
				}
			});			
		}
    }

    function bzotech_all_slider(seff,number){
    	if(!seff) seff = $('.smart-slider');
    	if(!number) number = '';
    	//Carousel Slider
		if(seff.length>0){
			var rtl = false;
			if($('.rtl-enable').length>0) rtl = true;
			seff.each(function(){
				var seff = $(this);
				var item = seff.attr('data-item');
				var speed = seff.attr('data-speed');
				var itemres = seff.attr('data-itemres');
				var nav = seff.attr('data-navigation');
				var pag = seff.attr('data-pagination');
				var text_prev = seff.attr('data-prev');
				var text_next = seff.attr('data-next');
				var margin = seff.attr('data-margin');
				var stage_padding = seff.attr('data-stage_padding');
				var start_position = seff.attr('data-start_position');
				var merge = seff.attr('data-merge');
				var loop = seff.attr('data-loop');
				var mousewheel = seff.attr('data-mousewheel');
				var animation_out = seff.attr('data-animation_out');
				var animation_in = seff.attr('data-animation_in');
				if(animation_in == 'none' || animation_in == undefined) animation_in = '';
				if(animation_out == 'none' || animation_out == undefined) animation_out = '';
				var pagination = false, navigation= false, singleItem = false;
				var autoplay;
				var autoplaytimeout = 5000;
				if(!margin) margin = 0;
				if(!stage_padding) stage_padding = 0;
				if(!start_position) start_position = 0;
				if(!merge) merge = false; else merge = true;
				if(!loop) loop = false; else loop = true;
				if(!mousewheel) mousewheel = false; else mousewheel = true;
				if(speed != ''){
					autoplay = true;
					autoplaytimeout = parseInt(speed, 10);
				}
				else autoplay = false;
				// Navigation
				if(nav) navigation = true;
				if(pag) pagination = true;
				var prev_text = '<i class="fa fa-angle-left" aria-hidden="true"></i>';
				var next_text = '<i class="fa fa-angle-right" aria-hidden="true"></i>';
				if(text_prev) prev_text = text_prev;
				if(text_next) next_text = text_next;
				if(itemres == '' || itemres === undefined){
					if(item == '1') itemres = '0:1,480:1,768:1,1200:1';
					if(item == '2') itemres = '0:1,480:1,768:2,1200:2';
					if(item == '3') itemres = '0:1,480:2,768:2,992:3';
					if(item == '4') itemres = '0:1,480:2,840:3,1200:4';
					if(item >= '5') itemres = '0:1,480:2,768:3,1024:4,1200:'+item;
				}
				itemres = itemres.split(',');
				var responsive = {};
				var i;
				for (i = 0; i < itemres.length; i++) { 
				    itemres[i] = itemres[i].split(':');
				    var res_dv = {};
				    res_dv.items = parseInt(itemres[i][1], 10);
				    responsive[itemres[i][0]] = res_dv;
				}
				seff.owlCarousel({
					items: parseInt(item, 10),
				    margin: parseInt(margin, 10),
				    loop: loop,
				    stagePadding: parseInt(stage_padding, 10),
				    startPosition: parseInt(start_position, 10),
				    nav:navigation,
				    navText: [prev_text,next_text],
				    responsive: responsive,
				    autoplay: autoplay,
				    autoplayTimeout: autoplaytimeout,
				    animateOut: animation_out,
				    animateIn: animation_in,
				    dots: pagination,
				    onTranslate: beforeAction,
				    onInitialize:background,
				    rtl: rtl,
				    rewind: true,
				});
				if(mousewheel){
					seff.on('mousewheel', '.owl-stage', function (e) {
					    if (e.deltaY>0) {
					        seff.trigger('next.owl');
					    } else {
					        seff.trigger('prev.owl');
					    }
					    e.preventDefault();
					});
				}
			});			
		}
    }
    
    function bzotech_product_tabs(){
    	 if($('.detail-product-tabs').length>0){
            $( ".detail-product-tabs .product-tab-content .tab-pane" ).not(':first-child').removeClass( "active");
        }
        if($('.detail-product-tabs').hasClass('tab-product-vertical_mobi')){
            if($(window).width()<=991){

                $('.detail-product-tabs').removeClass('tab-product-vertical');
                $('.detail-product-tabs').addClass('tab-product-horizontal');

            }else {

                $('.detail-product-tabs').removeClass('tab-product-horizontal');
                $('.detail-product-tabs').addClass('tab-product-vertical');
            }
        }
    }
    function bzotech_product_gallery_sticky(){
    	if($('.detail-gallery-sticky').length > 0){
            $('.detail-gallery-sticky').each(function(){
                var self = $(this);
                var info = self.parents('.product-detail').find('.product-detail-info');
                if($(window).width()>1170){
                    if($('.fixed-header').hasClass('active')){
               
                        self.parents('.product-detail').addClass('detail-on-sticky-menu');
                    }else{
                        self.parents('.product-detail').removeClass('detail-on-sticky-menu');
                    } 
                    var st = $(window).scrollTop();
                    var ot = self.offset().top;
                    var sh = self.height();
                    var dh = info.height();
                    var stop = sh - dh;
                    var top = st - ot + 150;
                    if(st < ot){
                        info.css('top',0);
                    }
                    if(st > ot && st < ot+sh-dh){
                        info.css('top',top+'px');
                    }
                    if(st > ot+sh-dh){
                        info.css('top',stop+'px');
                    }
                    info.css('position','absolute');
                }else{
                    info.css('top',0);
                    info.css('position','relative');
                }
            });
        }
        if($('.detail-gallery-sticky-style3').length > 0){
            $('.detail-gallery-sticky-style3').each(function(){
               var self = $(this);
               
               var offset_top = self.parents('.product-detail').find('.set_offset_top');
                var info = self.parents('.product-detail').find('.tab-style-sticky-style3');
                var info_top = self.parents('.product-detail').find('.product-detail-info');
                if($(window).width()>1170){
                    if($('.fixed-header').hasClass('active')){
               
                        self.parents('.product-detail').addClass('detail-on-sticky-menu');
                    }else{
                        self.parents('.product-detail').removeClass('detail-on-sticky-menu');
                    } 
                   
                    	info_top = info_top.height();
                    	var st = $(window).scrollTop();
					
                    	var self_stop = self.parents('.detail-sticky-style3');
					 
						var cc = self_stop.offset().top;
	                    var ot = offset_top.offset().top;
	                    var h_self_stop = self_stop.height();
	                    var self_stop = offset_top.offset().self_stop;
	                    
	                    var sh = self.height();
	                    var dh = info.height();
	                    var stop = (cc+h_self_stop)-dh;
	                    var top = st - ot;
					
	                    if(st < ot){
	                        info.css('top',0);
	                    }
	                    if(st > ot && st < ot+sh-dh){
	                        info.css('top',top+'px');
	                    } 
	                    if(st > stop){
	                        info.css('top',stop-dh-info_top+'px');
	                    }
                    info.css('position','absolute');
                }else{
                    info.css('top',0);
                    info.css('position','relative');
                }
            });
        }
    }
    
    function bzotech_attribute_data_color(){
    	if($('.attribute_data-custom').length>0){
            $('.attribute_data-custom .attribute-custom').on('click',function () {
                var image = $(this).attr('data-image');
                var image2 = $(this).attr('data-image2');
                if($(this).hasClass('active-att')){
                    var image_goc = $(this).parents('.attribute_data-custom').attr('data-imggoc');
                    var image_goc2 = $(this).parents('.attribute_data-custom').attr('data-imggoc2');
                    $(this).parents('.item-product').find('.product-thumb a img:first-child').attr('src',image_goc);
                    $(this).parents('.item-product').find('.product-thumb a img:first-child').attr('srcset',image_goc);
                    if(image_goc2){
                        $(this).parents('.item-product').find('.product-thumb a img:last-child').attr('src',image_goc2);
                        $(this).parents('.item-product').find('.product-thumb a img:last-child').attr('srcset',image_goc2);
                    }
                    $(this).removeClass('active-att');
                }else{
                    $(this).parents('.item-product').find('.product-thumb a img:first-child').attr('src',image);
                    $(this).parents('.item-product').find('.product-thumb a img:first-child').attr('srcset',image);
                    if(image2){
                        $(this).parents('.item-product').find('.product-thumb a img:last-child').attr('src',image2);
                        $(this).parents('.item-product').find('.product-thumb a img:last-child').attr('srcset',image2);
                    }

                    $('.attribute_data-custom .attribute-custom').removeClass('active-att');
                    $(this).toggleClass('active-att');
                }
            })
        }
    }
    function bzotech_accordion_e(){
    	if($('.elbzotech-accordion').length>0){
    		 $('.elbzotech-accordion').each(function(){
    		 	var active = $(this).data('active');
    		 	var animate = $(this).data('animate');
    		 	var heightStyle = $(this).data('heightstyle');
    		 	$(this).accordion(
    		 		{
					  active:active,
					  animate: animate,
					  heightStyle: heightStyle,
					}
    		 	);
    		 })
        }
    }
    	

    function bzotech_packery_masory(){
    	if($('.grid-masory-packery').length>0){
    		setTimeout(function() {
    		$('.grid-masory-packery').each(function(){
    			
	    			$(this).packery({
					  // options
					  itemSelector: '.width_masory',
					  gutter: 0
					});
				
    		});
		 	},500);
		 }
    }
	function bzotech_after_append_footer(){
    	if($('.after-append-footer').length>0){
    		//setTimeout(function() {
    			var h_after_footer = $('.after-append-footer').height();
	    		$('.footer-page').css('margin-bottom',h_after_footer);
		 	//},500);
		 }
    }
    function bzotech_column_grid(){
    	if($('.blog-grid-view,.product-grid-view').length>0){
	       	$('.blog-grid-view,.product-grid-view').each(function(){
 				var items_custom = $(this).data('column-grid');
 				if(items_custom){
					items_custom = items_custom.split(',');
					
					var i;
					for (i = 0; i < items_custom.length; i++) { 
						items_custom[i] = items_custom[i].split(':');
					    if($(window).width()>items_custom[i][0]){
					    	$(this).find('.list-col-item').css('width',100/items_custom[i][1]+'%');
					    }
					}
					
				
				}
	       	})
	    }
    }
    function bzotech_set_min_height_main_content(){
    	if($('.footer-default').length>0){
	       	var h_main = $('#main-content').height();
	       	var h_header = $('.header-default').height();
	       	var h_footer = $('.footer-default').height();
	       	var h_adminbar = $('#wpadminbar').height();
	       	var h_w = window.innerHeight;
	       	h_main =h_main+ h_header;

	       	if(h_main<h_w){
	       		var h_css = h_w - (h_footer+h_header+h_adminbar);
	       		$('#main-content').css('min-height',h_css);
	       	}
	    }
    }
    //Detect Closest Edge
	function closestEdge(x,y,w,h) {
	    var topEdgeDist = distMetric(x,y,w/2,0);
	    var bottomEdgeDist = distMetric(x,y,w/2,h);
	    var leftEdgeDist = distMetric(x,y,0,h/2);
	    var rightEdgeDist = distMetric(x,y,w,h/2);
	    var min = Math.min(topEdgeDist,bottomEdgeDist,leftEdgeDist,rightEdgeDist);
	    switch (min) {
	        case leftEdgeDist:
	            return "left";
	        case rightEdgeDist:
	            return "right";
	        case topEdgeDist:
	            return "top";
	        case bottomEdgeDist:
	            return "bottom";
	    }
	}

	//Distance Formula
	function distMetric(x,y,x2,y2) {
	    var xDiff = x - x2;
	    var yDiff = y - y2;
	    return (xDiff * xDiff) + (yDiff * yDiff);
	}	
    function box_hover_dir() {
		var boxes = $(".box-hover-dir");

		for(var i = 0; i < boxes.length; i++){

		    boxes[i].onmouseenter = function(e){
		        var x = e.pageX - this.offsetLeft;
		        var y = e.pageY - this.offsetTop;
		        var edge = closestEdge(x,y,this.clientWidth, this.clientHeight);
		        var overlay = this.childNodes[1];
		        var image = this.childNodes[0];

		        switch(edge){
		            case "left":
		                //tween overlay from the left
		                overlay.style.top = "0%";
		                overlay.style.left = "-100%";
		                TweenMax.to(overlay, .5, {left: '0%'});
		                TweenMax.to(image, .5, {scale: 1.2});
		                break;
		            case "right":
		                overlay.style.top = "0%";
		                overlay.style.left = "100%";
		                //tween overlay from the right
		                TweenMax.to(overlay, .5, {left: '0%'});
		                TweenMax.to(image, .5, {scale: 1.2});
		                break;
		            case "top":
		                overlay.style.top = "-100%";
		                overlay.style.left = "0%";
		                //tween overlay from the right
		                TweenMax.to(overlay, .5, {top: '0%'});
		                TweenMax.to(image, .5, {scale: 1.2});
		                break;
		            case "bottom":
		                overlay.style.top = "100%";
		                overlay.style.left = "0%";
		                //tween overlay from the right
		                TweenMax.to(overlay, .5, {top: '0%'});
		                TweenMax.to(image, .5, {scale: 1.2});
		                break;
		        }
		    };

		   
		    boxes[i].onmouseleave = function(e){
		        var x = e.pageX - this.offsetLeft;
		        var y = e.pageY - this.offsetTop;
		        var edge = closestEdge(x,y,this.clientWidth, this.clientHeight);
		        var overlay = this.childNodes[1];
		        var image = this.childNodes[0];

		        switch(edge){
		            case "left":
		                TweenMax.to(overlay, .5, {left: '-100%'});
		                TweenMax.to(image, .5, {scale: 1.0});
		                break;
		            case "right":
		                TweenMax.to(overlay, .5, {left: '100%'});
		                TweenMax.to(image, .5, {scale: 1.0});
		                break;
		            case "top":
		                TweenMax.to(overlay, .5, {top: '-100%'});
		                TweenMax.to(image, .5, {scale: 1.0});
		                break;
		            case "bottom":
		                TweenMax.to(overlay, .5, {top: '100%'});
		                TweenMax.to(image, .5, {scale: 1.0});
		                break;
		        }
		    };
		}
    }

    function bzotech_tab() {
    	if($('*[data-toggle="tab"]').length>0){
    		$('*[data-toggle="tab"]').on('click',function(e){
    			e.preventDefault();
    			$(this).parents('*[role="tablist"]').find('.active').removeClass('active');
    			$('.tab-pane').removeClass('active');
    			$(this).parent().addClass('active');
    			var id = $(this).attr('href');
    			$(id).addClass('active');
    		})
    	}
    }

	function slick_control(seff){
		var seff_active = seff.find('.slick-active');
		var check_prev = seff_active.prev().attr('data-slick-index');
		var check_next = seff_active.next().attr('data-slick-index');

		if(check_prev !== undefined) seff.find('.slick-prev').html(seff_active.prev().find('.client-thumb a').html());
		else seff.find('.slick-prev').html(seff.find('.item-client').last().find('.client-thumb a').html());

		if(check_next !== undefined) seff.find('.slick-next').html(seff_active.next().find('.client-thumb a').html());
		else seff.find('.slick-next').html(seff.find('.item-client').first().find('.client-thumb a').html());

	}
    
    /************ END FUNCTION **************/  
	$(document).ready(function(){		
		//Menu Responsive 
		bzotech_tab();
		letter_popup();
		fix_click_menu();
		rep_menu();
		bzotech_qty_click();
		detail_gallery();
		gallery_attachment_click();
		tool_panel();
		bzotech_product_gallery_sticky();
		bzotech_attribute_data_color();
		bzotech_accordion_e();
		bzotech_column_grid();
		bzotech_set_min_height_main_content();
		if($('.client-slider .slick').length>0){
			$('.client-slider .slick').each(function(){
				$(this).slick({
					// fade: true,
					infinite: true,
					initialSlide:1,
					slidesToShow: 1,
					prevArrow:'<div class="slick-prev slick-nav"></div>',
					nextArrow:'<div class="slick-next slick-nav"></div>',
				});
				var seff = $(this);
				slick_control(seff);
				$('.slick').on('afterChange', function(event){
					slick_control(seff);
				});
			});
		}

		$('.client-slider .slick-arrow img').click(function(){
			$('.client-slider .slick-arrow img').addClass('testi-active');
		});
		$('body').on('click','.search-icon-popup',function(e){
			e.preventDefault();
			$(this).parents('.elbzotech-search-wrap').addClass('open-search-popup');
		})
		$('body').on('click','.elbzotech-close-search-form',function(e){
			$(this).parents('.elbzotech-search-wrap').removeClass('open-search-popup');
		})
		if($('.elbzotech-mailchimp-style2').length>0){
			$('.elbzotech-mailchimp-style2 .elbzotech-close-popup').on('click',function(){
				$(this).parents('.elbzotech-mailchimp-style2').addClass('hide');
			})
			setTimeout(function() {
				$('.elbzotech-mailchimp-style2').addClass('actived');
			},3000);
		}
		$( ".addcart-link" ).click(function() {
			$( ".product-mini-cart" ).addClass( "bzotech-2" );
		  });
		//Accordion product
        if($('.tab-product-accordion-js').length>0){
            $('.tab-product-accordion-js').each(function () {
                var active = $(this).attr('data-active');
                $(this).accordion(
                    {
                        heightStyle: "content",
                        active: parseInt(active-1),
                        icons: { "header": "icon-bzo icon-bzo-dow", "activeHeader": "icon-bzo icon-bzo-up" }
                    }
                );
            })
        }
		$('.write-a-review').on('click',function(){
			$('#review_form_wrapper').slideToggle();
		})
		$('.search-icon-popup').on('click',function(){
			$('.elbzotech-search-form-wrap').addClass('active');
		})
		$('.elbzotech-close-search-form').on('click',function(){
			$('.elbzotech-search-form-wrap').removeClass('active');
		})
		$('.elbzotech-wrapper-slider-style2__open-close').on('click',function(){
			$('.elbzotech-wrapper-slider-style2').slideToggle();
			$(this).toggleClass('active');
		})
		$('body').on('click','.elbzotech-account-manager',function(){
			$(this).find('.elbzotech-popup-overlay').addClass('elbzotech-popup-open');
		})
		$('body').on('click','.elbzotech-close-popup',function(e){
			e.preventDefault();
			e.stopPropagation();
			$(this).parents('.elbzotech-popup-overlay').removeClass('elbzotech-popup-open');
		})
		if($('.widget_archive select').length>0){
			$('.widget_archive select').parents('.sidebar-widget').addClass('widget-select-type');
		}
		$('.elbzotech-tabs .header-tab .tab-item-wrap>a').on('click',function(){

			setTimeout(function() {
				bzotech_packery_masory();
			},100);
		})
		
 		if($('.list-service-home1').length>0){
 			$('.list-service-home1 .elementor-widget-bzotech_info_box').hover(function(){
 				$('.list-service-home1 .elementor-widget-bzotech_info_box').removeClass('active_hover');
 				$(this).addClass('active_hover');
 			})
        };
		
		 //Final Countdown

        if($('.final-countdown').length>0){
	       	$('.final-countdown').each(function(){
                var self = $(this);
                var finalDate = self.data('countdown');
                self.countdown(finalDate, function(event) {
                    self.html(event.strftime(''
                        +'<div class="clock day"><strong class="number">%D</strong><span class="text">DAYS</span></div>'
                        +'<div class="clock hour"><strong class="number">%H</strong><span class="text">HUR</span></div>'
                        +'<div class="clock min"><strong class="number">%M</strong><span class="text">MIN</span></div>'
                        +'<div class="clock sec"><strong class="number">%S</strong><span class="text">SEC</span></div>'
                    ));
                });
            });
        }
        if($('.bzotech-countdown').length>0){
       
            $('.bzotech-countdown').each(function(){
                var self = $(this);
                var finalDate = self.data('date');
                var html_date = self.html();
                self.countdown(finalDate, function(event) {
                    self.html(event.strftime(''+html_date
                    ));
                });
            });
        }



		if($(window).width()>1170 && $('.margin-left-by-container').length>0){
			var left_content = $('.bzotech-container').offset().left;
			$('.margin-left-by-container>div').css('margin-left',left_content+15+'px');
		}
		if($(window).width()>1170 && $('.margin-right-by-container').length>0){
			var right_content = $('.bzotech-container').offset().left;
			$('.margin-right-by-container>div').css('margin-right',right_content+15+'px');
		}

	
		$('.popup-gallery-quickview').each(function() { 
			$(this).magnificPopup({
				delegate: 'a',
				type: 'image',
				tLoading: 'Loading image #%curr%...',
				mainClass: 'mfp-img-mobile',
				gallery: {
					enabled: true,
					navigateByImgClick: true,
					preload: [0,1] // Will preload 0 - before current, and 1 after the current image
				},
				image: {
					tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
					titleSrc: function(item) {
						return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
					}
				}
			});
		})
		
		$('.element_calculator').on('click','.submit',function(){
			var sale_price = $(this).parents('.element_calculator').find('.sale-price').val();
			var interest_rate = $(this).parents('.element_calculator').find('.interest-rate').val();
			var year = $(this).parents('.element_calculator').find('.year').val();
			var down_payment = $(this).parents('.element_calculator').find('.down-payment').val();
			var currency = $(this).parents('.element_calculator').find('.sale-price').data('currency');
			var validation_text = $(this).parents('.element_calculator').find('.sale-price').data('validation');
			var lai_xuat = (sale_price - down_payment)*((interest_rate/100)/12);
			var kq = (sale_price - down_payment)/12 + lai_xuat;
			if(sale_price !='' && interest_rate !='' && year !=''&& down_payment !=''){
				
				$(this).parents('.element_calculator').find('.item-output').removeClass('active-validation');
				$(this).parents('.element_calculator').find('.item-output').addClass('active');
				$(this).parents('.element_calculator').find('.output-price').html(Math.round((kq + 0.00001) * 100) / 100 + currency+'/mo');
			}else{
				$(this).parents('.element_calculator').find('.item-output').removeClass('active');
				$(this).parents('.element_calculator').find('.item-output').addClass('active-validation');
				$(this).parents('.element_calculator').find('.output-price').html(validation_text);
			}
			
		})
		$('body').on('click','.toggler-icon',function(){
			$(this).toggleClass('menu-open');
			$(this).parents('.bzotech-menu-container').find('.bzotech-menu-inner').toggleClass('menu-side-active');
			$(this).parents('.bzotech-menu-container').find('.bzotech-navbar-nav').toggleClass('bzotech-scrollbar');
		})
		$('body').on('click','.close-menu',function(){
			$(this).parents('.bzotech-menu-container').find('.toggler-icon .bzotech-menu-toggler').removeClass('menu-open');
			$(this).parents('.bzotech-menu-container').find('.bzotech-menu-inner').removeClass('menu-side-active');
			$(this).parents('.bzotech-menu-container').find('.bzotech-navbar-nav').removeClass('bzotech-scrollbar');
		})
		$('body').on('click','.menu-style-icon .indicator-icon',function(){
			$(this).parent().parent().toggleClass('sub-open');
			return false;
		})
		// Filter click
		$('body').on('click','.btn-filter',function(){
			$(this).parents('.filter-product').toggleClass('active');
			return false;
		})

		/*add class elementor accordion*/
		
		if($('.elementor-accordion').length>0){
			setTimeout(function() {
			if ($('.elementor-accordion .elementor-tab-title').hasClass( 'elementor-active' ) ){
					$('.elementor-accordion .elementor-active').parent().addClass('active-item-accor');
				}
			},500);
			$('.elementor-accordion .elementor-tab-title').on('click',function(){
				$(this).parents('.elementor-accordion').find('.elementor-accordion-item').removeClass('active-item-accor');
				
				if (!$(this).hasClass( 'elementor-active' ) ){
					$(this).parent().addClass('active-item-accor');
				}
			});

		}

		//Filter Price

		if($('.range-filter').length>0){
			$('.range-filter').each(function(){
				var self = $(this);
				var min_price = Number(self.find('.slider-range').attr( 'data-min' ));
				var max_price = Number(self.find('.slider-range').attr( 'data-max' ));
				self.find( ".slider-range" ).slider({
					range: true,
					min: min_price,
					max: max_price,
					values: [ min_price, max_price ],
					slide: function( event, ui ) {
						self.find( '.element-get-min' ).html(ui.values[ 0 ]);
						self.find( '.element-get-max' ).html(ui.values[ 1 ]);
					}
				});
			});
		}
		//fix row bg
		$('.fix-row-bg').each(function(){
			var row_class = $(this).attr('class');
			row_class = row_class.replace('vc_row wpb_row','');
			$(this).removeClass(row_class);
			$(this).removeClass('fix-row-bg');
			$(this).wrap('<div class="wrap-vc-row'+row_class+'"></div>');
		})
		//Cat search
		$('.select-cat-search').on('click',function(event){
			event.preventDefault();
			$(this).parents('ul').find('li').removeClass('active');
			$(this).parent().addClass('active');
			var x = $(this).attr('data-filter');
			if(x){
				x = x.replace('.','');
				$('.cat-value').val(x);
			}
			else $('.cat-value').val('');
			$('.current-search-cat').text($(this).text());
		});
		// aside-box cart
		$('.close-minicart').on('click',function(event){
			$('body').removeClass('overlay');
			$('.mini-cart-content').removeClass('active');
		});
		$('.mini-cart-box.aside-box .mini-cart-link').on('click',function(event){
			event.preventDefault();
			event.stopPropagation();
			$('body').addClass('overlay');
			$(this).next().addClass('active');
		});
		//Count item cart
        if($(".get-cart-number").length){
            var count_cart_item = $(".get-cart-number").val();
            $(".set-cart-number").html(count_cart_item);
        }

		//Fix mailchimp
        $('.sv-mailchimp-form').each(function(){
             var placeholder = $(this).attr('data-placeholder');
             var submit = $(this).attr('data-submit');
             var icon = $(this).attr('data-icon');
             if(placeholder) $(this).find('input[name="EMAIL"]').attr('placeholder',placeholder);
             if(submit) {
             	$(this).find('input[type="submit"]').val(submit);
             	$(this).find('button[type="submit"]').html(submit);
             }
             if(icon) {
             	$(this).find('button[type="submit"]').html('<i class="'+icon+'"></i>');
             }
             if(icon && submit) {
             	$(this).find('button[type="submit"]').html('<i class="'+icon+'"></i>'+submit);
             }
			 var submit_bt= $(this).find('.input-newletter');
			 submit_bt.on('blur', function(){
				if (this.value=='') this.placeholder = placeholder;
			 });
			 submit_bt.on('focus', function(){
				if (this.value=='') this.placeholder = '';
			 });

         })      
        //Back To Top
		$('.scroll-top,.scroll-top-footer').on('click',function(event){
			event.preventDefault();
			$('html, body').animate({scrollTop:0}, 'slow');
		});	
		var quantity = $('.product-detail-info .cart input[name="quantity"]').val();
        $('.ajax_add_to_cart').attr('data-quantity',quantity);
        $('.product-detail-info .cart input[name="quantity"]').on('change',function(){
            var quantity = $(this).val();
        	$('.ajax_add_to_cart').attr('data-quantity',quantity);
        })

		setTimeout(function() {
		   $('body').removeClass('bzotech-elementor-layout-shifts');
		},20000);

	});

	$(window).load(function(){
		bzotech_swiper_slider();
		background_slider_swiper()
		fix_css_append();
		login_popup();
		fixed_header();
		bzotech_product_tabs();
		bzotech_after_append_footer();
		
		if($('.hover-desr-list').length>0){
            $(".hover-desr-list").each(function(){
                var height = $(this).find('.product-desc').height();
                if(height>=136){
                    $(this).addClass('hover-desr-list-active');
                }
                $(this).find('.more-details-btn').on('click',function () {
                    $(this).parents('.hover-desr-list').addClass('hover-desr-list_on');
                    $(this).parents('.hover-desr-list').css('max-height',height+'px');
                })
            })
        }
		
		if($('.box-hover-dir').length>0){
			$('.box-hover-dir').each( function() {
				$(this).hoverdir(); 
			});
		}

		if($('.active-center-hover-dir').length>0){
			$('.active-center-hover-dir .item-grid-post-style6:nth-child(2)').addClass('active');
			$('.active-center-hover-dir .blog-grid-post-item-style6').on('mousemove',function(){
				$('.active-center-hover-dir .item-grid-post-style6').removeClass('active');
			}).on('mouseout',function(){
	    		$('.active-center-hover-dir .item-grid-post-style6:nth-child(2)').addClass('active');
	    	})
			
		}
		
		//Pre Load
		$('body').removeClass('preload');
		// Fix height slider
		$('.banner-slider .banner-info').each(function(){
			if($(this).find('.slider-content-text').length > 0){
				var height_content = $(this).find('.slider-content-text')["0"].clientHeight;
				$(this).css('height',height_content);
			}
		})
		// menu fixed onload
		// $("#header").css('min-height','');
        // if($(window).width()>1024){
        //     $("#header").css('min-height',$("#header").height());
            
        // }
        // else{
        //     $("#header").css('min-height','');
        // }
		//menu fix
		if($(window).width() >= 768){
			var c_width = $(window).width();
			$('.menu-style- ul ul ul.sub-menu').each(function(){
				var left = $(this).offset().left;
				if(c_width - left < 250){
					$(this).css({"left": "-100%"})
				}
				if(left < 250){
					$(this).css({"left": "100%"})
				}
			})
		}
		//Menu mobi set left
        if($(window).width()<=1201 && $('.bzotech-menu-container').length>0){
            var check_drive =15;
            if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
                check_drive=0;
            }
            setTimeout(function() {
                var left = ($(window).width() - ( $('.bzotech-menu-container.menu-style- ,.bzotech-menu-container.menu-style-style2,.bzotech-menu-container.menu-style-style3, .bzotech-menu-container.menu-style-style4').offset().left + $('.bzotech-menu-container.menu-style-,.bzotech-menu-container.menu-style-style2,.bzotech-menu-container.menu-style-style3,.bzotech-menu-container.menu-style-style4').outerWidth()));
               
                $('.bzotech-menu-container.menu-style- .bzotech-menu-inner,.bzotech-menu-container.menu-style-style2 .bzotech-menu-inner').css({'right': -(left + check_drive)});
            },500);

        }else  $('.bzotech-menu-container .bzotech-menu-inner').css({'right':''});
        
        if($('.elbzotech-mini-cart-dropdown').length>0){
			if($(window).width()<=767){
	            var check_drive2 =30;
	            if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
	                check_drive2=15;
	            }
	            setTimeout(function() {
	                var left = ($(window).width() - ( $('.elbzotech-mini-cart-dropdown').offset().left + $('.elbzotech-mini-cart-dropdown').outerWidth()));
	                $('.elbzotech-mini-cart-dropdown .mini-cart-content').css({'right': -(left),'padding-left': (check_drive2)});
	            },500);

	        }else  $('.elbzotech-mini-cart-dropdown .mini-cart-content').css({'right':'','padding-left':''});	
        }
        var lastScrollTop = 0;
		window.addEventListener("scroll", function(){ // or window.addEventListener("scroll"....
		   var st = window.pageYOffset;
		   if (st > lastScrollTop || st<200){
		   
				$('.scroll-top').removeClass('active');
		   } else {
		   		$('.scroll-top').addClass('active');
		   }
		   lastScrollTop = st <= 0 ? 0 : st; // For Mobile or negative scrolling
		}); 
		auto_width_megamenu();
		setTimeout(function() {
		   $('body').removeClass('bzotech-elementor-layout-shifts');
		},50);
	});// End load

	/* ---------------------------------------------
     Scripts resize
     --------------------------------------------- */
    var w_width = $(window).width();
    $(window).resize(function(){
    	
		bzotech_column_grid();
		bzotech_set_min_height_main_content();
		bzotech_after_append_footer();
    	var crWidth = $(window).width();
    	if(crWidth != w_width) auto_width_megamenu();
    	bzotech_product_gallery_sticky();
		if($(window).width()>1170 && $('.margin-left-by-container').length>0 ){

			var left_content = $('.bzotech-container').offset().left;
			$('margin-left-by-container>div').css('margin-left',left_content+15+'px');
		}
		if($(window).width()>1170 && $('.margin-right-by-container').length>0 ){
			var right_content = $('.bzotech-container').offset().left;
			$('.margin-right-by-container>div').css('margin-right',right_content+15+'px');
		}
		
    	fix_click_menu();

    	if($('#dialog').length > 0){
	    	// popup resize
			var id = '#dialog';	
			//Get the screen height and width
			var maskHeight = $(document).height();
			var maskWidth = $(window).width();
		
			//Set heigth and width to mask to fill up the whole screen
			$('#mask').css({'width':maskWidth,'height':maskHeight});
		
			//Get the window height and width
			var winH = $(window).height();
			var winW = $(window).width();
	              
			//Set the popup window to center
			$(id).css('top',  winH/2-$(id).height()/2);
			$(id).css('left', winW/2-$(id).width()/2);
		}
        // $("#header").css('min-height','');
        //Menu mobi set left
        if($(window).width()<=1201 && $('.bzotech-menu-container').length>0){
            var check_drive =15;
            if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
                check_drive=0;
            }
            setTimeout(function() {
                var left = ($(window).width() - ( $('.bzotech-menu-container.menu-style- ,.bzotech-menu-container.menu-style-style2,.bzotech-menu-container.menu-style-style4').offset().left + $('.bzotech-menu-container.menu-style-,.bzotech-menu-container.menu-style-style2,.bzotech-menu-container.menu-style-style4').outerWidth()));
              
                $('.bzotech-menu-container.menu-style- .bzotech-menu-inner,.bzotech-menu-container.menu-style-style2 .bzotech-menu-inner, .bzotech-menu-container.menu-style-style4 .bzotech-menu-inner').css({'right': -(left + check_drive)});
            },500);

        }else  $('.bzotech-menu-container.menu-style- .bzotech-menu-inner').css({'right':''});
        
        if($('.elbzotech-mini-cart-dropdown').length>0){
			if($(window).width()<=767){
	            var check_drive2 =30;
	            if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
	                check_drive2=15;
	            }
	            setTimeout(function() {
	                var left = ($(window).width() - ( $('.elbzotech-mini-cart-dropdown').offset().left + $('.elbzotech-mini-cart-dropdown').outerWidth()));
	                $('.elbzotech-mini-cart-dropdown .mini-cart-content').css({'right': -(left),'padding-left': (check_drive2)});
	            },500);

	        }else  $('.elbzotech-mini-cart-dropdown .mini-cart-content').css({'right':'','padding-left':''});	
        }
    });

	jQuery(window).scroll(function(){
		bzotech_product_gallery_sticky();
		// if($(window).width()>1170){
        //     $("#header").css('min-height',$("#header").height());
        // }
        // else{
        //     $("#header").css('min-height','');
        // }
		
	});// End Scroll

	$.fn.tawcvs_variation_swatches_form = function () {
        return this.each( function() {
            var $form = $( this ),
                clicked = null,
                selected = [];

            $form
                .addClass( 'swatches-support' )
                .on( 'click', '.swatch', function ( e ) {
                    e.preventDefault();
                    var $el = $( this ),
                        $select = $el.closest( '.value' ).find( 'select' ),
                        attribute_name = $select.data( 'attribute_name' ) || $select.attr( 'name' ),
                        value = $el.data( 'value' );

                    $select.trigger( 'focusin' );

                    // Check if this combination is available
                    if ( ! $select.find( 'option[value="' + value + '"]' ).length ) {
                        $el.siblings( '.swatch' ).removeClass( 'selected' );
                        $select.val( '' ).change();
                        $form.trigger( 'tawcvs_no_matching_variations', [$el] );
                        return;
                    }

                    clicked = attribute_name;

                    if ( selected.indexOf( attribute_name ) === -1 ) {
                        selected.push(attribute_name);
                    }

                   if ( $el.hasClass( 'selected' ) ) {
                        $select.val( '' );
                        $el.removeClass( 'selected' );

                        delete selected[selected.indexOf(attribute_name)];
                    } else {
                    	$el.parents('.tawcvs-swatches').find('.swatch ').removeClass( 'selected' );
                        $el.addClass( 'selected' ).siblings( '.selected' ).removeClass( 'selected' );
                        $select.val( value );
                    }
                    $select.change();
                } )
                .on( 'click', '.reset_variations', function () {
                    $( this ).closest( '.variations_form' ).find( '.swatch.selected' ).removeClass( 'selected' );
                    selected = [];
                } )
                .on( 'tawcvs_no_matching_variations', function() {
                    window.alert( wc_add_to_cart_variation_params.i18n_no_matching_variations_text );
                } );
        } );
    };

    $( function () {
        $( '.variations_form' ).tawcvs_variation_swatches_form();
        $( document.body ).trigger( 'tawcvs_initialized' );
    } );
	if ($(window).width() <= 767) {
	var active_tab = $('.product-tab-title .nav-tabs .tab-item-wrap.active a').text();
    $('.tabs-drop-mobile').text(active_tab);
    $('.tabs-drop-mobile').on('click', function(){
        $(this).closest('.product-tab-title').toggleClass('active');
    });
    $('.product-tab-title .nav-tabs .tab-item-wrap').on('click', function(){
        var tit = $(this).find('a').text();
        $('.tabs-drop-mobile').text(tit);
        $(this).closest('.product-tab-title').removeClass('active');
    });
	}
	
})(jQuery);



