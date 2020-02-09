<?php 
/*
Widget Name: Blog Post Listing
Description: Different style of Blog Post listing layouts.
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


class ThePlus_Blog_ListOut extends Widget_Base {
		
	public function get_name() {
		return 'tp-blog-listout';
	}

    public function get_title() {
        return __('Blog/Post Listing', 'theplus');
    }

    public function get_icon() {
        return 'fa fa-newspaper-o theplus_backend_icon';
    }

    public function get_categories() {
        return array('plus-listing');
    }
	
	public function get_style_depends() {
		return [ 'tp-columns-bootstrap','plus-blog-style' ];
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
			'layout',
			[
				'label' => __( 'Layout', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'grid',
				'options' => [
					'grid'  => __( 'Grid', 'theplus' ),
					'masonry' => __( 'Masonry', 'theplus' ),
					'metro' => __( 'Metro', 'theplus' ),
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
				'options' => theplus_get_categories(),
				'separator' => 'before',
			]
		);
		$this->add_control(
			'post_tags',
			[
				'type' => Controls_Manager::SELECT2,
				'label'      => esc_html__( 'Select Tags', 'theplus' ),
				'default'    => '',
				'multiple'   => true,
				'options' => theplus_get_tags(),
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
					'layout!' => ['metro','carousel']
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
					'layout!' => ['metro','carousel']
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
					'layout!' => ['metro','carousel']
				],
			]
		);
		$this->add_control(
			'metro_column',
			[
				'label' => __( 'Metro Column', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => '3',
				'options' => [
					"3" => __("Column 3", 'theplus'),
					"4" => __("Column 4 (PRO)", 'theplus'),
					"5" => __("Column 5 (PRO)", 'theplus'),
					"6" => __("Column 6 (PRO)", 'theplus'),
				],
				'condition' => [
					'layout' => ['metro']
				],
			]
		);
		$this->add_control(
			'metro_style_3',
			[
				'label' => __( 'Metro Style', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => theplus_get_style_list(1),
				'condition' => [
					'metro_column' => '3',
					'layout' => ['metro']
				],
			]
		);
		$this->add_control(
			'plus_pro_metro_column_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
				'condition' => [
					'metro_column!' => '3',
					'layout' => ['metro']
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
					'{{WRAPPER}} .blog-list .post-inner-loop .grid-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
			'display_excerpt',
			[
				'label' => __( 'Display Excerpt/Content', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'default' => 'yes',
			]
		);		
		$this->add_control(
			'post_excerpt_count',
			[
				'label' => __( 'Excerpt/Content Count', 'theplus' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 5,
				'max' => 500,
				'step' => 2,
				'default' => 30,
				'separator' => 'after',
				'condition'   => [
					'display_excerpt'    => 'yes',
				],
			]
		);
		$this->add_control(
			'display_post_meta',
			[
				'label' => __( 'Display Post Meta', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'default' => 'yes',
			]
		);
		$this->add_control(
			'post_meta_tag_style',
			[
				'label' => __( 'Post Meta Tag', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => theplus_get_style_list(1),
				'separator' => 'after',
				'condition'   => [
					'display_post_meta'    => 'yes',
				],
			]
		);
		$this->end_controls_section();
		/*post Extra options*/
		/*post meta tag*/
		$this->start_controls_section(
            'section_meta_tag_style',
            [
                'label' => __('Post Meta Tag', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition'   => [
					'display_post_meta'    => 'yes',
				],
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'meta_tag_typography',
				'label' => __( 'Typography', 'theplus' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .blog-list .post-inner-loop .post-meta-info span',
			]
		);
		$this->start_controls_tabs( 'tabs_post_meta_style' );
		$this->start_controls_tab(
			'tab_post_meta_normal',
			[
				'label' => __( 'Normal', 'theplus' ),				
			]
		);
		$this->add_control(
			'post_meta_color',
			[
				'label' => __( 'Post Meta Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .blog-list .post-inner-loop .post-meta-info span,{{WRAPPER}} .blog-list .post-inner-loop .post-meta-info span a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_post_meta_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
			]
		);
		$this->add_control(
			'post_meta_color_hover',
			[
				'label' => __( 'Post Meta Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .blog-list .post-inner-loop .blog-list-content:hover .post-meta-info span,{{WRAPPER}} .blog-list .post-inner-loop .blog-list-content:hover .post-meta-info span a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		
		$this->end_controls_section();
		/*post meta tag*/
		
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
				'selector' => '{{WRAPPER}} .blog-list .post-inner-loop .post-title,{{WRAPPER}} .blog-list .post-inner-loop .post-title a',
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
					'{{WRAPPER}} .blog-list .post-inner-loop .post-title,{{WRAPPER}} .blog-list .post-inner-loop .post-title a' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .blog-list .post-inner-loop .blog-list-content:hover .post-title,{{WRAPPER}} .blog-list .post-inner-loop .blog-list-content:hover .post-title a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*Post Title*/		
		/*Post Excerpt*/
		$this->start_controls_section(
            'section_excerpt_style',
            [
                'label' => __('Excerpt/Content', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition'   => [
					'display_excerpt'    => 'yes',
				],
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'excerpt_typography',
				'label' => __( 'Typography', 'theplus' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .blog-list .post-inner-loop .entry-content',
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
					'{{WRAPPER}} .blog-list .post-inner-loop .entry-content,{{WRAPPER}} .blog-list .post-inner-loop .entry-content p' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .blog-list .post-inner-loop .blog-list-content:hover .entry-content,{{WRAPPER}} .blog-list .post-inner-loop .blog-list-content:hover .entry-content p' => 'color: {{VALUE}}',
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
				'selector' => '{{WRAPPER}} .blog-list.blog-style-1 .post-content-bottom',
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
				'selector' => '{{WRAPPER}} .blog-list.blog-style-1 .blog-list-content:hover .post-content-bottom',
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
		$this->add_control(
			'hover_image_style',
			[
				'label' => __( 'Image Hover Effect', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => theplus_get_style_list(1,'yes'),
			]
		);
		
		$this->end_controls_section();
		/*Post Featured Image*/
		
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
					'{{WRAPPER}} .blog-list .post-inner-loop .grid-item .blog-list-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .blog-list .post-inner-loop .grid-item .blog-list-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .blog-list .post-inner-loop .grid-item .blog-list-content:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector'  => '{{WRAPPER}} .blog-list .post-inner-loop .grid-item .blog-list-content',
				
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
				'selector'  => '{{WRAPPER}} .blog-list .post-inner-loop .grid-item .blog-list-content:hover',
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
		$post_title_tag=$settings["post_title_tag"];
		
		$display_post_meta=$settings["display_post_meta"];
		$post_meta_tag_style=$settings["post_meta_tag_style"];
		
		$display_excerpt=$settings["display_excerpt"];
		$post_excerpt_count=$settings["post_excerpt_count"];
		
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
		if($layout!='carousel' && $layout!='metro'){
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
		if($layout=='metro'){
			$metro_columns=$settings['metro_column'];
			$layout_attr .=' data-columns="3" ';
			if(isset($settings["metro_style_".$metro_columns]) && !empty($settings["metro_style_".$metro_columns])){
				$layout_attr .=' data-metro-style="'.esc_attr($settings["metro_style_".$metro_columns]).'" ';
			}
		}
		
		$data_class .=' blog-'.$style;
		$data_class .=' hover-image-'.$settings["hover_image_style"];
		
		
		$output=$data_attr='';
				
		$ji=1;$ij='';
		$uid=uniqid("post");
		
		$data_attr .=' data-id="'.esc_attr($uid).'"';
		$data_attr .=' data-style="'.esc_attr($style).'"';
		$tablet_metro_class=$tablet_ij='';
		
		if ( ! $query->have_posts() ) {
			$output .='<h3 class="theplus-posts-not-found">'.esc_html__( "Posts not found", "theplus" ).'</h3>';
		}else{
			$output .= '<div id="pt-plus-blog-post-list" class="blog-list '.esc_attr($uid).' '.esc_attr($data_class).' '.$animated_class.'" '.$layout_attr.' '.$data_attr.' '.$animation_attr.' data-enable-isotope="1">';
			
			$output .= '<div id="'.esc_attr($uid).'" class="tp-row post-inner-loop '.esc_attr($uid).'">';
			while ( $query->have_posts() ) {
			
				$query->the_post();
				$post = $query->post;
				
				
				if($layout=='metro'){
					$metro_columns=$settings['metro_column'];
					if(!empty($settings["metro_style_".$metro_columns])){
						$ij=theplus_metro_style_layout($ji,$settings['metro_column'],$settings["metro_style_".$metro_columns]);
					}
				}
				
				//grid item loop
				$output .= '<div class="grid-item metro-item'.esc_attr($ij).' '.esc_attr($tablet_metro_class).' '.$desktop_class.' '.$tablet_class.' '.$mobile_class.'">';				
				if(!empty($style)){
					ob_start();
					include THEPLUS_PATH. 'includes/blog/blog-style-1.php'; 
					$output .= ob_get_contents();
					ob_end_clean();
				}
				$output .='</div>';
				
				$ji++;
			}
			$output .='</div>';
			
						
			$output .='</div>';
		}
		
		echo $output;
		wp_reset_postdata();
	}
	
    protected function content_template() {
	
    }
	
	protected function get_query_args() {
		$settings = $this->get_settings_for_display();
		$query_args = array(
			'post_type'           => 'post',
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
		if ( '' !== $settings['post_category'] ) {
			
			$query_args['category__in'] = $settings['post_category'];
		}
		if ( '' !== $settings['post_tags'] ) {
			$query_args['tag__in'] = $settings['post_tags'];
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
