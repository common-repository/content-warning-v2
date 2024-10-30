<?php

namespace agy;

/**
 * Age Gate Templates Class
 */
class AGY_Templates
{
    /**
     * Getter for forms
     *
     * @return string
     */
    public static function get_accept_form()
    {
        $general_options = wp_parse_args( get_option( 'psag_options' ), AGY_Admin::get_defaults( 'psag_options' ) );
        $text_options = wp_parse_args( get_option( 'psag_texts' ), AGY_Admin::get_defaults( 'psag_texts' ) );
        $design_options = wp_parse_args( get_option( 'psag_design' ), AGY_Admin::get_defaults( 'psag_design' ) );
        ob_start();
        include apply_filters( 'agy_accept_template', AGY_PATH . '/src/templates/accept-age.php' );
        $accept_template = ob_get_contents();
        ob_end_clean();
        $age = 18;
        if ( isset( $general_options['psag_restrict_default_age'] ) && !empty($general_options['psag_restrict_default_age']) ) {
            $age = $general_options['psag_restrict_default_age'];
        }
        /* migrate old options */
        $placeholders = array(
            '[PSAG_LOGO_IMAGE]'      => '<img src="' . $design_options['psag_logo'] . '" />',
            '[PSAG_LOGO_SLOGAN]'     => $text_options['psag_texts_slogan'],
            '[PSAG_HEADLINE]'        => $text_options['psag_texts_headline'],
            '[PSAG_INSTRUCTION]'     => str_replace( '[age]', $age, $text_options['psag_texts_message'] ),
            '[PSAG_ENTER]'           => $text_options['psag_texts_enter'],
            '[PSAG_EXIT]'            => $text_options['psag_texts_exit'],
            '[PSAG_SEPARATOR_LABEL]' => $text_options['psag_texts_separator'],
            '[PSAG_SUBTITLE]'        => $text_options['psag_texts_subtitle'],
        );
        $background_image = $design_options['psag_overlay_background'];
        
        if ( isset( $background_image ) && !empty($background_image) ) {
            $placeholders['[PSAG_OVERLAY_BACKGROUND]'] = 'style="background-image:url(' . $background_image . ');"';
        } else {
            $placeholders['[PSAG_OVERLAY_BACKGROUND]'] = '';
        }
        
        $layout_mode = $design_options['psag_columns'];
        
        if ( 'one-column' === $layout_mode ) {
            $placeholders['[PSAG_ONE_COLUMN_LOGO]'] = '<img src="' . $design_options['psag_logo'] . '">';
        } else {
            $placeholders['[PSAG_ONE_COLUMN_LOGO]'] = '';
        }
        
        foreach ( $placeholders as $placeholder => $string ) {
            $accept_template = str_replace( $placeholder, $string, $accept_template );
        }
        return $accept_template;
    }

}