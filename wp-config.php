<?php
define( 'WP_CACHE', true );
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
define( 'DB_NAME', 'gghouse' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         '($I:]7H=&i@p$a$Q%{tgbRQXfNJ?0%$ut6xYckjH_xBS.ckPv-JWBLRN:^CEcDC]' );
define( 'SECURE_AUTH_KEY',  ')0qG*nMY#>FpgK]`g3tJ?Z$ISZLA+[<fY,2T8dZG{.11ELeJv^QgUQt>5S/[lDwW' );
define( 'LOGGED_IN_KEY',    'y+9!<31f,`Cw,Migm9OXOWT?>STDc7U.C3{4b&Pk&sfD*a)U6|gf<dcp;K[e:^0D' );
define( 'NONCE_KEY',        'ea6519PHi`Y>Srn},`UQrMV@rC@DxuBuqE95>+]wbc`Y?}[#/P>ng 9|j_&j%MTn' );
define( 'AUTH_SALT',        'yq&;Tf]4!2>`,ofY*AacJm1OJT2`i!qG)%m>1>H~l502rGNEp(Ii)E%Qvx5p%F|d' );
define( 'SECURE_AUTH_SALT', '.BxZn3e<6cjv<2)v*Q+65yRy.[}_J8LpZ#kaB7s}j,SP{[3?k`!d4.6E0@W{oQ3p' );
define( 'LOGGED_IN_SALT',   'FV9E9yJn6uoB2@9Ysn/pIB#)^$vcB(=IGJxaLhfbIV_Z^C}+%. n4EM4;bPfIl/|' );
define( 'NONCE_SALT',       'q+|kg>a<c@UX-.kYlCei}>.|``6j7hxp!}U{LnpJ<V%#tG:oXz(;M#O<k{1F9:9V' );

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
