<?php
namespace Happyden\Widgets\Elementor;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;

class Happyden_Progress_Bar extends Widget_Base {
	
	public function get_name() {
		return 'happyden-progress-bar';
	}

	public function get_title() {
		return esc_html__( 'Progress Bar', 'happyden' );
	}

	public function get_icon() {
		return 'eicon-skill-bar';
	}

	public function get_categories() {
		return [ 'happyden' ];
	}

	public function get_script_depends() {
		return [ 'happyden-waypoints', 'happyden-progress-bar' ];
	}

	public function get_keywords() {
		return [ 'happyden', 'skill', 'circle', 'bars' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'happyden_progress_bar_section_content',
			[
				'label' => __('Content', 'happyden')
			]
		);
					
		$this->add_control(
			'happyden_progress_bar_title',
			[
				'label'     => __('Title', 'happyden'),
				'type'      => Controls_Manager::TEXT,
				'default'   => __('Progress Bar', 'happyden'),
                'label_block' => true,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'happyden_progress_bar_value',
			[
				'label'   => __( 'Percentage Value', 'happyden' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 0,
				'max'     => 100,
				'step'    => 1,
				'default' => 60
			]
		);
			
		$this->end_controls_section();
				
		$this->start_controls_section(
			'happyden_section_progress_bar_styles_preset',
			[
				'label' => __('General Styles', 'happyden'),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'happyden_progress_bar_preset',
			[
				'label'   => __('Style Presets', 'happyden'),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'line'        => __('Line', 'happyden'),
					'line-bubble' => __('Line Bubble', 'happyden'),
					'circle'      => __('Circle', 'happyden'),
					'fan'         => __('Half Circle', 'happyden')
				],
				'default' => 'line'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'happyden_progress_bar_title_styles',
			[
				'label' => __('Title', 'happyden'),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'happyden_progress_bar_title_color',
			[
				'label'     => __( 'Color', 'happyden' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => [
					'{{WRAPPER}} .happyden-progress-bar-title' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
				[
					'name'     => 'happyden_progress_bar_title_typography',
					'fields_options'   => [
			            'font_size'    => [
			                'default'  => [
			                    'unit' => 'px',
			                    'size' => 16
			                ]
			            ],
			            'font_weight'  => [
			                'default'  => '600'
			            ]
		            ],
					'selector' => '{{WRAPPER}} .happyden-progress-bar-title'
				]
		);

		$this->add_responsive_control(
            'happyden_progress_bar_title_margin',
            [
                'label'        => __('Margin', 'happyden'),
                'type'         => Controls_Manager::DIMENSIONS,
                'size_units'   => ['px', '%'],
                'default'      => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '10',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false
                ],
                'selectors'    => [
                    '{{WRAPPER}} .happyden-progress-bar-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'happyden_progress_bar_front_style',
			[
				'label' => __('Front Bar', 'happyden'),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'happyden_progress_bar_stroke_color',
			[
				'label'   => __( 'Color', 'happyden' ),
				'type'    => Controls_Manager::COLOR,
                'default' => "#222"
			]
		);

		$this->add_control(
			'happyden_progress_bar_stroke_width',
			[
				'label'   => __( 'Width', 'happyden' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 0,
				'max'     => 100,
				'step'    => 1,
				'default' => 15
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'happyden_progress_bar_back_style',
			[
				'label' => __('Back Bar', 'happyden'),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'happyden_progress_bar_trail_color',
			[
				'label'   => __( 'Color', 'happyden' ),
				'type'    => Controls_Manager::COLOR,
				'default' => '#ddd'
			]
		);

		$this->add_control(
			'happyden_progress_bar_trail_width',
			[
				'label'   => __( 'Width', 'happyden' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 0,
				'max'     => 100,
				'step'    => 1,
				'default' => 15
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'happyden_progress_bar_value_styles',
			[
				'label' => __('Percentage Value', 'happyden'),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'happyden_progress_bar_value_position',
			[
				'label'      => __( 'Position', 'happyden' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range'      => [
					'px'       => [
						'min'  => 0,
						'max'  => 50,
						'step' => 1
					]
				],
				'default'    => [
					'unit'   => '%',
					'size'   => 7
				],
				'selectors'  => [
					'{{WRAPPER}} [class*="happyden-progress-bar-"].fan .ldBar-label' => 'bottom: {{SIZE}}{{UNIT}};'
				],
				'condition'  => [
					'happyden_progress_bar_preset' => 'fan'
				]
			]
		);

		$this->add_control(
			'happyden_progress_bar_value_color',
			[
				'label'     => __( 'Text Color', 'happyden' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => [
					'{{WRAPPER}} .happyden-progress-bar .ldBar-label' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
				[
					'name'     => 'happyden_progress_bar_value_value_typography',
					'selector' => '{{WRAPPER}} .happyden-progress-bar .ldBar-label'
				]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'happyden_progress_bar_background',
				'types'    => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .happyden-progress-bar .ldBar-label'
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'happyden_progress_bar_border',
				'selector' => '{{WRAPPER}} .happyden-progress-bar .ldBar-label'
			]
		);

		$this->add_responsive_control(
			'happyden_progress_bar_radius',
			[
				'label'      => __( 'Border Radius', 'happyden' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '50',
					'right'  => '50',
					'bottom' => '50',
					'left'   => '50',
					'unit'   => '%'
				],
				'selectors'  => [
					'{{WRAPPER}} .happyden-progress-bar .ldBar-label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'happyden_progress_bar_padding_style',
			[
				'label'      => __( 'Padding', 'happyden' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '10',
					'right'  => '10',
					'bottom' => '10',
					'left'   => '10'
				],
				'selectors'  => [
					'{{WRAPPER}} .happyden-progress-bar .ldBar-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'happyden_progress_bar_box_shadow',
				'selector' => '{{WRAPPER}} .happyden-progress-bar .ldBar-label'
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$title    = $settings['happyden_progress_bar_title'];
		
		$this->add_render_attribute( 
			'happyden-progress-bar', 
			[ 
				'class' => [ 
					esc_attr( $settings['happyden_progress_bar_preset'] ), 
					'happyden-progress-bar', 
					'happyden-progress-bar-'.$this->get_id() 
				],
				'data-id'                              => $this->get_id(),
				'data-type'                            => esc_attr( $settings['happyden_progress_bar_preset'] ),
				'data-progress-bar-value'              => esc_attr( $settings['happyden_progress_bar_value'] ),
				'data-stroke-color'                    => esc_attr( $settings['happyden_progress_bar_stroke_color'] ),
				'data-progress-bar-stroke-width'       => esc_attr( $settings['happyden_progress_bar_stroke_width'] ),
				'data-stroke-trail-color'              => esc_attr( $settings['happyden_progress_bar_trail_color'] ),
				'data-progress-bar-stroke-trail-width' => esc_attr( $settings['happyden_progress_bar_trail_width'] )
			]
		);

		$this->add_render_attribute( 'happyden_progress_bar_title', 'class', 'happyden-progress-bar-title' );
        $this->add_inline_editing_attributes( 'happyden_progress_bar_title', 'none' );

		if ( 'line' === $settings['happyden_progress_bar_preset'] || 'line-bubble' === $settings['happyden_progress_bar_preset'] ) {
			$this->add_render_attribute(
				'happyden-progress-bar',
				[
					'data-preset' => 'line',
					'style'       => 'width: 100%; height: 100px'
				]
			);
		}

		if ( 'circle' === $settings['happyden_progress_bar_preset'] ) {
			$this->add_render_attribute(
				'happyden-progress-bar',
				[
					'data-preset' => 'circle',
					'style'       => 'width: 100%; height: 100%'
				]
			);
		}

		if ( 'fan' === $settings['happyden_progress_bar_preset'] ) {
			$this->add_render_attribute(
				'happyden-progress-bar',
				[
					'data-preset' => 'fan',
					'style'       => 'width: 100%; height: 100%'
				]
			);
		}
		
		echo '<div '.$this->get_render_attribute_string('happyden-progress-bar').' data-progress-bar>';
			echo $title ? '<h6 '.$this->get_render_attribute_string( 'happyden_progress_bar_title' ).'>'.$title.'</h6>' : '';
		echo '</div>';
	}
}
$widgets_manager->register_widget_type( new \Happyden\Widgets\Elementor\Happyden_Progress_Bar() );