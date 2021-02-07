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
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '9vaxRo7g/HUmxXMFoHur2toqA//9hjBOSTXwlu809ae+Hmwc0qPaFHKLCv9F8BmN8pxcsxZgUMK575uFpRKCoQ==');
define('SECURE_AUTH_KEY',  'a97Ja/tYUPOazqaQtLLkYzkuEsi8iwgLcjfmH248waOdF+DAgiFbJBsGdEmNV3lP3vFIX+vGcG8DBIzTsi0dJQ==');
define('LOGGED_IN_KEY',    'EIN0R2cakGktzvZbNpAaXQizEb6TOqrUAmhxG2EKgYlrsJNYm4BTmEmhdypF6FYEbR964T3LCy1ubyP8oCjJ8A==');
define('NONCE_KEY',        'szzOW/IPby1r90isB186DDOvAaKptJ2ZJrhTPF1phQN5JMhMZX1Asdv3i4zSs7aZdXGwT2iMF4GW+XD5iu0pBg==');
define('AUTH_SALT',        '5tSQgMXSS9tXpQjcRcZgqIQJuHVqA76+CZyWDPvgXNHoT4xUanf1sUGIG3HCF7RDYo75GQNQu1mlR7LGwD9MOw==');
define('SECURE_AUTH_SALT', '6TXg7i36H47azlMWTGe8jkff4dcEdVVPi2IWCBAf8xhopUyzmZTOt9wZjgPkiDr8ETR+B9kFRVgEVonnxLqLbQ==');
define('LOGGED_IN_SALT',   'lztB3EuWQVspIsy/ostl7dJMHwahgL9VIKeIQTBY7drYNowrVMiAONFBRj5H/xKOWdWO2LZ+4/b5wqZJSgCAKg==');
define('NONCE_SALT',       '8S5zqRKwnACjcBoUFh6pghJLn6uK14waBSJAPeZ8mS3oLEkYIF4+gOma7jT5ia55eT8ybXgTJoT4OIjSrxm8lQ==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
