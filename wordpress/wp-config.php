<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'gamer');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'laungkee');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         '}rHMjYy(!}Y2Goz`gh!T(ha|c;%GHj#1ND*`OiOj*+EJ??hen|&Op}@}iBASIU3+');
define('SECURE_AUTH_KEY',  'n4i@H7+x$XQ2=ZFC/]BoMon4Fk1[hw$Izfzw7I7Fce*W)0FGWTSUT>qjrbzo9bY&');
define('LOGGED_IN_KEY',    'JF)N~R`_,MSU+2V1}*:-)td~>VEe.>?X=5qzP#vV!oUP..yFlKXQU?`KO/=n=CB0');
define('NONCE_KEY',        'XSS3r1DK{ApIf~Ce12t.*/R  7IGA=4Xv?6` vV`@uG|hoUzN]L+j|L9tASX7RSR');
define('AUTH_SALT',        'nwh*=nochwW1+I((8Kl06H;utB3yCs]y=Y15Qz#-WpdGLTy%ZZXCQfjn!QERJT5N');
define('SECURE_AUTH_SALT', 'Yusi_b)|)en*IFn?P>VHt]~-V>{DV);!sthRgs?J>tgu$8Jr%DX$M)j{l)o$.{_y');
define('LOGGED_IN_SALT',   'gUqqsAdJWQs|z/bUus1ml#d<]g`)A6+_[s)lr?f{gg8/WU:BBuyuq@V;UeYa ey3');
define('NONCE_SALT',       'w?u3;^D_kVF{}7p6r3Jv*HHH%YsZ,9Lde&aWxAr>kL2X[6m~l)d8ACn:!|iVOpl#');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
