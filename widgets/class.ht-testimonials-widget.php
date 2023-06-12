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
        $title = isset( $instance['title'] ) ? $instance['title'] : esc_html__( 'Testimonials', 'ht-testimonials' );
        $number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
        $image = isset( $instance['image'] ) ? (bool) $instance['image'] : false;
        $occupation = isset( $instance['occupation'] ) ? (bool) $instance['occupation'] : false;
        $company = isset( $instance['company'] ) ? (bool) $instance['company'] : false;
        ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title', 'ht-testimonials' ) ?>:</label>
                <input type="text" class="widefat" 
                    id="<?php echo $this->get_field_id( 'title' ); ?>" 
                    name="<?php echo $this->get_field_name( 'title' ); ?>"
                    value="<?php echo esc_attr( $title ); ?>" 
                >
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html_e( 'Number of testimonials to show', 'ht-testimonials' ) ?>:</label>
                <input type="number" class="tiny-text" step="1" min="1" size="3"
                    id="<?php echo $this->get_field_id( 'number' ); ?>" 
                    name="<?php echo $this->get_field_name( 'number' ); ?>"
                    value="<?php echo esc_attr( $number ); ?>" 
                >
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php esc_html_e( 'Display user image?', 'ht-testimonials' ) ?>:</label>
                <input type="checkbox" class="checkbox" <?php checked( $image ); ?>
                    id="<?php echo $this->get_field_id( 'image' ); ?>" 
                    name="<?php echo $this->get_field_name( 'image' ); ?>"
                >
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'occupation' ); ?>"><?php esc_html_e( 'Display occupation?', 'ht-testimonials' ) ?>:</label>
                <input type="checkbox" class="checkbox" <?php checked( $occupation ); ?>
                    id="<?php echo $this->get_field_id( 'occupation' ); ?>" 
                    name="<?php echo $this->get_field_name( 'occupation' ); ?>"
                >
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'company' ); ?>"><?php esc_html_e( 'Display company?', 'ht-testimonials' ) ?>:</label>
                <input type="checkbox" class="checkbox" <?php checked( $company ); ?>
                    id="<?php echo $this->get_field_id( 'company' ); ?>" 
                    name="<?php echo $this->get_field_name( 'company' ); ?>"
                >
            </p>
        <?php
    }

    public function widget( $args, $instance ) {

    }

    public function update( $new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        $instance['number'] = absint( $new_instance['number'] );
        $instance['image'] = ! empty( $new_instance['image'] )? 1 : 0;
        $instance['occupation'] = ! empty( $new_instance['occupation'] )? 1 : 0;
        $instance['company'] = ! empty( $new_instance['company'] )? 1 : 0;
        return $instance;
    }
}