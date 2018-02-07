.fl-node-<?php echo $id; ?> .fl-content-slider,
.fl-node-<?php echo $id; ?> .fl-slide {
	min-height: 100%;
}
.fl-node-<?php echo $id; ?> .fl-slide-foreground {
	margin: 0 auto;
	max-width: <?php echo $settings->max_width; ?>px;
}
.fl-node-<?php echo $id; ?> .fl-slide-photo-wrap {
	display: block !important;
}
<?php
if ( $settings->arrows ) :
	if ( isset( $settings->arrows_bg_color ) && ! empty( $settings->arrows_bg_color ) ) :
?>
	.fl-node-<?php echo $id; ?> .fl-content-slider-svg-container {
		background-color: <?php echo FLBuilderColor::hex_or_rgb( $settings->arrows_bg_color ); ?>;
		width: 40px;
		height: 40px;

		<?php if ( isset( $settings->arrows_bg_style ) && 'circle' == $settings->arrows_bg_style ) : ?>
		-webkit-border-radius: 50%;
		-moz-border-radius: 50%;
		-ms-border-radius: 50%;
		-o-border-radius: 50%;
		border-radius: 50%;
		<?php endif; ?>
	}
	.fl-node-<?php echo $id; ?> .fl-content-slider-navigation svg {
		height: 100%;
		width: 100%;
		padding: 5px;
	}
	<?php
	endif;

	if ( isset( $settings->arrows_text_color ) && ! empty( $settings->arrows_text_color ) ) :
	?>
	.fl-node-<?php echo $id; ?> .fl-content-slider-navigation path {
		fill: #<?php echo $settings->arrows_text_color; ?>;
	}
	<?php
	endif;
endif;

for ( $i = 0; $i < count( $settings->slides ); $i++ ) {

	// Make sure we have a slide.
	if ( ! is_object( $settings->slides[ $i ] ) ) {
		continue;
	}

	// Slide Settings
	$slide = $settings->slides[ $i ];


}// End for().
