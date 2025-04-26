<?php
/**
 * Plugin Name: Tools for WP
 * Plugin URI: https://example.com/tools-for-wp
 * Description: A collection of useful tools including BMI Calculator, KG to Pound Converter, and KM to Miles Converter.
 * Version: 1.0.0
 * Author: WordPress Developer
 * Author URI: https://example.com
 * Text Domain: tools-for-wp
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * WordPress function stubs for IDE compatibility
 * These declarations help IDEs recognize WordPress functions
 * They are not executed in a WordPress environment
 */
if (!function_exists('plugin_dir_path')) {
    function plugin_dir_path($file) { return dirname($file) . '/'; }
}
if (!function_exists('plugin_dir_url')) {
    function plugin_dir_url($file) { return ''; }
}
if (!function_exists('add_action')) {
    function add_action($hook, $callback, $priority = 10, $accepted_args = 1) {}
}
if (!function_exists('add_shortcode')) {
    function add_shortcode($tag, $callback) {}
}
if (!function_exists('wp_register_style')) {
    function wp_register_style($handle, $src, $deps = array(), $ver = false, $media = 'all') {}
}
if (!function_exists('wp_register_script')) {
    function wp_register_script($handle, $src, $deps = array(), $ver = false, $in_footer = false) {}
}
if (!function_exists('wp_localize_script')) {
    function wp_localize_script($handle, $object_name, $l10n) {}
}
if (!function_exists('admin_url')) {
    function admin_url($path = '', $scheme = 'admin') { return ''; }
}
if (!function_exists('wp_enqueue_style')) {
    function wp_enqueue_style($handle, $src = '', $deps = array(), $ver = false, $media = 'all') {}
}
if (!function_exists('wp_enqueue_script')) {
    function wp_enqueue_script($handle, $src = '', $deps = array(), $ver = false, $in_footer = false) {}
}

// Define plugin constants
define('TOOLS_FOR_WP_VERSION', '1.0.0');
define('TOOLS_FOR_WP_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('TOOLS_FOR_WP_PLUGIN_URL', plugin_dir_url(__FILE__));

// Include admin settings page
require_once TOOLS_FOR_WP_PLUGIN_DIR . 'admin/settings-page.php';

/**
 * The core plugin class
 */
class Tools_For_WP {    
    /**
     * Settings instance
     */
    private $settings;

    /**
     * Initialize the plugin
     */
    public function __construct() {
        // Initialize settings
        $this->settings = new Tools_For_WP_Settings();
        
        // Register scripts and styles
        add_action('wp_enqueue_scripts', array($this, 'register_assets'));
        
        // Register shortcodes
        add_shortcode('bmi_calculator', array($this, 'bmi_calculator_shortcode'));
        add_shortcode('kg_to_pound', array($this, 'kg_to_pound_shortcode'));
        add_shortcode('km_to_miles', array($this, 'km_to_miles_shortcode'));
        
        // Add custom CSS to head
        add_action('wp_head', array($this, 'add_custom_css'));
    }

    /**
     * Register and enqueue scripts and styles
     */
    public function register_assets() {
        // Register styles
        wp_register_style(
            'tools-for-wp-styles',
            TOOLS_FOR_WP_PLUGIN_URL . 'assets/css/tools-for-wp.css',
            array(),
            TOOLS_FOR_WP_VERSION
        );

        // Register scripts
        wp_register_script(
            'tools-for-wp-scripts',
            TOOLS_FOR_WP_PLUGIN_URL . 'assets/js/tools-for-wp.js',
            array('jquery'),
            TOOLS_FOR_WP_VERSION,
            true
        );

        // Localize script for AJAX URL
        wp_localize_script(
            'tools-for-wp-scripts',
            'tools_for_wp_params',
            array(
                'ajax_url' => admin_url('admin-ajax.php'),
            )
        );
    }

    /**
     * BMI Calculator shortcode callback
     */
    public function bmi_calculator_shortcode($atts) {
        // Enqueue assets
        wp_enqueue_style('tools-for-wp-styles');
        wp_enqueue_script('tools-for-wp-scripts');
        
        // Start output buffering
        ob_start();
        
        // Include the template
        include TOOLS_FOR_WP_PLUGIN_DIR . 'templates/bmi-calculator.php';
        
        // Return the buffered content
        return ob_get_clean();
    }

    /**
     * KG to Pound Converter shortcode callback
     */
    public function kg_to_pound_shortcode($atts) {
        // Enqueue assets
        wp_enqueue_style('tools-for-wp-styles');
        wp_enqueue_script('tools-for-wp-scripts');
        
        // Start output buffering
        ob_start();
        
        // Include the template
        include TOOLS_FOR_WP_PLUGIN_DIR . 'templates/kg-to-pound.php';
        
        // Return the buffered content
        return ob_get_clean();
    }

    /**
     * KM to Miles Converter shortcode callback
     */
    public function km_to_miles_shortcode($atts) {
        // Enqueue assets
        wp_enqueue_style('tools-for-wp-styles');
        wp_enqueue_script('tools-for-wp-scripts');
        
        // Start output buffering
        ob_start();
        
        // Include the template
        include TOOLS_FOR_WP_PLUGIN_DIR . 'templates/km-to-miles.php';
        
        // Return the buffered content
        return ob_get_clean();
    }
    
    /**
     * Add custom CSS based on settings
     */
    public function add_custom_css() {
        $settings = $this->settings->get_settings();
        
        // Start output buffering
        ob_start();
        ?>
        <style type="text/css">
            :root {
                --primary-color: <?php echo esc_attr($settings['primary_color']); ?>;
                --secondary-color: <?php echo esc_attr($settings['secondary_color']); ?>;
                --accent-color: <?php echo esc_attr($settings['accent_color']); ?>;
                --error-color: <?php echo esc_attr($settings['error_color']); ?>;
                --text-color: <?php echo esc_attr($settings['text_color']); ?>;
                --border-radius: <?php echo esc_attr($settings['border_radius']); ?>;
                --box-shadow: <?php echo esc_attr($settings['box_shadow']); ?>;
                --transition: all 0.3s ease;
            }
            
            .tools-for-wp-container {
                font-family: '<?php echo esc_attr($settings['font_family']); ?>', sans-serif;
            }
        </style>
        <?php
        
        // Output the buffered CSS
        echo ob_get_clean();
    }
}

// Initialize the plugin
$tools_for_wp = new Tools_For_WP();