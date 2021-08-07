<?php
/**
 * Testimonial class.
 * 
 * @category    Class
 * @package     TestimonialCarouselforElementor
 * @subpackage  WordPress
 * @author      priyanshuchaudhary53
 * @since       1.0.0
 * php version  7.3.9
 */

namespace TestimonialCarousel\Widgets;

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;

// Block direct access to the plugin PHP files.
defined( 'ABSPATH' ) || die();

/**
 * TS_Testimonial widget class.
 * 
 * @since 1.0.0
 */
class TS_Testimonial extends Widget_Base {

    /**
     * Class constructor.
     * 
     * @param array $data Widget data.
     * @param array $args Widget arguments.
     */
    public function __construct( $data = array(), $args = null ) {
        parent::__construct( $data, $args );
        
        wp_register_style( 'ts_stylesheet', plugins_url( '/assets/css/stylesheet.css', TESTIMONIAL_CAROUSEL ), array(), '1.0.0' );
    
        wp_register_script( 'ts_main', plugins_url( '/assets/js/main.js', TESTIMONIAL_CAROUSEL ), array( 'elementor-frontend' ), '1.0.0', true );
        
    }

    /**
     * Retrieve the widget name.
     * 
     * @since 1.0.0
     * @access public
     * 
     * @return string Widget name.
     */
    public function get_name() {
        return 'ts-testimonial-carousel';
    }

    /**
     * Retrive the widget title.
     * 
     * @since 1.0.0
     * @access public
     * 
     * @return string Widget title.
     */
    public function get_title() {
        return 'Testimonial Carousel';
    }

    /**
     * Retrive the widget icon.
     * 
     * @since 1.0.0
     * @access public
     * 
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'fas fa-comments';
    }

    /**
     * Retrive the list of categories the widget belongs to.
     * 
     * Used to determine where to display the widget in the editor.
     * 
     * @since 1.0.0
     * @access public
     * 
     * @return array Widget categories.
     */
    public function get_categories() {
        return array ( 'general' );
    }

    /**
     * Enquque stylesheets.
     */
    public function get_style_depends() {
        return array( 
            'ts_stylesheet',
         );
    }

    /**
     * Enqueue scripts.
     */
    public function get_script_depends() {
        return array( 
            'ts_main',
         );
    }

