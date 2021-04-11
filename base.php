<?php 

use \Elementor\Plugin as Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

final class Happyden_Extension {
	
	const VERSION = '1.0.0';
	const MINIMUM_ELEMENTOR_VERSION = '2.6.0';
	const MINIMUM_PHP_VERSION = '5.6';


	private static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	

	public function __construct() {

		add_action( 'init', [ $this, 'i18n' ] );
		add_action( 'plugins_loaded', [ $this, 'init' ] );

	}

	public function i18n() {
		load_plugin_textdomain( 'happyden' );
	}

	

	public function init() {
		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}
		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}

		//add_action( 'elementor/editor/after_enqueue_styles', array ( $this, 'pawelements_editor_styles' ) );
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
		add_action( 'elementor/elements/categories_registered',[$this,'register_new_category']);
		add_action( 'wp_enqueue_scripts', array( $this, 'happyden_register_frontend_styles' ), 10 );
		add_action( 'elementor/frontend/before_register_scripts', [ $this, 'happyden_register_frontend_scripts' ] );
		
	}

	/**
	 * Load Frontend Script
	 *
	*/
	public function happyden_register_frontend_scripts(){
		wp_enqueue_script(
			'happyden-bootstrap',
			HAPPYDEN_ASSETS_VENDOR .'bootstrap/bootstrap.bundel.js',
			['jquery'], HAPPYDEN_VERSION, true
		);
		
		wp_enqueue_script(
			'happyden-isotope',
			HAPPYDEN_ASSETS .'js/isotope.pkgd.min.js',
			['jquery'], HAPPYDEN_VERSION, true
		);
		
		wp_enqueue_script(
			'happyden-packery',
			HAPPYDEN_ASSETS .'js/packery-mode.pkgd.min.js',
			['jquery', 'happyden-isotope'], HAPPYDEN_VERSION, true
		);

		wp_enqueue_script(
			'happyden-imagesloaded',
			HAPPYDEN_ASSETS .'js/imagesloaded.pkgd.min.js',
			['jquery', 'happyden-isotope'], HAPPYDEN_VERSION, true
		);

		wp_enqueue_script(
			'magnific-popup',
			HAPPYDEN_ASSETS .'js/jquery.magnific-popup.min.js',
			['jquery', 'happyden-isotope'], HAPPYDEN_VERSION, true
		);

		wp_enqueue_script(
			'happyden-progress-bar',
			HAPPYDEN_ASSETS .'js/happyden-progress-bar-vendor.min.js',
			['jquery'], HAPPYDEN_VERSION, true
		);

		wp_enqueue_script(
			'happyden-waypoints',
			HAPPYDEN_ASSETS .'js/jquery.waypoints.min.js',
			['jquery'], HAPPYDEN_VERSION, true
		);

		wp_enqueue_script(
			'happyden-animated-text',
			HAPPYDEN_ASSETS .'js/typed.min.js',
			['jquery'], HAPPYDEN_VERSION, true
		);

		wp_enqueue_script(
			'happyden-widget',
			HAPPYDEN_ASSETS .'js/widget.js',
			['jquery'], time(), true
		);
		

	}

	
	/**
	 * Load Frontend Styles
	 *
	*/
	public function happyden_register_frontend_styles(){


		wp_enqueue_style(
			'happyden-fonts',
			 HAPPYDEN_ASSETS .'css/custom-fonts.css',
			 null, HAPPYDEN_VERSION
		);

		wp_enqueue_style(
			'elementor-animations',
			 HAPPYDEN_ASSETS .'css/animate.css',
			 null, HAPPYDEN_VERSION
		);

		wp_enqueue_style(
			'magnific-popup',
			 HAPPYDEN_ASSETS .'css/magnific-popup.css',
			 null, HAPPYDEN_VERSION
		);

		wp_enqueue_style(
			'happyden-widget',
			HAPPYDEN_ASSETS .'css/widget.css',
			['bootstrap'], HAPPYDEN_VERSION
		);
		wp_style_add_data( 'happyden-widget', 'rtl', 'replace' );

		wp_enqueue_style(
			'happyden-main',
			HAPPYDEN_ASSETS .'css/main.css',
			['bootstrap'], HAPPYDEN_VERSION
		);
		wp_style_add_data( 'happyden-main', 'rtl', 'replace' );

		wp_enqueue_style(
			'happyden-responsive',
			HAPPYDEN_ASSETS .'css/responsive.css',
			 ['bootstrap'], HAPPYDEN_VERSION
		);
		wp_style_add_data( 'happyden-main', 'rtl', 'replace' );
	}
	
	/**
	 * Widgets Catgory
	 *
	*/
	public function register_new_category($manager){
	   $manager->add_category('happyden',
			[
				'title' => __( 'Happyden Helper  Addons', 'happyden' ),
			]);
	}

	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'happyden' ),
			'<strong>' . esc_html__( 'Elementor Pawelements Extension', 'happyden' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'happyden' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'happyden' ),
			'<strong>' . esc_html__( 'Elementor happyden Extension', 'happyden' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'happyden' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'happyden' ),
			'<strong>' . esc_html__( 'Elementor Happyden Extension', 'happyden' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'happyden' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	public function init_widgets() {

		$widgets_manager = \Elementor\Plugin::instance()->widgets_manager;

		// Extensions Files
		require_once(HAPPYDEN_PATH . '/inc/extensions/container-extra.php');



		//Include Widget files
		require_once( HAPPYDEN_ADDONS_DIR . 'Button/widget.php' );
		require_once( HAPPYDEN_ADDONS_DIR . 'Service/widget.php' );
		require_once( HAPPYDEN_ADDONS_DIR . 'ContactForm7/widget.php' );
		require_once( HAPPYDEN_ADDONS_DIR . 'Testimonial/widget-normal.php' );
		require_once( HAPPYDEN_ADDONS_DIR . 'NavMenu/widget.php' );
		require_once( HAPPYDEN_ADDONS_DIR . 'Team/widget.php' );
		require_once( HAPPYDEN_ADDONS_DIR . 'portfolio/portfolio.php' );
		require_once( HAPPYDEN_ADDONS_DIR . 'Headding/widget.php' );
		require_once( HAPPYDEN_ADDONS_DIR . 'Headding/widget.php' );
		// require_once( HAPPYDEN_ADDONS_DIR . 'Breadcrumb/widget.php' );
		require_once( HAPPYDEN_ADDONS_DIR . 'FeatureImage/widget.php' );
		require_once( HAPPYDEN_ADDONS_DIR . 'Excerpt/widget.php' );
		require_once( HAPPYDEN_ADDONS_DIR . 'ClientInformaion/widget.php' );
		require_once( HAPPYDEN_ADDONS_DIR . 'PostNavigation/widget.php' );
		require_once( HAPPYDEN_ADDONS_DIR . 'SiteLogo/widget.php' );
		require_once( HAPPYDEN_ADDONS_DIR . 'Blog/widget.php' );
		require_once( HAPPYDEN_ADDONS_DIR . 'ImageBox/widget.php' );
		require_once( HAPPYDEN_ADDONS_DIR . 'Gallery/widget.php' );
		require_once( HAPPYDEN_ADDONS_DIR . 'Pricing/widget.php' );
		require_once( HAPPYDEN_ADDONS_DIR . 'Progresbar/widget.php' );
		require_once( HAPPYDEN_ADDONS_DIR . 'AnimatedText/widget.php' );
		require_once( HAPPYDEN_ADDONS_DIR . 'test-widget/widget.php' );
		require_once( HAPPYDEN_ADDONS_DIR . 'BreadcrumbHappy/widget.php' );
		require_once( HAPPYDEN_ADDONS_DIR . 'DualHeading/widget.php' );
	}
}

Happyden_Extension::instance();
