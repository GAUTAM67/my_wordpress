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
define('DB_NAME', 'wordpree');

/** MySQL database username */
define('DB_USER', 'wordpree');

/** MySQL database password */
define('DB_PASSWORD', 'wordpree');

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
define('AUTH_KEY',         'q1-/IiN,<9x,o?~<LP)xsQmLA{|@O`t2,}~[1JCZjy&z(:Hj3ru|>WsXJ42S]P*@');
define('SECURE_AUTH_KEY',  '#IWRCcbosv16.$kWYk?auI>dzPN3I};N;FU5pexGyZDSS u6IlSmV`.K+z=spuEg');
define('LOGGED_IN_KEY',    'ki,8T8k4e>eDA|X`8HKBCkd5mX?TtNx;uZ4RqIi28VSy<^{O.u,6{a7WM:28Yfp}');
define('NONCE_KEY',        ')K}Nsf(b=`xvStK&`)KDlvXEItWkY$_p::UUg7rd|NNfqZZ/ueK/<)p?=|C)HPHe');
define('AUTH_SALT',        '/$n]ST(miQp~husL%vP^NDy5z3Q?nKeM[;^x?L-_#Ue-^3)ce:szb~r7mNZ2!$~3');
define('SECURE_AUTH_SALT', '=T.Zp>v<=Es(O2m--@UEl@_+Qr!}[MBD_/e-o%idFIr2p|))0@K5Z0QwxlX#BEFW');
define('LOGGED_IN_SALT',   'umR:abi=EVXFe<-c2H>Pam,03=S]i3UJWZhLkbv,8vVC%#o:[]DP(,Z0K#UOQn_=');
define('NONCE_SALT',       'GL/w~Gq8>e]O/YqPA:3Lek`d;P~uV0pR6H9%O.)(73Ch6*Ot!_nyTo!`irk./?K(');

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

