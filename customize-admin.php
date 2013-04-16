<?php
/*
 Plugin Name: Customize Admin
 Plugin URI: http://www.vanderwijk.com/wordpress/customize-admin/
 Description: This plugin allows you to customize the appearance and branding of the WordPress admin interface.
 Version: 1.6
 Author: Johan van der Wijk
 Author URI: http://www.vanderwijk.com

 Release notes: 1.6 now includes a color picker for setting a background color and the option to add custom styles to the login screen.

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Title attribute for the logo on the login screen
function ca_logo_title() {
	if ( get_option( 'ca_logo_url' ) != '' ) {
		return sprintf ( __( 'Go to %1$s' ), get_option ( 'ca_logo_url' ) );
	}
}

// URL for the logo on the login screen
function ca_logo_url($url) {
	if ( get_option( 'ca_logo_url' ) != '') {
		return get_option( 'ca_logo_url' );
	} else {
		return get_bloginfo( 'url' );
	}
}

// CSS for custom logo on the login screen
function ca_logo_file() {
	if ( get_option( 'ca_logo_file' ) != '' ) {
		echo '<style>h1 a { background-image: url("' . get_option( 'ca_logo_file' ) . '")!important; background-size: auto!important; }</style>';
	} else {
		echo '<style>h1 a { background-image: url("' . plugins_url( 'vanderwijk.png' , __FILE__ ) . '")!important; background-size: auto!important; }</style>';
	}
}
// CSS for custom background color
function ca_login_background_color() {
	if ( get_option( 'ca_login_background_color' ) != '' ) {
		echo '<style>body { background-color: ' . get_option( 'ca_login_background_color' ) . '!important; } </style>';
	}
}

// Remove the shadow from the left menu
function ca_add_styles() {
	if ( get_option( 'ca_remove_shadow' ) != '' ) {
		echo '<style type="text/css">#adminmenushadow, #adminmenuback { background-image: none; }</style>';
	}
}

// Remove the generator meta tag
function ca_remove_meta_generator() {
	if ( get_option( 'ca_remove_meta_generator' ) != '' ) {
		remove_action( 'wp_head', 'wp_generator' );
	}
}

// Remove the RSD meta tag
function ca_remove_meta_rsd() {
	if ( get_option( 'ca_remove_meta_rsd' ) != '' ) {
		remove_action('wp_head', 'rsd_link');
	}
}

// Remove the WLW meta tag
function ca_remove_meta_wlw() {
	if ( get_option( 'ca_remove_meta_wlw' ) != '' ) {
		remove_action('wp_head', 'wlwmanifest_link');
	}
}

// Remove Quick Press widget from dashboard
function ca_remove_dashboard_quick_press() {
	if ( get_option( 'ca_remove_dashboard_quick_press' ) != '' ) {
		remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	}
} 

// Remove Plugins widget from dashboard
function ca_remove_dashboard_plugins() {
	if ( get_option( 'ca_remove_dashboard_plugins' ) != '' ) {
		remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
	}
}

// Remove Recent Comments widget from dashboard
function ca_remove_dashboard_recent_comments() {
	if ( get_option( 'ca_remove_dashboard_recent_comments' ) != '' ) {
		remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
	}
}

// Remove WordPress Site News widget from dashboard
function ca_remove_dashboard_wordpress_news() {
	if ( get_option( 'ca_remove_dashboard_wordpress_news' ) != '' ) {
		remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
	}
}

// Remove WordPress Other News widget from dashboard
function ca_remove_dashboard_wordpress_other() {
	if ( get_option( 'ca_remove_dashboard_wordpress_other' ) != '' ) {
		remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
	}
}

// CSS for custom CSS
function ca_custom_css() {
	if ( get_option( 'ca_custom_css' ) != '' ) {
		echo '<style>'. get_option( 'ca_custom_css' ) . '</style>';
	}
}

add_filter( 'login_headertitle', 'ca_logo_title' );
add_filter( 'login_headerurl', 'ca_logo_url' );
add_action( 'login_head', 'ca_logo_file' );
add_action( 'login_head', 'ca_login_background_color' );
add_action( 'admin_head', 'ca_add_styles' );
add_action( 'login_head', 'ca_custom_css' );
add_action( 'init', 'ca_remove_meta_generator' );
add_action( 'init', 'ca_remove_meta_rsd' );
add_action( 'init', 'ca_remove_meta_wlw' );
add_action( 'wp_dashboard_setup', 'ca_remove_dashboard_quick_press' );
add_action( 'wp_dashboard_setup', 'ca_remove_dashboard_plugins' );
add_action( 'wp_dashboard_setup', 'ca_remove_dashboard_recent_comments' );
add_action( 'wp_dashboard_setup', 'ca_remove_dashboard_wordpress_news' );
add_action( 'wp_dashboard_setup', 'ca_remove_dashboard_wordpress_other' );

require_once( 'customize-admin-options.php' );
?>