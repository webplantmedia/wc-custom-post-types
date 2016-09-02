<?php
/**
 * Plugin Name: WP Canvas - Portfolio
 * Plugin URI: http://wordpresscanvas.com/
 * Description: Portfolio post types with minimal configuration to be used with themes.
 * Version: 1.3
 * Author: Chris Baldelomar
 * Author URI: http://webplantmedia.com
 */

class WC_Custom_Post_Types {

	/**
	 * PHP5 constructor method.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function __construct() {

		/* Set the constants needed by the plugin. */
		add_action( 'plugins_loaded', array( &$this, 'constants' ), 1 );

		/* Internationalize the text strings used. */
		// add_action( 'plugins_loaded', array( &$this, 'i18n' ), 2 );

		/* Load the functions files. */
		add_action( 'plugins_loaded', array( &$this, 'includes' ), 3 );

		/* Load the admin files. */
		add_action( 'plugins_loaded', array( &$this, 'admin' ), 4 );

		/* Register activation hook. */
		// register_activation_hook( __FILE__, array( &$this, 'activation' ) );
	}

	/**
	 * Defines constants used by the plugin.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function constants() {

		/* Set constant path to the plugin directory. */
		define( 'WC_CPT_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );

		/* Set the constant path to the plugin directory URI. */
		define( 'WC_CPT_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );

		/* Set the constant path to the includes directory. */
		define( 'WC_CPT_INCLUDES', WC_CPT_DIR . trailingslashit( 'includes' ) );

		/* Set the constant path to the admin directory. */
		define( 'WC_CPT_ADMIN', WC_CPT_DIR . trailingslashit( 'admin' ) );

		/* Set plugin basename */
		define( 'WC_CPT_PLUGIN_BASENAME', plugin_basename( plugin_dir_path( realpath( __FILE__ ) ) . 'wc-custom-post-types.php' ) );
	}

	/**
	 * Loads the initial files needed by the plugin.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function includes() {

		require_once( WC_CPT_INCLUDES . 'functions.php' );
		require_once( WC_CPT_INCLUDES . 'post-types.php' );
		require_once( WC_CPT_INCLUDES . 'taxonomies.php' );
	}

	/**
	 * Loads the translation files.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function i18n() {

		/* Load the translation of the plugin. */
		load_plugin_textdomain( 'wc-custom-post-types', false, 'wc-custom-post-types/languages' );
	}

	/**
	 * Loads the admin functions and files.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function admin() {

		if ( is_admin() )
			require_once( WC_CPT_ADMIN . 'admin.php' );
	}

	/**
	 * Method that runs only when the plugin is activated.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	function activation() {

		/* Get the administrator role. */
		$role =& get_role( 'administrator' );

		/* If the administrator role exists, add required capabilities for the plugin. */
		if ( !empty( $role ) ) {

			$role->add_cap( 'manage_portfolio' );
			$role->add_cap( 'create_portfolio_items' );
			$role->add_cap( 'edit_portfolio_items' );
		}
	}
}

new WC_Custom_Post_Types();

?>
