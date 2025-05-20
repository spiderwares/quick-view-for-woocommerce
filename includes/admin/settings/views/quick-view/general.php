<?php
// Prevent direct access to the file.
defined( 'ABSPATH' ) || exit;

/**
 * Retrieve the general settings fields for the Quick View feature 
 * from the QVWC_Quick_View_Admin_Settings class.
 *
 * @var array $fields Array of settings fields related to Quick View general settings.
 */
$fields = QVWC_Quick_View_Admin_Settings::general_field();

/**
 * Get the saved Quick View settings from the WordPress options table.
 *
 * @var array|bool $options Retrieved settings array or false if not set.
 */
$options = get_option( 'qvwc_quick_view_setting', true );

/**
 * Load the settings form template for the Quick View general settings.
 *
 * This template allows users to configure general options 
 * for the Quick View feature.
 */
wc_get_template(
    'fields/setting-forms.php',
    array(
        'title'   => 'General Settings',
        'metaKey' => 'qvwc_quick_view_setting',
        'fields'  => $fields,
        'options' => $options,
    ),
    'quickview-for-woocommerce/fields/',
    QVWC_TEMPLATE_PATH
);