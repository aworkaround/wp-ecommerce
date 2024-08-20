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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          '7E/[#)Ir}!VFHlUg5UL$!hYfQ8+Hc`:`r_eE)}{97LGGL[ b*[VQ;|DenIA5u[K5' );
define( 'SECURE_AUTH_KEY',   ' <SuDaPv@ih;rOlH$uLah*;NiE408MwRBjtop:gF<&nw/J7yefo>A6n>^D=?__rY' );
define( 'LOGGED_IN_KEY',     '119$QlAf+-o`3CkA!k}4tP^#LPEp wZ.Hu6e=~s[.eq5y39r#w)Pel8ibt,fga,Z' );
define( 'NONCE_KEY',         '=_/IB%7c{w.Q^k26?%r[ywJt@QwR C%_^BKl9cFb30y{]!N -Dz ksFJ<T-klS+#' );
define( 'AUTH_SALT',         'x4Dgs#t7Dw[LsAhcfmi5Hma>)_wS?mg/!4J~,?MeNw20M$v*XWUDV1pk`(Cfj6ts' );
define( 'SECURE_AUTH_SALT',  '%EWmCb?1!n(D&3j$?`B38Ay2lOdtR<Lp{CBwV6[celC jZ8Ke9?6g8#UJwED}:6=' );
define( 'LOGGED_IN_SALT',    '9Dw4xX<N]|9hlVaV3j2CGxNYnbq46A3# ,U!U}yAmr5]_xH1.AQ6e-Rf_+f1<?D~' );
define( 'NONCE_SALT',        '#cB=4Zx;#;zNR~2+P$`J]f_*)uW6s,+w+Y%,>>#6|yGi[fQl==#yjgh&->+Q!_f2' );
define( 'WP_CACHE_KEY_SALT', 'Qj;Arbag,}+WjvVr2qQs~^3BS$KnO/5hS7CKgPC5Q/G*>PWgSIH)&7i#V]o~B^1F' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
