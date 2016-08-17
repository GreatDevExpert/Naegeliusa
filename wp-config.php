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
define('DB_NAME', 'naegeliu_2016');

/** MySQL database username */
define('DB_USER', 'naegeliu_m2016');

/** MySQL database password */
define('DB_PASSWORD', 'Tk&6!KDem!Gk');

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
define('AUTH_KEY',         '?0rKC9G)<3c[^Zb.ZOcP_.^|a+6L_fz-GYC2VFp//z5Fg)C.EF7s9+cg<k)n%SdU');
define('SECURE_AUTH_KEY',  'Pxt7NV]~G/o KEF64;D1Q#t}viWCB`/f,u Jyn!D[/w:TA@9|D+ycDOD+{3BC&D{');
define('LOGGED_IN_KEY',    '*!|hFQ$;i FL(RJ)#T<J;%>0<#^fk+S$ZhKmrt/-bvJoWw>0+HIcLY$f_2=F-h.T');
define('NONCE_KEY',        'jdGa$WJ(La|p<er8C*1D|)dQX4KN5apdr;LuuV&7^,% sSmu//!q12l:2e:Mi1:K');
define('AUTH_SALT',        'K5Y;cQ,GZh76O_biAm$H4 !%P`_)sEbv jhMW|iI]Y8ONONwHVpV`*D?MJ2PGW~m');
define('SECURE_AUTH_SALT', 'h__~N0F>R4{xrrtECJL~EGZeUua1CEv}h$xa|-Q^fQViAu#(C[TT?4|z9+nHW8&q');
define('LOGGED_IN_SALT',   '+FD+zVtw4ym%Rqta`V2yzU6Q#n%4R_w%XfN>FYAlT5|rO)6lY5 Q:6UqMW#hVI)>');
define('NONCE_SALT',       'HPO-397?_2b(P=,e=LQ7o*XH.1mGI{8W-w0aK [DeIer)yf=|=)BySV+[}B|&M&)');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'ng_';

/** Forwards HTTP/HTTPS status in WordPress on Optimized Hosting for

WordPress */
define( 'FORCE_SSL_ADMIN', true );
if($_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'){

$_SERVER['HTTPS'] = 'on';

};

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
define('WP_ACCESSIBLE_HOSTS', 'smtp.office365.com');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');