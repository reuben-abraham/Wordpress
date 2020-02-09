<?php 
/*
Widget Name: Gallery Listing
Description: Different style of gallery listing layouts.
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
use Elementor\Group_Control_Css_Filter;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly


class ThePlus_Gallery_ListOut extends Widget_Base {
		
	public function get_name() {
		return 'tp-gallery-listout';
	}

    public function get_title() {
        return __('Gallery Listing', 'theplus');
    }

    public function get_icon() {
        return 'fa fa-grav theplus_backend_icon';
    }

    public function get_categories() {
        return array('plus-listing');
    }
	
	public function get_style_depends() {
		return [ 'tp-columns-bootstrap','plus-gallery-style' ];
	}
	
    public function get_script_depends() {
        return [
            'theplus_frontend_scripts'
        ];
    }
	
    protected function _register_controls() {
		
		$this->start_controls_section(
			'layout_content_section',
			[
				'label' => __( 'Layout', 'theplus' ),
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
		$this->add_control(
			'popup_style',
			[
				'label' => __( 'Popup Layout', 'theplus' ),
				'type' => Controls_Manager::SELECT,				
				'default' => 'default',
				'separator' => 'before',
				'options' => [
					'default'  => __( 'Default', 'theplus' ),
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'gallery_options',
			[
				'label' => __( 'Select Option', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'normal',
				'options' => [
					"normal" => __("Normal", 'theplus'),
					"repeater" => __("Repeater (PRO)", 'theplus'),
				],
			]
		);
		$this->add_control(
			'gallery_images',
			[
				'label' => __( 'Add Images', 'theplus' ),
				'type' => Controls_Manager::GALLERY,
				'default' => [],
				'condition' => [
					'gallery_options' => ['normal']
				],
			]
		);
		$this->add_control(
			'plus_pro_gallery_repeater_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
				'condition' => [
					'gallery_options' => 'repeater',
				],
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
					'{{WRAPPER}} .gallery-list .post-inner-loop .grid-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
			'display_title',
			[
				'label' => __( 'Display Title', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'default' => 'yes',
			]
		);
		$this->add_control(
			'post_title_tag',
			[
				'label' => __( 'Title Tag', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => theplus_get_tags_options(),
				'condition' => [
					'display_title' => 'yes'
				],
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
				'separator' => 'before',
			]
		);
		$this->add_control(
			'filter_category',
			[
				'label' => __( 'Category Wise Filter', 'theplus' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'default' => 'no',
				'separator' => 'before',
				'condition' => [
					'gallery_options' => 'repeater',
				],
			]
		);
		$this->add_control(
			'plus_pro_filter_category_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
				'condition' => [
					'gallery_options' => 'repeater',
					'filter_category' => 'yes',
				],
			]
		);
		
		$this->end_controls_section();
		/*post Extra options*/		
		/*Icon Zoom*/
		$this->start_controls_section(
            'section_icon_zoom_style',
            [
                'label' => __('Popup Icon', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
			'display_icon_zoom',
			[
				'label' => __( 'Display Icon', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'default' => 'yes',
			]
		);
		$this->add_control(
			'custom_icon_image',
			[
				'label' => __( 'Custom Icon', 'theplus' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => '',
				],
				'condition' => [
					'display_icon_zoom'    => 'yes',
				],
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
						'min' => 5,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 22,
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .gallery-list .meta-search-icon a' => 'font-size: {{SIZE}}{{UNIT}};max-width:calc({{SIZE}}{{UNIT}} + 10px );',
				],
				'condition' => [
					'display_icon_zoom'    => 'yes',
				],
            ]
        );
		
		$this->start_controls_tabs( 'tabs_icon_style' );
		$this->start_controls_tab(
			'tab_icon_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
				'condition' => [
					'display_icon_zoom'    => 'yes',
				],
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .gallery-list .meta-search-icon a' => 'color: {{VALUE}}',
				],
				'condition' => [
					'display_icon_zoom'    => 'yes',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_icon_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
				'condition' => [
					'display_icon_zoom'    => 'yes',
				],
			]
		);
		$this->add_control(
			'icon_hover_color',
			[
				'label' => __( 'Icon Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .gallery-list .post-inner-loop .gallery-list-content:hover .meta-search-icon a' => 'color: {{VALUE}}',
				],
				'condition' => [
					'display_icon_zoom'    => 'yes',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
            'icon_bottom_space',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Bottom Space', 'theplus'),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 80,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 12,
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .gallery-list .meta-search-icon' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
				'separator' => 'before',
				'condition' => [
					'display_icon_zoom'    => 'yes',
				],
            ]
        );
		$this->end_controls_section();
		/*Icon Zoom*/		
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
				'selector' => '{{WRAPPER}} .gallery-list .post-inner-loop .post-title,{{WRAPPER}} .gallery-list .post-inner-loop .post-title a',
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
					'{{WRAPPER}} .gallery-list .post-inner-loop .post-title,{{WRAPPER}} .gallery-list .post-inner-loop .post-title a' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .gallery-list .post-inner-loop .gallery-list-content:hover .post-title,{{WRAPPER}} .gallery-list .post-inner-loop .gallery-list-content:hover .post-title a' => 'color: {{VALUE}}',
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
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .gallery-list .post-inner-loop .entry-content',
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
					'{{WRAPPER}} .gallery-list .post-inner-loop .entry-content,{{WRAPPER}} .gallery-list .post-inner-loop .entry-content p' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .gallery-list .post-inner-loop .gallery-list-content:hover .entry-content,{{WRAPPER}} .gallery-list .post-inner-loop .gallery-list-content:hover .entry-content p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
            'content_top_space',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Top Space', 'theplus'),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'render_type' => 'ui',
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .gallery-list .post-inner-loop .entry-content' => 'margin-top: {{SIZE}}{{UNIT}}',
				],
            ]
        );
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
				'selector' => '{{WRAPPER}} .gallery-list.gallery-style-1 .gallery-list-content .post-content-center,{{WRAPPER}} .gallery-list.gallery-style-2 .gallery-list-content .post-content-bottom,{{WRAPPER}} .gallery-list.gallery-style-3 .gallery-list-content .post-content-center',
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
				'selector' => '{{WRAPPER}} .gallery-list.gallery-style-1 .gallery-list-content:hover .post-content-center,{{WRAPPER}} .gallery-list.gallery-style-2 .gallery-list-content:hover .post-content-bottom,{{WRAPPER}} .gallery-list.gallery-style-3 .gallery-list-content:hover .post-content-center',
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
				'options' => theplus_get_style_list(1),
			]
		);
		$this->start_controls_tabs( 'tabs_image_style' );
		$this->start_controls_tab(
			'tab_image_normal',
			[
				'label' => __( 'Normal', 'theplus' ),				
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'overlay_image_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .gallery-list .gallery-list-content .gallery-image:before,{{WRAPPER}} .gallery-list.list-isotope-metro .gallery-list-content .gallery-bg-image-metro:before',
			]
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters',
				'selector' => '{{WRAPPER}} .gallery-list .gallery-list-content .gallery-image img,{{WRAPPER}} .gallery-list .gallery-list-content  .gallery-bg-image-metro',
				'separator' => 'before',
			]
		);		
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_image_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'overlay_image_hover_background',
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .gallery-list .gallery-list-content:hover .gallery-image:before,{{WRAPPER}} .gallery-list.list-isotope-metro .gallery-list-content:hover .gallery-bg-image-metro:before',
			]
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'hover_css_filters',
				'selector' => '{{WRAPPER}} .gallery-list .gallery-list-content:hover .gallery-image img,{{WRAPPER}} .gallery-list .gallery-list-content:hover  .gallery-bg-image-metro',
				'separator' => 'before',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
				
		$this->end_controls_section();
		/*Post Featured Image*/		
		/*Filter Category style*/
		$this->start_controls_section(
            'section_filter_category_styling',
            [
                'label' => __('Filter Category', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'filter_category' => 'yes',
					'gallery_options' => 'repeater',
				],
			]
        );
		$this->add_control(
			'plus_pro_filter_category_styling_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
			]
		);
		$this->end_controls_section();
		/*Filter Category style*/
		/*Box Loop style*/
		$this->start_controls_section(
            'section_box_loop_styling',
            [
                'label' => __('Box Loop Background Style', 'theplus'),
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
			'border_style',
			[
				'label' => __( 'Border Style', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => theplus_get_border_style(),
				'selectors'  => [
					'{{WRAPPER}} .gallery-list .post-inner-loop .grid-item .gallery-list-content' => 'border-style: {{VALUE}};',
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
					'{{WRAPPER}} .gallery-list .post-inner-loop .grid-item .gallery-list-content' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .gallery-list .post-inner-loop .grid-item .gallery-list-content' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .gallery-list .post-inner-loop .grid-item .gallery-list-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .gallery-list .post-inner-loop .grid-item .gallery-list-content:hover' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .gallery-list .post-inner-loop .grid-item .gallery-list-content:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'box_border' => 'yes',
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
			'tab_shadow_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow',
				'selector' => '{{WRAPPER}} .gallery-list .post-inner-loop .grid-item .gallery-list-content',
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
				'name'     => 'box_active_shadow',
				'selector' => '{{WRAPPER}} .gallery-list .post-inner-loop .grid-item .gallery-list-content:hover',
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
			'plus_tilt_parallax',
			[
				'label'        => esc_html__( 'Tilt 3D Parallax', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'theplus' ),
				'label_off'    => esc_html__( 'No', 'theplus' ),					
				'render_type'  => 'template',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'plus_pro_plus_tilt_parallax_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
				'condition' => [
					'plus_tilt_parallax' => 'yes',
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
			'plus_pro_plus_mouse_move_parallax_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
				'condition' => [
					'plus_mouse_move_parallax' => 'yes',
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
				'separator' => 'before',
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
		$style=$settings["style"];
		$layout=$settings["layout"];
		$display_title=$settings["display_title"];
		$post_title_tag=$settings["post_title_tag"];
		$popup_style=$settings["popup_style"];
		$popup_attr='';
		if($popup_style=='default'){
			$popup_attr = 'data-elementor-open-lightbox="'.$popup_style.'" data-elementor-lightbox-slideshow="'.$this->get_id().'"';
		}
			
		$display_icon_zoom=$settings["display_icon_zoom"];
		
		$featured_image_type=(!empty($settings["featured_image_type"])) ? $settings["featured_image_type"] : 'full';
		
		$display_excerpt=$settings["display_excerpt"];
		
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
			$layout_attr .=' data-columns="'.esc_attr($metro_columns).'" ';
			$layout_attr .=' data-metro-style="'.esc_attr($settings["metro_style_".$metro_columns]).'" ';
			
		}
		
		$data_class .=' gallery-'.$style;
		$data_class .=' hover-image-'.$settings["hover_image_style"];
		
		$output=$data_attr='';
		
		$ji=1;$ij=0;
		$uid=uniqid("post");
		
		$data_attr .=' data-id="'.esc_attr($uid).'"';
		$data_attr .=' data-style="'.esc_attr($style).'"';
		$tablet_metro_class=$tablet_ij='';
		
		if ( empty($settings['gallery_images'])) {
			$output .='<h3 class="theplus-posts-not-found">'.esc_html__( "Please select a multiple images gallery", "theplus" ).'</h3>';
		}else{
			if($style=='style-1'){
				$output .= '<div id="pt-plus-gallery-list" class="gallery-list '.esc_attr($uid).' '.esc_attr($data_class).' '.$animated_class.'" '.$layout_attr.' '.$data_attr.' '.$animation_attr.' data-enable-isotope="1">';
				
				$output .= '<div id="'.esc_attr($uid).'" class="tp-row post-inner-loop '.esc_attr($uid).'">';
				
				//Multiple Images
				if ( !empty($settings['gallery_images']) && $settings['gallery_options']=='normal') {
					foreach ( $settings['gallery_images'] as $image ) {
						$image_id=$image['id'];
						$attachment = get_post($image_id);
						$title=$description=$caption=$image_alt='';
						if($attachment){
							$image_alt=get_post_meta($image_id, '_wp_attachment_image_alt', true);
							$caption=$attachment->post_excerpt;
							$description=$attachment->post_content;
							$title=$attachment->post_title;
						}
						
						if($layout=='metro'){
							$metro_columns=$settings['metro_column'];
							if(!empty($settings["metro_style_".$metro_columns])){
								$ij=theplus_metro_style_layout($ji,$settings['metro_column'],$settings["metro_style_".$metro_columns]);
							}						
						}
						//grid item loop
						$output .= '<div class="grid-item metro-item'.esc_attr($ij).' '.$desktop_class.' '.$tablet_class.' '.$mobile_class.' '.$animated_columns.'">';
						
						if(!empty($style)){
							ob_start();
								include THEPLUS_PATH. 'includes/gallery/gallery-'.esc_attr($style).'.php'; 
								$output .= ob_get_contents();
							ob_end_clean();
						}
						
						$output .='</div>';
						
						$ji++;
					}
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
}
