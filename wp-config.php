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
// define('DB_NAME', 'avivahom_marthahair');
define('DB_NAME', 'avv_marthahair');
// define('DB_NAME', 'cabelobr_marthahair');

/** MySQL database username */
// define('DB_USER', 'appuser');
// define('DB_USER', 'cabelobr_root');
define('DB_USER', 'root');

/** MySQL database password */
// define('DB_PASSWORD', 'avivatec@123');
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');
// define('DB_HOST', '192.185.176.196');

/** Database Charset to use in creating database tables. */
// define('DB_CHARSET', 'utf8mb4');
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
define('AUTH_KEY',         '~{bk44VDi-)MWc&f8Yf8+)Or:D~d.9;XkuA^o]7$44?g8R+Swk&_`mS-Q}Bh]^<a');
define('SECURE_AUTH_KEY',  'xp}C];,;(1`VthF)7JN.nY: {K>+i,k4d|gST{oY,ko+HUGUs^7kw;~C:@h_(HE&');
define('LOGGED_IN_KEY',    'T)qo;-jP]O7~mOALD5/!T#7XB_O5mMV^vXw@=FM]!UDnK2:PO%6Iu6bh|P2N+Z[]');
define('NONCE_KEY',        'jq3-Z/ LiNtpGrQyX*um/KD:3~^9o_X,Py+-Hur$u<M{9kh~u+}`NkWzV++oy41D');
define('AUTH_SALT',        '<vfOWab:D5R!8klj{`}|4#~u^L)dw{<Tj(wsl<{osM|o^Wbmd t{>7:3?Mmd6:{k');
define('SECURE_AUTH_SALT', 'Pjt1u*WXkJ=a#k|M(NqUREiTo)#-!tQHMpZP@Z+jbD&{JtAnBf66ZkLO=0}2+}!~');
define('LOGGED_IN_SALT',   'PKzaI|qtZJ<R(6A[@!61!u];:z2)Z/y!]qCH*f|<SHulzw}yw;7u|(JaT(8TkPl|');
define('NONCE_SALT',       'rWt&*D0m2Vq-N+Q,2JZ+H+/:WHgrqEG_q-nqDT|1JAYg$1Z-:yd!@^~-N9hFUy]#');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'avv_';

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