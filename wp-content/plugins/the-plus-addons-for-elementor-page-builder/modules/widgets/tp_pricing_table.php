<?php 
/*
Widget Name: Pricing Table
Description: unique design of pricing table.
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


class ThePlus_Pricing_Table extends Widget_Base {
		
	public function get_name() {
		return 'tp-pricing-table';
	}

    public function get_title() {
        return __('Pricing Table', 'theplus');
    }

    public function get_icon() {
        return 'fa fa-money theplus_backend_icon';
    }

    public function get_categories() {
        return array('plus-essential');
    }
	public function get_style_depends() {
		return [ 'theplus-pricing-table' ];
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
				'label' => __( 'Layout', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'pricing_table_style',
			[
				'label' => __( 'Style', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1'  => __( 'Style 1', 'theplus' ),
					'style-2'  => __( 'Style 2 (PRO)', 'theplus' ),
					'style-3'  => __( 'Style 3 (PRO)', 'theplus' ),
				],
			]
		);
		$this->add_control(
			'plus_pro_pricing_table_style_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
				'condition'    => [
					'pricing_table_style!' => 'style-1',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'title_content_section',
			[
				'label' => __( 'Title Section', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'pricing_table_style' => 'style-1',
				],
			]
		);
		$this->add_control(
			'title_heading',
			[
				'label' => __( 'Title', 'theplus' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'title_style',
			[
				'label' => __( 'Title Style', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1'  => __( 'Style 1', 'theplus' ),
				],
			]
		);
		$this->add_control(
			'pricing_title',
			[
				'label' => __( 'Title', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Professional', 'theplus' ),
			]
		);
		$this->add_control(
			'pricing_subtitle',
			[
				'label' => __( 'Sub Title', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
			]
		);
		$this->add_control(
			'icons_heading',
			[
				'label' => __( 'Icon Options', 'theplus' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'image_icon',
			[
				'label' => __( 'Select Icon', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'description' => __('You can select Icon, Custom Image or SVG using this option.','theplus'),
				'default' => '',
				'options' => [
					''  => __( 'None', 'theplus' ),
					'icon' => __( 'Icon', 'theplus' ),
					'image' => __( 'Image', 'theplus' ),
					'svg' => __( 'Svg (PRO)', 'theplus' ),
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
				'condition'    => [
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
					'image_icon' => 'icon',
					'icon_font_style' => 'icon_mind',
				],
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'price_content_section',
			[
				'label' => __( 'Price', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'pricing_table_style' => 'style-1',
				],
			]
		);
		$this->add_control(
			'price_style',
			[
				'label' => __( 'Price Style', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1'  => __( 'Style 1', 'theplus' ),
					'style-2'  => __( 'Style 2 (PRO)', 'theplus' ),
					'style-3'  => __( 'Style 3 (PRO)', 'theplus' ),
				],
			]
		);
		$this->add_control(
			'plus_pro_price_style_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
				'condition'    => [
					'price_style!' => 'style-1',
				],
			]
		);
		$this->add_control(
			'price_prefix',
			[
				'label' => __( 'Prefix Text', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '$', 'theplus' ),
				'placeholder' => __( 'Enter text of Price Prefix.. Ex. $,Rs,...', 'theplus' ),
				'condition'    => [
					'price_style' => 'style-1',
				],
			]
		);
		$this->add_control(
			'price',
			[
				'label' => __( 'Value Of Price', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '59.99', 'theplus' ),
				'placeholder' => __( 'Enter value of Price.. Ex. 49,69...', 'theplus' ),
				'condition'    => [
					'price_style' => 'style-1',
				],
			]
		);
		$this->add_control(
			'price_postfix',
			[
				'label' => __( 'Postfix Text', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Per Month', 'theplus' ),
				'placeholder' => __( 'Enter text of Price Postfix.. Ex. Per Month...', 'theplus' ),
				'condition'    => [
					'price_style' => 'style-1',
				],
			]
		);
		$this->end_controls_section();
		/*Previous Price*/
		$this->start_controls_section(
			'previous_price_content_section',
			[
				'label' => __( 'Previous Price', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'pricing_table_style' => 'style-1',
				],
			]
		);
		$this->add_control(
			'show_previous_price',
			[
				'label'        => esc_html__( 'Display Previous Price', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'theplus' ),
				'label_off'    => esc_html__( 'No', 'theplus' ),
			]
		);
		$this->add_control(
			'previous_price_prefix',
			[
				'label' => __( 'Prefix Text', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '$', 'theplus' ),
				'placeholder' => __( 'Enter text of Price Prefix.. Ex. $,Rs,...', 'theplus' ),
				'condition' => [
					'show_previous_price' => 'yes',
				],
			]
		);
		$this->add_control(
			'previous_price',
			[
				'label' => __( 'Value Of Price', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '59.99', 'theplus' ),
				'placeholder' => __( 'Enter value of Price.. Ex. 49,69...', 'theplus' ),
				'condition' => [
					'show_previous_price' => 'yes',
				],
			]
		);
		$this->add_control(
			'previous_price_postfix',
			[
				'label' => __( 'Postfix Text', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'theplus' ),
				'placeholder' => __( 'Enter text of Price Postfix.. Ex. Rs,%..', 'theplus' ),
				'condition' => [
					'show_previous_price' => 'yes',
				],
			]
		);
		$this->end_controls_section();
		/*Previous Price*/
		$this->start_controls_section(
			'content_description_section',
			[
				'label' => __( 'Content Description', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'pricing_table_style' => 'style-1',
				],
			]
		);
		$this->add_control(
			'content_style',
			[
				'label' => __( 'Content Style', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'wysiwyg_content',
				'options' => [
					'stylist_list'  => __( 'Stylish List (PRO)', 'theplus' ),
					'wysiwyg_content'  => __( 'WYSIWYG', 'theplus' ),
				],
			]
		);
		$this->add_control(
			'plus_pro_content_list_style_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
				'condition' => [
					'content_style' => 'stylist_list',
				],
			]
		);
		$this->add_control(
			'content_wysiwyg_style',
			[
				'label' => __( 'Content Style', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1'  => __( 'Style 1', 'theplus' ),
					'style-2'  => __( 'Style 2', 'theplus' ),
				],
				'condition' => [
					'content_style' => 'wysiwyg_content',
				],
			]
		);
		$this->add_control(
			'content_wysiwyg',
			[
				'label' => __( 'Content', 'theplus' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => __( 'Luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'theplus' ),
				'condition' => [
					'content_style' => 'wysiwyg_content',
				],
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
            'button_section',
            [
                'label' => __('Button', 'theplus'),
                'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'pricing_table_style' => 'style-1',
				],
            ]
        );
		$this->add_control(
			'display_button',
			[
				'label' => __( 'Button', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Enable', 'theplus' ),
				'label_off' => __( 'Disable', 'theplus' ),
				'default' => 'yes',
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
				'default' => __( 'Free Trial', 'theplus' ),
				'condition' => [
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
					'display_button' => 'yes',
					'button_style!' => ['style-7','style-9'],
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
					'display_button' => 'yes',
					'button_style!' => ['style-7','style-9'],
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
					'display_button' => 'yes',
					'button_style!' => ['style-7','style-9'],
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
					'display_button' => 'yes',
					'button_style!' => ['style-7','style-9'],
					'button_icon_style!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .button-link-wrap i.button-after' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .button-link-wrap i.button-before' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]			
		);
		$this->end_controls_section();
		/* button content*/
		/*Call to Action*/
		$this->start_controls_section(
            'call_to_action_section',
            [
                'label' => __('Call to Action', 'theplus'),
                'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'pricing_table_style' => 'style-1',
				],
            ]
        );
		$this->add_control(
			'plus_pro_call_to_action_text_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
				
			]
		);
		$this->end_controls_section();
		/*Call to Action*/
		
		/*svg style*/
		$this->start_controls_section(
            'section_svg_styling',
            [
                'label' => __('Svg Style', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'image_icon' => 'svg',
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
					'image_icon' => 'svg',
				],
			]
		);
		$this->end_controls_section();
		/*svg style*/
		/* icons style */
		$this->start_controls_section(
            'section_icon_styling',
            [
                'label' => __('Icon Style', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'image_icon' => 'icon',
				],
            ]
        );
		$this->add_control(
			'icon_style',
			[
				'label' => __( 'Icon Style', 'theplus' ),
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
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner .pricing-icon' => 'font-size: {{SIZE}}{{UNIT}} !important;',
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
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner .pricing-icon' => 'width: {{SIZE}}{{UNIT}} !important;height: {{SIZE}}{{UNIT}} !important;line-height: {{SIZE}}{{UNIT}} !important;text-align: center;',
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
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner .pricing-icon' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner .pricing-icon' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{icon_gradient_color1.VALUE}} {{icon_gradient_color1_control.SIZE}}{{icon_gradient_color1_control.UNIT}}, {{icon_gradient_color2.VALUE}} {{icon_gradient_color2_control.SIZE}}{{icon_gradient_color2_control.UNIT}})',
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
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner .pricing-icon' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{icon_gradient_color1.VALUE}} {{icon_gradient_color1_control.SIZE}}{{icon_gradient_color1_control.UNIT}}, {{icon_gradient_color2.VALUE}} {{icon_gradient_color2_control.SIZE}}{{icon_gradient_color2_control.UNIT}})',
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
				'selector'  => '{{WRAPPER}} .plus-pricing-table .pricing-table-inner .pricing-icon',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'icon_border_color',
			[
				'label' => __( 'Border Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner .pricing-icon' => 'border-color: {{VALUE}}',
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
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner .pricing-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'icon_box_shadow',
				'selector' => '{{WRAPPER}} .plus-pricing-table .pricing-table-inner .pricing-icon',
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
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-icon' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-icon' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{icon_hover_gradient_color1.VALUE}} {{icon_hover_gradient_color1_control.SIZE}}{{icon_hover_gradient_color1_control.UNIT}}, {{icon_hover_gradient_color2.VALUE}} {{icon_hover_gradient_color2_control.SIZE}}{{icon_hover_gradient_color2_control.UNIT}})',
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
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-icon' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{icon_hover_gradient_color1.VALUE}} {{icon_hover_gradient_color1_control.SIZE}}{{icon_hover_gradient_color1_control.UNIT}}, {{icon_hover_gradient_color2.VALUE}} {{icon_hover_gradient_color2_control.SIZE}}{{icon_hover_gradient_color2_control.UNIT}})',
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
				'selector'  => '{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-icon',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'icon_border_hover_color',
			[
				'label' => __( 'Hover Border Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-icon' => 'border-color: {{VALUE}}',
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
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'icon_hover_box_shadow',
				'selector' => '{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-icon',
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
                'label' => __('Title Style', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'pricing_title!' => '',
				],
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .plus-pricing-table .pricing-title',
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
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-title' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .plus-pricing-table .pricing-title' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{title_gradient_color1.VALUE}} {{title_gradient_color1_control.SIZE}}{{title_gradient_color1_control.UNIT}}, {{title_gradient_color2.VALUE}} {{title_gradient_color2_control.SIZE}}{{title_gradient_color2_control.UNIT}})',
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
					'{{WRAPPER}} .plus-pricing-table .pricing-title' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{title_gradient_color1.VALUE}} {{title_gradient_color1_control.SIZE}}{{title_gradient_color1_control.UNIT}}, {{title_gradient_color2.VALUE}} {{title_gradient_color2_control.SIZE}}{{title_gradient_color2_control.UNIT}})',
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
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-title' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-title' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{title_hover_gradient_color1.VALUE}} {{title_hover_gradient_color1_control.SIZE}}{{title_hover_gradient_color1_control.UNIT}}, {{title_hover_gradient_color2.VALUE}} {{title_hover_gradient_color2_control.SIZE}}{{title_hover_gradient_color2_control.UNIT}})',
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
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-title' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{title_hover_gradient_color1.VALUE}} {{title_hover_gradient_color1_control.SIZE}}{{title_hover_gradient_color1_control.UNIT}}, {{title_hover_gradient_color2.VALUE}} {{title_hover_gradient_color2_control.SIZE}}{{title_hover_gradient_color2_control.UNIT}})',
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
		$this->end_controls_section();
		/*title style*/
		/*subtitle style*/
		$this->start_controls_section(
            'section_subtitle_styling',
            [
                'label' => __('SubTitle Style', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'pricing_subtitle!' => '',
				],
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'label' => __( 'Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .plus-pricing-table .pricing-table-inner .pricing-subtitle',
			]
		);
		$this->add_control(
			'subtitle_color',
			[
				'label' => __( 'Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner .pricing-subtitle' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'subtitle_Hover_color',
			[
				'label' => __( 'Hover Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-subtitle' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();
		/*subtitle style*/
		/*Previous Price Style*/
		$this->start_controls_section(
            'section_previous_price_styling',
            [
                'label' => __('Previous Price Style', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_previous_price' => 'yes',
				],
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'previous_price_typography',
				'label' => __( 'Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .plus-pricing-table .pricing-previous-price-wrap',
			]
		);
		$this->add_control(
			'previous_price_align',
			[
				'label' => __( 'Price Alignment', 'theplus' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'top' => [
						'title' => __( 'Top', 'theplus' ),
						'icon' => 'fa fa-level-up',
					],
					'middle' => [
						'title' => __( 'Middle', 'theplus' ),
						'icon' => 'fa fa-align-center',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'theplus' ),
						'icon' => 'fa fa-level-down',
					],
				],
				'default' => 'top',
				'toggle' => true,
				'label_block' => false,
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-previous-price-wrap' => 'vertical-align: {{VALUE}};',
				],
			]
		);
		$this->start_controls_tabs( 'previous_price_style_tab' );
		$this->start_controls_tab(
			'previous_price_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
			]
		);
		
		$this->add_control(
			'previous_price_color',
			[
				'label' => __( 'Price Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-previous-price-wrap' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'previous_price_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
			]
		);
		$this->add_control(
			'previous_price_hover_color',
			[
				'label' => __( 'Price Hover Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-previous-price-wrap' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*Previous Price Style*/		
		/*Price Style */
		$this->start_controls_section(
            'section_price_styling',
            [
                'label' => __('Price Style', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
			'price_style_heading',
			[
				'label' => __( 'Price Main', 'theplus' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'price_typography',
				'label' => __( 'Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .plus-pricing-table .pricing-price-wrap.style-1 span.price-prefix-text,{{WRAPPER}} .plus-pricing-table .pricing-price-wrap.style-1 .pricing-price',
			]
		);
		$this->start_controls_tabs( 'price_style_tab' );
		$this->start_controls_tab(
			'price_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
			]
		);
		
		$this->add_control(
			'price_color',
			[
				'label' => __( 'Price Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-price-wrap.style-1 span.price-prefix-text,{{WRAPPER}} .plus-pricing-table .pricing-price-wrap.style-1 .pricing-price' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'price_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
			]
		);
		$this->add_control(
			'price_hover_color',
			[
				'label' => __( 'Price Hover Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-price-wrap.style-1 span.price-prefix-text,{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-price-wrap.style-1 .pricing-price' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'price_postfix_style_heading',
			[
				'label' => __( 'Postfix', 'theplus' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'price_postfix_typography',
				'label' => __( 'Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .plus-pricing-table .pricing-price-wrap.style-1 span.price-postfix-text',
			]
		);
		$this->start_controls_tabs( 'price_postfix_style_tab' );
		$this->start_controls_tab(
			'price_postfix_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
			]
		);
		
		$this->add_control(
			'price_postfix_color',
			[
				'label' => __( 'Postfix Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-price-wrap span.price-postfix-text' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'price_postfix_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
			]
		);
		$this->add_control(
			'price_postfix_hover_color',
			[
				'label' => __( 'Postfix Hover Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-price-wrap span.price-postfix-text' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*Price Style */
		/*Content style*/
		$this->start_controls_section(
            'section_content_styling',
            [
                'label' => __('Content Style', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => __( 'Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.content-desc .pricing-content',
				'condition' => [
					'content_style' => 'wysiwyg_content',
				],
			]
		);
		$this->add_control(
			'content_text_color',
			[
				'label' => __( 'Content Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.content-desc .pricing-content,{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.content-desc .pricing-content p' => 'color: {{VALUE}};',
				],
				'condition' => [
					'content_style' => 'wysiwyg_content',
				],
			]
		);
		$this->add_control(
			'content_border_width_color',
			[
				 'type' => Controls_Manager::SLIDER,
				'label' => __('Border Width', 'theplus'),
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 2,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 2,
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.content-desc.style-1 hr.border-line' => 'margin: 30px {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'content_style' => 'wysiwyg_content',
					'content_wysiwyg_style' => 'style-1'
				],
			]
		);
		$this->add_control(
			'content_border_top_color',
			[
				'label' => __( 'Border Top Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.content-desc.style-1 hr.border-line' => 'border-top:1px solid;border-top-color: {{VALUE}};',
				],
				'condition' => [
					'content_style' => 'wysiwyg_content',
					'content_wysiwyg_style' => 'style-1'
				],
			]
		);
		
		$this->end_controls_section();
		/*Content style*/
		
		$this->start_controls_section(
            'section_tooltip_option_styling',
            [
                'label' => __('Tooltip Options', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
			'plus_pro_tooltip_option_styling_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
			]
		);
		$this->end_controls_section();
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
					'{{WRAPPER}} .pt-plus-button-wrapper' => 'margin-top: {{SIZE}}{{UNIT}}',
				],
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
				'size_units' => [ 'px', 'em'],
				'default' => [
							'top' => '8',
							'right' => '35',
							'bottom' => '8',
							'left' => '35',
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
					'{{WRAPPER}} .pt_plus_button .button-link-wrap:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'button_hover_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover',
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
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover',
				'condition' => [
					'button_style' => ['style-8'],
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
		$this->add_responsive_control(
			'bg_padding',
			[
				'label' => __( 'Inner Padding', 'theplus' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table.pricing-style-1 .pricing-table-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
					'{{WRAPPER}} .plus-pricing-table.pricing-style-1 .pricing-table-inner' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .plus-pricing-table.pricing-style-1 .pricing-table-inner' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .plus-pricing-table.pricing-style-1 .pricing-table-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
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
					'{{WRAPPER}} .plus-pricing-table.pricing-style-1:hover .pricing-table-inner' => 'border-color: {{VALUE}};',
				],
				'condition' => [
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
					'{{WRAPPER}} .plus-pricing-table.pricing-style-1:hover .pricing-table-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'box_border' => 'yes',
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
				'selector'  => '{{WRAPPER}} .plus-pricing-table.pricing-style-1 .pricing-table-inner',
				
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
				'selector'  => '{{WRAPPER}} .plus-pricing-table.pricing-style-1:hover .pricing-table-inner',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		
		$this->end_controls_section();
		/*background option*/
		/*Extra option*/
		$this->start_controls_section(
            'section_extra_options_styling',
            [
                'label' => __('Extra Effects', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
            'transform_scale',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Scale Zoom', 'theplus'),
				'default' => [
					'unit' => '',
					'size' => 1,
				],
				'range' => [
					'' => [
						'min'	=> 0.6,
						'max'	=> 1.8,
						'step' => 0.05,
					],
				],
				'render_type' => 'ui',
				'selectors'  => [
					'{{WRAPPER}} .plus-pricing-table.pricing-style-1 .pricing-table-inner' => 'transform: scale({{SIZE}});',
				],
            ]
        );
		$this->end_controls_section();
		/*Extra option*/
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
		$pricing_style = $settings["pricing_table_style"];
		$title_style = $settings["title_style"];
		
		
		/*title */
		$pricing_title = $settings["pricing_title"];
		$title='';
		if(!empty($pricing_title)){
			$title .='<div class="pricing-title-wrap">';
				$title .='<div class="pricing-title">'.esc_attr($pricing_title).'</div>';
			$title .='</div>';
		}
		/*title */
		
		/*subtitle */
		$pricing_subtitle = $settings["pricing_subtitle"];
		$subtitle='';
		if(!empty($pricing_subtitle)){
			$subtitle .='<div class="pricing-subtitle-wrap">';
				$subtitle .='<div class="pricing-subtitle">'.esc_attr($pricing_subtitle).'</div>';
			$subtitle .='</div>';
		}
		/*subtitle */
		
		/* Icon content */
		$icons_content='';
		$image_icon=$settings["image_icon"];
		if($image_icon == 'image'){
			if($settings["select_image"]["url"]!=''){
				$imgSrc = $settings["select_image"]["url"];
			}else{
				$imgSrc = '';
			}
			$icons_content='<div class="pricing-icon"><img src="'.esc_url($imgSrc).'"   class="pricing-icon-img" alt="'.esc_attr__("icon","theplus").'" /></div>';
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
				$icons_content = '<div class="pricing-icon '.esc_attr($service_icon_style).'"><i class=" '.esc_attr($icons).' "></i></div>';
			}
		}
		
		/* Icon content */
		
		/*content description*/
		$content_style = $settings['content_style'];
		$pricing_content ='';
		$i=0;
		if($content_style =='wysiwyg_content' && !empty($settings["content_wysiwyg"])){
			$pricing_content .='<div class="pricing-content-wrap content-desc '.$settings["content_wysiwyg_style"].'">';
				if($settings["content_wysiwyg_style"]=='style-1'){
					$pricing_content .='<hr class="border-line" />';
				}
				$pricing_content .='<div class="pricing-content">';
					$pricing_content .=$settings["content_wysiwyg"];
				$pricing_content .='</div>';
				$pricing_content .= '<div class="content-overlay-bg-color"></div>';
			$pricing_content .='</div>';
		}
		/*content description*/
		
		/*Previous Price*/
		$previous_price_content='';
		if(!empty($settings['show_previous_price']) && $settings['show_previous_price']=='yes'){
			$previous_price_prefix = $settings["previous_price_prefix"];
			$previous_price = $settings["previous_price"];
			$previous_price_postfix = $settings["previous_price_postfix"];
			$previous_price_content .='<span class="pricing-previous-price-wrap">'.$previous_price_prefix.$previous_price.$previous_price_postfix.'</span>';			
		}
		/*Previous Price*/
		
		/*Price content*/
		$price_style=$settings["price_style"];
		$price_prefix = $settings["price_prefix"];
		$price = $settings["price"];
		$price_postfix = $settings["price_postfix"];
		
		$price_content ='<div class="pricing-price-wrap '.$price_style.'">';
			$price_content .= $previous_price_content;
			if(!empty($price_prefix)){
				$price_content .='<span class="price-prefix-text">'.$price_prefix.'</span>';
			}
			if(!empty($price)){
				$price_content .='<span class="pricing-price">'.$price.'</span>';
			}
			if(!empty($price_postfix)){
				$price_content .='<span class="price-postfix-text">'.$price_postfix.'</span>';
			}
		$price_content .='</div>';
		/*Price content*/
		
		/* button */
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
	
		/* button */
		
		$title_style_content='';
		if($settings["title_style"]=='style-1'){
				$title_style_content .='<div class="pricing-title-content style-1">';
					$title_style_content .=$icons_content;
					$title_style_content .=$title;
					$title_style_content .=$subtitle;
				$title_style_content .='</div>';
		}
				
		$pricing_output='';
		if($pricing_style=='style-1'){
			$pricing_output .= $title_style_content;
			$pricing_output .= $price_content;
			$pricing_output .= $the_button;
			$pricing_output .= $pricing_content;
			$pricing_output .= '<div class="pricing-overlay-color"></div>';			
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
			
			
			$output = '<div id="plus-pricing-table" class="plus-pricing-table pricing-'.esc_attr($pricing_style).' '.esc_attr($animated_class).'" '.$animation_attr.'>';
				$output .= '<div class="pricing-table-inner">';
					$output .= $pricing_output;
				$output .='</div>';
				
			$output .='</div>';
		echo $output;
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
