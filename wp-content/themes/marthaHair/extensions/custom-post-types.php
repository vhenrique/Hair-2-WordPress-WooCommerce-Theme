<?php
// Celebrity register
	add_action('init', 'celebrity_register');
	function celebrity_register(){
		$singular_label = 'celebridade';
		$labels = array(
			'name'					=> __('Celebridades'),
			'singular_name'			=> __('Celebridade'),
			'add_new'				=> __('Adicionar nova'),
			'add_new_item'			=> __('Adicionar nova').' '.$singular_label,
			'edit_item'				=> __('Editar').' '.$singular_label,
			'new_item'				=> __('Nova').' '.$singular_label,
			'view_item'				=> __('Ver').' '.$singular_label,
			'search_items'			=> __('Procurar').' '.$singular_label,
			'not_found'				=> __('Nada encontrado'),
			'not_found_in_trash'	=> __('Nada encontrado no lixo'),
		);
		$args = array(
			'labels'				=> $labels,
			'public'				=> true,
			'publicly_queryable'	=> true,
			'show_ui'				=> true,
			'query_var'				=> true,
			'show_in_nav_menus' 	=> true,
			'capability_type'		=> 'post',
			'menu_icon' 			=> 'dashicons-tag',
			'hierarchical'			=> false,
			'menu_position'			=> 7,
			'has_archive'			=> true,
			'exclude_from_search'	=> true,
			'supports'				=> array('title', 'thumbnail', 'excerpt', 'comments'),
			'taxonomies'			=> array('category')
		);
		register_post_type('celebridades', $args);
	}

// Hair register
	add_action('init', 'hair_register');
	function hair_register(){
		$singular_label = 'cabelo';
		$labels = array(
			'name'					=> __('Cabelos'),
			'singular_name'			=> __('Cabelo'),
			'add_new'				=> __('Adicionar novo'),
			'add_new_item'			=> __('Adicionar novo').' '.$singular_label,
			'edit_item'				=> __('Editar').' '.$singular_label,
			'new_item'				=> __('Novo').' '.$singular_label,
			'view_item'				=> __('Ver').' '.$singular_label,
			'search_items'			=> __('Procurar').' '.$singular_label,
			'not_found'				=> __('Nada encontrado'),
			'not_found_in_trash'	=> __('Nada encontrado no lixo'),
		);
		$args = array(
			'labels'				=> $labels,
			'public'				=> true,
			'publicly_queryable'	=> true,
			'show_ui'				=> true,
			'query_var'				=> true,
			'show_in_nav_menus' 	=> true,
			'capability_type'		=> 'post',
			'menu_icon' 			=> 'dashicons-tag',
			'hierarchical'			=> false,
			'menu_position'			=> 7,
			'has_archive'			=> true,
			'exclude_from_search'	=> true,
			'supports'				=> array('title', 'thumbnail', 'excerpt', 'comments'),
			'taxonomies'			=> array('category')
		);
		register_post_type('cabelos', $args);
	}

// Media register
	add_action('init', 'media_register');
	function media_register(){
		$singular_label = 'mídia';
		$labels = array(
			'name'					=> __('Mídias'),
			'singular_name'			=> __('Mídia'),
			'add_new'				=> __('Adicionar nova'),
			'add_new_item'			=> __('Adicionar nova').' '.$singular_label,
			'edit_item'				=> __('Editar').' '.$singular_label,
			'new_item'				=> __('Nova').' '.$singular_label,
			'view_item'				=> __('Ver').' '.$singular_label,
			'search_items'			=> __('Procurar').' '.$singular_label,
			'not_found'				=> __('Nada encontrado'),
			'not_found_in_trash'	=> __('Nada encontrado no lixo'),
		);
		$args = array(
			'labels'				=> $labels,
			'public'				=> true,
			'publicly_queryable'	=> true,
			'show_ui'				=> true,
			'query_var'				=> true,
			'show_in_nav_menus' 	=> true,
			'capability_type'		=> 'post',
			'menu_icon' 			=> 'dashicons-tag',
			'hierarchical'			=> false,
			'menu_position'			=> 7,
			'has_archive'			=> true,
			'exclude_from_search'	=> true,
			'supports'				=> array('title', 'thumbnail', 'editor', 'excerpt', 'comments'),
			'taxonomies'			=> array('post_tag', 'category')
		);
		register_post_type('midia', $args);
	}

