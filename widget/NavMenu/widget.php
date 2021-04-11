<?php
/**
 * Happyden Team Widget.
 *
 *
 * @since 1.0.0
 */
namespace Happyden\Widgets\Elementor;
use  Elementor\Widget_Base;
use  Elementor\Controls_Manager;
use  Elementor\utils;
use  Elementor\Scheme_Color;
use  Elementor\Group_Control_Typography;
use  Elementor\Scheme_Typography;
use  Elementor\Group_Control_Box_Shadow;
use  Elementor\Group_Control_Background;
use  Elementor\Group_Control_Border;
if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class HappydenNavMenu extends \Elementor\Widget_Base
{
    /**
     * Get widget name.
     *
     * Retrieve oEmbed widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'happyden-nav-menu';
    }
    /**
     * Get widget title.
     *
     * Retrieve oEmbed widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('Primary Menu', 'finisys');
    }
    /**
     * Get widget icon.
     *
     * Retrieve oEmbed widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-nav-menu';
    }
    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the oEmbed widget belongs to.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['happyden'];
    }
    public function get_keywords(){
        return ['menu', 'main menu', 'nav menu'];
    }
    /**
     * Register oEmbed widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    private function get_available_menus()
    {
        $menus = wp_get_nav_menus();
        $options = [];
        foreach ($menus as $menu) {
            $options[$menu->slug] = $menu->name;
        }
        return $options;
    }
    /**
     * Register oEmbed widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls()
    {
        /**
         * Style tab
         */
        $this->start_controls_section(
            'general',
            [
                'label' => __('Content', 'happyden'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'use_main_menu',
            [
                'label' => __('Use Main Menu', 'happyden'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'happyden'),
                'label_off' => __('No', 'happyden'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $menus = $this->get_available_menus();
        if (!empty($menus)) {
            $this->add_control(
                'primary_menu',
                [
                    'label'        => __('Menu', 'header-footer-elementor'),
                    'type'         => Controls_Manager::SELECT,
                    'options'      => $menus,
                    'default'      => array_keys($menus)[0],
                    'save_default' => true,
                    'separator'    => 'after',
                    /* translators: %s Nav menu URL */
                    'description'  => sprintf(__('Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'header-footer-elementor'), admin_url('nav-menus.php')),
                    'condition'    => [
                        'use_main_menu!' => 'yes',
                    ],
                ]
            );
        } else {
            $this->add_control(
                'menu',
                [
                    'type'            => Controls_Manager::RAW_HTML,
                    /* translators: %s Nav menu URL */
                    'raw'             => sprintf(__('<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'header-footer-elementor'), admin_url('nav-menus.php?action=edit&menu=0')),
                    'separator'       => 'after',
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                ]
            );
        }
        $this->add_control(
            'menu_align',
            [
                'label' => __('Align', 'happyden'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => __('Left', 'happyden'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('top', 'happyden'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'end' => [
                        'title' => __('Right', 'happyden'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .happyden-main-menu-wrap.navbar' => 'justify-content: {{VALUE}};',
                ],
                'default' => 'left',
                'toggle' => true,
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'menu_style',
            [
                'label' => __('Menu Style', 'happyden'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'menu_typography',
                'label' => __('Menu Typography', 'happyden'),
                'selector' => '{{WRAPPER}} .main-navigation ul.navbar-nav>li>a',
            ]
        );
		$this->start_controls_tabs(
			'menu_items_tabs'
		);
		$this->start_controls_tab(
			'menu_normal_tab',
			[
				'label' => __( 'Normal', 'plugin-name' ),
			]
		);
        $this->add_control(
            'menu_color',
            [
                'label' => __('Item Color', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .navbar:not(.active) .main-navigation ul.navbar-nav>li>a, 
                     {{WRAPPER}} .navbar:not(.active) .main-navigation ul.navbar-nav > .menu-item-has-children > a .dropdownToggle,
                     {{WRAPPER}} .mean-container a.meanmenu-reveal span' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .navbar:not(.active) .main-navigation ul.navbar-nav > .menu-item-has-children > a  .dropdownToggle' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .navbar:not(.active) .mean-container a.meanmenu-reveal span',
                ],
            ]
        );
        
        $this->add_control(
            'menu_icon_bar_color',
            [
                'label' => __('Mobile Menu Bar', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .navbar>.navbar-toggler .navbar-toggler-icon, 
                     {{WRAPPER}} .navbar>.navbar-toggler .navbar-toggler-icon:before, 
                     {{WRAPPER}} .navbar>.navbar-toggler .navbar-toggler-icon:after' => 'background-color: {{VALUE}}',
                ],
            ]
        );


        $this->add_control(
            'menu_bg_color',
            [
                'label' => __('Item Background Color', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .navbar:not(.active) .main-navigation ul.navbar-nav>li>a' => 'background-color: {{VALUE}}',
                ],
            ]
        );
		$this->end_controls_tab();
		$this->start_controls_tab(
			'menu_hover_tab',
			[
				'label' => __( 'Hover', 'plugin-name' ),
			]
		);
        $this->add_control(
            'menu_hover_color',
            [
                'label' => __('Menu Homver Color', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .navbar:not(.active) .main-navigation ul.navbar-nav>li>a:hover, 
                     {{WRAPPER}} .navbar:not(.active) .main-navigation ul.navbar-nav > .menu-item-has-children > a:hover .dropdownToggle' => 'color: {{VALUE}}',
                     '{{WRAPPER}} .main-navigation ul.navbar-nav  li.current-menu-item>a' => 'color: {{VALUE}}',
                     '{{WRAPPER}} .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu {{WRAPPER}} .megamenu-width-container .main-navigation ul.navbar-nav>li.happyden-mega-menu>.sub-menu:before' => 'border-color: {{VALUE}}',
                     '{{WRAPPER}} .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu a:hover' => 'color: {{VALUE}}',
                     '{{WRAPPER}} .navbar:not(.active) .main-navigation ul.navbar-nav .sub-menu .menu-item-has-children > a  .dropdownToggle' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'menu_bg_hover_color',
            [
                'label' => __('Item Background Color', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .navbar:not(.active) .main-navigation ul.navbar-nav>li:hover>a' => 'background-color: {{VALUE}}',
                ],
            ]
        );
		$this->end_controls_tab();
		$this->end_controls_tabs();
        $this->add_responsive_control(
            'item_gap',
            [
                'label' => __('Menu Gap', 'happyden'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul.navbar-nav>li>a' => 'margin-left: {{SIZE}}{{UNIT}};margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'item_padding',
            [
                'label' => __('Item Padding', 'happyden'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul.navbar-nav>li>a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .main-navigation ul.navbar-nav>.menu-item-has-children>a' => 'padding: {{TOP}}{{UNIT}} calc({{RIGHT}}{{UNIT}} + 20px) {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'item_readius',
            [
                'label' => __('Item Radius', 'happyden'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul.navbar-nav>li>a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'dropdown_style',
            [
                'label' => __('Dropdown Style', 'happyden'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'dripdown_typography',
                'label' => __('Menu Typography', 'happyden'),
                'selector' => '{{WRAPPER}} .main-navigation ul.navbar-nav>li .sub-menu a',
            ]
        );
		$this->start_controls_tabs(
			'dropdown_items_tabs'
		);
		$this->start_controls_tab(
			'dropdown_normal_tab',
			[
				'label' => __( 'Normal', 'plugin-name' ),
			]
		);


        $this->add_control(
            'dropdown_icon_color',
            [
                'label' => __('Icon Color', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .navbar:not(.active) .main-navigation ul.navbar-nav .sub-menu .menu-item-has-children > a  .dropdownToggle' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'dropdown_item_color',
            [
                'label' => __('Item Color', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu a,
                        {{WRAPPER}} .navbar:not(.active) .main-navigation .sub-menu .menu-item-has-children > a  .dropdownToggle' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'dropdown_item_bg_color',
            [
                'label' => __('Item Background Color', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu a' => 'background-color: {{VALUE}}',
                ],
            ]
        );
		$this->end_controls_tab();
		$this->start_controls_tab(
			'dropdown_hover_tab',
			[
				'label' => __( 'Hover', 'plugin-name' ),
			]
		);

        $this->add_control(
            'dropdown_icon_hover_color',
            [
                'label' => __('Icon Hover Color', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .navbar:not(.active) .main-navigation ul.navbar-nav .sub-menu .menu-item-has-children > a  .dropdownToggle:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'dropdown_item_hover_color',
            [
                'label' => __('Item Homver Color', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu a:hover,
                     {{WRAPPER}} .navbar:not(.active) .main-navigation ul.sub-menu .menu-item-has-children > a  .dropdownToggle, 
                     {{WRAPPER}} .main-navigation ul.navbar-nav  li.current-menu-item>a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'dropdown_item_bg_hover_color',
            [
                'label' => __('Item Background Color', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu a:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'ddown_menu_border_color',
            [
                'label' => __('Menu Border Color', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu' => 'border-color: {{VALUE}}',
                ],
            ]
        );
		$this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_responsive_control(
            'dropdown_item_radius',
            [
                'label' => __('Menu radius', 'happyden'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dropdown_item_padding',
            [
                'label' => __('Item Padding', 'happyden'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'megamenu_style',
            [
                'label' => __('Megamenu Settings', 'happyden'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->start_controls_tabs(
			'megamenu_items_tabs'
		);
		$this->start_controls_tab(
			'megamenu_normal_tab',
			[
				'label' => __( 'Normal', 'plugin-name' ),
			]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'megamenu_title_typography',
                'label' => __('Heading Typography', 'happyden'),
                'selector' => '{{WRAPPER}} .navbar:not(.active) .main-navigation ul.navbar-nav>li.happyden-mega-menu>.sub-menu>li.megamenu-heading>a',
            ]
        );
        $this->add_control(
            'megamenu_title_color',
            [
                'label' => __('Heading Color', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .navbar:not(.active) .main-navigation ul.navbar-nav>li.happyden-mega-menu>.sub-menu>li.megamenu-heading>a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'mega_menu_bg_color',
            [
                'label' => __('Menu Background Color', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .navbar:not(.active) .main-navigation ul.navbar-nav>li.happyden-mega-menu>.sub-menu' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
			'column_width',
			[
				'label' => __( 'Column Width', 'happyden' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .main-navigation ul.navbar-nav>li.happyden-mega-menu>.sub-menu>li' => 'width: {{SIZE}}{{UNIT}}!important;',
				],
			]
        );
        $this->add_control(
			'megamenu_width_type',
			[
				'label' => __( 'Menu Width', 'happyden' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'custom',
				'options' => [
					'container'  => __( 'Container', 'happyden' ),
					'custom' => __( 'custom', 'happyden' ),
				],
			]
        );
        $this->add_control(
			'megamenu_panel_width',
			[
				'label' => __( 'Menu Width', 'happyden' ),
				'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw' ],
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
					'{{WRAPPER}} .main-navigation ul.navbar-nav>li.happyden-mega-menu>.sub-menu' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'megamenu_width_type' => 'custom'
                ]
			]
        );
        $this->add_responsive_control(
            'megamenu_padding',
            [
                'label' => __('Menu Padding', 'happyden'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul.navbar-nav>li.happyden-mega-menu>.sub-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->end_controls_tab();
		$this->start_controls_tab(
			'megamenu_hover_tab',
			[
				'label' => __( 'Hover', 'plugin-name' ),
			]
		);
        $this->add_control(
            'megamenu_title_color_hover',
            [
                'label' => __('Heading Color', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .navbar:not(.active) .main-navigation ul.navbar-nav>li.happyden-mega-menu>.sub-menu>li.megamenu-heading>a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
		$this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }
    /**
     * Render oEmbed widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {
        $popular_post_key = array();
        $popular_meta_value_num = array();
        $settings = $this->get_settings_for_display();
        if( 'yes' == $settings['use_main_menu'] ){
                  $args = [
                'theme_location'        => 'main-menu',
                'menu_class'            => 'navbar-nav',
                'menu_id'               => 'navbar-nav',
                'container_class'       => 'happyden-menu-container',
            ];
        }else{
            $args = [
                // 'theme_location'        => 'main-menu',
                'menu'                  => $settings['primary_menu'],
                'menu_class'            => 'navbar-nav',
                'menu_id'               => 'navbar-nav',
                'container_class'       => 'happyden-menu-container',
            ];
        }
        ?>
        <div class="happyden-main-menu-wrap navbar menu-align-<?php printf('%s megamenu-width-%s', esc_attr($settings['menu_align']), esc_attr( $settings['megamenu_width_type'] )) ?>">
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="navbarToggler" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- end of Nav toggler -->
            <div class="navbar-inner">
                <div class="happyden-mobile-menu"></div>
                <button class="navbar-toggler d-lg-none" type="button" data-toggle="navbarToggler" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <nav id="site-navigation" class="main-navigation ">
                    <?php
                    if (has_nav_menu('main-menu') ) {
                        wp_nav_menu($args);
                    }
                    ?>
                </nav><!-- #site-navigation -->
            </div>
        </div>
    <?php
    }
}
$widgets_manager->register_widget_type( new \Happyden\Widgets\Elementor\HappydenNavMenu() );