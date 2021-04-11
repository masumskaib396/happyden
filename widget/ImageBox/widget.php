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
class HappydenImageBox extends \Elementor\Widget_Base {
    public function get_name() {
        return 'happyden_iamgebox';
    }
    public function get_title() {
        return __('Happyden Image Box', 'happyden');
    }
    public function get_icon() {
        return ('eicon-image-box');
    }
    public function get_categories() {
        return ['happyden'];
    }
    public function get_keywords() {
        return ['image box', 'box', 'image'];
    }
    protected function _register_controls() {
        $this->start_controls_section('iamge_box_section',
            [
                'label' => __('Image Box', 'happyden'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
			'imgae', [
				'label' => __( 'Image', 'happyden' ),
				'type' => Controls_Manager::MEDIA,
                'dynamic' => [
					'active' => true,
				],
                'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
        );

        $this->add_control(
			'title',
			[
				'label' => __( 'Title', 'happyden' ),
				'type' => Controls_Manager::TEXT,
                'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your title', 'happyden' ),
				'default' => __( 'Add Your Heading Text Here', 'happyden' ),
			]
		);

        $this->add_control(
			'discription',
			[
				'label' => __( 'Discription', 'happyden' ),
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your Discription', 'happyden' ),
				'default' => __( 'Add Your Discription Text Here', 'happyden' ),
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
                    '{{WRAPPER}} .happyden__imagebox--thumb img' => 'width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .happyden__imagebox--thumb img' => 'max-width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .happyden__imagebox--thumb img' => 'height: {{SIZE}}{{UNIT}} !important;',
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
                    '{{WRAPPER}} .happyden__imagebox--thumb img' => 'object-fit: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'image_border',
                'selector'  => '{{WRAPPER}} .happyden__imagebox--thumb img',
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
                'selector' => '{{WRAPPER}} .happyden__imagebox--thumb img',
            ]
        );
        $this->add_responsive_control(
            'image_border_radius',
            [
                'label'      => __('Border Radius', 'happyden'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .happyden__imagebox--thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .happyden__imagebox--thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        /* 
        *Title
        */
        $this->start_controls_section('iamge_box_title',
            [
                'label' => __('Title', 'happyden'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'happyden_title_color',
            [
                'label'     => __('Color', 'happyden'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden__imagebox--title h4' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'happyden_title_style',
                'label'    => __('Typography', 'happyden'),
                'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}}  .happyden__imagebox--title h4',
            ]
        );
        $this->add_responsive_control(
            'happyden_title_padding',
            [
                'label'      => __('Margin', 'happyden'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .happyden__imagebox--title h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .happyden__imagebox--title h4' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        /* 
        *Discription
        */
        $this->start_controls_section('image_box_discription',
            [
                'label' => __('Designiton', 'happyden'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'happyden_dis_color',
            [
                'label'     => __('Color', 'happyden'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden__imagebox--discription p' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'happyden_dis_style',
                'label'    => __('Typography', 'happyden'),
                'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}}  .happyden__imagebox--discription p',
            ]
        );
        $this->add_responsive_control(
            'happyden_dis_padding',
            [
                'label'      => __('Margin', 'happyden'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .happyden__imagebox--discription p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .happyden__imagebox--discription p' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        /* 
        *Content Box
        */
        $this->start_controls_section('image_content_box',
            [
                'label' => __('Content Box', 'happyden'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control('image_box_content_align_two',
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
                    '{{WRAPPER}} .happyden__imagebox--content' => 'text-align: {{VALUE}}',
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
                    '{{WRAPPER}} .happyden__imagebox--content' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'box_content_border_radius',
            [
                'label'      => __('Border Radius', 'happyden'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .happyden__imagebox--content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .happyden__imagebox--content' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'box_content_margin',
            [
                'label'      => __('Margin', 'happyden'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .happyden__imagebox--content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .happyden__imagebox--content' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'box_content_padding',
            [
                'label'      => __('Padding', 'happyden'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .happyden__imagebox--content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .happyden__imagebox--content' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }
    protected function render() {
        $settings = $this->get_settings_for_display();

        $imgae = $settings['imgae']['url'];
        $title = $settings['title'];
        $discription = $settings['discription'];
        ?>  
        <div class="happyden__imagebox--wraper">
            <div class="happyden__imagebox--single">
                <?php if($imgae): ?>
                    <div class="happyden__imagebox--thumb">
                        <img src="<?php echo esc_url($imgae)  ?>" alt="">
                    </div>  
                <?php endif; ?>
                <div class="happyden__imagebox--content">
                    <?php  if($title): ?>
                        <div class="happyden__imagebox--title">
                            <h4><?php echo esc_html( $title ) ?></h4>
                        </div>
                    <?php endif; ?>

                    <?php  if($discription): ?>
                        <div class="happyden__imagebox--discription">
                            <?php echo happyden_get_meta($discription) ?>
                        </div>
                    <?php endif; ?>
                </div>  
            </div>
        </div>
        <?php
}
}
$widgets_manager->register_widget_type( new \Happyden\Widgets\Elementor\HappydenImageBox() );