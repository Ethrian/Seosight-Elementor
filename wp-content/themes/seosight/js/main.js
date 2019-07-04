//Global var
var CRUMINA = { };

( function ( $ ) {

    // USE STRICT
    "use strict";

    //----------------------------------------------------/
    // Predefined Variables
    //----------------------------------------------------/
    var $window = $( window ),
        $document = $( document ),
        $body = $( 'body' ),
        swipers = { },
        //Elements
        $header = $( '#site-header' ),
        $preloader = $('#hellopreloader'),
        $topbar = $header.siblings( '.top-bar' ),
        $nav = $( '#primary-menu' ),
        $header_space = $( '.header-spacer' ),
        $counter = $( '.counter' ),
        $progress_bar = $( '.skills-item' ),
        $pie_chart = $( '.pie-chart' ),
        $animatedIcons = $( '.js-animate-icon' ),
        $asidePanel = $( '.right-menu' ),
        $primaryMenu = $( '.primary-menu' ),
        $subscribe_section = $( '#subscribe-section' ),
        $footer = $( '#site-footer' ),
        $mainContent = $( '#primary' ),
        $adminBar = $( '#wpadminbar' );


    var $popupSearch = $( ".popup-search" );

    /* -----------------------
     * Fixed Header
     * --------------------- */
    CRUMINA.fixedHeaderInit = function () {
        if ( $header.hasClass( 'disable-sticky' ) ) {
            return;
        }
        if ( ( $header.hasClass( 'header-sticky-desktop' ) && $window.width() > 769 ) || ( $header.hasClass( 'header-sticky-mobile' ) && $window.width() <= 769 ) ) {
            $header.headroom( {
                "offset": 50,
                "tolerance": 5,
                "classes": {
                    "initial": "animated",
                    "pinned": $header.data( 'pinned' ),
                    "unpinned": $header.data( 'unpinned' ),
                },
                onUnpin: function () {
                    if ( $nav.find( '.sub-menu, .megamenu' ).hasClass( 'drop-up' ) ) {
                        this.elem.classList.remove( this.classes.unpinned );
                        this.elem.classList.add( this.classes.pinned );
                    } else {
                        this.elem.classList.add( this.classes.unpinned );
                        this.elem.classList.remove( this.classes.pinned );
                    }
                }
            } );
            $header.removeClass( 'headroom--not-bottom' );
        } else if ( $header.data( 'headroom' ) ) {
            $header.headroom( "destroy" );
        }
    };

    /* -----------------------
     * Filter Ajax Portfolio Params
     * --------------------- */
    CRUMINA.filterAjaxPortfolioParams = function () {
        Hooks.add_filter( 'ajax_portfolio_replaced_posts', function ( $posts, options ) {
            var $first = $posts.eq( 0 );
            var $sec = $posts.eq( 1 );
            $first.children( '.crumina-case-item' ).addClass( 'big' );
            $sec.children( '.crumina-case-item' ).addClass( 'big' );

            $first.removeClassWild( 'col-lg-*' ).removeClassWild( 'col-md-*' ).addClass( 'col-lg-6 col-md-6' );
            $sec.removeClassWild( 'col-lg-*' ).removeClassWild( 'col-md-*' ).addClass( 'col-lg-6 col-md-6' );

            return $posts;
        } );

        Hooks.add_filter( 'ajax_portfolio_scroll_to', function ( top, options ) {
            return top - 150;
        } );
    };

    /* -----------------------
     * Header Spacer
     * --------------------- */

    CRUMINA.headerSpacer = function () {
        $adminBar = $( '#wpadminbar' );

        setTimeout( function () {
            var $headerHeight = $header.outerHeight(),
                $adminBarHeight = $adminBar.outerHeight(),
                $headerSpacerHeight = $headerHeight + $adminBarHeight,
				$windowWidth = $(window).innerWidth(),
				$mainSlides = $('.main-slider .swiper-slide'),
				headerAbsoluteResolution = 1023;

            if ( $header.hasClass( 'headroom--not-top' && $windowWidth > 1024 ) ) {
                $headerSpacerHeight = $header.outerHeight() + $adminBarHeight + 40;
            }

			/*if( $header.hasClass( 'header-absolute' ) && $windowWidth < headerAbsoluteResolution ) {
				$header_space.css( 'height', '0' );
				return
			}*/

			if( $header.hasClass( 'header-absolute' ) && $windowWidth > headerAbsoluteResolution ) {
				$mainSlides.css('padding-top', $headerSpacerHeight + 'px');
			}else {
				$mainSlides.css('padding-top', 0 + 'px');
            }

            $header_space.css( 'height', $headerSpacerHeight + 'px' );
        }, 100 );
    };

    /* -----------------------
     * Parallax footer
     * --------------------- */

    CRUMINA.customScroll = function () {
        if ( $( '.mCustomScrollbar' ).length ) {
            $( '.mCustomScrollbar' ).perfectScrollbar( { wheelPropagation: false } );
        }
    };


    /* -----------------------
     * Preloader
     * --------------------- */

    CRUMINA.preloader = function () {
        setTimeout(function() {  $preloader.fadeOut(800) ; }, 500);
        return false;
    };

    /* -----------------------
     * Parallax footer
     * --------------------- */

    CRUMINA.parallaxFooter = function () {
        if ( $footer.length && $footer.hasClass( 'js-fixed-footer' ) ) {
            $footer.before( '<div class="block-footer-height"></div>' );
            $( '.block-footer-height' ).matchHeight( {
                target: $footer
            } );
        }
    };

    /* -----------------------
     * COUNTER NUMBERS
     * --------------------- */

    CRUMINA.counters = function () {
        if ( $counter.length ) {
            $counter.each( function () {
                var $this = $( this );
                $this.waypoint( function () {
                    var $current = $this.find( 'span' ),
                        $count = $current.data( 'to' );
                    if ( !$current.hasClass( 'animated' ) ) {
                        $current.countup( $count );
                        $current.addClass( 'animated' );
                    }
                }, { offset: '95%', triggerOnce: true } );
            } );
        }
    };

    /* -----------------------
     * Progress bars Animation
     * --------------------- */

    CRUMINA.progresBars = function () {
        $progress_bar.each( function () {
            var $this = $( this );
            $this.find( '.skills-item-meter-active' ).addClass( 'item-fully-transparent' );
            $this.waypoint( function () {
                var $current = $this.find( '.count-animate' ),
                    $count = $current.data( 'to' );
                if ( !$current.hasClass( 'animated' ) ) {
                    $current.countup( $count );
                    $current.addClass( 'animated' );
                }
                $this.find( '.skills-item-meter-active' ).fadeTo( 300, 1 ).addClass( 'skills-animate' ).removeClass( 'item-fully-transparent' );
            }, { offset: '85%', triggerOnce: true } );
        } );
    };

    /* -----------------------
     * Pie chart Animation
     * --------------------- */
    CRUMINA.pieCharts = function () {
        if ( $pie_chart.length ) {
            $pie_chart.each( function () {
                $( this ).waypoint( function () {
                    var current_cart = $( this );
                    var startColor = current_cart.data( 'startcolor' );
                    var endColor = current_cart.data( 'endcolor' );
                    var counter = current_cart.data( 'value' ) * 100;

                    current_cart.circleProgress( {
                        thickness: 16,
                        size: 320,
                        startAngle: -Math.PI / 4 * 2,
                        emptyFill: '#fff',
                        lineCap: 'round',
                        fill: {
                            gradient: [ endColor, startColor ],
                            gradientAngle: Math.PI / 4
                        }
                    } ).on( 'circle-animation-progress', function ( event, progress ) {
                        current_cart.find( '.content' ).html( parseInt( counter * progress, 10 ) + '<span>%</span>'
                            )
                    } );

                }, { offset: '90%', triggerOnce: true } );
            } );
        }
    };
    /* -----------------------
     * Animate SVG Icons
     * --------------------- */
    CRUMINA.animateSvg = function () {
        if ( $animatedIcons.length ) {
            $animatedIcons.each( function () {
                var $this = $( this );
                $( this ).waypoint( function () {
                    var mySVG = $this.find( '> svg' ).drawsvg();
                    mySVG.drawsvg( 'animate' );
                }, { offset: '95%', triggerOnce: true } );
            } );
        }
    };
    /* -----------------------
     * Tooltips JS plugin Init
     * --------------------- */
    CRUMINA.tooltips = function () {
        if ( !$( '.tippy' ).length ) {
            return;
        }
        new Tippy( '.tippy', {
            animation: 'scale',
            arrow: true
        } )
    };
    /* -----------------------
     * Run Chart js module
     * --------------------- */
    CRUMINA.chartJs = function () {
        $( '.chart-js-run' ).each( function () {
            var $wrapper = $( this );
            $( this ).waypoint( function () {
                var el_id = $wrapper.data( 'id' );
                var dataholder = $wrapper.find( '.chart-data' );
                var $fill = true;
                var $scales = true;
                var $borderColor = 'rgba(255, 255, 255, 0.1)';
                var ctx = document.getElementById( el_id );
                if ( $wrapper.data( 'type' ) === 'line' ) {
                    $fill = false;
                    $borderColor = dataholder.data( 'bordercolor' );
                }
                if ( $wrapper.data( 'type' ) === 'doughnut' || $wrapper.data( 'type' ) === 'pie' || $wrapper.data( 'type' ) === 'polarArea' ) {
                    $scales = false;
                }

                var myChart = new Chart( ctx, {
                    type: $wrapper.data( 'type' ),
                    data: {
                        labels: dataholder.data( 'labels' ),
                        datasets: [
                            {
                                data: dataholder.data( 'numbers' ),
                                backgroundColor: dataholder.data( 'colors' ),
                                borderColor: $borderColor,
                                pointBackgroundColor: dataholder.data( 'colors' ),
                                pointBorderColor: dataholder.data( 'colors' ),
                                fill: $fill
                            } ]
                    },
                    options: {
                        legend: {
                            display: false
                        },
                        scales: {
                            yAxes: [ {
                                    display: $scales,
                                    ticks: {
                                        beginAtZero: true,
                                        min: 0

                                    },
                                } ],
                            xAxes: [ {
                                    display: false,
                                } ]
                        }
                    },
                    animation: {
                        animateScale: true
                    }
                } );

            }, { offset: '75%', triggerOnce: true } );
        } );
    };

    CRUMINA.runchartJS = function ( $wrapper ) {
        var el_id = $wrapper.data( 'id' );
        var dataholder = $wrapper.find( '.chart-data' );
        var $fill = true;
        var $scales = true;
        var $borderColor = 'rgba(255, 255, 255, 0.1)';
        var ctx = document.getElementById( el_id );
        if ( $wrapper.data( 'type' ) === 'line' ) {
            $fill = false;
            $borderColor = dataholder.data( 'bordercolor' );
        }
        if ( $wrapper.data( 'type' ) === 'doughnut' || $wrapper.data( 'type' ) === 'pie' || $wrapper.data( 'type' ) === 'polarArea' ) {
            $scales = false;
        }

        var myChart = new Chart( ctx, {
            type: $wrapper.data( 'type' ),
            data: {
                labels: dataholder.data( 'labels' ),
                datasets: [
                    {
                        data: dataholder.data( 'numbers' ),
                        backgroundColor: dataholder.data( 'colors' ),
                        borderColor: $borderColor,
                        pointBackgroundColor: dataholder.data( 'colors' ),
                        pointBorderColor: dataholder.data( 'colors' ),
                        fill: $fill
                    } ]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [ {
                            display: $scales,
                            ticks: {
                                beginAtZero: true,
                                min: 0

                            },
                        } ],
                    xAxes: [ {
                            display: false,
                        } ]
                }
            },
            animation: {
                animateScale: true
            }
        } );
    };
    CRUMINA.runTimeLine = function () {
        $( '.cd-horizontal-timeline' ).each( function () {
            $( this ).horizontalTimeline();
        } );
    };


    $( "#top-bar-language" ).on( 'change', function () {
        var lang_href = jQuery( jQuery( this ).children( '[value=' + $( this ).val() + ']' ) ).data( 'url' );
        if ( lang_href ) {
            document.location.href = lang_href;
        }
    } );

    /* -----------------------------
     * Toggle aside panel on click
     * ---------------------------*/
    CRUMINA.togglePanel = function () {
        if ( $asidePanel.length ) {
            $asidePanel.toggleClass( 'opened' );
            $body.toggleClass( 'overlay-enable' );
        }
    };
    /* -----------------------------
     * Toggle Top bar on click
     * ---------------------------*/
    CRUMINA.toggleBar = function () {
        $topbar.toggleClass( 'open' );
        $body.toggleClass( 'overlay-enable' );
        return false;
    };
    /* -----------------------------
     * Toggle search overlay
     * ---------------------------*/
    CRUMINA.toggleSearch = function () {
        $body.toggleClass( 'open' );
        $( '.overlay_search-input' ).focus();
    };
    /* -----------------------------
     * Embedded Video in pop up
     * ---------------------------*/
    CRUMINA.mediaPopups = function () {
        $( '.js-popup-iframe' ).magnificPopup( {
            disableOn: 700,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,

            fixedContentPos: false
        } );
        $( '.js-zoom-image, .link-image' ).magnificPopup( {
            type: 'image',
            removalDelay: 500, //delay removal by X to allow out-animation
            callbacks: {
                beforeOpen: function () {
                    // just a hack that adds mfp-anim class to markup
                    this.st.image.markup = this.st.image.markup.replace( 'mfp-figure', 'mfp-figure mfp-with-anim' );
                    this.st.mainClass = 'mfp-zoom-in';
                }
            },
            closeOnContentClick: true,
            midClick: true
        } );
        $( '.js-zoom-gallery' ).each( function () {
            $( this ).magnificPopup( {
                delegate: 'a[data-lightbox="gallery-item"]',
                type: 'image',
                gallery: {
                    enabled: true
                },
                removalDelay: 500, //delay removal by X to allow out-animation
                callbacks: {
                    beforeOpen: function () {
                        // just a hack that adds mfp-anim class to markup
                        this.st.image.markup = this.st.image.markup.replace( 'mfp-figure', 'mfp-figure mfp-with-anim' );
                        this.st.mainClass = 'mfp-zoom-in';
                    }
                },
                closeOnContentClick: true,
                midClick: true
            } );
        } );

        $( '.js-open-video' ).magnificPopup( {
            type: 'inline',
            mainClass: 'inline--media-content overlay active animation-wrapper', // this class is for CSS animation below
            zoom: {
                enabled: true, // By default it's false, so don't forget to enable it
                duration: 300, // duration of the effect, in milliseconds
                easing: 'ease-in-out' // CSS transition easing function
            },
            callbacks: {
                open: function () {
                    var player = plyr.setup( '.plyr-module' );
                },
                close: function () {
                    var player = plyr.get( '.plyr-module' );
                    player[0].destroy();
                }
            }
        } );
    };
    /* -----------------------------
     * Equal height
     * ---------------------------*/
    CRUMINA.equalHeight = function () {
        $( '.js-equal-child' ).find( '.theme-module, .crumina-module' ).matchHeight( {
            property: 'min-height'
        } );
    };

    /* -----------------------------
     * Scrollmagic scenes animation
     * ---------------------------*/
    CRUMINA.SubscribeScrollAnnimation = function () {
        var controller = new ScrollMagic.Controller();
        new ScrollMagic.Scene( { triggerElement: "#subscribe-section" } )
            .setVelocity( ".gear", { opacity: 1, rotateZ: "360deg" }, 1200 )
            .triggerHook( "onEnter" )
            .addTo( controller );

        new ScrollMagic.Scene( { triggerElement: "#subscribe-section" } )
            .setVelocity( ".mail", { opacity: 1, bottom: "0" }, 600 )
            .triggerHook( 0.8 )
            .addTo( controller );

        new ScrollMagic.Scene( { triggerElement: "#subscribe-section" } )
            .setVelocity( ".mail-2", { opacity: 1, right: "20" }, 800 )
            .triggerHook( 0.9 )
            .addTo( controller );
    };

    CRUMINA.SeoScoreScrollAnnimation = function () {
        var controller = new ScrollMagic.Controller();

        new ScrollMagic.Scene( { triggerElement: ".crumina-your-score" } )
            .setVelocity( ".crumina-your-score .seoscore1", { opacity: 1, top: "-10" }, 400 )
            .triggerHook( "onEnter" )
            .addTo( controller );

        new ScrollMagic.Scene( { triggerElement: ".crumina-your-score" } )
            .setVelocity( ".crumina-your-score .seoscore2", { opacity: 1, bottom: "0" }, 800 )
            .triggerHook( 0.7 )
            .addTo( controller );

        new ScrollMagic.Scene( { triggerElement: ".crumina-your-score" } )
            .setVelocity( ".crumina-your-score .seoscore3", { opacity: 1, bottom: "0" }, 1000 )
            .triggerHook( 0.8 )
            .addTo( controller );
    };

    CRUMINA.TestimonialScrollAnnimation = function () {
        var controller = new ScrollMagic.Controller();

        new ScrollMagic.Scene( { triggerElement: ".crumina-testimonial-slider" } )
            .setVelocity( ".crumina-testimonial-slider .testimonial2", { opacity: 1, bottom: "-50" }, 400 )
            .triggerHook( 0.6 )
            .addTo( controller );

        new ScrollMagic.Scene( { triggerElement: ".crumina-testimonial-slider" } )
            .setVelocity( ".crumina-testimonial-slider .testimonial1", { opacity: 1, top: "20" }, 600 )
            .triggerHook( 1 )
            .addTo( controller );
    };

    CRUMINA.OurVisionScrollAnnimation = function () {
        var controller = new ScrollMagic.Controller();

        new ScrollMagic.Scene( { triggerElement: ".crumina-our-vision" } )
            .setVelocity( ".crumina-our-vision .elements", { opacity: 1 }, 600 )
            .triggerHook( 0.6 )
            .addTo( controller );

        new ScrollMagic.Scene( { triggerElement: ".crumina-our-vision" } )
            .setVelocity( ".crumina-our-vision .eye", { opacity: 1, bottom: "-90" }, 1000 )
            .triggerHook( 1 )
            .addTo( controller );
    };

    CRUMINA.MountainsScrollAnnimation = function () {
        var controller = new ScrollMagic.Controller();

        new ScrollMagic.Scene( { triggerElement: ".crumina-background-mountains" } )
            .setVelocity( ".crumina-background-mountains .mountain1", {
                opacity: 1,
                bottom: "0",
                paddingBottom: "10%"
            }, 800 )
            .triggerHook( 0.4 )
            .addTo( controller );

        new ScrollMagic.Scene( { triggerElement: ".crumina-background-mountains" } )
            .setVelocity( ".crumina-background-mountains .mountain2", { opacity: 1, bottom: "0" }, 800 )
            .triggerHook( 0.3 )
            .addTo( controller );
    };
    /* -----------------------------
     * Isotope sorting
     * ---------------------------*/
    CRUMINA.blogMasonry = function () {
        $( '.post--grid-masonry-container' ).each( function () {
            var $grid = $( this );

            $grid.imagesLoaded().done( function () {
                $grid.isotope( {
                    itemSelector: '.post--grid-masonry-col',
                    layoutMode: 'masonry',
                    percentPosition: true
                } );

            } );
        } );
    };
    
    CRUMINA.IsotopeSort = function () {
        var $container = $( '.sorting-container' );
        $container.each( function () {
            var $current = $( this );
            var layout = ( $current.data( 'layout' ).length ) ? $current.data( 'layout' ) : 'masonry';
            $current.isotope( {
                itemSelector: '.sorting-item',
                layoutMode: layout,
                percentPosition: true
            } );

            $current.imagesLoaded().progress( function () {
                $current.isotope( 'layout' );
            } );

            var $sorting_buttons = $current.siblings( '.sorting-menu' ).find( 'li' );

            $sorting_buttons.each( function () {
                var selector = $( this ).data( 'filter' );
                var count = $container.find( selector ).length;
                if ( count === 0 ) {
                    $( this ).css( 'display', 'none' );
                }
            } );
            if ( $sorting_buttons.filter( ':visible' ).length < 2 ) {
                $container.siblings( '.sorting-menu' ).hide();
            }

            $sorting_buttons.on( 'click', function () {
                if ( $( this ).hasClass( 'active' ) )
                    return false;
                $( this ).parent().find( '.active' ).removeClass( 'active' );
                $( this ).addClass( 'active' );
                var filterValue = $( this ).data( 'filter' );
                if ( typeof filterValue != "undefined" ) {
                    $current.isotope( { filter: filterValue } );
                    return false;
                }
            } );
        } );
    };

    /* -----------------------------
     * Sliders and Carousels
     * ---------------------------*/

    CRUMINA.initSwiper = function ($swipers) {
        var initIterator = 0;
        var $breakPoints = false;
        $swipers = $swipers ? $swipers : $( '.swiper-container' );
        $swipers.each( function () {

            var $t = $( this );
            var index = 'swiper-unique-id-' + initIterator;

            $t.addClass( 'swiper-' + index + ' initialized' ).attr( 'id', index );
            $t.find( '.swiper-pagination' ).addClass( 'pagination-' + index );

            var $effect = ( $t.data( 'effect' ) ) ? $t.data( 'effect' ) : 'slide',
                $crossfade = ( $t.data( 'crossfade' ) ) ? $t.data( 'crossfade' ) : true,
                $loop = ( $t.data( 'loop' ) === false ) ? $t.data( 'loop' ) : true,
                $autoplayStopOnLast = !$loop,
                $showItems = ( $t.data( 'show-items' ) ) ? $t.data( 'show-items' ) : 1,
                $stopOnHover = ( $t.data( 'stop-on-hover' ) ) ? $t.data( 'stop-on-hover' ) : 'no',
                $scrollItems = ( $t.data( 'scroll-items' ) ) ? $t.data( 'scroll-items' ) : 1,
                $scrollDirection = ( $t.data( 'direction' ) ) ? $t.data( 'direction' ) : 'horizontal',
                $mouseScroll = ( $t.data( 'mouse-scroll' ) ) ? $t.data( 'mouse-scroll' ) : false,
                $parallax = ( $t.data( 'parallax' ) ) ? $t.data( 'parallax' ) : false,
                $autoplay = ( $t.data( 'autoplay' ) ) ? parseInt( $t.data( 'autoplay' ), 10 ) : 0,
                $autoheight = !!($t.closest('.crumina-module').hasClass('auto-height')),
                $slidesSpace = ( $showItems > 1 ) ? 20 : 0;

            if ( $showItems > 1 ) {
                $breakPoints = {
                    480: {
                        slidesPerView: 1,
                        slidesPerGroup: 1
                    },
                    768: {
                        slidesPerView: 2,
                        slidesPerGroup: 2
                    }
                }
            } else {
                $breakPoints = {
                    768: {
                        slidesPerView: 1,
                        slidesPerGroup: 1
                    }
                }
            }

            swipers['swiper-' + index] = new Swiper( '.swiper-' + index, {
                pagination: '.pagination-' + index,
                paginationClickable: true,
                direction: $scrollDirection,
                mousewheelControl: $mouseScroll,
                mousewheelReleaseOnEdges: $mouseScroll,
                autoplayStopOnLast: $autoplayStopOnLast,
                slidesPerView: $showItems,
                slidesPerGroup: $scrollItems,
                spaceBetween: $slidesSpace,
                keyboardControl: true,
                preloadImages: true,
                updateOnImagesReady: true,
                autoplay: $autoplay,
                autoplayDisableOnInteraction: false,
                touchReleaseOnEdges:true,
                loop: $loop,
                breakpoints: $breakPoints,
                autoHeight: $autoheight,
                effect: $effect,
                fade: {
                    crossFade: true
                },
                parallax: $parallax,
                calculateHeight: true,
                onImagesReady: function ( swiper ) {
                    CRUMINA.resizeSwiper( swiper );
                },
                onTransitionStart: function ( swiper ) {
                    CRUMINA.resizeSwiper( swiper );
                },
                onSlideChangeStart: function ( swiper ) {
                    if ( $t.find( '.slider-slides' ).length ) {
                        $t.find( '.slider-slides .slide-active' ).removeClass( 'slide-active' );
                        var realIndex = swiper.slides.eq( swiper.activeIndex ).attr( 'data-swiper-slide-index' );
                        $t.find( '.slider-slides .slides-item' ).eq( realIndex ).addClass( 'slide-active' );
                    }
                },

            } );
            
            //Stop on hover
            var $currentSwiper = swipers['swiper-' + index];
            if ( $stopOnHover === 'on' && $autoplay ) {
                $t.find('.swiper-wrapper').hover( function () {
                    $currentSwiper.stopAutoplay();
                }, function () {
                    $currentSwiper.startAutoplay();
                } );
            }
            
            initIterator++;
        } );

        //swiper arrows
        $( '.btn-prev' ).on( 'click', function () {
            var mySwiper = swipers['swiper-' + $( this ).parent().attr( 'id' )];
            mySwiper.slidePrev();
        } );

        $( '.btn-next' ).on( 'click', function () {
            var mySwiper = swipers['swiper-' + $( this ).parent().attr( 'id' )];
            mySwiper.slideNext();
        } );

        //swiper tabs
        $( '.slider-slides .slides-item' ).on( 'click', function () {
            if ( $( this ).hasClass( 'slide-active' ) )
                return false;
            var mySwiper = swipers['swiper-' + $( this ).closest( '.swiper-container' ).attr( 'id' )];
            var activeIndex = $( this ).parent().find( '.slides-item' ).index( this );
            var $loop = ( mySwiper.container.data( 'loop' ) === false ) ? mySwiper.container.data( 'loop' ) : true;
            if ( true === $loop ) {
                activeIndex = activeIndex + 1;
            }
            mySwiper.slideTo( activeIndex );
            $( this ).parent().find( '.slide-active' ).removeClass( 'slide-active' );
            $( this ).addClass( 'slide-active' );
            mySwiper.update();
            return false;

        } );
    };

    CRUMINA.resizeSwiper = function ( swiper ) {
        swiper = ( swiper ) ? swiper : $( this )[0].swiper;

        var activeSlideHeight = swiper.slides.eq( swiper.activeIndex ).find( '> *' ).outerHeight();

        var $pagination = $(swiper.container).find( '.slider-slides' ),
            $pagination_height = ( $pagination.length ) ? $pagination.height() : 0;

        if ( $( swiper.container ).hasClass( 'pagination-vertical' ) ) {
            var headlineHeights = swiper.slides.map( function () {
                return $( this ).find( '> *' ).height();
            } ).get();

            var maxHeadLineHeight = Math.max.apply( Math, headlineHeights );
            swiper.container.css( { height: maxHeadLineHeight + 'px' } );
            swiper.update( true )
        }

        if ( $pagination_height > 0 ) {
            swiper.container.css( 'paddingBottom', $pagination_height + 'px' )
            swiper.onResize();
        }

        if ( $( swiper.container ).hasClass( 'auto-height' ) ) {
            swiper = ( swiper ) ? swiper : $( this )[0].swiper;
            swiper.container.css( { height: activeSlideHeight + 'px' } );
            swiper.onResize();
        }



        CRUMINA.mainSliderHeight();
    };

	CRUMINA.mainSliderHeight = function () {
        setTimeout( function () {
            $( '.swiper-container.js-full-window' ).each( function () {

                var $slider = $( this ),
                    $pagination = $slider.find( '.slider-slides' ),
                    $pagination_height = ( $pagination.length ) ? $pagination.height() : 0,
                    winHei = $( window ).height(),
                    $sliderSpaceOffsetTop = $mainContent.offset().top,
                    $sliderSlide = ( '.main-slider .container.d-flex' );

                $( $sliderSlide ).imagesLoaded().done( function () {

                    var $sliderSlideHeight = $( $sliderSlide ).outerHeight();

                    if ( $sliderSlideHeight > winHei - $pagination_height - $sliderSpaceOffsetTop ) {
                        $slider.css( 'min-height', 'auto' ).css( 'height', 'auto' );
                        $slider.find( '> .swiper-wrapper' ).css( 'min-height', 'auto' ).css( 'height', 'auto' );
                    } else {
                        $slider.css( 'min-height', winHei - $sliderSpaceOffsetTop + 'px' ).css( 'height', winHei - $sliderSpaceOffsetTop + 'px' );
                        $slider.find( '> .swiper-wrapper' ).css( 'min-height', winHei - $pagination_height - $sliderSpaceOffsetTop + 'px' ).css( 'height', winHei - $pagination_height - $sliderSpaceOffsetTop + 'px' );
                    }

                } );

            } );
        }, 800 );
    };

    CRUMINA.initSmoothScroll = function () {

        // Cut the mustard
        var supports = 'querySelector' in document && 'addEventListener' in window;
        if ( !supports )
            return;

        // Get all Toggle selectors
        var anchors = $( '#primary-menu a[href*=\\#], .btn[href*=\\#]:not(".scroll-ignore")' ).filter( function () {
            return $( this ).is( ":not([href=\\#])" );
        } );

        // Add smooth scroll to all anchors
        for ( var i = 0, len = anchors.length; i < len; i++ ) {
            var url = new RegExp( window.location.hostname + window.location.pathname );
            if ( !url.test( anchors[i].href ) )
                continue;
            anchors[i].setAttribute( 'data-scroll', true );
        }

        if ( window.location.hash ) {
            var anchor = document.querySelector( window.location.hash ); // Get the anchor
            var toggle = document.querySelector( 'a[href*="' + window.location.hash + '"]' ); // Get the toggle (if one exists)
            var options = { }; // Any custom options you want to use would go here
            if (anchor) {
                smoothScroll.animateScroll(anchor, toggle, options);
            }

        }

        smoothScroll.init( {
            selector: '[data-scroll]',
            speed: 500, // Integer. How fast to complete the scroll in milliseconds
            easing: 'easeOutQuad', // Easing pattern to use
            offset: $header.height(),
            updateURL: true, // Boolean. If true, update the URL hash on scroll
            callback: function ( anchor, toggle ) {
            } // Function to run after scrolling
        } );

        $( '#primary-menu' ).find( '[href=\\#]' ).on( 'click', function () {
            return false
        } )

    };

    CRUMINA.initVideo = function () {
        plyr.setup( '.plyr' );
    };

    CRUMINA.burgerAnimation = function () {
        /* In animations (to close icon) */

        var beginAC = 80,
            endAC = 320,
            beginB = 80,
            endB = 320;

        function inAC( s ) {
            s.draw( '80% - 240', '80%', 0.3, {
                delay: 0.1,
                callback: function () {
                    inAC2( s )
                }
            } );
        }

        function inAC2( s ) {
            s.draw( '100% - 545', '100% - 305', 0.6, {
                easing: ease.ease( 'elastic-out', 1, 0.3 )
            } );
        }

        function inB( s ) {
            s.draw( beginB - 60, endB + 60, 0.1, {
                callback: function () {
                    inB2( s )
                }
            } );
        }

        function inB2( s ) {
            s.draw( beginB + 120, endB - 120, 0.3, {
                easing: ease.ease( 'bounce-out', 1, 0.3 )
            } );
        }

        /* Out animations (to burger icon) */

        function outAC( s ) {
            s.draw( '90% - 240', '90%', 0.1, {
                easing: ease.ease( 'elastic-in', 1, 0.3 ),
                callback: function () {
                    outAC2( s )
                }
            } );
        }

        function outAC2( s ) {
            s.draw( '20% - 240', '20%', 0.3, {
                callback: function () {
                    outAC3( s )
                }
            } );
        }

        function outAC3( s ) {
            s.draw( beginAC, endAC, 0.7, {
                easing: ease.ease( 'elastic-out', 1, 0.3 )
            } );
        }

        function outB( s ) {
            s.draw( beginB, endB, 0.7, {
                delay: 0.1,
                easing: ease.ease( 'elastic-out', 2, 0.4 )
            } );
        }

        /* Scale functions */

        function addScale( m ) {
            m.className = 'menu-icon-wrapper scaled';
        }

        function removeScale( m ) {
            m.className = 'menu-icon-wrapper';
        }

        /* Awesome burger scaled */

        var pathD = document.getElementById( 'pathD' ),
            pathE = document.getElementById( 'pathE' ),
            pathF = document.getElementById( 'pathF' ),
            segmentD = new Segment( pathD, beginAC, endAC ),
            segmentE = new Segment( pathE, beginB, endB ),
            segmentF = new Segment( pathF, beginAC, endAC ),
            wrapper2 = document.getElementById( 'menu-icon-wrapper' ),
            trigger2 = document.getElementById( 'menu-icon-trigger' ),
            toCloseIcon2 = true;

        wrapper2.style.visibility = 'visible';

        trigger2.onclick = function () {
            addScale( wrapper2 );
            if ( toCloseIcon2 ) {
                inAC( segmentD );
                inB( segmentE );
                inAC( segmentF );
            } else {
                outAC( segmentD );
                outB( segmentE );
                outAC( segmentF );

            }
            toCloseIcon2 = !toCloseIcon2;
            setTimeout( function () {
                removeScale( wrapper2 )
            }, 450 );
        };
    };


    /* -----------------------------
     * On Click Functions
     * ---------------------------*/
    $window.keydown( function ( eventObject ) {
        if ( eventObject.which == 27 ) {
            if ( $asidePanel.hasClass( 'opened' ) ) {
                CRUMINA.togglePanel();
            }
            if($popupSearch.css('display', 'block')){
				$popupSearch.fadeToggle();
				$popupSearch.animate( {
					'width': 320
				}, 600 );
            }
            if ( $body.hasClass( 'open' ) ) {
                CRUMINA.toggleSearch();
            }
            if ( $topbar.hasClass( 'open' ) ) {
                CRUMINA.toggleBar();
            }
        }
    } );

    jQuery( ".js-close-aside" ).on( 'click', function () {
        if ( $asidePanel.hasClass( 'opened' ) ) {
            CRUMINA.togglePanel();
        }
        return false;
    } );

    jQuery( ".js-open-aside" ).on( 'click', function () {
        if ( !$asidePanel.hasClass( 'opened' ) ) {
            CRUMINA.togglePanel();
        }
        return false;
    } );

    //top bar
    jQuery( ".top-bar-link" ).on( 'click', function () {
        CRUMINA.toggleBar();
    } );
    jQuery( '.top-bar-close' ).on( 'click', function () {
        CRUMINA.toggleBar();
    } );


    jQuery( ".js-open-search" ).on( 'click', function () {
        CRUMINA.toggleSearch();
        return false;
    } );

    jQuery( ".overlay_search-close" ).on( 'click', function () {
        $body.removeClass( 'open' );
        return false;
    } );

    jQuery( ".js-open-p-search" ).on( 'click', function (e) {
        e.preventDefault();
        $popupSearch.fadeToggle();
		$popupSearch.animate( {
			'width': $popupSearch.closest( '.container' ).width()
		}, 600 );
		$popupSearch.find( 'input' ).focus();
	});

    //Remove play button on play in video player
    $( '.plyr' ).on( 'click', function () {
        $( this ).removeClass( 'hide-controls' );
    } );

    CRUMINA.quantity_selector_button_mod = function () {
        jQuery( ".quantity input[type=number]" ).each( function () {
            var number = jQuery( this ),
                max = parseFloat( number.attr( 'max' ) ),
                min = parseFloat( number.attr( 'min' ) ),
                step = parseInt( number.attr( 'step' ), 10 ),
                newNum = jQuery( jQuery( '<div />' ).append( number.clone( true ) ).html().replace( 'number', 'text' ) ).insertAfter( number );
            number.remove();

            setTimeout( function () {
                if ( newNum.next( '.quantity-plus' ).length == 0 ) {
                    var minus = jQuery( '<input type="button" value="-" class="quantity-minus">' ).insertBefore( newNum ),
                        plus = jQuery( '<input type="button" value="+" class="quantity-plus">' ).insertAfter( newNum );

                    minus.on( 'click', function () {
                        var the_val = parseInt( newNum.val(), 10 ) - step;
                        the_val = the_val < 0 ? 0 : the_val;
                        the_val = the_val < min ? min : the_val;
                        newNum.val( the_val );
                        enable_update_cart_button();
                    } );
                    plus.on( 'click', function () {
                        var the_val = parseInt( newNum.val(), 10 ) + step;
                        the_val = the_val > max ? max : the_val;
                        newNum.val( the_val );
                        enable_update_cart_button();
                    } );

                }
            }, 10 );

        } );
    };
    // since woocommerce 2.6 the update_cart button is disabeld by default and needs to be enabled if quantities change
    function enable_update_cart_button() {
        var $update_cart_button = jQuery( 'table.shop_table.cart' ).closest( 'form' ).find( 'input[name="update_cart"]' );
        if ( $update_cart_button.length ) {
            $update_cart_button.prop( 'disabled', false );
        }
    }
    // listen to updated_wc_div event since woocommerce 2.6 to redraw quantity selector and update the cart icon value
    jQuery( document ).bind( "updated_wc_div", function () {
        //setTimeout( update_cart_sub-menu, 1000 ); // high timeout needed because the minicard is drawn after the updated_wc_div event
        CRUMINA.quantity_selector_button_mod();
    } );

    /*---------------------------------
     ACCORDION
     -----------------------------------*/
    $( '.accordion-heading' ).on( 'click', function () {
        $( this ).parents( '.panel-heading' ).toggleClass( 'active' );
        $( this ).parents( '.accordion-panel' ).toggleClass( 'active' );
    } );
    CRUMINA.initAccordion = function ( wrp ) {
        $( wrp ).find( '.accordion-heading' )
            .off( 'click' )
            .on( 'click', function () {
                $( this ).parents( '.panel-heading' ).toggleClass( 'active' );
                $( this ).parents( '.accordion-panel' ).toggleClass( 'active' );
            } );
    };

    //Scroll to top.
    $( '.back-to-top' ).on( 'click', function () {
        $( 'html,body' ).animate( {
            scrollTop: 0
        }, 1200 );
        return false;
    } );

    $( ".input-dark" ).find( 'input' ).focus( function () {
        $( this ).closest( 'form' ).addClass( 'input-drop-shadow' );
    } ).blur( function () {
        $( this ).closest( 'form' ).removeClass( 'input-drop-shadow' );
    } );

    /* -----------------------------
     * On DOM ready functions
     * ---------------------------*/
    CRUMINA.init = function () {

        // 3-d party libs run
        $primaryMenu.crumegamenu( {
            showSpeed: 0,
            hideSpeed: 0,
            trigger: "hover",
            animation: "drop-up",
            indicatorFirstLevel: "&#xf0d7",
            indicatorSecondLevel: "&#xf105"
        } );

        if ( $( '#menu-icon-wrapper' ).length ) {
            CRUMINA.burgerAnimation();
        }
        CRUMINA.tooltips();

        CRUMINA.customScroll();
        CRUMINA.initSwiper();

        CRUMINA.equalHeight();
        CRUMINA.headerSpacer();
        CRUMINA.mediaPopups();
        CRUMINA.IsotopeSort();
        CRUMINA.blogMasonry();
        CRUMINA.parallaxFooter();
        CRUMINA.runTimeLine();
        CRUMINA.initSmoothScroll();
        CRUMINA.quantity_selector_button_mod();
        CRUMINA.fixedHeaderInit();
        CRUMINA.videoBgInit();
        CRUMINA.niceSelectInit();
        CRUMINA.notGruppedInit();
        CRUMINA.cartPopup.init();
        CRUMINA.backgroundAnimationInit();
        CRUMINA.addEventListeners();

        if ($preloader.length) {
            CRUMINA.preloader();
        }

        // On Scroll animations.
        CRUMINA.animateSvg();
        CRUMINA.counters();
        CRUMINA.progresBars();
        CRUMINA.pieCharts();
        CRUMINA.chartJs();
        
        CRUMINA.filterAjaxPortfolioParams();

    };

    CRUMINA.addEventListeners = function () {
        $( window ).on( 'resize', function () {
            CRUMINA.mainSliderHeight();
            CRUMINA.headerSpacer();
            CRUMINA.fixedHeaderInit();
        } );

        // Hide open popups
        $document.on( 'click', function ( event ) {
            if ( !$( event.target ).closest( $asidePanel ).length ) {
                if ( $asidePanel.hasClass( 'opened' ) ) {
                    CRUMINA.togglePanel();
                }
            }

        } );
    };
    
    CRUMINA.videoBgInit = function(){
      $('.js-section-background').background();  
    };

    CRUMINA.niceSelectInit = function () {
        $( 'select.nice-select, select.orderby, .variations select, .card-expiration select' ).niceSelect();
    };

    CRUMINA.backgroundAnimationInit = function () {
        if ( $subscribe_section.length && $subscribe_section.hasClass( 'js-animated' ) ) {
            CRUMINA.SubscribeScrollAnnimation();
        }
        if ( $( '.crumina-your-score' ).length ) {
            CRUMINA.SeoScoreScrollAnnimation();
        }
        if ( $( '.crumina-testimonial-slider' ).length ) {
            CRUMINA.TestimonialScrollAnnimation();
        }
        if ( $( '.crumina-our-vision' ).length ) {
            CRUMINA.OurVisionScrollAnnimation();
        }
        if ( $( '.crumina-background-mountains' ).length ) {
            CRUMINA.MountainsScrollAnnimation();
        }
    };

    CRUMINA.notGruppedInit = function () { // Must be optimized letter
        $( ".input-text" ).each( function () {
            $( this ).addClass( 'input-standard-grey' );
        } );

        $( ".crumina-module.list" ).each( function () {
            var $this = $( this );
            var $icon = $( this ).data( 'icon' );
            if ( $icon.length ) {
                $this.find( 'li' ).wrapInner( '<div class="ovh"></div>' );
                $this.find( 'li' ).prepend( '<i class="' + $icon + '"></i>' );
            }
        } );

    };

    CRUMINA.cartPopup = {
        $wrap: null,
        $cart: null,
        init: function () {
            this.$wrap = $( 'nav.primary-menu .cart-contents' );
            this.$cart = $( '.cart-popup-wrap', this.$wrap );

            this.addEventListeners();
        },
        addEventListeners: function () {
            var _this = this;
            this.$wrap.on( 'click', '.js-cart-animate', function ( event ) {
                event.preventDefault();
                _this.$cart.toggleClass( 'visible' );
                _this.$cart.fadeToggle( 200 );
            } );

            $document.on( 'click', function ( event ) {
                if ( !$( event.target ).closest( _this.$wrap ).length ) {
                    if ( _this.$cart.hasClass( 'visible' ) ) {
                        _this.$cart.fadeToggle( 200 );
                        _this.$cart.toggleClass( 'visible' )
                    }
                }
            } );
        },
    };

    $document.ready( function () {
        CRUMINA.init();
    } );

} )( jQuery );
