<?php
namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * Elementor Account manager
 *
 * Elementor widget for Account manager
 *
 * @since 1.0.0
 */
class Bzotech_Account extends Widget_Base {

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
		return 'bzotech-account';
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
		return esc_html__( 'Account manager', 'bw-petito' );
	}
	public function get_style_depends() {
		return [ 'bzotech-account' ];
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
		return 'eicon-person';
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

	public function get_roles() {
		global $wp_roles;
        $roles = array();
        if(isset($wp_roles->roles)){
            $roles_data = $wp_roles->roles;
            if(is_array($roles_data)){
                foreach ($roles_data as $key => $value) {
                    $roles[$key] = $value['name'];
                }
            }
        }
        return $roles;
	}

	public function login_form($redirect_to = '') {
		if(empty($redirect_to)) $redirect_to =  apply_filters( 'login_redirect',home_url('/'));
        ?>
        <div class="elbzotech-login-form popup-form active">
            <div class="form-header">
                <h2><?php esc_html_e( 'Log In','bw-petito' ); ?></h2>
                <div class="desc"><?php esc_html_e( 'Become a part of our community!','bw-petito' ); ?></div>
                <div class="message ms-done ms-default"><?php esc_html_e( 'Registration complete. Please check your email.','bw-petito' ); ?></div>
            </div>
            <form name="loginform" id="loginform" action="<?php echo esc_url( home_url( 'wp-login.php', 'login_post' ) ); ?>" method="post">
                <?php do_action( 'woocommerce_login_form_start' ); ?>
                <div class="form-field">
                    <input placeholder="<?php esc_attr_e( 'Username or Email Address','bw-petito' ); ?>" type="text" name="log" id="user_login" class="input" size="20" autocomplete="off"/>
                </div>
                <div class="form-field">
                	<input placeholder="<?php esc_attr_e( 'Password','bw-petito' ); ?>" type="password" name="pwd" id="user_pass" class="input" value="" size="20" autocomplete="off"/>
                </div>
                <div class="extra-field">
                    <?php 
                        if(class_exists("woocommerce")) do_action( 'woocommerce_login_form' );
                        else do_action( 'login_form' );
                    ?>
                </div>
                <div class="forgetmenot">
                    <input name="rememberme" type="checkbox" id="remembermep" value="forever" />
                    <label class="rememberme" for="remembermep"><?php esc_html_e( 'Remember Me','bw-petito' ); ?></label>
                </div>
                <div class="submit">
                    <input type="submit" name="wp-submit" class="elbzotech-bt-default elbzotech-bt-full" value="<?php esc_attr_e('Log In','bw-petito'); ?>" />
                    <input type="hidden" name="redirect_to1" value="<?php echo esc_attr($redirect_to); ?>" />
                </div>
                <?php do_action( 'woocommerce_login_form_end' ); ?>
            </form>
            <div class="nav-form">
                <?php if ( get_option( 'users_can_register' ) ) :
                    echo '<a href="#registerform" class="popup-redirect register-link">'.esc_html__("Register",'bw-petito').'</a>';
                endif;
                echo '<a href="#lostpasswordform" class="popup-redirect lostpass-link">'.esc_html__("Lost your password?",'bw-petito').'</a>';
                ?>
            </div>
        </div>
        <?php
	}

	public function register_form($redirect_to = '') {
		if(empty($redirect_to)) $redirect_to = apply_filters( 'registration_redirect', wp_login_url() );
        ?>
        <div class="elbzotech-register-form popup-form">
            <div class="form-header">
                <h2><?php esc_html_e( 'Create an account','bw-petito' ); ?></h2>
                <div class="desc"><?php esc_html_e( 'Welcome! Register for an account','bw-petito' ); ?></div>
                <div class="message login_error ms-error ms-default"><?php esc_html_e( 'The user name or email address is not correct.','bw-petito' ); ?></div>
                
            </div>
            <form name="registerform" id="registerform" action="<?php echo esc_url( home_url( 'wp-login.php?action=register', 'login_post' ) ); ?>" method="post" novalidate="novalidate">
                <?php do_action( 'woocommerce_register_form_start' ); ?>
                <div class="form-field">
                    <input placeholder="<?php esc_attr_e('Username','bw-petito') ?>" type="text" name="user_login" id="user_loginr" class="input" value="" size="20" autocomplete="off"/>
                </div>
                <div class="form-field">
                    <input placeholder="<?php esc_attr_e('Email','bw-petito') ?>" type="email" name="user_email" id="user_email" class="input" value="" size="25" autocomplete="off"/>
                </div>
                <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ){ ?>
                    <div class="form-field">
                        <input placeholder="<?php esc_attr_e( 'Password', 'bw-petito' ); ?>" type="password" name="password" id="reg_passwordp" autocomplete="new-password" />
                    </div>
                <?php }?>
                <div class="extra-field">
                    <?php 
                        if(class_exists("woocommerce")) do_action( 'woocommerce_register_form' );
                        else do_action( 'register_form' );
                    ?>
                    <input type="hidden" name="redirect_to1" value="<?php echo esc_attr( $redirect_to ); ?>" />
                </div>                
                <?php if ( 'no' != get_option( 'woocommerce_registration_generate_password' ) ){ ?>
                    <div id="reg_passmail">
                        <?php esc_html_e( 'Registration confirmation will be emailed to you.','bw-petito' ); ?>
                    </div>
                <?php }?>
                <div class="submit"><input type="submit" name="wp-submit" class="elbzotech-bt-default elbzotech-bt-full" value="<?php esc_attr_e('Register','bw-petito'); ?>" /></div>
                <?php do_action( 'woocommerce_register_form_end' ); ?>
            </form>

            <div class="nav-form">
                <a href="#loginform" class="popup-redirect login-link"><?php esc_html_e( 'Log in','bw-petito' ); ?></a>
                <a href="#lostpasswordform" class="popup-redirect lostpass-link"><?php esc_html_e( 'Lost your password?','bw-petito' ); ?></a>
            </div>
        </div>
        <?php
	}
	public function lostpass_form($redirect_to = '') {
		if(empty($redirect_to)) $redirect_to =  apply_filters( 'login_redirect',home_url('/'));
        ?>
        <div class="elbzotech-lostpass-form popup-form">
            <div class="form-header">
                <h2><?php esc_html_e( 'Reset password','bw-petito' ); ?></h2>
                <div class="desc"><?php esc_html_e( 'Recover your password','bw-petito' ); ?></div>
                <div class="message ms-default ms-done"><?php esc_html_e( 'Password reset email has been sent.','bw-petito' ); ?></div>
                <div class="message login_error ms-error ms-default"><?php esc_html_e( 'The email could not be sent.
Possible reason: your host may have disabled the mail function.','bw-petito' ); ?></div>
            </div>
            <form name="lostpasswordform" id="lostpasswordform" action="<?php echo esc_url( home_url( 'wp-login.php?action=lostpassword', 'login_post' ) ); ?>" method="post">
                <div class="form-field">
                    <input placeholder="<?php esc_attr_e( 'Username or Email Address','bw-petito' ); ?>" type="text" name="user_login" id="user_loginlp" class="input" value="" size="20" autocomplete="off"/>
                </div>
                <div class="extra-field">
                    <?php do_action( 'lostpassword_form' ); ?>
                    <input type="hidden" name="redirect_to1" value="<?php echo esc_attr( $redirect_to ); ?>" />
                </div>
                <div class="submit"><input type="submit" name="wp-submit" class="elbzotech-bt-default elbzotech-bt-full" value="<?php esc_attr_e('Get New Password','bw-petito'); ?>" /></div>
                <div class="desc note"><?php esc_html_e( 'A password will be e-mailed to you.','bw-petito' ); ?></div>
            </form>

            <div class="nav-form">
                <a href="#loginform" class="popup-redirect login-link"><?php esc_html_e('Log in','bw-petito') ?></a>
                <?php
                if ( get_option( 'users_can_register' ) ) :
                    echo '<a href="#registerform" class="popup-redirect register-link">'.esc_html__("Register",'bw-petito').'</a>';
                endif;
                ?>
            </div>
        </div>
        <?php
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
			'section_style',
			[
				'label' => esc_html__( 'Style', 'bw-petito' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'style',
			[
				'label' 	=> esc_html__( 'Style', 'bw-petito' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'elbzotech-account-default',
				'options'   => [
					'elbzotech-account-default'		=> esc_html__( 'Style 1 (Default)', 'bw-petito' ),
					'elbzotech-account-default2'		=> esc_html__( 'Style 2', 'bw-petito' )
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button',
			[
				'label' => esc_html__( 'Button', 'bw-petito' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'bw-petito' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-user',
					'library' => 'solid',
				],
			]
		);

		$this->add_control(
			'icon_logged',
			[
				'label' => esc_html__( 'Icon logged', 'bw-petito' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-user',
					'library' => 'solid',
				],
			]
		);

		$this->add_responsive_control(
			'align_icon',
			[
				'label' => esc_html__( 'Alignment', 'bw-petito' ),
				'type' => Controls_Manager::CHOOSE,
				'default'	=> '',
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'bw-petito' ),
						'icon' => 'eicon-text-align-left',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'bw-petito' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'account_bttext',
			[
				'label' => esc_html__( 'Add text', 'bw-petito' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Type your text to add search button', 'bw-petito' ),
			]
		);

		$this->add_control(
			'account_bttext_pos',
			[
				'label' => esc_html__( 'Text position', 'bw-petito' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'after-icon',
				'options' => [
					'after-icon'   => esc_html__( 'After icon', 'bw-petito' ),
					'before-icon'  => esc_html__( 'Before icon', 'bw-petito' ),
				],
				'condition' => [
					'account_bttext!' => '',
					'icon[value]!' => '',
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_links',
			[
				'label' => esc_html__( 'Links', 'bw-petito' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		
		$repeater_text = new Repeater();
		$repeater_text->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'bw-petito' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-user',
					'library' => 'solid',
				],
			]
		);
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

		$repeater_text->add_control(
			'roles',
			[
				'label' => esc_html__( 'Show with roles', 'bw-petito' ),
				'description' => esc_html__( 'Choose roles to show. Default is show with all roles', 'bw-petito' ),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => $this->get_roles(),
				'default' => [],
			]
		);

		$this->add_control(
			'list_links',
			[
				'label' => esc_html__( 'Add links', 'bw-petito' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty'=>false,
				'fields' => $repeater_text->get_controls(),
				'title_field' => '{{{ text }}}',
			]
		);

		$this->add_responsive_control(
			'wrap_links_left',
			[
				'label' => esc_html__( 'Wrap Left', 'bw-petito' ),
				'type' => Controls_Manager::CHOOSE,
				'default'	=> '',
				'options' => [
					'0' => [
						'title' => esc_html__( '0', 'bw-petito' ),
						'icon' => 'eicon-text-align-left',
					],
					'inherit' => [
						'title' => esc_html__( 'Inherit', 'bw-petito' ),
						'icon' => 'eicon-text-align-center',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elbzotech-account-manager .elbzotech-dropdown-list' => 'left: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'wrap_links_right',
			[
				'label' => esc_html__( 'Wrap Right', 'bw-petito' ),
				'type' => Controls_Manager::CHOOSE,
				'default'	=> '',
				'options' => [
					'0' => [
						'title' => esc_html__( '0', 'bw-petito' ),
						'icon' => 'eicon-text-align-right',
					],
					'inherit' => [
						'title' => esc_html__( 'Inherit', 'bw-petito' ),
						'icon' => 'eicon-text-align-center',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elbzotech-account-manager .elbzotech-dropdown-list' => 'right: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => esc_html__( 'Button', 'bw-petito' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'width_icon',
			[
				'label' => esc_html__( 'Width', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' , '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .button-account-manager' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'height_icon',
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
					'{{WRAPPER}} .button-account-manager' => 'line-height: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'size_icon',
			[
				'label' => esc_html__( 'Size icon', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .button-account-manager  i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'icon_account_effects' );

		$this->start_controls_tab( 'icon_account_normal',
			[
				'label' => esc_html__( 'Normal', 'bw-petito' ),
			]
		);

		$this->add_control(
			'color_icon',
			[
				'label' => esc_html__( 'Icon Color', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .button-account-manager i' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'color_text',
			[
				'label' => esc_html__( 'Text Color', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .button-account-manager span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'account_text_button_typography',
				'label' => esc_html__( 'Typography button text', 'bw-petito' ),
				'selector' => '{{WRAPPER}} .button-account-manager span',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_icon',
				'label' => esc_html__( 'Background', 'bw-petito' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .button-account-manager',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'shadow_icon',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .button-account-manager',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_icon',
				'selector' => '{{WRAPPER}} .button-account-manager',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'border_icon',
			[
				'label' => esc_html__( 'Border Radius', 'bw-petito' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .button-account-manager' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'icon_account_hover',
			[
				'label' => esc_html__( 'Hover', 'bw-petito' ),
			]
		);

		$this->add_control(
			'color_icon_hover',
			[
				'label' => esc_html__( 'Icon Color', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .button-account-manager:hover i' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'color_text_hover',
			[
				'label' => esc_html__( 'Text Color', 'bw-petito' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .button-account-manager:hover span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'account_text_button_typography:hover',
				'label' => esc_html__( 'Typography button text', 'bw-petito' ),
				'selector' => '{{WRAPPER}} .button-account-manager:hover span',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_icon_hover',
				'label' => esc_html__( 'Background', 'bw-petito' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .button-account-manager:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'shadow_icon_hover',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .button-account-manager:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_icon_hover',
				'selector' => '{{WRAPPER}} .button-account-manager:hover',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'border_icon_hover',
			[
				'label' => esc_html__( 'Border Radius', 'bw-petito' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .button-account-manager:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();	

		$this->add_control(
			'separator_icon_popup',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->add_responsive_control(
			'padding_icon',
			[
				'label' => esc_html__( 'Padding', 'bw-petito' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .button-account-manager' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'margin_icon',
			[
				'label' => esc_html__( 'Margin', 'bw-petito' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .button-account-manager' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_links',
			[
				'label' => esc_html__( 'Links', 'bw-petito' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'width_links',
			[
				'label' => esc_html__( 'Width', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' , '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elbzotech-account-manager .elbzotech-dropdown-list' => 'width: {{SIZE}}{{UNIT}};max-width: inherit;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'shadow_links',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .elbzotech-account-manager .elbzotech-dropdown-list',
			]
		);

		$this->add_responsive_control(
			'space_links',
			[
				'label' => esc_html__( 'Space', 'bw-petito' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' , '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elbzotech-account-manager .elbzotech-dropdown-list li' => 'line-height: {{SIZE}}{{UNIT}};',
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
		$settings = $this->get_settings();
		$name = '';

        $account_id = get_option('woocommerce_myaccount_page_id');
        if(empty($login_url)){
	        if($account_id) $login_url = get_permalink( $account_id );
	        else $login_url = wp_login_url();
	    }
	    
		if(is_user_logged_in()){
			$current_user = wp_get_current_user();
	        if(!empty($current_user)){
	            $name = $current_user->data->display_name;
	        }
			$title_account = sprintf(wp_kses_post(__( 'Hello <span>%s</span>','bw-petito' )), $name);
			$html_a = '<a class="button-account-manager" href="'.esc_url($login_url).'">';
			
		}else{
			
			$title_account = $settings['account_bttext'];
			$html_a = '<a class="button-account-manager" href="#">';
		}
		?>
		<div class="elbzotech-account-manager elbzotech-dropdown-box <?php echo esc_attr($settings['style'])?>">
			
			<?php echo  apply_filters('bzotech_output_content',$html_a); ?>
					<?php if($title_account && $settings['account_bttext_pos'] == 'before-icon') echo '<span class="account-bttext">'.$title_account.'</span>'?>
					<?php 
					$icon_stt = '';
					if(is_user_logged_in()) $icon_stt = '_logged';
					Icons_Manager::render_icon( $settings['icon'.$icon_stt], [ 'aria-hidden' => 'true' ] ); 
					?>
					<?php if($title_account && $settings['account_bttext_pos'] == 'after-icon') echo '<span class="account-bttext">'.$title_account.'</span>'?>
			</a>


			<?php if(is_user_logged_in()): ?>
				<?php if(!empty($settings['list_links'])){ ?>
					<ul class="elbzotech-dropdown-list">
				    	<?php 
				    	foreach (  $settings['list_links'] as $item ) {
							$target = $item['link']['is_external'] ? ' target="_blank"' : '';
							$nofollow = $item['link']['nofollow'] ? ' rel="nofollow"' : '';
							echo '<li><a href="'.$item['link']['url'].'"'.$target.$nofollow.' class="elementor-repeater-item-'.$item['_id'].'">';
							Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] );
							echo apply_filters('bzotech_output_content',$item['text']);
							echo '</a></li>';
						}
				    	?>
				    </ul>
				<?php } ?>
				
			  <?php else:?>
			  	<div class="login-popup-content-wrap elbzotech-popup-overlay">
			  		
	                <div class="elbzotech-login-popup-content bzotech-scrollbar">
						<i class="las la-times elbzotech-close-popup"></i>
	                    <?php
	                    $this->login_form();
	                    $this->register_form();
	                    $this->lostpass_form();
	                    ?>
	                </div>
	                <div class="popup-overlay"></div>
	            </div>
			<?php endif;?>
		</div>
		<?php
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
}
