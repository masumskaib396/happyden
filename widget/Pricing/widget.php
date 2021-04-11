<?php
namespace Happyden\Widgets\Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Icons_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Widget_Base;
use \Elementor\Repeater;

class Happyden_Pricing_Table extends Widget_Base {
	
	//use ElementsCommonFunctions;
	public function get_name() {
		return 'happyden-pricing-table';
	}

	public function get_title() {
		return esc_html__( 'Pricing Table', 'happyden' );
	}

	public function get_icon() {
		return 'eicon-image-box';
	}

	public function get_categories() {
		return [ 'happyden' ];
	}

	public function get_keywords() {
        return ['price', 'package', 'product', 'plan' ];
    }

	protected function _register_controls() {

		/**
  		 * Pricing Table Feature
  		 */
  		$this->start_controls_section(
  			'happyden_section_pricing_table_feature',
  			[
  				'label' => esc_html__( 'Features', 'happyden' )
  			]
		);
		  
		$pricing_repeater = new Repeater();

		$pricing_repeater->add_control(
			'happyden_pricing_table_item',
			[
				'name'        => 'happyden_pricing_table_item',
				'label'       => esc_html__( 'List Item', 'happyden' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Pricing table list item', 'happyden' )
			]
		);
		
		$pricing_repeater->add_control(
			'happyden_pricing_table_list_icon',
			[
				'name'        => 'happyden_pricing_table_list_icon',
				'label'       => esc_html__( 'List Icon', 'happyden' ),
				'type'        => Controls_Manager::ICONS,
				'default'     => [
					'value'   => 'fas fa-check',
					'library' => 'fa-solid'
				]
			]
		);
		
		$pricing_repeater->add_control(
			'happyden_pricing_table_icon_mood',
			[
				'name'         => 'happyden_pricing_table_icon_mood',
				'label'        => esc_html__( 'Item Active?', 'happyden' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes'
			]
        );

  		$this->add_control(
			'happyden_pricing_table_items',
			[
				'type'        => Controls_Manager::REPEATER,
				'fields'  => $pricing_repeater->get_controls(),
				'seperator'   => 'before',
				'default'     => [
					[ 'happyden_pricing_table_item' => esc_html__( 'Responsive Live', 'happyden' ) ],
					[ 'happyden_pricing_table_item' => esc_html__( 'Adaptive Bitrate', 'happyden' ) ],
					[ 'happyden_pricing_table_item' => esc_html__( 'Analytics', 'happyden' ) ],
					[ 	
						'happyden_pricing_table_item'      => esc_html__( 'Creative Layouts', 'happyden' ),
						'happyden_pricing_table_icon_mood' => 'no'
					],
					[ 
						'happyden_pricing_table_item'      => esc_html__( 'Free Support', 'happyden' ),
						'happyden_pricing_table_icon_mood' => 'no'
					]
				],	
				'title_field' => '{{happyden_pricing_table_item}}'
			]	
		);

		$this->end_controls_section();
		  
		/**
  		 * Pricing Table Promo label
  		 */
  		$this->start_controls_section(
			'happyden_section_pricing_table_promo_section',
			[
				'label' => esc_html__( 'Promo Label', 'happyden' )
			]
		);

		$this->add_control(
			'happyden_pricing_table_promo_enable',
			[
				'label'        => esc_html__( 'Promo Label?', 'happyden' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'no'
			]
		);

		$this->add_control(
			'happyden_pricing_table_promo_title',
			[
				'label'       => esc_html__( 'Title', 'happyden' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( 'Recommended', 'happyden' ),
				'condition'   => [
					'happyden_pricing_table_promo_enable' => 'yes'
				]
			]
		);

		$this->add_control(
			'happyden_pricing_table_promo_position',
			[
				'label'        => __( 'Position', 'happyden' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'promo_top',
				'options'      => [
					'promo_top'    => __( 'Top', 'happyden' ),
					'promo_bottom' => __( 'Bottom', 'happyden' ),
				],
				'condition'    => [
					'happyden_pricing_table_promo_enable' => 'yes'
				]
			]
		);

		$this->end_controls_section();

  		/**
  		 * Pricing Table Settings
  		 */
  		$this->start_controls_section(
  			'happyden_section_pricing_table_settings',
  			[
  				'label' => esc_html__( 'Header', 'happyden' )
  			]
  		);

  		$this->add_control(
			'happyden_pricing_table_title',
			[
				'label'       => esc_html__( 'Title', 'happyden' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( 'STANDARD', 'happyden' )
			]
		);

		$this->add_control(
			'happyden_pricing_table_subtitle',
			[
				'label'       => esc_html__( 'Subtitle', 'happyden' ),
				'type'        => Controls_Manager::TEXTAREA,
				'label_block' => true
			]
		);

		$this->add_control(
			'happyden_pricing_table_featured',
			[
				'label'        => esc_html__( 'Featured?', 'happyden' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'no'
			]
		);

		$this->add_control(
			'happyden_pricing_table_featured_type',
			[
				'label'     => esc_html__( 'Badge Type', 'happyden' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'text-badge',
				'options'   => [
					'text-badge' => __( 'Text Badge', 'happyden' ),
					'icon-badge' => __( 'Icon Badge', 'happyden' )
				],
				'condition' => [
					'happyden_pricing_table_featured' => 'yes'
				]
			]
		);

		$this->add_control(
			'happyden_pricing_table_featured_tag_text',
			[
				'label'       => esc_html__( 'Featured Text', 'happyden' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( 'FEATURED', 'happyden' ),
				'condition'   => [
					'happyden_pricing_table_featured'      => 'yes',
					'happyden_pricing_table_featured_type' => 'text-badge'
				]
			]
		);

  		$this->end_controls_section();

  		$this->start_controls_section(
  			'happyden_section_pricing_table_price',
  			[
  				'label' => esc_html__( 'Price', 'happyden' )
  			]
		);

		$this->add_control(
			'happyden_pricing_table_price',
			[
				'label'       => esc_html__( 'Price', 'happyden' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( '50', 'happyden' )
			]
		);
		
  		$this->add_control(
			'happyden_pricing_table_price_cur',
			[
				'label'       => esc_html__( 'Price Currency', 'happyden' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( '$', 'happyden' )
			]
		);

		$this->add_control(
			'happyden_pricing_table_price_cur_position',
			[
				'label'       => esc_html__( 'Currency Position', 'happyden' ),
				'type'        => Controls_Manager::CHOOSE,
				'toggle'	  => false,
				'label_block' => false,
				'default'     => 'happyden-pricing-cur-left',
				'options'     => [
					'happyden-pricing-cur-left' => [
						'title' => __( 'Left', 'happyden' ),
						'icon'  => 'eicon-angle-left'
					],
					'happyden-pricing-cur-right' => [
						'title' => __( 'Right', 'happyden' ),
						'icon'  => 'eicon-angle-right'
					]
				]
			]
		);

		$this->add_control(
			'happyden_pricing_table_price_by',
			[
				'label'       => esc_html__( 'Price By', 'happyden' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( 'mo', 'happyden' )
			]
		);

		$this->add_control(
			'happyden_pricing_table_period_separator',
			[
				'label'       => esc_html__( 'Separated By', 'happyden' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( '/', 'happyden' )
			]
		);

		$this->add_control(
			'happyden_pricing_table_discount_price',
			[
				'label' => __( 'Show Discount Price', 'happyden' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'happyden' ),
				'label_off' => __( 'Hide', 'happyden' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'happyden_pricing_table_regular_price',
			[
				'label'       => esc_html__( 'Ragular Price', 'happyden' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( '50', 'happyden' ),
				'condition'   => [
					'happyden_pricing_table_discount_price' => 'yes'
				]
			]
		);
		
  		$this->add_control(
			'happyden_pricing_table_regular_price_cur',
			[
				'label'       => esc_html__( 'Regular Price Currency', 'happyden' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( '$', 'happyden' ),
				'condition'   => [
					'happyden_pricing_table_discount_price' => 'yes'
				]
			]
		);

		$this->add_control(
			'happyden_pricing_table_price_subtitle',
			[
				'label'       => esc_html__( 'Price Subtitle', 'happyden' ),
				'type'        => Controls_Manager::TEXTAREA,
				'label_block' => true,
			]
		);

  		$this->end_controls_section();

  		

  		/**
  		 * Pricing Table Footer
  		 */
  		$this->start_controls_section(
  			'happyden_section_pricing_table_button',
  			[
  				'label' => esc_html__( 'Button', 'happyden' )
  			]
		);
		  

		$this->add_control(
			'happyden_pricing_table_btn_position',
			[
				'label'   => esc_html__( 'Position', 'happyden' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'bottom',
				'options' => [
					'middle' => __( 'Middle', 'happyden' ),
					'bottom' => __( 'Bottom', 'happyden' )
				]
			]
		);

		$this->add_control(
			'happyden_pricing_table_btn',
			[
				'label'       => esc_html__( 'Text', 'happyden' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Choose Plan', 'happyden' )
			]
		);

		$this->add_control(
			'happyden_pricing_table_btn_link',
			[
				'label'       => esc_html__( 'Link', 'happyden' ),
				'type'        => Controls_Manager::URL,
				'label_block' => true,
				'default'     => [
					'url'         => '#',
					'is_external' => ''
     			],
     			'show_external' => true
			]
		);

		$this->end_controls_section();
		  
		  /**
  		 * Pricing Table Note
  		 */
  		$this->start_controls_section(
			'happyden_section_pricing_table_note',
			[
				'label' => esc_html__( 'Note', 'happyden' )
			]
		);

		$this->add_control(
			'happyden_pricing_table_note_text',
			[
				'label' => __( 'Text', 'happyden' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 5,
			]
		);

		$this->end_controls_section();

  	
		/**
		 * -------------------------------------------
		 * Tab Style (Pricing Table Style)
		 * -------------------------------------------
		 */

		$this->start_controls_section(
			'happyden_section_pricing_tables_styles_presets',
			[
				'label' => esc_html__( 'Container', 'happyden' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'happyden_pricing_table_bg_color_simple',
				'label' => __( 'Background', 'happyden' ),
				'types' => [ 'classic', 'gradient' ],
				'fields_options'  => [
					'background'  => [
						'default' => 'classic'
					],
					'color'       => [
						'default' => '#ffffff'
					]
				],
				'selector' => '{{WRAPPER}} .happyden-pricing-table-badge-wrapper',
				'condition' => [
					'happyden_pricing_table_header_type' => 'simple'
				]
			]
		);
				
		$this->add_control(
			'happyden_pricing_table_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'happyden' ),
				'seperator' => 'before',
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .happyden-pricing-table-badge-wrapper' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .happyden-pricing-table-header .happyden-pricing-table-header-curved svg path' => 'fill: {{VALUE}};'
				],
				'condition' => [
					'happyden_pricing_table_header_type' => 'curved-header'
				]
			]
		);

		$this->add_responsive_control(
			'happyden_pricing_table_content_padding',
			[
				'label'      => __( 'Padding', 'happyden' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '45',
					'right'    => '30',
					'bottom'   => '45',
					'left'     => '30',
					'isLinked' => false
				],
				'selectors' => [
					'{{WRAPPER}} .happyden-pricing-table-badge-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'happyden_pricing_table_content_border',
				'selector' => '{{WRAPPER}} .happyden-pricing-table-badge-wrapper'
			]
		);

		$this->add_responsive_control(
			'happyden_pricing_table_content_border_radius',
			[
				'label'      => __( 'Border Radius', 'happyden' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
                    'top'      => '10',
                    'right'    => '10',
                    'bottom'   => '10',
                    'left'     => '10',
                    'unit'     => 'px'
                ],
				'selectors'  => [
					'{{WRAPPER}} .happyden-pricing-table-badge-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .happyden-pricing-table-header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 0 0;',
					'{{WRAPPER}} .happyden-pricing-table-header .happyden-pricing-table-header-svg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 0 0;'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'happyden_pricing_table_content_box_shadow',
				'selector' => '{{WRAPPER}} .happyden-pricing-table-badge-wrapper',
				'fields_options'         => [
		            'box_shadow_type'    => [
		                'default'        =>'yes'
		            ],
		            'box_shadow'         => [
		                'default'        => [
		                    'horizontal' => 0,
		                    'vertical'   => 13,
		                    'blur'       => 33,
		                    'spread'     => 0,
		                    'color'      => 'rgba(51,77,128,0.08)'
		                ]
		            ]
	            ]
			]
		);

		$content_align = is_rtl() ? 'right' : 'left';

		$this->add_control(
			'happyden_pricing_table_content_alignment',
			[
				'label'         => __( 'Alignment', 'happyden' ),
				'type'          => Controls_Manager::CHOOSE,
				'toggle'        => false,
				'separator'     => 'after',
				'default'       => $content_align,
				'options'       => [
					'left'      => [
						'title' => __( 'Left', 'happyden' ),
						'icon'  => 'eicon-text-align-left'
					],
					'center'    => [
						'title' => __( 'Center', 'happyden' ),
						'icon'  => 'eicon-text-align-center'
					],
					'right'     => [
						'title' => __( 'Right', 'happyden' ),
						'icon'  => 'eicon-text-align-right'
					]
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'happyden_pricing_table_transition_shadow',
				'label'    => __( 'Hover Box Shadow', 'happyden' ),
				'selector' => '{{WRAPPER}} .happyden-pricing-table-wrapper:hover .happyden-pricing-table-badge-wrapper',
				'fields_options'      => [
		            'box_shadow_type' => [
		                'default'     =>'yes'
		            ],
		            'box_shadow'  => [
		                'default' => [
		                    'horizontal' => 0,
		                    'vertical'   => 20,
		                    'blur'       => 40,
		                    'spread'     => 0,
		                    'color'      => 'rgba(51,77,128,0.2)'
		                ]
		            ]
	            ]
			]
		);

		$this->add_control(
			'happyden_pricing_table_transition_type',
			[
				'label'   => __( 'Hover Style', 'happyden' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'none'              =>  __( 'None', 'happyden' ),
					'transition_top'    =>  __( 'Transition Top', 'happyden' ),
					'transition_bottom' => __( 'Transition Bottom', 'happyden' ),
					'transition_zoom'   => __( 'Transition Zoom', 'happyden' )
				],
				'default' => 'none'
			]
		);

		
		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Style (Promo label)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'happyden_section_pricing_table_promo_style',
			[
				'label'     => esc_html__( 'Promo Label', 'happyden' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'happyden_pricing_table_promo_enable' => 'yes'
				]
			]
		);

		$this->add_control(
			'happyden_pricing_table_promo_alignment',
			[
				'label'     => __( 'Alignment', 'happyden' ),
				'type'      => Controls_Manager::CHOOSE,
				'toggle'    => false,
				'options'   => [
					'left'      => [
						'title' => __( 'Left', 'happyden' ),
						'icon'  => 'eicon-text-align-left'
					],
					'center'    => [
						'title' => __( 'Center', 'happyden' ),
						'icon'  => 'eicon-text-align-center'
					],
					'right'     => [
						'title' => __( 'Right', 'happyden' ),
						'icon'  => 'eicon-text-align-right'
					]
				],
				'default'   => 'center',
				'selectors' => [
					'{{WRAPPER}} .happyden-pricing-table-promo-label' => 'text-align: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'happyden_pricing_table_promo_background',
				'types'     => [ 'classic', 'gradient' ],
				'fields_options'  => [
					'background'  => [
						'default' => 'classic'
					],
					'color'       => [
						'default' => '#ffffff'
					]
				],
				'selector'  => '{{WRAPPER}} .happyden-pricing-table-promo-label',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'happyden_pricing_table_promo_typography',
				'label'    => __( 'Typography', 'happyden' ),
				'selector' => '{{WRAPPER}} .happyden-pricing-table-promo-label',
			]
		);

		$this->add_control(
			'happyden_pricing_table_promo_text-color',
			[
				'label'     => esc_html__( 'Text Color', 'happyden' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000',
				'selectors' => [
					'{{WRAPPER}} .happyden-pricing-table-promo-label' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'happyden_pricing_table_promo_padding',
			[
				'label'      => __( 'Padding', 'happyden' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '15',
					'right'    => '30',
					'bottom'   => '15',
					'left'     => '30',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .happyden-pricing-table-promo-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'happyden_pricing_table_promo_radius',
			[
				'label'      => __( 'Border radius', 'happyden' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => true
				],
				'selectors'  => [
					'{{WRAPPER}} .happyden-pricing-table-promo-label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Style (Header)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'happyden_section_pricing_table_title_header_settings',
			[
				'label' => esc_html__( 'Header', 'happyden' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'happyden_pricing_table_header_type',
			[
				'label'   => esc_html__( 'Header Type', 'happyden' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'simple',
				'options' => [
					'simple'        => __( 'Simple', 'happyden' ),
					'curved-header' => __( 'Curved Header', 'happyden' )
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'happyden_pricing_table_header_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .happyden-pricing-table-header',
			]
		);

		$this->add_responsive_control(
			'happyden_pricing_table_header_padding',
			[
				'label'      => __( 'Padding', 'happyden' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .happyden-pricing-table-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'happyden_pricing_table_header_margin',
			[
				'label'      => __( 'Margin', 'happyden' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '20',
					'left'     => '0',
					'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .happyden-pricing-table-header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Style (Title)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'happyden_section_pricing_table_title_style_settings',
			[
				'label' => esc_html__( 'Header Title', 'happyden' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'happyden_section_pricing_table_title_heading',
			[
				'label'     => esc_html__( 'Title', 'happyden' ),
				'type'      => Controls_Manager::HEADING,
				'separator' =>  'before'
			]
		);

		$this->add_control(
			'happyden_pricing_table_title_color',
			[
				'label'     => esc_html__( 'Text Color', 'happyden' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#8a8d91',
				'selectors' => [
					'{{WRAPPER}} .happyden-pricing-table-title' => 'color: {{VALUE}};'
				]
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'happyden_pricing_table_title_typography',
				'selector' => '{{WRAPPER}} .happyden-pricing-table-title',
				'fields_options'   => [
					'font_size'    => [
		                'default'  => [
		                    'unit' => 'px',
		                    'size' => 15
		                ]
		            ],
		            'font_weight'  => [
		                'default'  => '400'
		            ]
	            ]
			]
		);

		$this->add_responsive_control(
			'happyden_pricing_table_title_margin',
			[
				'label'      => esc_html__( 'Margin', 'happyden' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '20',
					'left'     => '0',
					'isLinked' => false
				],
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .happyden-pricing-table-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		/**
		 * -------------------------------------------
		 * Style (Sub Title)
		 * -------------------------------------------
		 */

		$this->add_control(
			'happyden_section_pricing_table_subtitletitle_heading',
			[
				'label'     => esc_html__( 'Sub Title', 'happyden' ),
				'type'      => Controls_Manager::HEADING,
				'separator' =>  'before'
			]
		);

		$this->add_control(
			'happyden_pricing_table_subtitle_color',
			[
				'label'     => esc_html__( 'Color', 'happyden' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => [
					'{{WRAPPER}} .happyden-pricing-table-subtitle' => 'color: {{VALUE}};'
				]
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'happyden_pricing_table_subtitle_typography',
				'selector' => '{{WRAPPER}} .happyden-pricing-table-subtitle'
			]
		);

		$this->add_responsive_control(
			'happyden_pricing_table_subtitle_margin',
			[
				'label'   => esc_html__( 'Margin', 'happyden' ),
				'type'    => Controls_Manager::DIMENSIONS,
				'default' => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '10',
					'left'     => '0',
					'isLinked' => false
				],
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .happyden-pricing-table-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Style (Pricing)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'happyden_section_pricing_table_price_style_settings',
			[
				'label' => esc_html__( 'Pricing', 'happyden' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'happyden_pricing_table_price_box_separator',
			[
				'label'        => esc_html__( 'Enable Separator', 'happyden' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'ON', 'happyden' ),
				'label_off'    => __( 'OFF', 'happyden' ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

		$this->add_responsive_control(
			'happyden_pricing_table_price_box_separator_height',
			[
				'label'     => esc_html__( 'Separator Height', 'happyden' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '1',
				'selectors' => [
					'{{WRAPPER}} .happyden-price-bottom-separator' => 'height: {{VALUE}}px;'
				],
				'condition' => [
					'happyden_pricing_table_price_box_separator' => 'yes'
				]
				
			]
		);

		$this->add_control(
			'happyden_pricing_table_price_box_separator_color',
			[
				'label'     => esc_html__( 'Separator Color', 'happyden' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#e5e5e5',
				'selectors' => [
					'{{WRAPPER}} .happyden-price-bottom-separator'  => 'background-color: {{VALUE}};'
				],
				'condition' => [
					'happyden_pricing_table_price_box_separator' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'happyden_pricing_table_price_box_separator_spacing',
			[
				'label'       => esc_html__( 'Separator Spacing', 'happyden' ),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [
					'size'    => 30
				],
				'range'       => [
					'px'      => [
						'max' => 50
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .happyden-price-bottom-separator' => 'margin: {{SIZE}}px 0;'
				],
				'condition'   => [
					'happyden_pricing_table_price_box_separator' => 'yes'
				]
			]
		);

		$this->add_control(
			'happyden_pricing_table_price_box',
			[
				'label'        => esc_html__( 'Price Box', 'happyden' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'ON', 'happyden' ),
				'label_off'    => __( 'OFF', 'happyden' ),
				'separator'	   => 'before',
				'return_value' => 'yes',
				'default'      => 'no'
			]
		);

		$this->add_responsive_control(
			'happyden_pricing_table_price_box_height',
			[
				'label'     => __( 'Box Height', 'happyden' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '100',
				'selectors' => [
					'{{WRAPPER}} .price-box' => 'height: {{VALUE}}px'
				],
				'condition' => [
					'happyden_pricing_table_price_box' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'happyden_pricing_table_price_box_width',
			[
				'label'     => __( 'Box Width', 'happyden' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '100',
				'selectors' => [
					'{{WRAPPER}} .price-box' => 'width: {{VALUE}}px'
				],
				'condition' => [
					'happyden_pricing_table_price_box' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'happyden_pricing_table_price_box_background',
				'types'     => [ 'classic', 'gradient'],
				'selector'  => '{{WRAPPER}} .price-box',
				'condition' => [
					'happyden_pricing_table_price_box' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'happyden_pricing_table_price_box_border',
				'selector'  => '{{WRAPPER}} .price-box',
				'condition' => [
					'happyden_pricing_table_price_box' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'happyden_pricing_table_price_box_radius',
			[
				'label'      => __( 'Box Radius', 'happyden' ),
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
					'{{WRAPPER}} .price-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'condition'  => [
					'happyden_pricing_table_price_box' => 'yes'
				]
			]
		);

		$this->add_control(
			'happyden_pricing_table_price_tag_heading',
			[
				'label'     => esc_html__( 'Original Price', 'happyden' ),
				'type'      => Controls_Manager::HEADING,
				'separator' =>  'before'
			]
		);

		$this->add_control(
			'happyden_pricing_table_pricing_color',
			[
				'label'     => esc_html__( 'Color', 'happyden' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#132c47',
				'selectors' => [
					'{{WRAPPER}} .happyden-pricing-table-wrapper .happyden-pricing-table-price p.happyden-pricing-table-new-price'  => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'happyden_pricing_table_price_tag_typography',
				'selector' => '{{WRAPPER}} .happyden-pricing-table-wrapper .happyden-pricing-table-price p.happyden-pricing-table-new-price',
				'fields_options'   => [
					'font_size'    => [
		                'default'  => [
		                    'unit' => 'px',
		                    'size' => 48
		                ]
		            ],
		            'font_weight'  => [
		                'default'  => '600'
		            ],
		              'letter_spacing' => [
		                'default'      => [
		                    'unit'     => 'px',
		                    'size'     => -3.2
		                ]
		            ]
	            ]
			]
		);

		$this->add_control(
			'happyden_pricing_table_regular_price_heading',
			[
				'label'     => esc_html__( 'Regular Price', 'happyden' ),
				'type'      => Controls_Manager::HEADING,
				'separator' =>  'before',
				'condition' => [
					'happyden_pricing_table_discount_price' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'happyden_pricing_table_regular_price_typography',
				'selector' => '{{WRAPPER}} .happyden-pricing-table-price.happyden-discount-price-yes p.happyden-pricing-table-regular-price',
				'condition' => [
					'happyden_pricing_table_discount_price' => 'yes'
				]
			]
		);

		$this->add_control(
			'happyden_pricing_table_regular_price_color',
			[
				'label'     => esc_html__( 'Color', 'happyden' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#132c47',
				'selectors' => [
					'{{WRAPPER}} .happyden-pricing-table-price.happyden-discount-price-yes p.happyden-pricing-table-regular-price' => 'color: {{VALUE}};'
				],
				'condition' => [
					'happyden_pricing_table_discount_price' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'happyden_pricing_table_regular_price_right_spacing',
			[
				'label'       => esc_html__( 'Regular Price Right Spacing', 'happyden' ),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [
					'size'    => 10
				],
				'range'       => [
					'px'      => [
						'max' => 100
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .happyden-pricing-table-price.happyden-discount-price-yes p.happyden-pricing-table-regular-price' => 'margin-right: {{SIZE}}px;'
				],
				'condition' => [
					'happyden_pricing_table_discount_price' => 'yes'
				]
			]
		);

		$this->add_control(
			'happyden_pricing_table_pricing_curency_heading',
			[
				'label'     => esc_html__( 'Pricing Curency', 'happyden' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'happyden_pricing_table_pricing_curency_spacing',
			[
				'label' => __( 'Spacing', 'happyden' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_off' => __( 'Default', 'happyden' ),
				'label_on' => __( 'Custom', 'happyden' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->start_popover();

			$this->add_responsive_control(
				'happyden_pricing_table_pricing_curency_bottom_spacing',
				[
					'label'      => esc_html__( 'Bottom Spacing', 'happyden' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range'      => [
						'px'     => [
							'min'  => -100,
							'max'  => 100,
							'step' => 1
						],
					],
					'selectors'  => [
						'{{WRAPPER}} .happyden-pricing-table-wrapper .happyden-pricing-table-price span.happyden-pricing-table-currency' => 'top: {{SIZE}}{{UNIT}};'
					],
				]
			);

            $this->add_responsive_control(
				'happyden_pricing_table_pricing_curency_right_spacing',
				[
					'label'      => esc_html__( 'Right Spacing', 'happyden' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range'      => [
						'px'     => [
							'min'  => 0,
							'max'  => 200,
							'step' => 1
						],
					],
					'selectors'  => [
						'{{WRAPPER}} .happyden-pricing-table-wrapper .happyden-pricing-table-price span.happyden-pricing-table-currency' => 'margin-right: {{SIZE}}{{UNIT}};'
					],
				]
			);

        $this->end_popover();

		$this->add_control(
			'happyden_pricing_table_pricing_curency_color',
			[
				'label'     => esc_html__( 'Color', 'happyden' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .happyden-pricing-table-wrapper .happyden-pricing-table-price span.happyden-pricing-table-currency' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'happyden_pricing_table_price_curency_typography',
				'selector' => '{{WRAPPER}} .happyden-pricing-table-wrapper .happyden-pricing-table-price span.happyden-pricing-table-currency',
			]
		);

		$this->add_control(
			'happyden_pricing_table_pricing_period_heading',
			[
				'label'     => esc_html__( 'Pricing By', 'happyden' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'happyden_pricing_table_pricing_period_color',
			[
				'label'     => esc_html__( 'Color', 'happyden' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#132c47',
				'selectors' => [
					'{{WRAPPER}} .happyden-pricing-table-wrapper .happyden-pricing-table-price span.happyden-price-period' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'happyden_pricing_table_price_preiod_typography',
				'selector' => '{{WRAPPER}} .happyden-pricing-table-wrapper .happyden-price-period',
				'fields_options'   => [
					'font_size'    => [
		                'default'  => [
		                    'unit' => 'px',
		                    'size' => 20
		                ]
		            ],
		            'font_weight'  => [
		                'default'  => '600'
		            ],
		              'letter_spacing' => [
		                'default'      => [
		                    'unit'     => 'px',
		                    'size'     => 0
		                ]
		            ]
	            ]
			]
		);

		$this->add_control(
			'happyden_pricing_table_price_subtitle_heading',
			[
				'label'     => esc_html__( 'Price Subtitle', 'happyden' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'happyden_pricing_table_price_subtitle_color',
			[
				'label'     => esc_html__( 'Text Color', 'happyden' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .happyden-pricing-table-wrapper .happyden-pricing-table-price-subtitle' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'happyden_pricing_table_price_subtitle_typography',
				'selector' => '{{WRAPPER}} .happyden-pricing-table-wrapper .happyden-pricing-table-price-subtitle',
			]
		);

		$this->add_responsive_control(
			'happyden_pricing_table_price_subtitle_margin',
			[
				'label'      => __( 'Margin', 'happyden' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
					'unit'   => 'px',
					'islinked' => true
				],
				'selectors'  => [
					'{{WRAPPER}} .happyden-pricing-table-wrapper .happyden-pricing-table-price-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->end_controls_section();


		/**
		 * -------------------------------------------
		 * Style (Feature List)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'happyden_section_pricing_table_style_featured_list_settings',
			[
				'label' => esc_html__( 'Feature List', 'happyden' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'happyden_pricing_table_list_item_typography',
				'selector' => '{{WRAPPER}} .happyden-pricing-table-features li'
			]
		);

		$this->add_responsive_control(
			'happyden_pricing_table_featured_list_icon_size',
			[
				'label'       => esc_html__( 'Icon Size', 'happyden' ),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [
					'size'    => 12
				],
				'range'       => [
					'px'      => [
						'max' => 24
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .happyden-pricing-li-icon' => 'font-size: {{SIZE}}px;'
				]
			]
		);

		$icon_gap = is_rtl() ? 'left' : 'right';

		$this->add_responsive_control(
			'happyden_pricing_table_featured_list_icon_space',
			[
				'label'       => esc_html__( 'Icon Space', 'happyden' ),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [
					'size'    => 7
				],
				'range'       => [
					'px'      => [
						'max' => 24
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .happyden-pricing-table-features li .happyden-pricing-li-icon' => 'margin-'.$icon_gap.': {{SIZE}}px;'
				]
			]
		);

		$this->add_control(
			'happyden_pricing_table_list_item_icon_color',
			[
				'label'     => esc_html__( 'Icon Color', 'happyden' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .happyden-pricing-table-features li span.happyden-pricing-li-icon' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'happyden_pricing_table_list_item_color',
			[
				'label'     => esc_html__( 'Item Color', 'happyden' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#132c47',
				'selectors' => [
					'{{WRAPPER}} .happyden-pricing-table-features li' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'happyden_pricing_table_list_padding',
			[
				'label'      => __( 'Padding', 'happyden' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '10',
					'right'    => '0',
					'bottom'   => '10',
					'left'     => '0',
					'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .happyden-pricing-table-features li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_control(
			'happyden_pricing_table_list_border_bottom',
			[
				'label'        => __( 'List Border Bottom', 'happyden' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'happyden' ),
				'label_off'    => __( 'Hide', 'happyden' ),
				'return_value' => 'yes',
				'default'      => 'no'
			]
		);

		$this->add_control(
			'happyden_pricing_table_list_border_bottom_style',
			[
				'label'     => __( 'List Border Bottom Color', 'happyden' ),
				'type'      => Controls_Manager::COLOR,
				'defailt'   => '#e5e5e5',
				'selectors' => [
					'{{WRAPPER}} .list-border-bottom li:not(:last-child)' => 'border-bottom:1px solid {{VALUE}};'
				],
				'condition' => [
					'happyden_pricing_table_list_border_bottom' => 'yes'
				]
			]
		);

		$this->add_control(
			'happyden_pricing_table_list_disable_item_styling',
			[
				'label'     => esc_html__( 'Disable Items', 'happyden' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'happyden_pricing_table_list_disable_item_icon_color',
			[
				'label'     => esc_html__( 'Icon Color', 'happyden' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#a6a9ad',
				'selectors' => [
					'{{WRAPPER}} .happyden-pricing-table-features li.happyden-pricing-table-features-disable span.happyden-pricing-li-icon' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'happyden_pricing_table_list_disable_item_color',
			[
				'label'     => esc_html__( 'Item color', 'happyden' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#a6a9ad',
				'selectors' => [
					'{{WRAPPER}} .happyden-pricing-table-features li.happyden-pricing-table-features-disable' => 'color: {{VALUE}};'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Pricing Table Featured Tag Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'happyden_section_pricing_table_featured_tag_settings',
			[
				'label'     => esc_html__( 'Featured Badge', 'happyden' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'happyden_pricing_table_featured' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'happyden_pricing_table_featured_tag_font_size',
			[
				'label'       => esc_html__( 'Font Size', 'happyden' ),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [
					'size'    => 12
				],
				'range'       => [
					'px'      => [
						'max' => 40
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .text-badge'   => 'font-size: {{SIZE}}px;',
					'{{WRAPPER}} .icon-badge i' => 'font-size: {{SIZE}}px;'
				]
			]
		);

		$this->add_control(
			'happyden_pricing_table_featured_tag_text_color',
			[
				'label'     => esc_html__( 'Color', 'happyden' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .text-badge'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .icon-badge i' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'happyden_pricing_table_featured_text_badge_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .text-badge',
				'condition' => [
					'happyden_pricing_table_featured_type' => 'text-badge'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'happyden_pricing_table_featured_icon_badge_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .icon-badge',
				'condition' => [
					'happyden_pricing_table_featured_type' => 'icon-badge'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Button Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'happyden_section_pricing_table_btn_style_settings',
			[
				'label' => esc_html__( 'Button', 'happyden' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'happyden_pricing_table_btn_typography',
				'selector' => '{{WRAPPER}} .happyden-pricing-table-wrapper .happyden-pricing-table-action'
			]
		);

		$this->add_responsive_control(
			'happyden_pricing_table_button_border_radius',
			[
				'label'      => __( 'Border Radius', 'happyden' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '4',
					'right'  => '4',
					'bottom' => '4',
					'left'   => '4'
				],
				'selectors'  => [
					'{{WRAPPER}} .happyden-pricing-table-wrapper .happyden-pricing-table-action' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'happyden_pricing_table_button_padding',
			[
				'label'      => __( 'Padding', 'happyden' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '12',
					'right'    => '30',
					'bottom'   => '12',
					'left'     => '30',
					'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .happyden-pricing-table-wrapper .happyden-pricing-table-action' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'happyden_pricing_table_button_margin',
			[
				'label'      => __( 'Margin', 'happyden' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '30',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .happyden-pricing-table-wrapper .happyden-pricing-table-action' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->start_controls_tabs( 'happyden_pricing_table_button_tabs' );

			// Normal State Tab
			$this->start_controls_tab( 'happyden_pricing_table_btn_normal', [ 'label' => esc_html__( 'Normal', 'happyden' ) ] );

			$this->add_control(
				'happyden_pricing_table_btn_normal_text_color',
				[
					'label'     => esc_html__( 'Text Color', 'happyden' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#ffffff',
					'selectors' => [
						'{{WRAPPER}} .happyden-pricing-table-wrapper .happyden-pricing-table-action' => 'color: {{VALUE}};'
					]
				]
			);

			$this->add_control(
				'happyden_pricing_table_btn_normal_bg_color',
				[
					'label'     => esc_html__( 'Background Color', 'happyden' ),
					'type'      => Controls_Manager::COLOR,
                    'default'   => '#F96331',
					'selectors' => [
						'{{WRAPPER}} .happyden-pricing-table-wrapper .happyden-pricing-table-action' => 'background-color: {{VALUE}};'
					]
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'            => 'happyden_pricing_table_btn_normal_border',
					'selector'        => '{{WRAPPER}} .happyden-pricing-table-wrapper .happyden-pricing-table-action'
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'happyden_pricing_table_btn_box_shadow',
					'selector' => '{{WRAPPER}} .happyden-pricing-table-wrapper .happyden-pricing-table-action'
				]
			);

			$this->end_controls_tab();

			// Hover State Tab
			$this->start_controls_tab( 'happyden_pricing_table_btn_hover', [ 'label' => esc_html__( 'Hover', 'happyden' ) ] );

			$this->add_control(
				'happyden_pricing_table_btn_hover_text_color',
				[
					'label'     => esc_html__( 'Text Color', 'happyden' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .happyden-pricing-table-wrapper .happyden-pricing-table-action:hover' => 'color: {{VALUE}};'
					]
				]
			);

			$this->add_control(
				'happyden_pricing_table_btn_hover_bg_color',
				[
					'label'     => esc_html__( 'Background Color', 'happyden' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#F96331',
					'selectors' => [
						'{{WRAPPER}} .happyden-pricing-table-wrapper .happyden-pricing-table-action:hover' => 'background-color: {{VALUE}};'
					]
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'            => 'happyden_pricing_table_btn_hover_border',
					'selector'        => '{{WRAPPER}} .happyden-pricing-table-wrapper .happyden-pricing-table-action:hover'
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'happyden_pricing_table_btn_box_shadow_hover',
					'selector' => '{{WRAPPER}} .happyden-pricing-table-wrapper .happyden-pricing-table-action:hover'
				]
			);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Note Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'happyden_section_pricing_table_note_style',
			[
				'label' => esc_html__( 'Note', 'happyden' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'happyden_pricing_table_note_alignment',
			[
				'label'         => __( 'Alignment', 'happyden' ),
				'type'          => Controls_Manager::CHOOSE,
				'toggle'        => false,
				'default'		=> 'center',
				'options'       => [
					'left'      => [
						'title' => __( 'Left', 'happyden' ),
						'icon'  => 'eicon-text-align-left'
					],
					'center'    => [
						'title' => __( 'Center', 'happyden' ),
						'icon'  => 'eicon-text-align-center'
					],
					'right'     => [
						'title' => __( 'Right', 'happyden' ),
						'icon'  => 'eicon-text-align-right'
					]
				],
				'selectors'  => [
					'{{WRAPPER}} .happyden-pricing-table-wrapper .happyden-pricing-table-note' => 'text-align: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'happyden_section_pricing_table_note_padding',
			[
				'label'      => __( 'Padding', 'happyden' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '10',
					'right'    => '10',
					'bottom'   => '10',
					'left'     => '10',
					'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .happyden-pricing-table-wrapper .happyden-pricing-table-note' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'happyden_section_pricing_table_note_margin',
			[
				'label'      => __( 'Margin', 'happyden' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .happyden-pricing-table-wrapper .happyden-pricing-table-note' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'happyden_section_pricing_table_note_background',
				'label' => __( 'Background', 'happyden' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .happyden-pricing-table-wrapper .happyden-pricing-table-note',
			]
		);

		$this->add_control(
			'happyden_section_pricing_table_note_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'happyden' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000',
				'selectors' => [
					'{{WRAPPER}} .happyden-pricing-table-wrapper .happyden-pricing-table-note' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'happyden_section_pricing_table_note_text_typography',
				'label'    => __( 'Typography', 'happyden' ),
				'selector' => '{{WRAPPER}} .happyden-pricing-table-wrapper .happyden-pricing-table-note',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'happyden_section_pricing_table_note_border',
				'selector' => '{{WRAPPER}} .happyden-pricing-table-wrapper .happyden-pricing-table-note'
			]
		);

		$this->add_responsive_control(
			'happyden_section_pricing_table_note_border_radius',
			[
				'label'      => __( 'Border Radius', 'happyden' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .happyden-pricing-table-wrapper .happyden-pricing-table-note' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

	}

	private function pricing_table_currency( $currency ) {
		return $currency ? '<span '.$this->get_render_attribute_string( 'happyden_pricing_table_price_cur' ).'>'.esc_html( $currency ).'</span>' : '';
	}

	protected function render() {
		$settings      = $this->get_settings_for_display();
		$title         = $settings['happyden_pricing_table_title'];
		$sub_title     = $settings['happyden_pricing_table_subtitle'];
		$price         = $settings['happyden_pricing_table_price'];
		$separator     = $settings['happyden_pricing_table_period_separator'];
		$price_by      = $settings['happyden_pricing_table_price_by'];
		$featured_text = $settings['happyden_pricing_table_featured_tag_text'];

		$this->add_render_attribute( 
			'happyden_pricing_table_wrapper', 
			[ 
				'class' => [ 
					'happyden-pricing-table-wrapper', 
					'happyden-pricing-table', 
					esc_attr( $settings['happyden_pricing_table_content_alignment'] ), 
					esc_attr( $settings['happyden_pricing_table_transition_type'] )
				]
			]
		);
	
		$this->add_render_attribute( 'happyden_pricing_table_featured_tag_text', 'class', 'happyden-pricing-featured-tag-text' );
		$this->add_inline_editing_attributes( 'happyden_pricing_table_featured_tag_text', 'none' );

		$this->add_render_attribute( 'happyden_pricing_table_promo_title', 'class', 'happyden-pricing-table-promo-label' );
		$this->add_inline_editing_attributes( 'happyden_pricing_table_promo_title', 'none' );

		$this->add_render_attribute( 'happyden_pricing_table_title', 'class', 'happyden-pricing-table-title' );
		$this->add_inline_editing_attributes( 'happyden_pricing_table_title', 'basic' );

		$this->add_render_attribute( 'happyden_pricing_table_subtitle', 'class', 'happyden-pricing-table-subtitle' );
		$this->add_inline_editing_attributes( 'happyden_pricing_table_subtitle', 'basic' );

		$this->add_render_attribute( 'happyden_pricing_table_box_value', 'class', [ 'happyden-pricing-table-price', 'happyden-discount-price-'.$settings['happyden_pricing_table_discount_price'] ] );

		if( 'yes' === $settings['happyden_pricing_table_price_box'] ){
			$this->add_render_attribute( 'happyden_pricing_table_box_value', 'class', 'price-box' );
		}

		$this->add_render_attribute( 'happyden_pricing_table_price_cur', 'class', 'happyden-pricing-table-currency' );
		$this->add_inline_editing_attributes( 'happyden_pricing_table_price_cur', 'none' );

		$this->add_render_attribute( 'happyden_pricing_table_period_separator', 'class', 'happyden-pricing-table-currency-separator' );
		$this->add_inline_editing_attributes( 'happyden_pricing_table_period_separator', 'none' );

		$this->add_render_attribute( 'happyden_pricing_table_price_by', 'class', 'happyden-pricing-table-price-by' );
		$this->add_inline_editing_attributes( 'happyden_pricing_table_price_by', 'none' );

		$this->add_render_attribute( 'happyden_pricing_table_price', 'class', 'happyden-pricing-table-price' );
		$this->add_inline_editing_attributes( 'happyden_pricing_table_price', 'none' );

		$this->add_render_attribute( 'happyden_pricing_table_features', 'class', 'happyden-pricing-table-features' );
		if( 'yes' === $settings['happyden_pricing_table_list_border_bottom'] ){
			$this->add_render_attribute( 'happyden_pricing_table_features', 'class', 'list-border-bottom' );
		}

        $this->add_render_attribute( 'happyden_pricing_table_btn_link', 'class', 'happyden-pricing-table-action' );
		if( $settings['happyden_pricing_table_btn_link']['url'] ) {
            $this->add_render_attribute( 'happyden_pricing_table_btn_link', 'href', esc_url( $settings['happyden_pricing_table_btn_link']['url'] ) );
	        if( $settings['happyden_pricing_table_btn_link']['is_external'] ) {
	            $this->add_render_attribute( 'happyden_pricing_table_btn_link', 'target', '_blank' );
	        }
	        if( $settings['happyden_pricing_table_btn_link']['nofollow'] ) {
	            $this->add_render_attribute( 'happyden_pricing_table_btn_link', 'rel', 'nofollow' );
	        }
        }

        $this->add_inline_editing_attributes( 'happyden_pricing_table_btn', 'none' );

		echo '<div '.$this->get_render_attribute_string( 'happyden_pricing_table_wrapper' ).'>';
			if( 'promo_top' === $settings['happyden_pricing_table_promo_position'] ) {
				if( 'yes' === $settings['happyden_pricing_table_promo_enable'] ) {
					echo '<span '.$this->get_render_attribute_string( 'happyden_pricing_table_promo_title' ).'>'.$settings['happyden_pricing_table_promo_title'].'</span>';
				}
			}
			echo '<div class="happyden-pricing-table-badge-wrapper">';

				if ( 'yes' === $settings['happyden_pricing_table_featured'] ) {
					echo '<span class="happyden-pricing-table-badge '.esc_attr( $settings['happyden_pricing_table_featured_type'] ).'">';
						if( 'text-badge' === $settings['happyden_pricing_table_featured_type'] && !empty( $featured_text ) ) {
							echo '<span '.$this->get_render_attribute_string( 'happyden_pricing_table_featured_tag_text' ).'>';
								echo esc_html( $featured_text );
							echo '</span>';
						}
						if( 'icon-badge' === $settings['happyden_pricing_table_featured_type'] ) {
							echo '<i class="demo-icon eicon-star"></i>';
						}
					echo '</span>';
				}

				echo '<div class="happyden-pricing-table-header">';
					do_action( 'happyden_pricing_table_header_wrapper_before' );

					$title ? printf( '<h4 '.$this->get_render_attribute_string( 'happyden_pricing_table_title' ).'>%s</h4>', wp_kses_post( $title ) ) : '';
					$sub_title ? printf( '<div '.$this->get_render_attribute_string( 'happyden_pricing_table_subtitle' ).'>%s</div>', wp_kses_post( $sub_title ) ) : '';

					echo '<div '.$this->get_render_attribute_string( 'happyden_pricing_table_box_value' ).'>';
						if( 'yes' === $settings['happyden_pricing_table_discount_price'] ){
							echo '<p class="happyden-pricing-table-regular-price">';							
								echo '<span class="happyden-pricing-table-regular-price-cur">'.$settings['happyden_pricing_table_regular_price_cur'].'</span>';
								echo '<span class="happyden-pricing-table-regular-price-text">'.$settings['happyden_pricing_table_regular_price'].'</span>';
							echo '</p>';
						}
						echo '<p class="happyden-pricing-table-new-price">';							
							if( 'happyden-pricing-cur-left' === $settings['happyden_pricing_table_price_cur_position'] ) :
								echo $this->pricing_table_currency( $settings['happyden_pricing_table_price_cur'] );
							endif;

							$price ? printf( '<span '.$this->get_render_attribute_string( 'happyden_pricing_table_price' ).'>%s</span>', esc_html( $price ) ) : '';

							if( 'happyden-pricing-cur-right' === $settings['happyden_pricing_table_price_cur_position'] ) :
								echo $this->pricing_table_currency( $settings['happyden_pricing_table_price_cur'] );
							endif;

							if( $separator || $price_by ) :
								echo '<span class="happyden-price-period">';
									$separator ? printf( '<span '.$this->get_render_attribute_string( 'happyden_pricing_table_period_separator' ).'>%s</span>', esc_html( $separator ) ) : '';
									$price_by ? printf( '<span '.$this->get_render_attribute_string( 'happyden_pricing_table_price_by' ).'>%s</span>', esc_html( $price_by ) ) : '';
								echo '</span>';
							endif;
						echo '</p>';
					echo '</div>';

					if( !empty( $settings['happyden_pricing_table_price_subtitle'] ) ){
						echo '<span class="happyden-pricing-table-price-subtitle">'. $settings['happyden_pricing_table_price_subtitle'] .'</span>';
					}

					if ( 'yes' === $settings['happyden_pricing_table_price_box_separator'] ) :
						echo '<div class="happyden-price-bottom-separator"></div>';
					endif;

					if( 'curved-header' === $settings['happyden_pricing_table_header_type'] ) {
						echo '<div class="happyden-pricing-table-header-curved">';
							echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 370 20">';
								echo '<path class="st0" d="M0 20h185C70 20 0 0 0 0v20zM185 20h185V0s-70 20-185 20z" />';
							echo '</svg>';
						echo '</div>';
					}

					do_action( 'happyden_pricing_table_header_wrapper_after' );
				echo '</div>';

				
				if( 'middle' === $settings['happyden_pricing_table_btn_position'] && !empty( $settings['happyden_pricing_table_btn'] ) ) {
					$this->pricing_table_btn();
				} 

				do_action( 'happyden_pricing_table_content_wrapper_before' );

				if ( is_array( $settings['happyden_pricing_table_items'] ) ) :
					echo '<ul '.$this->get_render_attribute_string( 'happyden_pricing_table_features' ).'>';
						foreach( $settings['happyden_pricing_table_items'] as $index => $item ) : 

							$each_pricing_item = 'link_' . $index;
							$icon_mod = 'yes' !== $item['happyden_pricing_table_icon_mood'] ? 'happyden-pricing-table-features-disable' : 'happyden-pricing-table-features-enable';
							$this->add_render_attribute( $each_pricing_item, 'class', [
								esc_attr( $icon_mod ),
								'elementor-repeater-item-'.esc_attr( $item['_id'] )
							] );

							$pricing_item = $this->get_repeater_setting_key( 'happyden_pricing_table_item', 'happyden_pricing_table_items', $index );
							$this->add_render_attribute( $pricing_item, 'class', 'happyden-pricing-item' );
							$this->add_inline_editing_attributes( $pricing_item, 'none' );
							$price = $item['happyden_pricing_table_item'];

							echo '<li '.$this->get_render_attribute_string( $each_pricing_item ).'>';
								if ( !empty( $item['happyden_pricing_table_list_icon']['value'] ) ) {
									echo '<span class="happyden-pricing-li-icon">';
										Icons_Manager::render_icon( $item['happyden_pricing_table_list_icon'] );
									echo '</span>									';
								}
								$price ? printf( '<span '.$this->get_render_attribute_string( $pricing_item ).'>%s</span>', esc_html( $price ) ) : '';
							echo '</li>';

						endforeach;
					echo '</ul>';
				endif;

				do_action( 'happyden_pricing_table_content_wrapper_after' );

				if( 'bottom' === $settings['happyden_pricing_table_btn_position'] && !empty( $settings['happyden_pricing_table_btn'] ) ) {
					$this->pricing_table_btn();
				} 
				if( !empty( $settings['happyden_pricing_table_note_text'] ) ){
					echo '<div class="happyden-pricing-table-note">'.$settings['happyden_pricing_table_note_text'].'</div>';
				}
			echo '</div>';
			if( 'promo_bottom' === $settings['happyden_pricing_table_promo_position'] ) {
				if( 'yes' === $settings['happyden_pricing_table_promo_enable'] ) {
					echo '<span '.$this->get_render_attribute_string( 'happyden_pricing_table_promo_title' ).'>'.$settings['happyden_pricing_table_promo_title'].'</span>';
				}
			}
		echo '</div>';
	}

    private function pricing_table_btn() {
		echo '<a '.$this->get_render_attribute_string( 'happyden_pricing_table_btn_link' ).'>';
			echo '<span '.$this->get_render_attribute_string( 'happyden_pricing_table_btn' ).'>';
				echo esc_html( $this->get_settings_for_display( 'happyden_pricing_table_btn' ) );
			echo '</span>';
		echo '</a>';
	}
}
$widgets_manager->register_widget_type( new \Happyden\Widgets\Elementor\Happyden_Pricing_Table() );