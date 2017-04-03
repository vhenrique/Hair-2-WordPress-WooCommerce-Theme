<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_sample_metaboxes( array $meta_boxes ) {
	// Theme prefix
	global $themePrefix;
	// Hair 
	$meta_boxes['slider_metabox'] = array(
		'id'         => 'slider_metabox',
		'title'      => 'Itens adicionais',
		'pages'      => array('cabelos'),
		'context'    => 'normal',
		'priority'   => 'low',
		'show_names' => true,
		'fields'     => array(
			array(
				'name' => 'Imagens',
				'desc' => 'Adicione as imagens que farão parte do seu slider.',
				'id'   => $themePrefix . 'imgFiles',
				'type' => 'file_list'
			)
		)
	);

	// Opinion
	$meta_boxes['opinion_metabox'] = array(
		'id'         => 'opinion_metabox',
		'title'      => 'Itens adicionais',
		'pages'      => array('opinioes'),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(
			array(
				'name' => 'Autor',
				'desc' => 'Informe o nome da pessoa.',
				'id'   => $themePrefix . 'opinion_author',
				'type' => 'text',
			),
			array(
				'name' => 'Onde',
				'desc' => 'instituição, empresa, revista, etc',
				'id'   => $themePrefix . 'opinion_where',
				'type' => 'text',
			),
			array(
				'name' => 'Vídeo',
				'desc' => 'Url do vídeo',
				'id'   => $themePrefix . 'opinion_video',
				'type' => 'oembed',
			)
		)
	);	

	// Celebrity
	$meta_boxes['celebrity_metabox'] = array(
		'id'         => 'celebrity_metabox',
		'title'      => 'Itens adicionais',
		'pages'      => array('celebridades'),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(
			array(
				'name' => 'Destaque',
				'desc' => 'Manter esta celebridade em destaque na Home page.',
				'id'   => $themePrefix . 'featured',
				'type' => 'checkbox',
			)
		)
	);
	return $meta_boxes;
}

// Initialize the metabox class.
add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
function cmb_initialize_cmb_meta_boxes() {
	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'custom-metaboxes/init.php';
}