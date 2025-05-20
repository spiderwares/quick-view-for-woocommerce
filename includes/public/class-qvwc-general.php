<?php
if ( ! defined( 'ABSPATH' ) ) :
    exit;
endif;

/**
 * Class QVWC_Genral
 * Handles general settings and product icons display for the Quick View for WooCommerce plugin.
 */
if ( ! class_exists( 'QVWC_Genral' ) ) :

    class QVWC_Genral {

        /**
         * Quick View settings options.
         *
         * @var array
         */
        private $setting;


        /**
         * Constructor to initialize class properties and add action hooks.
         */
        public function __construct() {
            global $wpdb;
            $this->setting          = get_option( 'qvwc_quick_view_setting', [] );
            $this->event_handler();
        }

        public function event_handler(){
            $enable                     = isset( $this->setting['enable'] ) && 'yes' === $this->setting['enable'];
            $single_position            = isset($this->setting['single_position']) ? $this->setting['single_position'] : 'woocommerce_product_thumbnails-0';
            $shop_position              = isset($this->setting['shop_position']) ? $this->setting['shop_position'] : 'woocommerce_before_shop_loop_item-10';
            $single_hook                = ! empty( $single_position ) ? explode( '-', $single_position ) : array();
            $shop_hook                  = ! empty( $shop_position ) ? explode( '-', $shop_position ) : array();
            
        
            // If no icons are enabled, stop execution
            if ( ! $enable ) :
                return;
            endif;

            if ( is_array( $single_hook ) ) :
                $single_priority    = isset( $single_hook[1] ) ? $single_hook[1] : 10;
                $single_hookname    = isset( $single_hook[0] ) ? $single_hook[0] : 'disable';
                
                if($single_hookname == 'woocommerce_product_thumbnails' ):
                    add_action( $single_hookname, array( $this, 'display_icons_on_product_image' ), $single_priority );
                else:
                    add_action( $single_hookname, array( $this, 'quick_view_buttons' ), $single_priority );
                endif;
            endif;

            
            if ( is_array( $shop_hook ) ) :
                $shop_priority           = isset( $shop_hook[1] ) ? $shop_hook[1] : 10;
                $shop_hookname      = isset( $shop_hook[0] ) ? $shop_hook[0] : 'disable';
                
                if( $shop_hookname == 'woocommerce_before_shop_loop_item' ):
                    add_action( $shop_hookname, array( $this, 'display_icons_on_product_image' ), $shop_priority );
                else:
                    add_action( $shop_hookname, array( $this, 'quick_view_buttons' ), $shop_priority );
                endif;
            endif;
        }

        /**
         * Display icons (Compare, Wishlist, Quick View) on product images.
         */
        public function display_icons_on_product_image() {
            global $product, $wp_query;
        
            // Check if the product exists
            if ( ! $product ) :
                return;
            endif;
        
            // Check if this is the main single product (not a related product)
            $is_main_product        = is_product() && isset( $wp_query->queried_object_id ) && $wp_query->queried_object_id === $product->get_id();
            $is_in_loop             = wc_get_loop_prop('name') ? true : false;
            $icon_position_loop     = isset( $this->setting['icon_position_loop'] ) ? $this->setting['icon_position_loop'] : 'top-right';
            $icon_position_single   = isset( $this->setting['icon_position_single'] ) ? $this->setting['icon_position_single'] : 'top-right';
            $display_type           = isset( $this->setting['icon_display_type'] ) ? $this->setting['icon_display_type'] : 'fixed';
            $loader_image_url       = get_admin_url() . 'images/spinner.gif'; // Dynamically get the admin URL for the loader image
        
            // Set class based on location
            if ( $is_main_product ) :
                $container_class = 'qvwc-single-product-icons';  // Main product page
                $icon_position   = $icon_position_single ;
            else :
                $container_class = 'qvwc-loop-product-icons';  // Related products / Loop
                $icon_position   = $icon_position_loop .' '. $display_type;
            endif;
        
            // Get the product ID
            $product_id = $product->get_id();
        
            echo '<div class="qvwc-product-icons-container ' . esc_attr( $container_class . ' ' . $icon_position ) . '">';
                // Display Quick View icon only in loops !$is_main_product && 
                if ( isset( $this->setting['enable'] ) && 'yes' === $this->setting['enable'] ) :
                    echo '<div class="qvwc-quick-view-icon qvwc-quick-view" data-product_id="' . esc_attr( $product_id ) . '">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="view" height="24px" width="24px">
                                    <path d="M12 5C7.064 5 3.308 8.058 1 12c2.308 3.942 6.064 7 11 7s8.693-3.058 11-7c-2.307-3.942-6.065-7-11-7zm0 12c-4.31 0-7.009-2.713-8.624-5C4.991 9.713 7.69 7 12 7c4.311 0 7.01 2.713 8.624 5-1.614 2.287-4.313 5-8.624 5z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                                <img class="qvwc-loader" style="display: none;" src="' . esc_url( $loader_image_url ) . '" alt="Loading...">
                            </div>';
                endif;        
            echo '</div>';
        }


        /**
         * Check if Quick View is enabled on mobile
         *
         * @return bool
         */
        public function is_quick_view_enabled_on_mobile() {
            return isset( $this->setting['enable_on_mobile'] ) && $this->setting['enable_on_mobile'] === 'yes';
        }

        /**
         * Display Quick View button on product pages
         */
        public function quick_view_btn( $product_id ) {
            if ( wp_is_mobile() && ! $this->is_quick_view_enabled_on_mobile() ) :
                return;
            endif;

            $button_label = isset( $this->setting['quick_view_button_label'] ) 
                ? esc_html( $this->setting['quick_view_button_label'] ) 
                : esc_html__( 'Quick View', 'product-quickview-for-woocommerce' );

            $html = sprintf(
                '<button class="qvwc-quick-view" data-product_id="%d">%s <span class="qvwc-loader"></span></button>',
                esc_attr( $product_id ),
                esc_html( $button_label )
            );

            echo wp_kses_post( $html );
        }

        /**
         * Display Quick View buttons (Compare, Quick View, Wishlist) on product pages.
         */
        public function quick_view_buttons() {
            global $product;

            $product_id = $product->get_id();

            // Display Quick View button if the Quick View feature is enabled.
            if ( isset( $this->setting['enable'] ) && 'yes' === $this->setting['enable'] ) :
                $this->quick_view_btn( $product_id );
            endif;

        }

    }

    // Initialize the class.
    new QVWC_Genral();

endif;