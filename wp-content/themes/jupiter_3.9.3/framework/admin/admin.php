<?php
class Theme_admin {
	function init(){
		$this->functions();
		add_action('admin_menu', array(&$this,'menus'));
		$this->theme_activated();

	}
	

	
	
	
	function functions(){
		include_once (THEME_ADMIN . '/general/general-functions.php');
		include_once (THEME_ADMIN . '/general/mega-menu.php');
		include_once (THEME_ADMIN . '/generators/option-generator.php');
		include_once (THEME_ADMIN . '/general/backend-enqueue-scripts.php');
		include_once (THEME_ADMIN . '/admin-panel/masterkey-ajax-calls.php');

		
		
		include_once (THEME_GENERATORS . '/metabox-generator.php');
		include_once (THEME_METABOXES . '/metabox-pages.php');
		include_once (THEME_METABOXES . '/metabox-posts.php');
		include_once (THEME_METABOXES . '/metabox-employee.php');
		include_once (THEME_METABOXES . '/metabox-slideshow.php');
		include_once (THEME_METABOXES . '/metabox-clients.php');
		include_once (THEME_METABOXES . '/metabox-testimonials.php');
		include_once (THEME_METABOXES . '/metabox-icarousel.php');
		include_once (THEME_METABOXES . '/metabox-pricing.php');
		include_once (THEME_METABOXES . '/metabox-banner-video.php');
		include_once (THEME_METABOXES . '/metabox-news.php');
		include_once (THEME_METABOXES . '/metabox-edge.php');
		include_once (THEME_METABOXES . '/metabox-portfolios.php');
		include_once (THEME_METABOXES . '/metabox-posts-slideshow.php');
		include_once (THEME_METABOXES . '/metabox-skinning.php');
		
		include_once (THEME_ADMIN_POST_TYPES . '/portfolio.php');
		include_once (THEME_ADMIN_POST_TYPES . '/news.php');
		include_once (THEME_ADMIN_POST_TYPES . '/faq.php');
		include_once (THEME_ADMIN_POST_TYPES . '/employee.php');
		include_once (THEME_ADMIN_POST_TYPES . '/pricing.php');	
		include_once (THEME_ADMIN_POST_TYPES . '/clients.php');
		include_once (THEME_ADMIN_POST_TYPES . '/testimonials.php');
		include_once (THEME_ADMIN_POST_TYPES . '/slideshow.php');
		include_once (THEME_ADMIN_POST_TYPES . '/edge_slider.php');
		include_once (THEME_ADMIN_POST_TYPES . '/icarousel.php');
		include_once (THEME_ADMIN_POST_TYPES . '/banner_builder.php');
		
		
	}
	



	function menus(){
		add_menu_page(__( 'Theme Options', 'mk_framework' ), __( 'Theme Options', 'mk_framework' ), 'edit_theme_options', 'masterkey', array(&$this,'_load_option_page'), 'dashicons-admin-network');

	}
	
	
	function theme_activated(){
		if ('themes.php' == basename($_SERVER['PHP_SELF']) && isset($_GET['activated']) && $_GET['activated']=='true' ) {
			update_option('woocommerce_enable_lightbox', "no");
			wp_redirect( admin_url('admin.php?page=masterkey') );
		}
	}
	
	
		function _load_option_page(){
		
			$page = include(THEME_ADMIN . '/admin-panel/masterkey.php');
			new mkOptionGenerator($page['name'],$page['options']);
		}


}
