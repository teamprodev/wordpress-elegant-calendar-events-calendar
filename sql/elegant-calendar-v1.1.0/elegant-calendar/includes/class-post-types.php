<?php
/**
 * Elegant_Calendar_Post_Types Class
 *
 * Plugin Post_Types Class
 *
 * @since  1.0.0
 * @package Elegant Calendar
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if ( ! class_exists( 'Elegant_Calendar_Post_Types' ) ) :

    class Elegant_Calendar_Post_Types {

        /**
         * Plugin instance
         *
         * @var null
         */
        private static $instance = null;

        /**
         * Return the plugin instance
         *
         * @since 1.0.0
         * @return Elegant_Calendar_Post_Types
         */
        public static function get_instance() {
            if ( is_null( self::$instance ) ) {
                self::$instance = new self();
            }

            return self::$instance;
        }

        /**
         * Elegant_Calendar_Post_Types constructor.
         *
         * @since 1.0
         */
        public function __construct() {
            add_action( 'init', array( $this, 'register_post_types' ) );
            add_action( 'init', array( $this, 'register_taxonomies' ) );
        }

        /**
		 * Called on init
		 *
		 * Register elegant event taxonomies
		 *
		 * @since 1.0.0
		 */
		public function register_taxonomies() {
            $__capabilities = array(
                'manage_terms' 		=> 'manage_elegant_terms',
                'edit_terms' 		=> 'edit_elegant_terms',
                'delete_terms' 		=> 'delete_elegant_terms',
                'assign_terms' 		=> 'assign_elegant_terms',
            );

            $_name = esc_html__('Event Location',Elegant_Calendar::DOMAIN);
            $_names = esc_html__('Event Locations',Elegant_Calendar::DOMAIN);
            register_taxonomy( 'elegant_event_location',
                apply_filters( 'elegant_taxonomy_objects_event_location', array('elegant_event') ),
                apply_filters( 'elegant_taxonomy_args_event_location', array(
                    'hierarchical' => false,
                    'labels' => array(
                        'name' 				=> sprintf( wp_kses( __( "%s", Elegant_Calendar::DOMAIN ), [] ), $_name ),
                        'singular_name' 	=> sprintf( wp_kses( __( "%s", Elegant_Calendar::DOMAIN ), [] ), $_name ),
                        'menu_name'			=> _x( $_name, 'Admin menu name', Elegant_Calendar::DOMAIN ),
                        'search_items' 		=> sprintf( wp_kses( __( "Search %s", Elegant_Calendar::DOMAIN ), [] ), $_names ),
                        'all_items' 		=> sprintf( wp_kses( __( "All %s", Elegant_Calendar::DOMAIN ), [] ), $_names ),
                        'parent_item' 		=> sprintf( wp_kses( __( "Parent %s", Elegant_Calendar::DOMAIN ), [] ), $_names ),
                        'parent_item_colon' => sprintf( wp_kses( __( "Parent %s:", Elegant_Calendar::DOMAIN ), [] ), $_names ),
                        'edit_item' 		=> sprintf( wp_kses( __( "Edit %s", Elegant_Calendar::DOMAIN ), [] ), $_names ),
                        'update_item' 		=> sprintf( wp_kses( __( "Update %s", Elegant_Calendar::DOMAIN ), [] ), $_names ),
                        'add_new_item' 		=> sprintf( wp_kses( __( "Add New %s", Elegant_Calendar::DOMAIN ), [] ), $_names ),
                        'new_item_name' 	=> sprintf( wp_kses( __( "New %s", Elegant_Calendar::DOMAIN ), [] ), $_names )
                    ),
                    'public' => true,
                    'show_ui' => true,
                    'query_var' => true,
                    'show_in_quick_edit'         => false,
                    'meta_box_cb'                => false
                ))
            );

            $_name = esc_html__('Event Organizer',Elegant_Calendar::DOMAIN);
            $_names = esc_html__('Event Organizers',Elegant_Calendar::DOMAIN);
            register_taxonomy( 'elegant_event_organizer',
                apply_filters( 'elegant_taxonomy_objects_event_organizer', array('elegant_event') ),
                apply_filters( 'elegant_taxonomy_args_event_organizer', array(
                    'hierarchical' => false,
                    'labels' => array(
                        'name' 				=> sprintf( wp_kses( __( "%s", Elegant_Calendar::DOMAIN ), [] ), $_name ),
                        'singular_name' 	=> sprintf( wp_kses( __( "%s", Elegant_Calendar::DOMAIN ), [] ), $_name ),
                        'menu_name'			=> _x( $_name, 'Admin menu name', Elegant_Calendar::DOMAIN ),
                        'search_items' 		=> sprintf( wp_kses( __( "Search %s", Elegant_Calendar::DOMAIN ), [] ), $_names ),
                        'all_items' 		=> sprintf( wp_kses( __( "All %s", Elegant_Calendar::DOMAIN ), [] ), $_names ),
                        'parent_item' 		=> sprintf( wp_kses( __( "Parent %s", Elegant_Calendar::DOMAIN ), [] ), $_names ),
                        'parent_item_colon' => sprintf( wp_kses( __( "Parent %s:", Elegant_Calendar::DOMAIN ), [] ), $_names ),
                        'edit_item' 		=> sprintf( wp_kses( __( "Edit %s", Elegant_Calendar::DOMAIN ), [] ), $_names ),
                        'update_item' 		=> sprintf( wp_kses( __( "Update %s", Elegant_Calendar::DOMAIN ), [] ), $_names ),
                        'add_new_item' 		=> sprintf( wp_kses( __( "Add New %s", Elegant_Calendar::DOMAIN ), [] ), $_names ),
                        'new_item_name' 	=> sprintf( wp_kses( __( "New %s", Elegant_Calendar::DOMAIN ), [] ), $_names )
                    ),
                    'public' => true,
                    'show_ui' => true,
                    'query_var' => true,
                    'show_in_quick_edit'         => false,
                    'meta_box_cb'                => false
                ))
            );

            $_name = esc_html__('Event Type',Elegant_Calendar::DOMAIN);
            $_names = esc_html__('Event Type',Elegant_Calendar::DOMAIN);
            register_taxonomy( 'elegant_event_type',
                apply_filters( 'elegant_taxonomy_objects_event_type', array('elegant_event') ),
                apply_filters( 'elegant_taxonomy_args_event_type', array(
                    'hierarchical' => false,
                    'labels' => array(
                        'name' 				=> sprintf( wp_kses( __( "%s", Elegant_Calendar::DOMAIN ), [] ), $_name ),
                        'singular_name' 	=> sprintf( wp_kses( __( "%s", Elegant_Calendar::DOMAIN ), [] ), $_name ),
                        'menu_name'			=> _x( $_name, 'Admin menu name', Elegant_Calendar::DOMAIN ),
                        'search_items' 		=> sprintf( wp_kses( __( "Search %s", Elegant_Calendar::DOMAIN ), [] ), $_names ),
                        'all_items' 		=> sprintf( wp_kses( __( "All %s", Elegant_Calendar::DOMAIN ), [] ), $_names ),
                        'parent_item' 		=> sprintf( wp_kses( __( "Parent %s", Elegant_Calendar::DOMAIN ), [] ), $_names ),
                        'parent_item_colon' => sprintf( wp_kses( __( "Parent %s:", Elegant_Calendar::DOMAIN ), [] ), $_names ),
                        'edit_item' 		=> sprintf( wp_kses( __( "Edit %s", Elegant_Calendar::DOMAIN ), [] ), $_names ),
                        'update_item' 		=> sprintf( wp_kses( __( "Update %s", Elegant_Calendar::DOMAIN ), [] ), $_names ),
                        'add_new_item' 		=> sprintf( wp_kses( __( "Add New %s", Elegant_Calendar::DOMAIN ), [] ), $_names ),
                        'new_item_name' 	=> sprintf( wp_kses( __( "New %s", Elegant_Calendar::DOMAIN ), [] ), $_names )
                    ),
                    'public' => true,
                    'show_ui' => true,
                    'query_var' => true,
                    'show_in_quick_edit'         => false,
                    'meta_box_cb'                => false
                ))
            );
        }


        /**
		 * Called on init
		 *
		 * Register elegant event post types
		 *
		 * @since 1.0.0
		 */
		public function register_post_types() {
            $args = array(
                'label'             => 'Elegant',
                'description'        => 'Elegant post type',
                'public'             => true,
                'publicly_queryable' => true,
                'show_ui'            => false,
                'show_in_menu'       => false,
                'query_var'          => true,
                'capability_type'    => 'elegant_event',
                'has_archive'        => true,
                'hierarchical'       => false,
                'supports'           => array('title','author', 'editor','custom-fields','thumbnail','page-attributes','comments'),
            );

            register_post_type( 'elegant_event', $args );
        }


    }

    /**
	 * Kicking this off by calling 'get_instance()' method
	 */
	Elegant_Calendar_Post_Types::get_instance();

endif;
