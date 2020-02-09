<?php 
/*
Widget Name: Accordion/FAQ
Description: Toggle of faq/accordion.
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


class ThePlus_Accordion extends Widget_Base {
		
	public function get_name() {
		return 'tp-accordion';
	}

    public function get_title() {
        return __('Accordion', 'theplus');
    }

    public function get_icon() {
        return 'fa fa-lightbulb-o theplus_backend_icon';
    }

    public function get_categories() {
        return array('plus-tabbed');
    }
	
	public function get_keywords() {
		return [ 'accordion', 'tabs', 'toggle' ];
	}
	
	public function get_style_depends() {
		return [ 'theplus-tabs-tours-ele' ];
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
				'label' => __( 'Content', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'tab_title',
			[
				'label' => __( 'Title & Content', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Accordion Title' , 'theplus' ),
				'dynamic' => [
					'active' => true,
				],
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'content_source',
			[
				'label' => __( 'Content Source', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'content',
				'options' => [
					'content'  => __( 'Content', 'theplus' ),
					'page_template' => __( 'Page Template (PRO)', 'theplus' ),
				],
			]
		);
		$repeater->add_control(
			'tab_content',
			[
				'label' => __( 'Content', 'theplus' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => __( 'Accordion Content', 'theplus' ),
				'show_label' => false,
				'condition'    => [
					'content_source' => [ 'content' ],
				],
			]
		);
		$repeater->add_control(
				'plus_pro_page_template_options',
				[
					'label' => __( 'Unlock more possibilities', 'theplus' ),
					'type' => Controls_Manager::TEXT,
					'default' => '',
					'description' => theplus_pro_ver_notice(),
					'classes' => 'plus-pro-version',
					'condition'    => [
						'content_source' => [ 'page_template' ],
					],
				]
			);
		$this->add_control(
			'tabs',
			[
				'label' => '',
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'tab_title' => __( 'Accordion #1', 'theplus' ),
						'tab_content' => __( 'I am item content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'theplus' ),
					],
					[
						'tab_title' => __( 'Accordion #2', 'theplus' ),
						'tab_content' => __( 'I am item content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'theplus' ),
					],
				],
				'title_field' => '{{{ tab_title }}}',
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'icon_content_section',
			[
				'label' => __( 'Icon Option', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'display_icon',[
				'label'   => esc_html__( 'Show Icon', 'theplus' ),
				'type'    =>  Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),	
			]
		);
		$this->add_control(
			'icon_style',
			[
				'label' => __( 'Icon Font', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'font_awesome',
				'options' => [
					'font_awesome'  => __( 'Font Awesome', 'theplus' ),
					'icon_mind' => __( 'Icons Mind (PRO)', 'theplus' ),
				],
				'condition' => [
					'display_icon' => 'yes',
				],
			]
		);
		$this->add_control(
			'icon_fontawesome',
			[
				'label' => __( 'Icon Library', 'theplus' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-plus',
				'condition' => [
					'display_icon' => 'yes',
					'icon_style' => 'font_awesome',
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
					'display_icon' => 'yes',
					'icon_style' => 'icon_mind',
				],
			]
		);
		$this->add_control(
			'icon_fontawesome_active',
			[
				'label' => __( 'Active Icon Library', 'theplus' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-minus',
				'condition' => [
					'display_icon' => 'yes',
					'icon_style' => 'font_awesome',
				],
			]
		);
		$this->add_control(
			'title_html_tag',
			[
				'label' => __( 'Title HTML Tag', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
				],
				'default' => 'div',
				'separator' => 'before',
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'extra_content_section',
			[
				'label' => __( 'Extra Option', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'plus_pro_active_accordion_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_toggle_style_icon',
			[
				'label' => __( 'Icon', 'theplus' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'display_icon' => 'yes',
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion .elementor-tab-title .elementor-accordion-icon .fa:before' => 'color: {{VALUE}};',
				],
				'condition' => [
					'display_icon' => 'yes',
				],
			]
		);

		$this->add_control(
			'icon_active_color',
			[
				'label' => __( 'Active Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion .elementor-tab-title.active .elementor-accordion-icon .fa:before' => 'color: {{VALUE}};',
				],
				'condition' => [
					'display_icon' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'icon_space',
			[
				'label' => __( 'Gap', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion .elementor-accordion-icon.elementor-accordion-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-accordion .elementor-accordion-icon.elementor-accordion-icon-right' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'display_icon' => 'yes',
				],
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'section_title_style',
			[
				'label' => __( 'Title', 'theplus' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .theplus-accordion-wrapper .theplus-accordion-item .plus-accordion-header',
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
					'{{WRAPPER}} .theplus-accordion-wrapper .theplus-accordion-item .plus-accordion-header' => 'color: {{VALUE}}',
				],
				'condition' => [
					'title_color_option' => 'solid',
				],
			]
		);
		$this->add_control(
			'plus_pro_title_gradient_color_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
				'condition' => [
					'title_color_option' => 'gradient',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_title_active',
			[
				'label' => __( 'Active', 'theplus' ),
			]
		);
		$this->add_control(
			'title_active_color_option',
			[
				'label' => __( 'Title Active Color', 'theplus' ),
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
			'title_active_color',
			[
				'label' => __( 'Active Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#3351a6',
				'selectors' => [
					'{{WRAPPER}} .theplus-accordion-wrapper .theplus-accordion-item .plus-accordion-header.active' => 'color: {{VALUE}}',
				],
				'condition' => [
					'title_active_color_option' => 'solid',
				],
			]
		);
		$this->add_control(
			'plus_pro_title_gradient_active_color_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
				'condition' => [
					'title_active_color_option' => 'gradient',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*title style*/
		/*Title style*/
		$this->start_controls_section(
            'section_accordion_styling',
            [
                'label' => __('Title Background', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
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
		$this->add_responsive_control(
			'border_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .theplus-accordion-wrapper .theplus-accordion-item .plus-accordion-header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'box_border' => 'yes',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_border_active',
			[
				'label' => __( 'Active', 'theplus' ),
				'condition' => [
					'box_border' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'border_active_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .theplus-accordion-wrapper .theplus-accordion-item .plus-accordion-header.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'box_border' => 'yes',
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
				'selector'  => '{{WRAPPER}} .theplus-accordion-wrapper .theplus-accordion-item .plus-accordion-header',
				
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_background_active',
			[
				'label' => __( 'Active', 'theplus' ),
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'box_active_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .theplus-accordion-wrapper .theplus-accordion-item .plus-accordion-header.active',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		
		$this->end_controls_section();
		/*Title style*/
		/*desc style*/
		$this->start_controls_section(
            'section_desc_styling',
            [
                'label' => __('Content', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
			]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'label' => __( 'Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .theplus-accordion-wrapper .theplus-accordion-item .plus-accordion-content .plus-content-editor',
			]
		);
		$this->add_control(
			'desc_color',
			[
				'label' => __( 'Text Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .theplus-accordion-wrapper .theplus-accordion-item .plus-accordion-content .plus-content-editor,{{WRAPPER}} .theplus-accordion-wrapper .theplus-accordion-item .plus-accordion-content .plus-content-editor p' => 'color: {{VALUE}}',
				],
				'separator' => 'after',
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
            'section_content_bg_styling',
            [
                'label' => __('Content Background', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
			]
        );
		$this->add_responsive_control(
			'content_border_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .theplus-accordion-wrapper .theplus-accordion-item .plus-accordion-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'content_box_border' => 'yes',
				],
			]
		);
		$this->add_control(
			'content_background_options',
			[
				'label' => __( 'Background Options', 'theplus' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'content_box_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .theplus-accordion-wrapper .theplus-accordion-item .plus-accordion-content',
				'separator' => 'after',
				
			]
		);
		$this->end_controls_section();
		/*desc style*/
		
		/*Hover Animation style*/
		$this->start_controls_section(
            'section_hover_styling',
            [
                'label' => __('Hover Style', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
			]
        );
		$this->add_control(
			'plus_pro_hover_style_options',
			[
				'label' => __( 'Unlock more possibilities', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => theplus_pro_ver_notice(),
				'classes' => 'plus-pro-version',
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
		$id_int = substr( $this->get_id_int(), 0, 3 );
		
		$uid=uniqid("accordion");
		
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
		<div class="theplus-accordion-wrapper elementor-accordion <?php echo esc_attr($animated_class); ?>" id="<?php echo esc_attr($uid); ?>" data-accordion-id="<?php echo esc_attr($uid); ?>" data-accordion-type="accordion" data-toogle-speed="300" <?php echo $animation_attr; ?> role="tablist">
			<?php
			foreach ( $settings['tabs'] as $index => $item ) :
				$tab_count = $index + 1;
				if(1==$tab_count){
					$active_default='active-default';
				}else{
					$active_default='no';
				}
				
				
				$tab_title_setting_key = $this->get_repeater_setting_key( 'tab_title', 'tabs', $index );

				$tab_content_setting_key = $this->get_repeater_setting_key( 'tab_content', 'tabs', $index );

				$this->add_render_attribute( $tab_title_setting_key, [
					'id' => 'elementor-tab-title-' . $id_int . $tab_count,
					'class' => [ 'elementor-tab-title', 'plus-accordion-header', $active_default, 'text-left' ],
					'tabindex' => $id_int . $tab_count,
					'data-tab' => $tab_count,
					'role' => 'tab',
					'aria-controls' => 'elementor-tab-content-' . $id_int . $tab_count,
				] );

				$this->add_render_attribute( $tab_content_setting_key, [
					'id' => 'elementor-tab-content-' . $id_int . $tab_count,
					'class' => [ 'elementor-tab-content', 'elementor-clearfix', 'plus-accordion-content', $active_default],
					'data-tab' => $tab_count,
					'role' => 'tabpanel',
					'aria-labelledby' => 'elementor-tab-title-' . $id_int . $tab_count,
				] );

				$this->add_inline_editing_attributes( $tab_content_setting_key, 'advanced' );
				?>
				<div class="theplus-accordion-item">
					<<?php echo $settings['title_html_tag']; ?> <?php echo $this->get_render_attribute_string( $tab_title_setting_key ); ?>>
						<?php if ( $settings['display_icon']=='yes' ) : ?>
							<?php 
								if($settings['icon_style']=='font_awesome'){
									$icons=$settings['icon_fontawesome'];
									$icons_active=$settings['icon_fontawesome_active'];
								}else{
									$icons=$icons_active='';
								}
							?>
							<?php if(!empty($icons) && !empty($icons_active)){ ?>
								<span class="elementor-accordion-icon elementor-accordion-icon-left" aria-hidden="true">
									<i class="elementor-accordion-icon-closed <?php echo esc_attr( $icons ); ?>"></i>
									<i class="elementor-accordion-icon-opened <?php echo esc_attr( $icons_active ); ?>"></i>
								</span>
							<?php } ?>
						<?php endif; ?>
						<?php echo $item['tab_title']; ?>
					</<?php echo $settings['title_html_tag']; ?>>
					<div <?php echo $this->get_render_attribute_string( $tab_content_setting_key ); ?>>
						<?php if($item['content_source']=='content' && !empty($item['tab_content'])){
							echo '<div class="plus-content-editor">'.$this->parse_text_editor( $item['tab_content'] ).'</div>';
						}
						?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<?php
	}

	protected function content_template() {
	
	}
}
