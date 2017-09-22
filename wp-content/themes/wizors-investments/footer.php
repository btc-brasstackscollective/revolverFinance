<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package WordPress
 * @subpackage WIZORS_INVESTMENTS
 * @since WIZORS_INVESTMENTS 1.0
 */

						// Widgets area inside page content
						wizors_investments_create_widgets_area('widgets_below_content');
						?>				
					</div><!-- </.content> -->

					<?php
					// Show main sidebar
					get_sidebar();

					// Widgets area below page content
					wizors_investments_create_widgets_area('widgets_below_page');

					$wizors_investments_body_style = wizors_investments_get_theme_option('body_style');
					if ($wizors_investments_body_style != 'fullscreen') {
						?></div><!-- </.content_wrap> --><?php
					}
					?>
			</div><!-- </.page_content_wrap> -->

			<?php
			// Footer
			$wizors_investments_footer_style = wizors_investments_get_theme_option("footer_style");
			if (strpos($wizors_investments_footer_style, 'footer-custom-')===0) $wizors_investments_footer_style = 'footer-custom';
			get_template_part( "templates/{$wizors_investments_footer_style}");
			?>

		</div><!-- /.page_wrap -->

	</div><!-- /.body_wrap -->

	<?php if (wizors_investments_is_on(wizors_investments_get_theme_option('debug_mode')) && wizors_investments_get_file_dir('images/makeup.jpg')!='') { ?>
		<img src="<?php echo esc_url(wizors_investments_get_file_url('images/makeup.jpg')); ?>" id="makeup">
	<?php } ?>

	<?php wp_footer(); ?>

</body>
</html>