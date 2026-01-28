<?php
namespace Elementor;
use WP_Query;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Bzotech_Products extends Widget_Base {

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
		return 'bzotech-products';
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
		return esc_html__( 'Products list', 'bw-petito' );
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
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		if(!class_exists('woocommerce')) return;
		$slider_items_widescreen =$slider_items_laptop = $slider_items_tablet_extra =$slider_items_mobile_extra =$slider_items_mobile =$slider_space_widescreen =$slider_space_laptop =$slider_space_tablet_extra =$slider_space_tablet =$slider_space_mobile_extra= $slider_space_mobile ='';
		$column_widescreen = $column_laptop =$slider_items_tablet =$column_tablet_extra =$column_tablet =$column_mobile_extra =$column_mobile ='';
		$settings = $this->get_settings();
		extract($settings);
		$view = str_replace('elbzotech-product-', '', $display);

		if(isset($_GET['type']) && $_GET['type']) $view = sanitize_text_field($_GET['type']);
        if(isset($_GET['number']) && $_GET['number']) $number = sanitize_text_field($_GET['number']);
		
        if(!empty($css_class)) $el_class .= ' '.$css_class;
        $filter_show = '';
        $el_class = 'product-'.$view.'-view '.$grid_type.' filter-'.$filter_show;

		if(isset($column['size'])) $column = $column['size'];
		if(isset($column_widescreen['size'])) $column_widescreen = $column_widescreen['size'];
		if(isset($column_laptop['size'])) $column_laptop = $column_laptop['size'];
		if(isset($column_tablet_extra['size'])) $column_tablet_extra = $column_tablet_extra['size'];
		if(isset($column_tablet['size'])) $column_tablet = $column_tablet['size'];
		if(isset($column_mobile_extra['size'])) $column_mobile_extra = $column_mobile_extra['size'];
		if(isset($column_mobile['size'])) $column_mobile = $column_mobile['size'];
		if(!empty($column_custom)){
        	$column = $column_tablet = $column_mobile = $column_widescreen= $column_laptop= $column_tablet_extra= $column_mobile_extra='';
        }
		if ( $view == 'grid' ) {
			$this->add_render_attribute( 'elbzotech-item-grid', 'class', 'list-col-item item-grid-product-'.$item_style.' list-'.esc_attr($column).'-item list-'.esc_attr($column_widescreen).'-item-widescreen list-'.esc_attr($column_laptop).'-item-laptop  list-'.esc_attr($column_tablet_extra).'-item-tablet-extra list-'.esc_attr($column_tablet).'-item-tablet list-'.esc_attr($column_mobile_extra).'-item-mobile-extra list-'.esc_attr($column_mobile).'-item-mobile');
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-column-grid',$column_custom);
		}
		$this->add_render_attribute( 'elbzotech-item', 'class', 'item-product');
		if ( $view == 'slider') { 
			$this->add_render_attribute( 'elbzotech-wrapper', 'class', 'elbzotech-swiper-slider swiper-container' );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-items-custom', $slider_items_custom );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-items', $slider_items );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-items-widescreen', $slider_items_widescreen );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-items-laptop', $slider_items_laptop );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-items-tablet-extra', $slider_items_tablet_extra);
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-items-tablet', $slider_items_tablet);
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-items-mobile-extra', $slider_items_mobile_extra);
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-items-mobile', $slider_items_mobile );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-space', $slider_space );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-space-widescreen', $slider_space_widescreen );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-space-laptop', $slider_space_laptop );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-space-tablet-extra', $slider_space_tablet_extra );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-space-tablet', $slider_space_tablet );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-space-mobile-extra', $slider_space_mobile_extra );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-space-mobile', $slider_space_mobile );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-column', $slider_column );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-auto', $slider_auto );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-center', $slider_center );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-loop', $slider_loop );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-speed', $slider_speed );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-navigation', $slider_navigation );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-pagination', $slider_pagination );
			$this->add_render_attribute( 'elbzotech-inner', 'class', 'swiper-wrapper' );
			$this->add_render_attribute( 'elbzotech-item-grid', 'class', 'swiper-slide item-grid-product-'.$item_style);
		}else if ( $view == 'slider-masory') {
			$this->add_render_attribute( 'elbzotech-wrapper', 'class', 'elbzotech-swiper-slider swiper-container' );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-items-custom', $slider_items_custom );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-items', $slider_items );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-items-widescreen', $slider_items_widescreen );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-items-laptop', $slider_items_laptop );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-items-tablet-extra', $slider_items_tablet_extra);
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-items-tablet', $slider_items_tablet);
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-items-mobile-extra', $slider_items_mobile_extra);
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-items-mobile', $slider_items_mobile );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-space', $slider_space );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-space-widescreen', $slider_space_widescreen );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-space-laptop', $slider_space_laptop );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-space-tablet-extra', $slider_space_tablet_extra );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-space-tablet', $slider_space_tablet );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-space-mobile-extra', $slider_space_mobile_extra );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-space-mobile', $slider_space_mobile );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-column', $slider_column );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-auto', $slider_auto );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-center', $slider_center );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-loop', $slider_loop );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-speed', $slider_speed );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-navigation', $slider_navigation );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-pagination', $slider_pagination );
			$this->add_render_attribute( 'elbzotech-inner', 'class', 'swiper-wrapper' );
			if($slider_items_group > 1) 
				$this->add_render_attribute( 'elbzotech-item-grid', 'class', 'width_masory item-grid-product-'.$item_style);
			else
				$this->add_render_attribute( 'elbzotech-item-grid', 'class', 'swiper-slide item-grid-product-'.$item_style);
		}
		else{

			$this->add_render_attribute( 'elbzotech-wrapper', 'class', 'elbzotech-products-wrap js-content-wrap '.$el_class );
			$this->add_render_attribute( 'elbzotech-inner', 'class', 'js-content-main list-product-wrap bzotech-row');
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-column', $column );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-column-tablet', $column_tablet );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-column-mobile', $column_mobile );
		}
        
        $paged = (get_query_var('paged') && $view != 'slider'&& $view != 'slider-masory') ? get_query_var('paged') : 1;
        $args = array(
            'post_type'         => 'product',
            'post_status'    => 'publish',
            'posts_per_page'    => $number,
            'orderby'           => $orderby,
            'order'             => $order,
            'paged'             => $paged,
            );
        if($product_type == 'trending'){
            $args['meta_query'][] = array(
                    'key'     => 'trending_product',
                    'value'   => '1',
                    'compare' => '=',
                );
        }
        if($product_type == 'toprate'){
            $args['meta_key'] = '_wc_average_rating';
            $args['orderby'] = 'meta_value_num';
            $args['meta_query'] = WC()->query->get_meta_query();
            $args['tax_query'][] = WC()->query->get_tax_query();
        }
        if($product_type == 'mostview'){
            $args['meta_key'] = 'post_views';
            $args['orderby'] = 'meta_value_num';
        }
        if($product_type == 'menu_order'){
            $args['meta_key'] = 'menu_order';
            $args['orderby'] = 'meta_value_num';
        }
        if($product_type == 'bestsell'){
            $args['meta_key'] = 'total_sales';
            $args['orderby'] = 'meta_value_num';
        }
        if($product_type=='onsale'){
            $args['meta_query']['relation']= 'OR';
            $args['meta_query'][]=array(
                'key'   => '_sale_price',
                'value' => 0,
                'compare' => '>',                
                'type'          => 'numeric'
            );
            $args['meta_query'][]=array(
                'key'   => '_min_variation_sale_price',
                'value' => 0,
                'compare' => '>',                
                'type'          => 'numeric'
            );
        }
        if($product_type == 'featured'){
            $args['tax_query'][] = array(
                'taxonomy' => 'product_visibility',
                'field'    => 'name',
                'terms'    => 'featured',
                'operator' => 'IN',
            );
        }
        if(!empty($cats)) {
            $custom_list = explode(",",$cats);
            $args['tax_query'][]=array(
                'taxonomy'=>'product_cat',
                'field'=>'slug',
                'terms'=> $custom_list
            );
        }
        if(!empty($custom_ids)){
            $args['post__in'] = explode(',', $custom_ids);
        }
        $args['tax_query'][] = array(
            'taxonomy' => 'product_visibility',
            'field'    => 'name',
            'terms'    => 'exclude-from-catalog',
            'operator' => 'NOT IN',
        );
        $product_query = new WP_Query($args);
        $count = 1;
        $count_query = $product_query->post_count;
        $max_page = $product_query->max_num_pages;
        $size = $thumbnail_size;

        if($size == 'custom' && !empty($thumbnail_custom_dimension['width']) && !empty($thumbnail_custom_dimension['height']))
        	$size = array($thumbnail_custom_dimension['width'],$thumbnail_custom_dimension['height']);
        
        if($grid_type == 'grid-masonry' and !empty($size_masonry)){
			$size = bzotech_get_size_crop($size_masonry);
        }

        $size_list = $thumbnail_list_size;
        if($size_list == 'custom' && !empty($thumbnail_list_custom_dimension['width']) && !empty($thumbnail_list_custom_dimension['height'])) $size_list = array($thumbnail_list_custom_dimension['width'],$thumbnail_list_custom_dimension['height']);
       


        $item_wrap = $this->get_render_attribute_string( 'elbzotech-item-grid' );
        $item_inner = $this->get_render_attribute_string( 'elbzotech-item' );
        $attr = array(
            'el_class'      => $el_class,
            'product_query' => $product_query,
            'count'         => $count,
            'count_query'   => $count_query,
            'max_page'      => $max_page,
            'args'          => $args,
            'column'        => $column,
            'view'       	=> $view,
            'settings'      => $settings,
            'size'      	=> $size,
            'item_wrap'		=> $item_wrap,
            'item_inner'	=> $item_inner,
            'wdata'			=> $this,
        );
        if($display_tab == 'yes' && is_array($tabs) && count($tabs) >=1){
        	$tab_title_html = $tab_content_html = '';
			$html_title='';
			if($tab_style=='style3') {
				if(!empty($block_sub_title) || !empty($block_title)) {
				$html_title.='<div class="block-title-wapper">';
				if(!empty($block_sub_title)) {
					$html_title.='<span class="block-sub-title">'.$block_sub_title.'</span>';
				}
				if(!empty($block_title)) {
					$html_title.='<span class="block-title">'.$block_title.'</span>';
				}
				$html_title.='</div>';
				}
			}
        	foreach ($tabs as $key => $tab) {
        		extract($tab);
        		if($key == 0) $active = 'active';
        		else $active = '';
        		$args = array(
		            'post_type'         => 'product',
		            'post_status'    => 'publish',
		            'posts_per_page'    => $number,
		            'orderby'           => $orderby,
		            'order'             => $order,
		            'paged'             => $paged,
		            );
		        if($product_type == 'trending'){
		            $args['meta_query'][] = array(
		                    'key'     => 'trending_product',
		                    'value'   => '1',
		                    'compare' => '=',
		                );
		        }
		        if($product_type == 'toprate'){
		            $args['meta_key'] = '_wc_average_rating';
		            $args['orderby'] = 'meta_value_num';
		            $args['meta_query'] = WC()->query->get_meta_query();
		            $args['tax_query'][] = WC()->query->get_tax_query();
		        }
		        if($product_type == 'mostview'){
		            $args['meta_key'] = 'post_views';
		            $args['orderby'] = 'meta_value_num';
		        }
		        if($product_type == 'menu_order'){
		            $args['meta_key'] = 'menu_order';
		            $args['orderby'] = 'meta_value_num';
		        }
		        if($product_type == 'bestsell'){
		            $args['meta_key'] = 'total_sales';
		            $args['orderby'] = 'meta_value_num';
		        }
		        if($product_type=='onsale'){
		            $args['meta_query']['relation']= 'OR';
		            $args['meta_query'][]=array(
		                'key'   => '_sale_price',
		                'value' => 0,
		                'compare' => '>',                
		                'type'          => 'numeric'
		            );
		            $args['meta_query'][]=array(
		                'key'   => '_min_variation_sale_price',
		                'value' => 0,
		                'compare' => '>',                
		                'type'          => 'numeric'
		            );
		        }
		        if($product_type == 'featured'){
		            $args['tax_query'][] = array(
		                'taxonomy' => 'product_visibility',
		                'field'    => 'name',
		                'terms'    => 'featured',
		                'operator' => 'IN',
		            );
		        }
		        if(!empty($cats)) {
		            $custom_list = explode(",",$cats);
		            $args['tax_query'][]=array(
		                'taxonomy'=>'product_cat',
		                'field'=>'slug',
		                'terms'=> $custom_list
		            );
		        }
		        if(!empty($custom_ids)){
		            $args['post__in'] = explode(',', $custom_ids);
		         }
		        $args['tax_query'][] = array(
		            'taxonomy' => 'product_visibility',
		            'field'    => 'name',
		            'terms'    => 'exclude-from-catalog',
		            'operator' => 'NOT IN',
		        );
				// echo '<pre>';
				// var_dump($args);
		        $attr['args'] = $args;
		        $product_query = new WP_Query($args);
		        $count = 1;
		        $count_query = $product_query->post_count;
		        $max_page = $product_query->max_num_pages;
		        $attr['product_query'] = $product_query;
		        $attr['count'] = $count;
		        $attr['count_query'] = $count_query;
		        $attr['max_page'] = $max_page;
		        
        		$tab_title_html .= 	'<li class="tab-item-wrap '.$active.'">
        								<a href="#'.$_id.'" data-target="#'.$_id.'" data-toggle="tab" aria-expanded="false">';
        		if($icon_pos != 'after-text' && $icon) {
					if($icon['library']=='svg') {
						$tab_title_html .= '<img src="'.$icon['value']['url'].'">';
						if(!empty($hover_icon) && $hover_icon['library']=='svg')
							$tab_title_html .= '<img class="img-hover before" src="'.$hover_icon['value']['url'].'">';
					}else {
						$tab_title_html .= '<i class="'.$icon['value'].'"></i>';
						if(!empty($hover_icon) && $hover_icon['library']!='svg')
							$tab_title_html .= '<i class="img-hover before'.$hover_icon['value'].'"></i>';
					}
				}
        		$tab_title_html .=		$title;
        		if($icon_pos == 'after-text' && $icon) {
					if($icon['library']=='svg') {
						$tab_title_html .= '<img src="'.$icon['value']['url'].'">';
						if(!empty($hover_icon) && $hover_icon['library']=='svg')
							$tab_title_html .= '<img class="img-hover after" src="'.$hover_icon['value']['url'].'">';
					}
					else {
						$tab_title_html .= '<i class="'.$icon['value'].'"></i>';
						if(!empty($hover_icon) && $hover_icon['library']!='svg')
							$tab_title_html .= '<i class="img-hover after'.$hover_icon['value'].'"></i>';
					}
				}
        		$tab_title_html .=		'</a>
        							</li>';

        		$tab_content_html .= '<div id="'.$_id.'" class="tab-pane '.$active.'">';
        		$tab_content_html .= bzotech_get_template_widget('products/shop',$view,$attr,false);
        		$tab_content_html .= '</div>';        		
        	}
        	echo 	'<div class="product-tab-wrap tab-style-'.$tab_style.'">
        				<div class="product-tab-title">
							'.$html_title.'
							<div class="tabs-drop-mobile"></div>
							<ul class="list-none nav nav-tabs" role="tablist">
								'.$tab_title_html.'
							</ul>
						</div>
						<div class="product-tab-content">
							<div class="tab-content">
								'.$tab_content_html.'
							</div>
						</div>
					</div>';
        }
        else bzotech_get_template_widget('products/shop',$view,$attr,true);
        wp_reset_postdata();
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
		// BEGIN TAB_CONTENT
		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Layout', 'bw-petito' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'display',
			[
				'label' 	=> esc_html__( 'Display type (Layout)', 'bw-petito' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'elbzotech-product-grid',
				'options'   => [
					'elbzotech-product-grid'		=> esc_html__( 'Grid', 'bw-petito' ),
					'elbzotech-product-list'		=> esc_html__( 'List', 'bw-petito' ),
					'elbzotech-product-slider'		=> esc_html__( 'Slider', 'bw-petito' ),/*
					'elbzotech-product-grid-masory'		=> esc_html__( 'Grid Masory', 'bw-petito' ),
					'elbzotech-product-slider-masory'		=> esc_html__( 'Slider Masory', 'bw-petito' ),*/
				],
			]
		);

		$this->add_control(
			'item_style',
			[
				'label' 	=> esc_html__( 'Item Grid Style', 'bw-petito' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''		=> esc_html__( 'Style 1 - default', 'bw-petito' ),
					'style2'		=> esc_html__( 'Style 2', 'bw-petito' ),
					'style3'		=> esc_html__( 'Style 3', 'bw-petito' ),
					'style4'		=> esc_html__( 'Style 4 - demo 4', 'bw-petito' ),
					'style5'		=> esc_html__( 'Style 5 - demo 4', 'bw-petito' ),
					'style6'		=> esc_html__( 'Style 6 - demo 5', 'bw-petito' ),
					'style7'		=> esc_html__( 'Style 7 - demo 6', 'bw-petito' )
				],
			]
		);

		

		$this->add_control(
			'display_tab',
			[
				'label' => esc_html__( 'Display tab', 'bw-petito' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'bw-petito' ),
				'label_off' => esc_html__( 'Off', 'bw-petito' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
			'item_thumbnail',
			[
				'label' => esc_html__( 'Thumbnail', 'bw-petito' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'bw-petito' ),
				'label_off' => esc_html__( 'Off', 'bw-petito' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'item_title',
			[
				'label' => esc_html__( 'Title', 'bw-petito' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'bw-petito' ),
				'label_off' => esc_html__( 'Off', 'bw-petito' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'item_quickview',
			[
				'label' => esc_html__( 'Quick View', 'bw-petito' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'bw-petito' ),
				'label_off' => esc_html__( 'Off', 'bw-petito' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
			'item_label',
			[
				'label' => esc_html__( 'Label', 'bw-petito' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'bw-petito' ),
				'label_off' => esc_html__( 'Off', 'bw-petito' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
			'item_price',
			[
				'label' => esc_html__( 'Price', 'bw-petito' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'bw-petito' ),
				'label_off' => esc_html__( 'Off', 'bw-petito' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'item_rate',
			[
				'label' => esc_html__( 'Rate', 'bw-petito' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'bw-petito' ),
				'label_off' => esc_html__( 'Off', 'bw-petito' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'item_button',
			[
				'label' => esc_html__( 'Button', 'bw-petito' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'bw-petito' ),
				'label_off' => esc_html__( 'Off', 'bw-petito' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'item_excerpt',
			[
				'label' => esc_html__( 'Excerpt', 'bw-petito' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'bw-petito' ),
				'label_off' => esc_html__( 'Off', 'bw-petito' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);
		$this->add_control(
			'excerpt',
			[
				'label' => esc_html__( 'Number of text for excerpt', 'bw-petito' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 999,
				'step' => 1,
				'default' => 80,
				'condition' => [
					'item_excerpt' => 'yes',
				]
			]
		);

		$this->add_control(
			'item_countdown',
			[
				'label' => esc_html__( 'Countdown', 'bw-petito' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'bw-petito' ),
				'label_off' => esc_html__( 'Off', 'bw-petito' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'item_brand',
			[
				'label' => esc_html__( 'Brand', 'bw-petito' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'bw-petito' ),
				'label_off' => esc_html__( 'Off', 'bw-petito' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_posts',
			[
				'label' => esc_html__( 'Query', 'bw-petito' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'number',
			[
				'label' => esc_html__( 'Number', 'bw-petito' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 1000,
				'step' => 1,
			]
		);

		$this->add_control(
			'orderby',
			[
				'label' 	=> esc_html__( 'Order by', 'bw-petito' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''		=> esc_html__( 'None', 'bw-petito' ),
					'ID'		=> esc_html__( 'ID', 'bw-petito' ),
					'author'	=> esc_html__( 'Author', 'bw-petito' ),
					'title'		=> esc_html__( 'Title', 'bw-petito' ),
					'name'		=> esc_html__( 'Name', 'bw-petito' ),
					'date'		=> esc_html__( 'Date', 'bw-petito' ),
					'modified'		=> esc_html__( 'Last Modified Date', 'bw-petito' ),
					'parent'		=> esc_html__( 'Parent', 'bw-petito' ),
					'post_views'		=> esc_html__( 'Post views', 'bw-petito' ),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label' 	=> esc_html__( 'Order', 'bw-petito' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'DESC',
				'options'   => [
					'DESC'		=> esc_html__( 'DESC', 'bw-petito' ),
					'ASC'		=> esc_html__( 'ASC', 'bw-petito' ),
				],
			]
		);

		$this->add_control(
			'product_type',
			[
				'label' 	=> esc_html__( 'Product type', 'bw-petito' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					'' 				=> esc_html__('Default','bw-petito'),
                    'trending' 		=> esc_html__('Trending','bw-petito'),
                    'featured' 		=> esc_html__('Featured Products','bw-petito'),
                    'bestsell' 		=> esc_html__('Best Sellers','bw-petito'),
                    'onsale' 		=> esc_html__('On Sale','bw-petito'),
                    'toprate' 		=> esc_html__('Top rate','bw-petito'),
                    'mostview' 		=> esc_html__('Most view','bw-petito'),
                    'menu_order' 	=> esc_html__('Menu order','bw-petito'),
				],
			]
		);

		$this->add_control(
			'custom_ids', 
			[
				'label' => esc_html__( 'Show by IDs', 'bw-petito' ),
				'description' => esc_html__( 'Enter IDs list. The values separated by ",". Example 11,12', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( '11,12', 'bw-petito' ),
			]
		);

		$this->add_control(
			'cats', 
			[
				'label' => esc_html__( 'Categories', 'bw-petito' ),
				'description' => esc_html__( 'Enter slug categories. The values separated by ",". Example cat-1,cat-2. Default will show all categories', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'cat-1,cat-2', 'bw-petito' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_list_setting',
			[
				'label' => esc_html__( 'List setting', 'bw-petito' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'display' => ['elbzotech-product-grid','elbzotech-product-list'],
				]
			]
		);
		$this->add_control(
			'item_list_style',
			[
				'label' 	=> esc_html__( 'Item List Style', 'bw-petito' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''		=> esc_html__( 'Style 1 - default', 'bw-petito' ),
				],
			]
		);
		$this->add_control(
			'excerpt_list',
			[
				'label' => esc_html__( 'Excerpt list', 'bw-petito' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 1000,
				'step' => 1,
			]
		);

		$this->add_responsive_control(
			'item_list_thumb_width',
			[
				'label' => esc_html__( 'Thumbnail Width', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' , 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 0.01,
					],
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .list-thumb-wrap' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .list-info-wrap' => 'width: calc(100% - {{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail_list', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default' => 'custom',
				'separator' => 'none',
			]
		);
		
		$this->end_controls_section();

		$this->start_controls_section(
			'section_grid',
			[
				'label' => esc_html__( 'Grid Setting', 'bw-petito' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'display' => ['elbzotech-product-grid','elbzotech-product-list'],
				]
			]
		);

		$this->add_responsive_control(
			'column',
			[
				'label' => esc_html__( 'Column', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 8,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 3,
				],
				'condition' => [
					'column_custom' => '',
				]
			]
		); 
		$this->add_control(
			'column_custom',
			[
				'label' => esc_html__( 'Column custom by display', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'description'	=> esc_html__( 'Enter item for screen width(px) format is width:value and separate values by ",". Example is 0:1,375:2,991:3,1170:4', 'bw-petito' ),
				'default' => '',
				
			]
		);
		$this->add_control(
			'grid_type',
			[
				'label' 	=> esc_html__( 'Grid type', 'bw-petito' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''				=> esc_html__( 'Default', 'bw-petito' ),
					'grid-masonry'	=> esc_html__( 'Masonry', 'bw-petito' ),
				],
			]
		);

		$this->add_control(
			'pagination',
			[
				'label' 	=> esc_html__( 'Grid pagination', 'bw-petito' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''				=> esc_html__( 'None', 'bw-petito' ),
					'pagination'	=> esc_html__( 'Pagination', 'bw-petito' ),
					'load-more'		=> esc_html__( 'Load more', 'bw-petito' ),
				],
			]
		);

		$this->end_controls_section();

		$this->get_slider_settings();
		//$this->get_slider_masory_settings();
		$this->start_controls_section(
			'section_top_filter',
			[
				'label' => esc_html__( 'Top filter', 'bw-petito' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'display' => ['elbzotech-product-list', 'elbzotech-product-grid'],
				]
			]
		);

		$this->add_control(
			'show_top_filter',
			[
				'label' => esc_html__( 'Status', 'bw-petito' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'bw-petito' ),
				'label_off' => esc_html__( 'Off', 'bw-petito' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'show_type',
			[
				'label' => esc_html__( 'Type', 'bw-petito' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'bw-petito' ),
				'label_off' => esc_html__( 'Off', 'bw-petito' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'show_top_filter' => 'yes',
				]
			]
		);
		$this->add_control(
			'show_number',
			[
				'label' => esc_html__( 'Number', 'bw-petito' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'bw-petito' ),
				'label_off' => esc_html__( 'Off', 'bw-petito' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'show_top_filter' => 'yes',
				]
			]
		);

		$this->add_control(
			'show_order',
			[
				'label' => esc_html__( 'Order', 'bw-petito' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'bw-petito' ),
				'label_off' => esc_html__( 'Off', 'bw-petito' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'show_top_filter' => 'yes',
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_filter',
			[
				'label' => esc_html__( 'Filter Button', 'bw-petito' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'filter_show',
			[
				'label' => esc_html__( 'Status', 'bw-petito' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'bw-petito' ),
				'label_off' => esc_html__( 'Off', 'bw-petito' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
			'filter_style',
			[
				'label' 	=> esc_html__( 'Style', 'bw-petito' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''					=> esc_html__( 'Style 1', 'bw-petito' ),
					'filter-col'		=> esc_html__( 'Style 2', 'bw-petito' ),
					'filter-col filter-col-list'	=> esc_html__( 'Style 3', 'bw-petito' ),
				],
				'condition' => [
					'filter_show' => 'yes',
				]
			]
		);

		$this->add_control(
			'filter_column',
			[
				'label' 	=> esc_html__( 'Column', 'bw-petito' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'filter-4-col',
				'options'   => [
					'filter-2-col'				=> esc_html__( '2 Column', 'bw-petito' ),
					'filter-3-col'				=> esc_html__( '3 Column', 'bw-petito' ),
					'filter-4-col'				=> esc_html__( '4 Column', 'bw-petito' ),
				],
				'condition' => [
					'filter_show' => 'yes',
					'filter_style' => ['filter-col','filter-col filter-col-list'],
				]
			]
		);

		$this->add_control(
			'filter_cats', 
			[
				'label' => esc_html__( 'Categories', 'bw-petito' ),
				'description' => esc_html__( 'Enter slug categories. The values separated by ",". Example cat-1,cat-2', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'cat-1,cat-2', 'bw-petito' ),
				'condition' => [
					'filter_show' => 'yes',
				]
			]
		);

		$this->add_control(
			'filter_price',
			[
				'label' => esc_html__( 'Price', 'bw-petito' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'bw-petito' ),
				'label_off' => esc_html__( 'Off', 'bw-petito' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'filter_show' => 'yes',
				]
			]
		);

		$this->add_control(
			'filter_attr', 
			[
				'label' => esc_html__( 'Attributes', 'bw-petito' ),
				'description' => esc_html__( 'Enter slug attributes. The values separated by ",". Example attribute-1,attribute-2', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'cat-1,cat-2', 'bw-petito' ),
				'condition' => [
					'filter_show' => 'yes',
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_tab',
			[
				'label' => esc_html__( 'Tab', 'bw-petito' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'display_tab' => 'yes',
				]
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'title', [
				'label' => esc_html__( 'Title', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Tab Title' , 'bw-petito' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'bw-petito' ),
				'type' => Controls_Manager::ICONS,
			]
		);
		$repeater->add_control(
			'hover_icon',
			[
				'label' => esc_html__( 'Hover Icon', 'bw-petito' ),
				'type' => Controls_Manager::ICONS,
			]
		);
		$repeater->add_control(
			'icon_pos',
			[
				'label' => esc_html__( 'Icon position', 'bw-petito' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'after-icon',
				'options' => [
					'after-text'   => esc_html__( 'After text', 'bw-petito' ),
					'before-text'  => esc_html__( 'Before text', 'bw-petito' ),
				],
			]
		);

		$repeater->add_control(
			'number',
			[
				'label' => esc_html__( 'Number', 'bw-petito' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 1000,
				'step' => 1,
			]
		);

		$repeater->add_control(
			'orderby',
			[
				'label' 	=> esc_html__( 'Order by', 'bw-petito' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''		=> esc_html__( 'None', 'bw-petito' ),
					'ID'		=> esc_html__( 'ID', 'bw-petito' ),
					'author'	=> esc_html__( 'Author', 'bw-petito' ),
					'title'		=> esc_html__( 'Title', 'bw-petito' ),
					'name'		=> esc_html__( 'Name', 'bw-petito' ),
					'date'		=> esc_html__( 'Date', 'bw-petito' ),
					'modified'		=> esc_html__( 'Last Modified Date', 'bw-petito' ),
					'parent'		=> esc_html__( 'Parent', 'bw-petito' ),
					'post_views'		=> esc_html__( 'Post views', 'bw-petito' ),
				],
			]
		);

		$repeater->add_control(
			'order',
			[
				'label' 	=> esc_html__( 'Order', 'bw-petito' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'DESC',
				'options'   => [
					'DESC'		=> esc_html__( 'DESC', 'bw-petito' ),
					'ASC'		=> esc_html__( 'ASC', 'bw-petito' ),
				],
			]
		);

		$repeater->add_control(
			'product_type',
			[
				'label' 	=> esc_html__( 'Product type', 'bw-petito' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'DESC',
				'options'   => [
					'' 				=> esc_html__('Default','bw-petito'),
                    'trending' 		=> esc_html__('Trending','bw-petito'),
                    'featured' 		=> esc_html__('Featured Products','bw-petito'),
                    'bestsell' 		=> esc_html__('Best Sellers','bw-petito'),
                    'onsale' 		=> esc_html__('On Sale','bw-petito'),
                    'toprate' 		=> esc_html__('Top rate','bw-petito'),
                    'mostview' 		=> esc_html__('Most view','bw-petito'),
                    'menu_order' 	=> esc_html__('Menu order','bw-petito'),
				],
			]
		);

		$repeater->add_control(
			'custom_ids', 
			[
				'label' => esc_html__( 'Show by IDs', 'bw-petito' ),
				'description' => esc_html__( 'Enter IDs list. The values separated by ",". Example 11,12', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( '11,12', 'bw-petito' ),
			]
		);

		$repeater->add_control(
			'cats', 
			[
				'label' => esc_html__( 'Categories', 'bw-petito' ),
				'description' => esc_html__( 'Enter slug categories. The values separated by ",". Example cat-1,cat-2. Default will show all categories', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'cat-1,cat-2', 'bw-petito' ),
			]
		);

		$this->add_control(
			'tabs',
			[
				'label' => esc_html__( 'Add tab', 'bw-petito' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty'=>false,
				'fields' => $repeater->get_controls(),
				'default' => [],
				'title_field' => '{{{ title }}}',
			]
		);
		$this->add_control(
			'tab_style',
			[
				'label' 	=> esc_html__( 'Tab Style', 'bw-petito' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''		=> esc_html__( 'Style 1 - default', 'bw-petito' ),
					'style2'		=> esc_html__( 'Style 2 (Vertical)', 'bw-petito' ),
					'style3' => esc_html__( 'Style 3 (Vertical)-home 6', 'bw-petito' ),
				],
			]
		);
		$this->add_control(
			'block_title', [
				'label' => esc_html__( 'Block Title', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Block Title' , 'bw-petito' ),
				'condition' => [
					'tab_style' => 'style3',
				]
			]
		);
		$this->add_control(
			'block_sub_title', [
				'label' => esc_html__( 'Block Sub Title', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Block Sub Title' , 'bw-petito' ),
				'condition' => [
					'tab_style' => 'style3',
				]
			]
		);

		$this->end_controls_section();
		// END TAB_CONTENT

		// BEGIN TAB_STYLE

		$this->start_controls_section(
			'section_style_item',
			[
				'label' => esc_html__( 'Item', 'bw-petito' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'item_width',
			[
				'label' => esc_html__( 'Width', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' , 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 0.01,
					],
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .product-slider-view .item-product' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .product-grid-view .list-col-item' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->get_box_settings('item','item-product');

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_thumbnail',
			[
				'label' => esc_html__( 'Thumbnail', 'bw-petito' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default' => 'custom',
				'separator' => 'none',
				'condition' => [
					'item_thumbnail' => 'yes',
					'grid_type!' => 'grid-masonry',
				]
			]
		);
		$this->add_control(
			'size_masonry',
			[
				'label' => esc_html__( 'Random image size', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'description' => esc_html__( 'Random image size mansory type (EX: 300x350,300x300,300x250)', 'bw-petito' ),
				'condition' => [
					'grid_type' => 'grid-masonry',
					'item_thumbnail' => 'yes',
				]
			]
		);
		$this->add_control(
			'size_random_img',
			[
				'label' => esc_html__( 'Random image size', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'description' => esc_html__( 'Random image size mansory type (EX: 300x350,300x300,300x250)', 'bw-petito' ),
				
			]
		);
		$this->get_thumb_styles('thumbnail','product-thumb');

		$this->get_box_image('thumbnail','product-thumb');

		$this->end_controls_section();

		$this->get_slider_styles();

		$this->start_controls_section(
			'section_style_info',
			[
				'label' => esc_html__( 'Info', 'bw-petito' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'info_align',
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
					'{{WRAPPER}} .product-info' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->get_box_settings_info('info','product-info');

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_title',
			[
				'label' => esc_html__( 'Title', 'bw-petito' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->get_text_styles('title','product-info .product-title a.color-title');

		$this->add_responsive_control(
			'title_space',
			[
				'label' => esc_html__( 'Space', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -300,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .product-info .product-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_price',
			[
				'label' => esc_html__( 'Price', 'bw-petito' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'price_regular',
			[
				'label' => esc_html__( 'Regular', 'bw-petito' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'none',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'regular_typography',
				'selectors' => [
					'{{WRAPPER}} .product-price > span',
					'{{WRAPPER}} .product-price ins',
				]
			]
		);

		$this->add_control(
			'regular_color',
			[
				'label' => esc_html__( 'Color', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product-price > span' => 'color: {{VALUE}};',
					'{{WRAPPER}} .product-price ins' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'price_sale',
			[
				'label' => esc_html__( 'Sale', 'bw-petito' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'sale_typography',
				'selectors' => [
					'{{WRAPPER}} .product-price > del',
				]
			]
		);

		$this->add_control(
			'sale_color',
			[
				'label' => esc_html__( 'Color', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product-price > del' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'separator_price',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->add_responsive_control(
			'price_space',
			[
				'label' => esc_html__( 'Space', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -300,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .product-info .product-price' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_button',
			[
				'label' => esc_html__( 'Button', 'bw-petito' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'item_button' => 'yes',
				]
			]
		);

		$this->get_button_styles('button','addcart-link');

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_tab',
			[
				'label' => esc_html__( 'Tab', 'bw-petito' ),
				'tab'   => Controls_Manager::TAB_STYLE,
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
					'{{WRAPPER}} .nav-tabs' => 'text-align: {{VALUE}};',
				],
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


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'tab_typography',
				'selector' => '{{WRAPPER}} .nav-tabs > li > a',
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
			]
		);

		$this->add_responsive_control(
			'tab_spacing',
			[
				'label' => esc_html__( 'Space', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .product-tab-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'tab_icon_spacing_left',
			[
				'label' => esc_html__( 'Icon Space left', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs > li > a i' => 'margin-left: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'tab_icon_spacing_right',
			[
				'label' => esc_html__( 'Icon Space right', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs > li > a i' => 'margin-right: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->start_controls_tabs( 'tab_effects' );

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

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'tab_background_hover',
				'label' => esc_html__( 'Background', 'bw-petito' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .nav-tabs > li > a:hover',
			]
		);

		$this->add_responsive_control(
			'tab_padding_hover',
			[
				'label' => esc_html__( 'Padding', 'bw-petito' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
					'{{WRAPPER}} .nav-tabs > li > a:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'tab_background_active',
				'label' => esc_html__( 'Background', 'bw-petito' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .nav-tabs > li.active > a',
			]
		);

		$this->add_responsive_control(
			'tab_padding_active',
			[
				'label' => esc_html__( 'Padding', 'bw-petito' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
					'{{WRAPPER}} .nav-tabs > li.active > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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

		// END TAB_STYLE
	}

	public function get_button_styles($key='button', $class="btn-class") {

		$this->add_control(
			$key.'_text', 
			[
				'label' => esc_html__( 'Text', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'label_block' => true,
			]
		);

		$this->add_responsive_control(
			$key.'_align',
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
					'{{WRAPPER}} .'.$class.'-wrap' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => $key.'_typography',
				'selector' => '{{WRAPPER}} .'.$class,
			]
		);

		$this->add_control(
			$key.'_icon',
			[
				'label' => esc_html__( 'Icon', 'bw-petito' ),
				'type' => Controls_Manager::ICONS,
			]
		);

		$this->add_responsive_control(
			$key.'_size_icon',
			[
				'label' => esc_html__( 'Size icon', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$class.' i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			$key.'_icon_pos',
			[
				'label' => esc_html__( 'Icon position', 'bw-petito' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'after-icon',
				'options' => [
					'after-text'   => esc_html__( 'After text', 'bw-petito' ),
					'before-text'  => esc_html__( 'Before text', 'bw-petito' ),
				],
				'condition' => [
					$key.'_text!' => '',
					$key.'_icon[value]!' => '',
				]
			]
		);

		$this->add_responsive_control(
			$key.'_spacing',
			[
				'label' => esc_html__( 'Space', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .'.$class.'-wrap' => 'margin-top: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			$key.'_icon_spacing_left',
			[
				'label' => esc_html__( 'Icon Space left', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .'.$class.' i' => 'margin-left: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			$key.'_icon_spacing_right',
			[
				'label' => esc_html__( 'Icon Space right', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .'.$class.' i' => 'margin-right: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->start_controls_tabs( $key.'_effects' );

		$this->start_controls_tab( $key.'_normal',
			[
				'label' => esc_html__( 'Normal', 'bw-petito' ),
			]
		);

		$this->add_control(
			$key.'_color',
			[
				'label' => esc_html__( 'Color', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$class => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => $key.'_background',
				'label' => esc_html__( 'Background', 'bw-petito' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .'.$class,
			]
		);

		$this->add_responsive_control(
			$key.'_padding',
			[
				'label' => esc_html__( 'Padding', 'bw-petito' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .'.$class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => $key.'_shadow',
				'selector' => '{{WRAPPER}} .'.$class,
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( $key.'_hover',
			[
				'label' => esc_html__( 'Hover', 'bw-petito' ),
			]
		);

		$this->add_control(
			$key.'_color_hover',
			[
				'label' => esc_html__( 'Color', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$class.':hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => $key.'_background_hover',
				'label' => esc_html__( 'Background', 'bw-petito' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .'.$class.':hover',
			]
		);

		$this->add_responsive_control(
			$key.'_padding_hover',
			[
				'label' => esc_html__( 'Padding', 'bw-petito' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .'.$class.':hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => $key.'_shadow_hover',
				'selector' => '{{WRAPPER}} .'.$class.':hover',
			]
		);

		$this->add_control(
			$key.'_hover_transition',
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
					'{{WRAPPER}} .'.$class => 'transition-duration: {{SIZE}}s',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
	}
	
	public function get_text_styles($key='text', $class="text-class") {
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => $key.'_typography',
				'selector' => '{{WRAPPER}} .'.$class,
			]
		);

		$this->start_controls_tabs( $key.'_effects' );

		$this->start_controls_tab( $key.'_normal',
			[
				'label' => esc_html__( 'Normal', 'bw-petito' ),
			]
		);

		$this->add_control(
			$key.'_color',
			[
				'label' => esc_html__( 'Color', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$class => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => $key.'_shadow',
				'selector' => '{{WRAPPER}} .'.$class,
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( $key.'_hover',
			[
				'label' => esc_html__( 'Hover', 'bw-petito' ),
			]
		);

		$this->add_control(
			$key.'_color_hover',
			[
				'label' => esc_html__( 'Color', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$class.':hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => $key.'_shadow_hover',
				'selector' => '{{WRAPPER}} .'.$class.':hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
	}

	public function get_thumb_styles($key='thumb', $class="thumb-image") {
		$this->start_controls_tabs( $key.'_effects' );

		$this->start_controls_tab( 'normal',
			[
				'label' => esc_html__( 'Normal', 'bw-petito' ),
			]
		);

		$this->add_control(
			$key.'_opacity',
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
				'name' => $key.'_css_filters',
				'selector' => '{{WRAPPER}} .'.$class.' img',
			]
		);

		$this->add_control(
			$key.'_overlay',
			[
				'label' => esc_html__( 'Overlay', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$class.' .product-thumb-link:before' => 'background-color: {{VALUE}}; opacity: 1; visibility: visible;',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'hover',
			[
				'label' => esc_html__( 'Hover', 'bw-petito' ),
			]
		);

		$this->add_control(
			$key.'_opacity_hover',
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
					'{{WRAPPER}} .'.$class.':hover img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => $key.'_css_filters_hover',
				'selector' => '{{WRAPPER}} .'.$class.':hover img',
			]
		);

		$this->add_control(
			$key.'_overlay_hover',
			[
				'label' => esc_html__( 'Overlay', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$class.':hover .product-thumb-link:before' => 'background-color: {{VALUE}}; opacity: 1; visibility: visible;',
				],
			]
		);

		$this->add_control(
			$key.'_background_hover_transition',
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
					'{{WRAPPER}} .'.$class.' img' => 'transition-duration: {{SIZE}}s',
					'{{WRAPPER}} .'.$class.' .product-thumb-link::after' => 'transition-duration: {{SIZE}}s',
					'{{WRAPPER}} .'.$class.' .product-thumb-link' => 'transition-duration: {{SIZE}}s',
				],
			]
		);

		$this->add_control(
			$key.'_hover_animation',
			[
				'label' 	=> esc_html__( 'Hover Animation', 'bw-petito' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'elbzotech-post-grid',
				'options'   => [
					''					=> esc_html__( 'None', 'bw-petito' ),
					'zoom-thumb'		=> esc_html__( 'Zoom', 'bw-petito' ),
					'rotate-thumb'		=> esc_html__( 'Rotate', 'bw-petito' ),
					'zoomout-thumb'		=> esc_html__( 'Zoom Out', 'bw-petito'),
					'translate-thumb'	=> esc_html__( 'Translate', 'bw-petito'),
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
	}
	public function get_slider_masory_settings() {
		$this->start_controls_section(
			'section_slider_masory',
			[
				'label' => esc_html__( 'Masory settings', 'bw-petito' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				
			]
		);

		$this->add_control(
			'slider_items_group',
			[
				'label' => esc_html__( 'Group item products', 'bw-petito' ),
				'type' => Controls_Manager::NUMBER,
				'description'	=> esc_html__( 'Group the number of products into 1  item of slider', 'bw-petito' ),
				'min' => 1,
				'max' => 20,
				'step' => 1,
				'default' => 1,
				'condition' => [
					'display' => ['elbzotech-product-slider-masory'],
				]
			]
		);
		$this->add_control(
			'column_custom_masory',
			[
				'label' => esc_html__( 'Column custom by display', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'description'	=> esc_html__( 'Enter item for screen width(px) format is width:value and separate values by ",". Example is 0:1,375:2,991:3,1170:4', 'bw-petito' ),
				'default' => '',
				'condition' => [
					'display' => ['elbzotech-product-grid-masory'],
				]
			]
		);
		$this->add_responsive_control(
			'space_item',
			[
				'label' => esc_html__( 'Space item (px)', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .width_masory' => 'padding: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .list-product-wrap' => 'margin: -{{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'display' => ['elbzotech-product-slider-masory','elbzotech-product-grid-masory'],
				]
			]
		);
		$repeater_masory = new Repeater();

		$repeater_masory->add_responsive_control(
			'width',
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
					'{{WRAPPER}} {{CURRENT_ITEM}}.width_masory' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$repeater_masory->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default' => 'custom',
				'separator' => 'none',
			]
		);
		$default_template = [
					'style1'		=> esc_html__( 'Style 1 (Replace)', 'bw-petito' ),
					'style2'		=> esc_html__( 'Style 2 (Replace)', 'bw-petito' ),
					'style3'		=> esc_html__( 'Style 3 (Replace)', 'bw-petito' ),
					'style5'		=> esc_html__( 'Style 5 (Replace)', 'bw-petito' ),
				];
		$repeater_masory->add_control(
			'template',
			[
				'label' 	=> esc_html__( 'Replace style or Insert template', 'bw-petito' ),
				'description'	=> esc_html__( 'Replace the display style or insert content in the template', 'bw-petito' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => bzotech_list_post_type('elementor_library',true,$default_template),
			]
		);
		$repeater_masory->add_control(
			'add_class_css', 
			[
				'label' => esc_html__( 'Add class CSS', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter name class' , 'bw-petito' ),
			]
		);
		$this->add_control(
			'list_grid_custom',
			[
				'label' => esc_html__( 'Add layout masory', 'bw-petito' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty'=>false,
				'fields' => $repeater_masory->get_controls(),
				'condition' => [
					'display' => ['elbzotech-product-slider-masory','elbzotech-product-grid-masory'],
				]
			]
		);

		$this->end_controls_section();
	}
	public function get_slider_settings() {
		$this->start_controls_section(
			'section_slider',
			[
				'label' => esc_html__( 'Slider', 'bw-petito' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'display' => ['elbzotech-product-slider','elbzotech-product-slider-masory'],
				]
			]
		);

		$this->add_responsive_control(
			'slider_items',
			[
				'label' => esc_html__( 'Items', 'bw-petito' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'default' => 3,
				'condition' => [
					'slider_auto' => '',
					'slider_items_custom' => '',
				]
			]
		);
		$this->add_control(
			'slider_items_custom',
			[
				'label' => esc_html__( 'Items custom by display', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'description'	=> esc_html__( 'Enter item for screen width(px) format is width:value and separate values by ",". Example is 0:1,375:2,991:3,1170:4', 'bw-petito' ),
				'default' => '',
				'condition' => [
					'slider_auto' => '',
				]
			]
		);

		$this->add_responsive_control(
			'slider_space',
			[
				'label' => esc_html__( 'Space(px)', 'bw-petito' ),
				'description'	=> esc_html__( 'For example: 20', 'bw-petito' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 200,
				'step' => 1,
				'default' => 0
			]
		);

		$this->add_control(
			'slider_column',
			[
				'label' => esc_html__( 'Row', 'bw-petito' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'default' => 1,
			]
		);

		$this->add_control(
			'slider_speed',
			[
				'label' => esc_html__( 'Speed(ms)', 'bw-petito' ),
				'description'	=> esc_html__( 'For example: 3000 or 5000', 'bw-petito' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 3000,
				'max' => 10000,
				'step' => 100,
			]
		);		

		$this->add_control(
			'slider_auto',
			[
				'label' => esc_html__( 'Auto width', 'bw-petito' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'bw-petito' ),
				'label_off' => esc_html__( 'Off', 'bw-petito' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
			'slider_center',
			[
				'label' => esc_html__( 'Center', 'bw-petito' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'bw-petito' ),
				'label_off' => esc_html__( 'Off', 'bw-petito' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
			'slider_loop',
			[
				'label' => esc_html__( 'Loop', 'bw-petito' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'bw-petito' ),
				'label_off' => esc_html__( 'Off', 'bw-petito' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
			'slider_navigation',
			[
				'label' 	=> esc_html__( 'Navigation', 'bw-petito' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''		=> esc_html__( 'None', 'bw-petito' ),
					'style1'		=> esc_html__( 'Style 1', 'bw-petito' ),
					'style2'		=> esc_html__( 'Style 2 (Vertical)', 'bw-petito' ),
					'style3'		=> esc_html__( 'Style 3', 'bw-petito' ),
					'style4'		=> esc_html__( 'Style 4', 'bw-petito' ),
					'group'		=> esc_html__( 'Style 2 (Group)', 'bw-petito' ),
					'group2'		=> esc_html__( 'Style 3 (Group)', 'bw-petito' ),
					'yes'		=> esc_html__( 'Default custom', 'bw-petito' ),
				],
			]
		);
		$this->add_control(
			'slider_pagination',
			[
				'label' 	=> esc_html__( 'Pagination', 'bw-petito' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''		=> esc_html__( 'None', 'bw-petito' ),
					'style1'		=> esc_html__( 'Style 1 (Square)', 'bw-petito' ),
					'style2'		=> esc_html__( 'style 2 (Round)', 'bw-petito' ),
					'style3'		=> esc_html__( 'style 3 (Line)', 'bw-petito' ),
					'number'		=> esc_html__( 'style 4 (Number)', 'bw-petito' ),
					'yes'		=> esc_html__( 'Default custom', 'bw-petito' ),
				],
			]
		);
		$this->add_control(
			'slider_scrollbar',
			[
				'label' 	=> esc_html__( 'Scrollbar', 'bw-petito' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''		=> esc_html__( 'None', 'bw-petito' ),
					'yes'		=> esc_html__( 'Default custom', 'bw-petito' ),
				],
			]
		);
		$this->end_controls_section();
	}

	public function get_box_image($key='box-key',$class="box-class") {
		$this->add_responsive_control(
			$key.'_padding',
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
			$key.'_margin',
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
				'name' => $key.'_border',
				'selectors' => [
					'{{WRAPPER}} .'.$class.' .product-thumb-link',
					'{{WRAPPER}} .'.$class.' .product-thumb-link::before',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			$key.'_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'bw-petito' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .'.$class.' .product-thumb-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => $key.'_box_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .'.$class.' .product-thumb-link',
			]
		);
	}

	public function get_box_settings($key='box-key',$class="box-class") {

		$this->add_responsive_control(
			$key.'_padding_wrap',
			[
				'label' => esc_html__( 'Padding Column', 'bw-petito' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', ],
				'selectors' => [
					'{{WRAPPER}} .list-col-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};margin-bottom:0px;',
					'{{WRAPPER}} .list-product-wrap' => 'margin: -{{TOP}}{{UNIT}} -{{RIGHT}}{{UNIT}} -{{BOTTOM}}{{UNIT}} -{{LEFT}}{{UNIT}};clear: both;',
				],
			]
        );

		$this->add_responsive_control(
			$key.'_padding',
			[
				'label' => esc_html__( 'Padding', 'bw-petito' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', ],
				'selectors' => [
					'{{WRAPPER}} .'.$class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->add_responsive_control(
			$key.'_margin',
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
			Group_Control_Background::get_type(),
			[
				'name' => $key.'_background',
				'label' => esc_html__( 'Background', 'bw-petito' ),
				'types' => [ 'classic' ],
				'selector' => '{{WRAPPER}} .'.$class,
			]
        );

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => $key.'_border',
                'label' => esc_html__( 'Border', 'bw-petito' ),
                'separator' => 'before',
				'selector' => '{{WRAPPER}} .'.$class,
			]
        );

        $this->add_responsive_control(
			$key.'_radius',
			[
				'label' => esc_html__( 'Border Radius', 'bw-petito' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .'.$class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => $key.'_shadow',
				'selector' => '{{WRAPPER}} .'.$class,
			]
		);
	}
	public function get_box_settings_info($key='box-key',$class="box-class") {

			$this->add_responsive_control(
				$key.'_padding',
				[
					'label' => esc_html__( 'Padding', 'bw-petito' ),
					'type' => Controls_Manager::DIMENSIONS,
	                'size_units' => [ 'px', ],
					'selectors' => [
						'{{WRAPPER}} .'.$class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
	        );

	        $this->add_responsive_control(
				$key.'_margin',
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
				Group_Control_Background::get_type(),
				[
					'name' => $key.'_background',
					'label' => esc_html__( 'Background', 'bw-petito' ),
					'types' => [ 'classic' ],
					'selector' => '{{WRAPPER}} .'.$class,
				]
	        );

	        $this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => $key.'_border',
	                'label' => esc_html__( 'Border', 'bw-petito' ),
	                'separator' => 'before',
					'selector' => '{{WRAPPER}} .'.$class,
				]
	        );

	        $this->add_responsive_control(
				$key.'_radius',
				[
					'label' => esc_html__( 'Border Radius', 'bw-petito' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors' => [
						'{{WRAPPER}} .'.$class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' => $key.'_shadow',
					'selector' => '{{WRAPPER}} .'.$class,
				]
			);
		}

	public function get_slider_styles() {
		$this->start_controls_section(
			'section_style_slider_nav',
			[
				'label' => esc_html__( 'Slider Navigation', 'bw-petito' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'display' => ['elbzotech-product-slider','elbzotech-product-slider-masory'],
					'slider_navigation!' => '',
				]
			]
		);

		$this->add_responsive_control(
			'width_slider_nav',
			[
				'label' => esc_html__( 'Width', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-button-nav' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'height_slider_nav',
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
					'{{WRAPPER}} .swiper-button-nav' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .swiper-button-nav i' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'padding_slider_nav',
			[
				'label' => esc_html__( 'Padding', 'bw-petito' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .swiper-button-nav' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'margin_slider_nav',
			[
				'label' => esc_html__( 'Margin', 'bw-petito' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .swiper-button-nav' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'slider_nav_effects' );

		$this->start_controls_tab( 'slider_nav_normal',
			[
				'label' => esc_html__( 'Normal', 'bw-petito' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_slider_nav',
				'label' => esc_html__( 'Background', 'bw-petito' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .swiper-button-nav',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'shadow_slider_nav',
				'selector' => '{{WRAPPER}} .swiper-button-nav',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_slider_nav',
				'selector' => '{{WRAPPER}} .swiper-button-nav',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'border_radius_slider_nav',
			[
				'label' => esc_html__( 'Border Radius', 'bw-petito' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .swiper-button-nav' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'slider_nav_hover',
			[
				'label' => esc_html__( 'Hover', 'bw-petito' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_slider_nav_hover',
				'label' => esc_html__( 'Background', 'bw-petito' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .swiper-button-nav:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'shadow_slider_nav_hover',
				'selector' => '{{WRAPPER}} .swiper-button-nav:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_slider_nav_hover',
				'selector' => '{{WRAPPER}} .swiper-button-nav:hover',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'border_radius_slider_nav_hover',
			[
				'label' => esc_html__( 'Border Radius', 'bw-petito' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .swiper-button-nav:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();	

		$this->add_control(
			'separator_slider_nav',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->add_control(
			'slider_icon_next',
			[
				'label' => esc_html__( 'Icon next', 'bw-petito' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'las la-arrow-right',
					'library' => 'solid',
				],
			]
		);

		$this->add_control(
			'slider_icon_prev',
			[
				'label' => esc_html__( 'Icon prev', 'bw-petito' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'las la-arrow-left',
					'library' => 'solid',
				],
			]
		);

		$this->add_responsive_control(
			'slider_icon_size',
			[
				'label' => esc_html__( 'Size icon', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .swiper-button-nav i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'slider_nav_space',
			[
				'label' => esc_html__( 'Space', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -500,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-button-next' => 'right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .swiper-button-prev' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_slider_pag',
			[
				'label' => esc_html__( 'Slider Pagination', 'bw-petito' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'display' =>  ['elbzotech-product-slider','elbzotech-product-slider-masory'],
					'slider_pagination!' => '',
				]
			]
		);

		$this->add_responsive_control(
			'width_slider_pag',
			[
				'label' => esc_html__( 'Width', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination span' => 'width: {{SIZE}}{{UNIT}};',
				], 
			]
		);

		$this->add_responsive_control(
			'height_slider_pag',
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
					'{{WRAPPER}} .swiper-pagination span' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'separator_bg_normal',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->add_control(
			'background_pag_heading',
			[
				'label' => esc_html__( 'Normal', 'bw-petito' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'none',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_slider_pag',
				'label' => esc_html__( 'Background', 'bw-petito' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .swiper-pagination span',
			]
		);

		$this->add_control(
			'opacity_pag',
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
					'{{WRAPPER}} .swiper-pagination span' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_control(
			'separator_bg_active',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->add_control(
			'background_pag_heading_active',
			[
				'label' => esc_html__( 'Active', 'bw-petito' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'none',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_slider_pag_active',
				'label' => esc_html__( 'Background', 'bw-petito' ),
				'description'	=> esc_html__( 'Active status', 'bw-petito' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .swiper-pagination span.swiper-pagination-bullet-active',
			]
		);

		$this->add_control(
			'opacity_pag_active',
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
					'{{WRAPPER}} .swiper-pagination span.swiper-pagination-bullet-active' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_control(
			'separator_shadow',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'shadow_slider_pag',
				'selector' => '{{WRAPPER}} .swiper-pagination span',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_slider_pag',
				'selector' => '{{WRAPPER}} .swiper-pagination span',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'border_radius_slider_pag',
			[
				'label' => esc_html__( 'Border Radius', 'bw-petito' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'slider_pag_space',
			[
				'label' => esc_html__( 'Space', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -500,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

}