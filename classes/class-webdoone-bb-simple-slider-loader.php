<?php
	
/**
 * A class that handles loading custom modules and custom
 * fields if the builder is installed and activated.
 */
class FL_Simple_Slider_Loader {
	
	/**
	 * Initializes the class once all plugins have loaded.
	 */
	static public function init() {
		add_action( 'plugins_loaded', __CLASS__ . '::setup_hooks' );
	}
	
	/**
	 * Setup hooks if the builder is installed and activated.
	 */
	static public function setup_hooks() {
		if ( ! class_exists( 'FLBuilder' ) ) {
			return;	
		}
		
		// Load custom modules.
		add_action( 'init', __CLASS__ . '::load_modules' );

	}
	
	/**
	 * Loads our custom modules.
	 */
	static public function load_modules() {
		require_once FL_SIMPLE_SLIDER_DIR . 'simple-slider/simple-slider.php';
	}

}

FL_Simple_Slider_Loader::init();