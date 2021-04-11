<?php
namespace Happyden\Widgets\Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;

class Happyden_Animated_Text extends Widget_Base {

	public function get_name() {
		return 'happyden-animated';
	}

	public function get_title() {
		return esc_html__( 'Happyden Animated Text', 'happyden' );
	}

	public function get_icon() {
		return 'eicon-animated-headline';
	}

   	public function get_categories() {
		return [ 'happyden' ];
	}
	  
	public function get_keywords() {
        return [ 'happyden', 'fancy', 'heading', 'animate', 'animation' ];
    } 
    
 	public function get_script_depends() {
		return [ 'happyden-animated-text' ];
	}

	protected function _register_controls() {
		
	    /*
	    * Animated Text Content
	    */
	    $this->start_controls_section(
	        'happyden_section_animated_text_content',
	        [
	            'label' => esc_html__( 'Content', 'happyden' )
	        ]
		);
		
		$this->add_control(
	        'happyden_animated_text_before_text',
	        [
				'label'   => esc_html__( 'Before Text', 'happyden' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'This is', 'happyden' )
	        ]
		);

		$this->add_control(
			'happyden_animated_text_animated_heading',
			[
				'label'       => esc_html__( 'Animated Text', 'happyden' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter your animated text with comma separated.', 'happyden' ),
				'description' => __( '<b>Write animated heading with comma separated. Example: Exclusive, Addons, Elementor</b>', 'happyden' ),
				'default'     => esc_html__( 'Finestdevs, Addons, Elementor', 'happyden' ),
				'dynamic'     => [ 'active' => true ]
			]
		);
		
		$this->add_control(
	        'happyden_animated_text_after_text',
	        [
				'label'   => esc_html__( 'After Text', 'happyden' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'For You.', 'happyden' )
	        ]
		);

		$this->add_control(
			'happyden_animated_text_animated_heading_tag',
			[
				'label'   => esc_html__( 'HTML Tag', 'happyden' ),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'h3',
				'toggle'  => false,
				'options' => [
					'h1'  => [
						'title' => __( 'H1', 'happyden' ),
						'icon'  => 'eicon-editor-h1'
					],
					'h2'  => [
						'title' => __( 'H2', 'happyden' ),
						'icon'  => 'eicon-editor-h2'
					],
					'h3'  => [
						'title' => __( 'H3', 'happyden' ),
						'icon'  => 'eicon-editor-h3'
					],
					'h4'  => [
						'title' => __( 'H4', 'happyden' ),
						'icon'  => 'eicon-editor-h4'
					],
					'h5'  => [
						'title' => __( 'H5', 'happyden' ),
						'icon'  => 'eicon-editor-h5'
					],
					'h6'  => [
						'title' => __( 'H6', 'happyden' ),
						'icon'  => 'eicon-editor-h6'
					]
				]
			]
		);

		$this->add_control(
			'happyden_animated_text_animated_heading_alignment',
			[
				'label'   => esc_html__( 'Alignment', 'happyden' ),
				'type'    => Controls_Manager::CHOOSE,
				'toggle'  => false,
				'options' => [
					'happyden-animated-text-align-left'   => [
						'title' => __( 'Left', 'happyden' ),
						'icon'  => 'eicon-text-align-left'
					],
					'happyden-animated-text-align-center' => [
						'title' => __( 'Center', 'happyden' ),
						'icon'  => 'eicon-text-align-center'
					],
					'happyden-animated-text-align-right'  => [
						'title' => __( 'Right', 'happyden' ),
						'icon'  => 'eicon-text-align-right'
					]
				],
				'default' => 'happyden-animated-text-align-center'
			]
		);

		$this->end_controls_section();

		/*
	    * Animated Text Container Style
	    */
	    $this->start_controls_section(
	        'happyden_section_animated_text_animation_tyle',
	        [
				'label' => esc_html__( 'Animation', 'happyden' ),
				'tab'   => Controls_Manager::TAB_STYLE
	        ]
		);

		$this->add_control(
			'happyden_animated_text_animated_heading_animated_type',
			[
				'label'   => esc_html__( 'Animation Type', 'happyden' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'happyden-typed-animation',
				'options' => [
					'happyden-typed-animation'   => __( 'Typed', 'happyden' ),
					'happyden-morphed-animation' => __( 'Animate', 'happyden' )
				]
			]
		);

		$this->add_control(
			'happyden_animated_text_animated_heading_animation_style',
			[
				'label'   => esc_html__( 'Animation Style', 'happyden' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'fadeIn',
				'options' => [
					'fadeIn'            => __( 'Fade In', 'happyden' ),
					'fadeInUp'          => __( 'Fade In Up', 'happyden' ),
					'fadeInDown'        => __( 'Fade In Down', 'happyden' ),
					'fadeInLeft'        => __( 'Fade In Left', 'happyden' ),
					'fadeInRight'       => __( 'Fade In Right', 'happyden' ),
					'zoomIn'            => __( 'Zoom In', 'happyden' ),
					'zoomInUp'          => __( 'Zoom In Up', 'happyden' ),
					'zoomInDown'        => __( 'Zoom In Down', 'happyden' ),
					'zoomInLeft'        => __( 'Zoom In Left', 'happyden' ),
					'zoomInRight'       => __( 'Zoom In Right', 'happyden' ),
					'slideInDown'       => __( 'Slide In Down', 'happyden' ),
					'slideInUp'         => __( 'Slide In Up', 'happyden' ),
					'slideInLeft'       => __( 'Slide In Left', 'happyden' ),
					'slideInRight'      => __( 'Slide In Right', 'happyden' ),
					'bounce'            => __( 'Bounce', 'happyden' ),
					'bounceIn'          => __( 'Bounce In', 'happyden' ),
					'bounceInUp'        => __( 'Bounce In Up', 'happyden' ),
					'bounceInDown'      => __( 'Bounce In Down', 'happyden' ),
					'bounceInLeft'      => __( 'Bounce In Left', 'happyden' ),
					'bounceInRight'     => __( 'Bounce In Right', 'happyden' ),
					'flash'             => __( 'Flash', 'happyden' ),
					'pulse'             => __( 'Pulse', 'happyden' ),
					'rotateIn'          => __( 'Rotate In', 'happyden' ),
					'rotateInDownLeft'  => __( 'Rotate In Down Left', 'happyden' ),
					'rotateInDownRight' => __( 'Rotate In Down Right', 'happyden' ),
					'rotateInUpRight'   => __( 'rotate In Up Right', 'happyden' ),
					'rotateIn'          => __( 'Rotate In', 'happyden' ),
					'rollIn'            => __( 'Roll In', 'happyden' ),
					'lightSpeedIn'      => __( 'Light Speed In', 'happyden' )
				],
				'condition' => [
					'happyden_animated_text_animated_heading_animated_type' => 'happyden-morphed-animation'
				]
			]
		);

		$this->end_controls_section();

		/*
	    * Animated Text Settings
	    */
	    $this->start_controls_section(
	        'happyden_section_animated_text_settings',
	        [
				'label' => esc_html__( 'Settings', 'happyden' ),
				'tab'   => Controls_Manager::TAB_STYLE
	        ]
		);

		$this->add_control(
			'happyden_animated_text_animation_speed',
			[
				'label'     => __( 'Animation Speed', 'happyden' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 1000,
				'min'       => 100,
				'max'       => 10000,
				'condition' => [
					'happyden_animated_text_animated_heading_animated_type' => 'happyden-morphed-animation'
				]
			]
		);

		$this->add_control(
			'happyden_animated_text_type_speed',
			[
				'label'   => __( 'Type Speed', 'happyden' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 60,
				'min'     => 10,
				'max'     => 200,
				'step'    => 10,
				'condition' => [
					'happyden_animated_text_animated_heading_animated_type' => 'happyden-typed-animation'
				]
			]
		);

		$this->add_control(
			'happyden_animated_text_start_delay',
			[
				'label'     => __( 'Start Delay', 'happyden' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 1000,
				'min'       => 1000,
				'max'       => 10000,
				'condition' => [
					'happyden_animated_text_animated_heading_animated_type' => 'happyden-typed-animation'
				]
			]
		);

		$this->add_control(
			'happyden_animated_text_back_type_speed',
			[
				'label'     => __( 'Back Type Speed', 'happyden' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 60,
				'min'       => 10,
				'max'       => 200,
				'step'      => 10,
				'condition' => [
					'happyden_animated_text_animated_heading_animated_type' => 'happyden-typed-animation'
				]
			]
		);

		$this->add_control(
			'happyden_animated_text_back_delay',
			[
				'label'     => __( 'Back Delay', 'happyden' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 1000,
				'min'       => 1000,
				'max'       => 10000,
				'condition' => [
					'happyden_animated_text_animated_heading_animated_type' => 'happyden-typed-animation'
				]
			]
		);

		$this->add_control(
			'happyden_animated_text_loop',
			[
				'label'        => __( 'Loop', 'happyden' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'ON', 'happyden' ),
				'label_off'    => __( 'OFF', 'happyden' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'happyden_animated_text_animated_heading_animated_type' => 'happyden-typed-animation'
				]
			]
		);

		$this->add_control(
			'happyden_animated_text_show_cursor',
			[
				'label'        => __( 'Show Cursor', 'happyden' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'ON', 'happyden' ),
				'label_off'    => __( 'OFF', 'happyden' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'happyden_animated_text_animated_heading_animated_type' => 'happyden-typed-animation'
				]
			]
		);

		$this->add_control(
			'happyden_animated_text_fade_out',
			[
				'label'        => __( 'Fade Out', 'happyden' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'ON', 'happyden' ),
				'label_off'    => __( 'OFF', 'happyden' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'happyden_animated_text_animated_heading_animated_type' => 'happyden-typed-animation'
				]
			]
		);

		$this->add_control(
			'happyden_animated_text_smart_backspace',
			[
				'label'        => __( 'Smart Backspace', 'happyden' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'ON', 'happyden' ),
				'label_off'    => __( 'OFF', 'happyden' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'happyden_animated_text_animated_heading_animated_type' => 'happyden-typed-animation'
				]
			]
		);

		$this->end_controls_section();

		/*
	    * Animated Text pre animated Text Style
		*/
	    $this->start_controls_section(
	        'happyden_pre_animated_text_style',
	        [
				'label'     => esc_html__( 'Pre Animated text', 'happyden' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'happyden_animated_text_before_text!' => ''
				]
	        ]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'happyden_pre_animated_text_typography',
				'fields_options'   => [
		            'font_size'    => [
		                'default'  => [
		                    'unit' => 'px',
		                    'size' => 30
		                ]
		            ],
		            'font_weight'  => [
		                'default'  => '600'
		            ]
	            ],
				'selector' => '{{WRAPPER}} .happyden-animated-text-pre-heading',
			]
		);

		$this->add_control(
			'happyden_pre_animated_text_color',
			[
				'label'     => esc_html__( 'Color', 'happyden' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#222222',
				'selectors' => [
					'{{WRAPPER}} .happyden-animated-text-pre-heading' => 'color: {{VALUE}}'
				]
			]
		);

		$this->end_controls_section();

		/*
	    * Animated Text animated Text Style
	    */
	    $this->start_controls_section(
	        'happyden_animated_text_style',
	        [
				'label' => esc_html__( 'Animated text', 'happyden' ),
				'tab'   => Controls_Manager::TAB_STYLE
	        ]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'happyden_animated_text_typography',
				'fields_options'   => [
		            'font_size'    => [
		                'default'  => [
		                    'unit' => 'px',
		                    'size' => 30
		                ]
		            ],
		            'font_weight'  => [
		                'default'  => '600'
		            ]
	            ],
				'selector' => '{{WRAPPER}} .happyden-animated-text-animated-heading, {{WRAPPER}} span.typed-cursor'
			]
		);

		$this->add_control(
			'happyden_animated_text_color',
			[
				'label'     => esc_html__( 'Color', 'happyden' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#222',
				'selectors' => [
					'{{WRAPPER}} .happyden-animated-text-animated-heading, {{WRAPPER}} span.typed-cursor' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_control(
			'happyden_animated_text_spacing',
			[
				'label'      => __( 'Spacing', 'happyden' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'default'    => [
                    'unit'   => 'px',
                    'size'   => 8
                ],
				'range'      => [
					'px'     => [
						'min' => 0,
						'max' => 50
					]
				],
				'selectors'  => [
					'{{WRAPPER}} .happyden-animated-text-animated-heading' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

		/*
	    * Animated Text post animated Text Style
	    */
	    $this->start_controls_section(
	        'happyden_post_animated_text_style',
	        [
				'label'     => esc_html__( 'Post Animated text', 'happyden' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'happyden_animated_text_after_text!' => ''
				]
	        ]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'happyden_post_animated_text_typography',
				'fields_options'   => [
		            'font_size'    => [
		                'default'  => [
		                    'unit' => 'px',
		                    'size' => 30
		                ]
		            ],
		            'font_weight'  => [
		                'default'  => '600'
		            ]
	            ],
				'selector' => '{{WRAPPER}} .happyden-animated-text-post-heading'
			]
		);

		$this->add_control(
			'happyden_post_animated_text_color',
			[
				'label'     => esc_html__( 'Color', 'happyden' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#222222',
				'selectors' => [
					'{{WRAPPER}} .happyden-animated-text-post-heading' => 'color: {{VALUE}}'
				]
			]
		);

		$this->end_controls_section();
	
	}

	protected function render() {
		$settings      = $this->get_settings_for_display();
		$id            = substr( $this->get_id_int(), 0, 3 );
		$type_heading  = explode( ',', $settings['happyden_animated_text_animated_heading'] );
		$before_text   = $settings['happyden_animated_text_before_text'];
		$heading_text  = $settings['happyden_animated_text_animated_heading'];
		$after_text    = $settings['happyden_animated_text_after_text'];
		$heading_tag   = $settings['happyden_animated_text_animated_heading_tag'];
		$heading_align = $settings['happyden_animated_text_animated_heading_alignment'];

		$this->add_render_attribute( 'happyden_typed_animated_string', 'class', 'happyden-typed-strings' );
		$this->add_render_attribute( 'happyden_typed_animated_string',
			[
				'data-type_string'       => esc_attr(json_encode($type_heading)),
				'data-heading_animation' => esc_attr( $settings['happyden_animated_text_animated_heading_animated_type'] )
			]
		);

		if($settings['happyden_animated_text_animated_heading_animated_type'] === 'happyden-typed-animation'){
			$this->add_render_attribute( 'happyden_typed_animated_string',
				[
					'data-type_speed'      => esc_attr( $settings['happyden_animated_text_type_speed'] ),
					'data-back_type_speed' => esc_attr( $settings['happyden_animated_text_back_type_speed'] ),
					'data-loop'            => esc_attr( $settings['happyden_animated_text_loop'] ),
					'data-show_cursor'     => esc_attr( $settings['happyden_animated_text_show_cursor'] ),
					'data-fade_out'        => esc_attr( $settings['happyden_animated_text_fade_out'] ),
					'data-smart_backspace' => esc_attr( $settings['happyden_animated_text_smart_backspace'] ),
					'data-start_delay'     => esc_attr( $settings['happyden_animated_text_start_delay'] ),
					'data-back_delay'      => esc_attr( $settings['happyden_animated_text_back_delay'] )
				]
			);
		}

		if($settings['happyden_animated_text_animated_heading_animated_type'] === 'happyden-morphed-animation'){
			$this->add_render_attribute( 'happyden_typed_animated_string',
				[
					'data-animation_style' => esc_attr( $settings['happyden_animated_text_animated_heading_animation_style'] ),
					'data-animation_speed' => esc_attr( $settings['happyden_animated_text_animation_speed'] )
				]
			);
		}

		$this->add_render_attribute( 'happyden_animated_text_animated_heading',
			[
				'id'    => 'happyden-animated-text-'.$id,
				'class' => 'happyden-animated-text-animated-heading'
			]
		);

		$this->add_render_attribute( 'happyden_animated_text_before_text', 'class', 'happyden-animated-text-pre-heading' );
        $this->add_inline_editing_attributes( 'happyden_animated_text_before_text' );

		$this->add_render_attribute( 'happyden_animated_text_after_text', 'class', 'happyden-animated-text-post-heading' );
        $this->add_inline_editing_attributes( 'happyden_animated_text_after_text' );

		echo '<div class="happyden-animated-text '.esc_attr($heading_align).'">';

			do_action( 'happyden_animated_text_wrapper_before' );

			echo '<'.esc_attr($heading_tag).' '.$this->get_render_attribute_string( 'happyden_typed_animated_string' ).'>';

				do_action( 'happyden_animated_text_content_before' );

				$before_text ? printf( '<span '.$this->get_render_attribute_string( 'happyden_animated_text_before_text' ).'>%s</span>', wp_kses_post($before_text) ) : '';

				if( 'happyden-typed-animation' === $settings['happyden_animated_text_animated_heading_animated_type'] ) {
					echo '<span id="happyden-animated-text-'.esc_attr($id).'" class="happyden-animated-text-animated-heading"></span>';
				}

				if( 'happyden-morphed-animation' === $settings['happyden_animated_text_animated_heading_animated_type'] ) {
					echo '<span '.$this->get_render_attribute_string( 'happyden_animated_text_animated_heading' ).'>'.wp_kses_post($heading_text).'</span>';
				}

				$after_text ? printf( '<span '.$this->get_render_attribute_string( 'happyden_animated_text_after_text' ).'>%s</span>', wp_kses_post($after_text) ) : '';

				do_action( 'happyden_animated_text_content_after' );

			echo '</'.esc_attr($heading_tag).'>';

			do_action( 'happyden_animated_text_wrapper_after' );

		echo '</div>';
	}
}
$widgets_manager->register_widget_type(new \Happyden\Widgets\Elementor\Happyden_Animated_Text());