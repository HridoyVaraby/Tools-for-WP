<?php
/**
 * Tools for WP - Admin Settings Page
 *
 * This file handles the admin settings page for the Tools for WP plugin,
 * allowing users to customize colors, fonts, and other design elements.
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * Class for handling the admin settings page
 */
class Tools_For_WP_Settings {

    /**
     * Settings group name
     */
    private $option_group = 'tools_for_wp_options';

    /**
     * Settings option name in the database
     */
    private $option_name = 'tools_for_wp_settings';

    /**
     * Default settings
     */
    private $defaults = array(
        'primary_color' => '#007BFF',
        'secondary_color' => '#F2F2F2',
        'accent_color' => '#28A745',
        'error_color' => '#DC3545',
        'text_color' => '#333333',
        'font_family' => 'Roboto',
        'border_radius' => '5px',
        'box_shadow' => '0 2px 5px rgba(0, 0, 0, 0.1)'
    );

    /**
     * Initialize the class
     */
    public function __construct() {
        // Add admin menu
        add_action('admin_menu', array($this, 'add_settings_page'));
        
        // Register settings
        add_action('admin_init', array($this, 'register_settings'));
    }

    /**
     * Add settings page to admin menu
     */
    public function add_settings_page() {
        add_options_page(
            'Tools for WP Settings',
            'Tools for WP',
            'manage_options',
            'tools-for-wp-settings',
            array($this, 'render_settings_page')
        );
    }

    /**
     * Register settings
     */
    public function register_settings() {
        register_setting(
            $this->option_group,
            $this->option_name,
            array($this, 'sanitize_settings')
        );

        // Add settings section
        add_settings_section(
            'tools_for_wp_appearance_section',
            'Appearance Settings',
            array($this, 'render_section_description'),
            'tools-for-wp-settings'
        );

        // Add settings fields
        add_settings_field(
            'primary_color',
            'Primary Color',
            array($this, 'render_color_field'),
            'tools-for-wp-settings',
            'tools_for_wp_appearance_section',
            array('field' => 'primary_color')
        );

        add_settings_field(
            'secondary_color',
            'Secondary Color',
            array($this, 'render_color_field'),
            'tools-for-wp-settings',
            'tools_for_wp_appearance_section',
            array('field' => 'secondary_color')
        );

        add_settings_field(
            'accent_color',
            'Accent Color',
            array($this, 'render_color_field'),
            'tools-for-wp-settings',
            'tools_for_wp_appearance_section',
            array('field' => 'accent_color')
        );

        add_settings_field(
            'error_color',
            'Error Color',
            array($this, 'render_color_field'),
            'tools-for-wp-settings',
            'tools_for_wp_appearance_section',
            array('field' => 'error_color')
        );

        add_settings_field(
            'text_color',
            'Text Color',
            array($this, 'render_color_field'),
            'tools-for-wp-settings',
            'tools_for_wp_appearance_section',
            array('field' => 'text_color')
        );

        add_settings_field(
            'font_family',
            'Font Family',
            array($this, 'render_font_field'),
            'tools-for-wp-settings',
            'tools_for_wp_appearance_section'
        );

        add_settings_field(
            'border_radius',
            'Border Radius',
            array($this, 'render_text_field'),
            'tools-for-wp-settings',
            'tools_for_wp_appearance_section',
            array('field' => 'border_radius')
        );

        add_settings_field(
            'box_shadow',
            'Box Shadow',
            array($this, 'render_text_field'),
            'tools-for-wp-settings',
            'tools_for_wp_appearance_section',
            array('field' => 'box_shadow')
        );
    }

    /**
     * Sanitize settings
     */
    public function sanitize_settings($input) {
        $sanitized = array();
        
        // Sanitize color fields
        $color_fields = array('primary_color', 'secondary_color', 'accent_color', 'error_color', 'text_color');
        foreach ($color_fields as $field) {
            if (isset($input[$field])) {
                // Validate hex color
                if (preg_match('/^#[a-f0-9]{6}$/i', $input[$field])) {
                    $sanitized[$field] = $input[$field];
                } else {
                    $sanitized[$field] = $this->defaults[$field];
                    add_settings_error(
                        $this->option_name,
                        'invalid_color',
                        'Invalid color format. Please use a valid hex color code.',
                        'error'
                    );
                }
            }
        }
        
        // Sanitize font family
        if (isset($input['font_family'])) {
            $sanitized['font_family'] = sanitize_text_field($input['font_family']);
        }
        
        // Sanitize border radius
        if (isset($input['border_radius'])) {
            $sanitized['border_radius'] = sanitize_text_field($input['border_radius']);
        }
        
        // Sanitize box shadow
        if (isset($input['box_shadow'])) {
            $sanitized['box_shadow'] = sanitize_text_field($input['box_shadow']);
        }
        
        return $sanitized;
    }

    /**
     * Render section description
     */
    public function render_section_description() {
        echo '<p>Customize the appearance of your tools by adjusting the colors, fonts, and other design elements.</p>';
    }

