<?php 
/*
Widget Name: Countdown 
Description: Display countdown.
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


class ThePlus_Heading_Animation extends Widget_Base {
		
	public function get_name() {
		return 'tp-heading-animation';
	}

    public function get_title() {
        return __('Heading Animation', 'theplus');
    }

    public function get_icon() {
        return 'fa fa-i-cursor theplus_backend_icon';
    }

    public function get_categories() {
        return array('plus-creatives');
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
				'label' => __( 'Text Animation', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'anim_styles',[
				'label' => __( 'Animation Style','theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1' => __( 'Style 1','theplus' ),
					'style-2' => __( 'Style 2 (PRO)','theplus' ),
					'style-3' => __( 'Style 3 (PRO)','theplus' ),
					'style-4' => __( 'Style 4 (PRO)','theplus' ),
					'style-5' => __( 'Style 5 (PRO)','theplus' ),
					'style-6' => __( 'Style 6','theplus' ),
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
					'anim_styles!' => ['style-1','style-6'],
				],
			]
		);
		$this->add_control(
            'prefix',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Prefix Text', 'theplus'),
                'label_block' => true,
                'description' => __('Enter Text, Which will be visible before the Animated Text.', 'theplus'),
                'separator' => 'before',
                'default' => __('This is ', 'theplus'),
				'condition'    => [
					'anim_styles' => ['style-1','style-6'],
				],
            ]
        );
		$this->add_control(
			'ani_title',
			[
				'label' => __( 'Animated Text', 'theplus' ),
				'type' => Controls_Manager::TEXTAREA,
				'description' => __( 'You need to add Multiple line by ctrl + Enter Or Cmnd + Enter for animated text.', 'theplus' ),
				'rows' => 5,
				'default' => __( 'Heading', 'theplus' ),
				'placeholder' => __( 'Type your description here', 'theplus' ),
				'condition'    => [
					'anim_styles' => ['style-1','style-6'],
				],
			]
		);
		$this->add_control(
            'postfix',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Postfix Text', 'theplus'),
                'label_block' => true,
                'description' => __('Enter Text, Which will be visible After the Animated Text.', 'theplus'),
                'separator' => 'before',
                'default' => __('Animation', 'theplus'),
				'condition'    => [
					'anim_styles' => ['style-1','style-6'],
				],
            ]
        );
		$this->add_responsive_control(
			'heading_text_align',
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
				 'selectors' => [
                    '{{WRAPPER}} .pt-plus-heading-animation .pt-plus-cd-headline,{{WRAPPER}} .pt-plus-heading-animation .pt-plus-cd-headline span' => 'text-align: {{VALUE}};',
                ],
				'condition'    => [
					'anim_styles' => ['style-1','style-6'],
				],
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
            'section_prefix_postfix_styling',
            [
                'label' => __('Prefix and Postfix', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
            'heading_anim_color',
            [
                'label' => __('Font Color', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => '#313131',
                'selectors' => [
                    '{{WRAPPER}} .pt-plus-heading-animation .pt-plus-cd-headline,{{WRAPPER}} .pt-plus-heading-animation .pt-plus-cd-headline span' => 'color: {{VALUE}};',
                ],
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'prefix_postfix_typography',
				'selector' => '{{WRAPPER}} .pt-plus-heading-animation .pt-plus-cd-headline,{{WRAPPER}} .pt-plus-heading-animation .pt-plus-cd-headline span',
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
            'section_heading_animation_styling',
            [
                'label' => __('Animated Text', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
            'ani_color',
            [
                'label' => __('Font Color', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => '#313131',
                'selectors' => [
                    '{{WRAPPER}} .pt-plus-heading-animation .pt-plus-cd-headline b' => 'color: {{VALUE}};',
                ],
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ani_typography',
				'selector' => '{{WRAPPER}} .pt-plus-heading-animation .pt-plus-cd-headline b',
			]
		);
		$this->add_control(
            'ani_bg_color',
            [
                'label' => __('Animation Background Color', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => '#d3d3d3',
				'condition' => [
					'anim_styles!' => ['style-6'],
				],
                'selectors' => [
                    '{{WRAPPER}} .pt-plus-heading-animation:not(.head-anim-style-6) .pt-plus-cd-headline b' => 'background: {{VALUE}};',
                ],
            ]
        );
		$this->end_controls_section();
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
		$anim_styles=$settings["anim_styles"];
		$prefix=$settings["prefix"];
		$postfix=$settings["postfix"];
		$ani_title=$settings["ani_title"];
		
			$animation_effects=$settings["animation_effects"];
			$animation_delay=$settings["animation_delay"]["size"];
			$animate_duration='';
			if($settings["animation_duration_default"]=='yes'){
				$animate_duration=$settings["animate_duration"]["size"];
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
			
			$heading_animation_back = 'style="';
			if($settings["ani_bg_color"] != "") {
				$heading_animation_back .='background: '.esc_attr($settings["ani_bg_color"]).';';
			}
			$heading_animation_back .= '"';		
				
				
			// Order of replacement
			$order   = array("\r\n", "\n", "\r", "<br/>", "<br>");
			$replace = '|';
				
			// Processes \r\n's first so they aren't converted twice.
			$str = str_replace($order, $replace, $ani_title);
			
			$lines = explode("|", $str);
			
			$count_lines = count($lines);
				
			$background_css='';
			if(!empty($settings["ani_color"])) {
				$background_css .= 'background-color: '.esc_attr($settings["ani_color"]).';';
			}
		
		
		$uid=uniqid('heading-animation');
		
		$heading_animation ='<div class="pt-plus-heading-animation heading-animation head-anim-'.esc_attr($anim_styles).' '.esc_attr($animated_class).' '.esc_attr($uid).'"  '.$animation_attr.'>';
		
		if ($anim_styles == 'style-1') {	
			$heading_animation .='<h1 class="pt-plus-cd-headline letters type" >';
			if($prefix != ''){
				$heading_animation .='<span >'.$prefix.' </span>';	
			}
			$heading_animation .='<span class="cd-words-wrapper waiting" '.$heading_animation_back.'>';
			$i=0;
			foreach($lines as $line)
			{
				if($i==0){
					
					$heading_animation .= '<b  class="is-visible"> '.strip_tags($line).'</b>';
					
					}else{
					$heading_animation .= '<b class=""> '.strip_tags($line).'</b>';
				}
				$i++;
			}
			
			$strings = '['; 
			foreach($lines as $key => $line)  
			{ 
				$strings .= trim(htmlspecialchars_decode(strip_tags($line)));
				if($key != ($count_lines-1))
				$strings .= ','; 
			} 
			$strings .= ']';		
			$heading_animation .='</span>';
			if($postfix != ''){
				$heading_animation .='<span > '.esc_html($postfix).' </span>';	
			}
			$heading_animation .='</h1>';
		}
		
		if ($anim_styles == 'style-6') {
			$heading_animation .='<h1 class="pt-plus-cd-headline letters scale"" >';
			if($prefix != ''){
				$heading_animation .='<span >'.esc_html($prefix).' </span>';	
			}
			$heading_animation .='<span class="cd-words-wrapper style-6"   >';
			$i=0;
			foreach($lines as $line)
			{
				if($i==0){
					
					$heading_animation .= '<b  class="is-visible ">'.strip_tags($line).'</b>';
					
					}else{
					$heading_animation .= '<b class="" >'.strip_tags($line).'</b>';
				}
				$i++;
			}
			
			$strings = '['; 
			foreach($lines as $key => $line)  
			{ 
				$strings .= trim(htmlspecialchars_decode(strip_tags($line)));
				if($key != ($count_lines-1))
				$strings .= ','; 
			} 
			$strings .= ']';
				$heading_animation .='</span>';	
			if($postfix != ''){
				$heading_animation .='<span > '.esc_html($postfix).' </span>';	
			}
			$heading_animation .='</h1>';	
		}
		$heading_animation .='</div>';
				
		$css_rule='';
		$css_rule .= '<style>';
			$css_rule .= '.'.esc_js($uid).' .pt-plus-cd-headline.loading-bar .cd-words-wrapper::after{'.esc_js($background_css).'}';
		$css_rule .= '</style>';
		echo $css_rule.$heading_animation;
	}
    protected function content_template() {
	
    }

}