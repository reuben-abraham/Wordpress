(function ($) {
	/* ------------------------------ */
	/* Advance accordion
	/* ------------------------------ */
	var WidgetAccordionHandler = function($scope, $) {

		var $plusadv_accordion = $scope.find('.theplus-accordion-wrapper');
		var $this =  $plusadv_accordion,
			$accordionID                = $this.attr('id'),
			$currentAccordion           = $('#'+$accordionID),
			$accordionType              = $this.data('accordion-type'),
			$accordionSpeed             = $this.data('toogle-speed'),
			$accrodionList              = $this.find('.theplus-accordion-item'),
			$PlusAccordionListHeader    = $accrodionList.find('.plus-accordion-header');

		$accrodionList.each(function(i) {
			if( $(this).find($PlusAccordionListHeader).hasClass('active-default') ) {
				$(this).find($PlusAccordionListHeader).addClass('active');
				$(this).find('.plus-accordion-content').addClass('active').css('display', 'block').slideDown($accordionSpeed);
			}
		});

		if( 'accordion' == $accordionType ) {
			$PlusAccordionListHeader.on('click', function() {
				//Check if 'active' class is already exists
				if( $(this).hasClass('active') ) {
					$(this).removeClass('active');
					$(this).next('.plus-accordion-content').removeClass('active').slideUp($accordionSpeed);
				}else {
					$PlusAccordionListHeader.removeClass('active');
					$PlusAccordionListHeader.next('.plus-accordion-content').removeClass('active').slideUp($accordionSpeed);
			
					$(this).toggleClass('active');
					$(this).next('.plus-accordion-content').slideToggle($accordionSpeed, function() {
						$(this).toggleClass('active');
					});
				}
			});			
		}		
		if( 'toggle' == $accordionType ) {
			$PlusAccordionListHeader.on('click', function() {
				if( $(this).hasClass('active') ) {
					$(this).removeClass('active');
					$(this).next('.plus-accordion-content').removeClass('active').slideUp($accordionSpeed);
				}else {
					$(this).toggleClass('active');
					$(this).next('.plus-accordion-content').slideToggle($accordionSpeed, function() {
						$(this).toggleClass('active');
					});
				}
			});
		}
	}; // End of advance accordion
	/* ------------------------------ */
	/* Advance Tab
	/* ------------------------------ */
	var WidgetTabHandler = function ($scope, $) {

		jQuery(document).ready(function($) {
			var $currentTab = $scope.find('.theplus-tabs-wrapper'),				
				$TabHover = $currentTab.data('tab-hover'),
				
				$currentTabId = '#' + $currentTab.attr('id').toString();
				
				$($currentTabId + ' ul.plus-tabs-nav li .plus-tab-header').each( function(index) {
					var default_active=$(this).closest('.theplus-tabs-wrapper').data("tab-default");
					if( default_active == index ) {
						$(this).removeClass('inactive').addClass('active');
					}
				} );

				$($currentTabId + ' .theplus-tabs-content-wrapper .plus-tab-content').each( function(index) {
					var default_active=$(this).closest('.theplus-tabs-wrapper').data("tab-default");
					if( default_active == index ) {
						$(this).removeClass('inactive').addClass('active');
					}
				} );
				if('no' == $TabHover){
					$($currentTabId + ' ul.plus-tabs-nav li .plus-tab-header').click(function(){
						var currentTabIndex = $(this).data("tab");
						var tabsContainer = $(this).closest('.theplus-tabs-wrapper');
						var tabsNav = $(tabsContainer).children('ul.plus-tabs-nav').children('li').children('.plus-tab-header');
						var tabsContent = $(tabsContainer).children('.theplus-tabs-content-wrapper').children('.plus-tab-content');
					
						$(tabsContainer).find(".plus-tab-header").removeClass('active default-active').addClass('inactive');
						$(this).addClass('active').removeClass('inactive');
					
						$(tabsContainer).find(".plus-tab-content").removeClass('active').addClass('inactive');
					$('.theplus-tabs-content-wrapper',tabsContainer).find("[data-tab='"+currentTabIndex+"']").addClass('active').removeClass('inactive');
					
						$(tabsContent).each( function(index) {
							$(this).removeClass('default-active');
						});
						$($currentTabId+" .list-carousel-slick > .post-inner-loop").slick('setPosition');
					});
				}
				
				if($($currentTabId).hasClass("mobile-accordion")){
					$(window).resize(function(){
						if($(window).innerWidth() <= 600){
							$($currentTabId).addClass("mobile-accordion-tab");
						}
					});
					$($currentTabId + ' .theplus-tabs-content-wrapper .elementor-tab-mobile-title').click(function(){
						var currentTabIndex = $(this).data("tab");
						var tabsContainer = $(this).closest('.theplus-tabs-wrapper');
						var tabsNav = $(tabsContainer).children('.theplus-tabs-content-wrapper').children('.elementor-tab-mobile-title');
						var tabsContent = $(tabsContainer).children('.theplus-tabs-content-wrapper').children('.plus-tab-content');
					
						$(tabsContainer).find(".elementor-tab-mobile-title").removeClass('active default-active').addClass('inactive');
						$(this).addClass('active').removeClass('inactive');
					
						$(tabsContainer).find(".plus-tab-content").removeClass('active').addClass('inactive');
					$('.theplus-tabs-content-wrapper',tabsContainer).find("[data-tab='"+currentTabIndex+"']").addClass('active').removeClass('inactive');
					
						$(tabsContent).each( function(index) {
							$(this).removeClass('default-active');
						});
						$($currentTabId+" .list-carousel-slick > .post-inner-loop").slick('setPosition');
					});
				}
				
		});
	}; // End of advance tabs
	
	/* smooth scroll page */
	var WidgetSmoothScrollHandler = function ($scope, $) {

		jQuery(document).ready(function($) {
			var $container = $('.plus-smooth-scroll', $scope);
			if($container.length){
				var data_frameRate=($container.attr("data-frameRate") == undefined) ? 150 : $container.attr("data-frameRate"),
					data_animationTime=($container.attr("data-animationTime") == undefined) ? 1000 : $container.attr("data-animationTime"),
					data_stepSize=($container.attr("data-stepSize") == undefined) ? 100 : $container.attr("data-stepSize"),
					data_pulseScale=($container.attr("data-pulseScale") == undefined) ? 4 : $container.attr("data-pulseScale"),
					data_pulseNormalize=($container.attr("data-pulseNormalize") == undefined) ? 1 : $container.attr("data-pulseNormalize"),
					data_accelerationDelta=($container.attr("data-accelerationDelta") == undefined) ? 50 : $container.attr("data-accelerationDelta"),
					data_accelerationMax=($container.attr("data-accelerationMax") == undefined) ? 3 : $container.attr("data-accelerationMax"),
					data_arrowScroll=($container.attr("data-arrowScroll") == undefined) ? 50 : $container.attr("data-arrowScroll");				
				
					$('head').append('<style>.magic-scroll .parallax-scroll, .magic-scroll .scale-scroll, .magic-scroll .both-scroll{-webkit-transition: -webkit-transform 1.3s ease .0s;-ms-transition: -ms-transform 1.3s ease .0s;-moz-transition: -moz-transform 1.3s ease .0s;-o-transition: -o-transform 1.3s ease .0s;transition: transform 0s ease .0s;will-change: transform;}</style>');
				
				!function(){function e(){z.keyboardSupport&&m("keydown",a)}function t(){if(!Y&&document.body){Y=!0;var t=document.body,o=document.documentElement,n=window.innerHeight,r=t.scrollHeight;if(A=document.compatMode.indexOf("CSS")>=0?o:t,D=t,e(),top!=self)O=!0;else if(te&&r>n&&(t.offsetHeight<=n||o.offsetHeight<=n)){var a=document.createElement("div");a.style.cssText="position:absolute; z-index:-10000; top:0; left:0; right:0; height:"+A.scrollHeight+"px",document.body.appendChild(a);var i;T=function(){i||(i=setTimeout(function(){L||(a.style.height="0",a.style.height=A.scrollHeight+"px",i=null)},500))},setTimeout(T,10),m("resize",T);var l={attributes:!0,childList:!0,characterData:!1};if(M=new W(T),M.observe(t,l),A.offsetHeight<=n){var c=document.createElement("div");c.style.clear="both",t.appendChild(c)}}z.fixedBackground||L||(t.style.backgroundAttachment="scroll",o.style.backgroundAttachment="scroll")}}function o(){M&&M.disconnect(),w(I,r),w("mousedown",i),w("keydown",a),w("resize",T),w("load",t)}function n(e,t,o){if(p(t,o),1!=z.accelerationMax){var n=Date.now(),r=n-q;if(r<z.accelerationDelta){var a=(1+50/r)/2;a>1&&(a=Math.min(a,z.accelerationMax),t*=a,o*=a)}q=Date.now()}if(R.push({x:t,y:o,lastX:t<0?.99:-.99,lastY:o<0?.99:-.99,start:Date.now()}),!j){var i=e===document.body,l=function(n){for(var r=Date.now(),a=0,c=0,u=0;u<R.length;u++){var d=R[u],s=r-d.start,f=s>=z.animationTime,m=f?1:s/z.animationTime;z.pulseAlgorithm&&(m=x(m));var w=d.x*m-d.lastX>>0,h=d.y*m-d.lastY>>0;a+=w,c+=h,d.lastX+=w,d.lastY+=h,f&&(R.splice(u,1),u--)}i?window.scrollBy(a,c):(a&&(e.scrollLeft+=a),c&&(e.scrollTop+=c)),t||o||(R=[]),R.length?_(l,e,1e3/z.frameRate+1):j=!1};_(l,e,0),j=!0}}function r(e){Y||t();var o=e.target;if(e.defaultPrevented||e.ctrlKey)return!0;if(h(D,"embed")||h(o,"embed")&&/\.pdf/i.test(o.src)||h(D,"object")||o.shadowRoot)return!0;var r=-e.wheelDeltaX||e.deltaX||0,a=-e.wheelDeltaY||e.deltaY||0;N&&(e.wheelDeltaX&&y(e.wheelDeltaX,120)&&(r=-120*(e.wheelDeltaX/Math.abs(e.wheelDeltaX))),e.wheelDeltaY&&y(e.wheelDeltaY,120)&&(a=-120*(e.wheelDeltaY/Math.abs(e.wheelDeltaY)))),r||a||(a=-e.wheelDelta||0),1===e.deltaMode&&(r*=40,a*=40);var i=u(o);return i?!!v(a)||(Math.abs(r)>1.2&&(r*=z.stepSize/120),Math.abs(a)>1.2&&(a*=z.stepSize/120),n(i,r,a),e.preventDefault(),void l()):!O||!J||(Object.defineProperty(e,"target",{value:window.frameElement}),parent.wheel(e))}function a(e){var t=e.target,o=e.ctrlKey||e.altKey||e.metaKey||e.shiftKey&&e.keyCode!==K.spacebar;document.body.contains(D)||(D=document.activeElement);var r=/^(textarea|select|embed|object)$/i,a=/^(button|submit|radio|checkbox|file|color|image)$/i;if(e.defaultPrevented||r.test(t.nodeName)||h(t,"input")&&!a.test(t.type)||h(D,"video")||g(e)||t.isContentEditable||o)return!0;if((h(t,"button")||h(t,"input")&&a.test(t.type))&&e.keyCode===K.spacebar)return!0;if(h(t,"input")&&"radio"==t.type&&P[e.keyCode])return!0;var i,c=0,d=0,s=u(D);if(!s)return!O||!J||parent.keydown(e);var f=s.clientHeight;switch(s==document.body&&(f=window.innerHeight),e.keyCode){case K.up:d=-z.arrowScroll;break;case K.down:d=z.arrowScroll;break;case K.spacebar:i=e.shiftKey?1:-1,d=-i*f*.9;break;case K.pageup:d=.9*-f;break;case K.pagedown:d=.9*f;break;case K.home:d=-s.scrollTop;break;case K.end:var m=s.scrollHeight-s.scrollTop,w=m-f;d=w>0?w+10:0;break;case K.left:c=-z.arrowScroll;break;case K.right:c=z.arrowScroll;break;default:return!0}n(s,c,d),e.preventDefault(),l()}function i(e){D=e.target}function l(){clearTimeout(E),E=setInterval(function(){F={}},1e3)}function c(e,t){for(var o=e.length;o--;)F[V(e[o])]=t;return t}function u(e){var t=[],o=document.body,n=A.scrollHeight;do{var r=F[V(e)];if(r)return c(t,r);if(t.push(e),n===e.scrollHeight){var a=s(A)&&s(o),i=a||f(A);if(O&&d(A)||!O&&i)return c(t,$())}else if(d(e)&&f(e))return c(t,e)}while(e=e.parentElement)}function d(e){return e.clientHeight+10<e.scrollHeight}function s(e){var t=getComputedStyle(e,"").getPropertyValue("overflow-y");return"hidden"!==t}function f(e){var t=getComputedStyle(e,"").getPropertyValue("overflow-y");return"scroll"===t||"auto"===t}function m(e,t){window.addEventListener(e,t,!1)}function w(e,t){window.removeEventListener(e,t,!1)}function h(e,t){return(e.nodeName||"").toLowerCase()===t.toLowerCase()}function p(e,t){e=e>0?1:-1,t=t>0?1:-1,X.x===e&&X.y===t||(X.x=e,X.y=t,R=[],q=0)}function v(e){if(e)return B.length||(B=[e,e,e]),e=Math.abs(e),B.push(e),B.shift(),clearTimeout(C),C=setTimeout(function(){try{localStorage.SS_deltaBuffer=B.join(",")}catch(e){}},1e3),!b(120)&&!b(100)}function y(e,t){return Math.floor(e/t)==e/t}function b(e){return y(B[0],e)&&y(B[1],e)&&y(B[2],e)}function g(e){var t=e.target,o=!1;if(document.URL.indexOf("www.youtube.com/watch")!=-1)do if(o=t.classList&&t.classList.contains("html5-video-controls"))break;while(t=t.parentNode);return o}function S(e){var t,o,n;return e*=z.pulseScale,e<1?t=e-(1-Math.exp(-e)):(o=Math.exp(-1),e-=1,n=1-Math.exp(-e),t=o+n*(1-o)),t*z.pulseNormalize}function x(e){return e>=1?1:e<=0?0:(1==z.pulseNormalize&&(z.pulseNormalize/=S(1)),S(e))}function k(e){for(var t in e)H.hasOwnProperty(t)&&(z[t]=e[t])}var D,M,T,E,C,H={frameRate:data_frameRate,animationTime:data_animationTime,stepSize:data_stepSize,pulseAlgorithm:!0,pulseScale:data_pulseScale,pulseNormalize:data_pulseNormalize,accelerationDelta:data_accelerationDelta,accelerationMax:data_accelerationMax,keyboardSupport:!0,arrowScroll:data_arrowScroll,fixedBackground:!0,excluded:""},z=H,L=!1,O=!1,X={x:0,y:0},Y=!1,A=document.documentElement,B=[],N=/^Mac/.test(navigator.platform),K={left:37,up:38,right:39,down:40,spacebar:32,pageup:33,pagedown:34,end:35,home:36},P={37:1,38:1,39:1,40:1},R=[],j=!1,q=Date.now(),V=function(){var e=0;return function(t){return t.uniqueID||(t.uniqueID=e++)}}(),F={};if(window.localStorage&&localStorage.SS_deltaBuffer)try{B=localStorage.SS_deltaBuffer.split(",")}catch(e){}var I,_=function(){return window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame||function(e,t,o){window.setTimeout(e,o||1e3/60)}}(),W=window.MutationObserver||window.WebKitMutationObserver||window.MozMutationObserver,$=function(){var e;return function(){if(!e){var t=document.createElement("div");t.style.cssText="height:10000px;width:1px;",document.body.appendChild(t);var o=document.body.scrollTop;document.documentElement.scrollTop;window.scrollBy(0,3),e=document.body.scrollTop!=o?document.body:document.documentElement,window.scrollBy(0,-3),document.body.removeChild(t)}return e}}(),U=window.navigator.userAgent,G=/Edge/.test(U),J=/chrome/i.test(U)&&!G,Q=/safari/i.test(U)&&!G,Z=/mobile/i.test(U),ee=/Windows NT 6.1/i.test(U)&&/rv:11/i.test(U),te=Q&&(/Version\/8/i.test(U)||/Version\/9/i.test(U)),oe=(J||Q||ee)&&!Z;"onwheel"in document.createElement("div")?I="wheel":"onmousewheel"in document.createElement("div")&&(I="mousewheel"),I&&oe&&(m(I,r),m("mousedown",i),m("load",t)),k.destroy=o,window.SmoothScrollOptions&&k(window.SmoothScrollOptions),"function"==typeof define&&define.amd?define(function(){return k}):"object"==typeof exports?module.exports=k:window.SmoothScroll=k}();
			
			}
		});
	};
	/* smooth scroll page */
	
	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/tp-accordion.default', WidgetAccordionHandler);
		elementorFrontend.hooks.addAction('frontend/element_ready/tp-tabs-tours.default', WidgetTabHandler);
		elementorFrontend.hooks.addAction('frontend/element_ready/tp-smooth-scroll.default', WidgetSmoothScrollHandler);
	});
	
	/* Default load WidgetThePlusHandler */
	var WidgetThePlusHandler = function ($scope, $) {
		var row_bg_elem = $scope.find('.pt-plus-row-set').eq(0);
		
		var parent_row= row_bg_elem.parents('section.elementor-element');
		var wid_sec=$scope.parents('section.elementor-element');
		
		/* CountDown */
		if(wid_sec.find('.pt_plus_countdown').length>0){
		( function ( $ ) {
		"use strict";
			$(document).ready(function () {
				theplus_countdown();
				$(".pt_plus_countdown").change(function () {
					theplus_countdown();
				});
			});	
			function theplus_countdown(){
				$(".pt_plus_countdown").each(function () {
					var timer1 = $(this).attr("data-timer");
					var res = timer1.split("-");
					var text_days=$(this).data("days");
					var text_hours=$(this).data("hours");
					var text_minutes=$(this).data("minutes");
					var text_seconds=$(this).data("seconds");
					$(this).downCount({
						date: res[1]+"/"+res[0]+"/"+res[2]+" 12:00:00",
						offset: +1,
						text_day:text_days,
						text_hour:text_hours,
						text_minute:text_minutes,
						text_second:text_seconds,
					});
				});
			}
		} ( jQuery ) );
		}
		/* CountDown*/
		
		/* post listing out*/
		if(wid_sec.find('.list-isotope').length>0){
			var b = window.theplus || {};
			b.window = $(window),
			b.document = $(document),
			b.windowHeight = b.window.height(),
			b.windowWidth = b.window.width();	
			b.list_isotope_Posts = function() {
				var c = function(c) {
					$('.list-isotope').each(function() {
						
						var e, c = $(this), d = c.data("layout-type"),f = {
							itemSelector: ".grid-item",
							resizable: !0,
							sortBy: "original-order"
						};
						var uid=c.data("id");
						var inner_c=$('.'+uid).find(".post-inner-loop");
						$('.'+uid).addClass("pt-plus-isotope layout-" + d),
						e = "masonry" === d  ? "packery" : "fitRows",
						f.layoutMode = e,
						function() {
							//b.initMetroIsotope(),
							inner_c.isotope(f)
						}(),
						$('.'+uid+' .post-filter-data').find(".filter-category-list").click(function(event) {
							event.preventDefault();
							var d = $(this).attr("data-filter");
							$(this).parent().parent().find(".active").removeClass("active"),
							$(this).addClass("active"),
							inner_c.isotope({
								filter: d
							}),
							$("body").trigger("isotope-sorted");
						});
					})
				};
				b.window.on("load resize", function() {
					c('[data-enable-isotope="1"]')
				}),
				b.document.on("load resize", function() {
					c('[data-enable-isotope="1"]')
				}),
				$(document).ready(function() {
					c('[data-enable-isotope="1"]')
				}),
				$("body").on("post-load resort-isotope", function() {
					setTimeout(function() {
						c('[data-enable-isotope="1"]')
					}, 800)
				}),
				$("body").on("tabs-reinited", function() {
					setTimeout(function() {
						c('[data-enable-isotope="1"]')
					}, 800)
				}),
				$.browser.firefox = /firefox/.test(navigator.userAgent.toLowerCase()),
				$.browser.firefox && setTimeout(function() {
					c('[data-enable-isotope="1"]')
				}, 2500);
			},
			b.init = function() {
				b.list_isotope_Posts();
			}
			,
			b.init();
		}
		if(wid_sec.find('.list-isotope-metro').length>0){
			if ($('.list-isotope-metro').size() > 0) {
				
				$(window).on("load resize", function() {
					theplus_setup_packery_portfolio('all');
					$('.list-isotope-metro .post-inner-loop').isotope('layout').isotope("reloadItems");
				});
				
				$("body").on("post-load resort-isotope", function() {
					setTimeout(function() {
						theplus_setup_packery_portfolio('all');
						$('.list-isotope-metro .post-inner-loop').isotope('layout');
					}, 800)
				});
				$("body").on("tabs-reinited", function() {
					setTimeout(function() {
						theplus_setup_packery_portfolio('all');
						$('.list-isotope-metro .post-inner-loop').isotope('layout');
					}, 800)
				});
				$.browser.firefox = /firefox/.test(navigator.userAgent.toLowerCase()),
				$.browser.firefox && setTimeout(function() {
					theplus_setup_packery_portfolio('all');
					$('.list-isotope-metro .post-inner-loop').isotope('layout');
				}, 2500);
			}			
		}
		if(wid_sec.find('.list-carousel-slick').length>0){
			var carousel_elem = $scope.find('.list-carousel-slick').eq(0);
			$(document).ready(function() {
				if (carousel_elem.length > 0) {
					if(!carousel_elem.hasClass("done-carousel")){
						theplus_carousel_list();
					}
				}
			});
		}
		/* post listing out*/
		if(wid_sec.find('.blog-list.blog-style-1').length>0){
			jQuery(document).ready(function($) {
				jQuery(document).on('mouseenter',".blog-list.blog-style-1 .grid-item .blog-list-content",function() {
					jQuery(this).find(".post-hover-content").slideDown(300)
				});
				jQuery(document).on('mouseleave',".blog-list.blog-style-1 .grid-item .blog-list-content",function() {
					jQuery(this).find(".post-hover-content").slideUp(300)
				})
			});
		}
		
	};
	/* Default load WidgetThePlusHandler */
	/* Backend load WidgetThePlusHandler */
	var WidgetThePlusHandlerBackEnd = function ($scope, $) {
		var wid_sec=$scope.parents('section.elementor-element');
		
		/*--- on load animation ----*/
		if(wid_sec.find(".animate-general").length){
			jQuery(document).ready(function() {
				"use strict";
				jQuery('.animate-general').each(function() {
					var c, p=jQuery(this);
					if(!p.hasClass("animation-done")){
						if(p.find('.animated-columns').length){
							var b = jQuery('.animated-columns',this);				
							var delay_time=p.data("animate-delay");
							
							c = p.find('.animated-columns');
							c.each(function() {
								jQuery(this).css("opacity", "0");
							});
							
							}else{			
							var b=jQuery(this);
							var delay_time=b.data("animate-delay");
							
							if(b.data("animate-item")){
								c = b.find(b.data("animate-item"));
								c.each(function() {
									jQuery(this).css("opacity", "0");
								});
								}else{
								b.css("opacity", "0");
							}
						}
					}
				});
				
				var d = function() {
					jQuery('.animate-general').each(function() {
						var c, d, p=jQuery(this), e = "85%";
						var id=jQuery(this).data("id");
						if(p.data("animate-columns")=="stagger"){
							var b = jQuery('.animated-columns',this);
							var animation_stagger=p.data("animate-stagger");
							var delay_time=p.data("animate-delay");
							var duration_time=p.data("animate-duration");
							var d = p.data("animate-type");
							p.css("opacity","1");
							c = p.find('.animated-columns');
							p.waypoint(function(direction) {
								if( direction === 'down'){
									if(c.hasClass("animation-done")){
										c.hasClass("animation-done");
										}else{
										c.addClass("animation-done").velocity(d,{ delay: delay_time,duration: duration_time,display:'auto',stagger: animation_stagger});
									}
								}
							}, {triggerOnce: true, offset: '120%'} );
							if(c){
								jQuery('head').append("<style type='text/css'>."+id+" .animated-columns.animation-done{opacity:1;}</style>")
							}
							}else if(p.data("animate-columns")=="columns"){
							var b = jQuery('.animated-columns',this);
							var delay_time=p.data("animate-delay");
							var d = p.data("animate-type");
							var duration_time=p.data("animate-duration");
							p.css("opacity","1");
							c = p.find('.animated-columns');
							c.each(function() {
								var bc=jQuery(this);
								bc.waypoint(function(direction) {
									if( direction === 'down'){
										if(bc.hasClass("animation-done")){
											bc.hasClass("animation-done");
										}else{
											bc.addClass("animation-done").velocity(d,{ delay: delay_time,duration: duration_time,drag:true,display:'auto'});
										}
									}
								}, {triggerOnce: true, offset: '90%'} );
							});
							if(c){
								jQuery('head').append("<style type='text/css'>."+id+" .animated-columns.animation-done{opacity:1;}</style>")
							}
							}else{
							var b = jQuery(this);
							var delay_time=b.data("animate-delay");
							var duration_time=b.data("animate-duration");
							d = b.data("animate-type"),
							b.waypoint(function(direction ) {
								if( direction === 'down'){
									if(b.hasClass("animation-done")){
										b.hasClass("animation-done");
									}else{
										b.addClass("animation-done").velocity(d, {delay: delay_time,duration: duration_time,display:'auto'});
									}
								}
							}, {triggerOnce: true,  offset: '90%' } );
						}
					})
				},
				e = function() {
					jQuery(".call-on-waypoint").each(function() {
						var c = jQuery(this);
						c.waypoint(function() {
							c.trigger("on-waypoin")
							}, {
							triggerOnce: !0,
							offset: "bottom-in-view"
						})
					})
				};
				jQuery(document).ready(e),jQuery(window).load(e),
				jQuery(document.body).on('post-load', function() {
					e()
				}),
				jQuery(document).ready(d),jQuery(window).load(d),
				jQuery(document.body).on('post-load', function() {
					d()
				});
				jQuery(document).ready(function(){
				e(); d();
				});
			});
		}
		/*--- on load animation ----*/
		/*Text Heading Animation*/
		if(wid_sec.find('.pt-plus-cd-headline').length>0){
			plus_heading_animation();
		}
		/*Text Heading Animation*/
		
		if(wid_sec.find('.list-isotope-metro').length>0){
			$(document).ready(function(){
				"use strict";
				var container=wid_sec.find('.list-isotope-metro');
				var uid=container.data("id");
				var columns=container.attr('data-columns');
				var metro_style=container.attr('data-metro-style');
				theplus_backend_packery_portfolio(uid,columns,metro_style);
			});
		}
		if(wid_sec.find('.list-carousel-slick').length>0){
			var carousel_elem = $scope.find('.list-carousel-slick').eq(0);
			$(document).ready(function() {
				if (carousel_elem.length > 0) {
					if(!carousel_elem.hasClass("done-carousel")){
						theplus_carousel_list();
					}
				}
			});
		}
		if(wid_sec.find('.theplus-contact-form').length){
			$(document).ready(function() {
				plus_cf7_form();
			});
		}		
	};
	/* Backend load WidgetThePlusHandler */
	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/global', WidgetThePlusHandler);
		if (elementorFrontend.isEditMode()) {
			elementorFrontend.hooks.addAction('frontend/element_ready/global', WidgetThePlusHandler);
			elementorFrontend.hooks.addAction('frontend/element_ready/global', WidgetThePlusHandlerBackEnd);			
		}
	});
})(jQuery);

