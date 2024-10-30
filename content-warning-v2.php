<?php

/**
 * Plugin Name:       Agy
 * Plugin URI:        https://patrickposner.dev
 * Description:       A simple, responsive and clean solution for age verification with WooCommerce.
 * Version:           4.3.2
 * Author:            Patrick Posner
 * Author URI:        https://patrickposner.dev
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       content-warning-v2
 * Domain Path:       /languages
 * WC requires at least: 4.5
 * WC tested up to: 6.3
 *
 */
define( 'AGY_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'AGY_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) );
define( 'AGY_VERSION', '4.3.2' );
// Bootmanager for Agy plugin.

if ( !function_exists( 'agy_run_plugin' ) ) {
    // autoload files.
    if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
        require __DIR__ . '/vendor/autoload.php';
    }
    add_action( 'plugins_loaded', 'agy_run_plugin' );
    /**
     * Run plugin
     *
     * @return void
     */
    function agy_run_plugin()
    {
        // load setup.
        require_once AGY_PATH . '/inc/setup.php';
        // localize.
        $textdomain_dir = plugin_basename( dirname( __FILE__ ) ) . '/languages';
        load_plugin_textdomain( 'content-warning-v2', false, $textdomain_dir );
        
        if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
            agy\AGY_Admin::init();
            agy\AGY_Meta::get_instance();
            agy\AGY_Tax_Meta::get_instance();
            agy\AGY_Loader::get_instance();
            agy\AGY_Public::get_instance();
        } else {
            deactivate_plugins( plugin_basename( __FILE__ ) );
            wp_die( esc_html__( 'Agy requires WooCommerce to run, please install it.', 'content-warning-v2' ), 'Plugin dependency check', array(
                'back_link' => true,
            ) );
        }
    
    }

}
