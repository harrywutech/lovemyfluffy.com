<?php
namespace Elementor;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
class Bzotech_Heading extends Widget_Base {
	public function get_name() {
		return 'bzotech-heading';
	}
	public function get_title() {
		return esc_html__( 'Headding and Text Editor', 'bw-petito' );
	}
	public function get_icon() {
		return 'eicon-t-letter';
	}
	public function get_categories() {
		return [ 'aqb-htelement-category' ];
	}
	public function get_keywords() {
		return [ 'heading', 'title', 'text','text editor' ];
	}
	public function get_script_depends() {
		return [ 'hello-world' ];
	}
	protected function render() {
		$settings = $this->get_settings_for_display();
		$title_id ='';
		if($settings['title_auto'] =='yes' && empty($settings['title'])){
			$id = get_the_ID();
			if(is_front_page() && is_home()) $id = (int)get_option( 'page_on_front' );
		    if(!is_front_page() && is_home()) $id = (int)get_option( 'page_for_posts' );
		    if($id) $title_id  = get_the_title($id);
		    else $title_id = esc_html__("Our Blog",'bw-petito');
		    if(is_archive()) $title_id = get_the_archive_title();
		    if(is_search()) $title_id =  sprintf( esc_html__( 'Search results for: %s', 'bw-petito' ), '<span class="title-search-query">' . get_search_query() . '</span>' );
		    if(bzotech_is_woocommerce_page()) $title_id = woocommerce_page_title(false);
		   
		}

		$attr = array(
			'wdata'		=> $this,
			'settings'	=> $settings,
			'title_id'	=> $title_id,
		);
		
		echo bzotech_get_template_widget('heading-editor/heading-editor',$settings['header_style'],$attr);
	}
	
