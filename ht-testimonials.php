<?php

/**
* Plugin Name: HT Testimonials
* Plugin URI: https://www.wordpress.org/ht-testimonials
* Description: My plugin's description
* Version: 1.0
* Requires at least: 5.6
* Requires PHP: 7.0
* Author: Heriberto Torres
* Author URI: https://heribertotorres.com
* License: GPL v2 or later
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
* Text Domain: ht-testimonials
* Domain Path: /languages
*/
/*
HT Testimonials is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
HT Testimonials is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with HT Testimonials. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if( !class_exists( 'HT_Testimonials' ) ){

    class HT_Testimonials{

        public function __construct() {

            // Define constants used througout the plugin
            $this->define_constants();

            $this->load_textdomain();

            require_once( HT_TESTIMONIALS_PATH . 'post-types/class.ht-testimonials-cpt.php' );
            $HTTestimonialsPostType = new HT_Testimonials_Post_Type();

            require_once( HT_TESTIMONIALS_PATH . 'widgets/class.ht-testimonials-widget.php' );
            $HTTestimonialsWidget = new HT_Testimonials_Widget();

            add_filter( 'archive_template', array( $this, 'get_archive_template' ) );
            add_filter( 'single_template', array( $this, 'get_single_template' ) );
        }

         /**
         * Define Constants
         */
        public function define_constants(){
            // Path/URL to root of this plugin, with trailing slash.
            define ( 'HT_TESTIMONIALS_PATH', plugin_dir_path( __FILE__ ) );
            define ( 'HT_TESTIMONIALS_URL', plugin_dir_url( __FILE__ ) );
            define ( 'HT_TESTIMONIALS_VERSION', '1.0.0' );
            define ( 'HT_TESTIMONIALS_OVERRIDE_PATH_DIR', get_stylesheet_directory() . '/ht-testimonials/' );
        }

        /**
         * Get archive template
         */
        public function get_archive_template( $template ) {
            if( current_theme_supports( 'ht-testimonials' ) ) {
                if ( is_post_type_archive ( 'ht-testimonials' ) ) {
                    $template = $this->get_template_part_location( 'archive-ht-testimonials.php' );
                }
            }
            return $template;
        }

        /**
         * Get single template
         */
        public function get_single_template( $template ) {
            if( current_theme_supports( 'ht-testimonials' ) ) {
                if ( is_singular( 'ht-testimonials' ) ) {
                    $template = $this->get_template_part_location( 'single-ht-testimonials.php' );
                }
            }
            return $template;
        }

        public function get_template_part_location( $file ){
            if( file_exists( HT_TESTIMONIALS_OVERRIDE_PATH_DIR . $file ) ){
                $file = HT_TESTIMONIALS_OVERRIDE_PATH_DIR . $file;
            } else {
                $file = HT_TESTIMONIALS_PATH . 'views/templates/' . $file;
            }
            return $file;
        }

        /**
         * Activate the plugin
         */
        public static function activate(){
            update_option('rewrite_rules', '' );
        }

        /**
         * Deactivate the plugin
         */
        public static function deactivate(){
            unregister_post_type( 'ht-testimonials' );
            flush_rewrite_rules();
        }

        /**
         * Uninstall the plugin
         */
        public static function uninstall(){
            delete_option( 'widget_ht-testimonials' );

            $posts = get_posts( 
                array(
                    'post_type' => 'ht-testimonials',
                    'numberposts' => -1,
                    'post_status' => 'any'
                ) 
            );

            foreach( $posts as $post ){
                wp_delete_post( $post->ID, true );
            }
        }

        public function load_textdomain(){
            load_plugin_textdomain( 'ht-testimonials', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
        }
    }
}

if( class_exists( 'HT_Testimonials' ) ){
    // Installation and uninstallation hooks
    register_activation_hook( __FILE__, array( 'HT_Testimonials', 'activate'));
    register_deactivation_hook( __FILE__, array( 'HT_Testimonials', 'deactivate'));
    register_uninstall_hook( __FILE__, array( 'HT_Testimonials', 'uninstall' ) );

    $ht_testimonials = new HT_Testimonials();
}