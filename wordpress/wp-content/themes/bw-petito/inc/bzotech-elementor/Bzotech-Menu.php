<?php
namespace Elementor;
use Bzotech_Walker_Nav_Menu;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Bzotech_Menu extends Widget_Base {

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
		return 'bzotech-menu';
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
		return esc_html__( 'Menu', 'bw-petito' );
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

	public function get_menus(){
        $list = [];
        $menus = wp_get_nav_menus();
        foreach($menus as $menu){
            $list[$menu->slug] = $menu->name;
        }

        return $list;
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
	protected function register_controls() {
		$this->start_controls_section(
            'content_tab',
            [
                'label' => esc_html__('Menu settings', 'bw-petito'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
		);

        $this->add_control(
            'nav_menu',
            [
                'label'     =>esc_html__( 'Select menu', 'bw-petito' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => $this->get_menus(),
            ]
		);

		$this->add_control(
			'main_menu_style',
			[
				'label' => esc_html__( 'Menu style', 'bw-petito' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''  => esc_html__( 'Default', 'bw-petito' ),
					'style2'  => esc_html__( 'Style 2', 'bw-petito' ),
					'style3'  => esc_html__( 'Style 3', 'bw-petito' ),
					'style4'  => esc_html__( 'Style 4', 'bw-petito' ),
					'icon' => esc_html__( 'Menu icon', 'bw-petito' ),
				],
			]
		);
		$this->add_control(
			'menu_sticky',
			[
				'label' => esc_html__( 'Menu sticky', 'bw-petito' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'bw-petito' ),
				'label_off' => esc_html__( 'Off', 'bw-petito' ),
				'return_value' => 'on',
				'default' => '',
			]
		);
		$this->add_control(
			'style_menu_sticky',
			[
				'label' => esc_html__( 'Style menu sticky', 'bw-petito' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					''  => esc_html__( 'Scroll up to show', 'bw-petito' ),
					'down' => esc_html__( 'Scroll down to show', 'bw-petito' ),
				],
				'default' => '',
				'condition' => [
					'menu_sticky' => 'on',
				]
			]
		);
        $this->add_responsive_control(
			'main_menu_position',
			[
				'label' => esc_html__( 'Menu text align', 'bw-petito' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left'  => esc_html__( 'Left', 'bw-petito' ),
					'center' => esc_html__( 'Center', 'bw-petito' ),
                    'right' => esc_html__( 'Right', 'bw-petito' ),
				],
				'selectors' => [
					'{{WRAPPER}} .bzotech-navbar-nav' => 'text-align: {{VALUE}};',
				],
			]
		);
        $this->add_responsive_control(
			'menu_icon_position_content',
			[
				'label' => esc_html__( 'Menu position content', 'bw-petito' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'left'  => esc_html__( 'Left', 'bw-petito' ),
                    'right' => esc_html__( 'Right', 'bw-petito' ),
				],

				'condition' => [
					'main_menu_style' => 'icon',
				]
			]
		);

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'bzotech_menubar_background',
				'label' => esc_html__( 'Background', 'bw-petito' ),
                'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .bzotech-menu-container',
			]
        );

        $this->add_responsive_control(
			'border_radius',
			[
				'label' => esc_html__( 'Border radius', 'bw-petito' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .bzotech-menu-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );        

		$this->end_controls_section();

		$this->start_controls_section(
            'content_side_tab',
            [
                'label' => esc_html__('Menu side/mobile', 'bw-petito'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
		);
		$this->add_control(
			'icon_mobile_menu',
			[
				'label' => esc_html__( 'Icon menu on mobile', 'bw-petito' ),
				'description'	=> esc_html__( 'You can choose the icon here', 'bw-petito' ),
				'type' => Controls_Manager::ICONS,
				'separator' => 'before',
				'default' => [
					'value' => 'la la-reorder',
					'library' => 'solid',
				]
			]
		);
		$this->add_control(
			'bzotech_nav_menu_logo',
			[
				'label' => esc_html__( 'Choose Mobile Menu Logo', 'bw-petito' ),
				'type' => Controls_Manager::MEDIA,
			]
		);

		$this->add_responsive_control(
            'mobile_menu_panel_background',
            [
                'label' => esc_html__( 'Item text background color', 'bw-petito' ),
                'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .menu-style-icon .bzotech-menu-inner' => 'background-image: linear-gradient(180deg, {{VALUE}} 0%, {{VALUE}} 100%);',
				],
            ]
        );
		$this->add_responsive_control(
            'mobile_menu_button',
            [
                'label' => esc_html__( 'Mobile menu button color', 'bw-petito' ),
                'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.toggle-mobile-menu' => 'color: {{VALUE}};',
				],
            ]
        );
		$this->add_responsive_control(
            'mobile_menu_text_color',
            [
                'label' => esc_html__( 'Mobile menu text color', 'bw-petito' ),
                'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bzotech-menu-toggler .text-menu' => 'color: {{VALUE}};',
				],
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography1',
				'label' => esc_html__( 'Typography for mobile text', 'bw-petito' ),
				'selector' => '{{WRAPPER}} .bzotech-menu-toggler .text-menu',
			]
		);
		$this->add_responsive_control(
			'mobile_menu_panel_spacing',
			[
				'label' => esc_html__( 'Padding', 'bw-petito' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .menu-style-icon .bzotech-menu-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mobile_menu_panel__head_spacing',
			[
				'label' => esc_html__( 'Head Padding', 'bw-petito' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bzotech-nav-identity-panel.panel-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'mobile_menu_panel_width',
			[
				'label' => esc_html__( 'Width', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 260,
						'max' => 900,
						'step' => 1,
                    ],
                    '%' => [
						'min' => 0,
						'max' => 100,
					],
                ],
				'selectors' => [
					'{{WRAPPER}} .menu-style-icon .bzotech-menu-inner' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'replace_menu_title', [
				'label' => esc_html__( 'Replace Menu Title', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter text', 'bw-petito' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'button_icon_display',
			[
				'label' => esc_html__( 'Menu display', 'bw-petito' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'inline',
				'options' => [
					'inline'   => esc_html__( 'Inline', 'bw-petito' ),
					'block'  => esc_html__( 'Block', 'bw-petito' ),
				],
				'condition' => [
					'icon_mobile_menu[value]!' => '',
					'replace_menu_title!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .menu-style-icon .bzotech-menu-toggler .text-menu' => 'display: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'icon_mobile_menu_position',
			[
				'label' => esc_html__( 'Mobile menu icon align', 'bw-petito' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left'  => esc_html__( 'Left', 'bw-petito' ),
					'center' => esc_html__( 'Center', 'bw-petito' ),
                    'right' => esc_html__( 'Right', 'bw-petito' ),
				],
				'selectors' => [
					'{{WRAPPER}} .menu-style-icon .bzotech-menu-toggler' => 'text-align: {{VALUE}};',
				],
			]
		);
        $this->end_controls_section();
        // Custom menu item lv0
        $this->start_controls_section(
            'style_tab_menuitem',
            [
                'label' => esc_html__('Menu item style', 'bw-petito'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => esc_html__( 'Typography', 'bw-petito' ),
				'selector' => '{{WRAPPER}} .bzotech-navbar-nav > li > a',
			]
		);

        $this->add_responsive_control(
			'menu_item_spacing',
			[
				'label' => esc_html__( 'Spacing', 'bw-petito' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .bzotech-navbar-nav > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'menu_item_margin',
			[
				'label' => esc_html__( 'Margin', 'bw-petito' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .bzotech-navbar-nav > li > a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
            'nav_menu_tabs'
		);
			// Normal
			$this->start_controls_tab(
				'nav_menu_normal_tab',
				[
					'label' => esc_html__( 'Normal', 'bw-petito' ),
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'item_background',
					'label' => esc_html__( 'Item background', 'bw-petito' ),
					'types' => ['classic', 'gradient'],
					'selector' => '{{WRAPPER}} .bzotech-navbar-nav > li > a',
				]
			);

			$this->add_responsive_control(
				'menu_text_color',
				[
					'label' => esc_html__( 'Item text color', 'bw-petito' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .bzotech-navbar-nav > li > a' => 'color: {{VALUE}}',
					],
				]
			);
	
			$this->end_controls_tab();

			// Hover
			$this->start_controls_tab(
				'nav_menu_hover_tab',
				[
					'label' => esc_html__( 'Hover', 'bw-petito' ),
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'item_background_hover',
					'label' => esc_html__( 'Item background', 'bw-petito' ),
					'types' => ['classic', 'gradient'],
					'selector' => '{{WRAPPER}} .bzotech-navbar-nav > li > a:hover, {{WRAPPER}} .bzotech-navbar-nav > li > a:focus, {{WRAPPER}} .bzotech-navbar-nav > li > a:active, {{WRAPPER}} .bzotech-navbar-nav > li:hover > a',
				]
			);
	
			$this->add_responsive_control(
				'item_color_hover',
				[
					'label' => esc_html__( 'Item text color', 'bw-petito' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .bzotech-navbar-nav > li > a:hover' => 'color: {{VALUE}}',
						'{{WRAPPER}} .bzotech-navbar-nav > li > a:focus' => 'color: {{VALUE}}',
						'{{WRAPPER}} .bzotech-navbar-nav > li > a:active' => 'color: {{VALUE}}',
						'{{WRAPPER}} .bzotech-navbar-nav > li:hover > a' => 'color: {{VALUE}}',
						'{{WRAPPER}} .bzotech-navbar-nav > li:hover > a .bzotech-submenu-indicator' => 'color: {{VALUE}}',
						'{{WRAPPER}} .bzotech-navbar-nav > li > a:hover .bzotech-submenu-indicator' => 'color: {{VALUE}}',
						'{{WRAPPER}} .bzotech-navbar-nav > li > a:focus .bzotech-submenu-indicator' => 'color: {{VALUE}}',
						'{{WRAPPER}} .bzotech-navbar-nav > li > a:active .bzotech-submenu-indicator' => 'color: {{VALUE}}',
					],
				]
			);

			$this->end_controls_tab();

			// active
			$this->start_controls_tab(
				'nav_menu_active_tab',
				[
					'label' => esc_html__( 'Active', 'bw-petito' ),
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'		=> 'nav_menu_active_bg_color',
					'label' 	=> esc_html__( 'Item background', 'bw-petito' ),
					'types'		=> ['classic', 'gradient'],
					'selector'	=> '{{WRAPPER}} .bzotech-navbar-nav > li.current-menu-item > a'
				]
			);
	
			$this->add_responsive_control(
				'nav_menu_active_text_color',
				[
					'label' => esc_html__( 'Item text color (Active)', 'bw-petito' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .bzotech-navbar-nav > li.current-menu-item > a' => 'color: {{VALUE}}',
						'{{WRAPPER}} .bzotech-navbar-nav > li.current-menu-ancestor > a' => 'color: {{VALUE}}',
						'{{WRAPPER}} .bzotech-navbar-nav > li.current-menu-ancestor > a .bzotech-submenu-indicator' => 'color: {{VALUE}}',
					],
				]
			);	

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'menu_item0_border_heading',
			[
				'label' => esc_html__( 'Items Border', 'bw-petito' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'menu_item0_border',
				'label' => esc_html__( 'Border', 'bw-petito' ),
				'selector' => '{{WRAPPER}} .bzotech-navbar-nav > li > a',
			]
		);

		$this->add_control(
			'menu_item0_border_last_child_heading',
			[
				'label' => esc_html__( 'Border Last Child', 'bw-petito' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'menu_item0_border_last_child',
				'label' => esc_html__( 'Border last Child', 'bw-petito' ),
				'selector' => '{{WRAPPER}} .bzotech-navbar-nav > li:last-child > a',
			]
		);

		$this->add_control(
			'menu_item0_border_first_child_heading',
			[
				'label' => esc_html__( 'Border First Child', 'bw-petito' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'menu_item0_border_first_child',
				'label' => esc_html__( 'Border First Child', 'bw-petito' ),
				'selector' => '{{WRAPPER}} .bzotech-navbar-nav > li:first-child > a',
			]
		);
		$this->add_control(
			'style_effect_hover',
			[
				'label' => esc_html__( 'Effect hover style', 'bw-petito' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''  => esc_html__( 'None', 'bw-petito' ),
					'effect-line-bottom'  => esc_html__( 'Line bottom', 'bw-petito' ),
					'effect-line-top' => esc_html__( 'Line top', 'bw-petito' ),
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'style_effect_hover_color',
			[
				'label' => esc_html__( 'Effect hover Color', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .effect-line-bottom' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'style_effect_hover!' => ''
				]
			]
		);
        $this->end_controls_section();
        // Custom sub menu item
        $this->start_controls_section(
            'style_tab_submenu_item',
            [
                'label' => esc_html__('Submenu item style', 'bw-petito'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'style_tab_submenu_item_arrow',
			[
				'label' => esc_html__( 'Submenu Indicator', 'bw-petito' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'bzotech_line_arrow',
				'options' => [
					'bzotech_line_arrow'  => esc_html__( 'Line Arrow', 'bw-petito' ),
					'bzotech_plus_icon' => esc_html__( 'Plus', 'bw-petito' ),
					'bzotech_fill_arrow' => esc_html__( 'Fill Arrow', 'bw-petito' ),
					'bzotech_none' => esc_html__( 'None', 'bw-petito' ),
                ],
			]
		);
		
		$this->add_responsive_control(
			'style_tab_submenu_indicator_color',
			[
				'label' => esc_html__( 'Indicator color', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bzotech-navbar-nav .sub-menu a .indicator-icon' => 'color: {{VALUE}}',
				],
				'condition' => [
					'style_tab_submenu_item_arrow!' => 'bzotech_none'
				]
			]
		);
		$this->add_responsive_control(
			'submenu_indicator_spacing',
			[
				'label' => esc_html__( 'Indicator Margin', 'bw-petito' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bzotech-navbar-nav-default a .indicator-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'style_tab_submenu_item_arrow!' => 'bzotech_none'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'menu_item_typography',
				'label' => esc_html__( 'Typography', 'bw-petito' ),
				'selector' => '{{WRAPPER}} .bzotech-navbar-nav .sub-menu > li > a',
			]
        );

		$this->add_responsive_control(
			'submenu_item_spacing',
			[
				'label' => esc_html__( 'Spacing', 'bw-petito' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .bzotech-navbar-nav .sub-menu > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
			'submenu_active_hover_tabs'
		);
			$this->start_controls_tab(
				'submenu_normal_tab',
				[
					'label'	=> esc_html__('Normal', 'bw-petito')
				]
			);

			$this->add_responsive_control(
				'submenu_item_color',
				[
					'label' => esc_html__( 'Item text color', 'bw-petito' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .bzotech-navbar-nav .sub-menu > li > a' => 'color: {{VALUE}}',
					],
					
				]
			);
	
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'menu_item_background',
					'label' => esc_html__( 'Item background', 'bw-petito' ),
					'types' => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .bzotech-navbar-nav .sub-menu > li > a',
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'submenu_hover_tab',
				[
					'label'	=> esc_html__('Hover', 'bw-petito')
				]
			);
	
			$this->add_responsive_control(
				'item_text_color_hover',
				[
					'label' => esc_html__( 'Item text color (hover)', 'bw-petito' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .bzotech-navbar-nav .sub-menu > li > a:hover' => 'color: {{VALUE}}',
						'{{WRAPPER}} .bzotech-navbar-nav .sub-menu > li > a:focus' => 'color: {{VALUE}}',
						'{{WRAPPER}} .bzotech-navbar-nav .sub-menu > li > a:active' => 'color: {{VALUE}}',
						'{{WRAPPER}} .bzotech-navbar-nav .sub-menu > li:hover > a' => 'color: {{VALUE}}',
					],
				]
			);
	
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'menu_item_background_hover',
					'label' => esc_html__( 'Item background (hover)', 'bw-petito' ),
					'types' => [ 'classic', 'gradient' ],
					'selector' => '
					{{WRAPPER}} .bzotech-navbar-nav .sub-menu > li > a:hover,
					{{WRAPPER}} .bzotech-navbar-nav .sub-menu > li > a:focus,
					{{WRAPPER}} .bzotech-navbar-nav .sub-menu > li > a:active,
					{{WRAPPER}} .bzotech-navbar-nav .sub-menu > li:hover > a',
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'submenu_active_tab',
				[
					'label'	=> esc_html__('Active', 'bw-petito')
				]
			);

			$this->add_responsive_control(
				'nav_sub_menu_active_text_color',
				[
					'label' => esc_html__( 'Item text color (Active)', 'bw-petito' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .bzotech-navbar-nav .sub-menu > li.current-menu-item > a' => 'color: {{VALUE}} !important'
					],
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'		=> 'nav_sub_menu_active_bg_color',
					'label' 	=> esc_html__( 'Item background (Active)', 'bw-petito' ),
					'types'		=> ['classic', 'gradient'],
					'selector'	=> '{{WRAPPER}} .bzotech-navbar-nav .sub-menu > li.current-menu-item > a',
				]
			);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'menu_item_border_heading',
			[
				'label' => esc_html__( 'Sub Menu Items Border', 'bw-petito' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'menu_item_border',
				'label' => esc_html__( 'Border', 'bw-petito' ),
				'selector' => '{{WRAPPER}} .bzotech-navbar-nav .sub-menu > li > a',
			]
		);

		$this->add_control(
			'menu_item_border_last_child_heading',
			[
				'label' => esc_html__( 'Border Last Child', 'bw-petito' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'menu_item_border_last_child',
				'label' => esc_html__( 'Border last Child', 'bw-petito' ),
				'selector' => '{{WRAPPER}} .bzotech-navbar-nav .sub-menu > li:last-child > a',
			]
		);

		$this->add_control(
			'menu_item_border_first_child_heading',
			[
				'label' => esc_html__( 'Border First Child', 'bw-petito' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'menu_item_border_first_child',
				'label' => esc_html__( 'Border First Child', 'bw-petito' ),
				'selector' => '{{WRAPPER}} .bzotech-navbar-nav .sub-menu > li:first-child > a',
			]
		);
		
        $this->end_controls_section();
		
        $this->start_controls_section(
            'style_tab_submenu_panel',
            [
                'label' => esc_html__('Submenu panel style', 'bw-petito'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'panel_submenu_border',
				'label' => esc_html__( 'Panel Menu Border', 'bw-petito' ),
				'selector' => '{{WRAPPER}} .bzotech-navbar-nav .sub-menu',
			]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'submenu_container_background',
                'label' => esc_html__( 'Container background', 'bw-petito' ),
                'types' => [ 'classic','gradient' ],
                'selector' => '{{WRAPPER}} .bzotech-navbar-nav .sub-menu',
            ]
        );

        $this->add_responsive_control(
			'submenu_panel_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'bw-petito' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .bzotech-navbar-nav .sub-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->add_responsive_control(
			'submenu_panel_padding',
			[
				'label' => esc_html__( 'Padding', 'bw-petito' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .bzotech-navbar-nav .sub-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->add_responsive_control(
			'submenu_container_width',
			[
				'label' => esc_html__( 'Container width', 'bw-petito' ),
                'type' => Controls_Manager::TEXT,
                'selectors' => [
                    '{{WRAPPER}} .bzotech-navbar-nav .sub-menu' => 'min-width: {{VALUE}};',
                ]
			]
		);
		

        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'panel_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'bw-petito' ),
				'selector' => '{{WRAPPER}} .bzotech-navbar-nav .sub-menu',
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
			'menu_toggle_style_tab',
			[
				'label' => esc_html__( 'Icon menu Style', 'bw-petito' ),
                'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
			'menu_toggle_style_title',
			[
				'label' => esc_html__( 'Icon menu Toggle', 'bw-petito' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'icon_menu_color_css',
			[
				'label' => __( 'Icon Menu Color', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bzotech-menu-toggler i' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'menu_toggle_icon_position',
			[
				'label' => esc_html__( 'Position', 'bw-petito' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Top', 'bw-petito' ),
						'icon' => 'fa fa-angle-left',
					],
					'right' => [
						'title' => esc_html__( 'Middle', 'bw-petito' ),
						'icon' => 'fa fa-angle-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .toggler-icon' => 'float: {{VALUE}}',
                ],
			]
		);

        $this->add_responsive_control(
			'menu_toggle_padding',
			[
				'label' => esc_html__( 'Padding', 'bw-petito' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', ],
				'selectors' => [
					'{{WRAPPER}} .toggler-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->add_responsive_control(
			'menu_toggle_spacing',
			[
				'label' => esc_html__( 'Margin', 'bw-petito' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', ],
				'selectors' => [
					'{{WRAPPER}} .toggler-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->add_responsive_control(
			'menu_toggle_width',
			[
				'label' => esc_html__( 'Width', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 200,
						'step' => 1,
					],
                ],
				'selectors' => [
					'{{WRAPPER}} .toggler-icon' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
        );

        $this->add_responsive_control(
			'menu_toggle_size',
			[
				'label' => esc_html__( 'Size', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 200,
						'step' => 1,
					],
                ],
				'selectors' => [
					'{{WRAPPER}} .toggler-icon .bzotech-menu-toggler' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
        );

        $this->add_responsive_control(
			'menu_toggle_size_height',
			[
				'label' => esc_html__( 'Size height', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 200,
						'step' => 1,
					],
                ],
				'selectors' => [
					'{{WRAPPER}} .toggler-icon .bzotech-menu-toggler' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
        );

        $this->add_responsive_control(
			'menu_toggle_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
                ],
				'tablet_default' => [
					'unit' => 'px',
					'size' => 3,
				],
				'selectors' => [
					'{{WRAPPER}} .toggler-icon' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
        );

        $this->start_controls_tabs(
            'menu_toggle_normal_and_hover_tabs'
        );

        $this->start_controls_tab(
            'menu_toggle_normal',
            [
                'label' => esc_html__( 'Normal', 'bw-petito' ),
            ]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'menu_toggle_background',
				'label' => esc_html__( 'Background', 'bw-petito' ),
				'types' => [ 'classic' ],
				'selector' => '{{WRAPPER}} .toggler-icon',
			]
        );

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'menu_toggle_border',
                'label' => esc_html__( 'Border', 'bw-petito' ),
                'separator' => 'before',
				'selector' => '{{WRAPPER}} .toggler-icon',
			]
        );

        $this->add_control(
			'menu_toggle_icon_color',
			[
				'label' => esc_html__( 'Humber Icon Color', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .toggler-icon .bzotech-menu-toggler span' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .toggler-icon .bzotech-menu-toggler:before' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .toggler-icon .bzotech-menu-toggler:after' => 'background-color: {{VALUE}}',
				],
			]
		);

        $this->end_controls_tab();

        $this->start_controls_tab(
            'menu_toggle_hover',
            [
                'label' => esc_html__( 'Hover', 'bw-petito' ),
            ]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'menu_toggle_background_hover',
				'label' => esc_html__( 'Background', 'bw-petito' ),
				'types' => [ 'classic' ],
				'selector' => '{{WRAPPER}} .toggler-icon:hover',
			]
        );

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'menu_toggle_border_hover',
                'label' => esc_html__( 'Border', 'bw-petito' ),
                'separator' => 'before',
				'selector' => '{{WRAPPER}} .toggler-icon:hover',
			]
        );

        $this->add_control(
			'menu_toggle_icon_color_hover',
			[
				'label' => esc_html__( 'Humber Icon Color', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .toggler-icon .bzotech-menu-toggler:hover span' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .toggler-icon .bzotech-menu-toggler:hover:before' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .toggler-icon .bzotech-menu-toggler:hover:after' => 'background-color: {{VALUE}}',
				],
			]
		);

        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->add_control(
			'menu_close_style_title',
			[
				'label' => esc_html__( 'Close Toggle', 'bw-petito' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_responsive_control(
			'menu_close_spacing',
			[
				'label' => esc_html__( 'Padding', 'bw-petito' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', ],
				'selectors' => [
					'{{WRAPPER}} .close-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->add_responsive_control(
			'menu_close_margin',
			[
				'label' => esc_html__( 'Margin', 'bw-petito' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', ],
				'selectors' => [
					'{{WRAPPER}} .close-menu' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->add_responsive_control(
			'menu_close_width',
			[
				'label' => esc_html__( 'Width', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 45,
						'max' => 100,
						'step' => 1,
					],
                ],
				'selectors' => [
					'{{WRAPPER}} .close-menu' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
        );

        $this->add_responsive_control(
			'menu_close_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
                ],
				'selectors' => [
					'{{WRAPPER}} .close-menu' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
        );

        $this->start_controls_tabs(
            'menu_close_normal_and_hover_tabs'
        );

        $this->start_controls_tab(
            'menu_close_normal',
            [
                'label' => esc_html__( 'Normal', 'bw-petito' ),
            ]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'menu_close_background',
				'label' => esc_html__( 'Background', 'bw-petito' ),
				'types' => [ 'classic' ],
				'selector' => '{{WRAPPER}} .close-menu',
			]
        );

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'menu_close_border',
                'label' => esc_html__( 'Border', 'bw-petito' ),
                'separator' => 'before',
				'selector' => '{{WRAPPER}} .close-menu',
			]
        );

        $this->add_control(
			'menu_close_icon_color',
			[
				'label' => esc_html__( 'Humber Icon Color', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				/*'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
                ],*/
				'selectors' => [
					'{{WRAPPER}} .close-menu .bzotech-menu-toggler span' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .close-menu .bzotech-menu-toggler:before' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .close-menu .bzotech-menu-toggler:after' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();

        $this->start_controls_tab(
            'menu_close_hover',
            [
                'label' => esc_html__( 'Hover', 'bw-petito' ),
            ]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'menu_close_background_hover',
				'label' => esc_html__( 'Background', 'bw-petito' ),
				'types' => [ 'classic' ],
				'selector' => '{{WRAPPER}} .close-menu:hover',
			]
        );

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'menu_close_border_hover',
                'label' => esc_html__( 'Border', 'bw-petito' ),
                'separator' => 'before',
				'selector' => '{{WRAPPER}} .close-menu:hover',
			]
        );

        $this->add_control(
			'menu_close_icon_color_hover',
			[
				'label' => esc_html__( 'Humber Icon Color', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				/*'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
                ],*/
				'selectors' => [
					'{{WRAPPER}} .close-menu .bzotech-menu-toggler:hover span' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .close-menu .bzotech-menu-toggler:hover:before' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .close-menu .bzotech-menu-toggler:hover:after' => 'background-color: {{VALUE}}',
				],
			]
		);

        $this->end_controls_tab();

        $this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'mobile_menu_logo_style_tab',
			[
				'label' => esc_html__( 'Mobile Menu Logo', 'bw-petito' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'mobile_menu_logo_width',
			[
				'label' => esc_html__( 'Width', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 5,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .mobile-logo > img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mobile_menu_logo_height',
			[
				'label' => esc_html__( 'Height', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .mobile-logo > img' => 'max-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mobile_menu_logo_margin',
			[
				'label' => esc_html__( 'Margin', 'bw-petito' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .mobile-logo' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mobile_menu_logo_padding',
			[
				'label' => esc_html__( 'Padding', 'bw-petito' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .mobile-logo' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

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
		$settings = $this->get_settings_for_display();
		$attr = array(
			'wdata'		=> $this,
			'settings'	=> $settings,
		);
		echo bzotech_get_template_widget('menu/menu',$settings['main_menu_style'],$attr);
		
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
}
