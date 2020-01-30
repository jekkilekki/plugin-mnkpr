<?php
/**
 * MNKPR - Functions.
 *
 * @since 1.0.0
 * @package MNKPR
 */

// Prevent direct file access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Load Text Domain.
 */
function mnkpr_load_textdomain() {
	load_plugin_textdomain( 'mnkpr', false, plugin_dir_path( __FILE__ ) . 'languages/' );
}
add_action( 'plugins_loaded', 'mnkpr_load_textdomain' );

/**
 * Enqueue the plugin's JavaScript files.
 */
function mnkpr_enqueue_scripts() {

	/* Wraps all requires images in an anchor tag - to remove dependence on buttons. */
	wp_enqueue_script( 'mnkpr-image-anchor-wrap', plugins_url( '../js/image-wrap.js', __FILE__ ), array(), '20200128', true );

	/* REST Script that loads a post in the same page when link is clicked. */
	wp_enqueue_script( 'mnkpr-rest-posts', plugins_url( '../js/rest-posts.js', __FILE__ ), array(), '20200130', true );

}
add_action( 'wp_enqueue_scripts', 'mnkpr_enqueue_scripts' );
