<?php
 /*
Plugin Name: Custome Metabox
Plugin URI: https://advance_plugin.com
Description: A simple plugin to handle signup and login forms.
Version: 1.0
Author: lucky
*/

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

// Enqueue CSS files
function custom_forms_enqueue_scripts() {
    wp_enqueue_style('custom-style', plugin_dir_url(__FILE__) . 'main.css');
}
add_action('wp_enqueue_scripts', 'custom_forms_enqueue_scripts');

class MY_MetaBox_MyCustomMetaBox {
    // Define the screens where the meta box will appear
    private $screen = ['post'];
    
    // Define the meta fields to be displayed in the meta box
    private $meta_fields = [
        [
            'label' => 'Author',
            'id' => 'author',
            'type' => 'text',
            'default' => '',
        ]
    ];

    public function __construct() {
        // Hook to add the meta box
        add_action('add_meta_boxes', [$this, 'add_meta_boxes']);
        // Hook to enqueue media fields script
        add_action('admin_footer', [$this, 'media_fields']);
        // Hook to save meta fields when the post is saved
        add_action('save_post', [$this, 'save_fields']);
    }

    // Function to add meta boxes
    public function add_meta_boxes() {
        foreach ($this->screen as $single_screen) {
            add_meta_box(
                'MyCustomMetaBox', // Unique ID for the meta box
                __('My Custom MetaBox', 'text-domain'), // Title of the meta box
                [$this, 'meta_box_callback'], // Callback function to render the meta box
                $single_screen, // Screen to display the box on
                'side', // Context (side, normal, advanced)
                'high' // Priority
            );
        }
    }

    // Callback function to display the content of the meta box
    public function meta_box_callback($post) {
        wp_nonce_field('MyCustomMetaBox_data', 'MyCustomMetaBox_nonce'); // Security nonce
        $this->field_generator($post); // Generate and display the fields
    }

    // Function to output media handling JavaScript
    public function media_fields() {
        ?>


        <script>
            jQuery(document).ready(function($) {
                var _custom_media = true,
                    _orig_send_attachment = wp.media.editor.send.attachment;

                // Click event for the new media button
                $('.new-media').click(function(e) {
                    var button = $(this);
                    var id = button.attr('id').replace('_button', '');
                    _custom_media = true;

                    // Handle media attachment
                    wp.media.editor.send.attachment = function(props, attachment) {
                        if (_custom_media) {
                            $('input#' + id).val(attachment.url); // Set input value to the media URL
                            $('div#preview' + id).css('background-image', 'url(' + attachment.url + ')'); // Show preview
                        } else {
                            return _orig_send_attachment.apply(this, [props, attachment]);
                        }
                    };
                    wp.media.editor.open(button); // Open the media library
                    return false;
                });

                // Handle the media button click
                $('.add_media').on('click', function() {
                    _custom_media = false; // Allow default behavior
                });

                // Remove media action
                $('.remove-media').on('click', function() {
                    var parent = $(this).closest('td');
                    parent.find('input[type="text"]').val(''); // Clear input
                    parent.find('div').css('background-image', 'none'); // Clear preview
                });
            });
        </script>

        <?php 
    }

    // Generate the fields in the meta box
    public function field_generator($post) {
        $output = '';
        foreach ($this->meta_fields as $meta_field) {
            // Create label and input for each field
            $label = '<label for="' . esc_attr($meta_field['id']) . '">' . esc_html($meta_field['label']) . '</label>';
            $meta_value = get_post_meta($post->ID, $meta_field['id'], true) ?: $meta_field['default'];
            $input = sprintf(
                '<input id="%s" name="%s" type="%s" value="%s" style="width: 100%%">',
                esc_attr($meta_field['id']),
                esc_attr($meta_field['id']),
                esc_attr($meta_field['type']),
                esc_attr($meta_value)
            );
            $output .= $this->format_rows($label, $input); // Format the rows
        }
        echo '<table class="form-table"><tbody>' . $output . '</tbody></table>'; // Output the table
    }

    // Format rows for the table
    public function format_rows($label, $input) {
        return '<tr><th>' . $label . '</th><td>' . $input . '</td></tr>'; // Return formatted row
    }

    // Save the fields when the post is saved
    public function save_fields($post_id) {
        if (!isset($_POST['MyCustomMetaBox_nonce'])) {
            return; // Check for nonce
        }

        if (!wp_verify_nonce($_POST['MyCustomMetaBox_nonce'], 'MyCustomMetaBox_data')) {
            return; // Verify nonce
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return; // Prevent autosave
        }

        // Save each meta field
        foreach ($this->meta_fields as $meta_field) {
            if (isset($_POST[$meta_field['id']])) {
                $value = '';
                // Sanitize and update the meta value
                switch ($meta_field['type']) {
                    case 'email':
                        $value = sanitize_email($_POST[$meta_field['id']]);
                        break;
                    case 'text':
                    default:
                        $value = sanitize_text_field($_POST[$meta_field['id']]);
                        break;
                }
                update_post_meta($post_id, $meta_field['id'], $value); // Update post meta
            } elseif ($meta_field['type'] === 'checkbox') {
                update_post_meta($post_id, $meta_field['id'], '0'); // Handle checkbox state
            }
        }
    }
}

// Instantiate the class if it exists
if (class_exists('My_MetaBox_MyCustomMetaBox')) {
    new My_MetaBox_MyCustomMetaBox();
}
