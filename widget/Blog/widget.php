<?php
namespace Happyden\Widgets\Elementor;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Widget_Base;
use Elementor\TAB_CONTENT;
use Elementor\Icons_Manager;

if (!defined('ABSPATH')) {
    exit;
}

class HappydenBlogLoop extends \Elementor\Widget_Base
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
    public function get_name() {
        return 'happyden-blog';
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
    public function get_title() {
        return __('Happyden Blog Post', 'happyden');
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
    public function get_icon() {
        return 'eicon-gallery-grid';
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
    public function get_categories() {
        return ['happyden'];
    }

    public function get_keywords() {
        return ['blog', 'post', 'default'];
    }


    protected function _register_controls()
    {
        $post_categories =  happyden_cpt_taxonomy_slug_and_name('category');
        $this->start_controls_section(
            'section_general',
            [
                'label' => __('General', 'happyden'),
            ]
        );
        $this->add_control(
            'posts_per_page',
            [
                'label' => __('Posts per page', 'happyden'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 5,
            ]
        );
       

        $this->add_control(
            'source',
            [
                'label'         => __('Source', 'happyden'),
                'type'          => \Elementor\Controls_Manager::SELECT,
                'options'       => [
                    'archive' => 'Archive',
                    'manual_selection' => 'Manual Selection',
                    'related' => 'Related',
                ],
                'default' =>    'archive',
            ]
        );
        $this->add_control(
            'manual_selection',
            [
                'label'         => __('Manual Selection', 'happyden'),
                'type'          => \Elementor\Controls_Manager::SELECT2,
                'description'   => __('Get specific template posts', 'happyden'),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => happyden_cpt_slug_and_id('post'),
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
                'type'          => \Elementor\Controls_Manager::SELECT2,
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
                'type'          => \Elementor\Controls_Manager::SELECT2,
                'description'   => __('Get templates for specific category(s)', 'happyden'),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => happyden_cpt_taxonomy_slug_and_name('category'),
                'default' =>    [],
                'condition' => [
                    'include_by' => 'category',
                    'source!' => 'related',
                    'source!' => 'manual_selection'
                ],
            ]
        );
        $this->add_control(
            'include_tags',
            [
                'label'         => __('Include Tags', 'happyden'),
                'type'          => \Elementor\Controls_Manager::SELECT2,
                'description'   => __('Get templates for specific tag(s)', 'happyden'),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => happyden_cpt_taxonomy_slug_and_name('post_tag'),
                'default' =>    [],
                'condition' => [
                    'include_by' => 'tags',
                    'source!' => 'related',
                    'source!' => 'manual_selection'
                ],
            ]
        );
        $this->add_control(
            'include_authors',
            [
                'label'         => __('Include authors', 'happyden'),
                'type'          => \Elementor\Controls_Manager::SELECT2,
                'description'   => __('Get templates for specific tag(s)', 'happyden'),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => happyden_cpt_author_slug_and_id('post'),
                'default' =>    [],
                'condition' => [
                    'include_by' => 'author',
                    'source!' => 'manual_selection'
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
                'type'          => \Elementor\Controls_Manager::SELECT2,
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
                    'source!' => 'manual_selection',
                    'source!' => 'manual_selection'
                ],
            ]
        );
        $this->add_control(
            'exclude_categories',
            [
                'label'         => __('Exclude categories', 'happyden'),
                'type'          => \Elementor\Controls_Manager::SELECT2,
                'description'   => __('Get templates for specific category(s)', 'happyden'),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => happyden_cpt_taxonomy_slug_and_name('category'),
                'default' =>    [],
                'condition' => [
                    'exclude_by' => 'category',
                    'source!' => 'related',
                    'source!' => 'manual_selection'
                ],
            ]
        );
        $this->add_control(
            'exclude_tags',
            [
                'label'         => __('Exclude Tags', 'happyden'),
                'type'          => \Elementor\Controls_Manager::SELECT2,
                'description'   => __('Get templates for specific tag(s)', 'happyden'),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => happyden_cpt_taxonomy_slug_and_name('post_tag'),
                'default' =>    [],
                'condition' => [
                    'exclude_by' => 'tags',
                    'source!' => 'related',
                    'source!' => 'manual_selection'
                ],
            ]
        );
        $this->add_control(
            'exclude_authors',
            [
                'label'         => __('Exclude authors', 'happyden'),
                'type'          => \Elementor\Controls_Manager::SELECT2,
                'description'   => __('Get templates for specific tag(s)', 'happyden'),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => happyden_cpt_author_slug_and_id('post'),
                'default' =>    [],
                'condition' => [
                    'exclude_by' => 'author',
                    'source!' => 'manual_selection'
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_control(
            'orderby',
            [
                'label'         => __('Order By', 'happyden'),
                'type'          => \Elementor\Controls_Manager::SELECT,
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
                'type'          => \Elementor\Controls_Manager::SELECT,
                'options'       => [
                    'ASC'   => 'ASC',
                    'DESC'    => 'DESC',
                ],
                'default' =>    'DESC',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Content', 'happyden'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'show_category',
            [
                'label' => __('Show category', 'happyden'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'happyden'),
                'label_off' => __('Hide', 'happyden'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'show_excerpt',
            [
                'label' => __('Show Content', 'happyden'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'happyden'),
                'label_off' => __('Hide', 'happyden'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'title_limit',
            [
                'label' => __('Title Limit', 'happyden'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'default' => [
					'unit' => 'px',
					'size' => 7,
				],
            ]
        );
        $this->add_control(
            'excerpt_limit',
            [
                'label' => __('Excerpt Word Limit', 'happyden'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'default' => [
					'unit' => 'px',
					'size' => 15,
				],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'condition' => [
                    'show_excerpt' => 'yes',
                ]
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_btn',
            [
                'label' => __('Readmore', 'happyden'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_readmore',
            [
                'label' => __('Readmore button', 'happyden'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'happyden'),
                'label_off' => __('Hide', 'happyden'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => __('Typography', 'happyden'),
                'name' => 'readmore_typography',
                'selector' => '{{WRAPPER}} .post-btn',
                'conditon' => [
                    'show_readmore' => 'yes',
                ]
            ]
        ); 

        $this->add_control(
            'readmore_text',
            [
                'label' => __('Readmore text', 'happyden'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('READ MORE', 'happyden'),
                'conditon' => [
                    'show_readmore' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'btn_icon',
            [
                'label' => __('Icon', 'happyden'),
                'type' => Controls_Manager::ICONS,
                'conditon' => [
                    'show_readmore' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'icon_position',
            [
                'label' => __('Icon Position', 'happyden'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'after',
                'options' => [
                    'before' => __('Before', 'happyden'),
                    'after' => __('After', 'happyden'),
                ],
                'conditon' => [
                    'show_readmore' => 'yes',
                ]
            ]
        );
        $this->add_responsive_control(
            'button_align',
            [
                'label' => __('Align', 'happyden'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
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
        $this->end_controls_section();
        $this->start_controls_section(
            'section_pagination',
            [
                'label' => __('Pagination', 'happyden'),
            ]
        );
        $this->add_control(
            'enable_pagination',
            [
                'label' => __('Show Pagination?', 'grayic-ts'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'grayic-ts'),
                'label_off' => __('No', 'grayic-ts'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => __('Pagination typography', 'happyden'),
                'name' => 'pagi_typography',
                'selector' => '{{WRAPPER}} .happyden-navigation  a, {{WRAPPER}} .happyden-navigation span',
                'condition' => [
                    'enable_pagination' => 'yes'
                ],
            ]
        );
        $this->start_controls_tabs(
            'pagination_controls'
        );
        $this->start_controls_tab(
            'pagination_normal',
            [
                'label' => __('Normal', 'happyden'),
                'condition' => [
                    'enable_pagination' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'pagi_color',
            [
                'label' => __('Pagination Color', 'happyden'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden-navigation > a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .happyden-navigation > span ' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .happyden-navigation a span.happyden-navigation-icon ' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'enable_pagination' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'pagi_bg_color',
            [
                'label' => __('Pagination Background Color', 'happyden'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden-navigation > a' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .happyden-navigation > span ' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .happyden-navigation a span.happyden-navigation-icon' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'enable_pagination' => 'yes'
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'page_border',
                'label' => __('Pagination Border', 'happyden'),
                'selector' => '{{WRAPPER}} .happyden-navigation > a, {{WRAPPER}} .happyden-navigation > span',
                'condition' => [
                    'enable_pagination' => 'yes'
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'pagination_hover',
            [
                'label' => __('Hover', 'happyden'),
                'condition' => [
                    'enable_pagination' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'pagi_hover_color',
            [
                'label' => __('Pagination Hover Color', 'happyden'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden-navigation > a:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .happyden-navigation > span:hover ' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .happyden-navigation > span.current ' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .happyden-navigation a:hover span.happyden-navigation-icon ' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'enable_pagination' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'pagi_hover_bg_color',
            [
                'label' => __('Pagination Background Hover Color', 'happyden'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden-navigation > a:hover' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .happyden-navigation > span:hover ' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .happyden-navigation > span.current ' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .happyden-navigation a:hover span.happyden-navigation-icon' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'enable_pagination' => 'yes'
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'page_hover_border',
                'label' => __('Pagination Hover Border', 'happyden'),
                'selector' => '{{WRAPPER}} .happyden-navigation > a:hover, {{WRAPPER}} .happyden-navigation > span:hover,{{WRAPPER}} .happyden-navigation > span.current',
                'condition' => [
                    'enable_pagination' => 'yes'
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_control(
            'hr',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );
        $this->add_responsive_control(
            'pagi_radius',
            [
                'label' => __('Pagination Border Radius', 'happyden'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .happyden-navigation > a'    => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .happyden-navigation > span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'enable_pagination' => 'yes'
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_image_style',
            [
                'label' => __('Image', 'happyden'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'image_style_tabs'
        );
        $this->start_controls_tab(
            'image_style_normal_tab',
            [
                'label' => __('Normal', 'happyden'),
            ]
        );
        $this->add_control(
            'svg_line_color',
            [
                'label' => __('SVG Line Color', 'happyden'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-thumbnail svg path' => 'stroke: {{VALUE}}',
                ],
                'description' => __('Note: This color only work with svg. If your featured image is svg thent it will work.', 'happyden'),
            ]
        );
        $this->add_control(
            'svg_fill_color',
            [
                'label' => __('SVG Fill Color', 'happyden'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-thumbnail svg path' => 'fill: {{VALUE}}',
                ],
                'description' => __('Note: This color only work with svg. If your featured image is svg thent it will work.', 'happyden'),
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'image_style_hover_tab',
            [
                'label' => __('Hover', 'happyden'),
            ]
        );
        $this->add_control(
            'svg_hover_line_color',
            [
                'label' => __('SVG Line Color', 'happyden'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden-post-widget-item:hover .post-thumbnail svg path' => 'stroke: {{VALUE}}',
                ],
                'description' => __('Note: This color only work with svg. If your featured image is svg thent it will work.', 'happyden'),
            ]
        );
        $this->add_control(
            'svg_hover_fill_color',
            [
                'label' => __('SVG Fill Color', 'happyden'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden-post-widget-item:hover .post-thumbnail svg path' => 'fill: {{VALUE}}',
                ],
                'description' => __('Note: This color only work with svg. If your featured image is svg thent it will work.', 'happyden'),
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_control(
            'image_style_divider',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );
        $this->add_responsive_control(
            'image_width',
            [
                'label' => __('Image Width', 'happyden'),
                'type' => \Elementor\Controls_Manager::SLIDER,
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
                    '{{WRAPPER}} .post-thumbnail img'  => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_height',
            [
                'label' => __('Image Height', 'happyden'),
                'type' => \Elementor\Controls_Manager::SLIDER,
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
                    '{{WRAPPER}} .post-thumbnail img'  => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_padding',
            [
                'label' => __('Image Padding', 'happyden'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .post-thumbnail ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .post-thumbnail ' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'content_style',
            [
                'label' => __('Content', 'happyden'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'cat_typography',
                'label' => __('Meta Typography', 'happyden'),
                'selector' => '{{WRAPPER}} .entry-meta',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'label' => __('Title Typography', 'happyden'),
                'selector' => '{{WRAPPER}} .happyden-post-widget-item .post-title',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'excerpt_typo',
                'label' => __('Excerpt Typography', 'happyden'),
                'selector' => '{{WRAPPER}} .happyden-post-widget-item p',
                'condition' => [
                    'show_excerpt' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'content_align',
            [
                'label' => __('Align', 'happyden'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __('Top', 'happyden'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'happyden'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'flex-end' => [
                        'title' => __('Bottom', 'happyden'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .happyden-post-widget-item .row' => 'align-items: {{VALUE}}',
                ],
                'toggle' => true,
            ]
        );




        $this->start_controls_tabs(
            'content_style_tabs'
        );
        $this->start_controls_tab(
            'content_style_normal_tab',
            [
                'label' => __('Normal', 'happyden'),
            ]
        );
        $this->add_control(
            'meta_color',
            [
                'label' => __('Meta Color', 'happyden'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .entry-meta' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .entry-meta a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => __('Title Color', 'happyden'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden-post-widget-item .post-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'excerpt_color',
            [
                'label' => __('Excerpt Color', 'happyden'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden-post-widget-item p' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'show_excerpt' => 'yes'
                ]
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'content_style_hover_tab',
            [
                'label' => __('Hover', 'happyden'),
            ]
        );
        $this->add_control(
            'category_hover_color',
            [
                'label' => __('Category Color', 'happyden'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .entry-meta' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .entry-meta a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'title_hover_color',
            [
                'label' => __('Title Color', 'happyden'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden-post-widget-item:hover .post-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'excerpt_hover_color',
            [
                'label' => __('Excerpt Color', 'happyden'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden-post-widget-item:hover p' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'show_excerpt' => 'yes'
                ]
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_control(
            'title_br',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );
        $this->add_responsive_control(
            'title_gap',
            [
                'label' => __('Title Gap', 'happyden'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .happyden-post-widget-item .post-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'meta_right',
            [
                'label' => __('Right Gap', 'happyden'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .entry-meta' => 'margin-right: {{SIZE}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .entry-meta' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_padding',
            [
                'label' => __('Content Padding', 'happyden'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .happyden-post-widget-item .post-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .happyden-post-widget-item .post-content' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ]
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'button_style',
            [
                'label' => __('Button', 'happyden'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typography',
                'label' => __('Button Typography', 'happyden'),
                'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .post-btn',
            ]
        );
        $this->start_controls_tabs(
            'button_style_tabs'
        );
        $this->start_controls_tab(
            'button_style_normal_tab',
            [
                'label' => __('Normal', 'happyden'),
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label' => __('Icon Color', 'happyden'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-btn .btn-icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .post-btn .btn-icon path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'boxed_btn_color',
            [
                'label' => __('Button Color', 'happyden'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-btn' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'boxed_btn_background',
            [
                'label' => __('Background Color', 'happyden'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-btn' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'label' => __('Border', 'happyden'),
                'selector' => '{{WRAPPER}} .post-btn',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_shadow',
                'label' => __('Button Shadow', 'happyden'),
                'selector' => '{{WRAPPER}} .post-btn',
            ]
        );
        $this->add_responsive_control(
            'button_radius',
            [
                'label' => __('Border Radius', 'happyden'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .post-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .post-btn' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'icon_gap',
            [
                'label' => __('Icon gap', 'happyden'),
                'type' => \Elementor\Controls_Manager::SLIDER,
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
                    'body:not(.rtl) {{WRAPPER}} .post-btn .icon-before' => 'margin-right: {{SIZE}}{{UNIT}};',
                    'body:not(.rtl) {{WRAPPER}} .post-btn .icon-after ' => 'margin-left: {{SIZE}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .post-btn .icon-before' => 'margin-left: {{SIZE}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .post-btn .icon-after ' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'button_style_hover_tab',
            [
                'label' => __('Hover', 'happyden'),
            ]
        );
        $this->add_control(
            'icon_hover_color',
            [
                'label' => __('Icon Color', 'happyden'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden-post-widget-item:hover .post-btn .btn-icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .happyden-post-widget-item:hover .post-btn .btn-icon path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'btn_hover_color',
            [
                'label' => __('Button Color', 'happyden'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden-post-widget-item:hover .post-btn' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'btn_hover_background',
            [
                'label' => __('Background Color', 'happyden'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-btn:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_hover_border',
                'label' => __('Border', 'happyden'),
                'selector' => '{{WRAPPER}} .post-btn:hover',
            ]
        );
        $this->add_control(
            'btn_hover_animation',
            [
                'label' => __('Hover Animation', 'happyden'),
                'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_hover_shadow',
                'label' => __('Button Shadow', 'happyden'),
                'selector' => '{{WRAPPER}} .post-btn:hover',
            ]
        );
        $this->add_responsive_control(
            'button_hover_radius',
            [
                'label' => __('Border Radius', 'happyden'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .post-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .post-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'icon_hover_gap',
            [
                'label' => __('Icon gap', 'happyden'),
                'type' => \Elementor\Controls_Manager::SLIDER,
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
                    'body:not(.rtl) {{WRAPPER}} .post-btn:hover .icon-before' => 'transform: translatex( -{{SIZE}}{{UNIT}} );',
                    'body:not(.rtl) {{WRAPPER}} .post-btn:hover .icon-after ' => 'transform: translatex( {{SIZE}}{{UNIT}} );',
                    'body.rtl {{WRAPPER}} .post-btn:hover .icon-before' => 'transform: translatex( {{SIZE}}{{UNIT}} );',
                    'body.rtl {{WRAPPER}} .post-btn:hover .icon-after ' => 'transform: translatex( -{{SIZE}}{{UNIT}} );',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_control(
            'buton_style_divider',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );
        $this->add_control(
            'icon_size',
            [
                'label' => __('Icon Size', 'happyden'),
                'type' => \Elementor\Controls_Manager::SLIDER,
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
                    '{{WRAPPER}} .post-btn .btn-icon'       => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .post-btn .btn-icon svg'   => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __('Button Padding', 'happyden'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .post-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .post-btn' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_content_box_style',
            [
                'label' => __('Box', 'happyden'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'box_style_tabs'
        );
        $this->start_controls_tab(
            'box_style_normal_tab',
            [
                'label' => __('Normal', 'happyden'),
            ]
        );
        $this->add_control(
            'box_bg_color',
            [
                'label' => __('Box Backgroound Color', 'happyden'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden-post-widget-item' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_radius',
            [
                'label' => __('Box Radius', 'happyden'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .happyden-post-widget-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .happyden-post-widget-item' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_shadow',
                'label' => __('Box Hover Shadow', 'happyden'),
                'selector' => '{{WRAPPER}} .happyden-post-widget-item',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'label' => __('Box Border', ''),
                'selector' => '{{WRAPPER}} .happyden-post-widget-item',
            ]
        );
        $this->add_control(
            'hide_last_item_border',
            [
                'label' => __('Hide Last Item Border?', 'happyden'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'happyden'),
                'label_off' => __('Hide', 'happyden'),
                'return_value' => 'yes',
                'default' => 'no',
                'selectors' => [
                    '{{WRAPPER}} .happyden-post-widget-wrap:last-child .happyden-post-widget-item' => 'border: none!important',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'box_style_hover_tab',
            [
                'label' => __('Hover', 'happyden'),
            ]
        );
        $this->add_control(
            'box_hover_bg_color',
            [
                'label' => __('Box Backgroound Color', 'happyden'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'defautl' => '#233aff',
                'selectors' => [
                    '{{WRAPPER}} .happyden-post-widget-item:hover:after' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_hover_radius',
            [
                'label' => __('Box Radius', 'happyden'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .happyden-post-widget-item:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .happyden-post-widget-item:hover' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_hover_shadow',
                'label' => __('Box Hover Shadow', 'happyden'),
                'selector' => '{{WRAPPER}} .happyden-post-widget-item:hover',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'box_hover_border',
                'label' => __('Box Border', ''),
                'selector' => '{{WRAPPER}} .happyden-post-widget-item:hover ',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_responsive_control(
            'box_padding',
            [
                'label' => __('Box Padding', 'happyden'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .happyden-post-widget-item ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .happyden-post-widget-item ' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
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
        $include_categories = [];
        $exclude_tags = [];
        $include_tags = '';
        $include_authors = '';
        $exclude_categories = [];
        $exclude_authors = '';
        $current_post_id = '';
        if ( 0 != count($settings['include_categories'])) {
            $include_categories['tax_query'] = [
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => $settings['include_categories'],
            ];
        }
        if ( 0 != count($settings['include_tags'])) {
            $include_tags = implode(',', $settings['include_tags']);
        }
        if ( 0 != count($settings['include_authors'])) {
            $include_authors = implode(',', $settings['include_authors']);
        }
        if ( 0 != count($settings['exclude_categories'])) {
            $exclude_categories['tax_query'] = [
                'taxonomy' => 'category',
                'operator' => 'NOT IN',
                'field'    => 'slug',
                'terms'    => $settings['exclude_categories'],
            ];
        }
        if ( 0 != count($settings['exclude_tags'])) {
            $exclude_tags['tax_query'] = [
                'taxonomy' => 'post_tag',
                'operator' => 'NOT IN',
                'field'    => 'slug',
                'terms'    => $settings['exclude_tags'],
            ];
        }
        if ( 0 != count($settings['exclude_authors'])) {
            $exclude_authors = implode(',', $settings['exclude_authors']);
        }
        if (in_array('current_post', $settings['exclude_by'])) {
            $current_post_id = get_the_ID();
        }
        // var_dump($settings['exclude_categories']);
        if ('related' == $settings['source'] && is_single() && 'post' == get_post_type()) {
            $related_categories = get_the_terms(get_the_ID(), 'category');
            $related_cats = [];
            foreach ($related_categories as $related_cat) {
                $related_cats[] = $related_cat->slug;
            }
            $the_query = new \WP_Query(array(
                'posts_per_page' => $settings['posts_per_page'],
                'post_type' => 'post',
                'orderby' => $settings['orderby'],
                'order' => $settings['order'],
                'post__not_in' => array($current_post_id),
                'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'category',
                        'operator' => 'IN',
                        'field'    => 'slug',
                        'terms'    => $related_cats,
                    ),
                ),
            ));
        } elseif ('manual_selection' == $settings['source']) {
            $the_query = new \WP_Query(array(
                'posts_per_page' => $settings['posts_per_page'],
                'post_type' => 'post',
                'orderby' => $settings['orderby'],
                'order' => $settings['order'],
                'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
                'post__in' => ( 0 != count($settings['manual_selection'])) ? $settings['manual_selection'] : array(),
            ));
        } else {
            $the_query = new \WP_Query(array(
                'posts_per_page' => $settings['posts_per_page'],
                'post_type' => 'post',
                'orderby' => $settings['orderby'],
                'order' => $settings['order'],
                'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
                'post_tag' => ( 0 != count($settings['include_tags'])) ? $include_tags : '',
                'post__not_in' => array($current_post_id),
                'author' => ( 0 != count($settings['include_authors'])) ? $include_authors : '',
                'author__not_in' => ( 0 != count($settings['exclude_authors'])) ? $exclude_authors : '',
                'tax_query' => array(
                    'relation' => 'AND',
                    ( 0 != count($settings['exclude_tags'])) ? $exclude_tags : '',
                    ( 0 != count($settings['exclude_categories'])) ? $exclude_categories : '',
                    ( 0 != count($settings['include_categories'])) ? $include_categories : '',
                ),
            ));
        } ?>
<div class="row">
        <div class="col-lg-12">
    <?php
    while ($the_query->have_posts()) : $the_query->the_post(); ?>
    <?php

    if (has_post_thumbnail()) {
        $thumbail_column = 'col-lg-8';
    } else {
        $thumbail_column = 'col-lg-12';
    };

    $author_icon = HAPPYDEN_ASSETS .('img/avatar-line.svg');
    $cat_icon = HAPPYDEN_ASSETS .('img/tag-outlined.svg');
    $date_icon = HAPPYDEN_ASSETS .('img/time-outline.svg');
   

    $idd = get_the_ID();
    $excerpt = ($settings['excerpt_limit']['size']) ? wp_trim_words(get_the_excerpt(), $settings['excerpt_limit']['size'], '...') : get_the_excerpt();
    $title = ($settings['title_limit']['size']) ? wp_trim_words(get_the_title(), $settings['title_limit']['size'], '...') : get_the_title();
    $image_type = wp_check_filetype(get_the_post_thumbnail_url()); 

    if( 'yes' == $settings['show_category'] && has_category() ) {
        $post_cat = get_the_terms($idd, 'category');
        $post_cat = join(', ', wp_list_pluck($post_cat, 'name'));
        $post_category = sprintf('<span class="category-list">%s</span>', $post_cat);
    }else{
        $post_cat = '';
        $post_category = '';
    }
    ?>
    <div class="happyden-post-widget-wrap">
        <div class="happyden-post-widget-item">
            <div class="row">
            <?php if (has_post_thumbnail()) : ?>
                <div class="col-lg-4">
                    <a href="<?php echo esc_url( get_the_permalink() ); ?>" class="post-link">
                        <div class="post-thumbnail-wrapper">
                            <div class="post-thumbnail">
                                <?php
                                if ('svg' == $image_type['ext']) {
                                    $image_id =  attachment_url_to_postid(get_the_post_thumbnail_url());
                                    $image =  [
                                    'value' => [
                                        'url' => get_the_post_thumbnail_url(),
                                        'id' => $image_id,
                                    ],
                                    'library' => 'svg'
                                ];
                                    Elementor\Icons_Manager::render_icon($image, ['aria-hidden' => 'true']);
                                } else {
                                    the_post_thumbnail('medium');
                                } ?>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endif; ?>
            <div class="<?php echo esc_attr($thumbail_column) ?>">
                <div class="post-content-wrap">
                    <div class="post-content">
                        <!-- <?php if( is_sticky() ) : ?>
                            <span class="dashicons dashicons-admin-post"></span>
                        <?php  endif; ?> -->
                        
                        
                        <a href="<?php echo esc_url( get_the_permalink() ); ?>" class="post-link">
                            <?php
                                printf('<h3 class="post-title">%s</h3>', esc_html( $title )); 
                            ?>
                        </a>  
                        <!-- post meta -->
                        <div class="entry-meta">
                            <span class="byline">
                                <img src="<?php echo esc_url($author_icon ) ?>">
                                <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
                                    <?php echo get_the_author(); ?>
                                </a>
                            </span>
                            <span class="cat-links">
                                <img src="<?php echo esc_url($cat_icon ) ?>">
                                <?php  echo  $post_category ; ?>
                            </span>
                            <span class="posted-on">
                                <img src="<?php echo esc_url($date_icon ) ?>">
                                <?php echo get_the_date(); ?>
                            </span>
                        </div> 
                        <!-- post meta end -->

                        <!-- post  excerpt -->
                            <?php
                                echo 'yes' == $settings['show_excerpt'] ? sprintf('<p> %s </p>', esc_html($excerpt)) : ''; 
                            ?>
                        <!-- post  excerpt end-->  
                    </div>

                    <!-- redmore -->  
                    <?php if ('yes' == $settings['show_readmore']): ?>
                    <div class="post-btn-wrap">
                            <a class='post-btn' href="<?php the_permalink() ?>">
                                <?php if ('before' == $settings['icon_position'] && !empty( $settings['btn_icon']['value']) ) : ?>
                                    <span class="icon-before btn-icon"><?php \Elementor\Icons_Manager::render_icon($settings['btn_icon'], ['aria-hidden' => 'true']) ?></span>
                                <?php endif; ?>



                                <?php echo esc_html( $settings['readmore_text'] ); ?>
                                

                                <?php if ('after' == $settings['icon_position'] && !empty($settings['btn_icon']['value'])) : ?>
                                    <span class="icon-after btn-icon"><?php \Elementor\Icons_Manager::render_icon($settings['btn_icon'], ['aria-hidden' => 'true']) ?></span>
                                <?php endif; ?>


                            </a>
                        </div>
                    <?php endif; ?>
                        <!-- redmore end-->  
                </div>                
            </div>       
            </div>
        </div>
    </div> 
<?php
endwhile;
    echo '</div> </div>';
    if ($settings['enable_pagination']) :
            $big = 999999999; // need an unlikely integer
    echo '<div class="row"><div class="col-12"><div class="happyden-navigation widget">';
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'prev_text' => '<span class="happyden-navigation-icon"><i class="fa fa-angle-left"> </i></span>',
        'next_text' => '<span class="happyden-navigation-icon"><i class="fa fa-angle-right"> </i></span>',
        'total' => $the_query->max_num_pages,
    ));
    echo '</div></div></div>';
    endif;
    wp_reset_postdata();
    }
}
$widgets_manager->register_widget_type(new \Happyden\Widgets\Elementor\HappydenBlogLoop());