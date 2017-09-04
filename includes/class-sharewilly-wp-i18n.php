<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://muennecke-vollmers.de
 * @since      1.0.0
 *
 * @package    Sharewilly_Wp
 * @subpackage Sharewilly_Wp/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Sharewilly_Wp
 * @subpackage Sharewilly_Wp/includes
 * @author     Münnecke & Vollners GbR <hallo@muennecke-vollmers.de>
 */
class Sharewilly_Wp_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'sharewilly-wp',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
