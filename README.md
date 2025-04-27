# **📦 Custom Meta Box Plugin for WordPress**  

Enhance your WordPress posts with a **custom meta box** that allows you to add extra information like **author name** and **media uploads**—all securely integrated into the post editor.  

---

-✨ Key Features**  
✅ **Custom Meta Box** – Adds a dedicated panel in the WordPress post editor.  
📝 **Author Name Field** – Store additional author details per post.  
🖼 **Media Upload Integration** – Easily attach images or files directly from the meta box.  
🔒 **Secure Data Handling** – Uses WordPress **nonces** and sanitization for protection.  
⚙ **Extensible Structure** – Easily add more custom fields as needed.  

---

-📥 Installation**  
1. **Download** the plugin files (ZIP or clone the repository).  
2. **Upload** the folder to `/wp-content/plugins/`.  
3. **Activate** the plugin via **WordPress Admin → Plugins → "Custom Meta Box"**.  

---

-📝 Usage**  
1. **Edit or create a new post** in WordPress.  
2. Locate the **"Post Details"** meta box in the right sidebar.  
3. **Enter the author name** and **upload media** as needed.  
4. **Save or update** the post to store the meta data.  

---

-🧩 Code Structure**  
#-🔹 Plugin Properties**  
- `$screen` – Controls where the meta box appears (default: `post`).  
- `$meta_fields` – Defines custom fields (text, media, etc.).  

#-🔹 Core Methods**  
- **`__construct()`** – Initializes hooks and meta box setup.  
- **`add_meta_boxes()`** – Registers the meta box in the editor.  
- **`meta_box_callback()`** – Renders the meta box content.  
- **`media_fields()`** – Handles media upload functionality.  
- **`field_generator()`** – Dynamically generates input fields.  
- **`format_rows()`** – Organizes fields in a structured layout.  
- **`save_fields()`** – Securely saves field data to the database.  

---

-🛡 Security**  
🔐 **Nonce Verification** – Prevents CSRF attacks.  
🧼 **Data Sanitization** – Ensures safe storage of user input.  

---

-🤝 Contributing**  
Contributions are welcome!  
- **Report issues** or suggest improvements via GitHub.  
- **Submit pull requests** for new features or fixes.  

---

-📜 License**  
This plugin is **open-source** under the **[MIT License](https://opensource.org/licenses/MIT)**.  

---

-🆘 Support**  
Need help?  
📌 **Open an issue** on GitHub for assistance.  

---

#-🚀 Enhance Your WordPress Posts Today!**  
Easily add custom fields, media uploads, and structured data to your posts with this lightweight, secure, and developer-friendly meta box plugin.  

🔗 **Download Now & Start Customizing!**
