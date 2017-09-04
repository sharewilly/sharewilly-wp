<?php

/**
 * Sharwilly WP plugin bootstrap file
 *
 * @link              http://muennecke-vollmers.de
 * @since             1.0.0
 * @package           Sharewilly_Wp
 *
 * @wordpress-plugin
 * Plugin Name:       Sharewilly WP - Share buttons for posts and pages
 * Plugin URI:        https://sharewilly.de
 * Description:       A very simple sharing plugin for your site. Let your visitors share posts and pages on Facebook, Twitter, Google+, LinkedIn and XING. By the way: we do not track!
 * Version:           1.0.0
 * Author:            Münnecke & Vollners GbR
 * Author URI:        http://muennecke-vollmers.de
 * 
 * Copyright:         (c) 2017 Münnecke & Vollmers GbR
 *
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( PLUGIN_VERSION, '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-sharewilly-wp-activator.php
 */
function activate_sharewilly_wp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sharewilly-wp-activator.php';
	Sharewilly_Wp_Activator::activate();
}

/**
 * Sharewilly WP
 */
function sharewilly_wp_social_sharing_buttons($content) {
	global $post;
	if(is_singular( 'post' ) || is_home()){
	
		$sharewilly_wp_url = urlencode(get_permalink());
		$sharewilly_wp_title = str_replace( ' ', '%20', get_the_title());
		$sharewilly_wp_thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
		$twitter_url = 'https://twitter.com/intent/tweet?text='.$sharewilly_wp_title.'&amp;url='.$sharewilly_wp_url.'&amp;via=sharewilly-wp';
		$facebook_url = 'https://www.facebook.com/sharer/sharer.php?u='.$sharewilly_wp_url;
		$google_url = 'https://plus.google.com/share?url='.$sharewilly_wp_url;
		$xing_url = 'https://www.xing.com/app/user?op=share&url='.$sharewilly_wp_url.'&amp;text='.$sharewilly_wp_title;
		$linkedIn_url = 'https://www.linkedin.com/shareArticle?mini=true&url='.$sharewilly_wp_url.'&amp;title='.$sharewilly_wp_title;
		$pinterestURL = 'https://pinterest.com/pin/create/button/?url='.$sharewilly_wp_url.'&amp;media='.$sharewilly_wp_thumb[0].'&amp;description='.$sharewilly_wp_title;
 
		// Sharewilly WP buttons
		$content .= '<div class="sharewilly-sharing">';
		$content .= '<p>'.  get_option('sharetext_field') .' <i class="fa fa-smile-o" aria-hidden="true"></i></p>'; 
		$content .= '<a class="sharewilly-link sharewilly-twitter sharewilly-transition" href="'. $twitter_url .'" target="_blank"><i class="fa fa-twitter fa-2x" aria-hidden="true"></i></a>';
		$content .= '<a class="sharewilly-link sharewilly-facebook sharewilly-transition" href="'.$facebook_url.'" target="_blank"><i class="fa fa-facebook fa-2x" aria-hidden="true"></i></a>';
		$content .= '<a class="sharewilly-link sharewilly-googleplus sharewilly-transition" href="'.$google_url.'" target="_blank"><i class="fa fa-google-plus fa-2x" aria-hidden="true"></i></a>';
		$content .= '<a class="sharewilly-link sharewilly-xing sharewilly-transition" href="'.$xing_url.'" target="_blank"><i class="fa fa-xing fa-2x" aria-hidden="true"></i></a>';
		$content .= '<a class="sharewilly-link sharewilly-linkedin sharewilly-transition" href="'.$linkedIn_url.'" target="_blank"><i class="fa fa-linkedin fa-2x" aria-hidden="true"></i></a>';
		$content .= '<a class="sharewilly-link sharewilly-pinterest sharewilly-transition" href="'.$pinterest_url.'" data-pin-custom="true" target="_blank"><i class="fa fa-pinterest-p fa-2x" aria-hidden="true"></i></a>';
		$content .= '</div>';
		
		return $content;
	}else{
		return $content;
	}
};
add_filter( 'the_content', 'sharewilly_wp_social_sharing_buttons');

add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'sharewilly_plugin_action_links' );

/**
 * Add some action links.
 * Sharewilly WP
 */

function sharewilly_plugin_action_links( $links ) {
   $links[] = '<a href="'. esc_url( get_admin_url(null, 'options-general.php') ) .'">Einstellungen</a>';
   $links[] = '<a href="https://sharewilly.de" target="_blank">Weitere Plugins</a>';
   return $links;
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-sharewilly-wp-deactivator.php
 */
function deactivate_sharewilly_wp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sharewilly-wp-deactivator.php';
	Sharewilly_Wp_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_sharewilly_wp' );
register_deactivation_hook( __FILE__, 'deactivate_sharewilly_wp' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-sharewilly-wp.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_sharewilly_wp() {

	$plugin = new Sharewilly_Wp();
	$plugin->run();

}
run_sharewilly_wp();