	protected function content_template() {
		
	}
	protected function register_controls() {
		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Title', 'bw-petito' ),
			]
		);

		$this->add_control(
			'header_style',
			[
				'label' 	=> esc_html__( 'Style', 'bw-petito' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''		=> esc_html__( 'Text Editor', 'bw-petito' ),
					'style1'		=> esc_html__( 'Heading style 1', 'bw-petito' ),
					'style2'		=> esc_html__( 'Heading style 2', 'bw-petito' ),
					'style33'		=> esc_html__( 'Heading style 3', 'bw-petito' ),
					'style44'		=> esc_html__( 'Heading style 4', 'bw-petito' ),
					'style55'		=> esc_html__( 'Heading style 5', 'bw-petito' ),
					'style6'		=> esc_html__( 'Heading style 6', 'bw-petito' ),
					'style7'		=> esc_html__( 'Heading style 7', 'bw-petito' )
					
				],
			]
		);
		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'bw-petito' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter your title', 'bw-petito' ),
				'default' => esc_html__( 'Add Your Heading Text Here', 'bw-petito' ),
				'condition' => [
					'header_style!' => '',
				]
			]
		);
		
		$this->add_control(
			'editor',
			[
				'label' => esc_html__( 'Text', 'bw-petito' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => '<p>' . esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'bw-petito' ) . '</p>',
				'condition' => [
					'header_style' => '',
				]
			]
		);
		$this->add_control(
			'title_auto',
			[
				'label' => esc_html__( 'Auto title by page', 'bw-petito' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'bw-petito' ),
				'label_off' => esc_html__( 'Off', 'bw-petito' ),
				'return_value' => 'yes',
				'default' => '',
				'condition' => [
					'header_style!' => '',
				]
			]
		);
		$this->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'bw-petito' ),
				'type' => Controls_Manager::URL,
				'default' => [
					'url' => '',
				],
				'separator' => 'before',
				'condition' => [
					'header_style!' => '',
				]
			]
		);


		$this->add_control(
			'header_size',
			[
				'label' => esc_html__( 'HTML Tag', 'bw-petito' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h2',
				'condition' => [
					'header_style!' => '',
				]
			]
		);

		$this->add_responsive_control(
			'align',
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
					'justify' => [
						'title' => esc_html__( 'Justified', 'bw-petito' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'view',
			[
				'label' => esc_html__( 'View', 'bw-petito' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__( 'Title', 'bw-petito' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs( 'tabs_style_title' );
		$this->start_controls_tab(
			'title_normal_style',
			[
				'label' => __( 'Normal', 'bw-petito' ),
			]
		);
		$this->add_responsive_control(
			'max-width-text',
			[
				'label' => esc_html__( 'Max Width', 'bw-petito' ) . ' (px)',
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
				],
				'tablet_default' => [
					'unit' => 'px',
				],
				'mobile_default' => [
					'unit' => 'px',
				],
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 50000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .text-css-e' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Text Color', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .text-css-e' => 'color: {{VALUE}};',
					'{{WRAPPER}} .text-css-e a' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'title_bg_color',
				'label' => esc_html__( 'Text Background', 'bw-petito' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .text-css-e',
				
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'selector' => '{{WRAPPER}} .text-css-e',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}} .text-css-e',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'css_border_elementor',
				'selector' => '{{WRAPPER}} .text-css-e',
			]
		);
		$this->add_control(
			'blend_mode',
			[
				'label' => esc_html__( 'Blend Mode', 'bw-petito' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' 				=> esc_html__('Normal', 'bw-petito'),
					'multiply'		=> esc_html__('Multiply', 'bw-petito'),
					'screen' 		=> esc_html__('Screen', 'bw-petito'),
					'overlay' 		=> esc_html__('Overlay', 'bw-petito'),
					'darken' 		=> esc_html__('Darken', 'bw-petito'),
					'lighten' 		=> esc_html__('Lighten', 'bw-petito'),
					'color-dodge'	=> esc_html__('Color Dodge', 'bw-petito'),
					'saturation' 	=> esc_html__('Saturation', 'bw-petito'),
					'color' 		=> esc_html__('Color', 'bw-petito'),
					'difference' 	=> esc_html__('Difference', 'bw-petito'),
					'exclusion' 	=> esc_html__('Exclusion', 'bw-petito'),
					'hue' 			=> esc_html__('Hue', 'bw-petito'),
					'luminosity' 	=> esc_html__('Luminosity', 'bw-petito'),
				],
				'selectors' => [
					'{{WRAPPER}} .text-css-e' => 'mix-blend-mode: {{VALUE}}',
				],
				'separator' => 'none',
			]
		);
		$this->add_control(
			'display_css',
			[
				'label' => esc_html__( 'Display', 'bw-petito' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__( 'Normal', 'bw-petito' ),
					'inline' => esc_html__('Inline','bw-petito' ),
					'block' => esc_html__('Block','bw-petito' ),
					'contents' => esc_html__('Contents','bw-petito' ),
					'inline-block' => esc_html__('Inline block	','bw-petito' ),
					'flex' => esc_html__('Flex','bw-petito' ),
					'grid' => esc_html__('Grid','bw-petito' ),
					'inherit' => esc_html__('Inherit','bw-petito' ),
					'initial' => esc_html__('Initial','bw-petito' ),
					'list-item' => esc_html__('List item','bw-petito' ),
					'inline-table' => esc_html__('Inline table','bw-petito' ),
					'inline-grid' => esc_html__('Inline grid','bw-petito' ),
					'inline-flex' => esc_html__('Inline flex','bw-petito' ),
					'table' => esc_html__('Table','bw-petito' ),
					'table-caption' => esc_html__('Table caption','bw-petito' ),
					'table-column-group' => esc_html__('Table column group','bw-petito' ),
					'table-header-group' => esc_html__('Table header group','bw-petito' ),
					'table-footer-group' => esc_html__('Table footer group','bw-petito' ),
					'table-row-group' => esc_html__('Table row group','bw-petito' ),
					'table-cell' => esc_html__('Table cell','bw-petito' ),
					'table-column' => esc_html__('Table column','bw-petito' ),
					'table-row' => esc_html__('Table row','bw-petito' ),
					'run-in' => esc_html__('Run in','bw-petito' ),
				],
				'selectors' => [
					'{{WRAPPER}} .text-css-e' => 'display: {{VALUE}}',
				],
				'separator' => '',
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__( 'Padding', 'bw-petito' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .text-css-e' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
			'title_color_hover',
			[
				'label' => esc_html__( 'Text Color Hover', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .text-css-e:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .text-css-e a:hover' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'title_bg_color_hover',
				'label' => esc_html__( 'Text Background Hover', 'bw-petito' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .text-css-e:hover',
				
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_hover',
				'label' => esc_html__( 'Typography Hover', 'bw-petito' ),
				'selector' => '{{WRAPPER}} .text-css-e:hover',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		
	}
}
