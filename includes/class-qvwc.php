<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'QVWC' ) ) :

    /**
     * Main QVWC Class
     *
     * @class QVWC
     * @version 1.0.0
     */
    final class QVWC {

        /**
         * The single instance of the class.
         *
         * @var QVWC
         */
        protected static $instance = null;

        /**
         * Constructor for the class.
         */
        public function __construct() {
            $this->event_handler();
            $this->includes();
        }

        /**
         * Initialize hooks and filters.
         */
        private function event_handler() {
            // Register plugin activation hook
            register_activation_hook( QVWC_FILE, array( __CLASS__, 'install' ) );

            // Hook to install the plugin after plugins are loaded
            add_action( 'plugins_loaded', array( $this, 'etwc_install' ), 11 );
            add_action( 'plugins_loaded', array( $this, 'includes' ), 11 );
        }

        /**
         * Main QVWC Instance.
         *
         * Ensures only one instance of QVWC is loaded or can be loaded.
         *
         * @static
         * @return QVWC - Main instance.
         */
        public static function instance() {
            if ( is_null( self::$instance ) ) :
                self::$instance = new self();
                do_action( 'etwc_plugin_loaded' );
            endif;
            return self::$instance;
        }

        /**
         * Function to display admin notice if WooCommerce is not active.
         */
        public function woocommerce_admin_notice() {
            ?>
            <div class="error">
                <p><?php esc_html_e( 'Quick View For WooCommerce requires WooCommerce to work.', 'product-quickview-for-woocommerce' ); ?></p>
            </div>
            <?php
        }

        /**
         * Display admin notice if Essential Kit For WooCommerce is active.
         */
        public function essential_kit_active_notice() {
            ?>
            <div class="notice notice-error">
                <p><?php esc_html_e( 'Quick View For WooCommerce plugin is already included in Essential Kit For WooCommerce plugin. Please deactivate the Product Compare plugin to avoid conflicts.', 'product-quickview-for-woocommerce' ); ?></p>
            </div>
            <?php
        }

        /**
         * Function to initialize the plugin after WooCommerce is loaded.
         */
        public function etwc_install() {
            if ( ! function_exists( 'WC' ) ) :
                add_action( 'admin_notices', array( $this, 'woocommerce_admin_notice' ) );
            elseif ( class_exists( 'EKWC' ) ) :
                // Essential Kit For WooCommerce is active.
                add_action( 'admin_notices', array( $this, 'essential_kit_active_notice' ) );
            else :
                do_action( 'qvwc_init' );
            endif;
        }

        /**
         * Include required files.
         */
        public function includes() {
            require_once QVWC_PATH . 'includes/public/class-qvwc-quick-view-ajax-handler.php';
            if( is_admin() ) :
                $this->includes_admin();
            else :
                $this->includes_public();
            endif;
        }

        /**
         * Include Admin required files.
         */
        public function includes_admin() {
            require_once QVWC_PATH . 'includes/class-qvwc-install.php';
            require_once QVWC_PATH . 'includes/admin/dashboard/class-quick-view-dashboard.php';
            require_once QVWC_PATH . 'includes/admin/settings/class-qvwc-admin-menu.php';
        }

        /**
         * Include Public required files.
         */
        public function includes_public(){
            require_once QVWC_PATH . 'includes/public/class-qvwc-quick-view-frontend.php';
            require_once QVWC_PATH . 'includes/public/class-qvwc-general.php';
        }

        /**
         * Install the plugin tables.
         */
        public static function install() {
            self::default_data();
        }

        /**
         * Execute function on plugin activation
         */
        public static function default_data() {

            $defaultOptions = require_once QVWC_PATH . '/includes/static/qvwc-default-options.php';
            foreach ( $defaultOptions as $optionKey => $option ) :
                $existingOption = get_option( $optionKey );
                if ( ! $existingOption ) :
                    update_option( $optionKey, $option );
                endif;
            endforeach;
            
        }

    }
endif;