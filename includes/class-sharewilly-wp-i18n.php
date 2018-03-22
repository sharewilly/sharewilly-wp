<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://muennecke-vollmers.de
 * @since      1.0.1
 *
 * @package    Sharewilly_Wp
 * @subpackage Sharewilly_Wp/includes
 *
 * Copyright (c) 2017 Münnecke & Vollmers GbR | widilo® - Eine Marke der Münnecke & Vollmers GbR
 */

class Sharewilly_Wp_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.1
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'sharewilly-wp',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
