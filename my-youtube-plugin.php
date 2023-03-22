<?php
/*
Plugin Name: YouTube Videos
Description: A plugin to display YouTube videos from a channel
Version: 1.0
Author: Valentin Predoi
License: GPL2
*/
require_once(plugin_dir_path(__FILE__) . 'settings-my-youtube-plugin.php');
// Add shortcode to display videos
function display_youtube_videos($atts) {
  // Set API key and channel ID
  $api_key = get_option('youtube_videos_api_key');
  //$channel_id = 'UCagifyw1hiJsLeMjEP3GzZg';
  //apiKey:AIzaSyBDMfEnpadrU6ccu33aIXjWoccR-MDF7Uc
  $channel_id = get_option('youtube_videos_channel_id');
  $api_endpoint = 'https://www.googleapis.com/youtube/v3/search?key='.$api_key.'&channelId='.$channel_id.'&part=snippet,id&order=date&maxResults=10';
  $errorMsg = '';
  if (empty($api_key || $channel_id)) {
     $errorMsg .='<p></p>API Key or Channel Id is not set</p>';
  } else {
     $api_endpoint = 'https://www.googleapis.com/youtube/v3/search?key='.$api_key.'&channelId='.$channel_id.'&part=snippet,id&order=date&maxResults=10';
  }
  

  // Get data from API endpoint
  $response = wp_remote_get($api_endpoint);
  //var_export($response);
  $response_body = wp_remote_retrieve_body($response);
  $data = json_decode($response_body);

  // Check if API request was successfull
  if ($response['response']['code'] != 200) {
       $errorMsg .= 'Error: API request failed - incorect or missing Api';
  }

    // Enqueue external CSS file
    wp_enqueue_style( 'my-youtube-plugin-styles', plugin_dir_url( __FILE__ ) . 'includes/css/main.css' );

  // Display videos
  if (empty($errorMsg)) {
        $output = '<div class="videos-container">';
        foreach ($data->items as $item) {
            $video_id = $item->id->videoId;
            $video_title = $item->snippet->title;
            $video_description = $item->snippet->description;
            $output .= '<div class="video">';
            $output .= '<div class="video-title">';
            $output .= '<h6>Video</h6>';
            $output .= '<h3>'.$video_title.'</h3>';
            $output .= '</div>';
            $output .= '<div class="video-info">';
            $output .= '<iframe width="560" height="315" src="https://www.youtube.com/embed/'.$video_id.'" frameborder="0" allowfullscreen></iframe>';
            $output .= '<h6>'.$video_description.'</h6>';
            $output .= '</div>';
            $output .= '</div>';

        }
        $output .= '</div>';
        return $output;
    } else {
        // Display Errors
        return $errorMsg;
    }
    
}
add_shortcode('youtube_videos', 'display_youtube_videos');
//[youtube_videos]

