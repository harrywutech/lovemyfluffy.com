<?php
    /**
     * ReduxFramework Barebones Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }
    // Redux help function    
    if(!function_exists('bzotech_switch_redux_option')){
        function bzotech_switch_redux_option(){
            $bzotech_option_name = bzotech_get_option_name();
            // Basic Settings
            Redux::setSection( $bzotech_option_name, array(
                'title'            => esc_html__( 'Basic Settings', 'bw-petito' ),
                'id'               => 'basic',
                'icon'             => 'el el-home'
            ) );
            Redux::setSection( $bzotech_option_name, array(
                'title'            => esc_html__( 'General', 'bw-petito' ),
                'id'               => 'basic-general',
                'subsection'       => true,
                'fields'           => array(
                    array(
                        'id'       => 'bzotech_header_page',
                        'type'     => 'select',
                        'title'    => esc_html__( 'Header Page', 'bw-petito' ),
                        'desc'     => esc_html__( 'Include Header content. Go to Header in admin menu to edit/create header content. Note this value default for all pages of your site, If have any page/single page display other content pehaps you are set specific header for it', 'bw-petito' ),
                        //Must provide key => value pairs for select options
                        'options'  => bzotech_list_post_type('bzotech_header'),
                        'default'  => ''
                    ),
                    array(
                        'id'       => 'bzotech_footer_page',
                        'type'     => 'select',
                        'title'    => esc_html__( 'Footer Page', 'bw-petito' ),
                        'desc'     => esc_html__( 'Include Footer content. Go to Footer in admin menu to edit/create footer content.  Note this value default for all pages of your site, If have any page/single page display other content pehaps you are set specific footer for it', 'bw-petito' ),
                        //Must provide key => value pairs for select options
                        'options'  => bzotech_list_post_type('bzotech_footer'),
                        'default'  => ''
                    ),
                    array(
                        'id'       => 'bzotech_show_breadrumb',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Show BreadCrumb', 'bw-petito' ),
                        'desc' => esc_html__( 'Look, it\'s on!', 'bw-petito' ),
                        'default'  => false,
                    ),
                    array(
                        'id'       => 'bzotech_bg_breadrumb',
                        'type'      => 'media',
                        'title'    => esc_html__( 'BreadCrumb Background', 'bw-petito' ),
                        'desc' => esc_html__( 'Select images in library', 'bw-petito' ),
                    ),
                    array(
                        'id'       => 'bzotech_404_page',
                        'type'     => 'select',
                        'title'    => esc_html__( '404 Page', 'bw-petito' ),
                        'desc'     => esc_html__( 'Include page to 404 page', 'bw-petito' ),
                        //Must provide key => value pairs for select options
                        'options'  => bzotech_list_post_type('bzotech_mega_item'),
                        'default'  => ''
                    ),
                    array(
                        'id'       => 'bzotech_404_page_style',
                        'type'     => 'select',
                        'title'    => esc_html__( '404 Style', 'bw-petito' ),
                        'desc'     => esc_html__( 'Choose a style to display.', 'bw-petito' ),
                        //Must provide key => value pairs for select options
                        'options'  => array(
                            ''           => esc_html__('Default','bw-petito'),
                            'full-width' => esc_html__('FullWidth','bw-petito'),
                        ),
                        'default'  => '',
                        'required' => array('bzotech_404_page','not','')
                    ),

                )
            ) );
            
            Redux::setSection( $bzotech_option_name, array(
                'title'            => esc_html__( 'Preload', 'bw-petito' ),
                'id'               => 'preload-general',
                'subsection'       => true,
                'fields'           => array(
                    array(
                        'id'       => 'show_preload',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Show Preload', 'bw-petito' ),
                        'desc'     => esc_html__( 'Look, it\'s on!', 'bw-petito' ),
                        'default'  => false,
                    ),
                    array(
                        'id'          => 'preload_bg',
                        'type'        => 'color_rgba',
                        'title'       => esc_html__('Background','bw-petito'),
                        'desc'        => esc_html__( 'Change default body background.', 'bw-petito' ),
                        'required'    => array('show_preload','=',true),
                    ),
                    array(
                        'id'          => 'preload_style',
                        'type'        => 'select',
                        'title'       => esc_html__('Preload Style','bw-petito'),
                        'default'     => '',
                        'options'     => array(
                            '' =>  esc_html__('Style 1','bw-petito'),
                            'style2' =>  esc_html__('Style 2','bw-petito'),
                            'style3' =>  esc_html__('Style 3','bw-petito'),
                            'style4' =>  esc_html__('Style 4','bw-petito'),
                            'style5' =>  esc_html__('Style 5','bw-petito'),
                            'style6' =>  esc_html__('Style 6','bw-petito'),
                            'style7' =>  esc_html__('Style 7','bw-petito'),
                            'custom-image' =>  esc_html__('Custom image','bw-petito'),
                        ),
                        'desc'        => esc_html__( 'Choose default style for your site.', 'bw-petito' ),
                        'required'    => array('show_preload','=',true),
                    ),
                )
            ) );
            Redux::setSection( $bzotech_option_name, array(
                'title'            => esc_html__( 'Other', 'bw-petito' ),
                'id'               => 'other-general',
                'subsection'       => true,
                'fields'           => array(
                    array(
                        'id'        => 'show_scroll_top',
                        'type'      => 'switch',
                        'title'     => esc_html__('Show scroll top button', 'bw-petito'),
                        'desc'      => esc_html__('This allow you to show or hide scroll top button', 'bw-petito'),
                        'default'   => false
                    ),
                    array(
                        'id'        => 'show_wishlist_notification',
                        'type'      => 'switch',
                        'title'     => esc_html__('Show wishlist notification', 'bw-petito'),
                        'desc'      => esc_html__('This allow you to show or hide wishlist notification when add to wishlist.', 'bw-petito'),
                        'default'   => false
                    ),
                    array(
                        'id'        => 'show_too_panel',
                        'type'      => 'switch',
                        'title'     => esc_html__('Show tool panel', 'bw-petito'),
                        'desc'      => esc_html__('This allow you to show or hide tool panel.', 'bw-petito'),
                        'default'   => false
                    ),
                    array(
                        'id'          => 'tool_panel_page',
                        'type'        => 'select',
                        'title'       => esc_html__( 'Choose tool panel page', 'bw-petito' ),
                        'desc'        => esc_html__( 'Choose a mega page to display.', 'bw-petito' ),
                        'options'     => bzotech_list_post_type('bzotech_mega_item'),
                        'required'   =>  array('show_too_panel','=',true),
                    ),
                    array(
                        'id'          => 'after_append_footer',
                        'type'        => 'select',
                        'title'       => esc_html__( 'Append content after footer', 'bw-petito' ),
                        'desc'        => esc_html__( 'Choose a mega page content append to after main content of footer', 'bw-petito' ),
                        'options'     => bzotech_list_post_type('bzotech_mega_item'),
                    ),
                    array(
                        'id'       => 'image_not_found',
                        'type'      => 'media',
                        'title'    => esc_html__( 'Image not found', 'bw-petito' ),
                        'desc' => esc_html__( 'Select images in library', 'bw-petito' ),
                    ),
                    array(
                        'id'          => 'body_bg',
                        'type'        => 'color_rgba',
                        'title'       => esc_html__('Body Background','bw-petito'),
                        'desc'        => esc_html__( 'Change default body background.', 'bw-petito' ),
                    ),
                    array(
                        'id'          => 'body_typo',
                        'type'        => 'typography',
                        'title'       => esc_html__('Body typography','bw-petito'),
                        'desc'        => esc_html__( 'Custom font in Body.', 'bw-petito' ),//AIzaSyAbY7X0X9ljU0uQ2CCSiLJvQXLtYMXQijY
                        'google'      => true,
                    ),
                    array(
                        'id'          => 'title_typo',
                        'type'        => 'typography',
                        'title'       => esc_html__('Title typography','bw-petito'),
                        'desc'        => esc_html__( 'Custom font in Title.', 'bw-petito' ),
                        'font-weight'=>false,
                        'font-size'=>false,
                        'color'=>false,
                        'line-height'=>false,
                        'text-align'=>false,
                        'subsets'=>false,
                    ),
                    array(
                        'id'          => 'main_color',
                        'type'        => 'color_rgba',
                        'title'       => esc_html__('Main color','bw-petito'),
                        'desc'        => esc_html__( 'Change main color of your site.', 'bw-petito' ),
                    ),
                    array(
                        'id'          => 'main_color2',
                        'type'        => 'color_rgba',
                        'title'       => esc_html__('Main color 2','bw-petito'),
                        'desc'        => esc_html__( 'Change main color 2 of your site.', 'bw-petito' ),
                    ),
                    array(
                        'id'          => 'bzotech_page_style',
                        'type'        => 'select',
                        'title'       => esc_html__('Page Style','bw-petito'),
                        'default'     => '',
                        'options'     => array(
                            'page-content-df' =>  esc_html__('Default','bw-petito'),
                            'page-content-box' =>  esc_html__('Page boxed','bw-petito'),
                        ),
                        'desc'        => esc_html__( 'Choose default style for pages.', 'bw-petito' ),
                    ),
                    array(
                        'id'          => 'container_width',
                        'type'        => 'text',
                        'title'       => esc_html__('Custom container width(px)','bw-petito'),
                        'desc'        => esc_html__( 'You can custom width of container on your site. Default is 1200px.', 'bw-petito' ),
                    ),
                    array(
                        'id'          => 'post_single_share',
                        'title'       => esc_html__('Show share box','bw-petito'),
                        'type'        => 'checkbox',
                        'options'  => array(
                            'post' => esc_html__('Post','bw-petito'),
                            'page' => esc_html__('Page','bw-petito'),
                            'product' => esc_html__('Product','bw-petito'),
                        ),
                        'desc'        => esc_html__( 'You can show/hide share box on post, page, product pages. ', 'bw-petito' ),
                    ),
                    array(
                        'id'          => 'post_single_share_list',
                        'title'       => esc_html__('Add custom share box','bw-petito'),
                        'type'        => 'repeater',
                        'fields'    => array( 
                            array(
                                'id'       => 'title',
                                'type'     => 'text',
                                'title'    => esc_html__( 'Title', 'bw-petito' ),
                            ),
                            array(
                                'id'          => 'social',
                                'title'       => esc_html__('Social','bw-petito'),
                                'type'        => 'select',
                                'options'     => array(
                                    'total'    => esc_html__('Total share','bw-petito'),
                                    'facebook'  => esc_html__('Facebook','bw-petito'),
                                    'twitter' => esc_html__('Twitter','bw-petito'),
                                    'pinterest' => esc_html__('Pinterest','bw-petito'),
                                    'linkedin' => esc_html__('Linkedin','bw-petito'),
                                    'tumblr' => esc_html__('Tumblr','bw-petito'),
                                    'envelope' => esc_html__('Mail','bw-petito'),
                                ),
                                
                            ),
                            array(
                                'id'          => 'number',
                                'title'       => esc_html__('Show number','bw-petito'),
                                'type'        => 'switch',
                                'default'         => '0',
                            ),
                        ),
                    ),
                    array(
                        'id'          => 'session_page',
                        'type'        => 'switch',
                        'title'       => esc_html__('Session page','bw-petito'),
                        'default'     => false,
                    ),
                    
                    array(
                        'id'       => 'bzotech_demo',
                        'type'     => 'select',
                        'title'    => esc_html__( 'Select Demo', 'bw-petito' ),
                        'desc'     => esc_html__( 'Select demo version','bw-petito' ),
                        //Must provide key => value pairs for select options
                        'options'     => bzotech_list_demo(),
                        'default'  => '1'
                    ),
                )
            ) );
            // End Basic Settings

            // Blog & Post
            Redux::setSection( $bzotech_option_name, array(
                'title'            => esc_html__( 'Blog & Post', 'bw-petito' ),
                'id'               => 'blog-post',
                'icon'             => 'el el-website'
            ) );
            Redux::setSection( $bzotech_option_name, array(
                'title'            => esc_html__( 'General', 'bw-petito' ),
                'id'               => 'blog-general',
                'subsection'       => true,
                'fields'           => array(                    
                    array(
                        'id'          => 'before_append_post',
                        'type'        => 'select',
                        'title'       => esc_html__('Append content before post/blog/archive page','bw-petito'),
                        'options'     => bzotech_list_post_type('bzotech_mega_item'),
                        'desc'        => esc_html__('Choose a mega page content append to before main content of post/blog/archive page.','bw-petito'),
                    ),
                    array(
                        'id'          => 'after_append_post',
                        'type'        => 'select',
                        'title'       => esc_html__('Append content after post/blog/archive page','bw-petito'),
                        'options'     => bzotech_list_post_type('bzotech_mega_item'),
                        'desc'        => esc_html__('Choose a mega page content append to after main content of post/blog/archive page.','bw-petito'),
                    ),
                    array(
                        'id'          => 'bzotech_sidebar_position_blog',
                        'type'        => 'select',
                        'title'       => esc_html__('Sidebar Blog','bw-petito'),
                        'desc'        => esc_html__('Set sidebar position for your blog page. Left, Right, or No sidebar.','bw-petito'),
                        'options'     => array(
                            'no'    => esc_html__('No Sidebar','bw-petito'),
                            'left'  => esc_html__('Left','bw-petito'),
                            'right' => esc_html__('Right','bw-petito'),
                        ),
                        'default'     => 'right'
                    ),
                    array(
                        'id'          => 'bzotech_sidebar_blog',
                        'type'        => 'select',
                        'title'       => esc_html__('Sidebar select display in blog','bw-petito'),
                        'data'        => 'sidebars',
                        'required'    => array(
                            array('bzotech_sidebar_position_blog','not','no'),
                            array('bzotech_sidebar_position_blog','not',''),
                        ), 
                        'desc'        => esc_html__('Choose a sidebar to display.','bw-petito'),
                    ),
                     array(
                        'id'          => 'bzotech_sidebar_style_blog',
                        'type'        => 'select',
                        'title'       => esc_html__('Sidebar blog style','bw-petito'),
                        'desc'        => esc_html__('Set sidebar style for your blog page.','bw-petito'),
                        'options'     => array(
                            'default'    => esc_html__('Default','bw-petito'),
                            'style2'  => esc_html__('Style2','bw-petito'),
                        ),
                        'required'    => array(
                            array('bzotech_sidebar_position_blog','not','no'),
                            array('bzotech_sidebar_position_blog','not',''),
                        ), 
                        'default'     => 'default'
                    ),
                    array(
                        'id'          => 'blog_default_style',
                        'type'        => 'select',
                        'title'       => esc_html__('Default style','bw-petito'),
                        'desc'        =>esc_html__('Choose a style to active display','bw-petito'),
                        'options'     => array(
                            'list'  => esc_html__('List','bw-petito'),
                            'grid'  => esc_html__('Grid','bw-petito'),
                        ),
                        'default'     => 'list',
                    ),
                    array(
                        'id'          => 'blog_style',
                        'type'        => 'select',
                        'title'       => esc_html__('Blog pagination','bw-petito'),
                        'desc'        => esc_html__('Choose a style to active display','bw-petito'),
                        'options'     => array(
                            ''          => esc_html__('Default','bw-petito'),
                            'load-more' =>esc_html__('Load more','bw-petito'),
                        )
                    ),
                    array(
                        'id'          => 'blog_number_filter',
                        'type'        => 'switch',
                        'title'       => esc_html__('Show number filter','bw-petito'),
                        'desc'        => 'Show/hide number filter on blog page.',
                        'default'     => false,
                    ),
                    
                    array(
                        'id'          => 'blog_number_filter_list',
                        'title'       => esc_html__('Add list number filter','bw-petito'),
                        'type'        => 'repeater',
                        'desc'        => esc_html__('Add custom list number to filter on the blog page.','bw-petito'),
                        'fields'    => array( 
                            array(
                                'id'       => 'title',
                                'type'     => 'text',
                                'title'    => esc_html__( 'Title', 'bw-petito' ),
                            ),
                            array(
                                'id'          => 'number',
                                'type'        => 'text',
                                'title'       => esc_html__('Number','bw-petito'),
                            ),
                        ),
                        'required'   => array('blog_number_filter','not', false),
                    ),
                    array(
                        'id'          => 'blog_type_filter',
                        'type'        => 'switch',
                        'title'       => esc_html__('Show type filter','bw-petito'),
                        'desc'        => esc_html__('Show/hide type filter(list/grid) on blog page.','bw-petito'),
                        'default'     => false,
                    ),
                    array(
                        'id'          => 'blog_order_filter',
                        'type'        => 'switch',
                        'title'       => esc_html__('Show order filter','bw-petito'),
                        'desc'        => esc_html__('Show/hide order filter(list/grid) on blog page.','bw-petito'),
                        'default'     => false,
                    ),
                    array(
                        'id'          => 'post_list_meta',
                        'type'        => 'select',
                        'options'     => array(
                           ''     => esc_html__( 'Default', 'bw-petito' ),
                            'yes'      => esc_html__( 'yes', 'bw-petito' ),
                            'no'      => esc_html__( 'No', 'bw-petito' ),
                        ),
                        'title'       => esc_html__('Show meta data','bw-petito'),
                        'desc'        => esc_html__('Show/hide meta data(author, date, comments, categories, tags) on post detail.','bw-petito'),
                        'default'     => '',
                    ),
                    array(
                        'id'          => 'item_meta_select',
                        'type'        => 'select',
                         'multi'=>  true,
                        'title'       => esc_html__('Meta list','bw-petito'),
                        'options'     => array(
                           'author'     => esc_html__( 'Author', 'bw-petito' ),
                            'date'      => esc_html__( 'Date', 'bw-petito' ),
                            'cats'      => esc_html__( 'Categories', 'bw-petito' ),
                            'tags'      => esc_html__( 'Tags', 'bw-petito' ),
                            'comments'  => esc_html__( 'Comments', 'bw-petito' ),
                            'views'     => esc_html__( 'Total views', 'bw-petito' ),
                        ),
                        'required'    => array('post_list_meta','=','yes'),
                    ),

                )
            ) );
            Redux::setSection( $bzotech_option_name, array(
                'title'            => esc_html__( 'List Settings', 'bw-petito' ),
                'id'               => 'blog-list',
                'subsection'       => true,
                'fields'           => array(
                    array(
                        'id'          => 'post_list_size',
                        'type'        => 'text',
                        'title'       => esc_html__('Custom list thumbnail size','bw-petito'),
                        'desc'        => esc_html__('Enter size thumbnail to crop. [width]x[height]. Example is 300x300.','bw-petito')
                    ),
                    array(
                        'id'          => 'post_list_excerpt',
                        'type'        => 'slider',
                        'title'       => esc_html__('Sub string excerpt','bw-petito'),
                        'min'         => 0,
                        'max'         => 999,
                        'step'        => 1,
                        'default'     => 999,
                        'desc'        => esc_html__('Enter number of character want to get from excerpt content. Default is full(999). Example is 80. Note: This value only apply for items style can be show excerpt.','bw-petito')
                    ),
                    array(
                        'id'          => 'post_list_item_style',
                        'type'        => 'select',
                        'title'       => esc_html__('List item style','bw-petito'),
                        'desc'        => esc_html__('Choose a style to active display','bw-petito'),
                        'options'     => bzotech_get_post_list_style()
                    ),
                )
            ) );
            Redux::setSection( $bzotech_option_name, array(
                'title'            => esc_html__( 'Grid Settings', 'bw-petito' ),
                'id'               => 'blog-grid',
                'subsection'       => true,
                'fields'           => array(
                    array(
                        'id'          => 'post_grid_column',
                        'type'        => 'select',
                        'title'       => esc_html__('Grid column','bw-petito'),
                        'default'     => '3',
                        'desc'=>esc_html__('Choose a style to active display','bw-petito'),
                        'options'     => array(
                            '2' => esc_html__('2 column','bw-petito'),
                            '3' =>esc_html__('3 column','bw-petito'),
                            '4' =>esc_html__('4 column','bw-petito'),
                            '5' =>esc_html__('5 column','bw-petito'),
                            '6' =>esc_html__('6 column','bw-petito'),
                        )
                    ),
                    array(
                        'id'          => 'post_grid_size',
                        'type'        => 'text',
                        'title'       => esc_html__('Custom grid thumbnail size','bw-petito'),
                        'desc'        => esc_html__('Enter size thumbnail to crop. [width]x[height]. Example is 300x300.','bw-petito')
                    ),
                    array(
                        'id'          => 'post_grid_excerpt',
                        'type'        => 'slider',
                        'title'       => esc_html__('Sub string excerpt','bw-petito'),
                        'min'         => 0,
                        'max'         => 999,
                        'step'        => 1,
                        'default'     => 999,
                        'desc'        => esc_html__('Enter number of character want to get from excerpt content. Default is full(999). Example is 80. Note: This value only apply for items style can be show excerpt.','bw-petito')
                    ),
                    array(
                        'id'          => 'post_grid_item_style',
                        'type'        => 'select',
                        'title'       => esc_html__('Grid item style','bw-petito'),
                        'desc'        =>esc_html__('Choose a style to active display','bw-petito'),
                        'options'     => bzotech_get_post_style()
                    ),
                    array(
                        'id'          => 'post_grid_type',
                        'type'        => 'select',
                        'title'       => esc_html__('Grid display','bw-petito'),
                        'desc'        =>esc_html__('Choose a style to active display','bw-petito'),
                        'options'     => array(
                            ''  => esc_html__('Default','bw-petito'),
                            'grid-masonry'  => esc_html__('Masonry','bw-petito'),
                            )
                    ),
                )
            ) );
            Redux::setSection( $bzotech_option_name, array(
                'title'            => esc_html__( 'Post detail Settings', 'bw-petito' ),
                'id'               => 'blog-post-detail',
                'subsection'       => true,
                'fields'           => array(                    
                    array(
                        'id'          => 'bzotech_style_post_detail',
                        'type'        => 'select',
                        'title'       => esc_html__('Style Single Post','bw-petito'),
                        'options'     => array(
                            ''    => esc_html__('Default','bw-petito'),
                        ),
                        'default'  => ''
                    ),
                    array(
                        'id'          => 'bzotech_sidebar_position_post',
                        'type'        => 'select',
                        'title'       => esc_html__('Sidebar Single Post','bw-petito'),
                        'desc'        => esc_html__('Set sidebar position for your post detail page. Left, Right, or No sidebar.','bw-petito'),
                        'options'     => array(
                            'no'    => esc_html__('No Sidebar','bw-petito'),
                            'left'  => esc_html__('Left','bw-petito'),
                            'right' => esc_html__('Right','bw-petito'),
                        ),
                        'default'  => 'right'
                    ),
                    array(
                        'id'          => 'bzotech_sidebar_post',
                        'type'        => 'select',
                        'title'       => esc_html__('Sidebar select display in single post','bw-petito'),
                        'data'        => 'sidebars',
                        'required'    => array(
                            array('bzotech_sidebar_position_post','not','no'),
                            array('bzotech_sidebar_position_post','not',''),
                        ),                   
                        'desc'        => esc_html__('Choose a sidebar to display.','bw-petito'),
                        'default'     => 'blog-sidebar'
                    ),

                    array(
                        'id'          => 'bzotech_sidebar_style_post',
                        'type'        => 'select',
                        'title'       => esc_html__('Sidebar post style','bw-petito'),
                        'desc'        => esc_html__('Set sidebar style for your single post.','bw-petito'),
                        'options'     => array(
                            'default'    => esc_html__('Default','bw-petito'),
                            'style2'  => esc_html__('Style2','bw-petito'),
                        ),
                        'required'    => array(
                            array('bzotech_sidebar_position_post','not','no'),
                            array('bzotech_sidebar_position_post','not',''),
                        ), 
                        'default'     => 'default'
                    ),
                    array(
                        'id'          => 'before_append_post_detail',
                        'title'       => esc_html__('Append content before post detail','bw-petito'),
                        'type'        => 'select',
                        'options'     => bzotech_list_post_type('bzotech_mega_item'),
                        'desc'        => esc_html__('Choose a mega page content append to before main content of post detail.','bw-petito'),
                    ),
                    array(
                        'id'          => 'after_append_post_detail',
                        'title'       => esc_html__('Append content after post detail','bw-petito'),
                        'type'        => 'select',
                        'options'     => bzotech_list_post_type('bzotech_mega_item'),
                        'desc'        => esc_html__('Choose a mega page content append to after main content of post detail.','bw-petito'),
                    ),
                    array(
                        'id'          => 'post_single_thumbnail',
                        'type'        => 'switch',
                        'title'       => esc_html__('Show thumbnail/media','bw-petito'),
                        'desc'        => 'Show/hide thumbnail image, gallery, media on post detail.',
                        'default'     => true,
                    ),                
                    array(
                        'id'          => 'post_single_size',
                        'title'       => esc_html__('Custom single image size','bw-petito'),
                        'type'        => 'text',
                        'desc'        => esc_html__('Enter size thumbnail to crop. [width]x[height]. Example is 300x300.','bw-petito'),
                        'required'    => array('post_single_thumbnail','=',true),
                    ),
                    array(
                        'id'          => 'post_single_meta',
                        'type'        => 'select',
                        'options'     => array(
                           ''     => esc_html__( 'Default', 'bw-petito' ),
                            'yes'      => esc_html__( 'yes', 'bw-petito' ),
                            'no'      => esc_html__( 'No', 'bw-petito' ),
                        ),
                        'title'       => esc_html__('Show meta data','bw-petito'),
                        'desc'        => esc_html__('Show/hide meta data(author, date, comments, categories, tags) on post detail.','bw-petito'),
                        'default'     => '',

                    ),
                     array(
                        'id'          => 'single_item_meta_select',
                        'type'        => 'select',
                        'multi'=>  true,
                        'title'       => esc_html__('Meta list','bw-petito'),
                        'options'     => array(
                           'author'     => esc_html__( 'Author', 'bw-petito' ),
                            'date'      => esc_html__( 'Date', 'bw-petito' ),
                            'cats'      => esc_html__( 'Categories', 'bw-petito' ),
                            'tags'      => esc_html__( 'Tags', 'bw-petito' ),
                            'comments'  => esc_html__( 'Comments', 'bw-petito' ),
                            'views'     => esc_html__( 'Total views', 'bw-petito' ),
                        ),
                        'required'    => array('post_single_meta','=','yes'),
                    ),
                    array(
                        'id'          => 'post_single_author',
                        'type'        => 'switch',
                        'title'       => esc_html__('Show author box','bw-petito'),
                        'desc'        => 'Show/hide author box on post detail.',
                        'default'     => false,
                    ),
                    array(
                        'id'          => 'post_single_navigation',
                        'type'        => 'switch',
                        'title'       => esc_html__('Show navigation post','bw-petito'),
                        'desc'        => 'Show/hide navigation to next post or previous post on the post detail.',
                        'default'     => false,
                    ),
                    // Related section
                    array(
                        'id'          => 'post_single_related',
                        'type'        => 'switch',
                        'title'       => esc_html__('Show related post','bw-petito'),
                        'desc'        => 'Show/hide related post on the post detail.',
                        'default'     => false,
                    ),
                    array(
                        'id'          => 'post_single_related_title',
                        'type'        => 'text',
                        'title'       => esc_html__('Related title','bw-petito'),
                        'desc'        => esc_html__('Enter title of related section.','bw-petito'),
                        'required'    => array('post_single_related','=',true),
                    ),
                    array(
                        'id'          => 'post_single_related_number',
                        'type'        => 'text',
                        'title'       => esc_html__('Related number post','bw-petito'),
                        'desc'        => esc_html__('Enter number of related post to display.','bw-petito'),
                        'required'    => array('post_single_related','=',true),
                    ),
                    array(
                        'id'          => 'post_single_related_item',
                        'type'        => 'text',
                        'title'       => esc_html__('Related custom number item responsive','bw-petito'),
                        'desc'        => esc_html__('Enter item for screen width(px) format is width:value and separate values by ",". Example is 0:2,600:3,1000:4. Default is auto.','bw-petito'),
                        'required'    => array('post_single_related','=',true),
                    ),
                    array(
                        'id'          => 'post_single_related_item_style',
                        'type'        => 'select',
                        'title'       => esc_html__('Related item style','bw-petito'),
                        'desc'        =>esc_html__('Choose a style to active display','bw-petito'),
                        'options'     => bzotech_get_post_style(),
                        'required'    => array('post_single_related','=',true),
                    ),
                )
            ) );
            // Blog & Post

            // Layout Settings
            Redux::setSection( $bzotech_option_name, array(
                'title'            => esc_html__( 'Layout Settings', 'bw-petito' ),
                'id'               => 'layout',
                'icon'             => 'el el-indent-left',
                'fields'           => array(
                    array(
                        'id'          => 'bzotech_sidebar_position_page',
                        'type'        => 'select',
                        'title'       => esc_html__('Sidebar Page','bw-petito'),
                        'desc'        => esc_html__('Set sidebar position for your default page. Left, Right, or No sidebar.','bw-petito'),
                        'options'     => array(
                            'no'    => esc_html__('No Sidebar','bw-petito'),
                            'left'  => esc_html__('Left','bw-petito'),
                            'right' => esc_html__('Right','bw-petito'),
                        ),
                        'default'     => ''
                    ),
                    array(
                        'id'          => 'bzotech_sidebar_page',
                        'type'        => 'select',
                        'title'       => esc_html__('Sidebar select display in page','bw-petito'),
                        'data'        => 'sidebars',
                        'required'    => array(
                            array('bzotech_sidebar_position_page','not','no'),
                            array('bzotech_sidebar_position_page','not',''),
                        ),
                        'desc'        => esc_html__('Choose a sidebar to display.','bw-petito'),
                        'default'     => ''
                    ),
                    array(
                        'id'          => 'bzotech_sidebar_style_page',
                        'type'        => 'select',
                        'title'       => esc_html__('Sidebar page style','bw-petito'),
                        'desc'        => esc_html__('Set sidebar style for your page.','bw-petito'),
                        'options'     => array(
                            'default'    => esc_html__('Default','bw-petito'),
                            'style2'  => esc_html__('Style2','bw-petito'),
                        ),
                        'required'    => array(
                            array('bzotech_sidebar_position_page','not','no'),
                            array('bzotech_sidebar_position_page','not',''),
                        ), 
                        'default'     => 'default'
                    ),
                    array(
                        'id'          => 'bzotech_sidebar_position_page_archive',
                        'type'        => 'select',
                        'title'       => esc_html__('Sidebar Position on Page Archives:','bw-petito'),
                        'desc'        => esc_html__('Set sidebar position for your archives page(category/tag/author page...). Left, Right, or No sidebar.','bw-petito'),
                        'options'     => array(
                            'no'    => esc_html__('No Sidebar','bw-petito'),
                            'left'  => esc_html__('Left','bw-petito'),
                            'right' => esc_html__('Right','bw-petito'),
                        ),
                        'default'     => 'right'
                    ),
                    array(
                        'id'          => 'bzotech_sidebar_page_archive',
                        'type'        => 'select',
                        'title'       => esc_html__('Sidebar select display in page Archives','bw-petito'),
                        'data'        => 'sidebars',
                        'required'    => array(
                            array('bzotech_sidebar_position_page_archive','not','no'),
                            array('bzotech_sidebar_position_page_archive','not',''),
                        ),
                        'desc'        => esc_html__('Choose a sidebar to display.','bw-petito'),
                        'default'     => 'blog-sidebar'
                    ),
                     array(
                        'id'          => 'bzotech_sidebar_style_archive',
                        'type'        => 'select',
                        'title'       => esc_html__('Sidebar archive style','bw-petito'),
                        'desc'        => esc_html__('Set sidebar style for your archive.','bw-petito'),
                        'options'     => array(
                            'default'    => esc_html__('Default','bw-petito'),
                            'style2'  => esc_html__('Style2','bw-petito'),
                        ),
                        'required'    => array(
                            array('bzotech_sidebar_position_page_archive','not','no'),
                            array('bzotech_sidebar_position_page_archive','not',''),
                        ), 
                        'default'     => 'default'
                    ),
                    array(
                        'id'          => 'bzotech_sidebar_position_page_search',
                        'type'        => 'select',
                        'title'       => esc_html__('Sidebar Position on search page:','bw-petito'),
                        'desc'        => esc_html__('Set sidebar position for your search page. Left, Right, or No sidebar.','bw-petito'),
                        'options'     => array(
                            'no'    => esc_html__('No Sidebar','bw-petito'),
                            'left'  => esc_html__('Left','bw-petito'),
                            'right' => esc_html__('Right','bw-petito'),
                        )
                    ),
                    array(
                        'id'          => 'bzotech_sidebar_page_search',
                        'type'        => 'select',
                        'title'       => esc_html__('Sidebar select display in page Archives','bw-petito'),
                        'data'        => 'sidebars',
                        'required'    => array(
                            array('bzotech_sidebar_position_page_search','not','no'),
                            array('bzotech_sidebar_position_page_search','not',''),
                        ),
                        'desc'        => esc_html__('Choose a sidebar to display.','bw-petito'),
                    ),    
                    array(
                        'id'          => 'bzotech_sidebar_style_search',
                        'type'        => 'select',
                        'title'       => esc_html__('Sidebar search style','bw-petito'),
                        'desc'        => esc_html__('Set sidebar style for your search.','bw-petito'),
                        'options'     => array(
                            'default'    => esc_html__('Default','bw-petito'),
                            'style2'  => esc_html__('Style2','bw-petito'),
                        ),
                        'required'    => array(
                            array('bzotech_sidebar_position_page_search','not','no'),
                            array('bzotech_sidebar_position_page_search','not',''),
                        ), 
                        'default'     => 'default'
                    ),          
                    array(
                        'id'          => 'bzotech_add_sidebar',
                        'title'       => esc_html__('Add SideBar','bw-petito'),
                        'type'        => 'repeater',
                        'default'     => '',
                        'fields'    => array( 
                            array(
                                'id'       => 'title',
                                'type'     => 'text',
                                'title'    => esc_html__( 'Title', 'bw-petito' ),
                            ),
                            array(
                                'id'          => 'widget_title_heading',
                                'type'        => 'select',
                                'title'       => esc_html__('Choose heading title widget','bw-petito'),
                                'default'     => 'h3',
                                'options'     => array(
                                    'h1' => esc_html__('H1','bw-petito'),
                                    'h2' => esc_html__('H2','bw-petito'),
                                    'h3' => esc_html__('H3','bw-petito'),
                                    'h4' => esc_html__('H4','bw-petito'),
                                    'h5' => esc_html__('H5','bw-petito'),
                                    'h6' => esc_html__('H6','bw-petito'),
                                )
                            )
                            
                        ),
                    ),
                )
            ) );
            // End Layout Settings

            
         
            if(class_exists("woocommerce")){
                // Shop
                Redux::setSection( $bzotech_option_name, array(
                    'title'            => esc_html__( 'Shop', 'bw-petito' ),
                    'id'               => 'shop',
                    'icon'             => 'el el-shopping-cart'
                ) );
                Redux::setSection( $bzotech_option_name, array(
                    'title'            => esc_html__( 'General', 'bw-petito' ),
                    'id'               => 'general-shop',
                    'subsection'       => true,
                    'fields'           => array(
                        array(
                            'id'          => 'bzotech_sidebar_position_woo',
                            'type'        => 'select',
                            'title'       => esc_html__('Sidebar Position WooCommerce page','bw-petito'),
                            'desc'        => esc_html__('Set sidebar position for your WooCommerce page(Shop, Checkout, Cart, My Account, Product category/tag/taxonomy page...). Left, Right, or No sidebar.','bw-petito'),
                            'options'     => array(
                                'no'    => esc_html__('No Sidebar','bw-petito'),
                                'left'  => esc_html__('Left','bw-petito'),
                                'right' => esc_html__('Right','bw-petito'),
                            ),
                            'default'  => 'right'
                        ),
                        array(
                            'id'          => 'bzotech_sidebar_woo',
                            'type'        => 'select',
                            'title'       => esc_html__('Sidebar select WooCommerce page','bw-petito'),
                            'data'        => 'sidebars',
                            'required'    => array(
                                array('bzotech_sidebar_position_woo','not','no'),
                                array('bzotech_sidebar_position_woo','not',''),
                            ),
                            'desc'        => esc_html__('Choose one style of sidebar for WooCommerce page','bw-petito'),
                            'default'  => 'blog-sidebar'
                        ),
                        array(
                            'id'          => 'bzotech_sidebar_style_woo',
                            'type'        => 'select',
                            'title'       => esc_html__('Sidebar woo style','bw-petito'),
                            'desc'        => esc_html__('Set sidebar style for your woo.','bw-petito'),
                            'options'     => array(
                                'default'    => esc_html__('Default','bw-petito'),
                                'style2'  => esc_html__('Style2','bw-petito'),
                            ),
                            'required'    => array(
                                array('bzotech_sidebar_position_woo','not','no'),
                                array('bzotech_sidebar_position_woo','not',''),
                            ), 
                            'default'     => 'default'
                        ),   
                        array(
                            'id'          => 'shop_default_style',
                            'type'        => 'select',
                            'title'       => esc_html__('Default style','bw-petito'),
                            'desc'=>esc_html__('Choose a style to active display','bw-petito'),
                            'options'     => array(                        
                                'grid'  => esc_html__('Grid','bw-petito'),
                                'list'  => esc_html__('List','bw-petito'),
                            ),
                            'default'  => 'grid'
                        ),
                        array(
                            'id'          => 'shop_gap_product',
                            'type'        => 'select',
                            'title'       => esc_html__('Gap Products','bw-petito'),
                            'desc'=>esc_html__('Choose space. The space between the items on the shop page.','bw-petito'),
                            'options'     => array(                        
                                ''          => esc_html__('Default','bw-petito'),
                                'gap-0'     => esc_html__('0','bw-petito'),
                                'gap-5'     => esc_html__('5px','bw-petito'),
                                'gap-10'    => esc_html__('10px','bw-petito'),
                                'gap-15'    => esc_html__('15px','bw-petito'),
                                'gap-20'    => esc_html__('20px','bw-petito'),
                                'gap-30'    => esc_html__('30px','bw-petito'),
                                'gap-40'    => esc_html__('40px','bw-petito'),
                                'gap-50'    => esc_html__('50px','bw-petito'),
                            ),
                        ),
                        array(
                            'id'          => 'woo_shop_number',
                            'type'        => 'slider',
                            'title'       => esc_html__('Product Number','bw-petito'),
                            'min'         => 0,
                            'max'         => 999,
                            'step'        => 1,
                            'default'     => 12,
                            'desc'        => esc_html__('Enter number product to display per page. Default is 12.','bw-petito')
                        ),
                        array(
                            'id'          => 'sv_set_time_woo',
                            'type'        => 'slider',
                            'title'       => esc_html__('Product new in(days)','bw-petito'),
                            'min'         => 0,
                            'max'         => 999,
                            'step'        => 1,
                            'default'     => 0,
                            'desc'        => esc_html__('Enter number to set time for product is new. Unit day. Default is 0 ..','bw-petito')
                        ),
                        array(
                            'id'          => 'shop_style',
                            'type'        => 'select',
                            'title'       => esc_html__('Shop pagination','bw-petito'),
                            'desc'=>esc_html__('Choose a style to active display','bw-petito'),
                            'options'     => array(
                                ''          => esc_html__('Default','bw-petito'),
                                'load-more' => esc_html__('Load more','bw-petito'),
                            )
                        ),
                        array(
                            'id'          => 'shop_ajax',
                            'type'        => 'switch',
                            'title'       => esc_html__('Shop ajax','bw-petito'),
                            'default'     => false,
                            'desc'        => esc_html__('Enable ajax process for your shop page.','bw-petito'),
                            'default'     => false
                        ),
                        array(
                            'id'          => 'shop_thumb_animation',
                            'type'        => 'select',
                            'title'       => esc_html__('Thumbnail animation','bw-petito'),
                            'desc'        => esc_html__('Choose a animation.','bw-petito'),
                            'options'     => bzotech_get_product_thumb_animation()
                        ),
                        array(
                            'id'          => 'shop_number_filter',
                            'type'        => 'switch',
                            'title'       => esc_html__('Show number filter','bw-petito'),
                            'desc'        => esc_html__('Show/hide number filter on shop page.','bw-petito'),
                            'default'     => false,
                        ),
                        array(
                            'id'          => 'shop_number_filter_list',
                            'type'        => 'repeater',
                            'title'       => esc_html__('Add list number filter','bw-petito'),
                            'desc'        => esc_html__('Add custom list number to filter on the shop page.','bw-petito'),
                            'fields'      => array(
                                array(
                                    'id'          => 'number',
                                    'type'        => 'text',
                                    'title'       => esc_html__('Number','bw-petito'),
                                ),
                            ),
                            'required'   => array('shop_number_filter','not',false),
                            'default'  => ''
                        ),
                        array(
                            'id'          => 'shop_type_filter',
                            'type'        => 'switch',
                            'title'       => esc_html__('Show type filter','bw-petito'),
                            'desc'        => esc_html__('Show/hide type filter(list/grid) on shop page.','bw-petito'),
                            'default'     => false,
                        ),
                        array(
                            'id'          => 'shop_order_filter',
                            'type'        => 'switch',
                            'title'       => esc_html__('Show order filter','bw-petito'),
                            'desc'        => esc_html__('Show/hide order filter(list/grid) on shop page.','bw-petito'),
                            'default'     => false,
                        ),

                        array(
                            'id'          => 'shop_attribute_color',
                            'title'       => esc_html__('Show color attribute','bw-petito'),
                            'desc'        => esc_html__('Show/hide color attribute on list item product.','bw-petito'),
                            'type'        => 'switch',
                            'section'     => 'option_woo',
                            'default'     => false,
                        ),
                        array(
                            'id'          => 'show_quick_view',
                            'title'       => esc_html__('Show button quick view','bw-petito'),
                            'type'        => 'switch',
                            'section'     => 'option_woo',
                            'default'     => false,
                        ),
                        array(
                            'id'          => 'quick_view_style',
                            'title'       => esc_html__('Quick view style','bw-petito'),
                            'type'        => 'select',
                            'section'     => 'option_woo',
                            'desc'        => esc_html__('Choose a style to display','bw-petito'),
                            'default'         => '',
                            'condition'   => 'show_quick_view:is(1)',
                            'options'     => array(
                                ''          => esc_html__('Default','bw-petito'),
                                'load-more' => esc_html__('Style 1 (default)','bw-petito'),
                            )
                        ),
                    )
                ) );
                
                Redux::setSection( $bzotech_option_name, array(
                    'title'            => esc_html__( 'List Settings', 'bw-petito' ),
                    'id'               => 'list-shop',
                    'subsection'       => true,
                    'fields'           => array(
                        array(
                            'id'          => 'shop_list_size',
                            'type'        => 'text',
                            'title'       => esc_html__('Custom list thumbnail size','bw-petito'),
                            'desc'        => esc_html__('Enter size thumbnail to crop. [width]x[height]. Example is 300x300.','bw-petito')
                        ),
                        array(
                            'id'          => 'shop_list_item_style',
                            'type'        => 'select',
                            'title'       => esc_html__('List item style','bw-petito'),
                            'desc'        => esc_html__('Choose a style to active display (Keep empty to select default style)','bw-petito'),
                            'options'     => bzotech_get_product_list_style()
                        ),
                    )
                ) );

                Redux::setSection( $bzotech_option_name, array(
                    'title'            => esc_html__( 'Grid Settings', 'bw-petito' ),
                    'id'               => 'grid-shop',
                    'subsection'       => true,
                    'fields'           => array(
                        array(
                            'id'          => 'shop_grid_column',
                            'type'        => 'select',
                            'title'       => esc_html__('Grid column','bw-petito'),
                            'default'     => '3',
                            'desc'        => esc_html__('Choose a style to active display','bw-petito'),
                            'options'     => array(
                                '2'     => esc_html__('2 column','bw-petito'),
                                '3'     => esc_html__('3 column','bw-petito'),
                                '4'     => esc_html__('4 column','bw-petito'),
                                '5'     => esc_html__('5 column','bw-petito'),
                                '6'     => esc_html__('6 column','bw-petito'),
                                '7'     => esc_html__('7 column','bw-petito'),
                                '8'     => esc_html__('8 column','bw-petito'),
                                '9'     => esc_html__('9 column','bw-petito'),
                                '10'    => esc_html__('10 column','bw-petito'),
                            )
                        ),
                        array(
                            'id'          => 'shop_grid_size',
                            'type'        => 'text',
                            'title'       => esc_html__('Custom grid thumbnail size','bw-petito'),
                            'desc'        => esc_html__('Enter size thumbnail to crop. [width]x[height]. Example is 300x300.','bw-petito')
                        ),
                        array(
                            'id'          => 'shop_grid_item_style',
                            'type'        => 'select',
                            'title'       => esc_html__('Grid item style','bw-petito'),
                            'desc'        => esc_html__('Choose a style to active display (Keep empty to select Default style)','bw-petito'),
                            'options'     => bzotech_get_product_style()
                        ),
                        array(
                            'id'          => 'shop_grid_type',
                            'type'        => 'select',
                            'title'       => esc_html__('Grid display','bw-petito'),
                            'desc'        => esc_html__('Choose a style to active display','bw-petito'),
                            'options'     => array(
                                ''              => esc_html__('Default','bw-petito'),
                                'grid-masonry'  => esc_html__('Masonry','bw-petito'),
                            )
                        ),
                    )
                ) );

                Redux::setSection( $bzotech_option_name, array(
                    'title'            => esc_html__( 'Advanced', 'bw-petito' ),
                    'id'               => 'advanced-shop',
                    'subsection'       => true,
                    'fields'           => array(
                        array(
                            'id'          => 'cart_page_style',
                            'type'        => 'select',
                            'title'       => esc_html__('Cart display','bw-petito'),
                            'desc'        => esc_html__('Choose a style to active display','bw-petito'),
                            'options'     => array(
                                ''          => esc_html__('Default','bw-petito'),
                                'style2'    => esc_html__('Style 2','bw-petito'),
                            )
                        ),
                        array(
                            'id'          => 'checkout_page_style',
                            'type'        => 'select',
                            'title'       => esc_html__('Checkout display','bw-petito'),
                            'desc'        => esc_html__('Choose a style to active display','bw-petito'),
                            'options'     => array(
                                ''          => esc_html__('Default','bw-petito'),
                                'style2'    => esc_html__('Style 2','bw-petito'),
                            )
                        ),
                        array(
                            'id'          => 'bzotech_header_page_woo',
                            'type'        => 'select',
                            'title'       => esc_html__( 'Header WooCommerce Page', 'bw-petito' ),
                            'desc'        => esc_html__( 'Include Header content. Go to Header in admin menu to edit/create header content. Note this value default for all pages of your site, If have any page/single page display other content pehaps you are set specific header for it', 'bw-petito' ),
                            'options'     => bzotech_list_post_type('bzotech_header')
                        ),
                        array(
                            'id'          => 'bzotech_footer_page_woo',
                            'type'        => 'select',
                            'title'       => esc_html__( 'Footer WooCommerce Page', 'bw-petito' ),
                            'desc'        => esc_html__( 'Include Footer content. Go to Footer in admin menu to edit/create footer content.  Note this value default for all pages of your site, If have any page/single page display other content pehaps you are set specific footer for it', 'bw-petito' ),
                            'options'     => bzotech_list_post_type('bzotech_footer')
                        ),
                        array(
                            'id'          => 'before_append_woo',
                            'type'        => 'select',
                            'title'       => esc_html__('Append content before WooCommerce page','bw-petito'),
                            'options'     => bzotech_list_post_type('bzotech_mega_item'),
                            'desc'        => esc_html__('Choose a mega page content append to before main content of page/post.','bw-petito'),
                        ),
                        array(
                            'id'          => 'after_append_woo',
                            'type'        => 'select',
                            'title'       => esc_html__('Append content after WooCommerce page','bw-petito'),
                            'options'     => bzotech_list_post_type('bzotech_mega_item'),
                            'desc'        => esc_html__('Choose a mega page content append to after main content of page/post.','bw-petito'),
                        ),
                    )
                ) );
                // End Shop

                // Product
                Redux::setSection( $bzotech_option_name, array(
                    'title'            => esc_html__( 'Product', 'bw-petito' ),
                    'id'               => 'product',
                    'icon'             => 'el el-briefcase'
                ) );
                Redux::setSection( $bzotech_option_name, array(
                    'title'            => esc_html__( 'General', 'bw-petito' ),
                    'id'               => 'general-product',
                    'subsection'       => true,
                    'fields'           => array(
                    array(
                        'id'          => 'sv_style_woo_single',
                        'title'       => esc_html__('Product detail style','bw-petito'),
                        'type'        => 'select',
                        'section'     => 'option_product',
                        'default'         => 'style-gallery-horizontal',
                        'desc'        => esc_html__('Select style of product detail','bw-petito'),
                        'options'     => array(
                                'style-gallery-horizontal'=> esc_html__('Style 1 (Gallery horizontal )','bw-petito'),
                                'style-gallery-vertical' => esc_html__('Style 2 (Gallery vertical)','bw-petito'),
                                'sticky-style1' => esc_html__('Style 3 (Gallery sticky)','bw-petito'),
                                'sticky-style2' => esc_html__('Style 4 (Gallery sticky)','bw-petito'),
                                'sticky-style3' => esc_html__('Style 5 (Gallery sticky)','bw-petito'),
                                'style-gallery-horizontal2' => esc_html__('Style 6 (Gallery horizontal 2)','bw-petito'),
                                'style-gallery-vertical2' => esc_html__('Style 7 (Gallery vertical 2)','bw-petito'),
                            )
                        ),
                        array(
                            'id'          => 'sv_sidebar_position_woo_single',
                            'type'        => 'select',
                            'title'       => esc_html__('Sidebar Position WooCommerce Single','bw-petito'),
                            'desc'        => esc_html__('Left, or Right, or Center','bw-petito'),
                            'default'         => 'no',
                            'options'     => array(
                                'no'    => esc_html__('No Sidebar','bw-petito'),
                                'left'  => esc_html__('Left','bw-petito'),
                                'right' => esc_html__('Right','bw-petito'),
                            ),
                        ),
                        array(
                            'id'          => 'sv_sidebar_woo_single',
                            'type'        => 'select',
                            'title'       => esc_html__('Sidebar select WooCommerce Single','bw-petito'),
                            'data'        => 'sidebars',
                            'required'    => array(
                                array('sv_sidebar_position_woo_single','not','no'),
                                array('sv_sidebar_position_woo_single','not',''),
                            ),
                            'desc'        => esc_html__('Choose one style of sidebar for WooCommerce page','bw-petito'),
                        ),
                        array(
                            'id'          => 'bzotech_sidebar_style_woo_single',
                            'type'        => 'select',
                            'title'       => esc_html__('Sidebar product style','bw-petito'),
                            'desc'        => esc_html__('Set sidebar style for your product.','bw-petito'),
                            'options'     => array(
                                'default'    => esc_html__('Default','bw-petito'),
                                'style2'  => esc_html__('Style2','bw-petito'),
                            ),
                            'required'    => array(
                                array('sv_sidebar_position_woo_single','not','no'),
                                array('sv_sidebar_position_woo_single','not',''),
                            ), 
                            'default'     => 'default'
                        ),  
                        array(
                            'id'          => 'product_image_zoom',
                            'type'        => 'select',
                            'title'       => esc_html__('Image zoom','bw-petito'),
                            'desc'        => esc_html__('Choose a style to display','bw-petito'),
                            'options'     => array(
                                ''              => esc_html__('None','bw-petito'),
                                'zoom-style1'   => esc_html__('Zoom 1','bw-petito'),
                                'zoom-style2'   => esc_html__('Zoom 2','bw-petito'),
                                'zoom-style3'   => esc_html__('Zoom 3','bw-petito'),
                                'zoom-style4'   => esc_html__('Zoom 4','bw-petito'),
                            )
                        ),
                        array(
                            'id'          => 'product_tab_detail',
                            'type'        => 'select',
                            'title'       => esc_html__('Product tab style','bw-petito'),
                            'desc'        => esc_html__('Choose a style to display','bw-petito'),
                            'default'         => 'tab-product-horizontal',
                            'options'     => array(
                                'tab-product-horizontal'=> esc_html__("Tab style horizontal", 'bw-petito'),
                                'tab-product-vertical'=> esc_html__("Tab style vertical", 'bw-petito'),
                            )
                        ),
                        array(
                            'id'          => 'show_excerpt',
                            'type'        => 'switch',
                            'title'       => esc_html__('Show Excerpt','bw-petito'),
                            'default'     => true
                        ),
                    )
                ) );

                Redux::setSection( $bzotech_option_name, array(
                    'title'            => esc_html__( 'Extra display', 'bw-petito' ),
                    'id'               => 'display-product',
                    'subsection'       => true,
                    'fields'           => array(
                       array(
                            'id'          => 'show_latest',
                            'type'        => 'switch',
                            'title'       => esc_html__('Show latest products','bw-petito'),
                            'default'     => false
                        ),
                        array(
                            'id'          => 'show_upsell',
                            'type'        => 'switch',
                            'title'       => esc_html__('Show upsell products','bw-petito'),
                            'default'     => false
                        ),
                        array(
                            'id'          => 'show_related',
                            'type'        => 'switch',
                            'title'       => esc_html__('Show related products','bw-petito'),
                            'section'     => 'option_product',
                            'default'     => false
                        ),
                        array(
                            'id'          => 'show_single_number',
                            'type'        => 'slider',
                            'title'       => esc_html__('Show Single Number','bw-petito'),
                            'min'         => '1',
                            'max'         => '100',
                            'step'        => '1',
                            'default'     => '6'
                        ),
                        array(
                            'id'          => 'show_single_size',
                            'type'        => 'text',
                            'title'       => esc_html__('Show Single Size','bw-petito'),
                            'desc'        => esc_html__('Custom size for related,upsell products. Enter size thumbnail to crop. [width]x[height]. Example is 300x300.','bw-petito'),
                        ),
                        array(
                            'id'          => 'show_single_itemres',
                            'type'        => 'text',
                            'title'       => esc_html__('Custom item devices','bw-petito'),
                            'desc'        => esc_html__('Enter item for screen width(px) format is width:value and separate values by ",". Example is 0:2,600:3,1000:4. Default is auto.','bw-petito'),
                        ),
                        array(
                            'id'          => 'show_single_item_style',
                            'type'        => 'select',
                            'title'       => esc_html__('Single item style','bw-petito'),
                            'desc'        => esc_html__('Choose a style to active display','bw-petito'),
                            'options'     => bzotech_get_product_style()
                        ),
                    )
                ) );

                Redux::setSection( $bzotech_option_name, array(
                    'title'            => esc_html__( 'Advanced', 'bw-petito' ),
                    'id'               => 'advanced-product',
                    'subsection'       => true,
                    'fields'           => array(
                       array(
                            'id'          => 'before_append_woo_single',
                            'type'        => 'select',
                            'title'       => esc_html__('Append content before product page','bw-petito'),
                            'options'     => bzotech_list_post_type('bzotech_mega_item'),
                            'desc'        => esc_html__('Choose a mega page content append to before main content of page/post.','bw-petito'),
                        ),
                        array(
                            'id'          => 'before_append_tab',
                            'type'        => 'select',
                            'title'       => esc_html__('Append content before product tab','bw-petito'),
                            'options'     => bzotech_list_post_type('bzotech_mega_item'),
                            'desc'        => esc_html__('Choose a mega page content append to before product tab.','bw-petito'),
                        ),
                        array(
                            'id'          => 'after_append_tab',
                            'type'        => 'select',
                            'title'       => esc_html__('Append content after product tab','bw-petito'),
                            'options'     => bzotech_list_post_type('bzotech_mega_item'),
                            'desc'        => esc_html__('Choose a mega page content append to before product tab.','bw-petito'),
                        ),
                        array(
                            'id'          => 'after_append_woo_single',
                            'type'        => 'select',
                            'title'       => esc_html__('Append content after product page','bw-petito'),
                            'options'     => bzotech_list_post_type('bzotech_mega_item'),
                            'desc'        => esc_html__('Choose a mega page content append to after main content of page/post.','bw-petito'),
                        ),
                    )
                ) );
                // End Product
            }
        }
    }
    // End Redux help function
    // This is your option name where all the Redux data is stored.

    $bzotech_option_name = bzotech_get_option_name();

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $bzotech_option_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__( 'Theme Options', 'bw-petito' ),
        'page_title'           => esc_html__( 'Theme Options', 'bw-petito' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => 'AIzaSyBFxhycc63fWy_uk126zW8KPtkD3Bay0jI',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => true,
        // Show the time the page took to load, etc
        'update_notice'        => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        

        // OPTIONAL -> Give you extra features
        'page_priority'        => 59,//29
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        'menu_icon'            => get_template_directory_uri().'/assets/admin/image/logo.png',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '_options',
        // Page slug used to denote the panel
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_options_object' => false,
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!

        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

      

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'light',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    
    $args['share_icons'][] = array(
        'url'   => 'https://www.facebook.com/',
        'title' => 'Like us on Facebook',
        'icon'  => 'el el-facebook'
    );
    $args['share_icons'][] = array(
        'url'   => 'https://twitter.com/',
        'title' => 'Follow us on Twitter',
        'icon'  => 'el el-twitter'
    );
    $args['share_icons'][] = array(
        'url'   => 'https://www.youtube.com/',
        'title' => 'Find us on Youtube',
        'icon'  => 'el el-youtube'
    );
    Redux::setArgs( $bzotech_option_name, $args );

    /*
     * ---> END ARGUMENTS
     */    
    
    bzotech_switch_redux_option();


