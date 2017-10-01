<?php
define('WP_MEMORY_LIMIT', '64M');

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


/** MySQL database username */

/** MySQL database password */

/** MySQL hostname */


if($_SERVER['SERVER_NAME'] == "grtest.co.uk" || $_SERVER['SERVER_NAME'] == "www.grtest.co.uk"){
	

	define('DB_USER', 'cl25-zonastore');
	define('DB_PASSWORD', 'dJm^6kGNR');
	define('DB_NAME', 'cl25-zonastore');
	define('DB_HOST', '79.170.44.105');
}
else {
	
	define('DB_USER', 'root');
	define('DB_PASSWORD', '');
	define('DB_NAME', 'wordpress_test');
	
	define('DB_HOST', 'localhost');
}
//exit();


define( 'WP_DEFAULT_THEME', 'grpr' );


/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         ':/LA[3^igQ442kgQ-l4LnRORBa^}-4+I+o@./ Wjx#3)O[CK[&YoGM$Gzkt1/c@:');
define('SECURE_AUTH_KEY',  '3O|bnpO3`~t+L;]/n^>YOIT)[qY:,qEuf!+Hu/W+@~=g)s1lMqhg/!StT7}WeBr=');
define('LOGGED_IN_KEY',    '+y8CwYTK&BhB%6N@0}~GFgX7mA>FyJi&jR/)%uL&t=)p%&h],9[J9doY!:aS?Q)S');
define('NONCE_KEY',        'IF%o($1%cN=[H653Q*./+j/c[~U2T9yxT Ulr*TnIigFH-367-q[|q*0nTx[$-_?');
define('AUTH_SALT',        '1HVFkDIe&#S~K@j[nedkf<_%5^eV^^cwp_`nU9/tXM]%w^3B@>c>XL2VW%!`,{p_');
define('SECURE_AUTH_SALT', '7*_TKX|yGuIh^Ef:aUzvJb,LyZjBSMugz[F)3q/[#omoNEg_o9|y.Z.XavP/4iVL');
define('LOGGED_IN_SALT',   'Z3,o>|%O.I4Mt]IewW hZeEThG| ~8s/[&YmMA .eCerMw48F4lu>}X)Kr,/C(Ey');
define('NONCE_SALT',       'ja3+$+<VoFf}<-hH&wu6nFN-i::Wv^|9eeV*:@PlDwsZb*4M5!9H &qn3=Ffi!90');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'gr_wp_';

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
