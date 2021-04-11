<?php
/**
 * Portfolio Widget.
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
// Exit if accessed directly
class Happyden_portfolio extends \Elementor\Widget_Base
{
    /**
     * Retrieve the widget name.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'happyden-portfolio';
    }

    public function get_script_depends()
    {
        return ['happyden-isotope', 'happyden-widget'];
    }
    /**
     * Retrieve the widget title.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('Portfolio', 'happyden');
    }
    /**
     * Retrieve the widget icon.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-portfolio';
    }
    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['happyden'];
    }
    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_layout',
            [
                'label' => __('Layout', 'happyden'),
            ]
        );
        $this->add_control(
            'layout_type',
            [
                'label' => __('Layout type', 'happyden'),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'masonry' => 'Masonry',
                    'normal' => 'Normal',
                ),
                'default' => 'masonry',
            ]
        );
        $this->add_control(
            'content_position',
            [
                'label' => __('Content Position', 'happyden'),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'on-image' => 'On Image',
                    'below-image' => 'Below Image',
                    'disabled' => 'Hidden',
                ),
                'default' => 'on-image',
            ]
        );
        $this->add_control(
            'enable_filtering',
            [
                'label' => __('Enable Filtering??', 'happyden'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'happyden'),
                'label_off' => __('No', 'happyden'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'enable_loadmore',
            [
                'label' => __('Enable Loadmore?', 'happyden'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'happyden'),
                'label_off' => __('No', 'happyden'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'loadmore_text',
            [
                'label' => __('Loadmore Text', 'happyden'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('Load more works', 'happyden'),
                'condition' => [
                    'enable_loadmore' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'loadmore_align',
            [
                'label' => __('Loadmore Align', 'happyden'),
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
                'condition' => [
                    'enable_loadmore' => 'yes'
                ],
                'default' => 'center',
                'toggle' => true,
            ]
        );
        $this->add_control(
            'loadmore_gap',
            [
                'label' => __('Loadmore Top Gap', 'happyden'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 400,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}}  .happyden-loadmore-wrap' => 'margin-top:{{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'enable_loadmore' => 'yes'
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_width_nd_height',
            [
                'label' => __('Width & Height', 'happyden'),
            ]
        );
        $this->add_control(
            'all_text',
            [
                'label' => __('Filter first item text', 'happyden'),
                'type' => Controls_Manager::TEXT,
                'default' => __('All WOrks', 'happyden'),
                'condition' => [
                    'enable_filtering' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'use_meta_grid',
            [
                'label' => __('Use grid from meta?', 'happyden'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'happyden'),
                'label_off' => __('No', 'happyden'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'post_grid',
            [
                'label' => __('Post Column', 'happyden'),
                'type' => Controls_Manager::SELECT,
                'devices' => ['desktop', 'tablet', 'mobile'],
                'options' => array(
                    'col-md-12' => '1 Column',
                    'col-md-6' => '2 Column',
                    'col-md-4' => '3 Column',
                    'col-md-3' => '4 Column',
                ),
                'default' => 'col-md-4',
                'condition' => [
                    'use_meta_grid!' => 'yes'
                ],
            ]
        );
        $this->add_responsive_control(
            'column_verti_gap',
            [
                'label' => __('Column Vertical Gap', 'happyden'),
                'type' => Controls_Manager::SLIDER,
                'devices' => ['desktop', 'tablet', 'mobile'],
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'desktop_default' => [
                    'size' => 15,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}}  .happyden-portfolio-item-wrap' => 'padding: 0 {{SIZE}}{{UNIT}} 0;',
                ]
            ]
        );
        $this->add_responsive_control(
            'column_hori_gap',
            [
                'label' => __('Column Horizontal Gap', 'happyden'),
                'type' => Controls_Manager::SLIDER,
                'devices' => ['desktop', 'tablet', 'mobile'],
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'desktop_default' => [
                    'size' => 30,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}}  .happyden-portfolio-item-wrap' => 'padding-bottom: {{SIZE}}{{UNIT}} ;',
                ]
            ]
        );
        $this->add_control(
            'use_custom_height',
            [
                'label' => __('Use custom height?', 'happyden'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'happyden'),
                'label_off' => __('No', 'happyden'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_responsive_control(
            'normal_image_height',
            [
                'label' => __('Normal Image Height', 'happyden'),
                'type' => Controls_Manager::SLIDER,
                'devices' => ['desktop', 'tablet', 'mobile'],
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}  .happyden-portfolio-item-wrap.height-normal .happyden-portfolio-item img' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'use_custom_height' => 'yes'
                ],
            ]
        );

        $this->add_responsive_control(
            'big_image_height',
            [
                'label' => __('Big Image Height', 'happyden'),
                'type' => Controls_Manager::SLIDER,
                'devices' => ['desktop', 'tablet', 'mobile'],
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}  .happyden-portfolio-item-wrap.height-big .happyden-portfolio-item img' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'use_custom_height' => 'yes'
                ],
            ]
        );

        $this->add_responsive_control(
            'object-fit',
            [
                'label'     => __('Object Fit', 'happyden'),
                'type'      => Controls_Manager::SELECT,
                'condition' => [
                    'use_custom_height' => 'yes'
                ],
                'options'   => [
                    ''        => __('Default', 'happyden'),
                    'fill'    => __('Fill', 'happyden'),
                    'cover'   => __('Cover', 'happyden'),
                    'contain' => __('Contain', 'happyden'),
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .happyden-portfolio-item-wrap.height-big .happyden-portfolio-item img' => 'object-fit: {{VALUE}};',
                    '{{WRAPPER}} .happyden-portfolio-item-wrap.height-normal .happyden-portfolio-item img' => 'object-fit: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'object-position',
            [
                'label'     => __('Object Position', 'happyden'),
                'type'      => Controls_Manager::SELECT,
                'condition' => [
                    'use_custom_height' => 'yes'
                ],
                'options'   => [
                    ''       => __('Default', 'happyden'),
                    'top'    => __('Top', 'happyden'),
                    'bottom' => __('Bottom', 'happyden'),
                    'left'   => __('Left', 'happyden'),
                    'right'  => __('Right', 'happyden'),
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .happyden-portfolio-item-wrap.height-big .happyden-portfolio-item img' => 'object-position: {{VALUE}};',
                    '{{WRAPPER}} .happyden-portfolio-item-wrap.height-normal .happyden-portfolio-item img' => 'object-position: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'section_query',
            [
                'label' => __('Query', 'happyden'),
            ]
        );
        $this->add_control(
            'posts_per_page',
            [
                'label' => __('Posts per page', 'happyden'),
                'type' => Controls_Manager::NUMBER,
                'default' => 5,
            ]
        );
        $this->add_control(
            'source',
            [
                'label'         => __('Source', 'happyden'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'portfolio' => 'Portfolio',
                    'manual_selection' => 'Manual Selection',
                    'related' => 'Related',
                ],
                'default' =>    'portfolio',
            ]
        );
        $this->add_control(
            'manual_selection',
            [
                'label'         => __('Manual Selection', 'happyden'),
                'type'          => Controls_Manager::SELECT2,
                'description'   => __('Get specific template posts', 'happyden'),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => happyden_cpt_slug_and_id('project'),
                'default' =>    [],
                'condition' => [
                    'source' => 'manual_selection'
                ],
            ]
        );
        $this->start_controls_tabs(
            'include_exclude_tabs'
        );
        $this->start_controls_tab(
            'include_tabs',
            [
                'label' => __('Include', 'happyden'),
                'condition' => [
                    'source!' => 'manual_selection'
                ],
            ]
        );
        $this->add_control(
            'include_by',
            [
                'label'         => __('Include by', 'happyden'),
                'type'          => Controls_Manager::SELECT2,
                'label_block'   => true,
                'multiple'      => true,
                'options'       => [
                    'tags'  => 'Tags',
                    'category'  => 'Category',
                    'author' => 'Author',
                ],
                'default' =>    [],
                'condition' => [
                    'source!' => 'manual_selection'
                ],
            ]
        );
        $this->add_control(
            'include_categories',
            [
                'label'         => __('Include categories', 'happyden'),
                'type'          => Controls_Manager::SELECT2,
                'description'   => __('Get templates for specific category(s)', 'happyden'),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => happyden_cpt_taxonomy_slug_and_name('project-category'),
                'default' =>    [],
                'condition' => [
                    'include_by' => 'category',
                    'source!' => 'related'
                ],
            ]
        );
        $this->add_control(
            'include_tags',
            [
                'label'         => __('Include Tags', 'happyden'),
                'type'          => Controls_Manager::SELECT2,
                'description'   => __('Get templates for specific tag(s)', 'happyden'),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => happyden_cpt_taxonomy_slug_and_name('project-tag'),
                'default' =>    [],
                'condition' => [
                    'include_by' => 'tags',
                    'source!' => 'related'
                ],
            ]
        );
        $this->add_control(
            'include_authors',
            [
                'label'         => __('Include authors', 'happyden'),
                'type'          => Controls_Manager::SELECT2,
                'description'   => __('Get templates for specific tag(s)', 'happyden'),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => happyden_cpt_author_slug_and_id('project'),
                'default' =>    [],
                'condition' => [
                    'include_by' => 'author',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'exclude_tabs',
            [
                'label' => __('Exclude', 'happyden'),
                'condition' => [
                    'source!' => 'manual_selection'
                ],
            ]
        );
        $this->add_control(
            'exclude_by',
            [
                'label'         => __('Exclude by', 'happyden'),
                'type'          => Controls_Manager::SELECT2,
                'label_block'   => true,
                'multiple'      => true,
                'options'       => [
                    'tags'  => 'tags',
                    'category'  => 'Category',
                    'author' => 'Author',
                    'current_post' => 'Current Post',
                ],
                'default' =>    [],
                'condition' => [
                    'source!' => 'manual_selection'
                ],
            ]
        );
        $this->add_control(
            'exclude_categories',
            [
                'label'         => __('Exclude categories', 'happyden'),
                'type'          => Controls_Manager::SELECT2,
                'description'   => __('Get templates for specific category(s)', 'happyden'),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => happyden_cpt_taxonomy_slug_and_name('project-category'),
                'default' =>    [],
                'condition' => [
                    'exclude_by' => 'category',
                    'source!' => 'related'
                ],
            ]
        );
        $this->add_control(
            'exclude_tags',
            [
                'label'         => __('Exclude Tags', 'happyden'),
                'type'          => Controls_Manager::SELECT2,
                'description'   => __('Get templates for specific tag(s)', 'happyden'),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => happyden_cpt_taxonomy_slug_and_name('project-tag'),
                'default' =>    [],
                'condition' => [
                    'exclude_by' => 'tags',
                    'source!' => 'related'
                ],
            ]
        );
        $this->add_control(
            'exclude_authors',
            [
                'label'         => __('Exclude authors', 'happyden'),
                'type'          => Controls_Manager::SELECT2,
                'description'   => __('Get templates for specific tag(s)', 'happyden'),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => happyden_cpt_author_slug_and_id('portfolio'),
                'default' =>    [],
                'condition' => [
                    'exclude_by' => 'author',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_control(
            'orderby',
            [
                'label'         => __('Order By', 'happyden'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'date'   => 'Date',
                    'title'    => 'title',
                    'menu_order'    => 'Menu Order',
                    'rand'    => 'Random',
                ],
                'default' =>    'date',
            ]
        );
        $this->add_control(
            'order',
            [
                'label'         => __('Order', 'happyden'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'ASC'   => 'ASC',
                    'DESC'    => 'DESC',
                ],
                'default' =>    'DESC',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_filter_style',
            [
                'label' => __('Filter', 'happyden'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_filtering' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'filter_align',
            [
                'label' => __('Filter Align', 'happyden'),
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
                'default' => 'left',
                'toggle' => true,
                'condition' => [
                    'enable_filtering' => 'yes'
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __('Filter Typography', 'happyden'),
                'name' => 'filter_typo',
                'selector' => '{{WRAPPER}} .pf-isotope-nav li',
            ]
        );
        $this->add_control(
            'filter_color',
            [
                'label' => __('Filter Color', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pf-isotope-nav li' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'filter_hover_color',
            [
                'label' => __('Filter Hover Color', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pf-isotope-nav li:hover,{{WRAPPER}} .pf-isotope-nav li.active' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Content', 'happyden'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
            'show_excerpt',
            [
                'label' => __('Show Excerpt?', 'happyden'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'happyden'),
                'label_off' => __('No', 'happyden'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );


        $this->add_responsive_control(
            'excerpt_leanth',
            [
                'label' => __('Excerpt Leanth', 'happyden'),
                'type' => Controls_Manager::NUMBER,
                'label_block' => true,
                'default' => 48,
                'condition' => [
                    'show_excerpt' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'show_category',
            [
                'label' => __('Show category?', 'happyden'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'happyden'),
                'label_off' => __('No', 'happyden'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_responsive_control(
            'show_title_icon',
            [
                'label' => __('Show Icon?', 'happyden'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'happyden'),
                'label_off' => __('No', 'happyden'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'title_icon',
            [
                'label' => __('Choose Title Icon', 'happyden'),
                'type' => Controls_Manager::ICONS,
                'default' => [
					'value' => 'fas fa-arrow-right',
					'library' => 'fa-solid',
				],
                'condition' => [
                    'show_title_icon' => 'yes',
                 ]
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_image',
            [
                'label' => __('Image', 'happyden'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'image_hover_tabs'
        );
        $this->start_controls_tab(
            'image_normal_tab',
            [
                'label' => __('Normal', 'happyden'),
            ]
        );
        $this->add_responsive_control(
            'image_radius',
            [
                'label' => __('Image Radius', 'happyden'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    ' {{WRAPPER}} .happyden-portfolio-item img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'image_shadow',
                'label' => __('Button Shadow', 'happyden'),
                'selector' => '{{WRAPPER}} .happyden-portfolio-item img',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'label' => __('Border', 'happyden'),
                'selector' => '{{WRAPPER}} .happyden-portfolio-item img',
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'image_hover_tab',
            [
                'label' => __('Hover', 'happyden'),
            ]
        );
        $this->add_responsive_control(
            'image_hover_radius',
            [
                'label' => __('Box Image Radius', 'happyden'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    ' {{WRAPPER}} .happyden-portfolio-item:hover img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'image_hover_shadow',
                'label' => __('Button Shadow', 'happyden'),
                'selector' => '{{WRAPPER}} .happyden-portfolio-item:hover img',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_hover_border',
                'label' => __('Border', 'happyden'),
                'selector' => '{{WRAPPER}} .happyden-portfolio-item:hover img',
            ]
        );
        $this->add_control(
            'enable_hover_rotate',
            [
                'label' => __('Rotate animation on hover?', 'happyden'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'happyden'),
                'label_off' => __('No', 'happyden'),
                'return_value' => 'happyden-hover-rotate',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'image_hover_animation',
            [
                'label' => __('Hover Animation', 'happyden'),
                'type' => Controls_Manager::HOVER_ANIMATION,
                // 'prefix_class' => 'elementor-animation-',
                'condition' => [
                    'enable_hover_rotate!' => 'happyden-hover-rotate'
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section(
            'section_category_style',
            [
                'label' => __('Category', 'happyden'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_category' => 'yes',
                 ]
            ]
        );
        $this->start_controls_tabs(
            'category_style_tabs'
        );
        $this->start_controls_tab(
            'category_style_normal_tab',
            [
                'label' => __('Normal', 'happyden'),
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __('Category Typography', 'happyden'),
                'name' => 'category_typo',
                'selector' => '{{WRAPPER}} .happyden-pf-category',
            ]
        );
        $this->add_control(
            'category_color',
            [
                'label' => __('Category Color', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden-pf-category' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'category_gap',
            [
                'label' => __('Category Gap', 'happyden'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 400,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}  .happyden-pf-category' => 'margin-bottom:{{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'category_style_hover_tab',
            [
                'label' => __('Hover', 'happyden'),
            ]
        );
        $this->add_control(
            'category_color_hover',
            [
                'label' => __('Category Color', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden-pf-category:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section(
            'section_title_style',
            [
                'label' => __('Title', 'happyden'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'title_style_tabs'
        );
        $this->start_controls_tab(
            'title_style_normal_tab',
            [
                'label' => __('Normal', 'happyden'),
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __('Title Typography', 'happyden'),
                'name' => 'title_typo',
                'selector' => '{{WRAPPER}} .happyden-portfolio-title',
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => __('Title Color', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden-portfolio-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'title_icon_line_color',
            [
                'label' => __('Title Icon Line Color', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title-icon svg path' => 'stroke: {{VALUE}}',
                    '{{WRAPPER}} .title-icon i' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'show_title_icon' => 'yes',
                 ]
            ]
        );
        $this->add_control(
            'title_icon_fill_color',
            [
                'label' => __('SVG Fill Color', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title-icon svg path' => 'fill: {{VALUE}}',
                ],
                'condition' => [
                    'show_title_icon' => 'yes',
                 ]
            ]
        );
        $this->add_responsive_control(
            'title_icon_rotate',
            [
                'label' => __('Rotate icon', 'happyden'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -360,
                        'max' => 360,
                    ],
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .title-icon svg, {{WRAPPER}} .title-icon i' => 'transform: rotate( {{SIZE}}deg );',
                ],
                'condition' => [
                    'show_title_icon' => 'yes',
                 ]
            ]
        );
        $this->add_responsive_control(
            'title_icon_size',
            [
                'label' => __('icon Size', 'happyden'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -360,
                        'max' => 360,
                    ],
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .title-icon  svg' => 'width: {{SIZE}}{{UNIT}} ;',
                    '{{WRAPPER}} .title-icon  i' => 'font-size: {{SIZE}}{{UNIT}} ;',
                ],
                'condition' => [
                    'show_title_icon' => 'yes',
                 ]
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'title_style_hover_tab',
            [
                'label' => __('Hover', 'happyden'),
            ]
        );
        $this->add_control(
            'title_color_hover',
            [
                'label' => __('Title Color', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden-portfolio-title:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'title_icon_line_color_hover',
            [
                'label' => __('Title Icon Line Color', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden-portfolio-title:hover .title-icon svg path' => 'stroke: {{VALUE}}',
                    '{{WRAPPER}} .happyden-portfolio-title:hover .title-icon i' => 'color: {{VALUE}}',
                ],
                 'condition' => [
                    'show_title_icon' => 'yes',
                 ]
            ]
        );
        $this->add_control(
            'title_icon_fill_color_hover',
            [
                'label' => __('SVG Fill Color', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden-portfolio-title:hover .title-icon svg path' => 'fill: {{VALUE}}',
                ],
                 'condition' => [
                    'show_title_icon' => 'yes',
                 ]
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        /* 
        * Content
        */
        $this->start_controls_section(
            'discription',
            [
                'label' => __('Discription', 'happyden'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __('Typography', 'happyden'),
                'name' => 'descrion',
                'selector' => '{{WRAPPER}} .happyden-portfolio-excerpt p',
            ]
        );
        $this->add_control(
            'descrion_color',
            [
                'label' => __('Hover Color', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden-portfolio-excerpt p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'descrion_color_hover',
            [
                'label' => __('Color', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden-portfolio-excerpt p:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'descrion_margin',
            [
                'label' => __('Margin', 'happyden'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .happyden-portfolio-excerpt p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .happyden-portfolio-excerpt p' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ]
            ]
        );
        $this->end_controls_section();


        $this->start_controls_section(
            'section_content_style',
            [
                'label' => __('Content Box', 'happyden'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

      $this->add_responsive_control(
            'content_align',
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
                'devices' => ['desktop', 'tablet', 'mobile'],
                'prefix_class' => 'content-align%s-',
                'toggle' => true,
            ]
        );
        $this->add_control(
            'content_bg_color',
            [
                'label' => __('Content Background Color', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden-portfolio-content' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'content_gap',
            [
                'label' => __('Content gap', 'happyden'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 400,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}  .happyden-portfolio-content.content-postion-on-image' => 'left:{{SIZE}}{{UNIT}};right:{{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'content_position' => 'on-image',
                ]
            ]
        );
        $this->add_control(
            'content_y_position',
            [
                'label' => __('Content Y Position', 'happyden'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}  .happyden-portfolio-content.content-postion-on-image' => 'bottom:{{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'content_position' => 'on-image',
                ]
            ]
        );
        $this->add_responsive_control(
            'content_padding',
            [
                'label' => __('Content Padding', 'happyden'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .happyden-portfolio-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_radius',
            [
                'label' => __('Content Box Radius', 'happyden'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .happyden-portfolio-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_radius',
            [
                'label' => __('Box Radius', 'happyden'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    ' {{WRAPPER}} .happyden-portfolio-item ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_loadmore',
            [
                'label' => __('Loadmore', 'happyden'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_loadmore' => 'yes'
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __('Typography', 'happyden'),
                'name' => 'loadmore_typo',
                'selector' => '{{WRAPPER}} .happyden-pf-loadmore-btn',
            ]
        );
        $this->start_controls_tabs(
            'loadmore_hover_tabs'
        );
        $this->start_controls_tab(
            'loadmore_normal_tab',
            [
                'label' => __('Normal', 'happyden'),
            ]
        );
        $this->add_control(
            'loadore_color',
            [
                'label' => __('Color', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden-pf-loadmore-btn' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'loadmore_background_color',
            [
                'label' => __('Filter background Color', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden-pf-loadmore-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'loadmore_border',
                'label' => __('Border', 'happyden'),
                'selector' => '{{WRAPPER}} .happyden-pf-loadmore-btn',
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'loadmore_hover_tab',
            [
                'label' => __('Hover', 'happyden'),
            ]
        );
        $this->add_control(
            'loadore_hover_color',
            [
                'label' => __('Color', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden-pf-loadmore-btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'loadmore_hover_bg_color',
            [
                'label' => __('Filter background Color', 'happyden'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden-pf-loadmore-btn:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'loadmore_hover_border',
                'label' => __('Border', 'happyden'),
                'selector' => '{{WRAPPER}} .happyden-pf-loadmore-btn:hover',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_control(
            'hr',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );
        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __('Button Padding', 'happyden'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default' => [
                    'top' => '22',
                    'right' => '38',
                    'bottom' => '21',
                    'left' => '38',
                ],
                'selectors' => [
                    '{{WRAPPER}} .happyden-pf-loadmore-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_radius',
            [
                'label' => __('Border Radius', 'happyden'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default' => [
                    'top' => '33',
                    'right' => '33',
                    'bottom' => '33',
                    'left' => '33',
                ],
                'selectors' => [
                    '{{WRAPPER}} .happyden-pf-loadmore-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_shadow',
                'label' => __('Button Shadow', 'happyden'),
                'selector' => '{{WRAPPER}} .happyden-pf-loadmore-btn',
                'fields_options' =>
                [
                    'box_shadow_type' =>
                    [
                        'default' => 'yes',
                    ],
                    'box_shadow' => [
                        'default' =>
                        [
                            'horizontal' => 0,
                            'vertical' => 0,
                            'blur' => 0,
                            'spread' => 0,
                            'color' => 'rgba(3, 3, 3, 0.14)',
                        ],
                    ],
                ],
            ]
        );
        $this->end_controls_section();
    }
    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings();
        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
        $portfolio_data = [];
        $portfolio_data['settings'] = $this->get_settings();
        $portfolio_data = json_encode($portfolio_data);
        // Including the query 
        include('queries/portfolio-query.php');

        if ($the_query->have_posts()) :
            if ($settings['enable_filtering']) :
    ?>
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <ul class="pf-isotope-nav text-<?php echo esc_attr($settings['filter_align']); ?>">
                                <li data-filter="<?php echo esc_attr('*') ?>" class="active"><?php echo esc_html($settings['all_text'])  ?></li>
                                <?php
                                if (0 != count($settings['include_categories'])) :
                                    foreach ($settings['include_categories'] as $cat) :
                                        $pf_term = get_term_by('slug', $cat, 'project-category');
                                ?>
                                        <li data-filter=".<?php echo esc_attr($pf_term->slug) ?>"><?php echo esc_html($pf_term->name) ?></li>
                                        <?php
                                    endforeach;
                                else :
                                    $pf_terms = get_terms('project-category');
                                    if (!empty($pf_terms)) :
                                        foreach ($pf_terms as $pf_term) : ?>
                                            <li data-filter=".<?php echo esc_attr($pf_term->slug) ?>"><?php echo esc_html($pf_term->name) ?></li>
                                <?php
                                        endforeach;
                                    endif;
                                endif;
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="container-fluid">
                <div class="row happyden-portfolio-wrap layout-mode-<?php echo esc_attr($settings['layout_type'] . ' ' . $settings['enable_hover_rotate']) ?>">
                    <?php
                    // including the item
                    include('contents/portfolio-content.php');
                    ?>
                </div>
            </div>
            
                <?php
                $total_posts = $the_query->found_posts;
                if ('yes' == $settings['enable_loadmore'] && '-1' != $settings['posts_per_page'] && $total_posts >= $settings['posts_per_page']) :
                    $posts_per_page = $settings['posts_per_page'];
                    $page_amount = ceil($total_posts / $posts_per_page);
                    $ajaxurl = admin_url('admin-ajax.php');
                    $nonce = wp_create_nonce('happyden_loadmore_callback');
                ?>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="happyden-loadmore-wrap text-<?php echo $settings['loadmore_align']; ?>">
                                <span id="load-next-projects-message"></span>
                                <span class="happyden-pf-loadmore-btn" data-url="<?php echo esc_url($ajaxurl) ?>" data-referrar="<?php echo $nonce; ?>" data-total-page="<?php echo $page_amount; ?>" data-paged="<?php echo $paged; ?>" data-portfolio-settings='<?php echo $portfolio_data ?>'><?php echo $settings['loadmore_text'] ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif;
        // var_dump(get_query_var('paged'));
        wp_reset_postdata();
    }
}
$widgets_manager->register_widget_type( new \Happyden\Widgets\Elementor\Happyden_portfolio() );