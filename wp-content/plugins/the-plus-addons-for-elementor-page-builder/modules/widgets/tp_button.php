<?php 
/*
Widget Name: Button
Description: creative of button style.
Author: Theplus
Author URI: http://posimyththemes.com
*/
namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Box_Shadow;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly


class ThePlus_Button extends Widget_Base {
		
	public function get_name() {
		return 'tp-button';
	}

    public function get_title() {
        return __('TP Button', 'theplus');
    }

    public function get_icon() {
        return 'fa fa-link theplus_backend_icon';
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
				'label' => __( 'Content', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
            'button_style', [
                'type' => Controls_Manager::SELECT,
                'label' => __('Button Style', 'theplus'),
                'default' => 'style-4',
                'options' => [
                    'style-1' => __('Style 1 (PRO)', 'theplus'),
                    'style-2' => __('Style 2 (PRO)', 'theplus'),
                    'style-3' => __('Style 3 (PRO)', 'theplus'),
                    'style-4' => __('Style 4', 'theplus'),
                    'style-5' => __('Style 5 (PRO)', 'theplus'),
                    'style-6' => __('Style 6 (PRO)', 'theplus'),
                    'style-7' => __('Style 7 (PRO)', 'theplus'),
					'style-8' => __('Style 8', 'theplus'),
					'style-9' => __('Style 9 (PRO)', 'theplus'),
					'style-10' => __('Style 10 (PRO)', 'theplus'),
					'style-11' => __('Style 11', 'theplus'),
					'style-12' => __('Style 12', 'theplus'),
					'style-13' => __('Style 13', 'theplus'),
					'style-14' => __('Style 14 (PRO)', 'theplus'),
					'style-15' => __('Style 15 (PRO)', 'theplus'),
					'style-16' => __('Style 16 (PRO)', 'theplus'),
					'style-17' => __('Style 17 (PRO)', 'theplus'),
					'style-18' => __('Style 18 (PRO)', 'theplus'),
					'style-19' => __('Style 19 (PRO)', 'theplus'),
					'style-20' => __('Style 20', 'theplus'),
					'style-21' => __('Style 21', 'theplus'),
					'style-22' => __('Style 22 (PRO)', 'theplus'),
                ],
            ]
        );
		$this->add_control(
			'button_text',
			[
				'label' => __( 'Text', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'Read More', 'theplus' ),
				'placeholder' => __( 'Read More', 'theplus' ),
				'condition'    => [
					'button_style' => [ 'style-4','style-8','style-11','style-12','style-13','style-20','style-21'],
				],
			]
		);
		$this->add_control(
			'button_hover_text',
			[
				'label' => __( 'Hover Text', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'Click Here', 'theplus' ),
				'placeholder' => __( 'Click Here', 'theplus' ),
				'condition' => [
					'button_style' => ['style-4','style-11'],
				],
			]
		);
		$this->add_control(
			'button_link',
			[
				'label' => __( 'Link', 'theplus' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'separator' => 'before',
				'placeholder' => __( 'https://www.demo-link.com', 'theplus' ),
				'default' => [
					'url' => '#',
				],
				'condition'    => [
					'button_style' => [ 'style-4','style-8','style-11','style-12','style-13','style-20','style-21'],
				],
			]
		);	
		$this->add_control(
			'plus_pro_social_style_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
				'condition'    => [
					'button_style!' => [ 'style-4','style-8','style-11','style-12','style-13','style-20','style-21'],
				],
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
            'section_button_styling',
            [
                'label' => __('Layout', 'theplus'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
		$this->add_responsive_control(
			'button_align',
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
			]
		);
				
		$this->add_control(
            'btn_hover_style', [
                'type' => Controls_Manager::SELECT,
                'label' => __('Button Style', 'theplus'),
                'default' => 'hover-left',
                'options' => [
                    'hover-left' => __('On Left', 'theplus'),
                    'hover-right' => __('On Right', 'theplus'),
                    'hover-top' => __('On Top', 'theplus'),
                    'hover-bottom' => __('On Bottom', 'theplus'),
                ],
				'condition' => [
					'button_style' => ['style-11','style-13'],
				],
            ]
        );
		$this->end_controls_section();
		$this->start_controls_section(
            'section_button_icon_styling',
            [
                'label' => __('Icon Settings', 'theplus'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
		$this->add_control(
			'button_icon_style',
			[
				'label' => __( 'Icon Font', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'font_awesome',
				'options' => [
					'font_awesome'  => __( 'Font Awesome', 'theplus' ),
					'icon_mind' => __( 'Icons Mind (PRO)', 'theplus' ),
				],
				'condition' => [
					'button_style!' => ['style-3','style-6','style-7','style-9'],
				],
			]
		);
		$this->add_control(
			'button_icon',
			[
				'label' => __( 'Icon', 'theplus' ),
				'type' => Controls_Manager::ICON,
				'label_block' => true,
				'default' => 'fa fa-chevron-right',
				'condition' => [
					'button_style!' => ['style-3','style-6','style-7','style-9'],
					'button_icon_style' => 'font_awesome',
				],
			]
		);
		$this->add_control(
			'plus_pro_button_icons_mind_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
				'condition' => [
					'button_style!' => ['style-3','style-6','style-7','style-9'],
					'button_icon_style' => 'icon_mind',
				],
			]
		);
		$this->add_control(
			'before_after',
			[
				'label' => __( 'Icon Position', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'after',
				'options' => [
					'after' => __( 'After', 'theplus' ),
					'before' => __( 'Before', 'theplus' ),
				],
				'condition' => [
					'button_style!' => ['style-3','style-6','style-7','style-9','style-17'],
					'button_icon_style!' => '',
				],
			]
		);
		$this->add_control(
			'icon_spacing',
			[
				'label' => __( 'Icon Spacing', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'condition' => [
					'button_style!' => ['style-3','style-6','style-7','style-9','style-17'],
					'button_icon_style!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .button-link-wrap i.button-after' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .button-link-wrap i.button-before' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .pt_plus_button.button-style-22 .button-link-wrap .btn-icon.button-before' => 'padding-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .pt_plus_button.button-style-22 .button-link-wrap .btn-icon.button-after' => 'padding-right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 200,
					],
				],
				'separator' => 'before',
				'condition' => [
					'button_style!' => ['style-3','style-6','style-7','style-9','style-17'],
					'button_icon_style!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .button-link-wrap i.btn-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
            'section_styling',
            [
                'label' => __('Typography and Cosmetics', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );		
		$this->add_responsive_control(
			'button_padding',
			[
				'label' => __( 'Padding', 'theplus' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
							'top' => '15',
							'right' => '30',
							'bottom' => '15',
							'left' => '30',
							'isLinked' => false 
				],
				'selectors' => [
					'{{WRAPPER}} .pt_plus_button:not(.button-style-11):not(.button-style-17) .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap > span,{{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap::before,.pt_plus_button.button-style-17 .button-link-wrap > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .pt_plus_button .button-link-wrap',
			]
		);
		
		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
			]
		);
		
		$this->add_control(
			'btn_text_color',
			[
				'label' => __( 'Text Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pt_plus_button .button-link-wrap' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'button_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .pt_plus_button.button-style-4 .button-link-wrap,
								{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap,
								{{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap,
								{{WRAPPER}} .pt_plus_button.button-style-20 .button-link-wrap,
								{{WRAPPER}} .pt_plus_button.button-style-21 .button-link-wrap',				
				'condition' => [
					'button_style' => ['style-4','style-8','style-11','style-20','style-21'],
				],
			]
		);
		$this->add_control(
			'button_border_style',
			[
				'label'   => __( 'Border Style', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => [
					'none'   => __( 'None', 'theplus' ),
					'solid'  => __( 'Solid', 'theplus' ),
					'dotted' => __( 'Dotted', 'theplus' ),
					'dashed' => __( 'Dashed', 'theplus' ),
					'groove' => __( 'Groove', 'theplus' ),
				],
				'selectors'  => [
					'{{WRAPPER}} .pt_plus_button.button-style-4 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-12 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-13 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-20 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-21 .button-link-wrap' => 'border-style: {{VALUE}};',
				],
				'separator' => 'before',
				'condition' => [
					'button_style' => ['style-4','style-8','style-11','style-12','style-13','style-20','style-21'],
				],
			]
		);

		$this->add_responsive_control(
			'button_border_width',
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
					'{{WRAPPER}} .pt_plus_button.button-style-4 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-12 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-13 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-20 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-21 .button-link-wrap' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'button_style' => ['style-4','style-8','style-11','style-12','style-13','style-20','style-21'],
					'button_border_style!' => 'none',
				]
			]
		);

		$this->add_control(
			'button_border_color',
			[
				'label'     => __( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => [
					'{{WRAPPER}} .pt_plus_button.button-style-4 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-12 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-13 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-20 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-21 .button-link-wrap' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .pt_plus_button.button-style-18 .button-link-wrap' => 'background: {{VALUE}};',
				],
				'condition' => [
					'button_style' => ['style-4','style-8','style-11','style-12','style-13','style-20','style-21'],
					'button_border_style!' => 'none'
				],
				]
		);

		$this->add_responsive_control(
			'button_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pt_plus_button.button-style-4 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-12 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-13 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-20 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-21 .button-link-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'button_style' => ['style-4','style-8','style-11','style-12','style-13','style-20','style-21'],
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_shadow',
				'selector' => '{{WRAPPER}} .pt_plus_button.button-style-4 .button-link-wrap,
							   {{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap,
							   {{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap,
							   {{WRAPPER}} .pt_plus_button.button-style-12 .button-link-wrap,
							   {{WRAPPER}} .pt_plus_button.button-style-13 .button-link-wrap,
							   {{WRAPPER}} .pt_plus_button.button-style-20 .button-link-wrap,
							   {{WRAPPER}} .pt_plus_button.button-style-21 .button-link-wrap',
				'condition' => [
					'button_style' => ['style-4','style-8','style-11','style-12','style-13','style-20','style-21'],
				],
			]
		);
		$this->add_control(
			'btn_bottom_border_color',
			[
				'label' => __( 'Border Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'button_style' => 'style-1',
				],
				'selectors' => [
					'{{WRAPPER}} .pt_plus_button .button-link-wrap .button_line' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
            'bottom_border_height',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Border Height', 'theplus'),
				'size_units' => [ 'px' ],
				'default' => [
					'unit' => 'px',
					'size' => 1,
				],
				'range' => [
					'px' => [
						'min'	=> 1,
						'max'	=> 20,
						'step' => 1,
					],
				],
				'render_type' => 'ui',
				'condition' => [
					'button_style' => 'style-1',
				],
				'selectors' => [
					'{{WRAPPER}} .pt_plus_button .button-link-wrap .button_line' => 'height: {{SIZE}}{{UNIT}};',
				],
            ]
        );
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
			]
		);
		$this->add_control(
			'btn_text_hover_color',
			[
				'label' => __( 'Text Hover Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pt_plus_button .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-22 .button-link-wrap .btn-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap::before' => 'color: {{VALUE}};',					
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'button_hover_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .pt_plus_button.button-style-4 .button-link-wrap::after,
								{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover,
								{{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap::before,
								{{WRAPPER}} .pt_plus_button.button-style-12 .button-link-wrap::before,
								{{WRAPPER}} .pt_plus_button.button-style-13 .button-link-wrap::before,{{WRAPPER}} .pt_plus_button.button-style-13 .button-link-wrap::after,
								{{WRAPPER}} .pt_plus_button.button-style-20 .button-link-wrap:after,
								{{WRAPPER}} .pt_plus_button.button-style-21 .button-link-wrap:after',
				'condition' => [
					'button_style' => ['style-4','style-8','style-11','style-12','style-13','style-20','style-21'],
				],
			]
		);
		$this->add_control(
			'button_border_hover_color',
			[
				'label'     => __( 'Hover Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => [
					'{{WRAPPER}} .pt_plus_button.button-style-4 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-12 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-13 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-20 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-21 .button-link-wrap:hover' => 'border-color: {{VALUE}};',					
				],
				'separator' => 'before',
				'condition' => [
					'button_style' => ['style-4','style-8','style-11','style-12','style-13','style-20','style-21'],
					'button_border_style!' => 'none'
				],
			]
		);

		$this->add_responsive_control(
			'button_hover_radius',
			[
				'label'      => __( 'Hover Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pt_plus_button.button-style-4 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-12 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-13 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-20 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-21 .button-link-wrap:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'button_style' => ['style-4','style-8','style-11','style-12','style-13','style-20','style-21'],
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_hover_shadow',
				'selector' => '{{WRAPPER}} .pt_plus_button.button-style-4 .button-link-wrap:hover,
							   {{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover,
							   {{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap:hover,
							   {{WRAPPER}} .pt_plus_button.button-style-12 .button-link-wrap:hover,
							   {{WRAPPER}} .pt_plus_button.button-style-13 .button-link-wrap:hover,
							   {{WRAPPER}} .pt_plus_button.button-style-20 .button-link-wrap:hover,
							   {{WRAPPER}} .pt_plus_button.button-style-21 .button-link-wrap:hover',
				'condition' => [
					'button_style' => ['style-4','style-8','style-11','style-12','style-13','style-20','style-21'],
				],
			]
		);
		$this->add_control(
			'btn_bottom_border_hover_color',
			[
				'label' => __( 'Border Hover Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'button_style' => 'style-1',
				],
				'selectors' => [
					'{{WRAPPER}} .pt_plus_button .button-link-wrap:hover .button_line' => 'background: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		
		$this->start_controls_section(
            'section_extra_effect_styling',
            [
                'label' => __('Special', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
			'btn_magic_scroll',
			[
				'label'        => esc_html__( 'Magic Scroll', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'theplus' ),
				'label_off'    => esc_html__( 'No', 'theplus' ),
				'render_type'  => 'template',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'plus_pro_magic_scroll_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
				'condition'    => [
					'btn_magic_scroll' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
			'plus_tooltip',
			[
				'label'        => esc_html__( 'Tooltip', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'theplus' ),
				'label_off'    => esc_html__( 'No', 'theplus' ),
				'render_type'  => 'template',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'plus_pro_tooltip_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
				'condition'    => [
					'plus_tooltip' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
            'btn_special_effect',
            [
				'label'   => esc_html__( 'Special Effect', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'plus_pro_overlay_effect_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
				'condition'    => [
					'btn_special_effect' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
			'plus_mouse_move_parallax',
			[
				'label'        => esc_html__( 'Mouse Move Parallax', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'theplus' ),
				'label_off'    => esc_html__( 'No', 'theplus' ),			
				'render_type'  => 'template',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'plus_pro_mouse_move_parallax_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
				'condition'    => [
					'plus_mouse_move_parallax' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
			'plus_continuous_animation',
			[
				'label'        => esc_html__( 'Continuous Animation', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'theplus' ),
				'label_off'    => esc_html__( 'No', 'theplus' ),					
				'render_type'  => 'template',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'plus_pro_continuous_animation_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
				'condition'    => [
					'plus_continuous_animation' => [ 'yes' ],
				],
			]
		);
		
		$this->add_control(
            'full_width_btn',
            [
				'label'   => esc_html__( 'Full-Width Button', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'btn_hover_effects',
			[
				'label'   => __( 'Button Hover Effects', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'separator' => 'before',
				'options' => theplus_get_content_hover_effect_options(),
			]
		);
		$this->end_controls_section();
		
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
		$full_button_width=$data_class=$button_hover_text='';
		
		
		$hover_class  = $hover_attr = '';
		$btn_hover_effects=$settings["btn_hover_effects"];
		if ($btn_hover_effects == "push") {
			$hover_class .= 'content_hover_push';
		}
		
		if ( ! empty( $settings['button_link']['url'] ) ) {
			$this->add_render_attribute( 'button', 'href', $settings['button_link']['url'] );
			if ( $settings['button_link']['is_external'] ) {
				$this->add_render_attribute( 'button', 'target', '_blank' );
			}
			if ( $settings['button_link']['nofollow'] ) {
				$this->add_render_attribute( 'button', 'rel', 'nofollow' );
			}
		}
			
		$this->add_render_attribute( 'button', 'class', 'button-link-wrap' );
		$this->add_render_attribute( 'button', 'role', 'button' );
		
			
		if(!empty($settings['button_hover_text'])){
			$this->add_render_attribute( 'button', 'data-hover', $settings['button_hover_text'] );
		}else{
			$this->add_render_attribute( 'button', 'data-hover', $settings['button_text'] );
		}
		$button_style = $settings['button_style'];
		$button_align=' text-'.$settings['button_align'];
		$button_align .=(!empty($settings['button_align_tablet'])) ? ' text--tablet'.$settings['button_align_tablet'] : '';
		$button_align .=(!empty($settings['button_align_mobile'])) ? ' text--mobile'.$settings['button_align_mobile'] : '';
		$btn_hover_style = $settings['btn_hover_style'];
		
		$button_text = $settings['button_text'];
		$button_hover_text = $settings['button_hover_text'];
		$uid=uniqid('btn');
		$data_class= $uid;
		$data_class .=' button-'.$button_style.' ';
		
		if($button_style=='style-11' || $button_style=='style-13'){
			$data_class .=' '.$btn_hover_style.' ';
		}
		
		if(!empty($settings['full_width_btn']) && $settings['full_width_btn']=='yes'){
			$data_class .=' full-button ';
			$full_button_width=' full-button ';
		}
		if(!empty($settings['transition_hover']) && $settings['transition_hover']=='yes'){
			$data_class .=' trnasition_hover ';
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
		
		$uid_button=uniqid("button");		
		$the_button ='<div class="pt-plus-button-wrapper  '.esc_attr($button_align).'  ">';
			$the_button .='<div class="button_parallax  '.esc_attr($full_button_width).'">';
				$the_button .='<div id="'.esc_attr($uid_button).'"  class="'.esc_attr($button_align).' ts-button content_hover_effect ' . esc_attr($hover_class) . ' '.esc_attr($full_button_width).' " >';
					$the_button .='<div class="pt_plus_button '.$data_class.' '.$animated_class.' " '.$animation_attr.'>';
						$the_button .= '<div class="animted-content-inner ">';
							$the_button .='<a '.$this->get_render_attribute_string( "button" ).'>';
							$the_button .= $this->render_text();
							$the_button .='</a>';
						$the_button .='</div>';
					$the_button .='</div>';
				$the_button .='</div>';
			$the_button .='</div>';
		$the_button .='</div>';
		
		echo $the_button;
	}
    protected function content_template() {
	
    }
	
	protected function render_text() {	
		$icons_after=$icons_before=$button_text=$style_content='';
		$settings = $this->get_settings_for_display();
		
		$button_style = $settings['button_style'];
		$before_after = $settings['before_after'];
		$button_text = $settings['button_text'];
		
		if($settings["button_icon_style"]=='font_awesome'){
			$icons=$settings["button_icon"];
		}else{
			$icons='';
		}
		
		if($before_after=='before' && !empty($icons)){
			$icons_before = '<i class="btn-icon button-before '.esc_attr($icons).'"></i>';
		}
		if($before_after=='after' && !empty($icons)){
		   $icons_after = '<i class="btn-icon button-after '.esc_attr($icons).'"></i>';
		}
		if($button_style=='style-4'){
			$button_text =$icons_before.$button_text . $icons_after;
		}
		if($button_style=='style-8'){
			$button_text =$icons_before . $button_text . $icons_after;
		}
		if($button_style=='style-11'){
			$button_text ='<span>'.$icons_before . $button_text . $icons_after.'</span>';
		}
		if($button_style=='style-12'){
			$button_text ='<span>'.$icons_before . $button_text . $icons_after.'</span>';
		}
		if($button_style=='style-13'){
			$button_text ='<span>'.$icons_before . $button_text . $icons_after.'</span>';			
		}
		if( $button_style=='style-20' || $button_style=='style-21'){
			$button_text =$icons_before .'<span>'. esc_html($button_text) .'</span>'. $icons_after;
		}
		return $button_text.$style_content;
	}
}
