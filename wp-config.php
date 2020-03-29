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
define( 'DB_NAME', 'Wordpress_db' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '6JDN!6[AKrFR$}7en9v{/w}2i}>10z@0D@5$:W]0!9;8ftpnbK`I[:egZg[d/UV7' );
define( 'SECURE_AUTH_KEY',  '8KE=!PEH?e8LIPcdIm>v*/ 7inQja=@:0B#m,M48WD=$/t>ha:#&.^H/Hdj=Rxtk' );
define( 'LOGGED_IN_KEY',    ':)|+0~b:PD/S/)PGS8!*^U;dYsByRkET3inD~!bda:sSId>($/mc@Uzn?%Tp~X|t' );
define( 'NONCE_KEY',        'I-6z@leh{zM=]blE=HoSp l4r{%^U{3]KjN!($~zsD`{n.&g)T-Q#ivazu:e]6/%' );
define( 'AUTH_SALT',        'hn:o:pZxr?nX!0 +!hNrS0M.M>scM.-#do>E,ELj_H&V M%KC8u`mja8#?v;Jbo+' );
define( 'SECURE_AUTH_SALT', 'k$XbI]&l3q/yAWoJG1utx!wMBz}ndxIaYcMb3!lO(mzCh$6nL@1c&M:RV<8x~.mQ' );
define( 'LOGGED_IN_SALT',   'ycU(5Ye:YYDPB<Y3G4dTVMrHa=G4pj{bKb/dW=^{cL<Qt4&!cRHuQEZV<q~#b4M;' );
define( 'NONCE_SALT',       'pL-]@mt;Wc%8tcQHq>APP_Q%#a18mi@E[,9NsZmElx:ji#sa/:J*L/M< rP~tMW7' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );