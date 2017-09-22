<?php
/**
 * The template to display the Logout page
 *
 * @package WordPress
 * @subpackage WIZORS_INVESTMENTS
 * @since WIZORS_INVESTMENTS 1.0
 */
 
/*
Template Name: Logout Page
*/

// clear all session variables
session_destroy();

// Redirect to "Home" page
header("Location: /");
exit;

get_header();

while ( have_posts() ) { the_post();

	get_template_part( 'content', 'page' );

	// If comments are open or we have at least one comment, load up the comment template.
	if ( !is_front_page() && ( comments_open() || get_comments_number() ) ) {
		comments_template();
	}
}

get_footer();
?>