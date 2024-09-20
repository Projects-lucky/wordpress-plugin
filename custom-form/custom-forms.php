<?php
/*
Plugin Name: Custom Forms Plugin
Plugin URI: https://example.com
Description: A simple plugin to handle signup and login forms.
Version: 1.0
Author: lucky
Author URI: https://example.com
*/

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin directory path
define('CUSTOM_FORMS_PLUGIN_DIR', plugin_dir_path(__FILE__));

// Add the menu pages
function custom_forms_menu(){
    add_menu_page("Forms", "Custom Forms", "manage_options", "cs-forms", "signup_forms_callback");
   
}
add_action('admin_menu', 'custom_forms_menu');

// Enqueue CSS files
function custom_forms_enqueue_scripts() {
    wp_enqueue_style('custom-forms-style', plugin_dir_url(__FILE__) . 'assets/css/main.css');
    wp_enqueue_style('custom-forms-styles', plugin_dir_url(__FILE__) . 'assets/css/login.css');
}
add_action('wp_enqueue_scripts', 'custom_forms_enqueue_scripts');

// Include signup and login pages
require_once(CUSTOM_FORMS_PLUGIN_DIR . "pages/signup.php");
require_once(CUSTOM_FORMS_PLUGIN_DIR . "pages/login.php");

// function for calling table 
function signup_forms_callback() {
    echo '<h1>Signup and login Forms</h1>';
    ob_start();
    require_once(CUSTOM_FORMS_PLUGIN_DIR . "pages/table.php");
    $output = ob_get_contents();
    ob_end_clean();
    echo $output;
}
