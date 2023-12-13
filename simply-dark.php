<?php
/**
* Plugin Name: Simply Dark
* Description: The simplest way to do a dark mode on the wp admin page.
* Author: Matt Jones
* Author URI: https://mattjones.tech
*
 */

 function sd_options_page_html() {
	// check user capabilities
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	?>
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form action="options.php" method="post">
			<?php
			// output security fields for the registered setting "wporg_options"
			settings_fields( 'sd_options' );
			// output setting sections and their fields
			// (sections are registered for "wporg", each field is registered to a specific section)
			do_settings_sections( 'simply-dark' );
			// output save settings button
			submit_button( __( 'Save Settings', 'textdomain' ) );
			?>
		</form>
	</div>
	<?php
}


function sd_init() {
   register_post_type('labs', [
      'label' => 'Labs',
      // .. ect
      'menu_icon' => 'data:image/svg+xml;base64,' . base64_encode('<svg width="20" height="20" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path fill="black" d="M1591 1448q56 89 21.5 152.5t-140.5 63.5h-1152q-106 0-140.5-63.5t21.5-152.5l503-793v-399h-64q-26 0-45-19t-19-45 19-45 45-19h512q26 0 45 19t19 45-19 45-45 19h-64v399zm-779-725l-272 429h712l-272-429-20-31v-436h-128v436z"/></svg>')
   ]);
}
add_action('init', 'sd_init');

//Activate Plugin
function sd_activate() { 
	// Trigger our function that registers the custom post type plugin.
	sd_create_admin_menu(); 
	// Clear the permalinks after the post type has been registered.
	flush_rewrite_rules(); 
}
register_activation_hook( __FILE__, 'sd_activate' );


function sd_options_page()
{
	add_submenu_page(
		'options-general.php',
		'Simply Dark',
		'Simply Dark',
		'manage_options',
		'simply-dark',
		'sd_options_page_html'
	);
}
add_action('admin_menu', 'sd_options_page');

 function sd_kill_the_lights() {
    wp_register_style('simply-dark', plugin_dir_url(__FILE__) . 'dark.css', array(), '1.0', 'all');
    wp_enqueue_style('simply-dark');
 }

 add_action('admin_enqueue_scripts', 'sd_kill_the_lights');

