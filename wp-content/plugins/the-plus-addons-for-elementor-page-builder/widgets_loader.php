<?php 
namespace TheplusAddons;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

final class Theplus_Element_Load {
	/**
		* Core singleton class
		* @var self - pattern realization
	*/
	private static $_instance;

	/**
	 * @var Manager
	 */
	private $_modules_manager;

	/**
	 * @deprecated
	 * @return string
	 */
	public function get_version() {
		return THEPLUS_VERSION;
	}
	
	/**
	* Cloning disabled
	*/
	public function __clone() {
	}
	
	/**
	* Serialization disabled
	*/
	public function __sleep() {
	}
	
	/**
	* De-serialization disabled
	*/
	public function __wakeup() {
	}
	
	/**
	* @return \Elementor\Theplus_Element_Loader
	*/
	public static function elementor() {
		return \Elementor\Plugin::$instance;
	}
	
	/**
	* @return Theplus_Element_Loader
	*/
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	/**
	 * we loaded module manager + admin php from here
	 * @return [type] [description]
	 */
	private function includes() {	
		if ( ! class_exists( 'CMB2' ) ){
			require_once THEPLUS_INCLUDES_URL.'plus-options/metabox/init.php';
		}
		require_once THEPLUS_INCLUDES_URL .'plus_addon.php';
		require THEPLUS_INCLUDES_URL.'theplus_options.php';
		
		require_once THEPLUS_PATH .'modules/helper-function.php';
		
		if ( file_exists(THEPLUS_INCLUDES_URL . 'plus-options/metabox/init.php' ) ) {
			require_once THEPLUS_INCLUDES_URL.'plus-options/includes.php';
		}
		
	}
	
	
	public function theplus_register_scripts() {
		
		$theplus_performance=get_option( 'theplus_performance' );		
		
		if(!empty($theplus_performance['compress_minify_js'])){
			$minify_js=$theplus_performance['compress_minify_js'];
		}else{
			$minify_js='disable';
		}
		wp_enqueue_script("jquery-effects-core");
		
		wp_enqueue_script( 'modernizr_js', THEPLUS_ASSETS_URL .'js/extra/modernizr.min.js');
		
		wp_enqueue_script( 'downCount-js', THEPLUS_ASSETS_URL .'js/extra/jquery.downCount.js',array(),'', true );		
		
		wp_enqueue_script( 'theplus_ele_frontend_scripts', THEPLUS_ASSETS_URL . 'js/extra/app.min.js',array(),'', false );
		echo '<script> var theplus_ajax_url = "'.admin_url('admin-ajax.php').'";</script>';
		wp_localize_script('theplus_frontend_scripts', 'ajax_var', array(
			'url' => admin_url('admin-ajax.php'),
			'nonce' => wp_create_nonce('ajax-nonce')
		));
		if($minify_js=='enable'){
			wp_enqueue_script( 'theplus-custom', THEPLUS_ASSETS_URL .'js/main/theplus-custom.min.js',array('jquery'),THEPLUS_VERSION, false);
		}else{
			wp_enqueue_script( 'theplus-custom', THEPLUS_ASSETS_URL .'js/main/theplus-custom.js',array('jquery'),THEPLUS_VERSION, false);
		}
	}
	
	/**
	* Widget Include required files
	*
	*/
	public function include_widgets()
	{	
		require_once THEPLUS_PATH.'modules/theplus-include-widgets.php';		
	}
	