// Media register
	add_action('init', 'prothesis_register');
	function prothesis_register(){
		$singular_label = 'prótese';
		$labels = array(
			'name'					=> __('Próteses'),
			'singular_name'			=> __('Prótese'),
			'add_new'				=> __('Adicionar nova'),
			'add_new_item'			=> __('Adicionar nova').' '.$singular_label,
			'edit_item'				=> __('Editar').' '.$singular_label,
			'new_item'				=> __('Nova').' '.$singular_label,
			'view_item'				=> __('Ver').' '.$singular_label,
			'search_items'			=> __('Procurar').' '.$singular_label,
			'not_found'				=> __('Nada encontrado'),
			'not_found_in_trash'	=> __('Nada encontrado no lixo'),
		);
		$args = array(
			'labels'				=> $labels,
			'public'				=> true,
			'publicly_queryable'	=> true,
			'show_ui'				=> true,
			'query_var'				=> true,
			'show_in_nav_menus' 	=> true,
			'capability_type'		=> 'post',
			'menu_icon' 			=> 'dashicons-tag',
			'hierarchical'			=> false,
			'menu_position'			=> 7,
			'has_archive'			=> true,
			'exclude_from_search'	=> true,
			'supports'				=> array('title', 'thumbnail', 'excerpt', 'comments'),
			'taxonomies'			=> array('category')
		);
		register_post_type('proteses', $args);
	}

// What people are talking about us
	add_action('init', 'opinions_register');
	function opinions_register(){
		$singular_label = 'opinião';
		$labels = array(
			'name'					=> __('Opiniões'),
			'singular_name'			=> __('Opinião'),
			'add_new'				=> __('Adicionar nova'),
			'add_new_item'			=> __('Adicionar nova').' '.$singular_label,
			'edit_item'				=> __('Editar').' '.$singular_label,
			'new_item'				=> __('Nova').' '.$singular_label,
			'view_item'				=> __('Ver').' '.$singular_label,
			'search_items'			=> __('Procurar').' '.$singular_label,
			'not_found'				=> __('Nada encontrado'),
			'not_found_in_trash'	=> __('Nada encontrado no lixo'),
		);
		$args = array(
			'labels'				=> $labels,
			'public'				=> true,
			'publicly_queryable'	=> true,
			'show_ui'				=> true,
			'query_var'				=> true,
			'show_in_nav_menus' 	=> true,
			'capability_type'		=> 'post',
			'menu_icon' 			=> 'dashicons-tag',
			'hierarchical'			=> false,
			'menu_position'			=> 7,
			'has_archive'			=> true,
			'exclude_from_search'	=> true,
			'supports'				=> array('title', 'excerpt', 'thumbnail'),
			'taxonomies'			=> array('category')
		);
		register_post_type('opinioes', $args);
	}

// Hair band
	add_action('init', 'hairBand_register');
	function hairBand_register(){
		$singular_label = 'Faixa de cabelo';
		$labels = array(
			'name'					=> __('Faixas de cabelo'),
			'singular_name'			=> __('Faixa de cabelo'),
			'add_new'				=> __('Adicionar nova'),
			'add_new_item'			=> __('Adicionar nova').' '.$singular_label,
			'edit_item'				=> __('Editar').' '.$singular_label,
			'new_item'				=> __('Nova').' '.$singular_label,
			'view_item'				=> __('Ver').' '.$singular_label,
			'search_items'			=> __('Procurar').' '.$singular_label,
			'not_found'				=> __('Nada encontrado'),
			'not_found_in_trash'	=> __('Nada encontrado no lixo'),
		);
		$args = array(
			'labels'				=> $labels,
			'public'				=> true,
			'publicly_queryable'	=> true,
			'show_ui'				=> true,
			'query_var'				=> true,
			'show_in_nav_menus' 	=> true,
			'capability_type'		=> 'post',
			'menu_icon' 			=> 'dashicons-tag',
			'hierarchical'			=> false,
			'menu_position'			=> 7,
			'has_archive'			=> true,
			'exclude_from_search'	=> true,
			'supports'				=> array('title', 'excerpt', 'thumbnail'),
			'taxonomies'			=> array('category')
		);
		register_post_type('faixas', $args);
	}

// Before and after
	add_action('init', 'beforeAfter_register');
	function beforeAfter_register(){
		$singular_label = 'Antes e depois';
		$labels = array(
			'name'					=> __('Antes e depois'),
			'singular_name'			=> __('Antes e depois'),
			'add_new'				=> __('Adicionar novo'),
			'add_new_item'			=> __('Adicionar novo').' '.$singular_label,
			'edit_item'				=> __('Editar').' '.$singular_label,
			'new_item'				=> __('Nova').' '.$singular_label,
			'view_item'				=> __('Ver').' '.$singular_label,
			'search_items'			=> __('Procurar').' '.$singular_label,
			'not_found'				=> __('Nada encontrado'),
			'not_found_in_trash'	=> __('Nada encontrado no lixo'),
		);
		$args = array(
			'labels'				=> $labels,
			'public'				=> true,
			'publicly_queryable'	=> true,
			'show_ui'				=> true,
			'query_var'				=> true,
			'show_in_nav_menus' 	=> true,
			'capability_type'		=> 'post',
			'menu_icon' 			=> 'dashicons-tag',
			'hierarchical'			=> false,
			'menu_position'			=> 7,
			'has_archive'			=> true,
			'exclude_from_search'	=> true,
			'supports'				=> array('title', 'editor', 'thumbnail'),
			'taxonomies'			=> array('category')
		);
		register_post_type('antesedepois', $args);
	}
?>