/*--- on load animation ----*/
(function($) {
    'use strict';
	jQuery(document).ready(function() {
		"use strict";
		jQuery('.animate-general').each(function() {
			var c, p=jQuery(this);
			if(!p.hasClass("animation-done")){
				if(p.find('.animated-columns').length){
					var b = jQuery('.animated-columns',this);				
					var delay_time=p.data("animate-delay");
					
					c = p.find('.animated-columns');
					c.each(function() {
						jQuery(this).css("opacity", "0");
					});
					
					}else{			
					var b=jQuery(this);
					var delay_time=b.data("animate-delay");
					
					if(b.data("animate-item")){
						c = b.find(b.data("animate-item"));
						c.each(function() {
							jQuery(this).css("opacity", "0");
						});
						}else{
						b.css("opacity", "0");
					}
				}
			}
		});
		
		var d = function() {
			jQuery('.animate-general').each(function() {
				var c, d, p=jQuery(this), e = "85%";
				var id=jQuery(this).data("id");
				if(p.data("animate-columns")=="stagger"){
					var b = jQuery('.animated-columns',this);
					var animation_stagger=p.data("animate-stagger");
					var delay_time=p.data("animate-delay");
					var duration_time=p.data("animate-duration");
					var d = p.data("animate-type");
					p.css("opacity","1");
					c = p.find('.animated-columns');
					p.waypoint(function(direction) {
						if( direction === 'down'){
							if(c.hasClass("animation-done")){
								c.hasClass("animation-done");
								}else{
								c.addClass("animation-done").velocity(d,{ delay: delay_time,duration: duration_time,display:'auto',stagger: animation_stagger});
							}
						}
					}, {triggerOnce: true, offset: '120%'} );
					if(c){
						jQuery('head').append("<style type='text/css'>."+id+" .animated-columns.animation-done{opacity:1;}</style>")
					}
					}else if(p.data("animate-columns")=="columns"){
					var b = jQuery('.animated-columns',this);
					var delay_time=p.data("animate-delay");
					var d = p.data("animate-type");
					var duration_time=p.data("animate-duration");
					p.css("opacity","1");
					c = p.find('.animated-columns');
					c.each(function() {
						var bc=jQuery(this);
						bc.waypoint(function(direction) {
							if( direction === 'down'){
								if(bc.hasClass("animation-done")){
									bc.hasClass("animation-done");
								}else{
									bc.addClass("animation-done").velocity(d,{ delay: delay_time,duration: duration_time,drag:true,display:'auto'});
								}
							}
						}, {triggerOnce: true, offset: '90%'} );
					});
					if(c){
						jQuery('head').append("<style type='text/css'>."+id+" .animated-columns.animation-done{opacity:1;}</style>")
					}
					}else{
					var b = jQuery(this);
					var delay_time=b.data("animate-delay");
					var duration_time=b.data("animate-duration");
					d = b.data("animate-type"),
					b.waypoint(function(direction ) {
						if( direction === 'down'){
							if(b.hasClass("animation-done")){
								b.hasClass("animation-done");
							}else{
								b.addClass("animation-done").velocity(d, {delay: delay_time,duration: duration_time,display:'auto'});
							}
						}
					}, {triggerOnce: true,  offset: '90%' } );
				}
			})
		},
		e = function() {
			jQuery(".call-on-waypoint").each(function() {
				var c = jQuery(this);
				c.waypoint(function() {
					c.trigger("on-waypoin")
					}, {
					triggerOnce: !0,
					offset: "bottom-in-view"
				})
			})
		};
		jQuery(document).ready(e),jQuery(window).load(e),
		jQuery(document.body).on('post-load', function() {
			e()
		}),
		jQuery(document).ready(d),jQuery(window).load(d),
		jQuery(document.body).on('post-load', function() {
			d()
		});
		jQuery(document).ready(function(){
		e(); d();
		});
	});
})(jQuery);
/*--- on load animation ----*/
/* list carosel slick*/
function theplus_carousel_list(){
	jQuery('.list-carousel-slick').each(function() {	
			var $self=jQuery(this);
			var $uid=$self.data("id");
			var slide_speed=$self.data("slide_speed");
			var default_active_slide=$self.data("default_active_slide");
			var slider_desktop_column=$self.data("slider_desktop_column");
			var steps_slide=$self.data("steps_slide");
			var slider_padding=$self.data("slider_padding");
			
			var slider_draggable=$self.data("slider_draggable");
			var slider_infinite=$self.data("slider_infinite");
			var slider_adaptive_height=$self.data("slider_adaptive_height");
			var slider_autoplay=$self.data("slider_autoplay");
			var autoplay_speed=$self.data("autoplay_speed");
			var slider_rows=$self.data("slider_rows");
			
			var slider_dots=$self.data("slider_dots");
			var slider_dots_style=$self.data("slider_dots_style");
			
			var slider_arrows=$self.data("slider_arrows");
			
			if(steps_slide=='1'){
				steps_slide=='1';
			}else{
				steps_slide=slider_desktop_column;
			}
			
			var prev_arrow='<button type="button" class="slick-nav slick-prev style-2"><span class="icon-wrap"></span></button>';
			var next_arrow='<button type="button" class="slick-nav slick-next style-2"><span class="icon-wrap"></span></button>';
			
			if(default_active_slide==undefined){
				default_active_slide=0;
			}
			if(!jQuery(this).hasClass("done-carousel")){
				jQuery('.'+$uid+' > .post-inner-loop').slick({
					dots: slider_dots,
					vertical: false,
					fade:false,
					arrows: slider_arrows,
					infinite: slider_infinite,
					speed: slide_speed,
					initialSlide: default_active_slide,
					adaptiveHeight: slider_adaptive_height,
					autoplay: slider_autoplay,
					autoplaySpeed: autoplay_speed,
					pauseOnHover: false,
					centerMode: false,
					centerPadding: 0,
					prevArrow: prev_arrow,
					nextArrow: next_arrow,
					slidesToShow: 1,
					slidesToScroll: 1,
					draggable:slider_draggable,
					dotsClass:slider_dots_style,
				});
				
				jQuery(this).addClass("done-carousel");
				
			}
	});
}
/* list carosel slick*/

