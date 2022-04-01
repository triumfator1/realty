<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

if (file_exists(dirname(__FILE__) . '/wp-config-local.php')) {
    require_once(dirname(__FILE__) . '/wp-config-local.php');
}

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
defined( 'DB_NAME') || define( 'DB_NAME', 'f0653471_wordpress' );

/** Database username */
defined( 'DB_USER') || define( 'DB_USER', 'f0653471_wordpress' );

/** Database password */
defined( 'DB_PASSWORD') || define( 'DB_PASSWORD', 'password' );

/** Database hostname */
defined( 'DB_HOST') || define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
defined( 'DB_CHARSET') || define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
defined( 'DB_COLLATE') || define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'FCcA4xGNsB?e=0r=lWS;{Ee}^4GUBy&Ci*C&aAI+lb}{gfdaM5kiYrKDCv]zpvew' );
define( 'SECURE_AUTH_KEY',  'WK//F] (x!<x~$<jjxftgpLCsI$8<21^#VmU6&5J.2]5j=CmOh8m$D>)#5D&xl}g' );
define( 'LOGGED_IN_KEY',    'F!]*L+[R,@U:HY=;FTAq]CpH3@RQN4vn^Qlsged_~N?<dNXv)dE>ZvPEeYO}vzL6' );
define( 'NONCE_KEY',        'B:mw6FVyNwN?G+ F[^_VT,k5f5xR!*HcZ! *OUeo9cv4tSRE|c0LcgnCdrItp3P1' );
define( 'AUTH_SALT',        ',4yE4TawjKS)ue/eFhD*R3^{^QDV[W]~ymT&UA~v.kH-B=;A[o FKmTzThrXKF;I' );
define( 'SECURE_AUTH_SALT', 'aw(2,Q+J*5H![E)wILU62b_ym`R3k}GeS+&Gk;,+H`$Ea-Yo7uoy!^T-yI8-pf^]' );
define( 'LOGGED_IN_SALT',   '`?.8RT^BMAwyi5E%w_xz&zo*~4w-B4(8FUf7xLchX2(T>I/sL;L/WGC=f/IByt,)' );
define( 'NONCE_SALT',       'HKh@1w{g`f]~pPmV{[]>#]GN%HWJ.[*jETOOdCHP&o!1t`[NwY_>}(M6q3uuX2<s' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */

/* Add any custom values between this line and the "stop editing" line. */

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

