<?php
/**
 * MNKPR plugin
 *
 * Custom plugin to handle some special use cases on the M&K PR website.
 *
 * @link              http://mnkpr.com/
 * @since             1.0.0
 * @package           MNKPR
 *
 * @wordpress-plugin
 * Plugin Name:       MNKPR
 * Plugin URI:        http://mnkpr.com/
 * Description:       Custom plugin to handle some special use cases on the M&K PR website.
 * Version:           1.0.0
 * Author:            Aaron Snowberger
 * Author URI:        https://aaron.kr/
 * License:           GPLv2
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       mnkpr
 * Domain Path:       /languages/
 */

/*
This plugin was originally developed by Aaron Snowberger (http://aaron.kr/).

Copyright 2020 Aaron Snowberger (http://aaron.kr)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License (Version 2 - GPLv2) as published by
the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Enqueue the plugin's JavaScript files.
 */
function mnkpr_enqueue_scripts() {

	/* Wraps all requires images in an anchor tag - to remove dependence on buttons. */
	wp_enqueue_script( 'mnkpr-image-anchor-wrap', plugins_url( '/js/image-wrap.js', __FILE__ ), array(), '20200128', true );

}
add_action( 'wp_enqueue_scripts', 'mnkpr_enqueue_scripts' );

/* Loads individual Case Study on home page when clicked (optional). */
require_once 'inc/mnkpr-front-case-studies.php';

/**
 * Undocumented function
 */
function mnkpr_backend() {
	/* Disables backend Admin menu options for certain users. */
	require_once 'inc/mnkpr-back-admin-menu.php';
}
add_action( 'plugins_loaded', 'mnkpr_backend' );
