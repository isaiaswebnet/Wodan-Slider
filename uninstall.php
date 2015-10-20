<?php

if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	
	exit();

}
	
global $wpdb;
	
	$cptName             = 'wodanslider';
	$optionsName         = 'wodanslider_options';
	
	$tablePostMeta       = $wpdb->prefix . 'postmeta';
	$tablePosts          = $wpdb->prefix . 'posts';

	$postMetaDeleteQuery = "DELETE FROM $tablePostMeta".
                      	   " WHERE post_id IN".
                      	   " (SELECT id FROM $tablePosts WHERE post_type='$cptName'";
	
	$postDeleteQuery     = "DELETE FROM $tablePosts WHERE post_type='$cptName'";

	$wpdb->query( $postMetaDeleteQuery );
	$wpdb->query( $postDeleteQuery);
	
delete_option( $optionsName );
delete_site_option( $optionsName );
