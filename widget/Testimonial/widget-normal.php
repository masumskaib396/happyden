<?php
/**
 * Happyden Testimonial Normal Widget.
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
// If this file is called directly, abort.
class HappydenTestimonialNormal extends \Elementor\Widget_Base {
    public function get_name() {
        return 'happyden_testimonial_normal';
    }
    public function get_title() {
        return __('Happyden Testimonial Normal', 'happyden');
    }
    public function get_icon() {
        return ('eicon-testimonial');
    }
    public function get_categories() {
        return ['happyden'];
    }
    public function get_keywords() {
        return ['team', 'card', 'testimonial', 'membar', 'reviw', 'rating'];
    }

    protected function _register_controls() {
        $this->start_controls_section('section',
            [
                'label' => __('Testimonial Content', 'happyden'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
			'imgae', [
				'label' => __( 'Image', 'happyden' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
        );
        $this->add_control(
			'name', [
				'label' => __( 'Name', 'happyden' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
                'default'   => __('Arlene McCoy', 'happyden'),
			]
        );
        
        $this->add_control(
			'title', [
				'label' => __( 'Title', 'happyden' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
                'default'   => __('New York, USA', 'happyden'),
			]
        );
        $this->add_control(
			'content', [
				'label' => __( 'Description', 'happyden' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
                'default'   => __('Aliquam ac dui vel dui vulputate consectetur. Mauris accumsan, ', 'happyden'),
			]
        );
        $this->add_control(
            'icon',
            [
                'label' => __('Icon', 'happyden'),
                'type' => Controls_Manager::ICONS,
                'default'   => [
                    'value'   => 'fas fa-quote-right',
                    'library' => 'solid',
                ],
            ]
        );
        $this->end_controls_section();

        /* 
        *Image
        */
        $this->start_controls_section('iamge_style',
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
                'default'        => [
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'unit' => 'px',
                ],
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
                    '{{WRAPPER}} .happyden--tl-image' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'space',
            [
                'label'          => __('Max Width', 'happyden'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'unit' => 'px',
                ],
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
                    '{{WRAPPER}} .happyden--tl-image' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'height',
            [
                'label'          => __('Height', 'happyden'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'unit' => 'px',
                ],
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
                    '{{WRAPPER}} .happyden--tl-image' => 'height: {{SIZE}}{{UNIT}} !important;',
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
                    '{{WRAPPER}} .happyden--tl-image' => 'object-fit: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'image_border',
                'selector'  => '{{WRAPPER}} .happyden--tl-image',
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'image_border_radius',
            [
                'label'      => __('Border Radius', 'happyden'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .happyden--tl-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .happyden--tl-image' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'image_box_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .happyden--tl-image',
            ]
        );
        $this->end_controls_section();

        /* 
        *Name
        */
        $this->start_controls_section('tn_name',
            [
                'label' => __('Name', 'happyden'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'name_color',
            [
                'label'     => __('Color', 'happyden'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden--tl-name' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'name_typo',
                'label'    => __('Typography', 'happyden'),
                'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}}  .happyden--tl-name',
            ]
        );
        $this->add_responsive_control(
            'name_margin',
            [
                'label'      => __('Margin', 'happyden'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .happyden--tl-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .happyden--tl-name' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        /* 
        *Title
        */
        $this->start_controls_section('tn_title',
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
                    '{{WRAPPER}} .happyden--tl-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typo',
                'label'    => __('Typography', 'happyden'),
                'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}}  .happyden--tl-title',
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label'      => __('Margin', 'happyden'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .happyden--tl-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .happyden--tl-title' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        /* 
        *Discription
        */
        $this->start_controls_section('discription',
            [
                'label' => __('Discription', 'happyden'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'dis_color',
            [
                'label'     => __('Color', 'happyden'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden--tl-single-top p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'dis_typo',
                'label'    => __('Typography', 'happyden'),
                'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}}  .happyden--tl-single-top p',
            ]
        );

        $this->add_responsive_control(
            'dis_margin',
            [
                'label'      => __('Margin', 'happyden'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .happyden--tl-single-top' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .happyden--tl-single-top' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        /* 
        *Icon
        */
        $this->start_controls_section('icon_style',
            [
                'label' => __('Icon', 'happyden'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => __('Color', 'happyden'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden--tl-icon i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .happyden--tl-icon svg' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .happyden--tl-icon svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'          => __('Size', 'happyden'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => 'px',
                ],
                'range'          => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .happyden--tl-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .happyden--tl-icon svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_margin',
            [
                'label'      => __('Margin', 'happyden'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .happyden--tl-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .happyden--tl-icon' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

    }
    protected function render() {
        $settings = $this->get_settings_for_display();
        $image = wp_get_attachment_image_url( $settings['imgae']['id'], 'thumbnail');
        $name = $settings['name'];
        $title = $settings['title'];
        $content = $settings['content'];

        if (!$image) {
            $image = Utils::get_placeholder_image_src();
        };

        ?>
        <div class="happyden--tl-normal">
            <div class="happyden--tl-single-item">
                
                <div class="happyden--tl-icon">
                    <?php Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']) ?>
                </div>

                <div class="happyden--tl-single-top">
                    <?php echo happyden_get_meta($content);   ?>
                </div>

                <div class="happyden--tl-single-bottom">
                    <?php if( $image ): ?>
                        <div class="happyden--tl-image">
                            <img src="<?php echo esc_url($image) ?>" alt="<?php echo esc_html($title) ?>">
                        </div>
                    <?php endif; ?>

                    <div class="happyden--tl-bottom-content">
                        <h5 class="happyden--tl-name"><?php echo esc_html($name) ?></h5>
                        <span class="happyden--tl-title"><?php echo esc_html($title) ?></span>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
$widgets_manager->register_widget_type( new \Happyden\Widgets\Elementor\HappydenTestimonialNormal() );