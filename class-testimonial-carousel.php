<?php
/**
 * Testimonial_Carousel class.
 * 
 * @category    Class
 * @package     TestimonialCarouselforElementor
 * @subpackage  WordPress
 * @author      priyanshuchaudhary53
 * @since       1.0.0
 * php version  7.3.9
 */

if ( ! defined( 'ABSPATH' ) ) {
    // Exit if accessed directly.
    exit;
}

/**
 * Main Testimonial Carousel Class
 *
 */

final class Testimonial_Carousel {

    /**
     * Plugin Version
     * 
     * @since 1.0.0
     * @var string Plugin version.
     */
    const VERSION = '1.0.0';

    /**
     * Minimum Elementor Version
     * 
     * @since 1.0.0
     * @var string Minimum Elementor version required.
     */
    const MINIMUM_ELEMENTOR_VERSION = '2.0.0';
    
    /**
     * Minimum PHP Version
     * 
     * @since 1.0.0
     * @var string Minimum PHP version required.
     */
    const MINIMUM_PHP_VERSION = '7.0';

    /**
     * Constructor
     * 
     * @since 1.0.0
     * @access public
     */
    public function __construct() {
        // Initialize the plugin
        add_action( 'plugins_loaded', array( $this, 'init' ) );
    }

    /**
     * Initialize the plugin
     * 
     * Validates the Elementor is installed and activated.
     * Checks for baisc plugin requiremenrs.
     * 
     * @since 1.0.0
     * @access public
     */
    public function init() {

        // Check if Elementor installed and activated.
        if ( ! did_action( 'elementor/loaded' ) ) {
            add_action ( 'admin_notices', array( $this, 'admin_notice_missing_elementor' ) );
            return;                                                                     
        }

        // Check for required Elementor version.
        if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
            add_action( 'admin_notices', array( $this, 'admin_notice_minium_elementor_version' ) );
            return;
        }

        // Check for required PHP version.
        if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
            add_action( 'admin_notices', array( $this, 'admin_notice_minuimum_php_version' ) );
            return;
        }

        // All validation checks has been passed. Now widgets can be safely included.
        require_once 'class-widgets.php';
    }

    /**
     * Admin notice
     * 
     * Warning when the website doesn't have Elementor installed or activated.
     * 
     * @since 1.0.0
     * @access public
     */
    public function admin_notice_missing_elementor() {
        deactivate_plugins( plugin_basename( TESTIMONIAL_CAROUSEL ) );
        unset( $_GET['activate'] );
        echo sprintf(
            wp_kses( '<div class="notice notice-warning is-dismissible"><p><strong>"%1$s"</strong> requires <strong>"%2$s"</strong> to be installed and activated.</p></div>', array(
                'div'      => array( 'class' => array() ),
                'p'        => array(),
                'strong'   => array(),
            ) ),
            'Testimonial Carousel',
            'Elementor'
        );
    }
    
    /**
     * Admin notice
     * 
     * Warning when the website doesn't have a minimum required Elementor version.
     * 
     * @since 1.0.0
     * @access public
     */
    public function admin_notice_minium_elementor_version() {
        deactivate_plugins( plugin_basename( TESTIMONIAL_CAROUSEL ) );
        unset( $_GET['activate'] );
        echo sprintf(
            wp_kses( '<div class="notice notice-warning is-dismissible"><p><strong>"%1$s"</strong> requires <strong>"%2$s"</strong> version %3$s or greater.</p></div>', array(
                'div'      => array( 'class' => array() ),
                'p'        => array(),
                'strong'   => array(),
            ) ),
            'Testimonial Carousel',
            'Elementor',
            self::MINIMUM_ELEMENTOR_VERSION
        );
    }

    /**
     * Admin notice
     * 
     * Warning when the website doesn't have a minimum required PHP version.
     * 
     * @since 1.0.0
     * @access public
     */
    public function admin_notice_minuimum_php_version() {
        deactivate_plugins( plugin_basename( TESTIMONIAL_CAROUSEL ) );
        unset( $_GET['activate'] );
        echo sprintf(
            wp_kses( '<div class="notice notice-warning is-dismissible"><p><strong>"%1$s"</strong> requires <strong>"%2$s"</strong> version %3$s or greater.</p></div>', array(
                'div'      => array( 'class' => array() ),
                'p'        => array(),
                'strong'   => array(),
            ) ),
            'Testimonial Carousel',
            'PHP',
            self::MINIMUM_PHP_VERSION
        );
    }
}

// Instantiate Testimonial_Carousel
new Testimonial_Carousel();