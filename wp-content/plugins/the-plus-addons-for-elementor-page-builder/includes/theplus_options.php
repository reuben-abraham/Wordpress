<?php
	
use Elementor\Plugin;
if (!defined('ABSPATH')) {
    exit;
}

class Theplus_Elementor_Plugin_Options
{
    
    /**
     * Option key, and option page slug
     * @var string
     */
    private $key = 'theplus_options';
    
    /**
     * Array of metaboxes/fields
     * @var array
     */
    protected $option_metabox = array();
    
    /**
     * Options Page title
     * @var string
     */
    protected $title = '';
    
    /**
     * Options Page hook
     * @var string
     */
    protected $options_page = '';
    protected $options_pages = array();
    /**
     * Constructor
     * @since 0.1.0
     */
    public function __construct()
    {
        // Set our title
		add_action( 'admin_enqueue_scripts', array( $this,'theplus_options_scripts') );
        $this->title = __('ThePlus Settings', 'theplus');
        require_once THEPLUS_INCLUDES_URL.'plus-options/cmb2-conditionals.php';
        // Set our CMB fields
        $this->fields = array(
        );
    }
    
    /**
     * Initiate our hooks
     * @since 1.0.0
     */
	public function theplus_options_scripts() {
		wp_enqueue_script( 'cmb2-conditionals', THEPLUS_URL .'includes/plus-options/cmb2-conditionals.js', array() );
		wp_enqueue_script('thickbox', null, array('jquery'));
		wp_enqueue_style('thickbox.css', '/'.WPINC.'/js/thickbox/thickbox.css', null, '1.0');
	}

    public function hooks()
    {
        add_action('admin_init', array(
            $this,
            'init'
        ));
        add_action('admin_menu', array(
            $this,
            'add_options_page'
        ));
    }
    
    /**
     * Register our setting to WP
     * @since  1.0.0
     */
    public function init()
    {
        //register_setting( $this->key, $this->key );
        $option_tabs = self::option_fields();
        foreach ($option_tabs as $index => $option_tab) {
            register_setting($option_tab['id'], $option_tab['id']);
        }
    }
    
    /**
     * Add menu options page
     * @since 1.0.0
     */
    public function add_options_page()
    {
		
        $option_tabs = self::option_fields();
        foreach ($option_tabs as $index => $option_tab) {
            if ($index == 0) {
                $this->options_pages[] = add_menu_page($this->title, $this->title, 'manage_options', $option_tab['id'], array(
                    $this,
                    'admin_page_display'
                )); //Link admin menu to first tab
                add_submenu_page($option_tabs[0]['id'], $this->title, $option_tab['title'], 'manage_options', $option_tab['id'], array(
                    $this,
                    'admin_page_display'
                )); //Duplicate menu link for first submenu page
            } else {
                $this->options_pages[] = add_submenu_page($option_tabs[0]['id'], $this->title, $option_tab['title'], 'manage_options', $option_tab['id'], array(
                    $this,
                    'admin_page_display'
                ));
            }
        }
    }
    
