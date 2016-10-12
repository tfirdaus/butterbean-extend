<?php
/**
 * Serialized data and store it in a single row
 *
 * @package    ButterBean
 * @author     Justin Tadlock <justin@justintadlock.com>
 * @author     Thoriq Firdaus <tfirdaus@outlook.com>
 * @copyright  Copyright (c) 2015-2016, Justin Tadlock
 * @link       https://github.com/justintadlock/butterbean
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */


if ( ! class_exists( 'ButterBean_Setting_Serialize' ) ) {

	/**
	 * Serialize setting class.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	class ButterBean_Setting_Serialize extends ButterBean_Setting {

		/**
		 * The type of setting.
		 *
		 * @since  1.0.0
		 * @access public
		 * @var    string
		 */
		public $type = 'serialize';

		/**
		 * Saves the value of the setting.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function save() {

			if ( ! $this->check_capabilities() ) {
				return;
			}

			$values = $this->get_serialized_value();
			$values[ $this->name ] = $this->get_posted_value();

			if ( is_array( $values ) && ! empty( $values ) ) {
				return update_post_meta( $this->manager->post_id, $this->manager->name, $values );
			} else if ( empty( $values ) ) {
				return delete_post_meta( $this->manager->post_id, $this->manager->name );
			}
		}

		/**
		 * Gets the value of the setting.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return mixed
		 */
		public function get_value() {

			$value = $this->get_serialized_value();

			if ( isset( $value[ $this->name ] ) ) {
				return $value[ $this->name ];
			}

			if ( ! isset( $value[ $this->name ] ) && ! butterbean()->is_new_post ) {
				return $this->default;
			}

			if ( butterbean()->is_new_post ) {
				return $this->default;
			}
		}

		/**
		 * Gets the serialized value of the setting.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return mixed
		 */
		public function get_serialized_value() {

			$value = get_post_meta( $this->manager->post_id, $this->manager->name, true );

			return ! $value || butterbean()->is_new_post ? null : $value;
		}
	}

}