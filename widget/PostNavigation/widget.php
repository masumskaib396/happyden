<?php
/**
 * Portfolio Widget.
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
use  Elementor\Icons_Manager;

if (!defined('ABSPATH')) {
    exit;
}


class Happyden_Post_Navigation extends \Elementor\Widget_Base
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
        return 'happyden-post-navigation';
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
        return __('Happyden Post Navigation', 'happyden');
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
        return 'eicon-post-navigation';
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
         * Content tab
         */
        $this->start_controls_section(
            'post_navigation',
            [
                'label' => __('Post Navigation', 'happyden'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'prev_text',
            [
                'label' => __('Prev Text', 'happyden'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Previous Portfolio', 'happyden'),
            ]
        );
        $this->add_control(
            'next_text',
            [
                'label' => __('Next Text', 'happyden'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Next Portfolio', 'happyden'),
            ]
        );
        $this->add_control(
			'prev_icon',
			[
				'label' => __( 'Prev Icon', 'happyden' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-arrow-left',
					'library' => 'solid',
				],
			]
        );
        $this->add_control(
			'next_icon',
			[
				'label' => __( 'Next Icon', 'happyden' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-arrow-right',
					'library' => 'solid',
				],
			]
        );
        $this->end_controls_section();
        /**
         * Style tab
         */
        $this->start_controls_section(
            'general',
            [
                'label' => __('Style', 'happyden'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'label_typo',
                'label' => __('Prev Next Text Typography', 'happyden'),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .happyden-single-post .nav-label',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typo',
                'label' => __('Title Typography', 'happyden'),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .happyden-single-post .nav-title',
            ]
        );
        $this->start_controls_tabs(
            'nav_style_tabs'
        );
        $this->start_controls_tab(
            'nav_style_normal_tab',
            [
                'label' => __('Normal', 'happyden'),
            ]
        );
        $this->add_control(
            'label_color',
            [
                'label' => __('label Color', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden-single-post .nav-label' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __('Title Color', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden-single-post .nav-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label' => __('Icon', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden-single-post .nav-links a svg path' => 'stroke: {{VALUE}}',
                    '{{WRAPPER}} .happyden-single-post .nav-links a i' => 'stroke: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'svg_fill_color',
            [
                'label' => __('Icon Fill Color', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden-single-post .nav-links a svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'nav_background',
            [
                'label' => __('Background Color', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden-single-post .nav-links a' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'nav_icon_bg',
            [
                'label' => __('Icon Background Color', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .nav-links .nav-icon' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'nav_border',
                'label' => __('Border', 'happyden'),
                'selector' => '{{WRAPPER}} .nav-links a',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nav_shadow',
                'label' => __('Button Shadow', 'happyden'),
                'selector' => '{{WRAPPER}} .nav-links a',
            ]
        );
        $this->add_responsive_control(
            'nav_radius',
            [
                'label' => __('Border Radius', 'happyden'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .nav-links a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .nav-links a' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
			'icon_gap',
			[
				'label' => __( 'Icon gap', 'happyden' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
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
					'body:not(.rtl) {{WRAPPER}} .happyden-single-post .nav-previous i, body:not(.rtl) {{WRAPPER}} .happyden-single-post .nav-previous svg ' => 'margin-right: {{SIZE}}{{UNIT}};',
					'body:not(.rtl) {{WRAPPER}} .happyden-single-post .nav-next i,body:not(.rtl) {{WRAPPER}} .happyden-single-post .nav-next svg ' => 'margin-left: {{SIZE}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .happyden-single-post .nav-previous i, body.rtl{{WRAPPER}} .happyden-single-post .nav-previous svg ' => 'margin-left: {{SIZE}}{{UNIT}};',
					'body.rtl {{WRAPPER}} .happyden-single-post .nav-next i, body.rtl{{WRAPPER}} .happyden-single-post .nav-next svg ' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_tab();
        $this->start_controls_tab(
            'nav_style_hover_tab',
            [
                'label' => __('Hover', 'happyden'),
            ]
        );
        $this->add_control(
            'label_color_hover',
            [
                'label' => __('label Color', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden-single-post a:hover .nav-label' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label' => __('Title Color', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden-single-post a:hover .nav-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'icon_color_hover',
            [
                'label' => __('Icon', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden-single-post .nav-links a:hover svg path' => 'stroke: {{VALUE}}',
                    '{{WRAPPER}} .happyden-single-post .nav-links a:hover i' => 'stroke: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'svg_fill_color_hover',
            [
                'label' => __('Icon Fill Color', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden-single-post .nav-links a:hover svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'nav_background_hover',
            [
                'label' => __('Background Color', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden-single-post .nav-links a:hover:after' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'nav_icon_bg_hover',
            [
                'label' => __('Icon Background Color', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .nav-links .nav-icon:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'nav_hover_border',
                'label' => __('Border', 'happyden'),
                'selector' => '{{WRAPPER}} .nav-links a:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nav_hover_shadow',
                'label' => __('Button Shadow', 'happyden'),
                'selector' => '{{WRAPPER}} .nav-links a:hover',
            ]
        );
        $this->add_responsive_control(
            'nav_hover_radius',
            [
                'label' => __('Border Radius', 'happyden'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .nav-links a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .nav-links a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'icon_hover_gap',
            [
                'label' => __('Icon gap', 'happyden'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .nav-links a:hover .icon-before, body.rtl {{WRAPPER}} .nav-links a:hover .icon-after' => 'transform: translatex( -{{SIZE}}{{UNIT}} );',
                    'body:not(.rtl) {{WRAPPER}} .nav-links a:hover .icon-after,  body.rtl {{WRAPPER}} .nav-links a:hover .icon-before' => 'transform: translatex( {{SIZE}}{{UNIT}} );',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_control(
            'nav_style_divider',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );
        $this->add_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'happyden' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .happyden-single-post svg' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .happyden-single-post i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
        );
        $this->add_responsive_control(
            'nav_padding',
            [
                'label' => __('Nav Padding', 'happyden'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .nav-links a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .nav-links a' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_padding',
            [
                'label' => __('Title Padding', 'happyden'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .happyden-sngle-page-nav .nav-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .happyden-sngle-page-nav .nav-title' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
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

        $prev_text = get_previous_post();
		$next_text = get_next_post();

		$happyden_prev_post_title = wp_trim_words( get_the_title($prev_text), 2, '..' );
		$happyden_next_post_title = wp_trim_words( get_the_title($next_text ), 2, '..' );

        
        $popular_post_key = array();
        $popular_meta_value_num = array();
        $settings = $this->get_settings_for_display();
        ob_start();
        Icons_Manager::render_icon( $settings['prev_icon'], [ 'aria-hidden' => 'true' ] );
        $prev_icon = ob_get_clean();
        ob_start();
        Icons_Manager::render_icon( $settings['next_icon'], [ 'aria-hidden' => 'true' ] );
        $next_icon = ob_get_clean();
        ?>
        <div class="happyden-single-post">
         <?php    
            the_post_navigation(

                array(
                    'prev_text' => ' <div class="happyden-sngle-page-nav">
                        <span class="nav-icon">'.$prev_icon.'</span>
                        <span class="post-navigation-text prev">
                            <span class="nav-label">' .''. $settings['prev_text'] . '</span> 
                            <span class="nav-title">'.$happyden_prev_post_title.'</span> 
                        </span>
                    </div>',
                    'next_text' => ' <div class="happyden-sngle-page-nav-next">
                        <span class="post-navigation-text next">
                            <span class="nav-label">' . $settings['next_text'] . '</span>
                            <span class="nav-title">'.$happyden_next_post_title .'</span> 
                        </span>
                        <span class="nav-icon">'.$next_icon.'</span>
                    </div>',
                )
            ); ?>
        </div>

        <?php
    }
}
$widgets_manager->register_widget_type( new \Happyden\Widgets\Elementor\Happyden_Post_Navigation() );
