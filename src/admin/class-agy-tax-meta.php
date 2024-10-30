<?php

namespace agy;

/**
 * Admin Meta Class
 */
class AGY_Tax_Meta
{
    /**
     * Return instance of AGY_Tax_Meta
     *
     * @return void
     */
    public static function get_instance()
    {
        new AGY_Tax_Meta();
    }
    
    /**
     * Constructor for AGY_Tax_Meta.
     */
    public function __construct()
    {
    }
    
    /**
     * Register Meta for terms.
     *
     * @return void
     */
    public function register_blacklist_meta()
    {
    }
    
    /**
     * New term meta fields.
     *
     * @return void
     */
    public function add_form_field_term_blacklist()
    {
    }
    
    /**
     * Edit term meta fields
     *
     * @param object $term current term object.
     * @return void
     */
    public function edit_form_field_term_blacklist( $term )
    {
    }
    
    /**
     * Save term object.
     *
     * @param int $term_id current term id.
     * @return void
     */
    public function save_term_blacklist( $term_id )
    {
    }
    
    /**
     * Modify admin columns for term.
     *
     * @param array $columns array of column names.
     * @return array
     */
    public function edit_term_columns( $columns )
    {
    }
    
    /**
     * Add content to column row.
     *
     * @param string $out the output.
     * @param string $column the column.
     * @param int    $term_id current term id.
     * @return string
     */
    public function manage_term_custom_column( $out, $column, $term_id )
    {
    }

}