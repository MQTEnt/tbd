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
define('DB_NAME', 'wp_tbd_woocommerce');

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
define('AUTH_KEY',         't8fvzuHTUsLSBkATZMF*2)0?f*r-l35$v9`xY`DDd586PNH5MDT>J]a1vmbN&.)R');
define('SECURE_AUTH_KEY',  'HxUbsP&i0S(Tfkg(:dAt=C?!mH3ZJ-3e,GrA*e6My[Kzj=JQ,v^O!t/|qFD~IE@l');
define('LOGGED_IN_KEY',    '%-gVRzD6hG.0J0i1j{/cxN}It^}[fEn(E0:{WvImae?<Ph?$W{w{7;[@j/YuDcE#');
define('NONCE_KEY',        '|Gpj)X@+<-wDu=)n$P),/8fbzv81z*7O8j:(3){fS&?CJYGHt9sY.D>],I&61EhI');
define('AUTH_SALT',        '!iB_K4GSM+71/85WeD:VnHG@[vT[:vV8<r%Fs[ZH7Ss,eZ(.v)^njM3^J?rbiXLj');
define('SECURE_AUTH_SALT', '@iFz1q3CFbL1gv8.U*m+s:x>l!IQg(ldRAW%,N#Yp){<)_f;fUm7u~3s7_i_$@]v');
define('LOGGED_IN_SALT',   '!vJ2- @xDVuVhSsx8j;KB!]7V;Bc1^FbR,9X_=0b.(#H{/UeD;2c1$bbDTh*1GEb');
define('NONCE_SALT',       'b/Chy-%i6c=eQD&;L=>pD<SY>Mo+)mY~5k,(kC]?qC6BJj2kaHHY/1)?:rsXl(XJ');

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
