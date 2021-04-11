<?php
/**
 * Happyden Team Widget.
 *
 *
 * @since 1.0.0
 */
namespace Happyden\Widgets\Elementor;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}
// If this file is called directly, abort.
class HappydenTeam extends \Elementor\Widget_Base {
    public function get_name() {
        return 'happyden_team';
    }
    public function get_title() {
        return __('Happyden Team', 'fa');
    }
    public function get_icon() {
        return ('eicon-person');
    }
    public function get_categories() {
        return ['happyden'];
    }
    public function get_keywords() {
        return ['team', 'membar', 'portfolio'];
    }
    protected function _register_controls() {
        $this->start_controls_section('team_section',
            [
                'label' => __('Team Section', 'happyden'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'membar_per_page',
            [
                'label'       => __('Numbar Of Membar', 'happyden'),
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
                'options' => finisys_get_all_posts('team'),
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
                'label' => __('Order', 'tfinisys'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'asc' => 'Ascending',
                    'desc' => 'Descending',
                ],
                'default' => 'desc',
                'label_block' => true,

            ]
        );

        $this->add_responsive_control(
            'team_margin_bottom',
            [
                'label'          => __('Margin Bottom', 'happyden'),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => ['px', '%', 'vw'],
                'range'          => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .happyden--team-single' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        /* 
        *Image
        */
        $this->start_controls_section('team_box_iamge',
            [
                'label' => __('Image', 'happyden'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'image_border',
                'selector'  => '{{WRAPPER}} .happyden--team-thum img',
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'image_box_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .happyden--team-thum img',
            ]
        );
        
        $this->add_responsive_control(
            'width',
            [
                'label'          => __('Width', 'happyden'),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => ['%', 'px','vw'],
                'range'          => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .happyden--team-thum img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'space',
            [
                'label'          => __('Max Width', 'happyden'),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => ['px', '%', 'vw'],
                'range'          => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .happyden--team-thum img' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'height',
            [
                'label'          => __('Height', 'happyden'),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => ['px', 'vh'],
                'range'          => [
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                    ],
                    'vh' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .happyden--team-thum img' => 'height: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'object-fit',
            [
                'label'     => __('Object Fit', 'happyden'),
                'type'      => Controls_Manager::SELECT,
                'condition' => [
                    'height[size]!' => '',
                ],
                'options'   => [
                    ''        => __('Default', 'happyden'),
                    'fill'    => __('Fill', 'happyden'),
                    'cover'   => __('Cover', 'happyden'),
                    'contain' => __('Contain', 'happyden'),
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .happyden--team-thum img' => 'object-fit: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_border_radius',
            [
                'label'      => __('Border Radius', 'happyden'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .happyden--team-thum img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .happyden--team-thum img' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        /* 
        *Name
        */
        $this->start_controls_section('team_box_name',
            [
                'label' => __('Name', 'happyden'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'happyden_team_name_color',
            [
                'label'     => __('Color', 'happyden'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden--team-name' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'happyden_team_name_style',
                'label'    => __('Typography', 'happyden'),
                'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}}  .happyden--team-name',
            ]
        );
        $this->add_responsive_control(
            'happyden_team_name_padding',
            [
                'label'      => __('Margin', 'happyden'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .happyden--team-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .happyden--team-name' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        /* 
        *Title
        */
        $this->start_controls_section('team_box_position',
            [
                'label' => __('Designiton', 'happyden'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'happyden_team_position_color',
            [
                'label'     => __('Color', 'happyden'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden--team-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'happyden_team_position_style',
                'label'    => __('Typography', 'happyden'),
                'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}}  .happyden--team-title',
            ]
        );
        $this->add_responsive_control(
            'happyden_team_position_padding',
            [
                'label'      => __('Margin', 'happyden'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .happyden--team-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .happyden--team-title' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        /* 
        *Content Box
        */
        $this->start_controls_section('team_content_box',
            [
                'label' => __('Content Box', 'happyden'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control('team_content_align_two',
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
                    '{{WRAPPER}} .happyden--team-content' => 'text-align: {{VALUE}}',
                ],
                'default'   => 'center',
            ]
        );
        $this->add_control(
            'content_box_bg',
            [
                'label'     => __('Backround Color', 'happyden'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden--team-content' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'happyden_team_content',
            [
                'label'      => __('Padding', 'happyden'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .happyden--team-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .happyden--team-content' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

    }
    protected function render() {
        $settings = $this->get_settings_for_display();
        $numabr_of_membar = !empty($settings['membar_per_page']) ? $settings['membar_per_page'] : -1;
        //gride calss
        $grid_classes = [];
        $grid_classes[] = 'col-lg-' . $settings['per_line'];
        $grid_classes[] = 'col-md-' . $settings['per_line_tablet'];
        $grid_classes[] = 'col-sm-' . $settings['per_line_mobile'];
        $grid_classes = implode(' ', $grid_classes);
        $this->add_render_attribute('happyden_team_classes', 'class', [$grid_classes]);
        $query_args = [
            'post_type'           => 'team',
            'orderby' => $settings['orderby'],
            'order'   => $settings['order'],
            'posts_per_page'      => $numabr_of_membar,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => 1,
        ];

        // get_type
        if ( 'selected' === $settings['post_by'] ) {
            $query_args['post__in'] = (array)$settings['post__in'];
        }

        $happyden_teams = new \WP_Query($query_args);
        ?>
        <div class="happyden--team-wraper">
            <div class="row">

            <?php while ($happyden_teams->have_posts()): $happyden_teams->the_post();
            ?>
                <div  <?php echo $this->get_render_attribute_string('happyden_team_classes'); ?>>
                    <div class="happyden--team-single">
                        <div class="happyden--team-thum">
                            <?php the_post_thumbnail('large');?>
                        </div>
                        <div class="happyden--team-content">
                            <h3 class="happyden--team-name"><?php the_title() ?></h3>
                            <?php if (function_exists('the_field')): ?>
                                <span class="happyden--team-title"><?php the_field('title')?></span>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
                <?php endwhile;
                wp_reset_postdata();?>
            </div>
        </div>
    <?php
}
}
$widgets_manager->register_widget_type( new \Happyden\Widgets\Elementor\HappydenTeam() );