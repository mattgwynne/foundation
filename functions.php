<?php

// Loads style.css and extra.css in the front end
function mytheme_extra_style() {
	    wp_enqueue_style('mytheme_main_style', get_stylesheet_uri()); 
     wp_enqueue_style('mytheme_extra_style', get_theme_file_uri('/assets/css/extra.css'));
}
add_action( 'wp_enqueue_scripts', 'mytheme_extra_style' );


// Loads style.css in the editor
function foundation_add_editor_style(){
	add_editor_style('/style.css');
	add_editor_style('/assets/css/extra.css');
   }
add_action('after_setup_theme','foundation_add_editor_style');


/**
 * Add block style variations.
 */
function register_block_styles() {

	$block_styles = array(
		'core/button'                    => array(
			'arrow-button'     => __( 'Arrow Button', ),
			'minimal'     => __( 'Minimal', ),
		),
		'core/image'                    => array(
			'radius-image'     => __( 'Radius Image', ),
			'position-absolute-left'  => __('Position Absolue Left'),
			'position-absolute-right'  => __('Position Absolue Right'),
			'position-absolute-bottom'  => __('Position Absolue Bottom'),
		),
		'core/group'                    => array(
			'minimal-card'     => __( 'Minimal Card', ),
		),
		'core/list'                      => array(
			'list-check'        => __( 'Check', 'foundation' ),
			'list-check-circle' => __( 'Check Circle', 'foundation' ),
			'list-boxed'        => __( 'Boxed', 'foundation' ),
		),
		'core/code'                      => array(
			'dark-code' => __( 'Dark', 'foundation' ),
		),
		'core/cover'                     => array(
			'blur-image-less' => __( 'Blur Image Less', 'foundation' ),
			'blur-image-more' => __( 'Blur Image More', 'foundation' ),
			'cover-hover'   => __( 'Hover Cover', 'foundation' ),
			'reverse-cover-hover'   => __( 'Reverse Cover Hover', 'foundation' ),
			'cover-hover-blur'   => __( 'Cover Hover Blur', 'foundation' ),

		),
		'core/post-excerpt'              => array(
			'excerpt-truncate-2' => __( 'Truncate 2 Lines', 'foundation' ),
			'excerpt-truncate-3' => __( 'Truncate 3 Lines', 'foundation' ),
			'excerpt-truncate-4' => __( 'Truncate 4 Lines', 'foundation' ),
		),
		'core/separator'                 => array(
			'separator-dotted' => __( 'Dotted', 'foundation' ),
			'separator-thin'   => __( 'Thin', 'foundation' ),
		),
		'core/post-terms'                => array(
			'term-button' => __( 'Button Style', 'ollie' ),
		),
	);

	foreach ( $block_styles as $block => $styles ) {
		foreach ( $styles as $style_name => $style_label ) {
			register_block_style(
				$block,
				array(
					'name'  => $style_name,
					'label' => $style_label,
				)
			);
		}
	}
}
add_action( 'init', __NAMESPACE__ . '\register_block_styles' );



/**
 * Load custom block styles only when the block is used.
 */
function enqueue_custom_block_styles() {

	// Scan our styles folder to locate block styles.
	$files = glob( get_template_directory() . '/assets/css/*.css' );

	foreach ( $files as $file ) {

		// Get the filename and core block name.
		$filename   = basename( $file, '.css' );
		$block_name = str_replace( 'core-', 'core/', $filename );

		wp_enqueue_block_style(
			$block_name,
			array(
				'handle' => "foundation-block-{$filename}",
				'src'    => get_theme_file_uri( "assets/css/{$filename}.css" ),
				'path'   => get_theme_file_path( "assets/css/{$filename}.css" ),
			)
		);
	}
}
add_action( 'init', __NAMESPACE__ . '\enqueue_custom_block_styles' );




