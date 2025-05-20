<?php
/**
 * JThemes Dashboard Class
 *
 * Handles the admin dashboard setup and related functionalities.
 *
 * @package JThemes
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Quick_View_Dashboard' ) ) {

	/**
	 * Class Quick_View_Dashboard
	 *
	 * Initializes the admin dashboard for JThemes.
	 */
	class Quick_View_Dashboard {

		/**
		 * Constructor for Quick_View_Dashboard class.
		 * Initializes the event handler.
		 */
		public function __construct() {
			$this->events_handler();
		}

		/**
		 * Initialize hooks for admin functionality.
		 */
		private function events_handler() {
			add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
			add_action( 'admin_menu', [ $this, 'admin_menu' ] );
		}

		/**
		 * Enqueue admin-specific styles for the dashboard.
		 */
		public function enqueue_scripts() {
			// Enqueue the JThemes dashboard CSS.
			wp_enqueue_style(
				'jthemes-dashboard',
				QVWC_URL . '/assets/css/admin-styles.css',
				[],
				QVWC_VERSION 
			);

			wp_enqueue_style( 'wp-color-picker' );

			wp_enqueue_script(
				'qvwc-admin-js',
				QVWC_URL . '/assets/js/qvwc-admin.js',
				array( 'jquery', 'wp-color-picker' ), // Dependencies
				QVWC_VERSION,
				true // Load in footer
			);
		}

		/**
		 * Add JThemes menu and submenu to the WordPress admin menu.
		 */
		public function admin_menu() {
			// Add the main menu page.
			add_menu_page(
				'JThemes',
				'JThemes',
				'manage_options',
				'jthemes',
				[ $this, 'dashboard_callback' ], 
				'data:image/svg+xml;base64,' . base64_encode( file_get_contents( QVWC_PATH . '/assets/img/qvwc.svg' ) ),
				26
			);

			// Add a submenu page under the main JThemes menu.
			add_submenu_page( 
                'jthemes',
                esc_html__( 'JThemes About', 'product-quickview-for-woocommerce' ), 
                esc_html__( 'About', 'product-quickview-for-woocommerce' ), 
                'manage_options', 
                'jthemes', 
            );

		}

		/**
		 * Callback function for rendering the dashboard content.
		 */
		public function dashboard_callback() {
			// Include the about page view file.
			require_once QVWC_PATH . 'includes/admin/dashboard/views/about.php';
		}

	}

	// Instantiate the Quick_View_Dashboard class.
	new Quick_View_Dashboard();
}
