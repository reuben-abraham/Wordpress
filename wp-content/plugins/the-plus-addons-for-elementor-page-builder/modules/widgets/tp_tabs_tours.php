<?php 
/*
Widget Name: Tabs And Tours
Description: Toggle of a tabs and tours content.
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

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly


class ThePlus_Tabs_Tours extends Widget_Base {
		
	public function get_name() {
		return 'tp-tabs-tours';
	}

    public function get_title() {
        return __('Tabs/Tours', 'theplus');
    }

    public function get_icon() {
        return 'fa fa-th-list theplus_backend_icon';
    }

    public function get_categories() {
        return array('plus-tabbed');
    }
	
	public function get_keywords() {
		return [ 'tabs', 'accordion', 'toggle' ];
	}
	
	public function get_style_depends() {
		return [ 'theplus-tabs-tours-ele' ];
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
				'label' => __( 'Content', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'tab_title',
			[
				'label' => __( 'Title & Content', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Tab Title' , 'theplus' ),
				'dynamic' => [
					'active' => true,
				],
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'content_source',
			[
				'label' => __( 'Content Source', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'content',
				'options' => [
					'content'  => __( 'Content', 'theplus' ),
					'page_template' => __( 'Page Template (PRO)', 'theplus' ),
				],
			]
		);
		$repeater->add_control(
			'tab_content',
			[
				'label' => __( 'Content', 'theplus' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => __( 'Content', 'theplus' ),
				'show_label' => false,
				'condition'    => [
					'content_source' => [ 'content' ],
				],
			]
		);
		$repeater->add_control(
			'plus_pro_page_template_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
				'condition'   => ['content_source' => "page_template"],
			]
		);
		$repeater->add_control(
			'display_icon',[
				'label'   => esc_html__( 'Show Icon', 'theplus' ),
				'type'    =>  Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),	
				'separator' => 'before',
			]
		);
		$repeater->add_control(
			'icon_style',
			[
				'label' => __( 'Icon Font', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'font_awesome',
				'options' => [
					'font_awesome'  => __( 'Font Awesome', 'theplus' ),
					'icon_mind' => __( 'Icons Mind (PRO)', 'theplus' ),
					'image' => __( 'Image (PRO)', 'theplus' ),
				],
				'condition' => [
					'display_icon' => 'yes',
				],
			]
		);
		
		$repeater->add_control(
			'icon_fontawesome',
			[
				'label' => __( 'Icon Library', 'theplus' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-plus',
				'separator' => 'before',
				'condition' => [
					'display_icon' => 'yes',
					'icon_style' => 'font_awesome',
				],
			]
		);
		$repeater->add_control(
			'plus_pro_icons_mind_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
				'condition' => [
					'display_icon' => 'yes',
					'icon_style' => ['icon_mind','image'],
				],
			]
		);
		
		$this->add_control(
			'tabs',
			[
				'label' => '',
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'tab_title' => __( 'Tab #1', 'theplus' ),
						'tab_content' => __( 'I am item content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'theplus' ),
					],
					[
						'tab_title' => __( 'Tab #2', 'theplus' ),
						'tab_content' => __( 'I am item content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'theplus' ),
					],
				],
				'title_field' => '{{{ tab_title }}}',
				'separator' => 'before',
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'layout_content_section',
			[
				'label' => __( 'Layout', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'tabs_type',
			[
				'label' => __( 'Layout', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => [
					'horizontal' => __( 'Horizontal', 'theplus' ),
					'vertical' => __( 'Vertical', 'theplus' ),
				],
				'prefix_class' => 'elementor-tabs-view-',
				
			]
		);
		$this->add_control(
			'tabs_align_horizontal',
			[
				'label' => __( 'Navigation Position', 'theplus' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'top' => [
						'title' => __( 'Top', 'theplus' ),
						'icon' => 'fa fa-level-up',
					],					
					'bottom' => [
						'title' => __( 'Bottom', 'theplus' ),
						'icon' => 'fa fa-level-down',
					],
				],
				'default' => 'top',
				'label_block' => false,
				'separator' => 'after',
				'condition'    => [
					'tabs_type' => [ 'horizontal' ],
				],
			]
		);
		$this->add_control(
			'plus_pro_tabs_align_horizontal_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
				'condition'    => [
					'tabs_type' => [ 'horizontal' ],
					'tabs_align_horizontal' => [ 'bottom' ],
				],
			]
		);
		$this->add_control(
			'tabs_align_vertical',
			[
				'label' => __( 'Navigation Position', 'theplus' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'theplus' ),
						'icon' => 'fa fa-align-left',
					],					
					'right' => [
						'title' => __( 'Right', 'theplus' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'left',
				'label_block' => false,
				'separator' => 'after',
				'condition'    => [
					'tabs_type' => [ 'vertical' ],
				],
			]
		);
		$this->add_control(
			'plus_pro_tabs_align_vertical_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
				'condition'    => [
					'tabs_type' => [ 'vertical' ],
					'tabs_align_vertical' => [ 'right' ],
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_toggle_style_icon',
			[
				'label' => __( 'Icon', 'theplus' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
            'icon_size',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Icon Size', 'theplus'),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 200,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header .tab-icon-wrap,{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title .tab-icon-wrap' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header .tab-icon-image' => 'max-width: {{SIZE}}{{UNIT}};',
				],
            ]
        );
		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header .tab-icon-wrap,{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title .tab-icon-wrap' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_active_color',
			[
				'label' => __( 'Active Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header:hover .tab-icon-wrap,{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header.active .tab-icon-wrap,{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title.active .tab-icon-wrap' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_space',
			[
				'label' => __( 'Spacing', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav:not(.full-width-icon) .plus-tab-header .tab-icon-wrap,{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title .tab-icon-wrap' => 'padding-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .theplus-tabs-wrapper ul.plus-tabs-nav.full-width-icon .plus-tab-header .tab-icon-wrap' => 'padding-right: 0;padding-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_title_style',
			[
				'label' => __( 'Tab Title Bar', 'theplus' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'nav_vertical_width',
			[
				'label' => __( 'Navigation Width', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' , 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 600,
						'step' => 2,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 25,
				],
				'selectors'  => [
					'{{WRAPPER}}.elementor-tabs-view-vertical .theplus-tabs-nav-wrapper' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'tabs_type' => 'vertical',
				],
				
			]
		);
		$this->add_control(
			'nav_vertical_align',
			[
				'label' => __( 'Vertical Alignment', 'theplus' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'align-top' => [
						'title' => __( 'Top', 'theplus' ),
						'icon' => 'fa fa-arrow-up',
					],
					'align-center' => [
						'title' => __( 'Center', 'theplus' ),
						'icon' => 'fa fa-align-center',
					],
					'align-bottom' => [
						'title' => __( 'Bottom', 'theplus' ),
						'icon' => 'fa fa-arrow-down',
					],
				],
				'default' => 'align-top',
				'label_block' => false,
				'separator' => 'after',
				'condition' => [
					'tabs_type' => 'vertical',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header,{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title',
			]
		);
		$this->add_control(
			'nav_align',
			[
				'label' => __( 'Nav Alignment', 'theplus' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'text-left' => [
						'title' => __( 'Left', 'theplus' ),
						'icon' => 'fa fa-align-left',
					],
					'text-center' => [
						'title' => __( 'Center', 'theplus' ),
						'icon' => 'fa fa-align-center',
					],
					'text-right' => [
						'title' => __( 'Right', 'theplus' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'text-left',
				'label_block' => false,
			]
		);
		$this->add_control(
			'nav_title_display',
			[
				'label' => __( 'Title On/Off', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'theplus' ),
				'label_off' => __( 'Off', 'theplus' ),
				'default' => 'yes',
				'separator' => 'after',
			]
		);
		$this->add_control(
			'nav_color_options',
			[
				'label' => __( 'Title Color Options', 'theplus' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
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
			'title_color_option',
			[
				'label' => __( 'Title Color', 'theplus' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'solid' => [
						'title' => __( 'Classic', 'theplus' ),
						'icon' => 'fa fa-paint-brush',
					],
					'gradient' => [
						'title' => __( 'Gradient', 'theplus' ),
						'icon' => 'fa fa-barcode',
					],
				],
				'default' => 'solid',
				'label_block' => false,
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#313131',
				'selectors' => [
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header,{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title' => 'color: {{VALUE}}',
				],
				'condition' => [
					'title_color_option' => 'solid',
				],
			]
		);
		$this->add_control(
			'plus_pro_title_color_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
				'condition' => [
					'title_color_option' => 'gradient',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_title_active',
			[
				'label' => __( 'Active', 'theplus' ),
			]
		);
		$this->add_control(
			'title_active_color_option',
			[
				'label' => __( 'Title Active Color', 'theplus' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'solid' => [
						'title' => __( 'Classic', 'theplus' ),
						'icon' => 'fa fa-paint-brush',
					],
					'gradient' => [
						'title' => __( 'Gradient', 'theplus' ),
						'icon' => 'fa fa-barcode',
					],
				],
				'default' => 'solid',
				'label_block' => false,
			]
		);
		$this->add_control(
			'title_active_color',
			[
				'label' => __( 'Active Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#3351a6',
				'selectors' => [
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header:hover,{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header.active,{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title.active' => 'color: {{VALUE}}',
				],
				'condition' => [
					'title_active_color_option' => 'solid',
				],
			]
		);
		$this->add_control(
			'plus_pro_title_active_color_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
				'condition' => [
					'title_active_color_option' => 'gradient',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		$this->start_controls_section(
			'section_title_bg_style',
			[
				'label' => __( 'Tab Title Bar Background', 'theplus' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'nav_inner_margin',
			[
				'label' => __( 'Nav Inner Margin', 'theplus' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header,{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'nav_inner_padding',
			[
				'label' => __( 'Nav Inner Padding', 'theplus' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'separator' => 'after',
				'selectors' => [
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header,{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'nav_title_space',
			[
				'label' => __( 'Navigation Between Space', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 2,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors'  => [
					'{{WRAPPER}}.elementor-tabs-view-horizontal .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header' => 'margin-left: {{SIZE}}{{UNIT}};margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.elementor-tabs-view-horizontal .theplus-tabs-wrapper .plus-tabs-nav li:first-child .plus-tab-header' => 'margin-left:0;',
					'{{WRAPPER}}.elementor-tabs-view-horizontal .theplus-tabs-wrapper .plus-tabs-nav li:last-child .plus-tab-header' => 'margin-right:0;',
					'{{WRAPPER}}.elementor-tabs-view-vertical .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header' => 'margin-top: {{SIZE}}{{UNIT}};margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.elementor-tabs-view-vertical .theplus-tabs-wrapper .plus-tabs-nav li:first-child .plus-tab-header' => 'margin-top:0;',
					'{{WRAPPER}}.elementor-tabs-view-vertical .theplus-tabs-wrapper .plus-tabs-nav li:last-child .plus-tab-header' => 'margin-bottom:0;',
					
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'nav_box_border',
			[
				'label' => __( 'Box Border', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'default' => 'no',
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'nav_border_style',
			[
				'label' => __( 'Border Style', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => theplus_get_border_style(),
				'selectors'  => [
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header' => 'border-style: {{VALUE}};',
				],
				'condition' => [
					'nav_box_border' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'nav_border_width',
			[
				'label' => __( 'Border Width', 'theplus' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top'    => 1,
					'right'  => 1,
					'bottom' => 1,
					'left'   => 1,
				],
				'selectors'  => [
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'nav_box_border' => 'yes',
				],
			]
		);
		$this->start_controls_tabs( 'nav_box_border_style' );
		$this->start_controls_tab(
			'nav_border_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
				'condition' => [
					'nav_box_border' => 'yes',
				],
			]
		);
		$this->add_control(
			'nav_border_color',
			[
				'label' => __( 'Border Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#252525',
				'selectors'  => [
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'nav_box_border' => 'yes',
				],
			]
		);
		
		$this->add_responsive_control(
			'nav_border_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'nav_box_border' => 'yes',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'nav_border_active',
			[
				'label' => __( 'Active', 'theplus' ),
				'condition' => [
					'nav_box_border' => 'yes',
				],
			]
		);
		$this->add_control(
			'nav_border_active_color',
			[
				'label' => __( 'Border Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#252525',
				'selectors'  => [
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header:hover,{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header.active' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'nav_box_border' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'nav_border_active_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header:hover,{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'nav_box_border' => 'yes',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->start_controls_tabs( 'nav_background_style' );
		$this->start_controls_tab(
			'nav_background_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nav_box_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header',
				
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'nav_background_active',
			[
				'label' => __( 'Active', 'theplus' ),
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nav_box_active_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header:hover,{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header.active',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		
		$this->end_controls_section();
		/*title bg style*/
		
		/*desc style*/
		$this->start_controls_section(
            'section_desc_styling',
            [
                'label' => __('Content', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
			]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'label' => __( 'Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-content-wrapper .plus-tab-content .plus-content-editor',
			]
		);
		$this->add_control(
			'desc_color',
			[
				'label' => __( 'Desc Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-content-wrapper .plus-tab-content .plus-content-editor,{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-content-wrapper .plus-tab-content .plus-content-editor p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
            'section_desc_bg_styling',
            [
                'label' => __('Content Background', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
			]
        );
		$this->add_responsive_control(
			'content_tab_margin',
			[
				'label' => __( 'Content Margin Space', 'theplus' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-content-wrapper,{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion.mobile-accordion-tab .theplus-tabs-content-wrapper .plus-tab-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_tab_padding',
			[
				'label' => __( 'Content Inner Padding', 'theplus' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-content-wrapper,{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion.mobile-accordion-tab .theplus-tabs-content-wrapper .plus-tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'content_border_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-content-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'content_box_border' => 'yes',
				],
			]
		);
		$this->add_control(
			'content_background_options',
			[
				'label' => __( 'Background Options', 'theplus' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'content_box_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-content-wrapper',
				
			]
		);
				
		$this->end_controls_section();
		/*desc style*/
		/* Extra option */
		$this->start_controls_section(
            'section_extra_options',
            [
                'label' => __('Extra Options', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
			]
        );
		$this->add_control(
			'plus_pro_extra_options_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
			]
		);
				
		$this->add_control(
			'tab_nav_responsive',
			[
				'label'   => __( 'Tab Navigation Responsive', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''  => __( 'None', 'theplus' ),
					'nav_full' => __( 'Full Width (PRO)', 'theplus' ),
					'nav_one' => __( 'One By One (PRO)', 'theplus' ),
					'tab_accordion' => __( 'Force Accordion', 'theplus' ),
				],
				'separator' => 'before',
				'description' => __('These options are for making your tabs look different in small devices. You can select none, If you want to keep your settings.','theplus'),
			]
		);
		$this->add_control(
			'plus_pro_tab_nav_responsive_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
				'condition' => [
					'tab_nav_responsive' => ['nav_full','nav_one'],
				],
			]
		);
		
		$this->start_controls_tabs( 'accordion__box_border_style' );
		$this->start_controls_tab(
			'accordion_border_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
				'condition' => [
					'tab_nav_responsive' => 'tab_accordion',
					'accordion_box_border' => 'yes',
				],
			]
		);
		
		$this->add_responsive_control(
			'accordion_border_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'tab_nav_responsive' => 'tab_accordion',
					'accordion_box_border' => 'yes',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'accordion_border_active',
			[
				'label' => __( 'Active', 'theplus' ),
				'condition' => [
					'tab_nav_responsive' => 'tab_accordion',
					'accordion_box_border' => 'yes',
				],
			]
		);
		
		$this->add_responsive_control(
			'accordion_border_active_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'tab_nav_responsive' => 'tab_accordion',
					'accordion_box_border' => 'yes',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->start_controls_tabs( 'accordion_background_style' );
		$this->start_controls_tab(
			'accordion_background_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
				'condition' => [
					'tab_nav_responsive' => 'tab_accordion',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'accordion_box_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title',
				'condition' => [
					'tab_nav_responsive' => 'tab_accordion',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'accordion_background_active',
			[
				'label' => __( 'Active', 'theplus' ),
				'condition' => [
					'tab_nav_responsive' => 'tab_accordion',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'accordion_box_active_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title.active',
				'condition' => [
					'tab_nav_responsive' => 'tab_accordion',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		
		$this->end_controls_section();
		/* Extra option */
		/*Adv tab*/
		$this->start_controls_section(
            'section_plus_extra_adv',
            [
                'label' => __('Plus Extras', 'theplus'),
                'tab' => Controls_Manager::TAB_ADVANCED,
            ]
        );
		$this->end_controls_section();
		/*Adv tab*/
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
		$tabs = $this->get_settings_for_display( 'tabs' );
		$nav_align=$settings["nav_align"];
		$id_int = substr( $this->get_id_int(), 0, 3 );
		
		
		$nav_vertical_align = $settings['nav_vertical_align'];
		$uid=uniqid("tabs");
		
		
		$animation_effects=$settings["animation_effects"];
		$animation_delay=$settings["animation_delay"]["size"];
		$animate_duration='';
		if($settings["animation_duration_default"]=='yes'){
			$animate_duration=$settings["animate_duration"]["size"];
		}			
		if($animation_effects=='no-animation'){
			$animated_class = '';
			$animation_attr = '';
		}else{
			$animated_class = 'animate-general';
			$animation_attr = ' data-animate-type="'.esc_attr($animation_effects).'" data-animate-delay="'.esc_attr($animation_delay).'"';
			if($settings["animation_duration_default"]=='yes'){
				$animation_attr .= ' data-animate-duration="'.esc_attr($animate_duration).'"';
			}
		}
			
			
			$tab_nav ='<div class="theplus-tabs-nav-wrapper elementor-tabs-wrapper '.esc_attr($nav_align).' '.esc_attr($nav_vertical_align).'">';
				$tab_nav .='<ul class="plus-tabs-nav ">';
				foreach ( $tabs as $index => $item ) :
					$tab_count = $index + 1;
					
					$tab_title_setting_key = $this->get_repeater_setting_key( 'tab_title', 'tabs', $index );
					
					$this->add_render_attribute( $tab_title_setting_key, [
						'id' => 'elementor-tab-title-' . $id_int . $tab_count,
						'class' => [ 'elementor-tab-title' , 'elementor-tab-desktop-title' , 'plus-tab-header'],
						'data-tab' => $tab_count,
						'tabindex' => $id_int . $tab_count,
						'role' => 'tab',
						'aria-controls' => 'elementor-tab-content-' . $id_int . $tab_count,
					] );
					
					$tab_nav .='<li>';
					$tab_nav .='<div '.$this->get_render_attribute_string( $tab_title_setting_key ).'>';
						if ( $item['display_icon']=='yes' ) :
							$icons=$icon_image='';
							if($item['icon_style']=='font_awesome'){
								$icons=$item['icon_fontawesome'];									
							}
							if(!empty($icons)){
							$tab_nav .='<span class="tab-icon-wrap" aria-hidden="true">';
								$tab_nav .='<i class="tab-icon '.esc_attr( $icons ).'"></i>';
								$tab_nav .='</span>';
							}
						endif;
						if($settings["nav_title_display"]=='yes'){
							$tab_nav .='<span>'.$item['tab_title'].'</span>';
						}
					$tab_nav .='</div>';
					$tab_nav .='</li>';
				endforeach;
				$tab_nav .='</ul>';
			$tab_nav .='</div>';
			$tab_content ='<div class="theplus-tabs-content-wrapper elementor-tabs-content-wrapper">';
				foreach ( $tabs as $index => $item ) :
					$tab_count = $index + 1;
					
					$tab_content_setting_key = $this->get_repeater_setting_key( 'tab_content', 'tabs', $index );

					$tab_title_mobile_setting_key = $this->get_repeater_setting_key( 'tab_title_mobile', 'tabs', $tab_count );
					
					$this->add_render_attribute( $tab_content_setting_key, [
						'id' => 'elementor-tab-content-' . $id_int . $tab_count,
						'class' => [ 'elementor-tab-content', 'elementor-clearfix','plus-tab-content'],
						'data-tab' => $tab_count,
						'role' => 'tabpanel',
						'aria-labelledby' => 'elementor-tab-title-' . $id_int . $tab_count,
					] );

					$this->add_render_attribute( $tab_title_mobile_setting_key, [
						'class' => [ 'elementor-tab-title', 'elementor-tab-mobile-title',$nav_align ],
						'tabindex' => $id_int . $tab_count,
						'data-tab' => $tab_count,
						'role' => 'tab',
					] );

					$this->add_inline_editing_attributes( $tab_content_setting_key, 'advanced' );
					
					$tab_content .='<div '.$this->get_render_attribute_string( $tab_title_mobile_setting_key ).'>';
						if ( $item['display_icon']=='yes' ) :
							$icons=$icon_image='';
							if($item['icon_style']=='font_awesome'){
								$icons=$item['icon_fontawesome'];									
							}
							if(!empty($icons)){
								$tab_content .='<span class="tab-icon-wrap" aria-hidden="true">';
									$tab_content .='<i class="tab-icon '.esc_attr( $icons ).'"></i>';
								$tab_content .='</span>';
							}
						endif;
						$tab_content .='<span>'.$item['tab_title'].'</span>';
					$tab_content .='</div>';
					$tab_content .='<div '.$this->get_render_attribute_string( $tab_content_setting_key ).'>';
						if($item['content_source']=='content' && !empty($item['tab_content'])){
							$tab_content .='<div class="plus-content-editor">'.$this->parse_text_editor( $item['tab_content'] ).'</div>';
						}						
					$tab_content .='</div>';
				endforeach;
			$tab_content .='</div>';
		$default_active='';
		
		$default_active .= ' data-tab-default="0"';		
		$default_active .= ' data-tab-hover="no"';
		
		$responsive_class='';
		if($settings["tab_nav_responsive"]=='tab_accordion'){
			$responsive_class='mobile-accordion';
		}
		
		$output ='<div class="theplus-tabs-wrapper elementor-tabs '.esc_attr($animated_class).' '.esc_attr($responsive_class).'" id="'.esc_attr($uid).'" data-tabs-id="'.esc_attr($uid).'" '.$default_active.' '.$animation_attr.' role="tablist">';
			if($settings["tabs_type"]=='horizontal'){
				if($settings['tabs_align_horizontal']=='top'){
					$output .= $tab_nav.$tab_content;
				}
			}
			if($settings["tabs_type"]=='vertical'){
				if($settings['tabs_align_vertical']=='left'){
					$output .= $tab_nav.$tab_content;
				}
			}
		$output .='</div>';
		echo $output;
	}

	protected function content_template() {
	
	}
}
