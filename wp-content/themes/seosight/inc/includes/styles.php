<?php

if ( !defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

//custom styles
add_action( 'wp_enqueue_scripts', 'seosight_custom_css_styles', 99 );

//custom styles
add_action( 'wp_enqueue_scripts', '_seosight_custom_font', 99 );

function _seosight_generate_font_styles( $tag ) {
	$font		 = fw_get_db_customizer_option( 'typography_' . $tag, array() );
	$font_family = fw_akg( 'family', $font, 'Default' );
	$font_color	 = fw_akg( 'color', $font, '' );

	if ( $tag === 'logo' ) {
		$font_css = '.logo .logo-text .logo-title, .logo .logo-text .logo-sub-title{';
	} elseif ( $tag === 'nav' ) {
		$font_css = '.primary-menu-menu .menu-item > a, .megamenu-item-info{';
	} elseif ( $tag === 'body' ) {
		$font_css = 'body, p, article p{';
	} else {
		$font_css = $tag . ', .' . $tag . '{';
	}
	if ( !empty( $font_family ) && 'Default' !== $font_family ) {
		$font_css	 .= 'font-family:"' . $font_family . '", sans-serif;';
		$variant	 = fw_akg( 'variation', $font, '' );
		if ( $variant ) {
			if ( substr_count( $variant, 'italic' ) > 0 ) {
				$font_css	 .= 'font-style:italic;';
				$variant	 = str_replace( 'italic', '', $variant );
			}
			$font_css .= 'font-weight:' . $variant . ';';
		} elseif ( false === $font[ 'google_font' ] ) {
			$font_css	 .= 'font-style:' . $font[ 'style' ] . ';';
			$font_css	 .= 'font-weight:' . $font[ 'weight' ] . ';';
		}
	}

	if ( !empty( $font_color ) ) {
		$font_css .= 'color:' . $font_color . ';';
	}

	$letter_spacing = fw_akg( 'letter-spacing', $font, '' );
	if ( !empty( $letter_spacing ) ) {
		$font_css .= 'letter-spacing:' . $letter_spacing . 'px;';
	}
	$size = fw_akg( 'size', $font, '' );
	if ( !empty( $size ) ) {
		$font_css .= 'font-size:' . $size . 'px;';
	}
	$font_css .= '} ';

	return $font_css;
}

function _seosight_custom_font() {
	$custom_css = '';

	if ( function_exists( 'fw_get_db_settings_option' ) ) {
		$custom_css	 .= _seosight_generate_font_styles( 'h1' );
		$custom_css	 .= _seosight_generate_font_styles( 'h2' );
		$custom_css	 .= _seosight_generate_font_styles( 'h3' );
		$custom_css	 .= _seosight_generate_font_styles( 'h4' );
		$custom_css	 .= _seosight_generate_font_styles( 'h5' );
		$custom_css	 .= _seosight_generate_font_styles( 'h6' );
		$custom_css	 .= _seosight_generate_font_styles( 'body' );
		$custom_css	 .= _seosight_generate_font_styles( 'nav' );
		$custom_css	 .= _seosight_generate_font_styles( 'logo' );
	}
	wp_add_inline_style( 'seosight-theme-style', $custom_css );
}

function seosight_custom_css_styles() {
	if ( function_exists( 'fw_get_db_customizer_option' ) ) {
		$custom_css		 = '';
		
		$primary_color	 = get_option( 'primary-accent-color' );
		$primary_color	 = $primary_color !== false ? $primary_color : fw_get_db_customizer_option( 'primary_color', '' );

		$secondary_color = get_option( 'secondary-accent-color' );
		$secondary_color = $secondary_color !== false ? $secondary_color : fw_get_db_customizer_option( 'secondary_color', '' );

		$website_preloader = fw_get_db_customizer_option( 'website_preloader', '' );

		if ( true === $website_preloader ) {
			if ( !empty( $primary_color ) ) {
				$bg_color = $primary_color;
			} else {
				$bg_color = '#4cc2c0';
			}
			$custom_css .= '#hellopreloader {display: block;position: fixed;z-index: 99999;top: 0;left: 0;width: 100%;height: 100%;min-width: 100%;background: url(' . get_template_directory_uri() . '/svg/preloader.svg) center center no-repeat;  background-color: ' . esc_attr( $bg_color ) . ';  background-size:100px;  opacity: 1;}';
		}

		if ( !empty( $primary_color ) ) {
			$custom_css .= 'a:hover,
.post__content ul ol ul li::before,
.first-letter--primary span:first-of-type,
.list--primary a:hover,
.list--primary i,
.crumina-accordion .panel-heading.active .accordion-heading i,
.crumina-accordion .panel-heading.active a,
.crumina-accordion .panel-heading:hover .accordion-heading,
.crumina-accordion .panel-heading:hover .accordion-heading i,
.c-primary,
.woocommerce-info:before,
.btn--primary.btn-border,
.btn--primary.btn-border:hover,
.btn--breez.btn-border,
.btn--breez.btn-border:hover,
.info-box.info-box--standard-bg .info-box-image i,
.info-box.info-box--modern:hover .read-more,
.info-box.info-box--modern:hover .read-more i,
.info-box.info-box--standard-hover:hover .info-box-title,
.info-box.info-box--standard-hover:hover .read-more,
input.input-standard-grey:focus,
textarea.input-standard-grey:focus,
.navigation .page-numbers:hover,
.navigation .page-numbers.current,
.pagination-arrow .btn-prev-wrap:hover .btn-content .btn-content-title,
.pagination-arrow .all-project:hover i,
.pagination-arrow .btn-next-wrap:hover .btn-content .btn-content-title,
.kc-tweet-owl .owl-controls.clickable .owl-buttons .owl-prev:hover:before,
.kc-tweet-owl .owl-controls.clickable .owl-buttons .owl-next:hover:after,
.load-more:hover .load-more-text,
.cart-popup-wrap .cart-total .cart-total-text .total-price,
.post .post__content .post__title:hover,
.post .post__author .post__author-name .post__author-link:hover,
.post-standard .post-thumb .link-image:hover,
.post-standard .post-thumb .link-post:hover,
.post-standard .post__content .post__content-info .post-additional-info .category a:hover,
.post-standard-details .post__content .post-additional-info .post__comments a:hover,
.post-standard-details .post__content .post-additional-info .post__comments a:hover i,
.post-standard .post__content .post__content-info .post-additional-info .post__comments a:hover,
.post-standard.quote .post-thumb .testimonial-content .author-info-wrap .author-info .author-name,
.post-standard.audio .post-thumb .audio-player .composition-time .time-over,
.post-standard-details .post__content .post-additional-info .category a:hover,
.post-standard-details .post__content .post-additional-info .post__comments:hover,
.ui-tabs .kc_tabs_nav > .ui-tabs-active a,
.ui-tabs .kc_tabs_nav > .ui-tabs-active a:hover,
.stunning-header .stunning-header-content .breadcrumbs .breadcrumbs-item.active span.c-primary,
.testimonial-item.testimonial-author-top .author-name,
.testimonial-item.testimonial-author-centered .author-name,
.testimonial-item.testimonial-author-centered-round .author-name,
.woocommerce .woocommerce-shipping-fields textarea:focus,
.woocommerce .woocommerce-billing-fields textarea:focus,
.comments .comment-list .comments__item .comment-reply-link:hover,
.commentlist .comment-list .comments__item .comment-reply-link:hover,
.contact-form .checked-icon:after,
.remember-wrap .checkbox.gray input[type=checkbox]:checked + label:before,
.contacts .contacts-item .content .title:hover,
.features-item:hover a,
.features-item:hover .read-more,
.features-item a:hover,
.features-item .read-more:hover,
.footer a:hover,
.header nav .menu .menu-item:hover > a,
.header nav .menu .menu-item:hover > a + i,
.nav-add li.search i:hover,
.crumina-heading .heading-decoration,
.crumina-heading .read-more:hover,
.right-menu .contacts .contacts-item .content a:hover,
.crumina-pie-chart-item .pie-chart-content a:hover,
.crumina-pie-chart-item .pie-chart-content a:hover i,
.crumina-pricing-tables-item:hover .pricing-title,
.crumina-pricing-tables-item .rate,
.primary-menu-menu > li.active > a,
.primary-menu-menu > li:hover > a,
.primary-menu-menu > li:hover > i,
.primary-menu-menu ul.sub-menu a:hover > i,
.primary-menu-menu > li.menu-item-has-mega-menu .megamenu ul > li a:hover i,
.primary-menu-menu > li.menu-item-has-mega-menu .megamenu ul > li > ul > li:hover a,
.primary-menu-menu > li.menu-item-has-mega-menu .megamenu ul > li a:hover,
.primary-menu-menu ul.sub-menu li:hover > a,
.primary-menu-menu li ul.sub-menu li:hover > a .indicator,
.primary-menu-menu > li:hover > a > .indicator,
.product-details .product-details-info .woocommerce-review-link,
.product-details .product-details-add-info .author .author-name,
.product-details .product-details-add-info .tags .tags-item:hover,
.product-description .product-description-control li.active .control-item,
.crum-icon-module i,
.cat-list .cat-list__item a:hover,
.cat-list .cat-list__item.active a,
.shop-user-form .item-title.active,
.shop-user-form .helped,
.cd-horizontal-timeline .events a.selected,
.cd-horizontal-timeline .events a.older-event,
.no-touch .cd-timeline-navigation a:hover:before,
#site-footer .contacts-item .content .title:hover,
.w-post-category .category-post-item a i,
.w-post-category .category-post-item:hover a,
.widget_nav_menu .menu li a:hover,
.widget_nav_menu .menu li a:hover:before,
 .top-bar .nice-select,
.top-bar .nice-select span,
.top-bar a:hover,
.top-bar .nice-select .option:hover,
 #site-footer .contacts-item .content .title:hover,
.comments .comment-list .comments__item .comments__article .comments__header .comments__author a:hover,
.commentlist .comment-list .comments__item .comments__article .comments__header .comments__author a:hover,
.btn.c-primary:hover,
.primary-menu-menu > li.has-megamenu .megamenu ul > li:hover i.seoicon-right-arrow,
.primary-menu-menu > li.has-megamenu .megamenu ul > li:hover a,
.primary-menu-menu > li.current-menu-item,
.primary-menu-menu > li.current-menu-item a {
  color: ' . esc_attr( $primary_color ) . ';
}';


			$custom_css .= '.back-to-top:hover,
.pagination-arrow .btn-prev-wrap:hover .btn-prev,
.pagination-arrow .btn-next-wrap:hover .btn-next,
.btn-next:hover,
.btn-next .btn-next-gray:hover,
.btn-prev:hover,
.btn-prev .btn-prev-gray:hover {
  fill: ' . esc_attr( $primary_color ) . ';
}';

			$custom_css	 .= '
.first-letter--squared span:first-of-type,
.woocommerce a.button.wc-backward,
.btn--primary,
.btn--breez,
.kc-tweet-owl .owl-controls.clickable .owl-buttons .owl-prev:hover,
.kc-tweet-owl .owl-controls.clickable .owl-buttons .owl-next:hover,
.post-standard .post__content .post__content-info .btn:hover,
.ui-tabs .kc_tabs_nav > li > a:before,
.cart-main .actions .coupon .btn-medium.btn--breez,
.cart_item .product-quantity .quantity .quantity-minus:hover,
.cart_item .product-quantity .quantity .quantity-plus:hover,
.woocommerce .checkout_coupon.coupon input.btn--breez,
.client-item-style2:hover,
.remember-wrap .checkbox label:before,
.header nav .menu .menu-item > a:after,
.header nav .menu .menu-item > a:before,
.nav-add li.cart .cart-count,
.woocommerce-checkout-review-order-table .cart_item.total,
.overlay_search .form_search-wrap form .overlay_search-input:focus+.overlay_search-close span,
.right-menu .mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar,
.mCSB_scrollTools .mCSB_dragger:hover .mCSB_dragger_bar,
.mCSB_scrollTools .mCSB_dragger:active .mCSB_dragger_bar,
.mCSB_scrollTools .mCSB_dragger.mCSB_dragger_onDrag .mCSB_dragger_bar,
.mCSB_scrollTools .mCSB_draggerRail,
.primary-menu-menu ul.sub-menu.sub-menu-has-icons li a:before,
.product-description .product-description-control li .control-item:before,
.crumina-case-item:hover,
.cat-list-bg-style .cat-list__item a:hover,
.cat-list-bg-style .cat-list__item.active,
.shop-user-form .login-btn-wrap .remember-wrap .checkbox label:before,
.woocommerce .product-item  a.added_to_cart,
.cd-horizontal-timeline .filling-line,
.no-touch .cd-horizontal-timeline .events a:hover::after,
.cd-horizontal-timeline .events a.selected::after,
.tags-wrap a:hover,
.widget.w-login .remember-wrap .checkbox label:before,
.post-edit-link, .top-bar-link,
 .info-box--standard-centered .btn:hover,
div:hover > .btn-reverse-bg-color-primary,
.servises-item-reverse-color:hover,
.right-menu .ps > .ps__scrollbar-y-rail > .ps__scrollbar-y,
#subscribe-section, .w-tags .tags-wrap a:hover,
.submit-wrap button,
.right-menu .ps > .ps__scrollbar-y-rail > .ps__scrollbar-y,
.post-password-form input[type="submit"],
.kc-carousel-images .bar,
.crumina-grid .owl-nav-round.owl-theme .owl-controls .owl-buttons div:hover,
.crumina-grid .owl-theme .owl-controls .owl-buttons div {

  background-color: ' . esc_attr( $primary_color ) . ';
}';
			$custom_css	 .= '
.selection--primary::-moz-selection {
  background-color: ' . esc_attr( $primary_color ) . ';
}';
			$custom_css	 .= '
.selection--primary::selection {
  background-color: ' . esc_attr( $primary_color ) . ';
}';
			$custom_css	 .= '
.c-primary .semicircle:after,
.btn--primary.btn-border  .semicircle::after,
.btn--primary.btn-border,
.btn--breez.btn-border,
.btn--breez.btn-border .semicircle::after,
.navigation .page-numbers.current,
.cart_item .product-quantity .quantity .quantity-minus:hover,
.cart_item .product-quantity .quantity .quantity-plus:hover,
.no-touch .cd-horizontal-timeline .events a:hover::after,
.cd-horizontal-timeline .events a.selected::after,
.cd-horizontal-timeline .events a.older-event::after,
.no-touch .cd-timeline-navigation a:hover,
#site-footer .widget.w-tags .tags-wrap a:hover,
.tags-wrap a:hover,
.widget_product_tag_cloud .tagcloud a:hover,
.product-details .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active,
.swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active,
.swiper-pagination.light .swiper-pagination-bullet.swiper-pagination-bullet-active,
.swiper-pagination.grey .swiper-pagination-bullet.swiper-pagination-bullet-active,
.kc-tweet-owl .owl-controls.clickable .owl-pagination .owl-page.active span,
 .top-bar a:hover, .w-tags .tags-wrap a:hover {

  border-color: ' . esc_attr( $primary_color ) . ';
}';
			$custom_css	 .= '
.woocommerce-info,
.woocommerce-message,
.woocommerce-checkout-review-order-table .cart_item.total .product-thumbnail:after,
.primary-menu-menu > li > a:before,
.primary-menu-menu > li > a:after,
.cat-list .cat-list__item a:before,
.cat-list .cat-list__item a:after {
  border-top-color: ' . esc_attr( $primary_color ) . ';
}';

			$custom_css .= '
.overlay_search .form_search-wrap form .overlay_search-input:focus {
  border-bottom-color: ' . esc_attr( $primary_color ) . ';
}';
		}
		if ( !empty( $secondary_color ) ) {
			$custom_css	 .= '
.product-description ul li:before,
.post__content ul li:before,
.list--secondary a:hover,
.list--secondary i,
.btn--secondary.btn-border,
.btn--secondary.btn-border:hover,
.crumina-info-box .info-box-image i,
.cart-popup-wrap .popup-cart .cart-product .cart-product__item .product-del,
.contact-form label sup,
.nav-add li.search .popup-search .search-btn i:hover,
.woocommerce #content .price {
  color: ' . esc_attr( $secondary_color ) . ';
}';
			$custom_css	 .= '
.btn--secondary,
.btn--secondary:hover,
.btn--secondary.btn-hover-shadow:hover,
.user-menu .user-menu-content,
.right-menu .right-menu-wrap .user-menu-close .user-menu-content,
ul.products .product-item .onsale,
.woocommerce.single #primary .onsale,
.form-subscribe button,
div:hover > .btn-reverse-bg-color-secondary  {
  background-color: ' . esc_attr( $secondary_color ) . ';
}';
			$custom_css	 .= '
.btn--secondary.btn-border,
.btn--secondary.btn-border .semicircle::after {
  border-color: ' . esc_attr( $secondary_color ) . ';
}';
		}


		if ( is_page() || is_singular( 'fw-portfolio' ) || is_singular( 'post' ) ) {
			$page_id				 = get_the_ID();
			$enable_customization	 = fw_get_db_post_option( $page_id, 'custom-header/enable', 'no' );
			if ( 'yes' === $enable_customization ) {
				$header_opacity	 = fw_get_db_post_option( $page_id, 'custom-header/yes/header-opacity', '100' );
				$font_color		 = fw_get_db_post_option( $page_id, 'custom-header/yes/header-color', '' );
				if ( 100 != $header_opacity || !empty( $font_color ) ) {
					$custom_css .= '#site-header{';
					if ( 100 != $header_opacity ) {
						$custom_css .= 'background:rgba(255,255,255,0.' . esc_attr( $header_opacity ) . ');';
					}
					if ( !empty( $font_color ) ) {
						$custom_css .= 'color:' . esc_attr( $font_color ) . ';';
					}
					$custom_css .= '}';
				}
			}
		}

		$options = function_exists( 'fw_get_db_customizer_option' ) ? fw_get_db_customizer_option( 'stunning-show', array() ) : array();

		$style					 = '';
		$bg_color				 = fw_get_db_customizer_option( 'stunning_bg_color', '' );
		$bg_image				 = fw_get_db_customizer_option( 'stunning_bg_type/image_bg/stunning_bg_image', fw_get_db_customizer_option( 'stunning_bg_image', array() ) );
		$bg_cover				 = fw_get_db_customizer_option( 'stunning_bg_type/image_bg/stunning_bg_cover', fw_get_db_customizer_option( 'stunning_bg_cover', false ) );
		$text_color				 = fw_get_db_customizer_option( 'stunning_text_color', '' );
		$enable_customization	 = fw_get_db_post_option( get_the_ID(), 'custom-stunning/enable', 'no' );
		$queried_object			 = get_queried_object();
		if ( is_category() ) {
			$enable_customization = fw_get_db_term_option( get_queried_object_id(), 'category', 'custom-stunning/enable', 'no' );
		} elseif ( is_tax() && 'fw-portfolio-category' === $queried_object->taxonomy ) {
			$enable_customization = fw_get_db_term_option( $queried_object->term_id, $queried_object->taxonomy, 'custom-stunning/enable', 'no' );
		}
		if ( 'yes' === $enable_customization ) {
			$options = fw_get_db_post_option( get_the_ID(), 'custom-stunning/yes/stunning-show', array() );
			if ( is_category() ) {
				$options = fw_get_db_term_option( get_queried_object_id(), 'category', 'custom-stunning/yes/stunning-show', array() );
			} elseif ( is_tax() && 'fw-portfolio-category' === $queried_object->taxonomy ) {
				$options = fw_get_db_term_option( $queried_object->term_id, $queried_object->taxonomy, 'custom-stunning/yes/stunning-show', array() );
			}

			$meta_bg_color	 = fw_akg( 'yes/stunning_bg_color', $options, '' );
			$meta_bg_image	 = fw_akg( 'yes/stunning_bg_type/image_bg/stunning_bg_image', $options, fw_akg( 'yes/stunning_bg_image', $options, array() ) );
			$meta_bg_cover	 = fw_akg( 'yes/stunning_bg_type/image_bg/stunning_bg_cover', $options, fw_akg( 'yes/stunning_bg_cover', $options, false ) );
			$meta_text_color = fw_akg( 'yes/stunning_text_color', $options, '' );

			$bg_color	 = !empty( $meta_bg_color ) ? $meta_bg_color : $bg_color;
			$bg_image	 = !empty( $meta_bg_image ) ? $meta_bg_image : $bg_image;
			$bg_cover	 = !empty( $meta_bg_cover ) ? $meta_bg_cover : $bg_cover;
			$text_color	 = !empty( $meta_text_color ) ? $meta_text_color : $text_color;
		}

		$bg_img_url = fw_akg( 'data/css/background-image', $bg_image, '' );

		if ( fw_akg( 'yes/padding-top', $options, '125px' ) !== '125px' ) {
			$style .= 'padding-top:' . fw_akg( 'yes/padding-top', $options ) . ';';
		}
		if ( fw_akg( 'yes/padding-bottom', $options, '125px' ) !== '125px' ) {
			$style .= 'padding-bottom:' . fw_akg( 'yes/padding-bottom', $options ) . ';';
		}
		if ( !empty( $bg_color ) ) {
			$style .= 'background-color:' . ( $bg_color ) . ';';
		}
		if ( !empty( $bg_img_url ) ) {
			$style .= 'background-image:' . ( $bg_img_url ) . ';';
		}
		if ( true === $bg_cover ) {
			$style .= 'background-size:cover;';
		}
		if ( !empty( $text_color ) ) {
			$style .= 'color:' . ( $text_color ) . ';';
		}

		if ( !empty( $style ) ) {
			$custom_css .= '#stunning-header{' . $style . '}';
		}

		$subscribe_section		 = fw_get_db_customizer_option( 'show_subscribe_section', 'yes' );
		$enable_customization	 = fw_get_db_post_option( get_the_ID(), 'custom-subscribe/enable', 'no' );
		if ( 'yes' === $enable_customization ) {
			$subscribe_section = fw_get_db_post_option( get_the_ID(), 'custom-subscribe/yes/subscribe-show/value', 'yes' );
		}
		if ( 'yes' === $subscribe_section ) {
			// Subscribe section styling.
			$subscribe_bg		 = fw_get_db_customizer_option( 'subscribe_bg_color', '' );
			$subscribe_bg_img	 = fw_get_db_customizer_option( 'subscribe_bg_image', '' );

			$subscribe_bg_cover	 = fw_get_db_customizer_option( 'subscribe_bg_cover', false );
			$subscribe_text		 = fw_get_db_customizer_option( 'subscribe_text_color', '' );

			if ( 'yes' === $enable_customization ) {
				$panel_options		 = fw_get_db_post_option( get_the_ID(), 'custom-subscribe/yes/subscribe-show', array() );
				// Subscribe section styling.
				$subscribe_bg		 = fw_akg( 'yes/subscribe_bg_color', $panel_options, '' );
				$subscribe_bg_img	 = fw_akg( 'yes/subscribe_bg_image', $panel_options, '' );

				$subscribe_bg_cover	 = fw_akg( 'yes/subscribe_bg_cover', $panel_options, '' );
				$subscribe_text		 = fw_akg( 'yes/subscribe_text_color', $panel_options, '' );
			}
			if ( !empty( $subscribe_bg ) || !empty( $subscribe_bg_img ) || !empty( $subscribe_text ) ) {
				$custom_css .= '#subscribe-section{';
				if ( !empty( $subscribe_bg ) ) {
					$custom_css .= 'background-color:' . esc_attr( $subscribe_bg ) . ';';
				}
				if ( !empty( $subscribe_bg_img ) ) {
					$bg_img_url = fw_akg( 'data/css/background-image', $subscribe_bg_img, '' );
					if ( !empty( $bg_img_url ) ) {
						$custom_css .= 'background-image:' . ( $bg_img_url ) . ';';

						if ( true === $subscribe_bg_cover ) {
							$custom_css .= 'background-size:cover;';
						}
					}
				}
				if ( !empty( $subscribe_text ) ) {
					$custom_css .= 'color:' . esc_attr( $subscribe_text ) . ';';
				}
				$custom_css .= '} ';
			}
		}

		// Paddings
		$padding_top	 = 120;
		$padding_bottom	 = 120;
		if ( function_exists( 'fw_get_db_customizer_option' ) ) {
			$menu_bg_color			 = fw_get_db_customizer_option( 'dropdown-style/2/bg-color', '#ecf4fc' );
			$sections_padding_data	 = fw_get_db_customizer_option( 'sections_padding', '' );
			$sections_padding_picker = fw_akg( 'sections_padding_picker', $sections_padding_data, 'medium' );

			switch ( $sections_padding_picker ) {
				case 'small':
					$padding_top	 = 70;
					$padding_bottom	 = 70;
					break;
				case 'medium':
					$padding_top	 = 120;
					$padding_bottom	 = 120;
					break;
				case 'large':
					$padding_top	 = 170;
					$padding_bottom	 = 170;
					break;
				default:
					$padding_top	 = (int) fw_akg( 'custom/top', $sections_padding_data, 120 );
					$padding_bottom	 = (int) fw_akg( 'custom/bottom', $sections_padding_data, 120 );
					break;
			}
		}

		if ( is_int( $padding_top ) && is_int( $padding_bottom ) ) {
			$custom_css .= ".kc_row:not(.kc_row_inner) {padding: {$padding_top}px 0 {$padding_bottom}px;}";
		}

		// Footer section styling.
		$footer_bg		 = fw_get_db_customizer_option( 'footer_bg_color', '' );
		$footer_bg_img	 = fw_get_db_customizer_option( 'footer_bg_image', '' );
		$footer_bg_cover = fw_get_db_customizer_option( 'footer_bg_cover', false );
		$footer_text	 = fw_get_db_customizer_option( 'footer_text_color', '' );
		$footer_title	 = fw_get_db_customizer_option( 'footer_title_color', '' );

		if ( !empty( $footer_bg ) || !empty( $footer_bg_img ) || !empty( $footer_text ) ) {
			$custom_css .= '#site-footer{';
			if ( !empty( $footer_bg ) ) {
				$custom_css .= 'background-color:' . esc_attr( $footer_bg ) . ';';
			}
			if ( !empty( $footer_bg_img ) ) {
				$bg_img_url = fw_akg( 'data/css/background-image', $footer_bg_img, '' );
				if ( isset( $footer_bg_img ) && !empty( $footer_bg_img ) ) {
					$custom_css .= 'background-image:' . ( $bg_img_url ) . ';';

					if ( true === $footer_bg_cover ) {
						$custom_css .= 'background-size:cover;';
					}
				}
			}
			if ( !empty( $footer_text ) ) {
				$custom_css .= 'color:' . esc_attr( $footer_text ) . ';';
			}
			$custom_css .= '}';
		}
		if ( !empty( $footer_title ) ) {
			$custom_css	 .= '.footer .info .heading .heading-title, #site-footer .contacts-item .content .title, #site-footer a{';
			$custom_css	 .= 'color:' . esc_attr( $footer_title ) . ';';
			$custom_css	 .= '}';
		}

		// Copyright section styling.
		$copyright_bg	 = fw_get_db_customizer_option( 'copyright_bg_color', '' );
		$copyright_text	 = fw_get_db_customizer_option( 'copyright_text_color', '' );
		if ( !empty( $copyright_bg ) || !empty( $copyright_text ) ) {
			if ( !empty( $copyright_bg ) ) {
				$custom_css .= '#site-footer .sub-footer{ background-color:' . esc_attr( $copyright_bg ) . '}';
			}
			if ( !empty( $copyright_text ) ) {
				$custom_css .= '#site-footer .site-copyright-text{ color:' . esc_attr( $copyright_text ) . '}';
			}
		}

		wp_add_inline_style( 'seosight-color-scheme', $custom_css );
	}
}
