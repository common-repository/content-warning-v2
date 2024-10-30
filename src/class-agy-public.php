<?php

namespace agy;

/**
 * Agy Public Class
 */
class AGY_Public {

	/**
	 * Constructor for AGY_Public
	 */
	public function __construct() {
		// Check if Agy is allready installed.
		$options = get_option( 'psag_options' );

		if ( isset( $options ) && ! empty( $options ) ) {
			add_action( 'wp_footer', array( $this, 'dynamic_styles' ) );
		}
	}

	/**
	 * Get instance of AGY_Public
	 *
	 * @return void
	 */
	public static function get_instance() {
		new AGY_Public();
	}

	/**
	 * Check for bot visits
	 *
	 * @return bool
	 */
	public static function bot_detected() {
		return ( isset( $_SERVER['HTTP_USER_AGENT'] ) && preg_match( '/bot|crawl|slurp|spider|mediapartners|Google Page Speed Insights/i', $_SERVER['HTTP_USER_AGENT'] ) );
	}

	/**
	 * Output dynamic styles based on customizer options
	 *
	 * @return void
	 */
	public function dynamic_styles() {

		if ( true === AGY_Loader::check_blacklist_status() ) {
			return;
		}

		if ( true === self::bot_detected() ) {
			return;
		}

		$general_options = wp_parse_args( get_option( 'psag_options' ), AGY_Admin::get_defaults( 'psag_options' ) );
		$text_options    = wp_parse_args( get_option( 'psag_texts' ), AGY_Admin::get_defaults( 'psag_texts' ) );
		$design_options  = wp_parse_args( get_option( 'psag_design' ), AGY_Admin::get_defaults( 'psag_design' ) );

		?>
		<style>
		.agy {
		display:none;
		}
		.agy button.btn {
		background-color: <?php echo esc_html( $design_options['psag_enter_color'] ); ?>;
		color: <?php echo esc_html( $design_options['psag_enter_font_color'] ); ?>;
		text-decoration: none;
		display: inline-block;
		letter-spacing: 0.1em;
		padding: 0.5em 0em;
		cursor: pointer;
		min-width: 160px
		}
		.agy button.btn.btn-beta {
		background-color: <?php echo esc_html( $design_options['psag_exit_color'] ); ?>;
		color: <?php echo esc_html( $design_options['psag_exit_font_color'] ); ?>;
		}
		.agy .decor-line {
		position: relative;
		top: 0.7em;
		border-top: 1px solid #ccc;
		text-align: center;
		max-width: 40%;
		margin: 0.5em auto;
		display: block;
		padding: 0.1em 1em;
		color: #ccc;
		}
		.agy .decor-line span {
		background: #fff;
		color: <?php echo esc_html( $design_options['psag_separator_color'] ); ?>;
		position: relative;
		top: -0.7em;
		padding: 0.5em;
		text-transform: uppercase;
		letter-spacing: 0.1em;
		font-weight: 900;
		}

		<?php

		if ( isset( $design_options['psag_overlay_background'] ) && ! empty( $design_options['psag_overlay_background'] ) ) {
			$background = $design_options['psag_overlay_background'];
		} else {
			$background = $design_options['psag_background_color'];
		}
		?>

		.overlay-verify {
		background: <?php echo esc_html( $background ); ?>;
		position: fixed;
		height: 100%;
		width: 100%;
		top: 0;
		left: 0;
		z-index:<?php echo esc_html( $design_options['psag_z_index_overlay'] ); ?>;
		display:none;
		}
		.agy .box {
		background: #fff;
		position: fixed;
		left: 0;
		right: 0;
		top: 20%;
		bottom: 0;
		margin: 0 auto;
		display: block;
		z-index: <?php echo esc_html( $design_options['psag_z_index'] ); ?>;
		max-width: <?php echo esc_html( $design_options['psag_box_width'] ); ?>px;
		height: <?php echo esc_html( $design_options['psag_box_height'] ); ?>px;
		}
		.agy .box .box-left, .agy .box .box-right {
		width: 100%;
		position: relative;
		text-align: center;
		padding: 10%;
		box-sizing: border-box;
		}
		@media (min-width: 54em) {
			.agy .box .box-left, .agy .box .box-right {
			display: table-cell;
			vertical-align: middle;
			width: 50%;
			}
		}
		.agy .box .box-left p, .agy .box .box-right p {
		position: relative;
		z-index: 3;
		}
		.agy .box .box-left {
		background: url(<?php echo esc_url( $design_options['psag_background_image_left'] ); ?>) 50% 50%;
		background-size: cover;
		color: <?php echo esc_html( $design_options['psag_slogan_color'] ); ?>;
		}
		.agy .box .box-left img {
		position: relative;
		z-index: 4;
		width: 18em;
		}
		.agy .box .box-left:after {
		content: '';
		position: absolute;
		z-index: 0;
		top: 0;
		left: 0;
		height: 100%;
		width: 100%;
		background-color: rgba(0, 0, 0, 0.4);
		}
		.agy .box .box-right {
		text-align: center;
		}
		.agy .box .box-right h3 {
		color: <?php echo esc_html( $design_options['psag_headline_color'] ); ?>;
		text-transform: uppercase;
		letter-spacing: 0.07em;
		border-bottom: 1px solid #eee;
		padding-bottom: 1em;
		margin: 10px auto;
		font-size: 1.2rem;
		}
		@media screen and ( max-width:380px ) {
			.agy .box .box-right h3 {
			font-size: 0.8rem;
			}
		}
		.agy .box .box-right p {
		color: <?php echo esc_html( $design_options['psag_instruction_color'] ); ?>;
		}
		.agy .box .box-right small {
		color: <?php echo esc_html( $design_options['psag_subtitle_color'] ); ?>;
		}
		.agy .box .box-right .btn {
		font-weight: 600;
		letter-spacing: 0.2em;
		padding: 0.9em 1em 0.7em;
		margin: 1em auto;
		display: block;
		}
		.agy .box-right img {
			max-width: <?php echo esc_html( $design_options['psag_box_logo_max_width'] ); ?>px;
			max-height: 250px;
			margin: 0px auto 15px auto;
		}
		<?php
		$layout_mode = esc_html( $design_options['psag_columns'] );
		if ( 'one-column' === $layout_mode ) :
			?>
		.box-left {
			display: none !important;
		}
		<?php endif; ?>
		<?php
		$blur           = esc_html( $design_options['psag_blur'] );
		$blur_container = esc_html( $design_options['psag_blur_container_id'] );
		$blur_strength  = esc_html( $design_options['psag_blur_blur_effect_strength'] );
		?>

		<?php if ( 'on' === $blur ) : ?>
		<?php echo esc_html( $blur_container ); ?> {
			-webkit-filter: blur(<?php echo esc_html( $blur_strength ); ?>px);
			-moz-filter: blur(<?php echo esc_html( $blur_strength ); ?>px);
			-ms-filter: blur(<?php echo esc_html( $blur_strength ); ?>px);
			-o-filter: blur(<?php echo esc_html( $blur_strength ); ?>px);
			filter: blur(<?php echo esc_html( $blur_strength ); ?>px);
		}
		<?php endif; ?>
		</style>
		<?php
	}
}
