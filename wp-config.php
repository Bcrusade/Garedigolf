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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'db_gdg');

/** Database username */
define('DB_USER', 'root');

/** Database password */
define('DB_PASSWORD', 'root');

/** Database hostname */
define('DB_HOST', '127.0.0.1:8889');

/** Database charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The database collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define( 'DB_SOCKET', '/Applications/MAMP/tmp/mysql/mysql.sock' );

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
define('AUTH_KEY',         '5#Y_{6Mb X)[v%?{^?(88_Ev& <C#_ONpRVC:xSq.H&=oRnW%X5k8tp,;;ctY>^6');
define('SECURE_AUTH_KEY',  '|1vSsfZSWF!1w0|9ns#1DED@ lT^P$}yJatasP3oLG-B#]_[l,5ukZJO>W:>kWkC');
define('LOGGED_IN_KEY',    'XB-p8 f0C 5RrJ:YF>:NKIsqw4UffvxU4C#_:zC FK02dJ66$4^=$Frr18+ |uR:');
define('NONCE_KEY',        '/dpnR(V4M<?LHoHe98-%i+}8/4+ ^ri:A{D#9)2_&9H?uf=<-Nc({neH7jVTS,<o');
define('AUTH_SALT',        'aVd?S:uD{T6D:;8u-{A i_jtr^.9Qdj<g8zHy|vQfq,om)Tt6:tB;}K+8&}?V$~K');
define('SECURE_AUTH_SALT', 'N3h,M;l>ja,Zyyh79L7N<`M5~1JCh@e?Y3@w<OU|vhrz^l3-ct6I]f*!ZSp%/%$X');
define('LOGGED_IN_SALT',   'Wa$T$IWs$.J %?tUg,@6fP(+GY-.Ah[&tK}(D@i=mw;,a^o9L8TYDh|)@]TxSCYf');
define('NONCE_SALT',       'HViwl9meWX[Rac*M?;L,MiZOGk`.k~[];<CbBBd0~-f9_(r^[l_*~(v6*iop`N`5');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
@ini_set('display_errors', 0);



/* Add any custom values between this line and the "stop editing" line. */

ini_set('max_input_vars', '5000');
ini_set('memory_limit', '512M');
ini_set('max_execution_time', '300');
ini_set('post_max_size', '42M');
ini_set('upload_max_filesize', '42M');
/** Aumenta il limite di memoria PHP per WordPress */
define('WP_MEMORY_LIMIT', '512M');
define('WP_MAX_MEMORY_LIMIT', '512M');
define('ALLOW_UNFILTERED_UPLOADS', true);


/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
	define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
