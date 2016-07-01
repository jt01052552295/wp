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
define('DB_NAME', 'wp');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'autoset');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         '`gp4p]p/NWo]5Z.jOOq?P{1gaZce,**: 0gA,!3*Q PxQIj0DF>P<)JIp945)s6I');
define('SECURE_AUTH_KEY',  't1H;OKls_EovgWr;B[0sAQE<&G0x>at~vuL#SmDD&<tHdmoaW/*mpxS,=SEv]nSl');
define('LOGGED_IN_KEY',    'h2q5TA*70/56O)Kmab6LT/~(^Hi+g)SO5p)-.a12C-8|?-Ul2W+wBk*k7S$D0;9f');
define('NONCE_KEY',        'lm}u(.ZJV~Tx>?^C~x[PO&K]4qgFeg4bZg`ny:xyp_]KN6qB=qWvU:2b^1zNn9n0');
define('AUTH_SALT',        '&G*50+d3Z=V{O4w%&$YJ9T&:UT@_YVJGR$.L((X%JNl.Vld}yTg zYpjx[c4oIDK');
define('SECURE_AUTH_SALT', '99Iwv.x<#%f+ryz![s/Y#!T)fvr9.?Q;eW*{-s}@?Z_N2twe%.z|C;~$uK2W`y!:');
define('LOGGED_IN_SALT',   'cU2jGskUH%J(onYE}Erq0=cJ>8mOpBt1PRmNn2S};;G9O1~zeTvXu)&;5,y^+Q<|');
define('NONCE_SALT',       '6JdZfpouLT|OtsGyiYw!^9nBZvW}g=7l HuDNb=4DLpu#jL7d*y7yAA>7j9Wt@is');

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
