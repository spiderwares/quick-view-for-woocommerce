<?php
defined('ABSPATH') || exit;  // Exit if accessed directly

if( ! class_exists( 'QVWC_Quick_View_Admin_Settings' ) ):

    /**
     * Class QVWC_Quick_View_Admin_Settings
     * Admin settings for the quick view feature.
     */
    class QVWC_Quick_View_Admin_Settings {

        /**
         * General settings for Quick View.
         *
         * @return array Fields for Quick View settings.
         */
        public static function general_field() {
            $fields = array(
                'enable' => array(
                    'title'      => esc_html__( 'Enable Quick View', 'product-quickview-for-woocommerce' ),
                    'field_type' => 'qvwcswitch',
                    'default'    => 'yes',
                    'name'       => 'qvwc_quick_view_setting[enable]',
                    'desc'       => esc_html__( 'Enable Quick View For WooCommerce.', 'product-quickview-for-woocommerce' ),
                ),
                'enable_on_mobile' => array(
                    'title'      => esc_html__( 'Enable Quick View on mobile', 'product-quickview-for-woocommerce' ),
                    'field_type' => 'qvwcswitch',
                    'default'    => 'yes',
                    'name'       => 'qvwc_quick_view_setting[enable_on_mobile]',
                    'desc'       => esc_html__( 'Enable Quick View on mobile devices.', 'product-quickview-for-woocommerce' ),
                ),

                'single_page_setting' => array(
                    'title'      => esc_html__( 'Single Page Setting', 'product-quickview-for-woocommerce' ),
                    'field_type' => 'qvwctitle',
                    'default'    => '',
                ),
                'single_position' => array(
                    'title'      => esc_html__( 'Display Position On Single Page', 'product-quickview-for-woocommerce' ),
                    'field_type' => 'qvwcselect',
                    'default'    => 'woocommerce_product_thumbnails-0',
                    'name'       => 'qvwc_quick_view_setting[single_position]',
                    'options'    => array(
                        'disable-0'                                     => esc_html__('Disable Button/Icon', 'product-quickview-for-woocommerce' ), 
                        'woocommerce_product_thumbnails-0'              => esc_html__( 'Over The Image', 'product-quickview-for-woocommerce' ),
                        'woocommerce_before_single_product_summary-0'   => esc_html__( 'Top of Product Page', 'product-quickview-for-woocommerce' ), 
                        'woocommerce_single_product_summary-0'          => esc_html__( 'Before Product Title', 'product-quickview-for-woocommerce' ), 
                        'woocommerce_single_product_summary-6'          => esc_html__( 'After Product Title', 'product-quickview-for-woocommerce' ), 
                        'woocommerce_before_add_to_cart_form-10'        => esc_html__( 'After Short Description', 'product-quickview-for-woocommerce' ), 
                        'woocommerce_before_add_to_cart_quantity-10'    => esc_html__( 'Before Quantity Input Field', 'product-quickview-for-woocommerce' ), 
                        'woocommerce_after_add_to_cart_quantity-10'     => esc_html__( 'After Quantity Input Field', 'product-quickview-for-woocommerce' ), 
                        'woocommerce_before_add_to_cart_button-10'      => esc_html__( 'Before Add to Cart Button', 'product-quickview-for-woocommerce' ), 
                        'woocommerce_after_add_to_cart_button-10'       => esc_html__( 'After Add to Cart Button', 'product-quickview-for-woocommerce' ), 
                        'woocommerce_product_meta_end-10'               => esc_html__( 'After Product Meta Information', 'product-quickview-for-woocommerce' ), 
                    ),
                    'data_hide'  => '.single_position_option',
                    'desc'       => esc_html__( 'Choose how Button/Icon Position on single page.', 'product-quickview-for-woocommerce' ),
                ),
                'icon_position_single' => array(
                    'title'      => esc_html__( 'Icon Position in Single Page', 'product-quickview-for-woocommerce' ),
                    'field_type' => 'qvwcselect',
                    'default'    => 'top-right',
                    'name'       => 'qvwc_quick_view_setting[icon_position_single]',
                    'options'    => array(
                        'top-left'     => esc_html__( 'Top Left', 'product-quickview-for-woocommerce' ),
                        'top-right'    => esc_html__( 'Top Right', 'product-quickview-for-woocommerce' ),
                        'bottom-left'  => esc_html__( 'Bottom Left', 'product-quickview-for-woocommerce' ),
                        'bottom-right' => esc_html__( 'Bottom Right', 'product-quickview-for-woocommerce' ),
                    ),
                    'style'      => 'single_position.woocommerce_product_thumbnails-0',
                    'extra_class'=> 'single_position_option woocommerce_product_thumbnails-0',
                    'desc'       => esc_html__( 'Choose the position of icons on the single product page.', 'product-quickview-for-woocommerce' ),
                ),

                'shop_archive_page_setting' => array(
                    'title'      => esc_html__( 'Shop / Archive Page Setting', 'product-quickview-for-woocommerce' ),
                    'field_type' => 'qvwctitle',
                    'default'    => '',
                ),
                'shop_position' => array(
                    'title'      => esc_html__( 'Display Position On Shop Page', 'product-quickview-for-woocommerce' ),
                    'field_type' => 'qvwcselect',
                    'default'    => 'woocommerce_before_shop_loop_item-10',
                    'name'       => 'qvwc_quick_view_setting[shop_position]',
                    'options'    => array(
                        'disable-0'                                 => esc_html__( 'Disable Button/Icon', 'product-quickview-for-woocommerce' ),
                        'woocommerce_before_shop_loop_item-10'      => esc_html__( 'Over The Image', 'product-quickview-for-woocommerce' ),
                        'woocommerce_shop_loop_item_title-10'       => esc_html__( 'After Featured Image/Before Title', 'product-quickview-for-woocommerce' ),
                        'woocommerce_after_shop_loop_item_title-0'  => esc_html__( 'After Title', 'product-quickview-for-woocommerce' ),
                        'woocommerce_after_shop_loop_item-1'        => esc_html__( 'Before Add to Cart', 'product-quickview-for-woocommerce' ),
                        'woocommerce_after_shop_loop_item-20'       => esc_html__( 'After Add to Cart', 'product-quickview-for-woocommerce' ),
                    ),
                    'data_hide'  => '.shop_position_option',
                    'desc'       => esc_html__( 'Choose how Button/Icon Position on single and archive page.', 'product-quickview-for-woocommerce' ),
                ),
                'icon_display_type' => array(
                    'title'      => esc_html__( 'Icon Display Type', 'product-quickview-for-woocommerce' ),
                    'field_type' => 'qvwcselect',
                    'default'    => 'fixed',
                    'name'       => 'qvwc_quick_view_setting[icon_display_type]',
                    'options'    => array(
                        'fixed' => esc_html__( 'Fixed', 'product-quickview-for-woocommerce' ),
                        'hover' => esc_html__( 'On Hover', 'product-quickview-for-woocommerce' ),
                    ),
                    'style'      => 'shop_position.woocommerce_before_shop_loop_item-10',
                    'extra_class'=> 'shop_position_option woocommerce_before_shop_loop_item-10',
                    'desc'       => esc_html__( 'Choose how icons should appear on product images.', 'product-quickview-for-woocommerce' ),
                ),
                'icon_position_shop' => array(
                    'title'      => esc_html__( 'Icon Position in Shop', 'product-quickview-for-woocommerce' ),
                    'field_type' => 'qvwcselect',
                    'default'    => 'top-right',
                    'name'       => 'qvwc_quick_view_setting[icon_position_shop]',
                    'options'    => array(
                        'top-left'     => esc_html__( 'Top Left', 'product-quickview-for-woocommerce' ),
                        'top-right'    => esc_html__( 'Top Right', 'product-quickview-for-woocommerce' ),
                    ),
                    'style'      => 'shop_position.woocommerce_before_shop_loop_item-10',
                    'extra_class'=> 'shop_position_option woocommerce_before_shop_loop_item-10',
                    'desc'       => esc_html__( 'Choose the position of icons in product loops (shop, category pages).', 'product-quickview-for-woocommerce' ),
                ),



                'other_setting' => array(
                    'title'      => esc_html__( 'Other Setting', 'product-quickview-for-woocommerce' ),
                    'field_type' => 'qvwctitle',
                    'default'    => '',
                ),
                'product_description' => array(
                    'title'      => esc_html__( 'Product Description', 'product-quickview-for-woocommerce' ),
                    'field_type' => 'qvwcselect',
                    'default'    => 'short',
                    'name'       => 'qvwc_quick_view_setting[product_description]',
                    'options'    => array(
                        'short' => esc_html__( 'Show short description', 'product-quickview-for-woocommerce' ),
                        'full'  => esc_html__( 'Show full description', 'product-quickview-for-woocommerce' ),
                    ),
                    'desc'       => esc_html__( 'Choose whether to display the short or full product description in Quick View.', 'product-quickview-for-woocommerce' ),
                ),
                'product_image_dimensions' => array(
                    'title'      => esc_html__( 'Product Image Dimensions', 'product-quickview-for-woocommerce' ),
                    'field_type' => 'qvwcsize',
                    'default'    => array(
                        'width'  => 300,
                        'height' => 300,
                    ),
                    'name'       => 'qvwc_quick_view_setting[product_image_dimensions]',
                    'desc'       => esc_html__( 'Set the dimensions for the product image in Quick View.', 'product-quickview-for-woocommerce' ),
                ),
                'quick_view_style' => array(
                    'title'      => esc_html__( 'Quick View Style', 'product-quickview-for-woocommerce' ),
                    'field_type' => 'qvwcbuypro',
                    'pro_link'   => QVWC_PRO_VERSION_URL,
                    'description'=> esc_html__( 'Get the Pro version to enable the Quick View style', 'product-quickview-for-woocommerce' ),
                    'default'    => 'no',
                ),
                'quick_view_button_label' => array(
                    'title'      => esc_html__( 'Quick View Button Label', 'product-quickview-for-woocommerce' ),
                    'field_type' => 'qvwctext',
                    'default'    => esc_html__( 'Quick View', 'product-quickview-for-woocommerce' ),
                    'name'       => 'qvwc_quick_view_setting[quick_view_button_label]',
                    'desc'       => esc_html__( 'Customize the label of the Quick View button.', 'product-quickview-for-woocommerce' ),
                ),
            );
            
            return apply_filters( 'qvwc_quick_view_general_fields', $fields );
        }
        
        /**
         * Style settings for Quick View.
         *
         * @return array Fields for Quick View style settings.
         */
        public static function style_field() {
            $fields = array(
                'quick_view_section' => array(
                    'title'      => esc_html__('Quick View', 'product-quickview-for-woocommerce'),
                    'field_type' => 'qvwctitle',
                    'default'    => '',
                ),
                'content_background' => array(
                    'title'      => esc_html__('Content Background', 'product-quickview-for-woocommerce'),
                    'field_type' => 'qvwccolor',
                    'name'       => 'qvwc_quick_view_setting[content_background]',
                    'default'    => '#ffffff',
                ),
                'overlay_color' => array(
                    'title'      => esc_html__('Overlay Color', 'product-quickview-for-woocommerce'),
                    'field_type' => 'qvwccolor',
                    'name'       => 'qvwc_quick_view_setting[overlay_color]',
                    'default'    => '#000000',
                ),
                'overlay_opacity' => array(
                    'title'      => esc_html__('Overlay Opacity', 'product-quickview-for-woocommerce'),
                    'field_type' => 'qvwcnumber',
                    'name'       => 'qvwc_quick_view_setting[overlay_opacity]',
                    'default'    => '0.5',
                    'min'        => '0',
                    'max'        => '1',
                    'step'       => '0.1',
                ),
                'close_icon_section' => array(
                    'title'      => esc_html__('Close Icon', 'product-quickview-for-woocommerce'),
                    'field_type' => 'qvwctitle',
                    'default'    => '',
                ),
                'close_icon_color' => array(
                    'title'      => esc_html__('Color', 'product-quickview-for-woocommerce'),
                    'field_type' => 'qvwccolor',
                    'name'       => 'qvwc_quick_view_setting[close_icon_color]',
                    'default'    => '#cdcdcd',
                ),
                'close_icon_hover' => array(
                    'title'      => esc_html__('Color Hover', 'product-quickview-for-woocommerce'),
                    'field_type' => 'qvwccolor',
                    'name'       => 'qvwc_quick_view_setting[close_icon_hover]',
                    'default'    => '#ff0000',
                ),
                'quick_view_button_section' => array(
                    'title'      => esc_html__('Quick View Button', 'product-quickview-for-woocommerce'),
                    'field_type' => 'qvwctitle',
                    'default'    => '',
                ),
                'button_bg_color' => array(
                    'title'      => esc_html__('Background Color', 'product-quickview-for-woocommerce'),
                    'field_type' => 'qvwccolor',
                    'name'       => 'qvwc_quick_view_setting[button_bg_color]',
                    'default'    => '#000000',
                ),
                'button_bg_hover' => array(
                    'title'      => esc_html__('Background Hover', 'product-quickview-for-woocommerce'),
                    'field_type' => 'qvwccolor',
                    'name'       => 'qvwc_quick_view_setting[button_bg_hover]',
                    'default'    => '#000000',
                ),
                'button_text_color' => array(
                    'title'      => esc_html__('Text Color', 'product-quickview-for-woocommerce'),
                    'field_type' => 'qvwccolor',
                    'name'       => 'qvwc_quick_view_setting[button_text_color]',
                    'default'    => '#ffffff',
                ),
                'button_text_hover' => array(
                    'title'      => esc_html__('Text Hover', 'product-quickview-for-woocommerce'),
                    'field_type' => 'qvwccolor',
                    'name'       => 'qvwc_quick_view_setting[button_text_hover]',
                    'default'    => '#ffffff',
                ),
                'content_section' => array(
                    'title'      => esc_html__('Content style', 'product-quickview-for-woocommerce'),
                    'field_type' => 'qvwctitle',
                    'default'    => '',
                ),
                'main_text_color' => array(
                    'title'      => esc_html__( 'Main Text Color', 'product-quickview-for-woocommerce' ),
                    'field_type' => 'qvwcbuypro',
                    'pro_link'   => QVWC_PRO_VERSION_URL,
                    'description'=> esc_html__( 'Get the Pro version to enable Main Text Color', 'product-quickview-for-woocommerce' ),
                    'default'    => 'no',
                ),

                'star_color' => array(
                    'title'      => esc_html__( 'Star Color', 'product-quickview-for-woocommerce' ),
                    'field_type' => 'qvwcbuypro',
                    'pro_link'   => QVWC_PRO_VERSION_URL,
                    'description'=> esc_html__( 'Get the Pro version to enable Star Color', 'product-quickview-for-woocommerce' ),
                    'default'    => 'no',
                ),

                'add_to_cart_btn_bg_color' => array(
                    'title'      => esc_html__( 'Add to Cart Button Background Color', 'product-quickview-for-woocommerce' ),
                    'field_type' => 'qvwcbuypro',
                    'pro_link'   => QVWC_PRO_VERSION_URL,
                    'description'=> esc_html__( 'Get the Pro version to enable Add to Cart Button Background Color', 'product-quickview-for-woocommerce' ),
                    'default'    => 'no',
                ),

                'add_to_cart_btn_bg_hover_color' => array(
                    'title'      => esc_html__( 'Add to Cart Button Background Hover Color', 'product-quickview-for-woocommerce' ),
                    'field_type' => 'qvwcbuypro',
                    'pro_link'   => QVWC_PRO_VERSION_URL,
                    'description'=> esc_html__( 'Get the Pro version to enable Add to Cart Button Background Hover Color', 'product-quickview-for-woocommerce' ),
                    'default'    => 'no',
                ),

                'add_to_cart_text_color' => array(
                    'title'      => esc_html__( 'Add to Cart Text Color', 'product-quickview-for-woocommerce' ),
                    'field_type' => 'qvwcbuypro',
                    'pro_link'   => QVWC_PRO_VERSION_URL,
                    'description'=> esc_html__( 'Get the Pro version to enable Add to Cart Text Color', 'product-quickview-for-woocommerce' ),
                    'default'    => 'no',
                ),

                'add_to_cart_text_hover_color' => array(
                    'title'      => esc_html__( 'Add to Cart Text Hover Color', 'product-quickview-for-woocommerce' ),
                    'field_type' => 'qvwcbuypro',
                    'pro_link'   => QVWC_PRO_VERSION_URL,
                    'description'=> esc_html__( 'Get the Pro version to enable Add to Cart Text Hover Color', 'product-quickview-for-woocommerce' ),
                    'default'    => 'no',
                ),

            );
            
            return apply_filters('qvwc_quick_view_style_fields', $fields);
        }

        /**
         * Advanced settings for Quick View.
         *
         * @return array Fields for Quick View advanced settings.
         */
        public static function advance_field() {

            $fields = array(
                'show_product_image' => array(
                    'title'      => esc_html__( 'Show Product Image', 'product-quickview-for-woocommerce' ),
                    'field_type' => 'qvwcbuypro',
                    'pro_link'   => QVWC_PRO_VERSION_URL,
                    'default'    => 'no',
                    'desc'       => esc_html__( 'Enable to show product images in the wishlist.', 'product-quickview-for-woocommerce' ),
                ),
                'show_product_name' => array(
                    'title'      => esc_html__( 'Show Product Name', 'product-quickview-for-woocommerce' ),
                    'field_type' => 'qvwcbuypro',
                    'pro_link'   => QVWC_PRO_VERSION_URL,
                    'default'    => 'no',
                    'desc'       => esc_html__( 'Enable to show product names in the wishlist.', 'product-quickview-for-woocommerce' ),
                ),
                'show_product_rating' => array(
                    'title'      => esc_html__( 'Show Product Rating', 'product-quickview-for-woocommerce' ),
                    'field_type' => 'qvwcbuypro',
                    'pro_link'   => QVWC_PRO_VERSION_URL,
                    'default'    => 'no',
                    'desc'       => esc_html__( 'Enable to display product ratings in the wishlist.', 'product-quickview-for-woocommerce' ),
                ),
                'show_product_price' => array(
                    'title'      => esc_html__( 'Show Product Price', 'product-quickview-for-woocommerce' ),
                    'field_type' => 'qvwcbuypro',
                    'pro_link'   => QVWC_PRO_VERSION_URL,
                    'default'    => 'no',
                    'desc'       => esc_html__( 'Enable to display product prices in the wishlist.', 'product-quickview-for-woocommerce' ),
                ),
                'show_add_to_cart' => array(
                    'title'      => esc_html__( 'Show "Add to Cart" Button', 'product-quickview-for-woocommerce' ),
                    'field_type' => 'qvwcbuypro',
                    'pro_link'   => QVWC_PRO_VERSION_URL,
                    'default'    => 'no',
                    'desc'       => esc_html__( 'Enable to show the "Add to Cart" button for wishlist items.', 'product-quickview-for-woocommerce' ),
                ),
                'show_product_meta' => array(
                    'title'      => esc_html__( 'Show Product Meta', 'product-quickview-for-woocommerce' ),
                    'field_type' => 'qvwcbuypro',
                    'pro_link'   => QVWC_PRO_VERSION_URL,
                    'default'    => 'no',
                    'desc'       => esc_html__( 'Enable to show additional product meta information in the wishlist.', 'product-quickview-for-woocommerce' ),
                ),
                'button_section' => array(
                    'title'      => esc_html__('After Add to Cart Action', 'product-quickview-for-woocommerce'),
                    'field_type' => 'qvwctitle',
                    'default'    => '',
                ),
                'close_popup_after_add_to_cart' => array(
                    'title'      => esc_html__( 'Close Popup After Adding to Cart', 'product-quickview-for-woocommerce' ),
                    'field_type' => 'qvwcbuypro',
                    'pro_link'   => QVWC_PRO_VERSION_URL,
                    'default'    => 'no',
                    'desc'       => esc_html__( 'Enable to automatically close the popup after adding a product to the cart.', 'product-quickview-for-woocommerce' ),
                ),
                'redirect_to_checkout_after_add_to_cart' => array(
                    'title'      => esc_html__( 'Redirect to Checkout After Adding to Cart', 'product-quickview-for-woocommerce' ),
                    'field_type' => 'qvwcbuypro',
                    'pro_link'   => QVWC_PRO_VERSION_URL,
                    'default'    => 'no',
                    'desc'       => esc_html__( 'Enable to redirect users to checkout after adding a product to the cart.', 'product-quickview-for-woocommerce' ),
                ),
                'sharing_section' => array(
                    'title'      => esc_html__('Sharing options', 'product-quickview-for-woocommerce'),
                    'field_type' => 'qvwctitle',
                    'default'    => '',
                ),
                'enable_facebook_share' => array(
                    'title'      => esc_html__( 'Enable Facebook Share', 'product-quickview-for-woocommerce' ),
                    'field_type' => 'qvwcbuypro',
                    'pro_link'   => QVWC_PRO_VERSION_URL,
                    'default'    => 'no',
                    'desc'       => esc_html__( 'Enable to allow sharing wishlists on Facebook.', 'product-quickview-for-woocommerce' ),
                ),
                'enable_x_share' => array(
                    'title'      => esc_html__( 'Enable X (Twitter) Share', 'product-quickview-for-woocommerce' ),
                    'field_type' => 'qvwcbuypro',
                    'pro_link'   => QVWC_PRO_VERSION_URL,
                    'default'    => 'no',
                    'desc'       => esc_html__( 'Enable to allow sharing wishlists on X (formerly Twitter).', 'product-quickview-for-woocommerce' ),
                ),
                'enable_pinterest_share' => array(
                    'title'      => esc_html__( 'Enable Pinterest Share', 'product-quickview-for-woocommerce' ),
                    'field_type' => 'qvwcbuypro',
                    'pro_link'   => QVWC_PRO_VERSION_URL,
                    'default'    => 'no',
                    'desc'       => esc_html__( 'Enable to allow sharing wishlists on Pinterest.', 'product-quickview-for-woocommerce' ),
                ),
                'enable_email_share' => array(
                    'title'      => esc_html__( 'Enable Email Share', 'product-quickview-for-woocommerce' ),
                    'field_type' => 'qvwcbuypro',
                    'pro_link'   => QVWC_PRO_VERSION_URL,
                    'default'    => 'no',
                    'desc'       => esc_html__( 'Enable to allow sharing wishlists via email.', 'product-quickview-for-woocommerce' ),
                ),
                'enable_whatsapp_share' => array(
                    'title'      => esc_html__( 'Enable WhatsApp Share', 'product-quickview-for-woocommerce' ),
                    'field_type' => 'qvwcbuypro',
                    'pro_link'   => QVWC_PRO_VERSION_URL,
                    'default'    => 'no',
                    'desc'       => esc_html__( 'Enable to allow sharing wishlists on WhatsApp.', 'product-quickview-for-woocommerce' ),
                ),
            );
        
            return apply_filters( 'qvwc_quick_view_advance_fields', $fields );
        }

    }

endif;