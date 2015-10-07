<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * functions.php
 * Add PHP snippets here
 */

/**
 * Hide Ground Shipping when Customer is outside Colorado
 *
 * UPDATED FOR WOOCOMMERCE 2.1
 *
 */
add_filter( 'woocommerce_package_rates', 'hide_out_of_state_ground_shipping' , 10, 2 );

/**
 *
 * @param array $available_methods
 */
function hide_out_of_state_ground_shipping( $rates, $package ) {
 	
 	//states to exclude
	$excluded_states = array( 'CO' );

	//create an array for shipping classes
	$shipping_classes = array();

	//loop through cart to determine if a shipping classes are present and add them to the shipping_class array
    if ( sizeof( WC()->cart->get_cart() ) > 0 ) {
        foreach( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
             //print_r($cart_item);
             $shipping_class = $cart_item['data']->get_shipping_class();
             $shipping_classes[] = $shipping_class;
		}
	}

	//debug if a specific shipping class is in array
	//print_r($shipping_classes);

	//if Shipping Method exists and the State to exclude is not in the respective array and the Shipping class is in the respective array
	if( isset( $rates['fedex:GROUND_HOME_DELIVERY'] ) AND !in_array( WC()->customer->shipping_state, $excluded_states) AND in_array('steaks', $shipping_classes ) ) :
 
		// Unset the fedexshipping method
		unset( $rates['fedex:GROUND_HOME_DELIVERY'] );

	endif;

	return $rates;
}