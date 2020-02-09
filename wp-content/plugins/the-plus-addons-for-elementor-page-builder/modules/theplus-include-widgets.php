<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}
if ( ! class_exists( 'Theplus_Widgets_Include' ) ) {

	/**
	 * Define Theplus_Widgets_Include class
	 */
	class Theplus_Widgets_Include {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		private static $instance = null;

		/**
		 * Check if processing elementor widget
		 *
		 * @var boolean
		 */
		 /**
		 * Localize data array
		 *
		 * @var array
		 */
		public $localize_data = array();

		/**
		 * Initalize integration hooks
		 *
		 * @return void
		 */
		public function init() {
			add_action( 'elementor/widgets/widgets_registered', array($this, 'add_widgets' ) );
		}
		
		/**
		 * Add new controls.
		 *
		 * @param  object $widgets_manager Controls manager instance.
		 * @return void
		 */
		public function add_widgets( $widgets_manager ) {

			$grouped = array(
				'theplus-widgets' => '\TheplusAddons\Widgets\Theplus_Elements_Widgets',
				'tp_smooth_scroll' => '\TheplusAddons\Widgets\ThePlus_Smooth_Scroll',
				'tp_accordion' => '\TheplusAddons\Widgets\ThePlus_Accordion',
				'tp_adv_text_block' => '\TheplusAddons\Widgets\ThePlus_Adv_Text_Block',
				'tp_blockquote' => '\TheplusAddons\Widgets\ThePlus_Block_Quote',
				'tp_blog_listout' => '\TheplusAddons\Widgets\ThePlus_Blog_ListOut',
				'tp_button' => '\TheplusAddons\Widgets\ThePlus_Button',
				'tp_clients_listout' => '\TheplusAddons\Widgets\ThePlus_Clients_ListOut',
				'tp_contact_form_7' => '\TheplusAddons\Widgets\ThePlus_Contact_Form_7',
				'tp_countdown' => '\TheplusAddons\Widgets\ThePlus_Countdown',
				'tp_flip_box' => '\TheplusAddons\Widgets\ThePlus_Flip_Box',
				'tp_gallery_listout' => '\TheplusAddons\Widgets\ThePlus_Gallery_ListOut',				
				'tp_heading_animation' => '\TheplusAddons\Widgets\ThePlus_Heading_Animation',
				'tp_heading_title' => '\TheplusAddons\Widgets\Theplus_Ele_Heading_Title',
				'tp_info_box' => '\TheplusAddons\Widgets\ThePlus_Info_Box',
				'tp_number_counter' => '\TheplusAddons\Widgets\ThePlus_Number_Counter',				
				'tp_pricing_table' => '\TheplusAddons\Widgets\ThePlus_Pricing_Table',
				'tp_social_icon' => '\TheplusAddons\Widgets\ThePlus_Social_Icon',
				'tp_tabs_tours' => '\TheplusAddons\Widgets\ThePlus_Tabs_Tours',
				'tp_team_member_listout' => '\TheplusAddons\Widgets\ThePlus_Team_Member_ListOut',
				'tp_testimonial_listout' => '\TheplusAddons\Widgets\ThePlus_Testimonial_ListOut',				
			);
			
			$get_option=theplus_get_option('general','check_elements');
			if(!empty($get_option)){
				array_push($get_option, "theplus-widgets");
				foreach ( $grouped as $widget_id => $class_name ) {
					if(in_array($widget_id,$get_option)){
						if ( $this->include_widget( $widget_id, true ) ) {
							$widgets_manager->register_widget_type( new $class_name() );
						}
					}
				}
			}else{
				foreach ( $grouped as $widget_id => $class_name ) {
					if ( $this->include_widget( $widget_id, true ) ) {
						$widgets_manager->register_widget_type( new $class_name() );
					}
				}
			}
		}
		
		/**
		 * Include control file by class name.
		 *
		 * @param  [type] $class_name [description]
		 * @return [type]             [description]
		 */
		public function include_widget( $widget_id, $grouped = false ) {

			$filename = sprintf('modules/widgets/'.$widget_id.'.php');

			if ( ! file_exists( THEPLUS_PATH.$filename ) ) {
				return false;
			}

			require THEPLUS_PATH.$filename;

			return true;
		}
		/**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 * @return object
		 */
		public static function get_instance( $shortcodes = array() ) {

			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self( $shortcodes );
			}
			return self::$instance;
		}
	}

}

/**
 * Returns instance of Theplus_Widgets_Include
 *
 * @return object
 */
function theplus_widgets_include() {
	return Theplus_Widgets_Include::get_instance();
}