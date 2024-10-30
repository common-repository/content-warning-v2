<?php

namespace agy;

/**
 * Admin Options Class
 */
class AGY_Admin
{
    /**
     * Setting up admin fields
     *
     * @return void
     */
    public static function init()
    {
        add_action( 'admin_enqueue_scripts', array( __CLASS__, 'add_admin_scripts' ) );
        $settings = new AGY_Settings();
        $settings->add_section( array(
            'id'    => 'psag_options',
            'title' => __( 'General', 'content-warning-v2' ),
        ) );
        $settings->add_field( 'psag_options', array(
            'id'      => 'psag_display_mode',
            'type'    => 'select',
            'name'    => __( 'Display Mode', 'content-warning-v2' ),
            'options' => array(
            'age-submit' => 'Yes or No',
        ),
            'premium' => 'premium',
        ) );
        $settings->add_field( 'psag_options', array(
            'id'      => 'psag_restrict_default_age',
            'type'    => 'number',
            'name'    => __( 'Minimum Age', 'content-warning-v2' ),
            'default' => 18,
        ) );
        $settings->add_field( 'psag_options', array(
            'id'      => 'psag_options_redirect_url',
            'type'    => 'url',
            'desc'    => __( 'The redirect URL if the exit button was clicked', 'content-warning-v2' ),
            'name'    => __( 'Exit URL', 'content-warning-v2' ),
            'default' => get_bloginfo( 'url' ),
        ) );
        $settings->add_field( 'psag_options', array(
            'id'      => 'psag_cookie_lifetime',
            'type'    => 'number',
            'name'    => __( 'Cookie Lifetime (in days)', 'content-warning-v2' ),
            'default' => 30,
        ) );
        $settings->add_field( 'psag_options', array(
            'id'   => 'psag_options_users_bypass_registered',
            'type' => 'toggle',
            'name' => __( 'Show for unregistered users only', 'content-warning-v2' ),
        ) );
        $settings->add_field( 'psag_options', array(
            'id'   => 'psag_blacklist_to_whitelist',
            'type' => 'toggle',
            'name' => __( 'Invert Blacklist to Whitelist', 'content-warning-v2' ),
            'desc' => __( 'Instead of exclude posts, pages and products, the age gate is disabled by default and you can tick the checkbox directly inside your post to activate it.', 'content-warning-v2' ),
        ) );
        $settings->add_field( 'psag_options', array(
            'id'   => 'psag_debug_mode',
            'type' => 'toggle',
            'name' => __( 'Activate debug mode', 'content-warning-v2' ),
        ) );
        $settings->add_field( 'psag_options', array(
            'id'   => 'psag_delete_settings_on_uninstall',
            'type' => 'toggle',
            'name' => __( 'Delete settings on uninstall', 'content-warning-v2' ),
        ) );
        $settings->add_section( array(
            'id'    => 'psag_texts',
            'title' => __( 'Texts', 'content-warning-v2' ),
        ) );
        $settings->add_field( 'psag_texts', array(
            'id'      => 'psag_texts_headline',
            'type'    => 'text',
            'name'    => __( 'Headline', 'content-warning-v2' ),
            'default' => __( 'Age Verification', 'content-warning-v2' ),
        ) );
        $settings->add_field( 'psag_texts', array(
            'id'      => 'psag_texts_message',
            'type'    => 'wysiwyg',
            'name'    => __( 'Message', 'content-warning-v2' ),
            'default' => __( 'By clicking enter, I certify that I am over the age of [age] and will comply with the above statement.', 'content-warning-v2' ),
        ) );
        $settings->add_field( 'psag_texts', array(
            'id'      => 'psag_texts_allow_shortcodes',
            'type'    => 'toggle',
            'name'    => __( 'Allow shortcodes in message.', 'content-warning-v2' ),
            'default' => 'off',
        ) );
        $settings->add_field( 'psag_texts', array(
            'id'      => 'psag_texts_enter',
            'type'    => 'text',
            'name'    => __( 'Enter Button Label', 'content-warning-v2' ),
            'default' => __( 'Enter', 'content-warning-v2' ),
        ) );
        $settings->add_field( 'psag_texts', array(
            'id'      => 'psag_texts_exit',
            'type'    => 'text',
            'name'    => __( 'Exit Button Label', 'content-warning-v2' ),
            'default' => __( 'Exit', 'content-warning-v2' ),
        ) );
        $settings->add_field( 'psag_texts', array(
            'id'      => 'psag_texts_separator',
            'type'    => 'text',
            'name'    => __( 'Separator Text', 'content-warning-v2' ),
            'default' => __( 'Or', 'content-warning-v2' ),
        ) );
        $settings->add_field( 'psag_texts', array(
            'id'      => 'psag_texts_subtitle',
            'type'    => 'text',
            'name'    => __( 'Subtitle', 'content-warning-v2' ),
            'default' => __( 'Always enjoy responsibily.', 'content-warning-v2' ),
        ) );
        $settings->add_field( 'psag_texts', array(
            'id'      => 'psag_texts_slogan',
            'type'    => 'wysiwyg',
            'name'    => __( 'Slogan', 'content-warning-v2' ),
            'default' => __( 'THINC Pure products are only for use in states where the sale and consumption of such products are legal. ', 'content-warning-v2' ),
        ) );
        $settings->add_section( array(
            'id'    => 'psag_design',
            'title' => __( 'Design', 'content-warning-v2' ),
        ) );
        $settings->add_field( 'psag_design', array(
            'id'   => 'psag_background_title',
            'type' => 'title',
            'name' => '<h3>' . __( 'Background', 'content-warning-v2' ) . '</h3>',
        ) );
        $settings->add_field( 'psag_design', array(
            'id'      => 'psag_background_color',
            'type'    => 'color',
            'name'    => __( 'Background color', 'content-warning-v2' ),
            'default' => 'rgba(0,0,0,0.3)',
        ) );
        $settings->add_field( 'psag_design', array(
            'id'   => 'psag_overlay_background',
            'type' => 'image',
            'name' => __( 'Background image for overlay', 'content-warning-v2' ),
        ) );
        $settings->add_field( 'psag_design', array(
            'id'      => 'psag_z_index_overlay',
            'type'    => 'number',
            'name'    => __( 'Z-Index (Overlay)', 'content-warning-v2' ),
            'default' => 999,
        ) );
        $settings->add_field( 'psag_design', array(
            'id'   => 'psag_box_design_title',
            'type' => 'title',
            'name' => '<h3>' . __( 'Content Box', 'content-warning-v2' ) . '</h3>',
        ) );
        $settings->add_field( 'psag_design', array(
            'id'      => 'psag_columns',
            'type'    => 'select',
            'name'    => __( 'Columns', 'content-warning-v2' ),
            'options' => array(
            'one-column'  => __( 'One Column', 'content-warning-v2' ),
            'two-columns' => __( 'Two Columns', 'content-warning-v2' ),
        ),
            'default' => 'one-column',
        ) );
        $settings->add_field( 'psag_design', array(
            'id'   => 'psag_logo',
            'type' => 'image',
            'name' => __( 'Upload your Logo', 'content-warning-v2' ),
        ) );
        $settings->add_field( 'psag_design', array(
            'id'   => 'psag_background_image_left',
            'type' => 'image',
            'name' => __( 'Background image left', 'content-warning-v2' ),
        ) );
        $settings->add_field( 'psag_design', array(
            'id'      => 'psag_box_width',
            'type'    => 'number',
            'name'    => __( 'Content box width (in px)', 'content-warning-v2' ),
            'default' => '450',
        ) );
        $settings->add_field( 'psag_design', array(
            'id'      => 'psag_box_height',
            'type'    => 'number',
            'name'    => __( 'Content box height (in px)', 'content-warning-v2' ),
            'default' => '500',
        ) );
        $settings->add_field( 'psag_design', array(
            'id'      => 'psag_box_logo_max_width',
            'type'    => 'number',
            'name'    => __( 'Logo max width (in px)', 'content-warning-v2' ),
            'default' => '250',
        ) );
        $settings->add_field( 'psag_design', array(
            'id'      => 'psag_z_index',
            'type'    => 'number',
            'name'    => __( 'Z-Index', 'content-warning-v2' ),
            'default' => 9999,
        ) );
        $settings->add_field( 'psag_design', array(
            'id'   => 'psag_texts_design_title',
            'type' => 'title',
            'name' => '<h3>' . __( 'Texts', 'content-warning-v2' ) . '</h3>',
        ) );
        $settings->add_field( 'psag_design', array(
            'id'      => 'psag_headline_color',
            'type'    => 'color',
            'name'    => __( 'Headline color', 'content-warning-v2' ),
            'default' => '#7c7c7c',
        ) );
        $settings->add_field( 'psag_design', array(
            'id'      => 'psag_instruction_color',
            'type'    => 'color',
            'name'    => __( 'Instruction color', 'content-warning-v2' ),
            'default' => '#7c7c7c',
        ) );
        $settings->add_field( 'psag_design', array(
            'id'      => 'psag_separator_color',
            'type'    => 'color',
            'name'    => __( 'Separator color', 'content-warning-v2' ),
            'default' => '#7c7c7c',
        ) );
        $settings->add_field( 'psag_design', array(
            'id'      => 'psag_subtitle_color',
            'type'    => 'color',
            'name'    => __( 'Subtitle color', 'content-warning-v2' ),
            'default' => '#7c7c7c',
        ) );
        $settings->add_field( 'psag_design', array(
            'id'      => 'psag_slogan_color',
            'type'    => 'color',
            'name'    => __( 'Slogan color', 'content-warning-v2' ),
            'default' => '#ffffff',
        ) );
        $settings->add_field( 'psag_design', array(
            'id'      => 'psag_enter_color',
            'type'    => 'color',
            'name'    => __( 'Enter Button background color', 'content-warning-v2' ),
            'default' => '#a21fff',
        ) );
        $settings->add_field( 'psag_design', array(
            'id'      => 'psag_enter_font_color',
            'type'    => 'color',
            'name'    => __( 'Enter Button font color', 'content-warning-v2' ),
            'default' => '#ffffff',
        ) );
        $settings->add_field( 'psag_design', array(
            'id'      => 'psag_exit_color',
            'type'    => 'color',
            'name'    => __( 'Exit Button background color', 'content-warning-v2' ),
            'default' => '#370059',
        ) );
        $settings->add_field( 'psag_design', array(
            'id'      => 'psag_exit_font_color',
            'type'    => 'color',
            'name'    => __( 'Exit Button font color', 'content-warning-v2' ),
            'default' => '#ffffff',
        ) );
        $settings->add_field( 'psag_design', array(
            'id'   => 'psag_box_design_blur_title',
            'type' => 'title',
            'name' => '<h3>' . __( 'Blur effect', 'content-warning-v2' ) . '</h3>',
        ) );
        $settings->add_field( 'psag_design', array(
            'id'   => 'psag_blur',
            'type' => 'toggle',
            'name' => __( 'Use blur effect', 'content-warning-v2' ),
        ) );
        $settings->add_field( 'psag_design', array(
            'id'      => 'psag_blur_container_id',
            'type'    => 'text',
            'name'    => __( 'Blur effect container', 'content-warning-v2' ),
            'default' => '#page',
        ) );
        $settings->add_field( 'psag_design', array(
            'id'   => 'psag_blur_blur_effect_strength',
            'type' => 'number',
            'name' => __( 'Blur effect strength', 'content-warning-v2' ),
        ) );
        $settings->add_section( array(
            'id'    => 'psag_woocommerce',
            'title' => __( 'WooCommerce', 'content-warning-v2' ),
        ) );
        $settings->add_field( 'psag_woocommerce', array(
            'id'   => 'psag_woocommerce_checkboxes',
            'type' => 'title',
            'name' => '<h3>' . __( 'Registration and Checkout', 'content-warning-v2' ) . '</h3>',
        ) );
        $settings->add_field( 'psag_woocommerce', array(
            'id'      => 'psag_woocommerce_deactivate_age_gate',
            'type'    => 'toggle',
            'name'    => __( 'Deactivate the age gate (use only checkboxes or Sofort Ident for verification)', 'content-warning-v2' ),
            'default' => 'off',
            'premium' => 'premium',
        ) );
        $settings->add_field( 'psag_woocommerce', array(
            'id'      => 'psag_woocommerce_age_verify_registration',
            'type'    => 'toggle',
            'name'    => __( 'Add a age verification checkbox to the registration', 'content-warning-v2' ),
            'default' => 'off',
            'premium' => 'premium',
        ) );
        $settings->add_field( 'psag_woocommerce', array(
            'id'      => 'psag_woocommerce_age_verify_checkout',
            'type'    => 'toggle',
            'name'    => __( 'Add a age verification checkbox to the checkout', 'content-warning-v2' ),
            'premium' => 'premium',
        ) );
        $settings->add_field( 'psag_woocommerce', array(
            'id'      => 'psag_woocommerce_save_age',
            'type'    => 'toggle',
            'name'    => __( 'Save Age Information in customer account', 'content-warning-v2' ),
            'premium' => 'premium',
        ) );
        $settings->add_field( 'psag_woocommerce', array(
            'id'      => 'psag_woocommerce_at_least_18',
            'type'    => 'documentation',
            'name'    => __( 'Modify the checkbox text', 'content-warning-v2' ),
            'desc'    => __( 'This is only available within the pro version.', 'content-warning-v2' ),
            'premium' => 'premium',
        ) );
        $settings->add_field( 'psag_woocommerce', array(
            'id'      => 'psag_woocommerce_at_least_18_error',
            'type'    => 'documentation',
            'name'    => __( 'Modify the error message', 'content-warning-v2' ),
            'desc'    => __( 'This is only available within the pro version.', 'content-warning-v2' ),
            'premium' => 'premium',
        ) );
        $settings->add_field( 'psag_woocommerce', array(
            'id'      => 'psag_woocommerce_apply_to_blacklist',
            'type'    => 'toggle',
            'name'    => __( 'Add checkbox only when blacklisted product in cart.', 'content-warning-v2' ),
            'premium' => 'premium',
        ) );
        $settings->add_field( 'psag_woocommerce', array(
            'id'   => 'psag_woocommerce_sofort_ident_title',
            'type' => 'title',
            'name' => '<h3>' . __( 'Sofort Ident', 'content-warning-v2' ) . '</h3>',
        ) );
        $settings->add_field( 'psag_woocommerce', array(
            'id'   => 'psag_woocommerce_sofort_ident_documentation',
            'type' => 'documentation',
            'name' => __( 'Instructions', 'content-warning-v2' ),
            'desc' => __( 'Activate Sofort Ident for WooCommerce if you need a real age verifcation in your checkout. It sends data via API, verify the customers data and send (if sucessfull) an positive feedback to the shop.', 'content-warning-v2' ),
        ) );
        $settings->add_field( 'psag_woocommerce', array(
            'id'      => 'psag_woocommerce_activate_sofort_ident',
            'type'    => 'toggle',
            'name'    => __( 'Activates the Sofort Ident API', 'content-warning-v2' ),
            'default' => 'off',
            'premium' => 'premium',
        ) );
        $settings->add_field( 'psag_woocommerce', array(
            'id'      => 'psag_woocommerce_sofort_ident_user_id',
            'type'    => 'text',
            'name'    => __( 'User ID', 'content-warning-v2' ),
            'desc'    => __( 'User ID from your Sofort account', 'content-warning-v2' ),
            'premium' => 'premium',
        ) );
        $settings->add_field( 'psag_woocommerce', array(
            'id'      => 'psag_woocommerce_sofort_ident_project_id',
            'type'    => 'text',
            'name'    => __( 'Project ID', 'content-warning-v2' ),
            'desc'    => __( 'Project ID from your Sofort account', 'content-warning-v2' ),
            'premium' => 'premium',
        ) );
        $settings->add_field( 'psag_woocommerce', array(
            'id'      => 'psag_woocommerce_sofort_ident_project_password',
            'type'    => 'text',
            'name'    => __( 'Project password', 'content-warning-v2' ),
            'desc'    => __( 'Project password from your Sofort account', 'content-warning-v2' ),
            'premium' => 'premium',
        ) );
        $settings->add_field( 'psag_woocommerce', array(
            'id'      => 'psag_woocommerce_sofort_ident_testmode',
            'type'    => 'toggle',
            'name'    => __( 'Testmode', 'content-warning-v2' ),
            'default' => 'off',
            'premium' => 'premium',
        ) );
    }
    
