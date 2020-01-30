<?php
/**
 * Remove WP Admin menu pieces for certain User Roles.
 *
 * @since 1.0.0
 * @package Smush
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

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

if ( check_user_role( array( 'editor', 'author', 'subscriber' ) ) ) {

	add_action( 'admin_init', 'mnkpr_editor_menus' );
	add_action( 'wp_before_admin_bar_render', 'mnkpr_editor_top_menu' );

}

if ( check_user_role( array( 'author', 'subscriber' ) ) ) {

	add_action( 'admin_init', 'mnkpr_author_menus' );

}

if ( check_user_role( array( 'subscriber' ) ) ) {
	add_action( 'admin_init', 'mnkpr_disable_guest_access' );
}

// } elseif ( current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_others_posts' ) ) {

// 	add_action( 'admin_menu', 'mnkpr_staff_writer_menus' );

// } elseif ( current_user_can( 'read' ) && ! current_user_can( 'edit_posts' ) ) {

// 	add_action( 'admin_menu', 'mnkpr_guest_menus' );


// }

/**
 * Admin & Tech Support (all access) ======================
 */

/**
 * Editor (Editor) ======================
 */

/** Remove Admin Sidebar menus. */
function mnkpr_editor_menus() {
	mnkpr_sidebar_menus( array( 'Jetpack', 'Comments', 'LayerSlider WP' ) );
}

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
 * Staff Author (Author) ======================
 */
function mnkpr_author_menus() {
	remove_menu_page( 'edit.php?post_type=page' );
}

/**
 * Guest (Subscriber) ======================
 */
function mnkpr_disable_guest_access() {
	if ( current_user_can( 'subscriber' ) && is_admin() ) {
		wp_redirect( home_url() );
		exit;
	}
}
