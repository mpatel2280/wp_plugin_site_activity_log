<?php
/**
 * Jetpack Support.
 *
 * @package Site Activity Log
 */

/*
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
add_action( 'jetpack_activate_module', 'sitep_jetpack_activate_module', 10, 2 );

if ( ! function_exists( 'sitep_get_jetpack_modules' ) ) {
	/**
	 * Get all jetpack modules.
	 */
	function sitep_get_jetpack_modules() {

		// Check that Jetpack has the needed methods.
		if ( ! method_exists( 'Jetpack', 'get_available_modules' ) || ! method_exists( 'Jetpack', 'get_module' ) ) {
			return false;
		}
		$available_modules           = Jetpack::get_available_modules();
		$available_modules_with_info = array();

		foreach ( $available_modules as $module_slug ) {
			$module = Jetpack::get_module( $module_slug );
			if ( ! $module ) {
				continue;
			}
			$available_modules_with_info[ $module_slug ] = $module;
		}
		return $available_modules_with_info;
	}
}

if ( ! function_exists( 'sitep_get_jetpack_module' ) ) {
	/**
	 * Get single jetpack modules.
	 *
	 * @param string $slug Slug.
	 */
	function sitep_get_jetpack_module( $slug = null ) {
		if ( empty( $slug ) ) {
			return false;
		}
		$modules = sitep_get_jetpack_modules();
		return isset( $modules[ $slug ] ) ? $modules[ $slug ] : false;
	}
}

if ( ! function_exists( 'sitep_jetpack_activate_module' ) ) {
	/**
	 * Store Jetpack Activate Module.
	 *
	 * @param string $module_slug Module Slug.
	 * @param string $success Success.
	 */
	function sitep_jetpack_activate_module( $module_slug = null, $success = null ) {
		if ( true !== $success ) {
			return;
		}
		$module = sitep_get_jetpack_module( $module_slug );
		if ( $module ) {
			$obj_type   = 'Activate Jetpack Module';
			$action     = $module_slug;
			$post_id    = '';
			$post_title = 'Activate Jetpack Module: ' . $module['name'];
			site_get_activity_function( $action, $obj_type, $post_id, $post_title );
		}
	}
}

add_action( 'jetpack_deactivate_module', 'sitep_jetpack_deactivate_module', 10, 2 );

if ( ! function_exists( 'sitep_jetpack_deactivate_module' ) ) {
	/**
	 * Store Jetpack Deactivate Module.
	 *
	 * @param string $module_slug Module Slug.
	 * @param string $success Success.
	 */
	function sitep_jetpack_deactivate_module( $module_slug = null, $success = null ) {
		if ( true !== $success ) {
			return;
		}
		$module = sitep_get_jetpack_module( $module_slug );
		if ( $module ) {
			$obj_type   = 'Deactivate Jetpack Module';
			$action     = $module_slug;
			$post_id    = '';
			$post_title = '';
			$hook       = 'jetpack_deactivate_module';
			$post_title = 'Deactivate Jetpack Module: ' . $module['name'];
			site_get_activity_function( $action, $obj_type, $post_id, $post_title );
		}
	}
}
