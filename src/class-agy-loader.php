<?php

namespace agy;

/**
 * Loader Class
 */
class AGY_Loader
{
    /**
     * Return instance of AGY_Loader
     *
     * @return void
     */
    public static function get_instance()
    {
        new AGY_Loader();
    }
    
    /**
     * Constructor for AGY_Loader
     */
    public function __construct()
    {
        // Check if Agy is allready installed.
        $options = get_option( 'psag_options' );
        
        if ( isset( $options ) && !empty($options) ) {
            add_action( 'wp_footer', array( $this, 'load_template' ) );
            add_action( 'wp_enqueue_scripts', array( $this, 'add_template_assets' ) );
        }
    
    }
    
    /**
     * Output the selected templates based on given options
     *
     * @return void
     */
    public function load_template()
    {
        if ( true === self::check_blacklist_status() ) {
            return;
        }
        if ( true === AGY_Public::bot_detected() ) {
            return;
        }
        $general_options = wp_parse_args( get_option( 'psag_options' ), AGY_Admin::get_defaults( 'psag_options' ) );
        $text_options = wp_parse_args( get_option( 'psag_texts' ), AGY_Admin::get_defaults( 'psag_texts' ) );
        
        if ( isset( $general_options['psag_options_users_bypass_registered'] ) && 'on' === $general_options['psag_options_users_bypass_registered'] ) {
            
            if ( !is_user_logged_in() ) {
                $template = AGY_Templates::get_accept_form();
                
                if ( 'on' === $text_options['psag_texts_allow_shortcodes'] ) {
                    // Now we render shortcodes and other things.
                    remove_filter( 'the_content', 'wpautop' );
                    $template = apply_filters( 'the_content', $template );
                    echo  $template ;
                    add_filter( 'the_content', 'wpautop' );
                } else {
                    echo  $template ;
                }
            
            }
        
        } else {
            $template = AGY_Templates::get_accept_form();
            
            if ( 'on' === $text_options['psag_texts_allow_shortcodes'] ) {
                // Now we render shortcodes and other things.
                remove_filter( 'the_content', 'wpautop' );
                $template = apply_filters( 'the_content', $template );
                echo  $template ;
                add_filter( 'the_content', 'wpautop' );
            } else {
                echo  $template ;
            }
        
        }
    
    }
    
    /**
     * Enqueue assets based on options
     *
     * @return void
     */
    public function add_template_assets()
    {
        if ( true === self::check_blacklist_status() ) {
            return;
        }
        if ( true === AGY_Public::bot_detected() ) {
            return;
        }
        $general_options = wp_parse_args( get_option( 'psag_options' ), AGY_Admin::get_defaults( 'psag_options' ) );
        $design_options = wp_parse_args( get_option( 'psag_design' ), AGY_Admin::get_defaults( 'psag_design' ) );
        $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min' );
        /* include cookie js */
        wp_enqueue_script(
            'cookie-js',
            AGY_URL . '/assets/public/cookie.min.js',
            array(),
            false,
            true
        );
        $age = $general_options['psag_restrict_default_age'];
        
        if ( isset( $general_options['psag_display_mode'] ) ) {
            $display_mode = $general_options['psag_display_mode'];
        } else {
            $display_mode = 'age-submit';
        }
        
        $options = array(
            'age'             => $age,
            'display_mode'    => $display_mode,
            'error_message'   => sprintf( __( 'Sorry, only persons over the age of %s may enter this site', 'content-warning-v2' ), esc_html( $age ) ),
            'exit_url'        => $general_options['psag_options_redirect_url'],
            'cookie_lifetime' => $general_options['psag_cookie_lifetime'],
            'is_debug'        => $general_options['psag_debug_mode'],
            'blur_container'  => $design_options['psag_blur_container_id'],
            'ajax_url'        => admin_url( 'admin-ajax.php' ),
        );
        
        if ( isset( $general_options['psag_options_users_bypass_registered'] ) && 'on' === $general_options['psag_options_users_bypass_registered'] ) {
            
            if ( !is_user_logged_in() ) {
                wp_enqueue_script(
                    'agy-public-js',
                    AGY_URL . '/assets/public/agy-public' . $suffix . '.js',
                    array( 'jquery' ),
                    AGY_VERSION,
                    true
                );
                wp_localize_script( 'agy-public-js', 'options', $options );
            }
        
        } else {
            wp_enqueue_script(
                'agy-public-js',
                AGY_URL . '/assets/public/agy-public' . $suffix . '.js',
                array( 'jquery' ),
                AGY_VERSION,
                true
            );
            wp_localize_script( 'agy-public-js', 'options', $options );
        }
    
    }
    
    /**
     * Determines if the post/page/product is on blacklist.
     *
     * @return boolean
     */
    public static function check_blacklist_status()
    {
        $general_options = wp_parse_args( get_option( 'psag_options' ), AGY_Admin::get_defaults( 'psag_options' ) );
        $whitelist_mode = $general_options['psag_blacklist_to_whitelist'];
        // set comparable for blacklists.
        $is_blacklist = true;
        if ( isset( $whitelist_mode ) && 'on' === $whitelist_mode ) {
            $is_blacklist = false;
        }
        include_once ABSPATH . 'wp-admin/includes/plugin.php';
        
        if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
            /* shop page */
            if ( function_exists( 'is_shop' ) ) {
                
                if ( is_shop() ) {
                    $shop_id = get_option( 'woocommerce_shop_page_id' );
                    $blacklist = get_post_meta( $shop_id, 'blacklist', true );
                    
                    if ( $is_blacklist == $blacklist ) {
                        return true;
                    } else {
                        return false;
                    }
                
                }
            
            }
            /* cart page */
            if ( function_exists( 'is_cart' ) ) {
                
                if ( is_cart() ) {
                    $cart_id = get_option( 'woocommerce_cart_page_id' );
                    $blacklist = get_post_meta( $cart_id, 'blacklist', true );
                    
                    if ( $is_blacklist == $blacklist ) {
                        return true;
                    } else {
                        return false;
                    }
                
                }
            
            }
            /* checkout page */
            if ( function_exists( 'is_checkout' ) ) {
                
                if ( is_checkout() ) {
                    $checkout_id = get_option( 'woocommerce_checkout_page_id' );
                    $blacklist = get_post_meta( $checkout_id, 'blacklist', true );
                    
                    if ( $is_blacklist == $blacklist ) {
                        return true;
                    } else {
                        return false;
                    }
                
                }
            
            }
            /* account page */
            if ( function_exists( 'is_account_page' ) ) {
                
                if ( is_account_page() ) {
                    $account_id = get_option( 'woocommerce_myaccount_page_id' );
                    $blacklist = get_post_meta( $account_id, 'blacklist', true );
                    
                    if ( $is_blacklist == $blacklist ) {
                        return true;
                    } else {
                        return false;
                    }
                
                }
            
            }
        }
        
        /* normal pages/products/posts */
        $blacklist = get_post_meta( get_the_id(), 'blacklist', true );
        if ( $is_blacklist == $blacklist ) {
            return true;
        }
        return false;
    }

}