<?php
/**
 * Happyden Gallery Widget.
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
use  Elementor\Repeater;
use Elementor\Icons_Manager;

if (!defined('ABSPATH')) {
    exit;
}
// If this file is called directly, abort.
class HappydenGallery extends \Elementor\Widget_Base {
    public function get_name() {
        return 'happyden_gallery';
    }
    public function get_title() {
        return __('Happyden Gallery', 'happyden');
    }
    public function get_icon() {
        return ('eicon-gallery-justified');
    }
    public function get_categories() {
        return ['happyden'];
    }
    public function get_keywords() {
        return ['image box', 'gallery', 'project', 'portfolio', 'box', 'image'];
    }
    protected function _register_controls() {
        $this->start_controls_section('happyden_gallery_section',
            [
                'label' => __('Gallery', 'happyden'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        
        $repeater = new Repeater();
        $repeater->add_control(
			'image', [
				'label' => __( 'Image', 'happyden' ),
				'type' => Controls_Manager::MEDIA,
                'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
        );
        $repeater->add_control(
            'title', [
                'label'         =>   __( 'Title', 'happyden' ),
                'type'          =>  Controls_Manager::TEXTAREA,
                'default'       =>  __( 'East Asia client Audit, Project Indust.' , 'happyden' ),
            ]
        );
        $repeater->add_control(
            'sub_title', [
                'label'         =>   __( 'Sub Title', 'happyden' ),
                'label_block'         =>   true,
                'type'          =>  Controls_Manager::TEXT,
                'default'       =>  __( '19 February, 2021' , 'happyden' ),
            ]
        );

        $repeater->add_control(
            'full_height',
            [
                'label'        => __('Full Height', 'happyden'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Show', 'happyden'),
                'label_off'    => __('Hide', 'happyden'),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $this->add_control(
            'contents',
            [
                'label' => __( 'Repeater List', 'happyden' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(sub_title.slice(0,1).toUpperCase() + sub_title.slice(1)) #>',
                'default' => [
                    [
                        'image' => ['url' => Utils::get_placeholder_image_src()],
                        'title' =>   __('East Asia client Audit, Project Indust.'),
                        'sub_title' =>   __('19 February, 2021', 'happyden'),
                        'full_height' =>   'no',
                    ],
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section('happyden_gallery_advance_section',
            [
                'label' => __('Advanced Settings', 'happyden'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_responsive_control(
            'gallery_gap',
            [
                'label'          => __('Gap', 'happyden'),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => ['px'],
                'range'          => [
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .happyden__gallery--single-item' => 'margin-bottom: {{SIZE}}{{UNIT}}; margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .happyden__gallery--wraper' => 'margin-left: -{{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        /* 
        Image
        */
        $this->start_controls_section('happyden_gallery_iamge',
            [
                'label' => __('Image', 'happyden'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'iamge_border_redius',
            [
                'label'      => __('Border Radius', 'happyden'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .happyden__gallery--thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .happyden__gallery--thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        /* 
        *Title
        */
        $this->start_controls_section('image_title',
            [
                'label' => __('Title', 'happyden'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'title_color',
            [
                'label'     => __('Color', 'happyden'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden__gallery--title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typo',
                'label'    => __('Typography', 'happyden'),
                'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}}  .happyden__gallery--title',
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label'      => __('Margin', 'happyden'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .happyden__gallery--title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .happyden__gallery--title' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        /* 
        *Sub Title
        */
        $this->start_controls_section('image_sub_title',
            [
                'label' => __('Sub Title', 'happyden'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'sub_title_color',
            [
                'label'     => __('Color', 'happyden'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden__gallery--sub-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'sub_title_typo',
                'label'    => __('Typography', 'happyden'),
                'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}}  .happyden__gallery--sub-title',
            ]
        );

        $this->add_responsive_control(
            'sub_title_margin',
            [
                'label'      => __('Margin', 'happyden'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .happyden__gallery--sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .happyden__gallery--sub-title' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();


        /* 
        *Icon
        */
        $this->start_controls_section('image_icon',
            [
                'label' => __('Icon', 'happyden'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'icon_color',
            [
                'label'     => __('Color', 'happyden'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden__gallery--icon i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'          => __('Size', 'happyden'),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => ['px'],
                'range'          => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .happyden__gallery--icon i' => 'font-size: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_margin',
            [
                'label'      => __('Margin', 'happyden'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .happyden__gallery--icon i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .happyden__gallery--icon i' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        /* 
        Content Box
        */
        $this->start_controls_section('happyden_content_box',
            [
                'label' => __('Content Box', 'happyden'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'contnet_box_bg_color',
            [
                'label'     => __('Color', 'happyden'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .happyden__gallery--content' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_box_border_redius',
            [
                'label'      => __('Border Radius', 'happyden'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .happyden__gallery--content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .happyden__gallery--content' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_box_margin',
            [
                'label'      => __('Margin', 'happyden'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .happyden__gallery--inner-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .happyden__gallery--inner-content' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();


    }
    protected function render() {
        $settings = $this->get_settings_for_display();
        $gallerys = $settings['contents'];
        ?>  

        <div class="happyden__gallery--wraper" id="happyden__gallery--masonay">
        <?php foreach( $gallerys as $gallery ): 
                $image = wp_get_attachment_image_url( $gallery['image']['id'], 'full');

                if('yes' == $gallery['full_height']){
                    $fullheight = 'full-height';
                }else{
                    $fullheight = '';
                }



            ?>
                <div class="happyden__gallery--collection-item happyden__gallery--collection-item-w1">
                    <a  href="<?php echo esc_url($image) ?>" class="happyden--popup happyden__gallery--single-item" >
                        <div class="happyden__gallery--thumb  <?php echo esc_attr($fullheight) ?>">
                            <img src="<?php echo esc_url($image) ?>" alt="<?php echo esc_html($gallery['title']); ?>">
                        </div>

                        <div class="happyden__gallery--content">
                            <div class="happyden__gallery--inner-content">
                                <div class="happyden__gallery--icon">
                                    <i class="fas fa-search-plus"></i>
                                </div> 
                                <div class="happyden__gallery--title">
                                    <?php echo esc_html($gallery['title']); ?>
                                </div> 

                                <div class="happyden__gallery--sub-title">
                                    <?php echo esc_html($gallery['sub_title']); ?>
                                </div> 
                            </div>
                        </div>
                    </a> 
                </div> 
            <?php endforeach; ?>
        </div>
    <?php
    }
}
$widgets_manager->register_widget_type( new \Happyden\Widgets\Elementor\HappydenGallery() );