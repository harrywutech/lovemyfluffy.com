<?php
namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Bzotech_Pricing_Table extends Widget_Base {
	public function get_name() {
		return 'bzotech_pricing_table';
	}
	public function get_title() {
		return esc_html__( 'Pricing Table', 'bw-petito' );
	}
	public function get_icon() {
		return 'eicon-table-of-contents';
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
		echo bzotech_get_template_widget('pricing-table/pricing-table',$settings['style'],$attr);
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
				'label' 	=> esc_html__( 'Style', 'bw-petito' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''		=> esc_html__( 'Style 1', 'bw-petito' ),
				],
			]
		);
		/*$this->add_control(
			'active_style_picing',
			[
				'label' => esc_html__( 'Active style', 'bw-petito' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'bw-petito' ),
				'label_off' => esc_html__( 'Off', 'bw-petito' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$this->add_control(
			'label', [
				'label' => esc_html__( 'Label', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter text', 'bw-petito' ),
				'label_block' => true,
				'condition' => [
					'style' =>  '',
				]
			]
		);
		*/
		$this->add_control(
			'title', [
				'label' => esc_html__( 'Title', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter text', 'bw-petito' ),
				'label_block' => true,
			]
		);
		/*$this->add_control(
			'desc', [
				'label' => esc_html__( 'Description', 'bw-petito' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => '<p>' . esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'bw-petito' ) . '</p>',
				
			]
		);*/
		$this->add_control(
			'price', [
				'label' => esc_html__( 'Price', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter text', 'bw-petito' ),
				'label_block' => true,
			]
		);
		
		
		$repeater = new Repeater();
		$repeater->add_control(
			'title', [
				'label' => esc_html__( 'Title', 'bw-petito' ),
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
				'condition' => [
					'icon_image[url]' =>  '',
				]
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
					'icon_image[url]!' =>  '',
				]
			]
		);
		
		$repeater->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'bw-petito' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'https://your-link.com', 'bw-petito' ),
				'show_label' => false,
			]
		);
		$repeater->add_control(
			'active_style',
			[
				'label' => esc_html__( 'Active style', 'bw-petito' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'bw-petito' ),
				'label_off' => esc_html__( 'Off', 'bw-petito' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'list_pricing_table',
			[
				'label' => esc_html__( 'Add list', 'bw-petito' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty'=>false,
				'fields' => $repeater->get_controls(),
				
			]
		);
		$this->add_control(
			'button_text', 
			[
				'label' => esc_html__( 'Text button', 'bw-petito' ),
				'description' => esc_html__( 'Enter text of button', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Read more', 'bw-petito' ),
				'placeholder' => esc_html__( 'Read more', 'bw-petito' ),
			]
		);
		$this->add_control(
			'button_link',
			[
				'label' => esc_html__( 'Link', 'bw-petito' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'bw-petito' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow' => true,
				],
			]
		);
		
		
		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Style', 'bw-petito' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'main_color',
			[
				'label' => esc_html__( 'Main Color', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors'=>[
					'{{WRAPPER}} .title-pricing-table' => 'background: {{VALUE}};',
					'{{WRAPPER}} .button-pricing' => 'background: {{VALUE}};',
				]
			]
		);
		
		$this->end_controls_section();
		$this->start_controls_section(
			'section_style_title',
			[
				'label' => esc_html__( 'Title style', 'bw-petito' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'title_width',
			[
				'label' => esc_html__( 'Title Width', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%','px','vw' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .title-pricing-table' => 'width: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->get_style_type_text('title','title-pricing-table');
		
		$this->end_controls_section(); /*End title style*/
		$this->start_controls_section(
			'section_style_price',
			[
				'label' => esc_html__( 'Price style', 'bw-petito' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->get_style_type_text('pricing','price-pricing-table');
		$this->add_control(
			'price_alignment',
			[
				'label' => esc_html__( 'Alignment', 'bw-petito' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
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
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .price-pricing-table' => 'text-align: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section(); /*End pricing style*/
		$this->start_controls_section(
			'section_style_des',
			[
				'label' => esc_html__( 'Description style', 'bw-petito' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->get_style_type_text('des','list-pricing-table .item-link');
		$this->add_control(
			'inactive_color',
			[
				'label' => __( 'Inactive Color', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .list-pricing-table .item-link.active-style__' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section(); /*End description style*/
		$this->start_controls_section(
			'section_style_button',
			[
				'label' => esc_html__( 'Button style', 'bw-petito' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->get_style_type_text('button','button-pricing');
		$this->add_control(
			'hover_bt_color',
			[
				'label' => __( 'Hover Background Color', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .button-pricing-wapper .button-pricing:hover' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'hover_title_bt_color',
			[
				'label' => __( 'Hover Button Title Color', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .button-pricing-wapper .button-pricing:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'button_alignment',
			[
				'label' => esc_html__( 'Alignment', 'bw-petito' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
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
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .button-pricing-wapper' => 'text-align: {{VALUE}}',
				],
			]
		);
		
		$this->end_controls_section(); /*End Button style*/
	}
	public function get_style_type_text($key='text',$class="title-pricing-table") {
		$this->add_control(
			$key.'_color_css',
			[
				'label' => __( 'Color', 'bw-petito' ),
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
				'label' => __( 'Title Background Color', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} div .'.$class => 'background-color: {{VALUE}};',
					'{{WRAPPER}} div .'.$class.':before' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => $key.'_typography_css',
				'label' => __( 'Text Typography', 'bw-petito' ),
				'selector' => '{{WRAPPER}} .'.$class.',{{WRAPPER}} .'.$class.' .sub-color-e',
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
				'label' => __( 'Text Shadow', 'bw-petito' ),
				'selector' => '{{WRAPPER}} .'.$class,
			]
		);
		$this->add_responsive_control(
			$key.'_padding_css',
			[
				'label' => esc_html__( 'Padding', 'bw-petito' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', ],
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
                'size_units' => [ 'px', ],
				'selectors' => [
					'{{WRAPPER}} .'.$class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );
		$this->add_responsive_control(
			$key.'_border_radius_css',
			[
				'label' => esc_html__( 'Border radius', 'bw-petito' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', ],
				'selectors' => [
					'{{WRAPPER}} .'.$class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

		$this->end_controls_tab(); /*End Normal Style*/
	}
}?>