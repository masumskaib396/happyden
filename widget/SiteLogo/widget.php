<?php
/**
 * Happyden Sit Logo
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
use  Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class HappydenSiteLogo extends \Elementor\Widget_Base
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
        return 'happyden-logo';
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
        return __('Happyden Site Logo', 'happyden');
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
        return 'eicon-image';
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
			'logo_type',
			[
				'label' => __( 'Logo Type', 'happyden' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'dark',
				'options' => [
					'dark'  => __( 'Dark', 'happyden' ),
					'white' => __( 'White', 'happyden' ),
					'custom' => __( 'Custom', 'happyden' ),
				],
			]
        );
        
        $this->add_control(
            'image',
            [
                'label' => __('Choose logo', 'amantheon-ts'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
                'condition' => [
                    'logo_type' => 'custom',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'logo_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                'include' => [],
                'default' => 'large',
                'condition' => [
                    'logo_type' => 'custom',
                ]
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
                        'title' => __('Center', 'happyden'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'happyden'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .happyden-site-logo' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_width',
            [
                'label' => __('Image width', 'amathon-ts'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .happyden-site-logo img' => 'width: {{SIZE}}{{UNIT}};',
                ]

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
    ?>
        <div class="happyden-site-logo">
            <a href="<?php echo home_url(); ?>" class="happyden-site-logo-wrap">
                <?php
				
				echo "<span class='site-logo'>";
                if ( 'custom' == $settings['logo_type'] && $settings['image']['url']) {
                    echo Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'image');
                } else {
                    echo $this->happyden_get_site_logo( $settings['logo_type'] );
                }
				echo '</span>'
                
                ?>
            </a>
        </div>
    <?php
    }
    /**
     * 
     *  Happyden get logo  
     * 
     */
    public function happyden_get_site_logo( $logo_type = 'dark'  )
    {
        $logo = '';
        $happyden = get_option('happyden');
        $logo_url = '';
        if ( 'dark' ==  $logo_type && isset( $happyden['logo']['url'] ) ) {
            $logo_url = esc_url($happyden['logo']['url']);
            $logo = '<img src="' . esc_url($logo_url) . '" alt="' . esc_attr(get_bloginfo('title')) . '" class="navbar-brand__regular dark-logo">';
        } else if ( 'white' ==  $logo_type && isset($happyden['white_logo']['url'])) {
            $logo_url = esc_url($happyden['white_logo']['url']);
            $logo = '<img src="' . esc_url($logo_url) . '" alt="' . esc_attr(get_bloginfo('title')) . '" class="navbar-brand__regular white-logo">';
        } else {
            if ( has_custom_logo() ) {
                $core_logo_id = get_theme_mod('custom_logo');
                $logo_url = wp_get_attachment_image_src($core_logo_id, 'full');
                $logo = '<img src="' . esc_url($logo_url[0]) . '" alt="' . esc_attr(get_bloginfo('title')) . '" class="navbar-brand__regular">';
            } else {
                $logo = '<h1 class="navbar-brand__regular">' . get_bloginfo('name') . '</h1>';
            }
        }
        return $logo;
    }
}
$widgets_manager->register_widget_type( new \Happyden\Widgets\Elementor\HappydenSiteLogo() );