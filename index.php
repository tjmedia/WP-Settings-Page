<?php
/*
Plugin Name: Custom Settings Page for Website
Plugin URI: http://www.thomasjono.com/
Description: Custom settings page for the Website
Version: 1.0
Author: Thomas Jono
Author URI: http://www.thomasjono.com/
License: GPL1
*/

class MySettingsPage {
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct() {
        add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
        add_action( 'admin_init', array( $this, 'settings_init' ) );
    }

    /**
     * Add options page
     */
    public function add_admin_menu() {
        // This page will be under "Settings"
        add_menu_page('Settings Admin', 'AR Settings', 'manage_options', 'ar-admin', array( $this, 'create_admin_page' ));
    }

    /**
     * Options page callback
     */
    public function create_admin_page() {
        // Set class property
        $this->options = get_option( 'my_option_name' );
        ?>
        <div class="wrap">
            <style type="text/css">
                @import url(/reference-to-custom-styles.css');
                .form-table td {padding: 10px;}
                .col-xs-6 {padding: 0;}
            </style>
            <?php screen_icon(); ?>
            <h2>Website Settings</h2>           
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'my_option_group' );   
                do_settings_sections( 'ar-admin' );
                submit_button(); 
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function settings_init() {        
        register_setting(
            'my_option_group', // Option group
            'my_option_name', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        $admin = "ar-admin";
        $section = "setting_section_category_id";

        add_settings_section(
            'setting_section_id', // ID
            'About Us Map', // Title
            array( $this, 'print_section_info' ), // Callback
            $admin // Page
        );

        add_settings_section(
            'setting_section_category_id', // ID
            'Category Section', // Title
            array( $this, 'print_category_section_info' ), // Callback
            $admin // Page
        );

        add_settings_field(
            'arctic_training_number', // ID
            '# of students trained', // Title 
            array( $this, 'arctic_training_number_callback' ), // Callback
            $admin, // Page
            'setting_section_id' // Section           
        );    

        add_settings_field(
            'image_01', // ID
            'Category 1 Image', // Title 
            array( $this, 'first_aid_image_callback' ), // Callback
            $admin, // Page
            $section // Section
        );

        add_settings_field(
            'image_01_link', // ID
            'Category 1 Link', // Title 
            array( $this, 'first_aid_image_link_callback' ), // Callback
            $admin, // Page
            $section // Section
        );

        add_settings_field(
            'image_02', // ID
            'Category 2 Image', // Title
            array( $this, 'field_image_callback' ), // Callback
            $admin, // Page
            $section // Section
        );

        add_settings_field(
            'image_02_link', // ID
            'Category 2 Link', // Title 
            array( $this, 'field_image_link_callback' ), // Callback
            $admin, // Page
            $section // Section
        );

        add_settings_field(
            'image_03', // ID
            'Category 3 Image', // Title
            array( $this, 'industrial_image_callback' ), // Callback
            $admin, // Page
            $section // Section
        );

        add_settings_field(
            'image_03_link', // ID
            'Category 3 Link', // Title 
            array( $this, 'industrial_image_link_callback' ), // Callback
            $admin, // Page
            $section // Section
        );

        add_settings_field(
            'image_04', // ID
            'Category 4 Image', // Title
            array( $this, 'driver_image_callback' ), // Callback
            $admin, // Page
            $section // Section
        );

        add_settings_field(
            'image_04_link', // ID
            'Category 4 Link', // Title 
            array( $this, 'driver_image_link_callback' ), // Callback
            $admin, // Page
            $section // Section
        );

        add_settings_field(
            'image_05', // ID
            'Category 5 Image', // Title
            array( $this, 'career_image_callback' ), // Callback
            $admin, // Page
            $section // Section
        );

        add_settings_field(
            'image_05_link', // ID
            'Category 5 Link', // Title 
            array( $this, 'career_image_link_callback' ), // Callback
            $admin, // Page
            $section // Section
        );
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input ) {
        $new_input = array();
        if( isset( $input['arctic_training_number'] ) )
            $new_input['arctic_training_number'] = absint( $input['arctic_training_number'] );
        if( isset( $input['image_01'] ) )
            $new_input['image_01'] = sanitize_text_field( $input['image_01'] );
        if( isset( $input['image_01_link'] ) )
            $new_input['image_01_link'] = sanitize_text_field( $input['image_01_link'] );
        if( isset( $input['image_02'] ) )
            $new_input['image_02'] = sanitize_text_field( $input['image_02'] );
        if( isset( $input['image_02_link'] ) )
            $new_input['image_02_link'] = sanitize_text_field( $input['image_02_link'] );
        if( isset( $input['image_03'] ) )
            $new_input['image_03'] = sanitize_text_field( $input['image_03'] );
        if( isset( $input['image_03_link'] ) )
            $new_input['image_03_link'] = sanitize_text_field( $input['image_03_link'] );
        if( isset( $input['image_04'] ) )
            $new_input['image_04'] = sanitize_text_field( $input['image_04'] );
        if( isset( $input['image_04_link'] ) )
            $new_input['image_04_link'] = sanitize_text_field( $input['image_04_link'] );
        if( isset( $input['image_05'] ) )
            $new_input['image_05'] = sanitize_text_field( $input['image_05'] );
        if( isset( $input['image_05_link'] ) )
            $new_input['image_05_link'] = sanitize_text_field( $input['image_05_link'] );

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info() {
        print 'This is where you can change the number of students trained throughout Canada.';
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function arctic_training_number_callback() {
        printf( '<input type="text" id="arctic_training_number" name="my_option_name[arctic_training_number]" value="%s" />',
            isset( $this->options['arctic_training_number'] ) ? esc_attr( $this->options['arctic_training_number']) : ''
        );
    }

    public function print_category_section_info() {
        print 'This is where you can change the images for each category under the Training section.';
    }

    /**
     * Get the settings option array and print one of its values
     */
    public function first_aid_image_callback() {
        printf( '<div class="col-xs-6 col-sm4"><input type="text" id="image_01" class="form-control" name="my_option_name[image_01]" placeholder="http://arcticresponse.ca/wp-content/uploads/2015/01/example.jpg" value="%s" /><span class="help-block">You can get the image source from the Media library. Copy & paste the image source into this field. Example: http://arcticresponse.thomasjono.com/wp-content/uploads/2015/01/Defensive-Driving.jpg</span></div>', isset( $this->options['image_01'] ) ? esc_attr( $this->options['image_01']) : '');
    }

    public function first_aid_image_link_callback() {
        printf( '<div class="col-xs-6 col-sm4"><input type="text" id="image_01_link" class="form-control" name="my_option_name[image_01_link]" placeholder="Enter the category name (ie. First Aid)" value="%s" /><span class="help-block">The category name will be under Posts -> Categories. From there, you can see the names of all categories. Example: First Aid</span></div>', isset( $this->options['image_01_link'] ) ? esc_attr( $this->options['image_01_link']) : '');
    }

    public function field_image_callback() {
        printf( '<div class="col-xs-6 col-sm4"><input type="text" id="image_02" class="form-control" name="my_option_name[image_02]" placeholder="http://arcticresponse.ca/wp-content/uploads/2015/01/example.jpg" value="%s" /></div>',
            isset( $this->options['image_02'] ) ? esc_attr( $this->options['image_02']) : ''
        );
    }

    public function field_image_link_callback() {
        printf( '<div class="col-xs-6 col-sm4"><input type="text" id="image_02_link" class="form-control" name="my_option_name[image_02_link]" placeholder="Enter the category name (ie. First Aid)" value="%s" /></div>',
            isset( $this->options['image_02_link'] ) ? esc_attr( $this->options['image_02_link']) : ''
        );
    }

    public function industrial_image_callback() {
        printf( '<div class="col-xs-6 col-sm4"><input type="text" id="image_03" class="form-control" name="my_option_name[image_03]" placeholder="http://arcticresponse.ca/wp-content/uploads/2015/01/example.jpg" value="%s" /></div>',
            isset( $this->options['image_03'] ) ? esc_attr( $this->options['image_03']) : ''
        );
    }

    public function industrial_image_link_callback() {
        printf( '<div class="col-xs-6 col-sm4"><input type="text" id="image_03_link" class="form-control" name="my_option_name[image_03_link]" placeholder="Enter the category name (ie. First Aid)" value="%s" /></div>',
            isset( $this->options['image_03_link'] ) ? esc_attr( $this->options['image_03_link']) : ''
        );
    }

    public function driver_image_callback() {
        printf( '<div class="col-xs-6 col-sm4"><input type="text" id="image_04" class="form-control" name="my_option_name[image_04]" placeholder="http://arcticresponse.ca/wp-content/uploads/2015/01/example.jpg" value="%s" /></div>',
            isset( $this->options['image_04'] ) ? esc_attr( $this->options['image_04']) : ''
        );
    }

    public function driver_image_link_callback() {
        printf( '<div class="col-xs-6 col-sm4"><input type="text" id="image_04_link" class="form-control" name="my_option_name[image_04_link]" placeholder="Enter the category name (ie. First Aid)" value="%s" /></div>',
            isset( $this->options['image_04_link'] ) ? esc_attr( $this->options['image_04_link']) : ''
        );
    }

    public function career_image_callback() {
        printf( '<div class="col-xs-6 col-sm4"><input type="text" id="image_05" class="form-control" name="my_option_name[image_05]" placeholder="http://arcticresponse.ca/wp-content/uploads/2015/01/example.jpg" value="%s" /></div>',
            isset( $this->options['image_05'] ) ? esc_attr( $this->options['image_05']) : ''
        );
    }

    public function career_image_link_callback() {
        printf( '<div class="col-xs-6 col-sm4"><input type="text" id="image_05_link" class="form-control" name="my_option_name[image_05_link]" placeholder="Enter the category name (ie. First Aid)" value="%s" /></div>',
            isset( $this->options['image_05_link'] ) ? esc_attr( $this->options['image_05_link']) : ''
        );
    }
}

if( is_admin() )
    $my_settings_page = new MySettingsPage();
