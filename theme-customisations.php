<?php
/**
 * Plugin Name: Custom Shipping Restrictions for WooCommerce
 * Description: A plugin to remove shipping options for some users based on specific conditions.
 * Version: 	1.0.0
 * Author: 		SweetWood
 * Author URI: 	http://www.sweetwood.com/
 *
 * @package Woo_Ship_Restrict
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Main Woo_Ship_Restrict Class
 *
 * @class Woo_Ship_Restrict
 * @version	1.0.0
 * @since 1.0.0
 * @package	Woo_Ship_Restrict
 */
final class Woo_Ship_Restrict {

	public function __construct () {
		add_action( 'init', array( $this, 'Woo_Ship_Restrict_setup' ), -1 );
	}

	/**
	 * Setup all the things
	 */
	public function Woo_Ship_Restrict_setup() {
		add_action( 'wp_enqueue_scripts', array( $this, 'Woo_Ship_Restrict_css' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'Woo_Ship_Restrict_js' ) );

		require_once( 'custom/functions.php' );
	}

	/**
	 * Enqueue the CSS
	 * @return void
	 */
	public function Woo_Ship_Restrict_css() {
		//wp_enqueue_style( 'custom-css', plugins_url( '/custom/style.css', __FILE__ ) );
	}

	/**
	 * Enqueue the Javascript
	 * @return void
	 */
	public function Woo_Ship_Restrict_js() {
		//wp_enqueue_script( 'custom-js', plugins_url( '/custom/custom.js', __FILE__ ), array( 'jquery' ) );
	}

} // End Class

/**
 * The 'main' function
 * @return void
 */
function __Woo_Ship_Restrict_main() {
	new Woo_Ship_Restrict();
}

/**
 * Initialise the plugin
 */
add_action( 'plugins_loaded', '__Woo_Ship_Restrict_main' );