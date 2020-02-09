<?php
/*
Widget Name: Heading Title 
Description: Creative Heading Options.
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
use Elementor\Group_Control_Text_Shadow;


if (!defined('ABSPATH'))
    exit; // Exit if accessed directly


class Theplus_Ele_Heading_Title extends Widget_Base {
		
	public function get_name() {
		return 'tp-heading-title';
	}

    public function get_title() {
        return __('Heading Title', 'theplus');
    }

    public function get_icon() {
        return 'fa fa-header theplus_backend_icon';
    }

    public function get_categories() {
        return array('plus-essential');
    }
	protected function _register_controls() {
		/*tab Layout */
		$this->start_controls_section(
			'heading_title_layout_section',
			[
				'label' => __( 'Content', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
            'heading_style', [
                'type' => Controls_Manager::SELECT,
                'label' => __('Style', 'theplus'),
                'default' => 'style_1',
                'options' => [
                    'style_1' => __('Modern', 'theplus'),
                    'style_2' => __('Simple', 'theplus'),
                    'style_4' => __('Classic', 'theplus'),
                    'style_5' => __('Double Border', 'theplus'),
                    'style_6' => __('Vertical Border (Pro)', 'theplus'),
                    'style_7' => __('Dashing Dots', 'theplus'),
                    'style_8' => __('Unique', 'theplus'),
                    'style_9' => __('Stylish', 'theplus'),
                ],
            ]
        );
		$this->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Heading Title', 'theplus'),
                'label_block' => true,
                'default' => __('Heading', 'theplus'),
				'condition'    => [
					'heading_style!' => 'style_6',
				],
            ]
        );
		$this->add_control(
            'sub_title',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Sub Title', 'theplus'),
                'label_block' => true,
                'separator' => 'before',
                'default' => __('Sub Title', 'theplus'),
				'condition'    => [
					'heading_style!' => 'style_6',
				],
            ]
        );
		$this->add_control(
            'title_s',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Extra Title', 'theplus'),
                'label_block' => true,
                'separator' => 'before',
                'default' => __('Title', 'theplus'),
				'condition'    => [
					'heading_style!' => 'style_6',
				],
            ]
        );
		$this->add_control(
            'heading_s_style', [
                'type' => Controls_Manager::SELECT,
                'label' => __('Extra Title Position', 'theplus'),
                'default' => 'text_after',
                'options' => [
                    'text_after' => __('Prefix', 'theplus'),
                    'text_before' => __('Postfix', 'theplus'),
                ],
				'condition'    => [
					'heading_style!' => 'style_6',
				],
            ]
        );
		$this->add_responsive_control(
			'sub_title_align',
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
					'justify' => [
						'title' => __( 'Justify', 'theplus' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'prefix_class' => 'text-%s',
				'default' => 'center',
				 'separator' => 'before',
				'condition'    => [
					'heading_style!' => 'style_6',
				],
			]
		);
		$this->add_control(
			'plus_pro_heading_style_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
				'condition'    => [
					'heading_style' => 'style_6',
				],
			]
		);
		$this->end_controls_section();
		/*tab style/Layout*/		
		
		/*tab style*/
		$this->start_controls_section(
            'section_styling',
            [
                'label' => __('Separator Settings', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition'    => [
					'heading_style!' => ['style_1','style_2','style_8'],
				],
            ]
        );
		$this->add_control(
            'double_color',
            [
                'label' => __('Color', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => '#4d4d4d',
                'selectors' => [
                    '{{WRAPPER}} .heading.style-5 .heading-title:before,{{WRAPPER}} .heading.style-5 .heading-title:after' => 'background: {{VALUE}};',
                ],
				'condition'    => [
					'heading_style' => 'style_5',
				],
            ]
        );
		$this->add_control(
            'double_top',
			[
				'label' => __( 'Top Separator Height', 'theplus' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'min' => -50,
				'step' => 1,
				'default' => 6,
				'condition'    => [
					'heading_style' => 'style_5',
				],
				'selectors' => [
                    '{{WRAPPER}} .heading.style-5 .heading-title:before' => 'height: {{VALUE}}px;',
                ],
				
			]
        );
		$this->add_control(
            'double_bottom',
			[
				'label' => __( 'Bottom Separator Height', 'theplus' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'min' => -50,
				'step' => 1,
				'default' => 2,
				'condition'    => [
					'heading_style' => 'style_5',
				],
				'selectors' => [
                    '{{WRAPPER}} .heading.style-5 .heading-title:after' => 'height: {{VALUE}}px;',
                ],
				
			]
        );
		$this->add_control(
			'sep_img',
			[
				'label' => __( 'Separator With Image', 'theplus' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => '',
				],
				'condition'    => [
					'heading_style' => 'style_4',
				],
			]
		);
		$this->add_control(
            'sep_clr',
            [
                'label' => __('Separator Color', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => '#4099c3',
                'selectors' => [
                    '{{WRAPPER}} .heading .title-sep' => 'border-color: {{VALUE}};',
                ],
				'condition'    => [
					'heading_style' => ['style_4','style_9'],
				],
            ]
        );
		$this->add_control(
            'sep_width',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Separator Width', 'theplus'),
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'range' => [
					'' => [
						'min' => 0,
						'max' => 100,
						'step' => 2,
					],
				],
				'render_type' => 'ui',
				'selectors' => [
                    '{{WRAPPER}} .heading .title-sep,{{WRAPPER}} .heading .seprator' => 'width: {{SIZE}}{{UNIT}};',
                ],
				'condition'    => [
					'heading_style' => ['style_4','style_9'],
				],
            ]
        );
		$this->add_control(
            'dot_color',
            [
                'label' => __('Separator Dot Color', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ca2b2b',
                'selectors' => [
					'{{WRAPPER}} .heading .sep-dot' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .heading.style-7 .head-title:after' => 'color: {{VALUE}}; text-shadow: 15px 0 {{VALUE}}, -15px 0 {{VALUE}};',
                ],
				'condition'    => [
					'heading_style' => ['style_7','style_9'],
				],
            ]
        );
		$this->add_control(
            'sep_height',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Separator Height', 'theplus'),
				'size_units' => [ 'px' ],
				'default' => [
					'unit' => 'px',
					'size' => 2,
				],
				'range' => [
					'' => [
						'min' => 0,
						'max' => 10,
						'step' => 1,
					],
				],
				'render_type' => 'ui',
				'selectors' => [
                    '{{WRAPPER}} .heading .title-sep' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
				'condition'    => [
					'heading_style' => 'style_4',
				],
            ]
        );
		$this->end_controls_section();
		/*tab style*/
		/*tab Main Title Style*/
		$this->start_controls_section(
            'section_title_styling',
            [
                'label' => __('Main Title', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
            'title_h', [
                'type' => Controls_Manager::SELECT,
                'label' => __('Title Tag', 'theplus'),
                'default' => 'h2',
                'options' => theplus_get_tags_options(),
            ]
        );
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Title Typography', 'theplus'),
                'selector' => '{{WRAPPER}} .heading .heading-title',
            ]
        );
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'theplus' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'solid' => [
						'title' => __( 'Solid', 'theplus' ),
						'icon' => 'fa fa-paint-brush',
					],
					'gradient' => [
						'title' => __( 'Gradient', 'theplus' ),
						'icon' => 'fa fa-barcode',
					],
				],
				'label_block' => false,
				'default' => 'solid',
				'toggle' => true,
			]
		);
		$this->add_control(
			'title_solid_color',
			[
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .heading .heading-title' => 'color: {{VALUE}};',
				],
				'default' => '#313131',
				'condition'    => [
					'title_color' => ['solid'],
				],
			]
		);
		$this->add_control(
            'title_gradient_color1',
            [
                'label' => __('Color 1', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => 'orange',
				'condition'    => [
					'title_color' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'title_gradient_color1_control',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Color 1 Location', 'theplus'),
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => 0,
				],
				'render_type' => 'ui',
				'condition'    => [
					'title_color' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'title_gradient_color2',
            [
                'label' => __('Color 2', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => 'cyan',
				'condition'    => [
					'title_color' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'title_gradient_color2_control',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Color 2 Location', 'theplus'),
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'render_type' => 'ui',
				'condition'    => [
					'title_color' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'title_gradient_style', [
                'type' => Controls_Manager::SELECT,
                'label' => __('Gradient Style', 'theplus'),
                'default' => 'linear',
                'options' => theplus_get_gradient_styles(),
				'condition'    => [
					'title_color' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'title_gradient_angle', [
				'type' => Controls_Manager::SLIDER,
				'label' => __('Gradient Angle', 'theplus'),
				'size_units' => [ 'deg' ],
				'default' => [
					'unit' => 'deg',
					'size' => 180,
				],
				'range' => [
					'deg' => [
						'step' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .heading .heading-title' => 'background-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{title_gradient_color1.VALUE}} {{title_gradient_color1_control.SIZE}}{{title_gradient_color1_control.UNIT}}, {{title_gradient_color2.VALUE}} {{title_gradient_color2_control.SIZE}}{{title_gradient_color2_control.UNIT}})',
				],
				'condition'    => [
					'title_color' => ['gradient'],
					'title_gradient_style' => ['linear']
				],
				'of_type' => 'gradient',
			]
        );
		$this->add_control(
            'title_gradient_position', [
				'type' => Controls_Manager::SELECT,
				'label' => __('Position', 'theplus'),
				'options' => theplus_get_position_options(),
				'default' => 'center center',
				'selectors' => [
					'{{WRAPPER}} .heading .heading-title' => 'background-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{title_gradient_color1.VALUE}} {{title_gradient_color1_control.SIZE}}{{title_gradient_color1_control.UNIT}}, {{title_gradient_color2.VALUE}} {{title_gradient_color2_control.SIZE}}{{title_gradient_color2_control.UNIT}})',
				],
				'condition' => [
					'title_color' => [ 'gradient' ],
					'title_gradient_style' => 'radial',
				],
				'of_type' => 'gradient',
			]
        );
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selectors' => '{{WRAPPER}} .heading .heading-title',
				'separator' => 'before',
			]
		);
		$this->add_control(
            'special_effect',
            [
				'label'   => esc_html__( 'Special Effect', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'separator' => 'before',
				'condition' => [
					'heading_style' => [ 'style_1','style_2','style_8' ],
				],
			]			
		);
		$this->end_controls_section();
		/*tab Title Style*/
		/*tab Sub Title Style*/
		$this->start_controls_section(
            'section_sub_title_styling',
            [
                'label' => __('Sub Title', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
            'sub_title_tag', [
                'type' => Controls_Manager::SELECT,
                'label' => __('Subtitle Tag', 'theplus'),
                'default' => 'h3',
                'options' => theplus_get_tags_options(),
            ]
        );
		
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sub_title_typography',
                'label' => __('Typography', 'theplus'),
                'selector' => '{{WRAPPER}} .heading .heading-sub-title',
            ]
        );
		$this->add_control(
			'sub_title_color',
			[
				'label' => __( 'Subtitle Title Color', 'theplus' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'solid' => [
						'title' => __( 'Solid', 'theplus' ),
						'icon' => 'fa fa-paint-brush',
					],
					'gradient' => [
						'title' => __( 'Gradient', 'theplus' ),
						'icon' => 'fa fa-barcode',
					],
				],
				'label_block' => false,
				'default' => 'solid',
				'toggle' => true,
			]
		);
		$this->add_control(
			'sub_title_solid_color',
			[
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .heading .heading-sub-title' => 'color: {{VALUE}};',
				],
				'default' => '#313131',
				'condition'    => [
					'sub_title_color' => ['solid'],
				],
			]
		);
		$this->add_control(
            'sub_title_gradient_color1',
            [
                'label' => __('Color 1', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => 'orange',
				'condition'    => [
					'sub_title_color' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'sub_title_gradient_color1_control',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Color 1 Location', 'theplus'),
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => 0,
				],
				'render_type' => 'ui',
				'condition'    => [
					'sub_title_color' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'sub_title_gradient_color2',
            [
                'label' => __('Color 2', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => 'cyan',
				'condition'    => [
					'sub_title_color' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'sub_title_gradient_color2_control',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Color 2 Location', 'theplus'),
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'render_type' => 'ui',
				'condition'    => [
					'sub_title_color' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'sub_title_gradient_style', [
                'type' => Controls_Manager::SELECT,
                'label' => __('Gradient Style', 'theplus'),
                'default' => 'linear',
                'options' => theplus_get_gradient_styles(),
				'condition'    => [
					'sub_title_color' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'sub_title_gradient_angle', [
				'type' => Controls_Manager::SLIDER,
				'label' => __('Gradient Angle', 'theplus'),
				'size_units' => [ 'deg' ],
				'default' => [
					'unit' => 'deg',
					'size' => 180,
				],
				'range' => [
					'deg' => [
						'step' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .heading .heading-sub-title' => 'background-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{sub_title_gradient_color1.VALUE}} {{sub_title_gradient_color1_control.SIZE}}{{sub_title_gradient_color1_control.UNIT}}, {{sub_title_gradient_color2.VALUE}} {{sub_title_gradient_color2_control.SIZE}}{{sub_title_gradient_color2_control.UNIT}})',
				],
				'condition'    => [
					'sub_title_color' => ['gradient'],
					'sub_title_gradient_style' => ['linear']
				],
				'of_type' => 'gradient',
			]
        );
		$this->add_control(
            'sub_title_gradient_position', [
				'type' => Controls_Manager::SELECT,
				'label' => __('Position', 'theplus'),
				'options' => theplus_get_position_options(),
				'default' => 'center center',
				'selectors' => [
					'{{WRAPPER}} .heading .heading-sub-title' => 'background-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{sub_title_gradient_color1.VALUE}} {{sub_title_gradient_color1_control.SIZE}}{{sub_title_gradient_color1_control.UNIT}}, {{sub_title_gradient_color2.VALUE}} {{sub_title_gradient_color2_control.SIZE}}{{sub_title_gradient_color2_control.UNIT}})',
				],
				'condition' => [
					'sub_title_color' => [ 'gradient' ],
					'sub_title_gradient_style' => 'radial',
				],
				'of_type' => 'gradient',
			]
        );
		$this->end_controls_section();
		/*tab Extra Title Style*/
		/*tab Ex Title Style*/
		$this->start_controls_section(
            'section_extra_title_styling',
            [
                'label' => __('Extra Title', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition'    => [
					'heading_style' => 'style_1',
				],
            ]
        );
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ex_title_typography',
                'label' => __('Typography', 'theplus'),
                'selector' => '{{WRAPPER}} .heading .title-s',
            ]
        );
		$this->add_control(
			'ex_title_color',
			[
				'label' => __( 'Extra Title Color', 'theplus' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'solid' => [
						'title' => __( 'Solid', 'theplus' ),
						'icon' => 'fa fa-paint-brush',
					],
					'gradient' => [
						'title' => __( 'Gradient', 'theplus' ),
						'icon' => 'fa fa-barcode',
					],
				],
				'label_block' => false,
				'default' => 'solid',
				'toggle' => true,
			]
		);
		$this->add_control(
			'ex_title_solid_color',
			[
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .heading .title-s' => 'color: {{VALUE}};',
				],
				'default' => '#313131',
				'condition'    => [
					'ex_title_color' => ['solid'],
				],
			]
		);
		$this->add_control(
            'ex_title_gradient_color1',
            [
                'label' => __('Color 1', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => 'orange',
				'condition'    => [
					'ex_title_color' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'ex_title_gradient_color1_control',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Color 1 Location', 'theplus'),
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => 0,
				],
				'render_type' => 'ui',
				'condition'    => [
					'ex_title_color' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'ex_title_gradient_color2',
            [
                'label' => __('Color 2', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => 'cyan',
				'condition'    => [
					'ex_title_color' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'ex_title_gradient_color2_control',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Color 2 Location', 'theplus'),
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'render_type' => 'ui',
				'condition'    => [
					'ex_title_color' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'ex_title_gradient_style', [
                'type' => Controls_Manager::SELECT,
                'label' => __('Gradient Style', 'theplus'),
                'default' => 'linear',
                'options' => theplus_get_gradient_styles(),
				'condition'    => [
					'ex_title_color' => 'gradient',
					],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'ex_title_gradient_angle', [
				'type' => Controls_Manager::SLIDER,
				'label' => __('Gradient Angle', 'theplus'),
				'size_units' => [ 'deg' ],
				'default' => [
					'unit' => 'deg',
					'size' => 180,
				],
				'range' => [
					'deg' => [
						'step' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .heading .title-s' => 'background-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{ex_title_gradient_color1.VALUE}} {{ex_title_gradient_color1_control.SIZE}}{{ex_title_gradient_color1_control.UNIT}}, {{ex_title_gradient_color2.VALUE}} {{ex_title_gradient_color2_control.SIZE}}{{ex_title_gradient_color2_control.UNIT}})',
				],
				'condition'    => [
					'ex_title_color' => ['gradient'],
					'ex_title_gradient_style' => ['linear']
				],
				'of_type' => 'gradient',
			]
        );
		$this->add_control(
            'ex_title_gradient_position', [
				'type' => Controls_Manager::SELECT,
				'label' => __('Position', 'theplus'),
				'options' => theplus_get_position_options(),
				'default' => 'center center',
				'selectors' => [
					'{{WRAPPER}} .heading .title-s' => 'background-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{ex_title_gradient_color1.VALUE}} {{ex_title_gradient_color1_control.SIZE}}{{ex_title_gradient_color1_control.UNIT}}, {{ex_title_gradient_color2.VALUE}} {{ex_title_gradient_color2_control.SIZE}}{{ex_title_gradient_color2_control.UNIT}})',
				],
				'condition' => [
					'ex_title_color' => [ 'gradient' ],
					'ex_title_gradient_style' => 'radial',
				],
				'of_type' => 'gradient',
			]
        );
		$this->end_controls_section();
		/*tab Extra Title Style*/
		
		
		/*tab Setting option*/
		$this->start_controls_section(
            'section_settings_option_styling',
            [
                'label' => __('Advanced', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		
		$this->add_control(
            'position',
            [
				'type' => Controls_Manager::SELECT,
				'label' => __('Title Position', 'theplus'),
				'default' => 'after',
				'options' => [
					'before' => __('Before Title', 'theplus'),
					'after' => __('After Title', 'theplus'),
				],
			]
		);
		$this->end_controls_section();
		/*tab Extra Title Style*/
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
		$heading_style=$settings["heading_style"];
		
		$imgSrc=$sub_gradient_cass =$title_s_gradient_cass =$title_gradient_cass ='';
		if(!empty($settings["sep_img"]["url"])){			
			$imgSrc = $settings["sep_img"]["url"];
		}
		
		if($settings["title_color"] == "gradient") {
			$title_gradient_cass = 'heading-title-gradient';
		}
		if($settings["ex_title_color"] == "gradient") {
			$title_s_gradient_cass = 'heading-title-gradient';
		}
		if($settings["sub_title_color"] == "gradient") {
			$sub_gradient_cass = 'heading-title-gradient';
		}
			
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
			
			$style_class='';
			if($heading_style =="style_1"){
				$style_class = 'style-1';
			}else if($heading_style =="style_2"){
				$style_class = 'style-2';
			}else if($heading_style =="style_4"){
				$style_class = 'style-4';
			}else if($heading_style =="style_5"){
				$style_class = 'style-5';
			}else if($heading_style =="style_7"){
				$style_class = 'style-7';
			}else if($heading_style =="style_8"){
				$style_class = 'style-8';
			}else if($heading_style =="style_9"){
				$style_class = 'style-9';
			}else if($heading_style =="style_10"){
				$style_class = 'style-10';
			}else if($heading_style =="style_11"){
				$style_class = 'style-11';
			}
			
			$uid=uniqid('heading_style');
			
			$heading ='<div class="heading heading_style '.esc_attr($uid).' '.esc_attr($style_class).' '.$animated_class.'" '.$animation_attr.'>';
			
				$heading .='<div class="sub-style" >';

					$title_con= $s_title_con = $title_s_before ='';
					
					if($heading_style =="style_1" ){
									$title_s_before .='<span class="title-s '.$title_s_gradient_cass.'"> '.$settings["title_s"].' </span>';
					}
						
						if(!empty($settings["title"])){
						
							$reveal_effects=$effect_attr='';
							if ($heading_style =="style_1" || $heading_style =="style_2" || $heading_style =="style_8"){
								if(!empty($settings["special_effect"]) && $settings["special_effect"]=='yes'){
									$effect_rand_no =uniqid('reveal');
									$effect_attr .=' data-reveal-id="'.esc_attr($effect_rand_no).'" ';
									$effect_attr .=' data-effect-color-1="'.esc_attr($settings["overlay_spcial_effect_color_1"]).'" ';
									$effect_attr .=' data-effect-color-2="'.esc_attr($settings["overlay_spcial_effect_color_2"]).'" ';
									$reveal_effects=' pt-plus-reveal '.esc_attr($effect_rand_no).' ';
								}
							}
							$title_con ='<div class="head-title" > ';
								$title_con .='<'.esc_attr($settings["title_h"]).' class="heading-title '.esc_attr($reveal_effects).' '.esc_attr($title_gradient_cass).'" '.$effect_attr.'  data-hover="'.esc_attr($settings["title"]).'">';
								if($settings["heading_s_style"]=="text_before"){
									$title_con.= $title_s_before.$settings["title"];
								}else{
									$title_con.= $settings["title"].$title_s_before;
								}
								$title_con .='</'.esc_attr($settings["title_h"]).'>';

								if ($heading_style =="style_4" || $heading_style =="style_9"){
									$title_con .='<div class="seprator sep-l" >';
									$title_con .='<span class="title-sep sep-l" ></span>';
									if ($heading_style =="style_9" ){
										$title_con .='<div class="sep-dot">.</div>';
									}else{	
									  if($imgSrc !=''){  
										$title_con .='<div class="sep-mg"><img src="'.esc_url($imgSrc).'" /></div>';
									  }
									}
									$title_con .='<span class="title-sep sep-r" ></span>';
									$title_con .='</div>';
								}
							$title_con .='</div>';
						}
						if($settings["sub_title"] !=""){
							$s_title_con ='<div class="sub-heading">';
							$s_title_con .='<'.esc_attr($settings["sub_title_tag"]).' class="heading-sub-title '.esc_attr($mobile_center).' '.$sub_gradient_cass.'"> '.$settings["sub_title"].' </'.esc_attr($settings["sub_title_tag"]).'>';
							$s_title_con .='</div>';
						}
						if($settings["position"] =="before"){
							$heading.= $s_title_con.$title_con;
							
						}if($settings["position"] =="after"){
							$heading.= $title_con.$s_title_con;
						}
				
				$heading.='</div>';
			$heading.='</div>';

		echo $heading;
	}
    protected function content_template() {
	
    }

}
