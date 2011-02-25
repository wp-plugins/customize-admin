<?php
/*
 Plugin Name: Custom Post Widget
 Plugin URI: http://www.vanderwijk.com/wordpress/wordpress-custom-post-widget/
 Description: Displays the contents of a custom post type named 'Content Block' in a widget.
 Version: 1.4
 Author: Johan van der Wijk
 Author URI: http://www.vanderwijk.com
 License: GPL2

 Release notes: 1.4 Thanks to Caspar from GlückPress (http://glueckpress.com) the Custom Post Widget plugin is now fully localized.
 
 Copyright 2011 Johan van der Wijk (email: info@vanderwijk.com)
 
 This program is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License, version 2, as 
 published by the Free Software Foundation.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with this program; if not, write to the Free Software
 Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
*/

/* Set constant path to the custom-post-widget plugin directory. */
define( 'CUSTOM_POST_WIDGET_DIR', plugin_dir_path( __FILE__ ) );
define( 'CUSTOM_POST_WIDGET_TEXTDOMAIN', 'custom-post-widget' );

/* Launch the plugin. */
add_action( 'plugins_loaded', 'custom_post_widget_plugin_init' );

/*
 Initialize the plugin. This function loads the required files needed for the plugin
 to run in the proper order and adds needed functions to the required hooks.
*/
function custom_post_widget_plugin_init() {

	/* Load the translation of the plugin. */
	load_plugin_textdomain( CUSTOM_POST_WIDGET_TEXTDOMAIN, false, 'custom-post-widget/languages' );

	add_action( 'widgets_init', 'custom_post_widget_load_widgets' );
}

/*
 Loads the widgets packaged with the plugin.
*/
function custom_post_widget_load_widgets() {
	require_once( CUSTOM_POST_WIDGET_DIR . '/post-widget.php' );
	register_widget( 'custom_post_widget' );
}

?>