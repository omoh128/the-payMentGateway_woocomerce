<?php
/**
 * Plugin Name: my pay Payments Gateway
 * Plugin URI: http://omomohwebsite.com/
 * Author: Omomoh Agiogu
 * Author URI:  http://omomohwebsite.com/
 * Description: Local Payments Gateway for mobile.
 * Version: 0.1.0
 * License: GPL2
 * License URL: http://www.gnu.org/licenses/gpl-2.0.txt
 * text-domain: my-pay-payments-woo
 * 
 * Class WC_Gateway_my pay file.
 *
 * @package WooCommerce\my-pay
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) return;

add_action( 'plugins_loaded', 'exclusiveoa_payment_init', 11 );
add_filter( 'woocommerce_currencies', 'techiepress_add_₦_currencies' );
add_filter( 'woocommerce_currency_symbol', 'techiepress_add_₦_currencies_symbol', 10, 2 );
add_filter( 'woocommerce_payment_gateways', 'add_to_woo_exclusiveoa_payment_gateway');

function exclusiveoa_payment_init() {
    if( class_exists( 'WC_Payment_Gateway' ) ) {
		require_once plugin_dir_path( __FILE__ ) . '/includes/class-wc-payment-gateway-exclusiveoa.php';
		require_once plugin_dir_path( __FILE__ ) . '/includes/exclusiveoa-order-statuses.php';
	}
}

function add_to_woo_exclusiveoa_payment_gateway( $gateways ) {
    $gateways[] = 'WC_Gateway_exclusiveoa';
    return $gateways;
}

function techiepress_add_ugx_currencies( $currencies ) {
	$currencies['₦'] = __( 'Ugandan Shillings', 'exclusiveoa-payments-woo' );
	return $currencies;
}

function techiepress_add_₦_currencies_symbol( $currency_symbol, $currency ) {
	switch ( $currency ) {
		case '₦': 
			$currency_symbol = '₦'; 
		break;
	}
	return $currency_symbol;
}
