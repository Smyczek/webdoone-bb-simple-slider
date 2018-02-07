<?php

/**
 * @class FLContentSliderModule
 */
class FLSimpleSliderModule extends FLBuilderModule {

	/**
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(array(
			'name'          	=> __( 'Simple Slider', 'fl-builder' ),
			'description'   	=> __( 'Displays multiple photo slides with links.', 'fl-builder' ),
			'category'      	=> __( 'Media', 'fl-builder' ),
			'partial_refresh'	=> true,
			'icon'				=> 'slides.svg',
		));

		$this->add_css( 'jquery-bxslider' );
		$this->add_js( 'jquery-bxslider' );
	}

	/**
	 * @method render_background
	 */
	public function render_background( $slide ) {
		// Background photo
		if ( ! empty( $slide->bg_photo_src ) ) {
			echo '<div class="fl-slide-bg-photo" style="background-image: url(' . $slide->bg_photo_src . ');"></div>';
		} // End if().

		// Background link
		if ( ! empty( $slide->link ) ) {
			echo '<a class="fl-slide-bg-link" href="' . $slide->link . '" target="' . $slide->link_target . '"></a>';
		}
	}

	/**
	 * @method render_media
	 */
	public function render_media( $slide ) {

		// Photo
		if ( ! empty( $slide->bg_photo_src ) ) {

			$alt = get_post_meta( $slide->bg_photo, '_wp_attachment_image_alt', true );

			echo '<div class="fl-slide-photo-wrap">';
			echo '<div class="fl-slide-photo">';

			if ( ! empty( $slide->link ) ) {
				echo '<a href="' . $slide->link . '" target="' . $slide->link_target . '">';
			}

			echo '<img class="fl-slide-photo-img wp-image-' . $slide->bg_photo . '" src="' . $slide->bg_photo_src . '" alt="' . esc_attr( $alt ) . '" />';

			if ( ! empty( $slide->link ) ) {
				echo '</a>';
			}

			echo '</div>';
			echo '</div>';
		} // End if().
	}

	/**
	 * @method is_loop_enabled
	 */
	public function is_loop_enabled() {
		if ( 'true' == $this->settings->loop &&
			1 == count( $this->settings->slides )
			) {
			return 'false';
		} else {
			return $this->settings->loop;
		}
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('FLSimpleSliderModule', array(
	'general'       => array(
		'title'         => __( 'General', 'fl-builder' ),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'auto_play'     => array(
						'type'          => 'select',
						'label'         => __( 'Auto Play', 'fl-builder' ),
						'default'       => '1',
						'options'       => array(
							'0'             => __( 'No', 'fl-builder' ),
							'1'             => __( 'Yes', 'fl-builder' ),
						),
						'toggle'        => array(
							'1'             => array(
								'fields'        => array( 'play_pause' ),
							),
						),
					),
					'delay'         => array(
						'type'          => 'text',
						'label'         => __( 'Delay', 'fl-builder' ),
						'default'       => '5',
						'maxlength'     => '4',
						'size'          => '5',
						'sanitize'		=> 'absint',
						'description'   => _x( 'seconds', 'Value unit for form field of time in seconds. Such as: "5 seconds"', 'fl-builder' ),
					),
					'loop'          => array(
						'type'          => 'select',
						'label'         => __( 'Loop', 'fl-builder' ),
						'default'       => 'true',
						'options'       => array(
							'false'            	=> __( 'No', 'fl-builder' ),
							'true'				=> __( 'Yes', 'fl-builder' ),
						),
					),
					'transition'    => array(
						'type'          => 'select',
						'label'         => __( 'Transition', 'fl-builder' ),
						'default'       => 'slide',
						'options'       => array(
							'horizontal'    => _x( 'Slide', 'Transition type.', 'fl-builder' ),
							'fade'          => __( 'Fade', 'fl-builder' ),
						),
					),
					'speed'         => array(
						'type'          => 'text',
						'label'         => __( 'Transition Speed', 'fl-builder' ),
						'default'       => '0.5',
						'maxlength'     => '4',
						'size'          => '5',
						'sanitize'		=> 'absint',
						'description'   => _x( 'seconds', 'Value unit for form field of time in seconds. Such as: "5 seconds"', 'fl-builder' ),
					),
					'play_pause'    => array(
						'type'          => 'select',
						'label'         => __( 'Show Play/Pause', 'fl-builder' ),
						'default'       => '0',
						'options'       => array(
							'0'             => __( 'No', 'fl-builder' ),
							'1'             => __( 'Yes', 'fl-builder' ),
						),
					),
					'arrows'       => array(
						'type'          => 'select',
						'label'         => __( 'Show Arrows', 'fl-builder' ),
						'default'       => '0',
						'options'       => array(
							'0'             => __( 'No', 'fl-builder' ),
							'1'             => __( 'Yes', 'fl-builder' ),
						),
						'toggle' 		=> array(
							'1'				=> array(
								'tabs'			=> array( 'styles' ),
							),
						),
					),
					'dots'          => array(
						'type'          => 'select',
						'label'         => __( 'Show Dots', 'fl-builder' ),
						'default'       => '1',
						'options'       => array(
							'0'             => __( 'No', 'fl-builder' ),
							'1'             => __( 'Yes', 'fl-builder' ),
						),
					),
				),
			),
			'advanced'      => array(
				'title'         => __( 'Advanced', 'fl-builder' ),
				'fields'        => array(
					'max_width'     => array(
						'type'          => 'text',
						'label'         => __( 'Max Content Width', 'fl-builder' ),
						'default'       => '1100',
						'maxlength'     => '4',
						'size'          => '5',
						'description'   => 'px',
						'sanitize'		=> 'absint',
						'help'          => __( 'The max width that the content area will be within your slides.', 'fl-builder' ),
					),
				),
			),
		),
	),
	'slides'       => array(
		'title'         => __( 'Slides', 'fl-builder' ),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'slides'        => array(
						'type'          => 'form',
						'label'         => __( 'Slide', 'fl-builder' ),
						'form'          => 'simple_slider_slide', // ID from registered form below
						'preview_text'  => 'label', // Name of a field to use for the preview text
						'multiple'      => true,
					),
				),
			),
		),
	),
	'styles'	   => array(
		'title'			=> __( 'Styles', 'fl-builder' ),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'arrows_bg_color' => array(
						'type'          => 'color',
						'label'         => __( 'Arrows Background Color', 'fl-builder' ),
						'show_reset'    => true,
						'show_alpha'	=> true,
					),
					'arrows_bg_style' => array(
						'type'          => 'select',
						'label'         => __( 'Arrows Background Style', 'fl-builder' ),
						'default' 		=> 'circle',
						'options'       => array(
							'circle'    	=> __( 'Circle', 'fl-builder' ),
							'square'        => __( 'Square', 'fl-builder' ),
						),
					),
					'arrows_text_color' => array(
						'type'          => 'color',
						'label'         => __( 'Arrows Color', 'fl-builder' ),
						'show_reset'    => true,
					),
				),
			),
		),
	),
));

