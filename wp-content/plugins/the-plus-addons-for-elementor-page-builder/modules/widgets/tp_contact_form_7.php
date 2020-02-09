<?php 
/*
Widget Name: Contact Form 7
Description: Third party plugin contact form 7 style.
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


class ThePlus_Contact_Form_7 extends Widget_Base {
		
	public function get_name() {
		return 'tp-contact-form-7';
	}

    public function get_title() {
        return __('Contact Form 7', 'theplus');
    }

    public function get_icon() {
        return 'fa fa-envelope theplus_backend_icon';
    }

    public function get_categories() {
        return array('plus-adapted');
    }
	public function get_style_depends() {
		return [ 'tp-columns-bootstrap','plus-cf7-style'];
	}
    public function get_script_depends() {
        return [
            'theplus_frontend_scripts'
        ];
    }

    protected function _register_controls() {
		/*Layout Content*/
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'contact_form',
			[
				'label' => __( 'Select Form', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'options' => theplus_get_contact_form_post(),
			]
		);
		$this->add_control(
			'form_style',
			[
				'label' => __( 'Style', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => theplus_get_style_list(1),
			]
		);
		$this->add_control(
			'content_align',
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
				'default' => 'center',
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
			]
		);
		$this->end_controls_section();
		/*Layout Content*/
		/*Extra option*/
		$this->start_controls_section(
			'extra_content_section',
			[
				'label' => __( 'Extra Options', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'outer_field_class',
			[
				'label' => __( 'Outer Section Styling', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'label',
				'options' => [
					'label'  => __( 'Default Label Field', 'theplus' ),
					'custom'  => __( 'Custom Class (PRO)', 'theplus' ),
				],
				'description' => esc_html__( 'For Outer Section you can select styling option values to Label or to Custom class.','theplus'),
			]
		);
		$this->add_control(
			'plus_pro_outer_field_class_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
				'condition' => [
					'outer_field_class' => 'custom',
				],
			]
		);
		$this->end_controls_section();
		/*Extra option*/		
		/*Input Field Style*/
		$this->start_controls_section(
			'section_style_input',
			[
				'label' => esc_html__( 'Input Fields Styling', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'input_typography',
				'selector' => '{{WRAPPER}} .theplus-contact-form .wpcf7-form-control:not(.wpcf7-submit):not(.wpcf7-checkbox):not(.wpcf7-radio):not(.wpcf7-file)',
			]
		);
		$this->add_control(
			'input_placeholder_color',
			[
				'label'     => esc_html__( 'Placeholder Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .theplus-contact-form .wpcf7-form-control:not(.wpcf7-submit):not(.wpcf7-checkbox):not(.wpcf7-radio):not(.wpcf7-file)::placeholder' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'input_inner_padding',
			[
				'label' => __( 'Inner Padding', 'theplus' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%'],
				'selectors' => [
					'{{WRAPPER}} .theplus-contact-form .wpcf7-form-control:not(.wpcf7-submit):not(.wpcf7-checkbox):not(.wpcf7-radio):not(.wpcf7-file)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);
		$this->start_controls_tabs( 'tabs_input_field_style' );
		$this->start_controls_tab(
			'tab_input_field_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
			]
		);
		$this->add_control(
			'input_field_color',
			[
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .theplus-contact-form .wpcf7-form-control:not(.wpcf7-submit):not(.wpcf7-checkbox):not(.wpcf7-radio):not(.wpcf7-file)' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'input_field_bg',
				'types'     => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .theplus-contact-form .wpcf7-form-control:not(.wpcf7-submit):not(.wpcf7-checkbox):not(.wpcf7-radio):not(.wpcf7-file)',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_input_field_focus',
			[
				'label' => __( 'Focus', 'theplus' ),
			]
		);
		$this->add_control(
			'input_field_focus_color',
			[
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .theplus-contact-form .wpcf7-form-control:not(.wpcf7-submit):not(.wpcf7-checkbox):not(.wpcf7-radio):not(.wpcf7-file):focus' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'input_field_focus_bg',
				'types'     => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .theplus-contact-form .wpcf7-form-control:not(.wpcf7-submit):not(.wpcf7-checkbox):not(.wpcf7-radio):not(.wpcf7-file):focus',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'input_border_options',
			[
				'label' => __( 'Border Options', 'theplus' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
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
			'border_style',
			[
				'label' => __( 'Border Style', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => theplus_get_border_style(),
				'selectors'  => [
					'{{WRAPPER}} .theplus-contact-form .wpcf7-form-control:not(.wpcf7-submit):not(.wpcf7-checkbox):not(.wpcf7-radio):not(.wpcf7-file)' => 'border-style: {{VALUE}};',
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
					'{{WRAPPER}} .theplus-contact-form .wpcf7-form-control:not(.wpcf7-submit):not(.wpcf7-checkbox):not(.wpcf7-radio):not(.wpcf7-file)' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'box_border' => 'yes',
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
		$this->add_control(
			'box_border_color',
			[
				'label' => __( 'Border Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#252525',
				'selectors'  => [
					'{{WRAPPER}} .theplus-contact-form .wpcf7-form-control:not(.wpcf7-submit):not(.wpcf7-checkbox):not(.wpcf7-radio):not(.wpcf7-file)' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .theplus-contact-form .wpcf7-form-control:not(.wpcf7-submit):not(.wpcf7-checkbox):not(.wpcf7-radio):not(.wpcf7-file)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_border_hover',
			[
				'label' => __( 'Focus', 'theplus' ),
			]
		);
		$this->add_control(
			'box_border_hover_color',
			[
				'label' => __( 'Border Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors'  => [
					'{{WRAPPER}} .theplus-contact-form .wpcf7-form-control:not(.wpcf7-submit):not(.wpcf7-checkbox):not(.wpcf7-radio):not(.wpcf7-file):focus' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .theplus-contact-form .wpcf7-form-control:not(.wpcf7-submit):not(.wpcf7-checkbox):not(.wpcf7-radio):not(.wpcf7-file):focus' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		
		$this->end_controls_section();
		/*Input Field Style*/		
		/*Checkbox Field Style*/
		$this->start_controls_section(
            'section_checked_styling',
            [
                'label' => __('CheckBox/Radio Field', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		
		$this->start_controls_tabs( 'tabs_checkbox_field_style' );
		$this->start_controls_tab(
			'tab_unchecked_field_bg',
			[
				'label' => __( 'Check Box', 'theplus' ),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'checkbox_typography',
				'selector' => '{{WRAPPER}} .theplus-contact-form span.wpcf7-form-control-wrap .input__checkbox_btn',
			]
		);
		$this->add_control(
			'checked_field_color',
			[
				'label'     => esc_html__( 'Checked Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .theplus-contact-form .input__checkbox_btn .toggle-button__icon:after' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'unchecked_field_bgcolor',
			[
				'label'     => esc_html__( 'UnChecked Bg Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .theplus-contact-form .input__checkbox_btn .toggle-button__icon' => 'background: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'checked_field_bgcolor',
			[
				'label'     => esc_html__( 'Checked Bg Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .theplus-contact-form .input__checkbox_btn .toggle-button__icon:after' => 'background: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_checked_field_bg',
			[
				'label' => __( 'Radio Button', 'theplus' ),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'radio_typography',
				'selector' => '{{WRAPPER}} .theplus-contact-form span.wpcf7-form-control-wrap .input__radio_btn',
			]
		);
		$this->add_control(
			'radio_field_color',
			[
				'label'     => esc_html__( 'Checked Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .theplus-contact-form .input__radio_btn .toggle-button__icon:after' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'radio_unchecked_field_bgcolor',
			[
				'label'     => esc_html__( 'UnChecked Bg Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .theplus-contact-form .input__radio_btn .toggle-button__icon' => 'background: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'radio_checked_field_bgcolor',
			[
				'label'     => esc_html__( 'Checked Bg Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .theplus-contact-form .input__radio_btn .toggle-button__icon:after' => 'background: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*Checkbox/Radio Field Style*/
		/*Choose File Field Style*/
		$this->start_controls_section(
            'section_choose_file_styling',
            [
                'label' => __('File/Upload Field', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'file_label_typography',
				'selector' => '{{WRAPPER}} .theplus-contact-form .wpcf7-file + .input__file_btn',
			]
		);
		$this->add_responsive_control(
			'file_field_min_height',
			[
				'label' => __( 'Min Height Field', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 600,
						'step' => 2,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .theplus-contact-form span.wpcf7-form-control-wrap.your-file.cf7-style-file' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'file_text_field_color',
			[
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default' => '#212121',
				'selectors' => [
					'{{WRAPPER}} .theplus-contact-form span.wpcf7-form-control-wrap.cf7-style-file .input__file_btn span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'file_icon_field_color',
			[
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default' => '#212121',
				'selectors' => [
					'{{WRAPPER}} .theplus-contact-form span.wpcf7-form-control-wrap.cf7-style-file .input__file_btn svg *' => 'fill: {{VALUE}};stroke:none;',
				],
				'separator' => 'after',
			]
		);
		$this->add_control(
			'file_field_align',
			[
				'label' => __( 'Alignment', 'theplus' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'center' => [
						'title' => __( 'Center', 'theplus' ),
						'icon' => 'fa fa-align-center',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'label_block' => false,
				'selectors' => [
					'{{WRAPPER}} .theplus-contact-form span.wpcf7-form-control-wrap.cf7-style-file' => '-webkit-justify-content: {{VALUE}};-ms-flex-pack: {{VALUE}};justify-content: {{VALUE}};',
					'{{WRAPPER}} .theplus-contact-form span.wpcf7-form-control-wrap.cf7-style-file span' => 'text-align: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'file_field_bg',
				'types'     => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .theplus-contact-form span.wpcf7-form-control-wrap.cf7-style-file .wpcf7-file + .input__file_btn',
			]
		);
		$this->add_control(
			'file_border_options',
			[
				'label' => __( 'Border Options', 'theplus' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'file_box_border',
			[
				'label' => __( 'Box Border', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'default' => 'no',
			]
		);
		
		$this->add_responsive_control(
			'file_box_border_width',
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
					'{{WRAPPER}} .theplus-contact-form .cf7-style-file .wpcf7-file + .input__file_btn' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'file_box_border' => 'yes',
				],
			]
		);
		$this->add_control(
			'file_box_border_color',
			[
				'label' => __( 'Border Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#252525',
				'selectors'  => [
					'{{WRAPPER}} .theplus-contact-form .cf7-style-file .wpcf7-file + .input__file_btn' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'file_box_border' => 'yes',
				],
			]
		);
		$this->end_controls_section();
		/*Choose File Field Style*/
		/*Outer Field Style*/
		$this->start_controls_section(
            'section_outer_styling',
            [
                'label' => __('Outer(Field) Styling', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'outer_typography',
				'selector' => '{{WRAPPER}} .theplus-contact-form.style-1.plus-cf7-label form.wpcf7-form  label,{{WRAPPER}} .theplus-contact-form.style-1.plus-cf7-custom form.wpcf7-form .tp-cf7-outer',
			]
		);
		
		$this->add_control(
			'outer_inner_padding',
			[
				'label' => __( 'Inner Padding', 'theplus' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%'],
				'selectors' => [
					'{{WRAPPER}} .theplus-contact-form.style-1.plus-cf7-label form.wpcf7-form  label,{{WRAPPER}} .theplus-contact-form.style-1.plus-cf7-custom form.wpcf7-form .tp-cf7-outer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);
		$this->start_controls_tabs( 'tabs_outer_field_style' );
		$this->start_controls_tab(
			'tab_outer_field_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
			]
		);
		$this->add_control(
			'outer_field_color',
			[
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .theplus-contact-form.style-1.plus-cf7-label form.wpcf7-form  label,{{WRAPPER}} .theplus-contact-form.style-1.plus-cf7-custom form.wpcf7-form .tp-cf7-outer' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'outer_field_bg',
				'types'     => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .theplus-contact-form.style-1.plus-cf7-label form.wpcf7-form  label,{{WRAPPER}} .theplus-contact-form.style-1.plus-cf7-custom form.wpcf7-form .tp-cf7-outer',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_outer_field_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
			]
		);
		$this->add_control(
			'plus_pro_outer_field_hover_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'outer_border_options',
			[
				'label' => __( 'Border Options', 'theplus' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'outer_box_border',
			[
				'label' => __( 'Box Border', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'default' => 'no',
			]
		);
		
		$this->add_control(
			'outer_border_style',
			[
				'label' => __( 'Border Style', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => theplus_get_border_style(),
				'selectors'  => [
					'{{WRAPPER}} .theplus-contact-form.style-1.plus-cf7-label form.wpcf7-form  label,{{WRAPPER}} .theplus-contact-form.style-1.plus-cf7-custom form.wpcf7-form .tp-cf7-outer' => 'border-style: {{VALUE}};',
				],
				'condition' => [
					'outer_box_border' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'outer_box_border_width',
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
					'{{WRAPPER}} .theplus-contact-form.style-1.plus-cf7-label form.wpcf7-form  label,{{WRAPPER}} .theplus-contact-form.style-1.plus-cf7-custom form.wpcf7-form .tp-cf7-outer' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'outer_box_border' => 'yes',
				],
			]
		);
		$this->start_controls_tabs( 'tabs_outer_border_style' );
		$this->start_controls_tab(
			'tab_outer_border_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
			]
		);
		$this->add_control(
			'outer_box_border_color',
			[
				'label' => __( 'Border Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#252525',
				'selectors'  => [
					'{{WRAPPER}} .theplus-contact-form.style-1.plus-cf7-label form.wpcf7-form  label,{{WRAPPER}} .theplus-contact-form.style-1.plus-cf7-custom form.wpcf7-form .tp-cf7-outer' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'outer_box_border' => 'yes',
				],
			]
		);
		
		$this->add_responsive_control(
			'outer_border_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .theplus-contact-form.style-1.plus-cf7-label form.wpcf7-form  label,{{WRAPPER}} .theplus-contact-form.style-1.plus-cf7-custom form.wpcf7-form .tp-cf7-outer' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_outer_border_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
			]
		);
		$this->add_control(
			'plus_pro_outer_border_hover_options',
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
		$this->end_controls_tab();
		$this->end_controls_tabs();
		
		$this->end_controls_section();
		/*Outer Field Style*/
		$this->start_controls_section(
            'section_button_styling',
            [
                'label' => __('Submit/Send Button', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_responsive_control(
            'button_max_width',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Maximum Width', 'theplus'),
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 2000,
						'step' => 5,
					],
					'%' => [
						'min' => 10,
						'max' => 100,
						'step' => 1,
					],
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .theplus-contact-form input.wpcf7-form-control.wpcf7-submit' => 'max-width: {{SIZE}}{{UNIT}}',
				],
				'separator' => 'after',
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .theplus-contact-form input.wpcf7-form-control.wpcf7-submit',
			]
		);
		$this->add_responsive_control(
			'button_inner_padding',
			[
				'label' => __( 'Inner Padding', 'theplus' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%'],
				'selectors' => [
					'{{WRAPPER}} .theplus-contact-form input.wpcf7-form-control.wpcf7-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
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
			'button_color',
			[
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .theplus-contact-form input.wpcf7-form-control.wpcf7-submit' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'button_bg',
				'types'     => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .theplus-contact-form input.wpcf7-form-control.wpcf7-submit',
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
			'button_hover_color',
			[
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .theplus-contact-form input.wpcf7-form-control.wpcf7-submit:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'button_hover_bg',
				'types'     => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .theplus-contact-form input.wpcf7-form-control.wpcf7-submit:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		
		$this->start_controls_tabs( 'tabs_button_border_style' );
		$this->start_controls_tab(
			'tab_button_border_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
			]
		);
				
		$this->add_responsive_control(
			'button_border_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .theplus-contact-form input.wpcf7-form-control.wpcf7-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_button_border_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
			]
		);
		
		$this->add_responsive_control(
			'button_border_hover_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .theplus-contact-form input.wpcf7-form-control.wpcf7-submit:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		
		$this->end_controls_section();
		/*Send/Submit Button Style*/
		/*Response Message Style*/
		$this->start_controls_section(
            'section_response_msg_styling',
            [
                'label' => __('Response Message', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'response_msg_typography',
				'selector' => '{{WRAPPER}} .wpcf7-response-output',
			]
		);
		$this->add_responsive_control(
			'response_msg_padding',
			[
				'label' => __( 'Inner Padding', 'theplus' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%'],
				'selectors' => [
					'{{WRAPPER}} .theplus-contact-form .wpcf7-response-output' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->start_controls_tabs( 'tabs_response_style' );
		$this->start_controls_tab(
			'tab_response_success',
			[
				'label' => __( 'Success', 'theplus' ),
			]
		);
		$this->add_control(
			'response_success_color',
			[
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .theplus-contact-form .wpcf7-response-output.wpcf7-mail-sent-ok' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'response_success_bg',
				'types'     => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .theplus-contact-form .wpcf7-response-output.wpcf7-mail-sent-ok',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_response_validate',
			[
				'label' => __( 'Validation', 'theplus' ),
			]
		);
		$this->add_control(
			'response_validate_color',
			[
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .theplus-contact-form .wpcf7-response-output.wpcf7-validation-errors,{{WRAPPER}} .theplus-contact-form  .wpcf7-response-output.wpcf7-acceptance-missing' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'response_validate_bg',
				'types'     => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .theplus-contact-form .wpcf7-response-output.wpcf7-validation-errors,{{WRAPPER}} .theplus-contact-form  .wpcf7-response-output.wpcf7-acceptance-missing',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		
		$this->start_controls_tabs( 'tabs_response_msg' );
		$this->start_controls_tab(
			'tab_response_msg_success',
			[
				'label' => __( 'Success', 'theplus' ),
			]
		);
	
		$this->add_responsive_control(
			'success_border_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .theplus-contact-form .wpcf7-response-output.wpcf7-mail-sent-ok' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_response_msg_validate',
			[
				'label' => __( 'Validation', 'theplus' ),
			]
		);
				
		$this->add_responsive_control(
			'validate_border_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .theplus-contact-form .wpcf7-response-output.wpcf7-validation-errors,{{WRAPPER}} .theplus-contact-form  .wpcf7-response-output.wpcf7-acceptance-missing' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*Response Message Style*/
		$this->start_controls_section(
            'section_extra_option_styling',
            [
                'label' => __('Extra Option', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_responsive_control(
            'content_max_width',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Maximum Width', 'theplus'),
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 250,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 10,
						'max' => 100,
						'step' => 1,
					],
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .theplus-contact-form' => 'max-width: {{SIZE}}{{UNIT}}',
				],
            ]
        );
		$this->add_control(
			'required_field_color',
			[
				'label' => __( 'Required Text Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors'  => [
					'{{WRAPPER}} .theplus-contact-form span.wpcf7-form-control-wrap .wpcf7-not-valid-tip' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'required_field_bgcolor',
			[
				'label' => __( 'Required Background Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors'  => [
					'{{WRAPPER}} .theplus-contact-form span.wpcf7-form-control-wrap .wpcf7-not-valid-tip' => 'background: {{VALUE}}',
					'{{WRAPPER}} .theplus-contact-form span.wpcf7-not-valid-tip:before' => 'border-bottom-color: {{VALUE}}',
				],
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
	private function get_shortcode() {
		$settings = $this->get_settings_for_display();

		if (!$settings['contact_form']) {
			return '<div class="theplus-contact-form-alert">'.__('Please select a Contact Form From Setting!', 'theplus').'</div>';
		}

		$attributes = [
			'id'	=> $settings['contact_form'],
		];

		$this->add_render_attribute( 'form_shortcode', $attributes );

		$shortcode   = [];
		$shortcode[] = sprintf( '[contact-form-7 %s]', $this->get_render_attribute_string( 'form_shortcode' ) );

		return implode("", $shortcode);
	}

	public function render() {
		$settings = $this->get_settings_for_display();
		$form_style=$settings["form_style"];
		$outer_field_class=$settings["outer_field_class"];
		
		$content_align='text-'.$settings['content_align'];
		
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
			
			$output ='<div class="theplus-contact-form '.esc_attr($form_style).' plus-cf7-label '.esc_attr($content_align).'  '.esc_attr($animated_class).'" '.$animation_attr.'>';
				$output .= do_shortcode( $this->get_shortcode() );				
			$output .= '</div>';
		echo $output;
	}
    protected function content_template() {
	
    }
}
