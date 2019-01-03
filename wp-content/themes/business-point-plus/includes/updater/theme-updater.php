<?php
/**
 * Easy Digital Downloads Theme Updater
 *
 * @package EDD Sample Theme
 */

// Includes the files needed for the theme updater
if ( !class_exists( 'EDD_Theme_Updater_Admin' ) ) {
	include( dirname( __FILE__ ) . '/theme-updater-admin.php' );
}

// Loads the updater classes
$updater = new EDD_Theme_Updater_Admin(

	// Config settings
	$config = array(
		'remote_api_url' => 'https://www.prodesigns.com/wordpress-themes/', // Site where EDD is hosted
		'item_name'      => 'Business Point Plus', // Name of theme
		'theme_slug'     => 'business-point-plus', // Theme slug
		'version'        => '2.0.1', // The current version of this theme
		'author'         => 'ProDesigns', // The author of this theme
		'download_id'    => '', // Optional, used for generating a license renewal link
		'renew_url'      => 'https://www.prodesigns.com/wordpress-themes/my-account/', // Optional, allows for a custom license renewal link
		'beta'           => false, // Optional, set to true to opt into beta versions
	),

	// Strings
	$strings = array(
		'theme-license'             => __( 'Theme License', 'business-point' ),
		'enter-key'                 => __( 'Enter your theme license key.', 'business-point' ),
		'license-key'               => __( 'License Key', 'business-point' ),
		'license-action'            => __( 'License Action', 'business-point' ),
		'deactivate-license'        => __( 'Deactivate License', 'business-point' ),
		'activate-license'          => __( 'Activate License', 'business-point' ),
		'status-unknown'            => __( 'License status is unknown.', 'business-point' ),
		'renew'                     => __( 'Renew?', 'business-point' ),
		'unlimited'                 => __( 'unlimited', 'business-point' ),
		'license-key-is-active'     => __( 'License key is active.', 'business-point' ),
		'expires%s'                 => __( 'Expires %s.', 'business-point' ),
		'expires-never'             => __( 'Lifetime License.', 'business-point' ),
		'%1$s/%2$-sites'            => __( 'You have %1$s / %2$s sites activated.', 'business-point' ),
		'license-key-expired-%s'    => __( 'License key expired %s.', 'business-point' ),
		'license-key-expired'       => __( 'License key has expired.', 'business-point' ),
		'license-keys-do-not-match' => __( 'License keys do not match.', 'business-point' ),
		'license-is-inactive'       => __( 'License is inactive.', 'business-point' ),
		'license-key-is-disabled'   => __( 'License key is disabled.', 'business-point' ),
		'site-is-inactive'          => __( 'Site is inactive.', 'business-point' ),
		'license-status-unknown'    => __( 'License status is unknown.', 'business-point' ),
		'update-notice'             => __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'business-point' ),
		'update-available'          => __('<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'business-point' ),
	)

);
