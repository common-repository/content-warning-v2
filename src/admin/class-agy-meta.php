<?php

namespace agy;

/**
 * Admin Meta Class
 */
class AGY_Meta
{
    /**
     * Return instance of AGY_Meta
     *
     * @return void
     */
    public static function get_instance()
    {
        new AGY_Meta();
    }
    
    /**
     * Constructor for AGY_Meta.
     */
    public function __construct()
    {
        add_action( 'add_meta_boxes', array( $this, 'add_metaboxes' ) );
        add_action( 'save_post', array( $this, 'save_metaboxes' ) );
    }
    
    /**
     * Adds the meta box container.
     *
     * @param array $post_type array of post types.
     * @return void
     */
    public function add_metaboxes( $post_type )
    {
        $post_types = apply_filters( 'agy_supported_post_types', array( 'post', 'page', 'product' ) );
        if ( in_array( $post_type, $post_types ) ) {
            add_meta_box(
                'agy',
                __( 'Agy Display options', 'content-warning-v2' ),
                array( $this, 'render_metabox' ),
                $post_type,
                'side',
                'high'
            );
        }
    }
    
    /**
     * Render Meta Box content.
     *
     * @param WP_Post $post The post object.
     */
    public function render_metabox( $post )
    {
        wp_nonce_field( 'blacklist_nonce_check', 'blacklist_nonce_check_value' );
        $screen = get_current_screen();
        $blacklist = get_post_meta( $post->ID, 'blacklist', true );
        /* get value and check status */
        
        if ( true == $blacklist ) {
            $checked = 'checked="checked"';
        } else {
            $checked = '';
        }
        
        $general_options = wp_parse_args( get_option( 'psag_options' ), AGY_Admin::get_defaults( 'psag_options' ) );
        // whitelist or blacklist.
        $blacklist_label = __( '<b>Deactivate</b> Age Verification for this content.', 'content-warning-v2' );
        if ( isset( $general_options['psag_blacklist_to_whitelist'] ) && 'on' === $general_options['psag_blacklist_to_whitelist'] ) {
            $blacklist_label = __( '<b>Activate</b> Age Verification for this content.', 'content-warning-v2' );
        }
        ?>
		<div>
			<label>
				<input type="checkbox" name="blacklist" id="blacklist" value="<?php 
        echo  $blacklist ;
        ?>" <?php 
        echo  $checked ;
        ?>>
				<?php 
        echo  $blacklist_label ;
        ?>
			</label>
		</div>
		<?php 
        ?>	
		<?php 
    }
    
    /**
     * Save the meta when the post is saved.
     *
     * @param int $post_id The ID of the post being saved.
     */
    public function save_metaboxes( $post_id )
    {
        // Check if our nonce is set.
        if ( !isset( $_POST['blacklist_nonce_check_value'] ) ) {
            return $post_id;
        }
        // Verify that the nonce is valid.
        if ( !wp_verify_nonce( $_POST['blacklist_nonce_check_value'], 'blacklist_nonce_check' ) ) {
            return $post_id;
        }
        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }
        // Check the user's permissions.
        if ( !current_user_can( 'edit_post', $post_id ) ) {
            return $post_id;
        }
        // Update the meta fields.
        
        if ( isset( $_POST['blacklist'] ) ) {
            update_post_meta( $post_id, 'blacklist', true );
        } else {
            delete_post_meta( $post_id, 'blacklist' );
        }
    
    }

}