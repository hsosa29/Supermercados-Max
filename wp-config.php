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
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '^h)lK1R>)vzY3Ty?OsJaT3Un.t#M&KX7QKgS1$;b3hL@:P=IA7p@FPD51Ow:e4Do' );
define( 'SECURE_AUTH_KEY',  ',5&eT4!7[AC]2B:hn,qsJ>j)(*(P3Us{&L5#R@W<nl4W9*Ew,?`-dxPl=fs-`b-x' );
define( 'LOGGED_IN_KEY',    'F_*}|m|`8a/-{(RTCBA^(Wz}>]omx@F[v*`rkynoTE~n59>s8P3`XlckEE%2K3_A' );
define( 'NONCE_KEY',        ':CsBNYeNL7Wqcw&R!Zc83n*r?C`qwy:~o9>5y8J]Dqi6i71]AF6T7?-+CjgX:ATG' );
define( 'AUTH_SALT',        'wkPcsp4[B`|RaI?iIT;}0 2kF%XJj l`!ghTli[_$ A?rFvLjnG7LixozfxVm::p' );
define( 'SECURE_AUTH_SALT', 'iMt4k<UL9<$dXQfpf1884%aQ=-g}BFX/g*hM8ye4^f+&}:FtS-Ff.NH5KAc~cZrM' );
define( 'LOGGED_IN_SALT',   'Dlf6}]v)tKCsU[rp/]&i#W(}b08h]2k0o0f8Q.lH2<#9BcYY@zVSCR{F4S:V5jzy' );
define( 'NONCE_SALT',       'I-@ L6+?Q7gc:]+CTBdjOHyQo/[#O1L*^~Sj_c2?U uNGI~}H/Y@eGE4Ej-V!d:a' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
