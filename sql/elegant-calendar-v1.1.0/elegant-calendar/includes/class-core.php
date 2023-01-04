<?php
/**
 * Elegant_Calendar_Core Class
 *
 * Plugin Core Class
 *
 * @since  1.0.0
 * @package Elegant Calendar
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if ( ! class_exists( 'Elegant_Calendar_Core' ) ) :

    class Elegant_Calendar_Core {

        /**
         * Calendar view style
         * @var string
         */
        public $view = 'list';

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
         * @return Elegant_Calendar_Core
         */
        public static function get_instance() {
            if ( is_null( self::$instance ) ) {
                self::$instance = new self();
            }

            return self::$instance;
        }

        /**
         * Elegant_Calendar_Core constructor.
         *
         * @since 1.0
         */
        public function __construct() {
            // Include all necessary files
            $this->includes();

            if ( is_admin() ) {
                // Initialize admin core
                $this->admin = new Elegant_Calendar_Admin();

			    // Enabled modules
                $modules = new Elegant_Calendar_Modules();

                // Add submenus
                add_action( 'admin_menu', array( $this, 'add_sub_menus' ) );

                // Add sub pages
                $this->admin->add_settings_page();
            }

            add_filter('script_loader_tag', array( $this, 'add_type_attribute' ) , 10, 3);

            // Enqueue scripts
            add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

            // Add shortcode
            add_shortcode ('elegant_calendar', array( $this, 'display_calendar_calendar' ), 10, 2);

        }

        /**
        * Add sub menus
        *
        * @since 1.0.0
        *
        * @param $hook
        */
        public function add_sub_menus() {
            $sub_menu_pages = array(
                array(
                    'parent_slug' => 'elegant-calendar',
                    'page_title' => esc_html__( 'Add Event', Elegant_Calendar::DOMAIN ),
                    'menu_title' => esc_html__( 'Add Event', Elegant_Calendar::DOMAIN ),
                    'capability' => 'manage_options',
                    'menu_slug' => 'admin.php?page=elegant-calendar-event-wizard',
                ),

                array(
                    'parent_slug' => 'elegant-calendar',
                    'page_title' => esc_html__( 'Event Locations', Elegant_Calendar::DOMAIN ),
                    'menu_title' => esc_html__( 'Event Locations', Elegant_Calendar::DOMAIN ),
                    'capability' => 'manage_options',
                    'menu_slug' => 'edit-tags.php?taxonomy=elegant_event_location&post_type=elegant_event',
                ),

                array(
                    'parent_slug' => 'elegant-calendar',
                    'page_title' => esc_html__( 'Event Organizers', Elegant_Calendar::DOMAIN ),
                    'menu_title' => esc_html__( 'Event Organizers', Elegant_Calendar::DOMAIN ),
                    'capability' => 'manage_options',
                    'menu_slug' => 'edit-tags.php?taxonomy=elegant_event_organizer&post_type=elegant_event',
                ),

                array(
                    'parent_slug' => 'elegant-calendar',
                    'page_title' => esc_html__( 'Event Type', Elegant_Calendar::DOMAIN ),
                    'menu_title' => esc_html__( 'Event Type', Elegant_Calendar::DOMAIN ),
                    'capability' => 'manage_options',
                    'menu_slug' => 'edit-tags.php?taxonomy=elegant_event_type&post_type=elegant_event',
                )
            );

            // Add each sub menu item to custom admin menu.
            foreach ( $sub_menu_pages as $sub_menu ) {
                add_submenu_page(
                    $sub_menu['parent_slug'],
                    $sub_menu['page_title'],
                    $sub_menu['menu_title'],
                    $sub_menu['capability'],
                    $sub_menu['menu_slug']
                );
            }
        }

        /**
        * Add enqueue scripts variables
        *
        * @since 1.0.0
        *
        * @param $hook
        */
        public function enqueue_scripts_variables(){
            $calendar_id = '#'.$this->view.'-calendar';
            ?>
            <script type="text/javascript" class="code-js">

                // register templates
                var templates = {
                    popupIsAllDay: function() {
                        return 'All Day';
                    },
                    popupStateFree: function() {
                        return 'Free';
                    },
                    popupStateBusy: function() {
                        return 'Busy';
                    },
                    titlePlaceholder: function() {
                        return 'Subject';
                    },
                    locationPlaceholder: function() {
                        return 'Location';
                    },
                    startDatePlaceholder: function() {
                            return 'Start date';
                    },
                     endDatePlaceholder: function() {
                            return 'End date';
                    },
                    popupDetailDate: function(isAllDay, start, end) {
                        var isSameDate = moment(start).isSame(end);
                        var endFormat = (isSameDate ? '' : 'YYYY.MM.DD ') + 'hh:mm a';

                        if (isAllDay) {
                            return moment(start).format('YYYY.MM.DD') + (isSameDate ? '' : ' - ' + moment(end).format('YYYY.MM.DD'));
                        }

                        return (moment(start).format('YYYY.MM.DD hh:mm a') + ' - ' + moment(end).format(endFormat));
                    },
                    popupDetailLocation: function(schedule) {
                        return 'Location : ' + schedule.location;
                    },
                    popupDetailState: function(schedule) {
                        return 'State : ' + schedule.state || 'Busy';
                    },
                    popupDetailBody: function(schedule) {
                        return 'Body : ' + schedule.body;
                    }
                    };
                var cal = new tui.Calendar('<?php echo $calendar_id; ?>', {
                    template: templates,
                    useDetailPopup: true,
                    defaultView: <?php echo "'".$this->view."'"; ?>, // view option
                    defaultDesign: <?php echo "'".$this->design."'"; ?> // design option
                });
            </script>
            <?php
        }

        /**
        * Add enqueue scripts hooks
        *
        * @since 1.0.0
        *
        * @param $hook
        */
        public function enqueue_scripts( $hook ) {

            // Enqueue front styles
            elegant_calendar_front_enqueue_styles( ELEGANT_CALENDAR_VERSION );

            // Enqueue front scripts
            elegant_calendar_front_enqueue_scripts( ELEGANT_CALENDAR_VERSION );

        }

        function add_type_attribute($tag, $handle, $src) {
            // if not your script, do nothing and return original $tag
            if ( 'ionicons-module' === $handle ) {
                // change the script tag by adding type="module" and return it.
                $tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
            } else if ('ionicons-no-module' === $handle) {
                // change the script tag by adding nomodule="" and return it.
                $tag = '<script nomodule="" src="' . esc_url( $src ) . '"></script>';
            } else{
                return $tag;
            }

            return $tag;
        }

        /**
        * Display Shortcode
        *
        * @since 1.0.0
        *
        * @param $atts
        */
        public function display_calendar_calendar($atts) {

            $defaults = array(
                'id'     => '',
                'view'   => 'list',
                'design' => 'classic',
                'filter' => 'no'
            );

            $atts = shortcode_atts( $defaults, $atts, 'elegant_calendar' );

            extract($atts);

            // Add scripts variables
            $this->view = $view;
            $this->design = $design;
            add_action( 'wp_footer', array( $this, 'enqueue_scripts_variables' ) );

            // Prepare elegant calendar event data
            elegant_calendar_front_event_data();

            // Show monthly view
            ob_start();
            include ELEGANT_CALENDAR_DIR . 'admin/views/calendar/'.$view.'.php';
            $calendar_content = ob_get_contents();
            ob_end_clean();
            return $calendar_content;
        }

        /**
         * Includes
         *
         * @since 1.0.0
         */
        private function includes() {

            if ( is_admin() ) {
                require_once ELEGANT_CALENDAR_DIR . 'admin/abstracts/class-admin-page.php';
                require_once ELEGANT_CALENDAR_DIR . 'admin/abstracts/class-admin-module.php';
                require_once ELEGANT_CALENDAR_DIR . 'admin/classes/class-admin.php';

            }

            // Register post types
            require_once ELEGANT_CALENDAR_DIR . 'includes/class-post-types.php';

            // Custome post types template loader
            require_once ELEGANT_CALENDAR_DIR . 'includes/class-template-loader.php';

            // Helpers
            require_once ELEGANT_CALENDAR_DIR . 'includes/helpers/helper-core.php';

            // Cron Jobs
            require_once ELEGANT_CALENDAR_DIR . 'includes/jobs/class-cron-job.php';

            // Modules
            require_once ELEGANT_CALENDAR_DIR . 'includes/class-modules.php';

            // Model
            require_once ELEGANT_CALENDAR_DIR . 'includes/model/class-calendar-event-model.php';
        }

    }

endif;
