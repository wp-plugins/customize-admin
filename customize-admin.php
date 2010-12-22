<?php
/*
 Plugin Name: Customize Admin
 Plugin URI: http://www.vanderwijk.com/wordpress/customize-admin/
 Description: This plugin allows you to customize the branding of the WordPress admin interface.
 Version: 1.1
 Author: Johan van der Wijk
 Author URI: http://www.vanderwijk.com

 Release notes: 1.1 Minor update

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

require_once('customize-admin-options.php');

add_action('login_head', 'custom_login_logo', 99);
add_filter('login_headerurl', 'custom_login_logo_url');
add_filter('login_headertitle', 'custom_login_logo_title');

/* Title attribute for the logo on the login screen */
function custom_login_logo_title($message) {
	if (get_option('custom_admin_logo_link') != '')
		printf(__("Go to %s"), get_option('custom_admin_logo_link'));
	else
		printf(__("Return to %s"), get_bloginfo('name'));
}

/* URL for the logo on the login screen */
function custom_login_logo_url($url) {
	if (get_option('custom_admin_logo_link') != '')
		return get_option('custom_admin_logo_link');
	else
		return get_bloginfo('siteurl');
}

/* CSS for custom logo on the login screen */
function custom_login_logo() {
	if (get_option('custom_admin_logo_file_location') != '')
		echo '<style>h1 a { background-image:url("' . get_option('custom_admin_logo_file_location') . '")!important; }</style>';
	else
		$stylesheet_uri = get_bloginfo('siteurl') . '/' . PLUGINDIR . '/' . dirname(plugin_basename(__FILE__)) . '/customize-admin.css';
		echo '<link rel="stylesheet" type="text/css" href="' . $stylesheet_uri . '" />';
}
	
?>