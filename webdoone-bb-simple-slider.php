<?php
/**
 * Plugin Name: Webdoone BB Simple Slider
 * Plugin URI: http://webdoone.com
 * Description: Beaver Builder simple slider.
 * Version: 1.0.5
 * Author: Webdoone
 * Author URI: http://webdoone.com
 */
define( 'FL_SIMPLE_SLIDER_DIR', plugin_dir_path( __FILE__ ) );
define( 'FL_SIMPLE_SLIDER_URL', plugins_url( '/', __FILE__ ) );

require_once FL_SIMPLE_SLIDER_DIR . 'classes/class-webdoone-bb-simple-slider-loader.php';

require_once( 'BFIGitHubPluginUploader.php' );
if ( is_admin() ) {
    new BFIGitHubPluginUpdater( __FILE__, 'smyczek', "webdoone-bb-simple-slider" );
}