    /**
     * 
     * @since  1.0.0
     */
    public function admin_page_display()
    {
		
        $option_tabs = self::option_fields();	
        $tab_forms   = array();
?>

		<div class="<?php  echo $this->key; ?>">
		<div id="ptplus-banner-wrap">
			<div id="ptplus-banner" class="ptplus-banner-sticky">
				<h2><?php echo esc_html__('ThePlus Settings','theplus'); ?><!--<span><img src="<?php echo THEPLUS_URL .'vc_elements/images/thepluslogo.png'; ?>"></span>--></h2>
				<div class="theplus-current-version wp-badge"> <?php echo esc_html__('Version','theplus'); ?> <?php echo THEPLUS_VERSION; ?></div>
			</div>
		</div>
		<h2 class="nav-tab-wrapper">
            	<?php
	        foreach ($option_tabs as $option_tab):
	            $tab_slug  = $option_tab['id'];
	            $nav_class = 'nav-tab';
				if($tab_slug=='theplus_purchase_code'){
					$nav_class .= ' plus-goto-pro';
				}
	            if ($tab_slug == $_GET['page']) {
	                $nav_class .= ' nav-tab-active'; 
	                $tab_forms[] = $option_tab; 
	            } ?>            	
            	<a class="<?php echo $nav_class; ?>" href="<?php  menu_page_url($tab_slug); ?>"><?php echo esc_html($option_tab['title']); ?></a>
           	<?php endforeach; ?>
        </h2>
		<?php foreach ($tab_forms as $tab_form): ?>
		
				
				<?php if($tab_form['id']=='theplus_purchase_code'){ ?>
						<div class="theplus_about-tab changelog" style="padding-bottom: 0;">
							
							<div class="feature-section">
								<h1 style="padding-left:15px;padding-left: 50px;font-size: 25px;font-weight: 700;letter-spacing: 0.3px;"><?php echo esc_html__('Pro Version :','theplus');?></h1>
								<div class="theplus-premium-text-list-wrapper">
									<table class="theplus-premium-text-list">
										<tbody>										
										<td>
											<ul class="cmb_checkbox_list cmb_list">
												<li><div class="info-box-list-pro"><span class="dashicons dashicons-dashboard"></span><span class="pro-list-box"><?php echo esc_html__('Get all Widgets with full features','theplus'); ?></span></div></li>
												<li><div class="info-box-list-pro"><span class="dashicons dashicons-schedule"></span><span class="pro-list-box"><?php echo esc_html__('Access of all 50+ Widgets','theplus'); ?></span></div></li>
												<li><div class="info-box-list-pro"><span class="dashicons dashicons-analytics"></span><span class="pro-list-box"><?php echo esc_html__('Get 10+ Ready Made Website Demos','theplus'); ?></span></div></li>
												<li><div class="info-box-list-pro"><span class="dashicons dashicons-editor-table"></span><span class="pro-list-box"><?php echo esc_html__('200+ UI Blocks','theplus'); ?></span></div></li>
												<li><div class="info-box-list-pro"><span class="dashicons dashicons-sos"></span><span class="pro-list-box"><?php echo esc_html__('Premium Support Forum Access','theplus'); ?></span></div></li>
												<li><div class="info-box-list-pro"><span class="dashicons dashicons-megaphone"></span><span class="pro-list-box"><?php echo esc_html__('Guaranteed Future Updates','theplus'); ?></span></div></li>												
											</ul>
										</td>
										</tr>
										</tbody>
									</table>
								</div>
								<h2 class="plus-pro-version-today" style="text-align: center;padding-top:30px;padding-bottom:30px;display:block"><a href="https://elementor.theplusaddons.com/pricing/" target="_blank" style="margin-bottom: 20px;display: inline-block;"><?php echo esc_html__('Buy Pro Version Today','theplus');?></a></h2>
							</div>
						
					</div>
				<?PHP } ?>
				
				<?php if($tab_form['id']!='theplus_about_us' && $tab_form['id']!='theplus_purchase_code'){ ?>
					<div id="<?php echo esc_attr($tab_form['id']); ?>" class="group theplus_form_content">
						<?php cmb2_metabox_form($tab_form, $tab_form['id']); ?>
					</div>
				<?php } ?>
				
				<?php if($tab_form['id']=='theplus_options'){ ?>
				<div class="theplus-premium-widgets-list-wrapper">
					<table class="theplus-premium-widgets-list">
						<tbody>
						<th><label for="check_elements"><?php echo esc_html__('In Pro Version :','theplus'); ?></label></th>
						<td>
							<p class="plus-pro-widget-description"><?php echo esc_html__('All Above Widgets with their full features. Also Below 10+ Widgets.','theplus'); ?></p>
							<ul class="cmb_checkbox_list cmb_list">
								<li><a href="<?php echo 'admin.php?page=theplus_purchase_code'; ?>"><label><?php echo esc_html__('Before After','theplus'); ?></label></a></li>
								<li><a href="<?php echo 'admin.php?page=theplus_purchase_code'; ?>"><label><?php echo esc_html__('Carousel Anything','theplus'); ?></label></a></li>
								<li><a href="<?php echo 'admin.php?page=theplus_purchase_code'; ?>"><label><?php echo esc_html__('Carousel Remote','theplus'); ?></label></a></li>			
								<li><a href="<?php echo 'admin.php?page=theplus_purchase_code'; ?>"><label><?php echo esc_html__('Cascading Image','theplus'); ?></label></a></li>
								<li><a href="<?php echo 'admin.php?page=theplus_purchase_code'; ?>"><label><?php echo esc_html__('Google Map','theplus'); ?></label></a></li>
								<li><a href="<?php echo 'admin.php?page=theplus_purchase_code'; ?>"><label><?php echo esc_html__('Dynamic Device','theplus'); ?></label></a></li>
								<li><a href="<?php echo 'admin.php?page=theplus_purchase_code'; ?>"><label><?php echo esc_html__('Hotspot','theplus'); ?></label></a></li>
								<li><a href="<?php echo 'admin.php?page=theplus_purchase_code'; ?>"><label><?php echo esc_html__('Creative Images','theplus'); ?></label></a></li>
								<li><a href="<?php echo 'admin.php?page=theplus_purchase_code'; ?>"><label><?php echo esc_html__('MailChimp','theplus'); ?></label></a></li>
								<li><a href="<?php echo 'admin.php?page=theplus_purchase_code'; ?>"><label><?php echo esc_html__('Post Search','theplus'); ?></label></a></li>
								<li><a href="<?php echo 'admin.php?page=theplus_purchase_code'; ?>"><label><?php echo esc_html__('Product Listing','theplus'); ?></label></a></li>
								<li><a href="<?php echo 'admin.php?page=theplus_purchase_code'; ?>"><label><?php echo esc_html__('Row Background','theplus'); ?></label></a></li>
								<li><a href="<?php echo 'admin.php?page=theplus_purchase_code'; ?>"><label><?php echo esc_html__('Stylist List','theplus'); ?></label></a></li>
								<li><a href="<?php echo 'admin.php?page=theplus_purchase_code'; ?>"><label><?php echo esc_html__('Switcher','theplus'); ?></label></a></li>
								<li><a href="<?php echo 'admin.php?page=theplus_purchase_code'; ?>"><label><?php echo esc_html__('Video Player','theplus'); ?></label></a></li>
							</ul>
						</td>
						</tr>
						</tbody>
					</table>
				</div>
				<?php } ?>
				
				<?php if($tab_form['id']=='theplus_about_us'){ ?>
				<div class="theplus_about-tab changelog">
					<div class="feature-section">
						<h2 class="plus-pro-version-today" style="padding-left:15px;padding-bottom:15px;"><a href="https://elementor.theplusaddons.com/pricing/" target="_blank"><?php echo esc_html__('Buy Pro Version','theplus');?></a></h2>
						<h4 style="padding-left:15px;"><?php echo esc_html__('Welcome to The Plus addons for Elementor. We have tried to get up as much as options possible with great customisation options for you. From this section, We have attached some links which will helpful to you.','theplus'); ?></h4>
						<div class="col-xs-6">
							<h3><?php echo esc_html__('Resources :','theplus'); ?></h3>
							<ul>
								<li>
									<a href="https://elementor.theplusaddons.com/documentation/" target="_blank"><?php echo esc_html__('Visit Our Main Page : Live Demo','theplus'); ?></a></li>
								<li><a href="https://elementor.theplusaddons.com/widgets/" target="_blank"><?php echo esc_html__('Check our 50+ Widgets : Plus Widgets','theplus'); ?></a></li>
								<li><a href="https://elementor.theplusaddons.com/plus-blocks/" target="_blank"><?php echo esc_html__('Our 500+ UI Blocks : Plus Blocks','theplus'); ?></a></li>
								<li><a href="https://elementor.theplusaddons.com/pluslisting/" target="_blank"><?php echo esc_html__('Visit Grid Builder Options : Plus Listings','theplus'); ?></a></li>
								<li><a href="https://elementor.theplusaddons.com/plus-templates/"><?php echo esc_html__('Check premade pages : Plus Pages','theplus'); ?></a></li>
							</ul>
						</div>
						
						<div class="col-xs-6">
							<ul style="padding-top: 40px;">
								<li><a href="https://elementor.theplusaddons.com/documentation/" target="_blank"><?php echo esc_html__('Checkout our detailed documentation : Online Documentation','theplus'); ?></a></li>
								<li><a href="https://www.youtube.com/playlist?list=PLFRO-irWzXaLK9H5opSt88xueTnRhqvO5" target="_blank"><?php echo esc_html__('Watch Our Video Tutorials : Video Library','theplus'); ?></a></li>
								<li><a href="https://elementor.theplusaddons.com/pricing/" target="_blank"><?php echo esc_html__('Purchase Another License : Buy Now','theplus'); ?></a></li>
							</ul>
						</div>
					</div>
				</div>
				<?php } ?>
				
            	<?php  endforeach; ?>
		</div>
		<?php
    }
    
