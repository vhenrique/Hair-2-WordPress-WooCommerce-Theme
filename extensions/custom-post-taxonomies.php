<?php 
	// Products
	add_action( 'init', 'create_custom_tax_types');
	function create_custom_tax_types() {
		$singular_label = 'tom';
		$labels = array(
			'name'					=> _x( 'Tons', 'taxonomy general name' ),
			'singular_name'			=> _x( 'Tons', 'taxonomy singular name' ),
			'search_items'			=> __( 'Procurar' ),
			'all_items'				=> __( 'Todos' ),
			'edit_item'				=> __( 'Editar' ),
			'update_item'			=> __( 'Alterar' ),
			'add_new_item'			=> __( 'Novo ' ) . $singular_label,
			'new_item_name'			=> __( 'Novo ' ) . $singular_label,
			'menu_name'				=> __( 'Tons' )
		);
		$args = array(
			'hierarchical'			=> true,
			'labels'				=> $labels,
			'show_ui'				=> true,
			'show_admin_column'		=> true,
			'capability_type'     	=> 'post',
			'query_var'				=> true,
			'rewrite'				=> array( 'slug' => 'tax_tones' ),
			'has_archive'			=> false,
			'exclude_from_search'	=> true,
			'supports'				=> array('title'),
		);
		register_taxonomy('tax_tones', array('cabelos'), $args );
	}
?>