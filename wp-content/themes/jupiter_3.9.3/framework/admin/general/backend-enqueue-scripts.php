<?php
function theme_admin_add_script()
{
     $theme_data = wp_get_theme("Jupiter");
     wp_enqueue_script('jquery-ui-tabs');
     wp_enqueue_script('jquery-ui-slider');
     wp_enqueue_style('wp-color-picker');
     wp_enqueue_script('wp-color-picker');
     wp_enqueue_script('admin-scripts', THEME_ADMIN_ASSETS_URI . '/js/jupiter-backend-scripts.js', array(
          'jquery'
     ), $theme_data['Version'], true);
     wp_enqueue_script('chosen', THEME_ADMIN_ASSETS_URI . '/js/chosen.min.js', array(
          'jquery'
     ), $theme_data['Version'], true);
}
function theme_admin_add_style()
{
     $theme_data = wp_get_theme("Jupiter");
     wp_enqueue_style('theme-style', THEME_ADMIN_ASSETS_URI . '/stylesheet/css/admin-styles.css');
     wp_enqueue_style('mk-fontawesome', THEME_STYLES . '/font-awesome.css', false, $theme_data['Version'], 'all');
     wp_enqueue_style('mk-icomoon', THEME_STYLES . '/icomoon-fonts.css', false, $theme_data['Version'], 'all');
}
if ((mk_theme_is_options() && mk_theme_is_masterkey()) || mk_theme_is_post_type()) {
     add_action('admin_init', 'theme_admin_add_script');
     add_action('admin_init', 'theme_admin_add_style');
     add_action('admin_head', 'add_script_to_head');
}
if (mk_theme_is_options() && mk_theme_is_masterkey()) {
     add_action('admin_init', 'mk_masterkey_specific_enqueue');
}
function mk_masterkey_specific_enqueue()
{
     wp_enqueue_style('mk-theme-icons', THEME_STYLES . '/theme-icons.css', false, false, 'all');
     if (function_exists('wp_enqueue_media')) {
          wp_enqueue_media();
     }
}
function add_script_to_head()
{
     echo '<script type="text/javascript">
		var mk_theme_admin_uri = "' . THEME_ADMIN_URI . '";
		var mk_theme_imges = "' . THEME_IMAGES . '";
	</script>';
}


