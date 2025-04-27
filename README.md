🛠 Custom Meta Box: Adds a meta box to the WordPress post editor for extra info like author name, with media upload support.
✨ Features:
Custom meta box for posts
Input field for author name
Media upload integration
Secure data handling (nonce verification)
Easy extension with more fields
📥 Installation:
Clone/download the repository
Upload the metabox folder to /wp-content/plugins/
Activate "WP Skills Custom Meta Box" from WordPress admin
📝 Usage:
Edit/Create a post
Find "My Custom MetaBox" in the right sidebar
Enter author name, add media, and save the post
🧩 Code Structure:
Properties: $screen, $meta_fields
Methods: __construct(), add_meta_boxes(), meta_box_callback(), media_fields(), field_generator(), format_rows(), save_fields()
🛡 Security: Uses WordPress nonces to protect against CSRF attacks.
🤝 Contributing: Contributions are welcome via pull requests or issues.
📜 License: Licensed under the MIT License.
🆘 Support: Open an issue on GitHub if you need help.
