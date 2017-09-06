<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * For more information, see the following discussion:
 * https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate/pull/123#issuecomment-28541913
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
 * Copyright:          (c) 2017 Münnecke & Vollmers GbR | widilo® - Eine Marke der Münnecke & Vollmers GbR
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}
