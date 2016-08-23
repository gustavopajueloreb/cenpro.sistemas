<?php
/* ----------------------------------------------------------------------
	Plugin Name:	WIP - Funciones
	Plugin URI:		http://www.webideaperu.net
	Description:	Funciones necesarias para el funcionamiento de los temas
	Version:		1.2.WIP-20160219
	Author:			Gustavo Pajuelo Vargas
	Author URI:		http://www.webideaperu.net
 * ---------------------------------------------------------------------- */

/**
 * Table of contents
 *
 *		System
 *		Optimization
 *		Security
 *		
 */

/*-----------------------------------------------------------------------------------*/
/*		System
/*-----------------------------------------------------------------------------------*/

/**
 * Measurement in footer
 *-------------------------------------------------*
 * @link http://codex.wordpress.org/Plugin_API/Action_Reference/wp_footer
 */
function wip_funciones_measurement_in_footer() {
	// if user administrator
	if (current_user_can('administrator')) {
		
$rebistaversion = 'General 1.2.WIP';

		echo '<style>.wip_ {	clear: both;	background: #ccc;	padding: 10px 150px;	height: 60px;	line-height: 25px;	}</style>
			<div class="wip_"><strong>Modelo ' . $rebistaversion . '</strong><br />' . round(memory_get_usage() / 1048576,2) . ' MB. '. get_num_queries() .' consultas. '. timer_stop() .' segundos.</div>';
	}
}
add_action('wp_footer', 'wip_funciones_measurement_in_footer', 100);


/**
 *	Link Back to Your WordPress Site from Copy & Pasted Text
 *-------------------------------------------------*
 * @link http://wpmu.org/wordpress-copied-text-link-back/
 */
function wip_funciones_add_copyright_text() {
	if (is_single()) { ?>

<script type='text/javascript'>
function wip_funciones_add_link() {
    if (
window.getSelection().containsNode(
document.getElementsByClassName('entry-content')[0], true)) {
    var body_element = document.getElementsByTagName('body')[0];
    var selection;
    selection = window.getSelection();
    var oldselection = selection
    var pagelink = "<br /><br /> Fuente: <a href='<?php echo get_permalink(get_the_ID()); ?>'><?php echo get_permalink(get_the_ID()); ?></a>";
    var copy_text = selection + pagelink;
    var new_div = document.createElement('div');
    new_div.style.left='-99999px';
    new_div.style.position='absolute';

    body_element.appendChild(new_div );
    new_div.innerHTML = copy_text ;
    selection.selectAllChildren(new_div );
    window.setTimeout(function() {
        body_element.removeChild(new_div );
    },0);
}
}
document.oncopy = wip_funciones_add_link;
</script>
<?php
	}
}
add_action( 'wp_head', 'wip_funciones_add_copyright_text');



/*-----------------------------------------------------------------------------------*/
/*		Optimization
/*-----------------------------------------------------------------------------------*/
/**
 * Loading jQuery from the Google CDN 	
 *-------------------------------------------------*
 */
// register from google and for footer
function wip_funciones_jquery() {
	if (!is_admin()) {
		// remove the default jQuery script
		wp_deregister_script('jquery');
		wp_deregister_script('jquery-migrate');  
		// register the Google hosted Version
		wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"), false, '', true);
		wp_register_script('jquery-migrate', ("https://code.jquery.com/jquery-migrate-1.4.1.min.js"), array('jquery'), '', true);
		  
		// add it back into the queue
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-migrate');
		}
	}
// even more smart jquery inclusion :)
add_action('init', 'wip_funciones_jquery');

/**
 *	Better jpg quality
 *-------------------------------------------------*
 */
function wip_funciones_jpeg_quality($arg) {
	return (int)100;
}
add_filter('jpeg_quality', 'wip_funciones_jpeg_quality');

/**
 *	Set the post revisions limit
 *-------------------------------------------------*
 */
if (!defined('WP_POST_REVISIONS')) define('WP_POST_REVISIONS', 5);

/*-----------------------------------------------------------------------------------*/
/*			Security
/*-----------------------------------------------------------------------------------*/
/**
 *	Change login errors EN EVALUACION
 *-------------------------------------------------*
 */
function wip_funciones_wrong_login() {
	return 'Wrong username or password.';
}
add_filter('login_errors', 'wip_funciones_wrong_login');


/**
 *	Disable File Editor
 *-------------------------------------------------*
 */
define('DISALLOW_FILE_EDIT', true);


/**
 * Disable updates for plugins
 *-------------------------------------------------*
 */
// Disable all the Nags & Notifications
function remove_core_updates(){
global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
}
add_filter('pre_site_transient_update_core','remove_core_updates');
add_filter('pre_site_transient_update_plugins','remove_core_updates');
add_filter('pre_site_transient_update_themes','remove_core_updates');


/**
 *	Remove unnecessary meta elements from head
 *-------------------------------------------------*
 */
remove_action('wp_head', 'rsd_link');					//<link rel="EditURI" type="application/rsd+xml" title="RSD" href="/wp/xmlrpc.php?rsd" />
//remove_action('wp_head', 'wp_generator');				//<meta name="generator" content="Bluefish 2.2.5" />
remove_action('wp_head', 'feed_links', 2);			//rel="alternate" type="application/rss+xml" //feed y comments feed
remove_action('wp_head', 'wp_shortlink_wp_head');	//rel='shortlink'
remove_action('wp_head', 'wlwmanifest_link');		//rel="wlwmanifest" type="application/wlwmanifest+xml"
remove_action('wp_head', 'feed_links_extra', 3);	//rel="alternate" type="application/rss+xml" title="sitios de pruebas &raquo; otro post Comments Feed" href="http://127.0.0.1/wordpress3.4/otro-post/feed/" /

/* Removes prev and next article links */
add_filter( 'index_rel_link', '__return_false' );
add_filter( 'parent_post_rel_link', '__return_false' );
add_filter( 'start_post_rel_link', '__return_false' );
add_filter( 'previous_post_rel_link', '__return_false' );
add_filter( 'next_post_rel_link', '__return_false' );

/* Remove the WordPress Version Number - The Right Way */
function remove_wp_version() { return ''; }
add_filter('the_generator', 'remove_wp_version');

/* Stop Adding Functions Below this Line */
?>
