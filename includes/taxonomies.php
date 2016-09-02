<?php
/**
 * File for registering custom taxonomies.
 *
 * @package    WC Custom Post Types
 * @since      1.1
 * @author     Chris Baldelomar <chris@webplantmedia.com>
 * @copyright  Copyright (c) 2013, Chris Baldelomar
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/* Register taxonomies on the 'init' hook. */
add_action( 'init', 'wc_cpt_register_taxonomies' );

/**
 * Register taxonomies for the plugin.
 *
 * @since  0.1.0
 * @access public
 * @return void.
 */
function wc_cpt_register_taxonomies() {

	/* Get the plugin settings. */
	$settings = wc_cpt_get_plugin_settings();

	/* Set up the arguments for the portfolio taxonomy. */
	$args = array(
		'public'            => true,
		'show_ui'           => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => true,
		'show_admin_column' => true,
		'hierarchical'      => true,
		'query_var'         => 'portfolio_cat',

		/* The rewrite handles the URL structure. */
		'rewrite' => array(
			'slug'         => !empty( $settings['portfolio_cat_base'] ) ? "{$settings['portfolio_root']}/{$settings['portfolio_cat_base']}" : $settings['portfolio_root'],
			'with_front'   => false,
			'hierarchical' => false,
			'ep_mask'      => EP_NONE
		),

		/* Labels used when displaying taxonomy and terms. */
		'labels' => array(
			'name'                       => __( 'Portfolio Categories',                 'wc-custom-post-types' ),
			'singular_name'              => __( 'Portfolio Category',                   'wc-custom-post-types' ),
			'menu_name'                  => __( 'Categories',                           'wc-custom-post-types' ),
			'name_admin_bar'             => __( 'Portfolio Category',                   'wc-custom-post-types' ),
			'search_items'               => __( 'Search Portfolio Categories',          'wc-custom-post-types' ),
			'popular_items'              => __( 'Popular Portfolio Categories',         'wc-custom-post-types' ),
			'all_items'                  => __( 'All Portfolio Categories',             'wc-custom-post-types' ),
			'edit_item'                  => __( 'Edit Portfolio Category',              'wc-custom-post-types' ),
			'view_item'                  => __( 'View Portfolio Category',              'wc-custom-post-types' ),
			'update_item'                => __( 'Update Portfolio Category',            'wc-custom-post-types' ),
			'add_new_item'               => __( 'Add New Portfolio Category',           'wc-custom-post-types' ),
			'new_item_name'              => __( 'New Portfolio Category Name',          'wc-custom-post-types' ),
			'separate_items_with_commas' => __( 'Separate portfolio categories with commas', 'wc-custom-post-types' ),
			'add_or_remove_items'        => __( 'Add or remove portfolio categories',    'wc-custom-post-types' ),
			'choose_from_most_used'      => __( 'Choose from the most used portfolio categories', 'wc-custom-post-types' ),
		)
	);

	/* Register the 'portfolio' taxonomy. */
	register_taxonomy( 'wc_portfolio_cat', array( 'wc_portfolio_item' ), $args );

	/* Set up the arguments for the portfolio taxonomy. */
	$args = array(
		'public'            => true,
		'show_ui'           => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => true,
		'show_admin_column' => true,
		'hierarchical'      => false,
		'query_var'         => 'portfolio_tag',

		/* The rewrite handles the URL structure. */
		'rewrite' => array(
			'slug'         => !empty( $settings['portfolio_tag_base'] ) ? "{$settings['portfolio_root']}/{$settings['portfolio_tag_base']}" : $settings['portfolio_root'],
			'with_front'   => false,
			'hierarchical' => false,
			'ep_mask'      => EP_NONE
		),

		/* Labels used when displaying taxonomy and terms. */
		'labels' => array(
			'name'                       => __( 'Portfolio Tags',                 'wc-custom-post-types' ),
			'singular_name'              => __( 'Portfolio Tag',                  'wc-custom-post-types' ),
			'menu_name'                  => __( 'Tags',                           'wc-custom-post-types' ),
			'name_admin_bar'             => __( 'Portfolio Tag',                  'wc-custom-post-types' ),
			'search_items'               => __( 'Search Portfolio Tags',          'wc-custom-post-types' ),
			'popular_items'              => __( 'Popular Portfolio Tags',         'wc-custom-post-types' ),
			'all_items'                  => __( 'All Portfolio Tags',             'wc-custom-post-types' ),
			'edit_item'                  => __( 'Edit Portfolio Tag',             'wc-custom-post-types' ),
			'view_item'                  => __( 'View Portfolio Tag',             'wc-custom-post-types' ),
			'update_item'                => __( 'Update Portfolio Tag',           'wc-custom-post-types' ),
			'add_new_item'               => __( 'Add New Portfolio Tag',          'wc-custom-post-types' ),
			'new_item_name'              => __( 'New Portfolio Tag Name',         'wc-custom-post-types' ),
			'separate_items_with_commas' => __( 'Separate portfolio tags with commas', 'wc-custom-post-types' ),
			'add_or_remove_items'        => __( 'Add or remove portfolio tags',   'wc-custom-post-types' ),
			'choose_from_most_used'      => __( 'Choose from the most used portfolio tags', 'wc-custom-post-types' ),
		)
	);

	/* Register the 'portfolio' taxonomy. */
	register_taxonomy( 'wc_portfolio_tag', array( 'wc_portfolio_item' ), $args );
}

?>
