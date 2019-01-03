/*
* WP SVG Icons
* Custom fucntion to uninstall a custom icon pack
* Compiled by Evan Herman, https://www.evan-herman.com
*/
function wp_svg_uninstall_font_pack() {

	if (confirm( translation_array.confirm ) == true) { // translation array passed in via wp_localize_script
		var data = {
			action : 'svg_delete_custom_pack'
		};

			jQuery.ajax({
			  type: "POST",
			  url: ajaxurl,
			  data: data,
			  success: function( response ) {
					jQuery("footer p:last-child").html("");
					jQuery(".current-font-pack").html("");
					jQuery(".preview-icon-code-box").hide();
					jQuery("#uninstall-pack-button").attr("disabled","disabled");
					jQuery(".dropDownButton").attr("disabled","disabled");
					jQuery(".svg-custom-pack-buttons").after("<div class=updated customFontUninstalledMessage><p>"+translation_array.success+"</p></div>");
					jQuery('input[value="Import"]').removeAttr("disabled");
					jQuery('#wp_svg_custom_pack_field').removeAttr("disabled");
					jQuery('.error').remove();
					setTimeout(function() {
						jQuery(".updated").fadeOut();
					},3500);
			  },
			  error: function(response) {
					console.log('Error deleting icon pack.');
					jQuery('#delete_succes_and_error_message').html('<div class="error customFontUninstalledMessage"><p>'+translation_array.error+'</p></div>');
			  }
			});
	}

		return false;
}
