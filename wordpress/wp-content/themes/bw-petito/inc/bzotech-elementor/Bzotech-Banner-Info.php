<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Bzotech_Banner_Info extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'bzotech-banner-info';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Banner info', 'bw-petito' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'aqb-htelement-category' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'hello-world' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings();
		

		$attr = array(
			'wdata'		=> $this,
			'settings'	=> $settings,
		);
		echo bzotech_get_template_widget('banner-info/banner-info',$settings['banner_style'],$attr);
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function content_template() {
		
	}
	protected function register_controls() {

		$this->start_controls_section(

			'section_image',
			[
				'label' => esc_html__( 'Image', 'bw-petito' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				
			]
		);
		$this->add_control(
			'banner_style',
			[
				'label' => esc_html__( 'Banner Style', 'bw-petito' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'elbzotech-bndf',
				'options' => [
					'elbzotech-bndf'  => esc_html__( 'style 1 (Default)', 'bw-petito' ),
					'style2'  => esc_html__( 'style 2 (Default)', 'bw-petito' ),
					'style3'  => esc_html__( 'style 3 (Default)', 'bw-petito' ),
					
				],
			]
		);
		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'bw-petito' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default' => 'full',
				'separator' => 'none',
			]
		);
		$this->add_control(
			'link',
			[
				'label' => esc_html__( 'Link image', 'bw-petito' ),
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


		/*info style default*/
		$this->start_controls_section(
			'section_info_default',
			[
				'label' => esc_html__( 'Text info', 'bw-petito' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'banner_style' => ['elbzotech-bndf','style2','style3'],
				]
			]
		);
		
		
		$repeater_text = new Repeater();
		$repeater_text->add_control(
			'text', 
			[
				'label' => esc_html__( 'Text', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Enter text' , 'bw-petito' ),
				'label_block' => true,
			]
		);
		$repeater_text->add_control(
			'image',
			[
				'label' => esc_html__( 'Image', 'bw-petito' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$repeater_text->start_controls_tabs( 'item_text_effects' );
		$repeater_text->start_controls_tab( 'normal_item_text',
			[
				'label' => esc_html__( 'Normal', 'bw-petito' ),
			]
		);
		$repeater_text->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}};',
					'{{WRAPPER}} {{CURRENT_ITEM}} sup' => 'color: {{VALUE}};',
				],
			]
		);
		$repeater_text->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'bg_title',
				'label' => esc_html__( 'Background', 'bw-petito' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
			]
		);
		$repeater_text->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
			]
		);
		$repeater_text->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
			]
		);
		$repeater_text->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_text',
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
				'separator' => 'before',
			]
		);

		$repeater_text->add_responsive_control(
			'border_radius_text',
			[
				'label' => esc_html__( 'Border Radius', 'bw-petito' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$repeater_text->add_control(
			'transform-rotate', 
			[
				'label' => esc_html__( 'Transform rotate', 'bw-petito' ),
				'type' => Controls_Manager::NUMBER,
				'min' => -180,
				'max' => 180,
				'step' => 1,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'transform: rotate({{SIZE}}deg);',
				],
			]
		);
		$repeater_text->end_controls_tab();
		$repeater_text->start_controls_tab( 'hover_item_text',
			[
				'label' => esc_html__( 'Hover', 'bw-petito' ),
			]
		);
		$repeater_text->add_control(
			'title_color_hover',
			[
				'label' => __( 'Text Color hover', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$repeater_text->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => __( 'Typography hover', 'bw-petito' ),
				'name' => 'text_typography_hover',
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}:hover',
			]
		);
		$repeater_text->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow_hover',
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}:hover',
			]
		);
		$repeater_text->add_control(
			'transform-rotate-hover', 
			[
				'label' => esc_html__( 'Transform rotate hover', 'bw-petito' ),
				'type' => Controls_Manager::NUMBER,
				'min' => -180,
				'max' => 180,
				'step' => 1,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'transform: rotate({{SIZE}}deg);',
				],
			]
		);
		$repeater_text->end_controls_tab();
		$repeater_text->end_controls_tabs();
		
		$repeater_text->add_control(
			'align_info_item',
			[
				'label' => esc_html__( 'Alignment Info', 'bw-petito' ),
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
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'text-align: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);
		
		$repeater_text->add_control(
			'text_tag',
			[
				'label' => esc_html__( 'Tag wrap text', 'bw-petito' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => [
					'h2' 		=> esc_html__( 'H2', 'bw-petito' ),
					'h3' 		=> esc_html__( 'H3', 'bw-petito' ),
					'h4' 		=> esc_html__( 'H4', 'bw-petito' ),
					'h5' 		=> esc_html__( 'H5', 'bw-petito' ),
					'h6' 		=> esc_html__( 'H6', 'bw-petito' ),
					'p' 		=> esc_html__( 'p', 'bw-petito' ),
					'span' 		=> esc_html__( 'Span', 'bw-petito' ),
					'strong' 	=> esc_html__( 'Strong', 'bw-petito' ),
					'div' 		=> esc_html__( 'Div', 'bw-petito' ),
					'label' 	=> esc_html__( 'Label', 'bw-petito' ),
					'a' 	=> esc_html__( 'a', 'bw-petito' ),
				],
			]
		);
		$repeater_text->add_control(
			'link_text_tag',
			[
				'label' => esc_html__( 'Link (url)', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'default' => '#',
				'condition' => [
					'text_tag' => ['a'],
				],
				
			]
		);
		$repeater_text->add_responsive_control(
			'text_padding',
			[
				'label' => __( 'Padding', 'bw-petito' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}'=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$repeater_text->add_responsive_control(
			'text_margin',
			[
				'label' => __( 'Margin', 'bw-petito' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$repeater_text->add_control(
			'add_class_css', 
			[
				'label' => esc_html__( 'Add class CSS', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter name class' , 'bw-petito' ),
			]
		);
		
		$this->add_control(
			'list_text',
			[
				'label' => esc_html__( 'Add text', 'bw-petito' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty'=>false,
				'fields' => $repeater_text->get_controls(),
				'title_field' => '{{{ text }}}',
			]
		);


		$repeater_bt = new Repeater();
		$repeater_bt->add_control(
			'text', [
				'label' => esc_html__( 'Label button', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Enter text' , 'bw-petito' ),
				'label_block' => true,
			]
		);
		$repeater_bt->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'bw-petito' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'bw-petito' ),
				'show_external' => true,
				'default' => [
					'url' => '#',
					'is_external' => false,
					'nofollow' => true,
				],
			]
		);
		$repeater_bt->add_control(
			'button_icon',
			[
				'label' => esc_html__( 'Icon', 'bw-petito' ),
				'type' => Controls_Manager::ICONS,
			]
		);

		$repeater_bt->add_control(
			'button_icon_pos',
			[
				'label' => esc_html__( 'Icon position', 'bw-petito' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'after-text',
				'options' => [
					'after-text'   => esc_html__( 'After text', 'bw-petito' ),
					'before-text'  => esc_html__( 'Before text', 'bw-petito' ),
				],
				'condition' => [
					'button_icon[value]!' => '',
				]
			]
		);
		$repeater_bt->add_control(
			'style',
			[
				'label' => esc_html__( 'Style', 'bw-petito' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default'		=> esc_html__( 'Style 1 (Default)', 'bw-petito' ),
					'default2'		=> esc_html__( 'Style 2', 'bw-petito' ),
					'style3'		=> esc_html__( 'Style 3', 'bw-petito' ),
					'custom'		=> esc_html__( 'Custom', 'bw-petito' ),
				],
			]
		);
		$repeater_bt->add_control(
			'add_class_css', 
			[
				'label' => esc_html__( 'Add class CSS', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter name class' , 'bw-petito' ),
			]
		);
		$key = 'custom_botton';
		$class = 'item-custom-botton-e';

		$repeater_bt->start_controls_tabs( 
			$key.'_tabs_style',
			[
				'separator' => 'before',
				'condition' => [
					'style' => 'custom',
				]
			]
		);
		$repeater_bt->start_controls_tab(
			$key.'_tab_normal_css',
			[
				'label' => esc_html__( 'Normal Style', 'bw-petito' ),
			]
		);
		$repeater_bt->add_control(
			$key.'_color_css',
			[
				'label' => esc_html__( 'Color', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .sub-color-e' => 'color: {{VALUE}}',
				],
			]
		);
		$repeater_bt->add_control(
			$key.'bg_color_css',
			[
				'label' => esc_html__( 'Background Color', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}};',
				],
			]
		);
		$repeater_bt->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => $key.'_typography_css',
				'label' => esc_html__( 'Text Typography', 'bw-petito' ),
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
			]
		);
		$repeater_bt->add_responsive_control(
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
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'opacity: {{SIZE}};',
				],
			]
		);
		$repeater_bt->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => $key.'_shadow_css',
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
			]
		);
		$repeater_bt->add_responsive_control(
			$key.'_padding_css',
			[
				'label' => esc_html__( 'Padding', 'bw-petito' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', ],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
        );

        $repeater_bt->add_responsive_control(
			$key.'_margin_css',
			[
				'label' => esc_html__( 'Margin', 'bw-petito' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', ],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );
		$repeater_bt->end_controls_tab(); /*End Normal Style*/

		$repeater_bt->start_controls_tab(
			$key.'_tab_hover_css',
			[
				'label' => __( 'Style On Hover', 'bw-petito' ),
			]
		);
		$repeater_bt->add_control(
			$key.'_color_hover_css',
			[
				'label' => __( 'Color On Hover', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}}:hover .sub-color-e' => 'color: {{VALUE}}',
				],
			]
		);
		
		$repeater_bt->add_control(
			$key.'_bg_color_hover_css',
			[
				'label' => __( 'Background Color On Hover', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}:hover, {{WRAPPER}} {{CURRENT_ITEM}}:focus' => 'background-color: {{VALUE}};',
				],
			]
		);
		$repeater_bt->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => $key.'_typography_hover_css',
				'label' => __( 'Typography On Hover', 'bw-petito' ),
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}:hover',
			]
		);
		$repeater_bt->add_responsive_control(
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
					'{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'opacity: {{SIZE}};',
				],
			]
		);
		$repeater_bt->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => $key.'_shadow_hover_css',
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}:hover',
			]
		);
		$repeater_bt->add_control(
			$key.'_hover_transition_css',
			[
				'label' => __( 'Transition Duration On Hover', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 5,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}}  {{CURRENT_ITEM}}' => 'transition-duration: {{SIZE}}s',
				],
			]
		);
		$repeater_bt->add_control(
			$key.'_animation_hover_css',
			[
				'label' => __( 'Animation On Hover', 'bw-petito' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);
		$repeater_bt->end_controls_tab();/*End Hover Style*/
		$repeater_bt->end_controls_tabs();

		/*-----------------------------*/
		$this->add_control(
			'separator_list_button',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);
		$this->add_control(
			'list_button',
			[
				'label' => esc_html__( 'Add button', 'bw-petito' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty'=>false,
				'fields' => $repeater_bt->get_controls(),
				'title_field' => '{{{ text }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_image',
			[
				'label' => esc_html__( 'Image', 'bw-petito' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'image2',
			[
				'label' => esc_html__( 'Choose Image 2 of Effect', 'bw-petito' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'image_effect_banner' => ['zoom-out','zoom-out overlay-image'],
				]
			]
		);
		

		$this->add_control(
			'box_overflow',
			[
				'label' => esc_html__( 'Overflow', 'bw-petito' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'elbzotech-hidden',
				'options' => [
					'elbzotech-hidden' 		=> esc_html__( 'Hidden', 'bw-petito' ),
					'elbzotech-inherit' 		=> esc_html__( 'Inherit', 'bw-petito' ),
				],
			]
		);
		$this->add_responsive_control(
			'align_image',
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
					'right ' => [
						'title' => esc_html__( 'Right', 'bw-petito' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elbzotech-banner-info-thumb.elbzotech-inherit' => 'text-align: {{VALUE}};',
				],
				'condition' => [
					'box_overflow' => ['elbzotech-inherit'],
				]
			]
		);
		$this->add_control(
			'separator_image_style',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->start_controls_tabs( 'image_effects' );

		$this->start_controls_tab( 'normal',
			[
				'label' => esc_html__( 'Normal', 'bw-petito' ),
			]
		);

		$this->add_control(
			'opacity',
			[
				'label' => esc_html__( 'Opacity', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elbzotech-banner-info-thumb img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters',
				'selector' => '{{WRAPPER}} .elbzotech-banner-info-thumb img',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'hover',
			[
				'label' => esc_html__( 'Hover', 'bw-petito' ),
			]
		);

		$this->add_control(
			'opacity_hover',
			[
				'label' => esc_html__( 'Opacity', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elbzotech-banner-info-thumb img:hover' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters_hover',
				'selector' => '{{WRAPPER}} .elbzotech-banner-info-wrap:hover img',
			]
		);

		$this->add_control(
			'background_hover_transition',
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
					'{{WRAPPER}} .elbzotech-banner-info-thumb img' => 'transition-duration: {{SIZE}}s',
				],
			]
		);

		$this->add_control(
			'image_hover_animation',
			[
				'label' => esc_html__( 'Hover Animation', 'bw-petito' ),
				'type' => Controls_Manager::HOVER_ANIMATION,

				'condition' => [
					'image_effect_banner' => '',
				],
			]
		);
		$this->add_control(
			'image_effect_banner',
			[
				'label' => esc_html__( 'Effect Image', 'bw-petito' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'label_block'=>true,
				'condition' => [
					'image_hover_animation' => '',
				],
				'options' => [
					''  => esc_html__( 'None', 'bw-petito' ),
					'zoom-image'  => esc_html__( 'Zoom', 'bw-petito' ),
					'overlay-image zoom-image'  => esc_html__( 'Zoom Overlay', 'bw-petito' ),
					'zoom-out'  => esc_html__( 'Zoom out', 'bw-petito' ),
					'zoom-out overlay-image'  => esc_html__( 'Zoom out Overlay', 'bw-petito' ),
					'fade-out-in'  => esc_html__( 'Fade out-in', 'bw-petito' ),
					'zoom-image fade-out-in'  => esc_html__( 'Zoom Fade out-in', 'bw-petito' ),
					'fade-in-out'  => esc_html__( 'Fade in-out', 'bw-petito' ),
					'zoom-rotate'  => esc_html__( 'Zoom rotate', 'bw-petito' ),
					'zoom-rotate fade-out-in'  => esc_html__( 'Zoom rotate Fade out-in', 'bw-petito' ),
					'overlay-image'  => esc_html__( 'Overlay', 'bw-petito' ),
					'zoom-image line-scale'  => esc_html__( 'Zoom image line', 'bw-petito' ),
					'gray-image'  => esc_html__( 'Gray image', 'bw-petito' ),
					'gray-image line-scale'  => esc_html__( 'Gray image line', 'bw-petito' ),
					'pull-curtain'  => esc_html__( 'Pull curtain', 'bw-petito' ),
					'pull-curtain gray-image'  => esc_html__( 'Pull curtain gray image', 'bw-petito' ),
					'pull-curtain zoom-image'  => esc_html__( 'Pull curtain zoom image', 'bw-petito' ),
					'folding-the-edge'  => esc_html__( 'Folding the edge', 'bw-petito' )
				],
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '{{WRAPPER}} .elbzotech-banner-info-thumb',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'bw-petito' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elbzotech-banner-info-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_box_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .elbzotech-banner-info-thumb',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_info',
			[
				'label' => esc_html__( 'Text Info', 'bw-petito' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'banner_style' => ['elbzotech-bndf','style2','style3'],
				]
			]
		);
		$this->add_responsive_control(
			'width_max_info',
			[
				'label' => esc_html__( 'Max Width', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%','px','vw' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .info-banner2,{{WRAPPER}} .position-info-custom' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'style_info',
			[
				'label' => esc_html__( 'Style Info', 'bw-petito' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'elbzotech-info-inner',
				'options' => [
					'elbzotech-info-inner' 		=> esc_html__( 'Inner', 'bw-petito' ),
					'elbzotech-info-outer' 		=> esc_html__( 'Outter', 'bw-petito' ),
				],
			]
		);
		$this->add_responsive_control(
			'align',
			[
				'label' => esc_html__( 'Alignment', 'bw-petito' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'text-left' => [
						'title' => esc_html__( 'Left', 'bw-petito' ),
						'icon' => 'eicon-text-align-left',
					],
					'text-center' => [
						'title' => esc_html__( 'Center', 'bw-petito' ),
						'icon' => 'eicon-text-align-center',
					],
					'text-right' => [
						'title' => esc_html__( 'Right', 'bw-petito' ),
						'icon' => 'eicon-text-align-right',
					],
				],
			]
		);
		$this->add_responsive_control(
			'justify_content',
			[
				'label' => esc_html__( 'Justify Content', 'bw-petito' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' 		=> esc_html__( 'none', 'bw-petito' ),
					'justify_content-center' 		=> esc_html__( 'center', 'bw-petito' ),
					'justify_content-flex-start' 		=> esc_html__( 'flex start', 'bw-petito' ),
					'justify_content-flex-end' 		=> esc_html__( 'flex end', 'bw-petito' ),
				],
				'condition' => [
					'style_info' => ['elbzotech-info-inner'],
				]
			]
		);
		$this->add_responsive_control(
			'position_info',
			[
				'label' => esc_html__( 'Position Info', 'bw-petito' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'top',
				'separator' => 'before',
				'options' => [
					'top' 		=> esc_html__( 'Top', 'bw-petito' ),
					'mid' 		=> esc_html__( 'Mid', 'bw-petito' ),
					'bottom' 		=> esc_html__( 'Bottom', 'bw-petito' ),
					'custom' 		=> esc_html__( 'Custom', 'bw-petito' ),
				],
				'condition' => [
					'style_info' => ['elbzotech-info-inner'],
				]
			]
		);
		

		$this->add_responsive_control(
			'position_info_top',
			[

				'label' => esc_html__( 'Top', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => esc_html__( 'Enter parameter for the top position (Ex: 0px | 10px | 10% | auto)', 'bw-petito' ),
				'condition' => [
					'position_info' => ['custom'],
				],
				'selectors' => [
					'{{WRAPPER}} .elbzotech-info-inner' => 'top: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'position_info_bottom',
			[
				'label' => esc_html__( 'Bottom', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => esc_html__( 'Enter parameter for the bottom position (Ex: 0px | 10px | 10% | auto)', 'bw-petito' ),
				'condition' => [
					'position_info' => ['custom'],
				],
				'selectors' => [
					'{{WRAPPER}} .elbzotech-info-inner' => 'bottom: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'position_info_left',
			[
				'label' => esc_html__( 'Left', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => esc_html__( 'Enter parameter for the left position (Ex: 0px | 10px | 10% | auto)', 'bw-petito' ),
				'condition' => [
					'position_info' => ['custom'],
				],
				'selectors' => [
					'{{WRAPPER}} .elbzotech-info-inner' => 'left: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'position_info_right',
			[
				'label' => esc_html__( 'Right', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => esc_html__( 'Enter parameter for the Right position (Ex: 0px | 10px | 10% | auto)', 'bw-petito' ),
				'condition' => [
					'position_info' => ['custom'],
				],
				'selectors' => [
					'{{WRAPPER}} .elbzotech-info-inner' => 'right: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'separator' => 'before',
				'name' => 'background',
				'label' => esc_html__( 'Background', 'bw-petito' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .elbzotech-info-inner',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'info_shadow',
				'label' => esc_html__( 'Box Shadow', 'bw-petito' ),
				'selector' => '{{WRAPPER}} .elbzotech-info-inner',
			]
		);
		$this->add_responsive_control(
			'padding_info',
			[
				'label' => esc_html__( 'Padding', 'bw-petito' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .elbzotech-banner-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'margin_info',
			[
				'label' => esc_html__( 'Margin', 'bw-petito' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .elbzotech-banner-info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'section_style_title',
			[
				'label' => esc_html__( 'Style title', 'bw-petito' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'banner_style' => ['style2'],
				]
			]
		);
		$this->get_style_type_text('title','item-title-e');
		$this->end_controls_section();
		
	}
	public function get_style_type_text($key='text',$class="item-text-e") {
		$this->start_controls_tabs( $key.'_tabs_style' );
		$this->start_controls_tab(
			$key.'_tab_normal_css',
			[
				'label' => __( 'Normal Style', 'bw-petito' ),
			]
		);
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
				'label' => __( 'Background Color', 'bw-petito' ),
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
				'label' => __( 'Text Typography', 'bw-petito' ),
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
		$this->end_controls_tab(); /*End Normal Style*/

		$this->start_controls_tab(
			$key.'_tab_hover_css',
			[
				'label' => __( 'Style On Hover', 'bw-petito' ),
			]
		);
		$this->add_control(
			$key.'_color_hover_css',
			[
				'label' => __( 'Color On Hover', 'bw-petito' ),
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
				'label' => __( 'Background Color On Hover', 'bw-petito' ),
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
				'label' => __( 'Typography On Hover', 'bw-petito' ),
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
				'label' => __( 'Shadow On Hover', 'bw-petito' ),
				'selector' => '{{WRAPPER}} .'.$class.':hover',
			]
		);
		$this->add_control(
			$key.'_hover_transition_css',
			[
				'label' => __( 'Transition Duration On Hover', 'bw-petito' ),
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
				'label' => __( 'Animation On Hover', 'bw-petito' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);
		$this->end_controls_tab();/*End Hover Style*/
		$this->end_controls_tabs();
	}
	
}