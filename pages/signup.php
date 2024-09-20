<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

// Shortcode for signup form
function custom_signup_form() {
    ob_start();

    $error = '';
    $success = '';

    if ( isset( $_POST['custom_signup_submit'] ) ) {
        $email = sanitize_email( $_POST['email'] );
        $password = sanitize_text_field( $_POST['password'] );
        $confirm_password = sanitize_text_field( $_POST['confirm_password'] );

        // Generate a username based on the email (before the "@" symbol)
        $username = explode('@', $email)[0];

        // Check if passwords match
        if ( $password !== $confirm_password ) {
            $error = 'Passwords do not match. Please try again.';
        } elseif ( email_exists( $email ) ) {
            $error = 'Email already exists. Please use another email address.';
        } elseif ( username_exists( $username ) ) {
            $error = 'Username already exists. Please choose a different username.';
        }

        // If no error, create the user
        if ( empty( $error ) ) {
            $userdata = array(
                'user_login'    => $username, // Use the generated username
                'user_email'    => $email,
                'user_pass'     => $password,
            );

            $user_id = wp_insert_user( $userdata );

            if ( is_wp_error( $user_id ) ) {
                // Output any WP_Error message
                $error = 'Error: ' . $user_id->get_error_message();
            } else {
                // Success message
                $success = 'Registration successful! You can now log in.';
            }
        }
    }

    // Display any error messages
    if ( !empty( $error ) ) {
        echo '<div style="color:red;">' . $error . '</div>';
    }

    // Display success message
    if ( !empty( $success ) ) {
        echo '<div style="color:green;">' . $success . '</div>';
    }

    ?>

<section class="bg-gray-50 dark:bg-gray-900">
  <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
          <img class="w-8 h-8 mr-2" src="https://img.freepik.com/free-vector/letter-n-logo-design_474888-2012.jpg?t=st=1726829999~exp=1726833599~hmac=49c23b1cfd68fa0a7e62d9cb100661331936887fd3ed57dc1b388922d6dee507&w=740" alt="logo">
              needinvision
      </a>
      <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                  Create an account
              </h1>
              <form class="space-y-4 md:space-y-6" method="post" action="">
                  <div>
                      <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                      <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required="">
                  </div>
                  <div>
                      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                      <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                  </div>
                  <div>
                      <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
                      <input type="confirm-password" name="confirm_password" id="confirm_password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                  </div>
                  <div class="flex items-start">
                      <div class="flex items-center h-5">
                        <input id="terms" aria-describedby="terms" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800" required="">
                      </div>
                      <div class="ml-3 text-sm">
                        <label for="terms" class="font-light text-gray-500 dark:text-gray-300">I accept the <a class="font-medium text-primary-600 hover:underline dark:text-primary-500" href="#">Terms and Conditions</a></label>
                      </div>
                  </div>
                  <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800" name="custom_signup_submit">Create an account</button>
                  <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                      Already have an account? <a href="#" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Login here</a>
                  </p>
              </form>
          </div>
      </div>
  </div>
</section>


    <?php
    return ob_get_clean();
}
add_shortcode('custom_signup', 'custom_signup_form');

?>