    /**
     * Defines the theme option metabox and field configuration
     * @since  1.0.0
     * @return array
     */
    public function option_fields()
    {
		
        // Only need to initiate the array once per page-load
        if (!empty($this->option_metabox)) {
            return $this->option_metabox;
        }
    
        $this->option_metabox[] = array(
            'id' => 'theplus_options',
            'title' => 'General Settings',
            'show_on' => array(
                'key' => 'options-page',
                'value' => array(
                    'theplus_options'
                )
            ),
            'show_names' => true,
            'fields' => array(
				array(
	                'name' => __('Widgets On/Off', 'theplus'),
	                'desc' => __('Use above option to hide/unhide widgets. If you want to use just few widgets, We suggest to uncheck rest, which will help you to improve performance of website.', 'theplus'),
	                'id' => 'check_elements',
	                'type' => 'multicheck_inline',
					'select_all_button' => true,
					'default' =>array('tp_accordion','tp_adv_text_block','tp_blockquote','tp_blog_listout','tp_button','tp_clients_listout','tp_contact_form_7','tp_countdown','tp_flip_box','tp_gallery_listout','tp_heading_animation','tp_heading_title','tp_info_box','tp_number_counter','tp_pricing_table','tp_social_icon','tp_smooth_scroll','tp_tabs_tours','tp_team_member_listout','tp_testimonial_listout'),
	                'options' => array(
	                    'tp_accordion' => __('Accordion', 'theplus'),
	                    'tp_adv_text_block' => __('Advanced Text Block', 'theplus'),
	                    'tp_blockquote' => __('Block quote', 'theplus'),
	                    'tp_blog_listout' => __('Blog Listing', 'theplus'),
	                    'tp_button' => __('Button', 'theplus'),                    
	                    'tp_clients_listout' => __('Clients Listing', 'theplus'),
	                    'tp_contact_form_7' => __('Contact Form 7', 'theplus'),
	                    'tp_countdown' => __('Count Down', 'theplus'),
	                    'tp_flip_box' => __('Flip Box', 'theplus'),
	                    'tp_gallery_listout' => __('Gallery Listing', 'theplus'),	                 
	                    'tp_heading_animation' => __('Heading Animation', 'theplus'),
	                    'tp_heading_title' => __('Heading Title', 'theplus'),
	                    'tp_info_box' => __('Info Box', 'theplus'),
	                    'tp_number_counter' => __('Number Counter', 'theplus'),
	                    'tp_pricing_table' => __('Pricing Table', 'theplus'),
	                    'tp_social_icon' => __('Social Icon', 'theplus'),
	                    'tp_smooth_scroll' => __('Smooth Scroll', 'theplus'),	                   
						'tp_tabs_tours' => __('Tabs/Tours', 'theplus'),
	                    'tp_team_member_listout' => __('Team Member Listing', 'theplus'),
	                    'tp_testimonial_listout' => __('Testimonial', 'theplus'),	                 
	                )	                
	            ),
            )
        );
        
        $this->option_metabox[] = array(
            'id' => 'post_type_options',
            'title' => 'Post Type Settings',
            'show_on' => array(
                'key' => 'options-page',
                'value' => array(
                    'post_type_options'
                )
            ),
            'show_names' => true,
            'fields' => array(				
				/* client option start */
				array(
					'name' => __('Clients Post Type Settings', 'theplus'),
					'desc' => '',
					'type' => 'title',
					'id' => 'client_post_title'
				),
				array(
						'name' => __('Select Post Type Type', 'theplus'),
						'desc' => '',
						'id' => 'client_post_type',
						'type' => 'select',
						'show_option_none' => true,
						'default' => 'disable',
						'options' => array(
							'disable' => __('Disable', 'theplus'),
							'plugin' => __('ThePlus Post Type', 'theplus'),
							'themes' => __('Prebuilt Theme Based', 'theplus'),
						)
				),
				array(
				'name' => __('Post Name : (Keep Blank if you want to keep default Name)', 'theplus'),
				'desc' => __('Enter value for clients custom post type name. Default: "theplus_clients"', 'theplus'),
				'default' => '',
				'id' => 'client_plugin_name',
				'type' => 'text',
					'attributes' => array(
						'data-conditional-id'    => 'client_post_type',
						'data-conditional-value' => 'plugin',
					),
				),
				array(
				'name' => __('Category Taxonomy Value : (Keep Blank if you want to keep default Name)', 'theplus'),
				'desc' => __('Enter value for Category Taxonomy Value. Default : "theplus_clients_cat" ', 'theplus'),
				'default' => '',
				'id' => 'client_category_plugin_name',
				'type' => 'text',
					'attributes' => array(
						'data-conditional-id'    => 'client_post_type',
						'data-conditional-value' => 'plugin',
					),
				),
				array(
				'name' => __('Prebuilt Post Name : (You can find that from here)', 'theplus'),
				'desc' => sprintf( __('Enter the value of your current post type name which is prebuilt with your theme. E.g.: "theplus_clients" <a href="%s" class="thickbox" title="Get the Post Name of Custom Post type as per above Screenshot.">Check screenshot</a> for how to get that value from URL of your current post type.', 'theplus'), THEPLUS_URL.'assets/images/post-type-screenshot.png' ),
				'default' => '',
				'id' => 'client_theme_name',
				'type' => 'text',
					'attributes' => array(
						'data-conditional-id'    => 'client_post_type',
						'data-conditional-value' => 'themes',
					),
				),
				array(
				'name' => __('Prebuilt Category Taxonomy Value : (You can find that from here)', 'theplus'),
				'desc' => sprintf( __('Enter the value of your current Category Taxonomy Value which is prebuilt with your theme.  E.g. : "theplus_clients_cat" <a href="%s" class="thickbox" title="Get the Category Taxonomy Value as per above screenshot.">Check screenshot</a> for how to get that value from URL of your current taxonomy.', 'theplus'), THEPLUS_URL.'assets/images/taxonomy-screenshot.png'),
				'default' => '',
				'id' => 'client_category_name',
				'type' => 'text',
					'attributes' => array(
						'data-conditional-id'    => 'client_post_type',
						'data-conditional-value' => 'themes',
					),
				),
				/* client option start */
				/* testimonial option start */
				array(
					'name' => __('Testimonial Post Type Settings', 'theplus'),
					'desc' => '',
					'type' => 'title',
					'id' => 'testimonial_post_title'
				),
				array(
						'name' => __('Select Post type Type', 'theplus'),
						'desc' => '',
						'id' => 'testimonial_post_type',
						'type' => 'select',
						'show_option_none' => true,
						'default' => 'disable',
						'options' => array(
							'disable' => __('Disable', 'theplus'),
							'plugin' => __('ThePlus Post Type', 'theplus'),
							'themes' => __('Prebuilt Theme Based', 'theplus'),
						)
				),
				array(
				'name' => __('Post Name : (Keep Blank if you want to keep default Name)', 'theplus'),
				'desc' => __('Enter value for testimonial custom post type name. Default: "theplus_testimonial"', 'theplus'),
				'default' => '',
				'id' => 'testimonial_plugin_name',
				'type' => 'text',
					'attributes' => array(
						'data-conditional-id'    => 'testimonial_post_type',
						'data-conditional-value' => 'plugin',
					),
				),
				array(
				'name' => __('Category Taxonomy Value : (Keep Blank if you want to keep default Name)', 'theplus'),
				'desc' => __('Enter value for Category Taxonomy Value. Default :"theplus_testimonial_cat"', 'theplus'),
				'default' => '',
				'id' => 'testimonial_category_plugin_name',
				'type' => 'text',
					'attributes' => array(
						'data-conditional-id'    => 'testimonial_post_type',
						'data-conditional-value' => 'plugin',
					),
				),
				array(
				'name' => __('Prebuilt Post Name : (You can find that from here)', 'theplus'),
				'desc' => sprintf( __('Enter the value of your current post type name which is prebuilt with your theme. E.g.: "theplus_testimonial" <a href="%s" class="thickbox" title="Get the Post Name of Custom Post type as per above Screenshot.">Check screenshot</a> for how to get that value from URL of your current post type.', 'theplus'), THEPLUS_URL.'assets/images/post-type-screenshot.png' ),
				'default' => '',
				'id' => 'testimonial_theme_name',
				'type' => 'text',
					'attributes' => array(
						'data-conditional-id'    => 'testimonial_post_type',
						'data-conditional-value' => 'themes',
					),
				),
				array(
				'name' => __('Prebuilt Category Taxonomy Value : (You can find that from here)', 'theplus'),
				'desc' => sprintf( __('Enter the value of your current Category Taxonomy Value which is prebuilt with your theme.  E.g. : "theplus_testimonial_cat" <a href="%s" class="thickbox" title="Get the Category Taxonomy Value as per above screenshot.">Check screenshot</a> for how to get that value from URL of your current taxonomy.', 'theplus'), THEPLUS_URL.'assets/images/taxonomy-screenshot.png' ),
				'default' => '',
				'id' => 'testimonial_category_name',
				'type' => 'text',
					'attributes' => array(
						'data-conditional-id'    => 'testimonial_post_type',
						'data-conditional-value' => 'themes',
					),
				),
				/* testimonial option start */
				/* Team Member option start */
				array(
					'name' => __('Team Member Post Type Settings','theplus'),
					'desc' => '',
					'type' => 'title',
					'id' => 'testimonial_post_title'
				),
				array(
						'name' => __('Select Team Member Post Type', 'theplus'),
						'desc' => '',
						'id' => 'team_member_post_type',
						'type' => 'select',
						'show_option_none' => true,
						'default' => 'disable',
						'options' => array(
							'disable' => __('Disable', 'theplus'),
							'plugin' => __('ThePlus Post Type', 'theplus'),
							'themes' => __('Prebuilt Theme Based', 'theplus'),
						)
				),
				array(
				'name' => __('Post Name : (Keep Blank if you want to keep default Name)', 'theplus'),
				'desc' => __('Enter value for team member custom post type name. Default: "theplus_team_member"', 'theplus'),
				'default' => '',
				'id' => 'team_member_plugin_name',
				'type' => 'text',
					'attributes' => array(
						'data-conditional-id'    => 'team_member_post_type',
						'data-conditional-value' => 'plugin',
					),
				),
				array(
				'name' => __('Category Taxonomy Value (Keep Blank if you want to keep default Name)', 'theplus'),
				'desc' => __('Enter value for Category Taxonomy Value. Default : "theplus_team_member_cat"', 'theplus'),
				'default' => '',
				'id' => 'team_member_category_plugin_name',
				'type' => 'text',
					'attributes' => array(
						'data-conditional-id'    => 'team_member_post_type',
						'data-conditional-value' => 'plugin',
					),
				),
				array(
				'name' => __('Prebuilt Post Name : (You can find that from here)', 'theplus'),
				'desc' => sprintf( __('Enter the value of your current post type name which is prebuilt with your theme. E.g.: "theplus_team_member" <a href="%s" class="thickbox" title="Get the Post Name of Custom Post type as per above Screenshot.">Check screenshot</a> for how to get that value from URL of your current post type.', 'theplus'), THEPLUS_URL.'assets/images/post-type-screenshot.png' ),
				'default' => '',
				'id' => 'team_member_theme_name',
				'type' => 'text',
					'attributes' => array(
						'data-conditional-id'    => 'team_member_post_type',
						'data-conditional-value' => 'themes',
					),
				),
				array(
				'name' => __('Prebuilt Category Taxonomy Value (You can find that from here)', 'theplus'),
				'desc' => sprintf( __('Enter the value of your current Category Taxonomy Value which is prebuilt with your theme.  E.g. : "theplus_team_member_cat" <a href="%s" class="thickbox" title="Get the Category Taxonomy Value as per above screenshot.">Check screenshot</a> for how to get that value from URL of your current taxonomy.', 'theplus'), THEPLUS_URL.'assets/images/taxonomy-screenshot.png' ),
				'default' => '',
				'id' => 'team_member_category_name',
				'type' => 'text',
					'attributes' => array(
						'data-conditional-id'    => 'team_member_post_type',
						'data-conditional-value' => 'themes',
					),
				),
				/* Team Member option start */
            )
        );
		
		$this->option_metabox[] = array(
            'id' => 'theplus_performance',
            'title' => 'Performance',
            'show_on' => array(
                'key' => 'options-page',
                'value' => array(
                    'theplus_performance'
                )
            ),
            'show_names' => true,
            'fields' => array(				
				array(
						'name' => __('Minify CSS', 'theplus'),
						'desc' => __('Enable Minified CSS to have faster performance of website. Disable it if it have any conflicts with your other plugins. If you are using cache plugins and do change status of this, do remove cache and test website. You need to do hard refresh.', 'theplus'),
						'id' => 'compress_minify_css',
						'type' => 'select',
						'show_option_none' => true,
						'default' => 'disable',
						'options' => array(
							'disable' => __('Disable', 'theplus'),
							'enable' => __('Enable', 'theplus'),
						)
				),
				array(
						'name' => __('Minified JS', 'theplus'),
						'desc' => __('Enable Minified JS to have faster performance of website. Disable it if it have any conflicts with your other plugins. If you are using cache plugins and do change status of this, do remove cache and test website. You need to do hard refresh.', 'theplus'),
						'id' => 'compress_minify_js',
						'type' => 'select',
						'show_option_none' => true,
						'default' => 'disable',
						'options' => array(
							'disable' => __('Disable', 'theplus'),
							'enable' => __('Enable', 'theplus'),
						)
				),
			),
        );
		$this->option_metabox[] = array(
            'id' => 'theplus_styling_data',
            'title' => 'Custom',
            'show_on' => array(
                'key' => 'options-page',
                'value' => array(
                    'theplus_styling_data'
                )
            ),
            'show_names' => true,
            'fields' => array(				
				array( 
					'name' => __( 'Custom CSS', 'theplus' ),
					'desc' => __( 'Add Your Custom CSS Styles', 'theplus' ),
					'id' => 'theplus_custom_css_editor',
					'type' => 'textarea_code',
				),
				array( 
					'name' => __( 'Custom JS', 'theplus' ),
					'desc' => __( 'Add Your Custom JS Scripts', 'theplus' ),
					'id' => 'theplus_custom_js_editor',
					'type' => 'textarea_code',
				),
			),
        );
		$this->option_metabox[] = array(
            'id' => 'theplus_purchase_code',
            'title' => 'Pro Version',
            'show_on' => array(
                'key' => 'options-page',
                'value' => array(
                    'theplus_purchase_code'
                )
            ),
            'show_names' => true,
        );
		$this->option_metabox[] = array(
            'id' => 'theplus_about_us',
            'title' => 'About',
            'show_on' => array(
                'key' => 'options-page',
                'value' => array(
                    'theplus_about_us'
                )
            ),
            'show_names' => true,
        );
        return $this->option_metabox;
    }
   
