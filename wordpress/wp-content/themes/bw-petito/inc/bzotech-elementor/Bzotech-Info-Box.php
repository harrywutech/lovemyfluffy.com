<?php
namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Bzotech_Info_Box extends Widget_Base {
	public function get_name() {
		return 'bzotech_info_box';
	}
	public function get_title() {
		return esc_html__( 'Info Box', 'bw-petito' );
	}
	public function get_icon() {
		return 'eicon-info-box';
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
		echo bzotech_get_template_widget('info-box/info-box',$settings['style'],$attr);
	}
	
	protected function content_template() {
		
	}
	
	protected function register_controls() {

		/*------------CONTENT--------- */
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
				'description'	=> esc_html__( 'You can change the display style here', 'bw-petito' ),
				'type'      => Controls_Manager::SELECT,				
				'default'   => '',
				'label_block' => true,
				'options'   => [
					''		=> esc_html__( 'Style 1 (Quote)', 'bw-petito' ),
					'style2'		=> esc_html__( 'Style 2 (Sevice)', 'bw-petito' ),
					'style3'		=> esc_html__( 'Style 3 (Countdown)', 'bw-petito' ),
					'style4'		=> esc_html__( 'Style 4 (Testimonial)', 'bw-petito' ),
					'style5'		=> esc_html__( 'Style 5 (Category)', 'bw-petito' ),
					'style6'		=> esc_html__( 'Style 6 (Branding)', 'bw-petito' ),	
					'style7'		=> esc_html__( 'Style 7 (Service)', 'bw-petito' )	,			
					'style8'		=> esc_html__( 'Style 8 (Countdown 2)', 'bw-petito' ),
					'style9'		=> esc_html__( 'Style 9 (Testimonial 2)', 'bw-petito' ),
					'style10'		=> esc_html__( 'Style 10 (Category 2)', 'bw-petito' ),
					'style11'		=> esc_html__( 'Style 11 (List items - home 4)', 'bw-petito' ),
					'style12'		=> esc_html__( 'Style 12 (Sevices -  home 5)', 'bw-petito' ),
					'style13'		=> esc_html__( 'Style 13 (Category 3 - home 5)', 'bw-petito' ),
					'style14'		=> esc_html__( 'Style 14 (Sevice with read more - home 6)', 'bw-petito' ),
				
				],
			]
		);
		$this->get_list_item_info('list_info_style11',array('style'=>'style11'),array('title'=>true,'desc'=>true,'image'=>true,'image_hover'=>true));
		$this->add_control(
			'title', [
				'label' => esc_html__( 'Title', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter text', 'bw-petito' ),
				'label_block' => true,
				'separator' => 'before',
				'default' => esc_html__( 'Add Your Title Text Here', 'bw-petito' ),
				'condition' => [
				'style' => ['','style2','style3','style4','style7','style8','style12','style14'],
				]
			]
		);
		$this->add_control(
			'sub_title', [
				'label' => esc_html__( 'Sub Title', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter text', 'bw-petito' ),
				'label_block' => true,
				'separator' => 'before',
				'default' => '',
				'condition' => [
				'style' => ['style2','style7','style12','style14'],
				]
			]
		);
		$this->add_control(
			'display_style', [
				'label' 	=> esc_html__( 'Display style', 'bw-petito' ),
				'description'	=> esc_html__( 'Set style', 'bw-petito' ),
				'type'      => Controls_Manager::SELECT,				
				'default'   => 'flex',
				'label_block' => true,
				'options'   => [
					'block'		=> esc_html__( 'Block', 'bw-petito' ),
					'flex'		=> esc_html__( 'Inline', 'bw-petito' ),
				],
				'selectors' => [
					'{{WRAPPER}} .item-info-box' => 'display: {{VALUE}};',
				],
				'condition' => [
					'style' =>  ['style14'],
				]
			]
		);

		$this->add_control(
			'read_more_title', [
				'label' => esc_html__( 'Read more text', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter text', 'bw-petito' ),
				'label_block' => true,
				'condition' => [
					'style' => ['style14'],
				]
			]
		);
		$this->add_control(
			'icon_after_readmore',
			[
				'label' => esc_html__( 'Icon after read more button', 'bw-petito' ),
				'description'	=> esc_html__( 'You can choose the icon here', 'bw-petito' ),
				'type' => Controls_Manager::ICONS,
				'separator' => 'before',
				'default' => [
					'value' => 'icon icon-heart1',
					'library' => 'solid',
				],
				'condition' => [
					'style' =>  ['style14'],
				]
			]
		);

		$this->add_control(
			'date', [
				'label' => esc_html__( 'Date', 'bw-petito' ),
				'type' => Controls_Manager::DATE_TIME,
				'placeholder' => esc_html__( 'Set date', 'bw-petito' ),
				'label_block' => true,
				'condition' => [
					'style' => ['style3','style8']
				]
			]
		);
		$this->add_control(
			'day', [
				'label' => esc_html__( 'Title day', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'description' => esc_html__( 'Enter text (Leave it blank will hide it)', 'bw-petito' ),
				'label_block' => true,
				'default' => '',
				'condition' => [
					'style' => ['style3','style8'],
				]
			]
		);
		$this->add_control(
			'hour', [
				'label' => esc_html__( 'Title hour', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'description' => esc_html__( 'Enter text (Leave it blank will hide it)', 'bw-petito' ),
				'label_block' => true,
				'default' =>'',
				'condition' => [
					'style' => ['style3','style8'],
				]
			]
		);
		$this->add_control(
			'min', [
				'label' => esc_html__( 'Title min', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'description' => esc_html__( 'Enter text (Leave it blank will hide it)', 'bw-petito' ),
				'label_block' => true,
				'default' => '',
				'condition' => [
					'style' => ['style3','style8'],
				]
			]
		);
		$this->add_control(
			'sec', [
				'label' => esc_html__( 'Title sec', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'description' => esc_html__( 'Enter text (Leave it blank will hide it)', 'bw-petito' ),
				'label_block' => true,
				'default' => '',
				'condition' => [
					'style' => ['style3','style8'],
				]
			]
		);
		
		$this->add_control(
			'desc_title', [
				'label' => esc_html__( 'Description', 'bw-petito' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter text', 'bw-petito' ),
				'label_block' => true,
				'condition' => [
					'style' => ['style4'],
				]
			]
		);
		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Image', 'bw-petito' ),
				'description'	=> esc_html__( 'You can choose the icon image here', 'bw-petito' ),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'style' =>  ['style4','style6'],
				]
			]
		);
	
		$this->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'bw-petito' ),
				'description'	=> esc_html__( 'You can choose the icon here', 'bw-petito' ),
				'type' => Controls_Manager::ICONS,
				'separator' => 'before',
				'default' => [
					'value' => 'icon icon-heart1',
					'library' => 'solid',
				],
				'condition' => [
					'style' =>  ['style2','style7','style12','style13','style14'],
					'icon_image[url]' =>  '',
				]
			]
		);
		$this->add_control(
			'icon_readmore_image',
			[
				'label' => esc_html__( 'Icon image', 'bw-petito' ),
				'description'	=> esc_html__( 'You can choose the icon image here (Replace for icon)', 'bw-petito' ),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'style' =>  ['style13'],
				]
			]
		);

		$this->add_control(
			'icon_image',
			[
				'label' => esc_html__( 'Icon image', 'bw-petito' ),
				'description'	=> esc_html__( 'You can choose the icon image here (Replace for icon)', 'bw-petito' ),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'style' =>  ['style2','style7','style12','style13','style14'],
					'icon[value]' =>  '',
				]
			]
		);
		$this->add_control(
			'icon_image_hover',
			[
				'label' => esc_html__( 'Icon image hover', 'bw-petito' ),
				'description'	=> esc_html__( 'You can choose the icon image here (Replace for icon)', 'bw-petito' ),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'style' =>  ['style2','style7','style12','style14'],
					'icon[value]' =>  '',
				]
			]
		);
		$this->add_control(
			'icon_gap',
			[
				'label' => esc_html__( 'Icon gap (px)', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .item-info-box' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'style' =>  ['style12'],
					'icon[value]!' =>  '',
				]
				
			]
		);
		$this->add_control(
			'content_width',
			[
				'label' => esc_html__( 'Content Width', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%','px','vw' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .info-box-content' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'style' =>  ['style14'],
				]
			]
		);
		$this->add_control(
			'link_info',
			[
				'label' => __( 'Link', 'bw-petito' ),
				'description'	=> esc_html__( 'You can add links for the element here', 'bw-petito' ),
				'type' => Controls_Manager::URL,
				'separator' => 'before',
				'dynamic' => [
					'active' => true,
				],
				'condition' => [
					'style!' =>  ['style11'],
				],
				'placeholder' => __( 'https://your-link.com', 'bw-petito' ),
				'show_label' => false,
			]
		);
		$repeater_style2 = new Repeater();
		$repeater_style2->add_control(
			'icon', [
				'label' => esc_html__( 'Icon social', 'bw-petito' ),
				'type' => Controls_Manager::ICONS,
				'placeholder' => esc_html__( 'Add Your Content Here', 'bw-petito' ),
				'label_block' => true,
			]
		);
		$repeater_style2->add_control(
			'link', [
				'label' => esc_html__( 'Link', 'bw-petito' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'You can add links for the element here', 'bw-petito' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow' => true,
				],
			]
		);
		$this->add_control(
			'list_social',
			[
				'label' => esc_html__( 'Add item social', 'bw-petito' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater_style2->get_controls(),
				'prevent_empty'=>false,
				'condition' => [
					'style' => ['style14'],
				]
			]
		);
		/*style 5 cate*/
		$this->add_control(
			'number_cate',
			[
				'label' => esc_html__( 'Show number', 'bw-petito' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'bw-petito' ),
				'label_off' => esc_html__( 'Off', 'bw-petito' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'style' =>  ['style5'],
				],
			]
		);
		$this->add_control(
			'category',
			[
				'label' 	=> esc_html__( 'Get category', 'bw-petito' ),
				'description'	=> esc_html__( 'You can change the display category here', 'bw-petito' ),
				'type'      => Controls_Manager::SELECT,
				'label_block' => true,
				'options'   => $this->get_list_category('product_cat'),
				'condition' => [
					'style' =>  ['style5','style10','style13'],
				]
			]
		);
		$this->add_control(
			'title_cate', [
				'label' => __( 'Replace Title', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Title text', 'bw-petito' ),
				'label_block' => true,
				'condition' => [
					'style' =>  ['style5','style10','style13'],
				]
			]
		);
		$this->add_control(
			'des_cate', [
				'label' => __( 'Replace Counter', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Description text', 'bw-petito' ),
				'label_block' => true,
				'condition' => [
					'style' =>  ['style13'],
				]
			]
		);
		
		$this->add_control(
			'image_cate',
			[
				'label' => esc_html__( 'Replace image', 'bw-petito' ),
				'description'	=> esc_html__( 'You can choose the icon image here (Replace for icon)', 'bw-petito' ),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'style' =>  ['style5','style10'],
				]
			]
		);
		
		$this->add_control(
			'image_cate_bg',
			[
				'label' => esc_html__( 'Image background', 'bw-petito' ),
				'description'	=> esc_html__( 'Select library', 'bw-petito' ),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'style' =>  ['style10','style13'],
				]
			]
		);
		$this->add_control(
			'image_cate_hover',
			[
				'label' => esc_html__( 'Image hover', 'bw-petito' ),
				'description'	=> esc_html__( 'Select library', 'bw-petito' ),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'style' =>  ['style10'],
				]
			]
		);
		$this->add_control(
			'image_cate_hover_pos',
			[
				'label' 	=> esc_html__( 'Image hover position', 'bw-petito' ),
				'description'	=> esc_html__( 'Set position', 'bw-petito' ),
				'type'      => Controls_Manager::SELECT,				
				'default'   => 'left',
				'label_block' => true,
				'options'   => [
					'left'		=> esc_html__( 'Left', 'bw-petito' ),
					'right'		=> esc_html__( 'Right', 'bw-petito' ),
				],
				'condition' => [
					'style' =>  ['style10'],
				]
			]
		);
		$this->add_control(
			'link_cate',
			[
				'label' => __( 'Replace Link', 'bw-petito' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'https://your-link.com', 'bw-petito' ),
				'show_label' => true,
				'condition' => [
					'style' =>  ['style5','style10','style13'],
				]
			]
		);
		
		
		$repeater2 = new Repeater();
		$repeater2->add_control(
			'category',
			[
				'label' 	=> esc_html__( 'Get Category', 'bw-petito' ),
				'description'	=> esc_html__( 'You can change the display category here', 'bw-petito' ),
				'type'      => Controls_Manager::SELECT,
				'label_block' => true,
				'options'   => $this->get_list_category('product_cat'),
			]
		);
		$repeater2->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'bw-petito' ),
				'description'	=> esc_html__( 'You can choose the icon here', 'bw-petito' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'las la-caret-right',
					'library' => 'solid',
				],
			]
		);
		$repeater2->add_control(
			'template',
			[
				'label' 	=> esc_html__( 'Sub navigation', 'bw-petito' ),
				'type'      => Controls_Manager::SELECT,
				'description'	=> esc_html__( 'Get template content)', 'bw-petito' ),
				'default'   => '',
				'options'   => bzotech_list_post_type('elementor_library',true),
			]
		);
		$repeater2->add_control(
			'title', [
				'label' => esc_html__( 'Replace Title', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'separator' => 'before',
				'placeholder' => esc_html__( 'Title text', 'bw-petito' ),
				'label_block' => true,
			]
		);
		
		
		
		$repeater2->add_control(
			'link',
			[
				'label' => esc_html__( 'Replace Link', 'bw-petito' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'show_external' => true,
				'placeholder' => esc_html__( 'https://your-link.com', 'bw-petito' ),
				'show_label' => true,
			]
		);
		$repeater9 = new Repeater();
		$repeater9->add_control(
			'title', [
				'label' => esc_html__( 'Name / Title', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'separator' => 'before',
				'placeholder' => esc_html__( 'Enter text', 'bw-petito' ),
				'label_block' => true,
			]
		);
		
		
		$repeater9->add_control(
			'position', [
				'label' => esc_html__( 'Position', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'separator' => 'before',
				'placeholder' => esc_html__( 'Enter text', 'bw-petito' ),
				'label_block' => true,
			]
		);
		$repeater9->add_control(
			'image', [
				'label' => esc_html__( 'Image', 'bw-petito' ),
				'type' => Controls_Manager::MEDIA,
				'separator' => 'before',
				'placeholder' => esc_html__( 'Select Image', 'bw-petito' ),
				'label_block' => true,
			]
		);
		$repeater9->add_control(
			'content', [
				'label' => esc_html__( 'Content', 'bw-petito' ),
				'type' => Controls_Manager::WYSIWYG,
				'separator' => 'before',
				'placeholder' => esc_html__( 'Enter Content', 'bw-petito' ),
				'label_block' => true,
			]
		);
		
		
		$this->add_control(
			'list_testimonial',
			[
				'label' => esc_html__( 'Add Testimonial', 'bw-petito' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty'=>false,
				'fields' => $repeater9->get_controls(),
				'title_field' => esc_html__( 'Item', 'bw-petito' ),
				'condition' => [
					'style' => 'style9',
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
		$this->end_controls_section();

		

		/*------------STYLE--------- */

		$this->start_controls_section(
			'section_style_title',
			[
				'label' => esc_html__( 'Title style', 'bw-petito' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
				'style' =>  ['','style2','style3','style4','style5','style7','style8','style12','style14'],
					'title!' =>  ''
				]
			]
		);
		
		$this->get_style_type_text('title','item-title-e');
		
		$this->end_controls_section(); /*End title style*/
		
//
		$this->start_controls_section(
			'section_style_count',
			[
				'label' => esc_html__( 'Count Categories Style', 'bw-petito' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
				'style' =>  ['style5'],
					
				]
			]
		);
		
		$this->get_style_type_text('count','count-item');

		$this->end_controls_section(); 
		// Phu
		$this->start_controls_section(
			'style_section1',
			[
				'label' => esc_html__( 'Style', 'bw-petito' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' =>  ['style10','style13'],
						
				]
			]
		);
		//color 
		$this->add_control(
			'text_color_cattitle',
			[
				'label' => esc_html__( 'Color category title', 'bw-petito' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'style' =>  ['style13'],
						
				],
				'selectors' => [
					'{{WRAPPER}} .item-cate' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography_number_countdown',
				'selector' => '{{WRAPPER}} .item-cate',
				'condition' => [
					'style' =>  ['style13'],
						
				]
			]
		);
		//color 
		$this->add_control(
			'text_color_number',
			[
				'label' => esc_html__( 'Color Number Countdown', 'bw-petito' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'style' =>  ['style10'],
						
				],
				'selectors' => [
					'{{WRAPPER}} .number' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography_number_countdown',
				'selector' => '{{WRAPPER}} .number',
				'condition' => [
					'style' =>  ['style10','style13'],
						
				]
			]
		);
	
			//typo 
			$this->add_control(
				'text_color_text',
				[
					'label' => esc_html__( 'Color Text Countdown', 'bw-petito' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .text' => 'color: {{VALUE}}',
						'{{WRAPPER}} .text-count' => 'color: {{VALUE}}',
					],
					'condition' => [
						'style' =>  ['style10','style13'],
							
					]
				]
			);
			
			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'content_typography_text_countdown',
					'selector' => '{{WRAPPER}} .text, {{WRAPPER}} .text-count',
					'condition' => [
						'style' =>  ['style10','style13'],
							
					]
				]
			);
		$this->end_controls_section();
			// Phu
		$this->start_controls_section(
			'section_style_sub_title',
			[
				'label' => esc_html__( 'Sub Title | Description Style', 'bw-petito' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' =>  ['style2','style3','style4','style7','style8','style12','style14'],
					'sub_title!' =>  ''
				]
			]
		);
		$this->get_style_type_text('sub_title','item-sub-title-e');
		$this->end_controls_section(); /*End sub title style*/

		$this->start_controls_section(
			'section_style_read_more',
			[
				'label' => esc_html__( 'Read more button Style', 'bw-petito' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' =>  ['style14'],
					'read_more_title!' =>  ''
				]
			]
		);
		$this->get_style_type_text('read_more_title','item-readmore-e');
		$this->end_controls_section(); /*End sub title style*/

		$this->start_controls_section(
			'section_style_icon_readmore',
			[
				'label' => esc_html__( 'Read More Icon Style', 'bw-petito' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' =>  ['style14'],
					'icon_after_readmore[value]!' =>  '',
				]
			]
		);
		$this->get_style_type_icon('icon_after_readmore','item-icon-readmore-e');
		$this->end_controls_section(); /*End Icon style*/

		$this->start_controls_section(
			'section_style_desc_title',
			[
				'label' => esc_html__( 'Description Style', 'bw-petito' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' =>  ['style4'],
					'desc_title!' =>  ''
				]
			]
		);
		$this->get_style_type_text('desc_title','item-desc-title-e');
		$this->end_controls_section(); /*End sub title style*/

		

		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => esc_html__( 'Icon style', 'bw-petito' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' =>  ['style2','style7','style12','style13','style14'],
					'icon[value]!' =>  '',
				]
			]
		);
		$this->get_style_type_icon('icon','item-icon-e');
		$this->end_controls_section(); /*End Icon style*/

		$this->start_controls_section(
			'section_style_image_icon',
			[
				'label' => esc_html__( 'Image Icon style', 'bw-petito' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'icon_image[url]!' =>  '',
				]
			]
		);
		$this->get_style_type_image('image_icon','item-image-icon-e');
		$this->end_controls_section(); /*End Icon style*/

		$this->start_controls_section(
			'section_style_image',
			[
				'label' => esc_html__( 'Image style', 'bw-petito' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'image[url]!' =>  '',
				]
			]
		);
		$this->get_style_type_image('image_size','item-image-e');
		$this->end_controls_section(); /*End Icon style*/
		//STYLE CATEGORIES 
		// $this->start_controls_section(
        //     'style_section',
        //     [
        //         'label' => esc_html__('Style', 'bw-petito'),
        //         'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        //     ]
        // );
		//    // Color title banner- Style  title
		//    $this->add_control(
        //     'text_color_1',
        //     [
        //         'label' => esc_html__('Title Color', 'bw-petito'),
        //         'type' => \Elementor\Controls_Manager::COLOR,
        //         'selectors' => [
        //             '{{WRAPPER}} .title_categories' => 'color: {{VALUE}}',
        //         ],
        //     ]
        // );
        // //Background-color-1
        // $this->add_group_control(
		// 	\Elementor\Group_Control_Background::get_type(),
		// 	[
		// 		'name' => 'background-color-1',
		// 		'label' => esc_html__( 'Background', 'bw-petito' ),
		// 		'types' => [ 'classic', 'gradient', 'video' ],
		// 		'selector' => '{{WRAPPER}} .title_categories',
		// 	]
		// );
        // //Text Shadow
        // $this->add_group_control(
		// 	\Elementor\Group_Control_Text_Shadow::get_type(),
		// 	[
		// 		'name' => 'text_shadow_title',
		// 		'label' => esc_html__( 'Text Shadow', 'bw-petito' ),
		// 		'selector' => '{{WRAPPER}} .title_categories',
		// 	]
		// );
        // //Box Shadow
        // $this->add_group_control(
		// 	\Elementor\Group_Control_Box_Shadow::get_type(),
		// 	[
		// 		'name' => 'box_shadow_title',
		// 		'label' => esc_html__( 'Box Shadow', 'bw-petito' ),
		// 		'selector' => '{{WRAPPER}} .title_categories',
		// 	]
		// );
        // //
        // //Border 
        
        // //Border-Radius
        // $this->add_control(
		// 	'Border-Radius-1',
		// 	[
		// 		'label' => esc_html__( 'Border Radius', 'bw-petito' ),
		// 		'type' => \Elementor\Controls_Manager::DIMENSIONS,
		// 		'size_units' => [ 'px', '%', 'em' ],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .title_categories' => 'Border Radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		// 		],
		// 	]
		// );
        // //Text-align
        // $this->add_control(
		// 	'text_align',
		// 	[
		// 		'label' => esc_html__( 'Alignment All', 'bw-petito' ),
		// 		'type' => \Elementor\Controls_Manager::CHOOSE,
		// 		'options' => [
		// 			'left' => [
		// 				'title' => esc_html__( 'Left', 'bw-petito' ),
		// 				'icon' => 'eicon-text-align-left',
		// 			],
		// 			'center' => [
		// 				'title' => esc_html__( 'Center', 'bw-petito' ),
		// 				'icon' => 'eicon-text-align-center',
		// 			],
		// 			'right' => [
		// 				'title' => esc_html__( 'Right', 'bw-petito' ),
		// 				'icon' => 'eicon-text-align-right',
		// 			],
		// 		],
		// 		'default' => 'center',
		// 		'toggle' => true,
		// 		'selectors' => [
		// 			'{{WRAPPER}} .wrapper-banner' => 'text-align: {{VALUE}};',
		// 		],
		// 	]
		// );
        // //Typography
        // $this->add_group_control(
		// 	\Elementor\Group_Control_Typography::get_type(),
		// 	[
		// 		'name' => 'content_typography_1',
		// 		'selector' => '{{WRAPPER}} .title_categories',
		// 	]
		// );
		// $this->end_controls_section();
		
		
		
	}
	protected function get_list_category($taxonomy='category',$by='slug'){
		$listcate = get_terms($taxonomy);
		
		$newarr = [];
		
		foreach($listcate as $value){
			if(!empty($value->$by))
			$newarr[$value->$by] = $value->name; 
		}
	
		return $newarr;
	
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
	public function get_style_type_icon($key='icon',$class="item-icon-e") {
		$this->start_controls_tabs( $key.'_tabs_style' );
		$this->start_controls_tab(
			$key.'_tab_normal',
			[
				'label' => __( 'Normal Style', 'bw-petito' ),
			]
		);
		$this->add_responsive_control(
			$key.'_size_css',
			[
				'label' => esc_html__( 'Font Size', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'max' => 200,
						'min' => 0,
						'step' => 1,
					],
					'em' => [
						'max' => 200,
						'min' => 0,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .'.$class => 'font-size: {{SIZE}}{{UNIT}};',
				],
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
		$this->add_responsive_control(
			$key.'_icon_width_css',
			[
				'label' => esc_html__( 'Icon Box Width', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%','px','vw' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .'.$class => 'width: {{SIZE}}{{UNIT}};',
				],
			]
	   );
		$this->add_responsive_control(
			$key.'_border_radius_css',
		   [
			   'label' => __( 'Border Radius', 'bw-petito' ),
			   'type' => Controls_Manager::DIMENSIONS,
			   'size_units' => [ 'px', '%' ],
			   'selectors' => [
				   '{{WRAPPER}} .'.$class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			   ],
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
			$key.'_tab_hover',
			[
				'label' => __( 'Hover Style', 'bw-petito' ),
			]
		);
		$this->add_responsive_control(
			$key.'_size_hover_css',
			[
				'label' => esc_html__( 'Size On Hover ', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'max' => 200,
						'min' => 0,
						'step' => 1,
					],
					'em' => [
						'max' => 200,
						'min' => 0,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .'.$class.':hover' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			$key.'_color_hover_css',
			[
				'label' => __( 'Color On Hover', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$class.':hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .'.$class.':hover .sub_color_e' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			$key.'_bg_hover_css',
			[
				'label' => __( 'Background Color On Hover', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$class.':hover, {{WRAPPER}} .'.$class.':focus' => 'background-color: {{VALUE}};',
				],
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
	public function get_style_type_image($key='image',$class="item-image-e") {

		$this->start_controls_tabs( $key.'_tabs_style' );
		$this->start_controls_tab(
			$key.'_tab_normal',
			[
				'label' => __( 'Normal Style', 'bw-petito' ),
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => $key, // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'include' => [],
				'default' => 'full',
			]
		);
		$this->add_responsive_control(
			$key.'_width_css',
			[
				'label' => esc_html__( 'Width', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%','px','vw' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .'.$class.' img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			$key.'_width_max_css',
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
					'{{WRAPPER}} .'.$class.' img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			$key.'_height_css',
			[
				'label' => esc_html__( 'Hight', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%','px','vh' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .'.$class.' img' => 'width: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'after',
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
					'{{WRAPPER}} .'.$class.' img' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => $key.'_filters_css',
				'selector' => '{{WRAPPER}} .'.$class.' img',
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
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => $key.'_border_css',
				'selector' => '{{WRAPPER}} .'.$class.' img',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			 $key.'_border_radius_css',
			[
				'label' => __( 'Border Radius', 'bw-petito' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .'.$class.'  img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' =>  $key.'_box_shadow_css',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .'.$class.' img',
			]
		);
		$this->end_controls_tab(); /*End Normal Style*/

		$this->start_controls_tab(
			$key.'_tab_hover',
			[
				'label' => __( 'Style On Hover', 'bw-petito' ),
			]
		);
		$this->add_control(
			$key.'_opacity_hover_css',
			[
				'label' => __( 'Opacity On Hover', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .'.$class.':hover img' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'label' => __( 'Filters On Hover', 'bw-petito' ),
				'name' => $key.'_filters_hover_css',
				'selector' => '{{WRAPPER}} .'.$class.':hover img',
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
	public function get_list_item_info($key='list_info',$condition=array(),$attr = []) {
		$category=$image=$image_hover=$title=$desc=$content=$button=$link=$star=$button2=$countdown_number = $countdown_after_number =$countdown_title =$countdown_number2 =$countdown_after_number2 =$countdown_title2 =false;

		extract($attr);
		$repeater_sliders = new Repeater();
		if($category==true)
			$repeater_sliders->add_control(
				'category',
				[
					'label' 	=> esc_html__( 'Get category', 'bw-petito' ),
					'description'	=> esc_html__( 'You can change the display category here', 'bw-petito' ),
					'type'      => Controls_Manager::SELECT,
					'label_block' => true,
					'options'   => bzotech_get_list_category('product_cat'),
					
				]
			);
		if($image==true)
		$repeater_sliders->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'bw-petito' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => ''
				],
			]
		);
		
		if($image_hover==true)
		$repeater_sliders->add_control(
			'image_hover',
			[
				'label' => esc_html__( 'Choose Image hover', 'bw-petito' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => ''
				],
			]
		);
		if($image==true)
		$repeater_sliders->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'include' => [],
				'default' => 'full',
			]
		);
			
		if($title==true)
		$repeater_sliders->add_control(
			'title', 
			[
				'label' => esc_html__( 'Title', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'label_block' => true,
			]
		);
		if($desc==true)
		$repeater_sliders->add_control(
			'description', 
			[
				'label' => esc_html__( 'Description', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'label_block' => true,
			]
		);
		
		if($content==true)
		$repeater_sliders->add_control(
			'content',
			[
				'label' => esc_html__( 'Content', 'bw-petito' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => '',
			]
		);
				
		if($button==true)
		$repeater_sliders->add_control(
			'button_name', 
			[
				'label' => esc_html__( 'Button name', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'label_block' => true,
			]
		);
		
		if($link==true)
		$repeater_sliders->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'bw-petito' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'bw-petito' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow' => false,
				],
			]
		);
		if($star==true)
		$repeater_sliders->add_control(
			'number_star',
			[
				'label' => esc_html__( 'Number star', 'bw-petito' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__( 'None', 'bw-petito' ),
					'1' => esc_html__( '1 star', 'bw-petito' ),
					'2' => esc_html__( '2 star', 'bw-petito' ),
					'3' => esc_html__( '3 star', 'bw-petito' ),
					'4' => esc_html__( '4 star', 'bw-petito' ),
					'5' => esc_html__( '5 star', 'bw-petito' ),
					
				],
				'default' => '5',
			]
		);
		if($countdown_number==true)
		$repeater_sliders->add_control(
			'countdown_number',
			[
				'label' => esc_html__( 'Countdown number', 'bw-petito' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '12',
			]
		);
		if($countdown_after_number==true)
		$repeater_sliders->add_control(
			'countdown_after_number',
			[
				'label' => esc_html__( 'After countdown number', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
			]
		);
		if($countdown_title==true)
		$repeater_sliders->add_control(
			'countdown_title',
			[
				'label' => esc_html__( 'Title countdown', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
			]
		);
		if($countdown_number2==true)
		$repeater_sliders->add_control(
			'countdown_number2',
			[
				'label' => esc_html__( 'Countdown number 2', 'bw-petito' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '12',
			]
		);
		if($countdown_after_number2==true)
		$repeater_sliders->add_control(
			'countdown_after_number2',
			[
				'label' => esc_html__( 'After countdown number 2', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
			]
		);
		if($countdown_title2==true)
		$repeater_sliders->add_control(
			'countdown_title2',
			[
				'label' => esc_html__( 'Title countdown 2', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			$key,
			[
				'label' => esc_html__( 'Add item info', 'bw-petito' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty'=>false,
				'fields' => $repeater_sliders->get_controls(),
				'title_field' => esc_html__( 'Item', 'bw-petito' ),
				'condition' => $condition,
			]
		);
		
		
	}
} ?>