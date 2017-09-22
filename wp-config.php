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
define('DB_NAME', 'nmartin143_revolver');

/** MySQL database username */
define('DB_USER', 'nmart_revolver');

/** MySQL database password */
define('DB_PASSWORD', 'hOvs946^');

/** MySQL hostname */
define('DB_HOST', 'mysqldb3.ehost-services.com');

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
define('AUTH_KEY',         ';dyeHKSE,MZ:3{.R|[2ZU^.uTh)1k{I++&z:V;0fY?x`XN-uAj1W>=)nHedcr7yF');
define('SECURE_AUTH_KEY',  '1~Q6zQB37w)8nx?+YG(8Ewj{]9vt] CF%4[WDRVaWtd_GslAhcz=SB3G&#j~dgp;');
define('LOGGED_IN_KEY',    'J7b|ta^i?T% 8UV?Wz..cab{0Qrf_q})s&}t]dc|;.23IzuCu-G|*g!<4A7+o%N.');
define('NONCE_KEY',        '@9nR,-!#r807LMNR/GMiQYa(4X2KwS#jzzS4Z${.z817IW>@apx+yEe_YggbOdjL');
define('AUTH_SALT',        'E}GHa>V[XnI5Ip]6!$C5;ad3%(4&-LCi`!+i{w]K&?PEh2klo=ih}lvU~}8wvyMF');
define('SECURE_AUTH_SALT', ':<_Xc}- x?]W*YqaS2bEo,TUm1 :=Hi]RzbiiZ~]~rLd5phxWgu([t14yG#!!2et');
define('LOGGED_IN_SALT',   'Z2DA=P!)1;TZ^Z<|s1T<f7SAZ @ly+?FJ@xDUq$#B1Ti^2I]g}k`x$N@B_`_F<FK');
define('NONCE_SALT',       'U]H=FCa^<L3yOQw? >xHM3~L{Y;{QjyTUvvFXNp_On&tFhGX,QpQ$su]EyU~qF|K');

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

ini_set('upload_max_filesize', '32M');
ini_set('post_max_size', '32M');
ini_set('file_uploads', 'On');


/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
