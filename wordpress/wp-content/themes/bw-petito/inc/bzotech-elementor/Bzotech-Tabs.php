<?php
namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Bzotech_Tabs extends Widget_Base {
	public function get_name() {
		return 'bzotech_tab';
	}
	public function get_title() {
		return esc_html__( 'Tab', 'bw-petito' );
	}
	public function get_icon() {
		return 'eicon-tabs';
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
		echo bzotech_get_template_widget('tabs/tab',$settings['style'],$attr);
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
				'default'   => '',
				'options'   => [
					''		=> esc_html__( 'Style 1 (Basic)', 'bw-petito' ),
				],
			]
		);
		
		$this->add_control(
			'title_header',
			[
				'label' => __( 'Title header', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'bw-petito' ),
				'placeholder' => __( 'Title header', 'bw-petito' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'sub_title_header',
			[
				'label' => __( 'Sub Title header', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'bw-petito' ),
				'placeholder' => __( 'Sub title header', 'bw-petito' ),
				'label_block' => true,
			]
		);
		$repeater = new Repeater();

		$repeater->add_control(
			'tab_title',
			[
				'label' => __( 'Title & Description', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Tab Title', 'bw-petito' ),
				'placeholder' => __( 'Tab Title', 'bw-petito' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon title', 'bw-petito' ),
				'type' => Controls_Manager::ICONS,
			]
		);
		$repeater->add_control(
			'template',
			[
				'label' 	=> esc_html__( 'Template content', 'bw-petito' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => bzotech_list_post_type('elementor_library',true),
			]
		);
		$repeater->add_control(
			'tab_content',
			[
				'label' => __( 'Content', 'bw-petito' ),
				'default' => __( 'Tab Content', 'bw-petito' ),
				'placeholder' => __( 'Tab Content', 'bw-petito' ),
				'type' => Controls_Manager::WYSIWYG,
				'show_label' => false,
				'dynamic' => [
					'active' => false,
				],
				'condition' => [
					'template' => ''
				]
			]
		);
		
		$this->add_control(
			'tabs',
			[
				'label' => esc_html__( 'Tabs Items', 'bw-petito' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty'=>false,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'tab_title' => esc_html__( 'Tab #1', 'bw-petito' ),
						'tab_content'  => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'bw-petito' ),
					],
					[
						'tab_title' => esc_html__( 'Tab #2', 'bw-petito' ),
						'tab_content' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'bw-petito' ),
					],
				],
				'title_field' => '{{{ tab_title }}}',
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'type',
			[
				'label' => esc_html__( 'Tab Position', 'bw-petito' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'horizontal-top',
				'options' => [
					'horizontal-top' => esc_html__( 'Horizontal top', 'bw-petito' ),
					'horizontal-bottom' => esc_html__( 'Horizontal bottom', 'bw-petito' ),
					'vertical-left' => esc_html__( 'Vertical left', 'bw-petito' ),					
					'vertical-right' => esc_html__( 'Vertical right', 'bw-petito' ),
				],
				'separator' => 'before',

			]
		);
		$this->add_control(
			'style_title_header',
			[
				'label' 	=> esc_html__( 'Title Header Style', 'bw-petito' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style1',
				'options'   => [
					'style1'					=> esc_html__( 'Style 1 (Default)', 'bw-petito' ),
				],
				'condition' => [
					'title_header!' => '',
				]
			]
		);
		$this->add_control(
			'item_title_header_style',
			[
				'label' 	=> esc_html__( 'Item Title Header Style', 'bw-petito' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style1',
				'options'   => [
					'style1'					=> esc_html__( 'Style 1 (Default)', 'bw-petito' ),
					'style2'		=> esc_html__( 'Style 2', 'bw-petito' ),
				],
			]
		);
		
		$this->end_controls_section();
		$this->start_controls_section(
			'section_header_tab',
			[
				'label' => esc_html__( 'Header Tab', 'bw-petito' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);  
		$this->add_control(
			'layout_tab_header',
			[
				'label' 	=> esc_html__( 'Layout tab header', 'bw-petito' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'layout-tab-header-d',
				'separator' => 'before',
				'options'   => [
					'layout-tab-header-df'		=> esc_html__( 'Defaut', 'bw-petito' ),
					'flex-wrapper flex_wrap-wrap'		=> esc_html__( 'Flex wrap', 'bw-petito' ),
				],

			]
		);
		$this->add_control(
			'content_width_tab_header',
			[
				'label' 	=> esc_html__( 'Content Width', 'bw-petito' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'header-w-default',
				'options'   => [
					'header-w-default'		=> esc_html__( 'Defaut', 'bw-petito' ),
					'header-w-boxed'		=> esc_html__( 'boxed', 'bw-petito' ),
				],

			]
		);
		$this->add_responsive_control(
			'header_tab_width',
			[
				'label' => esc_html__( 'header tab width', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%','px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .header-w-default' => 'width: {{SIZE}}{{UNIT}};',
				],
				
				'condition' => [
					'content_width_tab_header' => 'header-w-default',
				]
			]
		);
		$this->add_responsive_control(
			'header_tab_width_box',
			[
				'label' => esc_html__( 'header tab width', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['%','px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .layout-tab-header-df .header-w-boxed' => 'max-width: {{SIZE}}{{UNIT}}; margin-left: auto!important; margin-right: auto!important;',
				],
				
				'condition' => [
					'content_width_tab_header' => 'header-w-boxed',
					'type' => ['horizontal-top','horizontal-bottom'],
					'layout_tab_header' => 'layout-tab-header-df',
				]
				
			]
		);
		$this->add_responsive_control(
			'horizontal_tab_header',
			[
				'label' 	=> esc_html__( 'Horizontal Align Header', 'bw-petito' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'separator' => 'before',
				'options'   => [
					''		=> esc_html__( 'Defaut', 'bw-petito' ),
					'flex-start'		=> esc_html__( 'Start', 'bw-petito' ),
					'center'		=> esc_html__( 'Center', 'bw-petito' ),
					'flex-end'		=> esc_html__( 'End', 'bw-petito' ),
					'space-between'		=> esc_html__( 'Space between', 'bw-petito' ),
				],
				'selectors' => [
					'{{WRAPPER}}  .header-tab-layout .header-tab' => 'justify-content: {{VALUE}}; -ms-justify-content: {{VALUE}}; -webkit-justify-content: {{VALUE}};',
					'{{WRAPPER}} .header-tab-layout .header-tab' => 'justify-content: {{VALUE}}; -ms-justify-content: {{VALUE}}; -webkit-justify-content: {{VALUE}}; ',
				],
				
			]
		);
		$this->add_responsive_control(
			'vertical_tab_header',
			[
				'label' 	=> esc_html__( 'Vertical Align Header', 'bw-petito' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''		=> esc_html__( 'Defaut', 'bw-petito' ),
				
					'flex-start'		=> esc_html__( 'top', 'bw-petito' ),
					'center'		=> esc_html__( 'Middle', 'bw-petito' ),
					'flex-end'		=> esc_html__( 'Bottom', 'bw-petito' ),
				],
				'selectors' => [
					'{{WRAPPER}} .header-tab-layout' => 'align-content: {{VALUE}}; align-items: {{VALUE}};',
					'{{WRAPPER}} .header-tab-layout' => 'align-content: {{VALUE}};  align-items: {{VALUE}};',
				],
				
			]
		);
		
		
		$this->add_responsive_control(
			'magin_header_tab',
			[
				'label' => esc_html__( 'Magin', 'bw-petito' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .header-tab' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'padding_header_tab',
			[
				'label' => esc_html__( 'Padding', 'bw-petito' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .header-tab' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_header_tab',
                'label' => esc_html__( 'Border', 'bw-petito' ),
				'selector' => '{{WRAPPER}} .header-tab',
			]
        );
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'shadow_header_tab',
				'selector' => '{{WRAPPER}} .header-tab',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_header_tab',
				'label' => esc_html__( 'Background', 'bw-petito' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .header-tab',
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_style_tab_content',
			[
				'label' => esc_html__( 'Content tab', 'bw-petito' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		); 
		$this->add_responsive_control(
			'content_tab_width',
			[
				'label' => esc_html__( 'Width', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px','%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tab-content' => 'width: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);
		$this->add_responsive_control(
			'horizontal_align_content',
			[
				'label' 	=> esc_html__( 'Horizontal Align Content', 'bw-petito' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''		=> esc_html__( 'Defaut', 'bw-petito' ),
					
					'flex-start'		=> esc_html__( 'Start', 'bw-petito' ),
					'center'		=> esc_html__( 'Center', 'bw-petito' ),
					'flex-end'		=> esc_html__( 'End', 'bw-petito' ),
				],
				'selectors' => [
					'{{WRAPPER}} tabs-vertical-left .tab-content' => 'justify-content: {{VALUE}}; -ms-justify-content: {{VALUE}}; -webkit-justify-content: {{VALUE}}; display: flex; display: -ms-flex; display: -webkit-flex;',
					'{{WRAPPER}} tabs-vertical-right .tab-content' => 'justify-content: {{VALUE}}; -ms-justify-content: {{VALUE}}; -webkit-justify-content: {{VALUE}}; display: flex; display: -ms-flex; display: -webkit-flex;',
				],
				'condition' => [
					'type' => ['vertical-left','vertical-right'],
				]

			]
		);
		$this->add_responsive_control(
			'vertical_align_content',
			[
				'label' 	=> esc_html__( 'Vertical Align Content', 'bw-petito' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''		=> esc_html__( 'Defaut', 'bw-petito' ),
					
					'flex-start'		=> esc_html__( 'top', 'bw-petito' ),
					'center'		=> esc_html__( 'Middle', 'bw-petito' ),
					'flex-end'		=> esc_html__( 'Bottom', 'bw-petito' ),
				],
				'selectors' => [
					'{{WRAPPER}} tabs-vertical-left .tab-content' => 'align-content: {{VALUE}}; align-items: {{VALUE}}; display: flex; display: -ms-flex; display: -webkit-flex;',
					'{{WRAPPER}} tabs-vertical-right .tab-content' => 'align-content: {{VALUE}};  align-items: {{VALUE}}; display: flex; display: -ms-flex; display: -webkit-flex;',
				],
				'separator' => 'after',
				'condition' => [
					'type' => ['vertical-left','vertical-right'],
				]

			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'content_background',
				'label' => esc_html__( 'Background', 'bw-petito' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .tab-content',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'content_border',
                'label' => esc_html__( 'Border', 'bw-petito' ),
                'separator' => 'before',
				'selector' => '{{WRAPPER}} .tab-content',
			]
        );

        $this->add_responsive_control(
			'content_radius',
			[
				'label' => esc_html__( 'Border Radius', 'bw-petito' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .tab-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_padding',
			[
				'label' => esc_html__( 'Padding', 'bw-petito' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],
				'selectors' => [
					'{{WRAPPER}} .tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);	
		$this->end_controls_section();
		$this->start_controls_section(
			'section_style_tab',
			[
				'label' => esc_html__( 'Item Title Tab', 'bw-petito' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);   
		$this->add_responsive_control(
			'header_tab_list_width',
			[
				'label' => esc_html__( 'width', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px','%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .header-tab-list' => 'width: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);
		$this->add_responsive_control(
			'horizontal_align_item_tab',
			[
				'label' 	=> esc_html__( 'Horizontal Align Item Tab', 'bw-petito' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'separator' => 'before',
				'options'   => [
					''		=> esc_html__( 'Defaut', 'bw-petito' ),
				
					'flex-start'		=> esc_html__( 'Start', 'bw-petito' ),
					'center'		=> esc_html__( 'Center', 'bw-petito' ),
					'flex-end'		=> esc_html__( 'End', 'bw-petito' ),
				],
				'selectors' => [
					'{{WRAPPER}} .header-tab.flex-wrapper .header-tab-list' => 'justify-content: {{VALUE}}; -ms-justify-content: {{VALUE}}; -webkit-justify-content: {{VALUE}};',
				],
				'condition' => [
					'layout_tab_header' => ['flex-wrapper flex_wrap-wrap']
				]
			]
		);
		$this->add_responsive_control(
			'vertical_align_item_tab',
			[
				'label' 	=> esc_html__( 'Vertical Align Item Tab', 'bw-petito' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'separator' => 'after',
				'options'   => [
					''		=> esc_html__( 'Defaut', 'bw-petito' ),
					
					'flex-start'		=> esc_html__( 'top', 'bw-petito' ),
					'center'		=> esc_html__( 'Middle', 'bw-petito' ),
					'flex-end'		=> esc_html__( 'Bottom', 'bw-petito' ),
				],
				'selectors' => [
					'{{WRAPPER}} .header-tab.flex-wrapper .header-tab-list' => 'align-content: {{VALUE}}; align-items: {{VALUE}}; display: flex; display: -ms-flex; display: -webkit-flex;',
				],
				'condition' => [
					'layout_tab_header' => ['flex-wrapper flex_wrap-wrap']
				]

			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'tab_typography',
				'selector' => '{{WRAPPER}} .nav-tabs > li > a',
			]
		);
		$this->add_responsive_control(
			'tab_align',
			[
				'label' => esc_html__( 'Alignment', 'bw-petito' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'bw-petito' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'bw-petito' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'bw-petito' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .header-tab-list' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'tab_item_space',
			[
				'label' => esc_html__( 'Item space', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs > li' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .nav-tabs > li:last-child' => 'margin-right: 0px;',
				],

			]
		);
		
		$this->add_responsive_control(
			'tab_size_icon',
			[
				'label' => esc_html__( 'Size icon', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs > li > a i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'icon_pos',
			[
				'label' 	=> esc_html__( 'Icon position', 'bw-petito' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'left-text',
				'options'   => [
					'left-text'		=> esc_html__( 'Left of text', 'bw-petito' ),
					'right-text'	=> esc_html__( 'Right of text', 'bw-petito' ),
					'top-text'	=> esc_html__( 'Top of text', 'bw-petito' ),
					'bottom-text'	=> esc_html__( 'Bottom of text', 'bw-petito' ),
				],
			]
		);
		$this->add_responsive_control(
			'tab_icon_spacing',
			[
				'label' => esc_html__( 'Icon distance with text', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon_pos-right-text i' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .icon_pos-left-text i' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .icon_pos-top-text i' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .icon_pos-bottom-text i' => 'margin-top: {{SIZE}}{{UNIT}};'
				]
			]
		);
		
		$this->add_responsive_control(
			'tab_item_width',
			[
				'label' => esc_html__( 'Item width', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs > li' => 'width: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'tab_item_height',
			[
				'label' => esc_html__( 'Item height', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs > li > a' => 'height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);


		
		$this->start_controls_tabs( 'tab_effects',
			['separator' => 'before']
		 );

		$this->start_controls_tab( 'tab_normal',
			[
				'label' => esc_html__( 'Normal', 'bw-petito' ),

			]
		);

		$this->add_control(
			'tab_color',
			[
				'label' => esc_html__( 'Color', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .nav-tabs > li > a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'tab_color_icon',
			[
				'label' => esc_html__( 'Color icon', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .nav-tabs > li > a i' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'tab_background',
				'label' => esc_html__( 'Background', 'bw-petito' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .nav-tabs > li > a',
			]
		);

		$this->add_responsive_control(
			'tab_padding',
			[
				'label' => esc_html__( 'Padding', 'bw-petito' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'tab_border',
                'label' => esc_html__( 'Border', 'bw-petito' ),
                'separator' => 'before',
				'selector' => '{{WRAPPER}} .nav-tabs > li > a',
			]
        );

        $this->add_responsive_control(
			'tab_radius',
			[
				'label' => esc_html__( 'Border Radius', 'bw-petito' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs > li > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'tab_shadow',
				'selector' => '{{WRAPPER}} .nav-tabs > li > a',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'tab_hover',
			[
				'label' => esc_html__( 'Hover', 'bw-petito' ),
			]
		);

		$this->add_control(
			'tab_color_hover',
			[
				'label' => esc_html__( 'Color', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .nav-tabs > li > a:hover' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_responsive_control(
			'tab_color_icon:hover',
			[
				'label' => esc_html__( 'Color icon', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .nav-tabs > li > a;hover i' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'tab_background_hover',
				'label' => esc_html__( 'Background', 'bw-petito' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .nav-tabs > li > a:hover',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'tab_border_hover',
                'label' => esc_html__( 'Border', 'bw-petito' ),
                'separator' => 'before',
				'selector' => '{{WRAPPER}} .nav-tabs > li > a:hover',
			]
        );

        $this->add_responsive_control(
			'tab_radius_hover',
			[
				'label' => esc_html__( 'Border Radius', 'bw-petito' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs > li > a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'tab_shadow_hover',
				'selector' => '{{WRAPPER}} .nav-tabs > li > a:hover',
			]
		);

		$this->add_control(
			'tab_hover_transition',
			[
				'label' => esc_html__( 'Transition Duration', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs > li > a' => 'transition-duration: {{SIZE}}s',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'tab_active',
			[
				'label' => esc_html__( 'Active', 'bw-petito' ),
			]
		);

		$this->add_control(
			'tab_color_active',
			[
				'label' => esc_html__( 'Color', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .nav-tabs > li.active > a' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_responsive_control(
			'tab_color_icon_active',
			[
				'label' => esc_html__( 'Color icon', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .nav-tabs > li.active > a i' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'tab_background_active',
				'label' => esc_html__( 'Background', 'bw-petito' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .nav-tabs > li.active > a',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'tab_border_active',
                'label' => esc_html__( 'Border', 'bw-petito' ),
                'separator' => 'before',
				'selector' => '{{WRAPPER}} .nav-tabs > li.active > a',
			]
        );

        $this->add_responsive_control(
			'tab_radius_active',
			[
				'label' => esc_html__( 'Border Radius', 'bw-petito' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs > li.active > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'tab_shadow_active',
				'selector' => '{{WRAPPER}} .nav-tabs > li.active > a',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->end_controls_section();


		$this->start_controls_section(
			'title_header_tab',
			[
				'label' => esc_html__( 'Title Header', 'bw-petito' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'title_header!' => ''
				]
			]
		);  
		$this->add_responsive_control(
			'title_header_width',
			[
				'label' => esc_html__( 'Item width', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px','%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .div-title-header' => 'width: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'horizontal_align_title',
			[
				'label' 	=> esc_html__( 'Horizontal Align Title', 'bw-petito' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''		=> esc_html__( 'Defaut', 'bw-petito' ),
					
					'flex-start'		=> esc_html__( 'Start', 'bw-petito' ),
					'center'		=> esc_html__( 'Center', 'bw-petito' ),
					'flex-end'		=> esc_html__( 'End', 'bw-petito' ),
				],
				'selectors' => [
					'{{WRAPPER}} .header-tab.flex-wrapper .div-title-header' => 'justify-content: {{VALUE}}; -ms-justify-content: {{VALUE}}; -webkit-justify-content: {{VALUE}}; display: flex; display: -ms-flex; display: -webkit-flex;',
				],
				'condition' => [
					'layout_tab_header' => ['flex-wrapper flex_wrap-wrap']
				]

			]
		);
		$this->add_responsive_control(
			'vertical_align_title',
			[
				'label' 	=> esc_html__( 'Vertical Align Title', 'bw-petito' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''		=> esc_html__( 'Defaut', 'bw-petito' ),
					
					'flex-start'		=> esc_html__( 'top', 'bw-petito' ),
					'center'		=> esc_html__( 'Middle', 'bw-petito' ),
					'flex-end'		=> esc_html__( 'Bottom', 'bw-petito' ),
				],
				'selectors' => [
					'{{WRAPPER}} .header-tab.flex-wrapper .div-title-header' => 'align-content: {{VALUE}}; align-items: {{VALUE}}; display: flex; display: -ms-flex; display: -webkit-flex;',
				],
				'condition' => [
					'layout_tab_header' => ['flex-wrapper flex_wrap-wrap']
				]

			]
		);
		$this->add_responsive_control(
			'title_header_post',
			[
				'label' => esc_html__( 'Position', 'bw-petito' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'bw-petito' ),
						'icon' => 'eicon-text-align-left',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'bw-petito' ),
						'icon' => 'eicon-text-align-right',
					],
					'none' => [
						'title' => esc_html__( 'Right', 'bw-petito' ),
						'icon' => ' eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .div-title-header' => 'float: {{VALUE}};',
				],
			]
			
		);
		$this->add_responsive_control(
			'title_header_align',
			[
				'label' => esc_html__( 'Alignment', 'bw-petito' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'bw-petito' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'bw-petito' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'bw-petito' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .div-title-header' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->start_controls_tabs( 'tab_style_title_and_sub',
			['separator' => 'before']
		 );

		$this->start_controls_tab( 'tab_style_title',
			[
				'label' => esc_html__( 'Style title', 'bw-petito' ),

			]
		);
		$this->add_control(
			'title_header_color',
			[
				'label' => esc_html__( 'Color', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title-header' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_header_typography',
				'selector' => '{{WRAPPER}} .title-header',
			]
		);
		$this->add_responsive_control(
			'padding_title_header',
			[
				'label' => esc_html__( 'Padding', 'bw-petito' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .div-title-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'margin_title_header',
			[
				'label' => esc_html__( 'Margin', 'bw-petito' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .div-title-header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab( 'tab_style_sub_title',
			[
				'label' => esc_html__( 'Style sub title', 'bw-petito' ),

			]
		);
		$this->add_control(
			'sub_title_header_color',
			[
				'label' => esc_html__( 'Color sub title', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sub-title-header' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'sub_title_header_typography',
				'selector' => '{{WRAPPER}} .sub-title-header',
			]
		);
		$this->add_responsive_control(
			'padding_sub_title_header',
			[
				'label' => esc_html__( 'Padding sub title', 'bw-petito' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .sub-title-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'margin_sub_title_header',
			[
				'label' => esc_html__( 'Margin sub title', 'bw-petito' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .sub-title-header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();


		
	}
}?>