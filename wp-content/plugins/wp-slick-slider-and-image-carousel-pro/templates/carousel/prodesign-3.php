<?php/** * Template for WP Slick Slider and Image Carousel Pro - prodesign-3 * * This template can be overridden by copying it to yourtheme/wp-slick-slider-and-image-carousel-pro/carousel/prodesign-3.php * * @package WP Slick Slider and Image Carousel Pro * @version 1.4 */if ( !defined( 'ABSPATH' ) ) {	exit; // Exit if accessed directly}$grid_count = ( $count % 5 );$grid_count = !empty( $grid_count ) ? $grid_count : 5; ?><div class="wpsisac-slick-image-slide wpsisac-clr-<?php echo $grid_count; ?>">	<div class="wpsisac-slide-wrap">		<?php if( $slider_img ) { ?>			<div class="wpsisac-img-wrap" <?php echo $slider_height_css; ?>>					<img class="wpsisac-slider-img" src="<?php echo esc_url($slider_img); ?>" alt="<?php the_title_attribute(); ?>" />				<?php if( !empty($read_more_url) ) { ?>					<a class="wpsisac-slick-slider-link" href="<?php echo esc_url($read_more_url); ?>" target="<?php echo $link_target; ?>"></a><?php				} ?>			</div>		<?php } ?>		<div class="wpsisac-slideline">			<hr>		</div>		<div class="wpsisac-slider-content">			<?php if($slick_post_title) { ?>				<h2 class="wpsisac-slide-title"><?php					if($read_more_url != '') { ?>						<a href="<?php echo esc_url($read_more_url); ?>" target="<?php echo $link_target; ?>"><?php echo $slick_post_title; ?></a><?php					} else { echo $slick_post_title; } ?>				</h2>			<?php } ?>			<?php if($show_content) { ?>				<div class="wpsisac-slider-short-content">				<?php the_content(); ?>				</div>				<?php }			if( !empty($read_more_url) && $show_read_more) { ?>				<div class="wpsisac-readmore"><a href="<?php echo esc_url($read_more_url); ?>" class="wpsisac-slider-readmore" target="<?php echo $link_target; ?>"><?php esc_html_e( $read_more_text ); ?></a></div><?php			} ?>		</div>	</div></div>