/*text Heading Animation*/
(function($) {
    'use strict';
	$(document).ready(function() {
		plus_heading_animation();
	});
})(jQuery);
function plus_heading_animation(){
	/*------ heading animation--------*/
		jQuery(document).ready(function($){
			"use strict";
			//set animation timing
			var animationDelay = 2500,
			//loading bar effect
			barAnimationDelay = 3800,
			barWaiting = barAnimationDelay - 3000, 
			//letters effect
			lettersDelay = 50,
			//type effect
			typeLettersDelay = 150,
			selectionDuration = 500,
			typeAnimationDelay = selectionDuration + 800,
			//clip effect 
			revealDuration = 600,
			revealAnimationDelay = 1500;
			
			pt_plus_initHeadline();
			
			
			function pt_plus_initHeadline() {
				//insert <i> element for each letter of a changing word
				singleLetters($('.pt-plus-cd-headline.letters').find('b'));
				//initialise headline animation
				animateHeadline($('.pt-plus-cd-headline'));
			}
			
			function singleLetters($words) {
				$words.each(function(){
					var i;
					var word = $(this),
					letters = word.text().split(''),
					selected = word.hasClass('is-visible');
					for (i in letters) {
						if(word.parents('.rotate-2').length > 0) letters[i] = '<em>' + letters[i] + '</em>';
						letters[i] = (selected) ? '<i class="in">' + letters[i] + '</i>': '<i>' + letters[i] + '</i>';
					}
					var newLetters = letters.join('');
					word.html(newLetters).css('opacity', 1);
				});
			}
			
			function animateHeadline($headlines) {
				var duration = animationDelay;
				$headlines.each(function(){
					var headline = $(this);
					
					if (!headline.hasClass('type') ) {
						//assign to .cd-words-wrapper the width of its longest word
						var words = headline.find('.cd-words-wrapper b'),
						width = 0;
						words.each(function(){
							var wordWidth = $(this).width();
							if (wordWidth > width) width = wordWidth;
						});
						headline.find('.cd-words-wrapper').css('width', width+12);
					};
					
					//trigger animation
					setTimeout(function(){ hideWord( headline.find('.is-visible').eq(0) ) }, duration);
				});
			}
			
			function hideWord($word) {
				var nextWord = takeNext($word);
				
				if($word.parents('.pt-plus-cd-headline').hasClass('type')) {
					var parentSpan = $word.parent('.cd-words-wrapper');
					parentSpan.addClass('selected').removeClass('waiting');	
					setTimeout(function(){ 
						parentSpan.removeClass('selected'); 
						$word.removeClass('is-visible').addClass('is-hidden').children('i').removeClass('in').addClass('out');
					}, selectionDuration);
					setTimeout(function(){ showWord(nextWord, typeLettersDelay) }, typeAnimationDelay);
					
					} else if($word.parents('.pt-plus-cd-headline').hasClass('letters')) {
					var bool = ($word.children('i').length >= nextWord.children('i').length) ? true : false;
					hideLetter($word.find('i').eq(0), $word, bool, lettersDelay);
					showLetter(nextWord.find('i').eq(0), nextWord, bool, lettersDelay);
					
					} else {
					switchWord($word, nextWord);
					setTimeout(function(){ hideWord(nextWord) }, animationDelay);
				}
			}
			
			function showWord($word, $duration) {
				if($word.parents('.pt-plus-cd-headline').hasClass('type')) {
					showLetter($word.find('i').eq(0), $word, false, $duration);
					$word.addClass('is-visible').removeClass('is-hidden');
					
				}
			}
			
			function hideLetter($letter, $word, $bool, $duration) {
				$letter.removeClass('in').addClass('out');
				
				if(!$letter.is(':last-child')) {
					setTimeout(function(){ hideLetter($letter.next(), $word, $bool, $duration); }, $duration);  
					} else if($bool) { 
					setTimeout(function(){ hideWord(takeNext($word)) }, animationDelay);
				}
				
				if($letter.is(':last-child') && $('html').hasClass('no-csstransitions')) {
					var nextWord = takeNext($word);
					switchWord($word, nextWord);
				} 
			}
			
			function showLetter($letter, $word, $bool, $duration) {
				$letter.addClass('in').removeClass('out');
				
				if(!$letter.is(':last-child')) { 
					setTimeout(function(){ showLetter($letter.next(), $word, $bool, $duration); }, $duration); 
					} else { 
					if($word.parents('.pt-plus-cd-headline').hasClass('type')) { setTimeout(function(){ $word.parents('.cd-words-wrapper').addClass('waiting'); }, 200);}
					if(!$bool) { setTimeout(function(){ hideWord($word) }, animationDelay) }
				}
			}
			
			function takeNext($word) {
				return (!$word.is(':last-child')) ? $word.next() : $word.parent().children().eq(0);
			}
			
			function takePrev($word) {
				return (!$word.is(':first-child')) ? $word.prev() : $word.parent().children().last();
			}
			
			function switchWord($oldWord, $newWord) {
				$oldWord.removeClass('is-visible').addClass('is-hidden');
				$newWord.removeClass('is-hidden').addClass('is-visible');
			}
		});
		/*----header animation element--------*/
}
/*text Heading Animation*/

