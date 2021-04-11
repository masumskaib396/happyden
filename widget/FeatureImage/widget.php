<?php
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

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Elementor image widget.
 *
 * Elementor widget that displays an image into the page.
 *
 * @since 1.0.0
 */
class HappydenFeatureImage extends \Elementor\Widget_Base {
	/**
	 * Get widget name.
	 *
	 * Retrieve image widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'happyden-feature-image';
	}
	/**
	 * Get widget title.
	 *
	 * Retrieve image widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Happyden Featured Image', 'happyden' );
	}
	/**
	 * Get widget icon.
	 *
	 * Retrieve image widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-image';
	}
	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the image widget belongs to.
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
		return [ 'Feature image', 'photo', 'visual' ];
	}
	/**
	 * Register image widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'section_image',
			[
				'label' => __( 'Image', 'happyden' ),
			]
		);
		$this->add_responsive_control(
			'width',
			[
				'label' => __( 'Width', 'happyden' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%', 'px', 'vw' ],
				'range' => [
					'%' => [
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
				'selectors' => [
					'{{WRAPPER}} .happyden-feature-image img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'space',
			[
				'label' => __( 'Max Width', 'happyden' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%', 'px', 'vw' ],
				'range' => [
					'%' => [
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
				'selectors' => [
					'{{WRAPPER}} .happyden-feature-image img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'height',
			[
				'label' => __( 'Height', 'happyden' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
				],
				'tablet_default' => [
					'unit' => 'px',
				],
				'mobile_default' => [
					'unit' => 'px',
				],
				'size_units' => [ 'px', 'vh' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 500,
					],
					'vh' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .happyden-feature-image img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'object-fit',
			[
				'label' => __( 'Object Fit', 'happyden' ),
				'type' => Controls_Manager::SELECT,
				'condition' => [
					'height[size]!' => '',
				],
				'options' => [
					'' => __( 'Default', 'happyden' ),
					'fill' => __( 'Fill', 'happyden' ),
					'cover' => __( 'Cover', 'happyden' ),
					'contain' => __( 'Contain', 'happyden' ),
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .happyden-feature-image img' => 'object-fit: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();
	}
	/**
	 * Render image widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
        ?>
		<div class="happyden-feature-image">
				<?php the_post_thumbnail( get_the_Id(), 'full' ); ?>
		</div>
		<?php
	}
}
$widgets_manager->register_widget_type( new \Happyden\Widgets\Elementor\HappydenFeatureImage() );