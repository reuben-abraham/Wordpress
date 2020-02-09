<?php 
/*
Widget Name: Testimonial Carousel
Description: Different style of testimonial.
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


class ThePlus_Testimonial_ListOut extends Widget_Base {
		
	public function get_name() {
		return 'tp-testimonial-listout';
	}

    public function get_title() {
        return __('Testimonial', 'theplus');
    }

    public function get_icon() {
        return 'fa fa-users theplus_backend_icon';
    }

    public function get_categories() {
        return array('plus-listing');
    }
	
	public function get_style_depends() {
		return [ 'tp-columns-bootstrap','plus-testimonial-style' ];
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
				'default' => 'style-2',
				'options' => [
					'style-1'  => __( 'Style 1 (PRO)', 'theplus' ),
					'style-2' => __( 'Style 2', 'theplus' ),
					'style-3' => __( 'Style 3 (PRO)', 'theplus' ),
					'style-4' => __( 'Style 4', 'theplus' ),
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
					'style!' => ['style-2','style-4'],
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
				'options' => theplus_get_testimonial_categories(),
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
		$this->start_controls_section(
			'content_extra_options_section',
			[
				'label' => __( 'Extra Option', 'theplus' ),
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
			]
		);
		$this->end_controls_section();
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
				'selector' => '{{WRAPPER}} .testimonial-list .post-content-image .post-title,{{WRAPPER}} .testimonial-list.testimonial-style-4 .post-title',
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
					'{{WRAPPER}} .testimonial-list .post-content-image .post-title,{{WRAPPER}} .testimonial-list.testimonial-style-4 .post-title' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .testimonial-list .testimonial-list-content:hover .post-title,{{WRAPPER}} .testimonial-list.testimonial-style-4 .testimonial-list-content:hover .post-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*Post Title*/
		/*Post Extra options*/
		$this->start_controls_section(
            'section_extra_title_style',
            [
                'label' => __('Extra Title', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'extra_title_typography',
				'label' => __( 'Typography', 'theplus' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .testimonial-list.testimonial-style-1 .testimonial-list-content .testimonial-author-title,{{WRAPPER}} .testimonial-list.testimonial-style-2 .testimonial-list-content .testimonial-author-title,{{WRAPPER}} .testimonial-list.testimonial-style-3 .testimonial-list-content .testimonial-author-title,{{WRAPPER}} .testimonial-list.testimonial-style-4 .testimonial-author-title',
				'condition'   => [
					'style'    => ['style-2','style-4'],
				],
			]
		);
		$this->start_controls_tabs( 'tabs_extra_title_style' );
		
		$this->start_controls_tab(
			'tab_extra_title_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
				'condition'   => [
					'style'    => ['style-2','style-4'],
				],
			]
		);
		$this->add_control(
			'extra_title_color',
			[
				'label' => __( 'Extra Title Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .testimonial-list.testimonial-style-1 .testimonial-list-content .testimonial-author-title,{{WRAPPER}} .testimonial-list.testimonial-style-2 .testimonial-list-content .testimonial-author-title,{{WRAPPER}} .testimonial-list.testimonial-style-3 .testimonial-list-content .testimonial-author-title,{{WRAPPER}} .testimonial-list.testimonial-style-4 .testimonial-author-title' => 'color: {{VALUE}}',
				],
				'condition'   => [
					'style'    => ['style-2','style-4'],
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_extra_title_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
				'condition'   => [
					'style'    => ['style-2','style-4'],
				],
			]
		);
		$this->add_control(
			'extra_title_hover_color',
			[
				'label' => __( 'Extra Title Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .testimonial-list.testimonial-style-1 .testimonial-list-content:hover .testimonial-author-title,{{WRAPPER}} .testimonial-list.testimonial-style-2 .testimonial-list-content:hover .testimonial-author-title,{{WRAPPER}} .testimonial-list.testimonial-style-3 .testimonial-list-content:hover .testimonial-author-title,{{WRAPPER}} .testimonial-list.testimonial-style-4 .testimonial-list-content:hover .testimonial-author-title' => 'color: {{VALUE}}',
				],
				'condition'   => [
					'style'    => ['style-2','style-4'],
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		$this->start_controls_section(
            'section_designation_style',
            [
                'label' => __('Designation', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'designation_typography',
				'label' => __( 'Typography', 'theplus' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .testimonial-list.testimonial-style-2 .post-designation,{{WRAPPER}} .testimonial-list.testimonial-style-4 .post-designation',
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
				'label' => __( 'Designation Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .testimonial-list.testimonial-style-2 .post-designation,{{WRAPPER}} .testimonial-list.testimonial-style-4 .post-designation' => 'color: {{VALUE}}',
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
			'designation_hover_color',
			[
				'label' => __( 'Designation Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .testimonial-list.testimonial-style-2 .testimonial-list-content:hover .post-designation,{{WRAPPER}} .testimonial-list.testimonial-style-4 .testimonial-list-content:hover .post-designation' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*Post Extra options*/
		/*Post Excerpt*/
		$this->start_controls_section(
            'section_excerpt_style',
            [
                'label' => __('Excerpt/Content', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'excerpt_typography',
				'label' => __( 'Typography', 'theplus' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .testimonial-list .entry-content',
			]
		);
		$this->start_controls_tabs( 'tabs_excerpt_style' );
		$this->start_controls_tab(
			'tab_excerpt_normal',
			[
				'label' => __( 'Normal', 'theplus' ),				
			]
		);
		$this->add_control(
			'excerpt_color',
			[
				'label' => __( 'Content Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .testimonial-list .entry-content,{{WRAPPER}} .testimonial-list .entry-content p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_excerpt_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
			]
		);
		$this->add_control(
			'excerpt_hover_color',
			[
				'label' => __( 'Content Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .testimonial-list .testimonial-list-content:hover .entry-content,{{WRAPPER}} .testimonial-list .testimonial-list-content:hover .entry-content p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*Post Excerpt*/
		/*Content Background*/
		$this->start_controls_section(
            'section_content_bg_style',
            [
                'label' => __('Content Background', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_responsive_control(
			'content_inner_padding',
			[
				'label'      => __( 'Inner Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .testimonial-list.testimonial-style-2 .testimonial-list-content,{{WRAPPER}} .testimonial-list.testimonial-style-4 .testimonial-list-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_bg_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .testimonial-list.testimonial-style-2 .testimonial-list-content,{{WRAPPER}} .testimonial-list.testimonial-style-4 .testimonial-list-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs( 'tabs_content_bg_style' );
		$this->start_controls_tab(
			'tab_content_normal',
			[
				'label' => __( 'Normal', 'theplus' ),				
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'contnet_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .testimonial-list.testimonial-style-2 .testimonial-list-content,{{WRAPPER}} .testimonial-list.testimonial-style-4 .testimonial-list-content',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_content_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'content_hover_background',
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .testimonial-list.testimonial-style-2 .testimonial-list-content:hover,{{WRAPPER}} .testimonial-list.testimonial-style-4 .testimonial-list-content:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		
		$this->end_controls_section();
		/*Content Background*/
		/*Post Featured Image*/
		$this->start_controls_section(
            'section_post_image_style',
            [
                'label' => __('Featured Image', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		
		$this->add_responsive_control(
			'featured_image_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .testimonial-list.testimonial-style-2 .testimonial-featured-image img,{{WRAPPER}} .testimonial-list.testimonial-style-4 .testimonial-featured-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_section();
		
		/*carousel option*/
		$this->start_controls_section(
            'section_carousel_options_styling',
            [
                'label' => __('Carousel Options', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
			'slider_direction',
			[
				'label'   => __( 'Slider Mode', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => [
					'horizontal'  => __( 'Horizontal', 'theplus' ),
					'vertical' => __( 'Vertical (PRO)', 'theplus' ),
				],
			]
		);		
		$this->add_control(
            'slide_speed',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Slide Speed', 'theplus'),
				'size_units' => '',
				'range' => [
					'' => [
						'min' => 0,
						'max' => 10000,
						'step' => 100,
					],
				],
				'default' => [
					'unit' => '',
					'size' => 1500,
				],
            ]
        );
		
		$this->start_controls_tabs( 'tabs_carousel_style' );
		$this->start_controls_tab(
			'tab_carousel_desktop',
			[
				'label' => __( 'Desktop', 'theplus' ),
			]
		);
		$this->add_control(
			'slider_desktop_column',
			[
				'label'   => __( 'Desktop Columns', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1'  => __( 'Column 1', 'theplus' ),
				],
			]
		);
		$this->add_control(
			'steps_slide',
			[
				'label'   => __( 'Next Previous', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'description' => __( 'Select option of column scroll on previous or next in carousel.','theplus' ),
				'options' => [
					'1'  => __( 'One Column', 'theplus' ),
					'2' => __( 'All Visible Columns (PRO)', 'theplus' ),
				],
				'separator' => 'after',
			]
		);
		$this->add_responsive_control(
			'slider_padding',
			[
				'label' => __( 'Slide Padding', 'theplus' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'px' => [
					'top' => '',
					'right' => '10',
					'bottom' => '',
					'left' => '10',
					'isLinked' => true,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .list-carousel-slick .slick-initialized .slick-slide' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'slider_draggable',
			[
				'label'   => __( 'Draggable', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'theplus' ),
				'label_off' => __( 'Off', 'theplus' ),				
				'default' => 'yes',
			]
		);
		$this->add_control(
			'slider_infinite',
			[
				'label'   => __( 'Infinite Mode', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'theplus' ),
				'label_off' => __( 'Off', 'theplus' ),				
				'default' => 'yes',
			]
		);
		$this->add_control(
			'slider_adaptive_height',
			[
				'label'   => __( 'Adaptive Height', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'theplus' ),
				'label_off' => __( 'Off', 'theplus' ),				
				'default' => 'no',
			]
		);
		$this->add_control(
			'slider_autoplay',
			[
				'label'   => __( 'Autoplay', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'theplus' ),
				'label_off' => __( 'Off', 'theplus' ),				
				'default' => 'yes',
			]
		);
		$this->add_control(
            'autoplay_speed',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Autoplay Speed', 'theplus'),
				'size_units' => '',
				'range' => [
					'' => [
						'min' => 500,
						'max' => 10000,
						'step' => 200,
					],
				],
				'default' => [
					'unit' => '',
					'size' => 3000,
				],
				'condition' => [
					'slider_autoplay' => 'yes',
				],
            ]
        );
		
		$this->add_control(
			'slider_dots',
			[
				'label'   => __( 'Show Dots', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'theplus' ),
				'label_off' => __( 'Off', 'theplus' ),				
				'default' => 'yes',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'slider_dots_style',
			[
				'label'   => __( 'Dots Style', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1' => __( 'Style 1', 'theplus' ),
					'style-2' => __( 'Style 2 (PRO)', 'theplus' ),
					'style-3' => __( 'Style 3 (PRO)', 'theplus' ),
					'style-4' => __( 'Style 4 (PRO)', 'theplus' ),
					'style-5' => __( 'Style 5 (PRO)', 'theplus' ),
					'style-6' => __( 'Style 6 (PRO)', 'theplus' ),
					'style-7' => __( 'Style 7 (PRO)', 'theplus' ),
				],
				'condition'    => [
					'slider_dots' => ['yes'],
				],
			]
		);
		$this->add_control(
			'dots_border_color',
			[
				'label' => __( 'Dots Border Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#252525',
				'selectors' => [
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-1 li button' => '-webkit-box-shadow:inset 0 0 0 8px {{VALUE}};-moz-box-shadow: inset 0 0 0 8px {{VALUE}};box-shadow: inset 0 0 0 8px {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-1 li.slick-active button' => '-webkit-box-shadow:inset 0 0 0 1px {{VALUE}};-moz-box-shadow: inset 0 0 0 1px {{VALUE}};box-shadow: inset 0 0 0 1px {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-1 li button:before' => 'color: {{VALUE}};',
				],
				'condition' => [
					'slider_dots_style' => ['style-1'],
					'slider_dots' => 'yes',
				],
			]
		);
		$this->add_control(
			'slider_arrows',
			[
				'label'   => __( 'Show Arrows', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'theplus' ),
				'label_off' => __( 'Off', 'theplus' ),				
				'default' => 'no',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'slider_arrows_style',
			[
				'label'   => __( 'Arrows Style', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style-2',
				'options' => [
					'style-1' => __( 'Style 1 (PRO)', 'theplus' ),
					'style-2' => __( 'Style 2', 'theplus' ),
					'style-3' => __( 'Style 3 (PRO)', 'theplus' ),
					'style-4' => __( 'Style 4 (PRO)', 'theplus' ),
					'style-5' => __( 'Style 5 (PRO)', 'theplus' ),
					'style-6' => __( 'Style 6 (PRO)', 'theplus' ),
				],
				'condition'    => [
					'slider_arrows' => ['yes'],
				],
			]
		);
		$this->add_control(
			'arrow_icon_color',
			[
				'label' => __( 'Arrow Icon Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .list-carousel-slick .slick-prev.style-2 .icon-wrap:before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-2 .icon-wrap:after,{{WRAPPER}} .list-carousel-slick .slick-next.style-2 .icon-wrap:before,{{WRAPPER}} .list-carousel-slick .slick-next.style-2 .icon-wrap:after' => 'background: {{VALUE}};',
				],
				'condition' => [
					'slider_arrows_style' => ['style-2'],
					'slider_arrows' => 'yes',
				],
			]
		);
		$this->add_control(
			'arrow_hover_bg_color',
			[
				'label' => __( 'Arrow Hover Background Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .list-carousel-slick .slick-prev.style-2:hover::before,{{WRAPPER}} .list-carousel-slick .slick-next.style-2:hover::before' => 'background: {{VALUE}};',	
				],
				'condition' => [
					'slider_arrows_style' => ['style-2'],
					'slider_arrows' => 'yes',
				],
			]
		);
		$this->add_control(
			'arrow_hover_icon_color',
			[
				'label' => __( 'Arrow Hover Icon Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#c44d48',
				'selectors' => [
					'{{WRAPPER}} .list-carousel-slick .slick-prev.style-2:hover .icon-wrap::before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-2:hover .icon-wrap::after,{{WRAPPER}} .list-carousel-slick .slick-next.style-2:hover .icon-wrap::before,{{WRAPPER}} .list-carousel-slick .slick-next.style-2:hover .icon-wrap::after' => 'background: {{VALUE}};',
				],
				'condition' => [
					'slider_arrows_style' => ['style-2'],
					'slider_arrows' => 'yes',
				],
			]
		);
		$this->add_control(
			'slider_center_mode',
			[
				'label'   => __( 'Center Mode', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'theplus' ),
				'label_off' => __( 'Off', 'theplus' ),				
				'default' => 'no',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'plus_pro_slider_center_mode_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
				'condition'    => [
					'slider_center_mode' => ['yes'],
				],
			]
		);
		
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_carousel_tablet',
			[
				'label' => __( 'Tablet', 'theplus' ),
			]
		);
		$this->add_control(
			'plus_pro_carousel_tablet_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_carousel_mobile',
			[
				'label' => __( 'Mobile', 'theplus' ),
			]
		);
		$this->add_control(
			'plus_pro_carousel_mobile_options',
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
				'type' => Controls_Manager::SWITCHER,
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
		$this->end_controls_tab();
		$this->end_controls_tabs();
		
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
		$post_name=theplus_testimonial_post_name();
		$taxonomy_name=theplus_testimonial_post_category();
		
		$style=$settings["style"];
		$post_title_tag=$settings["post_title_tag"];
		$post_category=$settings['post_category'];
		
		$content_alignment_4='content-left';
		
		
		//animation load
		$animation_effects=$settings["animation_effects"];
		$animation_delay=$settings["animation_delay"]["size"];
		$animate_duration='';
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


		$data_class='';
		
		$data_class .=' list-carousel-slick ';
		$data_class .=' testimonial-'.$style;
		
		$output=$data_attr='';
		
		$i=1;
		$uid=uniqid("post");
		
		$data_attr .=' data-id="'.esc_attr($uid).'"';
		$data_attr .=' data-style="'.esc_attr($style).'"';
		$data_attr .=$this->get_carousel_options();
		
		if ( ! $query->have_posts() ) {
			$output .='<h3 class="theplus-posts-not-found">'.esc_html__( "Posts not found", "theplus" ).'</h3>';
		}else{
			if($style=='style-2' || $style=='style-4'){
			$output .= '<div id="theplus-testimonial-post-list" class="testimonial-list '.esc_attr($uid).' '.esc_attr($data_class).' '.esc_attr($animated_class).'" '.$data_attr.' '.$animation_attr.' data-enable-isotope="1">';
			
				$output .= '<div class="tp-row post-inner-loop '.esc_attr($uid).' '.esc_attr($content_alignment_4).'">';
				while ( $query->have_posts() ) {
				
					$query->the_post();
					$post = $query->post;
					
					//grid item loop
					$output .= '<div class="grid-item">';				
					if(!empty($style)){
						ob_start();
						include THEPLUS_PATH. 'includes/testimonial/testimonial-'.esc_attr($style).'.php'; 
						$output .= ob_get_contents();
						ob_end_clean();
					}
					$output .='</div>';
					
					$i++;
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
		$post_name=theplus_testimonial_post_name();
		$taxonomy_name=theplus_testimonial_post_category();
		$post_category=($settings['post_category']!='') ? $settings['post_category'] : '';
		
		$query_args = array(
			'post_type'           => $post_name,
			$taxonomy_name		  => $post_category,
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
	
	protected function get_carousel_options() {
		$settings = $this->get_settings_for_display();
		$data_slider ='';
			$data_slider .=' data-slide_speed="'.esc_attr($settings["slide_speed"]["size"]).'"';
			
			$data_slider .=' data-slider_desktop_column="1"';
			$data_slider .=' data-steps_slide="1"';
			
			$slider_draggable= ($settings["slider_draggable"]=='yes') ? 'true' : 'false';
			$data_slider .=' data-slider_draggable="'.esc_attr($slider_draggable).'"';
			$slider_infinite= ($settings["slider_infinite"]=='yes') ? 'true' : 'false';
			$data_slider .=' data-slider_infinite="'.esc_attr($slider_infinite).'"';
			
			$slider_adaptive_height= ($settings["slider_adaptive_height"]=='yes') ? 'true' : 'false';
			$data_slider .=' data-slider_adaptive_height="'.esc_attr($slider_adaptive_height).'"';
			$slider_autoplay= ($settings["slider_autoplay"]=='yes') ? 'true' : 'false';
			$data_slider .=' data-slider_autoplay="'.esc_attr($slider_autoplay).'"';
			$data_slider .=' data-autoplay_speed="'.esc_attr($settings["autoplay_speed"]["size"]).'"';
			
		
			$slider_dots= ($settings["slider_dots"]=='yes') ? 'true' : 'false';
			$data_slider .=' data-slider_dots="'.esc_attr($slider_dots).'"';
			$data_slider .=' data-slider_dots_style="slick-dots '.esc_attr($settings["slider_dots_style"]).'"';
			
			
			$slider_arrows= ($settings["slider_arrows"]=='yes') ? 'true' : 'false';
			$data_slider .=' data-slider_arrows="'.esc_attr($slider_arrows).'"';
			$data_slider .=' data-slider_arrows_style="'.esc_attr($settings["slider_arrows_style"]).'" ';
			$data_slider .=' data-arrow_icon_color="'.esc_attr($settings["arrow_icon_color"]).'" ';
			$data_slider .=' data-arrow_hover_bg_color="'.esc_attr($settings["arrow_hover_bg_color"]).'" ';
			$data_slider .=' data-arrow_hover_icon_color="'.esc_attr($settings["arrow_hover_icon_color"]).'" ';
			
		return $data_slider;
	}
}
