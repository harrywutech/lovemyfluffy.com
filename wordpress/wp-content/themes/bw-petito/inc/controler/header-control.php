<?php
if(!class_exists('Bzotech_HeaderController'))
{
    class Bzotech_HeaderController{

        static function _init()
        {
            if(function_exists('bzotech_reg_post_type'))
            {
                add_action('init',array(__CLASS__,'_add_post_type'));
            }
        }

        static function _add_post_type()
        {
            $labels = array(
                'name'               => esc_html__('Header Page','bw-petito'),
                'singular_name'      => esc_html__('Header Page','bw-petito'),
                'menu_name'          => esc_html__('Header Page','bw-petito'),
                'name_admin_bar'     => esc_html__('Header Page','bw-petito'),
                'add_new'            => esc_html__('Add New','bw-petito'),
                'add_new_item'       => esc_html__( 'Add New Header','bw-petito' ),
                'new_item'           => esc_html__( 'New Header', 'bw-petito' ),
                'edit_item'          => esc_html__( 'Edit Header', 'bw-petito' ),
                'view_item'          => esc_html__( 'View Header', 'bw-petito' ),
                'all_items'          => esc_html__( 'All Header', 'bw-petito' ),
                'search_items'       => esc_html__( 'Search Header', 'bw-petito' ),
                'parent_item_colon'  => esc_html__( 'Parent Header:', 'bw-petito' ),
                'not_found'          => esc_html__( 'No Header found.', 'bw-petito' ),
                'not_found_in_trash' => esc_html__( 'No Header found in Trash.', 'bw-petito' )
            );

            $args = array(
                'labels'             => $labels,
                'public'             => true,
                'publicly_queryable' => true,
                'show_ui'            => true,
                'show_in_menu'       => true,
                'query_var'          => true,
                'rewrite'            => array( 'slug' => 'bzotech_header' ),
                'capability_type'    => 'post',
                'has_archive'        => true,
                'hierarchical'       => false,
                'menu_position'      => null,
                'menu_icon'          => get_template_directory_uri() . "/assets/admin/image/header-icon.png",
                'supports'           => array( 'title', 'editor', 'revisions' )
            );

            bzotech_reg_post_type('bzotech_header',$args);
        }
    }

    Bzotech_HeaderController::_init();

}