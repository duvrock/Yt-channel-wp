<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Add action hook for initialization.
add_action( 'init', 'my_youtube_plugin_initialize' );

/**
 * Initialize the plugin.
 */
function my_youtube_plugin_initialize() {
	// Add shortcode to display YouTube videos.
	add_shortcode( 'youtube', 'my_youtube_plugin_shortcode' );
}

/**
 * Shortcode callback function to display YouTube videos.
 *
 * @param array $atts Shortcode attributes.
 * @return string HTML for displaying YouTube video.
 */
function my_youtube_plugin_shortcode( $atts ) {
	// Set up shortcode attributes with default values.
	$atts = shortcode_atts( array(
		'video_id' => '',
		'width' => '560',
		'height' => '315'
	), $atts );

	// Return HTML for displaying YouTube video.
	return '<iframe width="' . esc_attr( $atts['width'] ) . '"
