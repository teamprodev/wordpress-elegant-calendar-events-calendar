<?php
/**
 * Elegant_Calendar_Event_Model Class
 *
 * @since  1.0.0
 * @package Elegant Calendar
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if ( ! class_exists( 'Elegant_Calendar_Event_Model' ) ) :

    class Elegant_Calendar_Event_Model {

        const META_KEY = 'elegant_event';

		/**
		 * Calendar ID
		 *
		 * @int
		 */
		public $id;

		/**
		 * Calendar name
		 *
		 * @string
		 */
        public $name;

        /**
		 * Form settings
		 * array
		 */
		public $settings = array();

		/**
		 * WP_Post
		 */
        public $raw;

        /**
		 * This post type
		 *
		 * @string
		 */
		protected $post_type = 'elegant_event';

		const STATUS_PUBLISH = 'publish';
		const STATUS_DRAFT   = 'draft';

        /**
         * Elegant_Calendar_Event_Model constructor.
         *
         * @since 1.0
         */
        public function __construct() {

        }

		/**
		 * Return model
		 *
		 * @since 1.0.0
		 *
		 * @param string $class_name
		 *
		 * @return self
		 */
		public static function model( $class_name = __CLASS__ ) {
			$class = new $class_name();

			return $class;
		}

        /**
		 * Save form
		 *
		 * @since 1.0.0
		 *
		 * @param bool $clone
		 *
		 * @return mixed
		 */
		public function save() {
			//prepare the data
			$maps      = array_merge( $this->get_default_maps(), $this->get_maps() );
			$post_data = array();
			$meta_data = array();
			if ( ! empty( $maps ) ) {
				foreach ( $maps as $map ) {
					$attribute = $map['property'];
					if ( 'post' === $map['type'] ) {
						if ( isset( $this->$attribute ) ) {
							$post_data[ $map['field'] ] = $this->$attribute;
						} elseif ( isset( $map['default'] ) ) {
							$post_data[ $map['field'] ] = $map['default'];
						}
					}else {
						$meta_data[ $map['field'] ] = $this->$attribute;
					}
				}
			}

			// Prepare event data
			$post_data['post_type'] = $this->post_type;
			$post_data['post_name'] = $meta_data['settings']['elegant_event_name'];
			$post_data['post_title'] = $meta_data['settings']['elegant_event_name'];
			$post_data['post_content'] = $meta_data['settings']['elegant_event_content'];

			// Insert or update event data
			if ( is_null( $this->id ) ) {
				$id = wp_insert_post( $post_data );
			} else {
				$id = wp_update_post( $post_data );
			}

			update_post_meta( $id, self::META_KEY, $meta_data );

			return $id;
        }

        /**
		 * In here we will define how we store the properties
		 *
		 * @since 1.0.0
		 * @return array
		 */
		public function get_default_maps() {
			return array(
				array(
					'type'     => 'post',
					'property' => 'id',
					'field'    => 'ID',
				),
				array(
					'type'     => 'post',
					'property' => 'name',
					'field'    => 'post_title',
				),
				array(
					'type'     => 'post',
					'property' => 'status',
					'field'    => 'post_status',
					'default'  => self::STATUS_PUBLISH,
				),
				array(
					'type'     => 'meta',
					'property' => 'settings',
					'field'    => 'settings',
				),
			);
		}

		/**
		 * This should be get override by children
		 *
		 * @since 1.0.0
		 * @return array
		 */
		public function get_maps() {
			return array();
		}

        /**
		 * Load model
		 *
		 * @since 1.0.0
		 *
		 * @param $id
		 *
		 * @return bool|$this
		 */
		public function load( $id, $callback = false ) {
			$post = get_post( $id );

			if ( ! is_object( $post ) ) {
				// If we haven't saved yet, fallback to latest ID and replace the data
				if ( $callback ) {
					$id   = $this->get_latest_id();
					$post = get_post( $id );

					if ( ! is_object( $post ) ) {
						return false;
					}
				} else {
					return false;
				}
			}

			return $this->_load( $post );
        }

        	/**
		 * Count all form types
		 *
		 * @since 1.0.0
		 * @since 1.6 add optional param `status`
		 *
		 * @param string $status
		 *
		 * @return int
		 */
		public function count_all( $status = '' ) {
			$count_posts = wp_count_posts( $this->post_type );
			$count_posts = (array) $count_posts;
			if ( ! empty( $status ) ) {
				if ( isset( $count_posts[ $status ] ) ) {
					return $count_posts[ $status ];
				} else {
					return 0;
				}
			}

			return array_sum( $count_posts );
		}

		/**
		 * Get all paginated
		 *
		 * @since 1.2
		 * @since 1.5.4 add optional param per_page
		 * @since 1.5.4 add optional param $status
		 *
		 * @param int      $current_page
		 * @param null|int $per_page
		 * @param string   $status
		 *
		 * @return array
		 */
		public function get_all_paged( $current_page = 1, $per_page = null, $status = '' ) {
			if ( is_null( $per_page ) ) {
				$per_page = elegant_calendar_view_per_page();
			}
			$args = array(
				'post_type'      => $this->post_type,
				'post_status'    => 'any',
				'posts_per_page' => $per_page,
				'paged'          => $current_page,
			);

			if ( ! empty( $status ) ) {
				$args['post_status'] = $status;
			}

			$query  = new WP_Query( $args );
			$models = array();

			foreach ( $query->posts as $post ) {
				$models[] = $this->_load( $post );
			}

			return array(
				'totalPages'   => $query->max_num_pages,
				'totalRecords' => $query->post_count,
				'models'       => $models,
			);
        }

        /**
        * Get all
        *
        * @since 1.0.0
        * @since 1.6 add `status` in param
        * @since 1.6 add `limit` in param
        *
        * @param string $status post_status arg
        * @param int    $limit
        *
        * @return array()
        */
        public function get_all_models( $status = '', $limit = - 1 ) {
            $args = array(
            'post_type'      => $this->post_type,
            'post_status'    => 'any',
            'posts_per_page' => $limit,
            );

            if ( ! empty( $status ) ) {
                $args['post_status'] = $status;
            }
            $query  = new WP_Query( $args );
            $models = array();

            foreach ( $query->posts as $post ) {
                $models[] = $this->_load( $post );
            }

            return array(
                'totalPages'   => $query->max_num_pages,
                'totalRecords' => $query->post_count,
                'models'       => $models,
            );
        }

        /**
		 * Get Models
		 *
		 * @since 1.0.0
		 * @since 1.6 add `status` as optional param
		 *
		 * @param int    $total - the total. Defaults to 4
		 * @param string $status
		 *
		 * @return array $models
		 */
		public function get_models( $total = 4, $status = '' ) {
			$args = array(
				'post_type'      => $this->post_type,
				'post_status'    => 'any',
				'posts_per_page' => $total,
				'order'          => 'DESC',
			);
			if ( ! empty( $status ) ) {
				$args['post_status'] = $status;
			}
			$query  = new WP_Query( $args );
			$models = array();

			foreach ( $query->posts as $post ) {
				$models[] = $this->_load( $post );
			}

			return $models;
        }

        /**
         * Get event model
         *
         * @since 1.0.0
         * @since 1.6 add `status` in param
         * @since 1.6 add `limit` in param
         *
         * @param string $status post_status arg
         * @param int    $limit
         *
         * @return array()
         */
        public function get_event_model( $id, $status = 'publish') {
            $args = array(
                'post_type'      => $this->post_type,
                'post_status'    => $status,
                'p'              => $id

            );

            $query  = new WP_Query( $args );

            $model = $this->_load( $query->posts[0] );

            return $model;
        }

        /**
		 * @since 1.0.0
		 *
		 * @param $post
		 *
		 * @return mixed
		 */
		private function _load( $post ) {
			if ( $this->post_type === $post->post_type ) {
				$class         = get_class( $this );
				$object        = new $class();
				$meta          = get_post_meta( $post->ID, self::META_KEY, true );
				$maps          = array_merge( $this->get_default_maps(), $this->get_maps() );
				$fields        = ! empty( $meta['fields'] ) ? $meta['fields'] : array();
				$form_settings = array(
					'version'                    => '1.0.0',
					'cform-section-border-color' => '#E9E9E9',
				);

				// Update version from form settings
				if ( isset( $meta['settings']['version'] ) ) {
					$form_settings['version'] = $meta['settings']['version'];
				}

				// Update section border color
				if ( isset( $meta['settings']['cform-section-border-color'] ) ) {
					$form_settings['cform-section-border-color'] = $meta['settings']['cform-section-border-color'];
				}

				if ( ! empty( $maps ) ) {
					foreach ( $maps as $map ) {
						$attribute = $map['property'];
						if ( 'post' === $map['type'] ) {
							$att                = $map['field'];
							$object->$attribute = $post->$att;
						} else {
							if ( ! empty( $meta['fields'] ) && 'fields' === $map['field'] ) {
								foreach ( $meta['fields'] as $field_data ) {
									$field          = new Elegant_Calendar_Field_Model( $form_settings );
									$field->form_id = $post->ID;
									$field->slug    = $field_data['id'];
									unset( $field_data['id'] );
									$field->import( $field_data );
									$object->add_field( $field );
								}
							} else {
								if ( isset( $meta[ $map['field'] ] ) ) {
									$object->$attribute = $meta[ $map['field'] ];
								}
							}
						}
					}
				}

				$object->raw = $post;

				return $object;
			}

			return false;
        }

        /**
		 * Get Post Type of cpt
		 *
		 * @since 1.0.5
		 *
		 * @return mixed
		 */
		public function get_post_type() {
			return $this->post_type;
		}

        /**
         * Get Post Meta Data Settings
         *
         * @since 1.0.5
         *
         * @return mixed
         */
        public function get_settings() {

            $meta = get_post_meta( $this->id, self::META_KEY, true );

            return $meta['settings'];
		}

    }

endif;