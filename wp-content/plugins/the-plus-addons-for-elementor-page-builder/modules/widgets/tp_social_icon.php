<?php 
/*
Widget Name: Social Icon
Description: share social icon list design.
Author: Theplus
Author URI: http://posimyththemes.com
*/
namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Scheme_Typography;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly


class ThePlus_Social_Icon extends Widget_Base {
		
	public function get_name() {
		return 'tp-social-icon';
	}

    public function get_title() {
        return __('Social Icon', 'theplus');
    }

    public function get_icon() {
        return 'fa fa-share-square-o theplus_backend_icon';
    }

    public function get_categories() {
        return array('plus-essential');
    }

    public function get_script_depends() {
        return [
            'theplus_frontend_scripts',
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
			'styles',[
				'label' => __( 'Style','theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-2',
				'separator' => 'after',
				'options' => [
					'style-1' => __( 'Style 1 (PRO)','theplus' ),
					'style-2' => __( 'Style 2','theplus' ),
					'style-3' => __( 'Style 3 (PRO)','theplus' ),
					'style-4' => __( 'Style 4 (PRO)','theplus' ),
					'style-5' => __( 'Style 5 (PRO)','theplus' ),
					'style-6' => __( 'Style 6 (PRO)','theplus' ),
					'style-7' => __( 'Style 7 (PRO)','theplus' ),
					'style-8' => __( 'Style 8 (PRO)','theplus' ),
					'style-9' => __( 'Style 9 (PRO)','theplus' ),
					'style-10' => __( 'Style 10 (PRO)','theplus' ),
					'style-11' => __( 'Style 11 (PRO)','theplus' ),
					'style-12' => __( 'Style 12 (PRO)','theplus' ),
					'style-13' => __( 'Style 13 (PRO)','theplus' ),
					'style-14' => __( 'Style 14 (PRO)','theplus' ),
					'style-15' => __( 'Style 15 (PRO)','theplus' ),
					'custom' => __( 'Custom','theplus' ),
				],
			]
		);
		$repeater = new \Elementor\Repeater();
		
		$repeater->add_control(
			'pt_plus_social_icons',[
				'label' => __( 'Social Network Select','theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'image',
				'options' => [
					'none' => __( 'None','theplus' ),
					'fa-deviantart' => __( 'Deviantart ','theplus' ),
					'fa-digg' => __( 'Digg ','theplus' ),
					'fa-dribbble' => __( 'Dribbble ','theplus' ),
					'fa-dropbox' => __( 'Dropbox ','theplus' ),
					'fa-facebook' => __( 'Facebook ','theplus' ),
					'fa-flickr' => __( 'Flickr ','theplus' ),
					'fa-foursquare' => __( 'Foursquare ','theplus' ),
					'fa-google-plus' => __( 'Google + ','theplus' ),
					'fa-instagram' => __( 'Instagram ','theplus' ),
					'fa-lastfm' => __( 'LastFM ','theplus' ),
					'fa-linkedin' => __( 'LinkedIN ','theplus' ),
					'fa-pinterest-p' => __( 'Pinterest ','theplus' ),
					'fa-rss' => __( 'RSS ','theplus' ),
					'fa-tumblr' => __( 'Tumblr ','theplus' ),
					'fa-twitter' => __( 'Twitter ','theplus' ),
					'fa-vimeo' => __( 'Vimeo ','theplus' ),
					'fa-wordpress' => __( 'Wordpress ','theplus' ),
					'fa-youtube' => __( 'YouTube ','theplus' ),
					'fa-envelope' => __( 'Mail ','theplus' ),
					'fa-xing' => __( 'Xing ','theplus' ),
					'fa-spotify' => __( 'Spotify ','theplus' ),
					'fa-houzz' => __( 'Houzz ','theplus' ),
					'fa-skype' => __( 'Skype ','theplus' ),
					'fa-slideshare' => __( 'Slideshare ','theplus' ),
					'fa-bandcamp' => __( 'Bandcamp ','theplus' ),
					'fa-soundcloud' => __( 'Soundcloud ','theplus' ),
					'fa-snapchat-ghost' => __( 'Snapchat ','theplus' ),
					'fa-behance' => __( 'Behance ','theplus' ),
					'fa-windows' => __( 'Windows','theplus' ),
					'fa-video-camera' => __( 'Video ','theplus' ),
					'fa-tripadvisor' => __( 'TripAdvisor ','theplus' ),
					'fa-vk' => __( 'VK ','theplus' ),
					'fa-odnoklassniki-square' => __( 'Odnoklassniki','theplus' ),
					'fa-odnoklassniki' => __( 'Odnoklassniki 1','theplus' ),
					'fa-get-pocket' => __( 'Get Pocket','theplus' ),
				],
			]
		);
		$repeater->add_control(
			'social_url',
			[
				'label' => __( 'Link', 'theplus' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'https://www.demo-link.com', 'theplus' ),
				'default' => [
					'url' => '#',
				],
			]
		);
		$repeater->add_control(
			'social_text',[
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'label' => __('Title', 'theplus'),
				'default' => '',
			]
		);
		
		$repeater->add_control(
			'icon_color',[
				'label' => __('Icon Color', 'theplus'),
				'type' => Controls_Manager::COLOR,
				'default' => '#d3d3d3',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}:not(.style-12) a,{{WRAPPER}} {{CURRENT_ITEM}}.style-12 a .fa' => 'color: {{VALUE}};',
				],
			]
		);
		$repeater->add_control(
			'icon_hover_color',[
				'label' => __('Icon Hover Color', 'theplus'),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}:not(.style-12):not(.style-4):hover a,{{WRAPPER}} {{CURRENT_ITEM}}.style-12 a span,{{WRAPPER}} {{CURRENT_ITEM}}.style-4 a i.fa,{{WRAPPER}} {{CURRENT_ITEM}}.style-5:hover a i.fa,{{WRAPPER}} {{CURRENT_ITEM}}.style-14 a span' => 'color: {{VALUE}};',
				],
			]
		);
		$repeater->add_control(
			'bg_color',[
				'label' => __('Background Color', 'theplus'),
				'type' => Controls_Manager::COLOR,
				'default' => '#404040',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}:not(.style-3):not(.style-9):not(.style-11):not(.style-12) a,{{WRAPPER}} {{CURRENT_ITEM}}.style-12 a .fa' => 'background: {{VALUE}};',
					'{{WRAPPER}} {{CURRENT_ITEM}}.style-3' => 'background: {{VALUE}};border-color: {{VALUE}};background-clip: content-box;',
					'{{WRAPPER}} {{CURRENT_ITEM}}.style-9:hover a span:before' => 'background: {{VALUE}};',
					'{{WRAPPER}} {{CURRENT_ITEM}}.style-11 a:before' => '-webkit-box-shadow: inset 0 0 0 70px {{VALUE}};-moz-box-shadow: inset 0 0 0 70px {{VALUE}};box-shadow: inset 0 0 0 70px {{VALUE}};',
				],
			]
		);
		$repeater->add_control(
			'bg_hover_color',[
				'label' => __('Background Hover Color', 'theplus'),
				'type' => Controls_Manager::COLOR,
				'default' => '#222222',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}:not(.style-3):not(.style-9):not(.style-11):not(.style-12):hover a,{{WRAPPER}} {{CURRENT_ITEM}}.style-6 a .social-hover-style,{{WRAPPER}} {{CURRENT_ITEM}}.style-12:hover a span' => 'background: {{VALUE}};',
					'{{WRAPPER}} {{CURRENT_ITEM}}.style-3:hover' => 'background: {{VALUE}};border-color: {{VALUE}};background-clip: content-box;',					
					'{{WRAPPER}} {{CURRENT_ITEM}}.style-11:hover a:before' => '-webkit-box-shadow: inset 0 0 0 4px {{VALUE}};-moz-box-shadow: inset 0 0 0 4px {{VALUE}};box-shadow: inset 0 0 0 4px {{VALUE}};',
				],
			]
		);
		$repeater->add_control(
			'border_color',[
				'label' => __('Border Color', 'theplus'),
				'type' => Controls_Manager::COLOR,
				'default' => '#404040',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}:not(.style-11):not(.style-12):not(.style-13) a,{{WRAPPER}} {{CURRENT_ITEM}}.style-12 a .fa,{{WRAPPER}} {{CURRENT_ITEM}}.style-13 a:after,{{WRAPPER}} {{CURRENT_ITEM}}.style-13 a:before' => 'border-color: {{VALUE}};',
				],
			]
		);
		$repeater->add_control(
			'border_hover_color',[
				'label' => __('Border Hover Color', 'theplus'),
				'type' => Controls_Manager::COLOR,
				'default' => '#222222',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}:not(.style-11):not(.style-12):not(.style-13):hover a,{{WRAPPER}} {{CURRENT_ITEM}}.style-12:hover a span,{{WRAPPER}} {{CURRENT_ITEM}}.style-13:hover a:after,{{WRAPPER}} {{CURRENT_ITEM}}.style-13:hover a:before' => 'border-color: {{VALUE}};',
				],
			]
		);
		$repeater->add_control(
			'loop_magic_scroll',[
				'label'   => esc_html__( 'Magic Scroll', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'separator' => 'before',
			]
		);
		$repeater->add_control(
			'plus_pro_magic_scroll_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
				'condition'    => [
					'loop_magic_scroll' => [ 'yes' ],
				],
			]
		);
		$repeater->add_control(
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
		$repeater->add_control(
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
		$repeater->add_control(
			'plus_mouse_move_parallax',
			[
				'label'        => esc_html__( 'Mouse Move Parallax', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'theplus' ),
				'label_off'    => esc_html__( 'No', 'theplus' ),
				'separator' => 'before',
			]
		);
		$repeater->add_control(
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
            'pt_plus_social_networks',
            [
				'label' => __( 'Social Network Select', 'theplus' ),
                'type' => Controls_Manager::REPEATER,
				'description' => __('Add Cascading Sections with Positions.', 'theplus' ),
                'default' => [
                    [
                        'pt_plus_social_icons' => '',                       
                    ],
                ],                
				'fields' => $repeater->get_controls(),
                'title_field' => '{{{ pt_plus_social_icons }}}',
				'condition'    => [
					'styles' => [ 'style-2','custom' ],
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
						'styles!' => [ 'style-2','custom' ],
					],
				]
			);
		$this->add_responsive_control(
			'social_align',
			[
				'label' => __( 'Alignment', 'theplus' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'text-left' => [
						'title' => __( 'Left', 'theplus' ),
						'icon' => 'fa fa-align-left',
					],
					'text-center' => [
						'title' => __( 'Center', 'theplus' ),
						'icon' => 'fa fa-align-center',
					],
					'text-right' => [
						'title' => __( 'Right', 'theplus' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'text-center',
				'condition'    => [
					'styles' => [ 'style-2','custom' ],
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
            'section_social_styling',
            [
                'label' => __('Style', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_responsive_control(
			'social_icon_gap_margin',
			[
				'label' => __( 'Icons Between Gap', 'theplus' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors' => [
					'{{WRAPPER}} .pt_plus_social_list ul.social_list li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',					
				],
			]
		);
		$this->add_responsive_control(
			'icon_size',
			[
                'type' => Controls_Manager::SLIDER,
				'label' => __('Icon Font Size', 'theplus'),
				'size_units' => [ 'px' ],
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'range' => [
					'px' => [
						'min'	=> 8,
						'max'	=> 150,
						'step' => 1,
					],
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .pt_plus_social_list ul.social_list .style-2 a i.fa,
					{{WRAPPER}} .pt_plus_social_list ul.social_list .custom a' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				
            ]
		);
		$this->add_responsive_control(
			'social_icon_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pt_plus_social_list ul.social_list .style-2 a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'styles' => ['style-2'],
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'selector' => '{{WRAPPER}} .pt_plus_social_list ul.social_list .style-2 a span',
				'condition' => [
					'styles' => ['style-2'],
				],
			]
		);
		$this->add_responsive_control(
            'icon_space',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Icon Space', 'theplus'),
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 40,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 5,
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .pt_plus_social_list.custom ul.social_list li a' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .pt_plus_social_list.custom ul.social_list li:last-child a' => 'margin-right: 0;',
				],
				'condition' => [
					'styles' => 'custom',
				],
            ]
        );
		$this->add_responsive_control(
            'social_icon_width',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Icon Width', 'theplus'),
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 400,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 60,
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .pt_plus_social_list.custom ul.social_list li a' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'styles' => 'custom',
				],
				'separator' => 'before',
            ]
        );
		$this->add_responsive_control(
            'social_icon_height',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Icon Height', 'theplus'),
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 400,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 40,
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .pt_plus_social_list.custom ul.social_list li a' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'styles' => 'custom',
				],
            ]
        );
		$this->add_control(
			'social_icon_border',
			[
				'label' => __( 'Box Border', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'default' => 'no',
				'separator' => 'before',
				'condition' => [
					'styles' => 'custom',
				],
			]
		);
		$this->add_control(
			'social_border_style',
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
					'{{WRAPPER}} .pt_plus_social_list.custom ul.social_list li a' => 'border-style: {{VALUE}};',
				],
				'condition' => [
					'styles' => 'custom',
					'social_icon_border' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'social_border_width',
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
					'{{WRAPPER}} .pt_plus_social_list.custom ul.social_list li a' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'styles' => 'custom',
					'social_icon_border' => 'yes',
				],
			]
		);
		$this->start_controls_tabs( 'tabs_border_style' );
		$this->start_controls_tab(
			'tab_border_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
				'condition' => [
					'styles' => 'custom',
				],
			]
		);
		$this->add_responsive_control(
			'social_border_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pt_plus_social_list.custom ul.social_list li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'styles' => 'custom',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_border_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
				'condition' => [
					'styles' => 'custom',
				],
			]
		);
		$this->add_responsive_control(
			'social_border_hover_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pt_plus_social_list.custom ul.social_list li:hover a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'styles' => 'custom',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'social_icon_shadow_options',
			[
				'label' => __( 'Box Shadow Options', 'theplus' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'styles' => 'custom',
				],
			]
		);
		$this->start_controls_tabs( 'tabs_shadow_style' );
		$this->start_controls_tab(
			'tab_shadow_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
				'condition' => [
					'styles' => 'custom',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'social_icon_box_shadow',
				'selector' => '{{WRAPPER}} .pt_plus_social_list.custom ul.social_list li a',
				'condition' => [
					'styles' => 'custom',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_shadow_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
				'condition' => [
					'styles' => 'custom',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'social_icon_box_hover_shadow',
				'selector' => '{{WRAPPER}} .pt_plus_social_list.custom ul.social_list li:hover a',
				'condition' => [
					'styles' => 'custom',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
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
			$styles=$settings['styles'];
			$social_align=$settings["social_align"];
			
			
			
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
			  $social='<div class="pt_plus_social_list '.esc_attr($social_align).' '.esc_attr($styles).' '.esc_attr($animated_class).'" '.$animation_attr.'>';
				$social .='<ul class="social_list ">';
			if(!empty($settings['pt_plus_social_networks'])){			
				foreach($settings['pt_plus_social_networks'] as $network) {
				$link_atts_title=$link_atts_url=$link_atts_target='';
				$social_text=$link='';
				$id=rand(1000,10000000);
					if(!empty($network['pt_plus_social_icons']) && !empty($network['social_url']['url'])) {
					
						if(!empty($network['pt_plus_social_icons'])) {
							$icon = $network['pt_plus_social_icons'];
						}
						if ( ! empty( $network['social_url']['url'] ) ) {
							$link_atts_url = 'href="'.esc_url($network["social_url"]["url"]).'"';
						}
						if ( ! empty( $network['social_url']['is_external'] ) ) {
							$link_atts_target = 'target="_blank"';
						}
						if ( ! empty($network['social_url']['nofollow']) ) {
							$link_atts_title = 'rel="nofollow"';
						}
						
						if(!empty($network['social_text']) && ($styles=='style-2')){
							$social_text='<span data-lang="en">'.esc_html($network['social_text']).'</span>';
						}
						$icon_html = '<i class="fa '.esc_attr($icon).'"></i>';
						
						$uid_social=uniqid("social");
						$social .= '<li id="'.esc_attr($uid_social).'" class="elementor-repeater-item-' . $network['_id'] . ' '.esc_attr($styles).'  social-'.esc_attr($icon).' social-'.esc_attr($id).'" >';
							$social .= '<div class="social-loop-inner  "  >';
								$social .= '<a '.$link_atts_url.' '.$link_atts_title.' '.$link_atts_target.'>'.$icon_html.$social_text.'</a>';
							$social .= '</div>';
						$social .= '</li>';
					}
				}
			}
			$social .='</ul>';
		$social .='</div>';
		
	echo $social;
	}
    protected function content_template() {
	
    }

}
