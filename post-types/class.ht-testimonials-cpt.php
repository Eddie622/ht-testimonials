<?php

if ( !class_exists( 'HT_Testimonials_Post_Type') ){
    class HT_Testimonials_Post_Type{
        public function __construct(){
            add_action( 'init', array( $this, 'create_post_type' ) );
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
    }
}