/*- contact form-----------*/
( function ( $ ) {	
	'use strict';
	$(document).ready(function() {
		plus_cf7_form();
	});
} ( jQuery ) );
function plus_cf7_form(){
		jQuery('.theplus-contact-form').each(function(){
			var radio_checkbox='plus-checkbox';
			var i=0;
			if(!jQuery(this).hasClass("tp-form-loaded")){
			jQuery(".wpcf7-form-control.wpcf7-radio .wpcf7-list-item",this).each(function(){
				var text_val=jQuery(this).find('.wpcf7-list-item-label').text();
				jQuery(this).find('.wpcf7-list-item-label').remove();
				var label_Tags=jQuery('input[type="radio"]',this);
				if ( label_Tags.parent().is( 'label' )) {
					label_Tags.unwrap();
				}
				var radio_name=jQuery(this).find('input[type="radio"]').attr('name');
				jQuery(this).append('<label class="input__radio_btn" for="'+radio_name+i+'">'+text_val+'<div class="toggle-button__icon"></div></label>');
				jQuery(this).find('input[type="radio"]').attr('id',radio_name+i);
				
				jQuery(this).find('input[type="radio"]').addClass("input-radio-check");
				jQuery(this).parents(".wpcf7-form-control-wrap").addClass(radio_checkbox);
				i++;
			});
			var i=0;
			jQuery(".wpcf7-form-control.wpcf7-checkbox .wpcf7-list-item",this).each(function(){
				var text_val=jQuery(this).find('.wpcf7-list-item-label').text();
				jQuery(this).find('.wpcf7-list-item-label').remove();
				var label_Tags=jQuery('input[type="checkbox"]',this);
				if ( label_Tags.parent().is( 'label' )) {
					label_Tags.unwrap();
				}
				jQuery(this).append('<label class="input__checkbox_btn" for="'+radio_checkbox+i+'">'+text_val+'<div class="toggle-button__icon"></div></label>');
				jQuery(this).find('input[type="checkbox"]').attr('id',radio_checkbox+i);
				
				jQuery(this).find('input[type="checkbox"]').addClass("input-checkbox-check");
				jQuery(this).parents(".wpcf7-form-control-wrap").addClass(radio_checkbox);
				i++;
			});
			jQuery(".wpcf7-form-control-wrap input[type='file']",this).each(function(){
				var file_name=jQuery(this).attr('name');
				jQuery(this).attr('id',file_name+i);
				jQuery(this).attr('data-multiple-caption',"{count} files selected");
				jQuery(this).parents(".wpcf7-form-control-wrap").append('<label class="input__file_btn" for="'+file_name+i+'"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg><span>Choose a file…</span></label>');
				jQuery(this).parents(".wpcf7-form-control-wrap").addClass("cf7-style-file");
				i++;
			});
				jQuery(this).addClass("tp-form-loaded");
			}
		});	
}
/*- contact form-----------*/

