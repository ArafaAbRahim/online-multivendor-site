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
define('DB_NAME', 'ecommerce');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'C2[.?q-2e a|UR+uR)fz@fXo<Et<x<hze/$<u@%GQ^Dc;R(jY4*Sdai}W7[I)olW');
define('SECURE_AUTH_KEY',  'N!2zv_e}-/Jw2^aI<Y9wi%@4pPhq&}QCio. Y2nD>%8ifb [FB,>3;;%-!V[m[Aq');
define('LOGGED_IN_KEY',    '{e3!{j9Bn&3LqSw16_eWy%glnusPN#B FM#@`OoUT:6ddaw-!Z;fOkTX=esmu?@4');
define('NONCE_KEY',        '*/YLcZ T(Eh^``P{:Qu&>X `i3NKV8K#=,d7w f&~.t&Y<|,<>A+V?X|O:`#<2Vs');
define('AUTH_SALT',        'Lw[ERVjalD4$sbah)rSq9JUV=_II<,a|XYJ`YCXp]VgPsqe*W7WQxCTiGN1}z])#');
define('SECURE_AUTH_SALT', 'aT#]QMLkcbh8Sh<|0oh,KGJpYV&9O>),eVYiq(iv(~E|+DH=Aa?i;QLZ7p-j @y2');
define('LOGGED_IN_SALT',   '?-bg8Pb2KCKGQ=ILx;4/YC%=!XK(.7_h!v_EE3!a#;p8Z2Z4tg5.n0s[DTDW^GLZ');
define('NONCE_SALT',       'Wt)RRmd## wDI l}%AJB(YF{]02zIrk#6`y>-91`Tm0GcyJmf{8o33|k!|u}lj{X');

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