    /**
     * Register the widget controls.
     * 
     * Adds different input fields to allow the user to change and customize the widget settings.
     * 
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {
        // `Testimonial Carousel` Section
        $this->start_controls_section( 'testimonial_carousel', array(
            'label'     => 'Testimonial Carousel',
            'tab'       => Controls_Manager::TAB_CONTENT,
        ) );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control( 'testimonial_image', array(
            'label'     => 'Choose Image',
            'type'      => Controls_Manager::MEDIA,
            'default'   => array(
                'url'      => \Elementor\Utils::get_placeholder_image_src(),
            ),
        ) );

        $repeater->add_group_control( \Elementor\Group_Control_Image_Size::get_type(), array(
            'name'      => 'testimonial_img_size',
            'exclude'   => array(),
            'include'   => array(),
            'default'   => 'thumbnail',
        ) );

        $repeater->add_control( 'testimonial_content', array(
            'label'     => 'Content',
            'type'      => Controls_Manager::TEXTAREA,
            'default'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
        ) );

        $repeater->add_control( 'testimonial_name', array(
            'label'         => 'Name',
            'type'          => Controls_Manager::TEXT,
            'default'       => 'John Doe',
        ) );

        $repeater->add_control( 'testimonial_title', array(
            'label'     => 'Title',
            'type'      => Controls_Manager::TEXT,
            'default'   => 'Web Developer',
        ) );

        $this->add_control( 'testimonial_list', array(
            'label'         => 'Testimonials',
            'type'          => Controls_Manager::REPEATER,
            'fields'        => $repeater->get_controls(),
            'default'       => array(
                array(
                    'testimonial_content'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pharetra magna eu nisi porttitor, ut auctor felis commodo. Fusce nunc nisl, volutpat vel dolor eget, dapibus congue mauris. Nullam vestibulum eros vitae augue sagittis aliquet. Nulla tempor imperdiet enim eu pulvinar.',
                ),
                array(
                    'testimonial_content'   => 'Suspendisse nec imperdiet nisi, eu pulvinar turpis. Maecenas consequat pharetra mi eget volutpat. Vivamus quis pulvinar ante. Mauris vitae bibendum orci. Quisque porta dui mauris, eget facilisis nunc cursus et. Pellentesque condimentum mollis dignissim. Cras vehicula lacinia nulla, blandit luctus lectus ornare quis.',
                ),
                array(
                    'testimonial_content'   => 'Etiam ac ligula magna. Nam tempus lorem a leo fermentum, eget iaculis eros vulputate. Fusce sollicitudin nulla ac aliquam scelerisque. Fusce nec dictum magna. Ut maximus ultrices pulvinar. Integer sit amet felis tellus. Phasellus turpis ex, luctus vulputate egestas eget, laoreet et nunc.',
                ),
            ),
            'title_field'   => '{{{ testimonial_name }}}'
        ) );

        $this->end_controls_section();

        // `Image` Section
        $this->start_controls_section( 'testimonial_image_style', array(
            'label'     => 'Image',
            'tab'       => Controls_Manager::TAB_STYLE,
        ) );

        $this->add_control( 'testimonial_image_size', array(
            'label'     => 'Image Size',
            'type'      => Controls_Manager::SLIDER,
            'range'     => array(
                'px'        => array(
                    'min'       => 50,
                    'max'       => 500,
                    'step'      => 5,
                ),
            ),
            'selectors' => array(
                '{{WRAPPER}} .img-box'  => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
            ),
        ) );

        $this->add_group_control( \Elementor\Group_Control_Border::get_type(), array(
            'name'      => 'testimonial_image_border',
            'label'     => 'Border Type',
            'selector'  => '{{WRAPPER}} .img-box',
        ) );

        $this->add_control( 'testimonial_image_border_radius', array(
            'label'     => 'Border Radius',
            'type'      => Controls_Manager::DIMENSIONS,
            'size_units'=> array( 'px', '%' ),
            'selectors' => array(
                '{{WRAPPER}} .img-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                '{{WRAPPER}} .img-box img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ),  
        ) );

        $this->end_controls_section();

        // `Content` Section
        $this->start_controls_section( 'testimonial_content_style', array(
            'label'     => 'Content',
            'tab'       => Controls_Manager::TAB_STYLE,
        ) );

        $this->add_control( 'testimonial_content_text_color', array(
            'label'     => 'Text Color',
            'type'      => Controls_Manager::COLOR,
            'scheme'    => array(
                'type'      => \Elementor\Scheme_Color::get_type(),
                'value'     => \Elementor\Scheme_Color::COLOR_3,
            ),
            'selectors' => array(
                '{{WRAPPER}} .testimonial-content'  => 'color: {{VALUE}}',
            ),
        ) );

        $this->add_group_control( \Elementor\Group_Control_Typography::get_type(), array(
            'name'      => 'testimonial_content_typography',
            'label'     => 'Typography',
            'scheme'    => \Elementor\Scheme_Typography::TYPOGRAPHY_3,
            'selector'  => '{{WRAPPER}} .testimonial-content',
        ) );

        $this->add_group_control( \Elementor\Group_Control_Text_Shadow::get_type(),array(
            'name'      => 'testimonial_content_text_shadow',
            'label'     => 'Text Shadow',
            'selector'  => '{{WRAPPER}} .testimonial-content',
        ) );

        $this->end_controls_section();

        // `Name` Section
        $this->start_controls_section( 'testimonial_name_style', array(
            'label'     => 'Name',
            'tab'       => Controls_Manager::TAB_STYLE,
        ) );

        $this->add_control( 'testimonial_name_text_color', array(
            'label'     => 'Text Color',
            'type'      => Controls_Manager::COLOR,
            'scheme'    => array(
                'type'      => \Elementor\Scheme_Color::get_type(),
                'value'     => \Elementor\Scheme_Color::COLOR_1,
            ),
            'selectors' => array(
                '{{WRAPPER}} .testimonial_name'  => 'color: {{VALUE}}',
            ),
        ) );

        $this->add_group_control( \Elementor\Group_Control_Typography::get_type(), array(
            'name'      => 'testimonial_name_typography',
            'label'     => 'Typography',
            'scheme'    => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
            'selector'  => '{{WRAPPER}} .testimonial_name',
        ) );

        $this->add_group_control( \Elementor\Group_Control_Text_Shadow::get_type(),array(
            'name'      => 'testimonial_name_text_shadow',
            'label'     => 'Text Shadow',
            'selector'  => '{{WRAPPER}} .testimonial_name',
        ) );

        $this->end_controls_section();

        // `Title` Section
        $this->start_controls_section( 'testimonial_title_style', array(
            'label'     => 'Title',
            'tab'       => Controls_Manager::TAB_STYLE,
        ) );

        $this->add_control( 'testimonial_title_text_color', array(
            'label'     => 'Text Color',
            'type'      => Controls_Manager::COLOR,
            'scheme'    => array(
                'type'      => \Elementor\Scheme_Color::get_type(),
                'value'     => \Elementor\Scheme_Color::COLOR_3,
            ),
            'selectors' => array(
                '{{WRAPPER}} .testimonial_title'  => 'color: {{VALUE}}',
            ),
        ) );

        $this->add_group_control( \Elementor\Group_Control_Typography::get_type(), array(
            'name'      => 'testimonial_title_typography',
            'label'     => 'Typography',
            'scheme'    => \Elementor\Scheme_Typography::TYPOGRAPHY_3,
            'selector'  => '{{WRAPPER}} .testimonial_title',
        ) );

        $this->add_group_control( \Elementor\Group_Control_Text_Shadow::get_type(),array(
            'name'      => 'testimonial_title_text_shadow',
            'label'     => 'Text Shadow',
            'selector'  => '{{WRAPPER}} .testimonial_title',
        ) );

        $this->end_controls_section();
    }

    /**
     * Render the widget output on the frontend.
     * 
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( $settings['testimonial_list'] ) {
        ?>

            <div class="swiper-container ts_swiper_container">

                <div class="swiper-wrapper ts_swiper_wrapper">
                
                    <?php foreach ( $settings['testimonial_list'] as $item ) : ?>
                        <div class="swiper-slide">
                            <?php if ( $item['testimonial_image']['url'] ) : ?>
                            <div class="img-box">
                                <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $item, 'testimonial_img_size',  'testimonial_image'); ?>
                            </div>
                            <?php endif; ?>
                            <p class="testimonial-content"><?php echo $item['testimonial_content']; ?></p>
                            <p class="overview"><span class="testimonial_name"><?php echo $item['testimonial_name']; ?></span><?php if ( $item['testimonial_title'] ) : ?><span class="testimonial_title">, <?php echo $item['testimonial_title']; ?></span><?php endif; ?></p>
                        </div>
                    <?php endforeach; ?>
            
                </div>

                <!-- Pagination -->
                <div class="swiper-pagination ts_swiper_pagination"></div>

                <!-- Navigation Buttons -->
                <div class="swiper-button-prev ts_swiper_button_prev"><i class="fas fa-chevron-left"></i></div>
                <div class="swiper-button-next ts_swiper_button_next"><i class="fas fa-chevron-right"></i></div>

            </div>
        
        <?php
        }
    }

}