/**
 * Register the slide settings form.
 */
FLBuilder::register_settings_form('simple_slider_slide', array(
	'title' => __( 'Slide Settings', 'fl-builder' ),
	'tabs'  => array(
		'general'        => array( // Tab
			'title'         => __( 'General', 'fl-builder' ), // Tab title
			'sections'      => array( // Tab Sections
				'general'       => array(
					'title'     => '',
					'fields'    => array(
						'label'         => array(
							'type'          => 'text',
							'label'         => __( 'Slide Label', 'fl-builder' ),
							'help'          => __( 'A label to identify this slide on the Slides tab of the Content Slider settings.', 'fl-builder' ),
						),
					),
				),
				'background' => array(
					'title'     => __( 'Slide Photo', 'fl-builder' ),
					'fields'    => array(
						'bg_photo'      => array(
							'type'          => 'photo',
							'label'         => __( 'Photo', 'fl-builder' ),
						),
					),
				),
				'cta' => array(
					'title'     => __( 'Slide Link', 'fl-builder' ),
					'fields'    => array(
						'link'          => array(
							'type'          => 'link',
							'label'         => __( 'Link', 'fl-builder' ),
							'help'          => __( 'The link applies to the entire slide. If choosing a call to action type below, this link will also be used for the text or button.', 'fl-builder' ),
							),
							'link_target'   => array(
								'type'          => 'select',
								'label'         => __( 'Link Target', 'fl-builder' ),
								'default'       => '_self',
								'options'       => array(
									'_self'         => __( 'Same Window', 'fl-builder' ),
									'_blank'        => __( 'New Window', 'fl-builder' ),
								),
							),
							'link_nofollow'          => array(
								'type'          => 'select',
								'label'         => __( 'Link No Follow', 'fl-builder' ),
								'default'       => 'no',
								'options' 		=> array(
									'yes' 			=> __( 'Yes', 'fl-builder' ),
									'no' 			=> __( 'No', 'fl-builder' ),
								),
								'preview'       => array(
									'type'          => 'none',
								),
							),
						),
				),
			),
		),
	),
));
