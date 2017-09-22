<?php
/**
 * Developer: Babajide S. Adegbenro for GROUP1200
 * Project: Funimation Films
 */
// Check that file was called from WordPress admin
if( !defined( 'WP_UNINSTALL_PLUGIN' ) )
    exit();

// Get access to global WordPress wpdb class
global $wpdb;

// Check if site is configured for network installation
if ( is_multisite() ) {
    if ( !empty( $_GET['networkwide'] ) ) {
        $start_blog = $wpdb->blogid;

        // Get blog list and cycle through all blogs under network
        $blog_list = $wpdb->get_col( 'SELECT blog_id FROM ' . $wpdb->blogs );
        foreach ( $blog_list as $blog ) {
            switch_to_blog( $blog );

            // Call function to delete bug table with prefix
            theaterloc_drop_table( $wpdb->get_blog_prefix() );
        }
        switch_to_blog( $start_blog );
    }
}

theaterloc_drop_table( $wpdb->prefix );

function theaterloc_drop_table( $prefix ) {
    global $wpdb;
    $wpdb->query( $wpdb->prepare( 'DROP TABLE ' . $prefix . 'movies' ) );
    $wpdb->query( $wpdb->prepare( 'DROP TABLE ' . $prefix . 'theaters' ) );
    $wpdb->query( $wpdb->prepare( 'DROP TABLE ' . $prefix . 'movie_dates' ) );
    $wpdb->query( $wpdb->prepare( 'DROP TABLE ' . $prefix . 'circuit' ) );
}