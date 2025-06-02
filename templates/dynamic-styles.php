<?php
/**
 * Dynamic Styles for Quick View - Quick View for WooCommerce
 */
if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly.
endif;

$general_style           = isset( $general_style ) ? $general_style : array();
$quick_view_style        = isset( $quick_view_style ) ? $quick_view_style : array();

$background_color        = isset( $quick_view_style[ 'content_background' ] ) ? esc_attr( $quick_view_style[ 'content_background' ] ) : '#ffffff';
$overlay_color           = isset( $quick_view_style[ 'overlay_color' ] ) ? esc_attr( $quick_view_style[ 'overlay_color' ] ) : '#000000';
$overlay_opacity         = isset( $quick_view_style[ 'overlay_opacity' ] ) ? esc_attr( $quick_view_style[ 'overlay_opacity' ] ) : '0.5';
$close_icon_color        = isset( $quick_view_style[ 'close_icon_color' ] ) ? esc_attr( $quick_view_style[ 'close_icon_color' ] ) : '#cdcdcd';
$close_icon_hover        = isset( $quick_view_style[ 'close_icon_hover' ] ) ? esc_attr( $quick_view_style[ 'close_icon_hover' ] ) : '#ff0000';
$button_bg_color         = isset( $quick_view_style[ 'button_bg_color' ] ) ? esc_attr( $quick_view_style[ 'button_bg_color' ] ) : '#000000';
$button_bg_hover         = isset( $quick_view_style[ 'button_bg_hover' ] ) ? esc_attr( $quick_view_style[ 'button_bg_hover' ] ) : '#000000';
$button_text_color       = isset( $quick_view_style[ 'button_text_color' ] ) ? esc_attr( $quick_view_style[ 'button_text_color' ] ) : '#ffffff';
$button_text_hover       = isset( $quick_view_style[ 'button_text_hover' ] ) ? esc_attr( $quick_view_style[ 'button_text_hover' ] ) : '#ffffff';
$image_width             = isset( $quick_view_style[ 'product_image_dimensions' ][ 'width' ] ) ? esc_attr( $quick_view_style[ 'product_image_dimensions' ][ 'width' ] ) . 'px' : '300px';
$image_height            = isset( $quick_view_style[ 'product_image_dimensions' ][ 'height' ] ) ? esc_attr( $quick_view_style[ 'product_image_dimensions' ][ 'height' ] ) . 'px' : '300px';
$add_to_cart_bg          = isset( $quick_view_style[ 'add_to_cart_btn_bg_color' ] ) ? esc_attr( $quick_view_style[ 'add_to_cart_btn_bg_color' ] ) : '#000000';
$add_to_cart_bg_hover    = isset( $quick_view_style[ 'add_to_cart_btn_bg_hover_color' ] ) ? esc_attr( $quick_view_style[ 'add_to_cart_btn_bg_hover_color' ] ) : '#333333';
$add_to_cart_text        = isset( $quick_view_style[ 'add_to_cart_text_color' ] ) ? esc_attr( $quick_view_style[ 'add_to_cart_text_color' ] ) : '#ffffff';
$add_to_cart_text_hover  = isset( $quick_view_style[ 'add_to_cart_text_hover_color' ] ) ? esc_attr( $quick_view_style[ 'add_to_cart_text_hover_color' ] ) : '#ffffff';
$star_color              = isset( $quick_view_style[ 'star_color' ] ) ? esc_attr( $quick_view_style[ 'star_color' ] ) : '#f7c104';
$main_text_color         = isset( $quick_view_style[ 'main_text_color' ] ) ? esc_attr( $quick_view_style[ 'main_text_color' ] ) : '#333333';

$icon_hover_bg_color     = isset( $general_style[ 'icon_hover_bg_color' ] ) ? esc_attr( $general_style[ 'icon_hover_bg_color' ] ) : '#274c4f';
$icon_hover_color        = isset( $general_style[ 'icon_bg_color' ] ) ? esc_attr( $general_style[ 'icon_bg_color' ] ) : '#ffffff'; 
?>

.qvwc-quick-view-body {
    background-color: <?php echo esc_attr( $background_color ); ?>;
}

.qvwc-model::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: <?php echo esc_attr( $overlay_color ); ?>;
    opacity: <?php echo esc_attr( $overlay_opacity ); ?>;
}

.qvwc-quick-view-close {
    color: <?php echo esc_attr( $close_icon_color ); ?>;
}

.qvwc-quick-view-close:hover {
    color: <?php echo esc_attr( $close_icon_hover ); ?>;
}

.qvwc-quick-view {
    background-color: <?php echo esc_attr( $button_bg_color ); ?>;
    color: <?php echo esc_attr( $button_text_color ); ?>;
}

.qvwc-quick-view:hover {
    background-color: <?php echo esc_attr( $button_bg_hover ); ?>;
    color: <?php echo esc_attr( $button_text_hover ); ?>;
}

.qvwc-quick-view-image img {
    width: <?php echo esc_attr( $image_width ); ?>;
    height: <?php echo esc_attr( $image_height ); ?>;
    object-fit: cover;
    display: block;
    margin: 0 auto;
}

.qvwc-quick-view-cart button, 
.qvwc-quick-view-cart .view_product_button,
.qvwc-quick-view-content .qvwc_add_to_cart{
    background-color: <?php echo esc_attr( $add_to_cart_bg ); ?>;
    color: <?php echo esc_attr( $add_to_cart_text ); ?>;
}

.qvwc-quick-view-cart button:hover, 
.qvwc-quick-view-cart .view_product_button:hover,
.qvwc-quick-view-content .qvwc_add_to_cart:hover {
    background-color: <?php echo esc_attr( $add_to_cart_bg_hover ); ?>;
    color: <?php echo esc_attr( $add_to_cart_text_hover ); ?>;
}

.qvwc-quick-view-rating .star-rating span:before,
.qvwc-quick-view-rating .star-rating span:before{
    color: <?php echo esc_attr( $star_color ); ?>;
}

.qvwc-quick-view-description{
    color: <?php echo esc_attr( $main_text_color ); ?>;
}

.qvwc-product-icons-container .qvwc-compare-icon:hover, 
.qvwc-product-icons-container .qvwc-wishlist-icon:hover, 
.qvwc-product-icons-container .qvwc-quick-view-icon:hover{
    background: <?php echo esc_attr($icon_hover_bg_color); ?>;
    border: 1px solid <?php echo esc_attr($icon_hover_bg_color); ?>;
}

.qvwc-product-icons-container .qvwc-compare-icon, 
.qvwc-product-icons-container .qvwc-wishlist-icon, 
.qvwc-product-icons-container .qvwc-quick-view-icon{
    background: <?php echo esc_attr($icon_hover_color); ?>;
    border: 1px solid <?php echo esc_attr($icon_hover_color); ?>;
}
