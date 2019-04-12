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
define( 'DB_NAME', 'internphp_task4' );

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
define( 'AUTH_KEY',         ';SI^C%}S1,0$;C)FgK(*yR2KAiPi*i0tHplqGnQ=]j0If>Ug<dq%O|si{a#n<s<?' );
define( 'SECURE_AUTH_KEY',  ',c(rd4]>_3afl,8*c$[`rqR[j3usulpKm{~HN`_b1Pu{A#8g^@JeAc:.^n3<lzGf' );
define( 'LOGGED_IN_KEY',    'd1D7&:*)<!(+]!o*v72a1D1VCwkm@pB!^X{vKSG]!v5(w-En%+UR. c/oQ>sdal5' );
define( 'NONCE_KEY',        'QQdr/t`O-J73+M[66,!8<Dnkl@0g1`agl2Fl6*xeH|bF4($1x]T~[{X/EO7KXty-' );
define( 'AUTH_SALT',        '!*<ycG0w50EPL`TkvjL/l0Cq0r>pPgN6_%&Aq6eI-]H^>{<|V)]|,E<1V+jK7I)^' );
define( 'SECURE_AUTH_SALT', '1To_iqc4z]oa!T .i@c%nV_5dVnB,uP*=<|W2/|xR*gDUmWXI;MPqNe-r{5Z8Tb:' );
define( 'LOGGED_IN_SALT',   '<KbO2Nddh2p#iDBeV-BR18^7[aB >^i<zpx}Wzx}*GB//2,E|o^Trf48_JCv;)ee' );
define( 'NONCE_SALT',       '>c(UB~T*fA)ZBDsr$9Q54@n~F%Pu!?3%VV$eV#YD#>v5rn,Aq(28f8o6g)R/W#^0' );

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
