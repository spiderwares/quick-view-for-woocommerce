<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'QVWC_Admin_Menu' ) ) :

    /**
     * Main QVWC_Admin_Menu Class
     *
     * @class QVWC_Admin_Menu
     * @version     
     */
    final class QVWC_Admin_Menu {

        /**
         * The single instance of the class.
         *
         * @var QVWC_Admin_Menu
         */
        protected static $instance = null;

        /**
         * Constructor for the class.
         * Initializes the event handler (hooks and actions).
         */
        public function __construct() {
            $this->event_handler();
        }

        /**
         * Initialize hooks and filters for the admin menu.
         * This includes the settings registration and filter actions.
         */
        private function event_handler() {
            // Add admin init action to register settings
            add_action( 'admin_init', [ $this, 'register_settings' ] );

            // Add admin menu action to create submenu pages
            add_action( 'admin_menu', [ $this, 'admin_menu' ] );

            // Add filters to modify options before updating
            add_filter( 'pre_update_option_qvwc_general_setting', [ $this, 'filter_data_before_update' ], 10, 3 );
            add_filter( 'pre_update_option_qvwc_shipping_bar_settings', [ $this, 'filter_data_before_update' ], 10, 3 );
            add_filter( 'pre_update_option_qvwc_wishlist_setting', [ $this, 'filter_data_before_update' ], 10, 3 );
            add_filter( 'pre_update_option_qvwc_quick_view_setting', [ $this, 'filter_data_before_update' ], 10, 3 );
        }

        /**
         * Register plugin settings.
         * This is used to register all the settings that will be stored in the options table.
         */
        public function register_settings() {
            // Register settings with a common sanitization function
            $settings = [
                'qvwc_general_setting',
                'qvwc_compare_genral',
                'qvwc_compare_table',
                'qvwc_compare_style',
                'qvwc_compare_premium',
                'qvwc_shipping_bar_settings',
                'qvwc_wishlist_setting',
                'qvwc_quick_view_setting'
            ];
        
            foreach ( $settings as $setting ) :
                register_setting( $setting, $setting, [ 'sanitize_callback' => [ $this, 'sanitize_input' ] ] );
            endforeach;
        }
        
        /**
         * Generic sanitization function for all settings.
         *
         * @param mixed $input The input value to sanitize.
         * @return mixed Sanitized input value.
         */
        public function sanitize_input( $input ) {

            if ( is_array( $input ) ) :
                $sanitized = [];

                foreach ( $input as $key => $value ) :
                    if ( is_array( $value ) ) :
                        $sanitized[ $key ] = $this->sanitize_input( $value );
                    elseif ( strpos( $key, 'textarea' ) !== false || strpos( $key, 'description' ) !== false || strpos( $key, 'content' ) !== false ) :
                        $sanitized[ $key ] = sanitize_textarea_field( $value );
                    else :
                        $sanitized[ $key ] = sanitize_text_field( $value );
                    endif;
                endforeach;
                return $sanitized;
            endif;

            return sanitize_text_field( $input );
        }
      
        

        /**
         * Add submenus to the "Quick View" menu.
         * These submenus allow users to navigate and configure various settings.
         */
        public function admin_menu() {
            // Add Quick View submenu
            add_submenu_page( 
                'jthemes', 
                esc_html__( 'Quick View', 'product-quickview-for-woocommerce' ), 
                esc_html__( 'Quick View', 'product-quickview-for-woocommerce' ), 
                'manage_options', 
                'quick_view', 
                [ $this, 'quick_view_menu_content' ] 
            );
        }


        /**
         * Display content for the Quick View settings page.
         */
        public function quick_view_menu_content() {
            // Get the active tab (default to 'general')
            $active_tab = isset( $_GET['tab'] ) ? sanitize_key( $_GET['tab'] ) : 'general';

            // Include the view file for the Quick View settings page
            require_once QVWC_PATH . 'includes/admin/settings/views/quick-view-menu.php';
        }       

        /**
         * Filter data before updating options in the database.
         *
         * @param mixed  $value     The new value to be updated.
         * @param mixed  $old_value The previous value.
         * @param string $option    The option name.
         *
         * @return mixed The filtered data.
         */
        public function filter_data_before_update( $value, $old_value, $option ) {
            // Merge old value with new value to retain all settings
            $data = array_merge( (array) $old_value, (array) $value );
            return $data;
        }

    }

    // Instantiate the QVWC_Admin_Menu class
    new QVWC_Admin_Menu();

endif;
