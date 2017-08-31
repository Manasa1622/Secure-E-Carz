<?php
if (!session_id())
{
	session_start();
}

//session.cookie_httponly = True;

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
define('DB_NAME', 'ms0943');
/** MySQL database username */
define('DB_USER', 'ms0943');
/** MySQL database password */
define('DB_PASSWORD', 'uc@ntcr@ck!tm@n5560G');
/** MySQL hostname */
define('DB_HOST', 'student-db.cse.unt.edu');
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
define('AUTH_KEY',         'm+7y#H|,XUILEv&uWJ0K,883OA?7BaHf v<=oRkI06Ox6PgGReSKYTr/zV_lAxBb');
define('SECURE_AUTH_KEY',  '`<fYwM2d,GJ|2(MZ F;8nT$mlZLy{1P_6koH;-f)xLFrcRO.]{#Y5bm[c!?ffCHd');
define('LOGGED_IN_KEY',    '?Q |nGm<HKy0|<sMO6g*oZ#7lQ8|yc~DU]fqlw:,-=w)E2FV5[!iQJ!r>bhyL{.-');
define('NONCE_KEY',        'nrb?MD=>MS#WYS}> Yd<p7cP$s1`^ktHbPBRLzJhOgOxnqm3!nueRDL{-gIb6t{#');
define('AUTH_SALT',        '?+tg~^k1%+ qd2}XS^5JOiqD[_>]5gOt]~LmSG@Bq%Smry<=J{GF/oh_bMP3Uo(-');
define('SECURE_AUTH_SALT', 'mXLVnWIG]J:@EHl_c;3@Z[,KG66IIRi,oix%4ZFPOoHpUU(HZDJ:yjdT$#wa3Y=z');
define('LOGGED_IN_SALT',   '2D9Ctb2hfkMhcG0 YG`|%#*>!=K&3$.M<oZ=P;v!cOy.`cjgPiqlU{=JV>[Al%Zt');
define('NONCE_SALT',       '_}L[]3@&|7knpJXP0m_XFUd;l`m),Pu;.1AN~#N2:f7{IlCcm_xuFddVymC=*`{-');
/**#@-*/
/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'sec_';
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
