<?php
/**
 * Custom widgets.
 *
 * @package Business_Point
 */

if ( ! class_exists( 'Business_Point_Fun_Facts_Widget' ) ) :

	/**
	 * Facts widget class.
	 *
	 * @since 1.0.0
	 */
	class Business_Point_Fun_Facts_Widget extends WP_Widget {

		protected static $fun_script = false;

	    function __construct() {
	    	$opts = array(
				'classname'   => 'business_point_widget_fun_facts',
				'description' => esc_html__( 'Fun Fact Widget', 'business-point' ),
    		);

			parent::__construct( 'business-point-fun-facts', esc_html__( 'BP: Fun Facts', 'business-point' ), $opts );

			add_action('wp_enqueue_scripts',array($this,'business_point_fact_scripts'));


	    }


		function widget( $args, $instance ) {

			$title 			= apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

			$section_icon 	= !empty( $instance['section_icon'] ) ? $instance['section_icon'] : '';

			$sub_title 		= !empty( $instance['sub_title'] ) ? $instance['sub_title'] : '';

			$count_one		= !empty( $instance['count_one'] ) ? $instance['count_one'] : '';

			$count_two		= !empty( $instance['count_two'] ) ? $instance['count_two'] : '';

			$count_three	= !empty( $instance['count_three'] ) ? $instance['count_three'] : '';

			$count_four		= !empty( $instance['count_four'] ) ? $instance['count_four'] : '';

			$bg_pic  	 	= ! empty( $instance['bg_pic'] ) ? esc_url( $instance['bg_pic'] ) : '';

			$overlay_type 	= !empty( $instance['overlay_type'] ) ? $instance['overlay_type'] : '';

			// Add background image.
			if ( ! empty( $bg_pic ) ) {
				
				$background_style = '';
				
				$background_style .= ' style="background-image:url(' . esc_url( $bg_pic ) . ');" ';

				$args['before_widget'] = implode( $background_style . ' ' . 'class="overlay-'.esc_html( $overlay_type ).' bg_enabled ', explode( 'class="', $args['before_widget'], 2 ) );
			}
		
			echo $args['before_widget']; ?>

			<div class="fact-widget bp-fun-facts">

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
				$fact_count = business_point_is_count_active( $count_one, $count_two, $count_three, $count_four );

				$fact_class = '';

				if( 2 == $fact_count ){

					$fact_class = 'fact-half';

				} elseif( 3 == $fact_count ){

					$fact_class = 'fact-third';

				} elseif( 4 == $fact_count ){

					$fact_class = 'fact-fourth';

				}else{

					$fact_class = 'fact-full';

				} ?>


				<div class="counter-wrapper <?php echo esc_attr( $fact_class ); ?>">
					<?php 

					$facts = array( 'one', 'two', 'three', 'four'); 

					foreach ($facts as $fact) {

						$counter_item 	= 'counter-'.$fact;
						
						$fact_item 		= !empty( $instance['count_'.$fact] ) ? $instance['count_'.$fact] : '';

						$fact_icon 		= !empty( $instance['icon_'.$fact] ) ? $instance['icon_'.$fact] : '';

						$fact_text 		= !empty( $instance['text_'.$fact] ) ? $instance['text_'.$fact] : '';  

						if( !empty( $fact_item ) ){ ?>

							<div class="counter-item <?php echo esc_attr( $counter_item ); ?>">
								<?php 
								if( !empty( $fact_icon ) ){ ?>
									<span class="count-icon">
										<i class="fa <?php echo esc_html( $fact_icon ); ?>"></i>
									</span>
									<?php 
								} ?>

								<?php 
								if( !empty( $fact_item ) ){ ?>
									<span class="count"><?php echo absint( $fact_item ); ?></span>
									<?php 
								} ?>

								<?php 
								if( !empty( $fact_text ) ){ ?>
									<span class="count-text"><?php echo esc_html( $fact_text ); ?></span>
									<?php 
								} ?>
							</div><!-- .counter-item -->

							<?php 

						}
					} ?>
				</div><!-- .counter-wrapper -->

			</div><!-- .some-facts -->

			<?php 

			echo $args['after_widget'];

		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			$instance['title'] 				= sanitize_text_field( $new_instance['title'] );

			$instance['section_icon'] 		= sanitize_text_field( $new_instance['section_icon'] );
			$instance['sub_title'] 		    = sanitize_text_field( $new_instance['sub_title'] );

			$instance['icon_one'] 			= sanitize_text_field( $new_instance['icon_one'] );
			$instance['count_one'] 			= absint( $new_instance['count_one'] );
			$instance['text_one'] 			= sanitize_text_field( $new_instance['text_one'] );

			$instance['icon_two'] 			= sanitize_text_field( $new_instance['icon_two'] );
			$instance['count_two'] 			= absint( $new_instance['count_two'] );
			$instance['text_two'] 			= sanitize_text_field( $new_instance['text_two'] );

			$instance['icon_three'] 		= sanitize_text_field( $new_instance['icon_three'] );
			$instance['count_three'] 		= absint( $new_instance['count_three'] );
			$instance['text_three'] 		= sanitize_text_field( $new_instance['text_three'] );
			
			$instance['icon_four'] 			= sanitize_text_field( $new_instance['icon_four'] );
			$instance['count_four'] 		= absint( $new_instance['count_four'] );
			$instance['text_four'] 			= sanitize_text_field( $new_instance['text_four'] );

			$instance['overlay_type'] 		= sanitize_text_field( $new_instance['overlay_type'] );

			$instance['bg_pic']  	 		= esc_url_raw( $new_instance['bg_pic'] );


			return $instance;
		}

		function form( $instance ) {

			// Defaults.
			$defaults = array(
				'title' 			=> '',
				'section_icon' 		=> 'fa-folder-open-o',
				'sub_title' 		=> '',
				'icon_one'      	=> 'fa-folder-open-o',
				'count_one'			=> '',
				'text_one' 			=> '',
				'icon_two'      	=> 'fa-clock-o',
				'count_two'			=> '',
				'text_two' 			=> '',
				'icon_three'    	=> 'fa-users',
				'count_three'		=> '',
				'text_three' 		=> '',
				'icon_four'     	=> 'fa-trophy',
				'count_four'		=> '',
				'text_four' 		=> '',
				'overlay_type'   	=> 'light',
				'bg_pic'      		=> '',
			);

			$instance = wp_parse_args( (array) $instance, $defaults );


			$icon_one			= !empty( $instance['icon_one'] ) ? $instance['icon_one'] : '';
			$count_one			= !empty( $instance['count_one'] ) ? $instance['count_one'] : '';
			$text_one			= !empty( $instance['text_one'] ) ? $instance['text_one'] : '';

			$icon_two			= !empty( $instance['icon_two'] ) ? $instance['icon_two'] : '';
			$count_two			= !empty( $instance['count_two'] ) ? $instance['count_two'] : '';
			$text_two			= !empty( $instance['text_two'] ) ? $instance['text_two'] : ''; 

			$icon_three 		= !empty( $instance['icon_three'] ) ? $instance['icon_three'] : '';
			$count_three 		= !empty( $instance['count_three'] ) ? $instance['count_three'] : '';
			$text_three 		= !empty( $instance['text_three'] ) ? $instance['text_three'] : ''; 

			$icon_four			= !empty( $instance['icon_four'] ) ? $instance['icon_four'] : '';
			$count_four			= !empty( $instance['count_four'] ) ? $instance['count_four'] : '';
			$text_four			= !empty( $instance['text_four'] ) ? $instance['text_four'] : '';

			$bg_pic = '';

            if ( ! empty( $instance['bg_pic'] ) ) {

                $bg_pic = $instance['bg_pic'];

            }

            $wrap_style = '';

            if ( empty( $bg_pic ) ) {

                $wrap_style = ' style="display:none;" ';
            }

            $image_status = false;

            if ( ! empty( $bg_pic ) ) {
                $image_status = true;
            }

            $delete_button = 'display:none;';

            if ( true === $image_status ) {
                $delete_button = 'display:inline-block;';
            }
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

			<hr>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( "icon_one" ) ); ?>"><strong><?php esc_html_e( 'Icon One:', 'business-point' ); ?></strong></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( "icon_one" ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( "icon_one" ) ); ?>" type="text" value="<?php echo esc_attr( $icon_one ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_name('count_one') ); ?>">
					<?php esc_html_e('Count One:', 'business-point'); ?>
				</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('count_one') ); ?>" name="<?php echo esc_attr( $this->get_field_name('count_one') ); ?>" type="number" value="<?php echo absint( $count_one ); ?>" />
			</p>
			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_name('text_one') ); ?>">
					<?php esc_html_e('Text One:', 'business-point'); ?>
				</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('text_one') ); ?>" name="<?php echo esc_attr( $this->get_field_name('text_one') ); ?>" type="text" value="<?php echo esc_attr( $text_one ); ?>" />		
			</p>

			<hr>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( "icon_two" ) ); ?>"><strong><?php esc_html_e( 'Icon Two:', 'business-point' ); ?></strong></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( "icon_two" ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( "icon_two" ) ); ?>" type="text" value="<?php echo esc_attr( $icon_two ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_name('count_two') ); ?>">
					<?php esc_html_e('Count Two:', 'business-point'); ?>
				</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('count_two') ); ?>" name="<?php echo esc_attr( $this->get_field_name('count_two') ); ?>" type="number" value="<?php echo absint( $count_two ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_name('text_two') ); ?>">
					<?php esc_html_e('Text Two:', 'business-point'); ?>
				</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('text_two') ); ?>" name="<?php echo esc_attr( $this->get_field_name('text_two') ); ?>" type="text" value="<?php echo esc_attr( $text_two ); ?>" />		
			</p>

			<hr>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( "icon_three" ) ); ?>"><strong><?php esc_html_e( 'Icon Three:', 'business-point' ); ?></strong></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( "icon_three" ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( "icon_three" ) ); ?>" type="text" value="<?php echo esc_attr( $icon_three ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_name('count_three') ); ?>">
					<?php esc_html_e('Count Three:', 'business-point'); ?>
				</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('count_three') ); ?>" name="<?php echo esc_attr( $this->get_field_name('count_three') ); ?>" type="number" value="<?php echo absint( $count_three ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_name('text_three') ); ?>">
					<?php esc_html_e('Text Three:', 'business-point'); ?>
				</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('text_three') ); ?>" name="<?php echo esc_attr( $this->get_field_name('text_three') ); ?>" type="text" value="<?php echo esc_attr( $text_three ); ?>" />		
			</p>

			<hr>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( "icon_four" ) ); ?>"><strong><?php esc_html_e( 'Icon Four:', 'business-point' ); ?></strong></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( "icon_four" ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( "icon_four" ) ); ?>" type="text" value="<?php echo esc_attr( $icon_four ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_name('count_four') ); ?>">
					<?php esc_html_e('Count Four:', 'business-point'); ?>
				</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('count_four') ); ?>" name="<?php echo esc_attr( $this->get_field_name('count_four') ); ?>" type="number" value="<?php echo absint( $count_four ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_name('text_four') ); ?>">
					<?php esc_html_e('Text Four:', 'business-point'); ?>
				</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('text_four') ); ?>" name="<?php echo esc_attr( $this->get_field_name('text_four') ); ?>" type="text" value="<?php echo esc_attr( $text_four ); ?>" />		
			</p>

	        <p>
	          <label for="<?php echo esc_attr( $this->get_field_id( 'overlay_type' ) ); ?>"><strong><?php _e( 'Overlay Type:', 'business-point' ); ?></strong></label>
				<?php
	            $this->dropdown_overlay_type( array(
					'id'       => $this->get_field_id( 'overlay_type' ),
					'name'     => $this->get_field_name( 'overlay_type' ),
					'selected' => esc_attr( $instance['overlay_type'] ),
					)
	            );
				?>
	        </p>

			<div class="cover-image">
                <label for="<?php echo esc_attr( $this->get_field_id( 'bg_pic' ) ); ?>">
                    <strong><?php esc_html_e( 'Background Image:', 'business-point' ); ?></strong>
                </label>
                <input type="text" class="img widefat" name="<?php echo esc_attr( $this->get_field_name( 'bg_pic' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'bg_pic' ) ); ?>" value="<?php echo esc_url( $instance['bg_pic'] ); ?>" />
                <div class="rtam-preview-wrap" <?php echo $wrap_style; ?>>
                    <img src="<?php echo esc_url( $bg_pic ); ?>" alt="<?php esc_attr_e( 'Preview', 'business-point' ); ?>" />
                </div><!-- .rtam-preview-wrap -->
                <input type="button" class="select-img button button-primary" value="<?php esc_html_e( 'Upload', 'business-point' ); ?>" data-uploader_title="<?php esc_html_e( 'Select Background Image', 'business-point' ); ?>" data-uploader_button_text="<?php esc_html_e( 'Choose Image', 'business-point' ); ?>" />
                <input type="button" value="<?php echo esc_attr_x( 'X', 'Remove Button', 'business-point' ); ?>" class="button button-secondary btn-image-remove" style="<?php echo esc_attr( $delete_button ); ?>" />
            </div>
					
		<?php
				
		}

	    function dropdown_overlay_type( $args ) {
			$defaults = array(
		        'id'       => '',
		        'class'    => 'widefat',
		        'name'     => '',
		        'selected' => 'light',
			);

			$r = wp_parse_args( $args, $defaults );
			$output = '';

			$choices = array(
				'light' 		=> esc_html__( 'Light', 'business-point' ),
				'dark' 			=> esc_html__( 'Dark', 'business-point' ),
				'none' 			=> esc_html__( 'None', 'business-point' ),
			);

			if ( ! empty( $choices ) ) {

				$output = "<select name='" . esc_attr( $r['name'] ) . "' id='" . esc_attr( $r['id'] ) . "' class='" . esc_attr( $r['class'] ) . "'>\n";
				foreach ( $choices as $key => $choice ) {
					$output .= '<option value="' . esc_attr( $key ) . '" ';
					$output .= selected( $r['selected'], $key, false );
					$output .= '>' . esc_html( $choice ) . '</option>\n';
				}
				$output .= "</select>\n";
			}

			echo $output;
	    }
		
		function business_point_fact_scripts() {

			if(!self::$fun_script && is_active_widget(false, false, $this->id_base, true)){

			wp_enqueue_script( 'jquery-waypoints', get_template_directory_uri() . '/includes/widgets/counter-up/jquery.waypoints.min.js', array('jquery'), '4.0.1', true );

			wp_enqueue_script( 'jquery-counterup', get_template_directory_uri() . '/includes/widgets/counter-up/jquery.counterup.min.js', array('jquery-waypoints'), '2.0.5', true );

			wp_enqueue_script( 'business-point-facts', get_template_directory_uri() . '/includes/widgets/js/fun-facts.js', '', '2.0.1', true );

			self::$fun_script = true;
		    }   

		}

	}

endif;

if ( ! function_exists( 'business_point_is_count_active' ) ) :

	/**
	 * Check if fact counter count is active.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function business_point_is_count_active( $count_one, $count_two, $count_three, $count_four ) {

		$total_count = 0; 

		if ( 0 < $count_one ) {

			$total_count += 1; 

		} 

		if( 0 < $count_two ) {

			$total_count += 1; 

		}

		if( 0 < $count_three ) {

			$total_count += 1; 

		}

		if( 0 < $count_four ) {

			$total_count += 1; 

		}

		return $total_count;

	}

endif;