    public function get_option_key($field_id)
    {
        $option_tabs = $this->option_fields();
        foreach ($option_tabs as $option_tab) { //search all tabs
            foreach ($option_tab['fields'] as $field) { //search all fields
                if ($field['id'] == $field_id) {
                    return $option_tab['id'];
                }
            }
        }
        return $this->key; //return default key if field id not found
    }
    /**
     * Public getter method for retrieving protected/private variables
     * @since  1.0.0
     * @param  string  $field Field to retrieve
     * @return mixed          Field value or exception is thrown
     */
    public function __get($field)
    {
        
        // Allowed fields to retrieve
        if (in_array($field, array('key','fields','title','options_page'), true)) {
            return $this->{$field};
        }
        if ('option_metabox' === $field) {
            return $this->option_fields();
        }
        
        throw new Exception('Invalid property: ' . $field);
    }
    
}


// Get it started
$Theplus_Elementor_Plugin_Options = new Theplus_Elementor_Plugin_Options();
$Theplus_Elementor_Plugin_Options->hooks();

/**
 * Wrapper function around cmb_get_option
 * @since  1.0.0
 * @param  string  $key Options array key
 * @return mixed        Option value
 */
function theplus_ele_get_option($key = '')
{
    global $Theplus_Elementor_Plugin_Options;
    return cmb_get_option($Theplus_Elementor_Plugin_Options->key, $key);
}