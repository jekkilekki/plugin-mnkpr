<?php
/**
 * Remove WP Admin menu pieces for certain User Roles.
 *
 * @since 1.0.0
 * @package MNKPR
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Editor - and lower. */
if ( check_user_role( array( 'editor', 'author', 'subscriber' ) ) ) {
	add_action( 'admin_init', 'mnkpr_editor_menus' );
	add_action( 'wp_before_admin_bar_render', 'mnkpr_editor_top_menu' );
}

/* Staff Author - and lower. */
if ( check_user_role( array( 'author', 'subscriber' ) ) ) {
	add_action( 'admin_init', 'mnkpr_author_menus' );
}

/* Guest (Subscriber). */
if ( check_user_role( array( 'subscriber' ) ) ) {
	add_action( 'admin_init', 'mnkpr_disable_guest_access' );
}

/**
 * ==================================================================
 * Admin & Tech Support (all access)
 * ==================================================================
 */

/**
 * ==================================================================
 * Editor (Editor)
 * ==================================================================
 */

/** Remove Editor Admin Sidebar menus. */
function mnkpr_editor_menus() {
	mnkpr_sidebar_menus( array( 'Jetpack', 'Comments', 'LayerSlider WP' ) );
}

/** Remove Editor Admin Top menus. */
function mnkpr_editor_top_menu() {

	global $wp_admin_bar;

	$wp_admin_bar->remove_menu( 'smart_slider_3' );
	$wp_admin_bar->remove_menu( 'wpseo-menu' );
	$wp_admin_bar->remove_menu( 'wpvivid_admin_menu' );

	$wp_admin_bar->remove_menu( 'new-logocarousel' );
	$wp_admin_bar->remove_menu( 'new-x-portfolio' );
	$wp_admin_bar->remove_menu( 'new_content_smart_slider' );
	$wp_admin_bar->remove_menu( 'ab-ls-add-new' );

}

/**
 * ==================================================================
 * Staff Author (Author)
 * ==================================================================
 */

/** Remove Author Admin Sidebar menus. */
function mnkpr_author_menus() {
	remove_menu_page( 'edit.php?post_type=page' );
}

/**
 * ==================================================================
 * Guest (Subscriber)
 * ==================================================================
 */

/** Disable Guest (Subscriber) Dashboard access. */
function mnkpr_disable_guest_access() {
	if ( current_user_can( 'subscriber' ) && is_admin() ) {
		wp_safe_redirect( home_url() );
		exit;
	}
}

/**
 * ==================================================================
 * Helper Functions
 * ==================================================================
 */

/**
 * Function to check an array of user roles.
 *
 * @param array $roles The array of roles to check.
 * @param int   $user_id The ID of the user to check.
 */
function check_user_role( $roles, $user_id = null ) {

	if ( $user_id ) {
		$user = get_userdata( $user_id );
	} else {
		$user = wp_get_current_user();
	}

	if ( empty( $user ) ) {
		return false;
	}

	foreach ( $user->roles as $role ) {
		if ( in_array( $role, $roles, true ) ) {
			return true;
		}
	}

	return false;

}

/**
 * Function to remove given items in array from the admin sidebar menu.
 *
 * @param array $remove_menu_items Array of items to remove from admin sidebar menu.
 */
function mnkpr_sidebar_menus( $remove_menu_items ) {

	global $menu;
	$i = 0;

	foreach ( $menu as $item ) {
		if ( in_array( $item[0], $remove_menu_items, true ) ) {
			unset( $menu[ $i ] );
		}
		$i++;
	}

}
