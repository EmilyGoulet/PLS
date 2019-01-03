<?php/** * 'slick-variable-slider' Shortcode *  * @package WP Responsive Recent Post Slider Pro * @since 1.0.0 */if ( ! defined( 'ABSPATH' ) ) {    exit; // Exit if accessed directly}function wpsisac_pro_variable_slider( $atts, $content = null ) {	// Shortcode Parameter	$atts = shortcode_atts(array(		'limit'					=> 15,		'category' 				=> '',		'include_cat_child'		=> 'true',		'design' 				=> 'prodesign-1',		'image_fit' 			=> 'true',		'image_size' 			=> 'full',		'show_content' 			=> 'true',		'loop' 					=> 'true',		'dots' 					=> 'true',		'arrows' 				=> 'true',		'autoplay' 				=> 'true',		'autoplay_interval' 	=> 3000,		'speed'					=> 600,		'show_read_more'		=> 'true',		'read_more_text'		=> __('Read More', 'wp-slick-slider-and-image-carousel'),		'sliderheight' 			=> '',		'var_width'				=> 'false',			'rtl'					=> '',		'link_target'			=> '',		'order'					=> 'DESC',		'orderby'				=> 'date',		'exclude_cat'			=> array(),		'exclude_post'			=> array(),		'posts'					=> array(),		'center_width' 			=> '70%',		'arrow_design' 			=> 'design-1', /* Design 1 to 8 */		'dots_design' 			=> 'design-1', /* Design 1 to 12 */		'query_offset'			=> '',		'extra_class'			=> '',	), $atts, 'slick-variable-slider');	$shortcode_designs 			= wpsisac_pro_variable_designs();	$atts['limit'] 				= !empty( $atts['limit'] ) 					? $atts['limit'] 								: 15;	$atts['category'] 			= ( !empty( $atts['category'] ) ) 			? explode( ',', $atts['category'] ) 			: '';	$atts['include_cat_child']	= ( $atts['include_cat_child'] == 'false' )  ? false 										: true;	$atts['design'] 			= ( $atts['design'] && ( array_key_exists( trim( $atts['design'] ), $shortcode_designs ) ) ) ? trim( $atts['design'] ) : 'prodesign-1';	$atts['image_size'] 		= !empty( $atts['image_size'] ) 			? $atts['image_size'] 							: 'full';	$atts['loop'] 				= ( $atts['loop'] == 'false' ) 				? 'false' 										: 'true';	$atts['dots'] 				= ( $atts['dots'] == 'false' ) 				? 'false' 										: 'true';	$atts['arrows'] 			= ( $atts['arrows'] == 'false' ) 			? 'false' 										: 'true';	$atts['autoplay'] 			= ( $atts['autoplay'] == 'false' ) 			? 'false' 										: 'true';	$atts['var_width'] 			= ( $atts['var_width'] == 'false' ) 		? 'false' 										: 'true';	$atts['image_fit']			= ( $atts['image_fit'] == 'false' )			? 0 											: 1;	$atts['autoplay_interval'] 	= ( !empty( $atts['autoplay_interval'] ) ) 	? $atts['autoplay_interval'] 					: 3000;	$atts['speed'] 				= ( !empty( $atts['speed'] ) ) 				? $atts['speed'] 								: 300;	$atts['show_content'] 		= ( $atts['show_content'] == 'false' ) 		? 0 											: 1;	$atts['show_read_more'] 	= ( $atts['show_read_more'] == 'true' ) 	? true 											: false;	$atts['read_more_text'] 	= !empty( $atts['read_more_text'] ) 		? $atts['read_more_text'] 						: __('Read More', 'wp-slick-slider-and-image-carousel');	$atts['link_target'] 		= ( $atts['link_target'] == 'blank' ) 		? '_blank' 										: '_self';	$atts['order']				= ( strtolower( $atts['order'] ) == 'asc' ) ? 'ASC' 										: 'DESC';	$atts['orderby']			= !empty( $atts['orderby'] ) 				? $atts['orderby'] 								: 'date';	$atts['exclude_cat']		= !empty( $atts['exclude_cat'] )			? explode( ',', $atts['exclude_cat'] ) 			: array();	$atts['exclude_post']		= !empty( $atts['exclude_post'] )			? explode( ',', $atts['exclude_post'] ) 		: array();	$atts['posts']				= !empty( $atts['posts'] )					? explode( ',', $atts['posts'] ) 				: array();	$atts['sliderheight'] 		= ( !empty( $atts['sliderheight'] ) ) 		? $atts['sliderheight'] 						: '';	$atts['slider_height_css'] 	= ( !empty($atts['sliderheight'] ) )		? "style='height:{$atts['sliderheight']}px;'" 	: '';	$atts['center_width'] 		= !empty( $atts['center_width'] ) 			? $atts['center_width'] 						: '70%';	$atts['arrow_design']		= ( $atts['arrow_design'] )					? $atts['arrow_design'] 						: 'design-1';	$atts['dots_design']		= ( !empty($atts['dots_design'] ) )			? $atts['dots_design'] 							: 'design-1';	$atts['query_offset']		= !empty( $atts['query_offset'] )			? $atts['query_offset'] 						: null;	$atts['extra_class']		= wpsisac_sanitize_html_classes( $atts['extra_class'] );	extract( $atts );	// For RTL	if( empty( $rtl ) && is_rtl() ) {		$rtl = 'true';	} elseif ( $rtl == 'true' ) {		$rtl = 'true';	} else {		$rtl = 'false';	}	// Enqueus required script	wp_enqueue_script( 'wpos-slick-jquery' );	wp_enqueue_script( 'wpsisac-pro-public-script' );	// Taking some global	global $post;	// Taking some variables	$atts['unique']				= wpsisac_pro_get_unique();	$atts['image_fit_class'] 	= ( $image_fit ) ? 'wpsisac-image-fit' : '';	$atts['count'] 				= 1;	// Slider configuration	$atts['slider_conf'] = compact( 'dots', 'arrows', 'autoplay', 'autoplay_interval','var_width', 'speed', 'design', 'rtl', 'loop' );	// WP Query Parameters	$args = array ( 			'post_type' 			=> WPSISAC_PRO_POST_TYPE,			'post_status' 			=> array( 'publish' ),			'orderby' 				=> $orderby, 			'order'					=> $order,			'posts_per_page' 		=> $limit,			'post__not_in'	 		=> $exclude_post,			'post__in'		 		=> $posts,			'ignore_sticky_posts'	=> true,			'offset'				=> $query_offset,		);	// Category Parameter	if( $category != "" ) {		$args['tax_query'] = array(								array(									'taxonomy' 			=> WPSISAC_PRO_CAT,									'field' 			=> 'term_id',									'terms' 			=> $category,									'include_children'	=> $include_cat_child,								));	} else if( !empty($exclude_cat) ) {		$args['tax_query'] = array(								array(									'taxonomy' 			=> WPSISAC_PRO_CAT,									'field' 			=> 'term_id',									'terms' 			=> $exclude_cat,									'operator'			=> 'NOT IN',									'include_children'	=> $include_cat_child,								));	}	// WP Query Parameters	$query = new WP_Query( $args );	ob_start();	// If post is there	if ( $query->have_posts() ) :		wpsisac_get_template( 'variable-width/loop-start.php', $atts ); // loop start		while ( $query->have_posts() ) : $query->the_post();			$atts['slider_img'] 		= wpsisac_pro_get_post_featured_image( $post->ID, $image_size, true );			$atts['read_more_url'] 		= get_post_meta( $post->ID, 'wpsisac_slide_link', true );			$atts['slick_post_title']	= get_the_title();			wpsisac_get_template( "variable-width/{$design}.php", $atts ); // design file			$atts['count']++;		endwhile;		wpsisac_get_template( 'variable-width/loop-end.php', $atts ); // loop end	endif; // end have_post()	wp_reset_postdata(); // Reset WP Query	$content .= ob_get_clean();	return $content;}// 'slick-variable-slider' shortcodeadd_shortcode('slick-variable-slider', 'wpsisac_pro_variable_slider');