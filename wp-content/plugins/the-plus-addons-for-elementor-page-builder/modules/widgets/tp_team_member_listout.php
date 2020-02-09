<?php 
/*
Widget Name: Team Member Listing
Description: Different style of Team Member taxonomy Post listing layouts.
Author: Theplus
Author URI: http://posimyththemes.com
*/
namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly


class ThePlus_Team_Member_ListOut extends Widget_Base {
		
	public function get_name() {
		return 'tp-team-member-listout';
	}

    public function get_title() {
        return __('Team Member Listing', 'theplus');
    }

    public function get_icon() {
        return 'fa fa-users theplus_backend_icon';
    }

    public function get_categories() {
        return array('plus-listing');
    }
	
	public function get_style_depends() {
		return [ 'tp-columns-bootstrap','plus-team-member-style' ];
	}
	
    public function get_script_depends() {
        return [
            'theplus_frontend_scripts'
        ];
    }
	

    protected function _register_controls() {
		
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content Layout', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'style',
			[
				'label' => __( 'Style', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1'  => __( 'Style 1', 'theplus' ),
					'style-2' => __( 'Style 2 (PRO)', 'theplus' ),
					'style-3' => __( 'Style 3 (PRO)', 'theplus' ),
					'style-4' => __( 'Style 4 (PRO)', 'theplus' ),
				],
			]
		);
		$this->add_control(
			'plus_pro_style_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
				'condition' => [					
					'style!' => ['style-1'],
				],
			]
		);
		$this->add_control(
			'layout',
			[
				'label' => __( 'Layout', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'grid',
				'options' => [
					'grid' => __( 'Grid', 'theplus' ),
					'masonry' => __( 'Masonry', 'theplus' ),
					'carousel' => __( 'Carousel (PRO)', 'theplus' ),
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'content_source_section',
			[
				'label' => __( 'Content Source', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'post_category',
			[
				'type' => Controls_Manager::SELECT2,
				'label'      => esc_html__( 'Select Category', 'theplus' ),
				'default'    => '',
				'multiple'   => true,
				'options' => theplus_get_team_member_categories(),
				'separator' => 'before',
			]
		);
		$this->add_control(
			'display_posts',
			[
				'label' => __( 'Maximum Posts Display', 'theplus' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 200,
				'step' => 1,
				'default' => 8,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'post_offset',
			[
				'label' => __( 'Offset Posts', 'theplus' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 50,
				'step' => 1,
				'default' => '',
				'description' => __('Hide posts from the beginning of listing.','theplus'),
			]
		);
		$this->add_control(
			'post_order_by',
			[
				'label' => __( 'Order By', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => theplus_orderby_arr(),
			]
		);
		$this->add_control(
			'post_order',
			[
				'label' => __( 'Order', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => theplus_order_arr(),
			]
		);
		
		$this->end_controls_section();
		/*columns*/
		$this->start_controls_section(
			'columns_section',
			[
				'label' => __( 'Columns Manage', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'layout!' => ['carousel']
				],
			]
		);
		$this->add_control(
			'desktop_column',
			[
				'label' => __( 'Desktop Column', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => '3',
				'options' => theplus_get_columns_list(),
				'condition' => [
					'layout!' => ['carousel']
				],
			]
		);
		$this->add_control(
			'tablet_column',
			[
				'label' => __( 'Tablet Column', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => '4',
				'options' => theplus_get_columns_list(),
				'condition' => [
					'layout!' => ['carousel']
				],
			]
		);
		$this->add_control(
			'mobile_column',
			[
				'label' => __( 'Mobile Column', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => '6',
				'options' => theplus_get_columns_list(),
				'condition' => [
					'layout!' => ['carousel']
				],
			]
		);
		$this->add_responsive_control(
			'columns_gap',
			[
				'label' => __( 'Columns Gap/Space Between', 'theplus' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' =>[
					'top' => "15",
					'right' => "15",
					'bottom' => "15",
					'left' => "15",				
				],
				'separator' => 'before',
				'condition' => [
					'layout!' => ['carousel']
				],
				'selectors' => [
					'{{WRAPPER}} .team-member-list .post-inner-loop .grid-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		/*columns*/
		/*post Extra options*/
		$this->start_controls_section(
			'extra_option_section',
			[
				'label' => __( 'Extra Options', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'post_title_tag',
			[
				'label' => __( 'Title Tag', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => theplus_get_tags_options(),
				'separator' => 'after',
			]
		);
		$this->add_control(
			'display_designation',
			[
				'label' => __( 'Display Designation', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'default' => 'yes',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'display_social_icon',
			[
				'label' => __( 'Display Social Icon', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'default' => 'yes',
				'separator' => 'before',
				'condition' => [
					'style' => ['style-1','style-3','style-4'],
				],
			]
		);
		$this->add_control(
			'filter_category',
			[
				'label' => __( 'Category Wise Filter', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'default' => 'no',
				'separator' => 'before',
				'condition' => [
					'layout!' => 'carousel'
				],
			]
		);
		$this->add_control(
			'plus_pro_filter_category_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
				'condition'   => [
					'filter_category'    => 'yes',
					'layout!' => 'carousel',
				],
			]
		);
		$this->end_controls_section();
		/*post Extra options*/
			
		/*Post Title*/
		$this->start_controls_section(
            'section_title_style',
            [
                'label' => __('Title', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Typography', 'theplus' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .team-member-list .post-title,{{WRAPPER}} .team-member-list .post-title a',
			]
		);
		$this->start_controls_tabs( 'tabs_title_style' );
		$this->start_controls_tab(
			'tab_title_normal',
			[
				'label' => __( 'Normal', 'theplus' ),				
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .team-member-list .post-title,{{WRAPPER}} .team-member-list .post-title a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_title_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
			]
		);
		$this->add_control(
			'title_hover_color',
			[
				'label' => __( 'Title Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .team-member-list .team-list-content:hover .post-title,{{WRAPPER}} .team-member-list .team-list-content:hover .post-title a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*Post Title*/
		/*Designation*/
		$this->start_controls_section(
            'section_designation_style',
            [
                'label' => __('Designation', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition'   => [
					'display_designation'    => 'yes',
				],
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'designation_typography',
				'label' => __( 'Typography', 'theplus' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .team-member-list .member-designation',
			]
		);
		$this->start_controls_tabs( 'tabs_designation_style' );
		$this->start_controls_tab(
			'tab_designation_normal',
			[
				'label' => __( 'Normal', 'theplus' ),				
			]
		);
		$this->add_control(
			'designation_color',
			[
				'label' => __( 'Text Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .team-member-list .member-designation' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_designation_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
			]
		);
		$this->add_control(
			'designation_color_hover',
			[
				'label' => __( 'Text Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .team-member-list .team-list-content:hover .member-designation' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*Designation*/	
		/*Social Icon*/
		$this->start_controls_section(
            'section_social_icon_style',
            [
                'label' => __('Social Icon', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition'   => [
					'style' => ['style-1'],
					'display_social_icon'  => 'yes',
				],
            ]
        );
		$this->start_controls_tabs( 'tabs_social_icon_style' );
		$this->start_controls_tab(
			'tab_social_icon_normal',
			[
				'label' => __( 'Normal', 'theplus' ),				
			]
		);
		$this->add_control(
			'social_icon_color',
			[
				'label' => __( 'Icon Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .team-member-list.team-style-1 .team-social-content .team-social-list li a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_social_icon_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
			]
		);
		$this->add_control(
			'social_icon_color_hover',
			[
				'label' => __( 'Icon Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .team-member-list.team-style-1 .team-social-content .team-social-list li a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*Social Icon*/	
		/*Post Featured Image*/
		$this->start_controls_section(
            'section_post_image_style',
            [
                'label' => __('Featured Image', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_responsive_control(
			'featured_image_padding',
			[
				'label'      => __( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .team-member-list .post-content-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'featured_image_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .team-member-list .team-profile img,{{WRAPPER}} .team-member-list .post-content-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs( 'tabs_image_shadow_style' );
		
		$this->start_controls_tab(
			'tab_image_shadow_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
			]
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters',
				'selector' => '{{WRAPPER}} .team-member-list .post-content-image img',
				
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'image_shadow',
				'selector' => '{{WRAPPER}} .team-member-list .post-content-image',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_image_shadow_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
			]
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_hover_filters',
				'selector' => '{{WRAPPER}} .team-member-list .team-list-content:hover .post-content-image img',
				
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*Post Featured Image*/		
		/*Filter Category style*/
		$this->start_controls_section(
            'section_filter_category_styling',
            [
                'label' => __('Filter Category', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'filter_category' => 'yes',
				],
			]
        );
		$this->add_control(
			'plus_pro_filter_category_styling_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
				
			]
		);
		$this->end_controls_section();
		/*Filter Category style*/
		/*Box Loop style*/
		$this->start_controls_section(
            'section_box_loop_styling',
            [
                'label' => __('Box Loop Background Style', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
			]
        );
		$this->add_responsive_control(
			'content_inner_padding',
			[
				'label' => __( 'Padding', 'theplus' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .team-member-list .team-list-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs( 'tabs_border_style' );
		$this->start_controls_tab(
			'tab_border_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
			]
		);
		
		$this->add_responsive_control(
			'border_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .team-member-list .team-list-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_border_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
			]
		);
		
		$this->add_responsive_control(
			'border_hover_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .team-member-list .team-list-content:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->start_controls_tabs( 'tabs_background_style' );
		$this->start_controls_tab(
			'tab_background_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'box_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .team-member-list .team-list-content',
				
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_background_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'box_active_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .team-member-list .team-list-content:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		
		$this->end_controls_section();
		/*Box Loop style*/
		/*carousel option*/
		$this->start_controls_section(
            'section_carousel_options_styling',
            [
                'label' => __('Carousel Options', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => 'carousel',
				],
            ]
        );
		$this->add_control(
			'plus_pro_carousel_options_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
			]
		);
		$this->end_controls_section();
		/*carousel option*/
		/*Extra options*/
		$this->start_controls_section(
            'section_extra_options_styling',
            [
                'label' => __('Extra Options', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
			'messy_column',
			[
				'label' => __( 'Messy Columns', 'theplus' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'theplus' ),
				'label_off' => __( 'Off', 'theplus' ),				
				'default' => 'no',
			]
		);
		$this->add_control(
			'plus_pro_messy_column_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
				'condition' => [
					'messy_column' => 'yes',
				],
			]
		);
		$this->end_controls_section();
		/*Extra options*/
		$this->start_controls_section(
            'section_animation_styling',
            [
                'label' => __('On Scroll View Animation', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		
		$this->add_control(
			'animation_effects',
			[
				'label'   => __( 'Choose Animation Effect', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'no-animation',
				'options' => theplus_get_animation_options(),
			]
		);
		$this->add_control(
            'animation_delay',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Animation Delay', 'theplus'),
				'default' => [
					'unit' => '',
					'size' => 50,
				],
				'range' => [
					'' => [
						'min'	=> 0,
						'max'	=> 4000,
						'step' => 15,
					],
				],
				'render_type' => 'ui',
				'condition' => [
					'animation_effects!' => 'no-animation',
				],
            ]
        );
		
		$this->add_control(
            'animation_duration_default',
            [
				'label'   => esc_html__( 'Animation Duration', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'condition'    => [
					'animation_effects!' => 'no-animation',
				],
			]
		);
		$this->add_control(
            'animate_duration',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Duration Speed', 'theplus'),
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'range' => [
					'px' => [
						'min'	=> 100,
						'max'	=> 10000,
						'step' => 100,
					],
				],
				'render_type' => 'ui',
				'condition' => [
					'animation_effects!' => 'no-animation',
					'animation_duration_default' => 'yes',
				],
            ]
        );
		$this->end_controls_section();
	}
		
	 protected function render() {

        $settings = $this->get_settings_for_display();
		$query = $this->get_query_args();
		$style=$settings["style"];
		$layout=$settings["layout"];
		$team_name=theplus_team_member_post_name();
		$team_taxonomy=theplus_team_member_post_category();
		
		$post_title_tag=$settings["post_title_tag"];
		$display_designation=$settings["display_designation"];
		$display_social_icon=$settings["display_social_icon"];
		
		$post_category=$settings['post_category'];
		
		//animation load
		$animation_effects=$settings["animation_effects"];
		$animation_delay=$settings["animation_delay"]["size"];
		$animated_columns=$animate_duration='';
		if($settings["animation_duration_default"]=='yes'){
			$animate_duration=$settings["animate_duration"]["size"];
		}
		if($animation_effects=='no-animation'){
			$animated_class='';
			$animation_attr='';
		}else{
			$animated_class='animate-general';
			$animation_attr=' data-animate-type="'.esc_attr($animation_effects).'" data-animate-delay="'.esc_attr($animation_delay).'"';
			
			if($settings["animation_duration_default"]=='yes'){
				$animation_attr .= ' data-animate-duration="'.esc_attr($animate_duration).'"';
			}
		}
		
		//columns
		$desktop_class=$tablet_class=$mobile_class='';
		if( $layout!='metro'){
			$desktop_class='tp-col-md-'.esc_attr($settings['desktop_column']);
			$tablet_class='tp-col-sm-'.esc_attr($settings['tablet_column']);
			$mobile_class='tp-col-'.esc_attr($settings['mobile_column']);
		}
		
		
		//layout
		$layout_attr=$data_class='';
		if($layout!=''){
			$data_class .=theplus_get_layout_list_class($layout);
			$layout_attr=theplus_get_layout_list_attr($layout);
		}else{
			$data_class .=' list-isotope';
		}
		
		$data_class .=' team-'.$style;
		
		
		$output=$data_attr='';
		
		
		$uid=uniqid("post");
		
		$data_attr .=' data-id="'.esc_attr($uid).'"';
		$data_attr .=' data-style="'.esc_attr($style).'"';
		
		if ( ! $query->have_posts() ) {
			$output .='<h3 class="theplus-posts-not-found">'.esc_html__( "Posts not found", "theplus" ).'</h3>';
		}else{
			if($style=="style-1" && $layout!='carousel'){			
			$output .= '<div id="theplus-team-member-list" class="team-member-list '.esc_attr($uid).' '.esc_attr($data_class).' '.$animated_class.'" '.$layout_attr.' '.$data_attr.' '.$animation_attr.' data-enable-isotope="1">';
			
			$output .= '<div id="'.esc_attr($uid).'" class="tp-row post-inner-loop '.esc_attr($uid).' text-center">';
			while ( $query->have_posts() ) {
			
				$query->the_post();
				$post = $query->post;
				
				// Check if the custom field has a value.
				$designation='';
				$designation_team = get_post_meta( get_the_ID(), 'theplus_tm_designation', true );
				if ( ! empty( $designation_team ) ) {
					$designation='<div class="member-designation">'.esc_html($designation_team).'</div>';
				}
				
				$website = get_post_meta( get_the_ID(), 'theplus_tm_website_url', true );
				$facebook_link = get_post_meta( get_the_ID(), 'theplus_tm_face_link', true );
				$google_link = get_post_meta( get_the_ID(), 'theplus_tm_googgle_link', true );
				$insta_link = get_post_meta( get_the_ID(), 'theplus_tm_insta_link', true );
				$twit_link = get_post_meta( get_the_ID(), 'theplus_tm_twit_link', true );
				$linked_link = get_post_meta( get_the_ID(), 'theplus_tm_linked_link', true );
				$team_social_contnet='';
				if(!empty($website) || !empty($facebook_link) || !empty($google_link) || !empty($insta_link) || !empty($twit_link) || !empty($linked_link)){
					$team_social_contnet .='<div class="team-social-content">';
						$team_social_contnet .='<ul class="team-social-list">';
							if(!empty($website)){
								$team_social_contnet .='<li class="team-profile-link"><a href="'.esc_url($website).'" target="_blank"><i class="fa fa-globe" aria-hidden="true"></i></a>';
							}
							if(!empty($facebook_link)){
								$team_social_contnet .='<li class="fb-link"><a href="'.esc_url($facebook_link).'" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>';
							}
							if(!empty($twit_link)){
								$team_social_contnet .='<li class="twitter-link"><a href="'.esc_url($twit_link).'" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>';
							}
							if(!empty($insta_link)){
								$team_social_contnet .='<li class="instagram-link"><a href="'.esc_url($insta_link).'" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>';
							}
							if(!empty($google_link)){
								$team_social_contnet .='<li class="gplus-link"><a href="'.esc_url($google_link).'" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a>';
							}
							if(!empty($linked_link)){
								$team_social_contnet .='<li class="linkedin-link"><a href="'.esc_url($linked_link).'" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>';
							}
						$team_social_contnet .='</ul>';
					$team_social_contnet .='</div>';
				}
				
				//grid item loop
				$output .= '<div class="grid-item '.$desktop_class.' '.$tablet_class.' '.$mobile_class.' '.$animated_columns.'">';				
				if(!empty($style)){
					ob_start();
					include THEPLUS_PATH. 'includes/team-member/team-member-'.esc_attr($style).'.php'; 
					$output .= ob_get_contents();
					ob_end_clean();
				}
				$output .='</div>';
				
			}
			$output .='</div>';
			
			$output .='</div>';
			}else{
				$output .='<h3 class="theplus-posts-not-found">'.esc_html__( "This Style Premium Version", "theplus" ).'</h3>';
			}
		}
		
		echo $output;
		wp_reset_postdata();
	}
	
    protected function content_template() {
	
    }
	
	protected function get_query_args() {
		$settings = $this->get_settings_for_display();
		$team_name=theplus_team_member_post_name();
		$team_taxonomy=theplus_team_member_post_category();
		$terms = get_terms( array('taxonomy' => $team_taxonomy, 'hide_empty' => true) );
		$category=array();
		$post_category=$settings['post_category'];
		if ( $terms != null && !empty($post_category)){
			foreach( $terms as $term ) {
				if(in_array($term->term_id,$post_category)){
					$category[]=$term->slug;
				}
			}
		}
		
		$query_args = array(
			'post_type'           => $team_name,
			$team_taxonomy         => $category,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'posts_per_page'      => intval( $settings['display_posts'] ),
			'orderby'      =>  $settings['post_order_by'],
			'order'      => $settings['post_order'],
		);

		$offset = $settings['post_offset'];
		$offset = ! empty( $offset ) ? absint( $offset ) : 0;

		if ( $offset ) {
			$query_args['offset'] = $offset;
		}
		global $paged;
		if ( get_query_var('paged') ) {
			$paged = get_query_var('paged');
		}
		elseif ( get_query_var('page') ) {
			$paged = get_query_var('page');
		}
		else {
			$paged = 1;
		}
		$query_args['paged'] = $paged;
		
		$query = new \WP_Query( $query_args );
		
		return $query;
	}
	
}
