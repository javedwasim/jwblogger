<?php
/*
 * Plugin Name:		Download buttons for Youtube videos
 * Description:		Read the <a href="https://wordpress.org/plugins/audio-video-download-buttons-for-youtube/">official readme</a> of this plugin.
 * Text Domain:		audio-video-download-buttons-for-youtube
 * Domain Path:		/languages
 * Version:		1.04
 * WordPress URI:	https://wordpress.org/plugins/audio-video-download-buttons-for-youtube/
 * Plugin URI:		https://puvox.software/software/wordpress-plugins/?plugin=audio-video-download-buttons-for-youtube
 * Contributors: 	puvoxsoftware,ttodua
 * Author:		Puvox.software
 * Author URI:		https://puvox.software/
 * Donate Link:		https://paypal.me/Puvox
 * License:		GPL-3.0
 * License URI:		https://www.gnu.org/licenses/gpl-3.0.html
 
 * @copyright:		Puvox.software
*/


/**
 * Register the "book" custom post type
 */
function pluginprefix_setup_post_type() {
	add_shortcode( 'bartag', 'wpdocs_bartag_func' );
} 
add_action( 'init', 'pluginprefix_setup_post_type' );


/**
 * Activate the plugin.
 */
function pluginprefix_activate() { 
	// Trigger our function that registers the custom post type plugin.
	//pluginprefix_setup_post_type(); 
	
	// Clear the permalinks after the post type has been registered.
	//flush_rewrite_rules(); 
}
register_activation_hook( __FILE__, 'pluginprefix_activate' );

/**
 * Deactivation hook.
 */
function pluginprefix_deactivate() {
	// Unregister the post type, so the rules are no longer in memory.
	
	// Clear the permalinks to remove our post type's rules from the database.
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'pluginprefix_deactivate' );

function wpdocs_bartag_func( $atts ) {
	$atts = shortcode_atts( array(
		'foo' => 'no foo',
		'baz' => 'default baz'
	), $atts, 'bartag' );

	//return "foo = {$atts['foo']}";

	return '<form style="text-align: center;" role="search" method="get" class="search-form" action="https://jwblogger.com/">
			<label>
				<span class="screen-reader-text">Search for:</span>
				<input style="width:550px;" type="search" class="search-field" placeholder="Paste your video link here" value="" name="s" tabindex="-1">
					</label>
					<input type="submit" class="search-submit" value="Download">
			</form>';
	}

?>