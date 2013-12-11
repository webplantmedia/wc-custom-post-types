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
	$settings = get_option( 'plugin_wc_cpt', wc_cpt_get_default_settings() );

	/* Set up the arguments for the portfolio taxonomy. */
	$args = array(
		'public'            => true,
		'show_ui'           => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => true,
		'show_admin_column' => true,
		'hierarchical'      => false,
		'query_var'         => 'portfolio',

		/* Only 2 caps are needed: 'manage_portfolio' and 'edit_portfolio_items'. */
		'capabilities' => array(
			'manage_terms' => 'manage_portfolio',
			'edit_terms'   => 'manage_portfolio',
			'delete_terms' => 'manage_portfolio',
			'assign_terms' => 'edit_portfolio_items',
		),

		/* The rewrite handles the URL structure. */
		'rewrite' => array(
			'slug'         => !empty( $settings['portfolio_base'] ) ? "{$settings['portfolio_root']}/{$settings['portfolio_base']}" : $settings['portfolio_root'],
			'with_front'   => false,
			'hierarchical' => false,
			'ep_mask'      => EP_NONE
		),

		/* Labels used when displaying taxonomy and terms. */
		'labels' => array(
			'name'                       => __( 'Portfolios',                           'wc-custom-post-types' ),
			'singular_name'              => __( 'Portfolio',                            'wc-custom-post-types' ),
			'menu_name'                  => __( 'Portfolios',                           'wc-custom-post-types' ),
			'name_admin_bar'             => __( 'Portfolio',                            'wc-custom-post-types' ),
			'search_items'               => __( 'Search Portfolios',                    'wc-custom-post-types' ),
			'popular_items'              => __( 'Popular Portfolios',                   'wc-custom-post-types' ),
			'all_items'                  => __( 'All Portfolios',                       'wc-custom-post-types' ),
			'edit_item'                  => __( 'Edit Portfolio',                       'wc-custom-post-types' ),
			'view_item'                  => __( 'View Portfolio',                       'wc-custom-post-types' ),
			'update_item'                => __( 'Update Portfolio',                     'wc-custom-post-types' ),
			'add_new_item'               => __( 'Add New Portfolio',                    'wc-custom-post-types' ),
			'new_item_name'              => __( 'New Portfolio Name',                   'wc-custom-post-types' ),
			'separate_items_with_commas' => __( 'Separate portfolios with commas',      'wc-custom-post-types' ),
			'add_or_remove_items'        => __( 'Add or remove portfolios',             'wc-custom-post-types' ),
			'choose_from_most_used'      => __( 'Choose from the most used portfolios', 'wc-custom-post-types' ),
		)
	);

	/* Register the 'portfolio' taxonomy. */
	register_taxonomy( 'portfolio', array( 'portfolio_item' ), $args );
}

?>
