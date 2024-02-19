<?php
/**
 *  WP Crontrol Support.
 *
 * @package Site Activity Log
 */

/*
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Logs cron event management from the WP Crontrol plugin
 * Plugin URL: https://wordpress.org/plugins/wp-crontrol/
 *
 * Requires WP Crontrol 1.9.0 or later.
 */

if ( ! function_exists( 'sitep_added_new_event' ) ) {
	/**
	 * Added new cron event.
	 *
	 * @param string $event Event.
	 */
	function sitep_added_new_event( $event ) {
		$obj_type    = $event->hook;
		$action      = $event->hook;
		$post_id     = '';
		$post_title  = '';
		$hook        = 'added_new_event';
		$description = 'Added cron event ' . $event->hook;
		site_get_activity_function( $action, $obj_type, $post_id, $post_title );
	}
}
add_action( 'crontrol/added_new_event', 'sitep_added_new_event' );
add_action( 'crontrol/added_new_php_event', 'sitep_added_new_event' );

if ( ! function_exists( 'sitep_ran_event' ) ) {
	/**
	 * Manually ran cron event.
	 *
	 * @param string $event Event.
	 */
	function sitep_ran_event( $event ) {
		$obj_type    = $event->hook;
		$action      = $event->hook;
		$post_id     = '';
		$post_title  = '';
		$hook        = 'ran_event';
		$description = 'Manually ran cron event ' . $event->hook;
		site_get_activity_function( $action, $obj_type, $post_id, $post_title );
	}
}
add_action( 'crontrol/ran_event', 'sitep_ran_event' );

if ( ! function_exists( 'sitep_deleted_event' ) ) {
	/**
	 * Deleted Cron event.
	 *
	 * @param string $event Event.
	 */
	function sitep_deleted_event( $event ) {
		$obj_type   = $event->hook;
		$action     = $event->hook;
		$post_id    = '';
		$post_title = 'Deleted cron event ' . $event->hook;
		site_get_activity_function( $action, $obj_type, $post_id, $post_title );
	}
}
add_action( 'crontrol/deleted_event', 'sitep_deleted_event' );

if ( ! function_exists( 'sitep_deleted_all_with_hook' ) ) {
	/**
	 * Deleted all cron hook.
	 *
	 * @param string $hook Hook.
	 * @param string $deleted Deleted.
	 */
	function sitep_deleted_all_with_hook( $hook, $deleted ) {
		$obj_type   = '';
		$action     = 'deleted_all_with_hook';
		$post_id    = '';
		$post_title = 'Deleted all ' . $hook . ' cron events';
		site_get_activity_function( $action, $obj_type, $post_id, $post_title );
	}
}
add_action( 'crontrol/deleted_all_with_hook', 'sitep_deleted_all_with_hook', 10, 2 );

if ( ! function_exists( 'sitep_edited_event' ) ) {
	/**
	 * Edit cron event.
	 *
	 * @param string $event Event.
	 * @param string $original Original.
	 */
	function sitep_edited_event( $event, $original ) {
		$obj_type = $event->hook;
		$action   = $event->hook;
		$post_id  = '';

		$post_title = 'Edited cron event ' . $hook;
		site_get_activity_function( $action, $obj_type, $post_id, $post_title );
	}
}
add_action( 'crontrol/edited_event', 'sitep_edited_event', 10, 2 );
add_action( 'crontrol/edited_php_event', 'sitep_edited_event', 10, 2 );

if ( ! function_exists( 'sitep_added_new_schedule' ) ) {
	/**
	 * Added cron schedule.
	 *
	 * @param string $name Name.
	 * @param string $interval Interval.
	 * @param string $display DIsplay.
	 */
	function sitep_added_new_schedule( $name, $interval, $display ) {
		$obj_type = $name;
		$action   = $display;
		$post_id  = '';

		$description = 'Added cron schedule ' . $name;
		site_get_activity_function( $action, $obj_type, $post_id, $post_title );
	}
}
add_action( 'crontrol/added_new_schedule', 'sitep_added_new_schedule', 10, 3 );

if ( ! function_exists( 'sitep_deleted_schedule' ) ) {
	/**
	 * Delete cron Schedule.
	 *
	 * @param string $name Name.
	 */
	function sitep_deleted_schedule( $name ) {
		$obj_type = $name;
		$action   = $name;
		$post_id  = '';

		$post_title = 'Deleted cron schedule ' . $name;
		site_get_activity_function( $action, $obj_type, $post_id, $post_title );
	}
}
add_action( 'crontrol/deleted_schedule', 'sitep_deleted_schedule' );