    /**
     * Enqueue admin scripts
     *
     * @return void
     */
    public static function add_admin_scripts()
    {
        $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min' );
        wp_enqueue_style(
            'agy-admin',
            AGY_URL . '/assets/admin/agy-admin.css',
            array(),
            AGY_VERSION,
            'all'
        );
        wp_enqueue_script(
            'agy-admin',
            AGY_URL . '/assets/admin/agy-admin' . $suffix . '.js',
            array( 'jquery' ),
            AGY_VERSION,
            true
        );
        wp_localize_script( 'agy-admin', 'agy', array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
        ) );
    }
    
    /**
     * Return default based on option name.
     *
     * @param string $option_name name of the option.
     * @return array
     */
    public static function get_defaults( $option_name )
    {
        switch ( $option_name ) {
            case 'psag_options':
                $settings = array(
                    'psag_display_mode'                    => 'age-submit',
                    'psag_restrict_default_age'            => 18,
                    'psag_debug_mode'                      => 'off',
                    'psag_options_redirect_url'            => get_bloginfo( 'url' ),
                    'psag_cookie_lifetime'                 => 30,
                    'psag_options_users_bypass_registered' => 'off',
                    'psag_blacklist_to_whitelist'          => 'off',
                    'psag_delete_settings_on_uninstall'    => 'off',
                );
                return $settings;
                break;
            case 'psag_texts':
                $settings = array(
                    'psag_texts_headline'         => __( 'Age Verification', 'content-warning-v2' ),
                    'psag_texts_message'          => __( 'By clicking enter, I certify that I am over the age of [age] and will comply with the above statement.', 'content-warning-v2' ),
                    'psag_texts_enter'            => __( 'Enter', 'content-warning-v2' ),
                    'psag_texts_exit'             => __( 'Exit', 'content-warning-v2' ),
                    'psag_texts_separator'        => __( 'Or', 'content-warning-v2' ),
                    'psag_texts_subtitle'         => __( 'Always enjoy responsibily.', 'content-warning-v2' ),
                    'psag_texts_slogan'           => __( 'THINC Pure products are only for use in states where the sale and consumption of such products are legal. ', 'content-warning-v2' ),
                    'psag_texts_allow_shortcodes' => 'off',
                );
                return $settings;
                break;
            case 'psag_design':
                $settings = array(
                    'psag_background_color'          => 'rgba(0,0,0,0.3)',
                    'psag_overlay_background'        => '',
                    'psag_z_index_overlay'           => 9999,
                    'psag_columns'                   => 'one-column',
                    'psag_logo'                      => '',
                    'psag_background_image_left'     => '',
                    'psag_box_width'                 => '450',
                    'psag_box_height'                => '500',
                    'psag_box_logo_max_width'        => '250',
                    'psag_z_index'                   => 99999999,
                    'psag_headline_color'            => '#7c7c7c',
                    'psag_instruction_color'         => '#7c7c7c',
                    'psag_separator_color'           => '#7c7c7c',
                    'psag_subtitle_color'            => '#7c7c7c',
                    'psag_slogan_color'              => '#ffffff',
                    'psag_enter_color'               => '#a21fff',
                    'psag_enter_font_color'          => '#ffffff',
                    'psag_exit_color'                => '#370059',
                    'psag_exit_font_color'           => '#ffffff',
                    'psag_blur'                      => 'off',
                    'psag_blur_container_id'         => '#page',
                    'psag_blur_blur_effect_strength' => 2,
                );
                return $settings;
                break;
            case 'psag_woocommerce':
                $settings = array(
                    'psag_woocommerce_age_verify_registration'         => 'off',
                    'psag_woocommerce_age_verify_checkout'             => 'off',
                    'psag_woocommerce_save_age'                        => 'off',
                    'psag_woocommerce_sofort_ident_user_id'            => '',
                    'psag_woocommerce_sofort_ident_project_id'         => '',
                    'psag_woocommerce_sofort_ident_project_password'   => '',
                    'psag_woocommerce_sofort_ident_hash_mode'          => 'md5',
                    'psag_woocommerce_activate_sofort_ident'           => 'off',
                    'psag_woocommerce_at_least_18'                     => __( "I'm at least 18 years old.", 'content-warning-v2' ),
                    'psag_woocommerce_at_least_18_error'               => __( 'You have to be at least 18 years old to complete the registration.', 'content-warning-v2' ),
                    'psag_woocommerce_apply_to_blacklist'              => 'off',
                    'psag_woocommerce_sofort_ident_apply_to_blacklist' => 'off',
                    'psag_woocommerce_deactivate_age_gate'             => 'off',
                );
                return $settings;
                break;
        }
    }

}