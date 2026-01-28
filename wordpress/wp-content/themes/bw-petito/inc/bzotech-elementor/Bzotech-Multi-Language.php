<?php
namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


	class Bzotech_Multi_Language extends Widget_Base {
		public function get_name() {
			return 'bzotech_multi_language';
		}
		public function get_title() {
			return esc_html__( 'Multi language', 'bw-petito' );
		}
		public function get_icon() {
			return 'eicon-globe';
		}
		public function get_categories() {
			return [ 'aqb-htelement-category' ];
		}

		protected function render() {
			$settings = $this->get_settings();
			$attr = array(
				'wdata'		=> $this,
				'settings'	=> $settings,
			);
			echo bzotech_get_template_widget('multi-language/multi-language',$settings['style'],$attr);
		}
		
		protected function content_template() {
			
		}
		protected function register_controls() {
			$this->start_controls_section(
				'content_section',
				[
					'label' => esc_html__( 'Content', 'bw-petito' ),
					'tab' => Controls_Manager::TAB_CONTENT,
				]
			);
			$this->add_control(
				'style',
				[
					'label' => esc_html__( 'Type', 'bw-petito' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'default',
					'options' => [
						'default'  => esc_html__( 'Default', 'bw-petito' ),
						'wpml-style' => esc_html__( 'Style by Wpml', 'bw-petito' ),
						'poly-style' => esc_html__( 'Style by Polylang', 'bw-petito' ),
						'demo-style' => esc_html__( 'Demo style', 'bw-petito' ),
					],
				]
			);
			$data_demo = new Repeater();
			$data_demo->add_control(
				'title', 
				[
					'label' => esc_html__( 'Title', 'bw-petito' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( 'Enter text' , 'bw-petito' ),
					'label_block' => true,
				]
			);
			$data_demo->add_control(
				'image', [
					'label' => esc_html__( 'Image', 'bw-petito' ),
					'type' => Controls_Manager::MEDIA,
					'placeholder' => esc_html__( 'Enter logo flag', 'bw-petito' ),
				]
			);
			$this->add_control(
				'data_demo',
				[
					'label' => esc_html__( 'Add text', 'bw-petito' ),
					'type' => Controls_Manager::REPEATER,
					'fields' => $data_demo->get_controls(),
					'prevent_empty'=>false,
					'default' => [
						[
							'title' => esc_html__( 'English', 'bw-petito' ),
						],
						[
							'title' => esc_html__( 'Viet Nam', 'bw-petito' ),
						],
					],
					'title_field' => '{{{ title }}}',
					'condition' => [
						'style' => 'demo-style',
					]
				]
			);
			$this->add_control(
				'flag',
				[
					'label' => esc_html__( 'Show Flag', 'bw-petito' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Yes', 'bw-petito' ),
					'label_off' => esc_html__( 'No', 'bw-petito' ),
					'return_value' => 'yes',
					'default' => 'yes',
					'condition' => [
						'style' => ['default','demo-style'],
					]
				]
			);
			$this->add_control(
				'show_label',
				[
					'label' => esc_html__( 'Show Label', 'bw-petito' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Yes', 'bw-petito' ),
					'label_off' => esc_html__( 'No', 'bw-petito' ),
					'return_value' => 'yes',
					'default' => 'yes',
					'condition' => [
						'style' => ['default','demo-style'],
					]
				]
			);
			$this->end_controls_section();
			$this->start_controls_section(
				'section_style_label',
				[
					'label' => esc_html__( 'Label style', 'bw-petito' ),
					'tab'   => Controls_Manager::TAB_STYLE,
					'condition' => [
						'style' =>  ['default','demo-style'],
					]
				]
			);
	
			$this->add_responsive_control(
				'alignment',
				[
					'label' => esc_html__( 'Justify Content', 'bw-petito' ),
					'type' => Controls_Manager::CHOOSE,
					'responsive' => true,
					'label_block' => true,
					'options' => [
						'flex-start' => [
							'title' => esc_html_x( 'Start', 'Flex Container Control', 'bw-petito' ),
							'icon' => 'eicon-flex eicon-justify-start-h',
						],
						'center' => [
							'title' => esc_html_x( 'Center', 'Flex Container Control', 'bw-petito' ),
							'icon' => 'eicon-flex eicon-justify-center-h',
						],
						'flex-end' => [
							'title' => esc_html_x( 'End', 'Flex Container Control', 'bw-petito' ),
							'icon' => 'eicon-flex eicon-justify-end-h',
						],
						'space-between' => [
							'title' => esc_html_x( 'Space Between', 'Flex Container Control', 'bw-petito' ),
							'icon' => 'eicon-flex eicon-justify-space-between-h',
						],
						'space-around' => [
							'title' => esc_html_x( 'Space Around', 'Flex Container Control', 'bw-petito' ),
							'icon' => 'eicon-flex eicon-justify-space-around-h',
						],
						'space-evenly' => [
							'title' => esc_html_x( 'Space Evenly', 'Flex Container Control', 'bw-petito' ),
							'icon' => 'eicon-flex eicon-justify-space-evenly-h',
						],
					],
					'selectors' => [
						'{{WRAPPER}} .language-box-global>.label-e' => 'justify-content: {{VALUE}};',
					],
					'default' => '',
					'condition' => [
						'style' =>  ['default','demo-style']
					]
				]
			);
	
			$this->add_responsive_control(
				'align_items',
				[
					'label' => esc_html__( 'Align Items', 'bw-petito' ),
					'type' => Controls_Manager::CHOOSE,
					'responsive' => true,
					'options' => [
						'flex-start' => [
							'title' => esc_html_x( 'Start', 'Flex Container Control', 'bw-petito' ),
							'icon' => 'eicon-flex eicon-align-start-v',
						],
						'center' => [
							'title' => esc_html_x( 'Center', 'Flex Container Control', 'bw-petito' ),
							'icon' => 'eicon-flex eicon-align-center-v',
						],
						'flex-end' => [
							'title' => esc_html_x( 'End', 'Flex Container Control', 'bw-petito' ),
							'icon' => 'eicon-flex eicon-align-end-v',
						],
						'stretch' => [
							'title' => esc_html_x( 'Stretch', 'Flex Container Control', 'bw-petito' ),
							'icon' => 'eicon-flex eicon-align-stretch-v',
						],
					],
					'selectors' => [
						'{{WRAPPER}} .language-box-global>.label-e' => 'align-items: {{VALUE}};',
					],
					'default' => '',
					'condition' => [
						'style' =>  ['default','demo-style']
					]
				]
			);
			$this->add_responsive_control(
				'width_label_lang',
				[
					'label' => esc_html__( 'Width', 'bw-petito' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px'],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
						]
					],
					'selectors' => [
						'{{WRAPPER}} .language-box-global>.label-e' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
	
			$this->add_responsive_control(
				'height_label_lang',
				[
					'label' => esc_html__( 'Height', 'bw-petito' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 500,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .language-box-global>.label-e' => 'line-height: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'gap_label_lang',
				[
					'label' => esc_html__( 'Gap', 'bw-petito' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 500,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .language-box-global>.label-e' => 'gap: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->get_style_type_text('label','label-e');
			
			$this->end_controls_section(); /*End title style*/
			$this->start_controls_section(
				'section_style_label_item',
				[
					'label' => esc_html__( 'Label item style', 'bw-petito' ),
					'tab'   => Controls_Manager::TAB_STYLE,
					'condition' => [
						'style' =>  ['default','demo-style'],
					]
				]
			);
			$this->get_style_type_text('label-item','label-item-e');
			
			$this->end_controls_section(); /*End title style*/
			$this->start_controls_section(
				'section_style_dropdown',
				[
					'label' => esc_html__( 'Dropdown style', 'bw-petito' ),
					'tab'   => Controls_Manager::TAB_STYLE,
					'condition' => [
						'style' =>  ['default','demo-style'],
					]
				]
			);
			$this->add_responsive_control(
				'dropdown_width_css',
				[
					'label' => esc_html__( 'Width', 'bw-petito' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ '%','px','vw' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 500,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
						'vw' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .elbzotech-dropdown-list' => 'min-width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'dropdown_bg_color_css',
				[
					'label' => esc_html__( 'Background Color', 'bw-petito' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .elbzotech-dropdown-list' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name' => 'dropdown_shadow_css',
					'label' => esc_html__( 'Text Shadow', 'bw-petito' ),
					'selector' => '{{WRAPPER}} .elbzotech-dropdown-list',
				]
			);
			$this->add_responsive_control(
				'dropdown_padding_css',
				[
					'label' => esc_html__( 'Padding', 'bw-petito' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px'],
					'selectors' => [
						'{{WRAPPER}} .elbzotech-dropdown-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' => 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'dropdown_border_css',
					'selector' => '{{WRAPPER}} .elbzotech-dropdown-list',
					'separator' => 'before',
				]
			);
	
			$this->add_responsive_control(
				'dropdown_border_radius',
				[
					'label' => esc_html__( 'Border Radius', 'bw-petito' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px','%'],
					'selectors' => [
						'{{WRAPPER}}  .elbzotech-dropdown-list' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section(); /*End title style*/
		}
		public function get_style_type_text($key='text',$class="item-text-e") {
			$this->start_controls_tabs( $key.'_tabs_style' );
			$this->start_controls_tab(
				$key.'_tab_normal_css',
				[
					'label' => esc_html__( 'Normal Style', 'bw-petito' ),
				]
			);
			$this->add_control(
				$key.'_color_css',
				[
					'label' => esc_html__( 'Color', 'bw-petito' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .'.$class => 'color: {{VALUE}}',
						'{{WRAPPER}} .'.$class.' .sub-color-e' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				$key.'bg_color_css',
				[
					'label' => esc_html__( 'Background Color', 'bw-petito' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .'.$class => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => $key.'_typography_css',
					'label' => esc_html__( 'Text Typography', 'bw-petito' ),
					'selector' => '{{WRAPPER}} .'.$class,
				]
			);
			$this->add_responsive_control(
				$key.'_opacity_css',
				[
					'label' => esc_html__( 'Opacity', 'bw-petito' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'max' => 1,
							'min' => 0,
							'step' => 0.01,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .'.$class => 'opacity: {{SIZE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name' => $key.'_shadow_css',
					'label' => esc_html__( 'Text Shadow', 'bw-petito' ),
					'selector' => '{{WRAPPER}} .'.$class,
				]
			);
			$this->add_responsive_control(
				$key.'_padding_css',
				[
					'label' => esc_html__( 'Padding', 'bw-petito' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px'],
					'selectors' => [
						'{{WRAPPER}} .'.$class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' => 'before',
				]
			);
	
			$this->add_responsive_control(
				$key.'_margin_css',
				[
					'label' => esc_html__( 'Margin', 'bw-petito' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' ],
					'selectors' => [
						'{{WRAPPER}} .'.$class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => $key.'_border_css',
					'selector' => '{{WRAPPER}} .'.$class,
					'separator' => 'before',
				]
			);
	
			$this->add_control(
				 $key.'_border_radius',
				[
					'label' => esc_html__( 'Border Radius', 'bw-petito' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors' => [
						'{{WRAPPER}}  .'.$class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_tab(); /*End Normal Style*/
	
			$this->start_controls_tab(
				$key.'_tab_hover_css',
				[
					'label' => esc_html__( 'Style On Hover', 'bw-petito' ),
				]
			);
			$this->add_control(
				$key.'_color_hover_css',
				[
					'label' => esc_html__( 'Color On Hover', 'bw-petito' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .'.$class.':hover' => 'color: {{VALUE}}',
						'{{WRAPPER}} .'.$class.':hover .sub-color-e' => 'color: {{VALUE}}',
					],
				]
			);
			
			$this->add_control(
				$key.'_bg_color_hover_css',
				[
					'label' => esc_html__( 'Background Color On Hover', 'bw-petito' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .'.$class.':hover, {{WRAPPER}} .'.$class.':focus' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => $key.'_typography_hover_css',
					'label' => esc_html__( 'Typography On Hover', 'bw-petito' ),
					'selector' => '{{WRAPPER}} .'.$class.':hover',
				]
			);
			$this->add_responsive_control(
				$key.'_opacity_hover_css',
				[
					'label' => esc_html__( 'Opacity On Hover', 'bw-petito' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'max' => 1,
							'min' => 0,
							'step' => 0.01,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .'.$class.':hover' => 'opacity: {{SIZE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name' => $key.'_shadow_hover_css',
					'label' => esc_html__( 'Shadow On Hover', 'bw-petito' ),
					'selector' => '{{WRAPPER}} .'.$class.':hover',
				]
			);
			$this->add_control(
				$key.'_hover_transition_css',
				[
					'label' => esc_html__( 'Transition Duration On Hover', 'bw-petito' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'max' => 5,
							'step' => 0.1,
						],
					],
					'selectors' => [
						'{{WRAPPER}}  .'.$class => 'transition-duration: {{SIZE}}s',
					],
				]
			);
			$this->add_control(
				$key.'_animation_hover_css',
				[
					'label' => esc_html__( 'Animation On Hover', 'bw-petito' ),
					'type' => Controls_Manager::HOVER_ANIMATION,
				]
			);
	
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => $key.'_border_hover_css',
					'selector' => '{{WRAPPER}} .'.$class.':hover',
					'separator' => 'before',
				]
			);
	
			$this->add_control(
				 $key.'_border_hover_radius',
				[
					'label' => esc_html__( 'Border Radius', 'bw-petito' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors' => [
						'{{WRAPPER}}  .'.$class.':hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_tab();/*End Hover Style*/
			$this->end_controls_tabs();
		}
	}
