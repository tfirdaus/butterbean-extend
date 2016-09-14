<?php
/**
 * Plugin Name: ButterBean Extend
 * Plugin URI:  https://github.com/tfirdaus/butterbean-extend
 * Description: Extending ButterBean.
 * Version:     0.0.1
 * Author:      Thoriq Firdaus
 * Author URI:  http://www.hongkiat.com/blog/
 *
 * @package    ButterBean
 * @author     Justin Tadlock <justin@justintadlock.com>
 * @copyright  Copyright (c) 2015-2016, Justin Tadlock
 * @link       https://github.com/justintadlock/butterbean
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

if ( ! class_exists( 'ButterBean_Extend' ) ) {

	/**
	 * Main ButterBean Extend class.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	final class ButterBean_Extend {

		/**
		 * Directory path to the plugin folder.
		 *
		 * @since  1.0.0
		 * @access public
		 * @var    string
		 */
		public $dir_path = '';

		/**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return object
		 */
		public static function get_instance() {

			static $instance = null;

			if ( is_null( $instance ) ) {
				$instance = new self;
				$instance->setup();
				$instance->setup_actions();
			}

			return $instance;
		}

		/**
		 * Constructor method.
		 *
		 * @since  1.0.0
		 * @access private
		 * @return void
		 */
		private function __construct() {}

		/**
		 * Initial plugin setup.
		 *
		 * @since  1.0.0
		 * @access private
		 * @return void
		 */
		private function setup() {

			$this->dir_path = apply_filters( 'butterbean_dir_path', trailingslashit( plugin_dir_path( __FILE__ ) ) );
		}

		/**
		 * Initial plugin setup.
		 *
		 * @since  1.0.0
		 * @access private
		 * @return void
		 */
		public function includes() {

			require_once( $this->dir_path . 'inc/settings/class-setting-serialize.php');
		}

		/**
		 * Sets up initial actions.
		 *
		 * @since  1.0.0
		 * @access private
		 * @return void
		 */
		private function setup_actions() {

			// Register new setting types.
			add_action( 'butterbean_register', array( $this, 'register_setting_types' ), -95, 2 );
		}

		/**
		 * Registers our control types so that devs don't have to directly instantiate
		 * the class each time they register a control.  Instead, they can use the
		 * `type` argument.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function register_setting_types( $butterbean, $post_types ) {

			$this->includes(); // Include required files.

			$butterbean->register_setting_type( 'serialize', 'ButterBean_Setting_Serialize' );
		}
	}

	// Let's do this thang!
	ButterBean_Extend::get_instance();
}