	public function theplus_enqueue_style() {
		$theplus_performance=get_option( 'theplus_performance' );
		$get_name = wp_get_theme();
		
		if(!empty($theplus_performance['compress_minify_css'])){
			$minify_css=$theplus_performance['compress_minify_css'];
		}else{
			$minify_css='disable';
		}
		
		if($minify_css=='enable'){
			wp_enqueue_style( 'pt_theplus-style-min',THEPLUS_URL .'assets/css/main/theplus_style_min.css');
		}else{
			wp_enqueue_style( 'pt_theplus-style',THEPLUS_URL .'assets/css/main/theplus_style.css');
		}
		
		wp_enqueue_style( 'lity_css', THEPLUS_URL .'assets/css/extra/lity.css'); //Lity css Pop-up
		wp_enqueue_style( 'slick_min_css', THEPLUS_URL .'assets/css/extra/slick.min.css', false, '2.3.0' );//slider css
		
		wp_register_style( 'info-box-css', THEPLUS_URL . 'assets/css/main/theplus-info-box-style.css', [], THEPLUS_VERSION );
		wp_register_style( 'theplus-tabs-tours-ele', THEPLUS_URL . 'assets/css/main/theplus-tabs-tours.css', [], THEPLUS_VERSION );
		wp_register_style( 'theplus-pricing-table', THEPLUS_URL .'assets/css/main/theplus-pricing-table.css', [], THEPLUS_VERSION );
		
		wp_register_style( 'tp-columns-bootstrap', THEPLUS_URL .'assets/css/extra/tp-bootstrap-grid.css'); //bootstrap column grid  css	
		wp_register_style( 'plus-blog-style', THEPLUS_URL .'assets/css/main/theplus-blog-style.css'); //blogs style
		wp_register_style( 'plus-testimonial-style', THEPLUS_URL .'assets/css/main/theplus-testimonial-style.css'); //testimonial style
		wp_register_style( 'plus-client-style', THEPLUS_URL .'assets/css/main/theplus-client-style.css'); //client style
		wp_register_style( 'plus-gallery-style', THEPLUS_URL .'assets/css/main/theplus-gallery-style.css'); //gallery style
		wp_register_style( 'plus-team-member-style', THEPLUS_URL .'assets/css/main/theplus-team-member-style.css'); //Team Member style
		wp_register_style( 'plus-cf7-style', THEPLUS_URL .'assets/css/main/theplus-cf7-style.css'); //contact form 7 style
	}
	public function theplus_register_style(){
		wp_enqueue_style( 'info-box-css', THEPLUS_URL . 'assets/css/main/theplus-info-box-style.css', [], THEPLUS_VERSION );
		wp_enqueue_style( 'theplus-tabs-tours-ele', THEPLUS_URL . 'assets/css/main/theplus-tabs-tours.css', [], THEPLUS_VERSION );
		wp_enqueue_style( 'theplus-pricing-table', THEPLUS_URL . 'assets/css/main/theplus-pricing-table.css', [], THEPLUS_VERSION );
		wp_enqueue_style( 'tp-columns-bootstrap', THEPLUS_URL .'assets/css/extra/tp-bootstrap-grid.css', [], THEPLUS_VERSION );
		wp_enqueue_style( 'plus-blog-style', THEPLUS_URL .'assets/css/main/theplus-blog-style.css', [], THEPLUS_VERSION );
		wp_enqueue_style( 'plus-testimonial-style', THEPLUS_URL .'assets/css/main/theplus-testimonial-style.css', [], THEPLUS_VERSION );
		wp_enqueue_style( 'plus-client-style', THEPLUS_URL .'assets/css/main/theplus-client-style.css', [], THEPLUS_VERSION );
		wp_enqueue_style( 'plus-gallery-style', THEPLUS_URL .'assets/css/main/theplus-gallery-style.css', [], THEPLUS_VERSION );
		wp_enqueue_style( 'plus-team-member-style', THEPLUS_URL .'assets/css/main/theplus-team-member-style.css', [], THEPLUS_VERSION );
		wp_enqueue_style( 'plus-cf7-style',THEPLUS_URL .'assets/css/main/theplus-cf7-style.css', [], THEPLUS_VERSION );
	}
	public function theplus_editor_styles() {
		wp_enqueue_style( 'theplus-ele-admin', THEPLUS_ASSETS_URL .'css/admin/theplus-ele-admin.css', array(),THEPLUS_VERSION,false );
	}
	public function theplus_elementor_admin_css() {
		wp_enqueue_script( 'jquery-ui-dialog' );
		wp_enqueue_style( 'wp-jquery-ui-dialog' );
		wp_enqueue_style( 'theplus-ele-admin', THEPLUS_ASSETS_URL .'css/admin/theplus-ele-admin.css', array(),THEPLUS_VERSION,false );
		wp_enqueue_script( 'theplus-admin-js', THEPLUS_ASSETS_URL .'js/admin/theplus-admin.js', array(),THEPLUS_VERSION,false );		
	}
	function theplus_mime_types($mimes) {
		$mimes['svg'] = 'image/svg+xml';
		$mimes['svgz'] = 'image/svg+xml';
		return $mimes;
	}
	
