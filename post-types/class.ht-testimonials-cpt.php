<?php

if ( !class_exists( 'HT_Testimonials_Post_Type') ){
    class HT_Testimonials_Post_Type{
        public function __construct(){
            add_action( 'init', array( $this, 'create_post_type' ) );

            add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
            add_action( 'save_post', array( $this, 'save_meta_boxes' ) );
        }

        public function create_post_type(){
            register_post_type(
                'ht-testimonials',
                array(
                    'label' => esc_html__( 'HT Testimonial', 'ht-testimonials' ),
                    'description' => esc_html__( 'Testimonials', 'ht-testimonials' ),
                    'labels' => array(
                        'name' => esc_html__( 'Testimonials', 'ht-testimonials' ),
                        'singular_name' => esc_html__( 'Testimonial', 'ht-testimonials' ),
                        'menu_name' => esc_html__( 'Testimonial', 'ht-testimonials' ),
                        'name_admin_bar' => esc_html__( 'Testimonial', 'ht-testimonials' ),
                        'add_new' => esc_html__( 'Add New', 'ht-testimonials' ),
                        'add_new_item' => esc_html__( 'Add New Testimonial', 'ht-testimonials' ),
                        'new_item' => esc_html__( 'New Testimonial', 'ht-testimonials' ),
                        'edit_item' => esc_html__( 'Edit Testimonial', 'ht-testimonials' ),
                        'view_item' => esc_html__( 'View Testimonial', 'ht-testimonials' ),
                        'all_items' => esc_html__( 'All Testimonials', 'ht-testimonials' ),
                        'search_items' => esc_html__( 'Search Testimonials', 'ht-testimonials' ),
                        'parent_item_colon' => esc_html__( 'Parent Testimonials:', 'ht-testimonials' ),
                        'not_found' => esc_html__( 'No Testimonials found.', 'ht-testimonials' ),
                        'not_found_in_trash' => esc_html__( 'No Testimonials found in Trash.', 'ht-testimonials' ),
                        'featured_image' => esc_html__( 'Testimonial Cover Image', 'ht-testimonials' ),
                        'set_featured_image' => esc_html__( 'Set cover image', 'ht-testimonials' ),
                        'remove_featured_image' => esc_html__( 'Remove cover image', 'ht-testimonials' ),
                        'use_featured_image' => esc_html__( 'Use as cover image', 'ht-testimonials' ),
                        'archives' => esc_html__( 'Testimonial archives', 'ht-testimonials' ),
                        'insert_into_item' => esc_html__( 'Insert into Testimonial', 'ht-testimonials' ),
                        'uploaded_to_this_item' => esc_html__( 'Uploaded to this Testimonial', 'ht-testimonials' ),
                        'filter_items_list' => esc_html__( 'Filter Testimonials list', 'ht-testimonials' ),
                        'items_list_navigation' => esc_html__( 'Testimonials list navigation', 'ht-testimonials' ),
                        'items_list' => esc_html__( 'Testimonials list', 'ht-testimonials' ),
                    ),
                    'public' => true,
                    'supports' => array( 'title', 'editor', 'thumbnail' ),
                    'heirarchical' => false,
                    'show_ui' => true,
                    'show_in_menu' => true,
                    'menu_position' => 5,
                    'show_in_admin_bar' => true,
                    'show_in_nav_menus' => true,
                    'can_export' => true,
                    'has_archive' => true,
                    'exclude_from_search' => false,
                    'publicly_queryable' => true,
                    'show_in_rest' => true,
                    'menu_icon' => 'dashicons-testimonial',
                )
            );
        }

        public function add_meta_boxes() {
            add_meta_box(
                'ht-testimonials-meta-box',
                esc_html__( 'Testimonials Options', 'ht-testimonials' ),
                array( $this, 'add_inner_meta_boxes' ),
                'ht-testimonials',
                'normal',
                'high'
            );
        }

        public function add_inner_meta_boxes( $post ) {
            require_once HT_TESTIMONIALS_PATH . 'views/ht-testimonials_metabox.php';
        }

        public function save_meta_boxes( $post_id ){
            if( isset( $_POST['ht_testimonials_nonce'] ) && !wp_verify_nonce( $_POST['ht_testimonials_nonce'], 'ht_testimonials_nonce' ) ){
                return;
            }

            if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
                return;
            }

            if( isset( $_POST['post_type'] ) && $_POST['post_type'] === 'ht-testimonial' ){
                if( ! current_user_can( 'edit_page', $post_id ) || ! current_user_can( 'edit_post', $post_id ) ){
                    return;
                }
            }

            if (isset($_POST['action']) && $_POST['action'] == 'editpost') {
                $old_occupation = get_post_meta( $post_id, 'ht_testimonials_occupation', true ); 
                $new_occupation = $_POST['ht_testimonials_occupation'];
                $old_company    = get_post_meta( $post_id, 'ht_testimonials_company', true ); 
                $new_company    = $_POST['ht_testimonials_company'];
                $old_user_url   = get_post_meta( $post_id, 'ht_testimonials_user_url', true ); 
                $new_user_url   = $_POST['ht_testimonials_user_url']; 
            
                update_post_meta( $post_id, 'ht_testimonials_occupation', sanitize_text_field( $new_occupation ), $old_occupation );
                update_post_meta( $post_id, 'ht_testimonials_company', sanitize_text_field( $new_company ), $old_company );
                update_post_meta( $post_id, 'ht_testimonials_user_url', esc_url_raw( $new_user_url ), $old_user_url );
            }
        }
    }
}