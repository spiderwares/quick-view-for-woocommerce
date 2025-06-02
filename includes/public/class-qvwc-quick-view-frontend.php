<?php
if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly.
endif;

if ( ! class_exists( 'QVWC_Quick_View_Frontend' ) ) :

    class QVWC_Quick_View_Frontend {

        /**
         * Holds plugin settings
         *
         * @var array
         */
        protected $settings;
    
        /**
         * Constructor - Initialize the class
         */
        public function __construct() {
            $this->settings = get_option( 'qvwc_quick_view_setting', array() ); // Fetch settings from options table
            $this->event_handler();
        }
    
        /**
         * Register event handlers and hooks
         */
        public function event_handler() { 
            add_action( 'wp_footer', array( $this, 'add_modal' ) );
            add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_dynamic_styles' ) ); // Enqueue styles
            add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_quick_view_assets' ) );
        }

        /**
         * Add Modal to the footer
         */
        public function add_modal() {
            $modal_classes = apply_filters('qvwc_quick_view_modal_classes', 'qvwc-model');
        
            echo sprintf(
                '<div class="%s">
                    <div class="qvwc-model-content"></div>
                </div>',
                esc_attr($modal_classes)
            );
        }
    
        /**
         * Enqueue Dynamic Styles
         */
        public function enqueue_dynamic_styles() {
            // Generate the dynamic styles
            $styles = $this->generate_dynamic_styles();

            if ( ! empty( $styles ) ) :
                $handle = 'qvwc-quick-view';
                if ( ! wp_style_is( $handle, 'registered' ) ) :
                    wp_register_style( $handle, false, array(), QVWC_VERSION );
                    wp_enqueue_style( $handle ); 
                endif;

                wp_add_inline_style( 'qvwc-quick-view', $styles );
            endif;
        }
    
        /**
         * Generate Dynamic Styles based on settings
         *
         * @return string
         */
        public function generate_dynamic_styles() { 
            $general_style  = get_option( 'qvwc_general_setting', array() );
            $wishlist_style = get_option( 'qvwc_wishlist_setting', array() );
            $compare_style  = get_option( 'qvwc_compare_style', array() );
            $shipping_style = get_option( 'qvwc_shipping_bar_settings', array() );

            ob_start();
            wc_get_template( 
                'dynamic-styles.php', 
                array( 
                    'general_style'     => $general_style,
                    'quick_view_style'  => $this->settings,
                    'wishlist_style'    => $wishlist_style,
                    'shipping_style'    => $shipping_style,
                    'compare_style'     => $compare_style,
                ),
                'quickview-for-woocommerce/',
                QVWC_TEMPLATE_PATH
            );
            $output = ob_get_clean();

            return apply_filters( 'qvwc_dynamic_styles', $output, $this->settings );
        }

        /**
         * Enqueue frontend styles and scripts for the Quick View feature.
         */
        public function enqueue_quick_view_assets() {

            wp_enqueue_script( 'wc-add-to-cart-variation' );
            
            wp_enqueue_style( 
                'slick-theme', 
                QVWC_URL . 'assets/css/slick-theme.css', 
                array(), 
                QVWC_VERSION 
            );
        
            wp_enqueue_style( 
                'slick', 
                QVWC_URL . 'assets/css/slick.css', 
                array(), 
                QVWC_VERSION 
            );
        
            // Enqueue Slick Carousel JS (Local Copy)
            wp_enqueue_script( 
                'slick', 
                QVWC_URL . 'assets/js/slick.js', 
                array( 'jquery' ), 
                QVWC_VERSION, 
                true 
            );

            // Enqueue the Quick View JavaScript file
            wp_enqueue_script( 
                'qvwc-quick-view-js', 
                QVWC_URL . 'assets/js/qvwc-quick-view.js', 
                array( 'jquery', 'wc-add-to-cart-variation' ), 
                QVWC_VERSION, 
                true 
            );

            wp_localize_script( 'qvwc-quick-view-js', 'qvwc_vars', array(
                'ajax_url'              => admin_url( 'admin-ajax.php' ),
                'qvwc_nonce'            => wp_create_nonce( 'qvwc_nonce' ),
                'is_user_logged_in'     => is_user_logged_in() ? 1 : 0,
                'quick_view_setting'    => get_option( 'qvwc_quick_view_setting' ),
                'checkout_url'          => wc_get_checkout_url(),
            ) );

            // Enqueue the Quick View CSS file
            wp_enqueue_style( 
                'qvwc-quick-view-style', 
                QVWC_URL . 'assets/css/qvwc-quick-view.css', 
                array(), 
                QVWC_VERSION 
            );
            
        }

    }
    
    new QVWC_Quick_View_Frontend();

endif;