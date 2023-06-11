<?php 

class HT_Testimonials_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'ht-testimonials',
            esc_html__( 'HT Testimonials', 'ht-testimonials' ),
            array( 
                'description' => esc_html__( 'Display Testimonials', 'ht-testimonials' ), 
                'classname' => 'ht-testimonials-widget'
            )
        );

        add_action( 'widgets_init', function() {
                register_widget( 'HT_Testimonials_Widget' );
            }
        );
    }

    public function form( $instance ) {

    }

    public function widget( $args, $instance ) {

    }

    public function update( $new_instance, $old_instance) {

    }
}