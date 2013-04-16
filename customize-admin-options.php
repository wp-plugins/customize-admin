<?php

// Create custom plugin settings menu
add_action( 'admin_menu', 'ca_create_menu' );
function ca_create_menu() {

	// Create a submenu page in the 'Settings' menu
	add_submenu_page( 'options-general.php', 'Customize Admin', 'Customize Admin', 'manage_options', 'customize-admin/customize-admin-options.php', 'ca_settings_page' );

	// Call register settings function
	add_action( 'admin_init', 'ca_register_settings' );
}

// Register the settings
function ca_register_settings() {
	register_setting( 'customize-admin-settings-group', 'ca_logo_file' );
	register_setting( 'customize-admin-settings-group', 'ca_logo_url' );
	register_setting( 'customize-admin-settings-group', 'ca_login_background_color' );
	register_setting( 'customize-admin-settings-group', 'ca_remove_shadow' );
	register_setting( 'customize-admin-settings-group', 'ca_remove_meta_generator' );
	register_setting( 'customize-admin-settings-group', 'ca_remove_meta_rsd' );
	register_setting( 'customize-admin-settings-group', 'ca_remove_meta_wlw' );
	register_setting( 'customize-admin-settings-group', 'ca_remove_dashboard_quick_press' );
	register_setting( 'customize-admin-settings-group', 'ca_remove_dashboard_plugins' );
	register_setting( 'customize-admin-settings-group', 'ca_remove_dashboard_recent_comments' );
	register_setting( 'customize-admin-settings-group', 'ca_remove_dashboard_wordpress_news' );
	register_setting( 'customize-admin-settings-group', 'ca_remove_dashboard_wordpress_other' );
	register_setting( 'customize-admin-settings-group', 'ca_custom_css' );
}

// Include files for media uploader
function ca_admin_scripts() {
	wp_register_script( 'my-upload', WP_PLUGIN_URL . '/customize-admin/customize-admin.js', array( 'jquery', 'media-upload', 'thickbox' ) );
	wp_enqueue_script( 'my-upload' );
	wp_enqueue_script( 'media-upload' );
	wp_enqueue_script( 'thickbox' );
	wp_enqueue_script( 'wp-color-picker' );
}

function ca_admin_styles() {
	wp_enqueue_style( 'thickbox' );
	wp_enqueue_style( 'wp-color-picker' );
}

// Only include media uploader scripts and styles on custmize options page
if ( isset( $_GET['page'] ) && $_GET['page'] == 'customize-admin/customize-admin-options.php' ) {
	add_action( 'admin_print_scripts', 'ca_admin_scripts' );
	add_action( 'admin_print_styles', 'ca_admin_styles' );
}

