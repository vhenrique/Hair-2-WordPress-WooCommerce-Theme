<?php
// Remove junk from head
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'feed_links', 2);
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'feed_links_extra', 3);
	remove_action('wp_head', 'start_post_rel_link', 10, 0);
	remove_action('wp_head', 'parent_post_rel_link', 10, 0);
	remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
	
// Add page excerpt
	add_action('init', 'vhs_add_excerpt_to_pages');
	function vhs_add_excerpt_to_pages(){
		add_post_type_support('page', 'excerpt');
	}

// Remove default post type
	add_action('admin_menu','remove_default_post_type');
	function remove_default_post_type() {
		remove_menu_page('edit.php');
	}

// Allow editor to manager widgets and menus
	if(is_admin()){
		$role =& get_role('editor');
		$role->add_cap('edit_theme_options');
		$role->add_cap('manage_options');
		$role->add_cap('manage_polls');
		$role->remove_cap('switch_themes');
	}

// Add rel to wordpress galleries
	add_filter('wp_get_attachment_link', 'vhs_add_gallery_id_rel');
	function vhs_add_gallery_id_rel($link){
		global $post;
		return str_replace('<a href', '<a rel="fancybox" href', $link);
	}

// Remove the WP version from the header
	add_filter('the_generator', 'vhs_remove_wp_version');
	function vhs_remove_wp_version(){
		return '';
	}

// Add a class to the navigation buttons
	add_filter('next_posts_link_attributes', 'vhs_posts_link_attributes');
	add_filter('previous_posts_link_attributes', 'vhs_posts_link_attributes');
	function vhs_posts_link_attributes(){
		return 'class="nav-links"';
	}
?>