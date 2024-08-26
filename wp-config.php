<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'fishing-rods' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'MySql-8.0' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

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
define( 'AUTH_KEY',         '&()SL_4 PW~ +S?q}.0QG.LbnpKPK;9X%Tf;6wNt|X0m,81 A8nW_T?D*EA?|vaf' );
define( 'SECURE_AUTH_KEY',  '>0x-]EL5IA~5P3yU0vpXD04rM1ce?:;RM!x6S[*g $zOrgZl]%xM9g]!1Kx[3[M@' );
define( 'LOGGED_IN_KEY',    'HM0=+VLkM#UqMyz2xui:|pa29k|b02D]hL}1s?l-n^>ss^r#ag}[z+SOLen<.N!_' );
define( 'NONCE_KEY',        '4y]-AvCKla34J3%r884aW`0Wz<=}Pfx7%=rUO7@ff_3l*4V+#!B!D:a>8L7(A#==' );
define( 'AUTH_SALT',        '*/mXuWP~v=,8^ndhTS%R+(9}L:z%b|zS<$/TSqc[4>u JN`qcn|KunM9c<ltm>x)' );
define( 'SECURE_AUTH_SALT', 'z]-gX@B5:cqm82CnVUFA2xm.NDHNz;OSn6-hS4{Ng|= #?&!^c{fWSK7uB&zMlc/' );
define( 'LOGGED_IN_SALT',   'gO!{K/K)+`gc{))JUOM!(?//$?$)`>8E3S3L8}VWC}3usc#XVO+}F,iCO^+>*4oY' );
define( 'NONCE_SALT',       'on.d!MN/WYR7$5l1QP^?!%%gpDX[NtRmCL(VFq=XH9MdtL_(^esW7Q6q)G hj)=e' );

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', true );
define('WP_DEBUG_LOG', true);

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
