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
		'portfolio_root'      => 'portfolio',
		'portfolio_tag_base'      => 'tag',
		'portfolio_cat_base'      => 'category',
		'portfolio_item_base' => 'item'
	);

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

	if ( is_post_type_archive( 'portfolio_item' ) ) {
		$post_type = get_post_type_object( 'portfolio_item' );
		$title = isset( $post_type->labels->archive_title ) ? $post_type->labels->archive_title : $title;
	}

	return $title;
}
?>
