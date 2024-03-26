<?php
	define( 'ACF_LITE', true );

	include_once( 'acf-src-core/acf.php' );

	// Fields
	add_action( 'acf/register_fields', 'my_register_fields' );

	function my_register_fields() {

		include_once( 'add-ons/acf-repeater/repeater.php' );
		include_once('add-ons/acf-gallery/gallery.php');
		//include_once('add-ons/acf-flexible-content/flexible-content.php');
		//include_once('add-ons/acf-field-date-time-picker/acf-date_time_picker.php');
		include_once( 'add-ons/acf-chosen_select/acf-chosen_select.php' );
		include_once( 'add-ons/acf-gallery/acf-gallery.php' );
	}

	// Options Page
	include_once( 'add-ons/acf-options-page/acf-options-page.php' );

	function my_acf_options_page_settings( $settings ) {

		$settings['title']     = 'Настройки калькулятора';
		$settings['dash-icon'] = 'dashicons-admin-tools';

		return $settings;
	}


	add_filter( 'acf/options_page/settings', 'my_acf_options_page_settings' );


	if ( function_exists( "register_field_group" ) ) {

		// Автозагрузка библиотек и функций
		$dirs = array(
			CORE_PATH . '/ACF/autoload_fields_block/',
		);

		foreach ( $dirs as $dir ) {
			$custome_fields_init = array();
			if ( is_dir( $dir ) ) {
				if ( $dh = opendir( $dir ) ) {
					while ( false !== ( $file = readdir( $dh ) ) ) {
						if ( $file != '.' && $file != '..' && stristr( $file, '.php' ) !== false ) {
							list( $nam, $ext ) = explode( '.', $file );
							if ( $ext == 'php' ) {
								$custome_fields_init[] = $file;
							}
						}
					}
					closedir( $dh );
				}
			}
			asort( $custome_fields_init );
			foreach ( $custome_fields_init as $other_init ) {
				include_once $dir . $other_init;
			}
		}
	}

	add_action( 'acf/register_fields', 'register_fields' );
	function register_fields() {

		include_once( 'registered-fields/presets/acf-presets.php' );
		//    include_once('registered-fields/google-font/acf-googlefonts.php');
		include_once( 'registered-fields/googlemap/acf-googlemap.php' );
	}
