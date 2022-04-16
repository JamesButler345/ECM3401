
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
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'wordpressuser' );

/** Database password */
define( 'DB_PASSWORD', 'LifeWordpressuser18!' );

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

define('AUTH_KEY',         'CUf/|vF~v=tjF6]g^a<;}:,}Lj}#s iovu2Q!=aocaMEt;&/FXcc?MF1Q|,Q%-L*');
define('SECURE_AUTH_KEY',  'Kbt*>;C!%a+lfVc+<?BjV}vimS9rjm%cVI|zm48)W3R(@jDp9|PN-nEg87ZS4p!W');
define('LOGGED_IN_KEY',    '[ml07;Y#Bqp8&l{sM8M<V-/6TeLZx&vG3D+Sbv+&;8aS&>eQe@xq)g|FEJbMn0N7');
define('NONCE_KEY',        'P4@|&P+j+j_p>(xa|a+bh/.QY|dN$+;<P]# T7#b<FAA>k||FUHaw)Gl 13+Y=No');
define('AUTH_SALT',        'YXaIg!7d/+@DAAA%J2ysbvWL63vS!V)`-,bDH]niD:3jU+p}.q<vjdLZ7[CG6ME4');
define('SECURE_AUTH_SALT', 'd&W}q-g|kgb^qCO(%DV;?`N%diH2Z.l@)5YdY+R$?wwRomF{y^2d38KTp`4:iS(I');
define('LOGGED_IN_SALT',   '?%*HXQZL|TEYj1)[,Zfo|S.-f:ZP6~GXk~ewUbl=W2-brB-^ &Z48.F%F}QAi?A^');
define('NONCE_SALT',       'k,Z.db6WR6`OG1u/s|{YjHBUL80r%pRPnD8)Xd?5svG|s+K%ukxx`syHLbP-y@&|');

/**#@-*/

@ini_set( 'upload_max_size' , '4M' );
@ini_set( 'post_max_size', '4M');
@ini_set( 'max_execution_time', '300' );

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
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true);


/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
