=== WP Slick Slider and Image Carousel Pro  ===
Contributors: wponlinesupport
Tags: slick, image slider, slick slider, slick image slider, slider, image slider, header image slider, responsive image slider, responsive content slider, carousel, image carousel, carousel slider, content slider, coin slider, touch slider, text slider, responsive slider, responsive slideshow, Responsive Touch Slider, wp slider, wp image slider, wp header image slider, photo slider, responsive photo slider  
Requires at least: 3.5
Tested up to: 4.9.8
Author URI: https://www.wponlinesupport.com

A quick, easy way to add and display mulipale WP Slick Slider and carousel using a shortcode.

== Description ==

Display multiple slick image slider and carousel using shortcode with category. Fully responsive, Swipe enabled, Desktop mouse dragging and  Infinite looping.
Fully accessible with arrow key navigation  Autoplay, dots, arrows etc.

It uses A custom post type and taxonomy to create a slider, with almost unlimited options and support for multiple sliders on any page.
You can also display image slider on your website header.

= You can use 3 shortcodes =

<code>[slick-slider]</code> - Slick Slider
<code>[slick-carousel-slider]</code> - Slick Carousel Slider
<code>[slick-variable-slider]</code> - Slick Variable Slider

= Here is Template code =

<code><?php echo do_shortcode('[slick-slider]'); ?></code>
<code><?php echo do_shortcode('[slick-carousel-slider]'); ?></code>
<code><?php echo do_shortcode('[slick-variable-slider]'); ?></code>

= Features include =

* Display unlimited number of slider and carousel with the help of category.
* Touch-enabled Navigation.
* Fully responsive. Scales with its container.
* Fully accessible with arrow key navigation.
* Responsive
* Given shortcode and template code.
* Use for header image slider.

== Installation ==

1. Upload the 'wp-slick-slider-and-carousel-pro' folder to the '/wp-content/plugins/' directory.
2. Activate the "wp-slick-slider-and-carousel-pro" list plugin through the 'Plugins' menu in WordPress.
3. Add this short code where you want to display slider

<code>[slick-slider] and [slick-carousel-slider]</code>

== Changelog ==

= 1.2 (22, Sep 2018) =
* [+] New - Added Templating feature. Now you can override plugin design from your current theme!!
* [+] New - Added 'query_offset' parameter for shortcodes.
* [*] Tweak - Taken better care of Post Title as image ALT tag.

= 1.1 (27, March 2018) =
* [+] Introduced 'Shortcode Generator' functionality with Preview Panel.
* [+] Added 'extra_class' shortcode parameter in plugin shortcode. Now you can add your extra class and use it for custom designing.
* [*] Used 'wp_reset_postdata' instead of 'wp_reset_query'.
* [*] Fixed some minor designing issues.

= 1.0 =
* Initial release.