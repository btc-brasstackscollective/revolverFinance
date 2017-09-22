<?php
/*
 Plugin Name: Revolver Financial Application Form
 Plugin URI:
 Description: Plugin to manage borrower applications for property loans
 Author: Doug Ingalls
 Version: 1.0
 */
// Report all errors except E_NOTICE
error_reporting(E_ALL & ~E_NOTICE);
//additional custom post-type for Funimation Films
//**********************************************************
include_once(dirname(__FILE__) . '/includes/functions.php');
include_once(dirname(__FILE__) . '/includes/review_applications.php');
include_once(dirname(__FILE__) . '/includes/application_form_settings.php');
include_once(dirname(__FILE__) . '/includes/plugin_admin_page.php');
include_once(dirname(__FILE__) . '/includes/shortcodes.php');


//Register function to be called when plugin is activated
register_activation_hook( __FILE__ , 'application_form_activation' );

register_activation_hook( __FILE__ , 'update_db_table' );

application_form_activation('wp_');

// Register function to be called when new blogs are added to a network site
add_action( 'wpmu_new_blog', 'application_form_new_network_site' );

// Register function to be called when admin menu is constructed
add_action( 'admin_menu', 'my_admin_menu' );

function my_admin_menu()
{
    if (is_admin()) {
        add_menu_page('Application Forms', 'Application Forms', 'manage_options', 'plugin_admin_page', 'plugin_admin_page', 'dashicons-location-alt', 6);
        //add_submenu_page('plugin_admin_page', 'Theater Locator Management', 'General', 'manage_options', 'plugin_admin_page', 'plugin_admin_page');
        add_submenu_page('plugin_admin_page', 'Review Applications Management', 'Review Applications', 'manage_options', 'review_applications', 'review_applications_config_page');
        add_submenu_page('plugin_admin_page', 'Application Form Settings', 'Settings', 'manage_options', 'application_form_settings', 'settings_config_page');
    }
}

//add_action( 'admin_enqueue_scripts', 'wp_csv_to_db_admin_scripts' );
//add_action( 'admin_enqueue_scripts', 'wp_csv_to_db_admin_styles' );

function wp_csv_to_db_admin_scripts() {
    wp_enqueue_script('media-upload');  // For WP media uploader
    wp_enqueue_script('thickbox');  // For WP media uploader
    wp_enqueue_script('jquery-ui-tabs');  // For admin panel page tabs
    wp_enqueue_script('jquery-ui-dialog');  // For admin panel popup alerts

    //wp_enqueue_script( 'wp_csv_to_db', plugins_url( 'js/admin_page.js', __FILE__ ), array('jquery') );  // Apply admin page scripts
    //wp_localize_script( 'wp_csv_to_db', 'wp_csv_to_db_pass_js_vars', array( 'ajax_image' => plugin_dir_url( __FILE__ ).'images/loading.gif', 'ajaxurl' => site_url('wp-admin/admin-ajax.php') ) );
}

function wp_csv_to_db_admin_styles() {
    wp_enqueue_style('thickbox');  // For WP media uploader
    wp_enqueue_style('sdm_admin_styles', plugins_url( 'css/admin_page.css', __FILE__ ));  // Apply admin page styles
}

//  Ajax call for showing table column names
add_action( 'wp_ajax_wp_csv_to_db_get_columns', 'wp_csv_to_db_get_columns_callback' );

add_action ('admin_enqueue_scripts', 'tl_admin_scripts');

function tl_admin_scripts(){
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('jquery-ui-datepicker');
    wp_enqueue_style('datepickercss',
        plugins_url('css/ui-lightness/jquery-ui-1.8.17.custom.css', __FILE__), array(), '1.8.17');

    wp_enqueue_script('tiptipjs', plugins_url('tiptip/jquery.tipTip.js', __FILE__ ), array(), '1.3');
    wp_enqueue_style('tiptip',
        plugins_url('tiptip/tipTip.css', __FILE__), array(), '1.3');
}

/*add_action('activated_plugin','my_save_error');
function my_save_error()
{
    file_put_contents(dirname(__file__).'/error_activation.txt', ob_get_contents());
}*/