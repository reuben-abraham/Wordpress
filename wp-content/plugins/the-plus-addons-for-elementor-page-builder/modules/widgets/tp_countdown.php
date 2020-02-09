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
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly


class ThePlus_Countdown extends Widget_Base {
		
	public function get_name() {
		return 'tp-countdown';
	}

    public function get_title() {
        return __('Countdown', 'theplus');
    }

    public function get_icon() {
        return 'fa fa-clock-o theplus_backend_icon';
    }

    public function get_categories() {
        return array('plus-essential');
    }

    public function get_script_depends() {
        return [
            'theplus_frontend_scripts',
			'downCount-js'
        ];
    }

    protected function _register_controls() {
		
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Countdown Date', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'counting_timer',
			[
				'label' => __( 'Launch Date', 'theplus' ),
				'type' => Controls_Manager::DATE_TIME,
				'default'     => date( 'd-m-Y H:i', strtotime( '+1 month' ) + ( get_option( 'gmt_offset' ) ) ),
				'description' => sprintf( __( 'Date set according to your timezone: %s.', 'theplus' ), Utils::get_timezone_string() ),
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
            'section_downcount',
            [
                'label' => __('Label', 'theplus'),
            ]
        );
		$this->add_control(
			'show_labels',
			[
				'label'   => esc_html__( 'Show Labels', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
            'text_days',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Days Section Text', 'theplus'),
                'label_block' => true,
                'separator' => 'before',
                'default' => __('Days', 'theplus'),
				'condition'    => [
					'show_labels!' => '',
				],
            ]
        );
		$this->add_control(
            'text_hours',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Hours Section Text', 'theplus'),
                'label_block' => true,
                'separator' => 'before',
                'default' => __('Hours', 'theplus'),
				'condition'    => [
					'show_labels!' => '',
				],
            ]
        );
		$this->add_control(
            'text_minutes',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Minutes Section Text', 'theplus'),
                'label_block' => true,
                'separator' => 'before',
                'default' => __('Minutes', 'theplus'),
                'condition'    => [
					'show_labels!' => '',
				],
            ]
        );
		$this->add_control(
            'text_seconds',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Seconds Section Text', 'theplus'),
                'label_block' => true,
                'separator' => 'before',
                'default' => __('Seconds', 'theplus'),
				'condition'    => [
					'show_labels!' => '',
				],
            ]
        );
		$this->end_controls_section();
		$this->start_controls_section(
            'section_styling',
            [
                'label' => __('Counter Styling', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,				
            ]
        );
		$this->add_control(
            'number_text_color',
            [
                'label' => __('Counter Font Color', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .pt_plus_countdown li > span' => 'color: {{VALUE}};',
                ],
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'numbers_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}}  .pt_plus_countdown li > span',
				'separator' => 'after',
			)
		);
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'label_typography',
                'label' => __('Label Typography', 'theplus'),
                'selector' => '{{WRAPPER}} .pt_plus_countdown li > h6',
				'separator' => 'after',
				'condition'    => [
					'show_labels!' => '',
				],
            ]
        );
		$this->start_controls_tabs( 'tabs_days_style' );

		$this->start_controls_tab(
			'tab_day_style',
			[
				'label' => __( 'Days', 'theplus' ),
			]
		);
		$this->add_control(
            'days_text_color',
            [
                'label' => __('Text Color', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .pt_plus_countdown li.count_1 h6' => 'color:{{VALUE}};',
                ],
            ]
        );
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'days_background',
				'label'     => __("Days Background",'theplus'),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .pt_plus_countdown li.count_1',
				
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_hour_style',
			[
				'label' => __( 'Hours', 'theplus' ),
			]
		);
		$this->add_control(
            'hours_text_color',
            [
                'label' => __('Text Color', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .pt_plus_countdown li.count_2 h6' => 'color:{{VALUE}};',
                ],
            ]
        );
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'hours_background',
				'label'     => __("Background",'theplus'),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .pt_plus_countdown li.count_2',				
			]
		);
		$this->end_controls_tab();
		
		$this->start_controls_tab(
			'tab_minute_style',
			[
				'label' => __( 'Minutes', 'theplus' ),
			]
		);
		$this->add_control(
            'minutes_text_color',
            [
                'label' => __('Text Color', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .pt_plus_countdown li.count_3 h6' => 'color:{{VALUE}};',
                ],
            ]
        );
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'minutes_background',
				'label'     => __("Background",'theplus'),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .pt_plus_countdown li.count_3',				
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_second_style',
			[
				'label' => __( 'Seconds', 'theplus' ),
			]
		);
		$this->add_control(
            'seconds_text_color',
            [
                'label' => __('Text Color', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .pt_plus_countdown li.count_4 h6' => 'color:{{VALUE}};',
                ],
            ]
        );
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'seconds_background',
				'label'     => __("Background",'theplus'),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .pt_plus_countdown li.count_4',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'counter_padding',
			[
				'label' => __( 'Padding', 'theplus' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .pt_plus_countdown li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],				
			]
		);
		
		$this->add_control(
			'count_border_style',
			[
				'label'   => __( 'Border Style', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none'   => __( 'None', 'theplus' ),
				],
				'separator' => 'before',
				'selectors'  => [
					'{{WRAPPER}} .pt_plus_countdown li' => 'border-style: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'count_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pt_plus_countdown li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
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
		
		$data_attr='';
		
		
		$uid=uniqid('count_down');
			if (empty($settings['show_labels'])){
				$show_labels=$settings['show_labels'];
			}else{
				$show_labels='yes';
			}
			if (empty($settings['text_days'])){
				$text_days='Days';
			}else{
				$text_days=$settings['text_days'];
			}
			
			if (empty($settings['text_hours'])){
				$text_hours='Hours';
			}else{
				$text_hours=$settings['text_hours'];
			}
			
			if (empty($settings['text_minutes'])){
				$text_minutes='Minutes';
			}else{
				$text_minutes=$settings['text_minutes'];
			}
			
			if (empty($settings['text_seconds'])){
				$text_seconds='Seconds';
			}else{
				$text_seconds=$settings['text_seconds'];
			}
			
			if(!empty($settings['counting_timer'])){
				$counting_timer=$settings['counting_timer'];
				$counting_timer= date('d-m-Y', strtotime($counting_timer));
			}else{
				$counting_timer='31-08-2018';
			}
			
			$data_attr .='data-days="'.esc_attr($text_days).'"';
			$data_attr .='data-hours="'.esc_attr($text_hours).'"';
			$data_attr .='data-minutes="'.esc_attr($text_minutes).'"';
			$data_attr .='data-seconds="'.esc_attr($text_seconds).'"';
			
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
			?>
			<ul class="pt_plus_countdown <?php echo esc_attr($uid); ?> <?php echo $animated_class; ?>" <?php echo $data_attr; ?> data-timer="<?php echo esc_attr($counting_timer); ?>" <?php echo $animation_attr; ?>>
					<li class="count_1">
						<span class="days">00</span>
						<?php if(!empty($show_labels) && $show_labels=='yes'){ ?>
							<h6 class="days_ref"><?php echo esc_html($text_days); ?></h6>
						<?php } ?>
					</li>
					<li class="count_2">
						<span class="hours">00</span>
						<?php if(!empty($show_labels) && $show_labels=='yes'){ ?>
							<h6 class="hours_ref"><?php echo esc_html($text_hours); ?></h6>
						<?php } ?>
					</li>
					<li class="count_3">
						<span class="minutes">00</span>
						<?php if(!empty($show_labels) && $show_labels=='yes'){ ?>
						<h6 class="minutes_ref"><?php echo esc_html($text_minutes); ?></h6>
						<?php } ?>
					</li>
					<li class="count_4">
						<span class="seconds last">00</span>
						<?php if(!empty($show_labels) && $show_labels=='yes'){ ?>
						<h6 class="seconds_ref"><?php echo esc_html($text_seconds); ?></h6>
						<?php } ?>
					</li>
				</ul>
			<?php 	
	}
    protected function content_template() {
	
    }

}