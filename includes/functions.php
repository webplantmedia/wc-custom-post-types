<?php
/**
 * Various functions, filters, and actions used by the plugin.
 *
 * @package    WC Custom Post Types
 * @since      1.1
 * @author     Chris Baldelomar <chris@webplantmedia.com>
 * @copyright  Copyright (c) 2013, Chris Baldelomar
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/* Filter the post type archive title. */
add_filter( 'post_type_archive_title', 'wc_cpt_post_type_archive_title' );

/**
 * Returns the default settings for the plugin.
 *
 * @since  0.1.0
 * @access public
 * @return array
 */
function wc_cpt_get_default_settings() {

	$settings = array(
		'portfolio_name' => 'Portfolio Items',
		'portfolio_root' => 'portfolio',
		'portfolio_tag_base' => 'tag',
		'portfolio_item_base' => 'item',
		'portfolio_archive_title' => 'Portfolio',
	);

	return $settings;
}

function wc_cpt_get_plugin_settings() {
	/* Get the plugin settings. */
	$default = wc_cpt_get_default_settings();
	$settings = get_option( 'plugin_wc_cpt' );

	if ( empty( $settings ) || ! is_array( $settings ) ) {
		$settings = $default;
	}
	else {
		foreach ( $default as $key => $value ) {
			if ( ! array_key_exists( $key, $settings ) )
				$settings[ $key ] = $value;
		}
	}

	return $settings;
}

/**
 * Filter on 'post_type_archive_title' to allow for the use of the 'archive_title' label that isn't supported 
 * by WordPress.  That's okay since we can roll our own labels.
 *
 * @since  0.1.0
 * @access public
 * @param  string $title
 * @return string
 */
function wc_cpt_post_type_archive_title( $title ) {

	if ( is_post_type_archive( 'wc_portfolio_item' ) ) {
		$post_type = get_post_type_object( 'wc_portfolio_item' );
		$title = isset( $post_type->labels->archive_title ) ? $post_type->labels->archive_title : $title;
	}

	return $title;
}

function wc_cpt_add_action_links( $links ) {
	return array_merge(
		array(
			'settings' => '<a href="' . admin_url( 'options-general.php?page=wc-cpt' ) . '">' . __( 'Settings', 'wc-custom-post-types' ) . '</a>',
			'seeitems' => '<a href="' . admin_url( 'edit.php?post_type=wc_portfolio_item' ) . '">' . __( 'Items', 'wc-custom-post-types' ) . '</a>',
		),
		$links
	);
}
add_filter( 'plugin_action_links_' . WC_CPT_PLUGIN_BASENAME, 'wc_cpt_add_action_links' );
?>
