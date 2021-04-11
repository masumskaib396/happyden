<?php 
// Add Alignment Feature on counter
add_action('elementor/element/counter/section_title/after_section_end', function ($element, $args) {
    // add a control
    $element->start_controls_section(
        'section_extra',
        [
            'label' => __('Happyden Extra Style', 'happyden'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );
    $element->add_responsive_control(
        'counter_align',
        [
            'label' => __('Counter Alignment', 'happyden'),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'start' => [
                    'title' => __('Left', 'happyden'),
                    'icon' => 'eicon-text-align-left',
                ],
                'center' => [
                    'title' => __('Center', 'happyden'),
                    'icon' => 'eicon-text-align-center',
                ],
                'flex-end' => [
                    'title' => __('Right', 'happyden'),
                    'icon' => 'eicon-text-align-right',
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-counter .elementor-counter-number-wrapper ' => 'justify-content: {{VALUE}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'title_align',
        [
            'label' => __('Title Alignment', 'happyden'),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'left' => [
                    'title' => __('Left', 'happyden'),
                    'icon' => 'eicon-text-align-left',
                ],
                'center' => [
                    'title' => __('Center', 'happyden'),
                    'icon' => 'eicon-text-align-center',
                ],
                'right' => [
                    'title' => __('Right', 'happyden'),
                    'icon' => 'eicon-text-align-right',
                ],
                'justify' => [
                    'title' => __('Justified', 'happyden'),
                    'icon' => 'eicon-text-align-justify',
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-counter .elementor-counter-title ' => 'text-align: {{VALUE}};',
            ],
        ]
    );
   
    $element->add_responsive_control(
        'counter_gap',
        [
            'label'      => __('Counter Gap', 'happyden'),
            'type'       => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px'],
            'selectors'  => [
                '{{WRAPPER}} .elementor-counter-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                'body.rtl {{WRAPPER}} .elementor-counter-title' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
            ],
        ],
    );

    $element->start_controls_tabs(
        'counter_tabs'
    );
        $element->start_controls_tab(
            'counter_normal',
            [
                'label' => __('Normal', 'shadepro-ts'),
            ]
        );
        $element->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'      => 'counter_border',
                'selector'  => '{{WRAPPER}} .elementor-counter',
                'separator' => 'after',
            ]
        );
        $element->end_controls_tab();

        $element->start_controls_tab(
            'counter_hover',
            [
                'label' => __('Hover', 'shadepro-ts'),
            ]
        );
        $element->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'      => 'counter_border_hover',
                'selector'  => '{{WRAPPER}} .elementor-counter:hover',
                'separator' => 'before',
            ]
        );
        $element->end_controls_tab();
    $element->end_controls_tabs();
    

    $element->end_controls_section();
}, 10, 2);




// Add select dropdown control to button widget
add_action('elementor/element/video/section_lightbox_style/after_section_end', function ($element, $args) {
    // add a control
    $element->start_controls_section(
        'section_extra',
        [
            'label' => __('Happyden Extra', 'happyden'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );
    $element->add_control(
        'play_icon_bg',
        [
            'label' => __('Icon Box Background Color', 'happyden'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .elementor-custom-embed-play' => 'background-color: {{VALUE}}',
            ],
            'condition' => [
                'show_image_overlay' => 'yes',
                'show_play_icon' => 'yes',
            ],
        ]
    );

    $element->add_responsive_control(
        'play_icon_box_size',
        [
            'label' => __('Icon Box Size', 'happyden'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 10,
                    'max' => 500,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-custom-embed-play' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
            ],
            'condition' => [
                'show_image_overlay' => 'yes',
                'show_play_icon' => 'yes',
            ],
        ]
    );

    $element->add_responsive_control(
        'video_icon_margin',
        [
            'label' => __('Icon Margin', 'happyden'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .elementor-custom-embed-play i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                'body.rtl {{WRAPPER}} .elementor-custom-embed-play i' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',

            ],
            'condition' => [
                'show_image_overlay' => 'yes',
            ],
        ]
    );

    $element->add_responsive_control(
        'overlay_radius',
        [
            'label' => __('Image Oveerlay Radius', 'happyden'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .div.elementor-custom-embed-play i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                'body.rtl {{WRAPPER}} .elementor-custom-embed-image-overlay img' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',

            ],
            'condition' => [
                'show_image_overlay' => 'yes',
            ],
        ]
    );
    

    $element->add_responsive_control(
        'team_margin_bottom',
        [
            'label'          => __('Rotate', 'happyden'),
            'type'           =>  \Elementor\Controls_Manager::SLIDER,
            'size_units'     => ['px'],
            'default'        => 0,
            'range'          => [
                'px' => [
                    'step' => 0.1,
                    'min' => 0,
                    'max' => 1,
                ],
            ],
            'selectors'      => [
                '{{WRAPPER}} .elementor-custom-embed-image-overlay img' => 'opacity:{{SIZE}};',
            ],
        ]
    );

    $element->end_controls_section();
}, 10, 2);

add_action( 'elementor/element/divider/section_divider_style/before_section_start', function( $element, $args ) {
    
	$element->start_controls_section(
		'custom_section',
		[
			'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			'label' => __( 'Happyden Extra Style', 'happyden' ),
		]
	);

	$element->add_responsive_control(
        'team_margin_bottom',
        [
            'label'          => __('Rotate', 'happyden'),
            'type'           =>  \Elementor\Controls_Manager::SLIDER,
            'size_units'     => ['px', 'deg'],
            'range'          => [
                'px' => [
                    'min' => 1,
                    'max' => 1000,
                ],
                'deg' => [
                    'min' => 1,
                    'max' => 1000,
                ],
            ],
            'selectors'      => [
                '{{WRAPPER}} .elementor-divider' => 'transform: rotate({{SIZE}}{{UNIT}});',
            ],
        ]
    );

	$element->end_controls_section();

}, 10, 2 );



// image box
add_action('elementor/element/image-box/section_style_content/after_section_end', function ($element, $args) {
    // add a control
    $element->start_controls_section(
        'image_section_extra',
        [
            'label' => __('Happyden Extra Style', 'happyden'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );

    $element->add_control(
        'iamge_content_bg',
        [
            'label'     => __('Background Color', 'happyden'),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .elementor-image-box-content' => 'background-color: {{VALUE}}',
            ],
        ]
    );

    $element->add_responsive_control(
        'iamge_border_radius',
        [
            'label'      => __('Image Border Radius', 'happyden'),
            'type'       => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px'],
            'selectors'  => [
                '{{WRAPPER}} .elementor-image-box-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                'body.rtl {{WRAPPER}} .elementor-image-box-img img' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
            ],
        ],
    );

    $element->add_responsive_control(
        'iamge_content_padding',
        [
            'label'      => __('Content Padding', 'happyden'),
            'type'       => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px'],
            'selectors'  => [
                '{{WRAPPER}} .elementor-image-box-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                'body.rtl {{WRAPPER}} .elementor-image-box-content' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
            ],
        ],
    );
    $element->end_controls_section();
}, 10, 2);