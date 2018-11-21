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
define('DB_NAME', 'pizzamania');

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
define('AUTH_KEY',         '!B/>:/08wlK;2uUjewZLY|]W?guYtN(DA<=]cRk?&5m{Wf>* uIX+/:]C/-6ohvY');
define('SECURE_AUTH_KEY',  '[wS)h8Px6~T,rfm~XON5#SFb!}BVZ^vodvd$aJAkB z-P<{;+einazQ$q*!M?R`:');
define('LOGGED_IN_KEY',    'a`/?!z{D}t[HOhK&9XoKnR3$/oGAEKYlx{[>~:]l^t&SV-saY~n83oPNJKa=85?<');
define('NONCE_KEY',        'TBDIH%bk_3!^g4E&N:]RS#$#X=!CU)kN4VMZYvt}kfZU]S)d*gm[JyOM5<n$O4!?');
define('AUTH_SALT',        'IbMFtxYly9?ZdRK4l8BFK@PeDSZefulo~if&$]8jow,H2AfF28<ZuL{_#0q^i%p.');
define('SECURE_AUTH_SALT', 'kP^nJ+sCOh2rO>K}N`)1vVMD6*y&%kCKq%n-Q9T2pIS_=(.G:=QHV#0f=Ma~91jy');
define('LOGGED_IN_SALT',   '&.l01Ek<O2c}:^yB1vw2-yxi5>MR^iAs-vl2e.IMj:R[xW*Z)8wPPqN_FmEpCzv=');
define('NONCE_SALT',       '2)xb/RFMS;w[p(}}OlG^oIH**JvmS+~JK px?<HQ5-PxD7]xOHHo`7R&S<V6WMY2');

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
