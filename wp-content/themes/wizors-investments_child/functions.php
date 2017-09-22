<?php
/**
 * Child-Theme functions and definitions
 */

if ( !function_exists('wizors_investments_theme_fonts_links') ) {
	function wizors_investments_theme_fonts_links() {
		$links = array();
		
		/*
		Translators: If there are characters in your language that are not supported
		by chosen font(s), translate this to 'off'. Do not translate into your own language.
		*/
		$google_fonts_enabled = ( 'off' !== _x( 'on', 'Google fonts: on or off', 'wizors-investments' ) );
		$custom_fonts_enabled = ( 'off' !== _x( 'on', 'Custom fonts (included in the theme): on or off', 'wizors-investments' ) );
		
		if ( ($google_fonts_enabled || $custom_fonts_enabled) && !wizors_investments_storage_empty('load_fonts') ) {
			$load_fonts = wizors_investments_storage_get('load_fonts');
			if (count($load_fonts) > 0) {
				$google_fonts = '';
				foreach ($load_fonts as $font) {
					$slug = wizors_investments_get_load_fonts_slug($font['name']);
					$url  = wizors_investments_get_file_url( sprintf('css/font-face/%s/stylesheet.css', $slug));
					if ($url != '') {
						if ($custom_fonts_enabled) {
							$links[$slug] = $url;
						}
					} else {
						if ($google_fonts_enabled) {
							$google_fonts .= ($google_fonts ? '|' : '') 
											. str_replace(' ', '+', $font['name'])
											. ':' 
											. (empty($font['styles']) ? '400,400italic,700,700italic' : $font['styles']);
						}
					}
				}
				if ($google_fonts && $google_fonts_enabled) {
					//$links['google_fonts'] = sprintf('%s://fonts.googleapis.com/css?family=%s&subset=%s', wizors_investments_get_protocol(), $google_fonts, wizors_investments_get_theme_option('load_fonts_subset'));
					$links['google_fonts'] = 'https://fonts.googleapis.com/css?family='.$google_fonts;
				}
			}
		}
		return $links;
	}
}



?>