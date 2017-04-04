<?php
// Theme prefix
	global $themePrefix;
	$themePrefix = "_vhs_";

// Define templateurl
	define('TEMPLATEURL', get_template_directory_uri());

// Make theme available for translation
	load_theme_textdomain('lang', TEMPLATEPATH . '/languages');

// Location defaults
	date_default_timezone_set('Brazil/East');
	setlocale(LC_ALL, 'pt_BR');
	define("CHARSET", "utf-8");

// Set content width
	if(!isset($content_width)) $content_width = 640;

// Register navigation menus
	add_theme_support('nav-menus');
	register_nav_menus(array('menu'=>'Menu', 'footer'=>'Rodapé'));

// Register sidebar
	if(function_exists('register_sidebar')){
		register_sidebar(array('name'=>'Sidebar','before_widget'=>'<div class="widget">','after_widget'=>'</div>','before_title'=>'<h3>','after_title'=>'</h3>'));
	}

// Register post thumbnail sizes
	add_theme_support('post-thumbnails', array('celebridades', 'cabelos', 'midia', 'page', 'proteses', 'opinioes', 'faixas', 'antesedepois'));
	add_image_size('midiaNews', 70, 70, true);
	add_image_size('opinionIcon', 100, 100, true);
	add_image_size('bands', 136, 136, true);
	add_image_size('celebrityListHome', 190, 190, true);
	add_image_size('hairList', 235, 405, false);
	add_image_size('mediaListHome', 335, 225, true);
	add_image_size('celebrityList', 395, 359, false);
	add_image_size('singleSlider', 405, 510, true);
	add_image_size('page', 515);
	add_image_size('relatedList', 550, 550, true);
	add_image_size('midiaList', 810, 547, true);
	add_image_size('mainSlider', 1920, 700, true);

// Enqueue scripts
	add_action('wp_enqueue_scripts', 'vhs_enqueue_scripts');
	function vhs_enqueue_scripts(){
		wp_enqueue_script('layerslider', get_template_directory_uri().'/assets/js/layerslider.js', array('jquery'), '', true);
		wp_enqueue_script('classie', get_template_directory_uri().'/assets/js/classie.js', array('jquery'), '', true);
		wp_enqueue_script('custom', get_template_directory_uri().'/assets/js/custom.js', array('jquery'), '', true);
		wp_enqueue_script('sticky', get_template_directory_uri().'/assets/js/jquery.sticky.min.js', array('jquery'), '', true);
		wp_enqueue_script('jsplugins', get_template_directory_uri().'/assets/js/jsplugins.js', array('jquery'), '', true);
		wp_enqueue_script('modernizr', get_template_directory_uri().'/assets/js/modernizr.min.js', array('jquery'), '', true);
		wp_enqueue_script('photostack', get_template_directory_uri().'/assets/js/photostack.js', array('jquery'), '', true);

		if(is_single()){
			wp_enqueue_script('whatsApp', get_template_directory_uri().'/assets/js/whatsapp-button.js', array('jquery'), '', true);
		}
	}

// Admin extensions
	$extensions_path = TEMPLATEPATH . '/extensions/';
	if(file_exists($extensions_path . 'custom-post-types.php')) require_once($extensions_path . 'custom-post-types.php');
	if(file_exists($extensions_path . 'custom-post-taxonomies.php')) require_once($extensions_path . 'custom-post-taxonomies.php');
	if(file_exists($extensions_path . 'custom-functions.php')) require_once($extensions_path . 'custom-functions.php');
	if(file_exists($extensions_path . 'custom-wordpress-tweeks.php')) require_once($extensions_path . 'custom-wordpress-tweeks.php');
	if(file_exists($extensions_path . 'custom-shortcodes.php')) require_once($extensions_path . 'custom-shortcodes.php');

// Custom theme options
	if(!class_exists('ReduxFramework') && file_exists($extensions_path . 'redux/framework.php')) require_once($extensions_path . 'redux/framework.php');
	if(file_exists($extensions_path . 'custom-theme-options.php')) require_once($extensions_path . 'custom-theme-options.php');

// Custom metaboxes
	add_action('init', 'vhs_admin_init');
	function vhs_admin_init(){
		if(file_exists($extensions_path . 'custom-metaboxes/init.php')) require_once($extensions_path . 'custom-metaboxes/init.php');
	}
	if(file_exists($extensions_path . 'custom-post-meta.php')) require_once($extensions_path . 'custom-post-meta.php');

// Admin footer info
	function admin_footer(){
	    echo '<div id="wpfooter" role="contentinfo">';
		echo sprintf('<p id="footer-left" class="alignleft"><span id="footer-thankyou">Theme developped by <a href="%s" title="%s" target="_BLANK">vhenrique</a>. Thanks for use!</span></p>', 'http://vhenrique.com', 'Vhenrique portfolio.');
		echo sprintf('<p id="footer-upgrade" class="alignright"><a href="%s" title="%s"><img src="%s" width="50px"/></a></p>', 'http://vhenrique.com', 'Vhenrique portfolio.', TEMPLATEURL.'/screenshot.png');
		echo '<div class="clear"></div></div>';
	}
	add_action( 'admin_footer', 'admin_footer' );
	add_filter( 'update_footer', '__return_empty_string', 11 );
?>