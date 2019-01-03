<?php
/**
 * Template for WP Slick Slider and Image Carousel Pro -Loop Start
 *
 * This template can be overridden by copying it to yourtheme/wp-slick-slider-and-image-carousel-pro/carousel/loop-start.php
 *
 * @package WP Slick Slider and Image Carousel Pro
 * @version 1.4
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
} ?>

<div class="wpsisac-slick-carousal-wrp wpsisac-clearfix <?php echo $extra_class; ?>">
	<div id="wpsisac-pro-slick-carousal-<?php echo $unique; ?>" class="wpsisac-slick wpsisac-slick-carousal wpsisac-slick-carousal-slider <?php echo 'wpsisac-'.$design; ?> <?php echo $slider_effect_class.' '.$image_fit_class; ?> <?php echo 'wpsisac-arrow-'.$arrow_design; ?> <?php echo 'wpsisac-dots-'.$dots_design; ?>">