	public function add_elementor_category() {
			
		$elementor = \Elementor\Plugin::$instance;
		
		//Add elementor category
		$elementor->elements_manager->add_category('plus-essential', 
			[
				'title' => esc_html__( 'PlusEssential', 'theplus' ),
				'icon' => 'fa fa-plug',
			],
			1
		);
		$elementor->elements_manager->add_category('plus-listing', 
			[
				'title' => esc_html__( 'PlusListing', 'theplus' ),
				'icon' => 'fa fa-plug',
			],
			1
		);
		$elementor->elements_manager->add_category('plus-creatives', 
			[
				'title' => esc_html__( 'PlusCreatives', 'theplus' ),
				'icon' => 'fa fa-plug',
			],
			1
		);
		$elementor->elements_manager->add_category('plus-tabbed', 
			[
				'title' => esc_html__( 'PlusTabbed', 'theplus' ),
				'icon' => 'fa fa-plug',
			],
			1
		);
		$elementor->elements_manager->add_category('plus-social', 
			[
				'title' => esc_html__( 'PlusSocial', 'theplus' ),
				'icon' => 'fa fa-plug',
			],
			1
		);
		$elementor->elements_manager->add_category('plus-adapted', 
			[
				'title' => esc_html__( 'PlusAdapted', 'theplus' ),
				'icon' => 'fa fa-plug',
			],
			1
		);
		
	}
	

	function theplus_settings_links ( $links ) {
		$setting_link = sprintf( '<a href="' . admin_url( 'admin.php?page=theplus_options' ) . '">'.esc_html__("Settings","theplus").'</a>' );
		$go_pro_link = sprintf( '<a href="https://elementor.theplusaddons.com/pricing/?ref=pluspro" target="_blank" style="color: #39b54a; font-weight: bold;">' . __( 'Go Pro','theplus' ) . '</a>' );
		
		array_push( $links, $setting_link, $go_pro_link );
		return $links;
	}
	
	private function hooks() {
	
		add_action( 'elementor/init', [ $this, 'add_elementor_category' ] );
		add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'theplus_editor_styles' ] );
		$this->include_widgets();
		theplus_widgets_include()->init();
		add_action( 'elementor/preview/enqueue_styles', [ $this, 'theplus_register_style' ] );
		
		add_action( 'elementor/frontend/before_register_scripts', [ $this, 'theplus_register_scripts' ] );
		
		add_action( 'elementor/frontend/after_register_styles', [ $this, 'theplus_enqueue_style' ] );
		
		add_filter('upload_mimes', array( $this,'theplus_mime_types'));
		// Include some backend files
		add_action( 'admin_enqueue_scripts', [ $this,'theplus_elementor_admin_css'] );
		add_filter( 'plugin_action_links_' . THEPLUS_PBNAME ,[ $this, 'theplus_settings_links'] );
	}
	
	/**
	 * ThePlus_Load constructor.
	 */
	private function __construct() {
		// Register class automatically
		$this->includes();
		// Finally hooked up all things
		$this->hooks();
	}
}

function theplus_addon_load()
{
	return Theplus_Element_Load::instance();
}
// Get theplus_addon_load Running
theplus_addon_load();	