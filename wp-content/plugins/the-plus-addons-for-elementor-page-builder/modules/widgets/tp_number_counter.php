<?php 
/*
Widget Name: Number Counter 
Description: Display style of count numbers.
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

use TheplusAddons\Theplus_Element_Load;
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly


class ThePlus_Number_Counter extends Widget_Base {
		
	public function get_name() {
		return 'tp-number-counter';
	}

    public function get_title() {
        return __('Number Counter', 'theplus');
    }

    public function get_icon() {
        return 'fa fa-hashtag theplus_backend_icon';
    }

    public function get_categories() {
        return array('plus-essential');
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
				'label' => __( 'Style Counter', 'theplus' ),
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
			'title',
			[
				'label' => __( 'Title', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Title', 'theplus' ),
				'condition' => [					
					'style' => ['style-1'],
				],
			]
		);		
		$this->add_responsive_control(
			'alignment',
			[
				'label' => __( 'Alignment', 'theplus' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'theplus' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'theplus' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'theplus' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'default' => 'center',
				'prefix_class' => 'text-%s',
				'label_block' => false,
				'toggle' => false,
				'condition' => [
					'style' => 'style-1',
				],
			]
		);
		$this->end_controls_section();
		/*Number Content*/
		
		$this->start_controls_section(
			'number_content_section',
			[
				'label' => __( 'Number Counting', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'min_number',
			[
				'label' => __( 'Start Number (Minimum)', 'theplus' ),
				'type' => Controls_Manager::NUMBER,
				'default' => __( '0', 'theplus' ),
				'description' => __(' Enter value Start of digits/numbers you want to showcase in icon counter. e.g. 0,10,50.','theplus' ),				
			]
		);
		$this->add_control(
			'max_number',
			[
				'label' => __( 'Stop Number (Maximum)', 'theplus' ),
				'type' => Controls_Manager::NUMBER,
				'default' => __( '1000', 'theplus' ),
				'description' => __(' Enter value Stop of digits/numbers you want to showcase in icon counter. e.g. 200,300.','theplus' ),				
			]
		);
		$this->add_control(
            'delay_number',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Delay Counting Number', 'theplus'),
				'default' => [
					'unit' => '',
					'size' => 5,
				],
				'range' => [
					'' => [
						'min'	=> 0,
						'max'	=> 10000,
						'step' => 10,
					],
				],
            ]
        );
		$this->add_control(
            'increment_number',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Increase Counting Number', 'theplus'),
				'default' => [
					'unit' => '',
					'size' => 5,
				],
				'range' => [
					'' => [
						'min'	=> 0,
						'max'	=> 5000,
						'step' => 5,
					],
				],
            ]
        );
		$this->add_control(
			'symbol',
			[
				'label' => __( 'Symbol', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'description' => __('You can add any value in this option which will be setup as prefix or postfix on Digits. e.g. +,%,etc.','theplus' ),
				'separator' => 'before',
			]
		);
		$this->add_control(
			'symbol_position',
			[
				'label' => __( 'Symbol Position', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'after',
				'options' => [
					'after'  => __( 'After Number', 'theplus' ),
					'before' => __( 'Before Number', 'theplus' ),
				],
				'description' => __('You can Select Symbol position using this option.','theplus'),
			]
		);
		$this->end_controls_section();
		/*Number Content*/
		/*Icon Content*/
		$this->start_controls_section(
			'icon_content_section',
			[
				'label' => __( 'Icon', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'icon_type',
			[
				'label' => __( 'Select Icon', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'icon',
				'options' => [
					''  => __( 'None', 'theplus' ),
					'icon'  => __( 'Icon', 'theplus' ),
					'image'  => __( 'Image', 'theplus' ),
					'svg'  => __( 'Svg (PRO)', 'theplus' ),
				],
				'description' => __('You can select Icon, Custom Image or SVG using this option.','theplus'),
			]
		);
		$this->add_control(
			'icon_font_style',
			[
				'label' => __( 'Icon Font', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'font_awesome',
				'options' => [
					'font_awesome'  => __( 'Font Awesome', 'theplus' ),
					'icon_mind' => __( 'Icons Mind (PRO)', 'theplus' ),
				],
				'condition' => [
					'icon_type' => 'icon',
				],
			]
		);
		$this->add_control(
			'icon_fontawesome',
			[
				'label' => __( 'Icon Library', 'theplus' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-download',
				'condition' => [
					'icon_type' => 'icon',
					'icon_font_style' => 'font_awesome',
				],
			]
		);
		$this->add_control(
			'plus_pro_icon_mind_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
				'condition' => [
					'icon_type' => 'icon',
					'icon_font_style' => 'icon_mind',
				],
			]
		);
		$this->add_control(
			'plus_pro_svg_icon_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
				'condition' => [
					'icon_type' => 'svg',
				],
			]
		);
		$this->add_control(
			'icon_image',
			[
				'label' => __( 'Choose Image', 'theplus' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'icon_type' => 'image',
				],
			]
		);
		$this->add_control(
			'url_link',
			[
				'label' => __( 'Link', 'theplus' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'theplus' ),
				'show_external' => true,
				'default' => [
					'url' => '',
				],
			]
		);
		$this->end_controls_section();
		/*Icon Content*/
		/*icon style*/
		$this->start_controls_section(
            'section_icon_styling',
            [
                'label' => __('Icon Style', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition'   => [
					'icon_type'	=> 'icon',
				],
            ]
        );
		$this->add_control(
			'icon_style',
			[
				'label' => __( 'Icon Styles', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'square',
				'options' => [
					''  => __( 'None', 'theplus' ),
					'square' => __( 'Square', 'theplus' ),
					'rounded' => __( 'Rounded', 'theplus' ),
					'hexagon' => __( 'Hexagon (PRO)', 'theplus' ),
					'pentagon' => __( 'Pentagon (PRO)', 'theplus' ),
					'square-rotate' => __( 'Square Rotate (PRO)', 'theplus' ),
				],
			]
		);
		$this->add_control(
            'icon_size',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Icon Size', 'theplus'),
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 25,
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .plus-number-counter .counter-icon-inner .counter-icon' => 'font-size: {{SIZE}}{{UNIT}} !important;',
				],
            ]
        );
		$this->add_control(
            'icon_width',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Icon Width', 'theplus'),
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 250,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .plus-number-counter .counter-icon-inner' => 'width: {{SIZE}}{{UNIT}} !important;height: {{SIZE}}{{UNIT}} !important;line-height: {{SIZE}}{{UNIT}} !important;',
				],
            ]
        );
		$this->start_controls_tabs( 'tabs_icon_style' );
		$this->start_controls_tab(
			'tab_icon_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
			]
		);
		$this->add_control(
			'icon_color_option',
			[
				'label' => __( 'Icon Color', 'theplus' ),
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
				'label_block' => false, 
				'default' => 'solid',
				
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-number-counter .counter-icon-inner .counter-icon' => 'color: {{VALUE}}',
				],
				'condition' => [
					'icon_color_option' => 'solid',
				],
				'separator' => 'after',
			]
		);
		$this->add_control(
			'plus_pro_icon_color_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
				'condition' => [
					'icon_color_option' => 'gradient',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'icon_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .plus-number-counter .counter-icon-inner',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'icon_border_color',
			[
				'label' => __( 'Border Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-number-counter .counter-icon-inner' => 'border-color: {{VALUE}}',
				],
				'separator' => 'before',
				'condition' => [
					'icon_style!' => ['hexagon','pentagon','square-rotate'],
				],
			]
		);
		$this->add_responsive_control(
			'icon_border_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .plus-number-counter .counter-icon-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'icon_style!' => ['hexagon','pentagon','square-rotate'],
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'icon_box_shadow',
				'selector' => '{{WRAPPER}} .plus-number-counter .counter-icon-inner',
				'condition' => [
					'icon_style!' => ['hexagon','pentagon','square-rotate'],
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_icon_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
			]
		);
		$this->add_control(
			'icon_hover_color_option',
			[
				'label' => __( 'Icon Hover Color', 'theplus' ),
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
				'label_block' => false,
				'default' => 'solid',
			]
		);
		
		$this->add_control(
			'icon_hover_color',
			[
				'label' => __( 'Hover Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover .counter-icon-inner .counter-icon' => 'color: {{VALUE}}',
				],
				'condition' => [
					'icon_hover_color_option' => 'solid',
				],
				'separator' => 'after',
			]
		);
		$this->add_control(
			'plus_pro_icon_hover_color_option',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
				'condition' => [
					'icon_hover_color_option' => 'gradient',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'icon_hover_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover .counter-icon-inner',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'icon_border_hover_color',
			[
				'label' => __( 'Hover Border Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover .counter-icon-inner' => 'border-color: {{VALUE}}',
				],
				'separator' => 'before',
				'condition' => [
					'icon_style!' => ['hexagon','pentagon','square-rotate'],
				],
			]
		);
		$this->add_responsive_control(
			'icon__hover_border_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover .counter-icon-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'icon_style!' => ['hexagon','pentagon','square-rotate'],
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'icon_hover_box_shadow',
				'selector' => '{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover .counter-icon-inner',
				'condition' => [
					'icon_style!' => ['hexagon','pentagon','square-rotate'],
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();		
		$this->end_controls_section();		
		/*icon style*/
		/*icon Image*/
		$this->start_controls_section(
            'section_icon_image_styling',
            [
                'label' => __('Image Style', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition'   => [
					'icon_type'	=> 'image',
				],
            ]
        );
		$this->add_control(
            'image_width',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Image Width', 'theplus'),
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 2,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 100,
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .plus-number-counter .counter-image-inner' => 'max-width: {{SIZE}}{{UNIT}}',
				],
            ]
        );
		$this->end_controls_section();
		/*icon Image*/
		/*title style*/
		$this->start_controls_section(
            'section_title_styling',
            [
                'label' => __('Title Style', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .plus-number-counter .number-counter-inner-block .counter-title,{{WRAPPER}} .plus-number-counter .number-counter-inner-block .counter-title a',
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
				'label_block' => false,
				'default' => 'solid',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#313131',
				'selectors' => [
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block .counter-title,{{WRAPPER}} .plus-number-counter .number-counter-inner-block .counter-title a' => 'color: {{VALUE}}',
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
			'tab_title_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
			]
		);
		$this->add_control(
			'title_hover_color_option',
			[
				'label' => __( 'Title Hover Color', 'theplus' ),
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
				'label_block' => false,
				'default' => 'solid',
			]
		);
		$this->add_control(
			'title_hover_color',
			[
				'label' => __( 'Hover Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#3351a6',
				'selectors' => [
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover .counter-title,{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover .counter-title a' => 'color: {{VALUE}}',
				],
				'condition' => [
					'title_hover_color_option' => 'solid',
				],
			]
		);
		$this->add_control(
			'plus_pro_title_hover_color_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
				'condition' => [
					'title_hover_color_option' => 'gradient',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
            'title_top_space',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Title Top Space', 'theplus'),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'step' => 2,
						'min' => -150,
						'max' => 150,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'render_type' => 'ui',
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block .counter-title' => 'margin-top : {{SIZE}}{{UNIT}}',
				],
            ]
        );
		$this->add_control(
            'title_btm_space',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Title Bottom Space', 'theplus'),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'step' => 2,
						'min' => -150,
						'max' => 150,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block .counter-title' => 'margin-bottom : {{SIZE}}{{UNIT}}',
				],
            ]
        );
		
		$this->end_controls_section();
		/*title style*/
		/* digits */
		$this->start_controls_section(
				'section_digit_option',
				[
					'label' => __('Digit Style', 'theplus'),
					'tab' => Controls_Manager::TAB_STYLE,
				]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'digit_typography',
				'label' => __( 'Digit Typography', 'theplus' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				
			'selector' => '{{WRAPPER}} .plus-number-counter .number-counter-inner-block .counter-number',
	       ]
		);
		$this->add_control(
			'style_color',
			[
				'label' => __( 'Digit Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block .counter-number' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'style_hover_color',
			[
				'label' => __( 'Digit Hover Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover .counter-number' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
            'number_top_space',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Number Top Space', 'theplus'),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'step' => 2,
						'min' => -150,
						'max' => 150,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'render_type' => 'ui',
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block .counter-number' => 'margin-top : {{SIZE}}{{UNIT}}',
				],
            ]
        );
       $this->end_controls_section();
	    /* digits */
		/*background option*/
		$this->start_controls_section(
            'section_bg_option_styling',
            [
                'label' => __('Background Options', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
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
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		
		$this->add_control(
			'background_options',
			[
				'label' => __( 'Background Options', 'theplus' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
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
				'selector'  => '{{WRAPPER}} .plus-number-counter .number-counter-inner-block',
				
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
				'name'      => 'box_hover_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();		
		$this->end_controls_section();
		/*background option*/
		/*Extra options*/
		$this->start_controls_section(
            'section_extra_option_styling',
            [
                'label' => __('Extra Options', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_responsive_control(
			'box_padding',
			[
				'label' => __( 'Box Padding', 'theplus' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'default' =>[
					'top' => '15',
					'right' => '15',
					'bottom' => '15',
					'left' => '15',
				],
				'selectors' => [
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'box_hover_effects',
			[
				'label'   => __( 'Box Hover Effects', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => theplus_get_content_hover_effect_options(),
				'separator' => 'before',
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
				'condition' => [
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
		$style = $settings['style'];
		$alignment = 'text-'.$settings['alignment'];
		
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
		
		//content Hover effect
		$hover_class  = $hover_attr = '';
		$hover_uniqid = uniqid('hover-effect');
		
		$box_hover_effects=$settings["box_hover_effects"];
		if ($box_hover_effects == "push") {
			$hover_class .= 'content_hover_push';
		}
		
		//url
		$icon_link_a=$icon_link_a_close='';
		if ( ! empty( $settings['url_link']['url'] ) ) {
			$this->add_render_attribute( 'url_link', 'href', $settings['url_link']['url'] );
			if ( $settings['url_link']['is_external'] ) {
				$this->add_render_attribute( 'url_link', 'target', '_blank' );
			}
			if ( $settings['url_link']['nofollow'] ) {
				$this->add_render_attribute( 'url_link', 'rel', 'nofollow' );
			}
			$icon_link_a= '<a '.$this->get_render_attribute_string( "url_link" ).'">';
			$icon_link_a_close= '</a>';
		}
		
		//Symbol and Number
		$min_number = $settings['min_number'];
		$max_number = $settings['max_number'];
		$symbol = $settings['symbol'];
		$delay_number = $settings['delay_number']["size"];
		$increment_number = $settings['increment_number']["size"];
		$symbol_position = $settings['symbol_position'];
		if(!empty($symbol)) {
		  if($symbol_position=="after"){
				$number_symbol = '<span class="counter-number-inner numscroller" data-min="'.esc_attr($min_number).'" data-max="'.esc_attr($max_number).'" data-delay="'.esc_attr($delay_number).'" data-increment="'.esc_attr($increment_number).'">'.esc_html($min_number).'</span><span>'.esc_html($symbol).'</span>';
			}elseif($symbol_position=="before"){
				$number_symbol = '<span>'.esc_html($symbol).'</span><span class="counter-number-inner numscroller"  data-min="'.esc_attr($min_number).'" data-max="'.esc_attr($max_number).'" data-delay="'.esc_attr($delay_number).'" data-increment="'.esc_attr($increment_number).'">'.esc_html($min_number).'</span>';
			}
		} else {
			$number_symbol = '<span class="counter-number-inner numscroller" data-min="'.esc_attr($min_number).'" data-max="'.esc_attr($max_number).'" data-delay="'.esc_attr($delay_number).'" data-increment="'.esc_attr($increment_number).'">'.esc_html($min_number).'</span>';
		}
		
		//Icon
		$icon_img_ic ='';
		if($settings["icon_type"] =="image" && !empty($settings["icon_image"]["url"])){
			$icon_img_ic .='<div class="counter-image-inner">';
					$icon_img_ic .='<img class="counter-icon-image" src='.esc_url($settings["icon_image"]["url"]).' alt="" />';
			$icon_img_ic .='</div>';
		}else if($settings["icon_type"] =="icon"){
		
			if($settings["icon_font_style"]=='font_awesome'){
				$icons = $settings["icon_fontawesome"];
			}else{
				$icons = '';
			}			
			$icon_img_ic .='<div class="counter-icon-inner shape-icon-'.esc_attr($settings["icon_style"]).'">';
					$icon_img_ic .='<span class="counter-icon '.$icons.'"></span>';
			$icon_img_ic .='</div>';
			
		}
		
		//Number
		$number_markup ='';
		if($settings['max_number']!= ''){
			$number_markup = '<h5 class="counter-number">'.$number_symbol.'</h5>';
		}
		//Title
		$title ='';
		if($settings['title']!= ''){
			$title = '<h6 class="counter-title">'.$icon_link_a.esc_html($settings['title']).$icon_link_a_close.'</h6>';
		}
		
		//Style
		$counter_content = '<div class="number-counter-inner-block">';
			if($style == 'style-1'){
					$counter_content .='<div class="counter-wrap-content" >';
						$counter_content .= $icon_link_a.$icon_img_ic.$icon_link_a_close;
						$counter_content .= $number_markup;
						$counter_content .= $title;
					$counter_content .= '</div>';
			}else{
				$counter_content .='<div class="counter-wrap-content" >'.$number_markup.' '.$title.' </div>';
			}
		$counter_content .= '</div>';
		
		$uid=uniqid('counter');
		$icon_counter  = '<div class=" content_hover_effect ' . esc_attr($hover_class) . '" ' . $hover_attr . '>';
			$icon_counter .='<div class="plus-number-counter counter-'.esc_attr($style).' '.esc_attr($uid).' '.$animated_class.'" data-id="'.esc_attr($uid).'" '.$animation_attr.'>';
					$icon_counter .= $counter_content;
			$icon_counter .='</div>';
		$icon_counter .='</div>';
		
		echo $icon_counter;
	}
	
    protected function content_template() {
	
    }

}
