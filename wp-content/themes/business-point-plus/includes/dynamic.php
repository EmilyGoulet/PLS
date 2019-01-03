<?php
/**
 * Dynamic Options hook.
 *
 * This file contains option values from customizer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Business_Point
 */

if ( ! function_exists( 'business_point_dynamic_options' ) ) :

    function business_point_dynamic_options(){

        global $business_point_google_fonts;

        $body_font                  =  business_point_get_option( 'body_font' );
        $identity_font              =  business_point_get_option( 'site_identity_font' );
        $menu_font                  =  business_point_get_option( 'menu_font' );
        $heading_font               =  business_point_get_option( 'heading_font' );
        $paragraph_font             =  business_point_get_option( 'paragraph_font' );

        $primary_color              =  business_point_get_option( 'primary_color' );
        $top_header_bg              =  business_point_get_option( 'top_header_bg' );
        $top_header_color           =  business_point_get_option( 'top_header_color' );

        $site_title_color           =  business_point_get_option( 'site_title_color' );
        $site_tagline_color         =  business_point_get_option( 'site_tagline_color' );

        $breadcrumb_bg              =  business_point_get_option( 'breadcrumb_bg' );
        $breadcrumb_link            =  business_point_get_option( 'breadcrumb_link' );
        $breadcrumb_active          =  business_point_get_option( 'breadcrumb_active' );

        $top_footer_bg              =  business_point_get_option( 'top_footer_bg' );
        $top_footer_title_color     =  business_point_get_option( 'top_footer_title_color' );
        $top_footer_text_color      =  business_point_get_option( 'top_footer_text_color' );

        $bottom_footer_bg           =  business_point_get_option( 'bottom_footer_bg' );
        $bottom_footer_text_color   =  business_point_get_option( 'bottom_footer_text_color' );

        $scroll_top_bg              =  business_point_get_option( 'scroll_top_bg' );
        
        $bg_color                   = get_background_color();
    ?>               
    <style>
        body{
            font-family: '<?php echo esc_attr( $business_point_google_fonts[$body_font] ); ?>';
        }

        #masthead .site-title a{
            color: <?php echo esc_attr( $site_title_color ); ?>;
            font-family: '<?php echo esc_attr( $business_point_google_fonts[$identity_font] ); ?>';
        }

        .site-description{
            color: <?php echo esc_attr( $site_tagline_color ); ?>;
            font-family: '<?php echo esc_attr( $business_point_google_fonts[$identity_font] ); ?>';
        }

        .main-navigation ul li a{
            font-family: '<?php echo esc_attr( $business_point_google_fonts[$menu_font] ); ?>';
        }

        h1, h1 a,
        h2, h2 a,
        h3, h3 a,
        h4, h4 a,
        h5, h5 a,
        h6, h6 a,
        .entry-header h2.entry-title a{
            font-family: '<?php echo esc_attr( $business_point_google_fonts[$heading_font] ); ?>';
        }

        p, ul li, ul li a, ol li, ol li a{
            font-family: '<?php echo esc_attr( $business_point_google_fonts[$paragraph_font] ); ?>';
        }

        button,
        .comment-reply-link,
        input[type="button"],
        input[type="reset"],
        input[type="submit"],
        #infinite-handle span,
        #infinite-handle span:hover,
        .search-box > a,
        .widget_calendar caption,
        .business_point_widget_services .services-item:hover .service-icon,
        .business_point_widget_call_to_action .call-to-action-buttons .cta-button-secondary.button:hover,
        .bg_enabled.business_point_widget_facts,
        .slick-dots li button,
        .business_point_widget_features,
        a.read-more,
        .business_point_widget_contact,
        .business_point_widget_teams .our-team-text-wrap,
        .woocommerce nav.woocommerce-pagination ul li .page-numbers,
        .mean-container a.meanmenu-reveal span,
        .mean-container .mean-nav ul li a,
        .mean-container .mean-nav ul li a:hover {
            background: <?php echo esc_attr( $primary_color ); ?>;
        }

        button:hover,
        .comment-reply-link,
        input[type="button"]:hover,
        input[type="reset"]:hover,
        input[type="submit"]:hover,
        #home-page-widget-area .bg_enabled .widget-title span::before,
        #home-page-widget-area .bg_enabled .widget-title span::after,
        #home-page-widget-area .business_point_widget_services .widget-title span::before,
        #home-page-widget-area .business_point_widget_services .widget-title span::after,
        #home-page-widget-area .business_point_widget_latest_news .widget-title span::before,
        #home-page-widget-area .business_point_widget_latest_news .widget-title span::after,
        .search-box > a:hover,
        .business_point_widget_social ul li a:hover,
        #main-slider .pager-box,
        #footer-widgets h3.widget-title::after,
        .product .onsale,
        .slick-prev,
        .slick-next,
        #home-page-widget-area .bg_enabled.business_point_widget_contact .widget-title span::before,
        #home-page-widget-area .bg_enabled.business_point_widget_contact .widget-title span::after,
        .woocommerce span.onsale,
        #add_payment_method .wc-proceed-to-checkout a.checkout-button, 
        .woocommerce-cart .wc-proceed-to-checkout a.checkout-button, 
        .woocommerce-checkout .wc-proceed-to-checkout a.checkout-button,
        .woocommerce .cart .button, 
        .woocommerce .cart input.button,
        .woocommerce a.button,
        .woocommerce #payment #place_order, 
        .woocommerce-page #payment #place_order,
        .woocommerce #respond input#submit.alt, 
        .woocommerce a.button.alt, 
        .woocommerce button.button.alt, 
        .woocommerce input.button.alt,
        .woocommerce #review_form #respond .form-submit input,
        .woocommerce div.product .woocommerce-tabs ul.tabs li,
        .error-404.not-found  form.search-form input[type="submit"],
        .search-no-results  form.search-form input[type="submit"],
        .error-404.not-found  form.search-form input[type="submit"]:hover,
        #mobile-trigger i,
        .woocommerce #respond input#submit.alt.disabled, 
        .woocommerce #respond input#submit.alt.disabled:hover, 
        .woocommerce #respond input#submit.alt:disabled, 
        .woocommerce #respond input#submit.alt:disabled:hover, 
        .woocommerce #respond input#submit.alt:disabled[disabled], 
        .woocommerce #respond input#submit.alt:disabled[disabled]:hover, 
        .woocommerce a.button.alt.disabled, 
        .woocommerce a.button.alt.disabled:hover, 
        .woocommerce a.button.alt:disabled, 
        .woocommerce a.button.alt:disabled:hover, 
        .woocommerce a.button.alt:disabled[disabled], 
        .woocommerce a.button.alt:disabled[disabled]:hover, 
        .woocommerce button.button.alt.disabled, 
        .woocommerce button.button.alt.disabled:hover, 
        .woocommerce button.button.alt:disabled, 
        .woocommerce button.button.alt:disabled:hover, 
        .woocommerce button.button.alt:disabled[disabled], 
        .woocommerce button.button.alt:disabled[disabled]:hover, 
        .woocommerce input.button.alt.disabled, 
        .woocommerce input.button.alt.disabled:hover, 
        .woocommerce input.button.alt:disabled, 
        .woocommerce input.button.alt:disabled:hover, 
        .woocommerce input.button.alt:disabled[disabled], 
        .woocommerce input.button.alt:disabled[disabled]:hover {
            background-color: <?php echo esc_attr( $primary_color ); ?>;
        }

        a,
        a:visited,
        a:hover,
        a:focus,
        a:active,
        .main-navigation ul li.current-menu-item a,
        .main-navigation ul li a:hover,
        .home.page .slider-enabled.header-collapse ul li a:hover,
        .nav-links .nav-previous a:hover,
        .nav-links .nav-next a:hover,
        .comment-navigation .nav-next a:hover:after,
        .comment-navigation .nav-previous a:hover:before,
        .nav-links .nav-previous a:hover:before,
        .nav-links .nav-next a:hover:after,
        .section-title .seperator i,
        .entry-meta > span::before,
        .entry-footer > span::before,
        .single-post-meta > span::before,
        #commentform  input[type="submit"]:hover,
        #home-page-widget-area .business_point_widget_social ul li a::before,
        #main-slider .cycle-prev:hover i,
        #main-slider .cycle-next:hover i,
        .business_point_widget_services .services-item i,
        .services-item a,
        .services-item a:after,
        .product .woocommerce-loop-product__title,
        .product .button:hover,
        .product .button:hover:before,
        .counter-item .count-text,
        .business_point_widget_facts .counter-item span.count-text,
        .pt-team-item .pt-team-title,
        .pt-team-social li a::before,
        .pt-portfolio-item .pt-portfolio-text-wrap .pt-portfolio-title,
        .pt-testimonial-item .pt-testimonial-title,
        .business_point_widget_contact .contact-wrapper form input[type="submit"]:hover,
        #primary .post  .entry-title:hover a,
        #primary .page .entry-title:hover a,
        .woocommerce-message::before,
        .woocommerce-info::before,
        #add_payment_method #payment ul.payment_methods li, 
        .woocommerce-cart #payment ul.payment_methods li, 
        .woocommerce-checkout #payment ul.payment_methods li,
        .woocommerce nav.woocommerce-pagination ul li a:focus, 
        .woocommerce nav.woocommerce-pagination ul li a:hover, 
        .woocommerce nav.woocommerce-pagination ul li span.current,
        .post-navigation  .nav-previous:hover a,
        .post-navigation  .nav-next:hover a,
        .post-navigation  .nav-previous:hover:before,
        .post-navigation  .nav-next:hover:after,
        .post-navigation  .nav-previous:before,
        .post-navigation  .nav-next:after,
        .mean-container a.meanmenu-reveal {
            color: <?php echo esc_attr( $primary_color ); ?>;
        }

        #add_payment_method .wc-proceed-to-checkout a.checkout-button:hover, 
        .woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover, 
        .woocommerce-checkout .wc-proceed-to-checkout a.checkout-button:hover,
        .woocommerce .cart .button:hover, 
        .woocommerce .cart input.button:hover,
        .woocommerce a.button:hover,
        .woocommerce #payment #place_order:hover, 
        .woocommerce-page #payment #place_order:hover,
        .woocommerce #review_form #respond .form-submit input:hover{
            color: <?php echo esc_attr( $primary_color ); ?> !important;
        }

        .woocommerce-message,
        .woocommerce-info {
            border-top-color: <?php echo esc_attr( $primary_color ); ?>;
        }

        .nav-links .page-numbers.current,.nav-links a.page-numbers:hover {
            background: <?php echo esc_attr( $primary_color ); ?>;
            border-color: <?php echo esc_attr( $primary_color ); ?>;
        }

        #commentform  input[type="submit"],
        .business_point_widget_services .services-item .service-icon,
        #add_payment_method .wc-proceed-to-checkout a.checkout-button, 
        .woocommerce-cart .wc-proceed-to-checkout a.checkout-button, 
        .woocommerce-checkout .wc-proceed-to-checkout a.checkout-button,
        .woocommerce .cart .button, 
        .woocommerce .cart input.button,
        .woocommerce a.button,
        .woocommerce #payment #place_order, 
        .woocommerce-page #payment #place_order,
        .woocommerce #respond input#submit.alt, 
        .woocommerce a.button.alt, 
        .woocommerce button.button.alt, 
        .woocommerce input.button.alt,
        .woocommerce #review_form #respond .form-submit input {
            border:1px solid <?php echo esc_attr( $primary_color ); ?>;
        }

        .button {
            background: <?php echo esc_attr( $primary_color ); ?>;
            border:1px solid <?php echo esc_attr( $primary_color ); ?>; 
        }

        #home-page-widget-area .business_point_widget_social li a,
        .woocommerce div.product .woocommerce-tabs ul.tabs li,
        .woocommerce nav.woocommerce-pagination ul li .page-numbers {
            border: 1px solid <?php echo esc_attr( $primary_color ); ?>;
        }

        #main-slider .pager-box.cycle-pager-active,
        .slick-dots li.slick-active button {
            border: 5px solid <?php echo esc_attr( $primary_color ); ?>;
        }

        .bg_enabled.business_point_widget_contact .contact-wrapper form input[type="submit"]:hover,
        .woocommerce form .form-row.woocommerce-validated .select2-container, 
        .woocommerce form .form-row.woocommerce-validated input.input-text, 
        .woocommerce form .form-row.woocommerce-validated select {
            border-color: <?php echo esc_attr( $primary_color ); ?>;
        }

        #sidebar-primary .widget .widget-title,
        #primary .page-header .page-title{
            border-bottom: 2px solid <?php echo esc_attr( $primary_color ); ?>;
        }

        .woocommerce div.product .woocommerce-tabs ul.tabs::before {
            border-bottom: 1px solid <?php echo esc_attr( $primary_color ); ?>;
        }

        blockquote{
            border-left: 5px solid <?php echo esc_attr( $primary_color ); ?>;
        }

        .business_point_widget_call_to_action .call-to-action-buttons .cta-button-secondary.button,
        a.button{
            color: #fff;
        }

        /*--------------------------------------------------------------
        ## Top header Style
        --------------------------------------------------------------*/
        .top-header {
            background: <?php echo esc_attr( $top_header_bg ); ?>; 
        }

        .top-left span,
        .top-left span i,
        .top-menu-content .menu li a,
        .top-header .business_point_widget_social ul li a::before{
            color: <?php echo esc_attr( $top_header_color ); ?>; 
        }

        .top-menu-content .menu li a:after, 
        .top-header .business_point_widget_social li a:after{
            background: <?php echo esc_attr( $top_header_color ); ?>; 
        }

        /*--------------------------------------------------------------
        ## Breadcrumb Style
        --------------------------------------------------------------*/
        #breadcrumb {
            background: <?php echo esc_attr( $breadcrumb_bg ); ?>; 
            color: <?php echo esc_attr( $breadcrumb_active ); ?>; 
        }

        #breadcrumb a{
            color: <?php echo esc_attr( $breadcrumb_link ); ?>;
        }

        /*--------------------------------------------------------------
        ## Top footer Style
        --------------------------------------------------------------*/
        #footer-widgets {
            background-color: <?php echo esc_attr( $top_footer_bg ); ?>;
           
        }

        #footer-widgets .widget-title{
            color: <?php echo esc_attr( $top_footer_title_color ); ?>;
        }

        #footer-widgets a, 
        #footer-widgets .textwidget p {
            color: <?php echo esc_attr( $top_footer_text_color ); ?>;
        }

        /*--------------------------------------------------------------
        ## Bottom footer Style
        --------------------------------------------------------------*/
        footer#colophon {
            background-color: <?php echo esc_attr( $bottom_footer_bg ); ?>;
           
        }

        #colophon .copyright, 
        #colophon .copyright span, 
        #colophon .copyright a, 
        #colophon .site-info, 
        #colophon .site-info a {
            color: <?php echo esc_attr( $bottom_footer_text_color ); ?>;
        }

        /*--------------------------------------------------------------
        ## Scroll to top Style
        --------------------------------------------------------------*/
        .scrollup,
        .scrollup:hover{
            background-color: <?php echo esc_attr( $scroll_top_bg ); ?>;
        }

        .sidebar a {
            color: #121212;
        }

    </style>

<?php }

endif;

add_action( 'wp_head', 'business_point_dynamic_options' );