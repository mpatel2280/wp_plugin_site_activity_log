<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @package Site Activity Log
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}
$site_delete_data = get_option( 'siteDeleteData', 0 );

if ( 1 == $site_delete_data ) {
	delete_option( 'site_promo_time' );
	delete_option( 'site_is_optin' );
	delete_option( 'site_version' );
	delete_option( 'enable_user_list' );
	delete_option( 'enable_role_list_temp' );
	delete_option( 'enable_role_list' );
	delete_option( 'enable_email' );
	delete_option( 'to_email' );
	delete_option( 'from_email' );
	delete_option( 'email_message' );
	delete_option( 'ualpAllowIp' );
	delete_option( 'ualpKeepLogsDay' );
	// delete database table.
	global $wpdb;
	$table_name = $wpdb->prefix . 'sitep_user_activity';
	$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}sitep_user_activity" );
	delete_option( 'siteDeleteData' );
}

