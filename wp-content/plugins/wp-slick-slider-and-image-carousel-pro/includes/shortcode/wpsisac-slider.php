<?php
/**
 * 'slick-slider' Shortcode
 * 
 * @package WP Responsive Recent Post Slider Pro
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function wpsisac_pro_slick_slider( $atts, $content = null ) {

	// Shortcode Parameter
	$atts = shortcode_atts(array(
		'limit' 				=> 15,
		'category' 				=> '',
		'include_cat_child'		=> 'true',
		'design' 				=> 'prodesign-1',
		'image_fit' 			=> 'true',
		'image_size' 			=> 'large',
		'show_content' 			=> 'true',
		'loop' 					=> 'true',
		'dots' 					=> 'true',
		'arrows' 				=> 'true',
		'autoplay' 				=> 'true',
		'autoplay_interval'		=> 3000,
		'speed' 				=> 600,
		'fade'					=> 'false',
		'rtl'					=> '',
		'sliderheight' 			=> '',
		'show_read_more'		=> 'true',
		'read_more_text'		=> __('Read More', 'wp-slick-slider-and-image-carousel'),
		'slider_nav_column'		=> 5,
		'link_target'			=> 'self',
		'order'					=> 'DESC',
		'orderby'				=> 'date',
		'exclude_cat'			=> array(),
		'exclude_post' 			=> array(),
		'posts'					=> array(),
		'arrow_design' 			=> 'design-1',
		'dots_design' 			=> 'design-1',
		'query_offset'			=> '',
		'extra_class'			=> '',
		), $atts, 'slick-slider');

	$shortcode_designs 			= wpsisac_pro_slider_designs();
	$atts['limit'] 				= !empty( $atts['limit'] ) 					? $atts['limit'] 						: 15;
	$atts['show_read_more'] 	= ( $atts['show_read_more'] == 'true' ) 	? true 									: false;
	$atts['category'] 			= ( !empty( $atts['category'] ) ) 			? explode( ',', $atts['category'] ) 	: '';
	$atts['include_cat_child']	= ( $atts['include_cat_child'] == 'false' ) ? false 								: true;
	$atts['loop'] 				= ( $atts['loop'] == 'false' ) 				? 'false' 								: 'true';
	$atts['design'] 			= ( $atts['design'] && (array_key_exists( trim( $atts['design'] ), $shortcode_designs ) ) ) ? trim( $atts['design'] ) : 'prodesign-1';
	$atts['image_size'] 		= !empty( $atts['image_size'] ) 			? $atts['image_size'] 					: 'large';
	$atts['image_fit']			= ( $atts['image_fit'] == 'false' )			? 0 									: 1;
	$atts['show_content'] 		= ( $atts['show_content'] == 'false' ) 		? 0 									: 1;
	$atts['dots'] 				= ( $atts['dots'] == 'false' ) 				? 'false' 								: 'true';
	$atts['arrows'] 			= ( $atts['arrows'] == 'false' ) 			? 'false' 								: 'true';
	$atts['autoplay'] 			= ( $atts['autoplay'] == 'false' ) 			? 'false' 								: 'true';
	$atts['autoplay_interval'] 	= ( !empty( $atts['autoplay_interval'] ) ) 	? $atts['autoplay_interval'] 			: 3000;
	$atts['speed'] 				= ( !empty( $atts['speed'] ) ) 				? $atts['speed'] 						: 300;
	$atts['fade'] 				= ( $atts['fade'] == 'true' ) 				? 'true' 								: 'false';
	$atts['link_target'] 		= ( $atts['link_target'] == 'blank') 		? '_blank' 								: '_self';
	$atts['order']				= ( strtolower( $atts['order'] ) == 'asc' ) ? 'ASC' 								: 'DESC';
	$atts['orderby']			= !empty( $atts['orderby'] ) 				? $atts['orderby'] 						: 'date';
	$atts['exclude_cat']		= !empty( $atts['exclude_cat'] )			? explode( ',', $atts['exclude_cat'] ) 	: array();
	$atts['exclude_post']		= !empty( $atts['exclude_post'] )			? explode( ',', $atts['exclude_post'] ) : array();
	$atts['posts']				= !empty( $atts['posts'] )					? explode( ',', $atts['posts'] ) 		: array();
	$atts['read_more_text'] 	= !empty( $atts['read_more_text'] ) 		? $atts['read_more_text'] 				: __( 'Read More', 'wp-slick-slider-and-image-carousel' );
	$atts['sliderheight'] 		= ( !empty( $atts['sliderheight'] ) ) 		? $atts['sliderheight'] 				: '';
	$atts['slider_height_css'] 	= ( !empty( $atts['sliderheight'] ) )		? "style='height:{$atts['sliderheight']}px;'" : '';
	$atts['arrow_design']		= ( !empty( $atts['arrow_design'] ) )		? $atts['arrow_design'] 				: 'design-1';
	$atts['dots_design']		= ( !empty( $atts['dots_design'] ) )		? $atts['dots_design'] 					: 'design-1';
	$atts['query_offset']		= !empty( $atts['query_offset'] )			? $atts['query_offset'] 				: null;
	$atts['extra_class']		= wpsisac_sanitize_html_classes( $atts['extra_class'] );

	extract( $atts );

	// For RTL
	if( empty( $rtl ) && is_rtl() ) {
		$rtl = 'true';
	} elseif ( $rtl == 'true' ) {
		$rtl = 'true';
	} else {
		$rtl = 'false';
	}

	// Enqueus required script
	wp_enqueue_script( 'wpos-slick-jquery' );
	wp_enqueue_script( 'wpsisac-pro-public-script' );

	// Taking some global
	global $post;

	// Taking some variables
	$atts['count'] 				= 1; 
	$atts['unique']				= wpsisac_pro_get_unique();
	$atts['slider_as_nav_for'] 	= '';
	$atts['image_fit_class']	= ( $image_fit ) ? 'wpsisac-image-fit' : '';
	$slider_nav_designs			= array( 'prodesign-4', 'prodesign-5', 'prodesign-6' );

	// For Navigation design
	if( in_array( $design, $slider_nav_designs ) ) {
		$atts['slider_as_nav_for'] 	= "data-slider-nav-for='wpsisac-slider-nav-{$atts['unique']}'";
	}

	// WP Query Parameters
	$args = array (
		'posts_per_page' 		=> $limit,
		'post_type' 			=> WPSISAC_PRO_POST_TYPE,
		'post_status' 			=> array( 'publish' ),
		'orderby' 				=> $orderby,
		'order' 				=> $order,
		'post__not_in'			=> $exclude_post,
		'post__in'				=> $posts,
		'ignore_sticky_posts'	=> true,
		'offset'				=> $query_offset,
	);

	// Category Parameter
	if( $category != "" ) {

		$args['tax_query'] = array(
								array(
										'taxonomy' 			=> WPSISAC_PRO_CAT,
										'field' 			=> 'term_id',
										'terms' 			=> $category,
										'include_children'	=> $include_cat_child,
									));

	} else if( !empty($exclude_cat) ) {

		$args['tax_query'] = array(
								array(
										'taxonomy' 			=> WPSISAC_PRO_CAT,
										'field' 			=> 'term_id',
										'terms' 			=> $exclude_cat,
										'operator'			=> 'NOT IN',
										'include_children'	=> $include_cat_child,
									));
	}

	// WP Query Parameters
	$atts['query'] 	= new WP_Query($args);
	$post_count 	= $atts['query']->post_count;

	// Slider configuration and taken care of centermode
	if( in_array( $design, $slider_nav_designs ) ) {
		$slider_nav_column 	= ( !empty( $slider_nav_column ) && ( $slider_nav_column <= $post_count ) ) ? $slider_nav_column : 5;
		$nav_center_mode	= ( $slider_nav_column != $post_count ) ? 'true' : 'false';
	}

	// Slider configuration
	$atts['slider_conf'] = compact( 'dots', 'arrows', 'autoplay', 'autoplay_interval', 'speed', 'fade', 'design', 'rtl', 'loop', 'slider_nav_column', 'nav_center_mode' );

	ob_start();

	// If post is there
	if ( $atts['query']->have_posts() ) {

		wpsisac_get_template( 'slider/loop-start.php', $atts ); // loop start

		while ( $atts['query']->have_posts() ) : $atts['query']->the_post();
			
			$atts['slider_img'] 		= wpsisac_pro_get_post_featured_image( $post->ID, $image_size, true );
			$atts['read_more_url'] 		= get_post_meta( $post->ID, 'wpsisac_slide_link', true );
			$atts['slick_post_title']	= get_the_title();

			wpsisac_get_template( "slider/{$design}.php", $atts ); // design file

			$atts['count']++;
			
		endwhile;

		wpsisac_get_template( 'slider/loop-end.php', $atts ); // loop end

		// For Navigation design
		if( in_array( $design, $slider_nav_designs ) ) {
			wpsisac_get_template( "slider/nav/{$design}.php", $atts, null, null, 'slider/nav/nav-design.php' );
		}

	} // End have_posts()

	wp_reset_postdata(); // Reset WP Query

	$content .= ob_get_clean();
	return $content;
}

// 'slick-slider' shortcode
add_shortcode('slick-slider', 'wpsisac_pro_slick_slider');