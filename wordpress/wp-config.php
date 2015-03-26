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
define('DB_NAME', 'wgamer');

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
define('AUTH_KEY',         'ekU+?&:oD=?,<eH+^GK(cs@U~(^%R7x0kG-9)uED~M;a&%S1BO8=DaPfcr@hga?x');
define('SECURE_AUTH_KEY',  'gMUw>^3)SF]kT|1*}(,~%$5`|+%1vELL*!3+YOhG }PK!Yhl!S3E|q_8ij(2g|:5');
define('LOGGED_IN_KEY',    'bI@gc1%zn#ZPF#y/X1*M-wj[8dz.hoP0x2BW|#09d-a+D-yVYtlkzg5!%o[&xMY~');
define('NONCE_KEY',        'U> XC/GQ#e-|mVcR2|h,:RtDK-AyKInC,(c^1-uJy@6lJAG<|I=xxvLVUP4SXl5.');
define('AUTH_SALT',        'XYqdE49;-e%9mbxC-I[03cU|wV@{&7i,q2JkO|Kwt|)a6-a|7bgCylNGl6x5 ,Dn');
define('SECURE_AUTH_SALT', 'hO^w87rWH^bvp#7-!Jk]=FobSY.EM-;0as~k-kqdn}L5P|&kOX:_{Ik)|CgVQ|wD');
define('LOGGED_IN_SALT',   '/;J|]$5?CfHe|u5>k3wABT%)6<!|>i+z?xoC+-VG#q,X:/C/UJCk+`-u>g/IIZXR');
define('NONCE_SALT',       ':H1[6fViFo`>LiYRqhpYu~&ZM_o:`;ysv?~XaH#Ap7W-hT4<5,p>P`~k?oTkPkv~');

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
