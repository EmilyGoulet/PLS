<?php
/**
 * Custom widgets.
 *
 * @package Business_Point
 */

if ( ! class_exists( 'Business_Point_Latest_Product_Widget' ) ) :

	/**
	 * Latest Products widget class.
	 *
	 * @since 1.0.0
	 */
	class Business_Point_Latest_Product_Widget extends WP_Widget {

	    function __construct() {
	    	$opts = array(
				'classname'   => 'business_point_widget_latest_products',
				'description' => esc_html__( 'Latest Products Widget', 'business-point' ),
    		);

			parent::__construct( 'business-point-latest-products', esc_html__( 'BP: Latest Products', 'business-point' ), $opts );
	    }


	    function widget( $args, $instance ) {

			$title             	= apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

			$section_icon 	   	= !empty( $instance['section_icon'] ) ? $instance['section_icon'] : '';

			$sub_title 	 		= !empty( $instance['sub_title'] ) ? $instance['sub_title'] : '';

			$product_category   = ! empty( $instance['product_category'] ) ? $instance['product_category'] : 0;

			$product_number     = ! empty( $instance['product_number'] ) ? $instance['product_number'] : 6;

	        echo $args['before_widget']; ?>

	        <div class="latest-products-widget bp-latest-products">

        		<div class="section-title">

			        <?php 

			        if ( $title ) {
			        	echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
			        }

			        if ( $section_icon ) { ?>

			        	<div class="seperator">
			        	    <span><i class="fa <?php echo esc_html( $section_icon ); ?>"></i></span>
			        	</div>
			        	<?php
			        	
			        }

			        if ( $sub_title ) { ?>

			        	<p><?php echo esc_html( $sub_title ); ?></p>

			        	<?php 
			        	
			        } ?>

		        </div>

		        <?php

		        $carousel_args = array(
		        	'slidesToShow' => 4,
		        	'dots'         => false,
		        	'prevArrow'    => '<span data-role="none" class="slick-prev" tabindex="0"><i class="fa fa-angle-left" aria-hidden="true"></i></span>',
		        	'nextArrow'    => '<span data-role="none" class="slick-next" tabindex="0"><i class="fa fa-angle-right" aria-hidden="true"></i></span>',
		        	'responsive'   => array(
		        		array(
		        			'breakpoint' => 1024,
		        			'settings'   => array(
		        				'slidesToShow' => 4,
		        				),
		        			),
		        		array(
		        			'breakpoint' => 800,
		        			'settings'   => array(
		        				'slidesToShow' => 3,
		        				),
		        			),
		        		array(
		        			'breakpoint' => 659,
		        			'settings'   => array(
		        				'slidesToShow' => 2,
		        				),
		        			),
		        		array(
		        			'breakpoint' => 479,
		        			'settings'   => array(
		        				'slidesToShow' => 1,
		        				),
		        			),
		        		),
		        	);

		        $carousel_args_encoded = wp_json_encode( $carousel_args );

		        $meta_query = WC()->query->get_meta_query();

		        $tax_query  = WC()->query->get_tax_query();
		        
		        $tax_query[] = array(
		        	'taxonomy' => 'product_cat',
		        	'field'    => 'id',
		        	'terms'    => absint( $product_category ),
		        	'operator' => 'IN',
		        );

		        $query_args = array(
		        	'post_type'           => 'product',
		        	'post_status'         => 'publish',
		        	'ignore_sticky_posts' => 1,
		        	'posts_per_page'      => absint( $product_number ),
		        	'meta_query'          => $meta_query,
		        	'no_found_rows'       => true,
		        );

		        if ( absint( $product_category ) > 0 ) {

		        	$query_args['tax_query'] = $tax_query;
		        	
		        }
		        
		        global $woocommerce_loop;
		        $latest_products = new WP_Query( $query_args );

		        if ( $latest_products->have_posts() ) :?>

		        	<div class="inner-wrapper">

				        <div class="bp-products-carousel-wrap">
				        	
				        	<ul class="bp-latest-items bp-latest-products-carousel" data-slick='<?php echo $carousel_args_encoded; ?>'>

								<?php 

								while ( $latest_products->have_posts() ) :

	                                $latest_products->the_post(); 

	                            	wc_get_template_part( 'content', 'product' );

								endwhile; 

								woocommerce_reset_loop();

	                            wp_reset_postdata(); ?>

	                        </ul>

	                    </div>

	                </div>

		        <?php endif; ?>

	         </div><!-- .latest-news-widget -->

	        <?php
	        echo $args['after_widget'];

	    }

	    function update( $new_instance, $old_instance ) {
	        $instance = $old_instance;
			$instance['title']          	= sanitize_text_field( $new_instance['title'] );
			$instance['section_icon'] 		= sanitize_text_field( $new_instance['section_icon'] );
			$instance['sub_title'] 		    = sanitize_text_field( $new_instance['sub_title'] );
			$instance['product_category']  	= absint( $new_instance['product_category'] );
			$instance['product_number']  	= absint( $new_instance['product_number'] );
			
	        return $instance;
	    }

	    function form( $instance ) {

	        $instance = wp_parse_args( (array) $instance, array(
				'title'          		=> '',
				'section_icon' 			=> 'fa-folder-open-o',
				'sub_title' 			=> '',
				'product_category' 		=> '',
				'product_number' 		=> 6,

	        ) );
	        ?>
	        <p>
	          <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><strong><?php esc_html_e( 'Title:', 'business-point' ); ?></strong></label>
	          <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
	        </p>
	        <p>
	        	<label for="<?php echo esc_attr( $this->get_field_id( 'section_icon' ) ); ?>"><strong><?php esc_html_e( 'Icon:', 'business-point' ); ?></strong></label>
	        	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'section_icon' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'section_icon' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['section_icon'] ); ?>" />
	        </p>
	        <p>
	        	<label for="<?php echo esc_attr( $this->get_field_id( 'sub_title' ) ); ?>"><strong><?php esc_html_e( 'Sub Title:', 'business-point' ); ?></strong></label>
	        	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'sub_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'sub_title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['sub_title'] ); ?>" />
	        </p>
            <p>
				<label for="<?php echo  esc_attr( $this->get_field_id( 'product_category' ) ); ?>"><strong><?php esc_html_e( 'Select Category:', 'business-point' ); ?></strong></label>
				<?php
				$cat_args = array(
				    'orderby'         => 'name',
				    'hide_empty'      => 0,
				    'class' 		  => 'widefat',
				    'taxonomy'        => 'product_cat',
				    'name'            => $this->get_field_name( 'product_category' ),
				    'id'              => $this->get_field_id( 'product_category' ),
				    'selected'        => absint( $instance['product_category'] ),
				    'show_option_all' => esc_html__( 'All Categories','business-point' ),
				  );
				wp_dropdown_categories( $cat_args );
				?>
            </p>
	        <p>
	        	<label for="<?php echo esc_attr( $this->get_field_name('product_number') ); ?>">
	        		<?php esc_html_e('Number of Products:', 'business-point'); ?>
	        	</label>
	        	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('product_number') ); ?>" name="<?php echo esc_attr( $this->get_field_name('product_number') ); ?>" type="number" value="<?php echo absint( $instance['product_number'] ); ?>" />
	        </p>
	        <?php
	    }

	}

endif;