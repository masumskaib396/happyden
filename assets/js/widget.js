(function ($) {

"use strict";



/*--------------------------------------------------------------
PORTFOLIO MASONAY  JS
------------------------------------------------------------*/
var Happyden_Portfolio = function(){  
  if($.fn.isotope){
      var $gridMas = $('.happyden-portfolio-wrap.layout-mode-masonry');
      var $grid = $('.happyden-portfolio-wrap.layout-mode-normal');
      
      $grid.isotope({
          itemSelector: '.happyden-portfolio-item-wrap',
          percentPosition: true,
          layoutMode: 'fitRows',
      })
      
      $grid.imagesLoaded().progress(function () {
          $grid.isotope({
              itemSelector: '.happyden-portfolio-item-wrap',
              percentPosition: true,
              layoutMode: 'fitRows',

          })
      });

      $gridMas.isotope({
          itemSelector: '.happyden-portfolio-item-wrap',
          percentPosition: true,
          layoutMode: 'packery',
      })
      
      $gridMas.imagesLoaded().progress(function () {
          $gridMas.isotope({
              itemSelector: '.happyden-portfolio-item-wrap',
              percentPosition: true,
              layoutMode: 'packery',

          }).resize()
      });


      $(".pf-isotope-nav li").on('click', function () {
          $(".pf-isotope-nav li").removeClass("active");
          $(this).addClass("active");

          var selector = $(this).attr("data-filter");
          $gridMas.isotope({
              filter: selector,
              animationOptions: {
                  duration: 750,
                  easing: "linear",
                  queue: false,
              }
          }).resize();

      });
    
      
      $(".pf-isotope-nav li").on('click', function () {
          $(".pf-isotope-nav li").removeClass("active");
          $(this).addClass("active");

          var selector = $(this).attr("data-filter");
          $grid.isotope({
              filter: selector,
              animationOptions: {
                  duration: 750,
                  easing: "linear",
                  queue: false,
              }
          }).resize();

      });
  }


  // comment load more button click event
  $('.happyden-pf-loadmore-btn').on('click', function () {
      var button = $(this);
      
      // decrease the current comment page value
      var dpaged = button.data('paged'),
          total_pages = button.data('total-page'),
          nonce = button.data('referrar'),
          ajaxurl = button.data('url');
      
      dpaged++;
      // console.log(foio_portfolio_js_datas);
      $.ajax({
          url: ajaxurl, // AJAX handler, declared before
          dataType: 'html',
          data: {
              'action': 'foio_loadmore_callback', // wp_ajax_cloadmore
              // 'post_id': foio_portfolio_js_datas.parent_post_id, // the current post
              'paged': dpaged, // current comment page
              'folio_nonce': nonce,
              'portfolio_settings': button.data('portfolio-settings'),
          },
          type: 'POST',
          beforeSend: function (xhr) {
              button.text('Loading...'); // preloader here
          },
          success: function (data) {
              if (data) {
                  $('.happyden-portfolio-wrap').append(data);
                  $('.happyden-portfolio-wrap').isotope('reloadItems' ).isotope()
                  button.text('More projects');
                  button.data('paged', dpaged);
                  // if the last page, remove the button
                  if (total_pages == dpaged)
                      button.remove();
              } else {
                  button.remove();
              }
          }
      });
      return false;
  });

}


/*--------------------------------------------------------------
GALLERY MASONAY  JS
------------------------------------------------------------*/
var Happyden_Gallery = function(){
  var $container = $('#happyden__gallery--masonay'),
    colWidth = function () {
      var w = $container.width(), 
        columnNum = 1,
        columnWidth = 0;
      if (w > 1300) {
        columnNum  = 4;
      } else if (w > 900) {
        columnNum  = 3;
      } else if (w > 600) {
        columnNum  = 2;
      } else if (w > 450) {
        columnNum  = 2;
      } else if (w > 385) {
        columnNum  = 1;
      }
      columnWidth = Math.floor(w/columnNum);
      $container.find('.happyden__gallery--collection-item').each(function() {
        var $item = $(this),
          multiplier_w = $item.attr('class').match(/happyden__gallery--collection-item-w(\d)/),
          multiplier_h = $item.attr('class').match(/happyden__gallery--collection-item-h(\d)/),
          width = multiplier_w ? columnWidth*multiplier_w[1] : columnWidth,
          height = multiplier_h ? columnWidth*multiplier_h[1]*0.4-12 : columnWidth*0.5;
        $item.css({
          width: width,
          // height: height
        });
      });
      return columnWidth;
    },
    isotope = function () {
      $container.isotope({
        resizable: false,
        itemSelector: '.happyden__gallery--collection-item',
        masonry: {
          columnWidth: colWidth(),
          gutterWidth: 0
        }
      });
    };
  isotope();


/*--------------------------------------------------------------
MAGNIFIC POPUP JS
------------------------------------------------------------*/

  $(".happyden--popup").magnificPopup({
    type: 'image',
    gallery:{
        enabled:true,
    },
  });


}


// progress bar script starts

function animatedProgressbar( id, type, value, strokeColor, trailColor, strokeWidth, strokeTrailWidth ){
  var triggerClass = '.happyden-progress-bar-' + id;
  if ( 'function' === typeof ldBar ) {
      if( 'line' === type ) {
          new ldBar( triggerClass, {
              'type'              : 'stroke',
              'path'              : 'M0 10L100 10',
              'aspect-ratio'      : 'none',
              'stroke'			: strokeColor,
              'stroke-trail'	    : trailColor,
              'stroke-width'      : strokeWidth,
              'stroke-trail-width': strokeTrailWidth
          } ).set( value );
      }
      if( 'line-bubble' === type ) {
          new ldBar( triggerClass, {
              'type'              : 'stroke',
              'path'              : 'M0 10L100 10',
              'aspect-ratio'      : 'none',
              'stroke'			: strokeColor,
              'stroke-trail'		: trailColor,
              'stroke-width'      : strokeWidth,
              'stroke-trail-width': strokeTrailWidth
          } ).set( value );
          $( $( '.happyden-progress-bar-' + id ).find( '.ldBar-label' ) ).animate( {
              left: value + '%'
          }, 1000, 'swing');
      }
      if( 'circle' === type ) {
          new ldBar( triggerClass, {
              'type'				: 'stroke',
              'path'			    : 'M50 10A40 40 0 0 1 50 90A40 40 0 0 1 50 10',
              'stroke-dir'		: 'normal',
              'stroke'		    : strokeColor,
              'stroke-trail'	    : trailColor,
              'stroke-width'	    : strokeWidth,
              'stroke-trail-width': strokeTrailWidth
          } ).set( value );
      }
      if( 'fan' === type ) {
          new ldBar( triggerClass, {
              'type': 'stroke',
              'path': 'M10 90A40 40 0 0 1 90 90',
              'stroke': strokeColor,
              'stroke-trail': trailColor,
              'stroke-width': strokeWidth,
              'stroke-trail-width': strokeTrailWidth
          } ).set( value );
      }
  }
}

var HappydenProgressBar = function ( $scope, $ ){
  var progressBarWrapper = $scope.find( '[data-progress-bar]' ).eq( 0 );
  if ( $.isFunction( $.fn.waypoint ) ) {
      progressBarWrapper.waypoint( function () {
          var element      = $( this.element ),
          id               = element.data( 'id' ),
          type             = element.data( 'type' ),
          value            = element.data( 'progress-bar-value' ),
          strokeWidth      = element.data( 'progress-bar-stroke-width' ),
          strokeTrailWidth = element.data( 'progress-bar-stroke-trail-width' ),
          color            = element.data( 'stroke-color' ),
          trailColor       = element.data( 'stroke-trail-color' );
          animatedProgressbar( id, type, value, color, trailColor, strokeWidth, strokeTrailWidth );
          this.destroy();
      }, {
          offset: 'bottom-in-view'
      } );
  }
}
// progress bar script ends


// animated text script starts

var HappydenAnimatedText = function( $scope, $ ) {
  
	var animatedWrapper = $scope.find( '.happyden-typed-strings' ).eq(0),
	animateSelector     = animatedWrapper.find( '.happyden-animated-text-animated-heading' ),
	animationType       = animatedWrapper.data( 'heading_animation' ),
	animationStyle      = animatedWrapper.data( 'animation_style' ),
	animationSpeed      = animatedWrapper.data( 'animation_speed' ),
	typeSpeed           = animatedWrapper.data( 'type_speed' ),
	startDelay          = animatedWrapper.data( 'start_delay' ),
	backTypeSpeed       = animatedWrapper.data( 'back_type_speed' ),
	backDelay           = animatedWrapper.data( 'back_delay' ),
	loop                = animatedWrapper.data( 'loop' ) ? true : false,
	showCursor          = animatedWrapper.data( 'show_cursor' ) ? true : false,
	fadeOut             = animatedWrapper.data( 'fade_out' ) ? true : false,
	smartBackspace      = animatedWrapper.data( 'smart_backspace' ) ? true : false,	
	id                  = animateSelector.attr('id');

	if ( 'function' === typeof Typed ) {
		if( 'happyden-typed-animation' === animationType ){
			var typed = new Typed( '#'+id, {
				strings: animatedWrapper.data('type_string'),
				loop: loop,
				typeSpeed: typeSpeed,
				backSpeed: backTypeSpeed,
				showCursor : showCursor,
				fadeOut : fadeOut,
				smartBackspace : smartBackspace,
				startDelay : startDelay,
				backDelay : backDelay
			});
		}
	}


 	if ( $.isFunction( $.fn.Morphext ) ) {
		if( 'happyden-morphed-animation' === animationType ){
			$( animateSelector ).Morphext({
				animation: animationStyle,
				speed: animationSpeed
			});
		}
	}
}
// animated text script ends






 // Make sure you run this code under Elementor..
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/happyden-portfolio.default', Happyden_Portfolio);
        elementorFrontend.hooks.addAction('frontend/element_ready/happyden_gallery.default', Happyden_Gallery);
        elementorFrontend.hooks.addAction('frontend/element_ready/happyden-progress-bar.default', HappydenProgressBar);
        elementorFrontend.hooks.addAction('frontend/element_ready/happyden-animated.default', HappydenAnimatedText);

    });

})(jQuery);