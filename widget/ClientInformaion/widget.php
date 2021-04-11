<?php
/**
 * Happyden client Widget.
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
class HappydenClientInformaion extends \Elementor\Widget_Base {
    public function get_name() {
        return 'happyden_cleintinformaion';
    }
    public function get_title() {
        return __('Happyden Client Informaion', 'fa');
    }
    public function get_icon() {
        return ('eicon-meta-data');
    }
    public function get_categories() {
        return ['happyden'];
    }
    public function get_keywords() {
        return ['client', 'informaion', 'project', 'portfolio'];
    }
    protected function _register_controls() {
        $this->start_controls_section('client_section',
            [
                'label' => __('Client Info Section', 'happyden'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_responsive_control('content_align',
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
                    '{{WRAPPER}} .happyden--clint-info-wraper' => 'text-align: {{VALUE}}',
                ],
                'default'   => 'center',
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
                    '{{WRAPPER}} .happyden--clint-info-list'  => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        /* 
        *Information Title
        */
        $this->add_control(
			'information_title',
			[
				'label' => __( 'Information Title', 'plugin-name' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        
        $this->add_control(
            'information_title_color',
            [
                'label'     => __('Color', 'happyden'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden--cleint--info-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'label_typo',
                'label' => __('Typography', 'happyden'),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .happyden--cleint--info-title',
            ]
        );

        $this->add_responsive_control(
            'information_title_margin',
            [
                'label'      => __('Margin', 'happyden'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .happyden--cleint--info-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .happyden--cleint--info-title' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        /* 
        * Information Details
        */
        $this->add_control(
			'information_details',
			[
				'label' => __( 'Information Details', 'plugin-name' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        
        $this->add_control(
            'information_details_color',
            [
                'label'     => __('Color', 'happyden'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden--cleint--info-details' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'information_details_typo',
                'label' => __('Typography', 'happyden'),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .happyden--cleint--info-details',
            ]
        );

        $this->add_responsive_control(
            'information_details_margin',
            [
                'label'      => __('Margin', 'happyden'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .happyden--cleint--info-details' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .happyden--cleint--info-details' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

    }
    

    protected function render() {
        $settings = $this->get_settings_for_display();
        $rows = get_field('client_information');

        ?>
            <?php if( $rows ): ?>
                <div class="happyden--clint-info-wraper">
                    <?php foreach($rows as $row): ?>
                        <div class="happyden--clint-info-list">
                            <span class="happyden--cleint--info-title">
                                <?php echo esc_html( $row['information_title'] ) ?>
                            </span>
                            <span class="happyden--cleint--info-details">
                                <?php echo esc_html( $row['information_details'] ) ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        <?php
}
}
$widgets_manager->register_widget_type( new \Happyden\Widgets\Elementor\HappydenClientInformaion() );