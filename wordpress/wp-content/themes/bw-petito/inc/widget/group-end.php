<?php
/**
 * Created by Sublime Text 3.
 * User: MBach90
 * Date: 24/12/15
 * Time: 10:20 AM
 */
if(!class_exists('Bzotech_Group_End'))
{
    class Bzotech_Group_End extends WP_Widget {


        protected $default=array();

        static function _init()
        {
            add_action( 'widgets_init', array(__CLASS__,'_add_widget') );
        }

        static function _add_widget()
        {
            if(function_exists('bzotech_reg_widget')) bzotech_reg_widget( 'Bzotech_Group_End' );
        }

        function __construct() {
            // Instantiate the parent object
            parent::__construct( false, esc_html__('BZOTECH Group end','bw-petito'),
                array( 'description' => esc_html__( 'End a Group', 'bw-petito' ), ));

            $this->default=array();
        }



        function widget( $args, $instance ) {
            // Widget output
            echo '</div>';
        }

        function update( $new_instance, $old_instance ) {}

        function form( $instance ) {}
    }

    Bzotech_Group_End::_init();

}
