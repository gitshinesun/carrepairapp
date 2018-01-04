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
define('DB_NAME', 'mywordpress');

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
define('AUTH_KEY',         'Qz-K$:?be9:`gO9C/mVw_P3`A0#b+H7**NU$A)hz_>6Vj;Li*LF)UQX]:k$2/)&%');
define('SECURE_AUTH_KEY',  '6=>p_6XuG5^P1)8$At#c$-A?^pO[iG[-e;ib;oJieR9rw?mhaPI` DoM$S!#,{v0');
define('LOGGED_IN_KEY',    '@3AqiBp-hFU&.xF|Qv<a~L<q/cg DhP#7=}eH+=>$}J>aW2zD7;sH)K7F:21z:S7');
define('NONCE_KEY',        '&++Eqpk$>DAn=GzBfOe}*,[bU^zJb<ILMkSyb)ry1`UIQ>Nu|3;@hJ79bZ5R8_qC');
define('AUTH_SALT',        '=.aGTR**NZp}.=V#$cEZ6kR,kT. >|^1{EM[J?2fyvF|%mW=Jt$=&8J[{.)Dgq`U');
define('SECURE_AUTH_SALT', '(O9QwZuh7LB}O/k;$#OAx~GWpGXuG*yJMf40L6m,ioX8$=y-9=%)i)dd8jtty0S#');
define('LOGGED_IN_SALT',   'Tq#:&).Ff|X5[=&D40Eh2cm VX/{:iIh+EV!5Ut9gUmFHPI}T;}t##0h9c%L$3xE');
define('NONCE_SALT',       '~rnOY6e-#jWV.%oCw/w!0#x+AO,S71y-J06Zg&orpzW?4hr!S/&pVpdptt=hKvk5');

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
