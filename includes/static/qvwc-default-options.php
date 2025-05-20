<?php 

if ( ! defined( 'ABSPATH' ) ) exit;

return apply_filters( 'qvwc_get_default_options',
    array(
        'qvwc_quick_view_setting'   => array(
            'enable'                                    => 'yes',
            'enable_on_mobile'                          => 'yes',
            'single_position'                           => 'woocommerce_product_thumbnails-0',
            'icon_position_single'                      => 'top-right',
            'shop_position'                             => 'woocommerce_before_shop_loop_item-10',
            'icon_display_type'                         => 'fixed',
            'icon_position_shop'                        => 'top-right',
            'product_description'                       => 'full',
            'product_image_dimensions'                  => array(
                                                                        'width'     => '400',
                                                                        'height'    => '400'
                                                                    ),
            'quick_view_style'                          => 'window_modal',
            'quick_view_button_label'                   => 'Quick View',
            'content_background'                        => '#ffffff',
            'overlay_color'                             => '#000000',
            'close_icon_color'                          => '#0a0a0a',
            'close_icon_hover'                          => '#0a0404',
            'button_bg_color'                           => '#274c4f',
            'button_bg_hover'                           => '#2a4b4f',
            'button_text_color'                         => '#ffffff',
            'button_text_hover'                         => '#ffffff',
            'main_text_color'                           => '#404040',
            'star_color'                                => '#fcc640',
            'add_to_cart_btn_bg_color'                  => '#274c4f',
            'add_to_cart_btn_bg_hover_color'            => '#2a4b4f',
            'add_to_cart_text_color'                    => '#ffffff',
            'add_to_cart_text_hover_color'              => '#ffffff',
            'show_product_image'                        => 'yes',
            'show_product_name'                         => 'yes',
            'show_product_rating'                       => 'yes',
            'show_product_price'                        => 'yes',
            'show_add_to_cart'                          => 'yes',
            'show_wishlist_button'                      => 'yes',
            'show_product_meta'                         => 'yes',
            'close_popup_after_add_to_cart'             => 'yes',
            'redirect_to_checkout_after_add_to_cart'    => 'no',
            'enable_facebook_share'                     => 'yes',
            'enable_x_share'                            => 'yes',
            'enable_pinterest_share'                    => 'yes',
            'enable_email_share'                        => 'yes',
            'enable_whatsapp_share'                     => 'yes',
            'overlay_opacity'                           => '0.5',
        ),
    )
);
