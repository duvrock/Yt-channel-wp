<?php
// Add settings page
function youtube_videos_settings_page() {
    add_options_page(
      'YouTube Videos Settings',
      'YouTube Videos Settings',
      'manage_options',
      'youtube_videos_settings',
      'youtube_videos_settings_page_html'
    );
  }
  add_action('admin_menu', 'youtube_videos_settings_page');
  
  // Display settings pageq
  function youtube_videos_settings_page_html() {
    ?>
    <div class="wrap">
      <!-- <h1>YouTube Videos Settings</h1> -->
      <form action="options.php" method="post">
        <?php
          settings_fields('youtube_videos_options');
          do_settings_sections('youtube_videos_settings');
          submit_button('Save Settings');
        ?>
      </form>
    </div>
    <?php
  }
  
  // Register settings and fields
  function youtube_videos_settings_init() {
    register_setting(
      'youtube_videos_options',
      'youtube_videos_api_key'
    );

    register_setting(
        'youtube_videos_options',
        'youtube_videos_channel_id'
      );

    register_setting(
        'youtube_videos_options',
        'youtube_videos_shortcode'
    );
  
    add_settings_section(
      'youtube_videos_section',
      'YouTube Videos Settings',
      'youtube_videos_section_html',
      'youtube_videos_settings'
    );
    
    add_settings_field(
      'youtube_videos_api_key',
      'API Key',
      'youtube_videos_api_key_field_html',
      'youtube_videos_settings',
      'youtube_videos_section'
    );

    add_settings_field(
        'youtube_videos_channel_id',
        'Channel ID',
        'youtube_videos_channel_id_field_html',
        'youtube_videos_settings',
        'youtube_videos_section'
      );

    // Add shortcode field
    add_settings_field(
        'youtube_videos_shortcode',
        'Shortcode',
        'youtube_videos_shortcode_field_html',
        'youtube_videos_settings',
        'youtube_videos_section'
    );
  }
  add_action('admin_init', 'youtube_videos_settings_init');
  
  
  
  // Display settings section description
  function youtube_videos_section_html() {
    echo '<p>Enter your YouTube API key and Channel Id below:</p>';
  }
  
  // Display API key field
  function youtube_videos_api_key_field_html() {
    $value = get_option('youtube_videos_api_key');
    echo '<input type="text" id="youtube_videos_api_key" name="youtube_videos_api_key" value="' . esc_attr($value) . '">';
  }

  function youtube_videos_channel_id_field_html() {
    $value = get_option('youtube_videos_channel_id');
    echo '<input type="text" id="youtube_videos_channel_id" name="youtube_videos_channel_id" value="' . esc_attr($value) . '">';
  }
  
  function youtube_videos_shortcode_field_html() {
    echo '<p>Copy and paste this shortcode into any post or page to display your YouTube videos:</p></br>';
    echo '<strong>[youtube-videos]</strong>';
}
  

  
  
  