jQuery(window).on("load resize", function() {
	"use strict";
	if (jQuery('.list-isotope-metro').size() > 0) {
		theplus_setup_packery_portfolio('all');	
		jQuery('.list-isotope-metro .post-inner-loop').isotope('layout');
	}		
});
jQuery(document).ready(function() {
	if (jQuery('.list-isotope-metro').size() > 0) {
		theplus_setup_packery_portfolio('all');
		jQuery('.list-isotope-metro .post-inner-loop').isotope('layout').isotope("reloadItems");
	}
});

function theplus_backend_packery_portfolio(uid,metro_column,metro_style) {
		var setPad=0;
		var myWindow=jQuery(window);
		var container=jQuery("#"+uid);
		
		if (metro_column == '3') {
			var	norm_size = Math.floor((container.width() - setPad*2)/3),
			double_size = norm_size*2;				
			container.find('.grid-item').each(function(){
				var set_w = norm_size,
				set_h = norm_size;
				
				if(metro_style=='style-1'){
					if (jQuery(this).hasClass('metro-item1') || jQuery(this).hasClass('metro-item7')) {
						set_w = double_size,
						set_h = double_size;
					}
					if (jQuery(this).hasClass('metro-item4') || jQuery(this).hasClass('metro-item9')) {
						set_w = double_size,
						set_h = norm_size;
					}
				}
				if (myWindow.width() < 760) {
					set_w = myWindow.width() - setPad*2;
					set_h = myWindow.width() - setPad*2;
				}	
				jQuery(this).css({
					'width' : set_w+'px',
					'height' : set_h+'px'
				});
			});
		}
			if (myWindow.innerWidth() > 767) {
				jQuery("#"+uid).isotope({
					itemSelector: '.grid-item',
					layoutMode: 'masonry',
					masonry: {
						columnWidth: norm_size
					}
				});
			}else{
				jQuery("#"+uid).isotope({
					layoutMode: 'masonry',
					masonry: {
						columnWidth: '.grid-item'
					}
				});
			}
		jQuery("#"+uid).isotope('layout').isotope('layout').isotope( 'reloadItems' );
		
		jQuery("#"+uid).imagesLoaded( function(){		
			jQuery("#"+uid).isotope('layout').isotope( 'reloadItems' );		
		});
}
function theplus_setup_packery_portfolio(packery_id) {
	jQuery('.list-isotope-metro').each(function(){
		var uid=jQuery(this).data("id");
		var metro_column=jQuery(this).attr('data-columns');
		var tablet_metro_column=jQuery(this).attr('data-tablet-metro-columns');
		var setPad = 0;
		var myWindow=jQuery(window);
		var responsive_width=window.innerWidth;
		if(responsive_width <= 1024 && tablet_metro_column!=undefined){
			metro_column=tablet_metro_column;
		}
		if (metro_column == '3') {
			var metro_style=jQuery(this).attr('data-metro-style');
			if(responsive_width <= 1024 && tablet_metro_column!=undefined){
				metro_style=jQuery(this).attr('data-tablet-metro-style');
			}
			var	norm_size = Math.floor((jQuery(this).width() - setPad*2)/3),
			double_size = norm_size*2;				
			jQuery(this).find('.grid-item').each(function(){
				var set_w = norm_size,
				set_h = norm_size;
				
				if(metro_style=='style-1'){
					if (jQuery(this).hasClass('metro-item1') || jQuery(this).hasClass('metro-item7')) {
						set_w = double_size,
						set_h = double_size;
					}
					if (jQuery(this).hasClass('metro-item4') || jQuery(this).hasClass('metro-item9')) {
						set_w = double_size,
						set_h = norm_size;
					}
				}
				if (myWindow.width() < 760) {
					set_w = myWindow.width() - setPad*2;
					set_h = myWindow.width() - setPad*2;
				}
				jQuery(this).css({
					'width' : set_w+'px',
					'height' : set_h+'px'
				});
			});
		}
		
		if(jQuery(this).hasClass('list-isotope-metro')){
			if (myWindow.innerWidth() > 767) {
				jQuery("#"+uid).isotope({
					itemSelector: '.grid-item',
					layoutMode: 'masonry',
					masonry: {
						columnWidth: norm_size
					}
				});
			}else{
				jQuery("#"+uid).isotope({
					layoutMode: 'masonry',
					masonry: {
						columnWidth: '.grid-item'
					}
				});
			}
		}else{
			jQuery("#"+uid).isotope({
				layoutMode: 'masonry',
				masonry: {
					columnWidth: norm_size
				}
			});
		}
		jQuery("#"+uid).isotope('layout');
		
		jQuery("#"+uid).imagesLoaded( function(){
			jQuery("#"+uid).isotope('layout').isotope( 'reloadItems' );		
		});
				
	});
}
/*-Grid Masonry Metro list js-----*/