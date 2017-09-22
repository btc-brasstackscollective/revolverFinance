<?php
/**
 * Developer: Doug Ingalls
 * Project: Revolver Financial
 */
 
// Report all errors except E_NOTICE
error_reporting(E_ALL & ~E_NOTICE);

include_once(dirname(__FILE__) . '/dbinstall.php');

// Activation Callback
function application_form_activation() {
    // Get access to global database access class
    global $wpdb;

    // Check to see if WordPress installation is a network
    if ( is_multisite() ) {

        // If it is, cycle through all blogs, switch to them and call function to create plugin table
        if ( isset( $_GET['networkwide'] ) && ( $_GET['networkwide'] == 1) ) {
            $start_blog = $wpdb->blogid;

            $blog_list = $wpdb->get_col( 'SELECT blog_id FROM ' . $wpdb->blogs );
            foreach ( $blog_list as $blog ) {
                switch_to_blog( $blog );

                // Send cms table prefix to table creation function
                application_form_create_table( $wpdb->get_blog_prefix() );
            }
            switch_to_blog( $start_blog );
        }
    }

    // Create table on main cms in network mode or single blog
    application_form_create_table( $wpdb->get_blog_prefix() );
}

add_action( 'wp_enqueue_scripts', 'admin_styles' );
add_action( 'wp_enqueue_scripts', 'admin_scripts' );

// fixes inserting duplicate entries on POST submit
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');

function admin_styles()
{
    wp_enqueue_style('sdm_admin_styles', plugins_url( 'css/admin_page.css', __FILE__ ));  // Apply admin page styles
    wp_enqueue_style('signature_pad_styles', plugins_url( 'css/signature_pad.css', __FILE__ ));  // Apply signature pad field styles
}

function admin_scripts()
{
	wp_register_script('signature_pad', plugins_url( 'js/signature_pad.js', __FILE__ ), array(), '1.0', 1);
    wp_enqueue_script('signature_pad'); // Enqueue it!
    
    wp_register_script('signature_pad_function_script', plugins_url( 'js/app.js', __FILE__ ), array(), '1.0', 1);
    wp_enqueue_script('signature_pad_function_script'); // Enqueue it!
    
    //wp_enqueue_script('signature_pad_script', plugins_url( 'js/signature_pad.js', __FILE__ )); // Signature Pad JS
    //wp_enqueue_script('signature_pad_function_script', plugins_url( 'js/app.js', __FILE__ )); // Signature Pad JS
}

// Register function to be called when new contents are added to a network site
function application_form_new_network_site( $blog_id ) {
    global $wpdb;

    // Check if this plugin is active when new content is created include plugin functions if it is
    if ( !function_exists( 'is_plugin_active_for_network' ) )
        require_once(ABSPATH . '/wp-admin/includes/plugin.php');

    // Select current cms, create new table and switch back to main cms
    if ( is_plugin_active_for_network( plugin_basename( __FILE__ ) ) ) {
        $start_blog = $wpdb->blogid;
        switch_to_blog( $blog_id );

        // Send cms table prefix to table creation function
        application_form_create_table( $wpdb->get_blog_prefix() );

        switch_to_blog( $start_blog );
    }
}

function getDatabase(){
    // All the settings is in wp-config-env.php
    $dbhost = DB_HOST;
    $dbuser = DB_USER;
    $dbpass = DB_PASSWORD;
    $dbname = DB_NAME;

    //$mysql_conn_string = "mysql:host=$dbhost;dbname=$dbname";
    //$dbConnection = new PDO($mysql_conn_string, $dbuser, $dbpass);
    //$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //return $dbConnection;
    $con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
    // Check connection
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    
    else
    {
        return $con;
    }
}