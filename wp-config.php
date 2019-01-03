<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'pathlabsDB3thck');

/** MySQL database username */
define('DB_USER', 'pathlabsDB3thck');

/** MySQL database password */
define('DB_PASSWORD', 'OzlzliD741');

/** MySQL hostname */
define('DB_HOST', '127.0.0.1');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Ic37n$7Q$^fj3IM${7N@}0cvBQr,QUj37n$48R@!Ng}CFr|RV,4gv:CGw|GV!1gw');
define('SECURE_AUTH_KEY',  'pDp_#WZ[:Ghw~OS_|9]DHx+LPi#59ex+HO~_5Wpt;2im*ATX<]aex2LP*<Taq^.7X');
define('LOGGED_IN_KEY',    'dhxDK-]1dl.];aixHL+*2Sat;HL+*OSly{Ti2AEuy{Lei26mq.DXar^<Ub{AIu$I');
define('NONCE_KEY',        '+]Wp]DHXmuAIy<{bq{Aq+HX<6AYn7Mn$Mbf{AquAT^34JkzJY,3QU^3fj!48k@JN');
define('AUTH_SALT',        'wOZ[8Zo8NR@0DS~1dhwGWw#Slp5O-[5P+*;et;Dtx#Wa#9lp_*.Pe;EHu<HX.6im+');
define('SECURE_AUTH_SALT', 'fq6M${Mb{AYcrBFv,QUjIjyIY,<78No@Ncg}FrvBR^,4kz|4g-GKZ[8Zo8NR@}cs');
define('LOGGED_IN_SALT',   '1Ss|[Zd:1KWptDHO~_SWp]DHx-Kah:1$.<XbqIu${PTi<6EuyHLer,>Yb{Ij$^Q');
define('NONCE_SALT',       'y<TXq{EIy$LTi<6EQjn7Bru>IY3jn^AUX<{NRk,7BgzFNc^,7YrvFJy$GJc@04k');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);
define('FS_METHOD', 'direct');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