    /**
     * Render color field
     */
    public function render_color_field($args) {
        $options = get_option($this->option_name, $this->defaults);
        $field = $args['field'];
        $value = isset($options[$field]) ? $options[$field] : $this->defaults[$field];
        
        echo '<input type="color" id="' . esc_attr($field) . '" name="' . esc_attr($this->option_name) . '[' . esc_attr($field) . ']" value="' . esc_attr($value) . '" class="color-picker" />';
    }

    /**
     * Render font field
     */
    public function render_font_field() {
        $options = get_option($this->option_name, $this->defaults);
        $value = isset($options['font_family']) ? $options['font_family'] : $this->defaults['font_family'];
        
        $fonts = array(
            'Roboto' => 'Roboto',
            'Open Sans' => 'Open Sans',
            'Lato' => 'Lato',
            'Montserrat' => 'Montserrat',
            'Poppins' => 'Poppins',
            'Arial' => 'Arial',
            'Helvetica' => 'Helvetica',
            'Georgia' => 'Georgia',
            'Times New Roman' => 'Times New Roman'
        );
        
        echo '<select id="font_family" name="' . esc_attr($this->option_name) . '[font_family]">';
        foreach ($fonts as $font_value => $font_name) {
            echo '<option value="' . esc_attr($font_value) . '"' . selected($value, $font_value, false) . '>' . esc_html($font_name) . '</option>';
        }
        echo '</select>';
    }

    /**
     * Render text field
     */
    public function render_text_field($args) {
        $options = get_option($this->option_name, $this->defaults);
        $field = $args['field'];
        $value = isset($options[$field]) ? $options[$field] : $this->defaults[$field];
        
        echo '<input type="text" id="' . esc_attr($field) . '" name="' . esc_attr($this->option_name) . '[' . esc_attr($field) . ']" value="' . esc_attr($value) . '" class="regular-text" />';
    }

    /**
     * Render settings page
     */
    public function render_settings_page() {
        if (!current_user_can('manage_options')) {
            return;
        }
        
        // Add admin styles
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('wp-color-picker');
        wp_enqueue_style(
            'tools-for-wp-admin-styles',
            TOOLS_FOR_WP_PLUGIN_URL . 'admin/admin-styles.css',
            array(),
            TOOLS_FOR_WP_VERSION
        );
        
        // Initialize color pickers
        add_action('admin_footer', array($this, 'init_color_pickers'));
        
        // Get current settings
        $options = get_option($this->option_name, $this->defaults);
        
        // Show settings form
        ?>
        <div class="wrap tools-for-wp-settings-wrap">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            
            <div class="tools-for-wp-settings-section">
                <form method="post" action="options.php">
                    <?php
                    settings_fields($this->option_group);
                    do_settings_sections('tools-for-wp-settings');
                    submit_button('Save Settings');
                    ?>
                </form>
            </div>
            
            <div class="tools-for-wp-preview">
                <h3>Live Preview</h3>
                <p>This is how your tools will look with the current settings:</p>
                
                <div class="preview-box" id="preview-box" style="
                    border-radius: <?php echo esc_attr($options['border_radius']); ?>;
                    box-shadow: <?php echo esc_attr($options['box_shadow']); ?>;
                    font-family: '<?php echo esc_attr($options['font_family']); ?>', sans-serif;
                ">
                    <div class="preview-title" style="color: <?php echo esc_attr($options['primary_color']); ?>">
                        Sample Tool Title
                    </div>
                    <div class="preview-text" style="color: <?php echo esc_attr($options['text_color']); ?>">
                        This is a preview of how your tools will appear with the selected styling options.
                    </div>
                    <a href="#" class="preview-button" style="
                        background-color: <?php echo esc_attr($options['primary_color']); ?>;
                        border-radius: <?php echo esc_attr($options['border_radius']); ?>;
                    ">Sample Button</a>
                </div>
                
                <p class="tools-for-wp-help-text">Note: The preview updates in real-time as you change the settings. Click "Save Settings" to apply these changes to your tools.</p>
            </div>
        </div>
        <?php
    }

    /**
     * Initialize color pickers
     */
    public function init_color_pickers() {
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                // Initialize color pickers
                $('.color-picker').wpColorPicker({
                    change: function(event, ui) {
                        updatePreview();
                    }
                });
                
                // Update preview when select or text inputs change
                $('#font_family, #border_radius, #box_shadow').on('change input', function() {
                    updatePreview();
                });
                
                // Function to update the preview
                function updatePreview() {
                    var primaryColor = $('#primary_color').val();
                    var textColor = $('#text_color').val();
                    var borderRadius = $('#border_radius').val();
                    var boxShadow = $('#box_shadow').val();
                    var fontFamily = $('#font_family').val();
                    
                    // Update preview box
                    $('#preview-box').css({
                        'border-radius': borderRadius,
                        'box-shadow': boxShadow,
                        'font-family': "'" + fontFamily + "', sans-serif"
                    });
                    
                    // Update preview title
                    $('.preview-title').css('color', primaryColor);
                    
                    // Update preview text
                    $('.preview-text').css('color', textColor);
                    
                    // Update preview button
                    $('.preview-button').css({
                        'background-color': primaryColor,
                        'border-radius': borderRadius
                    });
                }
            });
        </script>
        <?php
    }

    /**
     * Get settings
     */
    public function get_settings() {
        return get_option($this->option_name, $this->defaults);
    }
}