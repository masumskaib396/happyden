<?php
/**
 * Thmpw Service.
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

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Happyden_Test extends \Elementor\Widget_Base {

	public function get_name() {
		return 'happyden_test';
	}
	
	public function get_title() {
		return __( 'Happyden Test Widget', 'happyden' );
	}

	public function get_icon() {
		return 'eicon-button';
	}

	public function get_categories() {
		return [ 'happyden' ];
	}

	protected function _register_controls() {

		$this->start_controls_section('content_section',
			[
				'label' => __( 'Service', 'happyden' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
			'happyden_infobox_animating_mask_switcher',
			[
				'label' 		=> __( 'Enable Animating Mask', 'happyden' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'ON', 'happyden' ),
				'label_off' 	=> __( 'OFF', 'happyden' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'no',
			]
		);

		$this->add_control(
			'happyden_infobox_animating_mask_style',
			[
				'label'        => __( 'Animating Mask Style', 'happyden' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'style_1',
				'options'      => [
					'style_1'  => __( 'Style 1', 'happyden' ),
					'style_2'  => __( 'Style 2', 'happyden' ),
					'style_3'  => __( 'Style 3', 'happyden' ),
				],
				'condition'		=> [
					'happyden_infobox_animating_mask_switcher' => 'yes'
				]
			]
		);



	}

protected function render() {
    $settings = $this->get_settings_for_display();
    $mask_style = $settings['happyden_infobox_animating_mask_style'];
    ?>

    <div class="wraper">
         <style>
            .happyden_iconbox {
                width: 80px;
                height: 80px;
                text-align: center;
                background-color: #222;
                color: #fff;
                line-height: 80px;
                font-size: 30px;
            }


            .happyden_iconbox.style_1{
            -webkit-animation: clip-1 10s linear infinite alternate forwards;
                animation: clip-1 10s linear infinite alternate forwards;
                overflow: hidden;
            }
            .happyden_iconbox.style_2{
            -webkit-animation: clip-2 10s linear infinite alternate forwards;
                animation: clip-2 10s linear infinite alternate forwards;
                overflow: hidden;
            }
            .happyden_iconbox.style_3{
            -webkit-animation: clip-3 10s linear infinite alternate forwards;
                animation: clip-3 10s linear infinite alternate forwards;
                overflow: hidden;
            }

            @keyframes clip-1{
            0%, 100% {
                border-radius: 63% 37% 54% 46% / 55% 48% 52% 45%;
            }
            14% {
                border-radius: 40% 60% 54% 46% / 49% 60% 40% 51%;
            }
            28% {
                border-radius: 54% 46% 38% 62% / 49% 70% 30% 51%;
            }
            42% {
                border-radius: 61% 39% 55% 45% / 61% 38% 62% 39%;
            }
            56% {
                border-radius: 61% 39% 67% 33% / 70% 50% 50% 30%;
            }
            70% {
                border-radius: 50% 50% 34% 66% / 56% 68% 32% 44%;
            }
            84% {
                border-radius: 46% 54% 50% 50% / 35% 61% 39% 65%;
            }
            }

            @keyframes clip-2 {
            0%, 100% {
                border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            }
            25% { 
                border-radius: 58% 42% 75% 25% / 76% 46% 54% 24%;
            }
            50% {
                border-radius: 50% 50% 33% 67% / 55% 27% 73% 45%;
            }
            75% {
                border-radius: 33% 67% 58% 42% / 63% 68% 32% 37%;
            }
            }

            @keyframes clip-3 {
            0%, 100% {
                border-radius: 33% 67% 58% 42% / 63% 68% 32% 37%;;
            }
            20% {
                border-radius: 45% 55% 62% 38% / 53% 51% 49% 47%;
            }
            40% {
                border-radius: 45% 55% 49% 51% / 36% 51% 49% 64%;
            }
            60% {
                border-radius: 60% 40% 57% 43% / 47% 62% 38% 53%;
            }
            80% {
                border-radius: 60% 40% 32% 68% / 38% 36% 64% 62%;
            }
            }
        </style>


        <div class="happyden_iconbox <?php echo esc_attr($mask_style); ?>">
            <i class="fa fa-facebook"></i>
        </div>
    </div>

    <?php
    
	}
}
$widgets_manager->register_widget_type( new \Happyden\Widgets\Elementor\Happyden_Test() );