<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Bzotech_Banner_Home extends Widget_Base
{

    /**
     * Retrieve the widget name.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'bzotech-banner-home';
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
    public function get_title()
    {
        return esc_html__('Banner Home', 'bw-petito');
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
    public function get_icon()
    {
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
    public function get_categories()
    {
        return ['aqb-htelement-category'];
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
    public function get_script_depends()
    {
        return ['hello-world'];
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
    protected function render()
    {
        $settings = $this->get_settings();

        // echo '<pre>' , var_dump( $settings) , '</pre>';

        $attr = array(
            'wdata'        => $this,
            'settings'    => $settings,
        );
        echo bzotech_get_template_widget('banner-home/banner-home',false, $attr);
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
    protected function content_template()
    {
    }
    protected function register_controls()
    {
        $this->start_controls_section(

            'section_image',
            [
                'label' => esc_html__('Image', 'bw-petito'),
                'tab' => Controls_Manager::TAB_CONTENT,

            ]
        );
        $this->add_control(
            'image',
            [
                'label' => esc_html__('Choose Image', 'bw-petito'),
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
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                'include' => [],
                'default' => 'full',
            ]
        );
        $this->end_controls_section();
        //  Title 
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'bw-petito'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'widget_title_11',
            [
                'label' => esc_html__('Title', 'bw-petito'),
                'type' => \Elementor\Controls_Manager::TEXT,
             
                'placeholder' => esc_html__('Type your title here', 'bw-petito'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );


        $this->add_control(
            'item_description_1',
            [
                'label' => esc_html__('Description', 'bw-petito'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'rows' => 10,
             
                'placeholder' => esc_html__('Type your description here', 'bw-petito'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'button_banner_1',
            [
                'label' => esc_html__('Button title', 'bw-petito'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('', 'bw-petito'),
                'description' => esc_html__('Type your title here', 'bw-petito'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'website_link',
            [
                'label' => esc_html__('Link', 'bw-petito'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'bw-petito'),
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                    // 'custom_attributes' => '',
                ],
                'label_block' => true,
            ]
        );

        $this->end_controls_section();



        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__('Style', 'bw-petito'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        // Width style image 
        $this->add_control(
			'width',
			[
				'label' => esc_html__( 'Width', 'bw-petito' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .image-banner' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        // Color title banner- Style  title
        $this->add_control(
            'text_color_1',
            [
                'label' => esc_html__('Title Color', 'bw-petito'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title-banner-1' => 'color: {{VALUE}}',
                ],
            ]
        );
        //Background-color-1
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background-color-1',
				'label' => esc_html__( 'Background', 'bw-petito' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .title-banner-1',
			]
		);
        //Text Shadow
        $this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow_title',
				'label' => esc_html__( 'Text Shadow', 'bw-petito' ),
				'selector' => '{{WRAPPER}} .title-banner-1',
			]
		);
        //Box Shadow
        $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow_title',
				'label' => esc_html__( 'Box Shadow', 'bw-petito' ),
				'selector' => '{{WRAPPER}} .title-banner-1',
			]
		);
        //
        //Border 
        
        //Border-Radius
        $this->add_control(
			'Border-Radius-1',
			[
				'label' => esc_html__( 'Border Radius', 'bw-petito' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .title-banner-1' => 'Border Radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        //Text-align
        $this->add_control(
			'text_align',
			[
				'label' => esc_html__( 'Alignment All', 'bw-petito' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
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
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .wrapper-banner' => 'text-align: {{VALUE}};',
				],
			]
		);
        //Typography
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography_1',
				'selector' => '{{WRAPPER}} .title-banner-1',
			]
		);
        // Margin Style  title
        $this->add_control(
			'margin_1',
			[
				'label' => esc_html__( 'Margin', 'bw-petito' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .title-banner-1' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
         // Padding Style  Description
         $this->add_control(
			'padding_1',
			[
				'label' => esc_html__( 'Padding', 'bw-petito' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .title-banner-1' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        //Divider
        $this->add_control(
			'hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
         // Color  banner- Style  Description
         $this->add_control(
            'text_color_2',
            [
                'label' => esc_html__('Description Color', 'bw-petito'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .desc-banner-1' => 'color: {{VALUE}}',
                ],
            ]
        );
        //Background-color-2
           $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background-color-2',
				'label' => esc_html__( 'Background', 'bw-petito' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .desc-banner-1',
			]
		);
        //Text Shadow
        $this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow_desc',
				'label' => esc_html__( 'Text Shadow', 'bw-petito' ),
				'selector' => '{{WRAPPER}} .desc-banner-1',
			]
		);
         //Box Shadow
         $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow_desc',
				'label' => esc_html__( 'Box Shadow', 'bw-petito' ),
				'selector' => '{{WRAPPER}} .desc-banner-1',
			]
		);
        //Typography
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography_2',
				'selector' => '{{WRAPPER}} .desc-banner-1',
			]
		);
          // Margin Style  Description
          $this->add_control(
			'margin_2',
			[
				'label' => esc_html__( 'Margin', 'bw-petito' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .desc-banner-1' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        // Padding Style  Description
        $this->add_control(
			'padding_2',
			[
				'label' => esc_html__( 'Padding', 'bw-petito' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .your-class' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
          //Divider
          $this->add_control(
			'hr1',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
        $this->add_control(
			'hr2',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
        // Color  banner- Style  Button
        $this->add_control(
            'text_color_3',
            [
                'label' => esc_html__('Button Color', 'bw-petito'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .button-banner-1' => 'color: {{VALUE}}',
                ],
            ]
        );
         //Background-color-3
         $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background-color-3',
				'label' => esc_html__( 'Background', 'bw-petito' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .button-banner-1',
			]
		);
        //Text Shadow
        $this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow_button',
				'label' => esc_html__( 'Text Shadow', 'bw-petito' ),
				'selector' => '{{WRAPPER}} .button-banner-1',
			]
		);
        //Box Shadow
          $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow_button',
				'label' => esc_html__( 'Box Shadow', 'bw-petito' ),
				'selector' => '{{WRAPPER}} .button-banner-1',
			]
		);
        //Border 
          $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .button-banner-1',
			]
		);
        //Border-Radius
        $this->add_control(
			'Border-Radius-3',
			[
				'label' => esc_html__( 'Border Radius', 'bw-petito' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .button-banner-1' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        //Typography
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography_3',
				'selector' => '{{WRAPPER}} .button-banner-1',
			]
		);
        // Margin Style  button
        $this->add_control(
			'margin_3',
			[
				'label' => esc_html__( 'Margin', 'bw-petito' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .button-banner-1' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
          // Padding Style  Description
          $this->add_control(
			'padding_3',
			[
				'label' => esc_html__( 'Padding', 'bw-petito' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .button-banner-1' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();
        //Style tab
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__('Style Section', 'bw-petito'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        // Nomal typography Hover
        $this->start_controls_tabs(
            'style_tabs'
        );

        $this->start_controls_tab(
            'style_normal_tab',
            [
                'label' => esc_html__('Normal', 'bw-petito'),
            ]
        );

    

        $this->end_controls_tab();
         // Hover typography Hover
        $this->start_controls_tab(
            'style_hover_tab',
            [
                'label' => esc_html__('Hover', 'bw-petito'),
            ]
        );
        $this->add_control(
			'text_color_hover_1',
			[
				'label' => esc_html__( 'Title Color', 'bw-petito' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title-banner-1:hover' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'text_color_hover_2',
			[
				'label' => esc_html__( 'Description Color', 'bw-petito' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .desc-banner-1:hover' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'text_color_hover_3',
			[
				'label' => esc_html__( 'Button Color', 'bw-petito' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .button-banner-1:hover' => 'color: {{VALUE}}',
				],
			]
		);


        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
        // Start tab


        // Select2




    }
    //

}
