<?php
/**
 * Button Widget.
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

class Happyden_Button extends \Elementor\Widget_Base {

	public function get_name() {
		return 'happyden_btutton';
	}
	
	public function get_title() {
		return __( 'Happyden Button', 'happyden' );
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
				'label' => __( 'Butoon', 'happyden' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control('button_text',
			[
				'label' => __( 'Button Text', 'happyden' ),
				'type' => Controls_Manager::TEXT,
                'dynamic'    => [ 'active' => true ],
				'placeholder' => __( 'Button Text', 'happyden' ),
				'default' => __( 'Awsome Button', 'happyden' ),
				'label_block' => true,
			]
		);

       $this->add_control('happyden_button_link_selection', 
        [
            'label'         => __('Link Type', 'happyden'),
            'type'          => Controls_Manager::SELECT,
            'options'       => [
                'url'   => __('URL', 'premium-addons-for-elementor'),
                'link'  => __('Existing Page', 'happyden'),
            ],
            'default'       => 'url',
            'label_block'   => true,
        ]
        );
       $this->add_control('happyden_button_link',
            [
                'label'         => __('Link', 'happyden'),
                'type'          => Controls_Manager::URL,
                'default'       => [
                    'url'   => '#',
                    'is_external' => '',
                ],
                'show_external' => true,
                'placeholder'   => 'https://yourdomin.com/',
                'label_block'   => true,
                'condition'     => [
                    'happyden_button_link_selection' => 'url'
                ]
            ]
        );
        $this->add_control('happyden_button_existing_link',
            [
                'label'         => __('Existing Page', 'happyden'),
                'type'          => Controls_Manager::SELECT2,
                'options'       => happyden_get_all_pages(),
                'condition'     => [
                    'happyden_button_link_selection'     => 'link',
                ],
                'multiple'      => false,
                'separator'     => 'after',
                'label_block'   => true,
            ]
        );

        $this->add_responsive_control('happyden_button_align',
			[
				'label'             => __( 'Alignment', 'happyden' ),
				'type'              => Controls_Manager::CHOOSE,
				'options'           => [
					'left'    => [
						'title' => __( 'Left', 'happyden' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'happyden' ),
						'icon'  => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'happyden' ),
						'icon'  => 'fa fa-align-right',
					],
				],
                'selectors'         => [
                    '{{WRAPPER}} .sb_wraper' => 'text-align: {{VALUE}}',
                ],
				'default' => 'left',
			]
		);
		$this->add_control('happyden_button_size', 
        	[
            'label'         => __('Size', 'happyden'),
            'type'          => Controls_Manager::SELECT,
            'default'       => 'lg',
            'options'       => [
                    'sm'        => __('Small', 'happyden'),
                    'md'        => __('Regular', 'happyden'),
                    'lg'        => __('Large', 'happyden'),
                    'ex'        => __('Extra Large', 'happyden'),
                    'block'     => __('Block', 'happyden'),
                ],
            'label_block'   => true,
            'separator'     => 'after',
            ]
        );

        $this->add_control('happyden_icon_switcher',
	        [
	            'label'         => __('Icon', 'happyden'),
	            'type'          => Controls_Manager::SWITCHER,
	            'description'   => __('Enable or disable button icon','happyden'),
	        ]
        );
		$this->add_control(
			'happyden_button_icon',
			[
				'label' => __( 'Icon', 'happyden' ),
				'type' => Controls_Manager::ICONS,
				'label_block' => true,
				'condition'     => [
                    'happyden_icon_switcher'  => 'yes'
                ],
			]
		);
		$this->add_control(
            'happyden_button_icon_position',
            [
                'label' => __( 'Icon Position', 'happyden' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'before' => [
                        'title' => __( 'Before', 'happyden' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'after' => [
                        'title' => __( 'After', 'happyden' ),
                        'icon' => 'eicon-h-align-right',
                    ]
                ],
                'toggle' => false,
                'default' => 'after',
                'condition' => [
                    'happyden_icon_switcher' => 'yes',
                    'happyden_button_icon!' => ''
                ]
            ]
        );

        $this->add_control(
			'button_css_id',
			[
				'label' => __( 'Button ID', 'happyden' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'title' => __( 'Add your custom id WITHOUT the Pound key. e.g: my-id', 'happyden' ),
				'label_block' => false,
				'description' => __( 'Please make sure the ID is unique and not used elsewhere on the page this form is displayed. This field allows <code>A-z 0-9</code> & underscore chars without spaces.', 'themepaw-companion' ),
				'separator' => 'before',

			]
		);
		$this->end_controls_section();
		// End Content Section




		/*
		*Button Icon Style
		*/
		$this->start_controls_section(
            'icon_style',
            [
                'label' => __('Icon', 'happyden'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'icon_size',
            [
                'label' => __('Icon Size', 'happyden'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .happyden-btn-cion .btn-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .happyden-btn-cion .btn-icon svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_vertical_position',
            [
                'label' => __('Icon Vertical Position', 'happyden'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .happyden-btn-cion .btn-icon' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_gap',
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
                    '{{WRAPPER}} .happyden-btn-cion .icon-before' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .happyden-btn-cion .icon-after ' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        //icon hover

        //btn normal hover style
        $this->start_controls_tabs(
            'icon_style_tabs'
        );
        // normal
        $this->start_controls_tab(
            'icon_normal',
            [
                'label' => __('Normal', 'happyden'),
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => __('Icon Color', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .happyden-btn-cion' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .happyden-btn-cion path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();

        // hover
        $this->start_controls_tab(
            'icon_hover',
            [
                'label' => __('Hover', 'happyden'),
            ]
        );

        $this->add_control(
            'hover_icon_color',
            [
                'label' => __('Icon Color', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .happyden-btn-cion:hover .btn-icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .happyden-btn-cion:hover .btn-icon path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

		/*
		*Button Style
		*/
		$this->start_controls_section('style_section',
			[
				'label' => __( 'Button Style', 'happyden' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]

		);
        $this->add_control('button_gradient_background',
	        [
	            'label'         => __('Gradient Opction', 'happyden'),
	            'type'          => Controls_Manager::SWITCHER,
	            'description'   => __('Use Gradient Background','happyden'),
	        ]
        );
		$this->start_controls_tabs('button_style_tabs');

		//Button Tab Normal Start
		$this->start_controls_tab('style_normal_tab',
			[
				'label' => __( 'Normal', 'happyden' ),
			]
		);	
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'              => 'happyden_button_typo_normal',
                'scheme'            => Scheme_Typography::TYPOGRAPHY_1,
                'selector'          => '{{WRAPPER}} .happyden-button',

            ]
        );
		$this->add_control(
			'color',
			[
				'label' => __( 'Text Color', 'happyden' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1D263A',
				'selectors' => [
					'{{WRAPPER}} .happyden-button' => 'color: {{VALUE}}',
				],

			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'happyden_button_gradient_background_normal',
				'types' => [ 'gradient', 'classic' ],
				'selector' => '{{WRAPPER}} .happyden-button',
				'condition' => [
					'button_gradient_background' => 'yes'
				],
			]
		);
		$this->add_control(
			'background_color',
			[
				'label' => __( 'Background', 'happyden' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#FFCD28',
				'selectors' => [
					'{{WRAPPER}} .happyden-button,
					 {{WRAPPER}} .happyden-button.happyden-button-style2-shutinhor:before,
					 {{WRAPPER}} .happyden-button.happyden-button-style2-shutinver:before,
					 {{WRAPPER}} .happyden-button.happyden-button-style3-radialin:before,
					 {{WRAPPER}} .happyden-button.happyden-button-style3-rectin:before'   => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'button_gradient_background!' => 'yes'
				],
			]
		);
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),[
				'name' => 'button_box_shadow',
				'label' => __( 'Box Shadow', 'happyden' ),
				'selector' => '{{WRAPPER}} .happyden-button',
			]
		);
		$this->add_group_control(
            Group_Control_Border::get_type(), 
            [
                'name'          => 'border_normal',
                'selector'      => '{{WRAPPER}} .happyden-button',
            ]

        );
        $this->add_control('border_radius_normal',
            [
                'label'         => __('Border Radius', 'happyden'),
                'type'          => Controls_Manager::DIMENSIONS,
                'separator' => 'before',
                'size_units'    => ['px', '%' ,'em'],
                'selectors'     => [
                    '{{WRAPPER}} .happyden-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
		$this->add_responsive_control('padding',
			[
				'label' => __( 'Padding', 'happyden' ),
				'type' => Controls_Manager::DIMENSIONS,
				'label_block' => true,
				'size_units'    => ['px', 'em', '%'],
	            'selectors'     => [
	                '{{WRAPPER}} .happyden-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	            ]
				
			]
		);
		$this->add_responsive_control('margin',
			[
				'label' => __( 'Margin', 'happyden' ),
				'type' => Controls_Manager::DIMENSIONS,
				'label_block' => true,
				'size_units'    => ['px', 'em', '%'],
	            'selectors'     => [
	                '{{WRAPPER}} .happyden-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	            ]
				
			]
		);
		$this->end_controls_tab();
		// Button Tab Normal End
		
		//Button Tab Hover Start
		$this->start_controls_tab('style_hover_tab',
			[
				'label' => __( 'Hover', 'happyden' ),
			]
		);
        

		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'              => 'happyden_button_typo_hover',
                'scheme'            => Scheme_Typography::TYPOGRAPHY_1,
                'selector'          => '{{WRAPPER}} .happyden-button:hover',

            ]
        );
		$this->add_control(
			'hover_color',
			[
				'label' => __( 'Text Color', 'happyden' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .happyden-button:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'happyden_button_gradient_background_hover',
				'types' => [ 'gradient', 'classic' ],
				'selector' => '{{WRAPPER}} .happyden-button:hover',
				'condition' => [
					'button_gradient_background' => 'yes'
				],
			]
		);
		$this->add_control(
			'background_hover_color',
			[
				'label' => __( 'Background', 'happyden' ),
				'type' => Controls_Manager::COLOR,
				'scheme'            => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3
                ],
				'default' => '#222831',
				'selectors' => ['
					{{WRAPPER}} .happyden-button-none:hover,
					{{WRAPPER}} .happyden-button-style1-top:before,
					{{WRAPPER}} .happyden-button-style1-right:before,
					{{WRAPPER}} .happyden-button-style1-bottom:before,
					{{WRAPPER}} .happyden-button-style1-left:before,
					{{WRAPPER}} .happyden-button-style2-shutouthor:before,
					{{WRAPPER}} .happyden-button-style2-shutoutver:before,
					{{WRAPPER}} .happyden-button-style2-shutinhor,
					{{WRAPPER}} .happyden-button-style2-shutinver,
					{{WRAPPER}} .happyden-button-style2-dshutinhor:before,
					{{WRAPPER}} .happyden-button-style2-dshutinver:before,
					{{WRAPPER}} .happyden-button-style2-scshutouthor:before,
					{{WRAPPER}} .happyden-button-style2-scshutoutver:before,
					{{WRAPPER}} .happyden-button-style3-radialin,
					{{WRAPPER}} .happyden-button-style3-radialout:before,
					{{WRAPPER}} .happyden-button-style3-rectin:before,
					{{WRAPPER}} .happyden-button-style3-rectout:before' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'button_gradient_background!' => 'yes'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow_hover',
				'selector' => '{{WRAPPER}} .happyden-button:hover',
			]
		);
		$this->add_group_control(
            Group_Control_Border::get_type(), 
            [
                'name'          => 'border_hover',
                'selector'      => '{{WRAPPER}} .happyden-button:hover',
            ]
        );

        
        //Animation Hover
        $this->add_control('happyden_button_hover_effect', 
            [
                'label'         => __('Hover Effect', 'happyden'),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'none',
                'options'       => [
                    'none'          => __('None', 'happyden'),
                    'style1'        => __('Slide', 'happyden'),
                    'style2'        => __('Shutter', 'happyden'),
                    'style3'        => __('In & Out', 'happyden'),
                ],
                'label_block'   => true,
            ]
        );
		$this->add_control('happyden_button_style1_dir', 
        [
            'label'         => __('Slide Direction', 'happyden'),
            'type'          => Controls_Manager::SELECT,
            'default'       => 'bottom',
            'options'       => [
                'bottom'       => __('Top to Bottom', 'happyden'),
                'top'          => __('Bottom to Top', 'happyden'),
                'left'         => __('Right to Left', 'happyden'),
                'right'        => __('Left to Right', 'happyden'),
            ],
            'condition'     => [
                'happyden_button_hover_effect' => 'style1',
            ],
            'label_block'   => true,
            ]
        );
		$this->add_control('happyden_button_style2_dir', 
        [
            'label'         => __('Shutter Direction', 'happyden'),
            'type'          => Controls_Manager::SELECT,
            'default'       => 'shutouthor',
            'options'       => [
                'shutinhor'     => __('Shutter in Horizontal', 'happyden'),
                'shutinver'     => __('Shutter in Vertical', 'happyden'),
                'shutoutver'    => __('Shutter out Horizontal', 'happyden'),
                'shutouthor'    => __('Shutter out Vertical', 'happyden'),
                'scshutoutver'  => __('Scaled Shutter Vertical', 'happyden'),
                'scshutouthor'  => __('Scaled Shutter Horizontal', 'happyden'),
                'dshutinver'   => __('Tilted Left'),
                'dshutinhor'   => __('Tilted Right'),
            ],
            'condition'     => [
                'happyden_button_hover_effect' => 'style2',
            ],
            'label_block'   => true,
            ]
        );
		$this->end_controls_tabs();
		$this->end_controls_tab();
		$this->end_controls_section();

	}
	protected function render() {
		$settings = $this->get_settings_for_display();
		//Button Text And Style
		$button_text = $settings['button_text'];
		$button_size = 'happyden-button-' . $settings['happyden_button_size'];
		$button_hover = $settings['happyden_button_hover_effect'];

		//Button Hover Effect
		if ($button_hover == 'none') {
			$button_hover_style = 'happyden-button-none';
		}elseif($button_hover == 'style1'){
			$button_hover_style = 'happyden-button-style1-' . $settings['happyden_button_style1_dir'];
		}elseif ($button_hover == 'style2') {
			$button_hover_style = 'happyden-button-style2-' . $settings['happyden_button_style2_dir'];
		}elseif ($button_hover == 'style3') {
			$button_hover_style = 'happyden-button-style3-' . $settings['happyden_button_style3_dir'];
		}

		//Butoon ID
		if ( ! empty( $settings['button_css_id'] ) ) {
			$this->add_render_attribute( 'happyden_button', 'id', $settings['button_css_id'] );
		}

        if( $settings['happyden_button_link_selection'] == 'url' ){
            $button_url = $settings['happyden_button_link']['url'];
        } else {
            $button_url = get_permalink( $settings['happyden_button_existing_link'] );
        }
		//Button Class Href
		$this->add_render_attribute( 'happyden_button', [
			'class'	=> ['happyden-button', esc_attr($button_size), esc_attr($button_hover_style) ],
			'href'	=> esc_attr($button_url),
		]);

        
		if( $settings['happyden_button_link']['is_external'] ) {
			$this->add_render_attribute( 'happyden_button', 'target', '_blank' );
		}
		if( $settings['happyden_button_link']['nofollow'] ) {
			$this->add_render_attribute( 'happyden_button', 'rel', 'nofollow');
		}

		$this->add_render_attribute( 'happyden_button', 'data-text', esc_attr($settings['button_text'] ));

		?>
		<div  class="sb_wraper">
			<a  <?php echo $this->get_render_attribute_string( 'happyden_button' ); ?>>

			 	<?php if ( $settings['happyden_button_icon_position'] == 'before' && !empty($settings['happyden_button_icon']['value']) ) : ?>
					<span class="happyden-btn-cion icon-before"><?php Icons_Manager::render_icon($settings['happyden_button_icon'], ['aria-hidden' => 'true']) ?></span>
                <?php endif; ?>

				<span><?php echo esc_html($button_text) ?></span>

				<?php if ( $settings['happyden_button_icon_position'] === 'after' && !empty($settings['happyden_button_icon']['value'])) : ?>
                    <span class="happyden-btn-cion icon-after"><?php Icons_Manager::render_icon($settings['happyden_button_icon'], ['aria-hidden' => 'true']) ?></span>
                <?php endif; ?>
			</a>
		</div>
		<?php

	}
}
$widgets_manager->register_widget_type( new \Happyden\Widgets\Elementor\Happyden_Button() );