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

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'jwblogger_update' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'password' );

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
define( 'AUTH_KEY',         ':rslw]q69cPS^#^xwJ9{Ced|6;>i9Mb 4l,lr91^@^X~TDnhx1rD5I,13!uIv`yy' );
define( 'SECURE_AUTH_KEY',  '] ol^9}&!| vpLv*sZYVI`Qa!SXN2{y*X_j} ZS`)I[o`AX:+AY/2A`|TV!PH(ri' );
define( 'LOGGED_IN_KEY',    'BI@1sjNv-xC{c?ZhYGar~0 Ow1#x/tGx6<<x$N`PLP/DJkDAo8@FhVugJYflrlVL' );
define( 'NONCE_KEY',        'dfD0m> s|0/ukC}eFJBm5NkrI@09`-=c:UFFfc5$mqv$t1X5Xp:#F[lM>d%[;a4]' );
define( 'AUTH_SALT',        'l_MxF7*NogUlF(~CxHP4: ]W.d.;v$0mQt^8:2DQ;?oPOr:,KELev+fj<wL@83TN' );
define( 'SECURE_AUTH_SALT', 'EGPubZEn}V#r7ZNC0]Q`ev`./HY0Jaj[b1C*g_&5LnH_&5ax]8)=T`@mCPn[/2Tk' );
define( 'LOGGED_IN_SALT',   'dw67m^]6FK(9$=~bz/j9zTo_9EgFq<DE=~Vqn-$#SjI5dh}#%ZL|ypDGv&)%[nrD' );
define( 'NONCE_SALT',       't5Y}duH!WyQ6w7|3-NQ-^w9CtXi^YQGU(zqNe0&d Mpz8NO_Lpl_}Bj-72nAQYyn' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wprt_';

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
define( 'FS_METHOD', 'direct' );