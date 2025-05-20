<?php
/**
 * Plugin Name:       Product Quickview For Woocommerce
 * Description:       Add a quick view feature to your WooCommerce store, allowing customers to preview product details in a popup without leaving the current page.
 * Version:           1.0.0 
 * Requires at least: 5.2
 * Requires PHP:      7.4
 * Author:            SpiderWares
 * Author URI:        https://spiderwares.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Requires Plugins:  woocommerce
 * Text Domain:       product-quickview-for-woocommerce
 *
 * @package Product Quickview For Woocommerce
 */

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'QVWC_FILE' ) ) :
    define( 'QVWC_FILE', __FILE__ ); // Define the plugin file path.
endif;

if ( ! defined( 'QVWC_BASENAME' ) ) :
    define( 'QVWC_BASENAME', plugin_basename( QVWC_FILE ) ); // Define the plugin basename.
endif;

if ( ! defined( 'QVWC_VERSION' ) ) :
    define( 'QVWC_VERSION', time() ); // Define the plugin version.
endif;

if ( ! defined( 'QVWC_PATH' ) ) :
    define( 'QVWC_PATH', plugin_dir_path( __FILE__ ) ); // Define the plugin directory path.
endif;

if ( ! defined( 'QVWC_TEMPLATE_PATH' ) ) :
	define( 'QVWC_TEMPLATE_PATH', plugin_dir_path( __FILE__ ) . '/templates/' ); // Define the plugin directory path.
endif;

if ( ! defined( 'QVWC_URL' ) ) :
    define( 'QVWC_URL', plugin_dir_url( __FILE__ ) ); // Define the plugin directory URL.
endif;

if ( ! defined( 'QVWC_REVIEWS' ) ) :
    define( 'QVWC_REVIEWS', 'https://spiderwares.com/' ); // Define the plugin directory URL.
endif;

if ( ! defined( 'QVWC_CHANGELOG' ) ) :
    define( 'QVWC_CHANGELOG', 'https://spiderwares.com/' ); // Define the plugin directory URL.
endif;

if ( ! defined( 'QVWC_DISCUSSION' ) ) :
    define( 'QVWC_DISCUSSION', 'https://spiderwares.com/' ); // Define the plugin directory URL.
endif;

if ( ! defined( 'QVWC_UPGRADE_URL' ) ) :
    define( 'QVWC_UPGRADE_URL', 'https://spiderwares.com/' ); // Define the upgrade URL.
endif;

if ( ! defined( 'QVWC_PRO_VERSION_URL' ) ) :
    define( 'QVWC_PRO_VERSION_URL', 'https://spiderwares.com/' ); // Define the Pro Version URL.
endif;

if ( ! class_exists( 'QVWC', false ) ) :
    include_once QVWC_PATH . 'includes/class-qvwc.php';
endif;

$GLOBALS['qvwc'] = QVWC::instance();
