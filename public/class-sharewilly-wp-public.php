<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://muennecke-vollmers.de
 * @since      1.0.0
 *
 * @package    Sharewilly_Wp
 * @subpackage Sharewilly_Wp/public
 * @author     Münnecke & Vollners GbR <hallo@muennecke-vollmers.de>
 * 
 * Copyright (c) 2017 Münnecke & Vollmers GbR | widilo® - Eine Marke der Münnecke & Vollmers GbR
 *
 */

class Sharewilly_Wp_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		// At this point we hook into the admin menu to create a settings page
		add_action( 'admin_menu', array( $this, 'create_plugin_settings_page' ) );
		add_action( 'admin_init', array( $this, 'setup_sections' ) );
		add_action( 'admin_init', array( $this, 'setup_fields' ) );
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Sharewilly_Wp_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Sharewilly_Wp_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/sharewilly-wp-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Sharewilly_Wp_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Sharewilly_Wp_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/sharewilly-wp-public.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'font-awesome', 'https://use.fontawesome.com/53a29384cb.js', false );

	}
	
	/**
	* Add the settings page to Sharewilly WP
	*
	* @since    1.0.0
	*/

	public function create_plugin_settings_page() {
		// Add the menu item and page
		$page_title = 'Sharewilly WP Einstellungen';
		$menu_title = 'Sharewilly WP';
		$capability = 'manage_options';
		$slug = 'sharewilly_fields';
		$callback = array( $this, 'plugin_settings_page_content' );
		$icon = 'dashicons-admin-generic';
		$position = 100;

		add_menu_page( $page_title, $menu_title, $capability, $slug, $callback, $icon, $position );
		// add_submenu_page( 'options-general.php', $page_title, $menu_title, $capability, $slug, $callback );
	}

	/**
	* Opens the form-html in public/partials/sharewilly-wp-public-display.php
	*
	* @since    1.0.0
	*/

	public function plugin_settings_page_content() { 

		require_once plugin_dir_path( __FILE__ ) . 'partials/sharewilly-wp-public-display.php';
	
	}
	
	/**
	* Everything you need to bring the sections of our options page alive
	*
	* @since    1.0.0
	*/	
	
	public function setup_sections() {
		add_settings_section( 'intro_section', 'Das kann Sharewilly WP:', array( $this, 'section_callback' ), 'sharewilly_fields' );

	}

	public function section_callback( $arguments ) {
		switch( $arguments['id'] ){
			case 'intro_section':
				echo '<div class="ulli"><li class="myli">Mit Sharewilly WP können deine Webseiten-Besucher Beiträge und Seiten in den Sozialen Medien teilen.</li> <li  class="myli">Sharing-Buttons für Facebook, Google+, Twitter, LinkedIn, XING & Pinterest</li> <li  class="myli">Sharewilly WP kommt ganz ohne JavaScript daher.</li> <li  class="myli">Sharewilly WP ist effizient, schlank und schnell.</li> <li  class="myli">Wir tracken nicht! Sharewilly WP respektiert deine Privatspäre.</li></div>';
				break;
		}
	}

	public function setup_fields() {
	$fields = array(
		array(
			'uid' => 'sharetext_field',
			'label' => 'Dein Text vor den Buttons',
			'section' => 'intro_section',
			'type' => 'text',
			'options' => false,
			'placeholder' => 'Beitrag teilen mit Sharewilly WP',
			'helper' => '',
			'supplemental' => '',
			'default' => 'Beitrag teilen mit Sharewilly WP'
		)

	);
		foreach( $fields as $field ){
			add_settings_field( $field['uid'], $field['label'], array( $this, 'field_callback' ), 'sharewilly_fields', $field['section'], $field );
			register_setting( 'sharewilly_fields', $field['uid'] );
		}
	}

	public function field_callback( $arguments ) {
		$value = get_option( $arguments['uid'] ); // Get the current value, if there is one
		if( ! $value ) { // If no value exists
			$value = $arguments['default']; // Set to our default
		}

	// Check which type of field we want
	switch( $arguments['type'] ){
		case 'text': // If it is a text field
			printf( '<input style="float: left;" name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" size="60" maxleght="100" />', $arguments['uid'], $arguments['type'], $arguments['placeholder'], $value );
			break;
		case 'textarea': // If it is a textarea
			printf( '<textarea name="%1$s" id="%1$s" placeholder="%2$s" rows="5" cols="50">%3$s</textarea>', $arguments['uid'], $arguments['placeholder'], $value );
			break;
		case 'select': // If it is a select dropdown
			if( ! empty ( $arguments['options'] ) && is_array( $arguments['options'] ) ){
				$options_markup = '';
				foreach( $arguments['options'] as $key => $label ){
					$options_markup .= sprintf( '<option value="%s" %s>%s</option>', $key, selected( $value, $key, false ), $label );
				}
				printf( '<select name="%1$s" id="%1$s">%2$s</select>', $arguments['uid'], $options_markup );
			}
			break;
	}

		// If there is help text
		if( $helper = $arguments['helper'] ){
			printf( '<br><br><span class="helper" style="display: inline-block; padding:10px 0 0 5px;"> %s</span>', $helper ); // Show it
		}

		// If there is supplemental text
		if( $supplimental = $arguments['supplemental'] ){
			printf( '<p class="description">%s</p>', $supplimental ); // Show it
		}
	}

	// If you want to call the field, you can do this => echo get_option('intro_field')
	// https://developer.wordpress.org/reference/functions/get_option/

}
