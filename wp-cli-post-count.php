<?php
/**
 * Plugin Name: WP CLI Post Count Demo
 * Description: Adding a custom command to WP-CLI to return the list of published posts
 * Author: Rikesh Ramlochund
 */

defined( 'ABSPATH' ) || exit;

if (defined('WP_CLI') && WP_CLI):

  function post_count( $args ){
    global $wpdb;

    $post_type = (NULL === $args[0]) ? 'post' : $args[0];

    $query = $wpdb->prepare( "SELECT COUNT(*) FROM $wpdb->posts WHERE post_status='publish' AND post_type=%s", $post_type );
    $count = $wpdb->get_var( $query );

    WP_CLI::line( sprintf( 'Count: %d', $count ) );
  }

  WP_CLI::add_command( 'post-count', 'post_count' );

endif;