function ca_settings_page() { ?>
	<div class="wrap">
	<h2><?php _e( 'Customize Admin Options' ); ?></h2>
	<form method="post" action="options.php">
		<?php settings_fields( 'customize-admin-settings-group' ); ?>
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><?php _e( 'Custom Logo Link' ); ?></th>
				<td><label for="ca_logo_url">
					<input type="text" id="ca_logo_url" name="ca_logo_url" value="<?php echo get_option( 'ca_logo_url' ); ?>" />
					<p class="description"><?php _e( 'If not specified, clicking on the logo will return you to the homepage.' ); ?></p>
					</label>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php _e( 'Custom Logo' ) ?></th>
				<td><label for="upload_image">
					<input id="upload_image" type="text" size="36" name="ca_logo_file" value="<?php echo get_option( 'ca_logo_file' ); ?>" />
					<input id="upload_image_button" type="button" value="Upload Image" />
					<p class="description"><?php _e( 'Enter a URL or upload logo image. Maximum height: 70px, width: 310px.' ); ?></p>
					</label>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php _e( 'Custom Login Background' ); ?></th>
				<td><label for="ca_login_background_color">
					<input type="text" id="ca_login_background_color" class="color-picker" name="ca_login_background_color" value="<?php echo get_option( 'ca_login_background_color' ); ?>" />
					<p class="description"><?php _e( '' ); ?></p>
					</label>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php _e( 'Remove Admin Menu Shadow' ); ?></th>
				<td><label for="ca_remove_shadow">
					<input id="ca_remove_shadow" type="checkbox" name="ca_remove_shadow" value="1" <?php checked( '1', get_option( 'ca_remove_shadow' ) ); ?> />
					<p class="description"><?php _e( 'Selecting this option removes the shadow from the admin menu on the left.' ); ?></p>
					</label>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php _e( 'Remove Generator Meta Tag' ); ?></th>
				<td><label for="ca_remove_meta_generator">
					<input id="ca_remove_meta_generator" type="checkbox" name="ca_remove_meta_generator" value="1" <?php checked( '1', get_option( 'ca_remove_meta_generator' ) ); ?> />
					<p class="description"><?php _e( 'Selecting this option removes the generator meta tag from the html source.' ); ?></p>
					</label>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php _e( 'Remove RSD Meta Tag' ); ?></th>
				<td><label for="ca_remove_meta_rsd">
					<input id="ca_remove_meta_rsd" type="checkbox" name="ca_remove_meta_rsd" value="1" <?php checked( '1', get_option( 'ca_remove_meta_rsd' ) ); ?> />
					<p class="description"><?php _e( 'Selecting this option removes the RSD meta tag from the html source.' ); ?></p>
					</label>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php _e( 'Remove WLW Meta Tag' ); ?></th>
				<td><label for="ca_remove_meta_wlw">
					<input id="ca_remove_meta_wlw" type="checkbox" name="ca_remove_meta_wlw" value="1" <?php checked( '1', get_option( 'ca_remove_meta_wlw' ) ); ?> />
					<p class="description"><?php _e( 'Selecting this option removes the WLW meta tag from the html source.' ); ?></p>
					</label>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php _e( 'Remove Dashboard Widgets' ); ?></th>
				<td><label for="ca_remove_dashboard_quick_press">
					<input id="ca_remove_dashboard_quick_press" type="checkbox" name="ca_remove_dashboard_quick_press" value="1" <?php checked( '1', get_option( 'ca_remove_dashboard_quick_press' ) ); ?> /> <?php _e( 'Quick Press' ); ?>
					<p class="description"><?php _e( 'Selecting this option removes the Quick Press dashboard widget.' ); ?></p>
					</label>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"></th>
				<td><label for="ca_remove_dashboard_plugins">
					<input id="ca_remove_dashboard_plugins" type="checkbox" name="ca_remove_dashboard_plugins" value="1" <?php checked( '1', get_option( 'ca_remove_dashboard_plugins' ) ); ?> /> <?php _e( 'Plugins' ); ?>
					<p class="description"><?php _e( 'Selecting this option removes the plugins dashboard widget.' ); ?></p>
					</label>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"></th>
				<td><label for="ca_remove_dashboard_recent_comments">
					<input id="ca_remove_dashboard_recent_comments" type="checkbox" name="ca_remove_dashboard_recent_comments" value="1" <?php checked( '1', get_option( 'ca_remove_dashboard_recent_comments' ) ); ?> /> <?php _e( 'Recent Comments' ); ?>
					<p class="description"><?php _e( 'Selecting this option removes the recent comments dashboard widget.' ); ?></p>
					</label>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"></th>
				<td><label for="ca_remove_dashboard_wordpress_news">
					<input id="ca_remove_dashboard_wordpress_news" type="checkbox" name="ca_remove_dashboard_wordpress_news" value="1" <?php checked( '1', get_option( 'ca_remove_dashboard_wordpress_news' ) ); ?> /> <?php _e( 'WordPress Site News' ); ?>
					<p class="description"><?php _e( 'Selecting this option removes the WordPress Site News dashboard widget.' ); ?></p>
					</label>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"></th>
				<td><label for="ca_remove_dashboard_wordpress_other">
					<input id="ca_remove_dashboard_wordpress_other" type="checkbox" name="ca_remove_dashboard_wordpress_other" value="1" <?php checked( '1', get_option( 'ca_remove_dashboard_wordpress_other' ) ); ?> /> <?php _e( 'WordPress Other News' ); ?>
					<p class="description"><?php _e( 'Selecting this option removes the Other WordPress News dashboard widget.' ); ?></p>
					</label>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php _e( 'Custom CSS' ); ?></th>
				<td>
					<textarea id="ca_custom_css" name="ca_custom_css" cols="70" rows="5"><?php echo get_option( 'ca_custom_css' ); ?></textarea>
					<p class="description"><?php _e( 'Add your own css to the WordPress dashboard.' ); ?></p>
				</td>
			</tr>
		</table>
		<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e( 'Save Changes' ); ?>" />
		</p>
	</form>
	</div>
<?php }; ?>