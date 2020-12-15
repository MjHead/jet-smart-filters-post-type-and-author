<?php
/**
 * Plugin Name: JetSmartFilters - Post type and author filters
 * Plugin URI:  #
 * Description: Allow to filter posts by post type and post author
 * Version:     1.0.0
 * Author:      Crocoblock
 * Author URI:  https://crocoblock.com/
 * License:     GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die();
}

class Jet_SF_Post_Type_Author {

	public function __construct() {
		add_filter( 'jet-smart-filters/query/vars', array( $this, 'register_filter_query_vars' ) );
		add_filter( 'jet-smart-filters/query/add-var', array( $this, 'process_filter_query_vars' ), 10, 4 );
		add_filter( 'jet-smart-filters/query/meta-query-row', array( $this, 'clear_meta_query' ) );
	}

	/**
	 * Register new query variables for post type and author
	 *
	 * @param  array $vars Default query variables array
	 * @return array
	 */
	public function register_filter_query_vars( $vars ) {
		array_unshift( $vars, 'post_type', 'author', 'author_name' );
		return $vars;
	}

	/**
	 * Add required variables from request to filtered query arguments.
	 * You can use this if you need to make some actions with $value before sending it into query
	 *
	 * @param  string $value Raw value from request.
	 * @param  string $key   Raw key from request.
	 * @param  string $var   Currently processed query variable name.
	 * @param  object $query Jet_Smart_Filters_Query_Manager instance.
	 * @return string
	 */
	public function process_filter_query_vars( $value, $key, $var, $query ) {
		return $value;
	}

	/**
	 * Remove aproppriate rows from meta query (because plugin is always added all unknown data as meta query)
	 *
	 * @param  array $row Meta query row.
	 * @return array
	 */
	public function clear_meta_query( $row ) {

		if ( in_array( $row['key'], array( 'author', 'author_name', 'post_type' ) ) ) {
			$row = array();
		}

		return $row;
	}

}

new Jet_SF_Post_Type_Author();
