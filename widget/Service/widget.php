<?php
/**
 * Thmpw Service.
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

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Happyden_Service extends \Elementor\Widget_Base {

	public function get_name() {
		return 'happyden_service';
	}
	
	public function get_title() {
		return __( 'Happyden Service', 'happyden' );
	}

	public function get_icon() {
		return 'eicon-button';
	}

	public function get_categories() {
		return [ 'happyden' ];
	}

	protected function _register_controls() {

		$this->start_controls_section('content_section',
			[
				'label' => __( 'Service', 'happyden' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
        $this->add_control(
            'service_per_page',
            [
                'label'       => __('Numbar Of Service', 'happyden'),
                'type'        => Controls_Manager::NUMBER,
                'default'     => '',
                'description' => 'user emty value show all posts',
            ]
        );
        
        $this->add_responsive_control('per_line', [
            'label'              => __('Columns per row', 'happyden'),
            'type'               => Controls_Manager::SELECT,
            'default'            => '4',
            'tablet_default'     => '6',
            'mobile_default'     => '12',
            'options'            => [
                '12' => '1',
                '6'  => '2',
                '4'  => '3',
                '3'  => '4',
            ],
            'frontend_available' => true,
        ]);

        $this->add_control(
            'post_by',
            [
                'label' => __('Post By:', 'finisys'),
                'type' => Controls_Manager::SELECT,
                'default' => 'latest',
                'label_block' => true,
                'options' => array(
                    'latest'   =>   __('Latest Post', 'finisys'),
                    'selected' =>   __('Selected posts', 'finisys'),
                    'author'   =>   __('Post by author', 'finisys'),
                ),
            ]
        );
        $this->add_control(
            'post__in',
            [
                'label' => __('Post In', 'finisys'),
                'type' => Controls_Manager::SELECT2,
                'options' => finisys_get_all_posts('service'),
                'multiple' => true,
                'label_block' => true,
                'condition'   => [
					'post_by' => 'selected',
				]
            ]
        );
        $this->add_control(
            'author',
            [
                'label' => __('Author', 'finisys'),
                'type' => Controls_Manager::SELECT2,
                'options' => finisys_get_authors(),
                'multiple' => true,
                'label_block' => true,
                'condition' => [
					'post_by' => 'author',
				],
            ]
        );
        $this->add_control(
            'orderby',
            [
                'label' => __('Order By', 'finisys'),
                'type' => Controls_Manager::SELECT,
                'options' => finisys_get_post_orderby_options(),
                'default' => 'date',
                'label_block' => true,

            ]
        );
        $this->add_control(
            'order',
            [
                'label' => __('Order', 'finisys'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'asc' => 'Ascending',
                    'desc' => 'Descending',
                ],
                'default' => 'desc',
                'label_block' => true,

            ]
        );
        $this->end_controls_section();
       

        /* 
        *Title
        */
        $this->start_controls_section('title_box',
            [
                'label' => __('Title', 'happyden'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label'     => __('Color', 'happyden'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden__service--headding' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label'     => __('Hover Color', 'happyden'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden__service--single-item:hover .happyden__service--headding' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typo',
                'label'    => __('Typography', 'happyden'),
                'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}}  .happyden__service--headding',
            ]
        );
        $this->add_responsive_control(
            'title_margin',
            [
                'label'      => __('Margin', 'happyden'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .happyden__service--headding' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .happyden__service--headding' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        /* 
        *Excerpt
        */
        $this->start_controls_section('excerpt_box',
            [
                'label' => __('Excerpt', 'happyden'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'excerpt_color',
            [
                'label'     => __('Color', 'happyden'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden__service--excerpt' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'excerpt_color_hover',
            [
                'label'     => __('Hover Color', 'happyden'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden__service--single-item:hover .happyden__service--excerpt' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'excerpt_typo',
                'label'    => __('Typography', 'happyden'),
                'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}}  .happyden__service--excerpt',
            ]
        );
        $this->add_responsive_control(
            'excerpt_margin',
            [
                'label'      => __('Margin', 'happyden'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .happyden__service--excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .happyden__service--excerpt' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        /* 
        *Numbar
        */
        $this->start_controls_section('number_box',
            [
                'label' => __('Number', 'happyden'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'show_numbar',
            [
                'label'        => __('Show Number', 'happyden'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Show', 'happyden'),
                'label_off'    => __('Hide', 'happyden'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'number_color',
            [
                'label'     => __('Color', 'happyden'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden__service--numbar' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'number_color_hover',
            [
                'label'     => __('Hover Color', 'happyden'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden__service--single-item:hover .happyden__service--numbar' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'number_typo',
                'label'    => __('Typography', 'happyden'),
                'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}}  .happyden__service--numbar',
            ]
        );
        $this->add_responsive_control(
            'number_margin',
            [
                'label'      => __('Margin', 'happyden'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .happyden__service--numbar' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .happyden__service--numbar' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();


        /* 
        *Icon
        */
        $this->start_controls_section('icon_box',
            [
                'label' => __('Icon', 'happyden'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'show_icon',
            [
                'label'        => __('Show Icon', 'happyden'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Show', 'happyden'),
                'label_off'    => __('Hide', 'happyden'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
			'service_icon',
			[
				'label' => __( 'Icon', 'facdustry' ),
				'type' => Controls_Manager::ICONS,
				'label_block' => true,
				'condition'     => [
                    'show_icon'  => 'yes'
                ],
			]
		);

        $this->add_responsive_control(
            'icon_size',
            [
                'label'          => __('Icon Size', 'happyden'),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => ['px', '%'],
                'range'          => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .happyden__service--icon i' =>   'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .happyden__service--icon svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition'     => [
                    'show_icon'  => 'yes'
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_color_margin',
            [
                'label'      => __('Margin', 'happyden'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .happyden__service--icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .happyden__service--icon' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
                'condition'     => [
                    'show_icon'  => 'yes'
                ],
            ]
        );
        $this->end_controls_section();
        /* 
        *Content Box
        */
        $this->start_controls_section('content_box',
            [
                'label' => __('Box', 'happyden'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control('content_align',
            [
                'label'     => __('Alignment', 'happyden'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => __('Left', 'happyden'),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'happyden'),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'  => [
                        'title' => __('Right', 'happyden'),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .happyden__service--single-item' => 'text-align: {{VALUE}}',
                ],
                'default'   => 'left',
            ]
        );
        $this->add_control(
            'content_box_bg',
            [
                'label'     => __('Backround Color', 'happyden'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden__service--single-item' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'content_box_bg_hover',
            [
                'label'     => __('Backround Hover Color', 'happyden'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden__service--single-item:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'margin_bottom',
            [
                'label'          => __('Margin Bottom', 'happyden'),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => ['px', '%'],
                'range'          => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .happyden__service--single-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_box_border-radius',
            [
                'label'      => __('Border Radius', 'happyden'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .happyden__service--single-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .happyden__service--single-item' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_box_padding',
            [
                'label'      => __('Padding', 'happyden'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .happyden__service--single-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .happyden__service--single-item' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
	}

protected function render() {
    $settings = $this->get_settings_for_display();
    $show_icon = $settings['show_icon'];
    $show_numbar = $settings['show_numbar'];
    $numabr_of_service = !empty($settings['service_per_page']) ? $settings['service_per_page'] : -1;
    //gride calss
    $grid_classes = [];
    $grid_classes[] = 'col-lg-' . $settings['per_line'];
    $grid_classes[] = 'col-md-' . $settings['per_line_tablet'];
    $grid_classes[] = 'col-sm-' . $settings['per_line_mobile'];
    $grid_classes = implode(' ', $grid_classes);
    $this->add_render_attribute('happyden_service_classes', 'class', [$grid_classes]);


    $query_args = [
        'post_type'           => 'service',
        'orderby' => $settings['orderby'],
        'order'   => $settings['order'],
        'post_status'         => 'publish',
        'ignore_sticky_posts' => 1,
        'posts_per_page' => $numabr_of_service,
    ];

    // get_type
    if ( 'selected' === $settings['post_by'] ) {
        $query_args['post__in'] = (array)$settings['post__in'];
    }
    $happyden_service = new \WP_Query($query_args);
    
    ?>
    <div class="happyden__service--wraper">
        <div class="row justify-content-center">

        <?php
        $i = 0;
        while ( $happyden_service->have_posts()): $happyden_service->the_post();
        $i++;
        if($i < 10 ){
            $i = 0 . $i;
        }
        ?>
            <div <?php echo $this->get_render_attribute_string('happyden_service_classes'); ?>>
                <a href="<?php the_permalink( ); ?>" class="happyden__service--single-item">
                    <h4 class="happyden__service--headding"> <?php the_title(); ?></h4>
                    <div class="happyden__service--excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                    <?php if( $show_icon == 'yes' && !empty($settings['service_icon']['value']) ): ?>
                        <div class="happyden__service--icon">
                            <?php Icons_Manager::render_icon($settings['service_icon'], ['aria-hidden' => 'true']) ?>
                        </div>
                    <?php endif; ?>

                    <?php if (function_exists('the_field') && $show_numbar == 'yes'): ?>
                            <!-- <h1 class="happyden__service--numbar"><?php the_field('service_numbar'); ?></h1> -->
                            <h1 class="happyden__service--numbar"><?php echo esc_html( $i ); ?></h1>
                    <?php endif; ?>
                </a>
            </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
    <?php
	}
}
$widgets_manager->register_widget_type( new \Happyden\Widgets\Elementor\Happyden_Service() );