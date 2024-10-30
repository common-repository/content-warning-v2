<?php

if ( !function_exists( 'agy_fs' ) ) {
    /**
     * Freemius helper function
     *
     * @return void
     */
    function agy_fs()
    {
        global  $agy_fs ;
        
        if ( !isset( $agy_fs ) ) {
            // Include Freemius SDK.
            require_once dirname( __FILE__ ) . '/freemius/start.php';
            $agy_fs = fs_dynamic_init( array(
                'id'             => '2792',
                'slug'           => 'content-warning-v2',
                'type'           => 'plugin',
                'public_key'     => 'pk_e83b5b3147ec6b780093b99d8fbd4',
                'is_premium'     => false,
                'premium_suffix' => '',
                'has_addons'     => false,
                'has_paid_plans' => true,
                'menu'           => array(
                'slug'    => 'agy_settings',
                'contact' => false,
                'support' => false,
                'parent'  => array(
                'slug' => 'woocommerce',
            ),
            ),
                'is_live'        => true,
            ) );
        }
        
        return $agy_fs;
    }
    
    // Init Freemius.
    agy_fs();
    // Signal that SDK was initiated.
    do_action( 'agy_fs_loaded' );
}

/**
 * Remove freemius pages.
 *
 * @param  bool $is_visible indicates if visible or not.
 * @param  int  $submenu_id current submenu id.
 * @return bool
 */
function agy_is_submenu_visible( $is_visible, $submenu_id )
{
    return false;
}

agy_fs()->add_filter(
    'is_submenu_visible',
    'agy_is_submenu_visible',
    10,
    2
);
/**
 * Add custom icon for Freemius.
 *
 * @return string
 */
function agy_custom_icon()
{
    return AGY_PATH . '/assets/admin/agy-logo.svg';
}

agy_fs()->add_filter( 'plugin_icon', 'agy_custom_icon' );
/**
 * Clean up after uninstallation
 *
 * @return void
 */
function agy_cleanup()
{
    $advanced_options = get_option( 'passster_advanced_settings' );
    
    if ( isset( $advanced_options ) ) {
        $options = array(
            'psag_woocommerce',
            'psag_design',
            'psag_texts',
            'psag_options'
        );
        // Check if we should delete settings.
        $settings = get_option( 'psag_options' );
        if ( isset( $settings['psag_delete_settings_on_uninstall'] ) && !empty($settings['psag_delete_settings_on_uninstall']) && 'on' === $settings['psag_delete_settings_on_uninstall'] ) {
            
            if ( is_multisite() ) {
                foreach ( $options as $option ) {
                    delete_site_option( $option );
                }
            } else {
                foreach ( $options as $option ) {
                    delete_option( $option );
                }
            }
        
        }
    }

}

agy_fs()->add_action( 'after_uninstall', 'agy_cleanup' );