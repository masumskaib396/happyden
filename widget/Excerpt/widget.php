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
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Happyden_Excerpt extends Widget_Base
{
    /**
     * Get widget name.
     *
     * Retrieve oEmbed widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'happyden-excerpt';
    }
    /**
     * Get widget title.
     *
     * Retrieve oEmbed widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('happyden Excerpt', 'happyden');
    }
    /**
     * Get widget icon.
     *
     * Retrieve oEmbed widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-yoast';
    }
    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the oEmbed widget belongs to.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['happyden'];
    }
    /**
     * Register oEmbed widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls()
    {
        /**
         * Style tab
         */
        $this->start_controls_section(
            'general',
            [
                'label' => __('Content', 'happyden'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'happyden_align',
            [
                'label' => __('Align', 'happyden'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'happyden'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('top', 'happyden'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'happyden'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .happyden-excerpt' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'happyden_color',
            [
                'label' => __('Color', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden-excerpt' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'happyden_typography',
                'label' => __('Typography', 'happyden'),
                'selector' => '{{WRAPPER}} .happyden-excerpt',
            ]
        );
        
        $this->end_controls_section();
    }
    /**
     * Render oEmbed widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();

        ?>
            <span class="happyden-excerpt">
                <?php the_excerpt() ?>
            </span>
        <?php
    }
}
$widgets_manager->register_widget_type( new \Happyden\Widgets\Elementor\Happyden_Excerpt() );