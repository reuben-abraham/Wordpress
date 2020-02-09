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


class ThePlus_Info_Box extends Widget_Base {
		
	public function get_name() {
		return 'tp-info-box';
	}

    public function get_title() {
        return __('Info Box', 'theplus');
    }

    public function get_icon() {
        return 'fa fa-info-circle theplus_backend_icon';
    }

    public function get_categories() {
        return array('plus-essential');
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
			'main_style',
			[
				'label' => __( 'Info Box Style', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style_1',
				'options' => [
					'style_1'  => __( 'Style-1', 'theplus' ),
					'style_2' => __( 'Style-2 (PRO)', 'theplus' ),
					'style_3' => __( 'Style-3', 'theplus' ),
					'style_4' => __( 'Style-4 (PRO)', 'theplus' ),
					'style_7' => __( 'Style-5 (PRO)', 'theplus' ),
					'style_11' => __( 'Style-6 (PRO)', 'theplus' ),
				],
				'condition' => [
					'info_box_layout' => 'single_layout',
				],
			]
		);
		$this->add_control(
			'plus_pro_main_style_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
				'condition'    => [
					'main_style!' => ['style_1','style_3'],
				],
			]
		);
		$this->add_control(
			'title',
			[
				'label' => __( 'Title Of Info Box', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'The Plus', 'theplus' ),
				'condition' => [
					'info_box_layout' => 'single_layout',
					'main_style' => ['style_1','style_3'],
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
					'main_style' => ['style_1','style_3'],
				],
			]
		);
		$this->add_control(
			'text_align',
			[
				'label' => __( 'Info Box Alignment', 'theplus' ),
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
				'default' => 'center',
				'toggle' => true,
				'condition' => [
					'main_style' => 'style_3',
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
				'condition' => [
					'info_box_layout' => 'single_layout',
					'main_style' => ['style_1','style_3'],
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
				'separator' => 'before',
				'condition' => [
					'info_box_layout' => 'single_layout',
					'main_style' => ['style_1','style_3'],
				],
			]
		);
		$this->add_control(
			'plus_pro_svg_icon_options',
			[
				'label' => __( 'Icon Library', 'theplus' ),
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
				'label' => __( 'Icon Library', 'theplus' ),
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
					'main_style' => ['style_1','style_3'],
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
				'label' => __( 'Button Text', 'theplus' ),
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
			'button_icon_style',
			[
				'label' => __( 'Icon Font', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'font_awesome',
				'options' => [
					''  => __( 'None', 'theplus' ),
					'font_awesome'  => __( 'Font Awesome', 'theplus' ),
					'icon_mind' => __( 'Icons Mind (PRO)', 'theplus' ),
				],
				'condition' => [
					'info_box_layout' => 'single_layout',
					'display_button' => 'yes',
					'button_style' => 'style-8',
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
					'button_style' => 'style-8',
					'button_icon_style' => 'font_awesome',
				],
			]
		);
		$this->add_control(
			'plus_pro_button_icons_mind_options',
			[
				'label' => __( 'Icon Library', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
				'condition' => [
					'info_box_layout' => 'single_layout',
					'display_button' => 'yes',
					'button_style' => 'style-8',
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
					'info_box_layout' => 'single_layout',
					'display_button' => 'yes',
					'button_style' => 'style-8',
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
					'info_box_layout' => 'single_layout',
					'display_button' => 'yes',
					'button_style' => 'style-8',
					'button_icon_style!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .button-link-wrap i.button-after' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .button-link-wrap i.button-before' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'hover_info_button',
			[
				'label'   => __( 'Hover Button InfoBox', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'theplus' ),
				'label_off' => __( 'Off', 'theplus' ),				
				'default' => 'no',
				'condition' => [
					'info_box_layout' => 'single_layout',
					'display_button' => 'yes',
					'button_style' => ['style-8'],					
				],
			]
		);
		$this->end_controls_section();
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
					'{{WRAPPER}} .pt_plus_info_box.info-box-style_3 .info-box-inner .service-title' => 'margin-top : {{SIZE}}{{UNIT}}',
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
					'{{WRAPPER}} .pt_plus_info_box.info-box-style_1 .info-box-inner .service-title,{{WRAPPER}} .pt_plus_info_box.info-box-style_3 .info-box-inner .service-title' => 'margin-bottom : {{SIZE}}{{UNIT}}',
				],
            ]
        );
		
		$this->end_controls_section();
		/*title style*/
		/*title bottom border */
		$this->start_controls_section(
            'section_title_border_styling',
            [
                'label' => __('Bottom Border Style', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
			]
        );
		$this->add_control(
			'border_check',
			[
				'label' => __( 'Display Border', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'default' => 'yes',
				'description' => __('By checking up this option you can turn on underline/border under the title.','theplus'),
			]
		);
		$this->add_control(
            'border_width',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Border Width', 'theplus'),
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 5,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 20,
				],
				'render_type' => 'ui',
				'condition' => [
					'border_check' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-border' => 'width: {{SIZE}}{{UNIT}}',
				],
            ]
        );
		$this->add_control(
            'border_height',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Border Height', 'theplus'),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 1,
				],
				'render_type' => 'ui',
				'condition' => [
					'border_check' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-border' => 'border-width: {{SIZE}}{{UNIT}}',
				],
            ]
        );
		$this->add_control(
			'title_border_color',
			[
				'label' => __( 'Border Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#252525',
				'selectors' => [
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-border' => 'border-color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();
		/*title bottom border */
		/*desc style*/
		$this->start_controls_section(
            'section_desc_styling',
            [
                'label' => __('Description Style', 'theplus'),
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
			'desc_color',
			[
				'label' => __( 'Desc Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-desc,{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-desc p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'desc_hover_color',
			[
				'label' => __( 'Desc Hover Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-desc,{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-desc p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();
		/*desc style*/
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
				'condition' => [
					'main_style' => ['style_1','style_3'],
				],
			]
		);
		$this->start_controls_tabs( 'tabs_border_style' );
		$this->start_controls_tab(
			'tab_border_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
				'condition' => [
					'box_border' => 'yes',
				],
			]
		);
		$this->add_control(
			'box_border_color',
			[
				'label' => __( 'Border Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#252525',
				'selectors'  => [
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .info-box-bg-box' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'main_style' => ['style_1','style_3'],
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .info-box-bg-box' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'main_style' => ['style_1','style_3'],
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .info-box-bg-box,{{WRAPPER}} .pt_plus_info_box .info-box-inner .infobox-overlay-color' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'main_style' => ['style_1','style_3'],
					'box_border' => 'yes',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_border_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
				'condition' => [
					'box_border' => 'yes',
				],
			]
		);
		$this->add_control(
			'box_border_hover_color',
			[
				'label' => __( 'Border Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#252525',
				'selectors'  => [
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .info-box-bg-box' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'main_style' => ['style_1','style_3'],
					'box_border' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'border_hover_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .info-box-bg-box,{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .infobox-overlay-color' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'main_style' => ['style_1','style_3'],
					'box_border' => 'yes',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'border_check_right',
			[
				'label' => __( 'Side image Border', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'default' => 'yes',
				'condition' => [
					'main_style' => ['style_1'],
				],
			]
		);
		$this->add_control(
			'border_right_color',
			[
				'label' => __( 'Border Right Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#252525',
				'condition' => [
					'main_style' => ['style_1'],
					'border_check_right' => 'yes',
				],
			]
		);
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
				'selector'  => '{{WRAPPER}} .pt_plus_info_box .info-box-inner .info-box-bg-box',
				
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
				'selector'  => '{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .info-box-bg-box',
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
			'tab_shadow_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow',
				'selector' => '{{WRAPPER}} .pt_plus_info_box .info-box-inner .info-box-bg-box',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_shadow_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_hover_shadow',
				'selector' => '{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .info-box-bg-box',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*background option*/
		/*button style*/
		$this->start_controls_section(
            'section_button_styling',
            [
                'label' => __('Button Style', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'display_button' => 'yes',
				],
            ]
        );
		$this->add_control(
            'button_top_space',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Button Above Space', 'theplus'),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 2,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .pt-plus-button-wrapper' => 'margin-top: {{SIZE}}{{UNIT}}',
				],
				'separator' => 'after',
				'condition' => [
					'display_button' => 'yes',
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
				'separator' => 'after',
				'condition' => [
					'button_style!' => ['style-7','style-9'],
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
				'condition' => [
					'button_style' => ['style-8'],
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
				'condition' => [
					'button_style' => ['style-8'],
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
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'button_style' => ['style-8'],
					'button_border_style!' => 'none'
				],
				'separator' => 'after',
			]
		);

		$this->add_responsive_control(
			'button_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'button_style' => ['style-8'],
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_shadow',
				'selector' => '
							   {{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap',
				'condition' => [
					'button_style' => ['style-8'],
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
					'{{WRAPPER}} .pt_plus_button .button-link-wrap:hover,{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .pt_plus_button .hover_box_button' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'button_hover_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .pt_plus_button .hover_box_button',
				'separator' => 'after',
				'condition' => [
					'button_style!' => ['style-7','style-9'],
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
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .pt_plus_button .hover_box_button' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'button_style' => ['style-8'],
					'button_border_style!' => 'none'
				],
				'separator' => 'after',
			]
		);

		$this->add_responsive_control(
			'button_hover_radius',
			[
				'label'      => __( 'Hover Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .pt_plus_button .hover_box_button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'button_style' => ['style-8'],
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_hover_shadow',
				'selector' => '{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .pt_plus_button .hover_box_button',
				'condition' => [
					'button_style' => ['style-8'],
				],
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->end_controls_section();
		/*button style*/
		/*svg style*/
		$this->start_controls_section(
            'section_svg_styling',
            [
                'label' => __('Svg Style', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition'    => [
					'image_icon' => [ 'svg' ],
				],
            ]
        );
		$this->add_control(
			'plus_pro_svg_icon_style_options',
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
                'label' => __('Icon Style', 'theplus'),
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
					'hexa-pro' => __( 'Hexagon (PRO)', 'theplus' ),
					'penta-pro' => __( 'Pentagon (PRO)', 'theplus' ),
					'square-rotate-pro' => __( 'Square Rotate (PRO)', 'theplus' ),
				],
			]
		);
		$this->add_responsive_control(
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
		$this->add_responsive_control(
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
		$this->add_responsive_control(
			'icon_border_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'icon_box_shadow',
				'selector' => '{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon',
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
		$this->add_responsive_control(
			'icon__hover_border_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'icon_hover_box_shadow',
				'selector' => '{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-icon',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();		
		$this->end_controls_section();		
		/*icon style*/
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
				'plus_pro_carousel_style_options',
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
		$this->end_controls_section();
		/*carousel option*/
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .info-box-bg-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'vertical_center',
			[
				'label' => __( 'Vertical Center', 'theplus' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'theplus' ),
				'label_off' => __( 'Off', 'theplus' ),				
				'default' => 'no',
				'condition'    => [
					'main_style' => ['style_1'],
				],
			]
		);
		$this->add_control(
			'tilt_parallax',
			[
				'label'        => esc_html__( 'Tilt 3D Parallax', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'theplus' ),
				'label_off'    => esc_html__( 'No', 'theplus' ),					
				'render_type'  => 'template',
				'separator' => 'before',
				'condition'    => [
					'main_style' => ['style_3'],
				],
			]
		);
		$this->add_control(
			'plus_pro_tilt_parallax_style_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
				'condition'    => [
					'main_style' => ['style_3'],
					'tilt_parallax' => 'yes',
				],
			]
		);
		$this->add_control(
			'messy_column',
			[
				'label' => __( 'Messy Columns', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
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
					'messy_column' => 'yes',
				],
			]
		);
		$this->add_control(
			'min_height_section',[
				'label'   => esc_html__( 'Minimum Height Section', 'theplus' ),
				'type'    =>  Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( 'Yes', 'theplus' ),
				'label_off' => __( 'No', 'theplus' ),
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
            'minimum_height',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Minimum Height', 'theplus'),
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 40,
						'max' => 700,
						'step' => 5,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 350,
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .info-box-bg-box' => 'min-height: {{SIZE}}{{UNIT}};display: -webkit-box;display: -ms-flexbox;display: flex;-webkit-box-orient: vertical;-webkit-align-items: center;-ms-align-items: center;align-items: center;',
				],
				'condition'    => [
					'min_height_section' => 'yes',
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
		$main_style = $settings["main_style"];
		
		$hover_class  = $hover_attr = '';
		
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
				
		$service_title = $description= $service_img = $service_center= $service_align = $service_border = $service_icon_style= $service_space = $serice_box_border =$serice_img_border=$border_right_css=$imge_content=$title_css=$subtitle_css=$output='';
		
		$text_align=$settings["text_align"];
		if($text_align == 'left'){
			$service_align = 'text-left';
		}
		if($text_align == 'center'){
			$service_align = 'text-center';
		}
		if($text_align == 'right'){
			$service_align = 'text-right';
		} 
		if($settings['box_border'] == 'yes'){
			$serice_box_border ='service-border-box';		
		}
		if($settings['vertical_center'] == 'yes'){
			$service_center = 'vertical-center';
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
				$icons = $settings["icon_fontawesome"];
			}else{
				$icons = '';
			}
			if(!empty($icons)){
				$service_img = '<i class=" '.esc_attr($icons).' service-icon '.esc_attr($service_icon_style).'"></i>';
			}
		}
		$border_stroke_color='none';
		
		if($settings['border_check_right'] == 'yes'){
			$serice_img_border ='service-img-border';
			$border_right_css = ' style="';
			if($settings['border_right_color'] != "") {
			$border_right_css .= 'border-color: '.esc_attr($settings["border_right_color"]).';';
			}		
			$border_right_css .= '"';
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
				$service_title= '<a '.$this->get_render_attribute_string( "box_link" ).' ><div class="service-title "> '.esc_html($settings["title"]).' </div></a>';
			}else{
				$service_title= '<div class="service-title "> '.esc_html($settings["title"]).' </div>';
			}
		}
		
		$border_check=$settings["border_check"];
		if($border_check == 'yes'){
			$service_border = '<div class="service-border"> </div>' ;
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
		$hover_box_class = (!empty($settings["hover_info_button"]) && $settings["hover_info_button"]=='yes') ? ' hover_box_button' : '';
		$this->add_render_attribute( 'button', 'class', $hover_box_class );
		$this->add_render_attribute( 'button', 'role', 'button' );
		
		$button_style = $settings['button_style'];
		$button_text = $settings['button_text'];
		$btn_uid=uniqid('btn');
		$data_class= $btn_uid;
		$data_class .=' button-'.$button_style.' ';
		
		
		$the_button ='<div class="pt-plus-button-wrapper">';
			$the_button .='<div class="button_parallax">';
				$the_button .='<div class="ts-button">';
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
		
		
		if ($info_box_layout == 'single_layout'){	
			$output = '<div class="info-box-inner content_hover_effect '. esc_attr($hover_class) .' "  >';	
			if($main_style == 'style_1'){
				$output .= '<div class="info-box-bg-box '.esc_attr($serice_box_border).'">';
					$output .= '<div class="service-media text-left '.esc_attr($service_center).' ">';	
					if($service_img != ''){				
						$output .= '<div class="m-r-16 '.esc_attr($serice_img_border).'" '.$border_right_css.'> '.$service_img.' </div>';
					}
						$output .= '<div class="service-content ">';
							$output .= $service_title;
							$output .= $service_border;
							$output .= $description;
							$output .= $the_button;
						$output .= '</div>';
					$output .= '</div>';
				$output .= '</div>';	
			}
			if($main_style == 'style_3'){
				$output .= '<div class="info-box-bg-box '.esc_attr($serice_box_border).'">';
					$output .= '<div class="'.esc_attr($service_align).'">';
						$output .= '<div class="service-center  ">';
							$output .= $service_img;
							$output .= $service_title;
							$output .= $service_border;
							$output .= $description;
							$output .= $the_button;
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
			
		$uid=uniqid('info_box');
		
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
		
		if($button_style=='style-8'){
			$button_text =$icons_before . $button_text . $icons_after;
		}		
		return $button_text;
	}
}