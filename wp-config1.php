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
//define( 'DB_NAME', 'jwblogge_wp884' );
define( 'DB_NAME', 'jwblogger' );
/** Database username */
//define( 'DB_USER', 'jwblogge_wp884' );
define( 'DB_USER', 'root' );
/** Database password */
//define( 'DB_PASSWORD', '98!Oq6Sp@u' );
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
// define( 'AUTH_KEY',         'r41jzuridhtobaqx3ksvpihwogprejnc4af4zopf2i3iqu27rtfw5bgwljyc5yi7' );
// define( 'SECURE_AUTH_KEY',  'sxnx4avm21epetpeuvvu9xxqxizluoes64hljtaw2kfnwejygie9aftxa6cujrha' );
// define( 'LOGGED_IN_KEY',    'ip1ouxjamrpf5pfzgm7i1m3mgcdauyxzikfghw23eqwkx9lpofyvlk8jkxkicves' );
// define( 'NONCE_KEY',        '47qhocycvklc5sutrpjni4lt1kiln2e2flclfnrwaevbpjdxvfkhmzoa9iq9blce' );
// define( 'AUTH_SALT',        'cedaicpqdkunhwpswtgepbvtxkj0j08l616qbc1wry870jpmyfrbqmotsx5peb7j' );
// define( 'SECURE_AUTH_SALT', 'dcnjq1s4c3al1yt7y3ptnx4hfpodbyzx0yjyofbc5yueohnn9krdg26apibddkym' );
// define( 'LOGGED_IN_SALT',   'h0xhtfxdtwo4zgddsruovkvpyyeiwxqeqfbisi965c1xddztvnnuvsubizm2yada' );
// define( 'NONCE_SALT',       'kfrh8vyjyf7kwtrywo1ectzeppfnrbyizx6aql8tvemn5nhmkcwcslr5zrrodciz' );

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
define( 'WP_DEBUG', true );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
