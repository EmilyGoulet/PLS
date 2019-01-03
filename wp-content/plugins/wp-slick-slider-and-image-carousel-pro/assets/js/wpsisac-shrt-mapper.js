var timer;
var timeOut_Val = 300;
var timeOut = timeOut_Val; /* delay after last change to execute filter */
var preview_shortcode = jQuery('.wpsisac-customizer').attr('data-shortcode');

var dep_wrap 	= '.wpsisac-customizer-control';
var dependency 	= jQuery(dep_wrap +' .wpsisac-cust-dependency').attr('data-dependency');
dependency 		= jQuery.parseJSON( dependency );

jQuery( document ).ready(function($) {

	$(document).on('click', '.wpsisac-cust-dwp', function() {
		$('body').toggleClass('wpsisac-cust-full-preview');
		$(this).toggleClass( 'wpsisac-cust-dwp-active' );
	});

	/* Customizer Accordian */
	$( "#wpsisac-cust-accordion" ).accordion({
		collapsible: true,
		heightStyle: "content",
		icons : {
				header: "dashicons dashicons-arrow-down-alt2",
				activeHeader: "dashicons dashicons-arrow-up-alt2"
		}
	});

	/* Generate Shortcode */
	$(document).on('change', '.wpsisac-customizer-control select, .wpsisac-customizer-control input[type="number"]', function() {
		field_timeout 	= $(this).attr('data-timeout');
		timeOut 		= (typeof(field_timeout) !== 'undefined') ? field_timeout : timeOut_Val;

		wpsisac_generate_shortcode_preview();
	});

	$(document).on('keyup', '.wpsisac-customizer-control input[type="text"], .wpsisac-customizer-control input[type="number"]', function() {
		field_timeout 	= $(this).attr('data-timeout');
		timeOut 		= (typeof(field_timeout) !== 'undefined') ? field_timeout : timeOut_Val;

		wpsisac_generate_shortcode_preview();
	});

	/* On Change of Customizer Shortcode */
	$(document).on('change', '.wpsisac-cust-shrt-switcher', function() {
		redirect = $(this).find(":selected").attr('data-url');

		if( typeof(redirect) !== 'undefined' && redirect != '' ) {
			window.location = redirect;
		}
	});

	/* Tweak - An extra care that form should not be refresh */
	jQuery('#wpsisac-customizer-shrt-form').submit(function( event ) {
		var form_target = $(this).attr('target');

		if( typeof(form_target) == 'undefined' || form_target == '' ) {
			return false;
		}
	});

	/* On Click of Preview Generate Button */
	$(document).on('click', '.wpsisac-cust-shrt-generate', function() {
		
		var main_ele 	= '.wpsisac-customizer-control';
		var shrt_val 	= $.trim( $('.wpsisac-customizer-shrt').val() );
		var first_char 	= shrt_val.substr(0, 1);
		var last_char 	= shrt_val.substr(-1);

		/* Simply return if blank value */
		if( shrt_val == '' ) {
			return false;
		}

		if( first_char == '[' && last_char == ']' ) {
			shrt_val = $.trim( shrt_val.slice(1, -1) );

			first_char 	= shrt_val.substr(0, 1);
			last_char 	= shrt_val.substr(-1);
		}

		if( first_char != '[' ) {
			shrt_val = '[' + shrt_val;
		}
		if( last_char != ']' ) {
			shrt_val = shrt_val + ']';
		}
		
		$('.wpsisac-customizer-shrt').val( shrt_val );

		temp_shrt_val = $.trim( shrt_val.slice(1, -1) );
		var data = wp.shortcode.attrs( temp_shrt_val );

		/* If wrong shortocde then simply return */
		if( data.numeric[0] && data.numeric[0] !== preview_shortcode ) {
			alert( Wpsisac_Shrt_Mapper.shortocde_err );
			return false;
		}

		if( data.named ) {
			$.each( data.named, function( shrt_param, shrt_param_val ) {
				if( shrt_param ) {
					$(main_ele+' .wpsisac-'+shrt_param).val( shrt_param_val ).trigger('change').trigger('keyup');
				}
			});
		}
	});

	/* Shortcode Customizer Dependency */
	if( dependency ) {
		$.each( dependency, function( key, dependency_val ) {

			if( key ) {

				/* Dependency on page load */
				setTimeout(function() {
					$(dep_wrap+' .wpsisac-'+key+'').trigger('change');
				}, 10);

				$(document).on('change keyup', dep_wrap+' .wpsisac-'+key+'', function() {
					
					var input_val = $(this).val();

					/* Show Dependency */
					if( dependency_val.show ) {
						$.each( dependency_val.show, function( sub_key, sub_dep_val ) {
							$(dep_wrap+' .wpsisac-'+sub_key+'').closest('.wpsisac-customizer-row').hide();
							$(dep_wrap+' .wpsisac-'+sub_key+'').addClass('wpsisac-cust-hidden-field');

							/* If value is present then show */
							if( ( $.inArray( input_val, sub_dep_val ) !== -1 ) ) {
								$(dep_wrap+' .wpsisac-'+sub_key+'').closest('.wpsisac-customizer-row').show();
								$(dep_wrap+' .wpsisac-'+sub_key+'').removeClass('wpsisac-cust-hidden-field');
							}

							/* Check if reference dependency is there then hide it's element also */
							wpsisac_check_ref_dependency( sub_key );
						});
					}

					/* Hide Dependency */
					if( dependency_val.hide ) {
						$.each( dependency_val.hide, function( sub_key, sub_dep_val ) {

							$(dep_wrap+' .wpsisac-'+sub_key+'').closest('.wpsisac-customizer-row').show();
							$(dep_wrap+' .wpsisac-'+sub_key+'').removeClass('wpsisac-cust-hidden-field');

							if( ( $.inArray( input_val, sub_dep_val ) !== -1 ) ) {
								$(dep_wrap+' .wpsisac-'+sub_key+'').closest('.wpsisac-customizer-row').hide();
								$(dep_wrap+' .wpsisac-'+sub_key+'').addClass('wpsisac-cust-hidden-field');
							}

							ref_dep = sub_key in dependency;
							if( ref_dep ) {

								var ref_input_val = $(dep_wrap+' .wpsisac-'+sub_key+'').val();

								$.each( dependency[sub_key]['hide'], function( ref_key, ref_dep_val ) {

									$(dep_wrap+' .wpsisac-'+ref_key+'').closest('.wpsisac-customizer-row').hide();
									$(dep_wrap+' .wpsisac-'+ref_key+'').addClass('wpsisac-cust-hidden-field');

									if( $.inArray( ref_input_val, ref_dep_val ) == -1 && (!$(dep_wrap+' .wpsisac-'+sub_key+'').hasClass('wpsisac-cust-hidden-field')) ) {
										$(dep_wrap+' .wpsisac-'+ref_key+'').closest('.wpsisac-customizer-row').show();
										$(dep_wrap+' .wpsisac-'+ref_key+'').removeClass('wpsisac-cust-hidden-field');
									}
								});
							}
						});
					}
				});
			}
		});
	} else {
		wpsisac_generate_shortcode_preview();
	}
	/* Shortcode Customizer Dependency */
});

