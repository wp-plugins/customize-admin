<?php

// Create custom plugin settings menu
add_action('admin_menu', 'custom_admin_create_menu');
function custom_admin_create_menu() {

	// Create a submenu page in the 'Settings' menu
	add_submenu_page( 'options-general.php', 'Customize Admin', 'Customize Admin', 'manage_options', 'customize-admin/customize-admin-options.php', 'custom_admin_settings_page');

	// Call register settings function
	add_action( 'admin_init', 'register_mysettings' );
}

// Register the settings
function register_mysettings() {
	register_setting( 'custom-admin-settings-group', 'custom_admin_logo_file_location' );
	register_setting( 'custom-admin-settings-group', 'custom_admin_logo_link' );
}

// Include files for media uploader
function my_admin_scripts() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_register_script('my-upload', WP_PLUGIN_URL.'/customize-admin/customize-admin.js', array('jquery','media-upload','thickbox'));
	wp_enqueue_script('my-upload');
}

function my_admin_styles() {
	wp_enqueue_style('thickbox');
}

// Only include media uploader scripts and styles on custmize options page
if (isset($_GET['page']) && $_GET['page'] == 'customize-admin/customize-admin-options.php') {
	add_action('admin_print_scripts', 'my_admin_scripts');
	add_action('admin_print_styles', 'my_admin_styles');
}

function custom_admin_settings_page() { ?>
<div class="wrap">
<h2><?php _e('Customize Admin Options') ?></h2>
<form method="post" action="options.php">
    <?php settings_fields( 'custom-admin-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
            <th scope="row"><?php _e('Custom Logo Link') ?></th>
            <td><label for="custom_admin_logo_link">
                <input type="text" id="custom_admin_logo_link" name="custom_admin_logo_link" value="<?php echo get_option('custom_admin_logo_link'); ?>" />
                <br /><?php _e('If not specified, clicking on the logo will return you to the homepage.') ?>
                </label>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row"><?php _e('Custom Logo') ?></th>
            <td><label for="upload_image">
                <input id="upload_image" type="text" size="36" name="custom_admin_logo_file_location" value="<?php echo get_option('custom_admin_logo_file_location'); ?>" />
                <input id="upload_image_button" type="button" value="Upload Image" />
                <br /><?php _e('Enter a URL or upload an image for the banner.') ?>
                </label>
            </td>
        </tr>
    </table>
    <p class="submit">
        <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    </p>
</form>
</div>
<?php } ?>