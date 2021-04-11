<?php 


namespace Happyden\Widgets\Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
/**
 * happyden heading widget.
 *
 * happyden widget that displays an eye-catching headlines.
 *
 * @since 1.0.0
 */
class Happyden_Heading extends Widget_Base {
	/**
	 * Get widget name.
	 *
	 * Retrieve heading widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'happyden-heading';
	}
	/**
	 * Get widget title.
	 *
	 * Retrieve heading widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'happyden Heading', 'happyden' );
	}
	/**
	 * Get widget icon.
	 *
	 * Retrieve heading widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-t-letter';
	}
	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the heading widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'happyden' ];
	}
	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'heading', 'title', 'text' ];
	}
	/**
	 * Register heading widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Title', 'happyden' ),
			]
		);
		$this->add_control(
			'show_page_title',
			[
				'label' => __( 'Show Page Title', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'your-plugin' ),
				'label_off' => __( 'Hide', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'happyden' ),
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your title', 'happyden' ),
				'default' => __( 'Add Your Heading Text Here', 'happyden' ),
				'condition' => [
					'show_page_title!' => 'yes',
				]
			]
		);
		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'happyden' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => '',
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'header_size',
			[
				'label' => __( 'HTML Tag', 'happyden' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h2',
			]
		);
		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'happyden' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'happyden' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'happyden' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'happyden' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'happyden' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'view',
			[
				'label' => __( 'View', 'happyden' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_title_style',
			[
				'label' => __( 'Title', 'happyden' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'happyden' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .happyden-heading-title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .happyden-heading-title',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}} .happyden-heading-title',
			]
		);
		$this->add_control(
			'blend_mode',
			[
				'label' => __( 'Blend Mode', 'happyden' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Normal', 'happyden' ),
					'multiply' => 'Multiply',
					'screen' => 'Screen',
					'overlay' => 'Overlay',
					'darken' => 'Darken',
					'lighten' => 'Lighten',
					'color-dodge' => 'Color Dodge',
					'saturation' => 'Saturation',
					'color' => 'Color',
					'difference' => 'Difference',
					'exclusion' => 'Exclusion',
					'hue' => 'Hue',
					'luminosity' => 'Luminosity',
				],
				'selectors' => [
					'{{WRAPPER}} .happyden-heading-title' => 'mix-blend-mode: {{VALUE}}',
				],
				'separator' => 'none',
			]
        );
        $this->end_controls_section();
		$this->start_controls_section(
			'section_line_style',
			[
				'label' => __( 'Line Style', 'happyden' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
            'enable_line',
            [
                'label' => __('Enable Line?', 'happyden'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'happyden'),
                'label_off' => __('No', 'happyden'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'line_color',
            [
                'label' => __('Line Color', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden-heading-title:after' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'enable_line' => 'yes',
                ]
            ]
        );
        $this->add_responsive_control(
            'line_width',
            [
                'label' => __('Line Width', 'happyden'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .happyden-heading-title:after'  => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'enable_line' => 'yes',
                ]
            ]
        );
        $this->add_responsive_control(
            'line_height',
            [
                'label' => __('Line height', 'happyden'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .happyden-heading-title:after'  => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'enable_line' => 'yes',
                ]
            ]
        );
        $this->add_responsive_control(
            'line_x_position',
            [
                'label' => __('Shape Y Position', 'happyden'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .happyden-heading-title:after'  => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'enable_line' => 'yes',
                ]
            ]
        );
        $this->add_responsive_control(
            'line_y_position',
            [
                'label' => __('Shape X Position', 'happyden'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .happyden-heading-title:after'  => 'left: {{SIZE}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .happyden-heading-title:after'  => 'right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'enable_line' => 'yes',
                ]
            ]
        );
		$this->end_controls_section();
	}
	/**
	 * Render heading widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		if ( '' === $settings['title'] ) {
			return;
		}
		if ( 'yes' == $settings['show_page_title'] ) {
			$title = get_the_title(  );
		}else {
			$title = $settings['title'];
		}
		$this->add_render_attribute( 'title', 'class', 'happyden-heading-title' );
		$this->add_render_attribute( 'title', 'class', 'show-line-'. $settings['enable_line'] );
		$this->add_inline_editing_attributes( 'title' );
		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'url', $settings['link'] );
			$title = sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'url' ), $title );
		}
		$title_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', $settings['header_size'], $this->get_render_attribute_string( 'title' ), $title );
		echo $title_html;
	}
	/**
	 * Render heading widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 2.9.0
	 * @access protected
	 */
	protected function content_template() {
		?>
		<#
		if ( 'yes' == settings.show_page_title ) {
			var title = '<?php echo get_the_title() ?>';
		} else{ 
			var title = settings.title;
		}
		if ( '' !== settings.link.url ) {
			title = '<a href="' + settings.link.url + '">' + title + '</a>';
		}
		view.addRenderAttribute( 'title', 'class', [ 'happyden-heading-title', 'show-line-'+ settings.enable_line ] );
		view.addInlineEditingAttributes( 'title' );
		var title_html = '<' + settings.header_size  + ' ' + view.getRenderAttributeString( 'title' ) + '>' + title + '</' + settings.header_size + '>';
		print( title_html );
		#>
		<?php
	}
}
$widgets_manager->register_widget_type( new \Happyden\Widgets\Elementor\Happyden_Heading() );