<?php 
/*
Widget Name: Info Box 
Description: Display Infobox.
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
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly


class ThePlus_Flip_Box extends Widget_Base {
		
	public function get_name() {
		return 'tp-flip-box';
	}

    public function get_title() {
        return __('Flip Box', 'theplus');
    }

    public function get_icon() {
        return 'fa fa-dot-circle-o theplus_backend_icon';
    }

    public function get_categories() {
        return array('plus-creatives');
    }

    public function get_script_depends() {
        return [
            'theplus_frontend_scripts',
        ];
    }
	public function get_style_depends() {
		return [ 'info-box-css' ];
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
			'info_box_layout',
			[
				'label' => __( 'Select Layout', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'single_layout',
				'options' => [
					'single_layout'  => __( 'Listing', 'theplus' ),
					'carousel_layout' => __( 'Carousel (PRO)', 'theplus' ),
				],
			]
		);
		$this->add_control(
			'plus_pro_info_box_layout_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
				'condition'    => [
					'info_box_layout' => 'carousel_layout',
				],
			]
		);
		$this->add_control(
			'flip_style',
			[
				'label' => __( 'Flip Type', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => [
					'horizontal'  => __( 'Horizontal', 'theplus' ),
					'vertical' => __( 'Vertical', 'theplus' ),
				],
				'condition'    => [
					'info_box_layout' => 'single_layout',
				],
			]
		);
		$this->add_responsive_control(
            'flip_box_height',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Box Height', 'theplus'),
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 700,
						'step' => 5,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 300,
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-flipbox,{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-flipbox-front,{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-flipbox-back' => 'min-height: {{SIZE}}{{UNIT}}',
				],
				'condition'    => [
					'info_box_layout' => 'single_layout',
				],
            ]
        );
		
		$this->end_controls_section();
		$this->start_controls_section(
			'front_content_section',
			[
				'label' => __( 'Front Side', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'info_box_layout' => 'single_layout',
				],
			]
		);
		$this->add_control(
			'front_options',
			[
				'label' => __( 'Front Options', 'theplus' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'info_box_layout' => 'single_layout',
				],
			]
		);
		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'The Plus', 'theplus' ),
				'condition' => [
					'info_box_layout' => 'single_layout',
				],
			]
		);
		
		$this->add_control(
			'image_icon',
			[
				'label' => __( 'Select Icon', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'description' => __('You can select Icon, Custom Image or SVG using this option.','theplus'),
				'default' => 'icon',
				'options' => [
					''  => __( 'None', 'theplus' ),
					'icon' => __( 'Icon', 'theplus' ),
					'image' => __( 'Image', 'theplus' ),
					'svg' => __( 'Svg (PRO)', 'theplus' ),
				],
				'condition' => [
					'info_box_layout' => 'single_layout',
				],
			]
		);
		$this->add_control(
			'plus_pro_image_icon_svg_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
				'condition' => [
					'info_box_layout' => 'single_layout',
					'image_icon' => 'svg',
				],
			]
		);
		$this->add_control(
			'select_image',
			[
				'label' => __( 'Use Image As icon', 'theplus' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => '',
				],
				'media_type' => 'image',
				'condition' => [
					'info_box_layout' => 'single_layout',
					'image_icon' => 'image',
				],
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
					'info_box_layout' => 'single_layout',
					'image_icon' => 'icon',
				],
			]
		);
		$this->add_control(
			'icon_fontawesome',
			[
				'label' => __( 'Icon Library', 'theplus' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-bank',
				'condition' => [
					'info_box_layout' => 'single_layout',
					'image_icon' => 'icon',
					'icon_font_style' => 'font_awesome',
				],
			]
		);
		$this->add_control(
			'plus_pro_icons_mind_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
				'condition' => [
					'info_box_layout' => 'single_layout',
					'image_icon' => 'icon',
					'icon_font_style' => 'icon_mind',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'back_content_section',
			[
				'label' => __( 'Back Side', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'info_box_layout' => 'single_layout',
				],
			]
		);
		$this->add_control(
			'back_options',
			[
				'label' => __( 'Back Options', 'theplus' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'info_box_layout' => 'single_layout',
				],
			]
		);
		$this->add_control(
			'content_desc',
			[
				'label' => __( 'Description', 'theplus' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => __( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'theplus' ),
				'placeholder' => __( 'Type your description here', 'theplus' ),
				'condition' => [
					'info_box_layout' => 'single_layout',
				],
			]
		);
		$this->add_control(
			'display_button',
			[
				'label' => __( 'Button', 'theplus' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Enable', 'theplus' ),
				'label_off' => __( 'Disable', 'theplus' ),
				'default' => 'no',
				'separator' => 'before',
				'condition' => [
					'info_box_layout' => 'single_layout',
				],
			]
		);
		$this->add_control(
            'button_style', [
                'type' => Controls_Manager::SELECT,
                'label' => __('Button Style', 'theplus'),
                'default' => 'style-8',
                'options' => [
                    'style-7' => __('Style 1 (PRO)', 'theplus'),
                    'style-8' => __('Style 2', 'theplus'),
                    'style-9' => __('Style 3 (PRO)', 'theplus'),                    
                ],
				'condition' => [
					'info_box_layout' => 'single_layout',
					'display_button' => 'yes',
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
				'condition' => [
					'info_box_layout' => 'single_layout',
					'display_button' => 'yes',
					'button_style' => 'style-8',
				],
			]
		);
		$this->add_control(
			'button_link',
			[
				'label' => __( 'Button Link', 'theplus' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'https://www.demo-link.com', 'theplus' ),
				'default' => [
					'url' => '#',
				],
				'condition' => [
					'info_box_layout' => 'single_layout',
					'display_button' => 'yes',
					'button_style' => 'style-8',
				],
			]
		);
		$this->add_control(
			'button_icon_font_style',
			[
				'label' => __( 'Icon Font', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'font_awesome',
				'options' => [
					'font_awesome'  => __( 'Font Awesome', 'theplus' ),
					'icon_mind' => __( 'Icons Mind', 'theplus' ),
				],
				'condition' => [
					'info_box_layout' => 'single_layout',
					'display_button' => 'yes',
					'button_style!' => ['style-7','style-9'],
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
					'info_box_layout' => 'single_layout',
					'display_button' => 'yes',
					'button_style!' => ['style-7','style-9'],
					'button_icon_font_style' => 'font_awesome',
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
					'info_box_layout' => 'single_layout',
					'display_button' => 'yes',
					'button_style!' => ['style-7','style-9'],
					'button_icon_font_style' => 'icon_mind',
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
					'info_box_layout' => 'single_layout',
					'display_button' => 'yes',
					'button_style!' => ['style-7','style-9'],
					'button_icon_font_style!' => '',
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
					'info_box_layout' => 'single_layout',
					'display_button' => 'yes',
					'button_style!' => ['style-7','style-9'],
					'button_icon_font_style!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .button-link-wrap i.button-after' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .button-link-wrap i.button-before' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		/*svg style*/
		$this->start_controls_section(
            'section_svg_styling',
            [
                'label' => __('Front Svg Icon', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition'    => [
					'image_icon' => [ 'svg' ],
				],
            ]
        );
		$this->add_control(
			'plus_pro_svg_styling_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
				'condition'    => [
					'image_icon' => [ 'svg' ],
				],
			]
		);
		$this->end_controls_section();
		/*svg style*/
		/*icon style*/
		$this->start_controls_section(
            'section_icon_styling',
            [
                'label' => __('Front Icon', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
				'conditions'   => [
					'relation' => 'or',
					'terms' => [
						[
							'name'     => 'image_icon',
							'operator' => '==',
							'value'    => 'icon',
						],
					],
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon' => 'font-size: {{SIZE}}{{UNIT}} !important;',
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon' => 'width: {{SIZE}}{{UNIT}} !important;height: {{SIZE}}{{UNIT}} !important;line-height: {{SIZE}}{{UNIT}} !important;text-align: center;',
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
				'default' => 'solid',
				
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon:before' => 'color: {{VALUE}};background: transparent;-webkit-background-clip: unset;-webkit-text-fill-color: initial;',
				],
				'condition' => [
					'icon_color_option' => 'solid',
				],
				'separator' => 'after',
			]
		);
		$this->add_control(
            'icon_gradient_color1',
            [
                'label' => __('Color 1', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => 'orange',
				'condition' => [
					'icon_color_option' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'icon_gradient_color1_control',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Color 1 Location', 'theplus'),
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => 0,
				],
				'render_type' => 'ui',
				'condition' => [
					'icon_color_option' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'icon_gradient_color2',
            [
                'label' => __('Color 2', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => 'cyan',
				'condition' => [
					'icon_color_option' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'icon_gradient_color2_control',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Color 2 Location', 'theplus'),
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => 100,
					],
				'render_type' => 'ui',
				'condition' => [
					'icon_color_option' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'icon_gradient_style', [
                'type' => Controls_Manager::SELECT,
                'label' => __('Gradient Style', 'theplus'),
                'default' => 'linear',
                'options' => theplus_get_gradient_styles(),
				'condition' => [
					'icon_color_option' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'icon_gradient_angle', [
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon:before' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{icon_gradient_color1.VALUE}} {{icon_gradient_color1_control.SIZE}}{{icon_gradient_color1_control.UNIT}}, {{icon_gradient_color2.VALUE}} {{icon_gradient_color2_control.SIZE}}{{icon_gradient_color2_control.UNIT}});-webkit-transition: all 0.3s linear;-moz-transition: all 0.3s linear;-o-transition: all 0.3s linear;-ms-transition: all 0.3s linear;transition: all 0.3s linear;',
				],
				'condition'    => [
					'icon_color_option' => 'gradient',
					'icon_gradient_style' => ['linear']
				],
				'of_type' => 'gradient',
				'separator' => 'after',
			]
        );
		$this->add_control(
            'icon_gradient_position', [
				'type' => Controls_Manager::SELECT,
				'label' => __('Position', 'theplus'),
				'options' => theplus_get_position_options(),
				'default' => 'center center',
				'selectors' => [
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon:before' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{icon_gradient_color1.VALUE}} {{icon_gradient_color1_control.SIZE}}{{icon_gradient_color1_control.UNIT}}, {{icon_gradient_color2.VALUE}} {{icon_gradient_color2_control.SIZE}}{{icon_gradient_color2_control.UNIT}});-webkit-transition: all 0.3s linear;-moz-transition: all 0.3s linear;-o-transition: all 0.3s linear;-ms-transition: all 0.3s linear;transition: all 0.3s linear;',
				],
				'condition' => [
					'icon_color_option' => 'gradient',
					'icon_gradient_style' => 'radial',
				],
				'of_type' => 'gradient',
				'separator' => 'after',
				
			]
        );
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'icon_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'icon_border_color',
			[
				'label' => __( 'Border Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon' => 'border-color: {{VALUE}}',
				],
				'separator' => 'before',
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
				'default' => 'solid',
			]
		);
		
		$this->add_control(
			'icon_hover_color',
			[
				'label' => __( 'Hover Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-icon:before' => 'color: {{VALUE}};background: transparent;-webkit-background-clip: unset;-webkit-text-fill-color: initial;',
				],
				'condition' => [
					'icon_hover_color_option' => 'solid',
				],
				'separator' => 'after',
			]
		);
		$this->add_control(
            'icon_hover_gradient_color1',
            [
                'label' => __('Color 1', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => 'orange',
				'condition' => [
					'icon_hover_color_option' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'icon_hover_gradient_color1_control',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Color 1 Location', 'theplus'),
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => 0,
				],
				'render_type' => 'ui',
				'condition' => [
					'icon_hover_color_option' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'icon_hover_gradient_color2',
            [
                'label' => __('Color 2', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => 'cyan',
				'condition' => [
					'icon_hover_color_option' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'icon_hover_gradient_color2_control',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Color 2 Location', 'theplus'),
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => 100,
					],
				'render_type' => 'ui',
				'condition' => [
					'icon_hover_color_option' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'icon_hover_gradient_style', [
                'type' => Controls_Manager::SELECT,
                'label' => __('Gradient Style', 'theplus'),
                'default' => 'linear',
                'options' => theplus_get_gradient_styles(),
				'condition' => [
					'icon_hover_color_option' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'icon_hover_gradient_angle', [
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-icon:before' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{icon_hover_gradient_color1.VALUE}} {{icon_hover_gradient_color1_control.SIZE}}{{icon_hover_gradient_color1_control.UNIT}}, {{icon_hover_gradient_color2.VALUE}} {{icon_hover_gradient_color2_control.SIZE}}{{icon_hover_gradient_color2_control.UNIT}})',
				],
				'condition'    => [
					'icon_hover_color_option' => 'gradient',
					'icon_hover_gradient_style' => ['linear']
				],
				'of_type' => 'gradient',
				'separator' => 'after',
			]
        );
		$this->add_control(
            'icon_hover_gradient_position', [
				'type' => Controls_Manager::SELECT,
				'label' => __('Position', 'theplus'),
				'options' => theplus_get_position_options(),
				'default' => 'center center',
				'selectors' => [
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-icon:before' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{icon_hover_gradient_color1.VALUE}} {{icon_hover_gradient_color1_control.SIZE}}{{icon_hover_gradient_color1_control.UNIT}}, {{icon_hover_gradient_color2.VALUE}} {{icon_hover_gradient_color2_control.SIZE}}{{icon_hover_gradient_color2_control.UNIT}})',
				],
				'condition' => [
					'icon_hover_color_option' => 'gradient',
					'icon_hover_gradient_style' => 'radial',
				],
				'of_type' => 'gradient',
				'separator' => 'after',
			]
        );
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'icon_hover_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-icon',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'icon_border_hover_color',
			[
				'label' => __( 'Hover Border Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-icon' => 'border-color: {{VALUE}}',
				],
				'separator' => 'before',
			]
		);
		
		$this->end_controls_tab();
		$this->end_controls_tabs();		
		$this->end_controls_section();		
		/*icon style*/
		
		/*title style*/
		$this->start_controls_section(
            'section_title_styling',
            [
                'label' => __('Front Title', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-title',
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
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#313131',
				'selectors' => [
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-title' => 'color: {{VALUE}}',
				],
				'condition' => [
					'title_color_option' => 'solid',
				],
			]
		);
		$this->add_control(
            'title_gradient_color1',
            [
                'label' => __('Color 1', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => 'orange',
				'condition' => [
					'title_color_option' => 'gradient',
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
				'condition' => [
					'title_color_option' => 'gradient',
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
				'condition' => [
					'title_color_option' => 'gradient',
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
				'condition' => [
					'title_color_option' => 'gradient',
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
				'condition' => [
					'title_color_option' => 'gradient',
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-title' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{title_gradient_color1.VALUE}} {{title_gradient_color1_control.SIZE}}{{title_gradient_color1_control.UNIT}}, {{title_gradient_color2.VALUE}} {{title_gradient_color2_control.SIZE}}{{title_gradient_color2_control.UNIT}})',
				],
				'condition'    => [
					'title_color_option' => 'gradient',
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-title' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{title_gradient_color1.VALUE}} {{title_gradient_color1_control.SIZE}}{{title_gradient_color1_control.UNIT}}, {{title_gradient_color2.VALUE}} {{title_gradient_color2_control.SIZE}}{{title_gradient_color2_control.UNIT}})',
				],
				'condition' => [
					'title_color_option' => 'gradient',
					'title_gradient_style' => 'radial',
			],
			'of_type' => 'gradient',
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-title' => 'color: {{VALUE}}',
				],
				'condition' => [
					'title_hover_color_option' => 'solid',
				],
			]
		);
		$this->add_control(
            'title_hover_gradient_color1',
            [
                'label' => __('Color 1', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => 'orange',
				'condition' => [
					'title_hover_color_option' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'title_hover_gradient_color1_control',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Color 1 Location', 'theplus'),
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => 0,
				],
				'render_type' => 'ui',
				'condition' => [
					'title_hover_color_option' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'title_hover_gradient_color2',
            [
                'label' => __('Color 2', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => 'cyan',
				'condition' => [
					'title_hover_color_option' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'title_hover_gradient_color2_control',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Color 2 Location', 'theplus'),
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => 100,
					],
				'render_type' => 'ui',
				'condition' => [
					'title_hover_color_option' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'title_hover_gradient_style', [
                'type' => Controls_Manager::SELECT,
                'label' => __('Gradient Style', 'theplus'),
                'default' => 'linear',
                'options' => theplus_get_gradient_styles(),
				'condition' => [
					'title_hover_color_option' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'title_hover_gradient_angle', [
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-title' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{title_hover_gradient_color1.VALUE}} {{title_hover_gradient_color1_control.SIZE}}{{title_hover_gradient_color1_control.UNIT}}, {{title_hover_gradient_color2.VALUE}} {{title_hover_gradient_color2_control.SIZE}}{{title_hover_gradient_color2_control.UNIT}})',
				],
				'condition'    => [
					'title_hover_color_option' => 'gradient',
					'title_hover_gradient_style' => ['linear']
				],
				'of_type' => 'gradient',
			]
        );
		$this->add_control(
            'title_hover_gradient_position', [
				'type' => Controls_Manager::SELECT,
				'label' => __('Position', 'theplus'),
				'options' => theplus_get_position_options(),
				'default' => 'center center',
				'selectors' => [
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-title' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{title_hover_gradient_color1.VALUE}} {{title_hover_gradient_color1_control.SIZE}}{{title_hover_gradient_color1_control.UNIT}}, {{title_hover_gradient_color2.VALUE}} {{title_hover_gradient_color2_control.SIZE}}{{title_hover_gradient_color2_control.UNIT}})',
				],
				'condition' => [
					'title_hover_color_option' => 'gradient',
					'title_hover_gradient_style' => 'radial',
			],
			'of_type' => 'gradient',
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
					'{{WRAPPER}} .pt_plus_info_box.info-box-style_5 .info-box-inner .service-title' => 'margin-top : {{SIZE}}{{UNIT}}',
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
					'{{WRAPPER}} .pt_plus_info_box.info-box-style_5 .info-box-inner .service-title' => 'margin-bottom : {{SIZE}}{{UNIT}}',
				],
            ]
        );
		
		$this->end_controls_section();
		/*title style*/
		/*desc style*/
		$this->start_controls_section(
            'section_desc_styling',
            [
                'label' => __('Back Description', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
			]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'label' => __( 'Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-desc',
			]
		);
		$this->add_control(
			'desc_hover_color',
			[
				'label' => __( 'Desc Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-desc,{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-desc p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();
		/*desc style*/
		/*button style*/
		$this->start_controls_section(
            'section_button_styling',
            [
                'label' => __('Back Button', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
				'conditions'   => [
					'relation' => 'or',
					'terms' => [
						[
							'name'     => 'display_button',
							'operator' => '==',
							'value'    => 'yes',
						],
					],
				],
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
					'{{WRAPPER}} .pt_plus_button .button-link-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .pt_plus_button.button-style-7 .button-link-wrap:after' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'button_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap',
				'condition' => [
					'button_style' => 'style-8',
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
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap' => 'border-style: {{VALUE}};',
				],
				'conditions'   => [
					'relation' => 'or',
					'terms' => [
						[
							'name'     => 'button_style',
							'operator' => '==',
							'value'    => 'style-8',
						],
					],
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
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'conditions'   => [
					'relation' => 'or',
					'terms' => [
						[
							'name'     => 'button_style',
							'operator' => '==',
							'value'    => 'style-8',
						],
					],
				],
			]
		);

		$this->add_control(
			'button_border_color',
			[
				'label'     => __( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => [
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap' => 'border-color: {{VALUE}};',
				],
				'conditions'   => [
					'relation' => 'or',
					'terms' => [
						[
							'name'     => 'button_style',
							'operator' => '==',
							'value'    => 'style-8',
						],
					],
				],
				'separator' => 'after',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_shadow',
				'selector' => '{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap',
				'condition' => [
					'button_style' => 'style-8',
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
					'{{WRAPPER}} .pt_plus_button .button-link-wrap:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'button_hover_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover,',
				'separator' => 'after',
				'condition' => [
					'button_style' => 'style-8',
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
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover' => 'border-color: {{VALUE}};',
				],
				'conditions'   => [
					'relation' => 'or',
					'terms' => [
						[
							'name'     => 'button_style',
							'operator' => '==',
							'value'    => 'style-8',
						],
					],
				],
				'separator' => 'after',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_hover_shadow',
				'selector' => '{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover',
				'condition' => [
					'button_style' => 'style-8',
				],
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->end_controls_section();
		/*button style*/
		/*background option*/
		$this->start_controls_section(
            'section_bg_option_styling',
            [
                'label' => __('Background Options', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
			'box_border',
			[
				'label' => __( 'Box Border', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'default' => 'no',				
			]
		);
		$this->add_control(
			'box_border_color',
			[
				'label' => __( 'Border Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#252525',
				'selectors'  => [
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-flipbox-front,{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-flipbox-back' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'box_border' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'box_border_width',
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-flipbox-front,{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-flipbox-back' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'box_border' => 'yes',
				],
			]
		);
		
		$this->add_control(
			'box_border_style',
			[
				'label'   => __( 'Border Style', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => theplus_get_border_style(),
				'selectors'  => [
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-flipbox-front,{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-flipbox-back' => 'border-style: {{VALUE}};',
				],
				'condition' => [
					'box_border' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'border_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-flipbox-front,{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-flipbox-back,{{WRAPPER}} .pt_plus_info_box .infobox-front-overlay' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'box_border' => 'yes',
				],
			]
		);		
		$this->start_controls_tabs( 'tabs_background_style' );
		$this->start_controls_tab(
			'tab_background_front',
			[
				'label' => __( 'Front', 'theplus' ),
				'condition' => [
					'info_box_layout' => 'single_layout',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'box_front_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-flipbox-front',
				'condition' => [
					'info_box_layout' => 'single_layout',
				],
			]
		);
		$this->add_control(
			'box_front_overlay_bg_color',
			[
				'label' => __( 'Overlay Background Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'separator' => 'before',
				'default' => '',
				'selectors'  => [
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .infobox-front-overlay' => 'background: {{VALUE}};',
				],
				'condition' => [
					'info_box_layout' => 'single_layout',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_background_back',
			[
				'label' => __( 'Back', 'theplus' ),
				'condition' => [
					'info_box_layout' => 'single_layout',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'box_back_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-flipbox-back',
				'condition' => [
					'info_box_layout' => 'single_layout',
				],
			]
		);
		$this->add_control(
			'box_back_overlay_bg_color',
			[
				'label' => __( 'Overlay Background Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'separator' => 'before',
				'default' => '',
				'selectors'  => [
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .infobox-back-overlay' => 'background: {{VALUE}};',
				],
				'condition' => [
					'info_box_layout' => 'single_layout',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'shadow_options',
			[
				'label' => __( 'Box Shadow Options', 'theplus' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->start_controls_tabs( 'tabs_shadow_style' );
		$this->start_controls_tab(
			'tab_shadow_front',
			[
				'label' => __( 'Front', 'theplus' ),
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow',
				'selector' => '{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-flipbox-front',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_shadow_back',
			[
				'label' => __( 'Back', 'theplus' ),
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_hover_shadow',
				'selector' => '{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-flipbox-back',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*background option*/
		/*carousel option*/
		$this->start_controls_section(
            'section_carousel_options_styling',
            [
                'label' => __('Carousel Options', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'info_box_layout' => 'carousel_layout',
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
				'condition' => [
					'info_box_layout' => 'carousel_layout',
				],
			]
		);
		$this->end_controls_section();
		/*carousel option*/
		/*box padding*/
		$this->start_controls_section(
            'section_extra_option_styling',
            [
                'label' => __('Extra Options', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .info-box-bg-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
				'condition'    => [
					'info_box_layout' => 'carousel_layout',
				],
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
					'condition'    => [
						'info_box_layout' => 'carousel_layout',
						'messy_column' => [ 'yes' ],
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
		$this->add_control(
			'responsive_visible_opt',[
				'label'   => esc_html__( 'Responsive Visibility', 'theplus' ),
				'type'    =>  Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( 'Enable', 'theplus' ),
				'label_off' => __( 'Disable', 'theplus' ),
				'separator' => 'before',
			]
		);
		$this->add_control(
			'desktop_opt',[
				'label'   => esc_html__( 'Desktop', 'theplus' ),
				'type'    =>  Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'condition'    => [
					'responsive_visible_opt' => 'yes',
				],
			]
		);
		$this->add_control(
			'tablet_opt',[
				'label'   => esc_html__( 'Tablet', 'theplus' ),
				'type'    =>  Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'condition'    => [
					'responsive_visible_opt' => 'yes',
				],
			]
		);
		$this->add_control(
			'mobile_opt',[
				'label'   => esc_html__( 'Mobile', 'theplus' ),
				'type'    =>  Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'condition'    => [
					'responsive_visible_opt' => 'yes',
				],
			]
		);
		$this->end_controls_section();
		/*box padding*/
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
		
		$info_box_layout = $settings["info_box_layout"];
		$main_style = 'style_5';
		
		$hover_class  =  '';
		
		$box_hover_effects=$settings["box_hover_effects"];
		if ($box_hover_effects == "push") {
			$hover_class .= 'content_hover_push';
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
		
		$service_title = $description= $service_img = $service_icon_style= $service_space = $serice_box_border =$imge_content=$title_css=$subtitle_css=$output=$service_btn=$the_button='';
		
		if($settings['box_border'] == 'yes'){
			$serice_box_border ='service-border-box';		
		}
		
		$image_icon=$settings["image_icon"];
		if($image_icon == 'image'){
			if($settings["select_image"]["url"]!=''){
				$imgSrc = $settings["select_image"]["url"];
			}else{
				$imgSrc = '';
			}
			$service_img='<img src="'.esc_url($imgSrc).'"   class="service-img" />';
		}
		
		$icon_style=$settings["icon_style"];
			if($icon_style == 'square'){
				$service_icon_style = 'icon-squre';
			} 
			if($icon_style == 'rounded'){
				$service_icon_style = 'icon-rounded';
			}
		if($image_icon == 'icon'){
			if($settings["icon_font_style"]=='font_awesome'){
				$icons=$settings["icon_fontawesome"];
			}else{
				$icons='';
			}
			$service_img = '<i class=" '.esc_attr($icons).' service-icon '.esc_attr($service_icon_style).'"></i>';
		}		
		if ( ! empty( $settings['url_link']['url'] ) ) {
			$this->add_render_attribute( 'box_link', 'href', $settings['url_link']['url'] );
			if ( $settings['url_link']['is_external'] ) {
				$this->add_render_attribute( 'box_link', 'target', '_blank' );
			}
			if ( $settings['url_link']['nofollow'] ) {
				$this->add_render_attribute( 'box_link', 'rel', 'nofollow' );
			}
		}
		
		if(!empty($settings["title"])){
			if (!empty($settings['url_link']['url'])){
				$service_title= '<div class="service-title"> '.esc_html($settings["title"]).' </div>';
			}else{
				$service_title= '<div class="service-title"> '.esc_html($settings["title"]).' </div>';
			}
		}
		
		
		$content_desc = $settings['content_desc'];
		if($content_desc !=''){
			 $description='<div class="service-desc"> '.$content_desc.' </div>';
		}
		
		$the_button='';
		if($settings['display_button'] == 'yes'){
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
		
		$button_style = $settings['button_style'];
		$button_text = $settings['button_text'];
		$btn_uid=uniqid('btn');
		$data_class= $btn_uid;
		$data_class .=' button-'.$button_style.' ';
		
		$the_button ='<div class="pt-plus-button-wrapper text-center">';
			$the_button .='<div class="button_parallax">';
				$the_button .='<div class="text-center ts-button">';
					$the_button .='<div class="pt_plus_button '.$data_class.'">';
						$the_button .= '<div class="animted-content-inner">';
							$the_button .='<a '.$this->get_render_attribute_string( "button" ).'>';
							$the_button .= $this->render_text();
							$the_button .='</a>';
						$the_button .='</div>';
					$the_button .='</div>';
				$the_button .='</div>';
			$the_button .='</div>';
		$the_button .='</div>';
		}
		
		if($settings['flip_style'] == 'horizontal'){
			$service_flip= "flip-horizontal";
		}
		if($settings['flip_style'] == 'vertical'){
			$service_flip= "flip-vertical";
		}
		
		if ($info_box_layout == 'single_layout'){	
			$output = '<div class="info-box-inner content_hover_effect '. esc_attr($hover_class) .'">';			
			if($main_style == 'style_5'){
				$output .= '<div class="info-box-bg-box">';
					$output .= '<div class="service-flipbox '.esc_attr($service_flip).' height-full">';
						$output .= '<div class="service-flipbox-holder height-full text-center perspective bezier-1"	>';
							$output .= '<div class="service-flipbox-front bezier-1 no-backface origin-center">';
								$output .= '<div class="service-flipbox-content width-full">';
									$output .= $service_img;
									$output .= '<div class="service-content">';
										$output .= $service_title;
									$output .= '</div>';
								$output .= '</div>';
								$output .= '<div class="infobox-front-overlay"></div>';
							$output .= '</div>';	
							$output .= '<div class="service-flipbox-back fold-back-horizontal no-backface bezier-1 origin-center">';
								$output .= '<div class="service-flipbox-content width-full">';
									$output .= $description;
									$output .= $the_button;
								$output .= '</div>';
								$output .= '<div class="infobox-back-overlay"></div>';
							$output .= '</div>';	
						$output .= '</div>';				
					$output .= '</div>';
				$output .= '</div>';
			}
			$output .= '</div>';
		}
		
		$visiblity_hide='';
			if(!empty($settings['responsive_visible_opt']) && $settings['responsive_visible_opt']=='yes'){
				$visiblity_hide .= (($settings['desktop_opt']!='yes' && $settings['desktop_opt']=='') ? 'desktop-hide ' : '' );							
				$visiblity_hide .= (($settings['tablet_opt']!='yes' && $settings['tablet_opt']=='') ? 'tablet-hide ' : '' );
				$visiblity_hide .= (($settings['mobile_opt']!='yes' && $settings['mobile_opt']=='') ? 'mobile-hide ' : '' );
			}
			
		$uid=uniqid('flip_box');
		
		$info_box ='<div class="pt_plus_info_box  '.esc_attr($uid).' info-box-'.esc_attr($main_style).' '.esc_attr($animated_class).'  '.esc_attr($service_space).'"  data-id="'.esc_attr($uid).'" '.$animation_attr.' '.$visiblity_hide.'>';
			$info_box .= '<div class="post-inner-loop">';
				$info_box .= $output;
			$info_box .='</div>';
		$info_box .='</div>';
	echo $info_box;
	}
    protected function content_template() {
	
    }
	protected function render_text() {	
		$icons_after=$icons_before='';
		$settings = $this->get_settings_for_display();
		
		$button_style = $settings['button_style'];
		$before_after = $settings['before_after'];
		$button_text = $settings['button_text'];
		
		if($settings["button_icon_font_style"]=='font_awesome'){
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
		
		if($button_style=='style-8'){
			$button_text =$icons_before . $button_text . $icons_after;
		}
		
		return $button_text;
	}
}