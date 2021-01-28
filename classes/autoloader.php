<?php
/**
 * Autoloader.
 *
 * Autoloader handler class is responsible for loading the different
 * classes needed to run the plugin.
 *
 * @package SmartDocs\Classes
 * @since 1.0.0
 */

namespace SmartDocs;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Autoloader class.
 */
class Autoloader {
	/**
	 * Classes map.
	 *
	 * Maps SmartDocs classes to file names.
	 *
	 * @since 1.0.0
	 * @access private
	 * @static
	 *
	 * @var array $classes_map Classes used by plugin.
	 */
	private static $classes_map;

	/**
	 * Run autoloader.
	 *
	 * Register a function as `__autoload()` implementation.
	 *
	 * @since 1.0.0
	 * @static
	 */
	public static function run() {
		spl_autoload_register( array( __CLASS__, 'autoload' ) );
	}

	/**
	 * Get classes map with file names.
	 *
	 * @since 1.0.0
	 * @static
	 * @see self::init_classes_map()
	 * @return array
	 */
	public static function get_classes_map() {
		if ( ! self::$classes_map ) {
			self::init_classes_map();
		}

		return self::$classes_map;
	}

	/**
	 * Initializes classes map with file names.
	 *
	 * @since 1.0.0
	 * @static
	 */
	private static function init_classes_map() {

		self::$classes_map = array(
			'Autoloader'              => 'classes/autoloader.php',
			'Admin'                   => 'classes/admin-settings.php',
			'Cpt'                     => 'classes/cpt.php',
			'Breadcrumb'              => 'classes/breadcrumb.php',
			'Ajax'                    => 'classes/ajax.php',
			'Structured_Data'         => 'classes/structured-data.php',
			'Template'                => 'classes/template.php',
			'Widget'                  => 'classes/widget.php',
			'Widgets\Category_Widget' => 'classes/widgets/category.php',
			'Customizer'              => 'classes/customizer.php',
			'Customizer_Control'      => 'classes/customizer/custom-controls.php',
			'Dynamic_CSS'             => 'classes/dynamic-css.php',
			'Content'                 => 'classes/content.php',
		);
}


	/**
	 * Load class.
	 *
	 * For a given class name, require the class file.
	 *
	 * @since 1.0.0
	 * @access private
	 * @static
	 *
	 * @param string $relative_class_name Class name.
	 */
	private static function load_class( $relative_class_name ) {
		$classes_map = self::get_classes_map();

		if ( isset( $classes_map[ $relative_class_name ] ) ) {
			$filename = SMART_DOCS_PATH . '/' . $classes_map[ $relative_class_name ];
		} else {
			$filename = strtolower(
				preg_replace(
					array( '/([a-z])([A-Z])/', '/_/', '/\\\/' ),
					array( '$1-$2', '-', DIRECTORY_SEPARATOR ),
					$relative_class_name
				)
			);

			$filename = SMART_DOCS_PATH . $filename . '.php';
		}

		if ( is_readable( $filename ) ) {
			require $filename;
		}
	}

	/**
	 * Autoload.
	 *
	 * For a given class, check if it exist and load it.
	 *
	 * @since 1.0.0
	 * @access private
	 * @static
	 *
	 * @param string $class Class name.
	 */
	private static function autoload( $class ) {
		if ( 0 !== strpos( $class, __NAMESPACE__ . '\\' ) ) {
			return;
		}

		$namespace           = str_replace( '\\', '\\\\', __NAMESPACE__ );
		$relative_class_name = preg_replace( '/^' . $namespace . '\\\/', '', $class );

		$final_class_name = __NAMESPACE__ . '\\' . $relative_class_name;

		if ( ! class_exists( $final_class_name ) ) {
			self::load_class( $relative_class_name );
		}
	}
}
