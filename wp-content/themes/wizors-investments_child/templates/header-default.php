<?php
/**
 * The template to display default site header
 *
 * @package WordPress
 * @subpackage WIZORS_INVESTMENTS
 * @since WIZORS_INVESTMENTS 1.0
 */

$wizors_investments_header_css = $wizors_investments_header_image = '';
$wizors_investments_header_video = wizors_investments_get_header_video();
if (true || empty($wizors_investments_header_video)) {
	$wizors_investments_header_image = get_header_image();
	if (wizors_investments_is_on(wizors_investments_get_theme_option('header_image_override')) && apply_filters('wizors_investments_filter_allow_override_header_image', true)) {
		if (is_category()) {
			if (($wizors_investments_cat_img = wizors_investments_get_category_image()) != '')
				$wizors_investments_header_image = $wizors_investments_cat_img;
		} else if (is_singular() || wizors_investments_storage_isset('blog_archive')) {
			if (has_post_thumbnail()) {
				$wizors_investments_header_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
				if (is_array($wizors_investments_header_image)) $wizors_investments_header_image = $wizors_investments_header_image[0];
			} else
				$wizors_investments_header_image = '';
		}
	}
}

?><header class="top_panel top_panel_default<?php
					echo !empty($wizors_investments_header_image) || !empty($wizors_investments_header_video) ? ' with_bg_image' : ' without_bg_image';
					if ($wizors_investments_header_video!='') echo ' with_bg_video';
					if ($wizors_investments_header_image!='') echo ' '.esc_attr(wizors_investments_add_inline_style('background-image: url('.esc_url($wizors_investments_header_image).');'));
					if (is_single() && has_post_thumbnail()) echo ' with_featured_image';
					if (wizors_investments_is_on(wizors_investments_get_theme_option('header_fullheight'))) echo ' header_fullheight trx-stretch-height';
					?> scheme_<?php echo esc_attr(wizors_investments_is_inherit(wizors_investments_get_theme_option('header_scheme')) 
													? wizors_investments_get_theme_option('color_scheme') 
													: wizors_investments_get_theme_option('header_scheme'));
					?>">
	
	<div class="header_utility_nav">
		<div class="content_wrap">
			<div class="columns_wrap">
				<div class="sc_layouts_column sc_layouts_column_align_right sc_layouts_column_icons_position_right column-4_4">
					
					<?php
						$userTbl = $wpdb->prefix ."application_user";
						$userFirstName = $wpdb->get_var("SELECT user_firstname
			    FROM ".$userTbl." WHERE ".$userTbl.".id='" . $_SESSION['loan_application_user_id'] ."'");
						
						// Logged In Navigation
						if(isset($_SESSION['loan_application_user_id']) && $_SESSION['loggedIn'] == true)
						{
					?>
							<a href="/user-settings">HELLO, <?php echo strtoupper($userFirstName); ?></a>
							<a href="/logout">LOGOUT</a>
					<?php		
						}
					
						// Logged Out Navigation
						else
						{
					?>
							<a href="/apply">LOGIN</a>
					<?php		
						}
					?>
				</div>
			</div>
		</div>
	</div>
						
	<?php

	// Background video
	if (!empty($wizors_investments_header_video)) {
		get_template_part( 'templates/header-video' );
	}
	
	// Main menu
	if (wizors_investments_get_theme_option("menu_style") == 'top') {
		get_template_part( 'templates/header-navi' );
	}

	// Page title and breadcrumbs area
	get_template_part( 'templates/header-title');

	// Header widgets area
	get_template_part( 'templates/header-widgets' );

	// Header for single posts
	// get_template_part( 'templates/header-single' );

?></header>