/* Function to generate shortocde preview */
function wpsisac_generate_shortcode_preview() {

	/* Taking some variables */
	var shortcode_val   = '';
	var main_ele		= jQuery('.wpsisac-customizer');
	var cls_ele         = jQuery('.wpsisac-customizer-control');
	var shortcode_name  = preview_shortcode;

	clearTimeout(timer); /* if we pressed the key, it will clear the previous timer and wait again */
	timer = setTimeout(function() {

		main_ele.find('.wpsisac-customizer-loader').fadeIn();

		shortcode_val += '['+shortcode_name;

		/* Loop of form element */
		cls_ele.find('input[type="text"], input[type="checkbox"]:checked, input[type="radio"], input[type="number"], textarea, select').each(function(i, field){

			if( jQuery(this).hasClass('wpsisac-cust-hidden-field') ) {
				return;
			}

			var field_val	= jQuery(this).val();
			var field_name  = jQuery(this).attr('name');
			var default_val	= jQuery(this).attr('data-default');
			var allow_empty	= jQuery(this).attr('data-empty');            

			if( typeof(field_val) != 'undefined' && ( field_val != '' || allow_empty ) && field_val != default_val ) {
				shortcode_val += ' '+field_name+'='+'"'+field_val+'"';
			}
		});

		shortcode_val += ']';

		/* Append shortcode */
		main_ele.find('.wpsisac-customizer-shrt').val(shortcode_val);

		jQuery('#wpsisac-customizer-shrt-form').submit();        

		main_ele.find('.wpsisac-customizer-preview-frame').load(function () {
			main_ele.find('.wpsisac-customizer-loader').fadeOut();
		});

	}, timeOut);
}

/* Function to check reference dependency */
function wpsisac_check_ref_dependency( sub_key ) {

	ref_dep = sub_key in dependency;

	if( ref_dep ) {

		var ref_input_val = jQuery(dep_wrap+' .wpsisac-'+sub_key+'').val();

		jQuery.each( dependency[sub_key]['show'], function( ref_key, ref_dep_val ) {
			
			jQuery(dep_wrap+' .wpsisac-'+ref_key+'').closest('.wpsisac-customizer-row').hide();
			jQuery(dep_wrap+' .wpsisac-'+ref_key+'').addClass('wpsisac-cust-hidden-field');

			if( jQuery.inArray( ref_input_val, ref_dep_val ) !== -1 && (jQuery(dep_wrap+' .wpsisac-'+sub_key+'').is(':visible')) ) {
				jQuery(dep_wrap+' .wpsisac-'+ref_key+'').closest('.wpsisac-customizer-row').show();
				jQuery(dep_wrap+' .wpsisac-'+ref_key+'').removeClass('wpsisac-cust-hidden-field');
			}

			/* Check if reference dependency is there then hide it's element also */
			wpsisac_check_ref_dependency( ref_key );
		});
	}
}