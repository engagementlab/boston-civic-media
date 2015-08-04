<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         'K-DEEE2.{VDE^Lil]wPRfK((~EJ&WBDP>LdWzb3n%tCkL>Rmb[P#O-vq/2ym0&;/');
define('SECURE_AUTH_KEY',  ']0xwgEHWX*[p0c-ik]Sh;ls@FQ7~Yb{Zx|==PMwy(FlT52B&BV.,gC0c~XDEI4(+');
define('LOGGED_IN_KEY',    'jGXk-MJn-ooH~Jyax+So),lhY)mCldcMz~Oj3t#f[aQ-hP*7LR~ zph8&#Wc3]%?');
define('NONCE_KEY',        '~Knw-s -9e<AVFp|yH,p0@= *Wn/[7-63|G=%Dqq^}!1!__cF$-O >:XF,_X~a]8');
define('AUTH_SALT',        'd6KCYLJ^j][3m+v{YkJy2KU4f6+{F[ztGs|>AwA%&%TtCGY2Ds^(QKr53*yq/V[V');
define('SECURE_AUTH_SALT', '$({#g&5hCnK-Qo-_$CQ^ZX/I7WgoNz~qTM{&ptN0$]yHp m?MXK_1v~0#gg6u-|f');
define('LOGGED_IN_SALT',   'FYs)8xjBl[R_s+xMRMpf6$s,,5+5OMpJ+0RQ_<r:|xg dS&;MH9|IT^lg7:0@E;.');
define('NONCE_SALT',       'Q>**-$.^|>pb|S.or,#Pl*#|VJ+0PZ4bc9R5>WiP[--Qt*VqRCjSol2AS5lJ&Y~s');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
