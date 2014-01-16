;(function($) {

	window.main = {
		vars: {},
		init: function(){
			
			var header = main.vars.header = $('#header'),
				mainNavigation = header.mainNavigation = $('.main-navigation', header);


			$('.share-popup-btn').on('click', function(){
				var url = $(this).attr('href'),
					width = 640,
					height = 305,
					left = ($(window).width() - width) / 2,
					top = ($(window).height() - height) / 2;
				window.open(url, 'sharer', 'toolbar=0,status=0,width='+width+',height='+height+',left='+left+', top='+top);
				return false;
			});

			$('.print-btn').on('click', function(e){
				e.preventDefault();
				window.print();
			});

			$('.mobile-navigation-btn', header).on('click', function(){
				mainNavigation.slideToggle(200);
			});

			$('.menu-item .sub-menu', mainNavigation).parent().addClass('has-sub-menu');
			

			$('.checkout-button').on('click', function(){
				var form = $('.cart-form');
				$('.proceed').val(1);
				form.submit();
			});

			$('.added-to-cart .close-btn', header).on('click', function(){
				$('.added-to-cart', header).fadeOut();
			});

			this.lightbox.init();
			this.ajaxPage.init();
			this.scroller.init();
			this.accordion.init();
		

			$(window).on('resize', this.resize);
			this.resize();

		},

		loaded: function(){
			$('body').addClass('loaded');
			this.equalHeight();
			setTimeout(main.scroller.resize, '1000');
		},

		lightbox: {
			init: function(){
				var container = main.lightbox.container = $('#lightbox'),
					overlay = main.lightbox.overlay = $('.overlay', container),
					content = main.lightbox.content = $('.content', container),
					loader = main.lightbox.loader = $('.loader', container);

				$('.lightbox-btn').on('click', main.lightbox.open);
				overlay.on('click', main.lightbox.close);
				$(document).on('click', '#lightbox .close-btn', main.lightbox.close);
			},
			open: function(e){
				e.preventDefault();
				main.lightbox.load($(this).attr('href'));
			},
			load: function(url){
				var container = main.lightbox.container,
					overlay = main.lightbox.overlay,
					content = main.lightbox.content,
					loader = main.lightbox.loader,
					documentHeight = $(document).height(),
					windowHeight = $(window).height(),
					scrollTop = $(window).scrollTop(),
					ajaxUrl = main.addToUrl(url, 'ajax'),
					lightboxUrl = main.addToUrl(ajaxUrl, 'lightbox');

				container.height(documentHeight);
				container.show();
				loader.fadeIn();
				content.hide();
				overlay.fadeIn('slow', function(){
					
					$.get(lightboxUrl, function(data) {
						content.html(data);
						loader.fadeOut(function(){
							
							if($.fn.imagesLoaded){
								content.imagesLoaded(function(){
									var top = scrollTop + (windowHeight - content.height()) / 2;
									if(top + content.height() > documentHeight - 60){
										top = documentHeight - content.height() - 60;
									}
									content.animate({top: top}, function(){
										content.fadeIn();
									});
								});
							} else {
								var top = scrollTop + (windowHeight - content.height()) / 2;
								if(top + content.height() > documentHeight - 60){
									top = documentHeight - content.height() - 60;
								}
								container.animate({top: top}, function(){
									content.fadeIn();
								});
							}	
						});	
						
					});
				});	

			},
			close: function(){
				var container = main.lightbox.container,
					overlay = main.lightbox.overlay,
					content = main.lightbox.content;

				content.fadeOut(function(){
					overlay.fadeOut(function(){
						container.hide();
					});
					content.html();
				});
			}
		},

		accordion: {
			init: function(){
				$('.accordion li .btn').on('click', function(){
					$(this).parent().find('.content').slideToggle();
				});
			}
		},
		zoom: {
			init: function(){
				if($.fn.elevateZoom){
					var image = $('.zoom img');
					image.elevateZoom({
						tint:true,
						tintColour:'#FFF',
						tintOpacity:0.5,
						borderSize: 0,
						zoomWindowPosition: 1,
						zoomWindowOffetx: 20,
						zoomWindowFadeIn: 500,
						zoomWindowFadeOut: 500,
						zoomWindowWidth: 480,
						zoomWindowHeight: image.height(),
						lensFadeIn: 500,
						lensFadeOut: 500,
						easing: true,
						lensBorderSize: 0,
						cursor: 'pointer',
						responsive: true
					});
				}
			}
		},

		scroller: {
			init: function(){
				var scrollers = main.scroller.scrollers = $('.scroller');
				if($.fn.scroller){
					scrollers.each(function(){
						var scroller = $(this),
							options = {};

						if(scroller.data('scroll-all') === true) options.scrollAll = true;
						if(scroller.data('auto-scroll') === true ) options.autoScroll = true;
						if(scroller.data('resize') === true ) options.resize = true;
						if(scroller.data('next-on-click') === true ) options.nextOnClick = true;
						if(scroller.data('on-change')) {
							scroller.bind('onChange', function(e, nextItem){
								var func = window[scroller.data('on-change')];
								func($(this), nextItem);
							});
						}

						scroller.scroller(options);
					});
					main.scroller.resize();
				}
			},
			resize: function(){
				if($.fn.scroller && main.scroller.scrollers){
					main.scroller.scrollers.each(function(){
						var scroller = $(this);
						if($('.scroll-items-container', scroller).length > 0){
							$('.scroll-item', scroller).width($(window).width() / 3);
							scroller.trigger('resizeScroller');
						}

					});
				}
			}
		},


		ajaxPage: {
			init: function(){
				var container = main.ajaxPage.container = $('#ajax-page'),
					//currUrl = main.ajaxPage.currUrl = window.location.href;
					pageUrl = main.ajaxPage.pageUrl = window.location.href;
				
				$('.ajax-btn').on('click', function(e){
					main.ajaxPage.load($(this).attr('href'));
					return false;
				});

			},
			load: function(url){

				var container = main.ajaxPage.container,
					ajaxUrl = main.addToUrl(url, 'ajax');

				
				container.slideDown(2000);
				if($('.content', container).length === 0){

					loader = $('<div class="loader"></div>').hide();
					container.animate({height: loader.actual('outerHeight')}, function(){
						loader.fadeIn();

						$.get(ajaxUrl, function(data) {
							var content = $('<div class="content"></div>').hide();

							container.html(content);
							content.html(data);
							loader.fadeOut(function(){
								if($.fn.imagesLoaded){
									content.imagesLoaded(function(){
										container.animate({'height': content.height()}, function(){
											container.css({'height': 'auto'});
											content.fadeIn();
											container.slideDown('slow');
										});
									});
								} else {
									container.animate({'height': content.actual('height')}, function(){
										container.css({'height': 'auto'});
										content.fadeIn();
									});
								}	
							});

						});
					});
				} else {
					var content = $('.content', container),
						loader = $('<div class="loader"></div>').hide();
					container.prepend(loader);
					content.fadeTo(300, 0, function(){
						loader.fadeIn();
						$.get(ajaxUrl, function(data) {
							content.html(data);
							loader.fadeOut(function(){
								container.animate({'height': content.actual('height')}, function(){
									content.fadeTo(300, 1);
									container.css({'height': 'auto'});
								});
							});
						});
					});
				}

				//main.ajaxPage.currUrl = url;
			}, 
			close: function(){
				var container = main.ajaxPage.container;

				container.slideUp(function(){
					container.html('');
				});

				//if(Modernizr.history) history.pushState(null, null, main.ajaxPage.pageUrl);
			}
		},

		addToUrl: function(url, query){
			var regex = new RegExp('(\\?|\\&)'+query+'=.*?(?=(&|$))'),
				qstring = /\?.+$/;

			if (regex.test(url)){
				url = url.replace(regex, '$1'+query+'=true');
			} else if (qstring.test(url)) {
				url = url + '&'+query+'=true';
			} else {
				url =  url + '?'+query+'=true';
			}

			return url;		
		},

		equalHeight: function(){
			if($('.equal-height').length !== 0){
		
				var currTallest = 0,
				currRowStart = 0,
				rowDivs = [],
				topPos = 0;

				$('.equal-height').each(function() {

					var element = $(this);
					topPos = element.position().top;
					if (currRowStart != topPos) {

						for (i = 0; i < rowDivs.length ; i++) {
							rowDivs[i].height(currTallest);
						}

						rowDivs.length = 0;
						currRowStart = topPos;
						currTallest = element.height();
						rowDivs.push(element);

					} else {
						rowDivs.push(element);
						currTallest = (currTallest < element.height()) ? (element.height()) : (currTallest);
					}

					for (i = 0 ; i < rowDivs.length ; i++) {
						rowDivs[i].height(currTallest);
					}

				});
			}
		},

		resize: function(){
			var windowWidth = $(window).width(),
				mainNavigation = main.vars.header.mainNavigation;
			
			if(windowWidth <= 600 && mainNavigation.is(':visible')){
				mainNavigation.hide();
			} else if(windowWidth > 600 && !mainNavigation.is(':visible')) {
				mainNavigation.show();
			}

			main.equalHeight();
			main.scroller.resize();
		}
	};

	$(function(){
		main.init();
	});

	$(window).load(function(){
		main.loaded();
	});
})(jQuery);
