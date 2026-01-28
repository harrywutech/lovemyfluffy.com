<?php
namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Bzotech_List_Link extends Widget_Base {
	public function get_name() {
		return 'bzotech_list_link';
	}
	public function get_title() {
		return esc_html__( 'List Link', 'bw-petito' );
	}
	public function get_icon() {
		return 'eicon-editor-link';
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
		echo bzotech_get_template_widget('list-link/list-link',$settings['style'],$attr);
	}
	
	protected function content_template() {
		
	}
	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'bw-petito' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'style',
			[
				'label' 	=> esc_html__( 'Style', 'bw-petito' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'elbzotech-list-link-inline',
				'options'   => [
					'elbzotech-list-link-inline'		=> esc_html__( 'Style 1 - Inline', 'bw-petito' ),
					'elbzotech-list-link-block'	=> esc_html__( 'Style 2 - Block', 'bw-petito' ),
					'elbzotech-list-link-icon'		=> esc_html__( 'Style 3 - Icon', 'bw-petito' ),
					'elbzotech-list-link-icon-style2'		=> esc_html__( 'Style 4 - Icon', 'bw-petito' ),
				],
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'title', [
				'label' => __( 'Title', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Title text', 'bw-petito' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'bw-petito' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => '',
					'library' => 'solid',
				],
			]
		);
		$repeater->add_control(
			'icon_image',
			[
				'label' => esc_html__( 'Icon image', 'bw-petito' ),
				'description'	=> esc_html__( 'You can choose the icon image here (Replace for icon)', 'bw-petito' ),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'icon[value]' =>  '',
				]
			]
		);
		$repeater->add_control(
			'icon_image_hover',
			[
				'label' => esc_html__( 'Icon image hover', 'bw-petito' ),
				'description'	=> esc_html__( 'You can choose the icon image here (Replace for icon)', 'bw-petito' ),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'icon[value]' =>  '',
				]
			]
		);
		$repeater->add_control(
			'link',
			[
				'label' => __( 'Link', 'bw-petito' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'https://your-link.com', 'bw-petito' ),
				'show_label' => false,
			]
		);
		$repeater->start_controls_tabs( 'tabs_style_private' );
		$repeater->start_controls_tab(
			'tab_normal_private',
			[
				'label' => __( 'Style private', 'bw-petito' ),
			]
		);
		$repeater->add_control(
			'icon_color_private',
			[
				'label' => __( 'Icon Color', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.item-link  i' => 'color: {{VALUE}}',
				],
			]
		);
		$repeater->add_control(
			'title_color_private',
			[
				'label' => __( 'Title Color', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.item-link .title' => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}}.item-link' => 'color: {{VALUE}}'
				],
			]
		);
		$repeater->add_control(
			'background_color_private',
			[
				'label' => __( 'Background Color', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.item-link' => 'background-color: {{VALUE}};',
				],
			]
		);
		$repeater->add_control(
			'border_color_icon_private',
			[
				'label' => __( 'Border Color', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.item-link i' => 'border-color: {{VALUE}};',
				],
			]
		);
		$repeater->add_control(
			'add_class_css_private', 
			[
				'label' => esc_html__( 'Add class CSS', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter name class' , 'bw-petito' ),
			]
		);
		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'tab_hover_private',
			[
				'label' => __( 'Style private hover', 'bw-petito' ),
			]
		);
		$repeater->add_control(
			'icon_color_hover_private',
			[
				'label' => __( 'Icon Color Hover', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.item-link:hover i' => 'color: {{VALUE}}',
				],
			]
		);
		$repeater->add_control(
			'title_color_hover_private',
			[
				'label' => __( 'Title Color Hover', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.item-link:hover .title' => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}}.item-link:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$repeater->add_control(
			'background_color_hover_private',
			[
				'label' => __( 'Background Color hover', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.item-link:hover, {{WRAPPER}} {{CURRENT_ITEM}}.item-link:focus' => 'background-color: {{VALUE}};',
				],
			]
		);
		$repeater->add_control(
			'border_color_hover_private',
			[
				'label' => __( 'Border Color hover', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.item-link:hover, {{WRAPPER}} {{CURRENT_ITEM}}.item-link:focus' => 'border-color: {{VALUE}};',
				],
			]
		);
		
		$repeater->end_controls_tab();
		$repeater->end_controls_tabs();
		$this->add_control(
			'list_link',
			[
				'label' => esc_html__( 'Add list', 'bw-petito' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty'=>false,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => esc_html__( 'Link 1', 'bw-petito' ),
						'link'  => '#',
					],
					[
						'title' => esc_html__( 'Link 2', 'bw-petito' ),
						'link'  => '#',
					],
				],
			]
		);
		
		$left = is_rtl() ? 'right' : 'left';
		$right = is_rtl() ? 'left' : 'right';
		$this->add_responsive_control(
			'alignment',
			[
				'label' => __( 'Alignment', 'bw-petito' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'bw-petito' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'bw-petito' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'bw-petito' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .element-list-link' => 'text-align: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'separator_inline',
			[
				'label' 	=> esc_html__( 'Separator', 'bw-petito' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''		=> esc_html__( 'None', 'bw-petito' ),
					'dot'	=> esc_html__( 'Dot', 'bw-petito' ),
					'vertical-bricks'	=> esc_html__( 'Vertical bricks', 'bw-petito' ),
				],
				'condition' => [
					'style' => 'elbzotech-list-link-inline'
				]
			]
		);
		$this->add_responsive_control(
			'space_separator',
			[
				'label' => __( 'separator space', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elbzotech-list-link-inline .space-separator' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'separator_inline!' => ''
				]
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'bw-petito' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs( 'tabs_style' );
		$this->start_controls_tab(
			'tab_normal',
			[
				'label' => __( 'Normal', 'bw-petito' ),
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .item-link i' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .item-link .title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .item-link' => 'color: {{VALUE}}'
				],
			]
		);
		$this->add_control(
			'background_color',
			[
				'label' => __( 'Background Color', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .item-link' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'border_color_icon',
			[
				'label' => __( 'Border Color', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-button' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'label' => __( 'Typography', 'bw-petito' ),
				'selector' => '{{WRAPPER}} .item-link',
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_hover',
			[
				'label' => __( 'Hover', 'bw-petito' ),
			]
		);
		$this->add_control(
			'icon_color_hover',
			[
				'label' => __( 'Icon Color Hover', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .item-link:hover i' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'title_color_hover',
			[
				'label' => __( 'Title Color Hover', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .item-link:hover .title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .item-link:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'background_color_hover',
			[
				'label' => __( 'Background Color hover', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .item-link:hover, {{WRAPPER}} .item-link:focus' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'border_color_hover',
			[
				'label' => __( 'Border Color hover', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .item-link:hover, {{WRAPPER}} .item-link:focus' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography_hover',
				'label' => __( 'Typography hover', 'bw-petito' ),
				'selector' => '{{WRAPPER}} .item-link:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		
		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Icon size', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .item-link i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'space_icon',
			[
				'label' => __( 'Icon space with text', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .item-link i' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .icon-image-link' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'label' => __( 'Text Shadow', 'bw-petito' ),
				'selector' => '{{WRAPPER}} .item-link .title',
			]
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters_title',
				'selector' => '{{WRAPPER}} .item-link .title',
			]
		);
		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => __( 'Padding', 'bw-petito' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .item-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'icon_margin',
			[
				'label' => __( 'Margin', 'bw-petito' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .item-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .item-link',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'bw-petito' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .item-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}
	
}?>